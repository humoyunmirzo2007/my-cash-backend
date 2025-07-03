<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared("
            CREATE OR REPLACE FUNCTION trg_after_insert_cash_box_conversion()
            RETURNS TRIGGER AS
            \$\$
            DECLARE
                from_currency TEXT;
                to_currency TEXT;
            BEGIN
                SELECT currency INTO from_currency FROM cash_boxes WHERE id = NEW.from_cash_box_id;
                SELECT currency INTO to_currency FROM cash_boxes WHERE id = NEW.to_cash_box_id;

                INSERT INTO cash_box_operations (
                    user_id, output_type_id, input_type_id, currency, amount, comment, conversion_id, created_at, updated_at
                ) VALUES (
                    NEW.user_id, NULL, NULL, from_currency, -NEW.from_amount, NEW.comment, NEW.id, now(), now()
                );

                INSERT INTO cash_box_operations (
                    user_id, output_type_id, input_type_id, currency, amount, comment, conversion_id, created_at, updated_at
                ) VALUES (
                    NEW.user_id, NULL, NULL, to_currency, NEW.to_amount, NEW.comment, NEW.id, now(), now()
                );
                
                RETURN NEW;
            END;
            \$\$ LANGUAGE plpgsql;

            DROP TRIGGER IF EXISTS trg_after_insert_cash_box_conversion ON cash_box_conversions;

            CREATE TRIGGER trg_after_insert_cash_box_conversion
            AFTER INSERT ON cash_box_conversions
            FOR EACH ROW
            EXECUTE FUNCTION trg_after_insert_cash_box_conversion();
        ");
    }

    public function down(): void
    {
        DB::unprepared("
            DROP TRIGGER IF EXISTS trg_after_insert_cash_box_conversion ON cash_box_conversions;
            DROP FUNCTION IF EXISTS trg_after_insert_cash_box_conversion();
        ");
    }
};

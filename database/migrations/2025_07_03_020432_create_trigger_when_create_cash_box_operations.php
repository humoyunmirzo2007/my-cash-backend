<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("
            CREATE OR REPLACE FUNCTION update_cash_box_residue_when_create_cash_box_operation()
            RETURNS TRIGGER AS \$\$
            BEGIN
                UPDATE cash_boxes
                SET residue = residue + NEW.amount
                WHERE user_id = NEW.user_id AND currency = NEW.currency;

                RETURN NULL;
            END;
            \$\$ LANGUAGE plpgsql;
        ");

        DB::unprepared("
            CREATE TRIGGER trigger_update_residue_on_create
            AFTER INSERT ON cash_box_operations
            FOR EACH ROW
            EXECUTE FUNCTION update_cash_box_residue_when_create_cash_box_operation();
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("
            DROP TRIGGER IF EXISTS trigger_update_residue_on_create ON cash_box_operations;
            DROP FUNCTION IF EXISTS update_cash_box_residue_when_create_cash_box_operation;
        ");
    }
};

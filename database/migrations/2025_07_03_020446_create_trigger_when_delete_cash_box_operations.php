<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("
            CREATE OR REPLACE FUNCTION update_cash_box_residue_when_delete_cash_box_operation()
            RETURNS TRIGGER AS \$\$
            BEGIN
                UPDATE cash_boxes
                SET residue = residue - OLD.amount
                WHERE user_id = OLD.user_id AND currency = OLD.currency;

                RETURN NULL;
            END;
            \$\$ LANGUAGE plpgsql;
        ");

        DB::unprepared("
            CREATE TRIGGER trigger_update_residue_on_delete
            AFTER DELETE ON cash_box_operations
            FOR EACH ROW
            EXECUTE FUNCTION update_cash_box_residue_when_delete_cash_box_operation();
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("
            DROP TRIGGER IF EXISTS trigger_update_residue_on_delete ON cash_box_operations;
            DROP FUNCTION IF EXISTS update_cash_box_residue_when_delete_cash_box_operation;
        ");

        Schema::dropIfExists('trigger_when_delete_cash_box_operations');
    }
};

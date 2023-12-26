<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
        CREATE TRIGGER update_present_reading
        BEFORE INSERT ON electric_usage
        FOR EACH ROW
        BEGIN
            UPDATE meter
            SET present_reading = present_reading + NEW.usage
            WHERE id = NEW.meter_id;
        END
    ');

        DB::unprepared('
        CREATE EVENT update_previous_reading
        ON SCHEDULE EVERY 1 MONTH STARTS CURRENT_DATE + INTERVAL 1 MONTH
        DO
            UPDATE meter
            SET previous_reading = present_reading;
    ');

        DB::unprepared('
        CREATE EVENT update_monthly_bill
        ON SCHEDULE EVERY 1 MONTH STARTS CURRENT_DATE + INTERVAL 1 MONTH
        DO
            INSERT INTO monthly_bill (meter_id, `YEAR_MONTH`, bill_amount)
            SELECT id, DATE_FORMAT(CURRENT_DATE + INTERVAL 1 MONTH, "%Y-%m"), (present_reading - previous_reading) * rate
            FROM meter;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS update_present_reading');
        DB::unprepared('DROP EVENT IF EXISTS update_previous_reading');
    }
};

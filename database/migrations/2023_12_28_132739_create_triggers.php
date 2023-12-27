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
        // trigger to update present_reading in every insert
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
        // event to update previous_reading in every month
        DB::unprepared('
        CREATE EVENT update_previous_reading
        ON SCHEDULE EVERY 1 MONTH
        DO
            UPDATE meter
            SET previous_reading = present_reading;
        ');

        // event to update monthly_bill in every month
        DB::unprepared('
        CREATE EVENT update_monthly_bill
        ON SCHEDULE EVERY 1 MONTH
        DO
            INSERT INTO monthly_bill (meter_id, `YEAR_MONTH`, bill_amount)
            SELECT id, DATE_FORMAT(CURRENT_DATE + INTERVAL 1 MONTH, "%Y-%m"), (present_reading - previous_reading) * rate
            FROM meter;
        ');
        // event to update 1hour_usage in every hour
        DB::unprepared('
        CREATE EVENT update_1hour_usage
        ON SCHEDULE EVERY 1 HOUR
        DO
            INSERT INTO 1hour_usage (meter_id, `usage`, recorded_at, usagemark)
            SELECT
                m.id, (m.`present_reading` - m.`previous_reading`) -
                COALESCE(
                    (
                        SELECT
                            u.`usagemark`
                        FROM
                            `1hour_usage` u
                        WHERE
                            u.`meter_id` = m.`id`
                        ORDER BY
                            u.`recorded_at` DESC
                        LIMIT 1
                    ),
                    0
                )  AS `usage`,
                NOW() ,
                present_reading
            FROM
                `meter` m;
        ');

        // event to update 1day_usage 
        DB::unprepared('
        CREATE EVENT update_1day_usage
        ON SCHEDULE EVERY 1 DAY
        DO
            INSERT INTO 1day_usage (meter_id, `usage`, recorded_at, usagemark)
            SELECT
                m.id, (m.`present_reading` - m.`previous_reading`) -
                COALESCE(
                    (
                        SELECT
                            u.`usagemark`
                        FROM
                            `1day_usage` u
                        WHERE
                            u.`meter_id` = m.`id`
                        ORDER BY
                            u.`recorded_at` DESC
                        LIMIT 1
                    ),
                    0
                )  AS `usage`,
                NOW() ,
                present_reading
            FROM
                `meter` m;
        ');

        // event to update 1month_usage every month
        DB::unprepared('
        CREATE EVENT update_1month_usage
        ON SCHEDULE EVERY 1 MONTH
        DO
            INSERT INTO 1month_usage (meter_id, `usage`, recorded_at, usagemark)
            SELECT
                m.id, (m.`present_reading` - m.`previous_reading`) -
                COALESCE(
                    (
                        SELECT
                            u.`usagemark`
                        FROM
                            `1month_usage` u
                        WHERE
                            u.`meter_id` = m.`id`
                        ORDER BY
                            u.`recorded_at` DESC
                        LIMIT 1
                    ),
                    0
                )  AS `usage`,
                NOW() ,
                present_reading
            FROM
                `meter` m;
        ');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS update_present_reading');
        DB::unprepared('DROP EVENT IF EXISTS update_previous_reading');
        DB::unprepared('DROP EVENT IF EXISTS update_monthly_bill');
        DB::unprepared('DROP EVENT IF EXISTS update_1hour_usage');
        DB::unprepared('DROP EVENT IF EXISTS update_1day_usage');
        
    }
};

INSERT INTO 1hour_usage (meter_id, `usage`, recorded_at, usagemark)
SELECT
    m.id,
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
    ) + m.`present_reading` - m.`previous_reading`,
    NOW(),
    present_reading
FROM
    `meter` m;
SELECT DISTINCT CAST(oslog.created_at AS DATE) AS 'Date of status 1', IFNULL(tbl_status_one.cnt, 'N/A') AS 'Total of status 1', IFNULL(tbl_status_two.cnt, 'N/A') AS 'Total of status 2', IFNULL(tbl_status_three.cnt, 'N/A') AS 'Total of status 3'

FROM order_status_log_uniq oslog

         LEFT JOIN (SELECT COUNT(*) AS cnt, created_at
                    FROM order_status_log_uniq
                    WHERE status_id = 1
                    GROUP BY CAST(created_at AS DATE)) AS tbl_status_one
                   ON CAST(oslog.created_at AS DATE) = CAST(tbl_status_one.created_at AS DATE)


         LEFT JOIN (SELECT COUNT(*) AS cnt, created_at
                    FROM order_status_log_uniq
                    WHERE status_id = 2
                    GROUP BY CAST(created_at AS DATE)) AS tbl_status_two
                   ON CAST(oslog.created_at AS DATE) = CAST(tbl_status_two.created_at AS DATE)


         LEFT JOIN (SELECT COUNT(*) AS cnt, created_at
                    FROM order_status_log_uniq
                    WHERE status_id = 3
                    GROUP BY CAST(created_at AS DATE)) AS tbl_status_three
                   ON CAST(oslog.created_at AS DATE) = CAST(tbl_status_three.created_at AS DATE)

WHERE status_id = 1
ORDER BY id DESC
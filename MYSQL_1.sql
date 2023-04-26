SELECT o.id as ID,
       os.title as 'Current title status', IFNULL(
    (SELECT sys_order_status.title
     FROM order_status_log_uniq
              JOIN sys_order_status ON sys_order_status.id = order_status_log_uniq.status_id
     WHERE order_id = o.id
     ORDER BY order_status_log_uniq.id DESC
        LIMIT 1, 1), 'N/A'
    ) as 'Prelast title status', IFNULL(

    (SELECT sys_order_status.created_at
     FROM order_status_log_uniq
              JOIN sys_order_status ON sys_order_status.id = order_status_log_uniq.status_id
     WHERE order_id = o.id
     ORDER BY order_status_log_uniq.id DESC
        LIMIT 1, 1),
'N/A') as 'Prelast date status'
FROM `order` o
         JOIN sys_order_status os ON os.id = o.status_id
ORDER BY o.id
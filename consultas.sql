-- El porcentaje de ejecución de fondos para cada proyecto registrado. La ejecución se 
-- calcula como el monto total ejecutado (gastado) dentro del total de fondos recibidos por 
-- medio de donaciones.

SELECT 
    p.id_project,
    p.project_name,
    (SELECT SUM(amount) 
     FROM donations_allocations 
     WHERE projects_id_project = p.id_project) AS dinero_recibido,
    (SELECT SUM(total_amount) 
     FROM purchase_orders 
     WHERE projects_id_project = p.id_project) AS dinero_gastado,
    
    ROUND(
        ((SELECT SUM(total_amount) 
          FROM purchase_orders 
          WHERE projects_id_project = p.id_project) / 
         (SELECT SUM(amount) 
          FROM donations_allocations 
          WHERE projects_id_project = p.id_project)) * 100, 2
    ) AS porcentaje_gastado

FROM projects p


--  La disponibilidad de fondos en cada rubro del proyecto “X”, de modo que se muestren 
--  todos los rubros del proyecto (incluyendo los que pueden no tener ninguna donación 
--  recibida o ninguna orden de compra emitida)

SELECT 
    bi.name AS rubro,
    COALESCE(recibido.total, 0) AS recibido,
    COALESCE(gastado.total, 0) AS gastado,
    COALESCE(recibido.total, 0) - COALESCE(gastado.total, 0) AS disponible

FROM budget_items bi

LEFT JOIN (
    SELECT budget_items_id_budget_item, SUM(amount) AS total
    FROM donations_allocations 
    WHERE projects_id_project = 1 
    GROUP BY budget_items_id_budget_item
) recibido ON bi.id_budget_item = recibido.budget_items_id_budget_item

LEFT JOIN (
    SELECT pod.budget_items_id_budget_item, SUM(pod.amount) AS total
    FROM purchase_order_details pod
    JOIN purchase_orders po ON pod.purchase_orders_id_purchase_order = po.id_purchase_order
    WHERE po.projects_id_project = 1
    GROUP BY pod.budget_items_id_budget_item
) gastado ON bi.id_budget_item = gastado.budget_items_id_budget_item

ORDER BY bi.name;
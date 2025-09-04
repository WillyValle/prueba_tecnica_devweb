<?php

class PurchaseOrderDetails {
    private $pdo;
    private $id_purchase_order_details;
    private $budget_items_id;
    private $amount;
    private $purchase_orders_id;

    public function __CONSTRUCT() {
        $this->pdo = BasedeDatos::Conectar();
    }

    // Métodos GET y SET
    public function getIdPurchaseOrderDetails(): ?int {
        return $this->id_purchase_order_details;
    }
    public function setIdPurchaseOrderDetails(int $id): void {
        $this->id_purchase_order_details = $id;
    }
    public function getBudgetItemsId(): ?int {
        return $this->budget_items_id;
    }
    public function setBudgetItemsId(int $id): void {
        $this->budget_items_id = $id;
    }
    public function getAmount(): ?float {
        return $this->amount;
    }
    public function setAmount(float $amount): void {
        $this->amount = $amount;
    }
    public function getPurchaseOrdersId(): ?int {
        return $this->purchase_orders_id;
    }
    public function setPurchaseOrdersId(int $id): void {
        $this->purchase_orders_id = $id;
    }

    public function Listar(): array {
        try {
            $consulta = $this->pdo->prepare("
                SELECT 
                    pod.id_purchase_order_details,
                    pod.budget_items_id_budget_item as budget_items_id,
                    pod.amount,
                    pod.purchase_orders_id_purchase_order as purchase_orders_id,
                    bi.name as budget_item_name,
                    po.id_purchase_order,
                    p.project_name,
                    s.name as supplier_name,
                    po.order_date
                FROM Prueba_Tecnica_DB.purchase_order_details pod
                INNER JOIN Prueba_Tecnica_DB.budget_items bi ON pod.budget_items_id_budget_item = bi.id_budget_item
                INNER JOIN Prueba_Tecnica_DB.purchase_orders po ON pod.purchase_orders_id_purchase_order = po.id_purchase_order
                INNER JOIN Prueba_Tecnica_DB.projects p ON po.projects_id_project = p.id_project
                INNER JOIN Prueba_Tecnica_DB.suppliers s ON po.suppliers_id_suppliers = s.id_suppliers
                ORDER BY po.order_date DESC, pod.id_purchase_order_details
            ");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ListarPorOrden(int $purchase_order_id): array {
        try {
            $consulta = $this->pdo->prepare("
                SELECT 
                    pod.id_purchase_order_details,
                    pod.budget_items_id_budget_item as budget_items_id,
                    pod.amount,
                    pod.purchase_orders_id_purchase_order as purchase_orders_id,
                    bi.name as budget_item_name,
                    bi.description as budget_item_description
                FROM Prueba_Tecnica_DB.purchase_order_details pod
                INNER JOIN Prueba_Tecnica_DB.budget_items bi ON pod.budget_items_id_budget_item = bi.id_budget_item
                WHERE pod.purchase_orders_id_purchase_order = ?
                ORDER BY bi.name
            ");
            $consulta->execute([$purchase_order_id]);
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerInfoOrden(int $purchase_order_id): ?object {
        try {
            $consulta = $this->pdo->prepare("
                SELECT 
                    po.id_purchase_order,
                    po.total_amount,
                    po.order_date,
                    p.project_name,
                    s.name as supplier_name
                FROM Prueba_Tecnica_DB.purchase_orders po
                INNER JOIN Prueba_Tecnica_DB.projects p ON po.projects_id_project = p.id_project
                INNER JOIN Prueba_Tecnica_DB.suppliers s ON po.suppliers_id_suppliers = s.id_suppliers
                WHERE po.id_purchase_order = ?
            ");
            $consulta->execute([$purchase_order_id]);
            return $consulta->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ListarBudgetItems(): array {
        try {
            $consulta = $this->pdo->prepare("SELECT id_budget_item as id, name, description FROM Prueba_Tecnica_DB.budget_items ORDER BY name");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ListarPurchaseOrders(): array {
        try {
            $consulta = $this->pdo->prepare("
                SELECT 
                    po.id_purchase_order as id,
                    CONCAT('Orden #', po.id_purchase_order, ' - ', p.project_name, ' (', s.name, ')') as name
                FROM Prueba_Tecnica_DB.purchase_orders po
                INNER JOIN Prueba_Tecnica_DB.projects p ON po.projects_id_project = p.id_project
                INNER JOIN Prueba_Tecnica_DB.suppliers s ON po.suppliers_id_suppliers = s.id_suppliers
                ORDER BY po.order_date DESC
            ");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerPorId(int $id): ?object {
        try {
            $consulta = $this->pdo->prepare("
                SELECT 
                    id_purchase_order_details,
                    budget_items_id_budget_item as budget_items_id,
                    amount,
                    purchase_orders_id_purchase_order as purchase_orders_id
                FROM Prueba_Tecnica_DB.purchase_order_details 
                WHERE id_purchase_order_details = ?
            ");
            $consulta->execute([$id]);
            return $consulta->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Insertar(PurchaseOrderDetails $data): void {
        try {
            $consulta = "INSERT INTO Prueba_Tecnica_DB.purchase_order_details (budget_items_id_budget_item, amount, purchase_orders_id_purchase_order) VALUES (?, ?, ?)";
            $this->pdo->prepare($consulta)->execute([
                $data->getBudgetItemsId(),
                $data->getAmount(),
                $data->getPurchaseOrdersId()
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar(PurchaseOrderDetails $data): void {
        try {
            $consulta = "UPDATE Prueba_Tecnica_DB.purchase_order_details SET budget_items_id_budget_item = ?, amount = ?, purchase_orders_id_purchase_order = ? WHERE id_purchase_order_details = ?";
            $this->pdo->prepare($consulta)->execute([
                $data->getBudgetItemsId(),
                $data->getAmount(),
                $data->getPurchaseOrdersId(),
                $data->getIdPurchaseOrderDetails()
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Eliminar(int $id): void {
        try {
            $consulta = "DELETE FROM Prueba_Tecnica_DB.purchase_order_details WHERE id_purchase_order_details = ?";
            $this->pdo->prepare($consulta)->execute([$id]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
<?php

class PurchaseOrders {
    private $pdo;
    private $id_purchase_order;
    private $total_amount;
    private $order_date;
    private $projects_id;
    private $suppliers_id;

    public function __CONSTRUCT() {
        $this->pdo = BasedeDatos::Conectar();
    }

    // Métodos GET y SET
    public function getIdPurchaseOrder(): ?int {
        return $this->id_purchase_order;
    }
    public function setIdPurchaseOrder(int $id): void {
        $this->id_purchase_order = $id;
    }
    public function getTotalAmount(): ?float {
        return $this->total_amount;
    }
    public function setTotalAmount(float $amount): void {
        $this->total_amount = $amount;
    }
    public function getOrderDate(): ?string {
        return $this->order_date;
    }
    public function setOrderDate(string $date): void {
        $this->order_date = $date;
    }
    public function getProjectsId(): ?int {
        return $this->projects_id;
    }
    public function setProjectsId(int $id): void {
        $this->projects_id = $id;
    }
    public function getSuppliersId(): ?int {
        return $this->suppliers_id;
    }
    public function setSuppliersId(int $id): void {
        $this->suppliers_id = $id;
    }

    public function Listar(): array {
        try {
            $consulta = $this->pdo->prepare("
                SELECT 
                    po.id_purchase_order,
                    po.total_amount,
                    po.order_date,
                    po.projects_id_project as projects_id,
                    po.suppliers_id_suppliers as suppliers_id,
                    p.project_name,
                    s.name as supplier_name
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

    public function ListarProjects(): array {
        try {
            $consulta = $this->pdo->prepare("SELECT id_project as id, project_name as name FROM Prueba_Tecnica_DB.projects ORDER BY project_name");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ListarSuppliers(): array {
        try {
            $consulta = $this->pdo->prepare("SELECT id_suppliers as id, name FROM Prueba_Tecnica_DB.suppliers ORDER BY name");
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
                    id_purchase_order,
                    total_amount,
                    order_date,
                    projects_id_project as projects_id,
                    suppliers_id_suppliers as suppliers_id
                FROM Prueba_Tecnica_DB.purchase_orders 
                WHERE id_purchase_order = ?
            ");
            $consulta->execute([$id]);
            return $consulta->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Insertar(PurchaseOrders $data): void {
        try {
            $consulta = "INSERT INTO Prueba_Tecnica_DB.purchase_orders (total_amount, order_date, projects_id_project, suppliers_id_suppliers) VALUES (?, ?, ?, ?)";
            $this->pdo->prepare($consulta)->execute([
                $data->getTotalAmount(),
                $data->getOrderDate(),
                $data->getProjectsId(),
                $data->getSuppliersId()
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar(PurchaseOrders $data): void {
        try {
            $consulta = "UPDATE Prueba_Tecnica_DB.purchase_orders SET total_amount = ?, order_date = ?, projects_id_project = ?, suppliers_id_suppliers = ? WHERE id_purchase_order = ?";
            $this->pdo->prepare($consulta)->execute([
                $data->getTotalAmount(),
                $data->getOrderDate(),
                $data->getProjectsId(),
                $data->getSuppliersId(),
                $data->getIdPurchaseOrder()
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Borrar(int $id): void {
        try {
            $consulta = $this->pdo->prepare("DELETE FROM Prueba_Tecnica_DB.purchase_orders WHERE id_purchase_order = ?");
            $consulta->execute([$id]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
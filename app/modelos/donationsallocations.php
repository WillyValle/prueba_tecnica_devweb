<?php

class DonationsAllocations {
    private $pdo;
    private $id_allocation;
    private $donors_id;
    private $projects_id;
    private $budget_items;
    private $amount;
    private $date;

    public function __CONSTRUCT() {
        $this->pdo = BasedeDatos::Conectar();
    }

    // Métodos GET y SET
    public function getIdAllocation(): ?int {
        return $this->id_allocation;
    }
    public function setIdAllocation(int $id): void {
        $this->id_allocation = $id;
    }
    public function getDonorsId(): ?int {
        return $this->donors_id;
    }
    public function setDonorsId(int $id): void {
        $this->donors_id = $id;
    }
    public function getProjectsId(): ?int {
        return $this->projects_id;
    }
    public function setProjectsId(int $id): void {
        $this->projects_id = $id;
    }
    public function getBudgetItems(): ?int {
        return $this->budget_items;
    }
    public function setBudgetItems(int $items): void {
        $this->budget_items = $items;
    }
    public function getAmount(): ?float {
        return $this->amount;
    }
    public function setAmount(float $amount): void {
        $this->amount = $amount;
    }
    public function getDate(): ?string {
        return $this->date;
    }
    public function setDate(string $date): void {
        $this->date = $date;
    }

    public function Listar(): array {
        try {
            $consulta = $this->pdo->prepare("
                SELECT 
                    da.id_allocations as id_allocation,
                    da.donors_id_donor as donors_id,
                    da.projects_id_project as projects_id,
                    da.budget_items_id_budget_item as budget_items,
                    da.amount,
                    da.date,
                    d.name as donor_name,
                    p.project_name,
                    bi.name as budget_item_name
                FROM donations_allocations da
                INNER JOIN donors d ON da.donors_id_donor = d.id_donor
                INNER JOIN projects p ON da.projects_id_project = p.id_project
                INNER JOIN budget_items bi ON da.budget_items_id_budget_item = bi.id_budget_item
            ");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ListarDonors(): array {
        try {
            $consulta = $this->pdo->prepare("SELECT id_donor as id, name FROM donors ORDER BY name");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ListarProjects(): array {
        try {
            $consulta = $this->pdo->prepare("SELECT id_project as id, project_name as name FROM projects ORDER BY project_name");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ListarBudgetItems(): array {
        try {
            $consulta = $this->pdo->prepare("SELECT id_budget_item as id, name FROM budget_items ORDER BY name");
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
                    id_allocations as id_allocation,
                    donors_id_donor as donors_id,
                    projects_id_project as projects_id,
                    budget_items_id_budget_item as budget_items,
                    amount,
                    date
                FROM donations_allocations 
                WHERE id_allocations = ?
            ");
            $consulta->execute([$id]);
            return $consulta->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Insertar(DonationsAllocations $data): void {
        try {
            $consulta = "INSERT INTO donations_allocations (donors_id_donor, projects_id_project, budget_items_id_budget_item, amount, date) VALUES (?, ?, ?, ?, ?)";
            $this->pdo->prepare($consulta)->execute([
                $data->getDonorsId(),
                $data->getProjectsId(),
                $data->getBudgetItems(),
                $data->getAmount(),
                $data->getDate()
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar(DonationsAllocations $data): void {
        try {
            $consulta = "UPDATE donations_allocations SET donors_id_donor = ?, projects_id_project = ?, budget_items_id_budget_item = ?, amount = ?, date = ? WHERE id_allocations = ?";
            $this->pdo->prepare($consulta)->execute([
                $data->getDonorsId(),
                $data->getProjectsId(),
                $data->getBudgetItems(),
                $data->getAmount(),
                $data->getDate(),
                $data->getIdAllocation()
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Borrar(int $id): void {
        try {
            $consulta = $this->pdo->prepare("DELETE FROM donations_allocations WHERE id_allocations = ?");
            $consulta->execute([$id]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
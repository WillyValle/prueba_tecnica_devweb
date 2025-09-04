<?php

class BudgetItems {
    private $pdo;

    private $id_budget_item;
    private $name;
    private $description;
    private $status;

    public function __CONSTRUCT() {
        $this->pdo = BasedeDatos::Conectar();
    }

    // Métodos GET y SET
    public function getIdBudgetItem(): ?int {
        return $this->id_budget_item;
    }

    public function setIdBudgetItem(int $id): void {
        $this->id_budget_item = $id;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function Listar() {
        try {
            $consulta = $this->pdo->prepare("SELECT * FROM budget_items");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Insertar (BudgetItems $categoria){
        try {
            $consulta = $this->pdo->prepare("INSERT INTO budget_items (name, description) VALUES (?, ?)");
            $consulta->execute(array(
                $categoria->getName(),
                $categoria->getDescription()
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerPorId($id): ?object{
        try {
            $consulta = $this->pdo->prepare("
            SELECT
                id_budget_item,
                name,
                description
            FROM budget_items WHERE id_budget_item = ?
            ");
            $consulta->execute(array($id));
            return $consulta->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar(BudgetItems $categoria) {
        try {
            $consulta = $this->pdo->prepare("UPDATE budget_items SET name = ?, description = ? WHERE id_budget_item = ?");
            $consulta->execute(array(
                $categoria->getName(),
                $categoria->getDescription(),
                $categoria->getIdBudgetItem()
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Borrar($id) {
        try {
            $consulta = $this->pdo->prepare("DELETE FROM budget_items WHERE id_budget_item = ?");
            $consulta->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
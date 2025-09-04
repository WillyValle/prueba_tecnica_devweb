<?php

class Suppliers{
    private $pdo;

    private $id_suppliers;
    private $name;
    private $description;
    private $status;

    public function __CONSTRUCT() {
        $this->pdo = BasedeDatos::Conectar();
    }

    // Métodos GET y SET
    public function getIdSuppliers(): ?int {
        return $this->id_suppliers;
    }

    public function setIdSuppliers(int $id): void {
        $this->id_suppliers = $id;
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
            $consulta = $this->pdo->prepare("SELECT * FROM suppliers");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Insertar (Suppliers $categoria){
        try {
            $consulta = $this->pdo->prepare("INSERT INTO suppliers (name, description) VALUES (?, ?)");
            $consulta->execute(array(
                $categoria->getName(),
                $categoria->getDescription()
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerPorId($id): ?object{
        try{
            $consulta = $this->pdo->prepare("
            SELECT
                id_suppliers,
                name,
                description
            FROM suppliers WHERE id_suppliers = ?
            ");
            $consulta->execute(array($id));
            return $consulta->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar(Suppliers $categoria) {
        try {
            $consulta = $this->pdo->prepare("UPDATE suppliers SET name = ?, description = ? WHERE id_suppliers = ?");
            $consulta->execute(array(
                $categoria->getName(),
                $categoria->getDescription(),
                $categoria->getIdSuppliers()
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Borrar(int $id): void {
        try {
            $consulta = $this->pdo->prepare("DELETE FROM suppliers WHERE id_suppliers = ?");
            $consulta->execute([$id]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
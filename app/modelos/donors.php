<?php

class Donors {
    private $pdo;

    private $id_donor;
    private $name;
    private $description;
    private $status;

    public function __CONSTRUCT() {
        $this->pdo = BasedeDatos::Conectar();
    }

    // Métodos GET y SET
    public function getIdDonor(): ?int {
        return $this->id_donor;
    }

    public function setIdDonor(int $id): void {
        $this->id_donor = $id;
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
            $consulta = $this->pdo->prepare("SELECT * FROM donors");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Insertar (Donors $categoria){
        try {
            $consulta = $this->pdo->prepare("INSERT INTO donors (name, description) VALUES (?, ?)");
            $consulta->execute(array(
                $categoria->getName(),
                $categoria->getDescription()
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerPorId($id) {
        try {
            $consulta = $this->pdo->prepare("
            SELECT
                id_donor,
                name,
                description
            FROM donors WHERE id_donor = ?
            ");
            $consulta->execute(array($id));
            return $consulta->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar(Donors $categoria) {
        try {
            $consulta = $this->pdo->prepare("UPDATE donors SET name = ?, description = ? WHERE id_donor = ?");
            $consulta->execute(array(
                $categoria->getName(),
                $categoria->getDescription(),
                $categoria->getIdDonor()
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Borrar(int $id): void {
        try {
            $consulta = $this->pdo->prepare("DELETE FROM donors WHERE id_donor = ?");
            $consulta->execute([$id]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
<?php

class Projects {
    private $pdo;

    private $id_project;
    private $project_name;
    private $municipality;
    private $department;
    private $start_date;
    private $end_date;

    public function __CONSTRUCT() {
        $this->pdo = BasedeDatos::Conectar();
    }

    // Métodos GET y SET
    public function getIdProject(): ?int {
        return $this->id_project;
    }

    public function setIdProject(int $id): void {
        $this->id_project = $id;
    }

    public function getProjectName(): ?string {
        return $this->project_name;
    }

    public function setProjectName(string $name): void {
        $this->project_name = $name;
    }

    public function getMunicipality(): ?string {
        return $this->municipality;
    }

    public function setMunicipality(string $municipality): void {
        $this->municipality = $municipality;
    }

    public function getDepartment(): ?string {
        return $this->department;
    }

    public function setDepartment(string $department): void {
        $this->department = $department;
    }

    public function getStartDate(): ?string {
        return $this->start_date;
    }

    public function setStartDate(string $start_date): void {
        $this->start_date = $start_date;
    }

    public function getEndDate(): ?string {
        return $this->end_date;
    }

    public function setEndDate(string $end_date): void {
        $this->end_date = $end_date;
    }

    public function Listar() {
        try {
            $consulta = $this->pdo->prepare("SELECT * FROM projects");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerPorId($id): ?object{
        try{
            $consulta = $this->pdo->prepare("
            SELECT
                id_project,
                project_name,
                municipality,
                department,
                start_date,
                end_date
            FROM projects WHERE id_project = ?
            ");
            $consulta->execute(array($id));
            return $consulta->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Insertar (Projects $categoria){
        try {
            $consulta = $this->pdo->prepare("INSERT INTO projects (project_name, municipality, department, start_date, end_date) VALUES (?, ?, ?, ?, ?)");
            $consulta->execute(array(
                $categoria->getProjectName(),
                $categoria->getMunicipality(),
                $categoria->getDepartment(),
                $categoria->getStartDate(),
                $categoria->getEndDate()
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar(Projects $categoria) {
        try {
            $consulta = $this->pdo->prepare("UPDATE projects SET project_name = ?, municipality = ?, department = ?, start_date = ?, end_date = ? WHERE id_project = ?");
            $consulta->execute(array(
                $categoria->getProjectName(),
                $categoria->getMunicipality(),
                $categoria->getDepartment(),
                $categoria->getStartDate(),
                $categoria->getEndDate(),
                $categoria->getIdProject()
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Borrar(int $id): void {
        try {
            $consulta = $this->pdo->prepare("DELETE FROM projects WHERE id_project = ?");
            $consulta->execute([$id]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
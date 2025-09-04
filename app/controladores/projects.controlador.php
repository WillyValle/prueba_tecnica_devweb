<?php
require_once "app/modelos/projects.php";

class ProjectsControlador{
    private $modelo;

    public function __CONSTRUCT(){
        $this->modelo = new Projects();
    }

    public function Inicio(){
        require_once "app/vistas/header.php";
        require_once "app/vistas/projects/listprojects.php";
        require_once "app/vistas/footer.php";
    }

    public function FormCrear(){
        require_once "app/vistas/header.php";
        require_once "app/vistas/projects/form.php";
        require_once "app/vistas/footer.php";
    }

    public function FormEditar(){
        $datos = $this->modelo->ObtenerPorId($_GET['id']);
        require_once "app/vistas/header.php";
        require_once "app/vistas/projects/form.php";
        require_once "app/vistas/footer.php";
    }

    public function Guardar(){
        $p = new Projects();
        
        // Si hay ID, es una actualización
        if(isset($_POST['id_project']) && !empty($_POST['id_project'])){
            $p->setIdProject($_POST['id_project']);
        }
        
        $p->setProjectName($_POST['project_name']);
        $p->setMunicipality($_POST['municipality']);
        $p->setDepartment($_POST['department']);
        $p->setStartDate($_POST['start_date']);
        $p->setEndDate($_POST['end_date']);

        $p->getIdProject() > 0 ?
        $this->modelo->Actualizar($p) :
        $this->modelo->Insertar($p);
        
        header("location: ?c=projects");
    }

    public function Eliminar(){
        $this->modelo->Borrar($_GET['id']);
        header("location: ?c=projects");
    }

}
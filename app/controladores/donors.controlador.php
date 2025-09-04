<?php
require_once "app/modelos/donors.php";

class DonorsControlador{
    private $modelo;

    public function __CONSTRUCT(){
        $this->modelo = new Donors();
    }

    public function Inicio(){
        require_once "app/vistas/header.php";
        require_once "app/vistas/donors/listdonors.php";
        require_once "app/vistas/footer.php";
    }

    public function FormCrear(){
        require_once "app/vistas/header.php";
        require_once "app/vistas/donors/form.php";
        require_once "app/vistas/footer.php";
    }

    public function FormEditar(){
        $datos = $this->modelo->ObtenerPorId($_GET['id']);
        require_once "app/vistas/header.php";
        require_once "app/vistas/donors/form.php";
        require_once "app/vistas/footer.php";
    }

    public function Guardar(){
        $donors = new Donors();

        // Si hay ID, es una actualización
        if(isset($_POST['id_donor']) && !empty($_POST['id_donor'])){
            $donors->setIdDonor($_POST['id_donor']);
    }

        $donors->setName($_POST['name']);
        $donors->setDescription($_POST['description']);

        $donors->getIdDonor() > 0 ?
        $this->modelo->Actualizar($donors) :
        $this->modelo->Insertar($donors);

        header("location: ?c=donors");
    }   

    public function Eliminar(){
        $this->modelo->Borrar($_GET['id']);
        header("location: ?c=donors");
    }
}
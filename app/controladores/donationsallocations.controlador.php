<?php
require_once "app/modelos/donationsallocations.php";

class DonationsAllocationsControlador{
    private $modelo;

    public function __CONSTRUCT(){
        $this->modelo = new DonationsAllocations();
    }

    public function Inicio(){
        require_once "app/vistas/header.php";
        require_once "app/vistas/donationsallocations/listdonationsallocations.php";
        require_once "app/vistas/footer.php";
    }

    public function FormCrear(){
        require_once "app/vistas/header.php";
        require_once "app/vistas/donationsallocations/form.php";
        require_once "app/vistas/footer.php";
    }

    public function FormEditar(){
        $datos = $this->modelo->ObtenerPorId($_GET['id']);
        require_once "app/vistas/header.php";
        require_once "app/vistas/donationsallocations/form.php";
        require_once "app/vistas/footer.php";
    }

    public function Guardar(){
        $d = new DonationsAllocations();
        
        // Si hay ID, es una actualización
        if(isset($_POST['id_allocation']) && !empty($_POST['id_allocation'])){
            $d->setIdAllocation($_POST['id_allocation']);
        }
        
        $d->setDonorsId($_POST['donors_id']);
        $d->setProjectsId($_POST['projects_id']);
        $d->setBudgetItems($_POST['budget_items']);
        $d->setAmount($_POST['amount']);
        $d->setDate($_POST['date']);

        $d->getIdAllocation() > 0 ?
        $this->modelo->Actualizar($d) :
        $this->modelo->Insertar($d);
        
        header("location: ?c=donationsallocations");
    }

    public function Eliminar(){
        $this->modelo->Borrar($_GET['id']);
        header("location: ?c=donationsallocations");
    }
}
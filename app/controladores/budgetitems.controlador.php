<?php
require_once "app/modelos/budgetitems.php";

class BudgetItemsControlador{
    private $modelo;

    public function __CONSTRUCT(){
        $this->modelo = new BudgetItems();
    }

    public function Inicio(){
        require_once "app/vistas/header.php";
        require_once "app/vistas/budgetitems/listbudgetitems.php";
        require_once "app/vistas/footer.php";
    }

    public function FormCrear(){
        require_once "app/vistas/header.php";
        require_once "app/vistas/budgetitems/form.php";
        require_once "app/vistas/footer.php";
    }

    public function FormEditar(){
        $datos = $this->modelo->ObtenerPorId($_GET['id']);
        require_once "app/vistas/header.php";
        require_once "app/vistas/budgetitems/form.php";
        require_once "app/vistas/footer.php";
    }

    public function Guardar(){
        $budgetItem = new BudgetItems();
        // Si hay ID, es una actualización
        if(isset($_POST['id_budget_item']) && !empty($_POST['id_budget_item'])){
            $budgetItem->setIdBudgetItem($_POST['id_budget_item']);
        }
        $budgetItem->setName($_POST['name']);
        $budgetItem->setDescription($_POST['description']);
        $budgetItem->getIdBudgetItem() > 0 ?
        $this->modelo->Actualizar($budgetItem) :
        $this->modelo->Insertar($budgetItem);
        header("location: ?c=budgetitems");
    }

    public function Eliminar(){
        $this->modelo->Borrar($_GET['id']);
        header("location: ?c=budgetitems");
    }

}
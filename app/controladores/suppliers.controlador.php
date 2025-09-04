<?php
require_once "app/modelos/suppliers.php";

class SuppliersControlador{
    private $modelo;

    public function __CONSTRUCT(){
        $this->modelo = new Suppliers();
    }

    public function Inicio(){
        require_once "app/vistas/header.php";
        require_once "app/vistas/suppliers/listsuppliers.php";
        require_once "app/vistas/footer.php";
    }

    public function FormCrear(){
        require_once "app/vistas/header.php";
        require_once "app/vistas/suppliers/form.php";
        require_once "app/vistas/footer.php";
    }

    public function FormEditar(){
        $datos = $this->modelo->ObtenerPorId($_GET['id']);
        require_once "app/vistas/header.php";
        require_once "app/vistas/suppliers/form.php";
        require_once "app/vistas/footer.php";
    }

    public function Guardar() {
        $supplier = new Suppliers();
        
        // Si hay ID, es una actualización
        if(isset($_POST['id_suppliers']) && !empty($_POST['id_suppliers'])){
            $supplier->setIdSuppliers($_POST['id_suppliers']);
        }
        
        $supplier->setName($_POST['name']);
        $supplier->setDescription($_POST['description']);

        $supplier->getIdSuppliers() > 0 ?
        $this->modelo->Actualizar($supplier) :
        $this->modelo->Insertar($supplier);
        
        header("location: ?c=suppliers");
    }

    public function Eliminar(){
        $this->modelo->Borrar($_GET['id']);
        header("location: ?c=suppliers");
    }

}
<?php
require_once "app/modelos/purchaseorders.php";

class PurchaseOrdersControlador{
    private $modelo;

    public function __CONSTRUCT(){
        $this->modelo = new PurchaseOrders();
    }

    public function Inicio(){
        require_once "app/vistas/header.php";
        require_once "app/vistas/purchaseorders/listpurchaseorders.php";
        require_once "app/vistas/footer.php";
    }

    public function FormCrear(){
        require_once "app/vistas/header.php";
        require_once "app/vistas/purchaseorders/form.php";
        require_once "app/vistas/footer.php";
    }

    public function FormEditar(){
        $datos = $this->modelo->ObtenerPorId($_GET['id']);
        require_once "app/vistas/header.php";
        require_once "app/vistas/purchaseorders/form.php";
        require_once "app/vistas/footer.php";
    }

    public function Guardar(){
        $po = new PurchaseOrders();
        
        // Si hay ID, es una actualización
        if(isset($_POST['id_purchase_order']) && !empty($_POST['id_purchase_order'])){
            $po->setIdPurchaseOrder($_POST['id_purchase_order']);
        }
        
        // NO manejamos total_amount porque se calcula automáticamente
        $po->setOrderDate($_POST['order_date']);
        $po->setProjectsId($_POST['projects_id']);
        $po->setSuppliersId($_POST['suppliers_id']);

        $po->getIdPurchaseOrder() > 0 ?
        $this->modelo->Actualizar($po) :
        $this->modelo->Insertar($po);
        
        header("location: ?c=purchaseorders");
    }

    public function Eliminar(){
        $this->modelo->Borrar($_GET['id']);
        header("location: ?c=purchaseorders");
    }
}
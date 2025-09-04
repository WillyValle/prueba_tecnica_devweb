<?php
require_once "app/modelos/purchaseorderdetails.php";

class PurchaseOrderDetailsControlador{
    private $modelo;

    public function __CONSTRUCT(){
        $this->modelo = new PurchaseOrderDetails();
    }

    public function Inicio(){
        require_once "app/vistas/header.php";
        require_once "app/vistas/purchaseorderdetails/listpurchaseorderdetails.php";
        require_once "app/vistas/footer.php";
    }

    public function VerDetallesPorOrden(){
        $purchase_order_id = $_GET['order_id'];
        $infoOrden = $this->modelo->ObtenerInfoOrden($purchase_order_id);
        $detalles = $this->modelo->ListarPorOrden($purchase_order_id);
        require_once "app/vistas/header.php";
        require_once "app/vistas/purchaseorderdetails/detailsbyorder.php";
        require_once "app/vistas/footer.php";
    }

    public function FormCrear(){
        // Si viene desde una orden específica, pre-seleccionarla
        $purchase_order_id = isset($_GET['order_id']) ? $_GET['order_id'] : null;
        require_once "app/vistas/header.php";
        require_once "app/vistas/purchaseorderdetails/form.php";
        require_once "app/vistas/footer.php";
    }

    public function FormEditar(){
        $datos = $this->modelo->ObtenerPorId($_GET['id']);
        require_once "app/vistas/header.php";
        require_once "app/vistas/purchaseorderdetails/form.php";
        require_once "app/vistas/footer.php";
    }

    public function Guardar(){
        $pod = new PurchaseOrderDetails();
        
        // Si hay ID, es una actualización
        if(isset($_POST['id_purchase_order_details']) && !empty($_POST['id_purchase_order_details'])){
            $pod->setIdPurchaseOrderDetails($_POST['id_purchase_order_details']);
        }
        
        $pod->setBudgetItemsId($_POST['budget_items_id']);
        $pod->setAmount($_POST['amount']);
        $pod->setPurchaseOrdersId($_POST['purchase_orders_id']);

        if($pod->getIdPurchaseOrderDetails() > 0){
            $this->modelo->Actualizar($pod);
        } else {
            $this->modelo->Insertar($pod);
        }
        
        // Redirigir a los detalles de la orden específica
        header("location: ?c=purchaseorderdetails&a=VerDetallesPorOrden&order_id=".$_POST['purchase_orders_id']);
    }

    public function Eliminar(){
        $id = $_GET['id'];
        $order_id = $_GET['order_id'];
        $this->modelo->Eliminar($id);
        header("location: ?c=purchaseorderdetails&a=VerDetallesPorOrden&order_id=".$order_id);
    }
}
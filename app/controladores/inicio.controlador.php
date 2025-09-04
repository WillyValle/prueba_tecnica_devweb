<?php

require_once "app/modelos/donors.php";
require_once "app/modelos/budgetitems.php";
require_once "app/modelos/projects.php";
require_once "app/modelos/suppliers.php";

class InicioControlador{
    private $modelo;

    public function __CONSTRUCT(){
        $this->modelo = new Donors();
    }

    public function Inicio(){
        $bd = BasedeDatos::Conectar();
        require_once "app/vistas/header.php";
        require_once "app/vistas/inicio/principal.php";
        require_once "app/vistas/footer.php";
    }
}
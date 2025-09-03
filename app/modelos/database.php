<?php

class BasedeDatos{

    public static function Conectar(){
        $host = ('localhost');
        $dbname = ('prueba_tecnica_db');
        $user = ('root');
        $pass = ('');

        try{
            $conexion = new PDO
            ("mysql:host=$host;dbname=$dbname;charset=utf8mb4",
                $user,
                $pass
            );
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
        }catch(PDOException $e){
            echo "❌ Error de conexión: " . $e->getMessage();
            return null; // <- importante
            //return "Error de conexion".$e->getMessage();
        }
    }
}
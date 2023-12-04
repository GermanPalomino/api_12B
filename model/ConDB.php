<?php
//Tarea
require_once("config.php");
class Connection{
    static public function connecction(){
        $con = false;
        try {
            $data = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8";
            $con = new PDO($data,DB_USERNAME,DB_PASSWORD);
            return $con;
        } catch (PDOException $e) {
            $mensaje = array(
                "CODE" => "000",
                "MENSAJE" => ("Error en DB".$e)
            );
        }
        return $con;
    }
}

?>
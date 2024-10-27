<?php
class Conexion
{
    public function conectar()
    {
        $host = "fdb1029.awardspace.net";
        $db = "4498731_visual";
        $usuario = "4498731_visual";
        $psw = "Galaxilife1";
        try {
            $conn = new PDO("mysql:host=" . $host . ";dbname=" . $db, $usuario, $psw);
            //print_r("Estás conectado");
            return $conn;
        } catch (Exception $e) {
            die("Error en la conexión: " . $e->getMessage());
        }
        
    }
}

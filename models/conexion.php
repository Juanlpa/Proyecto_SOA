<?php
class Conexion
{
    public function conectar()
    {
        $host = "localhost";
        $db = "quinto";
        $usuario = "root";
        $psw = "";
        try {
            $conn = new PDO("mysql:host=" . $host . ";dbname=" . $db, $usuario, $psw);
            //print_r("Estás conectado");
            return $conn;
        } catch (Exception $e) {
            die("Error en la conexión: " . $e->getMessage());
        }
        
    }
}

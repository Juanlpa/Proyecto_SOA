
<?php
header("Access-Control-Allow-Origin: *"); // Permite todos los orígenes
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

class Conexion
{
    public function conectar()
    {
        $host = "bi9exlm8cjbss7jof3ic-mysql.services.clever-cloud.com";
        $db = "bi9exlm8cjbss7jof3ic";
        $usuario = "uvjp7wemhc657dsb";
        $psw = "DmehEp1uH1ZayFx77YEJ";
        try {
            $conn = new PDO("mysql:host=" . $host . ";dbname=" . $db, $usuario, $psw);
            //print_r("Estás conectado");
            return $conn;
        } catch (Exception $e) {
            die("Error en la conexión: " . $e->getMessage());
        }
        
    }
}

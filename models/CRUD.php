<?php
include_once('conexion.php');
class CRUD
{
    private $conexion;
    public function __construct(){
        $this->conexion = new CONEXION();
    }

    public function obtenerEstudiantes(){
        $this->conexion->conectar();

        $sql = "SELECT * FROM estudiante";
        $resul = $this->conexion->conectar()->prepare($sql);
        $resul->execute();
        $data = $resul->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }
    public function obtenerEstudiante($cedula){
        $this->conexion->Conectar();

        // Para guardar todos los resultados posibles 
        // que coincidan con la busqueda
        $objetos = array();

        $sql = "SELECT * FROM estudiante WHERE cedula = '$cedula'";
        $resul = $this->conexion->conectar()->prepare($sql);
        $resul->execute();

        while ($row = $resul->fetch(PDO::FETCH_ASSOC)) {
            $objeto = array(
                "cedula" => $row["cedula"],
                "nombre" => $row["nombre"],
                "apellido" => $row["apellido"],
                "direccion" => $row["direccion"],
                "telefono" => $row["telefono"]
            );
            array_push($objetos, $objeto);
        }
        echo json_encode($objetos);
    }

    public function obtenerEstudianteCondiciones($parametro1,$parametro2){
        $this->conexion->Conectar();

        // Para guardar todos los resultados posibles
        // que coincidan con la busqueda
        $objetos = array();

        $sql = "SELECT * FROM estudiante WHERE cedula LIKE '%$parametro1%' AND nombre LIKE '%$parametro2%'";
        //$sql = "SELECT * FROM estudiante WHERE cedula = (SELECT cedula FROM tabla2 WHERE campo = '$parametro2')";
        $resul = $this->conexion->conectar()->prepare($sql);
        $resul->execute();

        while ($row = $resul->fetch(PDO::FETCH_ASSOC)) {
            $objeto = array(
                "cedula" => $row["cedula"],
                "nombre" => $row["nombre"],
                "apellido" => $row["apellido"],
                "direccion" => $row["direccion"],
                "telefono" => $row["telefono"]
            );
            array_push($objetos, $objeto);
        }
        echo json_encode($objetos);
    }

    public function guardarEstudiante(){
        $this->conexion->conectar();
        $this->conexion->conectar()->beginTransaction();

        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];

        $sql = "INSERT INTO estudiante VALUES('$cedula', '$nombre', '$apellido', '$direccion', '$telefono')";
        $resul = $this->conexion->conectar()->prepare($sql);
        $resul->execute();

        $this->conexion->conectar()->commit();
        echo json_encode($resul);
    }

    public function actualizarEstudiante($cedula, $nombre, $apellido, $direccion, $telefono){
        $this->conexion->conectar();
        $this->conexion->conectar()->beginTransaction();
        
        $sql = "UPDATE estudiante SET nombre='$nombre', apellido='$apellido', direccion='$direccion', telefono='$telefono' WHERE cedula='$cedula'";
        $resul = $this->conexion->conectar()->prepare($sql);
        $resul->execute();
        
        $this->conexion->conectar()->commit();
        echo json_encode($resul);
    }
    
    public function eliminarEstudiante($cedula){
        $this->conexion->conectar();
        $this->conexion->conectar()->beginTransaction();

        $sql = "DELETE FROM estudiante WHERE cedula='$cedula'";
        $resul = $this->conexion->conectar()->prepare($sql);
        $resul->execute();

        $this->conexion->conectar()->commit();
        echo json_encode($resul);
    }
}
?>

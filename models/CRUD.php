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

    public function guardarEstudiante() {
        try {
            $this->conexion->conectar();
            $conn = $this->conexion->conectar();
            $conn->beginTransaction();
    
            // Obtener los valores del POST
            $cedula = $_POST['cedula'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
    
            // Preparar la consulta SQL con parámetros
            $sql = "INSERT INTO estudiante (cedula, nombre, apellido, direccion, telefono) VALUES (:cedula, :nombre, :apellido, :direccion, :telefono)";
            $stmt = $conn->prepare($sql);
    
            // Asignar los valores a los parámetros
            $stmt->bindParam(':cedula', $cedula);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':telefono', $telefono);
    
            // Ejecutar la consulta
            if ($stmt->execute()) {
                // Si todo va bien, hacemos commit
                $conn->commit();
                // Respuesta JSON exitosa
                echo json_encode(['success' => true, 'message' => 'Estudiante guardado exitosamente']);
            } else {
                // Si algo falla, hacemos rollback
                $conn->rollBack();
                echo json_encode(['success' => false, 'message' => 'Error al guardar el estudiante']);
            }
        } catch (PDOException $e) {
            // Hacemos rollback en caso de excepción
            $conn->rollBack();
            // Retornar error en formato JSON
            echo json_encode(['success' => false, 'message' => 'Error tonto: ' . $e->getMessage()]);
        }
    }

    
    
    // public function eliminarEstudiante($cedula){
    //     $this->conexion->conectar();
    //     $sql = "DELETE FROM estudiante WHERE cedula='$cedula'";
    //     $resul = $this->conexion->conectar()->prepare($sql);
    //     $resul->execute();
    // }
    public function eliminarEstudiante($cedula) {
        try {
            $this->conexion->conectar();
            $conn = $this->conexion->conectar();
            $conn->beginTransaction();
    
            // Preparar la consulta SQL con parámetros
            $sql = "DELETE FROM estudiante WHERE cedula = :cedula";
            $stmt = $conn->prepare($sql);
    
            // Asignar los valores a los parámetros
            $stmt->bindParam(':cedula', $cedula);
    
            // Ejecutar la consulta
            if ($stmt->execute()) {
                // Si todo va bien, hacemos commit
                $conn->commit();
                // Respuesta JSON exitosa
                echo json_encode(['success' => true, 'message' => 'Estudiante eliminado exitosamente']);
            } else {
                // Si algo falla, hacemos rollback
                $conn->rollBack();
                echo json_encode(['success' => false, 'message' => 'Error al eliminar el estudiante']);
            }
        } catch (PDOException $e) {
            // Hacemos rollback en caso de excepción
            $conn->rollBack();
            // Retornar error en formato JSON
            echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }

    
    public function actualizarEstudiante($cedula, $nombre, $apellido, $direccion, $telefono) {
        try {
            $this->conexion->conectar();
            $conn = $this->conexion->conectar();
            $conn->beginTransaction();
    
            // Preparar la consulta SQL con parámetros
            $sql = "UPDATE estudiante SET nombre = :nombre, apellido = :apellido, direccion = :direccion, telefono = :telefono WHERE cedula = :cedula";
            $stmt = $conn->prepare($sql);
    
            // Asignar los valores a los parámetros
            $stmt->bindParam(':cedula', $cedula);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':telefono', $telefono);
    
            // Ejecutar la consulta
            if ($stmt->execute()) {
                // Si todo va bien, hacemos commit
                $conn->commit();
                echo json_encode(['success' => true, 'message' => 'Estudiante actualizado exitosamente']);
            } else {
                // Si algo falla, hacemos rollback
                $conn->rollBack();
                echo json_encode(['success' => false, 'message' => 'Error al actualizar el estudiante']);
            }
        } catch (PDOException $e) {
            // Hacemos rollback en caso de excepción
            $conn->rollBack();
            echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }

}
?>

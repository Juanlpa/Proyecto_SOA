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

        $sql = "SELECT * FROM estudiantes";
        $resul = $this->conexion->conectar()->prepare($sql);
        $resul->execute();
        $data = $resul->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }

    public function obtenerEstudiante($cedula){
        $this->conexion->conectar();

        $sql = "SELECT * FROM estudiantes WHERE estCedula = :cedula";
        $resul = $this->conexion->conectar()->prepare($sql);
        $resul->bindParam(':cedula', $cedula);
        $resul->execute();

        $data = $resul->fetch(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }

    public function obtenerEstudianteCondiciones($parametro1, $parametro2){
        $this->conexion->conectar();

        $sql = "SELECT * FROM estudiantes WHERE estCedula LIKE :cedula AND estNombre LIKE :nombre";
        $resul = $this->conexion->conectar()->prepare($sql);
        $cedula = "%$parametro1%";
        $nombre = "%$parametro2%";
        $resul->bindParam(':cedula', $cedula);
        $resul->bindParam(':nombre', $nombre);
        $resul->execute();

        $data = $resul->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }

    public function guardarEstudiante() {
        try {
            $this->conexion->conectar();
            $conn = $this->conexion->conectar();
            $conn->beginTransaction();
    
            // Aquí asegúrate de que las claves sean correctas
            $cedula = $_POST['estCedula']; // Asegúrate de que sea 'estCedula'
            $nombre = $_POST['estNombre'];   // Asegúrate de que sea 'estNombre'
            $apellido = $_POST['estApellido']; // Asegúrate de que sea 'estApellido'
            $direccion = $_POST['estDireccion']; // Asegúrate de que sea 'estDireccion'
            $telefono = $_POST['estTelefono']; // Asegúrate de que sea 'estTelefono'
            $curId = $_POST['curId']; // Asegúrate de que tengas este campo en tu formulario
    
            $sql = "INSERT INTO estudiantes (estCedula, estNombre, estApellido, estDireccion, estTelefono, curId) 
                    VALUES (:cedula, :nombre, :apellido, :direccion, :telefono, :curId)";
            $stmt = $conn->prepare($sql);
    
            $stmt->bindParam(':cedula', $cedula);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':curId', $curId);
    
            if ($stmt->execute()) {
                $conn->commit();
                echo json_encode(['success' => true, 'message' => 'Estudiante guardado exitosamente']);
            } else {
                $conn->rollBack();
                echo json_encode(['success' => false, 'message' => 'Error al guardar el estudiante']);
            }
        } catch (PDOException $e) {
            $conn->rollBack();
            echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }
    

    public function eliminarEstudiante($cedula) {
        try {
            $this->conexion->conectar();
            $conn = $this->conexion->conectar();
            $conn->beginTransaction();

            $sql = "DELETE FROM estudiantes WHERE estCedula = :cedula";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':cedula', $cedula);

            if ($stmt->execute()) {
                $conn->commit();
                echo json_encode(['success' => true, 'message' => 'Estudiante eliminado exitosamente']);
            } else {
                $conn->rollBack();
                echo json_encode(['success' => false, 'message' => 'Error al eliminar el estudiante']);
            }
        } catch (PDOException $e) {
            $conn->rollBack();
            echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function actualizarEstudiante($cedula, $nombre, $apellido, $direccion, $telefono) {
        try {
            $this->conexion->conectar();
            $conn = $this->conexion->conectar();
            $conn->beginTransaction();
    
            $sql = "UPDATE estudiantes SET estNombre = :nombre, estApellido = :apellido, estDireccion = :direccion, estTelefono = :telefono 
                    WHERE estCedula = :cedula";
            $stmt = $conn->prepare($sql);
    
            $stmt->bindParam(':cedula', $cedula);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':telefono', $telefono);
    
            if ($stmt->execute()) {
                $conn->commit();
                echo json_encode(['success' => true, 'message' => 'Estudiante actualizado exitosamente']);
            } else {
                $conn->rollBack();
                $errorInfo = $stmt->errorInfo(); // Obtener información sobre el error
                echo json_encode(['success' => false, 'message' => 'Error al actualizar el estudiante: ' . $errorInfo[2]]);
            }
        } catch (PDOException $e) {
            $conn->rollBack();
            echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }
    
    

    public function obtenerCursos() {
        $this->conexion->conectar();

        $sql = "SELECT * FROM cursos"; // Asegúrate de que esta consulta sea correcta
        $resul = $this->conexion->conectar()->prepare($sql);
        $resul->execute();
        $data = $resul->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }
}
?>

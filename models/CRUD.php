<?php
include_once('conexion.php');

class CRUD
{
    private $conexion;

    public function __construct(){
        $this->conexion = new CONEXION();
    }

    public function obtenerEstudiantes(){
        $conn = $this->conexion->conectar();

        $sql = "SELECT e.estCedula, e.estNombre, e.estApellido, e.estTelefono, e.estDireccion, e.curId, c.nombre AS nombreCurso 
                FROM estudiantes e 
                INNER JOIN cursos c ON c.curId = e.curId";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }

    public function obtenerEstudianteCondiciones($cedula, $nombre){
        $conn = $this->conexion->conectar();

        $sql = "SELECT e.estCedula, e.estNombre, e.estApellido, e.estTelefono, e.estDireccion, e.curId, c.nombre AS nombreCurso 
                FROM estudiantes e 
                INNER JOIN cursos c ON c.curId = e.curId 
                WHERE e.estCedula LIKE :cedula AND e.estNombre LIKE :nombre";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':cedula', "%$cedula%");
        $stmt->bindValue(':nombre', "%$nombre%");
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }

    public function guardarEstudiante() {
        try {
            $conn = $this->conexion->conectar();
            $conn->beginTransaction();
    
            $sql = "INSERT INTO estudiantes (estCedula, estNombre, estApellido, estDireccion, estTelefono, curId) 
                    VALUES (:cedula, :nombre, :apellido, :direccion, :telefono, :curId)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':cedula', $_POST['estCedula']);
            $stmt->bindParam(':nombre', $_POST['estNombre']);
            $stmt->bindParam(':apellido', $_POST['estApellido']);
            $stmt->bindParam(':direccion', $_POST['estDireccion']);
            $stmt->bindParam(':telefono', $_POST['estTelefono']);
            $stmt->bindParam(':curId', $_POST['curId']);
    
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


    public function obtenerEstudiantePorCedula($cedula) {
        $conn = $this->conexion->conectar();
    
        $sql = "SELECT e.estCedula, e.estNombre, e.estApellido, e.estTelefono, e.estDireccion, e.curId, c.nombre AS nombreCurso 
                FROM estudiantes e 
                INNER JOIN cursos c ON c.curId = e.curId 
                WHERE e.estCedula = :cedula";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cedula', $cedula);
        $stmt->execute();
    
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }
    

    public function actualizarEstudiante($cedula, $nombre, $apellido, $direccion, $telefono, $curId) {
        try {
            $conn = $this->conexion->conectar();
            $conn->beginTransaction();
    
            $sql = "UPDATE estudiantes 
                    SET estNombre = :nombre, estApellido = :apellido, estDireccion = :direccion, estTelefono = :telefono, curId = :curId 
                    WHERE estCedula = :cedula"; // Asegúrate de que aquí incluimos curId
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':cedula', $cedula);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':curId', $curId); // No olvides incluir esto
    
            if ($stmt->execute()) {
                $conn->commit();
                echo json_encode(['success' => true, 'message' => 'Estudiante actualizado exitosamente']);
            } else {
                $conn->rollBack();
                echo json_encode(['success' => false, 'message' => 'Error al actualizar el estudiante']);
            }
        } catch (PDOException $e) {
            $conn->rollBack();
            echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }
    

    

    public function obtenerCursos() {
        $conn = $this->conexion->conectar();

        $sql = "SELECT * FROM cursos";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }
}
?>

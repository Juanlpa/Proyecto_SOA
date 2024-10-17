<?php
include_once 'conexion.php';

class FuncionesApi
{
    public static function guardarEstudiante($data)
    {
        $conexion = new Conexion();
        $conn = $conexion->conectar();
        
        // Se utilizan las claves CED_EST, NOM_EST, etc.
        $cedula = $data['CED_EST'];
        $nombre = $data['NOM_EST'];
        $apellido = $data['APE_EST'];
        $direccion = $data['DIR_EST'];
        $telefono = $data['TEL_EST'];

        // Se ajusta la consulta SQL a las columnas correctas
        $sql = "INSERT INTO estudiantes (CED_EST, NOM_EST, APE_EST, DIR_EST, TEL_EST) VALUES ('$cedula', '$nombre', '$apellido', '$direccion', '$telefono')";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(["message" => "User created successfully"]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Error creating user: " . $conn->error]);
        }

        $conexion->cerrarConexion();
    }

    public static function buscarEstudiantePorCedula($cedula)
    {
        $conexion = new Conexion();
        $conn = $conexion->conectar();

        // Se utiliza CED_EST en lugar de cedula
        $sql = "SELECT * FROM estudiantes WHERE CED_EST='$cedula'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $estudiante = $result->fetch_assoc();
            echo json_encode($estudiante);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Student not found"]);
        }

        $conexion->cerrarConexion();
    }

    public static function borrarEstudiante()
    {
        $conexion = new Conexion();
        $conn = $conexion->conectar();
    
        // Obtener el valor de CED_EST desde $_GET
        if (isset($_GET['CED_EST'])) {
            $cedula = $_GET['CED_EST'];
            
            $sql = "DELETE FROM estudiantes WHERE CED_EST = '$cedula'";
            if ($conn->query($sql) === TRUE) {
                echo json_encode(["message" => "Estudiante eliminado"]);
            } else {
                echo json_encode(["message" => "Error: " . $conn->error]);
            }
        } else {
            echo json_encode(["message" => "Error: CED_EST no proporcionado"]);
        }
    
        $conexion->cerrarConexion();
    }
    

    public static function actualizarEstudiante($data)
    {
        $conexion = new Conexion();
        $conn = $conexion->conectar();
    
        // Verificamos que 'originalCedula' exista en el array $data
        if (!isset($data['originalCedula'])) {
            http_response_code(400);  // Error 400: Bad Request
            echo json_encode(["message" => "Error: originalCedula no proporcionada"]);
            $conexion->cerrarConexion();
            return;
        }
    
        // Asignación de valores
        $originalCedula = $data['originalCedula'];
        $cedula = $data['CED_EST'];
        $nombre = $data['NOM_EST'];
        $apellido = $data['APE_EST'];
        $direccion = $data['DIR_EST'];
        $telefono = $data['TEL_EST'];
    
        // Si la cédula ha cambiado, verificamos si ya existe
        if ($originalCedula !== $cedula) {
            // Verificación de duplicado en la columna CED_EST
            $checkSql = "SELECT * FROM estudiantes WHERE CED_EST='$cedula'";
            $result = $conn->query($checkSql);
            if ($result->num_rows > 0) {
                http_response_code(409);  // Error 409: Conflict
                echo json_encode(["message" => "Duplicate entry for CED_EST"]);
                $conexion->cerrarConexion();
                return;
            }
        }
    
        // Actualización de datos
        $sql = "UPDATE estudiantes SET CED_EST='$cedula', NOM_EST='$nombre', APE_EST='$apellido', DIR_EST='$direccion', TEL_EST='$telefono' WHERE CED_EST='$originalCedula'";
    
        if ($conn->query($sql) === TRUE) {
            echo json_encode(["message" => "User updated successfully"]);
        } else {
            http_response_code(500);  // Error 500: Internal Server Error
            echo json_encode(["message" => "Error updating user: " . $conn->error]);
        }
    
        $conexion->cerrarConexion();
    }
    
    public static function seleccionarEstudiantes()
    {
        $conexion = new Conexion();
        $conn = $conexion->conectar();

        // Se seleccionan todas las filas con las columnas CED_EST, NOM_EST, etc.
        $sql = "SELECT * FROM estudiantes";
        $result = $conn->query($sql);
        $estudiantes = array();
        
        while ($row = $result->fetch_assoc()) {
            $estudiantes[] = $row;
        }

        echo json_encode($estudiantes);
        $conexion->cerrarConexion();
    }

    public static function seleccionarEstudiantePorCedula($cedula)
    {
        $conexion = new Conexion();
        $conn = $conexion->conectar();

        // Se utiliza CED_EST para la consulta
        $sql = "SELECT * FROM estudiantes WHERE CED_EST = '$cedula'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $estudiante = $result->fetch_assoc();
            echo json_encode($estudiante);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "NO SE ENCONTRO EL ESTUDIANTE"]);
        }

        $conexion->cerrarConexion();
    }
}
?>

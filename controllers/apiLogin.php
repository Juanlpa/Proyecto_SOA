<?php
session_start(); // Esta línea debe estar al principio

include '../models/conexion.php';

header("Content-Type: application/json");

// Verifica si los datos fueron enviados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos enviados en el cuerpo de la solicitud
    $data = json_decode(file_get_contents("php://input"));

    if (isset($data->usuario) && isset($data->contra) && isset($data->redirect_page)) {
        $usuario = $data->usuario;
        $contra = $data->contra;  // Contraseña enviada por el usuario
        $redirect_page = $data->redirect_page;

        // Conectar a la base de datos
        $conexion = new Conexion();
        $conexion->conectar();

        // Preparar la consulta SQL para verificar las credenciales
        $sql = "SELECT usuario, password FROM usuarios WHERE usuario = :usuario";
        $resul = $conexion->conectar()->prepare($sql);
        $resul->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $resul->execute();
        $row = $resul->fetch(PDO::FETCH_ASSOC);

        // Verificar si se encontró el usuario y si la contraseña en texto plano es correcta
        if ($row && $contra === $row['password']) {
            $_SESSION['usuario'] = $usuario;

            // Responder con éxito y la página de redirección correcta
            echo json_encode([
                'status' => 'success',
                'message' => 'Login successful',
                'redirect' => $redirect_page  // Enviar la página correcta para redirigir
            ]);
        } else {
            // Responder con error si las credenciales no coinciden
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid credentials'
            ]);
        }
    } else {
        // Si faltan campos
        echo json_encode([
            'status' => 'error',
            'message' => 'Missing fields'
        ]);
    }
} else {
    // Si no es una solicitud POST
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method'
    ]);
}
?>

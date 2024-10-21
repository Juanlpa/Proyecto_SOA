<?php
include '../models/conexion.php';

header("Content-Type: application/json");
session_start();

// Obtener los datos enviados en el cuerpo de la solicitud
$data = json_decode(file_get_contents("php://input"));

// Verificar si se envió la acción de logout
if (isset($data->action) && $data->action === 'logout') {
    // Destruir la sesión y responder con éxito
    session_destroy();
    echo json_encode([
        'status' => 'success',
        'message' => 'Logout successful'
    ]);
    exit();  // Terminar la ejecución
}

// Si no es una solicitud de logout, procesar el login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($data->usuario) && isset($data->contra) && isset($data->redirectPage)) {
        $usuario = $data->usuario;
        $contra = $data->contra;
        $redirectPage = $data->redirectPage;  // Recibimos la página de redirección

        // Conectar a la base de datos
        $conexion = new Conexion();
        $conexion->conectar();

        // Preparar la consulta SQL para verificar las credenciales
        $sql = "SELECT usuario, contra FROM usuario WHERE usuario = :usuario AND contra = :contra";
        $resul = $conexion->conectar()->prepare($sql);
        $resul->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $resul->bindParam(':contra', $contra, PDO::PARAM_STR);
        $resul->execute();
        $row = $resul->fetch(PDO::FETCH_ASSOC);

        // Verificar si se encontró un usuario
        if ($row) {
            $_SESSION['usuario'] = $usuario;

            // Responder con éxito y devolver la página de redirección
            echo json_encode([
                'status' => 'success',
                'message' => 'Login successful',
                'redirectPage' => $redirectPage  // Devolvemos la página a la que debe redirigir
            ]);
        } else {
            // Responder con error
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid credentials'
            ]);
        }
    } else {
        // Si faltan campos en la solicitud de login
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

<?php
include '../models/FuncionesApi.php';


$opc = $_SERVER['REQUEST_METHOD'];
$requestPayload = file_get_contents("php://input");
$data = json_decode($requestPayload, true);

switch ($opc) {
    case 'GET':
        if (isset($_GET['cedula'])) {
            // Si se proporciona una cédula en los parámetros de la URL, buscar solo ese estudiante
            FuncionesApi::seleccionarEstudiantePorCedula($_GET['cedula']);
        } else {
            // Si no hay cédula en la URL, devolver todos los estudiantes
            FuncionesApi::seleccionarEstudiantes();
        }
        break;
    case 'POST':
        if (isset($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']) && $_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'] == 'PUT') {
            // Handle PUT request
            FuncionesApi::actualizarEstudiante($data);
        } else {
            // Handle POST request (create new user)
            FuncionesApi::guardarEstudiante($data);
        }
        break;
    case 'DELETE':
        FuncionesApi::borrarEstudiante($data);
        break;
    case 'PUT':
        FuncionesApi::actualizarEstudiante($data);
        break;
    default:
        http_response_code(405);
        echo json_encode(["message" => "Method not allowed"]);
        break;
}
?>

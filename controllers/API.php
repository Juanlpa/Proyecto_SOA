<?php
include_once '../models/CRUD.php';

$crud = new CRUD();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['cursos'])) {
            $crud->obtenerCursos();
        } elseif (isset($_GET['cedula'])) {
            // Obtener estudiante por cédula
            $cedula = $_GET['cedula'];
            $crud->obtenerEstudiantePorCedula($cedula);
        } elseif (isset($_GET['estCedula']) || isset($_GET['estNombre'])) {
            $cedula = isset($_GET['estCedula']) ? $_GET['estCedula'] : '';
            $nombre = isset($_GET['estNombre']) ? $_GET['estNombre'] : '';
            $crud->obtenerEstudianteCondiciones($cedula, $nombre);
        } else {
            $crud->obtenerEstudiantes();
        }
        break;
    
    
        
        case 'PUT':
            // Actualizar estudiante
            parse_str(file_get_contents("php://input"), $_PUT); // Obtener los datos del cuerpo
            if (isset($_GET['cedula'])) {
                $cedula = $_GET['cedula'];
                $nombre = $_PUT['estNombre'];
                $apellido = $_PUT['estApellido'];
                $direccion = $_PUT['estDireccion'];
                $telefono = $_PUT['estTelefono'];
                $curId = $_PUT['curId'];
                $crud->actualizarEstudiante($cedula, $nombre, $apellido, $direccion, $telefono, $curId);
            } else {
                echo json_encode(['error' => 'Cédula no proporcionada']);
            }
            break;

            case 'POST':
                if (isset($_GET['cedula'])) {
                    // Extraer los datos del formulario
                    $cedula = $_POST['estCedula'];
                    $nombre = $_POST['estNombre'];
                    $apellido = $_POST['estApellido'];
                    $direccion = $_POST['estDireccion'];
                    $telefono = $_POST['estTelefono'];
                    $curId = $_POST['curId']; // Asegúrate de que estás usando el nombre correcto
            
                    // Actualizar el estudiante
                    $crud->actualizarEstudiante($cedula, $nombre, $apellido, $direccion, $telefono, $curId);
                } else {
                    // Llama a la función de guardar estudiante
                    $crud->guardarEstudiante($_POST);
                }
                break;
            
            
    
    case 'DELETE':
        if (isset($_GET['cedula'])) {
            $cedula = $_GET['cedula'];
            $crud->eliminarEstudiante($cedula);
        } else {
            echo json_encode(['error' => 'Cédula no proporcionada']);
        }
        break;

    default:
        echo json_encode(['error' => 'Método no soportado']);
        break;
}
?>

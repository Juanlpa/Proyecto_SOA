<?php
include_once '../models/CRUD.php';

$crud = new CRUD();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['cursos'])) {
            $crud->obtenerCursos();
            return;
        }
        if (isset($_GET['estCedula']) || isset($_GET['estNombre'])) {
            $cedula = isset($_GET['estCedula']) ? $_GET['estCedula'] : '';
            $nombre = isset($_GET['estNombre']) ? $_GET['estNombre'] : '';
            $crud->obtenerEstudianteCondiciones($cedula, $nombre);
        } else {
            $crud->obtenerEstudiantes();
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
                $curID = $_POST['curId']; // Asegúrate de que estás usando el nombre correcto
        
                // Actualizar el estudiante
                $crud->actualizarEstudiante($cedula, $nombre, $apellido, $direccion, $telefono);
            } else {
                // Llama a la función de guardar estudiante
                $crud->guardarEstudiante($_POST);
            }
            break;
        

    default:
        echo json_encode(['error' => 'Método no soportado']);
}

?>

<?php
include_once('../models/CRUD.php');

$crud = new CRUD();
$opc = $_SERVER["REQUEST_METHOD"];

switch ($opc) {

    case "GET":
        if (isset($_GET['cedula']) && isset($_GET['nombre'])){
            // Probar en PostMan con:
            //    params
            $parametro1 = $_GET['cedula'];
            $parametro2 = $_GET['nombre'];
            $crud->obtenerEstudianteCondiciones($parametro1,$parametro2);
            return;
        }else if (isset($_GET['cedula'])) {
            // Probar en PostMan con:
            //    params
            $cedula = $_GET['cedula'];
            $crud->obtenerEstudiante($cedula);
            return;
        } else {
            // Probar en PostMan con:
            //    params (pero en vacio)
            $crud->obtenerEstudiantes();
            return;
        }

    case "POST":
        // Probar en PostMan con:
        //    form-data
        //    x-www-form-ulrencoded
        $crud->guardarEstudiante();
        return;
    
    case "PUT":
        // PARA LA TABLA DE ESTUDIANTES
        // PARA LARAVEL
        // PARA JAVA_ESCRITORIO
        // PARA JAVA_WEB
        // PARA SPRING_BOOT
        // Probar en PostMan con:
        //    x-www-form-urlencoded
        parse_str(file_get_contents('php://input'), $putData);
        $cedula = $putData['cedula'];
        $nombre = $putData['nombre'];
        $apellido = $putData['apellido'];
        $direccion = $putData['direccion'];
        $telefono = $putData['telefono'];
        $crud->actualizarEstudiante($cedula, $nombre, $apellido, $direccion, $telefono);
        return;
    /*
    case "PUT":
        // Probar en PostMan con:
        //    Params
        $cedula = $_GET["cedula"];
        $nombre = $_GET["nombre"];
        $apellido = $_GET["apellido"];
        $direccion = $_GET["direccion"];
        $telefono = $_GET["telefono"];
        $crud->actualizarEstudiante($cedula, $nombre, $apellido, $direccion, $telefono);
        return;
    */
    /*    
    case "PUT":
        // Probar en PostMan con:
        //    raw como JSON
        $coso = file_get_contents("php://input");
        $data =  json_decode($coso, true);
        $cedula = $data['cedula'];
        $nombre = $data['nombre'];
        $apellido = $data['apellido'];
        $direccion = $data['direccion'];
        $telefono = $data['telefono'];
        $crud->actualizarEstudiante($cedula, $nombre, $apellido, $direccion, $telefono);
        return;
    */

    case "DELETE":
        // Probar en PostMan con:
        //    Params
        $cedula = $_GET["cedula"];
        $crud->eliminarEstudiante($cedula);
        return;
}

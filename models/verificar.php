<?php
include 'conexion.php';

session_start();
$conexion = new Conexion();
$conexion->conectar();
$usuario = $_POST['usuario'];
$contra = $_POST['contra'];

// Selecciona solo el usuario y la contraseña
$sql = "SELECT usuario, contra FROM usuario WHERE usuario = :usuario AND contra = :contra";
$resul = $conexion->conectar()->prepare($sql);
$resul->bindParam(':usuario', $usuario, PDO::PARAM_STR);
$resul->bindParam(':contra', $contra, PDO::PARAM_STR);
$resul->execute();
$row = $resul->fetch(PDO::FETCH_ASSOC);

if ($row) {
    $_SESSION['usuario'] = $usuario;
    header('Location: ../index.php?action=servicios');
} else {
    header('Location: ../index.php?action=logueadoe');   
}
?>
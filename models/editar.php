<?php
include 'conexion.php';
$cedula=$_POST['CED_EST'];
$nombre=$_POST['NOM_EST'];
$apellido=$_POST['APE_EST'];
$direccion=$_POST['DIR_EST'];
$telefono=$_POST['TEL_EST'];
$sqlEditar="UPDATE ESTUDIANTES SET NOM_EST='$nombre',APE_EST='$apellido',DIR_EST='$direccion',TEL_EST='$telefono' WHERE CED_EST='$cedula'";
if(mysqli_query($conn, $sqlEditar)) 
{  echo json_encode("Se ha editado el estudiante") ;} 
else
{echo json_encode("Error al EDITAR:". mysqli_error($conn));}
    $conn->close();
?>

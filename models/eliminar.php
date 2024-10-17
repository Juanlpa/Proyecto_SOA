<?php
include 'conexion.php';
$cedula=$_POST['CED_EST'];
$sqlEliminar="DELETE FROM ESTUDIANTES WHERE CED_EST='$cedula'";
if(mysqli_query($conn, $sqlEliminar)) 
{  echo json_encode("Se Elimino") ;} 
else
{echo json_encode("Error al eliminar:". mysqli_error($conn));}
?>  
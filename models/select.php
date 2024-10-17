<?php
include 'conexion.php';
$sqlSelect="SELECT * FROM estudiantes";
$respuesta=$conn->query($sqlSelect);
$resultado=array();
if($respuesta->num_rows>0){
while($fila=$respuesta->fetch_assoc()){
    array_push($resultado,$fila);
}
}else{
    $resultado="No hay estudiantes";
}
echo json_encode($resultado);
?>  
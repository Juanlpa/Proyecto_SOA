<?php
class EnlacesPaginas{
    static function enlacesPaginasModel($enlacesModel){
        if ($enlacesModel=="nosotros" || $enlacesModel=="logueadoe"){
            $module="views/interfaces/" . $enlacesModel . ".php";
        }
        else if($enlacesModel=="servicios" && !isset($_SESSION['usuario'])){
            $module="views/interfaces/login.php";
        }
        else if($enlacesModel=="contactanos" && !isset($_SESSION['usuario'])){
            $module="views/interfaces/login.php";
        }
        else if($enlacesModel=="servicios2" && !isset($_SESSION['usuario'])){
            $module="views/interfaces/login.php";
        }
        else if($enlacesModel=="logout"){
            session_destroy();
            $module="views/interfaces/logout.php";
        }
        else if($enlacesModel=="servicios" && isset($_SESSION['usuario'])){
            $module="views/interfaces/servicios.php";
        }
        else if($enlacesModel=="contactanos" && isset($_SESSION['usuario'])){
            $module="views/interfaces/contactanos.php";
        }
        else if($enlacesModel=="servicios2" && isset($_SESSION['usuario'])){
            $module="views/interfaces/servicios2.php";
        }
        else{
            $module="views/interfaces/inicio.php";
        }
        return $module;
    }  
}
?>
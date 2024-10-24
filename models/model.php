<?php

class EnlacesPaginas {
    
    static function enlacesPaginasModel($enlacesModel) {
        if ($enlacesModel == "nosotros" || $enlacesModel == "logueadoe") {
            $module = "views/interfaces/" . $enlacesModel . ".php";
        } else if (!isset($_SESSION['usuario']) && ($enlacesModel == "servicios" || $enlacesModel == "contactanos" )) {
            $module = "views/interfaces/login.php";
        } else if ($enlacesModel == "logout") {
            session_destroy();
            $module = "views/interfaces/logout.php";
        } else if (isset($_SESSION['usuario']) && ($enlacesModel == "servicios" || $enlacesModel == "contactanos" )) {
            $module = "views/interfaces/" . $enlacesModel . ".php";
        } else {
            $module = "views/interfaces/inicio.php";
        }
        return $module;
    }
}
?>
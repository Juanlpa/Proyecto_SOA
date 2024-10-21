
<?php
class McvController {
    public function plantilla() {
        require_once 'views/template.php';
    }

    function enlacesPaginasController() {
        if (isset($_GET['action'])) {
            $enlacesControlador = $_GET['action'];
            if ($enlacesControlador == 'servicios' && isset($_SESSION['usuario'])) {
                $enlacesControlador = 'servicios';
            }elseif ($enlacesControlador == 'contactanos' && isset($_SESSION['usuario'])) {
                $enlacesControlador = 'contactanos';
            }elseif ($enlacesControlador == 'servicios2' && isset($_SESSION['usuario'])) {
                $enlacesControlador == 'servicios2';
            }
            
            
        } else {
            $enlacesControlador = 'inicio.php';
        }
        $respuesta = EnlacesPaginas::enlacesPaginasModel($enlacesControlador);
        include $respuesta;
    }
}
?>
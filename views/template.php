<?php
session_start(); // Esta línea debe estar al principio
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style1.css" type="text/css">
    <link rel="icon" href="imgs/logo.png" type="image/png">
</head>
<body>
    <header>
        <img class="imagenheader" src="imgs/contabilidad.png" alt="imagenConta">
        <h1 class="utah1">Universidad Técnica de Ambato</h1>
    </header>
    <nav class="navjuan">
        <ul>
            <li><a class="estilolista" href="index.php?action=incio">Inicio</a></li>
            <li><a class="estilolista" href="index.php?action=nosotros">Nosotros</a></li>
            <li><a class="estilolista" href="index.php?action=servicios">Servicios</a></li>
            <li><a class="estilolista" href="index.php?action=contactanos">Contacto</a></li>
            <li><a class="estilolista" href="index.php?action=logout">Cerrar Sesión</a></li>
        </ul>
    </nav>
    <section>
        <?php
        $mvc = new McvController();
        $mvc->enlacesPaginasController();
        ?>
    </section>
    <div>
        <footer>
            <div class="contenedorFooter">
                <h3 class="universidad-titulo">Universidad Técnica de Ambato</h3>
                <p class="copyright">COPYRIGHT© 2023 CTT. Todos los derechos reservados.</p>
                <div class="informacionContacto">
                    <span><img src="imgs/icons/tel.png" alt="Teléfono"> (03) 282 - 4804</span>
                    <span><img src="imgs/icons/email.png" alt="Email"> educacionvirtual@uta.edu.ec</span>
                    <span><img src="imgs/icons/ws.png" alt="WhatsApp"> (099) 8918 - 159</span>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>

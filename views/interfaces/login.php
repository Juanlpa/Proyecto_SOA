<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/sylelogin.css">
    <link rel="icon" href="imgs/logo.png" type="image/png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <main class="contenido">
    <div class="InicioSes">
    <form id="formDelLogin" class="formDelLogin">
      <h3>Inicia Sesion</h3>
      <div class="EstilosForm">
        <label for="usuario">Usuario</label>
        <input type="text" id="usuario" name="usuario" required>
      </div>
      <div class="EstilosForm">
        <label for="contra">Contraseña</label>
        <input type="password" id="contra" name="contra" required>
      </div>
      <div class="EstilosForm">
        <input type="hidden" id="redirect_page" name="redirect_page"> <!-- Campo oculto para la redirección -->
      </div>
      <div class="EstilosForm">
        <input type="submit" value="Iniciar sesión">
      </div>
    </form>
    <p id="error-msg" style="color: red;"></p>
  </div>
    </main>  

    <script>
        $(document).ready(function() {
            const urlParams = new URLSearchParams(window.location.search);
            const currentPage = urlParams.get('action') || 'inicio';

            $('#redirect_page').val(currentPage);

            $('#formDelLogin').on('submit', function(e) {
                e.preventDefault();

                const usuario = $('#usuario').val();
                const contra = $('#contra').val();
                const redirect_page = $('#redirect_page').val();

                $.ajax({
                    url: 'http://localhost/Proyecto_SOA/controllers/apiLogin.php',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        usuario: usuario,
                        contra: contra,
                        redirect_page: redirect_page
                    }),
                    success: function(response) {
                        if (response.status === 'success') {
                            window.location.href = 'index.php?action=' + response.redirect;
                        } else {
                            $('#error-msg').text(response.message);
                        }
                    },
                    error: function() {
                        $('#error-msg').text('Error en la conexión con el servidor');
                    }
                });
            });
        });
    </script>
</body>
</html>

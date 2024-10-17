
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/sylelogin.css">
    <link rel="icon" href="imgs/logo.png" type="image/png">
</head>
<body>
    <main class="contenido">
    <div class="InicioSes">
    <form action="models/verificar.php" method="post"class="formDelLogin">
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
        <input type="submit" value="Iniciar sesión" name="btnIngresar">
      </div>
    </form>
  </div>

    </main>  
</body>
</html>
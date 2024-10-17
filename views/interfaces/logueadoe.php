
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/css/sylelogin.css">
    <link rel="icon" href="imgs/logo.png" type="image/png">
</head>
<body>
      <style>
        .mensajeError {
          position: relative;
          background-color: #8a1b1f;
          border: 2px #8a1b1f;
          padding: 10px;
          text-align: center;
          color: azure;
          font-weight: bold;
          font-size: 18px;
          width: 300px;
        }
      </style>
    <main class="contenido">
    <div class="InicioSes">
    <form action="../../models/verificar.php" method="post"class="formDelLoginmal">
      <h3>Inicia Sesion</h3>
      <center>
      <div class="mensajeError">
        Datos Incorrectos
      </div> </center>
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
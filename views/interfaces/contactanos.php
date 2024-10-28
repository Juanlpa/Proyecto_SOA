<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/contactanos.css" type="text/css">
    <title>Contacto</title>
</head>
<body>
    <div class="contactosContenedor">
        <div class="cajaContacto">
            <h2>Contactanos</h2>
            <img src="imgs/logo.png" alt="Logo">
            <p><strong>Información de contacto:</strong></p>
            <ul>
                <li><strong>Teléfono:</strong> 0958992514</li>
                <li><strong>Email:</strong> jlopez7372@uta.edu.ec</li>
                <li>Av. los chásquis, Ambato 180207, Ambato</li>
            </ul>
        </div>
    </div>
  
    <style>
        body {
            color: #566787;
            background: #f5f5f5;    
        }
        .contactosContenedor {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
            border-radius: 10px;
        }
        .cajaContacto {
            background: #891317;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        .cajaContacto h2 {
            font-size: 24px;
            color: #fff;
            margin-bottom: 15px;
        }
        .cajaContacto img {
            max-width: 100px;
            margin: 15px 0;
        }
        .cajaContacto p {
            font-weight: bold;
            color: #fff;
        }
        .cajaContacto ul {
            list-style: none;
            padding: 0;
            margin-top: 10px;
        }
        .cajaContacto ul li {
            margin-bottom: 10px;
            font-size: 14px;
            color: #fff;
        }
        .cajaContacto ul li strong {
            color: #fff;
        }
    </style>
</body>
</html>

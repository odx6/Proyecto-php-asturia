
<?php
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Verificación Exitosa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .container {
            width: 80%;
            margin: auto;
            text-align: center;
            padding: 50px;
        }
        h1 {
            color: #4CAF50;
        }
        p {
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>¡Verificación Exitosa!</h1>
        <p>Tu correo electrónico ha sido verificado exitosamente. Gracias por confirmar tu dirección de correo electrónico.</p>
         <a href="./?view=index">Iniciar sesion</a>
    </div>
</body>
</html>
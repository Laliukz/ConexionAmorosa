<?php
include 'includes/conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/index.css">
    <title>Bienvenido</title><head>
    </head>
    <body>
        <header>
            <img src="assets/img/ConexiónAmorosa.gif" alt="Logo">
        </header>
        <div class="buttons">
            <div id="welcome">
                <h2>Bienvenido</h2>
            </div>
            <Div class="container">
                <button type="submit" onclick="window.location.href='Inicio_sesion.php'">Inicia sesión</button>
                <button type="submit" onclick="window.location.href='Registro.php'">Registrate</button>
            </Div>
        </div>
        <footer>
            
        </footer>
</body>
</html>
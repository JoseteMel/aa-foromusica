<?php
require_once("controlador/sesion.php");
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="css/estilo.css">

<head>
    <meta charset="UTF-8">
    <title>Foro Música</title>
    <nav>
        <label for="check-menu">
        </label>
    </nav>
</head>

<body>
    <header>
        <h1>Foro Música</h1>
    </header>
    <section>
        <div id="index">
            <h2>¡Bienvenido al foro musical más grande de habla hispana!</h2>
            <br>
            <p style="text-align: center">Aquí podrás encontrar una gran comunidad en español donde hablar de música, instrumentos, grabación,
                conciertos y muchas cosas más.<br>¡Nos une la pasión por la música!</p>
            <div style='margin-top: 20px'><a href='vista/foro.php'><button class='login_boton'>Ir al foro</a>
            <a href='vista/login.php'><button class='login_boton' style="margin-left: 20px">Iniciar sesión</a></div>
        </div>
    </section>
</body>

</html>

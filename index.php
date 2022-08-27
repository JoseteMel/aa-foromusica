<?php
require_once("controlador/verificar_sesion.php");
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="css/estilos.css">

<head>
    <meta charset="UTF-8">
    <title>Foro Música</title>
</head>

<body>
<header>
    <h1>Foro Música</h1>
    <nav>
        <label for="check-menu">
            <input id="check-menu" type="checkbox">
            <div class="btn-menu">Menú</div>
            <ul class="ul-menu">
                <li><a href="vista/foro.php">Inicio</a></li>
                <li><a href="vista/login.php">Acceder</a></li>
            </ul>
        </label>
    </nav>
</header>
<section>
    <div>
        <h2>¡Bienvenido al foro musical más grande de habla hispana!</h2>
        <br>
        <p>Aquí podrás encontrar una gran comunidad en español donde hablar de música, instrumentos, grabación,
            conciertos y muchas cosas más.</p>
        <p>¡Nos une la pasión por la música!</p>
    </div>
</section>
</body>

</html>

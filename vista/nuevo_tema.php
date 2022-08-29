<?php session_start();

if(!isset($_SESSION["USUARIO"])) {
    header("Location:login.php");
} else {

}?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Nuevo tema</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>

<body>
<header>
    <nav>
        <label for="check-menu">
            <input id="check-menu" type="checkbox">
            <div class="btn-menu">Menú</div>
            <ul class="ul-menu">
                <li><a href="foro.php">Inicio</a></li>
                <li><a href="perfil.php">Mi perfil</a></li>
                <li><a href="?cerrar">Cerrar sesión</a></li>
            </ul>
        </label>
    </nav>
</header>

<section id="formaulario">
    <div id="recuadro">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <?php require_once("../controlador/temas_controlador.php");?>

            <h2 class="title-form">Crea un nuevo tema</h2>

            <div class="div-input">
                <input type="text" class="input_titulo" name="title" placeholder="Título del tema" value="">
                <textarea name="comentario" placeholder="Escribe tu comentario"></textarea>
            </div>
            <input type="submit" class="boton" name="nuevo_tema" value="Crear tema">

        </form>
    </div>
</section>
</body>
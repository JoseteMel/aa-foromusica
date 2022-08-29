<?php
session_start();
if(isset($_SESSION["USUARIO"])){
    header("Location:foro.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Foro</title>
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
            </ul>
        </label>
    </nav>
</header>
<?php
if(isset($_GET["registrar"])){
    require_once("registrar.php");
}else{
    ?>
    <section id="formaulario">
        <div id="login">
            <form class="login_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <?php require_once("../controlador/usuarios_controlador.php"); ?>
                <h2 class="title-form">Iniciar sesión</h2>
                <div class="div-input">
                    <input type="text" class="user-form" name="usuario" id="usuario" placeholder="Nombre de usuario">
                </div>
                <div class="div-input">
                    <input type="password" class="user-form" name="password" id="password" placeholder="Contraseña">
                </div>
                <input type="submit" name="login" class="login_boton" value="Iniciar sesión">
                <p class="p-registrar-login">¿No tienes una cuenta? <a class="log-reg" href="<?php echo "?registrar" ?>">Registrarse</a></p>
            </form>
        </div>
    </section>
<?php } ?>
</body>
</html>

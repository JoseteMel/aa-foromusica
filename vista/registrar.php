<section id="formaulario">
    <div id="recuadro">
        <form class="login_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <?php require_once("../controlador/usuarios_controlador.php"); ?>

            <h2 class="title-form">Registro</h2>
            <div class="div-input">
                <input type="text" class="user-form" name="usuario" id="usuario" placeholder="Nombre de usuario">
            </div>
            <div class="div-input">
                <input type="text" class="user-form" name="nombre" id="nombre" placeholder="Nombre">
            </div>
            <div class="div-input">
                <input type="text" class="user-form" name="apellido" placeholder="Apellido">
            </div>
            <div class="div-input">
                <input type="text" class="user-form" name="email" placeholder="Email">
            </div>
            <div class="div-input">
                <input type="password" class="user-form" name="password" placeholder="Contraseña">
            </div>
            <div class="div-input">
                <input type="password" class="user-form" name="password2" placeholder="Confirmar contraseña">
            </div>
            <input type="submit" class="login_boton" name="registrar" value="Registrar">
        </form>
        <p class="p-registrar-login">¿Ya tienes una cuenta? <a class="log-reg" href="login.php">Iniciar sesión</a></p>
    </div>
</section>

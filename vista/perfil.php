<?php session_start();

if(!isset($_SESSION["USUARIO"])) {
    header("Location:login.php");
} else {?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Mi perfil</title>
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
                    <li><a href="?cerrar">Cerrar sesión</a></li>
                </ul>
            </label>
        </nav>
    </header>
    <section id="formaulario">
        <div id="recuadro">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <?php require_once("../controlador/usuarios_controlador.php");?>

                <?php if(isset($_GET["cambiapass"])) { ?>
                <h2 class="title-form">Cambiar contraseña</h2>
                <div class="div-input">
                    <input type="text" class="user-form" name="usuario" placeholder="Nombre de usuario"
                           value="<?php echo $_SESSION["USUARIO"] ?>" disabled title="No puedes cambiar el nombre de usuario">
                </div>
                <div class="div-input">
                    <input type="password" class="user-form" id="password" name="password" placeholder="Contraseña actual" autofocus>
                </div>
                <div class="div-input">
                    <input type="password" class="user-form" id="password2" name="password2" placeholder="Contraseña nueva">
                </div>
                <div class="div-input">
                    <input type="password" class="user-form" id="password2confirma" name="password2confirma"
                           placeholder="Confirmar contraseña nueva">
                </div>
                <div class="btn-perfil">
                    <input type="submit" class="boton_perfil" id="cambiapass" name="cambiapass" value="Cambiar">
                    <input type="submit" class="boton_perfil" id="cancelarpass" name="cancelarpass" value="Cancelar"></div>
        </div>
        <?php
        } elseif(isset($_GET["eliminar"])) { ?>
            <h2 class="title-form">Eliminar cuenta</h2>
            <p class="warning-form">Esto eliminará tu cuenta permanentemente</p>
            <div class="div-input">
                <input type="text" class="user-form" name="usuario" placeholder="Nombre de usuario"
                       value="<?php echo $_SESSION["USUARIO"] ?>" disabled title="No puedes cambiar el nombre de usuario">
            </div>
            <div class="div-input">
                <input type="password" class="user-form" id="password" name="password" placeholder="Contraseña" autofocus>
            </div>
            <div class="div-input">
                <input type="password" class="user-form" id="password2" name="password2" placeholder="Confirmar contraseña">
            </div>

            <div class="btn-perfil">
                <input type="submit" class="boton_perfil" id="confirmareliminar" name="confirmareliminar" value="Confirmar">
                <input type="submit" class="boton_perfil" id="cancelareliminar" name="cancelareliminar" value="Cancelar">
            </div>

        <?php } else { ?>

            <h2 class="title-form">Mis datos</h2>

            <div class="div-input">
                <input type="text" class="user-form" name="usuario" placeholder="Nombre de usuario"
                       value="<?php echo $_SESSION["USUARIO"] ?>" disabled title="No puedes cambiar el nombre de usuario">
            </div>
            <div class="div-input">
                <input type="text" class="user-form" id="nombre" name="nombre" placeholder="Nombre"
                    <?php echo (isset($_SESSION["NOMBRE"]) ? 'value="'.$_SESSION["NOMBRE"].'"' : '');
                    echo (($campo == 'nombre' || $campo == null) ? 'autofocus':''); ?>>
            </div>
            <div class="div-input">
                <input type="text" class="user-form" id="apellido" name="apellido" placeholder="Apellido"
                    <?php echo (isset($_SESSION["APELLIDO"]) ? 'value="'.$_SESSION["APELLIDO"].'"' : '');
                    echo ( $campo == 'apellido' ? 'autofocus':''); ?>>
            </div>
            <div class="div-input">
                <input type="text" class="user-form" id="email" name="email" placeholder="Email"
                    <?php echo (isset($_SESSION["EMAIL"]) ? 'value="'.$_SESSION["EMAIL"].'"' : '');
                    echo ( $campo == 'email' ? 'autofocus':''); ?>>
            </div>
            <div class="div-input">
                <input type="password" class="user-form" id="password" name="password" placeholder="Contraseña"
                    <?php echo (isset($_SESSION["PASSWORD"]) ? 'value="'.$_SESSION["PASSWORD"].'"' : '');
                    echo ($campo == 'password' ? 'autofocus':''); ?>>
            </div>
            <div class="div-input">
                <input type="password" class="user-form" name="password2" placeholder="Confirmar contraseña">
            </div>
            <div class="btn-datos">
                <input type="submit" class="boton_perfil" id="modificar" name="modificar" value="Modificar">
            </div>
            <div class="btn-datos">
                <input type="submit" class="boton_perfil" name="cambiar_pass" value="Cambiar contraseña">
            </div>
            <div class="btn-datos">
                <input type="submit" class="boton_perfil" name="eliminar" value="Eliminar cuenta">
            </div>
        <?php } ?>
        </form>
        </div>
    </section>
    </body>
    </html>
<?php } ?>

<?php
if(!empty($_SESSION["formdatalogin"])) {
    $alias = trim($_SESSION["formdatalogin"]["usuario"]);
    if(($_GET["login"]=="no")) {
        echo $_SESSION["mensajelogin"];
        if(!empty($_GET["campo"])) {
            $campo = $_GET["campo"];
        }
    }

    unset($_SESSION["formdatalogin"]);
    unset($_SESSION["mensajelogin"]);
}

if(!empty($_POST["login"])) {
    foreach($_POST as $key=>$value) {
        $value = trim($value);
        if($value == ""){
            $validacion=false;
            $mensaje = '<p class="error-form">El campo <b>'.$key.'</b> no puede estar vacío</p>';
            header("Location:". $_SERVER['PHP_SELF']."?login=no&campo=$key");
            break;
        } elseif($key == "usuario" && strlen($value) < $num=3) {
            $mensaje = '<p class="error-form">El campo <b>'.$key.'</b> debe ser mayor que '.$num.'</p>';
            $validacion=false;
            header("Location:". $_SERVER['PHP_SELF']."?login=no&campo=$key");
            break;
            // si el password tiene menos de 8 caracteres...
        } elseif($key == "password" && strlen($value) < $num=8) {
            $mensaje = '<p class="error-form">El número de carácteres del campo <b>'.$key.'</b> tiene ser mayor 
                            que '.$num.'</p>';
            $validacion=false;
            header("Location:". $_SERVER['PHP_SELF']."?login=no&campo=$key");
            break;
        }
    }

    if($validacion) {
        $controlador = new Usuarios_Controlador();
        $usuario = $controlador->iniciar_sesion($_POST["usuario"], $_POST["password"]);
        if(gettype($usuario) == "string") {
            $_SESSION["formdatalogin"] = $_POST;
            $_SESSION["mensajelogin"] = $usuario;
            header("Location:". $_SERVER['PHP_SELF']."?login=no");
        } elseif($usuario == null) {
            $_SESSION["formdatalogin"] = $_POST;
            $_SESSION["mensajelogin"] = '<p class="error-form">Usuario y/o contraseña incorrecta</p>';
            header("Location:". $_SERVER['PHP_SELF']."?login=no");
        } else {
            $_SESSION["USUARIO"] = $usuario->alias;
            $_SESSION["NOMBRE"] = $usuario->nombre;
            $_SESSION["APELLIDO"] = $usuario->apellido;
            $_SESSION["EMAIL"] = $usuario->email;
            $_SESSION["ID"] = $usuario->id;
            header("Location:foro.php");
        }
    } else {
        $_SESSION["formdatalogin"] = $_POST;
        $_SESSION["mensajelogin"] = $mensaje;
    }
}
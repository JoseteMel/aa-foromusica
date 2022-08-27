<?php
if(!empty($_SESSION["formdata"])) {
    $alias = trim($_SESSION["formdata"]["usuario"]);
    $nombre = trim($_SESSION["formdata"]["nombre"]);
    $apellido = trim($_SESSION["formdata"]["apellido"]);
    $email = trim($_SESSION["formdata"]["email"]);

    if($_GET["registrar"]== ("si" || "no")) {
        echo $_SESSION["mensajeregistrar"];
        if(!empty($_GET["campo"])){
            $campo = $_GET["campo"];
        }
    }

    unset($_SESSION["formdata"]);
    unset($_SESSION["mensajeregistrar"]);
}

if(isset($_POST["registrar"])) {
    $password2 = $_POST["password2"];

    foreach($_POST as $key=>$value) {
        $value = trim($value);
        if($value == "") {
            $mensaje = '<p class="error-form">El campo <b>'.$key.'</b> no puede estár vacío</p>';
            $validacion=false;
            header("Location:". $_SERVER['PHP_SELF']."?registrar=no&campo=$key");
            break;
        } elseif($key == "usuario" && !preg_match('/^[A-Za-zñÑ0-9.-_]{3,20}+$/', $value)) {
            $mensaje = '<p class="error-form">El campo <b>'.$key.'</b> sólo permite . - _ y letras sin tildes 
                            <br>(mínimo 3 y máximo 20 caracteres)</p>';
            $validacion=false;
            header("Location:". $_SERVER['PHP_SELF']."?registrar=no&campo=$key");
            break;
        } elseif(($key == "nombre" || $key == "apellido") &&
                    !preg_match("/^[ A-Za-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙñÑ]{2,20}+$/", $value)) {
            $mensaje = '<p class="error-form">El campo <b>'.$key.'</b> sólo puede contener letras <br>(mínimo 2 y 
                            máximo 20 caracteres).</p>';
            $validacion=false;
            header("Location:". $_SERVER['PHP_SELF']."?registrar=no&campo=$key");
            break;
        } elseif($key == "email") {
            if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
                $mensaje = '<p class="error-form">El email <b>'.$value.'</b> no es correcto.</p>';
                $validacion=false;
                header("Location:". $_SERVER['PHP_SELF']."?registrar=no&campo=$key");
                break;
            } elseif(strlen($value) > ($num=50)) {
                $mensaje = '<p class="error-form">El campo <b>'.$key.'</b> no debe ser mayor que '.$num.' caracteres</p>';
                $validacion=false;
                header("Location:". $_SERVER['PHP_SELF']."?registrar=no&campo=$key");
                break;
            }
        } elseif($key == "password") {
            if(strlen($value) < $num=6) {
                $mensaje = '<p class="error-form">El campo <b>'.$key.'</b> debe ser mayor que '.$num.'</p>';
                $validacion=false;
                header("Location:". $_SERVER['PHP_SELF']."?registrar=no&campo=$key");
                break;
            } elseif($value != $password2) {
                $mensaje = '<p class="error-form">El campo <b>'.$key.'</b> y confirmar contraseña deben coincidir</p>';
                $validacion=false;
                header("Location:". $_SERVER['PHP_SELF']."?registrar=no&campo=$key");
                break;
            }
        }
    }

    if($validacion) {
        $usuario = new Usuarios_modelo($_POST["usuario"], $_POST["nombre"],$_POST["apellido"],$_POST["email"], 0);
        $controlador = new Usuarios_Controlador();
        $respuesta = $controlador->registrar($usuario, $_POST["password"]);

        if(gettype($respuesta) == "string") {
            $_SESSION["formdata"] = $_POST;
            $_SESSION["mensajeregistrar"] = $respuesta;
            header("Location:". $_SERVER['PHP_SELF']."?registrar=no");
        } else {
            $_SESSION["formdata"] = $_POST;
            require_once("email.php");
            $_SESSION["mensajeregistrar"] = Email::email_registrar($_SESSION["formdata"]);
            header("Location:foro.php");
        }
    } else {
        $_SESSION["formdata"] = $_POST;
        $_SESSION["mensajeregistrar"] = $mensaje;
    }
}
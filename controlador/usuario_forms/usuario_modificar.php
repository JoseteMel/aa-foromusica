<?php
if(!empty($_SESSION["formdatamodificar"])) {
    if(isset($_GET["modificar"])) {
        if($_GET["modificar"]==("si" || "no")) {
            echo $_SESSION["mensajemodificar"];
        }
        if(!empty($_GET["campo"])) {
            $campo = $_GET["campo"];
        }
    }

    unset($_SESSION["formdatamodificar"]);
    unset($_SESSION["mensajemodificar"]);
}

if(isset($_POST["modificar"])) {
    $password2 = $_POST["password2"];

    foreach($_POST as $key=>$value) {
        $value = trim($value);
        if($value == "") {
            $mensaje = '<p class="error-form">El campo <b>'.$key.'</b> no puede estár vacío</p>';
            $validacion=false;
            header("Location:". $_SERVER['PHP_SELF']."?modificar=no&campo=$key");
            break;
        } elseif($key == "nombre" || $key == "apellido") {
            if(!preg_match("/^[ A-Za-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙñÑ.-]{2,20}+$/", $value)) {
                $mensaje = '<p class="error-form">El campo <b>'.$key.'</b> sólo puede contener letras (mínimo 2 y 
                                máximo 20 caracteres)</p>';
                $validacion=false;
                header("Location:". $_SERVER['PHP_SELF']."?modificar=no&campo=$key");
                break;
            }
        } elseif($key == "email") {
            if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $mensaje = '<p class="error-form">El email <b>'.$value.'</b> no es correcto.</p>';
                $validacion=false;
                header("Location:". $_SERVER['PHP_SELF']."?modificar=no&campo=$key");
                break;
            } elseif(strlen($value) > ($num=50)) {
                $mensaje = '<p class="error-form">El campo <b>'.$key.'</b> no debe ser mayor que '.$num.' caracteres</p>';
                $validacion=false;
                header("Location:". $_SERVER['PHP_SELF']."?modificar=no&campo=$key");
                break;
            }
        } elseif($key == "password") {
            if(strlen($value) < $num=6) {
                $mensaje = '<p class="error-form">El campo <b>'.$key.'</b> debe ser mayor que '.$num.'</p>';
                $validacion=false;
                header("Location:". $_SERVER['PHP_SELF']."?modificar=no&campo=$key");
                break;
            } elseif($value != $password2) {
                $mensaje = '<p class="error-form">El campo <b>'.$key.'</b> y confirmar contraseña deben coincidir</p>';
                $validacion=false;
                header("Location:". $_SERVER['PHP_SELF']."?modificar=no&campo=$key");
                break;
            }
        }
    }

    if($validacion) {
        $usuario = new Usuarios_modelo($_SESSION["USUARIO"], $_POST["nombre"],$_POST["apellido"],$_POST["email"], 0);
        $controlador = new Usuarios_Controlador();
        $respuesta = $controlador->actualizar($usuario, $_POST["password"]);
        if(gettype($respuesta) == "string") {
            $_SESSION["formdatamodificar"] = $_POST;
            $_SESSION["mensajemodificar"]= $respuesta;
            header("Location:perfil.php?modificar=no");
        } elseif($respuesta) {
            $_SESSION["NOMBRE"] = $_POST["nombre"];
            $_SESSION["APELLIDO"] = $_POST["apellido"];
            $_SESSION["EMAIL"] = $_POST["email"];
            $_SESSION["formdatamodificar"] = $_POST;
            $_SESSION["mensajemodificar"] = '<p class="ok-form">¡Los datos han sido modificados correctamente!</p>';
            header("Location:perfil.php?modificar=si");
        } else {
            $_SESSION["formdatamodificar"] = $_POST;
            $_SESSION["mensajemodificar"] = '<p class="error-form">No se han podido modificar los datos. 
                <b>Contraseña</b> incorrecta o quizás no has modificado ningún campo.</p>';
            header("Location:perfil.php?modificar=no");
        }
    } else {
        $_SESSION["formdatamodificar"] = $_POST;
        $_SESSION["mensajemodificar"]= $mensaje;
    }
}

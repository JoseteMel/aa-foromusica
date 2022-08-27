<?php
if(!empty($_SESSION["mensajecambiapass"])) {
    if($_GET["cambiapass"] == ("si" || "no")) {
        echo $_SESSION["mensajecambiapass"];
    }
    unset($_SESSION["mensajecambiapass"]);
}

if(isset($_POST["cambiar_pass"])) {
    header("Location:" . $_SERVER['PHP_SELF'] . "?cambiapass");
} elseif (isset($_POST["cambiapass"])) {
    $password_actual = $_POST["password"];
    $password_nuevo = $_POST["password2"];
    $password_nuevo_confirma = $_POST["password2confirma"];

    foreach($_POST as $key=>$value) {
        $campos = ["password"=>"Contraseña actual", "password2"=>"Contraseña nueva", "password2confirma"=>"Confirmar contraseña nueva"];
        $value = trim($value);
        if($value == "") {
            $mensaje = '<p class="error-form">El campo <b>'.$campos[$key].'</b> no puede estár vacío</p>';
            $validacion=false;
            header("Location:". $_SERVER['PHP_SELF']."?cambiapass=no");
            break;
        } elseif($key == "password" || $key == "password2" || $key == "password2confirma") {
            if(strlen($value) < $num=6) {
                $mensaje = '<p class="error-form">El campo <b>'.$campos[$key].'</b> debe ser mayor que '.$num.'</p>';
                $validacion=false;
                header("Location:". $_SERVER['PHP_SELF']."?cambiapass=no");
                break;
            }

            if($key == "password2") {
                if($value == $password_actual) {
                    $mensaje = '<p class="error-form">El campo <b>'.$campos[$key].'</b> debe ser distinta de la 
                                    <b>Contraseña actual</b></p>';
                    $validacion=false;
                    header("Location:". $_SERVER['PHP_SELF']."?cambiapass=no");
                } elseif($value != $password_nuevo_confirma) {
                    $mensaje = '<p class="error-form">El campo <b>'.$campos[$key].'</b> y <b>Confirmar contraseña 
                                    nueva</b> deben coincidir</p>';
                    $validacion = false;
                    header("Location:". $_SERVER['PHP_SELF']."?cambiapass=no");
                    break;
                }
            }
        }
    }
    if($validacion) {
        $controlador = new Usuarios_Controlador();
        $respuesta = $controlador->cambiapass($_SESSION["USUARIO"], $_POST["password"], $_POST["password2"]);
        if(gettype($respuesta) == "string") {
            $_SESSION["mensajecambiapass"]= $respuesta;
            header("Location:../vista/perfil.php?cambiapass=no");
        } elseif($respuesta) {
            $_SESSION["mensajecambiapass"]= '<p class="ok-form">La contraseña ha sido modificada.</p>';
            header("Location:../vista/perfil.php?cambiapass=si");
        }
    } else {
        $_SESSION["mensajecambiapass"] = $mensaje;
    }
}
elseif(isset($_POST["cancelarpass"])) {
    header("Location:". $_SERVER['PHP_SELF']);
}
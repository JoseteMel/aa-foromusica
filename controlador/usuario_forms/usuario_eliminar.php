<?php
if(!empty($_SESSION["mensajeeliminar"])) {
    if(isset($_GET["eliminar"])) {
        if($_GET["eliminar"]=="no") {
            echo $_SESSION["mensajeeliminar"];
        }
    }

    unset($_SESSION["mensajeeliminar"]);
}

if(isset($_POST["eliminar"])) {
    header("Location:". $_SERVER['PHP_SELF']."?eliminar");
} elseif(isset($_POST["confirmareliminar"])) {
    $password2 = $_POST["password2"];
    foreach($_POST as $key=>$value){
        $value = trim($value);
        if($value == "") {
            $mensaje = '<p class="error-form">El campo <b>'.$key.'</b> no puede estár vacío</p>';
            $validacion=false;
            header("Location:". $_SERVER['PHP_SELF']."?eliminar=no");
            break;
        } elseif($key == "password") {
            if(strlen($value) < $num=6) {
                $mensaje = '<p class="error-form">El campo <b>'.$key.'</b> debe ser mayor que '.$num.'</p>';
                $validacion=false;
                header("Location:". $_SERVER['PHP_SELF']."?eliminar=no");
                break;
            } elseif($value != $password2) {
                $mensaje = '<p class="error-form">El campo <b>'.$key.'</b> y confirmar contraseña deben coincidir</p>';
                $validacion=false;
                header("Location:". $_SERVER['PHP_SELF']."?eliminar=no");
                break;
            }
        }
    }

    if($validacion) {
        $controlador = new Usuarios_Controlador();
        $respuesta = $controlador->eliminar($_SESSION["USUARIO"], $_POST["password"]);
        if($respuesta) {
            header("Location:".$_SERVER['PHP_SELF']."?cerrar");
        } elseif(gettype($respuesta) == "string") {
            $_SESSION["mensajeeliminar"]= $respuesta;
            header("Location:../vista/perfil.php?eliminar=no");
        } else {
            $_SESSION["mensajeeliminar"]= '<p class="error-form">No se ha podido eliminar el usuario. <b>Contraseña</b> incorrecta</p>';
            header("Location:../vista/perfil.php?eliminar=no");
        }
    } else {
        $_SESSION["mensajeeliminar"]= $mensaje;
    }
} elseif(isset($_POST["cancelareliminar"])) {
    header("Location:". $_SERVER['PHP_SELF']);
}

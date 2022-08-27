<?php

require_once("../modelo/usuarios_modelo.php");

class Usuarios_Controlador{

    public function __construct() {
    }

    public function iniciar_sesion($alias, $password) {
        $usuario = Usuarios_modelo::get_usuario($alias, $password);
        return $usuario;
    }

    public function registrar($usuario, $password) {
        $registro = Usuarios_modelo::registrar($usuario, $password);
        return $registro;
    }

    public function actualizar($usuario, $password) {
        $usuario = Usuarios_modelo::actualizar($usuario, $password);
        return $usuario;
    }

    public function eliminar($alias, $password) {
        $usuario = Usuarios_modelo::eliminar($alias, $password);
        return $usuario;
    }

    public function cambiapass($alias, $password_actual, $password_nuevo) {
        $usuario = Usuarios_modelo::cambiapass($alias, $password_actual, $password_nuevo);
        return $usuario;
    }

    public function cerrar() {
        $_SESSION = array();
        session_destroy();
        header("Location: ../vista/foro.php");
    }
}

$campo=null;
$validacion=true;
$controlador = new Usuarios_Controlador();

if(isset($_GET["cerrar"])) {
    $controlador->cerrar();
}

require_once("usuario_forms/usuario_login.php");
require_once("usuario_forms/usuario_registrar.php");
require_once("usuario_forms/usuario_modificar.php");
require_once("usuario_forms/usuario_eliminar.php");
require_once("usuario_forms/usuario_cambiapass.php");
?>

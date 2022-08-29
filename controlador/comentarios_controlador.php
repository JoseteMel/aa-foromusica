<?php

require_once("../modelo/comentarios_modelo.php");

class comentarios_controlador {
    public function __construct(){}

    public function registrar($comentario){
        return comentarios_modelo::registrar($comentario);
    }

    public function eliminar($id){
        return comentarios_modelo::eliminar($id);
    }

    public function editar($comentario) {
        return comentarios_modelo::editar($comentario);
    }
}

$campo=null;
$validacion=true;
$controlador = new Comentarios_Controlador();

require_once("comentario_forms/comentario.php");
require_once("comentario_forms/comentario_eliminar.php");
require_once("comentario_forms/comentario_editar.php");
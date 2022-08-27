<?php
require_once("../modelo/temas_modelo.php");

class temas_controlador
{
    public function __construct(){}

    public function registrar($tema){
        return temas_modelo::registrar($tema);
    }

    public function editar($tema){
        return temas_modelo::editar($tema);
    }

    public function eliminar($id){
        return temas_modelo::eliminar($id);
    }
}

$campo=null;
$validacion=true;
$controlador = new Temas_Controlador();

require_once("tema_forms/crear_tema.php");
require_once("tema_forms/editar_tema.php");
require_once("tema_forms/eliminar_tema.php");
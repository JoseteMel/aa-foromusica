<?php
require_once("conexion/conexion.php");

class temas_modelo {
    public $id;
    public $titulo;
    public $user_id;
    public $texto;

    function __construct($id, $titulo, $user_id, $texto) {

        $this->id = $id;
        $this->titulo = $titulo;
        $this->user_id = $user_id;
        $this->texto = $texto;
    }

    public static function registrar($tema) {
        try {
            $conexion = Conectar::Conexion();
            if(gettype($conexion) == "string") {
                return $conexion;
            }

            $sql = "INSERT INTO TEMAS (TITULO, ID_USUARIO, TEXTO, FECHA) VALUES (:TIT, :USE, :TEX, :DAT)";
            $respuesta = $conexion->prepare($sql);
            return $respuesta->execute(array(":TIT"=>$tema->titulo, ":USE"=>$tema->user_id, ":TEX"=>$tema->texto,
                ":DAT"=>date("Y-m-d")));

            $respuesta->closeCursor();
            $conexion = null;

        } catch(PDOException $e) {
            return Conectar::mensajes($e->getCode());
        }
    }

    public static function editar($tema) {
        try {
            $conexion = Conectar::Conexion();
            if(gettype($conexion) == "string") {
                return $conexion;
            }

            $sql = "UPDATE TEMAS SET TITULO = :TIT, TEXTO = :TEX WHERE ID = :ID";
            $respuesta = $conexion->prepare($sql);
            return $respuesta->execute(array("TIT"=>$tema->titulo, ":TEX"=>$tema->texto, ":ID"=>$tema->id));

            $respuesta->closeCursor();
            $conexion = null;

        } catch(PDOException $e) {
            return Conectar::mensajes($e->getCode());
        }
    }

    public static function eliminar($id) {
        try {
            $conexion = Conectar::Conexion();
            if(gettype($conexion) == "string") {
                return $conexion;
            }

            $sql = "DELETE FROM TEMAS WHERE ID = :ID";
            $respuesta = $conexion->prepare($sql);
            return $respuesta->execute(array(":ID"=>$id));

            $respuesta->closeCursor();
            $conexion = null;

        } catch(PDOException $e) {
            return Conectar::mensajes($e->getCode());
        }
    }
}
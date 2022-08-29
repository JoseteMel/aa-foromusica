<?php

require_once("conexion/conexion.php");

class comentarios_modelo {
    public $id;
    public $text;
    public $user_id;
    public $tema_id;

    public function __construct($id, $text, $user_id, $tema_id) {
        $this->id = $id;
        $this->text = $text;
        $this->user_id = $user_id;
        $this->tema_id = $tema_id;
    }

    public static function registrar($comentario) {
        try {
            $conexion = Conectar::Conexion();
            if(gettype($conexion) == "string") {
                return $conexion;
            }

            $sql = "INSERT INTO COMENTARIOS (TEXTO, ID_USUARIO, ID_TEMA, FECHA) VALUES (:TEX, :USE, :TEM, :DAT)";
            $respuesta = $conexion->prepare($sql);
            return $respuesta->execute(array(":TEX"=>$comentario->text, ":USE"=>$comentario->user_id,
                ":TEM"=>$comentario->tema_id, ":DAT"=>date("Y-m-d")));

            $respuesta->closeCursor();
            $conexion = null;

        } catch(PDOException $e) {
            return Conectar::mensajes($e->getCode());
        }
    }

    public static function editar($comentario) {
        try {
            $conexion = Conectar::Conexion();
            if(gettype($conexion) == "string") {
                return $conexion;
            }

            $sql = "UPDATE COMENTARIOS SET TEXTO = :TEX WHERE ID = :ID";
            $respuesta = $conexion->prepare($sql);
            return $respuesta->execute(array(":TEX"=>$comentario->text, ":ID"=>$comentario->id));

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

            $sql = "DELETE FROM COMENTARIOS WHERE ID = :ID";
            $respuesta = $conexion->prepare($sql);
            return $respuesta->execute(array(":ID"=>$id));

            $respuesta->closeCursor();
            $conexion = null;

        } catch(PDOException $e) {
            return Conectar::mensajes($e->getCode());
        }
    }
}
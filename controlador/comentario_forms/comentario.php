<?php

if(isset($_POST["nuevo_comentario"])) {
    if (!($_POST["text"] == "")) {
        $comentario = new comentarios_modelo(0, $_POST["text"], $_SESSION["ID"], $_POST["tema_id"]);
        $controlador = new comentarios_controlador();
        $respuesta = $controlador->registrar($comentario);

        if(gettype($respuesta) == "string") {
            echo "Se ha producido un error";

        } else {
            echo "Se ha registrado el comentario";
        }
    }
}
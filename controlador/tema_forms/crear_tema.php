<?php

if(isset($_POST["nuevo_tema"])) {
    if ($_POST["title"] == "") {
        echo "<p class='error-form'>El título del tema no puede estar vacío.</p>";
    } elseif ($_POST["comentario"] == "") {
        echo "<p class='error-form'>Debes escribir el comentario.</p>";
    }
    else {
        $tema = new temas_modelo(0, $_POST["title"], $_SESSION["ID"], $_POST["comentario"]);
        $controlador = new temas_controlador();
        $respuesta = $controlador->registrar($tema);

        if (gettype($respuesta) == "string") {
            echo "Se ha producido un error";
        } else {
            echo "Se ha registrado el tema";
        }

        header("Location:foro.php");
    }
}
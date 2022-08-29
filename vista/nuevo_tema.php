<?php session_start();
include("../header.php");

if(!isset($_SESSION["USUARIO"])) {
    header("Location:login.php");
} else {

}?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Nuevo tema</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>

<body>
    <section id="formaulario">
        <div id="recuadro">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <?php require_once("../controlador/temas_controlador.php");?>

                <h2 class="title-form">Crea un nuevo tema</h2>

                <div class="div-input">
                    <input type="text" class="input_titulo" name="title" placeholder="Título del tema" value="">
                    <textarea name="comentario" placeholder="Escribe tu comentario"></textarea>
                </div>
                <input type="submit" class="boton" name="nuevo_tema" value="Crear tema">

            </form>
        </div>
    </section>
</body>
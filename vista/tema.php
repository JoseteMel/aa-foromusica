<?php session_start();
require_once("../controlador/usuarios_controlador.php");
require_once("../controlador/comentarios_controlador.php");
require_once("../controlador/temas_controlador.php");
require_once("../modelo/conexion/db.php")
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Foro</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>

<body>
<header>
    <nav>
        <label for="check-menu">
            <input id="check-menu" type="checkbox">
            <div class="btn-menu">Menú</div>
            <ul class="ul-menu">
                <li><a href="foro.php">Inicio</a></li>
                <?php
                if (isset($_SESSION["USUARIO"])) {
                    ?><li><a href="perfil.php">Mi perfil</a></li>
                    <li><a href="?cerrar">Cerrar sesión</a></li><?php
                } else {
                    ?><li><a href="login.php">Iniciar sesión</a></li>
                    <li><a href="login.php<?php echo '?registrar'; ?>">Registrarse</a></li><?php
                }
                ?>
            </ul>
        </label>
    </nav>
</header>
<section>
    <?php
    $conn = new mysqli(HOST, USER, PASS, DBNAME);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $id = $_GET['pid'];

    $sql = "SELECT t.ID, t.TITULO, t.TEXTO, t.ID_USUARIO, t.FECHA, u.USUARIO FROM temas t INNER JOIN usuarios u ON 
        t.ID_USUARIO = u.ID WHERE t.ID = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_array(); ?>
    <div class="titulo_tema"><h4 id="titulo<?php echo $row["ID"]?>"><?php echo $row["TITULO"]?></h4></div>
    <div class="comentario">
        <?php
        if(isset($_SESSION["USUARIO"])) {
            if ($row["ID_USUARIO"] == $_SESSION["ID"]) { ?>
                <div class="botones">
                    <form action="tema.php?pid=<?php echo $id;?>" method="post">
                        <input type="hidden" name="id" value="<?php echo $row["ID"]?>">
                        <input id="edit" type='button' value='Editar' class="boton" onclick="editarTema(this,
                            <?php echo $row["ID"]?>)">
                    </form>
                    <form action="foro.php" method="post">
                        <input type="hidden" name="idTema" value="<?php echo $row["ID"]?>">
                        <input id="eliminarTema<?php echo $row["ID"]?>" type='submit' name='eliminar_tema'
                               value='Eliminar' class="boton">
                    </form>
                </div>
                <form action="tema.php?pid=<?php echo $id;?>" method="post">
                    <input type="hidden" name="idTema" value="<?php echo $row["ID"]?>">
                    <input id="submitTema<?php echo $row["ID"]?>" style="display:none" type='submit' name='editar_tema'
                           value='Confirmar' class="boton">
                    <input id="inputTitulo<?php echo $row["ID"]?>" style="display:none" class="input_titulo" type="text"
                           maxlength="80" name="titulo" value="<?php echo $row["TITULO"];?>">
                    <textarea id="inputTema<?php echo $row["ID"]?>" style="display:none" maxlength="500" name="textTema">
                        <?php echo $row["TEXTO"];?></textarea>
                </form>
            <?php }
        } ?>
        <p id="<?php echo $row["ID"]?>"><?php echo $row["TEXTO"];?></p>
        <h5>Publicado por <?php echo $row["USUARIO"]. ", " .$row["FECHA"]?></h5>
    </div>
    <?php
    $sql = "SELECT c.ID, c.TEXTO, c.ID_USUARIO, c.FECHA, u.USUARIO FROM comentarios c INNER JOIN usuarios u ON 
        c.ID_USUARIO = u.ID WHERE ID_TEMA = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_array()) { ?>
            <div class='comentario'>
                <?php
                if(isset($_SESSION["USUARIO"])) {
                    if ($row["ID_USUARIO"] == $_SESSION["ID"]) { ?>
                        <div class="botones">
                            <form action="tema.php?pid=<?php echo $id;?>" method="post">
                                <input type="hidden" name="id" value="<?php echo $row["ID"]?>">
                                <input id="edit" type='button' value='Editar' class="boton"
                                       onclick="editar(this, <?php echo $row["ID"]?>)">
                            </form>
                            <form action="tema.php?pid=<?php echo $id;?>" method="post">
                                <input type="hidden" name="id" value="<?php echo $row["ID"]?>">
                                <input id="eliminar<?php echo $row["ID"]?>" type='submit' name='eliminar_comentario'
                                       value='Eliminar' class="boton">
                            </form>
                        </div>
                        <form action="tema.php?pid=<?php echo $id;?>" method="post">
                            <input type="hidden" name="id" value="<?php echo $row["ID"]?>">
                            <input id="submit<?php echo $row["ID"]?>" style="display:none" type='submit'
                                   name='editar_comentario' value='Confirmar' class="boton">
                            <textarea id="input<?php echo $row["ID"]?>" style="display:none" maxlength="500"
                                      name="text"><?php echo $row["TEXTO"];?></textarea>
                        </form>
                    <?php }
                } ?>
                <p id="comentario<?php echo $row["ID"]?>"><?php echo $row["TEXTO"];?></p>
                <h5>Publicado por <?php echo $row["USUARIO"]. ", " .$row["FECHA"]?></h5>
            </div>
        <?php }
    }

    $conn->close();

    if(isset($_SESSION["USUARIO"])){ ?>
        <div id="recuadro">
            <form action="tema.php?pid=<?php echo $id;?>" method="post">
                <h3 class="title-form">Añade tu comentario</h3>
                <div class="div-input">
                    <textarea class="comment-form" name="text"></textarea>
                    <input type="hidden" name="tema_id" value="<?php echo $id ?>">
                </div>
                <input type="submit" class="boton" name="nuevo_comentario" value="Comentar">
            </form>
        </div>
    <?php } ?>
</section>
</body>

<script>
    function editar(button, id) {
        button.style.display = "none";
        var comentario = document.getElementById("comentario" + id);
        comentario.style.display = "none";
        var inputComentario = document.getElementById("input" + id);
        inputComentario.style.display = "block";
        var confirmar = document.getElementById("submit" + id);
        confirmar.style.display = "block";
        var eliminar = document.getElementById("eliminar" + id);
        eliminar.style.display = "none";
    }

    function editarTema(button, id) {
        button.style.display = "none";
        var inputTitulo = document.getElementById("inputTitulo" + id);
        inputTitulo.style.display = "block";
        var comentario = document.getElementById(id);
        comentario.style.display = "none";
        var inputComentario = document.getElementById("inputTema" + id);
        inputComentario.style.display = "block";
        var confirmar = document.getElementById("submitTema" + id);
        confirmar.style.display = "block";
        var eliminar = document.getElementById("eliminarTema" + id);
        eliminar.style.display = "none";
    }
</script>

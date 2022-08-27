<?php session_start();
require_once("../controlador/usuarios_controlador.php");
require_once("../controlador/temas_controlador.php");
require_once("../modelo/conexion/db.php")
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Foro Música</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>

<body>
<header>
    <nav>
        <label for="check-menu">
            <input id="check-menu" type="checkbox">
            <div class="btn-menu">Menú</div>
            <ul class="ul-menu">
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
    if (isset($_SESSION["USUARIO"])) { ?>
        <input id="nuevo_tema" type="submit" value="NUEVO TEMA" onclick="window.location='nuevo_tema.php';">
    <?php }
    $conn = new mysqli(HOST, USER, PASS, DBNAME);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT t.ID, t.TITULO, t.FECHA, u.USUARIO FROM temas t INNER JOIN usuarios u ON t.ID_USUARIO = u.ID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_array()) { ?>
            <a href='tema.php?pid=<?php echo $row[0]?>'>
                <div class='tema'><h3><?php echo $row["TITULO"]?></h3>
                    <h5>Creado por <?php echo $row["USUARIO"]. ", " .$row["FECHA"]?></h5></div>
            </a>
        <?php }
    } else {
        echo "<br>Todavía no hay ningún tema creado. Inicia sesión y ¡sé el primero en crear uno!";
    }
    $conn->close();
    ?>
</section>
</body>
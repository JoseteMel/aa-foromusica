<header>
    <h1><a href="../index.php" style="color: #f1f1f1">Foro Música</a></h1>
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
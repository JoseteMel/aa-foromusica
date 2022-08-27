<?php

class Conectar{

    public static function Conexion() {
        try {
            if(file_exists("../modelo/conexion/basededatos.php") || file_exists("modelo/conexion/basededatos.php")) {
                require_once("basededatos.php");
                $conexion = new PDO("mysql:host=".HOST."; dbname=".DBNAME,USER,PASS);
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conexion->exec("SET CHARACTER SET utf8");
                return $conexion;
            } else {
                return "<p class='warning-form'>No se ha podido acceder a la base de datos por un problema en la
                            configuracción de acceso.</p>";
            }
        } catch(PDOException $e) {
            return self::mensajes($e->getCode());
        }
    }

    public static function Pruebaconexion() {
        try {
            require_once("db.php");
            $conexion = new PDO("mysql:host=".HOST,USER,PASS);
            return $conexion;
        } catch(PDOException $e) {
            return self::mensajes($e->getCode());
        }

    }

    public static function mensajes($e) {
        switch($e) {
            case "2002":
                if(file_exists("modelo/conexion/basededatos.php")) {
                    return "<p class='error-form'>¡¡Error!! El host no es correcto: (" . $e.")</p>";
                } else {
                    return "<p class='warning-form'>No se ha podido acceder a la base de datos por un problema en la
                                configuracción de acceso.</p>";
                }
                break;
            case "1049":
                return "<p class='error-form'>¡¡Error!! No se encuentra la Base de datos: (" . $e.")</p>";
                break;
            case "1045":
                return "<p class='error-form'>¡¡Error!! El usuario y/o contraseña son incorrectos: (" . $e.")</p>";
                break;
            case "42000":
                return "<p class='error-form'>¡¡Error!! El usuario y/o contraseña son incorrectos: (" . $e.")</p>";
                break;
            case "42S02":
                return "<p class='error-form'>¡¡Error!! No se encuentra la tabla en la base de datos: (" . $e.")</p>";
                break;
            case "23000":
                return "<p class='error-form'>Ya existe el usuario o el email introducido: (" . $e.")</p>";
                break;
            default:
                return "<p class='error-form'>ERROR INESPERADO ".$e."</p>";
        }
    }
}

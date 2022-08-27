<?php
require_once("conexion/conexion.php");

class Usuarios_modelo {
    public $alias;
    public $nombre;
    public $apellido;
    public $email;
    public $id;

    function __construct($alias,$nombre, $apellido, $email, $id) {

        $this->alias = $alias;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->id = $id;
    }

    public static function get_usuario($alias, $password) {
        try {
            $password = self::cryptconmd5($password);
            $conexion = Conectar::Conexion();

            if(gettype($conexion) == "string") {
                return $conexion;
            }

            $sql = "SELECT USUARIO, NOMBRE, APELLIDO, EMAIL, ID FROM USUARIOS WHERE USUARIO=:usuario AND PASSWORD=:password";
            $respuesta = $conexion->prepare($sql);
            $respuesta->execute(array(':usuario'=>$alias, ':password'=>$password));
            $respuesta = $respuesta->fetch(PDO::FETCH_ASSOC);

            if($respuesta) {
                $usuario = new Usuarios_modelo($respuesta["USUARIO"], $respuesta["NOMBRE"], $respuesta["APELLIDO"],
                    $respuesta["EMAIL"], $respuesta["ID"]);
                return $usuario;
            } else {
                return $usuario = null;
            }

            $respuesta->closeCursor();
            $conexion = null;

        } catch(PDOException $e) {
            return Conectar::mensajes($e->getCode());
        }
    }

    public static function registrar($usuario, $password) {
        try {
            $password = self::cryptconmd5($password);
            $conexion = Conectar::Conexion();
            if(gettype($conexion) == "string") {
                return $conexion;
            }

            $sql = "INSERT INTO USUARIOS (USUARIO, NOMBRE, APELLIDO, EMAIL, PASSWORD) VALUES (:USU, :NOM, :APE, :EMAIL, :PASS)";
            $respuesta = $conexion->prepare($sql);
            $respuesta = $respuesta->execute(array(":USU"=>$usuario->alias, ":NOM"=>$usuario->nombre,
                ":APE"=>$usuario->apellido, ":EMAIL"=>$usuario->email, ":PASS"=>$password));
            return $respuesta;

            $respuesta->closeCursor();
            $conexion = null;

        } catch(PDOException $e) {
            return Conectar::mensajes($e->getCode());
        }
    }

    public static function actualizar($usuario, $password) {
        try {
            $password = self::cryptconmd5($password);
            $sql= 'UPDATE USUARIOS SET NOMBRE=:NOM, APELLIDO=:APE, EMAIL=:EMAIL WHERE USUARIO=:USU AND PASSWORD=:PASS';
            $conexion = Conectar::Conexion();
            if(gettype($conexion) == "string") {
                return $conexion;
            }

            $conexion =$conexion->prepare($sql);
            $conexion->execute(array(":NOM"=>$usuario->nombre, ":APE"=>$usuario->apellido, ":EMAIL"=>$usuario->email,
                ":USU"=>$usuario->alias, ":PASS"=>$password));
            return $respuesta = $conexion->rowCount();

            $respuesta->closeCursor();
            $conexion = null;

        } catch(PDOException $e) {
            return Conectar::mensajes($e->getCode());
        }
    }

    public static function cambiapass($alias, $password_actual, $password_nuevo) {

        try {
            $password_nuevo = self::cryptconmd5($password_nuevo);
            $usuario = self::get_usuario($alias, $password_actual);

            if(gettype($usuario) == "string") {
                return $usuario;
            } elseif($usuario == null) {
                return '<p class="error-form">Contraseña incorrecta.</p>';
            }

            $sql= 'UPDATE USUARIOS SET PASSWORD=:PASSNUEVO WHERE USUARIO=:USU AND PASSWORD=:PASS';
            $conexion = Conectar::Conexion();
            if(gettype($conexion) == "string"){
                return $conexion;
            }

            $conexion =$conexion->prepare($sql);
            $password_actual = self::cryptconmd5($password_actual);
            $conexion->execute(array(":PASSNUEVO"=>$password_nuevo,":USU"=>$usuario->alias, ":PASS"=>$password_actual));

            return $respuesta = $conexion->rowCount();

            $respuesta->closeCursor();
            $conexion = null;
        } catch(PDOException $e) {
            return Conectar::mensajes($e->getCode());
        }
    }

    public static function eliminar($alias, $password) {
        try {
            $password = self::cryptconmd5($password);
            $sql= 'DELETE FROM USUARIOS WHERE USUARIO=:USU AND PASSWORD=:PASS';
            $conexion = Conectar::Conexion()->prepare($sql);
            $conexion->execute(array(":USU"=>$alias, ":PASS"=>$password));

            return $respuesta = $conexion->rowCount();

            $respuesta->closeCursor();
            $conexion = null;
        } catch(PDOException $e) {
            return Conectar::mensajes($e->getCode());
        }
    }

    public static function cryptconmd5($password) {
        $salt = md5($password."%*4!#$;.k~’(_@");
        $password = md5($salt.$password.$salt);
        return $password;
    }
}
?>
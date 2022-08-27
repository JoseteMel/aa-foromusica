-- Crea la base de datos si no existe
CREATE DATABASE IF NOT EXISTS foromusica DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE foromusica;

-- Crea la tabla de Comentarios

CREATE TABLE comentarios (
    id int(10) NOT NULL AUTO_INCREMENT,
    texto varchar(255) COLLATE utf8_spanish_ci NOT NULL,
    id_usuario int(11) NOT NULL,
    id_tema int(8) NOT NULL,
    fecha date NOT NULL,
    PRIMARY KEY (id),
    KEY id_usuario (id_usuario),
    KEY id_tema (id_tema)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Crea la tabla de Temas
CREATE TABLE temas (
    id int(8) NOT NULL AUTO_INCREMENT,
    titulo varchar(80) COLLATE utf8_spanish_ci NOT NULL,
    id_usuario int(11) NOT NULL,
    texto varchar(255) COLLATE utf8_spanish_ci NOT NULL,
    fecha date NOT NULL,
    PRIMARY KEY (id),
    KEY id_usuario (id_usuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Crea tabla para Usuarios
CREATE TABLE usuarios (
    id int(8) NOT NULL AUTO_INCREMENT,
    usuario varchar(30) COLLATE utf8_spanish_ci NOT NULL,
    nombre varchar(30) COLLATE utf8_spanish_ci NOT NULL,
    apellido varchar(30) COLLATE utf8_spanish_ci NOT NULL,
    email varchar(255) COLLATE utf8_spanish_ci NOT NULL,
    password varchar(255) COLLATE utf8_spanish_ci NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY usuario (usuario),
    UNIQUE KEY email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Vinculación de la tabla de Comentarios con Temas
ALTER TABLE comentarios ADD CONSTRAINT comentarios_temas FOREIGN KEY (id_tema) REFERENCES temas (id) ON DELETE CASCADE;

-- Vinculación de la tabla de Comentarios con Usuarios
ALTER TABLE comentarios ADD CONSTRAINT comentarios_usuarios FOREIGN KEY (id_usuario) REFERENCES usuarios (id) ON DELETE CASCADE;

-- Vinculación de la tabla de Temas con Usuarios
ALTER TABLE temas ADD CONSTRAINT temas_usuarios FOREIGN KEY (id_usuario) REFERENCES usuarios (id) ON DELETE CASCADE;

-- Confirma los cambios y los guarda
COMMIT;
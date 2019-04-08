DROP DATABASE IF EXISTS almazara;
CREATE DATABASE almazara;
USE almazara;

CREATE TABLE proveedores (
    id_proveedor INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL, 
    apellido1 VARCHAR(50) NOT NULL,
    apellido2 VARCHAR(50) NOT NULL,
    dni VARCHAR(9) NOT NULL,
    telf VARCHAR(9) NOT NULL
);

/* Las aportaciones de cada proveedor, por defecto el valor ecologico será false */
CREATE TABLE aportacion (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    dni_proveedor VARCHAR(9) NOT NULL,
    id_variedad INT UNSIGNED NOT NULL,
    id_localidad INT UNSIGNED NOT NULL,
    kilos INT UNSIGNED NOT NULL,
    eco VARCHAR(1) not null,
    fecha DATE not null
);

CREATE TABLE localidad (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    localidad VARCHAR(100) NOT NULL
);

/* Almacena los distintas variedades con un ID */
CREATE TABLE variedad (
    id TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    variedad VARCHAR(50) NOT NULL
);

/* Un bidon solo puede almacenar una variedad de aceite */
CREATE TABLE bidon (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    litros_max INT UNSIGNED NOT NULL DEFAULT 550000,
    litros_almacenados INT UNSIGNED NOT NULL DEFAULT 0,
    id_variedad TINYINT UNSIGNED NOT NULL,
    eco VARCHAR(1) NOT NULL
);

INSERT INTO bidon VALUES (null, 55000,0,1,1),(null, 55000,0,1,0),(null, 55000,0,2,1),(null, 55000,0,2,0),(null, 55000,0,3,1),(null, 55000,0,3,0);

/* Una tolva solo puede almacenar una variedad de aceituna 
CREATE TABLE tolva (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    kilos_maximos INT UNSIGNED NOT NULL,
    kilos_almacenados INT UNSIGNED NOT NULL,
    variedad TINYINT UNSIGNED NOT NULL
);
*/

/* En un bidon se almacenan N lotes de aceite pero de la misma variedad de aceituna */
CREATE TABLE bidon_almacena_aceite (
    id_bidon INT UNSIGNED NOT NULL,
    id_aceite INT UNSIGNED NOT NULL,
    litros_almacenados INT UNSIGNED NOT NULL
);

/* Del aceite almacenamos la acidez *(una unica acidez), los litros, y la variedad */
CREATE TABLE aceite (
    id_aceite INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_aportacion INT NOT NULL,
    litros INT UNSIGNED NOT NULL,
    id_variedad TINYINT UNSIGNED NOT NULL,
    eco VARCHAR(1) NOT NULL
);

CREATE TABLE usuarios (
    id int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username varchar(20) not null,
    passwd varchar(255) not null,
    nivel varchar(3)  not null
);

INSERT INTO usuarios (id,username,passwd,nivel) VALUES (null,'admin','$2y$10$gCkJrQW6y81UCzNEo3pxNO4uD0Y9zCOij901viKDLUEYxYM8Gsprq','2');
DROP TABLE variedad;
DROP TABLE localidad;

CREATE TABLE localidad (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    localidad VARCHAR(100) NOT NULL
);

/* Almacena los distintas variedades con un ID */
CREATE TABLE variedad (
    id TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    variedad VARCHAR(50) NOT NULL
);

INSERT INTO variedad (id, variedad) VALUES 
(null,'Picual'),
(null,'Arbequina'),
(null,'Blanqueta');


INSERT INTO localidad (id, localidad) VALUES 
(null,'Albox'),
(null,'Almería'),
(null,'Arboleas'),
(null,'Cantoria'),
(null,'Chirivel'),
(null,'El Ejido');



CREATE TABLE IF NOT EXISTS `ci_sessions` (
        `id` varchar(128) NOT NULL,
        `ip_address` varchar(45) NOT NULL,
        `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
        `data` blob NOT NULL,
        KEY `ci_sessions_timestamp` (`timestamp`)
);

/*
CREATE TABLE aportacion_tolva (
    id_aportacion INT UNSIGNED NOT NULL,
    id_tolva TINYINT UNSIGNED NOT NULL
);
*/
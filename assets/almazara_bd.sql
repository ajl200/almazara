DROP DATABASE IF EXISTS almazara;
CREATE DATABASE almazara;
USE almazara;

CREATE TABLE proveedores (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL, 
    apellido1 VARCHAR(50) NOT NULL,
    apellido2 VARCHAR(50) NOT NULL,
    dni VARCHAR(9) NOT NULL,
    telf INT UNSIGNED NOT NULL
);

/* Almacena los distintas variedades con un ID */
CREATE TABLE aceituna (
    id TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    variedad VARCHAR(20) NOT NULL
);

/* Las aportaciones de cada proveedor, por defecto el valor ecologico será false */
CREATE TABLE proveedor_aportacion (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_proveedor INT UNSIGNED NOT NULL,
    id_variedad INT UNSIGNED NOT NULL,
    kilos INT UNSIGNED NOT NULL,
    localidad INT UNSIGNED NOT NULL,
    ecologico BOOLEAN
);


CREATE TABLE localidad (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    localidad VARCHAR(100) NOT NULL
);

/* Un bidon solo puede almacenar una variedad de aceite */
CREATE TABLE bidon (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    litros_maximos INT UNSIGNED NOT NULL,
    litros_almacenados INT UNSIGNED NOT NULL,
    variedad TINYINT UNSIGNED NOT NULL
);

/* Una tolva solo puede almacenar una variedad de aceituna */
CREATE TABLE tolva (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    kilos_maximos INT UNSIGNED NOT NULL,
    kilos_almacenados INT UNSIGNED NOT NULL,
    variedad TINYINT UNSIGNED NOT NULL
);

/* En un bidon se almacenan N lotes de aceite pero de la misma variedad de aceituna */
CREATE TABLE bidon_almacena (
    id_bidon INT UNSIGNED,
    id_aceite INT UNSIGNED,
    variedad TINYINT UNSIGNED
);

/* Del aceite almacenamos la acidez *(una unica acidez), los litros, y la variedad */
CREATE TABLE aceite (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    acidez INT UNSIGNED NOT NULL,
    litros INT UNSIGNED NOT NULL,
    variedad TINYINT UNSIGNED NOT NULL
);

/* El aceite se crea mediante N aportaciones del mismo tipo de variedad */
CREATE TABLE aceite_aportacion (
    id_aceite INT UNSIGNED NOT NULL,
    id_aportacion INT UNSIGNED NOT NULL
);

CREATE TABLE usuarios (
    id int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username varchar(50) not null,
    passwd varchar(255) not null,
    nivel varchar(3)  not null
);

INSERT INTO usuarios (id,username,passwd,nivel) VALUES (null,'admin','$2y$10$gCkJrQW6y81UCzNEo3pxNO4uD0Y9zCOij901viKDLUEYxYM8Gsprq','2');
INSERT INTO aceituna (id,variedad) VALUES (null,'Picual'),
(null,'Arbequina'),(null,'Blanqueta'),
(null,'Cornicabra'), 
(null,'Royal'),(null,'Lechín de Sevilla'),
(null,'Lechín de Granada'),
(null,'Morisca'), (null,'Alfafara'),
(null,'Verdial de Badajoz');

INSERT INTO localidad (id,localidad) VALUES (null,'Albox'),
(null,'Almería'),
(null,'Antas'),
(null,'Arboleas'),
(null,'Bacares'),
(null,'Benahadux'),
(null,'Cantoria'),
(null,'Chirivel'),
(null,'El Ejido'),
(null,'Los Gayardos'),
(null,'Macael'),
(null,'Oria'),
(null,'Olula del Rio'),
(null,'Sorbas'),
(null,'Taberno'),
(null,'Zurgena');



CREATE TABLE IF NOT EXISTS `ci_sessions` (
        `id` varchar(128) NOT NULL,
        `ip_address` varchar(45) NOT NULL,
        `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
        `data` blob NOT NULL,
        KEY `ci_sessions_timestamp` (`timestamp`)
);

CREATE TABLE aportacion_tolva (
    id_aportacion INT UNSIGNED NOT NULL,
    id_tolva TINYINT UNSIGNED NOT NULL
);
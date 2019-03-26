DROP DATABASE almazara;
CREATE DATABASE almazara;
USE almazara;

CREATE TABLE proveedor (
    id INT UNSIGNED PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL, 
    apellido1 VARCHAR(50) NOT NULL,
    apellido2 VARCHAR(50) NOT NULL,
    dni VARCHAR(9) NOT NULL,
    telf TINYINT(9) UNSIGNED NOT NULL
);

test 

CREATE TABLE aceituna (
    id INT UNSIGNED PRIMARY KEY,
    variedad VARCHAR(20) NOT NULL
);

CREATE TABLE proveedor_aportacion (
    id INT UNSIGNED PRIMARY KEY,
    id_proveedor INT UNSIGNED NOT NULL,
    id_variedad INT UNSIGNED NOT NULL,
    kilos INT UNSIGNED NOT NULL,
    ecologico BOOLEAN
    
);
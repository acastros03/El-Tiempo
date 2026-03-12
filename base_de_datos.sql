CREATE DATABASE IF NOT EXISTS el_tiempo;
USE el_tiempo;

CREATE TABLE IF NOT EXISTS ciudades (
    id     INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255),
    pais   VARCHAR(10),
    lat    DECIMAL(9,6),
    lon    DECIMAL(9,6)
);

CREATE TABLE IF NOT EXISTS consultas (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    ciudad_id  INT,
    tipo       VARCHAR(20),
    fecha      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ciudad_id) REFERENCES ciudades(id)
);

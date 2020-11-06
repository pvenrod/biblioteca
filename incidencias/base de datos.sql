CREATE DATABASE incidencias CHARACTER SET utf8mb4;

USE incidencias;

CREATE TABLE usuarios (
    id INT PRIMARY KEY,
    usuario VARCHAR(50),
    email VARCHAR(70),
    contrasenya VARCHAR(50),
    foto VARCHAR(100),
    rol VARCHAR(20)
);

CREATE TABLE incidencias (
    id INT PRIMARY KEY,
    fecha DATETIME,
    lugar VARCHAR(50),
    equipo VARCHAR(50),
    descripcion VARCHAR(200),
    observaciones VARCHAR(200),
    usuario INT,
    estado ENUM("ABIERTA","EN ESPERA","CERRADA"),
    prioridad ENUM("MAXIMA","ALTA","BAJA","NADA")
);
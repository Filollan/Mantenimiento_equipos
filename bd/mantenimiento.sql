-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-04-2024 a las 04:33:18
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mantenimientos`
--

-- Estructura de tabla para la tabla `sedes`

CREATE TABLE sedes (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    nombre VARCHAR(255) NOT NULL
);

-- --------------------------------------------------------

-- Estructura de tabla para la tabla `salas`

CREATE TABLE salas (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    id_sedes INT NOT NULL,
    FOREIGN KEY (id_sedes) REFERENCES sedes(id)
);

-- --------------------------------------------------------

-- Estructura de tabla para la tabla `marcas`

CREATE TABLE marcas (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    nombre VARCHAR(255) NOT NULL
);

-- --------------------------------------------------------


-- Estructura de tabla para la tabla `equipos`

CREATE TABLE equipos (
    id_equipo INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    tipo VARCHAR(255) NOT NULL,
    codigo varchar(100) NOT NULL,
    id_marca INT NOT NULL,
    id_sala INT NOT NULL,
    fechaingreso DATE NOT NULL,
    estado int(11) NOT NULL DEFAULT '1',
    FOREIGN KEY (id_marca) REFERENCES marcas(id),
    FOREIGN KEY (id_sala) REFERENCES salas(id)
);

-- --------------------------------------------------------

-- Estructura de tabla para la tabla `monitores`

CREATE TABLE monitores (
    id INT  AUTO_INCREMENT PRIMARY KEY NOT NULL,
    nombre VARCHAR(255) NOT NULL
);

-- --------------------------------------------------------

-- Estructura de tabla para la tabla `mantenimientos`

CREATE TABLE mantenimientos (
    id_mantenimiento INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    tipo_mantenimiento VARCHAR(255) NOT NULL,
    problema VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    fechainicio DATE NOT NULL,
    fechafin DATE NOT NULL,
    id_equipo INT NOT NULL,
    quien_cc INT NOT NULL,
    FOREIGN KEY (id_equipo) REFERENCES equipos(id),
    FOREIGN KEY (quien_cc) REFERENCES monitores(id)
);


-- Insertar datos en la tabla `sedes`
INSERT INTO sedes (nombre) VALUES ('Sede Obando'), ('Sede Encarnacion'), ('Sede Bicentenerio');

-- Insertar datos en la tabla `salas`
INSERT INTO salas (nombre, id_sedes) VALUES
('Sala 101', 1),
('Sala 102', 1),
('Sala 201', 2),
('Sala 202', 2),
('Sala 301', 3),
('Sala 302', 3);

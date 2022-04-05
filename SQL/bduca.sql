-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-04-2022 a las 09:52:24
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bduca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntaexamen`
--

CREATE TABLE `preguntaexamen` (
  `id_examen` tinyint(3) UNSIGNED NOT NULL,
  `id_pregunta` tinyint(3) UNSIGNED NOT NULL,
  `respuesta` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `preguntaexamen`
--

INSERT INTO `preguntaexamen` (`id_examen`, `id_pregunta`, `respuesta`) VALUES
(3, 1, '1'),
(3, 2, '4');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `preguntaexamen`
--
ALTER TABLE `preguntaexamen`
  ADD PRIMARY KEY (`id_examen`,`id_pregunta`),
  ADD KEY `id_pregunta` (`id_pregunta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

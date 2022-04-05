-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-04-2022 a las 17:11:54
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
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `id_alumno` tinyint(3) UNSIGNED NOT NULL,
  `id_usuario` tinyint(3) UNSIGNED NOT NULL,
  `id_asignatura` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id_alumno`, `id_usuario`, `id_asignatura`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `id_asig` tinyint(3) UNSIGNED NOT NULL,
  `id_profesor` tinyint(3) UNSIGNED NOT NULL,
  `nombre_asig` varchar(50) NOT NULL,
  `id_grado` int(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`id_asig`, `id_profesor`, `nombre_asig`, `id_grado`) VALUES
(1, 1, 'POO', 1),
(2, 2, 'PW', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bateriapreguntas`
--

CREATE TABLE `bateriapreguntas` (
  `id_pregunta` tinyint(3) UNSIGNED NOT NULL,
  `id_tema` tinyint(3) UNSIGNED NOT NULL,
  `pregunta` varchar(1000) NOT NULL,
  `opcion1` varchar(500) NOT NULL,
  `opcion2` varchar(500) NOT NULL,
  `opcion3` varchar(500) NOT NULL,
  `opcion4` varchar(500) NOT NULL,
  `correcta` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `bateriapreguntas`
--

INSERT INTO `bateriapreguntas` (`id_pregunta`, `id_tema`, `pregunta`, `opcion1`, `opcion2`, `opcion3`, `opcion4`, `correcta`) VALUES
(1, 4, '¿Qué significan las siglas MVC?', 'Modelo-Vista-Controlador', 'Maquina-Virtual-Controlada', 'Modelo-Virtual-Condicionada', 'Maquina-Vista-Controlador', '1'),
(2, 4, '¿Cuáles de estas carpetas no pertenecen a los proyectos en Laravel?', 'app', 'config', 'database', 'debug', '4'),
(3, 4, '¿Dónde se definen las rutas de nuestra aplicación en Laravel?', 'main/web.php', 'routes/web.php', 'routes/index.php', 'routes.index.php', '2'),
(4, 1, 'Requisitos para instalar CodeIgniter', 'PHP 5', 'Visual Studio Code', 'Python', 'Aprobar ednl', '1'),
(5, 1, '¿En qué casos usamos el operador @?', 'Declarar variables', 'Declarar constantes', 'Llamadas a constructor', 'Control de errores', '4'),
(6, 1, '¿Cuáles de los siguientes son tipos de inputs?', 'Select', 'Radio', 'Text', 'Todas son correctas', '4'),
(7, 1, '¿Qué tenemos que usar para acceder a los métodos de la clase padre?', 'parent->', 'father::', 'parent::', 'no es necesario nada', '3'),
(8, 1, '¿Cómo se crea una cookie?', 'setcookie(id, valor)', '$_COOKIE[id] = valor', 'cookie(id, valor)', 'set $_COOKIE[id] = valor', '1'),
(9, 1, '¿Cuál es la diferencia entre GET y POST?', 'No existe diferencia', 'El manejo de seguridad de los datos', 'eficiencia', 'tipo de dato', '2'),
(10, 1, '¿Cuál de estas propiedades son correctas?', 'versátil, dificultad de instalación y usa MVC', 'versátil, facilidad de instalación y usa MVC', 'versátil, facilidad de instalacion y lentitud', 'Ninguna es correcta', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centro`
--

CREATE TABLE `centro` (
  `id_centro` tinyint(3) UNSIGNED NOT NULL,
  `nombre_centro` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `centro`
--

INSERT INTO `centro` (`id_centro`, `nombre_centro`) VALUES
(1, 'ESI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen`
--

CREATE TABLE `examen` (
  `id_examen` tinyint(3) UNSIGNED NOT NULL,
  `id_tema` tinyint(3) UNSIGNED NOT NULL,
  `id_alumno` tinyint(3) UNSIGNED NOT NULL,
  `calificacion` float DEFAULT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `examen`
--

INSERT INTO `examen` (`id_examen`, `id_tema`, `id_alumno`, `calificacion`, `fecha`) VALUES
(1, 1, 1, NULL, '2022-04-05'),
(2, 3, 0, 4, '2022-03-15'),
(3, 4, 1, 10, '2022-03-31'),
(4, 2, 1, NULL, '2022-04-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE `grado` (
  `id_grado` int(10) UNSIGNED NOT NULL,
  `id_centro` tinyint(3) UNSIGNED NOT NULL,
  `nombre_grado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`id_grado`, `id_centro`, `nombre_grado`) VALUES
(1, 1, 'Informatica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntaexamen`
--

CREATE TABLE `preguntaexamen` (
  `id_examen` tinyint(3) UNSIGNED NOT NULL,
  `id_pregunta` tinyint(3) UNSIGNED NOT NULL,
  `respuesta` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `id_profesor` tinyint(3) UNSIGNED NOT NULL,
  `id_usuario` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`id_profesor`, `id_usuario`) VALUES
(1, 2),
(2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tema`
--

CREATE TABLE `tema` (
  `id_tema` tinyint(3) UNSIGNED NOT NULL,
  `nombre_tema` varchar(50) NOT NULL,
  `id_asignatura` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tema`
--

INSERT INTO `tema` (`id_tema`, `nombre_tema`, `id_asignatura`) VALUES
(1, 'Programación en PHP', 1),
(2, 'Polimorfismo', 1),
(3, 'Introduccion PHP', 2),
(4, 'Frameworks', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` tinyint(3) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `dni` varchar(10) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `passwd` varchar(200) NOT NULL,
  `tipo` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `dni`, `correo`, `passwd`, `tipo`) VALUES
(1, 'Jose', 'Bautista Lazar', '58574796Y', 'jose@uca.es', '$2y$10$0ymUWHE/39VKYvxwYIvaxukq562QDIyQJ/EvNRBE.jcLWxhWCAtj2', 1),
(2, 'Nicolas', 'Priego Cadenas', '94493273G', 'nicolas@uca.es', '$2y$10$0ymUWHE/39VKYvxwYIvaxukq562QDIyQJ/EvNRBE.jcLWxhWCAtj2', 2),
(3, 'Laura', 'Muriel Arcos', '40714384Z', 'laura@uca.es', '$2y$10$0ymUWHE/39VKYvxwYIvaxukq562QDIyQJ/EvNRBE.jcLWxhWCAtj2', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`id_alumno`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_asignatura` (`id_asignatura`);

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`id_asig`),
  ADD KEY `id_grado` (`id_grado`),
  ADD KEY `id_profesor` (`id_profesor`);

--
-- Indices de la tabla `bateriapreguntas`
--
ALTER TABLE `bateriapreguntas`
  ADD PRIMARY KEY (`id_pregunta`),
  ADD KEY `id_tema` (`id_tema`);

--
-- Indices de la tabla `centro`
--
ALTER TABLE `centro`
  ADD PRIMARY KEY (`id_centro`);

--
-- Indices de la tabla `examen`
--
ALTER TABLE `examen`
  ADD PRIMARY KEY (`id_examen`),
  ADD KEY `id_tema` (`id_tema`),
  ADD KEY `id_alumno` (`id_alumno`);

--
-- Indices de la tabla `grado`
--
ALTER TABLE `grado`
  ADD PRIMARY KEY (`id_grado`),
  ADD KEY `id_centro` (`id_centro`);

--
-- Indices de la tabla `preguntaexamen`
--
ALTER TABLE `preguntaexamen`
  ADD PRIMARY KEY (`id_examen`,`id_pregunta`),
  ADD KEY `id_pregunta` (`id_pregunta`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`id_profesor`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`id_tema`),
  ADD KEY `id_asignatura` (`id_asignatura`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `id_alumno` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  MODIFY `id_asig` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `bateriapreguntas`
--
ALTER TABLE `bateriapreguntas`
  MODIFY `id_pregunta` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `centro`
--
ALTER TABLE `centro`
  MODIFY `id_centro` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `examen`
--
ALTER TABLE `examen`
  MODIFY `id_examen` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `grado`
--
ALTER TABLE `grado`
  MODIFY `id_grado` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `id_profesor` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tema`
--
ALTER TABLE `tema`
  MODIFY `id_tema` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `alumno_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `alumno_ibfk_2` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asig`);

--
-- Filtros para la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD CONSTRAINT `asignatura_ibfk_1` FOREIGN KEY (`id_grado`) REFERENCES `grado` (`id_grado`),
  ADD CONSTRAINT `asignatura_ibfk_2` FOREIGN KEY (`id_profesor`) REFERENCES `profesor` (`id_profesor`);

--
-- Filtros para la tabla `bateriapreguntas`
--
ALTER TABLE `bateriapreguntas`
  ADD CONSTRAINT `bateriapreguntas_ibfk_1` FOREIGN KEY (`id_tema`) REFERENCES `tema` (`id_tema`);

--
-- Filtros para la tabla `grado`
--
ALTER TABLE `grado`
  ADD CONSTRAINT `grado_ibfk_1` FOREIGN KEY (`id_centro`) REFERENCES `centro` (`id_centro`);

--
-- Filtros para la tabla `preguntaexamen`
--
ALTER TABLE `preguntaexamen`
  ADD CONSTRAINT `preguntaexamen_ibfk_1` FOREIGN KEY (`id_examen`) REFERENCES `examen` (`id_examen`);

--
-- Filtros para la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD CONSTRAINT `profesor_ibfk_1` FOREIGN KEY (`id_profesor`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `tema`
--
ALTER TABLE `tema`
  ADD CONSTRAINT `tema_ibfk_1` FOREIGN KEY (`id_tema`) REFERENCES `examen` (`id_tema`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

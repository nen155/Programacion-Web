-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-05-2017 a las 09:34:10
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `redsocial`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amigo`
--

CREATE TABLE `amigo` (
  `id` int(11) NOT NULL,
  `idUsuarioA` int(11) NOT NULL,
  `idUsuarioB` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `amigo`
--

INSERT INTO `amigo` (`id`, `idUsuarioA`, `idUsuarioB`) VALUES
(1, 9, 2),
(2, 9, 3),
(3, 1, 9),
(4, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `fechacreacion` datetime NOT NULL,
  `idEntrada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id`, `descripcion`, `fechacreacion`, `idEntrada`) VALUES
(1, 'hola pepe', '2017-05-10 14:02:00', 5),
(2, 'me parece correcto', '2017-05-10 14:03:25', 5),
(3, 'lo veo bien', '2017-05-10 14:09:00', 5),
(4, 'a ver si acertamos', '2017-05-10 16:37:28', 5),
(5, 'es muy interesante', '2017-05-10 16:43:56', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada`
--

CREATE TABLE `entrada` (
  `id` int(11) NOT NULL,
  `nombre` varchar(500) NOT NULL,
  `descripcion` text NOT NULL,
  `fechacreacion` datetime NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entrada`
--

INSERT INTO `entrada` (`id`, `nombre`, `descripcion`, `fechacreacion`, `idUsuario`) VALUES
(1, 'entrada1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...', '2017-05-10 00:00:00', 1),
(2, 'entrada2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...', '2017-05-12 00:00:00', 1),
(3, 'entrada3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...', '2017-05-03 00:00:00', 1),
(4, 'entrada4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...', '2017-05-09 00:00:00', 2),
(5, 'entrada5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...', '2017-05-09 00:00:00', 9),
(6, 'entrada6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...', '2017-05-07 00:00:00', 9),
(7, 'entrada7', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...', '2017-05-07 00:00:00', 9),
(8, 'entrada8', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...', '2017-05-09 00:00:00', 9),
(9, 'entrada9', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...', '2017-05-07 00:00:00', 9),
(10, 'entrada10', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...', '2017-05-07 00:00:00', 9),
(11, 'entrada11', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...', '2017-05-09 00:00:00', 9),
(12, 'entrada12', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...', '2017-05-07 00:00:00', 9),
(13, 'entrada13', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...', '2017-05-07 00:00:00', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `id` int(11) NOT NULL,
  `url` text NOT NULL,
  `idEntrada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(300) NOT NULL,
  `apellidos` varchar(500) NOT NULL,
  `telefono` varchar(500) NOT NULL,
  `enlinea` tinyint(1) DEFAULT NULL,
  `usuario` varchar(500) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `imagen` varchar(1000) DEFAULT NULL,
  `fechanacimiento` date NOT NULL,
  `email` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellidos`, `telefono`, `enlinea`, `usuario`, `password`, `imagen`, `fechanacimiento`, `email`) VALUES
(1, 'jonas', 'perez', '98969', 1, 'jonas', '78292154d88077447f4edf83546120720e6d05f4', 'pepe/pepe_20170323_1500.jpg', '2017-05-29', 'jonas@gmail.com'),
(2, 'maria', 'lopez', '32423452', 1, 'maria', '78292154d88077447f4edf83546120720e6d05f4', 'maria/maria_20170323_1530.jpg', '2017-05-23', 'maria@gmail.com'),
(3, 'roger', 'serio', '09766897', 1, 'juan', '78292154d88077447f4edf83546120720e6d05f4', 'juan/juan_20170323_1600.jpg', '2017-05-10', 'juan@gmail.com'),
(9, 'Pepe', 'Casfag', '987654321', 0, 'pepe', '78292154d88077447f4edf83546120720e6d05f4', 'pepe/pepe_20170323_1500.jpg', '2017-01-01', 'pepe@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `amigo`
--
ALTER TABLE `amigo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `amigo`
--
ALTER TABLE `amigo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `entrada`
--
ALTER TABLE `entrada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

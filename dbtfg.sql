-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 09-09-2017 a las 17:06:51
-- Versión del servidor: 10.0.31-MariaDB-0ubuntu0.16.04.2
-- Versión de PHP: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbtfg`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servers`
--

CREATE TABLE `servers` (
  `idHost` int(5) NOT NULL,
  `nombreHost` varchar(50) NOT NULL,
  `addrHost` varchar(50) NOT NULL,
  `puertoHost` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `servers`
--

INSERT INTO `servers` (`idHost`, `nombreHost`, `addrHost`, `puertoHost`) VALUES
(3, 'Olabide Moodle', 'ikasleak.olabide.eus', 443),
(4, 'Olabide Ikastola', 'ikasleak.olabide.eus', 123),
(6, 'UNIR', 'www.unir.net', 80);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nombreUsuario` varchar(30) NOT NULL,
  `emailUsuario` varchar(60) NOT NULL,
  `passUsuario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombreUsuario`, `emailUsuario`, `passUsuario`) VALUES
(1, 'aa', 'aa@aa.com', '$2y$10$7qP5q0y8DBMeEla3xn.v7etNQApE/FAACCTtHZXEt1EU0LgVQw9uy'),
(2, 'bb', 'b@b.com', '$2y$10$QtMK1.X0aySj/6HW/.pYneJRa8g978P0//.zItNmxZ9KiCHCchAHm');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `servers`
--
ALTER TABLE `servers`
  ADD PRIMARY KEY (`idHost`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `emailUsuario` (`emailUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `servers`
--
ALTER TABLE `servers`
  MODIFY `idHost` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

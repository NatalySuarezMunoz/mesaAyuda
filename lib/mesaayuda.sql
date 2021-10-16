-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-10-2021 a las 05:42:35
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mesaayuda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anexos`
--

CREATE TABLE `anexos` (
  `IDanexo` int(11) NOT NULL,
  `IDnota` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `ruta` varchar(50) NOT NULL,
  `nombrearchivo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `IDcargo` int(11) NOT NULL,
  `cargo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`IDcargo`, `cargo`) VALUES
(1, 'Desarrollador'),
(2, 'analista');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `IDempleado` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `documento` varchar(50) DEFAULT NULL,
  `IDcargo` int(11) DEFAULT NULL,
  `genero` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`IDempleado`, `nombre`, `documento`, `IDcargo`, `genero`) VALUES
(1, 'CECILIA MUÑOZ GIL', '12', 1, 'masculino'),
(2, 'CECILIA MUÑOZ GIL', '12', 1, 'masculino'),
(3, 'j', '12', 2, 'femenino'),
(4, 'j', '12', 2, 'femenino'),
(5, 'j', '12', 2, 'femenino'),
(6, 'CECILIA MUÑOZ GIL', '12', 1, 'masculino'),
(7, 'CECILIA MUÑOZ GIL', '12', 1, 'masculino'),
(8, 'jorge', '1323', 2, 'femenino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_ticket`
--

CREATE TABLE `estado_ticket` (
  `IDestado_ticket` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='estado del ticket de la mesa de ayuda';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `IDlogin` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` binary(1) NOT NULL,
  `fechacreacion` date NOT NULL,
  `IDempleado` int(11) NOT NULL,
  `ultimasesion` date NOT NULL,
  `estado` varchar(10) NOT NULL,
  `IDrol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_ticket`
--

CREATE TABLE `nota_ticket` (
  `IDnota` int(11) NOT NULL,
  `IDticket` int(11) NOT NULL,
  `fechacreacion` date NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `IDestado` int(11) NOT NULL,
  `IDlogin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `IDrol` int(11) NOT NULL,
  `rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='roles de los usuarios que interactúan con la mesa de ayuda';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `IDtiket` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `IDempleado` int(11) NOT NULL,
  `fechacreacion` date NOT NULL,
  `fechacierre` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anexos`
--
ALTER TABLE `anexos`
  ADD PRIMARY KEY (`IDanexo`),
  ADD UNIQUE KEY `IDnota` (`IDnota`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`IDcargo`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`IDempleado`),
  ADD KEY `IDcargoIDempleado` (`IDcargo`);

--
-- Indices de la tabla `estado_ticket`
--
ALTER TABLE `estado_ticket`
  ADD PRIMARY KEY (`IDestado_ticket`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`IDlogin`),
  ADD KEY `IDempleado` (`IDempleado`),
  ADD KEY `IDrol` (`IDrol`);

--
-- Indices de la tabla `nota_ticket`
--
ALTER TABLE `nota_ticket`
  ADD PRIMARY KEY (`IDnota`),
  ADD KEY `IDticket` (`IDticket`),
  ADD KEY `IDestado` (`IDestado`),
  ADD KEY `IDlogin` (`IDlogin`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`IDrol`);

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`IDtiket`),
  ADD KEY `IDempleado` (`IDempleado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `IDcargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `IDempleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anexos`
--
ALTER TABLE `anexos`
  ADD CONSTRAINT `anexos_ibfk_1` FOREIGN KEY (`IDnota`) REFERENCES `nota_ticket` (`IDnota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`IDrol`) REFERENCES `rol` (`IDrol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `login_ibfk_2` FOREIGN KEY (`IDempleado`) REFERENCES `empleado` (`IDempleado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `nota_ticket`
--
ALTER TABLE `nota_ticket`
  ADD CONSTRAINT `nota_ticket_ibfk_1` FOREIGN KEY (`IDticket`) REFERENCES `ticket` (`IDtiket`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nota_ticket_ibfk_2` FOREIGN KEY (`IDestado`) REFERENCES `estado_ticket` (`IDestado_ticket`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nota_ticket_ibfk_3` FOREIGN KEY (`IDlogin`) REFERENCES `login` (`IDlogin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`IDempleado`) REFERENCES `empleado` (`IDempleado`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

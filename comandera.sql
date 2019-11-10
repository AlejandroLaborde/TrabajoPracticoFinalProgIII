-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-11-2019 a las 16:55:32
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `comandera`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encargados`
--

CREATE TABLE `encargados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `rol` int(11) NOT NULL,
  `clave` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `encargados`
--

INSERT INTO `encargados` (`id`, `nombre`, `apellido`, `rol`, `clave`, `usuario`) VALUES
(1, 'alejandro', 'laborde', 2, '123', 'al34224'),
(2, 'daniel', 'laborde', 1, '123', 'dan123'),
(3, 'gustavo', 'laborde', 3, '123', 'gus123'),
(4, 'Jenkins', 'laborde', 4, '123', 'jen123'),
(5, 'Composer', 'laborde', 5, '123', 'com123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` int(11) NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `estado`) VALUES
(1, 'pendiente'),
(2, 'en preparacion'),
(3, 'listo para servir');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `id` int(11) NOT NULL,
  `codMesa` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id`, `codMesa`) VALUES
(1, 'MESA1'),
(2, 'MESA2'),
(3, 'MESA3'),
(4, 'MESA4'),
(5, 'MESA5'),
(6, 'MESA6'),
(7, 'MESA7'),
(8, 'MESA8'),
(9, 'MESA9');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `encargado` int(11) NOT NULL,
  `tiempo` int(11) NOT NULL,
  `precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `descripcion`, `encargado`, `tiempo`, `precio`) VALUES
(1, 'coca-cola', 1, 30, 100),
(2, 'vino', 1, 30, 150),
(3, 'agua', 1, 30, 75),
(4, 'jugo', 1, 30, 100),
(5, 'ipa', 2, 90, 30),
(6, 'honey', 2, 90, 30),
(7, 'porter', 2, 90, 30),
(8, 'scotish', 2, 90, 30),
(9, 'Pollo con papas', 3, 9200, 1800),
(10, 'Milanesa apolitana de pollo', 3, 250, 900),
(11, 'Ravioles con salsa bolognesa', 3, 200, 600),
(12, 'Parrilla completa', 3, 300, 1800);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `puesto` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `puesto`) VALUES
(1, 'bartender'),
(2, 'cervecero'),
(3, 'cocinero'),
(4, 'mozo'),
(5, 'socio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `codigo` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `tiempo` int(11) NOT NULL,
  `precio` float NOT NULL,
  `estado` int(11) NOT NULL,
  `cliente` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `imagen` text COLLATE utf8_spanish2_ci NOT NULL,
  `codMesa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`id`, `codigo`, `tiempo`, `precio`, `estado`, `cliente`, `imagen`, `codMesa`) VALUES
(1, 'a07mY', 0, 0, 1, 'ale', '', 1),
(2, 'hSTI3', 0, 0, 1, 'ale', '', 2),
(3, 'wu3Ga', 0, 0, 1, 'ale', '', 3),
(4, 'ciy9p', 0, 0, 1, 'ale', '', 4),
(5, '8n9QH', 0, 0, 1, 'ale', '', 2),
(6, 'XFNXO', 150, 235, 2, 'ale', '', 9),
(7, 'WDdzC', 0, 0, 3, 'ale', '', 7),
(8, '2C3Jr', 0, 0, 1, 'ale', '', 3),
(9, 'eszeY', 0, 0, 1, 'ale', '', 9),
(10, 'YYwSH', 0, 0, 1, 'ale', '', 4),
(11, 'AV0cQ', 0, 0, 1, 'ale', '', 1),
(12, 'Xamcd', 0, 0, 1, 'ale', '', 3),
(13, 'hvpig', 0, 0, 1, 'ale', '', 5),
(14, 'JOY3g', 0, 0, 1, 'ale', '', 8),
(15, 'N77c8', 0, 0, 1, 'ale', '', 7),
(16, 'yQAWk', 0, 0, 1, 'ale', '', 5),
(17, 'ItgCg', 0, 0, 1, 'ale', '', 5),
(18, 'kRHGg', 0, 0, 1, 'ale', '', 4),
(20, 'aILUo', 90, 300, 1, 'alejandro', '', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_productos`
--

CREATE TABLE `ticket_productos` (
  `codigo` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `producto` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `ticket_productos`
--

INSERT INTO `ticket_productos` (`codigo`, `producto`, `estado`, `id`) VALUES
('a07mY', 1, 2, 1),
('a07mY', 3, 1, 2),
('a07mY', 5, 1, 3),
('a07mY', 8, 1, 4),
('hSTI3', 1, 1, 5),
('hSTI3', 3, 1, 6),
('hSTI3', 5, 1, 7),
('hSTI3', 8, 1, 8),
('wu3Ga', 1, 1, 9),
('wu3Ga', 3, 1, 10),
('wu3Ga', 5, 1, 11),
('wu3Ga', 8, 1, 12),
('ciy9p', 1, 1, 13),
('ciy9p', 3, 1, 14),
('ciy9p', 5, 1, 15),
('ciy9p', 8, 1, 16),
('8n9QH', 1, 1, 17),
('8n9QH', 3, 1, 18),
('8n9QH', 5, 1, 19),
('8n9QH', 8, 1, 20),
('XFNXO', 1, 1, 21),
('XFNXO', 3, 1, 22),
('XFNXO', 5, 3, 23),
('XFNXO', 8, 1, 24),
('WDdzC', 1, 1, 25),
('WDdzC', 3, 1, 26),
('WDdzC', 5, 1, 27),
('WDdzC', 8, 1, 28),
('2C3Jr', 1, 1, 29),
('2C3Jr', 3, 1, 30),
('2C3Jr', 5, 1, 31),
('2C3Jr', 8, 1, 32),
('eszeY', 1, 1, 33),
('eszeY', 3, 1, 34),
('eszeY', 5, 1, 35),
('eszeY', 8, 1, 36),
('YYwSH', 1, 1, 37),
('YYwSH', 3, 1, 38),
('YYwSH', 5, 1, 39),
('YYwSH', 8, 1, 40),
('AV0cQ', 1, 1, 41),
('AV0cQ', 3, 1, 42),
('AV0cQ', 5, 1, 43),
('AV0cQ', 8, 1, 44),
('Xamcd', 1, 1, 45),
('Xamcd', 3, 1, 46),
('Xamcd', 5, 1, 47),
('Xamcd', 8, 1, 48),
('hvpig', 1, 1, 49),
('hvpig', 3, 1, 50),
('hvpig', 5, 1, 51),
('hvpig', 8, 1, 52),
('JOY3g', 1, 1, 53),
('JOY3g', 3, 1, 54),
('JOY3g', 5, 1, 55),
('JOY3g', 8, 1, 56),
('N77c8', 1, 1, 57),
('N77c8', 3, 1, 58),
('N77c8', 5, 1, 59),
('N77c8', 8, 1, 60),
('yQAWk', 1, 1, 61),
('yQAWk', 3, 1, 62),
('yQAWk', 5, 1, 63),
('yQAWk', 8, 1, 64),
('ItgCg', 1, 1, 65),
('ItgCg', 3, 1, 66),
('ItgCg', 5, 1, 67),
('ItgCg', 8, 1, 68),
('kRHGg', 1, 1, 69),
('kRHGg', 3, 1, 70),
('kRHGg', 5, 1, 71),
('kRHGg', 8, 1, 72),
('p8Mm2', 1, 0, 73),
('p8Mm2', 1, 0, 74),
('p8Mm2', 1, 0, 75),
('aILUo', 1, 0, 76),
('aILUo', 1, 0, 77),
('aILUo', 1, 0, 78);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `encargados`
--
ALTER TABLE `encargados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ticket_productos`
--
ALTER TABLE `ticket_productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `encargados`
--
ALTER TABLE `encargados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `ticket_productos`
--
ALTER TABLE `ticket_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

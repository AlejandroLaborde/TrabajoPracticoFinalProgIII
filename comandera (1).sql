-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2019 a las 22:51:39
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
(5, 'Composer', 'laborde', 5, '123', 'com123'),
(48, 'joana', 'soledad', 2, '951753', 'joana2695');

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
(3, 'listo para servir'),
(4, 'clientes esperando pedido'),
(5, 'clientes comiendo'),
(6, 'clientes pagando'),
(7, 'cerrada'),
(8, 'servido'),
(9, 'cobrado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `id` int(11) NOT NULL,
  `codMesa` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id`, `codMesa`, `estado`) VALUES
(1, 'MESA1', 4),
(2, 'MESA2', 4),
(3, 'MESA3', 7),
(4, 'MESA4', 7),
(5, 'MESA5', 7),
(6, 'MESA6', 7),
(7, 'MESA7', 7),
(8, 'MESA8', 7),
(9, 'MESA9', 7);

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
(1, 'coca-cola', 1, 5, 100),
(2, 'vino', 1, 5, 150),
(3, 'agua', 1, 5, 75),
(4, 'jugo', 1, 5, 100),
(5, 'ipa', 2, 10, 30),
(6, 'honey', 2, 10, 30),
(7, 'porter', 2, 10, 30),
(8, 'scotish', 2, 10, 30),
(9, 'Pollo con papas', 3, 30, 1800),
(10, 'Milanesa apolitana de pollo', 3, 30, 900),
(11, 'Ravioles con salsa bolognesa', 3, 30, 600),
(12, 'Parrilla completa', 3, 40, 1800),
(13, 'mila con fritas', 3, 30, 150);

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
(1, 'Msrug', 0, 4720, 1, 'trabajoPractico', '', 2);

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
('Msrug', 1, 1, 1),
('Msrug', 5, 1, 2),
('Msrug', 6, 1, 3),
('Msrug', 7, 1, 4),
('Msrug', 8, 1, 5),
('Msrug', 9, 1, 6),
('Msrug', 10, 1, 7),
('Msrug', 12, 1, 8);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ticket_productos`
--
ALTER TABLE `ticket_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

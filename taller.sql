-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 09-11-2023 a las 17:33:43
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `taller`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `descripcion`) VALUES
(1, 'LLantas', 'piesas para coches'),
(3, 'nombre1', 'descripcion1'),
(4, 'nombre2', 'descripcion2'),
(5, 'nombre3', 'descripcion3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `dni` varchar(80) DEFAULT NULL,
  `actividad_economica` varchar(255) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `nombre`, `dni`, `actividad_economica`, `email`, `telefono`, `imagen`) VALUES
(1, 'Fernanda Asturias', '240', 'Servicio de Taller Mecanico', 'fasturias@hotmail.com', '9515160434', 'your_logo.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id` int(11) NOT NULL,
  `dni` varchar(10) DEFAULT NULL,
  `imagen` varchar(255) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL,
  `domicilio` varchar(100) NOT NULL,
  `localidad` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `registro` varchar(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `kind` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id`, `dni`, `imagen`, `nombre`, `apellido`, `username`, `email`, `password`, `domicilio`, `localidad`, `telefono`, `celular`, `registro`, `status`, `kind`, `created_at`) VALUES
(1, '543434', 'view/resources/images/1699457636_avatar2.gif', 'Administrador', 'Administrador', 'admin', 'admin@admin.com', '67a74306b06d0c01624fe0d0249a570f4d093747', 'Oaxaca', 'Oaxaca', '951515642287', '951515642287', '1', 1, 0, '0000-00-00 00:00:00'),
(3, '123456', 'view/resources/images/default.png', 'Ranulfos', 'Sanchez', 'Ranulfoss', 'alphant76@hotmail.com', '67a74306b06d0c01624fe0d0249a570f4d093747', 'Conocido', 'OAXACA DE JUAREZ', '123456', '123456', '45', 1, 0, '2023-10-03 07:36:37'),
(4, '240', 'view/resources/images/default.png', 'Eduardo', 'Ramirez Luna', 'lalo4678', 'lalo4678@hotmail.com', 'b500474d9b3a8caf99e2d15e79b176d28e5435e1', 'Santa Lucia', 'Oaxaca', '95151139', '951139', '139', 1, 0, '2023-10-03 15:40:54'),
(5, '555', 'view/resources/images/default.png', 'Ever', 'Agustin', 'Ever', 'Ever@gmail.com', '67a74306b06d0c01624fe0d0249a570f4d093747', 'Conocido', 'OAXACA', '9512905212', '9512125212', '1234', 1, 0, '2023-11-03 19:31:43'),
(6, '6', 'view/resources/images/default.png', 'Ramon ', 'valdez ', 'Ramon ', 'Ramon@gmail.com', '67a74306b06d0c01624fe0d0249a570f4d093747', 'Conocido', 'OAXACA', '9512905212', '9512125212', '1234', 1, 0, '2023-11-07 17:32:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado_permisos`
--

CREATE TABLE `empleado_permisos` (
  `idempleado_permiso` int(11) NOT NULL,
  `idempleado` int(11) NOT NULL,
  `idpermiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `empleado_permisos`
--

INSERT INTO `empleado_permisos` (`idempleado_permiso`, `idempleado`, `idpermiso`) VALUES
(33, 4, 1),
(34, 4, 2),
(35, 4, 3),
(36, 4, 5),
(37, 4, 6),
(38, 4, 7),
(39, 4, 9),
(40, 4, 11),
(96, 3, 1),
(97, 3, 2),
(98, 3, 3),
(99, 3, 4),
(100, 3, 5),
(101, 3, 6),
(102, 3, 7),
(103, 3, 8),
(104, 3, 9),
(105, 3, 10),
(106, 3, 11),
(161, 1, 1),
(162, 1, 2),
(163, 1, 3),
(164, 1, 4),
(165, 1, 5),
(166, 1, 6),
(167, 1, 7),
(168, 1, 8),
(169, 1, 9),
(170, 1, 10),
(171, 1, 11),
(215, 5, 1),
(216, 5, 2),
(217, 5, 3),
(218, 5, 4),
(219, 5, 5),
(220, 5, 6),
(221, 5, 7),
(222, 5, 8),
(223, 5, 9),
(224, 5, 10),
(225, 5, 11),
(247, 6, 1),
(248, 6, 2),
(249, 6, 3),
(250, 6, 4),
(251, 6, 5),
(252, 6, 6),
(253, 6, 7),
(254, 6, 8),
(255, 6, 9),
(256, 6, 10),
(257, 6, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `cuit` varchar(30) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `fecha_carga` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `nombre`, `cuit`, `estado`, `fecha_carga`) VALUES
(1, 'ibm 2', '133', 1, '2018-06-25 03:45:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `nombre`) VALUES
(1, 'Dashboard'),
(2, 'Empleados'),
(3, 'Taller'),
(4, 'Seguro'),
(5, 'Empresa'),
(6, 'Sector'),
(7, 'Vehiculo'),
(8, 'Tarjeta'),
(9, 'Reparaciones'),
(10, 'Choquess'),
(11, 'Configuracion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `pk_solicitud` int(11) NOT NULL,
  `fk_empleado` int(11) NOT NULL,
  `NumeroFolio` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `operador` varchar(255) NOT NULL,
  `NoCarro` varchar(255) NOT NULL,
  `Kilometraje` varchar(255) NOT NULL,
  `NoPlacas` varchar(255) NOT NULL,
  `DetallesServicio` varchar(255) NOT NULL,
  `Observaciones` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`pk_solicitud`, `fk_empleado`, `NumeroFolio`, `fecha`, `operador`, `NoCarro`, `Kilometraje`, `NoPlacas`, `DetallesServicio`, `Observaciones`) VALUES
(2635, 3, '2798', '2023-11-07', 'Tomas Gonzales ', '63', '22245', 'wx-31617', 'Cambiar una llanta', 'No trae llanta de refeaccion '),
(5635, 1, '2638', '2023-11-09', 'Ramon carmona', '58', '222563', 'wr-2485', 'Cambio de llantas traseras ', 'ninguna'),
(5678, 3, '3957', '2023-11-04', 'Everardo Alvaro Ramon', '79', '25877', 'rx-31619', 'CAMBIO DE MOTOREs', 'Ya pago'),
(8546, 3, '3369', '2023-11-09', 'Ramon carmona', '59', '222563', 'wr-2485', 'Cambio de llantas traseras ', 'ninguna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

CREATE TABLE `subcategoria` (
  `id` int(11) NOT NULL,
  `fk_categoria` int(11) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategoria` (`id`, `fk_categoria`, `nombre`, `descripcion`) VALUES
(1, 1, 'subcategoria1', 'descripcion1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcatpro`
--

CREATE TABLE `tblcatpro` (
  `SKU` text NOT NULL,
  `STRCODINT` text NOT NULL,
  `STRDESPRO` text NOT NULL,
  `INTIDSUBCAT` int(11) NOT NULL,
  `MONPCOS` double NOT NULL,
  `INTIDUNI` int(11) NOT NULL,
  `STRIMG` varchar(255) NOT NULL,
  `BITTALL` bit(1) NOT NULL,
  `INTTIPUSO` int(11) NOT NULL,
  `BITSUS` int(1) NOT NULL DEFAULT 0,
  `INTIDCAT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblcatpro`
--

INSERT INTO `tblcatpro` (`SKU`, `STRCODINT`, `STRDESPRO`, `INTIDSUBCAT`, `MONPCOS`, `INTIDUNI`, `STRIMG`, `BITTALL`, `INTTIPUSO`, `BITSUS`, `INTIDCAT`) VALUES
('10005631120', 'MororV8', 'Motor 6 cilindros', 1, 0, 0, 'view/resources/images/default.png', b'1', 1, 1, 1),
('10005631121', 'MororV8', 'Motor 6 cilindros', 1, 0, 0, 'view/resources/images/default.png', b'1', 1, 1, 1),
('10005631122', 'MororV8', 'Motor 6 cilindros', 1, 4, 0, 'view/resources/images/default.png', b'1', 1, 1, 1),
('10005631123', 'MororV8', 'Motor 6 cilindros', 1, 4, 0, 'view/resources/images/default.png', b'1', 1, 1, 1),
('10005631124', 'MororV8', 'Motor 6 cilindros', 1, 40000, 4, 'view/resources/images/default.png', b'1', 1, 1, 1),
('10005631125', 'MororV8', 'Motor 6 cilindros', 1, 40000, 4, 'view/resources/images/Productos/1699463977_spaceship.gif', b'1', 1, 1, 1),
('10005631126', 'MororV8', 'Motor 6 cilindros', 1, 40000, 4, 'view/resources/images/Productos/1699464078_spaceship.gif', b'1', 1, 1, 1),
('10005631128', 'MororV8', 'Motor 6 cilindros', 1, 40000, 4, 'view/resources/images/Productos/1699466165_vehiculo.png', b'1', 1, 1, 1),
('1005631110', 'Motor6c', 'BUJIAS NGK PARA COCHE', 1, 35, 1, 'view/resources/images/default.png', b'1', 4, 1, 1),
('1006632110', 'BUJIAS02', 'BUJIAS NGK PARA CAMIONETA', 1, 35, 1, 'view/resources/images/default.png', b'1', 4, 1, 1),
('1008672319', 'BUJIAS03', 'BUJIAS NGK PARA TRACTOCAMION', 1, 35, 1, 'view/resources/images/default.png', b'1', 4, 1, 1),
('2008672319', 'LLANTA01', 'LLANTA AVANTE 205/70/16', 1, 35, 1, 'view/resources/images/default.png', b'1', 4, 1, 1),
('2009372319', 'LLANTA03', 'LLANTA GOODYEAR 205/70/16', 1, 35, 1, 'view/resources/images/default.png', b'1', 4, 1, 1),
('2009472319', 'LLANTA04', 'LLANTA GOODYEAR 205/70/15', 1, 35, 1, 'view/resources/images/default.png', b'1', 4, 1, 1),
('2009473316', 'LLANTA06', 'LLANTA FIRESTONE 205/70/15', 1, 35, 1, 'view/resources/images/default.png', b'1', 4, 1, 1),
('2009473319', 'LLANTA05', 'LLANTA AVANTE 205/70/15', 1, 35, 1, 'view/resources/images/default.png', b'1', 4, 1, 1),
('2009672319', 'LLANTA02', 'LLANTA FIRESTONE 205/70/16', 1, 35, 1, 'view/resources/images/default.png', b'1', 4, 1, 1),
('3009473316', 'ACEITE01', 'ACEITE SINTETICO P/MOTOR W50', 1, 35, 1, 'view/resources/images/default.png', b'1', 4, 1, 1),
('3009473317', 'ACEITE02', 'ACEITE SINTETICO P/TRANSMISION W50', 1, 35, 1, 'view/resources/images/default.png', b'1', 4, 1, 1),
('45234589', 'TORNILLO02', 'TORNILLO MILIMETRICO P/DADO DE 1/4', 1, 35, 1, 'view/resources/images/default.png', b'1', 4, 1, 1),
('5019473317', 'TINER01', 'TINER', 1, 35, 1, 'view/resources/images/default.png', b'1', 4, 1, 1),
('6724563792', 'TORNILLO01', 'TORNILLO MILIMETRICO P/DADO DE 3/16', 1, 35, 1, 'view/resources/images/default.png', b'1', 4, 1, 1),
('8345231094', 'CHAPA01', 'CHAPA PARA PUERTA MODELO 2013', 1, 3400, 1, 'view/resources/images/default.png', b'0', 1, 1, 1),
('9001671510', 'BALATAS03', 'BALATAS PARA TRACTOCAMION', 1, 35, 1, 'view/resources/images/default.png', b'1', 4, 1, 1),
('9002344298', 'BALATAS01', 'BALATAS PARA CAMIONETA', 1, 35, 1, 'view/resources/images/default.png', b'1', 4, 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleado_permisos`
--
ALTER TABLE `empleado_permisos`
  ADD PRIMARY KEY (`idempleado_permiso`),
  ADD KEY `idempleado` (`idempleado`),
  ADD KEY `idpermiso` (`idpermiso`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`pk_solicitud`);

--
-- Indices de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categoria` (`fk_categoria`);

--
-- Indices de la tabla `tblcatpro`
--
ALTER TABLE `tblcatpro`
  ADD PRIMARY KEY (`SKU`(30));

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `empleado_permisos`
--
ALTER TABLE `empleado_permisos`
  MODIFY `idempleado_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=258;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empleado_permisos`
--
ALTER TABLE `empleado_permisos`
  ADD CONSTRAINT `empleado_permisos_ibfk_1` FOREIGN KEY (`idempleado`) REFERENCES `empleado` (`id`),
  ADD CONSTRAINT `empleado_permisos_ibfk_2` FOREIGN KEY (`idpermiso`) REFERENCES `permisos` (`id`);

--
-- Filtros para la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD CONSTRAINT `subcategoria_ibfk_1` FOREIGN KEY (`fk_categoria`) REFERENCES `categoria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

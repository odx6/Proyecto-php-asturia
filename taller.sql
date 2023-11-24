-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 24-11-2023 a las 17:25:58
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
(257, 6, 11),
(258, 3, 2),
(259, 3, 3),
(260, 3, 4),
(261, 3, 5),
(262, 3, 6),
(263, 3, 7),
(264, 3, 8),
(265, 3, 9),
(266, 3, 10),
(267, 3, 11),
(327, 9, 1),
(328, 9, 2),
(329, 9, 3),
(330, 9, 4),
(331, 9, 5),
(332, 9, 6),
(333, 9, 7),
(334, 9, 8),
(335, 9, 9),
(336, 9, 10),
(337, 9, 11),
(338, 9, 12),
(351, 10, 1),
(352, 10, 2),
(353, 10, 3),
(354, 10, 4),
(355, 10, 5),
(356, 10, 6),
(357, 10, 7),
(358, 10, 8),
(359, 10, 9),
(360, 10, 10),
(361, 10, 11),
(362, 10, 12),
(469, 1, 1),
(470, 1, 2),
(471, 1, 3),
(472, 1, 4),
(473, 1, 5),
(474, 1, 6),
(475, 1, 7),
(476, 1, 8),
(477, 1, 9),
(478, 1, 10),
(479, 1, 11),
(480, 1, 12),
(481, 1, 13),
(482, 1, 14),
(483, 1, 15),
(484, 1, 16);

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
(11, 'Configuracion'),
(12, 'productos'),
(13, 'subcategoiras'),
(14, 'solicitud'),
(15, 'categorias'),
(16, 'unidades');

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
(1002, 1, '2638', '2023-11-14', 'Ramon carmona', '58', '222563', 'wr-2485', 'Cambio de llantas traseras ', 'ninguna'),
(1003, 1, '2638', '2023-11-14', 'Ramon carmona', '58', '222563', 'wr-2485', 'Cambio de llantas traseras ', 'ninguna'),
(1004, 1, '2638', '2023-11-14', 'Ramon carmona', '58', '222563', 'wr-2485', 'Cambio de llantas traseras ', 'ninguna'),
(1005, 1, '2638', '2023-11-14', 'Ramon carmona', '58', '222563', 'wr-2485', 'Cambio de llantas traseras ', 'ninguna'),
(1010, 1, '2638', '2023-11-14', 'Ramon carmona', '58', '222563', 'wr-2485', 'Cambio de llantas traseras ', 'ninguna'),
(1020, 1, '2638', '2023-11-14', 'Ramon carmona', '58', '222563', 'wr-2485', 'Cambio de llantas traseras ', 'ninguna'),
(2635, 3, '2798', '2023-11-07', 'Tomas Gonzales ', '63', '22245', 'wx-31617', 'Cambiar una llanta', 'No trae llanta de refeaccion '),
(2747, 1, '1234', '2023-11-14', 'Everardo Alvaro Agustin cruz ', '50', '422646', 'ry-31617', 'cambiar motor', 'NINGUNA'),
(5759, 1, '2638', '2023-11-14', 'Ramon carmona', '58', '222563', 'wr-2485', 'Cambio de llantas traseras ', 'ninguna'),
(5763, 1, '2638', '2023-11-14', 'Ramon carmona', '58', '222563', 'wr-2485', 'Cambio de llantas traseras ', 'ninguna'),
(5794, 1, '2638', '2023-11-14', 'Ramon carmona', '58', '222563', 'wr-2485', 'Cambio de llantas traseras ', 'ninguna'),
(5799, 1, '2638', '2023-11-14', 'Ramon carmona', '58', '222563', 'wr-2485', 'Cambio de llantas traseras ', 'ninguna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcatcat`
--

CREATE TABLE `tblcatcat` (
  `INTIDCAT` int(11) NOT NULL,
  `STRNOMCAT` varchar(30) NOT NULL,
  `STRDESCAT` varchar(150) NOT NULL,
  `DTEHOR` datetime NOT NULL,
  `BITSUS` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tblcatcat`
--

INSERT INTO `tblcatcat` (`INTIDCAT`, `STRNOMCAT`, `STRDESCAT`, `DTEHOR`, `BITSUS`) VALUES
(4, 'mECANICA', 'PARTES DE AUTOS', '2023-11-13 20:20:26', 1),
(6, 'coches', 'pintura par  coche', '2023-11-15 22:20:52', 1),
(7, 'CATEGORIA7', 'es una categoria', '2023-11-23 16:48:12', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcatemp`
--

CREATE TABLE `tblcatemp` (
  `IDEMP` int(11) NOT NULL,
  `STRNSS` varchar(15) NOT NULL,
  `STRRFC` text NOT NULL,
  `STRCUR` text NOT NULL,
  `STRNOM` text NOT NULL,
  `STRAPE` text NOT NULL,
  `STRDOM` text NOT NULL,
  `STRLOC` text NOT NULL,
  `STRMUN` text NOT NULL,
  `STREST` text NOT NULL,
  `STRCP` text NOT NULL,
  `STRPAI` text NOT NULL,
  `STRTEL` text NOT NULL,
  `STRCOR` text NOT NULL DEFAULT '0',
  `STRPWS` text NOT NULL DEFAULT '0',
  `BITSUS` bit(1) NOT NULL,
  `STRIMG` text NOT NULL DEFAULT 'view/resources/images/default.png',
  `CREATE_AT` datetime NOT NULL DEFAULT current_timestamp(),
  `TOKEN` text NOT NULL,
  `VERIFICATE_AT` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tblcatemp`
--

INSERT INTO `tblcatemp` (`IDEMP`, `STRNSS`, `STRRFC`, `STRCUR`, `STRNOM`, `STRAPE`, `STRDOM`, `STRLOC`, `STRMUN`, `STREST`, `STRCP`, `STRPAI`, `STRTEL`, `STRCOR`, `STRPWS`, `BITSUS`, `STRIMG`, `CREATE_AT`, `TOKEN`, `VERIFICATE_AT`) VALUES
(1, '543434', '123', 'SDJK544S44A', 'Administrador', 'Administrador', 'las casa num213', 'santa luci', 'santa cruz xoxocotlan ', 'Oaxaca', '71230', 'Mexico', '9152905212', 'admin@admin.com', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', b'1', 'view/resources/images/1700174068_1529891341_asus.jpg', '2023-11-11 10:11:13', '', '2023-11-21 13:13:27'),
(3, '123456', '123456', 'Ranulfos', 'Sanchez', 'Ranulfoss', 'alphant76@hotmail.com', 'kdhsdhk', 'Conocido', 'OAXACA DE JUAREZ', '123456', '123456', '45', '1', '0', b'1', 'view/resources/images/Default/perfil.png', '2023-11-11 10:11:13', '', NULL),
(4, '240', '3234dsdd', 'Eduardo', 'Ramirez Luna', 'lalo4678', 'lalo4678@hotmail.com', 'dhjd', 'Santa Lucia', 'Oaxaca', '95151139', '951139', '139', '1', '0', b'1', 'view/resources/images/Default/perfil.png', '2023-11-11 10:11:13', '', NULL),
(5, '555', '12345', 'Ever', 'Agustin', 'Ever', 'Ever@gmail.com', 'df1df31fd', 'Conocido', 'OAXACA', '9512905212', '9512125212', '1234', '1', '0', b'1', 'view/resources/images/Default/perfil.png', '2023-11-11 10:11:13', '', NULL),
(6, '6', '123456', 'Ramon ', 'valdez ', 'Ramon ', 'Ramon@gmail.com', 'jdjhdjk', 'Conocido', 'OAXACA', '9512905212', '9512125212', '1234', '1', '0', b'1', 'view/resources/images/Default/perfil.png', '2023-11-11 10:11:13', '', NULL),
(9, '12345', '1234', '123', '123', '123', 'lsdjdl', 'a', 'a', 'a', 'a', 'a', 'a', 'Ever@gmail.com', '09361980f210d386bfec673303e03ce617dfc107', b'1', 'view/resources/images/Default/perfil.png', '2023-11-11 22:38:26', '', NULL),
(10, '543434', '123', '123', '123', '123', 'lsdjdl', 'a', 'a', 'a', 'a', 'México', '9515925212', 'Everardo@gmail.com', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', b'1', 'view/resources/images/Default/perfil.png', '2023-11-15 16:32:21', '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcatpro`
--

CREATE TABLE `tblcatpro` (
  `STRSKU` text NOT NULL,
  `STRCOD` text NOT NULL,
  `STRDESPRO` text NOT NULL,
  `INTIDSBC` int(11) NOT NULL,
  `MONPCOS` double NOT NULL,
  `INTIDUNI` int(11) NOT NULL,
  `STRIMG` varchar(255) NOT NULL,
  `INTTIPUSO` int(11) NOT NULL,
  `BITSUS` int(1) NOT NULL DEFAULT 0,
  `INTIDCAT` int(11) NOT NULL,
  `CREATE_AT` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblcatpro`
--

INSERT INTO `tblcatpro` (`STRSKU`, `STRCOD`, `STRDESPRO`, `INTIDSBC`, `MONPCOS`, `INTIDUNI`, `STRIMG`, `INTTIPUSO`, `BITSUS`, `INTIDCAT`, `CREATE_AT`) VALUES
('10055646544', 'motor6 cilindros', 'Motor 6 cilindros', 4, 40000, 5, 'view/resources/images/Productos/1700763110_1529891341_asus.jpg', 1, 1, 7, '2023-11-23 19:11:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcatsbc`
--

CREATE TABLE `tblcatsbc` (
  `INTIDSBC` int(11) NOT NULL,
  `INTIDCAT` int(11) NOT NULL,
  `STRNOMSBC` varchar(30) NOT NULL,
  `STRDESBC` varchar(150) NOT NULL,
  `DTEHOR` datetime NOT NULL,
  `BITSUS` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tblcatsbc`
--

INSERT INTO `tblcatsbc` (`INTIDSBC`, `INTIDCAT`, `STRNOMSBC`, `STRDESBC`, `DTEHOR`, `BITSUS`) VALUES
(4, 7, 'TORNILLOS', 'tornillos para tabla roca', '2023-11-23 19:10:35', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcattus`
--

CREATE TABLE `tblcattus` (
  `INTIDPUSO` int(11) NOT NULL,
  `STRNOMPUSO` text NOT NULL,
  `STRDESPUSO` text NOT NULL,
  `DTEHOR` datetime NOT NULL,
  `BITSUS` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblcattus`
--

INSERT INTO `tblcattus` (`INTIDPUSO`, `STRNOMPUSO`, `STRDESPUSO`, `DTEHOR`, `BITSUS`) VALUES
(1, 'uso1', 'uso1', '2023-11-13 20:03:02', 1),
(2, 'uso2', 'uso2', '2023-11-13 20:19:58', 1),
(3, 'uso3', 'uso3', '2023-11-14 20:35:16', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcatuni`
--

CREATE TABLE `tblcatuni` (
  `INTIDUNI` int(11) NOT NULL,
  `STRNOMUNI` varchar(30) NOT NULL,
  `STRDESUNI` varchar(150) NOT NULL,
  `DTEHOR` datetime NOT NULL,
  `BITSUS` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tblcatuni`
--

INSERT INTO `tblcatuni` (`INTIDUNI`, `STRNOMUNI`, `STRDESUNI`, `DTEHOR`, `BITSUS`) VALUES
(5, 'Centimetros', 'se mide en centrimetros ', '2023-11-15 21:03:41', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
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
  ADD PRIMARY KEY (`pk_solicitud`),
  ADD KEY `fk_empleado` (`fk_empleado`);

--
-- Indices de la tabla `tblcatcat`
--
ALTER TABLE `tblcatcat`
  ADD PRIMARY KEY (`INTIDCAT`),
  ADD KEY `INTIDCAT` (`INTIDCAT`);

--
-- Indices de la tabla `tblcatemp`
--
ALTER TABLE `tblcatemp`
  ADD PRIMARY KEY (`IDEMP`),
  ADD UNIQUE KEY `STRNSS` (`STRNSS`,`STRRFC`,`STRCUR`) USING HASH,
  ADD KEY `IDEMP` (`IDEMP`);

--
-- Indices de la tabla `tblcatpro`
--
ALTER TABLE `tblcatpro`
  ADD PRIMARY KEY (`STRSKU`(30)),
  ADD KEY `INTIDCAT` (`INTIDCAT`),
  ADD KEY `INTTIPUSO` (`INTTIPUSO`),
  ADD KEY `INTIDUNI` (`INTIDUNI`),
  ADD KEY `INTIDSBC` (`INTIDSBC`);

--
-- Indices de la tabla `tblcatsbc`
--
ALTER TABLE `tblcatsbc`
  ADD PRIMARY KEY (`INTIDSBC`),
  ADD KEY `INTIDCAT` (`INTIDSBC`,`INTIDCAT`),
  ADD KEY `tblcatsbc_ibfk_1` (`INTIDCAT`);

--
-- Indices de la tabla `tblcattus`
--
ALTER TABLE `tblcattus`
  ADD PRIMARY KEY (`INTIDPUSO`),
  ADD KEY `INTIDPUSO` (`INTIDPUSO`);

--
-- Indices de la tabla `tblcatuni`
--
ALTER TABLE `tblcatuni`
  ADD PRIMARY KEY (`INTIDUNI`),
  ADD KEY `INTIDUNI` (`INTIDUNI`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `empleado_permisos`
--
ALTER TABLE `empleado_permisos`
  MODIFY `idempleado_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=550;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `tblcatcat`
--
ALTER TABLE `tblcatcat`
  MODIFY `INTIDCAT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tblcatemp`
--
ALTER TABLE `tblcatemp`
  MODIFY `IDEMP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `tblcatsbc`
--
ALTER TABLE `tblcatsbc`
  MODIFY `INTIDSBC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tblcattus`
--
ALTER TABLE `tblcattus`
  MODIFY `INTIDPUSO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tblcatuni`
--
ALTER TABLE `tblcatuni`
  MODIFY `INTIDUNI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empleado_permisos`
--
ALTER TABLE `empleado_permisos`
  ADD CONSTRAINT `empleado_permisos_ibfk_1` FOREIGN KEY (`idempleado`) REFERENCES `tblcatemp` (`IDEMP`),
  ADD CONSTRAINT `empleado_permisos_ibfk_2` FOREIGN KEY (`idpermiso`) REFERENCES `permisos` (`id`);

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `solicitud_ibfk_1` FOREIGN KEY (`fk_empleado`) REFERENCES `tblcatemp` (`IDEMP`);

--
-- Filtros para la tabla `tblcatpro`
--
ALTER TABLE `tblcatpro`
  ADD CONSTRAINT `tblcatpro_ibfk_1` FOREIGN KEY (`INTIDSBC`) REFERENCES `tblcatsbc` (`INTIDSBC`),
  ADD CONSTRAINT `tblcatpro_ibfk_2` FOREIGN KEY (`INTIDCAT`) REFERENCES `tblcatcat` (`INTIDCAT`),
  ADD CONSTRAINT `tblcatpro_ibfk_3` FOREIGN KEY (`INTTIPUSO`) REFERENCES `tblcattus` (`INTIDPUSO`),
  ADD CONSTRAINT `tblcatpro_ibfk_4` FOREIGN KEY (`INTIDUNI`) REFERENCES `tblcatuni` (`INTIDUNI`);

--
-- Filtros para la tabla `tblcatsbc`
--
ALTER TABLE `tblcatsbc`
  ADD CONSTRAINT `tblcatsbc_ibfk_1` FOREIGN KEY (`INTIDCAT`) REFERENCES `tblcatcat` (`INTIDCAT`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

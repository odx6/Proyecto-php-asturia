-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 29-11-2023 a las 22:34:14
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
(469, 1, 1),
(470, 1, 2),
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
(1, 'Inicio'),
(2, 'Empleados'),
(11, 'Configuracion'),
(12, 'Productos'),
(13, 'Subcategorias'),
(14, 'Solicitud'),
(15, 'Categorias'),
(16, 'Unidades');

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
(2747, 1, '1234', '2023-11-14', 'Everardo Alvaro Agustin cruz ', '50', '422646', 'ry-31617', 'cambiar motor', 'NINGUNA'),
(5759, 1, '2638', '2023-11-14', 'Ramon carmona', '58', '222563', 'wr-2485', 'Cambio de llantas traseras ', 'ninguna'),
(5763, 1, '2638', '2023-11-14', 'Ramon carmona', '58', '222563', 'wr-2485', 'Cambio de llantas traseras ', 'ninguna'),
(5794, 1, '2638', '2023-11-14', 'Ramon carmona', '58', '222563', 'wr-2485', 'Cambio de llantas traseras ', 'ninguna'),
(5799, 1, '2638', '2023-11-14', 'Ramon carmona', '58', '222563', 'wr-2485', 'Cambio de llantas traseras ', 'ninguna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcatalm`
--

CREATE TABLE `tblcatalm` (
  `INTIDALM` int(11) NOT NULL,
  `STRNOMALM` tinytext DEFAULT NULL,
  `DTEHOR` datetime DEFAULT NULL,
  `BITSUS` int(1) DEFAULT NULL,
  `STRDESALM` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `STRCOR` text NOT NULL,
  `STRPWS` text NOT NULL DEFAULT '0',
  `BITSUS` int(1) NOT NULL,
  `STRIMG` text NOT NULL DEFAULT 'view/resources/images/default.png',
  `CREATE_AT` datetime NOT NULL DEFAULT current_timestamp(),
  `TOKEN` text NOT NULL,
  `VERIFICATE_AT` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tblcatemp`
--

INSERT INTO `tblcatemp` (`IDEMP`, `STRNSS`, `STRRFC`, `STRCUR`, `STRNOM`, `STRAPE`, `STRDOM`, `STRLOC`, `STRMUN`, `STREST`, `STRCP`, `STRPAI`, `STRTEL`, `STRCOR`, `STRPWS`, `BITSUS`, `STRIMG`, `CREATE_AT`, `TOKEN`, `VERIFICATE_AT`) VALUES
(1, '543434', '123', 'SDJK544S44A', 'Administrador', 'Administrador', 'las casa num213', 'santa luci', 'santa cruz xoxocotlan ', 'Oaxaca', '71230', 'Mexico', '9152905212', 'admin@admin.com', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 1, 'view/resources/images/Default/perfil.png', '2023-11-11 10:11:13', '', '2023-11-21 13:13:27'),
(24, '12345678910', 'AUCE970202BW4', 'AUCE970202HOCGRVO3', 'Everardo Alvaro', 'Agustin Cruz', 'las casas 912 #206', 'oaxaca', 'santa cruz amilpaz', 'oaxaca', '71230', 'mexico', '9515887515', 'r41325833@gmail.com', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 2, 'view/resources/images/Default/perfil.png', '2023-11-29 21:32:24', '3337b51c5cf1f0377d0f0310c6281687', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcatpro`
--

CREATE TABLE `tblcatpro` (
  `STRSKU` varchar(50) NOT NULL,
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
('12345689', 'BUJIA314', 'BUJIA AGREGADA 12', 4, 45, 5, 'view/resources/images/Productos/1701114375_productoDefault.png', 3, 1, 7, '2023-11-27 20:46:15');

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
-- Estructura de tabla para la tabla `tblcattop`
--

CREATE TABLE `tblcattop` (
  `INTIDTOP` int(11) NOT NULL,
  `STRNOMTPO` tinytext DEFAULT NULL,
  `STRDESTPO` text DEFAULT NULL,
  `DTEHOR` datetime DEFAULT NULL,
  `BITSUS` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblinv`
--

CREATE TABLE `tblinv` (
  `INTIDINV` int(11) NOT NULL,
  `DTEFEC` datetime DEFAULT NULL,
  `INTIDTOP` int(11) DEFAULT NULL,
  `INTTIPMOV` int(11) DEFAULT NULL,
  `INTFOL` int(20) DEFAULT NULL,
  `IDEMP` int(11) DEFAULT NULL,
  `STROBS` text DEFAULT NULL,
  `INTALM` int(11) DEFAULT NULL,
  `DTEHOR` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblinvdet`
--

CREATE TABLE `tblinvdet` (
  `INTIDDET` int(11) NOT NULL,
  `INTIDINV` int(11) DEFAULT NULL,
  `SKU` varchar(50) NOT NULL,
  `STRREF` tinytext DEFAULT NULL,
  `INTCAN` int(11) DEFAULT NULL,
  `INTIDUNI` int(11) DEFAULT NULL,
  `MONPRCOS` double DEFAULT NULL,
  `MONCTOPRO` double DEFAULT NULL,
  `DTEHOR` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbltarinv`
--

CREATE TABLE `tbltarinv` (
  `INTIDTAR` int(11) NOT NULL,
  `INTIDINV` int(11) DEFAULT NULL,
  `DTEFEC` int(11) DEFAULT NULL,
  `SKU` varchar(50) DEFAULT NULL,
  `STRREF` tinytext DEFAULT NULL,
  `INTCAN` int(11) DEFAULT NULL,
  `INTIDUNI` int(11) DEFAULT NULL,
  `MONPRCOS` double DEFAULT NULL,
  `MONCTOPRO` double DEFAULT NULL,
  `INTTIPMOV` int(11) DEFAULT NULL,
  `INTALM` int(11) DEFAULT NULL,
  `DTEHOR` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indices de la tabla `tblcatalm`
--
ALTER TABLE `tblcatalm`
  ADD PRIMARY KEY (`INTIDALM`);

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
  ADD KEY `INTIDSBC` (`INTIDSBC`),
  ADD KEY `STRSKU` (`STRSKU`);

--
-- Indices de la tabla `tblcatsbc`
--
ALTER TABLE `tblcatsbc`
  ADD PRIMARY KEY (`INTIDSBC`),
  ADD KEY `INTIDCAT` (`INTIDSBC`,`INTIDCAT`),
  ADD KEY `tblcatsbc_ibfk_1` (`INTIDCAT`);

--
-- Indices de la tabla `tblcattop`
--
ALTER TABLE `tblcattop`
  ADD PRIMARY KEY (`INTIDTOP`);

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
-- Indices de la tabla `tblinv`
--
ALTER TABLE `tblinv`
  ADD PRIMARY KEY (`INTIDINV`),
  ADD KEY `IDEMP` (`IDEMP`),
  ADD KEY `INTALM` (`INTALM`),
  ADD KEY `INTIDTOP` (`INTIDTOP`);

--
-- Indices de la tabla `tblinvdet`
--
ALTER TABLE `tblinvdet`
  ADD PRIMARY KEY (`INTIDDET`),
  ADD KEY `INTIDINV` (`INTIDINV`),
  ADD KEY `INTIDUNI` (`INTIDUNI`),
  ADD KEY `SKU` (`SKU`);

--
-- Indices de la tabla `tbltarinv`
--
ALTER TABLE `tbltarinv`
  ADD PRIMARY KEY (`INTIDTAR`),
  ADD KEY `INTIDINV` (`INTIDINV`),
  ADD KEY `SKU` (`SKU`),
  ADD KEY `INTIDUNI` (`INTIDUNI`),
  ADD KEY `INTALM` (`INTALM`);

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
  MODIFY `idempleado_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=599;

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
-- AUTO_INCREMENT de la tabla `tblcatalm`
--
ALTER TABLE `tblcatalm`
  MODIFY `INTIDALM` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblcatcat`
--
ALTER TABLE `tblcatcat`
  MODIFY `INTIDCAT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tblcatemp`
--
ALTER TABLE `tblcatemp`
  MODIFY `IDEMP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `tblcatsbc`
--
ALTER TABLE `tblcatsbc`
  MODIFY `INTIDSBC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tblcattop`
--
ALTER TABLE `tblcattop`
  MODIFY `INTIDTOP` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT de la tabla `tblinv`
--
ALTER TABLE `tblinv`
  MODIFY `INTIDINV` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblinvdet`
--
ALTER TABLE `tblinvdet`
  MODIFY `INTIDDET` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbltarinv`
--
ALTER TABLE `tbltarinv`
  MODIFY `INTIDTAR` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empleado_permisos`
--
ALTER TABLE `empleado_permisos`
  ADD CONSTRAINT `empleado_permisos_ibfk_1` FOREIGN KEY (`idempleado`) REFERENCES `tblcatemp` (`IDEMP`) ON DELETE CASCADE ON UPDATE CASCADE,
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

--
-- Filtros para la tabla `tblinv`
--
ALTER TABLE `tblinv`
  ADD CONSTRAINT `tblinv_ibfk_1` FOREIGN KEY (`IDEMP`) REFERENCES `tblcatemp` (`IDEMP`),
  ADD CONSTRAINT `tblinv_ibfk_2` FOREIGN KEY (`INTALM`) REFERENCES `tblcatalm` (`INTIDALM`),
  ADD CONSTRAINT `tblinv_ibfk_3` FOREIGN KEY (`INTIDTOP`) REFERENCES `tblcattop` (`INTIDTOP`);

--
-- Filtros para la tabla `tblinvdet`
--
ALTER TABLE `tblinvdet`
  ADD CONSTRAINT `tblinvdet_ibfk_1` FOREIGN KEY (`INTIDINV`) REFERENCES `tblinv` (`INTIDINV`),
  ADD CONSTRAINT `tblinvdet_ibfk_2` FOREIGN KEY (`INTIDUNI`) REFERENCES `tblcatuni` (`INTIDUNI`),
  ADD CONSTRAINT `tblinvdet_ibfk_3` FOREIGN KEY (`SKU`) REFERENCES `tblcatpro` (`STRSKU`);

--
-- Filtros para la tabla `tbltarinv`
--
ALTER TABLE `tbltarinv`
  ADD CONSTRAINT `tbltarinv_ibfk_1` FOREIGN KEY (`INTIDINV`) REFERENCES `tblinv` (`INTIDINV`),
  ADD CONSTRAINT `tbltarinv_ibfk_2` FOREIGN KEY (`SKU`) REFERENCES `tblcatpro` (`STRSKU`),
  ADD CONSTRAINT `tbltarinv_ibfk_3` FOREIGN KEY (`INTIDUNI`) REFERENCES `tblcatuni` (`INTIDUNI`),
  ADD CONSTRAINT `tbltarinv_ibfk_4` FOREIGN KEY (`INTALM`) REFERENCES `tblcatalm` (`INTIDALM`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

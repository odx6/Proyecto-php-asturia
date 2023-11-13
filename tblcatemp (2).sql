-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 11-11-2023 a las 21:08:26
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
  `CREATE_AT` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tblcatemp`
--

INSERT INTO `tblcatemp` (`IDEMP`, `STRNSS`, `STRRFC`, `STRCUR`, `STRNOM`, `STRAPE`, `STRDOM`, `STRLOC`, `STRMUN`, `STREST`, `STRCP`, `STRPAI`, `STRTEL`, `STRCOR`, `STRPWS`, `BITSUS`, `STRIMG`, `CREATE_AT`) VALUES
(1, '543434', 'view/resources/images/1699457636_avatar2.gif', 'Administrador', 'Administrador', 'admin', 'admin@admin.com', '67a74306b06d0c01624fe0d0249a570f4d093747', 'Oaxaca', 'Oaxaca', '951515642287', '951515642287', '1', '1', '0', b'0', 'view/resources/images/default.png', '2023-11-11 10:11:13'),
(3, '123456', 'view/resources/images/default.png', 'Ranulfos', 'Sanchez', 'Ranulfoss', 'alphant76@hotmail.com', '67a74306b06d0c01624fe0d0249a570f4d093747', 'Conocido', 'OAXACA DE JUAREZ', '123456', '123456', '45', '1', '0', b'1', 'view/resources/images/default.png', '2023-11-11 10:11:13'),
(4, '240', 'view/resources/images/default.png', 'Eduardo', 'Ramirez Luna', 'lalo4678', 'lalo4678@hotmail.com', 'b500474d9b3a8caf99e2d15e79b176d28e5435e1', 'Santa Lucia', 'Oaxaca', '95151139', '951139', '139', '1', '0', b'1', 'view/resources/images/default.png', '2023-11-11 10:11:13'),
(5, '555', 'view/resources/images/default.png', 'Ever', 'Agustin', 'Ever', 'Ever@gmail.com', '67a74306b06d0c01624fe0d0249a570f4d093747', 'Conocido', 'OAXACA', '9512905212', '9512125212', '1234', '1', '0', b'1', 'view/resources/images/default.png', '2023-11-11 10:11:13'),
(6, '6', 'view/resources/images/default.png', 'Ramon ', 'valdez ', 'Ramon ', 'Ramon@gmail.com', '67a74306b06d0c01624fe0d0249a570f4d093747', 'Conocido', 'OAXACA', '9512905212', '9512125212', '1234', '1', '0', b'1', 'view/resources/images/default.png', '2023-11-11 10:11:13');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tblcatemp`
--
ALTER TABLE `tblcatemp`
  ADD PRIMARY KEY (`IDEMP`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tblcatemp`
--
ALTER TABLE `tblcatemp`
  MODIFY `IDEMP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-11-2022 a las 03:26:24
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `registroasesor`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adviser`
--

CREATE TABLE `adviser` (
  `IdAsesor` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `cedula` int(11) NOT NULL,
  `telefono` int(11) NOT NULL,
  `fechanacimiento` datetime NOT NULL,
  `genero` varchar(20) NOT NULL,
  `clientetrabajo` varchar(50) NOT NULL,
  `sede` varchar(50) NOT NULL,
  `userregistro` varchar(50) NOT NULL,
  `edad` int(11) NOT NULL,
  `fechacreacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `adviser`
--

INSERT INTO `adviser` (`IdAsesor`, `nombre`, `cedula`, `telefono`, `fechanacimiento`, `genero`, `clientetrabajo`, `sede`, `userregistro`, `edad`, `fechacreacion`) VALUES
(1, 'Andrea', 2147483647, 32432432, '2002-06-14 00:00:00', 'Femenino', 'Nutresa', 'Puerto Seco', 'comunicaciones', 20, '2022-11-13 19:56:18'),
(5, 'Angela', 1002332423, 123131, '2008-02-05 21:08:00', 'Femenino', 'Nutresa', 'Ruta N', 'Comunicaciones', 14, '2022-11-15 02:08:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `IdUsuario` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `activo` bit(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`IdUsuario`, `usuario`, `password`, `activo`) VALUES
(3, 'comunicaciones', '3c3c996b90a265ea0ace52fda6adc901', b'01'),
(4, 'gestion', '0b16ecbb7bd154616defe4d50e2dde4d', b'01'),
(5, 'prueba', '202cb962ac59075b964b07152d234b70', b'00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_token`
--

CREATE TABLE `usuarios_token` (
  `IdToken` int(11) NOT NULL,
  `UsuarioId` int(11) NOT NULL,
  `Token` varchar(250) NOT NULL,
  `Estado` int(11) NOT NULL,
  `Fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios_token`
--

INSERT INTO `usuarios_token` (`IdToken`, `UsuarioId`, `Token`, `Estado`, `Fecha`) VALUES
(1, 3, '690d000c2a68b3fad5d29dbfe2e2ff1e', 1, '2022-11-13 20:42:00'),
(2, 3, '12f4c4d365b777cdb00485e4f4cca3be', 1, '2022-11-14 06:32:00'),
(3, 3, '0eab031d1029156554fbfe899cf1de4b', 1, '2022-11-14 06:45:00'),
(4, 3, 'f3af53a7a60fa9676d024ba68dcccd42', 1, '2022-11-14 07:06:00'),
(5, 3, '890d7c8461e8e8dff9d054f7c204e97f', 1, '2022-11-14 07:38:00'),
(6, 3, 'da161323fb082a91f1a96c81ae4fe4e9', 1, '2022-11-14 12:07:00'),
(7, 3, '903a4bc038855ad4b93ae9b0a8ae0ef8', 1, '2022-11-14 22:41:00'),
(8, 3, '9099b2c6b75490547e58170e3b358586', 1, '2022-11-14 23:34:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adviser`
--
ALTER TABLE `adviser`
  ADD PRIMARY KEY (`IdAsesor`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`IdUsuario`);

--
-- Indices de la tabla `usuarios_token`
--
ALTER TABLE `usuarios_token`
  ADD PRIMARY KEY (`IdToken`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adviser`
--
ALTER TABLE `adviser`
  MODIFY `IdAsesor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios_token`
--
ALTER TABLE `usuarios_token`
  MODIFY `IdToken` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

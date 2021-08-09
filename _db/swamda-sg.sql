-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-08-2021 a las 11:27:44
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `swamda-sg`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendar_data`
--

CREATE TABLE `calendar_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `start` date NOT NULL,
  `end` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `url` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `auth` int(10) UNSIGNED NOT NULL,
  `auth_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `calendar_data`
--

INSERT INTO `calendar_data` (`id`, `title`, `start`, `end`, `start_time`, `end_time`, `url`, `auth`, `auth_date`) VALUES
(1, 'Horario de mañana', '2021-08-09', '2021-08-09', '10:00:00', '13:30:00', NULL, 1, '2021-08-08 22:11:01'),
(2, 'Horario de mañana', '2021-08-10', '2021-08-10', '10:00:00', '13:30:00', NULL, 1, '2021-08-08 22:11:01'),
(4, 'Horario de mañana', '2021-08-12', '2021-08-12', '10:00:00', '13:30:00', NULL, 1, '2021-08-08 22:11:01'),
(5, 'Horario de mañana', '2021-08-13', '2021-08-13', '10:00:00', '13:30:00', NULL, 1, '2021-08-08 22:11:01'),
(6, 'Horario de mañana', '2021-08-09', '2021-08-09', '10:00:00', '13:30:00', NULL, 2, '2021-08-08 22:11:01'),
(7, 'Horario de mañana', '2021-08-10', '2021-08-10', '10:00:00', '13:30:00', NULL, 2, '2021-08-08 22:11:01'),
(8, 'Horario de mañana', '2021-08-11', '2021-08-11', '10:00:00', '13:30:00', NULL, 2, '2021-08-08 22:11:01'),
(9, 'Horario de mañana', '2021-08-12', '2021-08-12', '10:00:00', '13:30:00', NULL, 2, '2021-08-08 22:11:01'),
(10, 'Horario de mañana', '2021-08-13', '2021-08-13', '10:00:00', '13:30:00', NULL, 2, '2021-08-08 22:11:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `name`) VALUES
(1, 'Empleado'),
(2, 'Gerente'),
(3, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(512) COLLATE utf8_spanish_ci NOT NULL,
  `realname` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `realsurname` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `auth_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `rol` tinyint(4) UNSIGNED NOT NULL,
  `color` varchar(9) COLLATE utf8_spanish_ci DEFAULT NULL,
  `flag_activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `realname`, `realsurname`, `phone`, `email`, `auth_date`, `rol`, `color`, `flag_activo`) VALUES
(1, 'POLIVA', '$2a$07$SwamDAsG52570b6fcf2eb.4NvdKoSWgs6Q0fv9.Vl0bOF8ciU/MP6', 'Pedro', 'Oliva Gil', '663631377', 'onion_oliva@hotmail.com', '2021-08-07 19:20:24', 3, '#990000', 1),
(2, 'AZA', '$2a$07$SwamDAsG52570b6fcf2eb.lG6Zh5BN4i9ObKRDzmZv.pJGENSgeYO', 'Azahara', 'Arribas Carrascal', '653035072', 'tralarilolali2@gmail.com', '2021-08-08 22:06:39', 3, '#FC126A', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userlogin`
--

CREATE TABLE `userlogin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `date_login` date NOT NULL DEFAULT current_timestamp(),
  `time_login` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `userlogin`
--

INSERT INTO `userlogin` (`id`, `id_user`, `date_login`, `time_login`) VALUES
(1, 1, '2021-08-07', '21:20:36'),
(2, 1, '2021-08-08', '01:42:30'),
(3, 1, '2021-08-08', '23:52:16'),
(4, 1, '2021-08-09', '00:05:31'),
(5, 2, '2021-08-09', '00:07:23'),
(6, 2, '2021-08-09', '00:10:11'),
(7, 2, '2021-08-09', '00:16:19'),
(8, 2, '2021-08-09', '00:20:57'),
(9, 2, '2021-08-09', '01:11:43'),
(10, 2, '2021-08-09', '01:28:45'),
(11, 2, '2021-08-09', '09:32:54'),
(12, 1, '2021-08-09', '09:35:23'),
(13, 1, '2021-08-09', '09:41:31'),
(14, 1, '2021-08-09', '10:00:45');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calendar_data`
--
ALTER TABLE `calendar_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth` (`auth`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `rol` (`rol`);

--
-- Indices de la tabla `userlogin`
--
ALTER TABLE `userlogin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calendar_data`
--
ALTER TABLE `calendar_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `userlogin`
--
ALTER TABLE `userlogin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calendar_data`
--
ALTER TABLE `calendar_data`
  ADD CONSTRAINT `calendar_data_ibfk_1` FOREIGN KEY (`auth`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `userlogin`
--
ALTER TABLE `userlogin`
  ADD CONSTRAINT `userlogin_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

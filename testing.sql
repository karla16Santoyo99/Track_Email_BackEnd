-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-07-2022 a las 00:28:09
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `testing`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `email_data`
--

CREATE TABLE `email_data` (
  `email_id` int(11) NOT NULL,
  `email_subject` varchar(255) NOT NULL,
  `email_body` text NOT NULL,
  `email_address` text NOT NULL,
  `email_track_code` varchar(100) NOT NULL,
  `email_status` enum('no','yes') NOT NULL,
  `email_open_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `email_data`
--

INSERT INTO `email_data` (`email_id`, `email_subject`, `email_body`, `email_address`, `email_track_code`, `email_status`, `email_open_datetime`) VALUES
(5, 'judith99santoyo16@gmail.com', 'holis', 'judith99santoyo16@gmail.com', '2fd1e150a0ddc662cd124373551c320b', 'no', '0000-00-00 00:00:00'),
(6, 'Testing email', 'testing holis', 'judith99santoyo16@gmail.com', '43b146a3f2d300dc14973532cb5d0531', 'no', '0000-00-00 00:00:00'),
(7, 'Testing email', 'testing', 'judith99santoyo16@gmail.com', 'cb06ee511bd91a999773e8dff4f24b8b', 'no', '0000-00-00 00:00:00'),
(8, 'Testing email', 'testing', 'judith99santoyo16@gmail.com', '22df70d5edc366808b9e5cc06ab5c5a8', 'no', '0000-00-00 00:00:00'),
(9, 'Testing email', 'testing', 'judith99santoyo16@gmail.com', 'b0b99b3f99d409ec56812dfef3c07609', 'no', '0000-00-00 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `email_data`
--
ALTER TABLE `email_data`
  ADD PRIMARY KEY (`email_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `email_data`
--
ALTER TABLE `email_data`
  MODIFY `email_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

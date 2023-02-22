-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-02-2023 a las 18:52:19
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectocursos`
--
CREATE DATABASE IF NOT EXISTS `proyectocursos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `proyectocursos`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ponentes`
--

CREATE TABLE `ponentes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `redes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ponentes`
--

INSERT INTO `ponentes` (`id`, `nombre`, `apellidos`, `correo`, `imagen`, `tags`, `redes`) VALUES
(11, 'Ferran ', 'Adrià', 'ferranadria@gmail.com ', 'ferran.jpg', 'Cocinero Chef', 'ferranadria'),
(12, 'Karlos ', 'Arguiñano', 'carlosarguiñano@gmail.com', 'carloscocina.jpeg', 'Cocinero Chef', 'carlosarguiñanooficial'),
(13, 'Ángel ', 'León', 'angelleoncocina@gmail.com', 'angelleon.png', 'Michellin Chef', 'angelleoncocina'),
(14, 'Pedro', 'Subijana', 'pedrodubijana@gmail.es', 'pedrito.jpeg', 'Cocinero Michelin', 'subijanaoficial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(255) NOT NULL,
  `confirmado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `password`, `rol`, `confirmado`) VALUES
(2, 'Jose', 'Lopez', 'pablo.cid.olmos@gmail.com', '$2y$10$veMqO8Z.hpOAbMv5sIoEeufyB9XFMwp2DBkdjYHirhuN3NvMIppwe', 'user', 0),
(3, 'David', 'Diaz lopez', 'davilillo@gmail.com', '$2y$10$94n/raoVPRzqzXHPR/5aR.TMzBgVtGR8GPBT9qLt1KpmbyPoyebXa', 'user', 0),
(4, 'David', 'Cid Olmos', 'david@gmail.com', '$2y$10$7.m4a8lEcigX3q6S550bxuB0sYpeTAM8OpSQFRUg5gWl/478TDe.y', 'user', 0),
(8, 'Javier', 'Fernandez', 'javierfer@gmail.com', '$2y$10$sThbe.UeFqW.UXPUt4oGT.yyjL2k6cBTaL.3DERGNurvAYPirWOWe', 'user', 0),
(9, 'Carmensita', 'Carmenchu', 'carmen@gmail.com', '$2y$10$1pF00x7k99rS4yks5D5.S.ZbYjisu4tS1E086AZ7we1yepXG4DE4e', 'user', 0),
(13, 'admin', 'admin', 'admin@admin.es', '$2y$10$T5gm0N2wW6aixgP3D3.lj.hBtUi/fq0X4ZW2LrI/yYaATLw1C9yaS', 'user', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ponentes`
--
ALTER TABLE `ponentes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ponentes`
--
ALTER TABLE `ponentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

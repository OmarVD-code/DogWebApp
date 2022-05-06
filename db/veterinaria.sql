-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-05-2022 a las 02:48:14
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `veterinaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id`, `nombre`, `email`, `password`) VALUES
(1, 'ADMINISTRADOR', 'admin@demo.com', '4b0143fbdfd67f09bc1a3db12109cc2f');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `email`, `password`) VALUES
(1, 'ADMINISTRADOR', '', ''),
(2, 'Poppy Harlow', 'poppy@gmail.com', 'd7d6cd05d5e3ccd5c875ae8a530255eb'),
(3, 'Zack Holden', 'zack@gmail.com', '38ba6e4737a6d1385f8d3f6c48615e6a'),
(4, 'Mike Posner', 'mike@gmail.com', '24b7700ef56361fa066204f67c65fc4f'),
(5, 'Henry Jones', 'henry@gmail.com', '598d6af0d9494160f1398e01b873646e'),
(6, 'Kevin Vela', 'kevin@gmail.com', 'ac8b417196e3dc30cdcec00ef5dcd821'),
(8, 'Jane Douglas', 'jane@gmail.com', 'a06aa9e5c9a02ba655d4f24875768adf'),
(9, 'Becky Walden', 'becky@gmail.com', '3590fc7164cb972a40497a17f8dcde31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

CREATE TABLE `consultas` (
  `id` int(11) NOT NULL,
  `id_perro` int(11) NOT NULL,
  `id_veterinario` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `consultas`
--

INSERT INTO `consultas` (`id`, `id_perro`, `id_veterinario`, `fecha`) VALUES
(3, 9, 1, '2022-05-12'),
(4, 3, 2, '2022-05-19'),
(5, 13, 3, '2022-05-07'),
(6, 3, 3, '2022-06-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perros`
--

CREATE TABLE `perros` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `genero` tinyint(1) NOT NULL,
  `raza` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_amo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `perros`
--

INSERT INTO `perros` (`id`, `nombre`, `fechaNacimiento`, `genero`, `raza`, `foto`, `id_amo`) VALUES
(2, 'Lucy', '2022-01-30', 0, 'Pequinés', 'IMG-626f0d78e838e6.74153555.jpg', 9),
(3, 'Bernardeschi', '2021-07-07', 1, 'San Bernardo', 'IMG-626f0dec655505.10418066.jpg', 9),
(4, 'Bernard', '2022-05-03', 1, 'San Bernardo', 'IMG-626f0f5698fb20.89562683.jpg', 6),
(9, 'Bea', '2022-05-03', 0, 'Pequinés', 'IMG-626f45c58bf593.22533074.jpg', 9),
(13, 'Matthew', '2022-05-12', 1, 'San Bernardo', 'IMG-626f55a2cb6d64.83540186.jpg', 9),
(18, 'Solitario', '2022-05-06', 1, 'Pitbull', 'IMG-6270bae892a7f6.33821022.jpg', 3),
(19, 'Solitario2', '2022-05-06', 1, 'Pitbull', 'IMG-6270bb0c27e139.94991181.jpg', 1),
(21, 'Mary2', '2022-05-06', 0, 'Chihuahua', 'IMG-627170924e5404.72311677.jpg', 3),
(22, 'Bobby', '2022-05-10', 1, 'Bulldog', 'IMG-627172ad85d996.25348055.jpg', 2),
(23, 'Juanito', '2021-08-11', 1, 'Bulldog', 'IMG-6271746ac54a09.44693877.jpg', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `veterinarios`
--

CREATE TABLE `veterinarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `honorario` float NOT NULL,
  `id_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `veterinarios`
--

INSERT INTO `veterinarios` (`id`, `nombre`, `email`, `password`, `honorario`, `id_admin`) VALUES
(1, 'John Doe', 'john.doe@gmail.com', '6579e96f76baa00787a28653876c6127', 1000, 1),
(2, 'Otto Hayes', 'otto@gmail.com', 'c27558520b2dd9fd072a48091071014c', 2500, 1),
(3, 'Carmelo Sanders', 'carmelo@gmail.com', '7e56ce0292f6c656d726f5a268313b55', 600, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_perro` (`id_perro`),
  ADD KEY `id_veterinario` (`id_veterinario`);

--
-- Indices de la tabla `perros`
--
ALTER TABLE `perros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_amo` (`id_amo`);

--
-- Indices de la tabla `veterinarios`
--
ALTER TABLE `veterinarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_admin` (`id_admin`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `consultas`
--
ALTER TABLE `consultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `perros`
--
ALTER TABLE `perros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `veterinarios`
--
ALTER TABLE `veterinarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD CONSTRAINT `consultas_ibfk_1` FOREIGN KEY (`id_perro`) REFERENCES `perros` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `consultas_ibfk_2` FOREIGN KEY (`id_veterinario`) REFERENCES `veterinarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `perros`
--
ALTER TABLE `perros`
  ADD CONSTRAINT `perros_ibfk_1` FOREIGN KEY (`id_amo`) REFERENCES `clientes` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `veterinarios`
--
ALTER TABLE `veterinarios`
  ADD CONSTRAINT `veterinarios_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `administradores` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-11-2023 a las 17:27:40
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
-- Base de datos: `futbol`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidos`
--

CREATE TABLE `partidos` (
  `lugar` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `equipacion` varchar(30) NOT NULL,
  `cod_partido` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `partidos`
--

INSERT INTO `partidos` (`lugar`, `fecha`, `equipacion`, `cod_partido`) VALUES
('Estadio Santiago Bernabéu', '2023-11-10', 'local', 1),
('Camp Nou', '2023-11-12', 'visitante', 2),
('Estadio Wanda Metropolitano', '2023-11-15', 'visitante', 3),
('Estadio Ramón Sánchez-Pizjuán', '2023-11-18', 'local', 4),
('Mestalla', '2023-11-20', 'local', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `rol` int(1) NOT NULL,
  `dni` varchar(10) NOT NULL,
  `contraseña` varchar(100) NOT NULL,
  `usuario` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nombre`, `apellidos`, `correo`, `rol`, `dni`, `contraseña`, `usuario`) VALUES
('Carlos', 'Gómez', 'carlos@gmail.com', 0, '12345678A', 'b43cb7705522b2d46f054e988ae170462cff98bd6c0291290660d41fae6c6d25', 'cargom12'),
('Elena', 'Fernández', 'elena@gmail.com', 0, '23456789B', 'f7b813a6a29496930fa3c7981211238e89ea737052c77bf0b1d77778e1939ae4', 'elefer23'),
('Javier', 'López', 'javier@gmail.com', 0, '34567890C', 'cbf349a43bfef45891e5447aa94925bed975055a817a55234b98f53054655181', 'javlop34'),
('Ana', 'Martínez', 'ana@gmail.com', 0, '45678901D', 'e9edfe80ab16bc782a436eaf38c231c7dc5154c677dde27aa5b1d6d3b2a8731e', 'anamar45'),
('Admin', 'Administrador', 'admin@gmail.com', 1, '56789012E', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_tienen_partidos`
--

CREATE TABLE `usuarios_tienen_partidos` (
  `dni` varchar(8) NOT NULL,
  `cod_partido` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `partidos`
--
ALTER TABLE `partidos`
  ADD PRIMARY KEY (`cod_partido`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `usuarios_tienen_partidos`
--
ALTER TABLE `usuarios_tienen_partidos`
  ADD PRIMARY KEY (`dni`,`cod_partido`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

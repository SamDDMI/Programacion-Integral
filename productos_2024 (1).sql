-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-10-2024 a las 09:52:10
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `productos_2024`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_descargas`
--

CREATE TABLE `catalogo_descargas` (
  `id` int(11) NOT NULL,
  `nombre_apellido` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fecha_descarga` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `catalogo_descargas`
--

INSERT INTO `catalogo_descargas` (`id`, `nombre_apellido`, `telefono`, `email`, `fecha_descarga`) VALUES
(1, 'Samuel Carrera', '6561348028', 'samuelcedillo02@gmail.com', '2024-10-01 07:23:42'),
(2, 'Samuel Carrera', '6561348028', 'samuelcedillo02@gmail.com', '2024-10-01 07:25:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `imagen`, `categoria`, `file_name`) VALUES
(1, 'Camiseta', 'Camiseta del doctorado', 'uploads/polo 3.jpg', 'Software', NULL),
(2, 'Camiseta', 'Camiseta del doctorado', 'uploads/polo.jpg', 'Software', NULL),
(3, 'salmon de japon', 'pescado bien rico', 'uploads/347547633_948522706293666_157573763638785505_n.jpg', 'Antropometría', NULL),
(4, 'salmon de iberia', 'salmon bien ricote', 'uploads/347408070_4211239132434491_8078323003434831513_n.jpg', 'Bitalino', NULL),
(7, 'salmon de japon 3', 'sajhasjhdsaj', 'uploads/imagen_2024-09-26_235852327.png', 'Manuales', NULL),
(8, 'salmon de japon 3', 'sajhasjhdsaj', 'uploads/imagen_2024-09-26_235852327.png', 'Manuales', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_contactos`
--

CREATE TABLE `tabla_contactos` (
  `id` int(11) NOT NULL,
  `nombre_apellido` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `empresa` varchar(255) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tabla_contactos`
--

INSERT INTO `tabla_contactos` (`id`, `nombre_apellido`, `telefono`, `email`, `empresa`, `fecha_registro`) VALUES
(1, 'Samuel Carrera', '6561348028', 'samuelcedillo02@gmail.com', 'ergo', '2024-10-01 07:39:49'),
(2, 'Samuel Carrera', '6561348028', 'samuelcedillo02@gmail.com', 'ergo', '2024-10-01 07:44:17'),
(3, 'Samuel Carrera', '6561348028', 'samuel.carrera3@facebook.com', 'ergod', '2024-10-01 07:50:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`) VALUES
(1, 'ergoadmin', '$2y$10$KkuaiecThx3bY6Iq.438yedF0/lOheu1zxpsRDOdycJZ6gIyKj21.');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `catalogo_descargas`
--
ALTER TABLE `catalogo_descargas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tabla_contactos`
--
ALTER TABLE `tabla_contactos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `catalogo_descargas`
--
ALTER TABLE `catalogo_descargas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tabla_contactos`
--
ALTER TABLE `tabla_contactos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

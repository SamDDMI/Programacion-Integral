-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2024 at 10:27 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `productos_2024`
--

-- --------------------------------------------------------

--
-- Table structure for table `catalogo_descargas`
--

CREATE TABLE `catalogo_descargas` (
  `id` int(11) NOT NULL,
  `nombre_apellido` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fecha_descarga` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `catalogo_descargas`
--

INSERT INTO `catalogo_descargas` (`id`, `nombre_apellido`, `telefono`, `email`, `fecha_descarga`) VALUES
(1, 'Samuel Carrera', '6561348028', 'samuelcedillo02@gmail.com', '2024-10-01 07:23:42'),
(2, 'Samuel Carrera', '6561348028', 'samuelcedillo02@gmail.com', '2024-10-01 07:25:22');

-- --------------------------------------------------------

--
-- Table structure for table `productos`
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
-- Dumping data for table `productos`
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
-- Table structure for table `tabla_contactos`
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
-- Dumping data for table `tabla_contactos`
--

INSERT INTO `tabla_contactos` (`id`, `nombre_apellido`, `telefono`, `email`, `empresa`, `fecha_registro`) VALUES
(1, 'Samuel Carrera', '6561348028', 'samuelcedillo02@gmail.com', 'ergo', '2024-10-01 07:39:49'),
(2, 'Samuel Carrera', '6561348028', 'samuelcedillo02@gmail.com', 'ergo', '2024-10-01 07:44:17'),
(3, 'Samuel Carrera', '6561348028', 'samuel.carrera3@facebook.com', 'ergod', '2024-10-01 07:50:06');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`) VALUES
(1, 'ergoadmin', '$2y$10$KkuaiecThx3bY6Iq.438yedF0/lOheu1zxpsRDOdycJZ6gIyKj21.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catalogo_descargas`
--
ALTER TABLE `catalogo_descargas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabla_contactos`
--
ALTER TABLE `tabla_contactos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catalogo_descargas`
--
ALTER TABLE `catalogo_descargas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tabla_contactos`
--
ALTER TABLE `tabla_contactos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

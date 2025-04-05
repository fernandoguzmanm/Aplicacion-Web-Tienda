
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2025 at 06:46 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS tienda;
USE tienda;

--
-- Database: `tienda`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(10) NOT NULL,
  `nombre` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`) VALUES
(1, 'frutas'),
(2, 'cereales'),
(3, 'lacteos'),
(4, 'dulces'),
(5, 'refrescos');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id_mensaje` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `mensaje` varchar(400) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detalles_pedido`
--

CREATE TABLE `detalles_pedido` (
  `id_pedido` int(10) NOT NULL,
  `id_producto` int(10) NOT NULL,
  `cantidad` int(5) NOT NULL,
  `precio_unidad` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `fecha_pedido` date NOT NULL,
  `estado` enum('pendiente','enviado','entregado','cancelado') NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(7) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(10) NOT NULL,
  `id_vendedor` int(10) NOT NULL,
  `id_categoria` int(10) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `descripcion`, `precio`, `stock`, `id_vendedor`, `id_categoria`, `imagen`) VALUES
(1, 'pepino', 'fruta', 1.39, 20, 1, 1, 'pepino.jpg'),
(2, 'platanos', 'fruta', 3.49, 20, 1, 1, 'platanos.jpg'),
(3, 'tomates', 'fruta', 1.59, 20, 1, 1, 'tomates.jpg'),
(4, 'naranja', 'fruta', 1.79, 20, 1, 1, 'naranjas.jpg'),
(5, 'arroz', 'cereales', 1.39, 20, 2, 2, 'arroz.jpg'),
(6, 'leche', 'lacteo', 0.89, 20, 3, 3, 'leche.png'),
(7, 'yogur', 'lacteo', 2.39, 20, 3, 3, 'yogur.png'),
(8, 'queso', 'lacteo', 1.59, 20, 3, 3, 'queso.png'),
(9, 'chocolate', 'dulce', 1.79, 20, 2, 4, 'chocolate.png')
(10, 'manzana', 'fruta fresca y crujiente', 2.29, 30, 1, 1, 'manzana.jpg'),
(11, 'pan integral', 'cereal saludable', 1.99, 25, 2, 2, 'pan_integral.jpg'),
(12, 'mantequilla', 'producto lácteo para untar', 2.49, 20, 3, 3, 'mantequilla.png'),
(13, 'galletas', 'dulces caseras de chocolate', 1.89, 40, 2, 4, 'galletas.jpg'),
(14, 'limonada', 'refresco natural de limón', 1.59, 50, 1, 5, 'limonada.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `puntos_fidelidad`
--

CREATE TABLE `puntos_fidelidad` (
  `id_puntos` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `puntos_acumulados` int(5) NOT NULL,
  `fecha_caducidad` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reseñas`
--

CREATE TABLE `reseñas` (
  `id_reseña` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `id_producto` int(10) NOT NULL,
  `puntuación` int(2) NOT NULL CHECK (`puntuación` between 1 and 5),
  `comentario` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `tipo_usuario` enum('cliente','vendedor','administrador') NOT NULL,
  `puntos_fidelidad` int(5) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `email`, `contraseña`, `tipo_usuario`, `puntos_fidelidad`) VALUES
(1, 'Vendedor1', 'vendedor1@gmail.com', 'v1', 'vendedor', 0),
(2, 'Vendedor2', 'vendedor2@gmail.com', 'v2', 'vendedor', 0),
(3, 'fer', 'fer@gmail.com', '1234', 'vendedor', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_mensaje`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  ADD PRIMARY KEY (`id_pedido`,`id_producto`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_vendedor` (`id_vendedor`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indexes for table `puntos_fidelidad`
--
ALTER TABLE `puntos_fidelidad`
  ADD PRIMARY KEY (`id_puntos`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `reseñas`
--
ALTER TABLE `reseñas`
  ADD PRIMARY KEY (`id_reseña`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id_mensaje` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `puntos_fidelidad`
--
ALTER TABLE `puntos_fidelidad`
  MODIFY `id_puntos` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reseñas`
--
ALTER TABLE `reseñas`
  MODIFY `id_reseña` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Constraints for table `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  ADD CONSTRAINT `detalles_pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalles_pedido_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE;

--
-- Constraints for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_vendedor`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE;

--
-- Constraints for table `puntos_fidelidad`
--
ALTER TABLE `puntos_fidelidad`
  ADD CONSTRAINT `puntos_fidelidad_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Constraints for table `reseñas`
--
ALTER TABLE `reseñas`
  ADD CONSTRAINT `reseñas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `reseñas_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

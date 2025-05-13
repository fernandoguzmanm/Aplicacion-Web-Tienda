
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
-- Table structure for table `detalles_pedido`
--

CREATE TABLE `detalles_pedido` (
  `id_pedido` int(10) NOT NULL,
  `id_producto` int(10) NOT NULL,
  `cantidad` int(5) NOT NULL,
  `precio_unidad` decimal(10,2) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `id_vendedor` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `detalles_pedido`
--

INSERT INTO `detalles_pedido` (`id_pedido`, `id_producto`, `cantidad`, `precio_unidad`, `nombre`, `id_vendedor`) VALUES
-- Pedido 1
(1, 1, 2, 1.39, 'pepino', 1),
(1, 2, 1, 1.59, 'platanos', 1),

-- Pedido 2
(2, 21, 2, 4.99, 'tarta de queso', 2),
(2, 17, 1, 2.49, 'avena', 2),
(2, 6, 2, 0.89, 'leche', 3),

-- Pedido 3
(3, 24, 7, 0.99, 'agua con gas', 1),
(3, 16, 6, 2.99, 'kiwi', 1),

-- Pedido 4
(4, 3, 4, 1.59, 'tomates', 2),
(4, 5, 5, 1.39, 'arroz', 2),
(4, 10, 2, 2.49, 'manzana', 3),
(4, 12, 2, 2.29, 'mantequilla', 2),
(4, 18, 3, 2.79, 'cornflakes', 2),

-- Pedido 5
(5, 9, 2, 1.79, 'chocolate', 2),

-- Pedido 6
(6, 5, 2, 1.39, 'arroz', 2),
(6, 6, 1, 0.89, 'leche', 3),
(6, 13, 1, 1.99, 'galletas', 2);

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

--
-- Dumping data for table `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `id_usuario`, `fecha_pedido`, `estado`, `total`) VALUES
(1, 5, '2025-03-01', 'pendiente', 4.37),
(2, 5, '2025-03-02', 'enviado', 14.25),
(3, 6, '2025-03-03', 'entregado', 24.87),
(4, 7, '2025-03-04', 'cancelado', 31.24),
(5, 6, '2025-03-05', 'pendiente', 3.58),
(6, 8, '2025-03-08', 'pendiente', 5.66);

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
(1, 'pepino', 'Fruta refrescante, ideal para ensaladas y platos fríos por su sabor suave.', 1.39, 10, 1, 1, 'pepino.jpg'),
(2, 'platanos', 'Fruta dulce y energética, perfecta para meriendas o postres naturales', 3.49, 25, 1, 1, 'platanos.jpg'),
(3, 'tomates', 'Jugosos y versátiles, esenciales en ensaladas, salsas y guisos mediterráneos.', 1.59, 10, 1, 1, 'tomates.jpg'),
(4, 'naranja', 'Cítrico rico en vitamina C, ideal para zumos y postres refrescantes', 1.79, 25, 1, 1, 'naranjas.jpg'),
(5, 'arroz', 'Alimento básico, acompañamiento perfecto para platos de carne, pescado o vegetales.', 1.39, 20, 2, 2, 'arroz.jpg'),
(6, 'leche', 'Fuente de calcio natural, esencial en desayunos y recetas lácteas.', 0.89, 10, 3, 3, 'leche.png'),
(7, 'yogur', 'Producto lácteo fermentado, excelente para postres o como snack saludable.', 2.39, 30, 3, 3, 'yogur.png'),
(8, 'queso', 'Alimento derivado de la leche, sabroso y presente en muchas recetas.', 1.59, 18, 3, 3, 'queso.png'),
(9, 'chocolate', 'Dulce irresistible, perfecto para postres, meriendas o para darte un gusto.', 1.79, 10, 2, 4, 'chocolate.png'),
(10, 'manzana', 'Fruta crujiente y saludable, ideal para llevar y comer en cualquier momento.', 2.49, 30, 1, 1, 'manzana.jpg'),
(11, 'pan integral', 'Rico en fibra, opción saludable para desayunos, tostadas o bocadillos.', 1.89, 20, 2, 2, 'pan_integral.jpg'),
(12, 'mantequilla', 'Grasa láctea ideal para cocinar, untar o dar sabor a platos.', 2.29, 50, 3, 3, 'mantequilla.jpg'),
(13, 'galletas', 'Dulces horneados, perfectos para acompañar el café o como tentempié.', 1.99, 60, 2, 4, 'galletas.jpg'),
(14, 'limonada', 'Bebida refrescante con limón, ideal para combatir el calor del verano.', 1.59, 10, 1, 5, 'limonada.jpg'),
(15, 'sandia', 'Fruta veraniega, muy jugosa y dulce, excelente para hidratarse naturalmente.', 3.99, 15, 1, 1, 'sandia.jpg'),
(16, 'kiwi', 'Fruta tropical con alto contenido en vitamina C y fibra.', 2.99, 30, 1, 1, 'kiwi.jpeg'),
(17, 'avena', 'Cereal saludable ideal para desayunos nutritivos o como ingrediente en repostería.', 2.49, 12, 2, 2, 'avena.jpeg'),
(18, 'cornflakes', 'Copos de maíz crujientes, clásicos en desayunos con leche o yogur.', 2.79, 40, 2, 2, 'cornflakes.jpg'),
(19, 'nata', 'Lácteo cremoso que se usa en repostería, salsas o postres.', 1.99, 30, 3, 3, 'nata.jpg'),
(20, 'batido de chocolate', 'Bebida dulce y cremosa, perfecta como merienda o capricho ocasional.', 1.99, 12, 3, 3, 'batido.jpg'),
(21, 'tarta de queso', 'Postre suave y cremoso, muy popular en celebraciones y meriendas.', 4.99, 6, 2, 4, 'tarta_queso.jpg'),
(22, 'caramelos', 'Pequeños dulces duros o blandos, ideales para disfrutar de algo azucarado.', 1.49, 100, 2, 4, 'caramelos.jpg'),
(23, 'cola', 'Bebida con gas y cafeína, muy popular en reuniones y celebraciones.', 1.39, 22, 1, 5, 'cola.jpg'),
(24, 'agua con gas', 'Alternativa burbujeante al agua natural, refrescante y sin calorías.', 0.99, 10, 1, 5, 'agua_gas.jpg');


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
(1, 'Vendedor1', 'vendedor1@gmail.com', 'Vendedor1', 'vendedor', 0),
(2, 'Vendedor2', 'vendedor2@gmail.com', 'Vendedor2', 'vendedor', 0),
(3, 'Vendedor3', 'vendedor3@gmail.com', 'Vendedor3', 'vendedor', 0),
(4, 'Administrador', 'administrador@gmail.com', 'Administrador1', 'administrador', 0),
(5, 'Cliente1', 'cliente1@gmail.com', 'Cliente1', 'cliente', 0),
(6, 'Cliente2', 'cliente2@gmail.com', 'Cliente2', 'cliente', 0),
(7, 'Cliente3', 'cliente3@gmail.com', 'Cliente3', 'cliente', 0),
(8, 'Cliente4', 'cliente4@gmail.com', 'Cliente4', 'cliente', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

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
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

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

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

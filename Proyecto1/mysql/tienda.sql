@@ -2,200 +2,219 @@
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2025 at 11:36 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-03-2025 a las 11:49:48
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tienda`
-- Base de datos: `tienda`
--

CREATE DATABASE IF NOT EXISTS tienda;
USE tienda;

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categorias` int(10) NOT NULL,
  `nombre` varchar(40) NOT NULL
  `id_categoria` INT(10) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(40) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `chat` (
  `id_mensaje` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `mensaje` varchar(400) NOT NULL,
  `fecha` date NOT NULL
CREATE TABLE `usuarios` (
  `id_usuario` INT(10) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `email` VARCHAR(30) NOT NULL UNIQUE,
  `contraseña` VARCHAR(255) NOT NULL,
  `tipo_usuario` ENUM('cliente', 'vendedor', 'administrador') NOT NULL,
  `puntos_fidelidad` INT(5) DEFAULT 0,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detalles_pedido`
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `detalles_pedido` (
  `id_pedido` int(10) NOT NULL,
  `id_producto` int(10) NOT NULL,
  `cantidad` int(5) NOT NULL,
  `precio_unidad` varchar(10) NOT NULL
CREATE TABLE `productos` (
  `id_producto` INT(7) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(25) NOT NULL,
  `descripcion` VARCHAR(100) NOT NULL,
  `precio` DECIMAL(10, 2) NOT NULL,
  `stock` INT(10) NOT NULL,
  `id_vendedor` INT(10) NOT NULL,
  `id_categoria` INT(10) NOT NULL,
  PRIMARY KEY (`id_producto`),
  FOREIGN KEY (`id_vendedor`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE,
  FOREIGN KEY (`id_categoria`) REFERENCES `categorias`(`id_categoria`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `fecha_pedido` date NOT NULL,
  `estado` varchar(20) NOT NULL,
  `total` varchar(10) NOT NULL
  `id_pedido` INT(10) NOT NULL AUTO_INCREMENT,
  `id_usuario` INT(10) NOT NULL,
  `fecha_pedido` DATE NOT NULL,
  `estado` ENUM('pendiente', 'enviado', 'entregado', 'cancelado') NOT NULL,
  `total` DECIMAL(10, 2) NOT NULL,
  PRIMARY KEY (`id_pedido`),
  FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productos`
-- Estructura de tabla para la tabla `detalles_pedido`
--

CREATE TABLE `productos` (
  `id_producto` int(7) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `precio` float NOT NULL,
  `imagen` text NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `stock` int(10) NOT NULL,
  `id_vendedor` int(10) NOT NULL
CREATE TABLE `detalles_pedido` (
  `id_pedido` INT(10) NOT NULL,
  `id_producto` INT(10) NOT NULL,
  `cantidad` INT(5) NOT NULL,
  `precio_unidad` DECIMAL(10, 2) NOT NULL,
  PRIMARY KEY (`id_pedido`, `id_producto`),
  FOREIGN KEY (`id_pedido`) REFERENCES `pedidos`(`id_pedido`) ON DELETE CASCADE,
  FOREIGN KEY (`id_producto`) REFERENCES `productos`(`id_producto`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Dumping data for table `productos`
-- Estructura de tabla para la tabla `reseñas`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `precio`, `imagen`, `descripcion`, `stock`, `id_vendedor`) VALUES
(0, 'pepino', 1.39, 'pepino.jpg', 'fruta', 20, 1),
(1, 'platanos', 3.49, 'platanos.jpg', 'fruta', 20, 1),
(2, 'tomates', 1.59, 'tomates.jpg', 'fruta', 20, 1),
(3, 'naranja', 1.79, 'naranjas.jpg', 'fruta', 20, 1),
(5, 'arroz', 1.39, 'arroz.jpg', 'cereales', 20, 2);
CREATE TABLE `reseñas` (
  `id_reseña` INT(10) NOT NULL AUTO_INCREMENT,
  `id_usuario` INT(10) NOT NULL,
  `id_producto` INT(10) NOT NULL,
  `puntuación` INT(2) NOT NULL CHECK (`puntuación` BETWEEN 1 AND 5),
  `comentario` VARCHAR(300) NOT NULL,
  PRIMARY KEY (`id_reseña`),
  FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE,
  FOREIGN KEY (`id_producto`) REFERENCES `productos`(`id_producto`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `puntos_fidelidad`
-- Estructura de tabla para la tabla `puntos_fidelidad`
--

CREATE TABLE `puntos_fidelidad` (
  `id_puntos` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `puntos_acumulados` int(5) NOT NULL,
  `fecha_caducidad` date NOT NULL
  `id_puntos` INT(10) NOT NULL AUTO_INCREMENT,
  `id_usuario` INT(10) NOT NULL,
  `puntos_acumulados` INT(5) NOT NULL,
  `fecha_caducidad` DATE NOT NULL,
  PRIMARY KEY (`id_puntos`),
  FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reseñas`
-- Estructura de tabla para la tabla `chat`
--

CREATE TABLE `reseñas` (
  `id_reseña` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `id_producto` int(10) NOT NULL,
  `puntuación` int(2) NOT NULL,
  `comentario` varchar(300) NOT NULL
CREATE TABLE `chat` (
  `id_mensaje` INT(10) NOT NULL AUTO_INCREMENT,
  `id_usuario` INT(10) NOT NULL,
  `mensaje` VARCHAR(400) NOT NULL,
  `fecha` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_mensaje`),
  FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
-- Índices para tablas volcadas
--

CREATE TABLE `usuarios` (
  `id_usuario` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contraseña` varchar(30) NOT NULL,
  `tipo_usuario` varchar(20) NOT NULL,
  `puntis_fidelidad` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `usuarios`
-- Indices de la tabla `categorias`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `email`, `contraseña`, `tipo_usuario`, `puntis_fidelidad`) VALUES
('67c83574dfac4', 'b', 'b@b.com', 'b', 'cliente', 0),
('67c835ec229de', 'a', 'a@a.com', 'a', 'cliente', 0);
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for dumped tables
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE (`email`);

--
-- Indexes for table `categorias`
-- Indices de la tabla `productos`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categorias`);
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD FOREIGN KEY (`id_vendedor`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE,
  ADD FOREIGN KEY (`id_categoria`) REFERENCES `categorias`(`id_categoria`) ON DELETE CASCADE;

--
-- Indexes for table `chat`
-- Indices de la tabla `pedidos`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_mensaje`);
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE;

--
-- Indexes for table `pedidos`
-- Indices de la tabla `detalles_pedido`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`);
ALTER TABLE `detalles_pedido`
  ADD PRIMARY KEY (`id_pedido`, `id_producto`),
  ADD FOREIGN KEY (`id_pedido`) REFERENCES `pedidos`(`id_pedido`) ON DELETE CASCADE,
  ADD FOREIGN KEY (`id_producto`) REFERENCES `productos`(`id_producto`) ON DELETE CASCADE;

--
-- Indexes for table `productos`
-- Indices de la tabla `reseñas`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);
ALTER TABLE `reseñas`
  ADD PRIMARY KEY (`id_reseña`),
  ADD FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE,
  ADD FOREIGN KEY (`id_producto`) REFERENCES `productos`(`id_producto`) ON DELETE CASCADE;

--
-- Indexes for table `puntos_fidelidad`
-- Indices de la tabla `puntos_fidelidad`
--
ALTER TABLE `puntos_fidelidad`
  ADD PRIMARY KEY (`id_puntos`);
  ADD PRIMARY KEY (`id_puntos`),
  ADD FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE;

--
-- Indexes for table `reseñas`
-- Indices de la tabla `chat`
--
ALTER TABLE `reseñas`
  ADD PRIMARY KEY (`id_reseña`);
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_mensaje`),
  ADD FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE;

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
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
-- Base de datos: `tienda`
--

CREATE DATABASE IF NOT EXISTS tienda;
USE tienda;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` INT(10) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(40) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

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
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(7) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  `precio` float NOT NULL,
  `imagen` text NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `stock` int(10) NOT NULL,
  `id_vendedor` int(10) NOT NULL
  --`id_categoria` INT(10) NOT NULL,
  PRIMARY KEY (`id_producto`),
  FOREIGN KEY (`id_vendedor`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE,
  --FOREIGN KEY (`id_categoria`) REFERENCES `categorias`(`id_categoria`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `precio`, `imagen`, `descripcion`, `stock`, `id_vendedor`) VALUES
(0, 'pepino', 1.39, 'pepino.jpg', 'fruta', 20, 1),
(1, 'platanos', 3.49, 'platanos.jpg', 'fruta', 20, 1),
(2, 'tomates', 1.59, 'tomates.jpg', 'fruta', 20, 1),
(5, 'arroz', 1.39, 'arroz.jpg', 'cereales', 20, 2);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
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
-- Estructura de tabla para la tabla `detalles_pedido`
--

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
-- Estructura de tabla para la tabla `reseñas`
--

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
-- Estructura de tabla para la tabla `puntos_fidelidad`
--

CREATE TABLE `puntos_fidelidad` (
  `id_puntos` INT(10) NOT NULL AUTO_INCREMENT,
  `id_usuario` INT(10) NOT NULL,
  `puntos_acumulados` INT(5) NOT NULL,
  `fecha_caducidad` DATE NOT NULL,
  PRIMARY KEY (`id_puntos`),
  FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat`
--

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
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE (`email`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD FOREIGN KEY (`id_vendedor`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE,
  ADD FOREIGN KEY (`id_categoria`) REFERENCES `categorias`(`id_categoria`) ON DELETE CASCADE;

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE;

--
-- Indices de la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  ADD PRIMARY KEY (`id_pedido`, `id_producto`),
  ADD FOREIGN KEY (`id_pedido`) REFERENCES `pedidos`(`id_pedido`) ON DELETE CASCADE,
  ADD FOREIGN KEY (`id_producto`) REFERENCES `productos`(`id_producto`) ON DELETE CASCADE;

--
-- Indices de la tabla `reseñas`
--
ALTER TABLE `reseñas`
  ADD PRIMARY KEY (`id_reseña`),
  ADD FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE,
  ADD FOREIGN KEY (`id_producto`) REFERENCES `productos`(`id_producto`) ON DELETE CASCADE;

--
-- Indices de la tabla `puntos_fidelidad`
--
ALTER TABLE `puntos_fidelidad`
  ADD PRIMARY KEY (`id_puntos`),
  ADD FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE;

--
-- Indices de la tabla `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_mensaje`),
  ADD FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

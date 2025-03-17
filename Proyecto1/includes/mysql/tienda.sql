SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `tienda`
-- Base de datos: `tienda`
--

CREATE DATABASE IF NOT EXISTS tienda;
USE tienda;

-- --------------------------------------------------------
-- Table structure for table `categorias`
-- Estructura de tabla para la tabla `categorias`

CREATE TABLE `categorias` (
  `id_categoria` INT(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Insertar datos en categorias
INSERT INTO categorias (nombre) VALUES ('frutas'), ('cereales');

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `usuarios`

CREATE TABLE `usuarios` (
  `id_usuario` INT(10) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `email` VARCHAR(30) NOT NULL UNIQUE,
  `contraseña` VARCHAR(255) NOT NULL,
  `tipo_usuario` ENUM('cliente', 'vendedor', 'administrador') NOT NULL,
  `puntos_fidelidad` INT(5) DEFAULT 0,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Insertar datos en usuarios
INSERT INTO `usuarios` (`id_usuario`, `nombre`, `email`, `contraseña`, `tipo_usuario`, `puntos_fidelidad`) VALUES
(1, 'Vendedor1', 'vendedor1@gmail.com', 'v1', 'vendedor', 0),
(2, 'Vendedor2', 'vendedor2@gmail.com', 'v2', 'vendedor', 0),
(3, 'fer', 'fer@gmail.com', '1234', 'vendedor', 0);
-- --------------------------------------------------------
-- Estructura de tabla para la tabla `productos`

CREATE TABLE `productos` (
  `id_producto` INT(7) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(25) NOT NULL,
  `descripcion` VARCHAR(100) NOT NULL,
  `precio` DECIMAL(10, 2) NOT NULL,
  `stock` INT(10) NOT NULL,
  `id_vendedor` INT(10) NOT NULL,
  `id_categoria` INT(10) NOT NULL,
  `imagen` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_producto`),
  FOREIGN KEY (`id_vendedor`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE,
  FOREIGN KEY (`id_categoria`) REFERENCES `categorias`(`id_categoria`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Insertar datos en productos
INSERT INTO `productos` (`nombre`, `descripcion`, `precio`, `stock`, `id_vendedor`, `id_categoria`, `imagen`) VALUES
('pepino', 'fruta', 1.39, 20, 1, 1, 'pepino.jpg'),
('platanos', 'fruta', 3.49, 20, 1, 1, 'platanos.jpg'),
('tomates', 'fruta', 1.59, 20, 1, 1, 'tomates.jpg'),
('naranja', 'fruta', 1.79, 20, 1, 1, 'naranjas.jpg'),
('arroz', 'cereales', 1.39, 20, 2, 2, 'arroz.jpg');

-- --------------------------------------------------------
-- Table structure for table `pedidos`
-- Estructura de tabla para la tabla `pedidos`

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
-- Table structure for table `detalles_pedido`

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
-- Estructura de tabla para la tabla `reseñas`

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
-- Estructura de tabla para la tabla `puntos_fidelidad`

CREATE TABLE `puntos_fidelidad` (
  `id_puntos` INT(10) NOT NULL AUTO_INCREMENT,
  `id_usuario` INT(10) NOT NULL,
  `puntos_acumulados` INT(5) NOT NULL,
  `fecha_caducidad` DATE NOT NULL,
  PRIMARY KEY (`id_puntos`),
  FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `chat`

CREATE TABLE `chat` (
  `id_mensaje` INT(10) NOT NULL AUTO_INCREMENT,
  `id_usuario` INT(10) NOT NULL,
  `mensaje` VARCHAR(400) NOT NULL,
  `fecha` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_mensaje`),
  FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


COMMIT;


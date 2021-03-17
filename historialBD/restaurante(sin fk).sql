-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-10-2020 a las 00:04:15
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdrestaurante`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `barmans`
--

CREATE TABLE `barmans` (
  `id_barman` int(5) NOT NULL COMMENT 'pk',
  `dni` varchar(9) COLLATE utf8_spanish_ci NOT NULL COMMENT 'fk de trabajadores como dni',
  `estado` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=abilitado 0=besabilitado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bebidas`
--

CREATE TABLE `bebidas` (
  `id_bebidas` int(5) NOT NULL COMMENT 'pk',
  `nombre` int(20) NOT NULL,
  `descripcion` int(50) NOT NULL,
  `tipo` int(20) NOT NULL COMMENT 'si es refresco con gas sin gas zumo etc',
  `estado` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'activo=1 inactivo=0',
  `foto` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='datos de bebidas';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camareros`
--

CREATE TABLE `camareros` (
  `id_camarero` int(5) NOT NULL COMMENT 'pk',
  `dni` varchar(8) COLLATE utf8_spanish_ci NOT NULL COMMENT 'fk de trabajadores como dni',
  `estado` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=abilitado 0=besabilitado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cocineros`
--

CREATE TABLE `cocineros` (
  `id_cocineros` int(5) NOT NULL COMMENT 'pk',
  `dni` varchar(9) COLLATE utf8_spanish_ci NOT NULL COMMENT 'fk de trabajadores como dni',
  `estado` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=abilitado 0=besabilitado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comandas`
--

CREATE TABLE `comandas` (
  `id_comanda` int(5) NOT NULL COMMENT 'pk',
  `id_camarero` int(5) NOT NULL COMMENT 'fk camareros como id_camarero',
  `numero_mesa` int(3) NOT NULL COMMENT 'fk mesas como numero_mesa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comanda_bebida`
--

CREATE TABLE `comanda_bebida` (
  `id_bebida` int(5) NOT NULL COMMENT 'pk y fk de bebidas como id_bebida',
  `id_comanda` int(5) NOT NULL COMMENT 'pk y fk de comandas como id_comandas',
  `cantidad` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='relacion entre bebidas y comandas';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comanda_menu`
--

CREATE TABLE `comanda_menu` (
  `id_menu` int(5) NOT NULL COMMENT 'pk y fk de menus como id_menu',
  `id_comanda` int(5) NOT NULL COMMENT 'pk y fk de comandas como id_comanda',
  `cantidad` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='relacion entre menus y comandas';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comanda_plato`
--

CREATE TABLE `comanda_plato` (
  `id_plato` int(5) NOT NULL COMMENT 'pk y fk de platos como id_plato',
  `id_comanda` int(5) NOT NULL COMMENT 'pk y fk de comandas como id_comanda',
  `cantidad` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='relacion entre platos y comandas';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE `menus` (
  `id_menu` int(5) NOT NULL COMMENT 'pk',
  `descripcion` int(20) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'activo=1 inactivo=0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='datos menus';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_bebida`
--

CREATE TABLE `menu_bebida` (
  `id_menu` int(5) NOT NULL COMMENT 'pk y fk de menus como id_menu',
  `id_bebida` int(5) NOT NULL COMMENT 'pk y fk de bebidas como id_bebidas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_plato`
--

CREATE TABLE `menu_plato` (
  `id_menu` int(5) NOT NULL COMMENT 'pk y fk de menus como id_menu',
  `id_plato` int(5) NOT NULL COMMENT 'pk y fk de platos como id_plato',
  `tipo` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='relacion entre menus y platos';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `numero_mesa` int(3) NOT NULL COMMENT 'pk',
  `ubicacionX` int(3) NOT NULL,
  `ubicacionY` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='datos de mesas';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platos`
--

CREATE TABLE `platos` (
  `id_plato` int(5) NOT NULL COMMENT 'pk',
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `receta` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'activo=1 inactivo=0',
  `foto` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='datos de platos';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibe_barman`
--

CREATE TABLE `recibe_barman` (
  `id_comanda` int(5) NOT NULL COMMENT 'pk',
  `id_barman` int(5) NOT NULL COMMENT 'fk de barmans como id_barman',
  `preparado` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'preparado=1 noPreparado=0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='tabla de relacion N:M de comandas y barmans';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibe_cocinero`
--

CREATE TABLE `recibe_cocinero` (
  `id_comanda` int(5) NOT NULL COMMENT 'pk ',
  `id_cocinero` int(5) NOT NULL COMMENT 'fk cocineros como id_cocinero',
  `preparado` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'preparado=1 noPreparado=0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='tabla de relacion N:M de comandas y cocineros';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadores`
--

CREATE TABLE `trabajadores` (
  `dni` varchar(9) COLLATE utf8_spanish_ci NOT NULL COMMENT 'pk fk de trabajadores, cocineros, barmans como dni',
  `usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `contraseña` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='datos de trabajadores padre de cocineros camareros y barmans';

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `barmans`
--
ALTER TABLE `barmans`
  ADD PRIMARY KEY (`id_barman`);

--
-- Indices de la tabla `bebidas`
--
ALTER TABLE `bebidas`
  ADD PRIMARY KEY (`id_bebidas`);

--
-- Indices de la tabla `camareros`
--
ALTER TABLE `camareros`
  ADD PRIMARY KEY (`id_camarero`);

--
-- Indices de la tabla `cocineros`
--
ALTER TABLE `cocineros`
  ADD PRIMARY KEY (`id_cocineros`);

--
-- Indices de la tabla `comandas`
--
ALTER TABLE `comandas`
  ADD PRIMARY KEY (`id_comanda`);

--
-- Indices de la tabla `comanda_bebida`
--
ALTER TABLE `comanda_bebida`
  ADD PRIMARY KEY (`id_bebida`,`id_comanda`);

--
-- Indices de la tabla `comanda_menu`
--
ALTER TABLE `comanda_menu`
  ADD PRIMARY KEY (`id_menu`,`id_comanda`);

--
-- Indices de la tabla `comanda_plato`
--
ALTER TABLE `comanda_plato`
  ADD PRIMARY KEY (`id_plato`,`id_comanda`);

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indices de la tabla `menu_bebida`
--
ALTER TABLE `menu_bebida`
  ADD PRIMARY KEY (`id_menu`,`id_bebida`);

--
-- Indices de la tabla `menu_plato`
--
ALTER TABLE `menu_plato`
  ADD PRIMARY KEY (`id_menu`,`id_plato`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`numero_mesa`);

--
-- Indices de la tabla `platos`
--
ALTER TABLE `platos`
  ADD PRIMARY KEY (`id_plato`);

--
-- Indices de la tabla `recibe_barman`
--
ALTER TABLE `recibe_barman`
  ADD PRIMARY KEY (`id_comanda`);

--
-- Indices de la tabla `recibe_cocinero`
--
ALTER TABLE `recibe_cocinero`
  ADD PRIMARY KEY (`id_comanda`);

--
-- Indices de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD PRIMARY KEY (`dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `barmans`
--
ALTER TABLE `barmans`
  MODIFY `id_barman` int(5) NOT NULL AUTO_INCREMENT COMMENT 'pk';

--
-- AUTO_INCREMENT de la tabla `bebidas`
--
ALTER TABLE `bebidas`
  MODIFY `id_bebidas` int(5) NOT NULL AUTO_INCREMENT COMMENT 'pk';

--
-- AUTO_INCREMENT de la tabla `camareros`
--
ALTER TABLE `camareros`
  MODIFY `id_camarero` int(5) NOT NULL AUTO_INCREMENT COMMENT 'pk';

--
-- AUTO_INCREMENT de la tabla `cocineros`
--
ALTER TABLE `cocineros`
  MODIFY `id_cocineros` int(5) NOT NULL AUTO_INCREMENT COMMENT 'pk';

--
-- AUTO_INCREMENT de la tabla `comandas`
--
ALTER TABLE `comandas`
  MODIFY `id_comanda` int(5) NOT NULL AUTO_INCREMENT COMMENT 'pk';

--
-- AUTO_INCREMENT de la tabla `menus`
--
ALTER TABLE `menus`
  MODIFY `id_menu` int(5) NOT NULL AUTO_INCREMENT COMMENT 'pk';

--
-- AUTO_INCREMENT de la tabla `platos`
--
ALTER TABLE `platos`
  MODIFY `id_plato` int(5) NOT NULL AUTO_INCREMENT COMMENT 'pk';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

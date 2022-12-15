-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-12-2022 a las 20:21:36
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `jengas-pizza`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comandas`
--

CREATE TABLE `comandas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rut_encargado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_venta` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `comandas`
--

INSERT INTO `comandas` (`id`, `fecha`, `estado`, `rut_encargado`, `id_venta`) VALUES
(1, '2022-12-15 15:13:27', 'finalizado', '19543720-3', 2),
(2, '2022-12-15 15:13:13', 'finalizado', '19543720-3', 2),
(3, '2022-12-15 16:40:00', 'finalizado', '19543720-3', 2),
(4, '2022-12-15 18:41:45', 'finalizado', '19543720-3', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(49, '2014_10_12_000000_create_users_table', 1),
(50, '2014_10_12_100000_create_password_resets_table', 1),
(51, '2019_08_19_000000_create_failed_jobs_table', 1),
(52, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(53, '2022_11_14_180629_create_productos_table', 1),
(54, '2022_11_14_180855_create_promociones_table', 1),
(55, '2022_11_18_195847_create_productos_promociones_table', 1),
(56, '2022_11_18_200152_create_ventas_table', 1),
(57, '2022_11_18_200222_create_comandas_table', 1),
(58, '2022_11_18_200242_create_reparto_table', 1),
(59, '2022_11_18_200309_create_promociones_ventas_table', 1),
(60, '2022_12_13_222442_create_carritos_table', 1),
(61, '2022_12_13_223442_create_carrito_promocion_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `codigo` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(10) UNSIGNED NOT NULL,
  `precio` int(10) UNSIGNED NOT NULL,
  `visible` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'visible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_promociones`
--

CREATE TABLE `productos_promociones` (
  `codigo_producto` int(10) UNSIGNED NOT NULL,
  `codigo_promocion` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `codigo` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` int(10) UNSIGNED NOT NULL,
  `visible` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'visible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `promociones`
--

INSERT INTO `promociones` (`codigo`, `nombre`, `categoria`, `descripcion`, `precio`, `visible`) VALUES
(1, '01 PEPE IRONIC', 'Tus REGALONAS', 'Pepperoni y tocino', 9500, 'visible'),
(2, '02 LA SIÚTICA', 'Tus REGALONAS', 'Lomo salteado, choclo y cebolla salteada', 9500, 'visible'),
(3, '03 LA GOLOSA', 'Tus REGALONAS', 'Pepperoni americano, pollo al curry, tocino ahumado y aceitunas', 11990, 'visible'),
(4, '04 LA DIABLA', 'Tus REGALONAS', 'Pollo al curry, cebolla salteada, tomate cherry, aceitunas y jalapeños', 9990, 'visible'),
(5, '05 LA TERRIBLE', 'Tus REGALONAS', 'Pollo al curry, cebolla salteada, choclo, pimentón asado y jalapeños', 11990, 'visible'),
(6, '06 LA CAVERNÍCOLA', 'Tus REGALONAS', 'Lomo salteado, pepperoni americano, aceitunas y tomate cherry', 9990, 'visible'),
(7, '07 LA CHORIZA', 'Tus REGALONAS', 'Chorizo de carne angus, cebolla salteada, aceitunas y pimentón asado', 10990, 'visible'),
(8, '08 CAPRICHICKEN', 'Tus REGALONAS', 'Pollo al curry, choclo y champiñón', 9500, 'visible'),
(9, '09 LA TRAVIESA', 'Tus REGALONAS', 'Pollo al orégano, choclo, champiñones y cebolla salteada', 9500, 'visible'),
(10, '10 LA CURIOSA', 'Tus REGALONAS', 'Tocino ahumado, champiñones y aceitunas', 9000, 'visible'),
(11, '11 LA TÓXICA', 'Tus REGALONAS', 'Tocino ahumado, lomo salteado, cebolla salteada y pimentón asado', 10990, 'visible'),
(12, '12 LA CUARENTONA', 'Tus REGALONAS', 'Pollo al curry, aceitunas negras, pimentón asado, jalapeños y cebolla salteada', 11990, 'visible'),
(13, '01 MERCURIO', 'Galácticas', 'Camarón ecuatoriano, pollo a la crema, choclo y champiñones', 11990, 'visible'),
(14, '02 VENUS', 'Galácticas', 'Pollo a la crema, jamón serrano, tomate cherry y pimentón salteado', 11990, 'visible'),
(15, '03 TERRÍCOLA', 'Galácticas', 'Aceitunas, cebolla salteada, pimentón salteado, champiñón y choclo', 11990, 'visible'),
(16, '04 MARTE', 'Galácticas', 'Lomo salteado, tocino americano, chorizo de carne angus y cebolla salteada', 12990, 'visible'),
(17, '05 JÚPITER', 'Galácticas', 'Pepperoni americano, tocino americano, jamón serrano y lomo salteado', 13990, 'visible'),
(18, '06 SATURNO', 'Galácticas', 'Jamón serrano, cebolla salteada, aceitunas y jalapeños', 12990, 'visible'),
(19, '07 URANO', 'Galácticas', 'Tocino americano, lomo salteado, cebolla salteada y pimentónn', 11990, 'visible'),
(20, '08 NEPTUNO', 'Galácticas', 'Pollo a la crema, tocino, pimentón asado y tomate cherry', 11990, 'visible'),
(21, '09 PLUTÓN', 'Galácticas', 'Pollo al orégano, lomo salteado, cebolla salteada y aceitunas', 11990, 'visible'),
(22, '10 SOLAR', 'Galácticas', 'Tocino, choclo, champiñones y cebolla salteada', 11990, 'visible'),
(23, '01 PAPAS EL CHAVO', 'Big box FRIES', 'Papas fritas cubiertas con pollo a la crema, cebolla salteada, pimentón y trilogía de quesos (mozzarella, parmesano y reggianito)', 13990, 'visible'),
(24, '02 PAPAS CHILINDRINA', 'Big box FRIES', 'Papas cubiertas con pollo a la crema, choclo, champiñón, y trilogía de quesos (mozzarella, parmesano y reggianito)', 13990, 'visible'),
(25, '03 PAPAS DOÑA FLORINDA', 'Big box FRIES', 'Papas cubiertas con lomo salteado, cebolla salteada, aceitunas, y trilogía de quesos (mozarella, parmesano y reggianito)', 13990, 'visible'),
(26, '04 PAPAS KIKO', 'Big box FRIES', 'Papas cubiertas con lomo salteado, pimentón, aceitunas, y trilogía de quesos (mozarella, parmesano y reggianito)', 13990, 'visible'),
(27, '05 PAPAS DON RAMÓN', 'Big box FRIES', 'Papas cubiertas con pollo a la crema, pimentón, champiñones, y trilogía de quesos (mozarella, parmesano y reggianito)', 13990, 'visible'),
(28, '06 SALCHIPAPAS', 'Big box FRIES', 'Papas fritas con vienesas', 6000, 'visible'),
(29, '5 Empanadas de queso', 'Extras', '5 unidades', 1690, 'visible'),
(30, '10 Empanadas de queso', 'Extras', '10 unidades', 2990, 'visible'),
(31, '8x Palitos de ajo', 'Extras', '8 unidades', 4990, 'visible'),
(32, 'Bebida en lata 350 ml', 'Bebidas', 'Coca cola, sprite, fanta', 1500, 'visible'),
(33, 'Bebida 2,5 lts', 'Bebidas', 'Coca cola, sprite, fanta', 3000, 'visible'),
(34, 'Alcaparras', 'Extras', '-', 1000, 'visible'),
(35, 'Jalapeños', 'Extras', '-', 1000, 'visible'),
(36, 'Salsa barbecue', 'Extras', '-', 1000, 'visible'),
(37, 'Bordes de queso', 'Otros', 'Agrega bordes de queso a tu pizza', 2990, 'visible'),
(38, 'Agranda tu pizza a XL', 'Otros', 'Agranda tu pizza', 2990, 'visible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones_ventas`
--

CREATE TABLE `promociones_ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `codigo_promocion` int(10) UNSIGNED NOT NULL,
  `id_venta` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(10) UNSIGNED NOT NULL,
  `subtotal` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `promociones_ventas`
--

INSERT INTO `promociones_ventas` (`id`, `codigo_promocion`, `id_venta`, `cantidad`, `subtotal`) VALUES
(1, 4, 1, 1, 9990),
(2, 1, 2, 1, 9500),
(3, 1, 5, 1, 9500),
(4, 4, 5, 1, 9990),
(5, 23, 5, 1, 13990),
(6, 1, 6, 1, 9500),
(7, 23, 7, 1, 13990),
(8, 23, 8, 1, 13990),
(9, 23, 9, 1, 13990),
(10, 23, 10, 1, 13990),
(11, 1, 11, 1, 9500),
(12, 3, 11, 1, 11990);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `rut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_completo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cliente',
  `habilitacion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'habilitado',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`rut`, `nombre_completo`, `email`, `password`, `direccion`, `rol`, `habilitacion`, `remember_token`) VALUES
('0-0', 'Admin Test', 'test@test.cl', '$2y$10$J3i10rhPW2cTVTLWzwF1Z.bXohccko3Z8l.6.c19ZSO1qlQvxhbZW', 'test', 'administrador', 'habilitado', 'CyXSeItVoLcQzYt4nxoYcCCKEleip7GMa8hj1PnPRkPyrD0adRvNySlZgN1q'),
('19414244-7', 'Repartidor Test', 'reparto@test.cl', '$2y$10$Cb.Ey5PKzzKhbgWmBC8xD.4Jysbxbi9/Tim5TwGXtm2IFhA9kMLAC', 'Test', 'repartidor', 'habilitado', NULL),
('19416137-9', 'jean gatica', 'jpgatica48@gmail.com', '$2y$10$16c8DjCuMBtJNBCKRERl0.26FwnwQqlKsfJyJengCcYGpID/gZUq6', 'av ohigins', 'cliente', 'habilitado', NULL),
('19543720-3', 'Cocinero Test', 'cocinero@test.cl', '$2y$10$8v6DQWUC63po.Xktk2jXCesDde.mJcDecxZSHf3WjGH9cHw7cuNZ2', 'Local Jenga\'s Pizza', 'cocinero', 'habilitado', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `neto` int(11) NOT NULL,
  `iva` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `observaciones` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `medio_venta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metodo_pago` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rut_cliente` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `fecha`, `estado`, `neto`, `iva`, `total`, `observaciones`, `medio_venta`, `metodo_pago`, `rut_cliente`) VALUES
(1, '2022-12-14 07:45:39', 'creacion', 8092, 1898, 9990, '-', 'presencial', '-', '0-0'),
(2, '2022-12-15 17:16:03', 'en reparto', 7695, 1805, 9500, '-', 'presencial', 'efectivo', '0-0'),
(3, '2022-12-15 03:00:00', 'creacion', 0, 0, 0, '-', 'presencial', '-', '0-0'),
(5, '2022-12-15 03:00:00', 'creacion', 27119, 6361, 33480, '-', 'online', 'webpay', '0-0'),
(6, '2022-12-15 18:42:21', 'en reparto', 7695, 1805, 9500, '-', 'presencial', 'debito', '0-0'),
(7, '2022-12-15 03:00:00', 'creacion', 11332, 2658, 13990, '-', 'online', 'webpay', '19416137-9'),
(8, '2022-12-15 03:00:00', 'creacion', 11332, 2658, 13990, '-', 'online', 'webpay', '0-0'),
(9, '2022-12-15 03:00:00', 'creacion', 11332, 2658, 13990, '-', 'online', 'webpay', '0-0'),
(10, '2022-12-15 18:59:48', 'pagado', 11332, 2658, 13990, '-', 'online', 'webpay', '0-0'),
(11, '2022-12-15 19:15:24', 'pagado', 17407, 4083, 21490, 'Al vacio', 'online', 'webpay', '0-0');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comandas`
--
ALTER TABLE `comandas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comandas_rut_encargado_foreign` (`rut_encargado`),
  ADD KEY `comandas_id_venta_foreign` (`id_venta`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `productos_promociones`
--
ALTER TABLE `productos_promociones`
  ADD KEY `productos_promociones_codigo_producto_foreign` (`codigo_producto`),
  ADD KEY `productos_promociones_codigo_promocion_foreign` (`codigo_promocion`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `promociones_ventas`
--
ALTER TABLE `promociones_ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promociones_ventas_codigo_promocion_foreign` (`codigo_promocion`),
  ADD KEY `promociones_ventas_id_venta_foreign` (`id_venta`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD UNIQUE KEY `usuarios_rut_unique` (`rut`),
  ADD UNIQUE KEY `usuarios_email_unique` (`email`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ventas_rut_cliente_foreign` (`rut_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comandas`
--
ALTER TABLE `comandas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `codigo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
  MODIFY `codigo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `promociones_ventas`
--
ALTER TABLE `promociones_ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comandas`
--
ALTER TABLE `comandas`
  ADD CONSTRAINT `comandas_id_venta_foreign` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`),
  ADD CONSTRAINT `comandas_rut_encargado_foreign` FOREIGN KEY (`rut_encargado`) REFERENCES `usuarios` (`rut`);

--
-- Filtros para la tabla `productos_promociones`
--
ALTER TABLE `productos_promociones`
  ADD CONSTRAINT `productos_promociones_codigo_producto_foreign` FOREIGN KEY (`codigo_producto`) REFERENCES `productos` (`codigo`),
  ADD CONSTRAINT `productos_promociones_codigo_promocion_foreign` FOREIGN KEY (`codigo_promocion`) REFERENCES `promociones` (`codigo`);

--
-- Filtros para la tabla `promociones_ventas`
--
ALTER TABLE `promociones_ventas`
  ADD CONSTRAINT `promociones_ventas_codigo_promocion_foreign` FOREIGN KEY (`codigo_promocion`) REFERENCES `promociones` (`codigo`),
  ADD CONSTRAINT `promociones_ventas_id_venta_foreign` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_rut_cliente_foreign` FOREIGN KEY (`rut_cliente`) REFERENCES `usuarios` (`rut`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

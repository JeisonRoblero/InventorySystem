-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-09-2024 a las 09:08:59
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventory_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT 0,
  `picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `picture`, `created_at`) VALUES
(1, 'Computadora HP 15\"', 'Computadora marca HP, perfecta para estudiantes, de 15 pulgadas.', '4500.00', 3, 'https://www.elgallomasgallo.com.gt/media/catalog/product/l/a/laptop-hp-15-fc0002la-amd-r5-189221-ever-110324_1_.jpg?optimize=medium&bg-color=255,255,255&fit=bounds&height=700&width=700&canvas=700:700', '2024-09-13 23:57:07'),
(2, 'Televisor LED 32 pulgadas', 'Televisor LED de 32 pulgadas con resolución HD.', '3500.00', 10, 'https://www.elgallomasgallo.com.gt/media/catalog/product/t/e/televisor-smart-hd-telstar-32-tts032495kk-goo-184546_2_.jpg?optimize=medium&bg-color=255,255,255&fit=bounds&height=&width=', '2024-09-14 07:24:09'),
(3, 'Licuadora de 1.5 litros', 'Licuadora de 1.5 litros con 5 velocidades.', '450.00', 15, 'https://pyunicentroprod.vtexassets.com/arquivos/ids/317879/IMG-EC011733-201851-01.jpg?v=637927959494700000', '2024-09-14 07:24:09'),
(4, 'Refrigerador de 2 puertas', 'Refrigerador de 2 puertas con capacidad de 300 litros.', '6500.00', 8, 'https://image.cdn1.buscalibre.com/3543480.__RS360x360__.jpg', '2024-09-14 07:24:09'),
(5, 'Horno microondas 20 litros', 'Horno microondas de 20 litros con función de descongelado.', '1200.00', 12, 'https://imagedelivery.net/4fYuQyy-r8_rpBpcY7lH_A/falabellaPE/115262417_01/w=800,h=800,fit=pad', '2024-09-14 07:24:09'),
(6, 'Lavadora automática 16 kg', 'Lavadora automática con capacidad de 16 kg y múltiples programas de lavado.', '3200.00', 5, 'https://www.lapolar.cl/dw/image/v2/BCPP_PRD/on/demandware.static/-/Sites-master-catalog/default/dw62d65f36/images/large/2CC21426300.jpg?sw=1200&sh=1200&sm=fit', '2024-09-14 07:24:09'),
(7, 'Estufa de 4 quemadores', 'Estufa a gas de 4 quemadores con horno.', '2500.00', 7, 'https://www.elgallomasgallo.com.gt/media/catalog/product/e/s/estufa-de-gas-oster-20-pulgadas-os-gsgmi20ss-4-quemadores-gris-negro-190430_1_.jpg?optimize=medium&bg-color=255,255,255&fit=bounds&height=&width=', '2024-09-14 07:24:09'),
(8, 'Aspiradora de 2000W', 'Aspiradora potente de 2000W con bolsa de gran capacidad.', '800.00', 10, 'https://image.made-in-china.com/202f0j00GQBMuyKJrroC/Powerful-Power-Two-Pure-Copper-Motor-Wet-Dry-Industrial-Car-Vacuum-Cleaner.webp', '2024-09-14 07:24:09'),
(9, 'Plancha a vapor', 'Plancha a vapor con función de autolimpieza.', '350.00', 20, 'https://agenciaswayonline.com/wp-content/uploads/2023/07/Plancha-Oster-GCSTAC6953-angulo-10.jpg', '2024-09-14 07:24:09'),
(10, 'Extractor de jugos', 'Extractor de jugos con capacidad de 1 litro y filtro de acero inoxidable.', '600.00', 10, 'https://m.media-amazon.com/images/I/715pZ4H7yAL._AC_UF894,1000_QL80_.jpg', '2024-09-14 07:24:09'),
(11, 'Cafetera automática', 'Cafetera automática con función de programación y molino integrado.', '900.00', 15, 'https://http2.mlstatic.com/D_NQ_NP_888609-MLM28238150495_092018-O.webp', '2024-09-14 07:24:09'),
(12, 'Reproductor Blu-ray', 'Reproductor Blu-ray con salida HDMI y función de upscaling.', '700.00', 6, 'https://m.media-amazon.com/images/I/61WbzHwX3dL._AC_UF1000,1000_QL80_.jpg', '2024-09-14 07:24:09'),
(13, 'Calentador de agua eléctrico', 'Calentador de agua eléctrico de 50 litros.', '1500.00', 9, 'https://www.cointra.es/wp-content/uploads/2020/12/termo-tdf-plus-50-S-cointra.jpg', '2024-09-14 07:24:09'),
(14, 'Ventilador de pie', 'Ventilador de pie con 3 velocidades y ajuste de altura.', '400.00', 12, 'https://ae-pic-a1.aliexpress-media.com/kf/S538df50e518e4c3a9bbad6d62cba8a66C.png_640x640.png_.webp', '2024-09-14 07:24:09'),
(15, 'Cocina de inducción', 'Cocina de inducción portátil con 2 quemadores.', '1800.00', 11, 'https://i.ebayimg.com/thumbs/images/g/kWoAAOSw~5lmRj2a/s-l1200.jpg', '2024-09-14 07:24:09'),
(16, 'Horno eléctrico 30 litros', 'Horno eléctrico con capacidad de 30 litros y función de convección.', '2500.00', 8, 'https://osterla.vteximg.com.br/arquivos/ids/157683-700-700/TSSTTV7030-4.jpg?v=637248093534330000/', '2024-09-14 07:24:09'),
(17, 'Secadora de ropa', 'Secadora de ropa con capacidad para 5 kg.', '3000.00', 4, 'https://www.punktal.com.uy/index.php/files/large/c57044e3dccd7d8', '2024-09-14 07:24:09'),
(18, 'Microondas con grill', 'Microondas con función grill y capacidad de 25 litros.', '1300.00', 10, 'https://whirlpoolarg.vtexassets.com/arquivos/ids/164358/MCP349SL-13.jpg?v=638188170243830000', '2024-09-14 07:24:09'),
(19, 'Enfriador de aire', 'Enfriador de aire portátil con filtro de agua.', '1500.00', 7, 'https://www.steren.com.gt/media/catalog/product/cache/b69086f136192bea7a4d681a8eaf533d/image/2147931b5/mini-enfriador-personal.jpg', '2024-09-14 07:24:09'),
(20, 'Batidora de mano', 'Batidora de mano con accesorios y velocidad ajustable.', '500.00', 15, 'https://www.aftgrupo.com/img_artics/05700500_5.jpg', '2024-09-14 07:24:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `purchases`
--

INSERT INTO `purchases` (`id`, `user_id`, `product_id`, `quantity`, `status`, `purchase_date`) VALUES
(19, 11, 2, 2, 0, '2024-09-14 22:39:16'),
(20, 11, 3, 1, 1, '2024-09-14 22:39:16'),
(21, 11, 1, 1, 0, '2024-09-15 04:34:45'),
(22, 11, 4, 1, 0, '2024-09-16 10:15:02'),
(23, 1, 5, 1, 0, '2024-09-17 01:47:33'),
(24, 10, 2, 1, 0, '2024-09-17 22:24:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `oauth_id` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `oauth_provider` varchar(255) DEFAULT NULL,
  `role` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `oauth_id`, `profile_picture`, `oauth_provider`, `role`, `created_at`) VALUES
(1, 'Dann Rob', NULL, 'dannrobg@gmail.com', '113147214169488070704', 'https://lh3.googleusercontent.com/a/ACg8ocL1S-NQyCnakLlfEruL_2y3-RqxGJae-saWRHt_ugFfjbY9rA=s96-c', 'google', NULL, '2024-09-13 09:46:10'),
(10, 'admin', '$2y$10$2q/QQH18sFtfdKmtc.b3k.7OfOwRHRLk.zWr5MUtnG9fq/isvbU7q', 'admin@gmail.com', NULL, NULL, NULL, 'admin', '2024-09-14 08:13:07'),
(11, 'Yeyo R', NULL, 'jeisondanyy@gmail.com', '117676202293548077621', 'https://lh3.googleusercontent.com/a/ACg8ocJ2jsF-xSuJZx_gC7kS-NzyfdIJymaWdjv0FQPm9sBvPySs5vg=s96-c', 'google', NULL, '2024-09-14 19:57:25'),
(12, 'Jeison', '$2y$10$gQURZ1z4.PYrEBrkZCZjvePrc0G3pi3qG6dNHgw7wZtOeRUSrP1eO', 'jeisonroblero@gmail.com', NULL, NULL, NULL, NULL, '2024-09-14 20:05:57'),
(13, 'Noe', '$2y$10$ok8uQzYlsB8.MWgBRP3A0ecnSU4iSC/TZjlGeLW/36x9cWy4I5y56', 'noe@gmial.com', NULL, NULL, NULL, NULL, '2024-09-14 22:43:17');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `purchases_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

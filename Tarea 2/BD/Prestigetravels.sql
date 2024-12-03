-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-06-2023 a las 05:52:15
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prestigetravels`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones_h`
--

CREATE TABLE `calificaciones_h` (
  `id_ch` int(11) NOT NULL,
  `id_u` int(11) NOT NULL,
  `id_h` int(11) NOT NULL,
  `limpieza` int(5) NOT NULL,
  `servicio` int(5) NOT NULL,
  `decoracion` int(5) NOT NULL,
  `calidad_ca` int(5) NOT NULL,
  `resena` varchar(500) NOT NULL,
  `promedio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `calificaciones_h`
--

INSERT INTO `calificaciones_h` (`id_ch`, `id_u`, `id_h`, `limpieza`, `servicio`, `decoracion`, `calidad_ca`, `resena`, `promedio`) VALUES
(3, 6, 1, 5, 4, 3, 5, 'wenisimo', 4.25),
(9, 6, 4, 4, 4, 3, 5, 'Muy simple la decoración', 4),
(13, 6, 0, 5, 5, 5, 5, 'Lo mas bonito que existe', 5),
(15, 6, 3, 3, 3, 4, 5, 'Muy buena vista', 3.75),
(16, 5, 1, 3, 1, 3, 3, 'MUY MUY MUY COMO LA BASURA', 2.5),
(17, 5, 0, 5, 4, 5, 4, 'Muy dificil guiarse', 4.5),
(19, 5, 11, 5, 4, 5, 5, 'Un poco apartado, pero todo es fascinante', 4.75),
(20, 5, 10, 5, 5, 5, 5, 'Muy bueno todo, sobre todo cuando te chupetea un oso ', 5),
(21, 6, 2, 3, 2, 3, 2, 'Mala calidad y mal servicio', 2.5),
(22, 6, 5, 5, 3, 4, 4, 'Nada espectacular', 4),
(23, 6, 6, 5, 5, 5, 5, 'Lo mas mejor', 5),
(24, 6, 7, 5, 4, 3, 5, 'Bonito paisaje', 4.25),
(25, 6, 8, 4, 4, 3, 4, 'Simple pero sirve', 3.75),
(26, 6, 9, 3, 3, 3, 2, 'Ahi nomah', 2.75),
(27, 6, 12, 4, 4, 5, 3, 'Medio peligroso', 4),
(30, 9, 1, 4, 1, 4, 5, 'Muy bonita la pagina', 3.5),
(32, 6, 15, 3, 1, 4, 1, 'Malo', 2.25),
(33, 6, 13, 5, 4, 5, 5, 'Relajante', 4.75),
(34, 6, 14, 3, 5, 4, 4, 'Me que atrapao help', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones_p`
--

CREATE TABLE `calificaciones_p` (
  `id_cpaq` int(11) NOT NULL,
  `id_u` int(11) NOT NULL,
  `id_p` int(11) NOT NULL,
  `calidad_h` int(5) NOT NULL,
  `transporte` int(5) NOT NULL,
  `servicio` int(5) NOT NULL,
  `relacion_pc` int(5) NOT NULL,
  `resena` varchar(500) NOT NULL,
  `promedio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `calificaciones_p`
--

INSERT INTO `calificaciones_p` (`id_cpaq`, `id_u`, `id_p`, `calidad_h`, `transporte`, `servicio`, `relacion_pc`, `resena`, `promedio`) VALUES
(1, 5, 4, 5, 5, 5, 5, 'Una experiencia unica', 5),
(2, 6, 5, 4, 5, 5, 4, 'Fantastic', 4.5),
(3, 6, 1, 5, 4, 4, 5, 'Bastante bueno el recorrido', 4.5),
(4, 6, 2, 4, 5, 3, 4, 'Me perdi', 4),
(5, 6, 3, 5, 4, 4, 5, 'Bonito paisaje', 4.5),
(10, 5, 2, 5, 5, 2, 4, 'Bonito, pero mal servicio', 4),
(13, 6, 6, 5, 4, 5, 5, 'Los osos robot son lo maximo', 4.75),
(14, 6, 7, 5, 5, 5, 5, 'Una aventura espacial', 5),
(15, 6, 8, 4, 3, 2, 2, 'Huele mal', 2.75),
(16, 6, 9, 4, 4, 5, 4, 'Buena experiencia', 4.25),
(17, 6, 11, 5, 5, 5, 4, 'Que buen mix', 4.75),
(18, 6, 12, 5, 5, 5, 5, 'Cosas inigualables', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_compra` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nom_articulo` varchar(255) NOT NULL,
  `precio` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `personas` int(11) DEFAULT NULL,
  `tipo_compra` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id_compra`, `id_usuario`, `nom_articulo`, `precio`, `cantidad`, `personas`, `tipo_compra`) VALUES
(26, 6, 'Planeptune', 18000, 1, NULL, 'hotel'),
(27, 6, 'Around the world', 40000, 1, 1, 'paquete'),
(28, 6, 'Doubletree by Hilton', 120000, 1, NULL, 'hotel'),
(31, 5, 'Around the world', 40000, 5, 2, 'paquete'),
(35, 6, 'Mainstay Suits', 100000, 1, NULL, 'hotel'),
(36, 6, 'Sheraton', 150000, 1, NULL, 'hotel'),
(37, 6, 'Hotel Kennedy', 300000, 1, NULL, 'hotel'),
(38, 6, 'Enjoy Puerto Varas', 90000, 1, NULL, 'hotel'),
(39, 6, 'InterContinental', 90000, 1, NULL, 'hotel'),
(40, 6, 'Park Plaza', 90000, 2, NULL, 'hotel'),
(41, 6, 'Fuera de Santiago', 500000, 1, 1, 'paquete'),
(42, 6, 'City tour edicion santiago', 30000, 1, 1, 'paquete'),
(43, 6, 'Recorrido por eeuu', 200000, 1, 1, 'paquete'),
(44, 6, 'Sur de Chile', 40000, 1, 1, 'paquete'),
(45, 6, 'Cyberpsicosis', 207700, 1, NULL, 'hotel'),
(48, 9, 'Around the world', 40000, 1, 1, 'paquete'),
(49, 9, 'Miami Hotel', 20000, 1, NULL, 'hotel'),
(54, 6, 'USA USA USA!', 150000, 1, 1, 'paquete'),
(55, 6, 'Recorrido universal', 190000, 1, 1, 'paquete'),
(56, 6, 'Torre del poder', 200000, 1, NULL, 'hotel'),
(57, 5, 'Miami Hotel', 20000, 2, NULL, 'hotel'),
(58, 6, 'Puyuhuapi Lodge & Spa', 150000, 1, NULL, 'hotel'),
(59, 6, 'Hotel SAO', 300000, 1, NULL, 'hotel'),
(60, 6, 'Tour geek', 500000, 1, 1, 'paquete'),
(61, 6, 'Viaje Otaku', 650000, 1, 1, 'paquete'),
(62, 6, 'Paquete MEGA MIX de la corazon', 70000, 1, 1, 'paquete'),
(63, 6, 'ARM tour', 430000, 1, 1, 'paquete');

--
-- Disparadores `carrito`
--
DELIMITER $$
CREATE TRIGGER `actualizar_disponibles_h` AFTER DELETE ON `carrito` FOR EACH ROW BEGIN
    IF OLD.tipo_compra = 'hotel' THEN
        UPDATE hoteles
        SET hoteles.habitaciones_d = hoteles.habitaciones_d + OLD.cantidad
        WHERE hoteles.nombre_h = OLD.nom_articulo;
    ELSEIF OLD.tipo_compra = 'paquete' THEN
        UPDATE paquetes
        SET paquetes.paq_disponibles = paquetes.paq_disponibles + OLD.cantidad
        WHERE paquetes.nom_paquete = OLD.nom_articulo;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hoteles`
--

CREATE TABLE `hoteles` (
  `id_h` int(11) NOT NULL,
  `nombre_h` varchar(100) NOT NULL,
  `estrellas_h` int(11) NOT NULL,
  `precio_h` int(11) NOT NULL,
  `ciudad` varchar(30) NOT NULL,
  `habitaciones_t` int(11) NOT NULL,
  `habitaciones_d` int(11) NOT NULL,
  `estacionamiento` varchar(2) NOT NULL,
  `piscina` varchar(2) NOT NULL,
  `lavanderia` varchar(2) NOT NULL,
  `pet` varchar(2) NOT NULL,
  `desayuno` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hoteles`
--

INSERT INTO `hoteles` (`id_h`, `nombre_h`, `estrellas_h`, `precio_h`, `ciudad`, `habitaciones_t`, `habitaciones_d`, `estacionamiento`, `piscina`, `lavanderia`, `pet`, `desayuno`) VALUES
(0, 'Planeptune', 5, 18000, 'Boston', 1987, 115, 'si', 'si', 'no', 'si', 'si'),
(1, 'Miami Hotel', 4, 20000, 'Miami', 20000, 3474, 'si', 'si', 'si', 'no', 'si'),
(2, 'Mainstay Suits', 1, 100000, 'IOWA', 20000, 3000, 'si', 'si', 'si', 'si', 'si'),
(3, 'Doubletree by Hilton', 3, 120000, 'Santiago', 10000, 4000, 'no', 'no', 'si', 'si', 'si'),
(4, 'Mercure', 4, 125000, 'Santiago', 10000, 4000, 'no', 'si', 'si', 'si', 'si'),
(5, 'Sheraton', 4, 150000, 'Viña del mar', 5000, 200, 'si', 'si', 'si', 'si', 'si'),
(6, 'Hotel Kennedy', 5, 300000, 'Santiago', 15000, 1389, 'si', 'no', 'si', 'no', 'si'),
(7, 'Enjoy Puerto Varas', 4, 90000, 'Puerto Varas', 1500, 89, 'si', 'si', 'si', 'no', 'si'),
(8, 'InterContinental', 3, 90000, 'Santiago', 13000, 2300, 'si', 'si', 'si', 'no', 'si'),
(9, 'Park Plaza', 2, 90000, 'Santiago', 1300, 230, 'no', 'si', 'si', 'si', 'si'),
(10, 'Fredbears Family Diner & Hotel', 5, 60000, 'New Harmony', 87, 32, 'si', 'no', 'si', 'si', 'no'),
(11, 'Hotel de gemas', 4, 100000, 'Houseki no kuni', 250, 100, 'no', 'si', 'si', 'si', 'no'),
(12, 'Cyberpsicosis', 4, 207700, 'Night City', 8000, 2079, 'si', 'no', 'si', 'si', 'si'),
(13, 'Puyuhuapi Lodge & Spa', 5, 150000, 'Cisnes', 150, 90, 'no', 'si', 'no', 'si', 'si'),
(14, 'Hotel SAO', 4, 300000, 'Piso 22 Sword art Online', 2500, 139, 'si', 'si', 'si', 'si', 'si'),
(15, 'Torre del poder', 3, 200000, 'Republica de Padokia', 10000, 200, 'no', 'no', 'no', 'no', 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquetes`
--

CREATE TABLE `paquetes` (
  `id_p` int(11) NOT NULL,
  `nom_paquete` varchar(50) DEFAULT NULL,
  `hospedaje_1` int(11) DEFAULT NULL,
  `hospedaje_2` int(11) DEFAULT NULL,
  `hospedaje_3` int(11) DEFAULT NULL,
  `ciudad_1` varchar(50) DEFAULT NULL,
  `ciudad_2` varchar(50) DEFAULT NULL,
  `ciudad_3` varchar(50) DEFAULT NULL,
  `aerolinea_ida` varchar(50) DEFAULT NULL,
  `aerolinea_vuelta` varchar(50) DEFAULT NULL,
  `f_salida` date DEFAULT NULL,
  `f_llegada` date DEFAULT NULL,
  `noches_totales` int(11) DEFAULT NULL,
  `precio_pers` int(11) DEFAULT NULL,
  `paq_disponibles` int(11) DEFAULT NULL,
  `paq_totales` int(11) DEFAULT NULL,
  `max_pers_paq` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paquetes`
--

INSERT INTO `paquetes` (`id_p`, `nom_paquete`, `hospedaje_1`, `hospedaje_2`, `hospedaje_3`, `ciudad_1`, `ciudad_2`, `ciudad_3`, `aerolinea_ida`, `aerolinea_vuelta`, `f_salida`, `f_llegada`, `noches_totales`, `precio_pers`, `paq_disponibles`, `paq_totales`, `max_pers_paq`) VALUES
(1, 'City tour edicion santiago', 8, 5, 6, 'Santiago', NULL, NULL, 'Transantiago', 'Transantiago', '2023-06-05', '2023-06-09', 4, 30000, 200, 1000, 4),
(2, 'Recorrido por eeuu', 2, 4, 1, 'Miami', 'IOWA', 'Boston', 'Sky airline', 'LATAM airlines', '2023-06-05', '2023-06-09', 5, 200000, 223, 3000, 2),
(3, 'Sur de Chile', 7, 13, NULL, 'Puerto Varas', 'Cisnes', NULL, 'Turbus', 'Andimar', '2023-06-18', '2023-06-21', 3, 40000, 140, 300, 2),
(4, 'Around the world', 2, 0, 6, 'IOWA', 'Boston', 'Puerto Varas', 'Turbus Universal', 'Infinitum', '2023-06-18', '2023-06-21', 3, 40000, 9986, 12000, 2),
(5, 'Fuera de Santiago', 1, 10, 12, 'Miami', 'New Harmony', 'Night City', 'Trailblazer', 'Coquimbo Universal', '2023-06-22', '2023-08-21', 16, 500000, 500, 120, 3),
(6, 'USA USA USA!', 1, 10, 2, 'Miami', 'New Harmony', 'IOWA', 'Sky airline', 'LATAM airlines', '2023-05-12', '2023-06-09', 5, 150000, 200, 500, 3),
(7, 'Recorrido universal', 0, 11, NULL, 'Boston', 'Houseki no kuni', NULL, 'Turbus Universal', 'LATAM airlines', '2023-07-15', '2023-10-13', 11, 190000, 500, 2000, 3),
(8, 'Tour geek', 12, 10, 11, 'Night City', 'New Harmony', 'Houseki no kuni 	', 'Tren Infinito', 'Nube voladora', '2023-06-09', '2023-06-04', 2, 500000, 473, 10000, 2),
(9, 'Viaje Otaku', 14, 15, 12, 'Piso 22 Sword art Online', 'Republica de Padokia', 'Night City', 'Crunchyroll sky', 'Luz del sol airline', '2023-06-19', '2023-06-25', 6, 650000, 790, 8000, 5),
(11, 'Paquete MEGA MIX de la corazon', 13, 6, 7, 'Cisnes', 'Santiago', 'Puerto Varas', 'Pullman Bus', 'Turbus', '2023-06-18', '2023-06-30', 11, 70000, 309, 3000, 4),
(12, 'ARM tour', 8, 0, 4, 'Santiago', 'Boston', 'Santiago', 'Sky airline', 'LATAM airlines', '2023-07-01', '2023-07-09', 8, 430000, 604, 20000, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contrasena` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_usuario`, `email`, `contrasena`, `fecha_nacimiento`) VALUES
(1, 'admin', 'thomi.rodriguez@gmail.com', '123', '2002-03-14'),
(2, 'infested', 'aaa@gmail.com', '1', '1989-12-12'),
(4, 'pinkyig', 'ale@gmail.com', '123', '2023-06-11'),
(5, 'NCT', 'pipo@gmail.com', '127', '2002-09-02'),
(6, 'calif', 'nep@gmail.com', 'cal', '2023-06-06'),
(8, 'Manzaneke', 'jmanzano854@gmail.com', '1987', '2002-09-02'),
(9, 'abc', 'abc@gmail.com', 'TT', '2023-06-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wishlists`
--

CREATE TABLE `wishlists` (
  `id_u` int(11) NOT NULL,
  `id_wish` int(100) NOT NULL,
  `id_ph` int(11) NOT NULL,
  `hotel` int(2) NOT NULL,
  `paquete` int(2) NOT NULL,
  `nombre_w` varchar(120) NOT NULL,
  `punt` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `wishlists`
--

INSERT INTO `wishlists` (`id_u`, `id_wish`, `id_ph`, `hotel`, `paquete`, `nombre_w`, `punt`) VALUES
(6, 8, 0, 1, 0, 'Planeptune ', 4.75),
(6, 9, 3, 1, 0, 'Doubletree by Hilton ', 4.38),
(6, 11, 1, 1, 0, 'Miami Hotel ', 3.42),
(5, 12, 0, 1, 0, 'Planeptune ', 4.75),
(5, 13, 10, 1, 0, 'Fredbears Family Diner & Hotel ', 5),
(5, 14, 11, 1, 0, 'Hotel de gemas ', 4.75),
(6, 16, 2, 1, 0, 'Mainstay Suits ', 2.5),
(6, 17, 4, 1, 0, 'Mercure ', 4),
(6, 18, 5, 1, 0, 'Sheraton ', 4),
(6, 19, 6, 1, 0, 'Hotel Kennedy ', 5),
(6, 20, 7, 1, 0, 'Enjoy Puerto Varas ', 4.25),
(6, 21, 8, 1, 0, 'InterContinental ', 3.75),
(6, 22, 9, 1, 0, 'Park Plaza ', 2.75),
(6, 23, 4, 0, 1, 'Around the world ', 5),
(6, 24, 5, 0, 1, 'Fuera de Santiago ', 3.38),
(6, 25, 1, 0, 1, 'City tour edicion santiago ', 4.5),
(6, 26, 3, 0, 1, 'Sur de Chile ', 4.5),
(6, 27, 12, 1, 0, 'Cyberpsicosis ', 4),
(5, 28, 12, 1, 0, 'Cyberpsicosis ', 4),
(5, 29, 4, 0, 1, 'Around the world ', 5),
(5, 30, 2, 0, 1, 'Recorrido por eeuu ', 4),
(9, 31, 4, 0, 1, 'Around the world ', 5),
(6, 32, 2, 0, 1, 'Recorrido por eeuu ', 4),
(6, 35, 6, 0, 1, 'USA USA USA! ', 4.75),
(6, 36, 7, 0, 1, 'Recorrido universal ', 5),
(6, 37, 14, 1, 0, 'Hotel SAO ', 4),
(6, 38, 13, 1, 0, 'Puyuhuapi Lodge & Spa ', 4.75),
(6, 39, 15, 1, 0, 'Torre del poder ', 2.25),
(6, 40, 8, 0, 1, 'Tour geek ', 2.75),
(6, 41, 9, 0, 1, 'Viaje Otaku ', 4.25),
(6, 42, 11, 0, 1, 'Paquete MEGA MIX de la corazon ', 4.75),
(6, 43, 12, 0, 1, 'ARM tour ', 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calificaciones_h`
--
ALTER TABLE `calificaciones_h`
  ADD PRIMARY KEY (`id_ch`),
  ADD KEY `id_u` (`id_u`);

--
-- Indices de la tabla `calificaciones_p`
--
ALTER TABLE `calificaciones_p`
  ADD PRIMARY KEY (`id_cpaq`),
  ADD KEY `id_u` (`id_u`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `hoteles`
--
ALTER TABLE `hoteles`
  ADD PRIMARY KEY (`id_h`) USING BTREE;

--
-- Indices de la tabla `paquetes`
--
ALTER TABLE `paquetes`
  ADD PRIMARY KEY (`id_p`),
  ADD KEY `hospedaje_1` (`hospedaje_1`),
  ADD KEY `hospedaje_2` (`hospedaje_2`),
  ADD KEY `hospedaje_3` (`hospedaje_3`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id_wish`),
  ADD KEY `id_u` (`id_u`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calificaciones_h`
--
ALTER TABLE `calificaciones_h`
  MODIFY `id_ch` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `calificaciones_p`
--
ALTER TABLE `calificaciones_p`
  MODIFY `id_cpaq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `paquetes`
--
ALTER TABLE `paquetes`
  MODIFY `id_p` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id_wish` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificaciones_h`
--
ALTER TABLE `calificaciones_h`
  ADD CONSTRAINT `calificaciones_h_ibfk_1` FOREIGN KEY (`id_u`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `calificaciones_p`
--
ALTER TABLE `calificaciones_p`
  ADD CONSTRAINT `calificacion_u` FOREIGN KEY (`id_u`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `conex_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `paquetes`
--
ALTER TABLE `paquetes`
  ADD CONSTRAINT `paquetes_ibfk_1` FOREIGN KEY (`hospedaje_1`) REFERENCES `hoteles` (`id_h`),
  ADD CONSTRAINT `paquetes_ibfk_2` FOREIGN KEY (`hospedaje_2`) REFERENCES `hoteles` (`id_h`),
  ADD CONSTRAINT `paquetes_ibfk_3` FOREIGN KEY (`hospedaje_3`) REFERENCES `hoteles` (`id_h`);

--
-- Filtros para la tabla `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wish_usuario` FOREIGN KEY (`id_u`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

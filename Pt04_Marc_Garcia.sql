-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 09-12-2024 a las 10:49:11
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
-- Base de datos: `Pt04_Marc_Garcia`
--
CREATE DATABASE IF NOT EXISTS `Pt04_Marc_Garcia` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `Pt04_Marc_Garcia`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `ID` int(11) NOT NULL,
  `Titol` varchar(255) NOT NULL,
  `Cos` text NOT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articles`
--

INSERT INTO `articles` (`ID`, `Titol`, `Cos`, `User_ID`) VALUES
(61, 'iPhone 14', 'Smartphone con pantalla OLED de 6.1 pulgadas, procesador A15 Bionic y cámara dual de 12 MP.', 2),
(62, 'Samsung Galaxy S23', 'Teléfono Android con pantalla Dynamic AMOLED de 6.1 pulgadas y cámara de 50 MP.', 2),
(63, 'MacBook Pro 14\"', 'Portátil Apple con procesador M1 Pro, 16 GB de RAM y 512 GB de almacenamiento SSD.', 2),
(64, 'Dell XPS 13', 'Portátil ultraligero con procesador Intel Core i7, 16 GB de RAM y pantalla táctil de 13.3 pulgadas.', 2),
(65, 'Sony WH-1000XM5', 'Auriculares inalámbricos con cancelación de ruido y hasta 30 horas de autonomía.', 2),
(66, 'GoPro HERO11', 'Cámara de acción con grabación 5.3K y estabilización de imagen mejorada.', 2),
(67, 'Apple Watch Series 9', 'Smartwatch con pantalla Retina, seguimiento de salud y resistencia al agua hasta 50 metros.', 2),
(68, 'Samsung Galaxy Watch 6', 'Reloj inteligente con seguimiento de actividad, monitorización de sueño y pantalla AMOLED.', 2),
(69, 'Nike Air Max 270', 'Zapatillas deportivas con unidad Air visible para una mayor comodidad y amortiguación.', 2),
(70, 'Adidas Ultraboost 22', 'Zapatillas de running con tecnología Boost para una mayor respuesta de energía.', 2),
(71, 'The North Face Jacket', 'Chaqueta impermeable para actividades al aire libre, resistente al viento y transpirable.', 2),
(72, 'Levi\'s 501 Original Fit Jeans', 'Vaqueros clásicos de corte recto con cierre de botones y ajuste icónico.', 2),
(73, 'Ray-Ban Aviator', 'Gafas de sol de diseño clásico con montura metálica y lentes polarizadas.', 2),
(74, 'Apple AirPods Pro 2', 'Auriculares inalámbricos con cancelación de ruido activa y modo de transparencia.', 2),
(75, 'Bose SoundLink Revolve', 'Altavoz Bluetooth portátil con sonido envolvente de 360 grados y resistencia al agua.', 2),
(76, 'PlayStation 5', 'Consola de videojuegos de nueva generación con gráficos 4K y almacenamiento SSD ultrarrápido.', 2),
(77, 'Xbox Series X', 'Consola de videojuegos con soporte para juegos en 4K y una CPU de 8 núcleos a 3.8 GHz.', 2),
(78, 'Nintendo Switch OLED', 'Consola híbrida con pantalla OLED de 7 pulgadas y capacidad de juego en modo portátil o TV.', 2),
(79, 'Dyson V15 Detect', 'Aspiradora inalámbrica con sensor láser para detectar partículas de polvo y alta potencia de succión.', 2),
(80, 'Roomba i7+', 'Robot aspirador con sistema de vaciado automático y control por voz mediante Alexa o Google Assistant.', 2),
(81, 'Sony PlayStation VR2', 'Sistema de realidad virtual para PlayStation con gráficos avanzados y seguimiento de movimiento.', 2),
(82, 'Kindle Paperwhite', 'E-reader con pantalla antirreflejo de 6.8 pulgadas, luz ajustable y resistencia al agua.', 2),
(83, 'Fitbit Charge 5', 'Pulsera de actividad con monitorización de salud, GPS integrado y análisis de sueño.', 2),
(84, 'Huawei MateBook X Pro', 'Portátil ultrafino con pantalla táctil 3K, procesador Intel Core i7 y diseño premium.', 2),
(85, 'LG OLED C1 TV 55\"', 'Televisor OLED de 55 pulgadas con resolución 4K, HDR10 y compatibilidad con Dolby Vision.', 2),
(86, 'Canon EOS R6', 'Cámara mirrorless con sensor de 20 MP, grabación en 4K y estabilización de imagen en 5 ejes.', 2),
(87, 'Samsung Galaxy Tab S8', 'Tablet con pantalla de 11 pulgadas, procesador Snapdragon 8 Gen 1 y compatibilidad con S Pen.', 2),
(88, 'JBL Charge 5', 'Altavoz portátil Bluetooth con sonido potente, resistencia al agua y hasta 20 horas de autonomía.', 2),
(89, 'Fender Stratocaster', 'Guitarra eléctrica con cuerpo de aliso, mástil de arce y pastillas de bobina simple.', 2),
(90, 'Casio G-Shock', 'Reloj resistente a golpes con funciones de cronómetro, resistencia al agua y luz LED.', 2),
(93, 'Prova', 'Prova', 2),
(94, 'PROVA', 'PROVA', 5),
(95, 'Prova', 'Prova', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuaris`
--

DROP TABLE IF EXISTS `usuaris`;
CREATE TABLE `usuaris` (
  `ID` int(11) NOT NULL,
  `Nom_usuari` varchar(50) NOT NULL,
  `Contrasenya` varchar(255) DEFAULT NULL,
  `Email` varchar(100) NOT NULL,
  `Token` varchar(255) DEFAULT NULL,
  `Google` tinyint(1) NOT NULL DEFAULT 0,
  `Github` tinyint(1) NOT NULL DEFAULT 0,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuaris`
--

INSERT INTO `usuaris` (`ID`, `Nom_usuari`, `Contrasenya`, `Email`, `Token`, `Google`, `Github`, `admin`) VALUES
(1, 'Marc', '$2y$10$vuiLR8JNL50Q56hOt2hYp.M/Mgmc9MPXw.Qf6juelfwsGETCkhTM.', 'marc@sapalomera.cat', '', 0, 0, 0),
(2, 'Prova', '$2y$10$7ck8vfA4KzRUk6XuvQ0A3ehOrTz2q5gwZJ2fdU/0CsNHkyph.3b5q', 'prova@sapalomera.cat', '', 0, 0, 1),
(5, 'Profe', '$2y$10$HXaSxKmrU5IMfoNhDXy9H.GXAB8YaI1kpu9rAd7UITEz800IB3Afa', 'profe@sapalomera.cat', '', 0, 0, 0),
(7, 'Marc', '$2y$10$R7aAN9ppPPRX3JqI/VAhhuDS1uthQnjpzDTlRvw/4ulKm1qYn/J7i', 'gmarc3292@gmail.com', NULL, 0, 0, 0),
(10, 'Garc', NULL, 'garc12play4@gmail.com', NULL, 1, 0, 0),
(12, 'Marc', NULL, 'markitussgarciamrtnz@gmail.com', NULL, 1, 0, 0),
(23, 'Marc', NULL, 'disneymarc33@gmail.com', NULL, 1, 0, 0),
(24, 'marcgarcia05', NULL, 'm.garcia5@sapalomera.cat', NULL, 0, 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indices de la tabla `usuaris`
--
ALTER TABLE `usuaris`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articles`
--
ALTER TABLE `articles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT de la tabla `usuaris`
--
ALTER TABLE `usuaris`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `usuaris` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

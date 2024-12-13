-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-12-2024 a las 19:11:41
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cinica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `contra` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `nombre`, `email`, `contra`) VALUES
(1, 'noelia', 'callenoelia3@gmail.com', '$2y$10$PAVxp0JtJ85F/S1D2vEO7epYP3jCwfLtLfCC22WAVpioSjoWp/v7S');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE `medicos` (
  `dni` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(200) NOT NULL,
  `contra` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `especialidad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`dni`, `nombre`, `apellido`, `contra`, `email`, `especialidad`) VALUES
(12345654, 'nadia', 'mendoza', '$2y$10$Cs2IulIBqKWrBXH4YpBTfOlHFfv1X3XW5bP9NW6u93NaUH03by77K', 'nahiaramaidana1345@gmail.com', 'ginecologia'),
(47164333, 'alex', 'maidana', '$2y$10$BqcjohLi5caV5VLSmcNLIeRUJEcannBUJevbEqbu1.YUTAUIlwAki', 'maidanaalex643@gmail.com', 'neurologia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `dni` int(11) NOT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `apellido` varchar(250) DEFAULT NULL,
  `contra` varchar(250) DEFAULT NULL,
  `telefono` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`dni`, `nombre`, `email`, `apellido`, `contra`, `telefono`) VALUES
(123457, 'alex', 'maidanaalex077@gmail.com', 'maidana', '$2y$10$8gPKGgW4NwqnhqHhbuxwDupgc8D.aV0sebvqUEKpnxDbV0WXZbvAW', '1150535270'),
(35092222, 'pepepito', 'pi@gmail.com', 'li', '$2y$10$LRcO62ufXgwL4JwzRnhmsuNHjVDGmKP8/XiG4/hux/VmmNG3SI27C', '43434343'),
(47164330, 'asdmhasd', 'dakdsfbjasdfkhasdf@gmail.com', 'jahsdfmsbdf', '$2y$10$MLINEatYsUzxj6AKkV9lt.2RcLmBMWLop8wEBDm8AU9FNCeUewIAe', '1150535250'),
(47164331, 'asdmhasd', 'dakdsfbjasdfkhasdf@gmail.com', 'jahsdfmsbdf', '$2y$10$Z7oB23IqQKJzwkS38h.vGOwl0K8BF99m6ane6j0ifLoTfv2RYJcbu', '1150535250'),
(47164332, 'asdmhasd', 'dakdsfbjasdfkhasdf@gmail.com', 'jahsdfmsbdf', '$2y$10$4tgm7WdJ.zc9UMV8Ivhfe.bhlukyzfyMiJwJccsq8QVxma..7r9qa', '1150535250'),
(47164333, 'nahiara', 'nadiamendoza012@gmail.com', 'maidana', '$2y$10$mrFzG0b4a2ABzsa1OCXNsuG7DYYejx97sFbAx30MkDk9UdzzCVxEq', '1150535250'),
(47164334, 'asdmhasd', 'dakdsfbjasdfkhasdf@gmail.com', 'jahsdfmsbdf', '$2y$10$HwVzzal1ZbImuuu5c9FnAezTk5FM/oIkBlBZg4CJs0WBTNOPESoeS', '1150535250'),
(47164335, 'asdmhasd', 'dakdsfbjasdfkhasdf@gmail.com', 'jahsdfmsbdf', '$2y$10$ngECk0G/NHxcHaBrW6o1uO6TLAFTEiwn1hzNfA5rc0HLZylPj3r6a', '1150535250'),
(47164336, 'asdmhasd', 'dakdsfbjasdfkhasdf@gmail.com', 'jahsdfmsbdf', '$2y$10$Dp92or5rbOS57rdsiFuZr.U8rdhbqbrNjMFiQXNi8Z/Qo.I/.uIm2', '1150535250'),
(47164337, 'asdmhasd', 'dakdsfbjasdfkhasdf@gmail.com', 'jahsdfmsbdf', '$2y$10$Gn5YY2IoMiTSKbAt1lipSOPigOvS3zjZYZe/kozhvva.MVDnpy4.K', '1150535250'),
(47164338, 'asdmhasd', 'dakdsfbjasdfkhasdf@gmail.com', 'jahsdfmsbdf', '$2y$10$GoQNtX/7xyqWtfNwsZsTr.XOgyuya2Mo8D3hW6SreC0367egum2nC', '1150535250'),
(47164339, 'asdmhasd', 'dakdsfbjasdfkhasdf@gmail.com', 'jahsdfmsbdf', '$2y$10$iY96Uc1P55ty7Ew2yXf0/eS5JsTTB0JQC1prSD/DMtuilfQaO1Vq.', '1150535250'),
(47164340, 'asdmhasd', 'dakdsfbjasdfkhasdf@gmail.com', 'jahsdfmsbdf', '$2y$10$FVxcX.uvNg3tM5LtxUveLOj55ah24rWyQw0uLGpCRBxSsunaimoim', '1150535250');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `id` int(11) NOT NULL,
  `medico_id` int(11) NOT NULL,
  `paciente_dni` int(11) NOT NULL,
  `especialidad` varchar(250) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`id`, `medico_id`, `paciente_dni`, `especialidad`, `fecha`, `hora`) VALUES
(7, 12345654, 123457, 'ginecologia', '2024-12-15', '11:00:00'),
(24, 12345654, 47164330, 'ginecologia', '2024-12-15', '13:30:00'),
(25, 12345654, 47164331, 'ginecologia', '2024-12-15', '13:00:00'),
(26, 12345654, 47164332, 'ginecologia', '2024-12-15', '12:30:00'),
(27, 12345654, 47164333, 'ginecologia', '2024-12-15', '12:00:00'),
(28, 12345654, 47164334, 'ginecologia', '2024-12-15', '11:30:00'),
(29, 12345654, 47164335, 'ginecologia', '2024-12-15', '10:30:00'),
(30, 12345654, 47164336, 'ginecologia', '2024-12-15', '10:00:00'),
(31, 12345654, 47164337, 'ginecologia', '2024-12-15', '09:30:00'),
(32, 12345654, 47164338, 'ginecologia', '2024-12-15', '09:00:00'),
(33, 12345654, 47164339, 'ginecologia', '2024-12-20', '12:00:00'),
(35, 47164333, 35092222, 'neurologia', '2024-12-15', '13:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medico_id` (`medico_id`),
  ADD KEY `paciente_dni` (`paciente_dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD CONSTRAINT `turnos_ibfk_1` FOREIGN KEY (`medico_id`) REFERENCES `medicos` (`dni`),
  ADD CONSTRAINT `turnos_ibfk_2` FOREIGN KEY (`paciente_dni`) REFERENCES `paciente` (`dni`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 18-11-2017 a las 20:23:25
-- Versión del servidor: 10.0.32-MariaDB-0+deb8u1
-- Versión de PHP: 5.6.30-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `grupo26`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion_general`
--

CREATE TABLE IF NOT EXISTS `configuracion_general` (
`id` int(11) NOT NULL,
  `cant_elementos_pagina` int(11) NOT NULL,
  `sitio_habilitado` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `configuracion_general`
--

INSERT INTO `configuracion_general` (`id`, `cant_elementos_pagina`, `sitio_habilitado`) VALUES
(1, 11, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion_inicial`
--

CREATE TABLE IF NOT EXISTS `configuracion_inicial` (
`id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` varchar(1024) NOT NULL,
  `mail_contacto` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `configuracion_inicial`
--

INSERT INTO `configuracion_inicial` (`id`, `titulo`, `descripcion`, `mail_contacto`) VALUES
(1, 'El Hospital', 'Este centro de salud tiene un programa de residencias de primer nivel en el pais. Se ofrecen oportunidades de pratica intensiva y supervisada en ambitos profesionales y por la misma -por supuesto- se recibe un salario mensual, acorde a lo que la regulacion medica profesional lo indica en cada momento.', 'contacto_hospital@gutierrez.com'),
(2, 'Guardias', 'Hospital Dr.Ricardo Gutierrez de La Plata dispone de un sotisfado servicio de guardias medicas las 24 horas para la atencion de distintas urgencias. La administracion de la institucion hace viable una eficiente separacion de los pacientes segun el nivel de seriedad y tipo de patologia.', 'contacto_guardia@gutierrez.com'),
(3, 'Especialidades', 'Acorde a una respetable trayectoria en materia de medicina y salud, en Hospital Dr.Ricardo Gutierrez de la Plata podemos encontrar profesionales de las principales especialidades de salud. Del mismo modo, se brinda atencion programada y de urgencias, se realizan estudios medicos y se brinda soporte en muchas de las ramas comunes de la medicina moderna.', 'contacto_especialidades@gutierrez.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_demograficos`
--

CREATE TABLE IF NOT EXISTS `datos_demograficos` (
`id` int(11) NOT NULL,
  `id_vivienda` varchar(11) NOT NULL,
  `id_agua` varchar(11) NOT NULL,
  `id_calefaccion` varchar(11) NOT NULL,
  `mascota` tinyint(4) NOT NULL,
  `electricidad` tinyint(4) NOT NULL,
  `heladera` tinyint(4) NOT NULL,
  `id_paciente` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `datos_demograficos`
--

INSERT INTO `datos_demograficos` (`id`, `id_vivienda`, `id_agua`, `id_calefaccion`, `mascota`, `electricidad`, `heladera`, `id_paciente`) VALUES
(1, '2', '1', '1', 1, 0, 1, 9),
(2, '3', '2', '3', 1, 0, 0, 1),
(3, '1', '2', '3', 1, 0, 1, 2),
(4, '1', '2', '1', 1, 1, 1, 3),
(5, '2', '1', '2', 0, 1, 0, 10),
(6, '1', '1', '3', 0, 1, 1, 11),
(7, '2', '2', '1', 0, 0, 0, 11),
(8, '2', '2', '2', 1, 1, 1, 12),
(9, '1', '2', '3', 1, 1, 1, 13),
(10, '2', '1', '1', 1, 1, 1, 14),
(11, '3', '1', '2', 1, 1, 1, 15),
(12, '3', '2', '3', 1, 1, 1, 16),
(13, '3', '1', '1', 1, 1, 1, 17),
(14, '1', '2', '2', 0, 1, 0, 18),
(15, '2', '2', '3', 0, 1, 0, 19),
(16, '1', '1', '1', 0, 1, 1, 20),
(17, '2', '2', '2', 0, 1, 1, 21),
(18, '1', '2', '3', 0, 1, 1, 23),
(19, '3', '1', '1', 0, 0, 0, 25),
(20, '1', '1', '2', 0, 0, 1, 27),
(21, '2', '1', '3', 0, 0, 0, 28);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia_clinica`
--

CREATE TABLE IF NOT EXISTS `historia_clinica` (
`id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `peso` int(11) NOT NULL,
  `vacunas_completas` tinyint(1) NOT NULL,
  `vacunas_observaciones` varchar(512) NOT NULL,
  `maduracion_acorde` tinyint(1) NOT NULL,
  `maduracion_observaciones` varchar(512) NOT NULL,
  `ex_fisico_normal` tinyint(1) NOT NULL,
  `ex_fisico_observaciones` varchar(511) NOT NULL,
  `pc` int(11) DEFAULT NULL,
  `ppc` int(11) DEFAULT NULL,
  `talla` int(11) DEFAULT NULL,
  `alimentacion` varchar(512) DEFAULT NULL,
  `observaciones_generales` varchar(512) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `historia_clinica`
--

INSERT INTO `historia_clinica` (`id`, `fecha`, `peso`, `vacunas_completas`, `vacunas_observaciones`, `maduracion_acorde`, `maduracion_observaciones`, `ex_fisico_normal`, `ex_fisico_observaciones`, `pc`, `ppc`, `talla`, `alimentacion`, `observaciones_generales`, `activo`, `id_paciente`, `id_usuario`) VALUES
(29, '2017-11-11 21:40:43', 50, 0, 'fgbgfbfggb', 1, '', 0, 'fdsf', 24, 52, 161, 'emi come la comida de iron manija', 'SDdgfsgffdgdgdffggdfgfdgdfg', 1, 1, 3),
(30, '2017-11-11 23:14:41', 53, 1, 'bfgbfgb', 1, '', 1, 'dfg', 35, 55, 165, 'bdddfg', 'dfg', 1, 1, 3),
(31, '2017-11-11 23:18:16', 60, 1, 'bfgbfgb', 1, '', 0, 'sdfsfd', 42, 58, 166, 'sdfsdf', 'fsdfsdfdssdfsdfsdfdsfsfdsdfdsf', 1, 1, 3),
(32, '2017-11-14 03:15:25', 80, 1, 'fsdfsdf', 1, 'sdfs', 1, 'sdfsdf', 23423, 86, 180, 'sdfsdf', 'sdfdsffd', 1, 2, 2),
(33, '2017-11-14 03:24:35', 45, 1, 'dsfdsf', 1, 'sdfsf', 1, 'sdff', 234234, 51, 150, 'guille come guilletitas', 'sfsdf', 1, 3, 2),
(34, '2017-11-14 03:25:17', 39, 1, 'fsdfsdf', 1, 'sfsdfs', 1, 'sdfsdf', 24234, 49, 153, 'guille come gordas', 'fsdfsdf', 1, 3, 2),
(35, '2017-11-14 03:37:34', 82, 0, 'sdfsdf', 0, 'sdfsdf', 1, 'dsfsdf', 4234, 79, 182, 'fssdfs', 'sdfdsf', 1, 2, 2),
(36, '2017-11-14 04:15:17', 78, 1, 'fff', 1, 'fsdf', 0, 'dsff', 324, 75, 184, 'ff', 'dfg', 1, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE IF NOT EXISTS `paciente` (
`id` int(11) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `fechaDeNacimiento` date NOT NULL,
  `genero` varchar(255) NOT NULL,
  `id_documento` varchar(11) NOT NULL,
  `numeroDocumento` int(11) NOT NULL,
  `domicilio` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `id_obraSocial` varchar(11) NOT NULL,
  `activo` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id`, `apellido`, `nombre`, `fechaDeNacimiento`, `genero`, `id_documento`, `numeroDocumento`, `domicilio`, `telefono`, `id_obraSocial`, `activo`) VALUES
(1, 'Martinez', 'Maria Emilia', '1995-07-15', 'femenino', '4', 38916388, '518 e/ 207 y 208', '2216220977', '3', 1),
(2, 'Barreto', 'Cristian', '1994-06-17', 'masculino', '2', 38369763, '46', '323455', '2', 1),
(3, 'Ramirez', 'guillermo', '1993-05-22', 'masculino', '3', 37394444, '54', '3213255', '3', 1),
(9, 'Manija', 'Iron', '2017-10-13', 'masculino', '4', 123131, 'Calle copada', '23143', '1', 1),
(10, 'Beni', 'Norma', '2017-10-13', 'femenino', '1', 3552000, '234234', '412434', '1', 1),
(11, 'jaja', 'sarasa', '2017-10-02', 'masculino', '2', 144314, 'wdq41', '1223', '3', 1),
(12, 'lalala', 'lala', '2017-10-01', 'femenino', '4', 231314, '314134', '414414', '1', 1),
(13, 'Tinelli', 'Marcelo', '2017-10-05', 'masculino', '2', 2141234, '1233', '1234566', '3', 1),
(14, 'Fort', 'Ricardo', '2016-11-29', 'masculino', '1', 1235557, 'w3214', '243214', '3', 1),
(15, 'Gimenez', 'Susana', '2017-10-13', 'femenino', '4', 123124, '2134', '23443', '2', 1),
(16, 'Spinosi', 'Agustin', '2017-10-13', 'masculino', '3', 36040200, '48', '312423', '3', 1),
(17, 'sarasa', 'mateo', '2017-10-31', 'masculino', '2', 23412, '12323', '2344', '2', 0),
(18, 'Naranja', 'Rodri', '2017-10-12', 'masculino', '1', 37861351, 'Pedro telmo', '61613216', '1', 0),
(20, 'Romagnioli', 'Leandro', '2012-11-30', 'femenino', '4', 35432151, 'Calle piola a la vuelta de los chetos', '1221351431651', '3', 0),
(21, 'Sand', 'Pepe', '1994-10-28', 'masculino', '4', 42424242, 'Calle lanus', '51316132151', '2', 1),
(22, 'Preciso', 'Claro', '2014-11-29', 'masculino', '2', 2147483647, 'Calle posada ', '6161613216', '2', 1),
(23, 'Claro', 'Nombre', '2015-11-29', 'femenino', '2', 31361561, 'Domicilioas', '3216351321', '1', 1),
(24, 'Pedro', 'Claro', '2015-10-30', 'masculino', '1', 2147483647, 'sdsddsaadsads', '3213212313', '1', 1),
(25, 'a', 'a', '1989-09-30', 'femenino', '3', 10, 'a', '23123', '1', 1),
(26, 'asd', 'asd', '2017-12-31', '', '2', 3, '324', '3', '2', 1),
(27, 'QWE', 'aDQWE', '2017-12-31', 'femenino', '3', 234234, 'sdf', '7', '2', 1),
(28, 'WQE', 'ASD', '2017-12-30', 'masculino', '1', 454534, '46 10 y 11', '344', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE IF NOT EXISTS `permiso` (
`id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id`, `nombre`) VALUES
(1, 'paciente_show'),
(2, 'paciente_new'),
(3, 'paciente_destroy'),
(4, 'paciente_update'),
(5, 'paciente_index'),
(6, 'usuario_show'),
(7, 'usuario_new'),
(8, 'usuario_update'),
(9, 'usuario_destroy'),
(10, 'configuracion_update'),
(11, 'usuario_busqueda'),
(12, 'usuario_index'),
(13, 'datosDem_show'),
(14, 'paciente_busqueda'),
(15, 'usuario_reload'),
(16, 'perfil_update'),
(17, 'perfil_show'),
(18, 'historiaClinica_show'),
(19, 'historiaClinica_new'),
(20, 'historiaClinica_update'),
(21, 'historiaClinica_index'),
(22, 'historiaClinica_destroy');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
`id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`) VALUES
(1, 'administrador'),
(2, 'pediatra'),
(3, 'recepcionista');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_permiso`
--

CREATE TABLE IF NOT EXISTS `rol_permiso` (
`id` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol_permiso`
--

INSERT INTO `rol_permiso` (`id`, `id_rol`, `id_permiso`) VALUES
(17, 1, 1),
(18, 1, 2),
(19, 1, 3),
(20, 1, 4),
(21, 1, 5),
(22, 1, 6),
(23, 1, 7),
(24, 1, 8),
(25, 1, 9),
(26, 1, 10),
(27, 1, 11),
(28, 1, 12),
(29, 1, 13),
(30, 1, 14),
(31, 1, 15),
(44, 1, 16),
(47, 1, 17),
(51, 1, 18),
(53, 1, 19),
(54, 1, 20),
(55, 1, 21),
(58, 1, 22),
(32, 2, 1),
(33, 2, 2),
(34, 2, 4),
(35, 2, 5),
(37, 2, 13),
(36, 2, 14),
(45, 2, 16),
(48, 2, 17),
(50, 2, 18),
(52, 2, 19),
(56, 2, 20),
(57, 2, 21),
(38, 3, 1),
(39, 3, 2),
(40, 3, 4),
(41, 3, 5),
(42, 3, 13),
(43, 3, 14),
(46, 3, 16),
(49, 3, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno`
--

CREATE TABLE IF NOT EXISTS `turno` (
`id` int(11) NOT NULL,
  `dni` int(11) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `turno`
--

INSERT INTO `turno` (`id`, `dni`, `fecha`) VALUES
(6, 38916388, '2017-11-18 08:00:00'),
(7, 38916388, '2017-11-18 08:30:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
`id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `activo` tinyint(4) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `username`, `password`, `activo`, `updated_at`, `created_at`, `first_name`, `last_name`) VALUES
(1, 'emi.maartinez@gmail.com', 'emi', 'lila', 1, '2017-11-07 17:45:36', '2017-10-02 00:00:00', 'Maria Emilia', 'Martinez'),
(2, 'cristianbarretof@gmail.com', 'cristian17', '1234', 1, '2017-11-08 15:04:01', '0000-00-00 00:00:00', 'cristian', 'barreto'),
(3, 'admin@gmail.com', 'admin', 'grupopiola', 1, '2017-11-06 05:27:30', '2017-10-10 00:00:00', 'Jere', 'Preto'),
(5, 'iron@gmail.com', 'iron', 'gato', 1, '2017-10-13 18:25:14', '2017-10-13 18:25:14', 'Iron', 'Ramirez'),
(6, 'pau@gmail.com', 'paula', 'hermana', 1, '2017-10-28 22:14:02', '2017-10-13 00:00:00', 'Paula', 'Martinez'),
(7, 'este@gmail.com', 'estebita', 'hermano', 1, '2017-10-28 23:54:07', '2017-10-13 00:00:00', 'Esteban', 'Martinez'),
(8, 'lorena@gmail.com', 'lanner', 'gatito', 1, '2017-10-28 23:54:17', '2017-10-13 00:00:00', 'Lorena', 'Robles'),
(9, 'pili@gmail.com', 'pili', 'pili', 1, '2017-10-28 23:54:32', '2017-10-13 00:00:00', 'Pilar', 'Cercato'),
(10, 'marcial@gmail.com', 'marcial', 'hermano', 1, '2017-10-28 23:54:48', '2017-10-13 00:00:00', 'Marcial', 'Ramirez'),
(11, 'norma@gmail.com', 'norma', 'secretaria', 1, '2017-10-28 23:54:58', '2017-10-13 00:00:00', 'Norma', 'Beni'),
(12, 'prueba@gmail.com', 'pruebaa', '1234', 1, '2017-11-06 21:19:07', '2017-11-06 01:54:47', 'holaa', 'chau'),
(14, 'b@b.com', 'cccddd', 'b', 0, '2017-11-06 21:18:56', '2017-11-06 21:11:06', 'b', 'b'),
(15, 'c@c.com', 'DD', 'c', 0, '2017-11-06 21:14:53', '2017-11-06 21:13:26', 'c', 'c'),
(16, 'gg@dd', 'dfsf', 'sdff', 1, '2017-11-08 15:04:45', '2017-11-08 15:04:45', 'sdfsd', 'sdf'),
(17, 'z@z', 'Holaa', '123', 1, '2017-11-08 15:09:26', '2017-11-08 15:09:26', 'dfdf', 'sdfs');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_rol`
--

CREATE TABLE IF NOT EXISTS `usuario_rol` (
`id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario_rol`
--

INSERT INTO `usuario_rol` (`id`, `id_usuario`, `id_rol`) VALUES
(107, 1, 2),
(108, 1, 3),
(110, 2, 2),
(89, 3, 1),
(90, 3, 2),
(91, 3, 3),
(5, 5, 1),
(8, 6, 2),
(9, 7, 3),
(10, 8, 2),
(11, 9, 2),
(12, 9, 3),
(13, 10, 2),
(14, 11, 3),
(102, 12, 1),
(103, 12, 2),
(104, 12, 3),
(84, 13, 2),
(101, 14, 3),
(97, 15, 1),
(98, 15, 2),
(111, 16, 2),
(112, 17, 3),
(113, 18, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `configuracion_general`
--
ALTER TABLE `configuracion_general`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuracion_inicial`
--
ALTER TABLE `configuracion_inicial`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datos_demograficos`
--
ALTER TABLE `datos_demograficos`
 ADD PRIMARY KEY (`id`), ADD KEY `tipo_vivienda` (`id_vivienda`), ADD KEY `id_agua` (`id_agua`), ADD KEY `id_calefaccion` (`id_calefaccion`);

--
-- Indices de la tabla `historia_clinica`
--
ALTER TABLE `historia_clinica`
 ADD PRIMARY KEY (`id`), ADD KEY `id_paciente` (`id_paciente`,`id_usuario`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
 ADD PRIMARY KEY (`id`), ADD KEY `id_documento` (`id_documento`), ADD KEY `id_obraSocial` (`id_obraSocial`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol_permiso`
--
ALTER TABLE `rol_permiso`
 ADD PRIMARY KEY (`id`), ADD KEY `id_rol` (`id_rol`,`id_permiso`);

--
-- Indices de la tabla `turno`
--
ALTER TABLE `turno`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
 ADD PRIMARY KEY (`id`), ADD KEY `id_usuario` (`id_usuario`,`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `configuracion_general`
--
ALTER TABLE `configuracion_general`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `configuracion_inicial`
--
ALTER TABLE `configuracion_inicial`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `datos_demograficos`
--
ALTER TABLE `datos_demograficos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `historia_clinica`
--
ALTER TABLE `historia_clinica`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `rol_permiso`
--
ALTER TABLE `rol_permiso`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT de la tabla `turno`
--
ALTER TABLE `turno`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=114;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

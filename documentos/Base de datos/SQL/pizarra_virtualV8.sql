-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 16-05-2014 a las 17:02:41
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `pizarra_virtual`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE IF NOT EXISTS `alumno` (
  `id_alumno` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `matricula` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `institucion` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `correo` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `info_adicional` text COLLATE utf8_unicode_ci NOT NULL,
  `usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_alumno`),
  KEY `fk_alumno_usuario1_idx` (`usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id_alumno`, `nombres`, `apellidos`, `matricula`, `institucion`, `fecha_nacimiento`, `fecha_ingreso`, `correo`, `info_adicional`, `usuario`) VALUES
(1, 'al', 'al', 'aa', 'aaa', '2014-05-14', '2014-05-16', 'asd.c@qwe.ccom', 'ASAS', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo`
--

CREATE TABLE IF NOT EXISTS `archivo` (
  `id_Archivos` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `grupo` int(11) NOT NULL,
  PRIMARY KEY (`id_Archivos`),
  KEY `fk_Archivos_grupo1_idx` (`grupo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat_general`
--

CREATE TABLE IF NOT EXISTS `chat_general` (
  `id_chat` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mensaje` text COLLATE utf8_unicode_ci NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id_chat`),
  KEY `fk_chat_general_idx` (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `chat_general`
--

INSERT INTO `chat_general` (`id_chat`, `mensaje`, `usuario_id`, `fecha`) VALUES
(1, 'ff', 3, '2014-05-13 04:49:20'),
(2, 'ggg', 3, '2014-05-13 05:03:08'),
(3, 'a', 2, '2014-05-13 05:16:08'),
(4, 'bbbbbb', 2, '2014-05-13 05:16:10'),
(5, 'cccccc', 2, '2014-05-13 05:16:12'),
(6, 'ddddd', 2, '2014-05-13 05:16:14'),
(7, 'eeeeeeee', 2, '2014-05-13 05:16:16'),
(8, 'ffff', 2, '2014-05-13 05:16:18'),
(9, 'gggg', 2, '2014-05-13 05:16:20'),
(10, 'hhh', 2, '2014-05-13 05:16:57'),
(11, 'iiii', 2, '2014-05-13 05:17:01'),
(12, 'fff', 2, '2014-05-13 05:22:09'),
(13, 'sss', 2, '2014-05-13 05:22:15'),
(14, 'iguigiguiug s s s s s s  s s  addwdweweeeeeeeeeeeeeeeeeeeeee eeeeeeeeeeeeeeee', 1, '2014-05-13 20:42:09'),
(15, 'holaaa', 1, '2014-05-13 21:22:06'),
(16, 'aaa', 1, '2014-05-13 21:43:09'),
(17, 'fefe', 1, '2014-05-13 21:45:23'),
(18, 'Hola\n&lt;br&gt;\naca', 1, '2014-05-13 22:31:32'),
(19, 'ff', 2, '2014-05-13 23:17:40'),
(20, 'wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww', 2, '2014-05-13 23:18:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat_grupo`
--

CREATE TABLE IF NOT EXISTS `chat_grupo` (
  `id_chat` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mensaje` text COLLATE utf8_unicode_ci NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id_chat`),
  KEY `fk_chat_grupo_usuario_idx` (`usuario_id`),
  KEY `fk_chat_grupo_grupo_idx` (`grupo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `chat_grupo`
--

INSERT INTO `chat_grupo` (`id_chat`, `mensaje`, `usuario_id`, `grupo_id`, `fecha`) VALUES
(1, 'gggg11', 3, 2, '2014-05-13 05:03:00'),
(2, 'aaa\n', 3, 2, '2014-05-13 05:03:19'),
(3, 'ggg322', 2, 3, '2014-05-13 05:05:02'),
(4, '11111', 2, 3, '2014-05-13 05:05:11'),
(5, '22222222', 2, 3, '2014-05-13 05:05:13'),
(6, '33333333', 2, 3, '2014-05-13 05:05:15'),
(7, '4444444444', 2, 3, '2014-05-13 05:05:17'),
(8, '55555555', 2, 3, '2014-05-13 05:05:21'),
(9, '6666666666', 2, 3, '2014-05-13 05:05:24'),
(10, '666666', 2, 3, '2014-05-13 05:05:26'),
(11, '77777777777', 2, 3, '2014-05-13 05:05:29'),
(12, '88888888', 2, 3, '2014-05-13 05:05:31'),
(13, '9999999999', 2, 3, '2014-05-13 05:05:33'),
(14, '10101010', 2, 3, '2014-05-13 05:05:35'),
(15, '11111111', 2, 3, '2014-05-13 05:05:37'),
(16, '1212121', 2, 3, '2014-05-13 05:05:41'),
(17, '131313\n', 2, 3, '2014-05-13 05:05:45'),
(18, '141414141\n', 2, 3, '2014-05-13 05:05:48'),
(19, '151515151', 2, 3, '2014-05-13 05:05:51'),
(20, '161616161', 2, 3, '2014-05-13 05:05:52'),
(21, '17717171', 2, 3, '2014-05-13 05:05:54'),
(22, '18181818', 2, 3, '2014-05-13 05:05:56'),
(23, '1919191\n', 2, 3, '2014-05-13 05:05:58'),
(24, '20202020\n', 2, 3, '2014-05-13 05:06:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase`
--

CREATE TABLE IF NOT EXISTS `clase` (
  `id_clase` int(11) NOT NULL AUTO_INCREMENT,
  `grupo` int(11) NOT NULL,
  `alumno` int(11) NOT NULL,
  PRIMARY KEY (`id_clase`),
  KEY `fk_grupo_clase_idx` (`grupo`),
  KEY `fk_alumno_clase_idx` (`alumno`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `clase`
--

INSERT INTO `clase` (`id_clase`, `grupo`, `alumno`) VALUES
(1, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE IF NOT EXISTS `grupo` (
  `id_grupo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_desintegracion` date NOT NULL,
  `plan` int(11) NOT NULL,
  `tutor` int(11) NOT NULL,
  `pizarra` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_grupo`),
  KEY `fk_tutor_grupo_idx` (`tutor`),
  KEY `fk_plan_grupo_idx` (`plan`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id_grupo`, `nombre`, `fecha_creacion`, `fecha_desintegracion`, `plan`, `tutor`, `pizarra`) VALUES
(2, 'G1 asdasdasdas we qwr rw rwetw et twet wet wett', '2014-05-28', '2014-05-22', 1, 1, 'pizarra'),
(3, 'G2', '2014-05-28', '2014-05-14', 1, 1, 'paaa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan`
--

CREATE TABLE IF NOT EXISTS `plan` (
  `id_plan` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_creacion` date NOT NULL,
  `carpeta_material` text COLLATE utf8_unicode_ci NOT NULL,
  `plan_procedente` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `tarea` int(11) NOT NULL,
  PRIMARY KEY (`id_plan`),
  KEY `fK_plan_tarea_idx` (`tarea`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `plan`
--

INSERT INTO `plan` (`id_plan`, `nombre`, `fecha_creacion`, `carpeta_material`, `plan_procedente`, `tarea`) VALUES
(1, 'plan1', '2014-05-14', 'ssd', 'asd', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea`
--

CREATE TABLE IF NOT EXISTS `tarea` (
  `id_tarea` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `responsable` int(11) NOT NULL,
  `contenido` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_tarea`),
  KEY `fk_tutor_tarea_idx` (`responsable`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tarea`
--

INSERT INTO `tarea` (`id_tarea`, `nombre`, `descripcion`, `responsable`, `contenido`) VALUES
(1, 'Tarea1', 'tarea', 1, 'jpasjdpoasjdpoajepqwjepqjepqwjepoqjepoqjeqweqwknelqkwnelkqw');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutor`
--

CREATE TABLE IF NOT EXISTS `tutor` (
  `id_tutor` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `seccion` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `correo` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_tutor`),
  KEY `fk_tutor_usuario1_idx` (`usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tutor`
--

INSERT INTO `tutor` (`id_tutor`, `nombres`, `apellidos`, `seccion`, `fecha_nacimiento`, `fecha_ingreso`, `correo`, `usuario`) VALUES
(1, 'tu', 'tu', 'tu', '2014-05-13', '2014-05-01', 'asd.c@qwe.ccom', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `contrasena` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `contrasena`, `tipo_usuario`) VALUES
(1, 'admin', '$1$7n..Cz3.$g9z0DTQsQbxj6BYlDVfon1', 1),
(2, 't', '$1$7n..Cz3.$g9z0DTQsQbxj6BYlDVfon1', 2),
(3, 'a', '$1$7n..Cz3.$g9z0DTQsQbxj6BYlDVfon1', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_grupo`
--

CREATE TABLE IF NOT EXISTS `usuario_grupo` (
  `id_usuario_grupo` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario_grupo`),
  KEY `fk_usuario_grupo_usuario_idx` (`usuario_id`),
  KEY `fk_usuario_grupo_grupo_idx` (`grupo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `usuario_grupo`
--

INSERT INTO `usuario_grupo` (`id_usuario_grupo`, `usuario_id`, `grupo_id`) VALUES
(1, 3, 2),
(2, 2, 3);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `fk_alumno_usuario1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `archivo`
--
ALTER TABLE `archivo`
  ADD CONSTRAINT `fk_archivo_grupo` FOREIGN KEY (`grupo`) REFERENCES `grupo` (`id_grupo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `chat_general`
--
ALTER TABLE `chat_general`
  ADD CONSTRAINT `fk_chat_general` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `chat_grupo`
--
ALTER TABLE `chat_grupo`
  ADD CONSTRAINT `fk_chat_grupo_grupo` FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id_grupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_chat_grupo_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `clase`
--
ALTER TABLE `clase`
  ADD CONSTRAINT `fk_alumno_clase` FOREIGN KEY (`alumno`) REFERENCES `alumno` (`id_alumno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_grupo_clase` FOREIGN KEY (`grupo`) REFERENCES `grupo` (`id_grupo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `fk_plan_grupo` FOREIGN KEY (`plan`) REFERENCES `plan` (`id_plan`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tutor_grupo` FOREIGN KEY (`tutor`) REFERENCES `tutor` (`id_tutor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `plan`
--
ALTER TABLE `plan`
  ADD CONSTRAINT `fK_plan_tarea` FOREIGN KEY (`tarea`) REFERENCES `tarea` (`id_tarea`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD CONSTRAINT `fk_tutor_tarea` FOREIGN KEY (`responsable`) REFERENCES `tutor` (`id_tutor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tutor`
--
ALTER TABLE `tutor`
  ADD CONSTRAINT `fk_tutor_usuario1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario_grupo`
--
ALTER TABLE `usuario_grupo`
  ADD CONSTRAINT `fk_usuario_grupo_grupo` FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id_grupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_grupo_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

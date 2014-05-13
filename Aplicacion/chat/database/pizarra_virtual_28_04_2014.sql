-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 29-04-2014 a las 20:17:33
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
  PRIMARY KEY (`id_alumno`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id_alumno`, `nombres`, `apellidos`, `matricula`, `institucion`, `fecha_nacimiento`, `fecha_ingreso`, `correo`, `info_adicional`) VALUES
(1, 'g', 'g', 'g', 'g', '2014-04-16', '2014-04-09', 'adasd', 'dasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase`
--

CREATE TABLE IF NOT EXISTS `clase` (
  `id_clase` int(11) NOT NULL,
  `grupo` int(11) NOT NULL,
  `alumno` int(11) NOT NULL,
  PRIMARY KEY (`id_clase`),
  KEY `fk_grupo_clase_idx` (`grupo`),
  KEY `fk_alumno_clase_idx` (`alumno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  PRIMARY KEY (`id_grupo`),
  KEY `fk_tutor_grupo_idx` (`tutor`),
  KEY `fk_plan_grupo_idx` (`plan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE IF NOT EXISTS `mensaje` (
  `id_mensaje` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `usuario` int(11) NOT NULL,
  `mensaje` varchar(10000) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_hora` datetime NOT NULL,
  PRIMARY KEY (`id_mensaje`),
  KEY `fk_usuario_mensaje_idx` (`usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`id_mensaje`, `usuario`, `mensaje`, `fecha_hora`) VALUES
(1, 1, 'hola', '2014-04-20 14:11:32'),
(2, 1, 'Hola\n', '2014-04-27 01:38:10'),
(3, 1, 'uh', '2014-04-29 20:12:49');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea`
--

CREATE TABLE IF NOT EXISTS `tarea` (
  `id_tarea` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `responsable` int(11) NOT NULL,
  PRIMARY KEY (`id_tarea`),
  KEY `fk_tutor_tarea_idx` (`responsable`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`id_tutor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tutor`
--

INSERT INTO `tutor` (`id_tutor`, `nombres`, `apellidos`, `seccion`, `fecha_nacimiento`, `fecha_ingreso`, `correo`) VALUES
(1, 'g', 'g', 'g', '2014-04-16', '2014-04-02', 'ss');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `contrasena` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `fk_usuario_tutor_idx` (`usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usuario`, `nombre_usuario`, `contrasena`, `tipo_usuario`) VALUES
(1, 1, 'f', '', 0),
(3, 1, 'f', '', 1);

--
-- Restricciones para tablas volcadas
--

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
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `fk_usuario_mensaje` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_alumno` FOREIGN KEY (`usuario`) REFERENCES `alumno` (`id_alumno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_tutor` FOREIGN KEY (`usuario`) REFERENCES `tutor` (`id_tutor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

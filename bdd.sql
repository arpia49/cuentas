-- phpMyAdmin SQL Dump
-- version 2.11.9.3
-- http://www.phpmyadmin.net
--
-- Servidor: mysql.arpia49.com
-- Tiempo de generación: 22-04-2009 a las 15:13:32
-- Versión del servidor: 5.0.67
-- Versión de PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `arpia49cuentas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amigos`
--

CREATE TABLE IF NOT EXISTS `amigos` (
  `id_user1` mediumint(8) unsigned NOT NULL,
  `id_user2` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY  (`id_user1`,`id_user2`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fiestas`
--

CREATE TABLE IF NOT EXISTS `fiestas` (
  `id_fiesta` mediumint(8) unsigned NOT NULL auto_increment,
  `id_user` mediumint(8) unsigned NOT NULL,
  `descripcion` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `abierto` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id_fiesta`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=32 ;

--
-- Volcar la base de datos para la tabla `fiestas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rondas`
--

CREATE TABLE IF NOT EXISTS `rondas` (
  `id_user` mediumint(8) unsigned NOT NULL,
  `desc` varchar(255) collate utf8_spanish2_ci NOT NULL,
  `id_ronda` mediumint(8) unsigned NOT NULL auto_increment,
  `precio` decimal(10,2) NOT NULL,
  PRIMARY KEY  (`id_ronda`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=64 ;

--
-- Volcar la base de datos para la tabla `rondas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rondas_fiesta`
--

CREATE TABLE IF NOT EXISTS `rondas_fiesta` (
  `id_ronda` mediumint(8) unsigned NOT NULL,
  `id_fiesta` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY  (`id_ronda`,`id_fiesta`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` mediumint(8) unsigned NOT NULL auto_increment,
  `user` varchar(255) collate utf8_spanish2_ci NOT NULL,
  `pass` varchar(32) collate utf8_spanish2_ci NOT NULL,
  `correo` varchar(100) collate utf8_spanish2_ci NOT NULL,
  PRIMARY KEY  (`id_user`),
  UNIQUE KEY `user` (`user`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_fiesta`
--

CREATE TABLE IF NOT EXISTS `users_fiesta` (
  `id_user` mediumint(8) unsigned NOT NULL,
  `id_fiesta` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY  (`id_user`,`id_fiesta`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_ronda`
--

CREATE TABLE IF NOT EXISTS `users_ronda` (
  `id_user` mediumint(8) unsigned NOT NULL,
  `id_ronda` mediumint(8) unsigned NOT NULL,
  `marcado` tinyint(1) NOT NULL default '1',
  `saldo` decimal(10,2) NOT NULL default '0.00',
  PRIMARY KEY  (`id_user`,`id_ronda`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;


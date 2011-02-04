-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-02-2011 a las 15:35:07
-- Versión del servidor: 5.1.41
-- Versión de PHP: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `fractalcms_db1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fw_log_document`
--

DROP TABLE IF EXISTS `fw_log_document`;
CREATE TABLE IF NOT EXISTS `fw_log_document` (
  `ld_file` varchar(250) NOT NULL DEFAULT '',
  `ld_referer` varchar(250) NOT NULL DEFAULT '',
  `ld_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `ld_date` (`ld_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `fw_log_document`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fw_log_email`
--

DROP TABLE IF EXISTS `fw_log_email`;
CREATE TABLE IF NOT EXISTS `fw_log_email` (
  `contenido_id` int(12) NOT NULL DEFAULT '0',
  `le_email_to` varchar(250) NOT NULL DEFAULT '',
  `le_name_to` varchar(250) NOT NULL DEFAULT '',
  `le_name` varchar(250) NOT NULL DEFAULT '',
  `le_email` varchar(200) NOT NULL DEFAULT '',
  `le_title` varchar(250) NOT NULL DEFAULT '',
  `le_message` text NOT NULL,
  `le_moreinfo` text NOT NULL,
  `le_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `le_ip` varchar(16) NOT NULL DEFAULT '',
  KEY `le_date` (`le_date`),
  KEY `contenido_id` (`contenido_id`),
  KEY `le_email_to` (`le_email_to`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `fw_log_email`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fw_log_page`
--

DROP TABLE IF EXISTS `fw_log_page`;
CREATE TABLE IF NOT EXISTS `fw_log_page` (
  `contenido_id` int(12) NOT NULL DEFAULT '0',
  `log_page_referer` varchar(250) NOT NULL DEFAULT '',
  `log_page_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `contenido_id` (`contenido_id`),
  KEY `log_page_referer` (`log_page_referer`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `fw_log_page`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fw_log_search`
--

DROP TABLE IF EXISTS `fw_log_search`;
CREATE TABLE IF NOT EXISTS `fw_log_search` (
  `querystring` varchar(250) NOT NULL DEFAULT '',
  `num_res` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_ip` varchar(20) NOT NULL DEFAULT '',
  KEY `querystring` (`querystring`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Search stats';

--
-- Volcar la base de datos para la tabla `fw_log_search`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fw_log_user`
--

DROP TABLE IF EXISTS `fw_log_user`;
CREATE TABLE IF NOT EXISTS `fw_log_user` (
  `user_log_sid` varchar(128) NOT NULL DEFAULT '',
  `persona_id` int(11) NOT NULL DEFAULT '0',
  `user_log_useragent` varchar(255) NOT NULL DEFAULT '',
  `user_log_browser` varchar(150) NOT NULL DEFAULT '',
  `user_log_browser_version` varchar(60) NOT NULL DEFAULT '',
  `user_log_os` varchar(150) NOT NULL DEFAULT '',
  `user_log_os_version` varchar(60) NOT NULL DEFAULT '',
  `user_log_ipadress` varchar(20) NOT NULL DEFAULT '',
  `user_log_referer` varchar(250) NOT NULL DEFAULT '',
  `user_log_lastpage` int(12) NOT NULL DEFAULT '0',
  `user_log_counter` int(11) NOT NULL DEFAULT '0',
  `user_log_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`user_log_sid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `fw_log_user`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fw_node_english`
--

DROP TABLE IF EXISTS `fw_node_english`;
CREATE TABLE IF NOT EXISTS `fw_node_english` (
  `node_id` int(11) NOT NULL DEFAULT '0',
  `map` int(2) NOT NULL DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `template_id` smallint(6) NOT NULL DEFAULT '0',
  `template_layout` smallint(6) NOT NULL DEFAULT '0',
  `template_head` smallint(6) NOT NULL DEFAULT '0',
  `template_menu1` smallint(6) NOT NULL DEFAULT '0',
  `template_menu2` smallint(6) NOT NULL DEFAULT '0',
  `template_main` smallint(6) NOT NULL DEFAULT '0',
  `template_secondary` smallint(6) NOT NULL DEFAULT '0',
  `template_footer` smallint(6) NOT NULL DEFAULT '0',
  `visible` tinyint(4) NOT NULL DEFAULT '1',
  `title` text NOT NULL,
  `summary` text,
  `content` text,
  `image` varchar(400) DEFAULT NULL,
  `autor` varchar(300) DEFAULT NULL,
  `date` datetime DEFAULT '0000-00-00 00:00:00',
  `categories` text,
  `order` int(12) NOT NULL DEFAULT '0',
  `params` text COMMENT 'JSON  encoded array with node parameters, Base 64 encoded',
  `rawtext` text,
  PRIMARY KEY (`node_id`),
  KEY `map` (`map`),
  KEY `parent` (`parent_id`),
  KEY `order` (`order`),
  FULLTEXT KEY `rawtext` (`rawtext`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Content data';
--
-- Volcar la base de datos para la tabla `fw_node_english`
--

INSERT INTO `fw_node_english` VALUES
(1, 1, 0, 1, 2, 7, 5, 0, 9, 16, 6, 1, 'Home', '', '21;5;3', '', '', '0000-00-00 00:00:00', '', 1, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(2, 0, 1, 1, 0, 0, 0, 0, 3, 4, 0, 1, 'Site Tools', '', '', '', '', '0000-00-00 00:00:00', '', 1, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(3, 0, 1, 1, 0, 0, 0, 0, 3, 4, 0, 1, 'Contents', '', '', '', '', '0000-00-00 00:00:00', '', 10, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(4, 0, 1, 1, 0, 0, 0, 0, 3, 4, 0, 1, 'Administration', '', '', '', '', '0000-00-00 00:00:00', '', 20, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(5, 0, 2, 0, 0, 0, 0, 0, 10, 0, 0, 1, 'Search', '', 'buscar.inc.php', '', '', '0000-00-00 00:00:00', '', 5, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(6, 0, 2, 0, 0, 0, 0, 0, 10, 0, 0, 1, 'Contact Us', '', 'contacto.inc.php|contactos=Webmaster:info@fractalserver.com,CIO:info@f20x.com|campos=Address,City,Telephone', '', '', '0000-00-00 00:00:00', '', 10, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(7, 0, 2, 0, 0, 0, 0, 0, 10, 0, 0, 1, 'Site Map', '', 'mapa.inc.php', '', '', '0000-00-00 00:00:00', '', 15, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(8, 0, 2, 0, 0, 0, 0, 0, 10, 0, 0, 1, 'Login', '', 'login.inc.php', '', '', '0000-00-00 00:00:00', '', 20, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(9, 0, 2, 0, 0, 0, 0, 0, 3, 0, 0, 0, 'Tool 5', '', '', '', '', '0000-00-00 00:00:00', '', 25, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(10, 0, 2, 0, 0, 0, 0, 0, 3, 0, 0, 0, 'Tool 6', '', '', '', '', '0000-00-00 00:00:00', '', 30, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(11, 0, 4, 0, 0, 0, 0, 0, 10, 0, 0, 1, 'Users Administration', '', 'adm/users.inc.php', '', '', '0000-00-00 00:00:00', '', 5, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(12, 0, 4, 0, 0, 0, 0, 0, 10, 0, 0, 1, 'Site Stats', '', 'adm/stats.inc.php', '', '', '0000-00-00 00:00:00', '', 10, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(13, 0, 4, 0, 0, 0, 0, 0, 10, 0, 0, 1, 'Access Grants', '', 'adm/groups.inc.php', '', '', '0000-00-00 00:00:00', '', 15, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(14, 0, 4, 0, 0, 0, 0, 0, 10, 0, 0, 0, 'Admin 2', '', '', '', '', '0000-00-00 00:00:00', '', 20, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(15, 0, 4, 0, 0, 0, 0, 0, 10, 0, 0, 0, 'Admin 3', '', '', '', '', '0000-00-00 00:00:00', '', 25, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(16, 0, 4, 0, 0, 0, 0, 0, 10, 0, 0, 0, 'Admin 4', '', '', '', '', '0000-00-00 00:00:00', '', 30, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(17, 0, 4, 0, 0, 0, 0, 0, 10, 0, 0, 0, 'Admin 5', '', '', '', '', '0000-00-00 00:00:00', '', 35, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(18, 0, 4, 0, 0, 0, 0, 0, 10, 0, 0, 0, 'Admin 6', '', '', '', '', '0000-00-00 00:00:00', '', 40, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(19, 0, 4, 0, 0, 0, 0, 0, 10, 0, 0, 0, 'Admin 7', '', '', '', '', '0000-00-00 00:00:00', '', 45, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(20, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'Section 1', '', '', '', '', '0000-00-00 00:00:00', '', 5, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(21, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'Section 2', '', '', '', '', '0000-00-00 00:00:00', '', 10, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(22, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'Section 3', '', '', '', '', '0000-00-00 00:00:00', '', 15, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(23, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'Section 4', '', '', '', '', '0000-00-00 00:00:00', '', 20, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(24, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Section 5', '', '', '', '', '0000-00-00 00:00:00', '', 25, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(25, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Section 6', '', '', '', '', '0000-00-00 00:00:00', '', 30, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(26, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Section 7', '', '', '', '', '0000-00-00 00:00:00', '', 35, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(27, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Section 8', '', '', '', '', '0000-00-00 00:00:00', '', 40, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(28, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Section 9', '', '', '', '', '0000-00-00 00:00:00', '', 45, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(29, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Section 10', '', '', '', '', '0000-00-00 00:00:00', '', 50, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fw_node_spanish`
--

DROP TABLE IF EXISTS `fw_node_spanish`;
CREATE TABLE IF NOT EXISTS `fw_node_spanish` (
  `node_id` int(11) NOT NULL AUTO_INCREMENT,
  `map` int(2) NOT NULL DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `template_id` smallint(6) NOT NULL DEFAULT '0',
  `template_layout` smallint(6) NOT NULL DEFAULT '0',
  `template_head` smallint(6) NOT NULL DEFAULT '0',
  `template_menu1` smallint(6) NOT NULL DEFAULT '0',
  `template_menu2` smallint(6) NOT NULL DEFAULT '0',
  `template_main` smallint(6) NOT NULL DEFAULT '0',
  `template_secondary` smallint(6) NOT NULL DEFAULT '0',
  `template_footer` smallint(6) NOT NULL DEFAULT '0',
  `visible` tinyint(4) NOT NULL DEFAULT '1',
  `title` text NOT NULL,
  `summary` text,
  `content` text,
  `image` varchar(200) DEFAULT NULL,
  `autor` varchar(150) DEFAULT NULL,
  `date` datetime DEFAULT '0000-00-00 00:00:00',
  `categories` text,
  `order` int(12) NOT NULL DEFAULT '0',
  `params` text COMMENT 'JSON  encoded array with node parameters, Base 64 encoded',
  `rawtext` text,
  PRIMARY KEY (`node_id`),
  KEY `map` (`map`),
  KEY `padre` (`parent_id`),
  KEY `orden` (`order`),
  FULLTEXT KEY `rawtext` (`rawtext`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Content data';

--
-- Volcar la base de datos para la tabla `fw_node_spanish`
--

INSERT INTO `fw_node_spanish` VALUES
(1, 1, 0, 1, 2, 7, 5, 0, 9, 16, 6, 1, 'Inicio', '', '21;5;3', '', '', '0000-00-00 00:00:00', '', 1, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(2, 0, 1, 1, 0, 0, 0, 0, 3, 4, 0, 1, 'Herramientas', '', '', '', '', '0000-00-00 00:00:00', '', 1, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(3, 0, 1, 1, 0, 0, 0, 0, 3, 4, 0, 1, 'Contenidos', '', '', '', '', '0000-00-00 00:00:00', '', 10, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(4, 0, 1, 1, 0, 0, 0, 0, 3, 4, 0, 1, 'Administraci&oacute;n', '', '', '', '', '0000-00-00 00:00:00', '', 20, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(5, 0, 2, 0, 0, 0, 0, 0, 10, 0, 0, 1, 'Buscar', '', 'buscar.inc.php', '', '', '0000-00-00 00:00:00', '', 5, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(6, 0, 2, 0, 0, 0, 0, 0, 10, 0, 0, 1, 'Contacto', '', 'contacto.inc.php|contactos=Webmaster:info@fractalserver.com,CIO:info@f20x.com|campos=Address,City,Telephone', '', '', '0000-00-00 00:00:00', '', 10, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(7, 0, 2, 0, 0, 0, 0, 0, 10, 0, 0, 1, 'Mapa del Sitio', '', 'mapa.inc.php', '', '', '0000-00-00 00:00:00', '', 15, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(8, 0, 2, 0, 0, 0, 0, 0, 10, 0, 0, 1, 'Ingresar', '', 'login.inc.php', '', '', '0000-00-00 00:00:00', '', 20, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(9, 0, 2, 0, 0, 0, 0, 0, 3, 0, 0, 0, 'Herramienta 5', '', '', '', '', '0000-00-00 00:00:00', '', 25, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(10, 0, 2, 0, 0, 0, 0, 0, 3, 0, 0, 0, 'Herramienta 6', '', '', '', '', '0000-00-00 00:00:00', '', 30, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(11, 0, 4, 0, 0, 0, 0, 0, 10, 0, 0, 1, 'Administrador de Usuarios', '', 'adm/users.inc.php', '', '', '0000-00-00 00:00:00', '', 5, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(12, 0, 4, 0, 0, 0, 0, 0, 10, 0, 0, 1, 'Estad&iacute;sticas de Acceso', '', 'adm/stats.inc.php', '', '', '0000-00-00 00:00:00', '', 10, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(13, 0, 4, 0, 0, 0, 0, 0, 10, 0, 0, 1, 'Permisos de Acceso', '', 'adm/groups.inc.php', '', '', '0000-00-00 00:00:00', '', 15, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(14, 0, 4, 0, 0, 0, 0, 0, 10, 0, 0, 0, 'Admin 2', '', '', '', '', '0000-00-00 00:00:00', '', 20, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(15, 0, 4, 0, 0, 0, 0, 0, 10, 0, 0, 0, 'Admin 3', '', '', '', '', '0000-00-00 00:00:00', '', 25, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(16, 0, 4, 0, 0, 0, 0, 0, 10, 0, 0, 0, 'Admin 4', '', '', '', '', '0000-00-00 00:00:00', '', 30, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(17, 0, 4, 0, 0, 0, 0, 0, 10, 0, 0, 0, 'Admin 5', '', '', '', '', '0000-00-00 00:00:00', '', 35, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(18, 0, 4, 0, 0, 0, 0, 0, 10, 0, 0, 0, 'Admin 6', '', '', '', '', '0000-00-00 00:00:00', '', 40, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(19, 0, 4, 0, 0, 0, 0, 0, 10, 0, 0, 0, 'Admin 7', '', '', '', '', '0000-00-00 00:00:00', '', 45, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(20, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'Secci&oacute;n 1', '', '', '', '', '0000-00-00 00:00:00', '', 5, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(21, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'Secci&oacute;n 2', '', '', '', '', '0000-00-00 00:00:00', '', 10, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(22, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'Secci&oacute;n 3', '', '', '', '', '0000-00-00 00:00:00', '', 15, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(23, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'Secci&oacute;n 4', '', '', '', '', '0000-00-00 00:00:00', '', 20, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(24, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Secci&oacute;n 5', '', '', '', '', '0000-00-00 00:00:00', '', 25, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(25, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Secci&oacute;n 6', '', '', '', '', '0000-00-00 00:00:00', '', 30, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(26, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Secci&oacute;n 7', '', '', '', '', '0000-00-00 00:00:00', '', 35, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(27, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Secci&oacute;n 8', '', '', '', '', '0000-00-00 00:00:00', '', 40, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(28, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Secci&oacute;n 9', '', '', '', '', '0000-00-00 00:00:00', '', 45, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL),
(29, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Secci&oacute;n 10', '', '', '', '', '0000-00-00 00:00:00', '', 50, 'eyJwcmludEJ1dHRvbiI6MSwibnVtUmVncyI6MTAsInNvcnRCeSI6Im9yZGVyIiwic29ydERpciI6IkFTQyIsInN1YkNsYXNzIjoiIn0=', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fw_persona`
--

DROP TABLE IF EXISTS `fw_persona`;
CREATE TABLE IF NOT EXISTS `fw_persona` (
  `persona_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL DEFAULT '',
  `password` varchar(200) NOT NULL DEFAULT '',
  `email` varchar(220) DEFAULT NULL,
  `nombre` varchar(200) NOT NULL DEFAULT '',
  `status` tinyint(3) NOT NULL DEFAULT '1',
  `dataset` text NOT NULL COMMENT 'Complementary Data',
  PRIMARY KEY (`persona_id`),
  UNIQUE KEY `username` (`username`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Usuarios del Sistema';

--
-- Volcar la base de datos para la tabla `fw_persona`
--

INSERT INTO `fw_persona` VALUES
(1, 'admin', '93cF0QBBwP.RQ', 'info@fractalserver.com', 'Administrator', 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fw_plantilla`
--

DROP TABLE IF EXISTS `fw_plantilla`;
CREATE TABLE IF NOT EXISTS `fw_plantilla` (
  `plantilla_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_padre` int(11) NOT NULL DEFAULT '0',
  `tipo` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `nombre` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `funcion` varchar(150) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `funcion_edicion` varchar(150) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `archivo` varchar(150) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `html` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `personalizable` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`plantilla_id`),
  KEY `plantilla_id_padre` (`id_padre`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Templates';

--
-- Volcar la base de datos para la tabla `fw_plantilla`
--

INSERT INTO `fw_plantilla` VALUES
(1, 0, 'Global', 'General', '', '', '', '', 1, 0),
(2, 1, 'Layout', 'Layout', 'tpl_layout_general', '', 'tpl_layout_general.html', '', 1, 0),
(3, 1, 'Contenido Principal', 'Contenido Principal', 'tpl_contenido_principal_general', 'tpl_editor_principal', 'tpl_contenido_principal_general.html', '', 1, 0),
(4, 1, 'Contenido Secundario', 'Lista Simple', 'tpl_contenido_secundario_general', 'tpl_editor_secundario', 'tpl_contenido_secundario_general.html', '', 1, 0),
(5, 1, 'Menu 1', 'Menu 1', 'tpl_menu1_general', '', 'tpl_menu1_general.html', '', 1, 0),
(6, 1, 'Pie', 'Footer', 'tpl_pie_general', '', 'tpl_pie_general.html', '', 1, 0),
(7, 1, 'Cabezote', 'Header', 'tpl_cabezote_general', '', 'tpl_cabezote_general.html', '', 1, 0),
(9, 1, 'Contenido Principal', 'Página de Inicio', 'tpl_contenido_principal_home', 'tpl_editor_principal_home', 'tpl_contenido_principal_home.html', '', 1, 0),
(10, 1, 'Contenido Principal', 'Incluir Aplicación', 'tpl_contenido_principal_include', 'tpl_editor_principal', 'tpl_contenido_principal_general.html', '', 1, 0),
(11, 1, 'Contenido Secundario', 'Lista con Resumen', 'tpl_contenido_secundario_resumen', 'tpl_editor_secundario', 'tpl_contenido_secundario_resumen.html', '', 1, 0),
(12, 1, 'Contenido Secundario', 'Galería de Imágenes', 'tpl_contenido_secundario_galeria', 'tpl_editor_secundario', 'tpl_contenido_secundario_galeria.html', '', 1, 0),
(13, 1, 'Contenido Principal', 'Producto', 'tpl_contenido_principal_producto', 'tpl_editor_producto', 'tpl_contenido_principal_producto.html', '', 0, 0),
(14, 1, 'Contenido Secundario', 'Catálogo de Productos', 'tpl_contenido_secundario_resumen', 'tpl_editor_secundario', 'tpl_contenido_secundario_resumen.html', '', 0, 0),
(15, 1, 'Contenido Principal', 'Oculto', 'tpl_null', 'tpl_editor_principal', '', '', 1, 0),
(16, 1, 'Contenido Secundario', 'Oculto', 'tpl_null', 'tpl_editor_secundario', '', '', 1, 0),
(17, 1, 'Contenido Principal', 'Cita Calendario', 'tpl_contenido_principal_cita_cal', 'tpl_editor_cita_cal', 'tpl_contenido_principal_cita_cal.html', '', 0, 0),
(18, 1, 'Contenido Secundario', 'Lista de Categorías', 'tpl_contenido_secundario_categorias', 'tpl_editor_secundario', 'tpl_contenido_secundario_categorias.html', '', 1, 0),
(19, 1, 'Contenido Principal', 'Item de la Galería', 'tpl_contenido_principal_item_galeria', 'tpl_editor_principal', 'tpl_contenido_principal_item_galeria.html', '', 1, 0),
(20, 1, 'Contenido Secundario', 'Comentarios', 'tpl_contenido_secundario_comentarios', 'tpl_editor_secundario', 'tpl_contenido_secundario_comentarios.html', '', 1, 0),
(21, 1, 'Contenido Secundario', 'Calendario de Eventos', 'tpl_contenido_secundario_calendario', 'tpl_editor_secundario', 'tpl_contenido_secundario_calendario.html', '', 1, 0),
(22, 1, 'Contenido Principal', 'Video YouTube', 'tpl_contenido_principal_video', 'tpl_editor_principal_video', 'tpl_contenido_principal_video.html', '', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fw_propiedad`
--

DROP TABLE IF EXISTS `fw_propiedad`;
CREATE TABLE IF NOT EXISTS `fw_propiedad` (
  `propiedad_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) DEFAULT NULL,
  `descripcion` text,
  `visible` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`propiedad_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Lista de Propiedades Aplicables a una Persona';

--
-- Volcar la base de datos para la tabla `fw_propiedad`
--

INSERT INTO `fw_propiedad` VALUES
(1, 'Administrador', 'Administrador Del Sitio', 1),
(2, 'Editor N1', 'Editor de Contenidos Nivel 1', 1),
(3, 'Sistema de Administración', 'Empleo del Sistema de Administración del Portal', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fw_propiedad_contenido`
--

DROP TABLE IF EXISTS `fw_propiedad_contenido`;
CREATE TABLE IF NOT EXISTS `fw_propiedad_contenido` (
  `propiedad_id` int(11) NOT NULL DEFAULT '0',
  `contenido_id` int(11) NOT NULL DEFAULT '0',
  `valor` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`propiedad_id`,`contenido_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Permisos de Visualizacion';

--
-- Volcar la base de datos para la tabla `fw_propiedad_contenido`
--

INSERT INTO `fw_propiedad_contenido` VALUES
(3, 4, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fw_propiedad_persona`
--

DROP TABLE IF EXISTS `fw_propiedad_persona`;
CREATE TABLE IF NOT EXISTS `fw_propiedad_persona` (
  `propiedad_id` int(11) NOT NULL DEFAULT '0',
  `persona_id` int(11) NOT NULL DEFAULT '0',
  `valor` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`propiedad_id`,`persona_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Grupos de usuarios';

--
-- Volcar la base de datos para la tabla `fw_propiedad_persona`
--

INSERT INTO `fw_propiedad_persona` VALUES
(3, 1, '0'),
(1, 1, '0'),
(2, 1, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fw_propiedad_persona_contenido`
--

DROP TABLE IF EXISTS `fw_propiedad_persona_contenido`;
CREATE TABLE IF NOT EXISTS `fw_propiedad_persona_contenido` (
  `propiedad_id` int(11) NOT NULL DEFAULT '0',
  `persona_id` int(11) NOT NULL DEFAULT '0',
  `contenido_id` int(11) NOT NULL DEFAULT '0',
  `valor` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`propiedad_id`,`persona_id`,`contenido_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Permisos de admin. y edicion';

--
-- Volcar la base de datos para la tabla `fw_propiedad_persona_contenido`
--

INSERT INTO `fw_propiedad_persona_contenido` VALUES
(2, 1, 1, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

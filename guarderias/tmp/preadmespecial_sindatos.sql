-- MySQL dump 10.13  Distrib 5.6.46, for Linux (x86_64)
--
-- Host: localhost    Database: preadmespecial
-- ------------------------------------------------------
-- Server version	5.6.46

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumnos` (
  `id_alumno` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `apellido1` varchar(50) NOT NULL DEFAULT 'nodata',
  `apellido2` varchar(50) NOT NULL DEFAULT 'nodata',
  `nombre` varchar(50) NOT NULL DEFAULT 'nodata',
  `dni_alumno` varchar(9) DEFAULT 'nodata',
  `nacionalidad` varchar(50) DEFAULT 'nodata',
  `fnac` date DEFAULT '2000-01-01',
  `num_hbaremo` int(2) NOT NULL DEFAULT '0',
  `num_hadmision` int(2) NOT NULL DEFAULT '0',
  `datos_tutor1` varchar(200) NOT NULL DEFAULT 'nodata',
  `datos_tutor2` varchar(200) DEFAULT 'nodata',
  `dni_tutor2` varchar(9) DEFAULT 'nodata',
  `dni_tutor1` varchar(9) NOT NULL DEFAULT 'nodata',
  `calle_dfamiliar` varchar(200) NOT NULL DEFAULT 'nodata',
  `num_dfamiliar` varchar(3) NOT NULL DEFAULT 'nda',
  `piso_dfamiliar` char(20) DEFAULT 'nodata',
  `loc_dfamiliar` char(50) NOT NULL DEFAULT 'nodata',
  `cp_dfamiliar` varchar(10) NOT NULL DEFAULT 'nodata',
  `tel_dfamiliar1` int(9) NOT NULL DEFAULT '0',
  `tel_dfamiliar2` int(9) DEFAULT '0',
  `nuevaesc` tinyint(1) NOT NULL DEFAULT '0',
  `id_centro_estudios_origen` int(11) NOT NULL DEFAULT '0',
  `loc_centro_origen` varchar(100) NOT NULL DEFAULT 'nodata',
  `modalidad_origen` varchar(100) NOT NULL DEFAULT 'nodata',
  `id_centro_destino` int(11) NOT NULL DEFAULT '0',
  `curso_solicitado` varchar(50) NOT NULL DEFAULT 'nodata',
  `loc_centro_destino` varchar(100) NOT NULL DEFAULT 'nodata',
  `modalidad_destino` varchar(100) NOT NULL DEFAULT 'nodata',
  `id_centro_destino1` int(11) DEFAULT NULL,
  `id_centro_destino2` int(11) DEFAULT NULL,
  `id_centro_destino3` int(11) DEFAULT NULL,
  `id_centro_destino4` int(11) DEFAULT NULL,
  `id_centro_destino5` int(11) DEFAULT NULL,
  `id_centro_destino6` int(11) DEFAULT NULL,
  `fotocopia_resolucion` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Fotocopia compulsada de la Resolución del Director del Servicio Provincial de Educación en la Modalidad de Educación Especial o Combinada.',
  `reserva` tinyint(4) DEFAULT '0',
  `prematuridad` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Resolución del Director del Servicio Provincial de Educación, Cultura y Deporte correspondiente, en caso de prematuridad. (Sólo para el acceso por primera vez a segundo ciclo de Educación Infantil)',
  `acred_dom_familiar` tinyint(1) NOT NULL DEFAULT '0',
  `cer_rec_discapacidad` tinyint(1) NOT NULL DEFAULT '0',
  `fam_numerosa` tinyint(1) NOT NULL DEFAULT '0',
  `acred_dom_laboral` tinyint(1) NOT NULL DEFAULT '0',
  `permiten_renta` tinyint(1) NOT NULL DEFAULT '0',
  `cumplen_resta` tinyint(1) NOT NULL DEFAULT '0',
  `fase_solicitud` enum('borrador','validada','baremada') DEFAULT 'borrador',
  `transporte` enum('1','2','3') DEFAULT '3',
  `nasignado` int(11) DEFAULT '0',
  `nordensorteo` int(11) DEFAULT '0',
  `estado_solicitud` enum('irregular','duplicada','apta') DEFAULT 'apta',
  `oponenautorizar` tinyint(4) DEFAULT '0',
  `cumplen` tinyint(4) DEFAULT '0',
  `tipoestudios` enum('ebo','tva') DEFAULT 'ebo',
  `est_desp_sorteo` enum('noadmitida','admitida','otro') DEFAULT 'otro',
  PRIMARY KEY (`id_alumno`),
  UNIQUE KEY `cp_alumnos` (`id_alumno`) USING BTREE,
  UNIQUE KEY `nombre_2` (`nombre`,`apellido1`,`fnac`,`dni_tutor1`),
  KEY `un_dni` (`dni_alumno`) USING BTREE,
  KEY `id_usuario` (`id_usuario`),
  KEY `id_centro_destino1` (`id_centro_destino1`),
  KEY `id_centro_destino2` (`id_centro_destino2`),
  KEY `id_centro_destino3` (`id_centro_destino3`),
  KEY `id_centro_destino4` (`id_centro_destino4`),
  KEY `id_centro_destino5` (`id_centro_destino5`),
  KEY `id_centro_destino6` (`id_centro_destino6`),
  KEY `id_centro_destino` (`id_centro_destino`),
  CONSTRAINT `alumnos_ibfk_7` FOREIGN KEY (`id_centro_destino5`) REFERENCES `centros` (`id_centro`),
  CONSTRAINT `alumnos_ibfk_8` FOREIGN KEY (`id_centro_destino6`) REFERENCES `centros` (`id_centro`)
) ENGINE=InnoDB AUTO_INCREMENT=8978 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `alumnos_definitiva_final`
--

DROP TABLE IF EXISTS `alumnos_definitiva_final`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumnos_definitiva_final` (
  `nombre` varchar(50) NOT NULL DEFAULT 'nodata',
  `apellido1` varchar(50) NOT NULL DEFAULT 'nodata',
  `apellido2` varchar(50) NOT NULL DEFAULT 'nodata',
  `tipoestudios` enum('ebo','tva') DEFAULT 'ebo',
  `fase_solicitud` enum('borrador','validada','baremada') DEFAULT 'borrador',
  `estado_solicitud` enum('irregular','duplicada','apta') DEFAULT 'apta',
  `transporte` enum('1','2','3') DEFAULT '3',
  `nordensorteo` int(11) DEFAULT '0',
  `nasignado` int(11) DEFAULT '0',
  `est_desp_sorteo` enum('noadmitida','admitida','otro') DEFAULT 'otro',
  `nombre_centro` varchar(100),
  `id_alumno` int(11),
  `hermanos_centro` tinyint(4) DEFAULT '0',
  `tutores_centro` tinyint(1) DEFAULT '0',
  `tipo_domicilio` enum('laboral','familiar') DEFAULT 'familiar',
  `renta_inferior` tinyint(4) DEFAULT '0',
  `discapacidad` enum('alumno','hpadres','no') DEFAULT 'no',
  `tipo_familia` enum('numerosa_especial','numerosa_general','monoparental_especial','monoparental_general','no') DEFAULT 'no',
  `monoparental` tinyint(4) DEFAULT '0',
  `zona_dfamiliar` enum('A','B','DESC') DEFAULT 'DESC',
  `zona_dtrabajo` enum('A','B','DESC') DEFAULT 'DESC',
  `zona_limitrofe` enum('SI','NO','DESC') DEFAULT 'DESC',
  `zona_trabajo_limitrofe` enum('SI','NO','DESC') DEFAULT 'DESC',
  `proximidad_domicilio` enum('dfamiliar','dlaboral','dflimitrofe','dllimitrofe','sindomicilio') DEFAULT 'sindomicilio',
  `validar_proximidad_domicilio` tinyint(1) DEFAULT '0',
  `validar_tutores_centro` tinyint(1) DEFAULT '0',
  `validar_renta_inferior` tinyint(1) DEFAULT '0',
  `validar_hnos_centro` tinyint(1) DEFAULT '0',
  `validar_discapacidad` tinyint(1) DEFAULT '0',
  `validar_tipo_familia` tinyint(1) DEFAULT '0',
  `calle_dlaboral` varchar(200) DEFAULT NULL COMMENT 'calle domicilio laboral',
  `puntos_validados` float DEFAULT NULL,
  `puntos_totales` float DEFAULT NULL,
  `calle_dllimitrofe` varchar(200) DEFAULT NULL,
  `id_centro_destino` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `alumnos_fase2`
--

DROP TABLE IF EXISTS `alumnos_fase2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumnos_fase2` (
  `id_alumno` int(11) NOT NULL DEFAULT '0',
  `nombre` varchar(50) NOT NULL DEFAULT 'nodata',
  `apellido1` varchar(50) NOT NULL DEFAULT 'nodata',
  `apellido2` varchar(50) NOT NULL DEFAULT 'nodata',
  `localidad` char(50) DEFAULT NULL,
  `calle_dfamiliar` varchar(200) NOT NULL DEFAULT 'nodata',
  `nombre_centro` varchar(100),
  `tipoestudios` enum('ebo','tva') DEFAULT 'ebo',
  `fase_solicitud` enum('borrador','validada','baremada') DEFAULT 'borrador',
  `estado_solicitud` enum('irregular','duplicada','apta') DEFAULT 'apta',
  `transporte` enum('1','2','3') DEFAULT '3',
  `nordensorteo` int(11) DEFAULT '0',
  `nasignado` int(11) DEFAULT '0',
  `puntos_validados` float DEFAULT NULL,
  `id_centro` int(11) NOT NULL DEFAULT '0',
  `centro1` varchar(100) NOT NULL,
  `id_centro1` int(11) DEFAULT '0',
  `centro2` varchar(100) DEFAULT NULL,
  `id_centro2` int(11) DEFAULT NULL,
  `centro3` varchar(100) DEFAULT NULL,
  `id_centro3` int(11) DEFAULT NULL,
  `centro4` varchar(100) DEFAULT NULL,
  `id_centro4` int(11) DEFAULT NULL,
  `centro5` varchar(100) DEFAULT NULL,
  `id_centro5` int(11) DEFAULT NULL,
  `centro6` varchar(100) DEFAULT NULL,
  `id_centro6` int(11) DEFAULT NULL,
  `centro_definitivo` varchar(100) DEFAULT 'nocentro',
  `id_centro_definitivo` int(11) DEFAULT NULL,
  `id_centro_origen` int(11) DEFAULT '0',
  `centro_origen` varchar(100) DEFAULT 'nocentro',
  `reserva` tinyint(4) DEFAULT '0',
  `reserva_original` tinyint(4) DEFAULT '0',
  `tipo_modificacion` enum('automatica','manual','nomodificada') DEFAULT 'nomodificada',
  `activo_fase3` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `alumnos_fase2_tmp`
--

DROP TABLE IF EXISTS `alumnos_fase2_tmp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumnos_fase2_tmp` (
  `id_alumno` int(11) NOT NULL DEFAULT '0',
  `nombre` varchar(50) NOT NULL DEFAULT 'nodata',
  `apellido1` varchar(50) NOT NULL DEFAULT 'nodata',
  `apellido2` varchar(50) NOT NULL DEFAULT 'nodata',
  `localidad` char(50) DEFAULT NULL,
  `calle_dfamiliar` varchar(200) NOT NULL DEFAULT 'nodata',
  `nombre_centro` varchar(100),
  `tipoestudios` enum('ebo','tva') DEFAULT 'ebo',
  `fase_solicitud` enum('borrador','validada','baremada') DEFAULT 'borrador',
  `estado_solicitud` enum('irregular','duplicada','apta') DEFAULT 'apta',
  `transporte` enum('1','2','3') DEFAULT '3',
  `nordensorteo` int(11) DEFAULT '0',
  `nasignado` int(11) DEFAULT '0',
  `puntos_validados` float DEFAULT NULL,
  `id_centro` int(11) NOT NULL DEFAULT '0',
  `centro1` varchar(100) NOT NULL,
  `id_centro1` int(11) DEFAULT '0',
  `centro2` varchar(100) DEFAULT NULL,
  `id_centro2` int(11) DEFAULT NULL,
  `centro3` varchar(100) DEFAULT NULL,
  `id_centro3` int(11) DEFAULT NULL,
  `centro4` varchar(100) DEFAULT NULL,
  `id_centro4` int(11) DEFAULT NULL,
  `centro5` varchar(100) DEFAULT NULL,
  `id_centro5` int(11) DEFAULT NULL,
  `centro6` varchar(100) DEFAULT NULL,
  `id_centro6` int(11) DEFAULT NULL,
  `centro_definitivo` varchar(100) DEFAULT 'nocentro',
  `id_centro_definitivo` int(11) DEFAULT NULL,
  `id_centro_origen` int(11) DEFAULT '0',
  `centro_origen` varchar(100) DEFAULT 'nocentro',
  `reserva` tinyint(4) DEFAULT '0',
  `reserva_original` tinyint(4) DEFAULT '0',
  `tipo_modificacion` enum('automatica','manual','nomodificada') DEFAULT 'nomodificada',
  `activo_fase3` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `alumnos_provisional_final`
--

DROP TABLE IF EXISTS `alumnos_provisional_final`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumnos_provisional_final` (
  `nombre` varchar(50) NOT NULL DEFAULT 'nodata',
  `apellido1` varchar(50) NOT NULL DEFAULT 'nodata',
  `apellido2` varchar(50) NOT NULL DEFAULT 'nodata',
  `tipoestudios` enum('ebo','tva') DEFAULT 'ebo',
  `fase_solicitud` enum('borrador','validada','baremada') DEFAULT 'borrador',
  `estado_solicitud` enum('irregular','duplicada','apta') DEFAULT 'apta',
  `transporte` enum('1','2','3') DEFAULT '3',
  `nordensorteo` int(11) DEFAULT '0',
  `nasignado` int(11) DEFAULT '0',
  `est_desp_sorteo` enum('noadmitida','admitida','otro') DEFAULT 'otro',
  `nombre_centro` varchar(100),
  `id_alumno` int(11),
  `hermanos_centro` tinyint(4) DEFAULT '0',
  `tutores_centro` tinyint(1) DEFAULT '0',
  `tipo_domicilio` enum('laboral','familiar') DEFAULT 'familiar',
  `renta_inferior` tinyint(4) DEFAULT '0',
  `discapacidad` enum('alumno','hpadres','no') DEFAULT 'no',
  `tipo_familia` enum('numerosa_especial','numerosa_general','monoparental_especial','monoparental_general','no') DEFAULT 'no',
  `monoparental` tinyint(4) DEFAULT '0',
  `zona_dfamiliar` enum('A','B','DESC') DEFAULT 'DESC',
  `zona_dtrabajo` enum('A','B','DESC') DEFAULT 'DESC',
  `zona_limitrofe` enum('SI','NO','DESC') DEFAULT 'DESC',
  `zona_trabajo_limitrofe` enum('SI','NO','DESC') DEFAULT 'DESC',
  `proximidad_domicilio` enum('dfamiliar','dlaboral','dflimitrofe','dllimitrofe','sindomicilio') DEFAULT 'sindomicilio',
  `validar_proximidad_domicilio` tinyint(1) DEFAULT '0',
  `validar_tutores_centro` tinyint(1) DEFAULT '0',
  `validar_renta_inferior` tinyint(1) DEFAULT '0',
  `validar_hnos_centro` tinyint(1) DEFAULT '0',
  `validar_discapacidad` tinyint(1) DEFAULT '0',
  `validar_tipo_familia` tinyint(1) DEFAULT '0',
  `calle_dlaboral` varchar(200) DEFAULT NULL COMMENT 'calle domicilio laboral',
  `puntos_validados` float DEFAULT NULL,
  `puntos_totales` float DEFAULT NULL,
  `calle_dllimitrofe` varchar(200) DEFAULT NULL,
  `id_centro_destino` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `baremo`
--

DROP TABLE IF EXISTS `baremo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `baremo` (
  `id_alumno` int(11) NOT NULL,
  `hermanos_centro` tinyint(4) NOT NULL DEFAULT '0',
  `tutores_centro` tinyint(1) NOT NULL DEFAULT '0',
  `tipo_domicilio` enum('laboral','familiar') NOT NULL DEFAULT 'familiar',
  `renta_inferior` tinyint(4) DEFAULT '0',
  `discapacidad` enum('alumno','hpadres','no') NOT NULL DEFAULT 'no',
  `tipo_familia` enum('numerosa_especial','numerosa_general','monoparental_especial','monoparental_general','no') NOT NULL DEFAULT 'no',
  `monoparental` tinyint(4) NOT NULL DEFAULT '0',
  `zona_dfamiliar` enum('A','B','DESC') NOT NULL DEFAULT 'DESC',
  `zona_dtrabajo` enum('A','B','DESC') NOT NULL DEFAULT 'DESC',
  `zona_limitrofe` enum('SI','NO','DESC') NOT NULL DEFAULT 'DESC',
  `zona_trabajo_limitrofe` enum('SI','NO','DESC') NOT NULL DEFAULT 'DESC',
  `proximidad_domicilio` enum('dfamiliar','dlaboral','dflimitrofe','dllimitrofe','sindomicilio') DEFAULT 'sindomicilio',
  `validar_proximidad_domicilio` tinyint(1) NOT NULL DEFAULT '0',
  `validar_tutores_centro` tinyint(1) NOT NULL DEFAULT '0',
  `validar_renta_inferior` tinyint(1) NOT NULL DEFAULT '0',
  `validar_hnos_centro` tinyint(1) DEFAULT '0',
  `validar_discapacidad` tinyint(1) NOT NULL DEFAULT '0',
  `validar_tipo_familia` tinyint(1) DEFAULT '0',
  `calle_dlaboral` varchar(200) DEFAULT NULL COMMENT 'calle domicilio laboral',
  `puntos_validados` float DEFAULT NULL,
  `puntos_totales` float DEFAULT NULL,
  `calle_dllimitrofe` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_alumno`),
  CONSTRAINT `baremo_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `centros`
--

DROP TABLE IF EXISTS `centros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `centros` (
  `id_usuario` int(11) NOT NULL,
  `localidad` varchar(100) NOT NULL,
  `provincia` varchar(20) NOT NULL,
  `nombre_centro` varchar(100) NOT NULL,
  `tipo_centro` enum('origen','destino','ambos') DEFAULT NULL,
  `id_centro` int(11) NOT NULL,
  `zona` enum('A','B','DESC') NOT NULL DEFAULT 'DESC',
  `vacantes_ebo` int(11) NOT NULL DEFAULT '0',
  `vacantes_ebo_original` int(11) DEFAULT '0',
  `vacantes_tva` int(11) NOT NULL DEFAULT '0',
  `vacantes_tva_original` int(11) DEFAULT '0',
  `num_sorteo` int(11) DEFAULT '0',
  `ndespuessorteo` int(11) DEFAULT '0',
  `tipoestudios` enum('ebo','tva') DEFAULT 'ebo',
  `solicitudes_ebo` int(11) DEFAULT '0',
  `solicitudes_tva` int(11) DEFAULT '0',
  `fase_sorteo` enum('0','1','2','3') DEFAULT '0',
  `primera_conexion` enum('si','no') DEFAULT 'si',
  `clase_centro` enum('especial','normal') DEFAULT 'normal',
  PRIMARY KEY (`id_centro`),
  UNIQUE KEY `codigo_centro` (`id_centro`),
  UNIQUE KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `centros_backup`
--

DROP TABLE IF EXISTS `centros_backup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `centros_backup` (
  `id_usuario` int(11) NOT NULL,
  `localidad` varchar(20) NOT NULL,
  `provincia` varchar(20) NOT NULL,
  `nombre_centro` varchar(100) NOT NULL,
  `tipo_centro` enum('origen','destino','ambos') DEFAULT NULL,
  `id_centro` int(11) NOT NULL,
  `zona` enum('A','B','DESC') NOT NULL DEFAULT 'DESC',
  `vacantes_ebo` int(11) NOT NULL DEFAULT '0',
  `vacantes_tva` int(11) NOT NULL DEFAULT '0',
  `num_sorteo` int(11) DEFAULT '0',
  `ndespuessorteo` int(11) DEFAULT '0',
  `tipoestudios` enum('ebo','tva') DEFAULT 'ebo',
  `solicitudes_ebo` int(11) DEFAULT '0',
  `solicitudes_tva` int(11) DEFAULT '0',
  `fase_sorteo` enum('0','1','2','3') DEFAULT '0',
  `primera_conexion` enum('si','no') DEFAULT 'si',
  `clase_centro` enum('especial','normal') DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `centros_grupos`
--

DROP TABLE IF EXISTS `centros_grupos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `centros_grupos` (
  `id_centro` int(11) NOT NULL,
  `tipo_alumno` enum('ebo','tva') NOT NULL,
  `num_grupos` int(11) DEFAULT NULL,
  `plazas` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_centro`,`tipo_alumno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `centros_tmp`
--

DROP TABLE IF EXISTS `centros_tmp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `centros_tmp` (
  `id_usuario` int(11) NOT NULL,
  `localidad` varchar(20) NOT NULL,
  `provincia` varchar(20) NOT NULL,
  `nombre_centro` varchar(100) NOT NULL,
  `tipo_centro` enum('origen','destino','ambos') DEFAULT NULL,
  `id_centro` int(11) NOT NULL,
  `zona` enum('A','B','DESC') NOT NULL DEFAULT 'DESC',
  `vacantes_ebo` int(11) NOT NULL DEFAULT '0',
  `vacantes_ebo_original` int(11) DEFAULT '0',
  `vacantes_tva` int(11) NOT NULL DEFAULT '0',
  `vacantes_tva_original` int(11) DEFAULT '0',
  `num_sorteo` int(11) DEFAULT '0',
  `ndespuessorteo` int(11) DEFAULT '0',
  `tipoestudios` enum('ebo','tva') DEFAULT 'ebo',
  `solicitudes_ebo` int(11) DEFAULT '0',
  `solicitudes_tva` int(11) DEFAULT '0',
  `fase_sorteo` enum('0','1','2','3') DEFAULT '0',
  `primera_conexion` enum('si','no') DEFAULT 'si',
  `clase_centro` enum('especial','normal') DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hermanos`
--

DROP TABLE IF EXISTS `hermanos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hermanos` (
  `id_registro` int(11) NOT NULL AUTO_INCREMENT,
  `id_alumno` int(11) NOT NULL,
  `datos` varchar(100) DEFAULT 'nodata',
  `fnacimiento` date DEFAULT '2000-01-01',
  `curso` varchar(100) DEFAULT 'nodata' COMMENT '''curso solicitado'' para el caso de hermanos q participan y ''curso actual'' a efectos de baremo',
  `nivel_educativo` varchar(9) DEFAULT NULL,
  `tipo` enum('admision','baremo') DEFAULT 'baremo',
  PRIMARY KEY (`id_registro`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `matricula`
--

DROP TABLE IF EXISTS `matricula`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matricula` (
  `id_alumno` int(11) NOT NULL AUTO_INCREMENT,
  `curso` varchar(50) NOT NULL,
  `provincia` varchar(50) NOT NULL,
  `ensenanza` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `fnac` date NOT NULL,
  `tipo_centro` varchar(100) NOT NULL,
  `nombre_centro` varchar(100) NOT NULL,
  `tipo_alumno_futuro` enum('tva','ebo','out') NOT NULL,
  `tipo_alumno_actual` enum('ebo','tva') NOT NULL,
  `estado` enum('continua','cambia a ebo','cambia a tva','no continua') DEFAULT 'continua',
  `id_centro` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_alumno`),
  UNIQUE KEY `cp_matricula` (`id_alumno`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=44617 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `renta`
--

DROP TABLE IF EXISTS `renta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `renta` (
  `id_renta` int(11) NOT NULL AUTO_INCREMENT,
  `id_alumno` int(11) NOT NULL,
  `datos` varchar(100) NOT NULL,
  `parentesco` enum('padre','madre') NOT NULL,
  `dni` varchar(9) NOT NULL,
  UNIQUE KEY `cp_renta` (`id_renta`) USING BTREE,
  UNIQUE KEY `un_renta` (`datos`,`parentesco`,`dni`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sorteo`
--

DROP TABLE IF EXISTS `sorteo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sorteo` (
  `id_alumno` int(11) NOT NULL,
  `trans_cole` enum('1','2','3','4') NOT NULL COMMENT '4.transporte sin cole- 3. transporte con cole- 2.no cole''- 1. cole',
  `numero_sorteo` int(11) NOT NULL,
  PRIMARY KEY (`id_alumno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tributantes`
--

DROP TABLE IF EXISTS `tributantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tributantes` (
  `id_alumno` int(11) DEFAULT NULL,
  `id_tributante` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(20) NOT NULL,
  `apellido1` char(20) NOT NULL,
  `apellido2` char(20) DEFAULT NULL,
  `parentesco` char(50) DEFAULT NULL,
  `dni` char(9) DEFAULT NULL,
  PRIMARY KEY (`id_tributante`),
  KEY `id_alumno` (`id_alumno`),
  CONSTRAINT `tributantes_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(500) NOT NULL,
  `rol` enum('alumno','centro','spzaragoza','sphuesca','spteruel','admin') DEFAULT 'alumno',
  `clave` varchar(200) NOT NULL,
  `clave_original` int(4) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `cp_usuarios` (`id_usuario`) USING BTREE,
  UNIQUE KEY `nombre_usuario` (`nombre_usuario`,`clave`),
  UNIQUE KEY `nombre_usuario_2` (`nombre_usuario`,`clave_original`)
) ENGINE=InnoDB AUTO_INCREMENT=60020958 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-06 11:19:08

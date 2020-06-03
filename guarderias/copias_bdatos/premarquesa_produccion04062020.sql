-- MySQL dump 10.13  Distrib 5.6.46, for Linux (x86_64)
--
-- Host: localhost    Database: premarquesa_produccion
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
  `email` varchar(50) DEFAULT 'nodata',
  `nuevaesc` tinyint(1) NOT NULL DEFAULT '0',
  `id_centro_estudios_origen` int(11) NOT NULL DEFAULT '0',
  `loc_centro_origen` varchar(100) NOT NULL DEFAULT 'nodata',
  `modalidad_origen` varchar(100) NOT NULL DEFAULT 'nodata',
  `id_centro_destino` int(11) NOT NULL DEFAULT '0',
  `curso_solicitado` varchar(50) NOT NULL DEFAULT 'nodata',
  `loc_centro_destino` varchar(100) NOT NULL DEFAULT 'nodata',
  `prov_centro_destino` enum('zaragoza','huesca','teruel') DEFAULT 'zaragoza',
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
  `transporte` enum('1','2','3') DEFAULT '1',
  `nasignado` int(11) DEFAULT '0',
  `nordensorteo` int(11) DEFAULT '0',
  `estado_solicitud` enum('irregular','duplicada','apta') DEFAULT 'apta',
  `oponenautorizar` tinyint(4) DEFAULT '0',
  `cumplen` tinyint(4) DEFAULT '0',
  `tipoestudios` enum('2020','2019','2018') DEFAULT '2020',
  `est_desp_sorteo` enum('noadmitida','admitida','otro') DEFAULT 'otro',
  `sol_plaza` tinyint(4) DEFAULT '0',
  `sol_vacantes` tinyint(4) DEFAULT '0',
  `hore` enum('7:45','8:30','9:00','9:30') DEFAULT '7:45',
  `hors` enum('13:00','16:00','17:00') DEFAULT '17:00',
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
) ENGINE=InnoDB AUTO_INCREMENT=9051 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumnos`
--

LOCK TABLES `alumnos` WRITE;
/*!40000 ALTER TABLE `alumnos` DISABLE KEYS */;
INSERT INTO `alumnos` VALUES (9049,60021068,'pa01','nodata','n01','67510723L','nodata','2018-04-01',0,0,'nt01','nodata','nodata','67510723L','nodata','nda','nodata','nodata','nodata',0,0,'a@a.com',0,0,'nodata','nodata',1,'nodata','nodata','zaragoza','nodata',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,0,0,0,0,0,'borrador','1',0,0,'apta',0,0,'2019','otro',1,0,'7:45','16:00'),(9050,60021072,'paaa','nodata','nq1','05752543J','nodata','2019-05-03',0,0,'nt22','nodata','nodata','05752543J','nodata','nda','nodata','nodata','nodata',0,0,'a@a.com',0,0,'nodata','nodata',1,'nodata','nodata','zaragoza','nodata',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,0,0,0,0,0,'borrador','1',0,0,'apta',0,0,'2020','otro',0,1,'7:45','16:00');
/*!40000 ALTER TABLE `alumnos` ENABLE KEYS */;
UNLOCK TABLES;

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
  `nombre_centro` varchar(100) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL,
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
-- Dumping data for table `alumnos_definitiva_final`
--

LOCK TABLES `alumnos_definitiva_final` WRITE;
/*!40000 ALTER TABLE `alumnos_definitiva_final` DISABLE KEYS */;
/*!40000 ALTER TABLE `alumnos_definitiva_final` ENABLE KEYS */;
UNLOCK TABLES;

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
  `coordenadas` char(100) DEFAULT NULL,
  `nombre_centro` varchar(100) DEFAULT NULL,
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
-- Dumping data for table `alumnos_fase2`
--

LOCK TABLES `alumnos_fase2` WRITE;
/*!40000 ALTER TABLE `alumnos_fase2` DISABLE KEYS */;
/*!40000 ALTER TABLE `alumnos_fase2` ENABLE KEYS */;
UNLOCK TABLES;

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
  `nombre_centro` varchar(100) DEFAULT NULL,
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
-- Dumping data for table `alumnos_fase2_tmp`
--

LOCK TABLES `alumnos_fase2_tmp` WRITE;
/*!40000 ALTER TABLE `alumnos_fase2_tmp` DISABLE KEYS */;
/*!40000 ALTER TABLE `alumnos_fase2_tmp` ENABLE KEYS */;
UNLOCK TABLES;

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
  `tipoestudios` enum('2020','2019','2018') DEFAULT '2020',
  `fase_solicitud` enum('borrador','validada','baremada') DEFAULT 'borrador',
  `estado_solicitud` enum('irregular','duplicada','apta') DEFAULT 'apta',
  `transporte` enum('1','2','3') DEFAULT '1',
  `nordensorteo` int(11) DEFAULT '0',
  `nasignado` int(11) DEFAULT '0',
  `est_desp_sorteo` enum('noadmitida','admitida','otro') DEFAULT 'otro',
  `nombre_centro` varchar(100) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `hermanos_centro` tinyint(4) DEFAULT '0',
  `tutores_centro` tinyint(1) DEFAULT '0',
  `tipo_domicilio` enum('laboral','familiar') DEFAULT 'familiar',
  `renta_inferior` tinyint(4) DEFAULT '0',
  `iprem` enum('mayor','menor','no') DEFAULT 'no',
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
  `sitlaboral` tinyint(4) DEFAULT '0',
  `validar_sitlaboral` tinyint(1) DEFAULT '0',
  `id_centro_destino` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumnos_provisional_final`
--

LOCK TABLES `alumnos_provisional_final` WRITE;
/*!40000 ALTER TABLE `alumnos_provisional_final` DISABLE KEYS */;
/*!40000 ALTER TABLE `alumnos_provisional_final` ENABLE KEYS */;
UNLOCK TABLES;

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
  `iprem` enum('mayor','menor','no') DEFAULT 'no',
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
  `sitlaboral` tinyint(4) DEFAULT '0',
  `validar_sitlaboral` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_alumno`),
  CONSTRAINT `baremo_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `baremo`
--

LOCK TABLES `baremo` WRITE;
/*!40000 ALTER TABLE `baremo` DISABLE KEYS */;
INSERT INTO `baremo` VALUES (9049,0,0,'familiar',0,'no','no','no',0,'DESC','DESC','DESC','DESC','sindomicilio',0,0,0,0,0,0,NULL,0,0,NULL,0,0),(9050,0,0,'familiar',0,'no','no','no',0,'DESC','DESC','DESC','DESC','sindomicilio',0,0,0,0,0,0,NULL,0,0,NULL,0,0);
/*!40000 ALTER TABLE `baremo` ENABLE KEYS */;
UNLOCK TABLES;

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
  `coordenadas` char(100) DEFAULT 'nodata',
  `direccion` char(100) DEFAULT 'nodata',
  `nombre_centro` varchar(100) NOT NULL,
  `tipo_centro` enum('origen','destino','ambos') DEFAULT NULL,
  `id_centro` int(11) NOT NULL,
  `zona` enum('A','B','DESC') NOT NULL DEFAULT 'DESC',
  `vuno` int(11) DEFAULT '0',
  `vuno_original` int(11) DEFAULT '0',
  `vdos` int(11) DEFAULT '0',
  `vdos_original` int(11) DEFAULT '0',
  `vtres` int(11) DEFAULT '0',
  `vtres_original` int(11) DEFAULT '0',
  `num_sorteo` int(11) DEFAULT '0',
  `ndespuessorteo` int(11) DEFAULT '0',
  `tipoestudios` enum('ebo','tva') DEFAULT 'ebo',
  `fase_sorteo` enum('0','1','2','3') DEFAULT '0',
  `primera_conexion` enum('si','no') DEFAULT 'si',
  `num_sorteo_fase2` int(11) DEFAULT '0',
  `asignado_num_fase2` int(11) DEFAULT '0',
  PRIMARY KEY (`id_centro`),
  UNIQUE KEY `codigo_centro` (`id_centro`),
  UNIQUE KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `centros`
--

LOCK TABLES `centros` WRITE;
/*!40000 ALTER TABLE `centros` DISABLE KEYS */;
INSERT INTO `centros` VALUES (50032903,'locspteruel','provspteruel','nodata','nodata','censpteruel',NULL,-3,'DESC',0,0,0,0,0,0,0,0,'ebo','0','si',0,0),(50032902,'locsphuesca','provsphuesca','nodata','nodata','censphuesca',NULL,-2,'DESC',0,0,0,0,0,0,0,0,'ebo','0','si',0,0),(50032901,'locspzaragoza','provspzaragoza','nodata','nodata','cenadmin',NULL,-1,'DESC',0,0,0,0,0,0,0,0,'ebo','0','si',0,0),(50019810,'locadmin','provadmin','nodata','nodata','cenadmin',NULL,1,'DESC',0,0,0,0,0,0,0,0,'ebo','0','si',0,0),(22600060,'Barbastro','huesca','42.0331735:0.1352504','CL. Miguel Fleta, 3','LA PAZ',NULL,22600060,'DESC',7,7,36,36,54,54,0,0,'ebo','0','no',0,0),(22600072,'Huesca','huesca','42.1333411:-0.4025878','CL. Ramón J. Sender nº 19','NUESTRA SEÑORA DE SAN LORENZO',NULL,22600072,'DESC',7,7,24,24,54,54,0,0,'ebo','0','no',0,0),(22600084,'Monzón','huesca','41.9063324:0.1861263','Avda. del Pueyo, 78','NUESTRA SEÑORA DE LA ALEGRÍA',NULL,22600084,'DESC',7,7,23,23,36,36,0,0,'ebo','0','si',0,0),(44600021,'Alcañiz','teruel','41.0470808:-0.1295485','Avda. Aragón, s/n','SANTO ÁNGEL CUSTODIO',NULL,44600021,'DESC',14,14,24,24,54,54,0,0,'ebo','0','no',0,0),(50600105,'Calatayud','zaragoza','41.3514525:-1.6459713','CL. Ramón y Cajal, s/n','NUESTRA SEÑORA DEL CARMEN',NULL,50600105,'DESC',0,0,42,42,66,66,0,0,'ebo','0','si',0,0),(50600117,'Ejea de los Caballeros','zaragoza','42.1184092:-1.1381542','CL. Tauste, 28','VIRGEN DE LA OLIVA',NULL,50600117,'DESC',7,7,24,24,36,36,0,0,'ebo','0','si',0,0),(50600129,'Gallur','zaragoza','41.8683563:-1.3142354','CL. Colón, 4','SAN ANTONIO DE PADUA',NULL,50600129,'DESC',0,0,12,12,18,18,0,0,'ebo','0','si',0,0),(50600130,'Zaragoza','zaragoza','41.6250332:-0.8806351','CL. Pablo Parellada, 46','ARAGÓN',NULL,50600130,'DESC',14,14,24,24,36,36,0,0,'ebo','0','no',0,0),(50600142,'Zaragoza','zaragoza','41.6449649:-0.9281999','Avda. Manuel Rodríguez Ayuso 45','INMACULADA CONCEPCIÓN',NULL,50600142,'DESC',7,7,22,22,72,72,0,0,'ebo','0','si',0,0),(50600154,'Zaragoza','zaragoza','41.65417:-0.916355','CL. Ramiro I de Aragón, s/n','MONSALUD',NULL,50600154,'DESC',7,7,24,24,72,72,0,0,'ebo','0','no',0,0),(50600166,'Zaragoza','zaragoza','41.6373675:-0.8775779','CL. José Pellicer, 2','SANTA MARÍA DEL PILAR',NULL,50600166,'DESC',0,0,36,36,54,54,0,0,'ebo','0','no',0,0);
/*!40000 ALTER TABLE `centros` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `centros_backup`
--

LOCK TABLES `centros_backup` WRITE;
/*!40000 ALTER TABLE `centros_backup` DISABLE KEYS */;
/*!40000 ALTER TABLE `centros_backup` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `centros_grupos`
--

LOCK TABLES `centros_grupos` WRITE;
/*!40000 ALTER TABLE `centros_grupos` DISABLE KEYS */;
INSERT INTO `centros_grupos` VALUES (22002338,'ebo',2,12),(22002338,'tva',0,0),(22002511,'ebo',1,6),(22002511,'tva',1,12),(22003835,'ebo',2,12),(22003835,'tva',0,0),(22004891,'ebo',1,6),(22004891,'tva',1,12),(22005157,'ebo',11,66),(22005157,'tva',1,12),(22010001,'ebo',7,42),(22010001,'tva',1,12),(44003259,'ebo',9,54),(44003259,'tva',1,12),(44004148,'ebo',8,48),(44004148,'tva',2,24),(50000850,'ebo',1,6),(50000850,'tva',0,0),(50004612,'ebo',1,6),(50004612,'tva',0,0),(50006049,'ebo',2,12),(50006049,'tva',0,0),(50006128,'ebo',2,12),(50006128,'tva',0,0),(50007376,'ebo',16,96),(50007376,'tva',0,0),(50007674,'ebo',18,108),(50007674,'tva',3,36),(50008630,'ebo',6,36),(50008630,'tva',1,12),(50008678,'ebo',2,12),(50008678,'tva',0,0),(50008915,'ebo',4,24),(50008915,'tva',0,0),(50009488,'ebo',5,30),(50009488,'tva',1,12),(50009646,'ebo',7,42),(50009646,'tva',0,0),(50010387,'ebo',13,78),(50010387,'tva',2,24),(50011537,'ebo',8,48),(50011537,'tva',2,24),(50017369,'ebo',7,42),(50017369,'tva',1,12),(50018131,'ebo',14,84),(50018131,'tva',1,12),(50019408,'ebo',5,30),(50019408,'tva',1,12);
/*!40000 ALTER TABLE `centros_grupos` ENABLE KEYS */;
UNLOCK TABLES;

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
  `clase_centro` enum('especial','normal') DEFAULT 'normal',
  `coordenadas` char(100) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `centros_tmp`
--

LOCK TABLES `centros_tmp` WRITE;
/*!40000 ALTER TABLE `centros_tmp` DISABLE KEYS */;
/*!40000 ALTER TABLE `centros_tmp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `distancias`
--

DROP TABLE IF EXISTS `distancias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `distancias` (
  `id_alumno` int(11) NOT NULL DEFAULT '0',
  `id_centro` int(11) NOT NULL DEFAULT '0',
  `dlineal` float DEFAULT '0',
  `ddriving` float DEFAULT '0',
  `tdriving` char(50) DEFAULT 'nodata',
  `dwalking` float DEFAULT '0',
  `twalking` char(50) DEFAULT 'nodata',
  `dbicycling` float DEFAULT '0',
  `tbicycling` char(50) DEFAULT 'nodata',
  `dtransit` float DEFAULT '0',
  `ttransit` char(50) DEFAULT 'nodata',
  PRIMARY KEY (`id_alumno`,`id_centro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distancias`
--

LOCK TABLES `distancias` WRITE;
/*!40000 ALTER TABLE `distancias` DISABLE KEYS */;
INSERT INTO `distancias` VALUES (3,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(3,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(3,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(3,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(23,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(23,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(23,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(23,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,''),(33,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(33,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(33,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(33,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,''),(37,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(37,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(37,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(56,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(56,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(56,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(56,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(62,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(62,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(62,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(62,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(68,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(68,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(68,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(68,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(76,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(76,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(76,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(76,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,''),(81,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(81,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(81,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(81,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,''),(99,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(99,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(99,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(99,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(102,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(102,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(102,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(102,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(109,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(109,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(109,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(109,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,''),(111,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(111,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(111,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(111,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(143,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(143,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(143,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(143,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(145,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(145,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(145,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(148,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(148,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(148,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(148,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,''),(154,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(154,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(154,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(189,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(189,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(189,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(189,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(203,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(203,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(203,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(203,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,''),(213,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(213,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(213,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(213,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(220,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(220,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(220,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(220,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,''),(221,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(221,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(221,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(221,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(232,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(232,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(232,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(232,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(243,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(243,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(243,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(243,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,''),(248,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(248,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(248,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(248,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(267,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(267,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(267,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(275,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(275,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(275,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(275,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(277,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(277,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(277,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(283,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(283,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(283,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(283,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,''),(295,22002338,0,76,'15 horas 25 mins',84.32,'59 mins',79.2,'3 horas 52 mins',86.08,'1 hour 51 mins'),(295,22002511,0,71.36,'14 horas 24 mins',77.6,'51 mins',73.12,'3 horas 33 mins',86.88,'6 horas 1 min'),(295,22003835,0,143.2,'1 day 5 horas',130.56,'1 hour 28 mins',126.24,'6 horas 42 mins',184,'3 horas 23 mins'),(295,22004891,0,140.64,'1 day 4 horas',128,'1 hour 23 mins',123.68,'6 horas 36 mins',0,'nodata'),(317,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(317,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(317,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(317,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(335,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(335,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(335,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(335,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(347,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(347,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(347,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(347,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(348,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(348,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(348,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(348,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(360,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(360,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(360,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(360,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(368,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(368,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(368,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(368,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(379,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(379,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(379,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(379,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(383,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(383,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(383,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(383,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(387,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(387,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(387,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(387,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(388,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(388,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(388,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(393,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(393,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(393,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(393,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(405,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(405,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(405,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(405,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(407,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(407,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(407,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(407,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(410,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(410,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(410,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(410,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(420,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(420,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(420,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(420,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(430,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(430,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(430,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(430,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(434,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(434,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(434,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(434,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(439,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(439,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(439,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(439,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,''),(441,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(441,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(441,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(441,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(445,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(445,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(445,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(449,22002338,0,76,'15 horas 25 mins',84.32,'59 mins',79.2,'3 horas 52 mins',86.08,'1 hour 51 mins'),(449,22002511,0,71.36,'14 horas 24 mins',77.6,'51 mins',73.12,'3 horas 33 mins',86.88,'6 horas 1 min'),(449,22003835,0,143.2,'1 day 5 horas',130.56,'1 hour 28 mins',126.24,'6 horas 42 mins',184,'3 horas 23 mins'),(449,22004891,0,140.64,'1 day 4 horas',128,'1 hour 23 mins',123.68,'6 horas 36 mins',0,'nodata'),(458,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(458,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(458,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(458,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(461,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(461,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(461,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(461,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(466,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(466,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(466,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(466,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(471,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(471,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(471,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(471,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(475,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(475,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(475,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(475,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,''),(481,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(481,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(481,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(481,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(485,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(485,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(485,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(485,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(498,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(498,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(498,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(498,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(501,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(501,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(501,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(501,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,''),(507,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(507,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(507,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(507,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(508,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(508,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(508,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(508,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(525,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(525,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(525,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(525,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,''),(531,22002338,0,76,'15 horas 25 mins',84.32,'59 mins',79.2,'3 horas 52 mins',86.08,'1 hour 51 mins'),(531,22002511,0,71.36,'14 horas 24 mins',77.6,'51 mins',73.12,'3 horas 33 mins',86.88,'6 horas 1 min'),(531,22003835,0,143.2,'1 day 5 horas',130.56,'1 hour 28 mins',126.24,'6 horas 42 mins',184,'3 horas 23 mins'),(532,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(532,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(532,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(532,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(536,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(536,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(536,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(536,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(554,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(554,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(554,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(554,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(559,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(559,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(559,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(559,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(565,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(565,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(565,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(586,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(586,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(586,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(586,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(589,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(589,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(589,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(594,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(594,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(594,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(594,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(598,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(598,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(598,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(598,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,''),(610,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(610,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(610,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(610,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(612,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(612,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(612,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(612,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(621,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(621,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(621,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(621,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,''),(631,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(631,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(631,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(631,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(649,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(649,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(649,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(649,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(654,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(654,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(654,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(654,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,''),(655,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(655,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(655,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(655,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(657,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(657,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(657,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(657,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(665,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(665,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(665,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(673,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(673,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(673,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(673,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,''),(681,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(681,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(681,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(681,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(690,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(690,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(690,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(690,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(702,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(702,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(702,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(702,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(713,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(713,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(713,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(713,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(716,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(716,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(716,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(716,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(726,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(726,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(726,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(726,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,''),(731,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(731,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(731,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(731,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(737,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(737,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(737,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(737,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(738,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(738,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(738,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(738,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(740,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(740,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(740,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(740,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(747,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(747,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(747,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(747,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(749,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(749,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(749,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(749,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(755,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(755,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(755,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(755,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(760,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(760,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(760,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(760,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(761,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(761,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(761,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(761,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(767,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(767,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(767,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(767,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,''),(769,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(769,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(769,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(769,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(789,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(789,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(789,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(789,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(800,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(800,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(800,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(800,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(802,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(802,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(802,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(805,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(805,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(805,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(805,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(828,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(828,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(828,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(828,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(838,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(838,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(838,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(838,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(842,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(842,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(842,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(852,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(852,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(852,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(852,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(854,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(854,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(854,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(854,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(858,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(858,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(858,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(858,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(865,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(865,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(865,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(865,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(896,22002338,0,76,'15 horas 25 mins',84.32,'59 mins',79.2,'3 horas 52 mins',86.08,'1 hour 51 mins'),(896,22002511,0,71.36,'14 horas 24 mins',77.6,'51 mins',73.12,'3 horas 33 mins',86.88,'6 horas 1 min'),(896,22003835,0,143.2,'1 day 5 horas',130.56,'1 hour 28 mins',126.24,'6 horas 42 mins',184,'3 horas 23 mins'),(900,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(900,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(900,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(900,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(904,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(904,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(904,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(904,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,''),(906,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(906,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(906,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(906,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(911,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(911,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(911,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(919,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(919,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(919,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(919,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,''),(920,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(920,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(920,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(920,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(926,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(926,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(926,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(926,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(947,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(947,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(947,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(947,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(950,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(950,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(950,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(955,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(955,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(955,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(955,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(963,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(963,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(963,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(967,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(967,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(967,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(967,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(969,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(969,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(969,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(969,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(978,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(978,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(978,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(978,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(990,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(990,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(990,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(990,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(996,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(996,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(996,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(996,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(8931,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(8931,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(8931,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(8937,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(8937,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(8937,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(8937,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(8941,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(8941,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(8941,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(8941,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(8942,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(8942,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(8942,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(8942,22004891,0,139.52,'1 day 4 horas',125.92,'1 hour 22 mins',122.88,'6 horas 32 mins',0,'nodata'),(8943,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(8943,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(8943,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(8961,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(8961,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(8961,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(8963,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(8963,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(8963,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(8965,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(8965,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(8965,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins'),(8979,22002338,0,75.04,'15 horas 10 mins',82.4,'58 mins',78.4,'3 horas 48 mins',85.44,'1 hour 43 mins'),(8979,22002511,0,70.24,'14 horas 9 mins',75.68,'50 mins',72.32,'3 horas 29 mins',86.24,'5 horas 53 mins'),(8979,22003835,0,142.08,'1 day 5 horas',128.48,'1 hour 27 mins',125.44,'6 horas 39 mins',182.4,'3 horas 15 mins');
/*!40000 ALTER TABLE `distancias` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hermanos`
--

LOCK TABLES `hermanos` WRITE;
/*!40000 ALTER TABLE `hermanos` DISABLE KEYS */;
/*!40000 ALTER TABLE `hermanos` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=44618 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matricula`
--

LOCK TABLES `matricula` WRITE;
/*!40000 ALTER TABLE `matricula` DISABLE KEYS */;
/*!40000 ALTER TABLE `matricula` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `renta`
--

LOCK TABLES `renta` WRITE;
/*!40000 ALTER TABLE `renta` DISABLE KEYS */;
/*!40000 ALTER TABLE `renta` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `sorteo`
--

LOCK TABLES `sorteo` WRITE;
/*!40000 ALTER TABLE `sorteo` DISABLE KEYS */;
/*!40000 ALTER TABLE `sorteo` ENABLE KEYS */;
UNLOCK TABLES;

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
  `apellido1` char(20) DEFAULT 'nodata',
  `apellido2` char(20) DEFAULT NULL,
  `parentesco` char(50) DEFAULT NULL,
  `dni` char(9) DEFAULT NULL,
  PRIMARY KEY (`id_tributante`),
  KEY `id_alumno` (`id_alumno`),
  CONSTRAINT `tributantes_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tributantes`
--

LOCK TABLES `tributantes` WRITE;
/*!40000 ALTER TABLE `tributantes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tributantes` ENABLE KEYS */;
UNLOCK TABLES;

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
  `clave_original` char(50) DEFAULT 'nodata',
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `cp_usuarios` (`id_usuario`) USING BTREE,
  UNIQUE KEY `nombre_usuario` (`nombre_usuario`,`clave`),
  UNIQUE KEY `nombre_usuario_2` (`nombre_usuario`,`clave_original`)
) ENGINE=InnoDB AUTO_INCREMENT=60021073 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (22600060,'22600060','centro','27c078462edb346899e0aa7c512cf6d0','22600060'),(22600072,'22600072','centro','5612b0e9eb31b0682ed9dd5fd3e7083f','22600072'),(22600084,'22600084','centro','9ae8b0d638f62ee0581e01475519b324','22600084'),(44600021,'44600021','centro','7c2caaf92803ed9b140dfab085f0b8d7','44600021'),(50019810,'admin','admin','90a6027bb514f405bfca7ca143a59047',NULL),(50032901,'spzaragoza','spzaragoza','2f65e33a5b0b910b76f2de35cf365057','0'),(50032902,'sphuesca','sphuesca','74e56059e1f7632778c0383788441858','0'),(50032903,'spteruel','spteruel','3aea677510a5cc31b9bc01b67e5499cf','0'),(50600105,'50600105','centro','f71262c877c7ab0442bf98022d18ae28','50600105'),(50600117,'50600117','centro','41259732770cfa386b03c2795869467b','50600117'),(50600129,'50600129','centro','cc29de266f259e0e171f76107b2e3d17','50600129'),(50600130,'50600130','centro','250fc601904feeb66d249e5838396b44','aragon'),(50600142,'50600142','centro','ac0621f9c92eb0b213cfe9478ac44ef2','50600142'),(50600154,'50600154','centro','cf0f5ef85de1922d964ca19d4f4b09ca','50600154'),(50600166,'50600166','centro','e2685e33cdbc83d0c5f05f3be56c6c10','50600166'),(60021068,'14577727M','alumno','9fd98f856d3ca2086168f264a117ed7c','4707'),(60021069,'05752543J','alumno','454cecc4829279e64d624cd8a8c9ddf1','7724'),(60021070,'05752543J','alumno','767c23430487b6c64d45b83d5d32e9a1','7647'),(60021071,'05752543J','alumno','debe236f3c30658190a8fe363a2b5cc0','8151'),(60021072,'05752543J','alumno','ae3f4c649fb55c2ee3ef4d1abdb79ce5','7849');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-04  1:49:35

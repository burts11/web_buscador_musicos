-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: proyecto
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.28-MariaDB

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
-- Table structure for table `concierto`
--

DROP TABLE IF EXISTS `concierto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `concierto` (
  `idconcierto` int(11) NOT NULL,
  `idlocal` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` datetime NOT NULL,
  `genero` varchar(50) NOT NULL,
  `valoreconomico` int(20) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `conciertocol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idconcierto`),
  KEY `idlocal` (`idlocal`),
  CONSTRAINT `concierto_ibfk_1` FOREIGN KEY (`idlocal`) REFERENCES `local` (`idlocal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `concierto`
--

LOCK TABLES `concierto` WRITE;
/*!40000 ALTER TABLE `concierto` DISABLE KEYS */;
/*!40000 ALTER TABLE `concierto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fan`
--

DROP TABLE IF EXISTS `fan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fan` (
  `idfan` int(11) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `telefono` int(9) NOT NULL,
  `direccion` varchar(40) NOT NULL,
  `imagen` longtext NOT NULL,
  PRIMARY KEY (`idfan`),
  CONSTRAINT `fan_ibfk_1` FOREIGN KEY (`idfan`) REFERENCES `usuario` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fan`
--

LOCK TABLES `fan` WRITE;
/*!40000 ALTER TABLE `fan` DISABLE KEYS */;
INSERT INTO `fan` VALUES (3,'fam',666,'555','sss');
/*!40000 ALTER TABLE `fan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inscripcion`
--

DROP TABLE IF EXISTS `inscripcion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inscripcion` (
  `idinscripcion` int(11) NOT NULL AUTO_INCREMENT,
  `idmusico` int(11) DEFAULT NULL,
  `estado` int(1) NOT NULL,
  `idconcierto` int(11) NOT NULL,
  PRIMARY KEY (`idinscripcion`),
  KEY `idmusico` (`idmusico`),
  CONSTRAINT `inscripcion_ibfk_1` FOREIGN KEY (`idmusico`) REFERENCES `musico` (`idmusico`),
  CONSTRAINT `inscripcion_ibfk_2` FOREIGN KEY (`idinscripcion`) REFERENCES `concierto` (`idconcierto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inscripcion`
--

LOCK TABLES `inscripcion` WRITE;
/*!40000 ALTER TABLE `inscripcion` DISABLE KEYS */;
/*!40000 ALTER TABLE `inscripcion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `local`
--

DROP TABLE IF EXISTS `local`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `local` (
  `idlocal` int(11) NOT NULL,
  `ubicacion` varchar(50) NOT NULL,
  `aforo` int(10) NOT NULL,
  `imagen` longtext NOT NULL,
  PRIMARY KEY (`idlocal`),
  CONSTRAINT `local_ibfk_1` FOREIGN KEY (`idlocal`) REFERENCES `usuario` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `local`
--

LOCK TABLES `local` WRITE;
/*!40000 ALTER TABLE `local` DISABLE KEYS */;
/*!40000 ALTER TABLE `local` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `musico`
--

DROP TABLE IF EXISTS `musico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `musico` (
  `idmusico` int(11) NOT NULL,
  `genero` varchar(30) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
  `telefono` int(9) NOT NULL,
  `web` varchar(60) NOT NULL,
  `nombreartistico` varchar(50) NOT NULL,
  `numerocomponentes` int(11) NOT NULL,
  PRIMARY KEY (`idmusico`),
  CONSTRAINT `musico_ibfk_1` FOREIGN KEY (`idmusico`) REFERENCES `usuario` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `musico`
--

LOCK TABLES `musico` WRITE;
/*!40000 ALTER TABLE `musico` DISABLE KEYS */;
INSERT INTO `musico` VALUES (2,'Rock','',0,'','Muse',3),(4,'Balada','Ferri Llopis',0,'','Nino Bravo',1),(5,'Epic','On Titan',0,'','SHINGEKI',0),(6,'Rock','',0,'','Coldplay',4);
/*!40000 ALTER TABLE `musico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `tipo` int(1) NOT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Steven','semail','steven','1234',0),(2,'Muse','','muse','1234',1),(3,'Fan','fanemail','fan','1234',3),(4,'Luis','','nino','1234',1),(5,'Attack','','attack','1234',1),(6,'Coldplay','','coldplay','1234',1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `votacionfan`
--

DROP TABLE IF EXISTS `votacionfan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votacionfan` (
  `idmusico` int(11) NOT NULL,
  `idconcierto` int(11) DEFAULT NULL,
  `idfan` int(11) NOT NULL,
  `puntuacion` tinyint(4) NOT NULL,
  PRIMARY KEY (`idmusico`,`idfan`),
  KEY `idfan` (`idfan`),
  KEY `idconcierto` (`idconcierto`),
  CONSTRAINT `votacionfan_ibfk_1` FOREIGN KEY (`idmusico`) REFERENCES `musico` (`idmusico`),
  CONSTRAINT `votacionfan_ibfk_2` FOREIGN KEY (`idfan`) REFERENCES `fan` (`idfan`),
  CONSTRAINT `votacionfan_ibfk_3` FOREIGN KEY (`idconcierto`) REFERENCES `concierto` (`idconcierto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `votacionfan`
--

LOCK TABLES `votacionfan` WRITE;
/*!40000 ALTER TABLE `votacionfan` DISABLE KEYS */;
/*!40000 ALTER TABLE `votacionfan` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-05 16:30:16

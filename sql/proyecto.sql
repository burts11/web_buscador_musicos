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
-- Table structure for table `ciudad`
--

DROP TABLE IF EXISTS `ciudad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ciudad` (
  `idciudad` int(11) NOT NULL AUTO_INCREMENT,
  `provincia` varchar(45) NOT NULL,
  `poblacion` varchar(45) NOT NULL,
  PRIMARY KEY (`idciudad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciudad`
--

LOCK TABLES `ciudad` WRITE;
/*!40000 ALTER TABLE `ciudad` DISABLE KEYS */;
/*!40000 ALTER TABLE `ciudad` ENABLE KEYS */;
UNLOCK TABLES;

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
  `genero` int(11) NOT NULL,
  `valoreconomico` int(20) NOT NULL,
  `estado` int(11) NOT NULL,
  `ciudad` int(11) NOT NULL,
  `idmusico` int(11) DEFAULT NULL,
  PRIMARY KEY (`idconcierto`),
  KEY `idlocal` (`idlocal`),
  KEY `ciudad_fk_idx` (`genero`),
  KEY `ciudad_fk_idx1` (`ciudad`),
  CONSTRAINT `ciudad_fk` FOREIGN KEY (`genero`) REFERENCES `genero` (`idgenero`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `local_fk` FOREIGN KEY (`idlocal`) REFERENCES `local` (`idlocal`)
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
  `imagen` varchar(100) NOT NULL,
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
-- Table structure for table `genero`
--

DROP TABLE IF EXISTS `genero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genero` (
  `idgenero` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idgenero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genero`
--

LOCK TABLES `genero` WRITE;
/*!40000 ALTER TABLE `genero` DISABLE KEYS */;
INSERT INTO `genero` VALUES (1,'Rock'),(2,'Pop'),(3,'Electronica'),(4,'Country');
/*!40000 ALTER TABLE `genero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inscripcion`
--

DROP TABLE IF EXISTS `inscripcion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inscripcion` (
  `idmusico` int(11) NOT NULL,
  `estado` int(1) NOT NULL,
  `idconcierto` int(11) NOT NULL,
  PRIMARY KEY (`idmusico`,`idconcierto`),
  KEY `idmusico` (`idmusico`),
  KEY `concierto_fk_idx` (`idconcierto`),
  CONSTRAINT `concierto_fk` FOREIGN KEY (`idconcierto`) REFERENCES `concierto` (`idconcierto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `musico_ins_con_fk` FOREIGN KEY (`idmusico`) REFERENCES `musico` (`idmusico`)
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
  `imagen` varchar(100) NOT NULL,
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
  `generoID` int(11) NOT NULL,
  PRIMARY KEY (`idmusico`),
  KEY `genero_fk_idx` (`generoID`),
  CONSTRAINT `musico_fk_genero` FOREIGN KEY (`generoID`) REFERENCES `genero` (`idgenero`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `musico_ibfk_1` FOREIGN KEY (`idmusico`) REFERENCES `usuario` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `musico`
--

LOCK TABLES `musico` WRITE;
/*!40000 ALTER TABLE `musico` DISABLE KEYS */;
INSERT INTO `musico` VALUES (2,'Rock','',0,'','Muse',3,1),(4,'Balada','Ferri Llopis',0,'','Nino Bravo',1,2),(5,'Epic','On Titan',0,'','SHINGEKI',0,3),(6,'Rock','',0,'','Coldplay',4,4);
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
  `ciudad` int(11) DEFAULT NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `usuario_UNIQUE` (`usuario`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_ciudad_idx` (`ciudad`),
  CONSTRAINT `fk_ciudad` FOREIGN KEY (`ciudad`) REFERENCES `ciudad` (`idciudad`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Steven','semail','steven','1234',0,NULL),(2,'Muse','wtwr','muse','1234',1,NULL),(3,'Fan','fanemail','fan','1234',3,NULL),(4,'Luis','wrtrwt','nino','1234',1,NULL),(5,'Attack','htrhdth','attack','1234',1,NULL),(6,'Coldplay','laihf','coldplay','1234',1,NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `votacionconcierto`
--

DROP TABLE IF EXISTS `votacionconcierto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votacionconcierto` (
  `idconcierto` int(11) NOT NULL,
  `idfan` int(11) NOT NULL,
  PRIMARY KEY (`idconcierto`),
  KEY `idfan` (`idfan`),
  CONSTRAINT `votacionconcierto_ibfk_1` FOREIGN KEY (`idconcierto`) REFERENCES `concierto` (`idconcierto`),
  CONSTRAINT `votacionconcierto_ibfk_2` FOREIGN KEY (`idfan`) REFERENCES `fan` (`idfan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `votacionconcierto`
--

LOCK TABLES `votacionconcierto` WRITE;
/*!40000 ALTER TABLE `votacionconcierto` DISABLE KEYS */;
/*!40000 ALTER TABLE `votacionconcierto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `votacionmusico`
--

DROP TABLE IF EXISTS `votacionmusico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votacionmusico` (
  `idmusico` int(11) NOT NULL,
  `idfan` int(11) NOT NULL,
  PRIMARY KEY (`idmusico`,`idfan`),
  KEY `idfan` (`idfan`),
  CONSTRAINT `votacionmusico_ibfk_1` FOREIGN KEY (`idmusico`) REFERENCES `musico` (`idmusico`),
  CONSTRAINT `votacionmusico_ibfk_2` FOREIGN KEY (`idfan`) REFERENCES `fan` (`idfan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `votacionmusico`
--

LOCK TABLES `votacionmusico` WRITE;
/*!40000 ALTER TABLE `votacionmusico` DISABLE KEYS */;
/*!40000 ALTER TABLE `votacionmusico` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-06 20:36:02

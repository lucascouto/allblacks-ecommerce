CREATE DATABASE  IF NOT EXISTS `allblacks_ecommerce` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `allblacks_ecommerce`;
-- MySQL dump 10.13  Distrib 5.7.25, for osx10.9 (x86_64)
--
-- Host: 127.0.0.1    Database: allblacks_ecommerce
-- ------------------------------------------------------
-- Server version	5.7.25

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
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `idclient` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `document` varchar(45) NOT NULL,
  `zip_code` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `neighborhood` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  `state` char(2) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `active` varchar(3) NOT NULL,
  PRIMARY KEY (`idclient`),
  UNIQUE KEY `documento_UNIQUE` (`document`)
) ENGINE=InnoDB AUTO_INCREMENT=2221 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'TESSLIA BATISTA MATIAS JR.','00002253000102','75650000','Pc. Prof. Jose Candido Nr 709','Centro','Morrinhos','GO','','fulanodetal10@yahoo.com','SIM'),(2,'LUCIANA VIOLETA CARMONA','00003152000148','76630000','Rua Luis Antonio Nr 62','Centro','Itaberai','GO','6233751346','fulanodetal11@yahoo.com','SIM'),(3,'HENRIQUE DANTE SOTO FILHO','00003194000189','76630000','Rua Sr. dos Passos Nr 62','Centro','Itaberai','GO','','fulanodetal12@yahoo.com','NÃO'),(4,'ELIZABETH RAMIRES JR.','00004317000104','76240000','Rua Dagmar Bueno 225','Setor Aeroporto','Aragarças','GO','6436381218','fulanodetal13@yahoo.com','SIM'),(5,'JLIA QUEIRS MATIAS','00004721000170','60325720','Rua Cassimiro Montenegro, Nº 50','Monte Castelo','Fortaleza','CE','','fulanodetal14@yahoo.com','SIM'),(6,'LUCIANO RODRIGO VALDEZ','00005397000104','77750000','Av. Brasil Nr 506','Centro','Couto de Magalhaes','TO','','fulanodetal15@yahoo.com','NÃO'),(7,'SRA. JOANA SANTANA','00005413000169','77460000','Rua 12 S/nº Qd. 10 Lt. 09','Setor Sul','Peixe','TO','6333561193','fulanodetal16@yahoo.com','NÃO'),(8,'DR. SOFIA GALHARDO','00005421000105','77725000','Av. Costa e Silva  Nr 032','Centro','Colmeia','TO','','fulanodetal17@yahoo.com','NÃO'),(9,'SABRINA FONSECA CORTS','00007336000186','76165000','Rua Augusto Pereira Nr 326','Centro','Americano do Brasil','GO','6435041434','fulanodetal18@yahoo.com','NÃO'),(10,'THALES URIAS FRANCO','00034831000184','11013150','Rua Amador Bueno Nr 203','Centro','Santos','SP','1332232783','fulanodetal19@yahoo.com','SIM');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-04 21:45:45

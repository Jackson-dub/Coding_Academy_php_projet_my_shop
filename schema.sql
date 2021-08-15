-- MySQL dump 10.13  Distrib 8.0.25, for Linux (x86_64)
--
-- Host: localhost    Database: my_shop
-- ------------------------------------------------------
-- Server version	8.0.25-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `description` varchar(255) DEFAULT NULL,
  `price` int NOT NULL DEFAULT '0',
  `picture` varchar(255) DEFAULT NULL,
  `category_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'T-34','Zavod 183s finest product!',10000,'https://fr.m.wikipedia.org/wiki/Fichier:Tank_T-34.JPG',0),(2,'IS-2','Honoring the mustachoed georgian',50000,'https://fr.m.wikipedia.org/wiki/Fichier:Tank_T-34.JPG',0),(3,'IS-2','Honoring the mustachoed georgian',50000,'https://fr.m.wikipedia.org/wiki/Fichier:Tank_T-34.JPG',0),(4,'IS-2','Honoring the mustachoed georgian',50000,'https://fr.m.wikipedia.org/wiki/Fichier:Tank_T-34.JPG',0),(5,'IS-2','Honoring the mustachoed georgian',50000,'https://fr.m.wikipedia.org/wiki/Fichier:Tank_T-34.JPG',0),(6,'T-85','Honoring the mustachoed georgian',50000,'https://fr.m.wikipedia.org/wiki/Fichier:Tank_T-34.JPG',0),(7,'Wirblewind','To remove love in the air',50000,'https://fr.m.wikipedia.org/wiki/Fichier:Tank_T-34.JPG',0),(8,'table','Une table quoi',50,'https://fr.m.wikipedia.org/wiki/Fichier:Tank_T-34.JPG',0),(9,'chaise','Pour se poser',50,'https://fr.m.wikipedia.org/wiki/Fichier:Tank_T-34.JPG',0),(10,'tabouret','Pour se poser et tomber',50,'https://fr.m.wikipedia.org/wiki/Fichier:Tank_T-34.JPG',0),(11,'Un objet','Il existe',50,'https://fr.m.wikipedia.org/wiki/Fichier:Tank_T-34.JPG',0),(12,'Un objet 2','Il existe ?',50,'https://fr.m.wikipedia.org/wiki/Fichier:Tank_T-34.JPG',0),(13,'Manuel PHP','Bible du programmeur debutant',50,'https://fr.m.wikipedia.org/wiki/Fichier:Tank_T-34.JPG',0),(14,'sabre laser','Si seulement',50,'https://fr.m.wikipedia.org/wiki/Fichier:Tank_T-34.JPG',0),(15,'bt-5','craint la Finlande',50,'https://fr.m.wikipedia.org/wiki/Fichier:Tank_T-34.JPG',0),(16,'Simo Haya','Format pocket',50,'https://fr.m.wikipedia.org/wiki/Fichier:Tank_T-34.JPG',0),(17,'Neron','Lyre vendue séparément',50,'https://fr.m.wikipedia.org/wiki/Fichier:Tank_T-34.JPG',0),(18,'Objet 3','un objet',50,'https://fr.m.wikipedia.org/wiki/Fichier:Tank_T-34.JPG',0),(19,'Stuart','souris attachante',50,'https://fr.m.wikipedia.org/wiki/Fichier:Tank_T-34.JPG',0);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-25 10:49:50

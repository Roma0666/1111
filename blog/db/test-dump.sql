-- MySQL dump 10.13  Distrib 8.0.40, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: test_bd
-- ------------------------------------------------------
-- Server version	8.0.40-0ubuntu0.24.04.1

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categories_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'cat12'),(4,'test2312');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `text` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_author` int NOT NULL,
  `post_id` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_moderate` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `comments_posts_FK` (`post_id`),
  KEY `comments_users_FK` (`id_author`),
  CONSTRAINT `comments_posts_FK` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (13,'sdsadassdsadas',35,14,'2024-12-19 14:17:39',1),(14,'sdsadassdsadas',35,14,'2024-12-19 14:17:40',1),(15,'sdsadassdsadas',35,14,'2024-12-19 14:17:42',1),(16,'sdsadassdsadas',35,14,'2024-12-19 14:17:43',1),(17,'sdsadassdsadas',35,14,'2024-12-19 14:17:44',1),(18,'sdsadassdsadas',35,14,'2024-12-19 14:17:45',1),(19,'sdsadassdsadas',35,14,'2024-12-19 14:17:46',1),(20,'sdsadassdsadas',35,14,'2024-12-19 14:17:47',1),(21,'sdsadassdsadas',35,14,'2024-12-19 14:17:50',1),(22,'sdsadassdsadas',35,14,'2024-12-19 14:17:51',1),(23,'sdsadassdsadas',35,14,'2024-12-19 14:17:52',1),(24,'sdsadassdsadas',35,14,'2024-12-19 14:17:54',1),(25,'sdsadassdsadas',35,14,'2024-12-19 14:17:55',1),(26,'sdsadassdsadas',35,14,'2024-12-19 14:17:56',1),(27,'sdsadassdsadas',35,14,'2024-12-19 14:17:58',1),(28,'sdsadassdsadas',35,14,'2024-12-19 14:17:59',1),(29,'sdsadassdsadas',35,14,'2024-12-19 14:18:00',1),(30,'sdsadassdsadas',35,14,'2024-12-19 14:18:01',1),(31,'sdsadassdsadas',35,14,'2024-12-19 14:18:03',1),(32,'sdsadassdsadas',35,14,'2024-12-19 14:18:04',1),(33,'1234567890',35,14,'2024-12-19 14:27:07',1);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `title` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_author` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contacts_users_FK` (`id_author`),
  CONSTRAINT `contacts_users_FK` FOREIGN KEY (`id_author`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES ('asdfghjgfhfgdfgdgd','asdfghghdsafdghjkjhhgfdsfdgh',19,'2024-12-19 14:06:10','user',35),('sdsadassdsadas','sdsadassdsadas',20,'2024-12-19 14:16:19','user',35),('sdsadassdsadas','sdsadassdsadas',21,'2024-12-19 14:16:21','user',35),('sdsadassdsadas','sdsadassdsadas',22,'2024-12-19 14:16:22','user',35),('sdsadassdsadas','sdsadassdsadas',23,'2024-12-19 14:16:23','user',35),('sdsadassdsadas','sdsadassdsadas',24,'2024-12-19 14:16:24','user',35),('sdsadassdsadas','sdsadassdsadas',25,'2024-12-19 14:16:25','user',35),('sdsadassdsadas','sdsadassdsadas',26,'2024-12-19 14:16:27','user',35),('sdsadassdsadas','sdsadassdsadas',27,'2024-12-19 14:16:28','user',35),('sdsadassdsadas','sdsadassdsadas',28,'2024-12-19 14:16:29','user',35),('sdsadassdsadas','sdsadassdsadas',29,'2024-12-19 14:16:30','user',35),('sdsadassdsadas','sdsadassdsadas',30,'2024-12-19 14:16:30','user',35),('sdsadassdsadas','sdsadassdsadas',31,'2024-12-19 14:16:31','user',35),('sdsadassdsadas','sdsadassdsadas',32,'2024-12-19 14:16:47','user',35);
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_tags`
--

DROP TABLE IF EXISTS `post_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_tags` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `tag_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_tags_posts_FK` (`post_id`),
  KEY `post_tags_tags_FK` (`tag_id`),
  CONSTRAINT `post_tags_posts_FK` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `post_tags_tags_FK` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_tags`
--

LOCK TABLES `post_tags` WRITE;
/*!40000 ALTER TABLE `post_tags` DISABLE KEYS */;
INSERT INTO `post_tags` VALUES (7,14,1),(8,15,1),(9,16,1),(10,17,1),(11,18,1),(12,19,1),(13,20,1),(14,21,1),(15,22,1),(16,23,1),(17,24,1),(18,25,4),(19,27,1),(20,27,4),(21,28,1),(22,28,4),(23,28,5),(24,28,6),(25,28,7);
/*!40000 ALTER TABLE `post_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_author` int NOT NULL,
  `categories_id` int DEFAULT NULL,
  `is_moderate` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `posts_categories_FK` (`categories_id`),
  KEY `posts_users_FK` (`id_author`),
  CONSTRAINT `posts_categories_FK` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `posts_user_FK` FOREIGN KEY (`id_author`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (14,'sdsadassdsadas','sdsadassdsadas','2024-12-19 14:17:14',35,1,1),(15,'sdsadassdsadas','sdsadassdsadas','2024-12-19 14:17:16',35,1,1),(16,'sdsadassdsadas','sdsadassdsadas','2024-12-19 14:17:17',35,1,0),(17,'sdsadassdsadas','sdsadassdsadas','2024-12-19 14:17:18',35,1,0),(18,'sdsadassdsadas','sdsadassdsadas','2024-12-19 14:17:19',35,1,0),(19,'sdsadassdsadas','sdsadassdsadas','2024-12-19 14:17:19',35,1,0),(20,'sdsadassdsadas','sdsadassdsadas','2024-12-19 14:17:20',35,1,0),(21,'sdsadassdsadas','sdsadassdsadas','2024-12-19 14:17:21',35,1,0),(22,'sdsadassdsadas','sdsadassdsadas','2024-12-19 14:17:22',35,1,0),(23,'sdsadassdsadas','sdsadassdsadas','2024-12-19 14:17:23',35,1,0),(24,'sdsadassdsadas','sdsadassdsadas','2024-12-19 14:17:24',35,1,0),(25,'sdsadassdsadas','sdsadassdsadas','2024-12-19 14:49:09',35,1,0),(27,'sdsadassdsadas','sdsadassdsadas','2024-12-19 16:54:41',35,1,0),(28,'321312asdsadsa','sdadsadasdcfvgbhnjmkdfgh','2024-12-19 17:05:16',35,4,0);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tags_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'tag12'),(4,'test23'),(5,'sdfghj'),(6,'qwertyui'),(7,'hihgfdfdd');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pass` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_email_IDX` (`email`) USING BTREE,
  UNIQUE KEY `users_email_IDX` (`email`,`username`) USING BTREE,
  UNIQUE KEY `users_username_IDX` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (19,'admin','$2y$10$lnzJu388wA3qEcDf9AG2P.VnxMdtSXUHyvSNFVIs6RY/RNmJbnDBq','fgombgg@gmail.com','admin','2024-11-20 13:08:20'),(25,'user21','$2y$10$d9Xnsn5oIvBnENRd/QkRFOoYmcJbmjuBJnDhy0Pt3ZCQtdT2eYK.6','vocnuft@gmail.com','user','2024-11-22 13:46:54'),(32,'user3','$2y$10$NEW44VdDnp4W9gsMTVII9uXKnwxxDBVKhUT.L.2Y4juZHYqCXj0IW','roma.maks50@gmail.com','user','2024-12-18 14:08:53'),(35,'user','$2y$10$tu9Bo86mq.SmdrK3dGd90.jyfUfFBICAA1l7GBQfHjcjU7B3iPvCK','damota1957@atebin.com','user','2024-12-19 13:35:58');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'test_bd'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-30  0:30:43

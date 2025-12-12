-- MariaDB dump 10.19  Distrib 10.6.7-MariaDB, for Win64 (AMD64)
--
-- Host: 62.72.12.172    Database: web_gastore
-- ------------------------------------------------------
-- Server version	10.6.22-MariaDB-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_mst_product`
--

DROP TABLE IF EXISTS `tbl_mst_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_mst_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `type_barang` enum('REGULER','NON-REGULER') DEFAULT NULL,
  `jenis_asset` varchar(12) DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `stock_type` enum('INDENT','READY') DEFAULT NULL,
  `special_order` bit(1) DEFAULT b'0',
  `merek` varchar(100) DEFAULT NULL,
  `warna` varchar(100) DEFAULT NULL,
  `satuan_id` int(11) DEFAULT NULL,
  `ukuran` varchar(100) DEFAULT NULL,
  `model` varchar(100) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `show` bit(1) DEFAULT NULL,
  `min_stock` double DEFAULT 0,
  `max_stock` double DEFAULT 0,
  `is_deleted` bit(1) DEFAULT NULL,
  `is_actived` bit(1) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `responsibility` varchar(255) DEFAULT NULL,
  `tahun` varchar(4) DEFAULT NULL,
  `no_asset` varchar(255) DEFAULT NULL,
  `nomor_barang` varchar(100) DEFAULT NULL,
  `update_opname` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_mst_product_unique` (`kode_barang`),
  KEY `tbl_mst_product_tbl_mst_kategori_FK` (`kategori_id`),
  KEY `tbl_mst_product_tbl_mst_satuan_FK` (`satuan_id`),
  CONSTRAINT `tbl_mst_product_tbl_mst_kategori_FK` FOREIGN KEY (`kategori_id`) REFERENCES `tbl_mst_kategori` (`id`),
  CONSTRAINT `tbl_mst_product_tbl_mst_satuan_FK` FOREIGN KEY (`satuan_id`) REFERENCES `tbl_mst_satuan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=192 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mst_product`
--

LOCK TABLES `tbl_mst_product` WRITE;
/*!40000 ALTER TABLE `tbl_mst_product` DISABLE KEYS */;
INSERT INTO `tbl_mst_product` VALUES (53,'PEN-01','Pulpen','REGULER','PL',13,'READY','\0','M2100','Hitam',1,'-','-',0,NULL,'assets/images/1759105091_pulpen.jpg','',5,10,NULL,'\0','2025-10-24 10:15:42','2025-09-29 07:18:11','user_2','user_3','GA','Gilang','2025',NULL,NULL,NULL),(54,'KRS','Kursi','NON-REGULER','PL',8,'INDENT','\0','Donati','Hitam',1,'-','-',150000,NULL,'assets/images/1759119290_Harga-Kursi-Kantor-4008-Bandung.png','',0,0,NULL,'','2025-10-21 15:40:16','2025-09-29 11:14:50','user_2','user_7','GA','Gilang','2025','2','2',NULL),(55,'SRG-01','Seragam','REGULER','PK',14,'READY','','Bonecom','Biru',1,'L','TShirts',15000,NULL,'assets/images/1760671383_logo-color@2x1.png','',5,10,NULL,'','2025-10-20 13:09:07','2025-10-02 08:52:34','user_2','user_7','Plant 5','Gilang','2025','-','-',NULL),(57,'GA-ATK-112-001','Paper Fastener','REGULER','PK',13,'READY','\0',NULL,NULL,1,NULL,NULL,14000,NULL,'assets/images/1760424899_Screenshot 2025-10-14 135445.png','',5,10,NULL,'','2025-10-21 15:53:32','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(58,'GA-ATK-112-002','Amplop Coklat F4','REGULER','PK',13,'READY','\0','Joyko','Hitam',9,'-','-',40000,'Barang ATK','assets/images/1760425872_Screenshot 2025-10-14 141058.png','',5,20,NULL,'','2025-10-20 08:48:59','2025-10-14 11:43:07','user_4','user_7','Plant 5','ASNAWI','2025','Non Aset','-',NULL),(59,'GA-ATK-112-003','Amplop Putih 90 PPS','REGULER','PK',13,'READY','\0',NULL,NULL,12,NULL,NULL,28000,NULL,'assets/images/1760425015_Screenshot 2025-10-14 135638.png','',0,0,NULL,'','2025-10-20 08:49:20','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(60,'GA-ATK-112-004','Amplop Putih 104 PPS','REGULER','PK',13,'READY','\0',NULL,NULL,NULL,NULL,NULL,21000,NULL,'assets/images/1760425055_Screenshot 2025-10-14 135721.png','',0,0,NULL,'','2025-10-20 08:49:36','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(61,'GA-ATK-112-005','Ballpoint Kenko Gel K-1 Hitam','REGULER','PK',13,'READY','\0',NULL,NULL,NULL,NULL,NULL,65000,NULL,'assets/images/1760425168_Screenshot 2025-10-14 135843.png','',0,0,NULL,'','2025-10-20 08:50:21','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(62,'GA-ATK-112-006','Ballpoint Balliner','REGULER','PK',13,'READY','\0','Pilot',NULL,NULL,NULL,NULL,210000,NULL,'assets/images/1760425299_Screenshot 2025-10-14 140120.png','',0,0,NULL,'','2025-10-20 08:50:31','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(63,'GA-ATK-112-007','Ballpoint Snowman V5 Hitam','REGULER','PK',13,'READY','\0',NULL,NULL,NULL,NULL,NULL,35000,NULL,'assets/images/1760425351_Screenshot 2025-10-14 140213.png','',0,0,NULL,'','2025-10-20 08:56:59','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(64,'GA-ATK-112-008','Ballpoint Standard AE 7 Hitam','REGULER','PK',13,'READY','\0',NULL,NULL,NULL,NULL,NULL,23000,NULL,'assets/images/1760425397_Screenshot 2025-10-14 140259.png','',0,0,NULL,'','2025-10-20 08:57:06','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(65,'GA-ATK-112-009','Bantalan Stampel Joyko No. 1','REGULER','PK',13,'READY','\0',NULL,NULL,1,NULL,NULL,15000,NULL,'assets/images/1760425473_Screenshot 2025-10-14 140417.png','',0,0,NULL,'','2025-10-20 08:57:38','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(66,'GA-ATK-112-010','Battery Alkaline AA @ 2 Pcs','REGULER','PK',8,'READY','\0',NULL,NULL,NULL,NULL,NULL,15000,NULL,'assets/images/1760425596_Screenshot 2025-10-14 140624.png','',0,0,NULL,'','2025-10-20 09:03:03','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(67,'GA-ATK-112-011','Battery Alkaline AAA @ 2 Pcs','REGULER','PK',8,'READY','\0',NULL,NULL,NULL,NULL,NULL,15000,NULL,'assets/images/1760425555_Screenshot 2025-10-14 140516.png','',0,0,NULL,'','2025-10-20 09:05:52','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(68,'GA-ATK-112-012','Battery Besar','REGULER','PK',8,'READY','\0',NULL,NULL,1,NULL,NULL,20000,NULL,'assets/images/1760425662_Screenshot 2025-10-14 140722.png','',0,0,NULL,'','2025-10-20 09:06:10','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(69,'GA-ATK-112-013','Binder Clip No. 107 @ 12 Lusin','REGULER','PK',13,'READY','\0',NULL,NULL,10,NULL,NULL,48000,NULL,'assets/images/1760425973_Screenshot 2025-10-14 141229.png','',0,0,NULL,'','2025-10-20 09:10:05','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(70,'GA-ATK-112-014','Binder Clip No. 200 @ 12 Pcs','REGULER','PK',13,'READY','\0',NULL,NULL,NULL,NULL,NULL,14000,NULL,'assets/images/1760426027_Screenshot 2025-10-14 141328.png','',0,0,NULL,'','2025-10-20 09:10:20','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(71,'GA-ATK-112-015','Binder Clip No. 260 @ 12 Pcs','REGULER','PK',13,'READY','\0',NULL,NULL,NULL,NULL,NULL,18000,NULL,'assets/images/1760426723_Screenshot 2025-10-14 142504.png','',0,0,NULL,'','2025-10-20 09:13:24','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(72,'GA-ATK-112-016','Box File Bantex Biru','REGULER','PK',13,'READY','\0',NULL,NULL,1,NULL,NULL,42000,NULL,'assets/images/1760426913_Screenshot 2025-10-14 142818.png','',0,0,NULL,'','2025-10-20 09:13:32','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(73,'GA-ATK-112-017','Buku Folio Isi 100 Lembar','REGULER','PK',13,'READY','\0',NULL,NULL,1,NULL,NULL,19000,NULL,'assets/images/1760428328_Screenshot 2025-10-14 145152.png','',0,0,NULL,'','2025-10-20 09:13:45','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(74,'GA-ATK-112-018','Buku Kwitansi Sedang','REGULER','PK',13,'READY','\0',NULL,NULL,1,NULL,NULL,7000,NULL,'assets/images/1760428387_Screenshot 2025-10-14 145251.png','',0,0,NULL,'','2025-10-20 09:16:24','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(75,'GA-ATK-112-019','Buku Mini Pocket Diary','REGULER','PK',13,'READY','\0',NULL,NULL,1,NULL,NULL,10000,NULL,'assets/images/1760428615_Screenshot 2025-10-14 145640.png','',0,0,NULL,'','2025-10-20 09:16:37','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(76,'GA-ATK-112-020','Buku Nota Kontan Kecil 1 Ply ( 108 x 155 mm )','REGULER','PK',13,'READY','\0',NULL,NULL,1,NULL,NULL,5000,NULL,'assets/images/1760428680_Screenshot 2025-10-14 145740.png','',0,0,NULL,'','2025-10-20 09:16:44','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(77,'GA-ATK-112-021','Bussines File F4 Biru','REGULER','PK',13,'READY','\0',NULL,NULL,9,NULL,NULL,30000,NULL,'assets/images/1760428725_Screenshot 2025-10-14 145831.png','',0,0,NULL,'','2025-10-20 09:16:55','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(78,'GA-ATK-112-022','Card Case A3','REGULER','PK',13,'READY','\0',NULL,NULL,1,NULL,NULL,25000,NULL,'assets/images/1760430795_Screenshot 2025-10-14 153300.png','',0,0,NULL,'','2025-10-20 09:17:03','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(79,'GA-ATK-112-023','Casing ID Card','REGULER','PK',13,'READY','\0',NULL,NULL,1,NULL,NULL,5000,NULL,'assets/images/1760430952_Screenshot 2025-10-14 153540.png','',0,0,NULL,'','2025-10-20 09:17:11','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(80,'GA-ATK-112-024','Clear Book A4 / F4 Isi 20','REGULER','PK',13,'READY','\0',NULL,NULL,1,NULL,NULL,20000,NULL,'assets/images/1760431097_Screenshot 2025-10-14 153800.png','',0,0,NULL,'','2025-10-20 09:17:30','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(81,'GA-ATK-112-025','Clear Holder A4 \"Daichi\"','REGULER','PK',13,'READY','\0',NULL,NULL,9,NULL,NULL,32000,NULL,'assets/images/1760431140_Screenshot 2025-10-14 153843.png','',0,0,NULL,'','2025-10-20 09:17:40','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(82,'GA-ATK-112-026','Cutter Besar L 500','REGULER','PK',13,'READY','\0',NULL,NULL,1,NULL,NULL,20000,NULL,'assets/images/1760925119_cutter L500.png','',0,0,NULL,'','2025-10-20 11:28:09','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(83,'GA-ATK-112-027','Dispenser Tape Lion No. 50','REGULER','PK',13,'READY','\0',NULL,NULL,1,NULL,NULL,40000,NULL,'assets/images/1760925169_dispenser Tap.jpg','',0,0,NULL,'','2025-10-20 11:28:15','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(84,'GA-ATK-112-028','Dispenser Tape OPP Bahan Besi \"V Tech\"','REGULER','PK',13,'READY','\0',NULL,NULL,1,NULL,NULL,25000,NULL,'assets/images/1760925391_tap V-tech.png','',0,0,NULL,'','2025-10-20 11:28:21','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(85,'GA-ATK-112-029','Double Tape 1\"','REGULER','PK',13,'READY','\0',NULL,NULL,8,NULL,NULL,7500,NULL,'assets/images/1760926719_double tap.jpg','',0,0,NULL,'','2025-10-20 11:28:29','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(86,'GA-ATK-112-030','Gantungan Kunci Joyko KR 08 Isi 50 Pcs','REGULER','PK',13,'READY','\0',NULL,NULL,9,NULL,NULL,50000,NULL,'assets/images/1760926952_Gantungan Kunci Label Joyko.jpg','',0,0,NULL,'','2025-10-20 11:28:35','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(87,'GA-ATK-112-031','Gunting Besar','REGULER','PK',13,'READY','\0',NULL,NULL,1,NULL,NULL,15000,NULL,'assets/images/1760926996_Gunting_Besar.jpg','',0,0,NULL,'','2025-10-20 11:29:20','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(88,'GA-ATK-112-032','Gunting Sedang','REGULER','PK',13,'READY','\0',NULL,NULL,1,NULL,NULL,12000,NULL,'assets/images/1760927040_Gunting Sedang.jpg','',0,0,NULL,'','2025-10-20 09:27:51','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(89,'GA-ATK-112-033','Isi Ballpoint Snowman V5','REGULER','PK',13,'READY','\0',NULL,NULL,NULL,NULL,NULL,14000,NULL,'assets/images/1760927164_isi Ball point v-5.png','',0,0,NULL,'','2025-10-20 09:27:40','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(90,'GA-ATK-112-034','Isi Staples Max No. 10','REGULER','PK',13,'READY','\0',NULL,NULL,NULL,NULL,NULL,70000,NULL,'assets/images/1760927249_isi strapless.png','',0,0,NULL,'','2025-10-20 09:27:29','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(91,'GA-ATK-112-035','Kalkulator Casio DH 12','REGULER','PK',13,'READY','\0',NULL,NULL,1,NULL,NULL,170000,NULL,'assets/images/1760927408_kalkulator.png','',0,0,NULL,'','2025-10-20 09:30:21','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(92,'GA-ATK-112-036','Kalkulator Citizen SDC 812 NR','REGULER','PK',13,'READY','\0',NULL,NULL,1,NULL,NULL,90000,NULL,'assets/images/1760928268_kalkulator Nr.png','',0,0,NULL,'','2025-10-20 09:44:28','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(93,'GA-ATK-112-037','Kartu Absen Apple','REGULER','PK',13,'READY','\0',NULL,NULL,9,NULL,NULL,25000,NULL,'assets/images/1760928399_kartu absen.jpg','',0,0,NULL,'','2025-10-20 09:46:39','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(94,'GA-ATK-112-038','Kertas A3 75 gr Paper One','REGULER','PK',13,'READY','\0',NULL,NULL,NULL,NULL,NULL,95000,NULL,'assets/images/1760928576_kertas-a3-75gr-paper-one-t2z2_600.png','',0,0,NULL,'','2025-10-20 09:49:36','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(95,'GA-ATK-112-039','Kertas A4 70 gr IK Copy Paper','REGULER','PK',13,'READY','\0',NULL,NULL,NULL,NULL,NULL,42000,NULL,'assets/images/1760928627_A4.jpg','',0,0,NULL,'','2025-10-20 09:50:27','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(96,'GA-ATK-112-040','Kertas A4 70 gr Warna Kuning Merk Neo Star','REGULER','PK',13,'READY','\0',NULL,NULL,NULL,NULL,NULL,65000,NULL,'assets/images/1760928717_a4 kuning.png','',0,0,NULL,'','2025-10-20 09:51:57','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(97,'GA-ATK-112-041','Kertas A4 70 gr Warna Biru Merk Neo Star','REGULER','PK',13,'READY','\0',NULL,NULL,NULL,NULL,NULL,65000,NULL,'assets/images/1760928820_A4.jpg','',0,0,NULL,'','2025-10-20 09:53:40','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(98,'GA-ATK-112-042','Kertas A4 70 gr Warna Pink Merk Neo Star','REGULER','PK',13,'READY','\0',NULL,NULL,NULL,NULL,NULL,65000,NULL,'assets/images/1760928882_A4.jpg','',0,0,NULL,'','2025-10-20 09:54:42','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(99,'GA-ATK-112-043','Kertas A4 70 gr Warna Hijau Merk Neo Star','REGULER','PK',13,'READY','\0',NULL,NULL,NULL,NULL,NULL,65000,NULL,'assets/images/1760929086_A4.jpg','',0,0,NULL,'','2025-10-20 09:58:06','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(100,'GA-ATK-112-044','Kertas Buram A4','REGULER','PK',13,'READY','\0',NULL,NULL,NULL,NULL,NULL,35000,NULL,'assets/images/1760928899_A4.jpg','',0,0,NULL,'','2025-10-20 09:54:59','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(101,'GA-ATK-112-045','Kertas Buffalo A4 Orange','REGULER','PK',13,'READY','\0',NULL,NULL,9,NULL,NULL,65000,NULL,'assets/images/1760929149_orange a4.png','',0,0,NULL,'','2025-10-20 09:59:18','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(102,'GA-ATK-112-046','Kertas Concord 220 gr Isi 10 Lembar','REGULER','PK',13,'READY','\0',NULL,NULL,9,NULL,NULL,18000,NULL,'assets/images/1760929205_Screenshot 2025-10-20 095950.png','',0,0,NULL,'','2025-10-20 10:00:05','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(103,'GA-ATK-112-047','Kertas F4 75 gr Paper One','REGULER','PK',13,'READY','\0',NULL,NULL,NULL,NULL,NULL,58000,NULL,'assets/images/1760929255_Screenshot 2025-10-20 100035.png','',0,0,NULL,'','2025-10-20 10:00:55','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(104,'GA-ATK-112-048','Label Tom & Jerry No. 121','REGULER','PK',13,'READY','\0',NULL,NULL,9,NULL,NULL,8000,NULL,'assets/images/1760929292_Screenshot 2025-10-20 100117.png','',0,0,NULL,'','2025-10-20 10:01:32','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(105,'GA-ATK-112-049','Lakban Bening 2\"','REGULER','PK',13,'READY','\0',NULL,NULL,8,NULL,NULL,11000,NULL,'assets/images/1760935221_Screenshot 2025-10-20 114007.png','',0,0,NULL,'','2025-10-20 11:40:21','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(106,'GA-ATK-112-050','Lakban Kertas 1\"','REGULER','PK',13,'READY','\0',NULL,NULL,8,NULL,NULL,7500,NULL,'assets/images/1760935272_Screenshot 2025-10-20 114053.png','',0,0,NULL,'','2025-10-20 11:41:12','2025-10-14 11:43:07','user_4','user_7',NULL,NULL,NULL,NULL,NULL,NULL),(107,'GA-ATK-112-051','Lakban Lantai 2\" G Tape','REGULER','PK',13,'READY','\0','-','Kuning',8,NULL,NULL,60000,NULL,'assets/images/1760941547_Screenshot 2025-10-20 132453.png','',0,0,NULL,'','2025-10-20 13:25:47','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(108,'GA-ATK-112-052','Lem Stick Kenko 15 gr @ 20 Pcs','REGULER','PK',13,'READY','\0','Kenko','Hijau',1,'-','Stick',80000,'-','assets/images/1760942294_Screenshot 2025-10-20 133625.png','',5,10,NULL,'','2025-10-20 13:38:14','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(109,'GA-ATK-112-053','Map Seagul Spring File','REGULER','PK',13,'READY','\0','Seagull','-',1,'-','-',6500,'-','assets/images/1760942460_Screenshot 2025-10-20 133957.png','',5,10,NULL,'','2025-10-20 13:41:00','2025-10-14 11:43:07','user_4','user_7','Plant 5','GIlang','2025','-','-',NULL),(110,'GA-ATK-112-054','Mesin Laminating V Tech','REGULER','PK',13,'INDENT','\0','V- Tech','-',12,'-','-',900000,NULL,'assets/images/1760942599_Screenshot 2025-10-20 134138.png','',0,0,NULL,'','2025-10-21 15:53:13','2025-10-14 11:43:07','user_4','user_7','Plant 5','GIlang','2025','-','-',NULL),(111,'GA-ATK-112-055','Ordner Bindex Kwitansi 777 , 727 , 717','REGULER','PK',13,'READY','\0','Bindex','-',1,'-','-',270000,'-','assets/images/1760942699_Screenshot 2025-10-20 134357.png','',5,10,NULL,'','2025-10-20 13:44:59','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(112,'GA-ATK-112-056','Paper Clip No. 3','REGULER','PK',13,'READY','\0','Joyko','-',9,'-','Clip',1600,'-','assets/images/1760942810_Screenshot 2025-10-20 134540.png','',5,10,NULL,'','2025-10-20 13:46:50','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(113,'GA-ATK-112-057','Pembolong Kertas No. 30','REGULER','PK',13,'READY','\0','Kenko','-',1,'-','-',12500,'-','assets/images/1760942927_Screenshot 2025-10-20 134736.png','',5,10,NULL,'','2025-10-20 13:48:47','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(114,'GA-ATK-112-058','Pembolong Kertas No. 85','REGULER','PK',13,'READY','\0','Joyko','-',1,'-','-',47500,'-','assets/images/1760943023_Screenshot 2025-10-20 134921.png','',0,0,NULL,'','2025-10-20 13:50:23','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(115,'GA-ATK-112-059','Penggaris Plastik 30 cm @ 12 Pcs','REGULER','PK',13,'READY','\0','Butterfly','-',1,'-','-',30000,'-','assets/images/1760943134_Screenshot 2025-10-20 135113.png','',5,10,NULL,'','2025-10-20 13:52:14','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(116,'GA-ATK-112-060','Penghapus Whiteboard Merk GM','REGULER','PK',13,'READY','\0','Kenko','-',1,'-','-',12500,'-','assets/images/1760943262_Screenshot 2025-10-20 135250.png','',5,10,NULL,'','2025-10-20 13:54:22','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(117,'GA-ATK-112-061','Pensil Raut 2B \"Agatis\"','REGULER','PK',13,'READY','\0','Kenko','-',1,'-','-',37000,'-','assets/images/1760943348_Screenshot 2025-10-20 135452.png','',5,10,NULL,'','2025-10-20 13:55:48','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(118,'GA-ATK-112-062','Pita Epson LQ 2180','REGULER','PK',13,'READY','\0','Epson','-',1,'-','LQ',75000,'-','assets/images/1760943589_Screenshot 2025-10-20 135828.png','',5,10,NULL,'','2025-10-20 13:59:49','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(119,'GA-ATK-112-063','Pita Epson LQ 2190','REGULER','PK',13,'READY','\0','Epson','-',1,'-','LQ',75000,'-','assets/images/1760943672_Screenshot 2025-10-20 135828.png','',5,10,NULL,'','2025-10-20 14:01:12','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(120,'GA-ATK-112-064','Pita Epson LQ 2190 + Rumah','REGULER','PK',13,'READY','\0','Epson','-',1,'-','LQ Rumah',184000,'-','assets/images/1760943745_Screenshot 2025-10-20 135828.png','',5,10,NULL,'','2025-10-20 14:02:25','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(121,'GA-ATK-112-065','Pita Epson LQ 310','REGULER','PK',13,'READY','\0','Epson','-',1,'-','LQ 310',48500,'-','assets/images/1760943844_Screenshot 2025-10-20 135828.png','',5,10,NULL,'','2025-10-20 14:04:04','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(122,'GA-ATK-112-066','Pita Epson LX 310','REGULER','PK',13,'READY','\0','Epson','-',1,'-','LX',40000,'-','assets/images/1760943931_Screenshot 2025-10-20 140435.png','',5,10,NULL,'','2025-10-20 14:05:31','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(123,'GA-ATK-112-067','Plastik Laminating A3','REGULER','PK',13,'READY','\0','Amanda','-',9,'-','-',150000,'-','assets/images/1760944140_Screenshot 2025-10-20 140742.png','',5,10,NULL,'','2025-10-20 14:09:00','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(124,'GA-ATK-112-068','Plastik Laminating A4','REGULER','PK',13,'READY','\0','Amanda','-',9,'-','-',82500,'-','assets/images/1760944211_Screenshot 2025-10-20 140925.png','',5,10,NULL,'','2025-10-20 14:10:11','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(125,'GA-ATK-112-069','Plastik Laminating ID Card','REGULER','PK',13,'READY','\0','E- Print','-',9,'-','-',33000,'-','assets/images/1760944300_Screenshot 2025-10-20 141048.png','',5,10,NULL,'','2025-10-20 14:11:40','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(126,'GA-ATK-112-070','Post IT 654 Warna Kuning','REGULER','PK',13,'READY','\0','Post','-',9,'-','-',10500,'-','assets/images/1760944388_Screenshot 2025-10-20 141215.png','',5,10,NULL,'','2025-10-20 14:13:08','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(127,'GA-ATK-112-071','Post It Mark & Notes','REGULER','PK',13,'READY','\0','Fronto','-',1,'-','-',9500,'-','assets/images/1760944491_Screenshot 2025-10-20 141353.png','',5,10,NULL,'','2025-10-20 14:14:51','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(128,'GA-ATK-112-072','Post It Sign Here','REGULER','PK',13,'READY','\0','Fronto','-',1,'-','-',20000,'-','assets/images/1760944571_Screenshot 2025-10-20 141515.png','',5,10,NULL,'','2025-10-20 14:16:11','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(129,'GA-ATK-112-073','PP Pocket F4 Bindex @ 20 Pcs','REGULER','PK',13,'READY','\0','Bindex','-',9,'-','-',24000,'-','assets/images/1760944790_Screenshot 2025-10-20 141856.png','',5,10,NULL,'','2025-10-20 14:19:50','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(130,'GA-ATK-112-074','Push Pin','REGULER','PK',13,'READY','\0','Kenko','-',9,'-','-',3500,'-','assets/images/1760944902_Screenshot 2025-10-20 142045.png','',5,10,NULL,'','2025-10-20 14:21:42','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(131,'GA-ATK-112-075','Rautan Pensil \"Maped\"','REGULER','PK',13,'READY','\0','Maped','-',1,'-','-',2500,'-','assets/images/1760945293_Screenshot 2025-10-20 142708.png','',5,10,NULL,'','2025-10-20 14:28:13','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(132,'GA-ATK-112-076','Remover Staples \"Bantex\"','REGULER','PK',13,'READY','\0','Bantex','Hitam',1,'-','-',9500,'-','assets/images/1761011369_Screenshot 2025-10-21 084824.png','',2,5,NULL,'','2025-10-21 08:49:29','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(133,'GA-ATK-112-077','Spidol Snowman OPF','REGULER','PK',13,'READY','\0','Snowman','Hitam',1,'-','-',84000,'-','assets/images/1761011442_Screenshot 2025-10-21 084955.png','',5,10,NULL,'','2025-10-21 08:50:42','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(134,'GA-ATK-112-078','Spidol Snowman Paint Marker Putih','REGULER','PK',13,'INDENT','\0','Snowman','Putih',1,'-','-',12250,'-','assets/images/1761011537_Screenshot 2025-10-21 085109.png','',0,0,NULL,'','2025-10-21 08:52:17','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(135,'GA-ATK-112-079','Spidol Snowman Permanent','REGULER','PK',13,'INDENT','\0','Snowman','Hitam',1,'-','Permanent',68400,'-','assets/images/1761011613_Screenshot 2025-10-21 085243.png','',0,0,NULL,'','2025-10-21 08:53:33','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(136,'GA-ATK-112-080','Spidol Snowman Whiteboard Hitam','REGULER','PK',13,'READY','\0','Snowman','Hitam',1,'-','-',80400,'-','assets/images/1761011797_Screenshot 2025-10-21 085540.png','',5,10,NULL,'','2025-10-21 08:56:37','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(137,'GA-ATK-112-081','Spidol Snowman Whiteboard merah','REGULER','PK',13,'READY','\0','Snowman','Merah',1,'-','-',80400,'-','assets/images/1761011888_Screenshot 2025-10-21 085723.png','',5,10,NULL,'','2025-10-21 08:58:08','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(138,'GA-ATK-112-082','Spidol Snowman Whiteboard Gold','REGULER','PK',13,'INDENT','\0','Snowman','Gold',1,'-','-',147000,'-','assets/images/1761012001_Screenshot 2025-10-21 085832.png','',0,0,NULL,'','2025-10-21 09:00:01','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(139,'GA-ATK-112-083','Stabillo Boss Hijau','REGULER','PK',13,'READY','\0','Stabillo','Hijau',1,'-','-',9000,'-','assets/images/1761012092_Screenshot 2025-10-21 090038.png','',5,10,NULL,'','2025-10-21 09:01:32','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(140,'GA-ATK-112-084','Stabillo Boss Biru','REGULER','PK',13,'READY','\0','Stabillo','Biru',1,'-',NULL,9000,'-','assets/images/1761012157_Screenshot 2025-10-21 090159.png','',5,10,NULL,'','2025-10-21 09:02:37','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(141,'GA-ATK-112-085','Stampel Tanggal Joyko D-3','REGULER','PK',13,'INDENT','\0','Joyko','-',1,'-','-',9500,'-','assets/images/1761012230_Screenshot 2025-10-21 090302.png','',0,0,NULL,'','2025-10-21 09:03:50','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(142,'GA-ATK-112-086','Staples Max HD 10','REGULER','PK',13,'READY','\0','Stapler','Biru',1,'-','-',15000,'-','assets/images/1761012312_Screenshot 2025-10-21 090408.png','',1,2,NULL,'','2025-10-21 09:05:12','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(143,'GA-ATK-112-087','Staples Max HD 50','REGULER','PK',13,'READY','\0','Stapless','Biru',1,'-','-',65000,'-','assets/images/1761012399_Screenshot 2025-10-21 090542.png','',1,2,NULL,'','2025-10-21 09:06:39','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(144,'GA-ATK-112-088','Tinta Epson 001 Black','REGULER','PK',13,'READY','\0','Epson','Hitam',1,'-','-',180000,'-','assets/images/1761012528_Screenshot 2025-10-21 090711.png','',1,3,NULL,'','2025-10-21 09:08:48','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(145,'GA-ATK-112-089','Tinta Epson 001 Cyan','REGULER','PK',13,'READY','\0','Epson','Cyan',1,'-','-',120000,'-','assets/images/1761012636_Screenshot 2025-10-21 090931.png','',1,2,NULL,'','2025-10-21 09:10:36','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(146,'GA-ATK-112-090','Tinta Epson 001 Magenta','REGULER','PK',13,'READY','\0','Epson','Magenta',1,'-','-',120000,'-','assets/images/1761012704_Screenshot 2025-10-21 091059.png','',1,2,NULL,'','2025-10-21 09:11:44','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(147,'GA-ATK-112-091','Tinta Epson 001 Yellow','REGULER','PK',13,'READY','\0','Epson','Yellow',1,'-','-',120000,'-','assets/images/1761012778_Screenshot 2025-10-21 091208.png','',1,2,NULL,'','2025-10-21 09:12:58','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(148,'GA-ATK-112-092','Tinta Epson 003 Black','REGULER','PK',13,'READY','\0','Epson','Hitam',1,'-','003',88000,'-','assets/images/1761013003_Screenshot 2025-10-21 091547.png','',1,2,NULL,'','2025-10-21 09:16:43','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(149,'GA-ATK-112-093','Tinta Epson 003 Cyan','REGULER','PK',13,'READY','\0','Epson','Cyan',1,'-','003',88000,'-','assets/images/1761013060_Screenshot 2025-10-21 091657.png','',1,2,NULL,'','2025-10-21 09:17:40','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(150,'GA-ATK-112-094','Tinta Epson 003 Magenta','REGULER','PK',13,'READY','\0','Epson','Magenta',1,'-','003',88000,'-','assets/images/1761013130_Screenshot 2025-10-21 091807.png','',1,2,NULL,'','2025-10-21 09:18:50','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(151,'GA-ATK-112-095','Tinta Epson 003  Yellow','REGULER','PK',13,'READY','\0','Epson','Yellow',1,'-','003',88000,'-','assets/images/1761013211_Screenshot 2025-10-21 091922.png','',1,2,NULL,'','2025-10-21 09:20:11','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(152,'GA-ATK-112-096','Tinta Epson 008 Black','REGULER','PK',13,'READY','\0','Epson','Hitam',1,'-','008',279000,'-','assets/images/1761013467_Screenshot 2025-10-21 092138.png','',1,2,NULL,'','2025-10-21 09:24:27','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(153,'GA-ATK-112-097','Tinta Epson 008 Cyan','REGULER','PK',13,'READY','\0','Epson','Cyan',1,'-','008',279000,'-','assets/images/1761013419_Screenshot 2025-10-21 092330.png','',1,2,NULL,'','2025-10-21 09:23:39','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(154,'GA-ATK-112-098','Tinta Epson 008 Magenta','REGULER','PK',13,'READY','\0','Epson','Magenta',1,'-','008',279000,'-','assets/images/1761013550_Screenshot 2025-10-21 092512.png','',1,2,NULL,'','2025-10-21 09:25:50','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(155,'GA-ATK-112-099','Tinta Epson 008  Yellow','REGULER','PK',13,'READY','\0','Epson','-',1,'-','-',224000,'-','assets/images/1761009505_Screenshot 2025-10-21 081653.png','',5,10,NULL,'','2025-10-21 08:18:25','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(156,'GA-ATK-112-100','Tinta Spidol Snowman Whiteboard','REGULER','PK',13,'READY','\0','Snowman','-',1,'-','-',14000,'-','assets/images/1761009618_Screenshot 2025-10-21 081858.png','',5,10,NULL,'','2025-10-21 08:20:18','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(157,'GA-ATK-112-101','Tinta Stampel Artline Hitam','REGULER','PK',13,'READY','\0','Artline','-',1,'-','-',23000,'-','assets/images/1761009746_Screenshot 2025-10-21 082136.png','',5,10,NULL,'','2025-10-21 08:22:26','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(158,'GA-ATK-112-102','Tinta Stampel Artline Biru','REGULER','PK',13,'READY','\0','Artline','Biru',1,'-','-',23000,'-','assets/images/1761009815_Screenshot 2025-10-21 082251.png','',5,10,NULL,'','2025-10-21 08:23:35','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(159,'GA-ATK-112-103','Tinta Stampel Artline Merah','REGULER','PK',13,'READY','\0','Artline','Merah',1,'-','-',23000,'-','assets/images/1761009882_Screenshot 2025-10-21 082404.png','',5,10,NULL,'','2025-10-21 08:24:42','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(160,'GA-ATK-112-104','Tipe Ex Kertas Kenko','REGULER','PK',13,'READY','\0','Kenko','-',1,'-','-',5500,'-','assets/images/1761010032_Screenshot 2025-10-21 082520.png','',5,10,NULL,'','2025-10-21 08:27:12','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(161,'GA-ATK-112-105','Tray Besi 3 Susun V Tech','REGULER','PK',13,'INDENT','\0','Joyko','Hitam',12,'-',NULL,80000,'-','assets/images/1761010122_Screenshot 2025-10-21 082738.png','',0,0,NULL,'','2025-10-21 08:28:42','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(162,'GA-ATK-112-106','Triagonal Clips','REGULER','PK',13,'READY','\0','Joyko','-',9,'-','-',1800,'-','assets/images/1761010197_Screenshot 2025-10-21 082907.png','',5,10,NULL,'','2025-10-21 08:29:57','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(163,'GA-ATK-112-107','Clear Holder Folio isi 80 lbr','REGULER','PK',13,'INDENT','\0','Agatha','-',1,'-','Clear Holder',43000,'-','assets/images/1761010315_Screenshot 2025-10-21 083032.png','',0,0,NULL,'','2025-10-21 08:31:55','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(164,'GA-ATK-112-108','Printer Ribbon Colour Series HiTi CS-2 YMCKO 400','REGULER','PK',13,'READY','\0','Hiti','-',1,'-','Ribbon',1675000,'-','assets/images/1761010433_Screenshot 2025-10-21 083245.png','',0,0,NULL,'','2025-10-21 08:33:53','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(165,'GA-ATK-112-109','Tinta Print Brother D60 Black','REGULER','PK',13,'READY','\0','brother','Hitam',1,'-','-',105000,'-','assets/images/1761010570_Screenshot 2025-10-21 083435.png','',1,2,NULL,'','2025-10-21 08:36:10','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(166,'GA-ATK-112-110','Tinta Print Brother 500 Yellow','REGULER','PK',13,'READY','\0','Brother','Kuning',1,'-','-',105000,'-','assets/images/1761010651_Screenshot 2025-10-21 083649.png','',1,2,NULL,'','2025-10-21 08:37:31','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(167,'GA-ATK-112-111','Tinta Print Brother 500 Magenta','REGULER','PK',13,'READY','\0','Brother','Merah',1,'-','-',105000,'-','assets/images/1761010721_Screenshot 2025-10-21 083757.png','',1,2,NULL,'','2025-10-21 08:38:41','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(168,'GA-ATK-112-112','Tinta Print Brother 500 Cyan','REGULER','PK',13,'READY','\0','Brother','Biru',1,'-','-',105000,'-','assets/images/1761010781_Screenshot 2025-10-21 083905.png','',1,2,NULL,'','2025-10-21 08:39:41','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(169,'GA-ATK-112-113','Stampel Approval','REGULER','PK',13,'INDENT','\0','-','-',1,'-','-',170000,'-','assets/images/1761030906_Screenshot 2025-10-21 141317.png','',0,0,NULL,'','2025-10-21 14:15:06','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(170,'GA-ATK-112-114','Sticker Scotlite Logo BTI','REGULER','PK',13,'INDENT','\0','-','-',1,'--','-',800000,'-','assets/images/1761031705_Screenshot 2025-10-21 142746.png','',0,0,NULL,'','2025-10-21 14:28:25','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(171,'GA-ATK-112-115','Sticker Tanda Panah Merah dan Hijau','REGULER','PK',13,'INDENT','\0','-','-',1,'-','-',10000,'-','assets/images/1761030993_Screenshot 2025-10-21 141554.png','',0,0,NULL,'','2025-10-21 14:16:33','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(172,'GA-ATK-112-116','Stampel Quality Dept (Model Cap Polos)','REGULER','PK',NULL,'READY','\0',NULL,NULL,1,NULL,NULL,85000,NULL,NULL,NULL,0,0,NULL,'','2025-10-14 11:43:07','2025-10-14 11:43:07','user_4','user_4',NULL,NULL,NULL,NULL,NULL,NULL),(173,'GA-ATK-112-117','Surat Jalan PT. Bonecom Tricom ','REGULER','PK',NULL,'READY','\0',NULL,NULL,1,NULL,NULL,41000,NULL,NULL,NULL,0,0,NULL,'','2025-10-14 11:43:07','2025-10-14 11:43:07','user_4','user_4',NULL,NULL,NULL,NULL,NULL,NULL),(174,'GA-ATK-112-118','Stampel PT. Bonecom Tricom','REGULER','PK',13,'INDENT','\0','-','-',1,'-','-',85000,'-','assets/images/1761011226_Screenshot 2025-10-21 084617.png','',0,0,NULL,'','2025-10-21 08:47:06','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(175,'GA-ATK-112-119','Stampel Receiving PCD BTI','REGULER','PK',13,'INDENT','\0','-','-',1,'-','-',225000,'-','assets/images/1761031445_Screenshot 2025-10-21 142336.png','',0,0,NULL,'','2025-10-21 14:24:05','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(176,'GA-ATK-112-120','Stampel Delivery PCD BTI','REGULER','PK',13,'INDENT','\0','-','-',1,'-','-',225000,'-','assets/images/1761031533_Screenshot 2025-10-21 142507.png','',0,0,NULL,'','2025-10-21 14:25:33','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(177,'GA-ATK-112-121','Stampel Security BTI','REGULER','PK',13,'INDENT','\0','-','-',1,'-','-',225000,'-','assets/images/1761031385_Screenshot 2025-10-21 142217.png','',0,0,NULL,'','2025-10-21 14:23:05','2025-10-14 11:43:07','user_4','user_7','Plant 5','Gilang','2025','-','-',NULL),(179,'AC002','Air Conditioner','NON-REGULER','PL',8,'INDENT','\0','Daikin','Putih',12,'2 PK','Split',0,'-','assets/images/1760924599_Ac1pk.png','',0,0,NULL,'','2025-10-21 15:39:49','2025-10-20 08:23:39','user_7','user_7','Plant 5','Gilang','2025','-','-',NULL),(180,'AC001','Air Conditioner','NON-REGULER','PL',8,'INDENT','\0','Daikin','Putih',12,'1 PK','Split',0,'-','assets/images/1760924738_Ac1pk.png','',0,0,NULL,'','2025-10-21 15:39:43','2025-10-20 08:45:38','user_7','user_7','Plant 5','Gilang','2025','-','-',NULL),(181,'MJ002','Meja Kerja','NON-REGULER','PL',8,'INDENT','\0','INDACHI','Cream',12,'-','-',1542000,'-','assets/images/1761035475_Screenshot 2025-10-21 152906.png','',0,0,NULL,'','2025-10-21 15:39:33','2025-10-21 15:31:15','user_7','user_7','Plant 5','Gilang','2025','-','-',NULL),(182,'MJ001','Meja Meeting','NON-REGULER','PL',8,'INDENT','\0','INDACHI','-',12,'-','-',3000000,'-','assets/images/1761035664_Screenshot 2025-10-21 153314.png','',0,0,NULL,'','2025-10-21 15:39:27','2025-10-21 15:34:24','user_7','user_7','Plant 5','Gilang','2025','-','-',NULL),(183,'KR001','Kursi Kerja','NON-REGULER','PL',8,'INDENT','\0','Donati','HItam',12,'-','-',990000,'-','assets/images/1761036542_Screenshot 2025-10-21 154712.png','',0,0,NULL,'','2025-10-21 15:49:02','2025-10-21 15:49:02','user_7',NULL,'Plant 5','Gilang','2025','-','-',NULL),(184,'LM001','Lemari File','NON-REGULER','PL',8,'INDENT','\0','Donati','Cream',12,'-','-',990000,'-','assets/images/1761036746_Screenshot 2025-10-21 155216.png','',0,0,NULL,'','2025-10-21 15:52:26','2025-10-21 15:52:26','user_7',NULL,'Plant 5','Gilang','2025','-','-',NULL),(185,'SL001','Sapu Lantai','REGULER','PL',18,'READY','\0','Dragon','-',1,'-','-',32000,'-','assets/images/1761037330_Screenshot 2025-10-21 160035.png','',5,15,NULL,'','2025-10-27 07:59:11','2025-10-21 16:02:10','user_7','user_7','Plant 5','Gilang','2025','-','-',NULL),(186,'PL001','Pel Lantai','REGULER','PL',18,'READY','\0','Dragon','-',1,'-','-',52000,'-','assets/images/1761526735_Screenshot 2025-10-27 075824.png','',5,15,NULL,'','2025-10-27 07:58:55','2025-10-21 16:10:16','user_7','user_7','Plant 5','Gilang','2025','-','-',NULL),(187,'EM001','Ember','NON-REGULER','PL',18,'INDENT','\0','Lion Star','-',12,'-','-',72000,'-','assets/images/1761038273_Screenshot 2025-10-21 161627.png','',0,0,NULL,'','2025-10-21 16:17:53','2025-10-21 16:17:53','user_7',NULL,'Plant 5','Gilang','2025','-','-',NULL),(189,'PN001','Pengki','REGULER','PL',18,'READY','\0','Lion Star','-',12,'11.5 KG','DP-5',37500,'-','assets/images/1761527046_Screenshot 2025-10-27 080309.png','',5,15,NULL,'','2025-10-27 08:04:06','2025-10-27 08:04:06','user_7',NULL,'Plant 5','Gilang','2025','-','-',NULL),(190,'LD001','Lobby Duster','REGULER','PL',18,'READY','\0','Dragon','Putih',12,'90 cm','MP 233',122000,'-','assets/images/1761527216_Screenshot 2025-10-27 080443.png','',5,15,NULL,'','2025-10-27 08:07:10','2025-10-27 08:06:56','user_7','user_7','Plant 5','Gilang','2025','-','-',NULL),(191,'KC001','Kemoceng','REGULER','PL',18,'READY','\0','-','-',12,'0.1','Plastic',21000,'-','assets/images/1761527366_Screenshot 2025-10-27 080749.png','',5,15,NULL,'','2025-10-27 08:09:26','2025-10-27 08:09:26','user_7',NULL,'Plant 5','Gilang','2025','-','-',NULL);
/*!40000 ALTER TABLE `tbl_mst_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mst_token`
--

DROP TABLE IF EXISTS `tbl_mst_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_mst_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` text DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `approved_by` varchar(100) DEFAULT NULL,
  `approved_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_mst_token_unique` (`token`) USING HASH
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mst_token`
--

LOCK TABLES `tbl_mst_token` WRITE;
/*!40000 ALTER TABLE `tbl_mst_token` DISABLE KEYS */;
INSERT INTO `tbl_mst_token` VALUES (41,'$2y$10$H2MqzbMqOR8fu7m9siG.uOFYW57GqNMOOIkvqcum51d2VnF1jDg7O','ORDER-00002','approved','2025-10-11 07:24:44','2025-10-13 10:30:49',NULL,NULL),(42,'$2y$10$f8U.S4U2ibNe4FqI9owZT.4Px852NC5H6.Zj7nxECH02nfiyL0t2S','ORDER-00001','pending','2025-10-13 11:13:38','2025-10-13 04:13:38',NULL,NULL),(43,'$2y$10$1OmGNVZ4prAAfmu45sXXi.ipsay7LWP9k37/z3zd81VAKyZgQV6GO','ORDER-00001','approved','2025-10-13 11:25:21','2025-10-13 11:26:51',NULL,NULL),(44,'$2y$10$hduUPPurhJoZwwWcm0LTOu5ySB/bOAeh5UBdqB3Drarid1sljNvJK','ORDER-00001','pending','2025-10-16 08:47:43','2025-10-16 01:47:43',NULL,NULL),(45,'$2y$10$Puy1n9zEAk508waDa6IEUuadTu/wWZB.UzkOj4RikEsg2ojPFMHgS','ORDER-00001','approved','2025-10-16 10:37:40','2025-10-16 10:38:46',NULL,NULL),(46,'$2y$10$R5AUDWnFXPGjMmsOu7SgmeZHRh5X5hguuxDKPvB1634nS0bymmAGy','ORDER-00002','approved','2025-10-16 13:28:13','2025-10-16 13:28:43',NULL,NULL),(47,'$2y$10$rJkQizk2xakzwEiqFNz/GOki.zCaCiWa8FkznIKwu8eUbwlyHZA86','ORDER-00003','approved','2025-10-16 13:36:25','2025-10-16 13:37:09',NULL,NULL),(48,'$2y$10$i7y6fven1H.xHrbvxizQn.wKj/tHok1bvBIRAxjP0hZV3tqJoyxDS','ORDER-00004','pending','2025-10-16 16:52:28','2025-10-16 09:52:28',NULL,NULL),(49,'$2y$10$fYfBdxG7D3r0VkwsJ9dXCehOOKMDsy.q/kB/yt04vrxja4Ge1nV3C','ORDER-00004','approved','2025-10-16 16:57:38','2025-10-16 16:58:05',NULL,NULL),(50,'$2y$10$K1PRcseLBpZSXCPOKuDcv.Y1Ir2cKEEGJ0YGbmIAZgB2.CY2pZCs6','ORDER-00005','approved','2025-10-17 09:47:56','2025-10-17 09:48:30',NULL,NULL),(51,'$2y$10$lpCK4rY.DIDRMmpl/E6wguFDIHuTGLVo1lohDdPQK/fxerbIP97Xe','ORDER-00006','approved','2025-10-17 09:50:16','2025-10-17 09:51:19',NULL,NULL),(52,'$2y$10$nBpWBh4xe3kg9PjEw2AZHe3EwLe3dwYkjnR7OCgSBZS2mFuvA./lS','ORDER-00007','approved','2025-10-17 10:16:36','2025-10-17 10:16:53',NULL,NULL),(53,'$2y$10$ml1LqEGWpQ.Av.v/AhssKe..32VifxuEjpwNS36T9kSOFo6R/Khlq','ORDER-00008','pending','2025-10-17 10:18:49','2025-10-17 03:18:49',NULL,NULL),(54,'$2y$10$UHiSw48Wakjafl2ZwcYYROoHojvrhe1m3gyWgt6y4LpEXkkK4dJqO','ORDER-00009','pending','2025-10-17 10:27:26','2025-10-17 03:27:26',NULL,NULL),(55,'$2y$10$71jQgV4ekI7OSaTosDyeru6h.IFDqFpJdhUkupX.lbJdn8ZLPoFE2','ORDER-00010','approved','2025-10-17 10:53:22','2025-10-17 10:54:40',NULL,NULL),(56,'$2y$10$pXGqPAtVWmF./SNmd5rcwuKwT5CHImybMC/zLG1HFHBmrXSsSZ7SW','ORDER-00011','approved','2025-10-17 13:34:05','2025-10-17 13:34:47',NULL,NULL),(57,'$2y$10$MrkbwT4GfuK8JBQYdLPs/eamh910HyYWhqhekwMNn0Sx.GCL/TMYm','ORDER-00012','approved','2025-10-17 13:37:21','2025-10-17 13:40:55',NULL,NULL),(58,'$2y$10$aoVOJtPHUdu2fBc7M5Y96.zOEzVInTAC7RuSulG.oE28n8PlOflLu','ORDER-00013','approved','2025-10-17 13:40:49','2025-10-17 13:41:11',NULL,NULL),(59,'$2y$10$FIDSbNrHCfABJaBQqOo8veXIsWOdc9uBs6OJMbrhb7Ug3JXUD9xyO','ORDER-00014','rejected','2025-10-17 13:43:25','2025-10-17 13:43:40',NULL,NULL),(60,'$2y$10$.wYpVHG1jvtgMEgDh6ko5ui4cmHPC7PwV4XrAzY4OBHO2Qhc97l2e','ORDER-00001','approved','2025-10-17 13:47:44','2025-10-17 13:48:53',NULL,NULL),(61,'$2y$10$51tE.Zrq73NoG5kKuAlcKOnRjDXYCqsKDU6tX8xp1xJx5kULL47sq','ORDER-00002','approved','2025-10-20 11:47:42','2025-10-20 11:48:08',NULL,NULL),(62,'$2y$10$xFIJ2KzkXjv159zuR1Rk5uYzvjNZ3.44K6YPggtD.gXE2gGqNDpH.','ORDER-00003','approved','2025-10-20 13:51:04','2025-10-20 13:52:46',NULL,NULL),(63,'$2y$10$OX.VnuZYmNVXFC3MGdt5O.B1rGTPANN1HdyAzd7BF3TYghP5N38Nm','ORDER-00004','approved','2025-10-23 10:27:43','2025-10-23 10:59:45',NULL,NULL),(64,'$2y$10$CDyx4ZASt/8zcK2FAWOW4.rpcSRhHR/Thn8hU6Sz5u9MWN7G3FKb2','ORDER-00005','rejected','2025-10-23 11:01:37','2025-10-23 11:13:34',NULL,NULL),(65,'$2y$10$yGiB/bOeQYqy3IG4lnq14ebeYluSxpi3GbSsxY2kWfc8hcK5DkfBa','ORDER-00006','approved','2025-10-23 13:19:18','2025-10-23 13:21:57',NULL,NULL),(66,'$2y$10$RKov8bOIAG6pGMrwvxN8fexaKVf/Y/iLoN1qg8/gpbGEu/1nkLSsm','ORDER-00007','approved','2025-10-23 13:32:11','2025-10-23 13:33:19',NULL,NULL),(67,'$2y$10$8WLNwQyrzRJlBmqAJkMoQemQNII3WZ6raK68l6whl7jwVRtGEbw2a','ORDER-00005','pending','2025-10-24 08:00:35','2025-10-24 01:00:35',NULL,NULL),(68,'$2y$10$ihOIdJxx7HqGR2Jt6EtsSOFLLfRiQbogt1zNd3hVk.GoEg08.AigW','ORDER-00008','rejected','2025-10-24 08:37:33','2025-10-24 08:51:07',NULL,NULL),(71,'$2y$10$TUztwN1DRHXYlEgbFOJo8.eKraxCMXEq6WlQc2UXE7lleEcpmzcHq','ORDER-00008','pending','2025-10-24 08:42:56','2025-10-24 01:42:56',NULL,NULL),(73,'$2y$10$G7NRafGqKM9NW6VqNKkiVuvYUMyIUR/bOGwdQXW3lHErsoU3cJFSC','ORDER-00009','rejected','2025-10-24 08:57:17','2025-10-24 08:57:35',NULL,NULL),(82,'$2y$10$.Bz1p.WIL9kKlKt6.dvK8eQL2AnJjU8RNk9x3USz2ZY1jB16vmVpy','ORDER-00010','pending','2025-10-24 09:10:51','2025-10-24 02:10:52',NULL,NULL),(84,'$2y$10$BVJQqJ.4jNLdLN.FERqMm.HRB8BQnQ84dBQmrNohxXQjtVA/KpheC','ORDER-00011','pending','2025-10-24 09:17:54','2025-10-24 02:17:54',NULL,NULL),(89,'$2y$10$217gyeLOCHAw.Idvh4Z81e3LV0gdhC9pwk4GXH22tzUo/MKCbjOX2','ORDER-00010','pending','2025-10-24 09:22:28','2025-10-24 02:22:28',NULL,NULL),(91,'$2y$10$IRYWxAz6ahcssucgC8KkIuhYcU3eiCy8utLDaZL0M2V4qL5C3aY5y','ORDER-00011','rejected','2025-10-24 09:46:40','2025-10-24 09:48:23',NULL,NULL),(92,'$2y$10$NXTvzS1z4W2QzjPpzPW2kuAhQUgR7Dwzvmc50nhKXW2aooy3kBUwe','ORDER-00012','approved','2025-10-24 14:01:39','2025-10-24 14:03:11',NULL,NULL),(93,'$2y$10$8MgGZ42xpt29iubiY48qSeHROfJNgEAxE811ggE3j.J5eduwhTlVa','ORDER-00013','approved','2025-10-24 15:03:20','2025-10-24 15:11:51',NULL,NULL),(107,'$2y$10$xX6Kz2M5rNM/IFyDVgFKtOhLW/1kzPUmhTT5CnGelVSSjMso.Wb6.','ORDER-00010','pending','2025-10-27 08:14:33','2025-10-27 01:14:36',NULL,NULL),(108,'$2y$10$0GS37KgoQ79BqmuO1hFNwe.8.19s39fv/NzfnV1PnGPx9dGMwlPAm','ORDER-00005','pending','2025-10-27 08:16:58','2025-10-27 01:17:01',NULL,NULL),(109,'$2y$10$VVUoKPxOpHhT2behRY1mAuxtiNTPuCb7TT1gnXUVHDeWlwaYYW0Vy','ORDER-00005','pending','2025-10-27 08:18:40','2025-10-27 01:18:43',NULL,NULL);
/*!40000 ALTER TABLE `tbl_mst_token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_trn_stock`
--

DROP TABLE IF EXISTS `tbl_trn_stock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_trn_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `kode_barang` varchar(100) DEFAULT NULL,
  `stock` double DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_trn_stock_unique` (`product_id`),
  UNIQUE KEY `tbl_trn_stock_unique_1` (`kode_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_trn_stock`
--

LOCK TABLES `tbl_trn_stock` WRITE;
/*!40000 ALTER TABLE `tbl_trn_stock` DISABLE KEYS */;
INSERT INTO `tbl_trn_stock` VALUES (27,53,'PEN01',4,'2025-09-29 07:21:14','2025-10-27 08:11:28','user_7','MUSLIKHUN'),(31,55,'SRG-01',5,'2025-10-02 13:51:28','2025-10-17 10:24:45','user_2',NULL),(32,56,'BP03',0,'2025-10-14 03:11:10','2025-10-14 10:11:10',NULL,'import-excel'),(33,57,'GA-ATK-112-001',39,'2025-10-14 04:43:07','2025-10-27 08:22:01','user_7','MUSLIKHUN'),(34,58,'GA-ATK-112-002',-1,'2025-10-14 04:43:07','2025-10-17 09:52:32',NULL,'MUSLIKHUN'),(35,59,'GA-ATK-112-003',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(36,60,'GA-ATK-112-004',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(37,61,'GA-ATK-112-005',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(38,62,'GA-ATK-112-006',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(39,63,'GA-ATK-112-007',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(40,64,'GA-ATK-112-008',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(41,65,'GA-ATK-112-009',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(42,66,'GA-ATK-112-010',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(43,67,'GA-ATK-112-011',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(44,68,'GA-ATK-112-012',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(45,69,'GA-ATK-112-013',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(46,70,'GA-ATK-112-014',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(47,71,'GA-ATK-112-015',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(48,72,'GA-ATK-112-016',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(49,73,'GA-ATK-112-017',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(50,74,'GA-ATK-112-018',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(51,75,'GA-ATK-112-019',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(52,76,'GA-ATK-112-020',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(53,77,'GA-ATK-112-021',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(54,78,'GA-ATK-112-022',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(55,79,'GA-ATK-112-023',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(56,80,'GA-ATK-112-024',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(57,81,'GA-ATK-112-025',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(58,82,'GA-ATK-112-026',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(59,83,'GA-ATK-112-027',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(60,84,'GA-ATK-112-028',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(61,85,'GA-ATK-112-029',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(62,86,'GA-ATK-112-030',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(63,87,'GA-ATK-112-031',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(64,88,'GA-ATK-112-032',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(65,89,'GA-ATK-112-033',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(66,90,'GA-ATK-112-034',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(67,91,'GA-ATK-112-035',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(68,92,'GA-ATK-112-036',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(69,93,'GA-ATK-112-037',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(70,94,'GA-ATK-112-038',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(71,95,'GA-ATK-112-039',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(72,96,'GA-ATK-112-040',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(73,97,'GA-ATK-112-041',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(74,98,'GA-ATK-112-042',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(75,99,'GA-ATK-112-043',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(76,100,'GA-ATK-112-044',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(77,101,'GA-ATK-112-045',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(78,102,'GA-ATK-112-046',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(79,103,'GA-ATK-112-047',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(80,104,'GA-ATK-112-048',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(81,105,'GA-ATK-112-049',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(82,106,'GA-ATK-112-050',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(83,107,'GA-ATK-112-051',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(84,108,'GA-ATK-112-052',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(85,109,'GA-ATK-112-053',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(86,110,'GA-ATK-112-054',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(87,111,'GA-ATK-112-055',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(88,112,'GA-ATK-112-056',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(89,113,'GA-ATK-112-057',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(90,114,'GA-ATK-112-058',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(91,115,'GA-ATK-112-059',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(92,116,'GA-ATK-112-060',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(93,117,'GA-ATK-112-061',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(94,118,'GA-ATK-112-062',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(95,119,'GA-ATK-112-063',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(96,120,'GA-ATK-112-064',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(97,121,'GA-ATK-112-065',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(98,122,'GA-ATK-112-066',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(99,123,'GA-ATK-112-067',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(100,124,'GA-ATK-112-068',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(101,125,'GA-ATK-112-069',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(102,126,'GA-ATK-112-070',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(103,127,'GA-ATK-112-071',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(104,128,'GA-ATK-112-072',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(105,129,'GA-ATK-112-073',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(106,130,'GA-ATK-112-074',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(107,131,'GA-ATK-112-075',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(108,132,'GA-ATK-112-076',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(109,133,'GA-ATK-112-077',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(110,134,'GA-ATK-112-078',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(111,135,'GA-ATK-112-079',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(112,136,'GA-ATK-112-080',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(113,137,'GA-ATK-112-081',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(114,138,'GA-ATK-112-082',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(115,139,'GA-ATK-112-083',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(116,140,'GA-ATK-112-084',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(117,141,'GA-ATK-112-085',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(118,142,'GA-ATK-112-086',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(119,143,'GA-ATK-112-087',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(120,144,'GA-ATK-112-088',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(121,145,'GA-ATK-112-089',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(122,146,'GA-ATK-112-090',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(123,147,'GA-ATK-112-091',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(124,148,'GA-ATK-112-092',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(125,149,'GA-ATK-112-093',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(126,150,'GA-ATK-112-094',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(127,151,'GA-ATK-112-095',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(128,152,'GA-ATK-112-096',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(129,153,'GA-ATK-112-097',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(130,154,'GA-ATK-112-098',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(131,155,'GA-ATK-112-099',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(132,156,'GA-ATK-112-100',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(133,157,'GA-ATK-112-101',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(134,158,'GA-ATK-112-102',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(135,159,'GA-ATK-112-103',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(136,160,'GA-ATK-112-104',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(137,161,'GA-ATK-112-105',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(138,162,'GA-ATK-112-106',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(139,163,'GA-ATK-112-107',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(140,164,'GA-ATK-112-108',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(141,165,'GA-ATK-112-109',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(142,166,'GA-ATK-112-110',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(143,167,'GA-ATK-112-111',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(144,168,'GA-ATK-112-112',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(145,169,'GA-ATK-112-113',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(146,170,'GA-ATK-112-114',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(147,171,'GA-ATK-112-115',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(148,172,'GA-ATK-112-116',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(149,173,'GA-ATK-112-117',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(150,174,'GA-ATK-112-118',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(151,175,'GA-ATK-112-119',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(152,176,'GA-ATK-112-120',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel'),(153,177,'GA-ATK-112-121',0,'2025-10-14 04:43:07','2025-10-14 11:43:07',NULL,'import-excel');
/*!40000 ALTER TABLE `tbl_trn_stock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_trn_adjust`
--

DROP TABLE IF EXISTS `tbl_trn_adjust`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_trn_adjust` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `kode_barang` varchar(100) DEFAULT NULL,
  `type` enum('+','-') DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_trn_adjust_tbl_mst_product_FK` (`product_id`),
  CONSTRAINT `tbl_trn_adjust_tbl_mst_product_FK` FOREIGN KEY (`product_id`) REFERENCES `tbl_mst_product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_trn_adjust`
--

LOCK TABLES `tbl_trn_adjust` WRITE;
/*!40000 ALTER TABLE `tbl_trn_adjust` DISABLE KEYS */;
INSERT INTO `tbl_trn_adjust` VALUES (11,57,'GA-ATK-112-001','+',5,'Inventory Oktober','2025-10-17 00:00:00','2025-10-17 11:22:29','2025-10-17 11:22:29','user_3',NULL);
/*!40000 ALTER TABLE `tbl_trn_adjust` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mst_kategori`
--

DROP TABLE IF EXISTS `tbl_mst_kategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_mst_kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `jenis` enum('R','NR','SO') DEFAULT NULL,
  `is_actived` bit(1) DEFAULT NULL,
  `is_deleted` bit(1) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `updated_by` varchar(100) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_mst_kategori_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mst_kategori`
--

LOCK TABLES `tbl_mst_kategori` WRITE;
/*!40000 ALTER TABLE `tbl_mst_kategori` DISABLE KEYS */;
INSERT INTO `tbl_mst_kategori` VALUES (8,'UMUM','UM','R','','\0',NULL,'2025-08-11 09:25:57','2025-08-11 09:25:57',NULL,'system'),(13,'ATK','ATK','R','','\0',NULL,'2025-10-17 10:43:29','2025-10-17 10:43:29',NULL,'user_3'),(14,'APD','APD','SO','','\0','( Seragam, topi, ID-Card & Sepatu)','2025-10-17 10:43:40','2025-10-17 10:43:40',NULL,'user_3'),(17,'Konsumsi','CON','NR','','\0',NULL,'2025-10-21 14:29:34','2025-10-21 14:29:34',NULL,'user_7'),(18,'Alat- alat Kebersihan','AAK','NR','','\0',NULL,'2025-10-21 14:30:49','2025-10-21 15:23:56','user_7','user_7');
/*!40000 ALTER TABLE `tbl_mst_kategori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_log_transaksi`
--

DROP TABLE IF EXISTS `tbl_log_transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_log_transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `kode_barang` varchar(100) DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `stock_awal` double DEFAULT NULL,
  `stock_akhir` double DEFAULT NULL,
  `name_process` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_log_transaksi_tbl_mst_product_FK` (`product_id`),
  CONSTRAINT `tbl_log_transaksi_tbl_mst_product_FK` FOREIGN KEY (`product_id`) REFERENCES `tbl_mst_product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_log_transaksi`
--

LOCK TABLES `tbl_log_transaksi` WRITE;
/*!40000 ALTER TABLE `tbl_log_transaksi` DISABLE KEYS */;
INSERT INTO `tbl_log_transaksi` VALUES (6,53,'PEN01',1,14,13,'order','-','2025-10-01 13:58:56','2025-10-01 13:58:56','user_3',NULL),(7,55,'SRG-01',2,0,2,'new stock','+','2025-10-02 13:51:28','2025-10-02 13:51:28','user_2',NULL),(8,57,'GA-ATK-112-001',10,0,10,'new stock','+','2025-10-16 07:38:25','2025-10-16 07:38:25','user_7',NULL),(9,57,'GA-ATK-112-001',4,10,6,'order','-','2025-10-16 13:23:21','2025-10-16 13:23:21','user_4',NULL),(10,58,'GA-ATK-112-002',20,0,20,'new stock','+','2025-10-16 13:27:28','2025-10-16 13:27:28','user_4',NULL),(11,53,'PEN01',2,13,15,'new stock','+','2025-10-16 17:50:26','2025-10-16 17:50:26','user_2',NULL),(12,58,'GA-ATK-112-002',10,20,10,'order','-','2025-10-16 18:05:58','2025-10-16 18:05:58','user_2',NULL),(13,58,'GA-ATK-112-002',7,10,3,'order','-','2025-10-17 09:49:02','2025-10-17 09:49:02','user_3',NULL),(14,58,'GA-ATK-112-002',4,3,-1,'order','-','2025-10-17 09:52:32','2025-10-17 09:52:32','user_3',NULL),(15,57,'GA-ATK-112-001',2,6,4,'order','-','2025-10-17 10:17:54','2025-10-17 10:17:54','user_3',NULL),(16,55,'SRG-01',5,0,5,'new stock','+','2025-10-17 10:24:45','2025-10-17 10:24:45','user_3',NULL),(17,57,'GA-ATK-112-001',5,4,9,'adjust','+','2025-10-17 11:22:29','2025-10-17 11:22:29','user_3',NULL),(18,57,'GA-ATK-112-001',3,9,6,'order','-','2025-10-17 13:35:38','2025-10-17 13:35:38','user_2',NULL),(19,57,'GA-ATK-112-001',3,6,3,'order','-','2025-10-17 13:42:10','2025-10-17 13:42:10','user_2',NULL),(20,57,'GA-ATK-112-001',3,3,0,'order','-','2025-10-17 13:44:47','2025-10-17 13:44:47','user_2',NULL),(21,57,'GA-ATK-112-001',50,0,50,'new stock','+','2025-10-17 13:47:02','2025-10-17 13:47:02','user_2',NULL),(22,57,'GA-ATK-112-001',2,50,48,'order','-','2025-10-17 13:49:30','2025-10-17 13:49:30','user_2',NULL),(23,57,'GA-ATK-112-001',2,48,50,'new stock','+','2025-10-17 14:06:57','2025-10-17 14:06:57','user_2',NULL),(24,57,'GA-ATK-112-001',7,50,43,'order','-','2025-10-20 13:54:16','2025-10-20 13:54:16','user_3',NULL),(25,57,'GA-ATK-112-001',1,43,42,'order','-','2025-10-23 13:27:16','2025-10-23 13:27:16','user_3',NULL),(26,57,'GA-ATK-112-001',1,42,41,'order','-','2025-10-24 14:06:26','2025-10-24 14:06:26','user_3',NULL);
/*!40000 ALTER TABLE `tbl_log_transaksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sys_users`
--

DROP TABLE IF EXISTS `tbl_sys_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sys_users` (
  `user_id` varchar(10) NOT NULL,
  `noreg` varchar(100) NOT NULL,
  `password` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `role_id` varchar(100) DEFAULT NULL,
  `level_id` varchar(100) DEFAULT NULL,
  `jabatan_id` varchar(100) DEFAULT NULL,
  `sign` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `updated_by` varchar(100) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `is_actived` bit(1) DEFAULT NULL,
  `is_deleted` bit(1) DEFAULT NULL,
  `special_order` bit(1) DEFAULT b'0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sys_users`
--

LOCK TABLES `tbl_sys_users` WRITE;
/*!40000 ALTER TABLE `tbl_sys_users` DISABLE KEYS */;
INSERT INTO `tbl_sys_users` VALUES ('user_10','2110569','$2y$10$5sF3j6Evw1PrUhuprnYvX.72m2ytdxW1SLHXgyJhCkRVKp5x8hrvK','HQ0VsAA47w53j4fMpzOC7lMUFrxJxLOL9gvPN3E8nWZ1oKAGvSNddK8meefj','Teddy A','admin.PCD@bonecomtricom.co.id',2,'cus','C',NULL,'assets/signatures/2110569_sign_1761182507.png','','2025-10-23 08:21:47','2025-10-23 08:21:47',NULL,'user_3',NULL,NULL,'\0'),('user_11','Dewi Setiawati','$2y$10$vtcLD4cDiM6hr.6wc2Eyce17Dlx3Z3wuXkgKaSjTzr8yjeqb4bVJ.',NULL,'Dewi Setiawati','production02@bonecomtricom.com',56,'cus','C',NULL,'assets/signatures/Dewi Setiawati_sign_1761275333.jpeg','','2025-10-24 10:08:53','2025-10-24 10:08:53',NULL,'user_3',NULL,NULL,'\0'),('user_12','I250209','$2y$10$wVDTzaKgHpV7enkbYLvRKOBiafgZ2H5u/HS2ZeMAhkzOqwjJhbBrG',NULL,'Nadira','qhse@bonecomtricom.com',52,'cus','C',NULL,'assets/signatures/I250209_sign_1761275478.jpeg','','2025-10-24 10:11:18','2025-10-24 10:11:18',NULL,'user_3',NULL,NULL,'\0'),('user_13','2411205','$2y$10$NXbBxYFUEiakcFih/wVROeoGkrDeLE81qonwnNP.Gdw.VQWrsHmw.',NULL,'Dita Rahmayani','tax@bonecomtricom.com',49,'cus','C',NULL,'assets/signatures/2411205_sign_1761275565.jpeg','','2025-10-24 10:12:45','2025-10-24 10:12:45',NULL,'user_3',NULL,NULL,'\0'),('user_14','2112575','$2y$10$69vi5nMa5cg/Xv0XY/6eYe5WyccV7zZ2TDvn5wwLOsOxDWMyOrrJS',NULL,'Novia Andriani','admin.purchasing@bonecomtricom.co.id',48,'cus','C',NULL,'assets/signatures/2112575_sign_1761275790.jpeg','','2025-10-24 10:16:30','2025-10-24 10:16:30',NULL,'user_3',NULL,NULL,'\0'),('user_15','2507116','$2y$10$uyzk/ge5RhriuDClDVPTYequKd.CTPtTmKPpwDfJt7IGd/lRK479W',NULL,'Jessica','marketing@bonecomtricom.com',46,'cus','C',NULL,'assets/signatures/2507116_sign_1761275832.jpeg','','2025-10-24 10:17:12','2025-10-24 10:17:12',NULL,'user_3',NULL,NULL,'\0'),('user_16','I241217','$2y$10$.YtxNz4nMF8/VZ6H9Mq0UO3elEaBkUFro35MT0W4T.eVZ9nWdt8S6',NULL,'Eris T','marketing02@bonecomtricom.com',46,'cus','C',NULL,'assets/signatures/I241217_sign_1761275958.jpeg','','2025-10-24 10:19:18','2025-10-24 10:19:18',NULL,'user_3',NULL,NULL,'\0'),('user_18','2311613','$2y$10$.fbTD5trKR5dxFo8u6eVv.BKA5luo3QgWM5oYs8UJJIOZog4rRF76',NULL,'Yovira','people.development@bonecomtricom.co.id',54,'cus','C',NULL,'assets/signatures/2311613_sign_1761276123.jpeg','','2025-10-24 10:22:04','2025-10-24 10:22:04',NULL,'user_3',NULL,NULL,'\0'),('user_19','2107555','$2y$10$ndk8bKXRS55/NuyKSwyoOeWKuTXYxOJ27g1AXO5Nbka9bnIzEYsB6',NULL,'Yuyun','finance@bonecomtricom.com',49,'cus','C',NULL,'assets/signatures/2107555_sign_1761276202.jpeg','','2025-10-24 10:23:22','2025-10-24 10:23:22',NULL,'user_3',NULL,NULL,'\0'),('user_2','2410220','$2y$10$Tim7soJs.FhkKoLB3ktZx.ope88W5/42AXWO2ntPjnV5k.FRXAkCG','PmEq24A9rbUdAdKZfcBtdWJ7W9HYWbBy30qLinN8TEiWRm8ex87y2JYeqScR','dasep depiyawan','dasepdepiyawan@outlook.com',1,'dev','C','SPV','assets/signatures/2410220_sign_1760670127.png',NULL,'2025-09-09 09:12:16','2025-10-17 10:02:07','user_2','system',NULL,NULL,'\0'),('user_20','I251068','$2y$10$HJtAlGZ4Jmz8tkmR.icScOMJdWnWfbNJ5lLWPZgrENwch7h6HojXa',NULL,'Diah Ayu','admin.engineering@bonecomtricom.com',50,'cus','C',NULL,'assets/signatures/I251068_sign_1761276554.jpeg','','2025-10-24 10:29:14','2025-10-24 10:29:14',NULL,'user_3',NULL,NULL,'\0'),('user_21','2101040','$2y$10$QRp1UlQhK74IFR/C1U67s.V/jRbIby2Pjknyym1mvNjBXX.RT7c/q',NULL,'Siti','hrd@bonecomtricom.com',54,'cus','C',NULL,'assets/signatures/2101040_sign_1761276650.jpeg','','2025-10-24 10:30:50','2025-10-24 10:30:50',NULL,'user_3',NULL,NULL,'\0'),('user_22','1609265','$2y$10$UyRs09/xVvvomN2B3xnmCugVMbv2bOnUi0HAQUT.La6k7jylcBd/q',NULL,'Rizqi Firmansyah','rizqi.firmansyah@bonecomtricom.com',42,'cus','A',NULL,'assets/signatures/1609265_sign_1761277025.jpeg','','2025-10-24 10:37:05','2025-10-24 10:37:05',NULL,'user_3',NULL,NULL,'\0'),('user_23','1306014','$2y$10$ety00D2kK1X5DoYfd3VoBOPnPGHTvIbnWG2/iok12eKqwb8aL/bLe',NULL,'Eri Ridwan','eri@bonecomtricom.com',2,'cus','A',NULL,'assets/signatures/1306014_sign_1761277937.jpeg','','2025-10-24 10:52:17','2025-10-24 10:52:17',NULL,'user_3',NULL,NULL,'\0'),('user_24','2103531','$2y$10$x0Ys.DaslOrQjnp6QbwwHOULZPXOx5CTgu7bJ.vZYXiM5NPUZM0yK',NULL,'Nurwahid Diono','nurwahid@bonecomtricom.com',56,'cus','A',NULL,'assets/signatures/2103531_sign_1761278083.jpeg','','2025-10-24 10:54:43','2025-10-24 10:54:43',NULL,'user_3',NULL,NULL,'\0'),('user_25','1704336','$2y$10$AuQbxmTUtY3ynHduGozcOOsh2TJ1Wk1DwoDtDQCJizAKSpoGyYeBu',NULL,'Junaidi Ilham','ilham@bonecomtricom.com',52,'cus','A',NULL,'assets/signatures/1704336_sign_1761278193.jpeg','','2025-10-24 10:56:33','2025-10-24 10:56:33',NULL,'user_3',NULL,NULL,'\0'),('user_26','1804424','$2y$10$0jfQ4tORs.xcw2hMNtxAX.JxAAD2TNunf3Ly0m1UXT7s1E3zIThfm',NULL,'Dwi Ramadhan','dwi.ramadhan@bonecomtricom.com',49,'cus','A',NULL,'assets/signatures/1804424_sign_1761278471.jpeg','','2025-10-24 11:01:11','2025-10-24 11:01:11',NULL,'user_3',NULL,NULL,'\0'),('user_27','1610275','$2y$10$eQrH7KNDqUE2Fdm9PYXMveVaC4xPAsn5cRTTfBoj2nLv1nu2wgXSe',NULL,'Azis Andriana','purchasing01@bonecomtricom.com',48,'cus','A',NULL,'assets/signatures/1610275_sign_1761278543.jpeg','','2025-10-24 11:02:23','2025-10-24 11:02:23',NULL,'user_3',NULL,NULL,'\0'),('user_28','2110564','$2y$10$zh7XKqPUZ5kmWCj3LjGM6.IWxA8C2nPGS.bplrTNbgOA.dNGog4e.',NULL,'Bambang Irawan','bambang.irawan@bonecomtricom.com',54,'cus','A',NULL,'assets/signatures/2110564_sign_1761278981.jpeg','','2025-10-24 11:09:41','2025-10-24 11:09:41',NULL,'user_3',NULL,NULL,'\0'),('user_29','1312012','$2y$10$5CzBhn/RrauQmn2hfuUBKexeahtUS.Smuho/QbSwmVc7dyKxQ.KOS',NULL,'Oktaviana Nur','nur@bonecomtricom.com',49,'cus','A',NULL,'assets/signatures/1312012_sign_1761279098.jpeg','','2025-10-24 11:11:38','2025-10-24 11:45:38','user_3','user_3',NULL,NULL,'\0'),('user_3','2203613','$2y$10$/7Zl55SVe4T9mbpM8BuHBu.Q36k9fTx6.HxD66bZEGgkwV4JZqHQG','lnq78dYcxK1CJps76v14rKbEKd2Xx1TFYbDtG5hiQwDkL68VfkGe7RLI3NtG','MUSLIKHUN','muse.jr07@gmail.com',1,'adm','A','STF','assets/signatures/2203613_sign_1760756416.png','assets/images/users/2203613_photo_1760325470.jpeg','2025-10-01 11:38:57','2025-10-18 10:00:16','user_3','user_2',NULL,NULL,''),('user_30','1609266','$2y$10$O7dEjpa7s9bfwjsm4YrALOKhz.JKnMXWZViH4caHRGxrXrrmDzzy6',NULL,'Yogi Anggri S','yogi@bonecomtricom.com',50,'cus','A',NULL,'assets/signatures/1609266_sign_1761279258.jpeg','','2025-10-24 11:14:18','2025-10-24 11:14:18',NULL,'user_3',NULL,NULL,'\0'),('user_31','2502089','$2y$10$ihzgr/Xk.vihTknYIye8CuXYXrWSA34l436c2ZXaNssO8iWz5IK4C',NULL,'Ardiyanto','production@ravalia.co.id',62,'cus','A',NULL,'assets/signatures/2502089_sign_1761279817.jpeg','','2025-10-24 11:23:37','2025-10-27 07:29:20','user_3','user_3',NULL,NULL,'\0'),('user_32','2411147','$2y$10$ZpkuR993cNFEmjO1czlbJegPIwQ8JIiJP6D352wgA7EmAIjqw2psC',NULL,'Arief','pcd01@ravalia.co.id',63,'cus','A',NULL,'assets/signatures/2411147_sign_1761279912.jpeg','','2025-10-24 11:25:12','2025-10-27 07:27:48','user_3','user_3',NULL,NULL,'\0'),('user_33','2003503','$2y$10$41I/Cz.A.urHB/kFW4/rn..gz4VSRuXgsr48dQnXux4B2ARs9acPy',NULL,'Nugroho Abdi','pcd.ppn02@bonecomtricom.com',63,'cus','A',NULL,'assets/signatures/2003503_sign_1761280125.jpeg','','2025-10-24 11:28:45','2025-10-27 07:26:23','user_3','user_3',NULL,NULL,'\0'),('user_34','2006507','$2y$10$Lfp6YwD4IKbl9C9EGYLYbOK0Eo6UZGlJlB1N/Qd2hdMUnUIyD0itS',NULL,'Apriyanto Nur A','apriyanto@btipaintech.com',58,'cus','A',NULL,'assets/signatures/2006507_sign_1761280237.jpeg','','2025-10-24 11:30:37','2025-10-27 07:26:43','user_3','user_3',NULL,NULL,'\0'),('user_35','1605235','$2y$10$5.Xj4dcpoarvf19lyOmRcegjP9gybW5q0cD9TULJ0LF3DZGQgj7na',NULL,'Ariyanto','arijhunnot@yahoo.com',59,'cus','A',NULL,'assets/signatures/1605235_sign_1761280321.jpeg','','2025-10-24 11:32:01','2025-10-27 07:25:11','user_3','user_3',NULL,NULL,'\0'),('user_36','1307015','$2y$10$2tLEC/0qWNVCbErHSGlolOCaS.sxF1G40ba8sZC3yfTQatJB.fGyC',NULL,'Egi Setiawan','egi@btipaintech.com',60,'cus','A',NULL,'assets/signatures/1307015_sign_1761280361.jpeg','','2025-10-24 11:32:41','2025-10-27 07:24:49','user_3','user_3',NULL,NULL,'\0'),('user_37','1401050','$2y$10$srDe0526Rtj6QNXFH5wrE.XwApiGkZjzJj5Q.3iDS5S21cxwDKd1O',NULL,'Nur Agus','nuragus@btipaintech.com',59,'cus','A',NULL,'assets/signatures/1401050_sign_1761280664.jpeg','','2025-10-24 11:37:44','2025-10-27 07:28:16','user_3','user_3',NULL,NULL,'\0'),('user_38','P250102','$2y$10$cqDPKInKI.3dg1I3b2uMQ.0xYxs2Dct5GwhDV8lAxdAH9tqY3SxZO',NULL,'Wulan Ayu','admin.qa@btipaintech.com',58,'cus','C',NULL,'assets/signatures/P250102_sign_1761280769.jpeg','','2025-10-24 11:39:29','2025-10-24 11:39:29',NULL,'user_3',NULL,NULL,'\0'),('user_39','P250856','$2y$10$o7lnWxgnnzWfhaY4DeHdPOjGgDxuTxQ8j56yOP0dyDtbYDzbIZtOC',NULL,'Iin Parhiyah','pcd@btipaintech.com',60,'cus','A',NULL,'assets/signatures/P250856_sign_1761280836.jpeg','','2025-10-24 11:40:36','2025-10-24 11:40:36',NULL,'user_3',NULL,NULL,'\0'),('user_4','2504095','$2y$10$7WSc0tJBPro6G/q.wpNwXeB3Mg8EcnhEcdeY4rDEcOJaNmf6fT/Gi','GzAlJdMYfQpwS1p83RjgM5FWExa2AADKc7KcRnYAdL2jEBSa0wYQlpgJ3yFt','Asnawi','generalaffair02@bonecomtricom.com',44,'adm','A','STF',NULL,'','2025-10-14 11:12:28','2025-10-14 11:27:51','user_3','user_3',NULL,NULL,'\0'),('user_40','P241023','$2y$10$YX7lPebG52EWAzyvOEuve.K5Z8iqyBL4RBgCzUQCcZYpBpInAdcui',NULL,'Aisyah','production@btipaintech.com',59,'cus','C',NULL,'assets/signatures/P241023_sign_1761280927.jpeg','','2025-10-24 11:42:07','2025-10-24 11:42:07',NULL,'user_3',NULL,NULL,'\0'),('user_41','I250431','$2y$10$oZniBL4USUzlHOko.XU.fePruZXWqsvnLZvZKU9pDoloQ51e2XVES',NULL,'Melly Marcelia Aziza','mellymarceliaaziza@gmail.com',51,'cus','C',NULL,'assets/signatures/I250431_sign_1761287006.jpeg','','2025-10-24 13:23:26','2025-10-24 13:23:26',NULL,'user_3',NULL,NULL,'\0'),('user_5','2503093','$2y$10$UTPw.vxc4lLlvaS2gy6ZCuxU24yKpfNnaD2LeI2uO3nqXufG57ZUS','jxlKsk3x27Wos7bfFu1kFHDnhfbppFnkmHaakNiru8ijaVbnRRDvKOIIAYa0','Amelia Rossa','admin.it@bonecomtricom.com',1,'cus','C',NULL,'assets/signatures/2503093_sign_1760756305.png','','2025-10-15 08:07:52','2025-10-18 09:59:36','user_3','user_3',NULL,NULL,'\0'),('user_6','2302113','$2y$10$fI6/C2/XODezx.q4SPlZiOZtjoFbpRsoK9oh9K3jDdpinYr9yssDu',NULL,'Ahmad Febri Hartanto','depiyawandasep13@gmail.com',1,'cus','A',NULL,'assets/signatures/2302113_sign_1760756396.png','','2025-10-15 15:14:46','2025-10-18 09:59:56','user_3','user_2',NULL,NULL,'\0'),('user_7','2407129','$2y$10$P3XHSAffNfY4AQK9eAE9E.zeUDi7PBLtqMhrPv8aBcofZHrywiF76','8I0WKKYHo7aQCb0moI9oLqN1YUJVOrl7HJt9V1cOpCRA3dfNaHr87m6b0pcu','Gilang Pakusadewo','gilangpakusadewo98@gmail.com',44,'adm','A',NULL,'assets/signatures/2407129_sign_1760685608.png','','2025-10-16 07:28:20','2025-10-17 14:20:08','user_2','user_3',NULL,NULL,''),('user_8','2502050','$2y$10$MV2SslAwAwf.XRu0e8YRv.e1CjFlSBVb9VtvZMVzjAd8rX2GEKmMa',NULL,'Amirul Hakim','admin.quality@bonecomtricom.co.id',3,'cus','C',NULL,'assets/signatures/2502050_sign_1761182121.png','','2025-10-23 08:15:21','2025-10-23 08:15:21',NULL,'user_3',NULL,NULL,'\0'),('user_9','2204620','$2y$10$Jr2XDlRKRRsQeEHf/q6hJe1T1XgewMLwwteJ4XMmSEPylL7.RfqhW',NULL,'Afif A','maintenance02@bonecomtricom.co.id',43,'cus','C',NULL,'assets/signatures/2204620_sign_1761182647.png','','2025-10-23 08:17:49','2025-10-23 08:24:07','user_3','user_3',NULL,NULL,'\0');
/*!40000 ALTER TABLE `tbl_sys_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sys_menu`
--

DROP TABLE IF EXISTS `tbl_sys_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sys_menu` (
  `menu_id` varchar(10) NOT NULL,
  `parent_menu` varchar(100) DEFAULT NULL,
  `menu` varchar(100) DEFAULT NULL,
  `level` enum('root','menu','submenu','subsubmenu') DEFAULT NULL,
  `controller` varchar(100) DEFAULT NULL,
  `function` varchar(100) DEFAULT NULL,
  `parameters` varchar(100) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `is_actived` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `updated_by` varchar(100) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sys_menu`
--

LOCK TABLES `tbl_sys_menu` WRITE;
/*!40000 ALTER TABLE `tbl_sys_menu` DISABLE KEYS */;
INSERT INTO `tbl_sys_menu` VALUES ('MN-0001','*','Dashboard','root','',NULL,NULL,'home','home',1,1,0,'2025-09-09 10:56:34','2025-09-09 10:56:34',NULL,NULL),('MN-0002','*','Database','menu','',NULL,NULL,'database',NULL,2,1,0,'2025-09-09 10:56:34','2025-09-09 10:56:34',NULL,NULL),('MN-0002A','MN-0002','Master','submenu','',NULL,NULL,NULL,NULL,3,1,0,'2025-09-09 10:56:34','2025-09-09 10:56:34',NULL,NULL),('MN-0002AA','MN-0002A','Master Department','subsubmenu','',NULL,NULL,NULL,'departments',4,1,0,'2025-09-09 10:56:34','2025-09-09 10:56:34',NULL,NULL),('MN-0002AB','MN-0002A','Master Kategori','subsubmenu','',NULL,NULL,NULL,'kategori',5,1,0,'2025-09-09 10:56:34','2025-09-09 10:56:34',NULL,NULL),('MN-0002AC','MN-0002A','Master Unit','subsubmenu','',NULL,NULL,NULL,'units',6,1,0,'2025-09-09 10:56:34','2025-09-09 10:56:34',NULL,NULL),('MN-0002AD','MN-0002A','Jenis Asset','subsubmenu','',NULL,NULL,NULL,'jenis-asset',6,1,0,'2025-09-09 10:56:34','2025-09-09 10:56:34',NULL,NULL),('MN-0002B','MN-0002','Barang','submenu','',NULL,NULL,NULL,NULL,7,1,0,'2025-09-09 10:56:34','2025-09-09 10:56:34',NULL,NULL),('MN-0002BA','MN-0002B','Master Barang','subsubmenu','',NULL,NULL,NULL,'product',8,1,0,'2025-09-09 10:56:34','2025-09-09 10:56:34',NULL,NULL),('MN-0003','*','Transaction','menu','',NULL,NULL,'shopping-cart',NULL,9,1,0,'2025-09-09 10:56:34','2025-09-09 10:56:34',NULL,NULL),('MN-0003A','MN-0003','Permintaan Barang','submenu','',NULL,NULL,NULL,NULL,10,1,0,'2025-09-09 10:56:34','2025-09-09 10:56:34',NULL,NULL),('MN-0003AA','MN-0003A','List Request','subsubmenu','',NULL,NULL,NULL,'pengadaan',11,1,0,'2025-09-09 10:56:34','2025-09-09 10:56:34',NULL,NULL),('MN-0003B','MN-0003','Stock','submenu','',NULL,NULL,NULL,NULL,12,1,0,'2025-09-09 10:56:34','2025-09-09 10:56:34',NULL,NULL),('MN-0003BA','MN-0003B','Input Stock','subsubmenu','',NULL,NULL,NULL,'inputstock',13,1,0,'2025-09-09 10:56:34','2025-09-09 10:56:34',NULL,NULL),('MN-0003BB','MN-0003B','List Stock','subsubmenu','',NULL,NULL,NULL,'stock',14,1,0,'2025-09-09 10:56:34','2025-09-09 10:56:34',NULL,NULL),('MN-0003BC','MN-0003B','Adjust Stock','subsubmenu','',NULL,NULL,NULL,'adjuststock',14,1,0,'2025-09-09 10:56:34','2025-09-09 10:56:34',NULL,NULL),('MN-0004','*','Reporting','menu','',NULL,NULL,'file',NULL,15,1,0,'2025-09-09 10:56:34','2025-09-09 10:56:34',NULL,NULL),('MN-0004A','MN-0004','Order','subsubmenu','',NULL,NULL,'','reportorder',16,1,0,'2025-09-09 10:56:34','2025-09-09 10:56:34',NULL,NULL),('MN-0004B','MN-0004','Beli','subsubmenu','',NULL,NULL,'','reportbeli',17,1,0,'2025-09-09 10:56:34','2025-09-09 10:56:34',NULL,NULL),('MN-0020','*','Settings','menu','',NULL,NULL,'settings',NULL,18,1,0,'2025-09-09 10:56:34','2025-09-09 10:56:34',NULL,NULL),('MN-0020A','MN-0020','Roles Apps','submenu','',NULL,NULL,NULL,'roles',19,1,0,'2025-09-09 10:56:34','2025-09-09 10:56:34',NULL,NULL),('MN-0020B','MN-0020','User Account','submenu','',NULL,NULL,NULL,'users',20,1,0,'2025-09-09 10:56:34','2025-09-09 10:56:34',NULL,NULL);
/*!40000 ALTER TABLE `tbl_sys_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sys_role_access`
--

DROP TABLE IF EXISTS `tbl_sys_role_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sys_role_access` (
  `role_id` varchar(100) NOT NULL,
  `menu_id` varchar(100) NOT NULL,
  `is_actived` bit(1) DEFAULT b'1',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`role_id`,`menu_id`),
  KEY `tbl_sys_role_access_tbl_sys_menu_FK` (`menu_id`),
  CONSTRAINT `tbl_sys_role_access_tbl_sys_menu_FK` FOREIGN KEY (`menu_id`) REFERENCES `tbl_sys_menu` (`menu_id`),
  CONSTRAINT `tbl_sys_role_access_tbl_sys_role_FK` FOREIGN KEY (`role_id`) REFERENCES `tbl_sys_role` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sys_role_access`
--

LOCK TABLES `tbl_sys_role_access` WRITE;
/*!40000 ALTER TABLE `tbl_sys_role_access` DISABLE KEYS */;
INSERT INTO `tbl_sys_role_access` VALUES ('adm','MN-0001','','2025-10-01 04:32:32','2025-10-01 04:32:32',NULL,NULL),('adm','MN-0002','','2025-10-01 04:32:32','2025-10-01 04:32:32',NULL,NULL),('adm','MN-0002A','','2025-10-01 04:32:32','2025-10-01 04:32:32',NULL,NULL),('adm','MN-0002AA','','2025-10-01 04:32:32','2025-10-01 04:32:32',NULL,NULL),('adm','MN-0002AB','','2025-10-01 04:32:32','2025-10-01 04:32:32',NULL,NULL),('adm','MN-0002AC','','2025-10-01 04:32:32','2025-10-01 04:32:32',NULL,NULL),('adm','MN-0002AD','','2025-10-01 04:32:32','2025-10-01 04:32:32',NULL,NULL),('adm','MN-0002B','','2025-10-01 04:32:32','2025-10-01 04:32:32',NULL,NULL),('adm','MN-0002BA','','2025-10-01 04:32:32','2025-10-01 04:32:32',NULL,NULL),('adm','MN-0003','','2025-10-01 04:32:32','2025-10-01 04:32:32',NULL,NULL),('adm','MN-0003A','','2025-10-01 04:32:32','2025-10-01 04:32:32',NULL,NULL),('adm','MN-0003AA','','2025-10-01 04:32:32','2025-10-01 04:32:32',NULL,NULL),('adm','MN-0003B','','2025-10-01 04:32:32','2025-10-01 04:32:32',NULL,NULL),('adm','MN-0003BA','','2025-10-01 04:32:32','2025-10-01 04:32:32',NULL,NULL),('adm','MN-0003BB','','2025-10-01 04:32:32','2025-10-01 04:32:32',NULL,NULL),('adm','MN-0003BC','','2025-10-01 04:32:32','2025-10-01 04:32:32',NULL,NULL),('adm','MN-0004','','2025-10-01 04:32:32','2025-10-01 04:32:32',NULL,NULL),('adm','MN-0004A','','2025-10-01 04:32:32','2025-10-01 04:32:32',NULL,NULL),('adm','MN-0004B','','2025-10-01 04:32:32','2025-10-01 04:32:32',NULL,NULL),('adm','MN-0020','','2025-10-01 04:32:32','2025-10-01 04:32:32',NULL,NULL),('adm','MN-0020A','','2025-10-01 04:32:32','2025-10-01 04:32:32',NULL,NULL),('adm','MN-0020B','','2025-10-01 04:32:32','2025-10-01 04:32:32',NULL,NULL),('cus','MN-0001','','2025-09-12 07:00:00','2025-09-12 09:58:31',NULL,NULL),('cus','MN-0002','\0','2025-09-12 07:00:00','2025-09-12 09:58:31',NULL,NULL),('cus','MN-0002A','\0','2025-09-12 10:22:26','2025-09-12 10:22:26',NULL,NULL),('cus','MN-0002AA','\0','2025-09-12 10:42:06','2025-09-12 10:42:06',NULL,NULL),('cus','MN-0002AB','\0','2025-09-12 11:00:59','2025-09-12 11:00:59',NULL,NULL),('cus','MN-0002AC','\0','2025-09-12 11:00:59','2025-09-12 11:00:59',NULL,NULL),('cus','MN-0002AD','\0','2025-09-12 11:00:59','2025-09-12 11:00:59',NULL,NULL),('cus','MN-0002B','\0','2025-09-12 11:00:59','2025-09-12 11:00:59',NULL,NULL),('cus','MN-0002BA','\0','2025-09-12 11:00:59','2025-09-12 11:00:59',NULL,NULL),('dev','MN-0001','','2025-09-12 07:00:00','2025-09-12 07:00:00',NULL,NULL),('dev','MN-0002','','2025-09-12 07:00:00','2025-09-12 07:00:00',NULL,NULL),('dev','MN-0002A','','2025-09-12 07:00:00','2025-09-12 07:00:00',NULL,NULL),('dev','MN-0002AA','','2025-09-12 07:00:00','2025-09-12 07:00:00',NULL,NULL),('dev','MN-0002AB','','2025-09-12 07:00:00','2025-09-12 07:00:00',NULL,NULL),('dev','MN-0002AC','','2025-09-12 07:00:00','2025-09-12 07:00:00',NULL,NULL),('dev','MN-0002AD','','2025-09-12 07:00:00','2025-09-12 07:00:00',NULL,NULL),('dev','MN-0002B','','2025-09-12 07:00:00','2025-09-12 07:00:00',NULL,NULL),('dev','MN-0002BA','','2025-09-12 07:00:00','2025-09-12 07:00:00',NULL,NULL),('dev','MN-0003','','2025-09-12 07:00:00','2025-09-12 07:00:00',NULL,NULL),('dev','MN-0003A','','2025-09-12 07:00:00','2025-09-12 07:00:00',NULL,NULL),('dev','MN-0003AA','','2025-09-12 07:00:00','2025-09-12 07:00:00',NULL,NULL),('dev','MN-0003B','','2025-09-12 07:00:00','2025-09-12 07:00:00',NULL,NULL),('dev','MN-0003BA','','2025-09-12 07:00:00','2025-09-12 07:00:00',NULL,NULL),('dev','MN-0003BB','','2025-09-12 07:00:00','2025-09-12 07:00:00',NULL,NULL),('dev','MN-0003BC','','2025-09-30 11:23:47','2025-09-30 11:23:47',NULL,NULL),('dev','MN-0004','','2025-09-12 07:00:00','2025-09-12 07:00:00',NULL,NULL),('dev','MN-0004A','','2025-09-12 07:00:00','2025-09-12 07:00:00',NULL,NULL),('dev','MN-0004B','','2025-09-12 07:00:00','2025-09-12 07:00:00',NULL,NULL),('dev','MN-0020','','2025-09-12 07:00:00','2025-09-12 07:00:00',NULL,NULL),('dev','MN-0020A','','2025-09-12 07:00:00','2025-09-12 07:00:00',NULL,NULL),('dev','MN-0020B','','2025-09-12 07:00:00','2025-09-12 07:00:00',NULL,NULL),('IT','MN-0001','','2025-10-16 11:40:39','2025-10-16 11:40:39',NULL,NULL);
/*!40000 ALTER TABLE `tbl_sys_role_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_trn_orders_fail`
--

DROP TABLE IF EXISTS `tbl_trn_orders_fail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_trn_orders_fail` (
  `order_id` varchar(100) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `department_id` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `updated_by` varchar(100) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_trn_orders_fail`
--

LOCK TABLES `tbl_trn_orders_fail` WRITE;
/*!40000 ALTER TABLE `tbl_trn_orders_fail` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_trn_orders_fail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mst_jenis_asset`
--

DROP TABLE IF EXISTS `tbl_mst_jenis_asset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_mst_jenis_asset` (
  `kode_asset` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `is_actived` bit(1) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp(),
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`kode_asset`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mst_jenis_asset`
--

LOCK TABLES `tbl_mst_jenis_asset` WRITE;
/*!40000 ALTER TABLE `tbl_mst_jenis_asset` DISABLE KEYS */;
INSERT INTO `tbl_mst_jenis_asset` VALUES ('PK','PERLENGKAPAN','','2025-09-11 11:02:51',NULL,'2025-09-11 11:11:24','system'),('PL','PERALATAN','','2025-09-11 11:02:51',NULL,'2025-09-11 11:02:51',NULL),('PS','PERSEDIAAN','','2025-09-11 11:02:51',NULL,'2025-09-11 11:02:51',NULL);
/*!40000 ALTER TABLE `tbl_mst_jenis_asset` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_trn_beli`
--

DROP TABLE IF EXISTS `tbl_trn_beli`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_trn_beli` (
  `transaction_id` varchar(100) NOT NULL,
  `no_po` varchar(255) DEFAULT NULL,
  `tanggal_beli` datetime DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `harga_satuan` double DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `updated_by` varchar(100) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `supplier` varchar(100) DEFAULT NULL,
  `harga_total` double DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_trn_beli`
--

LOCK TABLES `tbl_trn_beli` WRITE;
/*!40000 ALTER TABLE `tbl_trn_beli` DISABLE KEYS */;
INSERT INTO `tbl_trn_beli` VALUES ('BELI_00001',NULL,'2025-10-17 00:00:00',57,50,1000,'2025-10-17 13:47:01','2025-10-17 13:47:01',NULL,'user_2',NULL,50000,'done',NULL);
/*!40000 ALTER TABLE `tbl_trn_beli` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sys_role`
--

DROP TABLE IF EXISTS `tbl_sys_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sys_role` (
  `role_id` varchar(100) NOT NULL,
  `name_role` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp(),
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sys_role`
--

LOCK TABLES `tbl_sys_role` WRITE;
/*!40000 ALTER TABLE `tbl_sys_role` DISABLE KEYS */;
INSERT INTO `tbl_sys_role` VALUES ('adm','Admin','2025-09-09 07:19:20','system','2025-10-01 11:32:32','system'),('cus','Customer','2025-09-09 07:19:29','system','2025-10-01 11:32:46','system'),('dev','Developer','2025-09-09 07:19:36','system','2025-09-30 11:23:47','system'),('IT','Information','2025-10-16 18:40:39','system','2025-10-16 18:40:39',NULL);
/*!40000 ALTER TABLE `tbl_sys_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sys_user_role_access`
--

DROP TABLE IF EXISTS `tbl_sys_user_role_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sys_user_role_access` (
  `user_id` varchar(100) NOT NULL,
  `role_id` varchar(100) NOT NULL,
  `menu_id` varchar(100) NOT NULL,
  `is_create` bit(1) NOT NULL DEFAULT b'1',
  `is_delete` bit(1) NOT NULL DEFAULT b'1',
  `is_update` bit(1) NOT NULL DEFAULT b'1',
  `is_read` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`user_id`,`role_id`,`menu_id`),
  KEY `tbl_sys_user_role_access_tbl_sys_role_access_FK` (`role_id`,`menu_id`),
  CONSTRAINT `tbl_sys_user_role_access_tbl_sys_role_access_FK` FOREIGN KEY (`role_id`, `menu_id`) REFERENCES `tbl_sys_role_access` (`role_id`, `menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sys_user_role_access`
--

LOCK TABLES `tbl_sys_user_role_access` WRITE;
/*!40000 ALTER TABLE `tbl_sys_user_role_access` DISABLE KEYS */;
INSERT INTO `tbl_sys_user_role_access` VALUES ('user_1','dev','MN-0001','','','',''),('user_1','dev','MN-0002','','','',''),('user_1','dev','MN-0002A','','','',''),('user_1','dev','MN-0002AA','','','',''),('user_1','dev','MN-0002AB','','','',''),('user_1','dev','MN-0002AC','','','',''),('user_1','dev','MN-0002AD','','','',''),('user_1','dev','MN-0002B','','','',''),('user_1','dev','MN-0002BA','','','',''),('user_1','dev','MN-0003','','','',''),('user_1','dev','MN-0003A','','','',''),('user_1','dev','MN-0003AA','','','',''),('user_1','dev','MN-0003B','','','',''),('user_1','dev','MN-0003BA','','','',''),('user_1','dev','MN-0003BB','','','',''),('user_1','dev','MN-0004','','','',''),('user_1','dev','MN-0004A','','','',''),('user_1','dev','MN-0004B','','','',''),('user_1','dev','MN-0020','','','',''),('user_1','dev','MN-0020A','','','',''),('user_1','dev','MN-0020B','','','',''),('user_10','cus','MN-0001','\0','\0','\0','\0'),('user_11','cus','MN-0001','\0','\0','\0','\0'),('user_12','cus','MN-0001','\0','\0','\0','\0'),('user_13','cus','MN-0001','\0','\0','\0','\0'),('user_14','cus','MN-0001','\0','\0','\0','\0'),('user_15','cus','MN-0001','\0','\0','\0','\0'),('user_16','cus','MN-0001','\0','\0','\0','\0'),('user_17','cus','MN-0001','\0','\0','\0','\0'),('user_18','cus','MN-0001','\0','\0','\0','\0'),('user_19','cus','MN-0001','\0','\0','\0','\0'),('user_2','dev','MN-0001','','','',''),('user_2','dev','MN-0002','','','',''),('user_2','dev','MN-0002A','','','',''),('user_2','dev','MN-0002AA','','','',''),('user_2','dev','MN-0002AB','','','',''),('user_2','dev','MN-0002AC','','','',''),('user_2','dev','MN-0002AD','','','',''),('user_2','dev','MN-0002B','','','',''),('user_2','dev','MN-0002BA','','','',''),('user_2','dev','MN-0003','','','',''),('user_2','dev','MN-0003A','','','',''),('user_2','dev','MN-0003AA','','','',''),('user_2','dev','MN-0003B','','','',''),('user_2','dev','MN-0003BA','','','',''),('user_2','dev','MN-0003BB','','','',''),('user_2','dev','MN-0003BC','','','',''),('user_2','dev','MN-0004','','','',''),('user_2','dev','MN-0004A','','','',''),('user_2','dev','MN-0004B','','','',''),('user_2','dev','MN-0020','','','',''),('user_2','dev','MN-0020A','','','',''),('user_2','dev','MN-0020B','','','',''),('user_20','cus','MN-0001','\0','\0','\0','\0'),('user_21','cus','MN-0001','\0','\0','\0','\0'),('user_22','cus','MN-0001','\0','\0','\0','\0'),('user_23','cus','MN-0001','\0','\0','\0','\0'),('user_24','cus','MN-0001','\0','\0','\0','\0'),('user_25','cus','MN-0001','\0','\0','\0','\0'),('user_26','cus','MN-0001','\0','\0','\0','\0'),('user_27','cus','MN-0001','\0','\0','\0','\0'),('user_28','cus','MN-0001','\0','\0','\0','\0'),('user_29','cus','MN-0001','\0','\0','\0','\0'),('user_3','adm','MN-0001','','','',''),('user_3','adm','MN-0002','','','',''),('user_3','adm','MN-0002A','','','',''),('user_3','adm','MN-0002AA','','','',''),('user_3','adm','MN-0002AB','','','',''),('user_3','adm','MN-0002AC','','','',''),('user_3','adm','MN-0002AD','','','',''),('user_3','adm','MN-0002B','','','',''),('user_3','adm','MN-0002BA','','','',''),('user_3','adm','MN-0003','','','',''),('user_3','adm','MN-0003A','','','',''),('user_3','adm','MN-0003AA','','','',''),('user_3','adm','MN-0003B','','','',''),('user_3','adm','MN-0003BA','','','',''),('user_3','adm','MN-0003BB','','','',''),('user_3','adm','MN-0003BC','','','',''),('user_3','adm','MN-0004','','','',''),('user_3','adm','MN-0004A','','','',''),('user_3','adm','MN-0004B','','','',''),('user_3','adm','MN-0020','','','',''),('user_3','adm','MN-0020A','','','',''),('user_3','adm','MN-0020B','','','',''),('user_30','cus','MN-0001','\0','\0','\0','\0'),('user_31','cus','MN-0001','\0','\0','\0','\0'),('user_32','cus','MN-0001','\0','\0','\0','\0'),('user_33','cus','MN-0001','\0','\0','\0','\0'),('user_34','cus','MN-0001','\0','\0','\0','\0'),('user_35','cus','MN-0001','\0','\0','\0','\0'),('user_36','cus','MN-0001','\0','\0','\0','\0'),('user_37','cus','MN-0001','\0','\0','\0','\0'),('user_38','cus','MN-0001','\0','\0','\0','\0'),('user_39','cus','MN-0001','\0','\0','\0','\0'),('user_4','adm','MN-0001','','','',''),('user_4','adm','MN-0002','','','',''),('user_4','adm','MN-0002A','','','',''),('user_4','adm','MN-0002AA','','','',''),('user_4','adm','MN-0002AB','','','',''),('user_4','adm','MN-0002AC','','','',''),('user_4','adm','MN-0002AD','','','',''),('user_4','adm','MN-0002B','','','',''),('user_4','adm','MN-0002BA','','','',''),('user_4','adm','MN-0003','','','',''),('user_4','adm','MN-0003A','','','',''),('user_4','adm','MN-0003AA','','','',''),('user_4','adm','MN-0003B','','','',''),('user_4','adm','MN-0003BA','','','',''),('user_4','adm','MN-0003BB','','','',''),('user_4','adm','MN-0003BC','','','',''),('user_4','adm','MN-0004','','','',''),('user_4','adm','MN-0004A','','','',''),('user_4','adm','MN-0004B','','','',''),('user_4','adm','MN-0020','\0','\0','\0','\0'),('user_4','adm','MN-0020A','\0','\0','\0','\0'),('user_4','adm','MN-0020B','\0','\0','\0','\0'),('user_40','cus','MN-0001','\0','\0','\0','\0'),('user_41','cus','MN-0001','\0','\0','\0','\0'),('user_5','cus','MN-0001','\0','\0','\0','\0'),('user_6','adm','MN-0001','','','',''),('user_6','adm','MN-0002','','','',''),('user_6','adm','MN-0002A','','','',''),('user_6','adm','MN-0002AA','','','',''),('user_6','adm','MN-0002AB','','','',''),('user_6','adm','MN-0002AC','','','',''),('user_6','adm','MN-0002AD','','','',''),('user_6','adm','MN-0002B','','','',''),('user_6','adm','MN-0002BA','','','',''),('user_6','adm','MN-0003','','','',''),('user_6','adm','MN-0003A','','','',''),('user_6','adm','MN-0003AA','','','',''),('user_6','adm','MN-0003B','','','',''),('user_6','adm','MN-0003BA','','','',''),('user_6','adm','MN-0003BB','','','',''),('user_6','adm','MN-0003BC','','','',''),('user_6','adm','MN-0004','','','',''),('user_6','adm','MN-0004A','','','',''),('user_6','adm','MN-0004B','','','',''),('user_6','adm','MN-0020','','','',''),('user_6','adm','MN-0020A','','','',''),('user_6','adm','MN-0020B','','','',''),('user_6','cus','MN-0001','\0','\0','\0','\0'),('user_7','adm','MN-0001','','','',''),('user_7','adm','MN-0002','','','',''),('user_7','adm','MN-0002A','','','',''),('user_7','adm','MN-0002AA','','','',''),('user_7','adm','MN-0002AB','','','',''),('user_7','adm','MN-0002AC','','','',''),('user_7','adm','MN-0002AD','','','',''),('user_7','adm','MN-0002B','','','',''),('user_7','adm','MN-0002BA','','','',''),('user_7','adm','MN-0003','','','',''),('user_7','adm','MN-0003A','','','',''),('user_7','adm','MN-0003AA','','','',''),('user_7','adm','MN-0003B','','','',''),('user_7','adm','MN-0003BA','','','',''),('user_7','adm','MN-0003BB','','','',''),('user_7','adm','MN-0003BC','','','',''),('user_7','adm','MN-0004','','','',''),('user_7','adm','MN-0004A','','','',''),('user_7','adm','MN-0004B','','','',''),('user_7','adm','MN-0020','\0','\0','\0','\0'),('user_7','adm','MN-0020A','\0','\0','\0','\0'),('user_7','adm','MN-0020B','\0','\0','\0','\0'),('user_8','cus','MN-0001','\0','\0','\0','\0'),('user_9','cus','MN-0001','\0','\0','\0','\0');
/*!40000 ALTER TABLE `tbl_sys_user_role_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mst_department`
--

DROP TABLE IF EXISTS `tbl_mst_department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_mst_department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `is_actived` bit(1) DEFAULT NULL,
  `is_deleted` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mst_department`
--

LOCK TABLES `tbl_mst_department` WRITE;
/*!40000 ALTER TABLE `tbl_mst_department` DISABLE KEYS */;
INSERT INTO `tbl_mst_department` VALUES (1,'Information Technology','IT','2025-08-08 14:00:00','system',NULL,NULL,'',NULL),(2,'Production Control','PCD','2025-08-08 14:00:00','system',NULL,NULL,'',NULL),(3,'Quality Assurance','QA','2025-08-08 14:00:00','system',NULL,NULL,'',NULL),(42,'Quality Control','QC','2025-08-11 07:55:55',NULL,'2025-08-11 07:55:55',NULL,'',NULL),(43,'Maintenance','MTC','2025-08-11 08:33:33','system','2025-08-11 08:33:33',NULL,'',NULL),(44,'General Affair','GA','2025-10-14 11:10:24','system','2025-10-14 11:10:24',NULL,'',NULL),(46,'Marketing','MKT','2025-10-14 11:31:18','system','2025-10-14 11:31:18',NULL,'',NULL),(48,'Purchasing','PUD','2025-10-18 10:00:43','system','2025-10-18 10:00:43',NULL,'',NULL),(49,'FINANCE','FAT','2025-10-18 10:00:55','system','2025-10-18 10:00:55',NULL,'',NULL),(50,'Engineering','ENG','2025-10-20 10:21:01','system','2025-10-20 10:21:01',NULL,'',NULL),(51,'Research and Development','R & D','2025-10-20 10:22:14','system','2025-10-20 10:22:14',NULL,'',NULL),(52,'Safety Health and Environment','SHE','2025-10-20 10:22:41','system','2025-10-20 10:22:41',NULL,'',NULL),(53,'FAT Invoice','INV','2025-10-20 10:23:58','system','2025-10-20 10:23:58',NULL,'',NULL),(54,'Human Resources Department','HRD','2025-10-20 10:26:25','system','2025-10-20 10:26:25',NULL,'',NULL),(55,'Bonecom Inty Technology','BIT','2025-10-20 10:26:54','system','2025-10-20 10:26:54',NULL,'',NULL),(56,'Production','PRD','2025-10-20 10:28:24','system','2025-10-20 10:28:24',NULL,'',NULL),(58,'Quality - BTP','QA-BTP','2025-10-24 11:36:21','system','2025-10-24 11:36:21',NULL,'',NULL),(59,'Production-BTP','PRD-BTP','2025-10-24 11:36:44','system','2025-10-24 11:36:44',NULL,'',NULL),(60,'PCD-BTP','PCD-BTP','2025-10-24 11:37:19','system','2025-10-24 11:37:19',NULL,'',NULL),(61,'ENGINEERING-BTP','ENG-BTP','2025-10-24 11:37:34','system','2025-10-24 11:37:34',NULL,'',NULL),(62,'Production-KIMU','PRD-KIMU','2025-10-24 11:38:04','system','2025-10-24 11:38:04',NULL,'',NULL),(63,'PCD-KIMU','PCD-KIMU','2025-10-24 11:38:18','system','2025-10-24 11:38:18',NULL,'',NULL);
/*!40000 ALTER TABLE `tbl_mst_department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mst_jabatan`
--

DROP TABLE IF EXISTS `tbl_mst_jabatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_mst_jabatan` (
  `jabatan_id` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`jabatan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mst_jabatan`
--

LOCK TABLES `tbl_mst_jabatan` WRITE;
/*!40000 ALTER TABLE `tbl_mst_jabatan` DISABLE KEYS */;
INSERT INTO `tbl_mst_jabatan` VALUES ('LH','Line Head'),('SPV','Supervisor'),('SS','Senior Staff'),('STF','Staff');
/*!40000 ALTER TABLE `tbl_mst_jabatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mst_level`
--

DROP TABLE IF EXISTS `tbl_mst_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_mst_level` (
  `level_id` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`level_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mst_level`
--

LOCK TABLES `tbl_mst_level` WRITE;
/*!40000 ALTER TABLE `tbl_mst_level` DISABLE KEYS */;
INSERT INTO `tbl_mst_level` VALUES ('A','Approved'),('C','Created'),('CH','Checked'),('K','Knowledge');
/*!40000 ALTER TABLE `tbl_mst_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_trn_order`
--

DROP TABLE IF EXISTS `tbl_trn_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_trn_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(100) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `user_id` varchar(20) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `qty` double DEFAULT 0,
  `qty_actual` double DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `status` enum('request','checked','progress','done','rejected','approved') DEFAULT NULL,
  `progress_by` varchar(100) DEFAULT NULL,
  `progress_date` datetime DEFAULT NULL,
  `finish_by` varchar(100) DEFAULT NULL,
  `finish_date` datetime DEFAULT NULL,
  `received_by` varchar(100) DEFAULT NULL,
  `department_received` varchar(100) DEFAULT NULL,
  `approved_by` varchar(100) DEFAULT NULL,
  `approved_date` datetime DEFAULT NULL,
  `rejected_date` datetime DEFAULT NULL,
  `rejected_by` varchar(100) DEFAULT NULL,
  `remark_reject` text DEFAULT NULL,
  `remark` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_trn_order_tbl_mst_product_FK` (`product_id`),
  KEY `tbl_trn_order_tbl_mst_department_FK` (`department_id`),
  CONSTRAINT `tbl_trn_order_tbl_mst_department_FK` FOREIGN KEY (`department_id`) REFERENCES `tbl_mst_department` (`id`),
  CONSTRAINT `tbl_trn_order_tbl_mst_product_FK` FOREIGN KEY (`product_id`) REFERENCES `tbl_mst_product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_trn_order`
--

LOCK TABLES `tbl_trn_order` WRITE;
/*!40000 ALTER TABLE `tbl_trn_order` DISABLE KEYS */;
INSERT INTO `tbl_trn_order` VALUES (56,'ORDER-00001',1,'user_2',57,1,2,'2025-10-17 13:47:43','2025-10-17 13:48:53','user_2','user_6','approved',NULL,NULL,'dasep depiyawan','2025-10-17 13:49:30',NULL,NULL,'user_6','2025-10-17 13:48:53',NULL,NULL,NULL,'-'),(57,'ORDER-00002',1,'user_5',180,1,1,'2025-10-20 11:47:42','2025-10-20 11:48:08','user_5','user_3','progress','Gilang Pakusadewo','2025-10-20 11:48:40',NULL,NULL,NULL,NULL,'user_3','2025-10-20 11:48:08',NULL,NULL,NULL,'-'),(58,'ORDER-00003',1,'user_5',57,10,7,'2025-10-20 13:51:04','2025-10-20 13:52:46','user_5','user_3','done',NULL,NULL,'MUSLIKHUN','2025-10-20 13:54:16',NULL,NULL,'user_3','2025-10-20 13:52:46',NULL,NULL,NULL,'-'),(59,'ORDER-00004',1,'user_5',57,1,1,'2025-10-23 10:27:43','2025-10-23 10:59:45','user_5','user_3','approved',NULL,NULL,NULL,NULL,NULL,NULL,'user_3','2025-10-23 10:59:45',NULL,NULL,NULL,'Untuk kebutuhan perapihan dokumen '),(60,'ORDER-00005',1,'user_5',57,1,1,'2025-10-23 11:01:37','2025-10-23 11:01:37','user_5','user_5','request',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'-'),(61,'ORDER-00006',1,'user_5',57,2,1,'2025-10-23 13:19:18','2025-10-23 13:21:57','user_5','user_3','done',NULL,NULL,'MUSLIKHUN','2025-10-23 13:27:16',NULL,NULL,'user_3','2025-10-23 13:21:57',NULL,NULL,NULL,'Kebutuhan perapihan dokumen IT'),(62,'ORDER-00007',1,'user_5',184,1,1,'2025-10-23 13:32:11','2025-10-23 13:33:19','user_5','user_3','progress','MUSLIKHUN','2025-10-23 13:36:12',NULL,NULL,NULL,NULL,'user_3','2025-10-23 13:33:19',NULL,NULL,NULL,'kebutuhan lemari IT user Febri'),(66,'ORDER-00008',1,'user_2',57,1,1,'2025-10-24 08:37:33','2025-10-24 08:37:33','user_2','user_2','request',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'paper tester tester'),(68,'ORDER-00009',1,'user_3',57,1,1,'2025-10-24 08:57:17','2025-10-24 08:57:17','user_3','user_3','request',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'kebutuhan tst'),(82,'ORDER-00010',1,'user_2',57,1,1,'2025-10-24 09:22:28','2025-10-24 09:22:28','user_2','user_2','request',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'testesterer'),(84,'ORDER-00011',1,'user_2',187,1,1,'2025-10-24 09:46:40','2025-10-24 09:48:23','user_2','user_2','rejected',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-10-24 09:48:23','user_2',NULL,'tesstesterstestesstester'),(85,'ORDER-00012',1,'user_5',57,2,1,'2025-10-24 14:01:39','2025-10-24 14:03:11','user_5','user_3','done',NULL,NULL,'MUSLIKHUN','2025-10-24 14:06:26',NULL,NULL,'user_3','2025-10-24 14:03:11',NULL,NULL,NULL,'Kebutuhan perapihan file IT'),(86,'ORDER-00013',2,'user_10',57,2,2,'2025-10-24 15:03:20','2025-10-24 15:11:51','user_10','user_33','approved',NULL,NULL,NULL,NULL,NULL,NULL,'user_33','2025-10-24 15:11:51',NULL,NULL,NULL,'Kebutuhan Dokumen New');
/*!40000 ALTER TABLE `tbl_trn_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mst_satuan`
--

DROP TABLE IF EXISTS `tbl_mst_satuan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_mst_satuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `is_actived` bit(1) DEFAULT NULL,
  `is_deleted` bit(1) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `updated_by` varchar(100) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_mst_satuan_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mst_satuan`
--

LOCK TABLES `tbl_mst_satuan` WRITE;
/*!40000 ALTER TABLE `tbl_mst_satuan` DISABLE KEYS */;
INSERT INTO `tbl_mst_satuan` VALUES (1,'PIECES','PCS','','\0','2025-08-11 09:42:30','2025-08-11 09:42:30',NULL,'system'),(2,'KILOGRAM','KG','','\0','2025-08-11 09:42:30','2025-08-11 09:42:30',NULL,'system'),(3,'METER','M','','\0','2025-08-11 09:42:30','2025-08-11 09:42:30',NULL,'system'),(4,'CENTIMETER','CM','','\0','2025-08-11 09:42:30','2025-08-11 09:42:30',NULL,'system'),(8,'ROLL','ROLL','',NULL,'2025-08-12 10:49:51','2025-08-12 10:49:51',NULL,'system'),(9,'PACKING','PACK','',NULL,'2025-08-12 10:50:05','2025-08-12 10:50:14','system','system'),(10,'GROSS','GROSS','',NULL,'2025-08-12 10:50:36','2025-08-12 10:50:36',NULL,'system'),(12,'UNIT','UNIT','',NULL,'2025-10-16 17:30:02','2025-10-20 11:42:14','user_7','user_2');
/*!40000 ALTER TABLE `tbl_mst_satuan` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-28  7:18:12

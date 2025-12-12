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
-- Temporary table structure for view `vw_mst_product`
--

DROP TABLE IF EXISTS `vw_mst_product`;
/*!50001 DROP VIEW IF EXISTS `vw_mst_product`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_mst_product` (
  `id` tinyint NOT NULL,
  `kode_barang` tinyint NOT NULL,
  `nama_barang` tinyint NOT NULL,
  `type_barang` tinyint NOT NULL,
  `jenis_asset` tinyint NOT NULL,
  `kategori_id` tinyint NOT NULL,
  `stock_type` tinyint NOT NULL,
  `special_order` tinyint NOT NULL,
  `merek` tinyint NOT NULL,
  `warna` tinyint NOT NULL,
  `satuan_id` tinyint NOT NULL,
  `ukuran` tinyint NOT NULL,
  `model` tinyint NOT NULL,
  `harga` tinyint NOT NULL,
  `deskripsi` tinyint NOT NULL,
  `images` tinyint NOT NULL,
  `is_deleted` tinyint NOT NULL,
  `is_actived` tinyint NOT NULL,
  `updated_at` tinyint NOT NULL,
  `created_at` tinyint NOT NULL,
  `created_by` tinyint NOT NULL,
  `updated_by` tinyint NOT NULL,
  `units` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_trn_adjust`
--

DROP TABLE IF EXISTS `vw_trn_adjust`;
/*!50001 DROP VIEW IF EXISTS `vw_trn_adjust`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_trn_adjust` (
  `id` tinyint NOT NULL,
  `product_id` tinyint NOT NULL,
  `kode_barang` tinyint NOT NULL,
  `type` tinyint NOT NULL,
  `qty` tinyint NOT NULL,
  `remark` tinyint NOT NULL,
  `tanggal` tinyint NOT NULL,
  `created_at` tinyint NOT NULL,
  `updated_at` tinyint NOT NULL,
  `created_by` tinyint NOT NULL,
  `updated_by` tinyint NOT NULL,
  `nama_barang` tinyint NOT NULL,
  `images` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_stock`
--

DROP TABLE IF EXISTS `vw_stock`;
/*!50001 DROP VIEW IF EXISTS `vw_stock`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_stock` (
  `id` tinyint NOT NULL,
  `product_id` tinyint NOT NULL,
  `kode_barang` tinyint NOT NULL,
  `stock` tinyint NOT NULL,
  `created_at` tinyint NOT NULL,
  `updated_at` tinyint NOT NULL,
  `created_by` tinyint NOT NULL,
  `updated_by` tinyint NOT NULL,
  `nama_barang` tinyint NOT NULL,
  `max_stock` tinyint NOT NULL,
  `min_stock` tinyint NOT NULL,
  `type_barang` tinyint NOT NULL,
  `merek` tinyint NOT NULL,
  `stock_type` tinyint NOT NULL,
  `satuan` tinyint NOT NULL,
  `images` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_trn_beli`
--

DROP TABLE IF EXISTS `vw_trn_beli`;
/*!50001 DROP VIEW IF EXISTS `vw_trn_beli`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_trn_beli` (
  `barang_id` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `creator` tinyint NOT NULL,
  `order_date` tinyint NOT NULL,
  `qty` tinyint NOT NULL,
  `no_po` tinyint NOT NULL,
  `tanggal_beli` tinyint NOT NULL,
  `harga_satuan` tinyint NOT NULL,
  `harga_total` tinyint NOT NULL,
  `supplier` tinyint NOT NULL,
  `remark` tinyint NOT NULL,
  `transaction_id` tinyint NOT NULL,
  `id` tinyint NOT NULL,
  `kode_barang` tinyint NOT NULL,
  `nama_barang` tinyint NOT NULL,
  `type_barang` tinyint NOT NULL,
  `jenis_asset` tinyint NOT NULL,
  `kategori_id` tinyint NOT NULL,
  `merek` tinyint NOT NULL,
  `warna` tinyint NOT NULL,
  `satuan_id` tinyint NOT NULL,
  `ukuran` tinyint NOT NULL,
  `model` tinyint NOT NULL,
  `harga` tinyint NOT NULL,
  `deskripsi` tinyint NOT NULL,
  `images` tinyint NOT NULL,
  `updated_at` tinyint NOT NULL,
  `created_at` tinyint NOT NULL,
  `created_by` tinyint NOT NULL,
  `updated_by` tinyint NOT NULL,
  `is_deleted` tinyint NOT NULL,
  `is_actived` tinyint NOT NULL,
  `stock_type` tinyint NOT NULL,
  `special_order` tinyint NOT NULL,
  `kategori_name` tinyint NOT NULL,
  `satuan_name` tinyint NOT NULL,
  `jenis_asset_name` tinyint NOT NULL,
  `stock` tinyint NOT NULL,
  `order_count` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_usr_menu_access`
--

DROP TABLE IF EXISTS `vw_usr_menu_access`;
/*!50001 DROP VIEW IF EXISTS `vw_usr_menu_access`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_usr_menu_access` (
  `user_id` tinyint NOT NULL,
  `role_id` tinyint NOT NULL,
  `menu` tinyint NOT NULL,
  `menu_id` tinyint NOT NULL,
  `level` tinyint NOT NULL,
  `sort` tinyint NOT NULL,
  `parameters` tinyint NOT NULL,
  `parent_menu` tinyint NOT NULL,
  `is_deleted` tinyint NOT NULL,
  `url` tinyint NOT NULL,
  `icon` tinyint NOT NULL,
  `is_actived` tinyint NOT NULL,
  `is_delete` tinyint NOT NULL,
  `is_create` tinyint NOT NULL,
  `is_update` tinyint NOT NULL,
  `is_read` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_trn_order`
--

DROP TABLE IF EXISTS `vw_trn_order`;
/*!50001 DROP VIEW IF EXISTS `vw_trn_order`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_trn_order` (
  `barang_id` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `creator` tinyint NOT NULL,
  `photo` tinyint NOT NULL,
  `creator_sign` tinyint NOT NULL,
  `department_id` tinyint NOT NULL,
  `order_date` tinyint NOT NULL,
  `qty` tinyint NOT NULL,
  `qty_actual` tinyint NOT NULL,
  `progress_by` tinyint NOT NULL,
  `progress_date` tinyint NOT NULL,
  `finish_by` tinyint NOT NULL,
  `finish_date` tinyint NOT NULL,
  `approved_by` tinyint NOT NULL,
  `approved_date` tinyint NOT NULL,
  `rejected_by` tinyint NOT NULL,
  `rejected_date` tinyint NOT NULL,
  `order_id` tinyint NOT NULL,
  `remark_reject` tinyint NOT NULL,
  `remark` tinyint NOT NULL,
  `id` tinyint NOT NULL,
  `kode_barang` tinyint NOT NULL,
  `nama_barang` tinyint NOT NULL,
  `type_barang` tinyint NOT NULL,
  `jenis_asset` tinyint NOT NULL,
  `kategori_id` tinyint NOT NULL,
  `merek` tinyint NOT NULL,
  `warna` tinyint NOT NULL,
  `satuan_id` tinyint NOT NULL,
  `ukuran` tinyint NOT NULL,
  `model` tinyint NOT NULL,
  `harga` tinyint NOT NULL,
  `deskripsi` tinyint NOT NULL,
  `images` tinyint NOT NULL,
  `updated_at` tinyint NOT NULL,
  `created_at` tinyint NOT NULL,
  `created_by` tinyint NOT NULL,
  `updated_by` tinyint NOT NULL,
  `is_deleted` tinyint NOT NULL,
  `is_actived` tinyint NOT NULL,
  `stock_type` tinyint NOT NULL,
  `special_order` tinyint NOT NULL,
  `department` tinyint NOT NULL,
  `code_department` tinyint NOT NULL,
  `kategori_name` tinyint NOT NULL,
  `satuan_name` tinyint NOT NULL,
  `jenis_asset_name` tinyint NOT NULL,
  `stock` tinyint NOT NULL,
  `rejected_name` tinyint NOT NULL,
  `approved_name` tinyint NOT NULL,
  `approved_sign` tinyint NOT NULL,
  `order_count` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `vw_mst_product`
--

/*!50001 DROP TABLE IF EXISTS `vw_mst_product`*/;
/*!50001 DROP VIEW IF EXISTS `vw_mst_product`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`ga`@`117.54.227.123` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_mst_product` AS select `a`.`id` AS `id`,`a`.`kode_barang` AS `kode_barang`,`a`.`nama_barang` AS `nama_barang`,`a`.`type_barang` AS `type_barang`,`a`.`jenis_asset` AS `jenis_asset`,`a`.`kategori_id` AS `kategori_id`,`a`.`stock_type` AS `stock_type`,`a`.`special_order` AS `special_order`,`a`.`merek` AS `merek`,`a`.`warna` AS `warna`,`a`.`satuan_id` AS `satuan_id`,`a`.`ukuran` AS `ukuran`,`a`.`model` AS `model`,ifnull(`a`.`harga`,0) AS `harga`,`a`.`deskripsi` AS `deskripsi`,`a`.`images` AS `images`,`a`.`is_deleted` AS `is_deleted`,`a`.`is_actived` AS `is_actived`,`a`.`updated_at` AS `updated_at`,`a`.`created_at` AS `created_at`,`a`.`created_by` AS `created_by`,`a`.`updated_by` AS `updated_by`,`b`.`name` AS `units` from (`tbl_mst_product` `a` left join `tbl_mst_satuan` `b` on(`b`.`id` = `a`.`satuan_id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_trn_adjust`
--

/*!50001 DROP TABLE IF EXISTS `vw_trn_adjust`*/;
/*!50001 DROP VIEW IF EXISTS `vw_trn_adjust`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`ga`@`117.54.227.123` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_trn_adjust` AS select `a`.`id` AS `id`,`a`.`product_id` AS `product_id`,`a`.`kode_barang` AS `kode_barang`,`a`.`type` AS `type`,`a`.`qty` AS `qty`,`a`.`remark` AS `remark`,`a`.`tanggal` AS `tanggal`,`a`.`created_at` AS `created_at`,`a`.`updated_at` AS `updated_at`,`a`.`created_by` AS `created_by`,`a`.`updated_by` AS `updated_by`,`b`.`nama_barang` AS `nama_barang`,`b`.`images` AS `images` from (`tbl_trn_adjust` `a` left join `tbl_mst_product` `b` on(`b`.`id` = `a`.`product_id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_stock`
--

/*!50001 DROP TABLE IF EXISTS `vw_stock`*/;
/*!50001 DROP VIEW IF EXISTS `vw_stock`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`ga`@`117.54.227.123` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_stock` AS select `tbl_trn_stock`.`id` AS `id`,`tbl_trn_stock`.`product_id` AS `product_id`,`tbl_trn_stock`.`kode_barang` AS `kode_barang`,`tbl_trn_stock`.`stock` AS `stock`,`tbl_trn_stock`.`created_at` AS `created_at`,`tbl_trn_stock`.`updated_at` AS `updated_at`,`tbl_trn_stock`.`created_by` AS `created_by`,`tbl_trn_stock`.`updated_by` AS `updated_by`,`b`.`nama_barang` AS `nama_barang`,`b`.`max_stock` AS `max_stock`,`b`.`min_stock` AS `min_stock`,`b`.`type_barang` AS `type_barang`,`b`.`merek` AS `merek`,`b`.`stock_type` AS `stock_type`,`c`.`code` AS `satuan`,`b`.`images` AS `images` from ((`tbl_trn_stock` left join `tbl_mst_product` `b` on(`b`.`id` = `tbl_trn_stock`.`product_id`)) left join `tbl_mst_satuan` `c` on(`c`.`id` = `b`.`satuan_id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_trn_beli`
--

/*!50001 DROP TABLE IF EXISTS `vw_trn_beli`*/;
/*!50001 DROP VIEW IF EXISTS `vw_trn_beli`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`ga`@`117.54.227.123` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_trn_beli` AS select `tbl_mst_product`.`id` AS `barang_id`,`tbl_trn_beli`.`status` AS `status`,`tbl_sys_users`.`nama` AS `creator`,`tbl_trn_beli`.`created_at` AS `order_date`,`tbl_trn_beli`.`qty` AS `qty`,`tbl_trn_beli`.`no_po` AS `no_po`,`tbl_trn_beli`.`tanggal_beli` AS `tanggal_beli`,`tbl_trn_beli`.`harga_satuan` AS `harga_satuan`,`tbl_trn_beli`.`harga_total` AS `harga_total`,`tbl_trn_beli`.`supplier` AS `supplier`,`tbl_trn_beli`.`remark` AS `remark`,`tbl_trn_beli`.`transaction_id` AS `transaction_id`,`tbl_mst_product`.`id` AS `id`,`tbl_mst_product`.`kode_barang` AS `kode_barang`,`tbl_mst_product`.`nama_barang` AS `nama_barang`,`tbl_mst_product`.`type_barang` AS `type_barang`,`tbl_mst_product`.`jenis_asset` AS `jenis_asset`,`tbl_mst_product`.`kategori_id` AS `kategori_id`,`tbl_mst_product`.`merek` AS `merek`,`tbl_mst_product`.`warna` AS `warna`,`tbl_mst_product`.`satuan_id` AS `satuan_id`,`tbl_mst_product`.`ukuran` AS `ukuran`,`tbl_mst_product`.`model` AS `model`,`tbl_mst_product`.`harga` AS `harga`,`tbl_mst_product`.`deskripsi` AS `deskripsi`,`tbl_mst_product`.`images` AS `images`,`tbl_mst_product`.`updated_at` AS `updated_at`,`tbl_mst_product`.`created_at` AS `created_at`,`tbl_mst_product`.`created_by` AS `created_by`,`tbl_mst_product`.`updated_by` AS `updated_by`,`tbl_mst_product`.`is_deleted` AS `is_deleted`,`tbl_mst_product`.`is_actived` AS `is_actived`,`tbl_mst_product`.`stock_type` AS `stock_type`,`tbl_mst_product`.`special_order` AS `special_order`,`tbl_mst_kategori`.`name` AS `kategori_name`,`tbl_mst_satuan`.`name` AS `satuan_name`,`tbl_mst_jenis_asset`.`name` AS `jenis_asset_name`,`tbl_trn_stock`.`stock` AS `stock`,(select count(0) from `tbl_trn_beli` `o2` where `o2`.`product_id` = `tbl_mst_product`.`id`) AS `order_count` from ((((((`tbl_trn_beli` left join `tbl_mst_product` on(`tbl_trn_beli`.`product_id` = `tbl_mst_product`.`id`)) left join `tbl_mst_kategori` on(`tbl_mst_product`.`kategori_id` = `tbl_mst_kategori`.`id`)) left join `tbl_mst_satuan` on(`tbl_mst_product`.`satuan_id` = `tbl_mst_satuan`.`id`)) left join `tbl_mst_jenis_asset` on(`tbl_mst_product`.`jenis_asset` = `tbl_mst_jenis_asset`.`kode_asset`)) left join `tbl_trn_stock` on(`tbl_mst_product`.`id` = `tbl_trn_stock`.`product_id`)) left join `tbl_sys_users` on(`tbl_sys_users`.`user_id` = `tbl_trn_beli`.`created_by`)) order by `tbl_trn_beli`.`created_at` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_usr_menu_access`
--

/*!50001 DROP TABLE IF EXISTS `vw_usr_menu_access`*/;
/*!50001 DROP VIEW IF EXISTS `vw_usr_menu_access`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`ga`@`117.54.227.123` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_usr_menu_access` AS select `a`.`user_id` AS `user_id`,`a`.`role_id` AS `role_id`,`b`.`menu` AS `menu`,`b`.`menu_id` AS `menu_id`,`b`.`level` AS `level`,`b`.`sort` AS `sort`,`b`.`parameters` AS `parameters`,`b`.`parent_menu` AS `parent_menu`,`b`.`is_deleted` AS `is_deleted`,`b`.`url` AS `url`,`b`.`icon` AS `icon`,`c`.`is_actived` AS `is_actived`,`a`.`is_delete` AS `is_delete`,`a`.`is_create` AS `is_create`,`a`.`is_update` AS `is_update`,`a`.`is_read` AS `is_read` from ((`tbl_sys_user_role_access` `a` left join `tbl_sys_menu` `b` on(`b`.`menu_id` = `a`.`menu_id`)) left join `tbl_sys_role_access` `c` on(`c`.`role_id` = `a`.`role_id` and `c`.`menu_id` = `a`.`menu_id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_trn_order`
--

/*!50001 DROP TABLE IF EXISTS `vw_trn_order`*/;
/*!50001 DROP VIEW IF EXISTS `vw_trn_order`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`ga`@`117.54.227.123` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_trn_order` AS select `tbl_mst_product`.`id` AS `barang_id`,`tbl_trn_order`.`status` AS `status`,`tbl_sys_users`.`nama` AS `creator`,`tbl_sys_users`.`photo` AS `photo`,`tbl_sys_users`.`sign` AS `creator_sign`,`tbl_trn_order`.`department_id` AS `department_id`,`tbl_trn_order`.`created_at` AS `order_date`,`tbl_trn_order`.`qty` AS `qty`,`tbl_trn_order`.`qty_actual` AS `qty_actual`,`tbl_trn_order`.`progress_by` AS `progress_by`,`tbl_trn_order`.`progress_date` AS `progress_date`,`tbl_trn_order`.`finish_by` AS `finish_by`,`tbl_trn_order`.`finish_date` AS `finish_date`,`tbl_trn_order`.`approved_by` AS `approved_by`,`tbl_trn_order`.`approved_date` AS `approved_date`,`tbl_trn_order`.`rejected_by` AS `rejected_by`,`tbl_trn_order`.`rejected_date` AS `rejected_date`,`tbl_trn_order`.`order_id` AS `order_id`,`tbl_trn_order`.`remark_reject` AS `remark_reject`,`tbl_trn_order`.`remark` AS `remark`,`tbl_trn_order`.`id` AS `id`,`tbl_mst_product`.`kode_barang` AS `kode_barang`,`tbl_mst_product`.`nama_barang` AS `nama_barang`,`tbl_mst_product`.`type_barang` AS `type_barang`,`tbl_mst_product`.`jenis_asset` AS `jenis_asset`,`tbl_mst_product`.`kategori_id` AS `kategori_id`,`tbl_mst_product`.`merek` AS `merek`,`tbl_mst_product`.`warna` AS `warna`,`tbl_mst_product`.`satuan_id` AS `satuan_id`,`tbl_mst_product`.`ukuran` AS `ukuran`,`tbl_mst_product`.`model` AS `model`,`tbl_mst_product`.`harga` AS `harga`,`tbl_mst_product`.`deskripsi` AS `deskripsi`,`tbl_mst_product`.`images` AS `images`,`tbl_mst_product`.`updated_at` AS `updated_at`,`tbl_mst_product`.`created_at` AS `created_at`,`tbl_mst_product`.`created_by` AS `created_by`,`tbl_mst_product`.`updated_by` AS `updated_by`,`tbl_mst_product`.`is_deleted` AS `is_deleted`,`tbl_mst_product`.`is_actived` AS `is_actived`,`tbl_mst_product`.`stock_type` AS `stock_type`,`tbl_mst_product`.`special_order` AS `special_order`,`tbl_mst_department`.`name` AS `department`,`tbl_mst_department`.`code` AS `code_department`,`tbl_mst_kategori`.`name` AS `kategori_name`,`tbl_mst_satuan`.`code` AS `satuan_name`,`tbl_mst_jenis_asset`.`name` AS `jenis_asset_name`,`tbl_trn_stock`.`stock` AS `stock`,`reject`.`nama` AS `rejected_name`,`appr`.`nama` AS `approved_name`,`appr`.`sign` AS `approved_sign`,(select count(0) from `tbl_trn_order` `o2` where `o2`.`product_id` = `tbl_mst_product`.`id`) AS `order_count` from (((((((((`tbl_trn_order` left join `tbl_mst_product` on(`tbl_trn_order`.`product_id` = `tbl_mst_product`.`id`)) left join `tbl_mst_kategori` on(`tbl_mst_product`.`kategori_id` = `tbl_mst_kategori`.`id`)) left join `tbl_mst_satuan` on(`tbl_mst_product`.`satuan_id` = `tbl_mst_satuan`.`id`)) left join `tbl_mst_jenis_asset` on(`tbl_mst_product`.`jenis_asset` = `tbl_mst_jenis_asset`.`kode_asset`)) left join `tbl_trn_stock` on(`tbl_mst_product`.`id` = `tbl_trn_stock`.`product_id`)) left join `tbl_mst_department` on(`tbl_trn_order`.`department_id` = `tbl_mst_department`.`id`)) left join `tbl_sys_users` on(`tbl_sys_users`.`user_id` = `tbl_trn_order`.`created_by`)) left join `tbl_sys_users` `appr` on(`appr`.`user_id` = `tbl_trn_order`.`approved_by`)) left join `tbl_sys_users` `reject` on(`reject`.`user_id` = `tbl_trn_order`.`rejected_by`)) order by `tbl_trn_order`.`created_at` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-28  7:17:22

-- web_gastore.tbl_mst_department definition

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


-- web_gastore.tbl_mst_jabatan definition

CREATE TABLE `tbl_mst_jabatan` (
  `jabatan_id` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`jabatan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- web_gastore.tbl_mst_jenis_asset definition

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


-- web_gastore.tbl_mst_kategori definition

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


-- web_gastore.tbl_mst_level definition

CREATE TABLE `tbl_mst_level` (
  `level_id` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`level_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;


-- web_gastore.tbl_mst_satuan definition

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


-- web_gastore.tbl_mst_token definition

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


-- web_gastore.tbl_sys_menu definition

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


-- web_gastore.tbl_sys_role definition

CREATE TABLE `tbl_sys_role` (
  `role_id` varchar(100) NOT NULL,
  `name_role` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp(),
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;


-- web_gastore.tbl_sys_users definition

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


-- web_gastore.tbl_trn_beli definition

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


-- web_gastore.tbl_trn_orders_fail definition

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


-- web_gastore.tbl_trn_stock definition

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


-- web_gastore.tbl_mst_product definition

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


-- web_gastore.tbl_sys_role_access definition

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


-- web_gastore.tbl_sys_user_role_access definition

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


-- web_gastore.tbl_trn_adjust definition

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


-- web_gastore.tbl_trn_order definition

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


-- web_gastore.tbl_log_transaksi definition

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
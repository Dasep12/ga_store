-- web_gastore.vw_mst_product source

CREATE OR REPLACE
ALGORITHM = UNDEFINED VIEW `web_gastore`.`vw_mst_product` AS
select
    `a`.`id` AS `id`,
    `a`.`kode_barang` AS `kode_barang`,
    `a`.`nama_barang` AS `nama_barang`,
    `a`.`type_barang` AS `type_barang`,
    `a`.`jenis_asset` AS `jenis_asset`,
    `a`.`kategori_id` AS `kategori_id`,
    `a`.`stock_type` AS `stock_type`,
    `a`.`special_order` AS `special_order`,
    `a`.`merek` AS `merek`,
    `a`.`warna` AS `warna`,
    `a`.`satuan_id` AS `satuan_id`,
    `a`.`ukuran` AS `ukuran`,
    `a`.`model` AS `model`,
    ifnull(`a`.`harga`, 0) AS `harga`,
    `a`.`deskripsi` AS `deskripsi`,
    `a`.`images` AS `images`,
    `a`.`is_deleted` AS `is_deleted`,
    `a`.`is_actived` AS `is_actived`,
    `a`.`updated_at` AS `updated_at`,
    `a`.`created_at` AS `created_at`,
    `a`.`created_by` AS `created_by`,
    `a`.`updated_by` AS `updated_by`,
    `b`.`name` AS `units`
from
    (`web_gastore`.`tbl_mst_product` `a`
left join `web_gastore`.`tbl_mst_satuan` `b` on
    (`b`.`id` = `a`.`satuan_id`));


-- web_gastore.vw_stock source

CREATE OR REPLACE
ALGORITHM = UNDEFINED VIEW `web_gastore`.`vw_stock` AS
select
    `web_gastore`.`tbl_trn_stock`.`id` AS `id`,
    `web_gastore`.`tbl_trn_stock`.`product_id` AS `product_id`,
    `web_gastore`.`tbl_trn_stock`.`kode_barang` AS `kode_barang`,
    `web_gastore`.`tbl_trn_stock`.`stock` AS `stock`,
    `web_gastore`.`tbl_trn_stock`.`created_at` AS `created_at`,
    `web_gastore`.`tbl_trn_stock`.`updated_at` AS `updated_at`,
    `web_gastore`.`tbl_trn_stock`.`created_by` AS `created_by`,
    `web_gastore`.`tbl_trn_stock`.`updated_by` AS `updated_by`,
    `b`.`nama_barang` AS `nama_barang`,
    `b`.`max_stock` AS `max_stock`,
    `b`.`min_stock` AS `min_stock`,
    `b`.`type_barang` AS `type_barang`,
    `b`.`merek` AS `merek`,
    `b`.`stock_type` AS `stock_type`,
    `c`.`code` AS `satuan`,
    `b`.`images` AS `images`
from
    ((`web_gastore`.`tbl_trn_stock`
left join `web_gastore`.`tbl_mst_product` `b` on
    (`b`.`id` = `web_gastore`.`tbl_trn_stock`.`product_id`))
left join `web_gastore`.`tbl_mst_satuan` `c` on
    (`c`.`id` = `b`.`satuan_id`));


-- web_gastore.vw_trn_adjust source

CREATE OR REPLACE
ALGORITHM = UNDEFINED VIEW `web_gastore`.`vw_trn_adjust` AS
select
    `a`.`id` AS `id`,
    `a`.`product_id` AS `product_id`,
    `a`.`kode_barang` AS `kode_barang`,
    `a`.`type` AS `type`,
    `a`.`qty` AS `qty`,
    `a`.`remark` AS `remark`,
    `a`.`tanggal` AS `tanggal`,
    `a`.`created_at` AS `created_at`,
    `a`.`updated_at` AS `updated_at`,
    `a`.`created_by` AS `created_by`,
    `a`.`updated_by` AS `updated_by`,
    `b`.`nama_barang` AS `nama_barang`,
    `b`.`images` AS `images`
from
    (`web_gastore`.`tbl_trn_adjust` `a`
left join `web_gastore`.`tbl_mst_product` `b` on
    (`b`.`id` = `a`.`product_id`));


-- web_gastore.vw_trn_beli source

CREATE OR REPLACE
ALGORITHM = UNDEFINED VIEW `web_gastore`.`vw_trn_beli` AS
select
    `web_gastore`.`tbl_mst_product`.`id` AS `barang_id`,
    `web_gastore`.`tbl_trn_beli`.`status` AS `status`,
    `web_gastore`.`tbl_sys_users`.`nama` AS `creator`,
    `web_gastore`.`tbl_trn_beli`.`created_at` AS `order_date`,
    `web_gastore`.`tbl_trn_beli`.`qty` AS `qty`,
    `web_gastore`.`tbl_trn_beli`.`no_po` AS `no_po`,
    `web_gastore`.`tbl_trn_beli`.`tanggal_beli` AS `tanggal_beli`,
    `web_gastore`.`tbl_trn_beli`.`harga_satuan` AS `harga_satuan`,
    `web_gastore`.`tbl_trn_beli`.`harga_total` AS `harga_total`,
    `web_gastore`.`tbl_trn_beli`.`supplier` AS `supplier`,
    `web_gastore`.`tbl_trn_beli`.`remark` AS `remark`,
    `web_gastore`.`tbl_trn_beli`.`transaction_id` AS `transaction_id`,
    `web_gastore`.`tbl_mst_product`.`id` AS `id`,
    `web_gastore`.`tbl_mst_product`.`kode_barang` AS `kode_barang`,
    `web_gastore`.`tbl_mst_product`.`nama_barang` AS `nama_barang`,
    `web_gastore`.`tbl_mst_product`.`type_barang` AS `type_barang`,
    `web_gastore`.`tbl_mst_product`.`jenis_asset` AS `jenis_asset`,
    `web_gastore`.`tbl_mst_product`.`kategori_id` AS `kategori_id`,
    `web_gastore`.`tbl_mst_product`.`merek` AS `merek`,
    `web_gastore`.`tbl_mst_product`.`warna` AS `warna`,
    `web_gastore`.`tbl_mst_product`.`satuan_id` AS `satuan_id`,
    `web_gastore`.`tbl_mst_product`.`ukuran` AS `ukuran`,
    `web_gastore`.`tbl_mst_product`.`model` AS `model`,
    `web_gastore`.`tbl_mst_product`.`harga` AS `harga`,
    `web_gastore`.`tbl_mst_product`.`deskripsi` AS `deskripsi`,
    `web_gastore`.`tbl_mst_product`.`images` AS `images`,
    `web_gastore`.`tbl_mst_product`.`updated_at` AS `updated_at`,
    `web_gastore`.`tbl_mst_product`.`created_at` AS `created_at`,
    `web_gastore`.`tbl_mst_product`.`created_by` AS `created_by`,
    `web_gastore`.`tbl_mst_product`.`updated_by` AS `updated_by`,
    `web_gastore`.`tbl_mst_product`.`is_deleted` AS `is_deleted`,
    `web_gastore`.`tbl_mst_product`.`is_actived` AS `is_actived`,
    `web_gastore`.`tbl_mst_product`.`stock_type` AS `stock_type`,
    `web_gastore`.`tbl_mst_product`.`special_order` AS `special_order`,
    `web_gastore`.`tbl_mst_kategori`.`name` AS `kategori_name`,
    `web_gastore`.`tbl_mst_satuan`.`name` AS `satuan_name`,
    `web_gastore`.`tbl_mst_jenis_asset`.`name` AS `jenis_asset_name`,
    `web_gastore`.`tbl_trn_stock`.`stock` AS `stock`,
    (
    select
        count(0)
    from
        `web_gastore`.`tbl_trn_beli` `o2`
    where
        `o2`.`product_id` = `web_gastore`.`tbl_mst_product`.`id`) AS `order_count`
from
    ((((((`web_gastore`.`tbl_trn_beli`
left join `web_gastore`.`tbl_mst_product` on
    (`web_gastore`.`tbl_trn_beli`.`product_id` = `web_gastore`.`tbl_mst_product`.`id`))
left join `web_gastore`.`tbl_mst_kategori` on
    (`web_gastore`.`tbl_mst_product`.`kategori_id` = `web_gastore`.`tbl_mst_kategori`.`id`))
left join `web_gastore`.`tbl_mst_satuan` on
    (`web_gastore`.`tbl_mst_product`.`satuan_id` = `web_gastore`.`tbl_mst_satuan`.`id`))
left join `web_gastore`.`tbl_mst_jenis_asset` on
    (`web_gastore`.`tbl_mst_product`.`jenis_asset` = `web_gastore`.`tbl_mst_jenis_asset`.`kode_asset`))
left join `web_gastore`.`tbl_trn_stock` on
    (`web_gastore`.`tbl_mst_product`.`id` = `web_gastore`.`tbl_trn_stock`.`product_id`))
left join `web_gastore`.`tbl_sys_users` on
    (`web_gastore`.`tbl_sys_users`.`user_id` = `web_gastore`.`tbl_trn_beli`.`created_by`))
order by
    `web_gastore`.`tbl_trn_beli`.`created_at` desc;


-- web_gastore.vw_trn_order source

CREATE OR REPLACE
ALGORITHM = UNDEFINED VIEW `web_gastore`.`vw_trn_order` AS
select
    `web_gastore`.`tbl_mst_product`.`id` AS `barang_id`,
    `web_gastore`.`tbl_trn_order`.`status` AS `status`,
    `web_gastore`.`tbl_sys_users`.`nama` AS `creator`,
    `web_gastore`.`tbl_sys_users`.`photo` AS `photo`,
    `web_gastore`.`tbl_sys_users`.`sign` AS `creator_sign`,
    `web_gastore`.`tbl_trn_order`.`department_id` AS `department_id`,
    `web_gastore`.`tbl_trn_order`.`created_at` AS `order_date`,
    `web_gastore`.`tbl_trn_order`.`qty` AS `qty`,
    `web_gastore`.`tbl_trn_order`.`qty_actual` AS `qty_actual`,
    `web_gastore`.`tbl_trn_order`.`progress_by` AS `progress_by`,
    `web_gastore`.`tbl_trn_order`.`progress_date` AS `progress_date`,
    `web_gastore`.`tbl_trn_order`.`finish_by` AS `finish_by`,
    `web_gastore`.`tbl_trn_order`.`finish_date` AS `finish_date`,
    `web_gastore`.`tbl_trn_order`.`approved_by` AS `approved_by`,
    `web_gastore`.`tbl_trn_order`.`approved_date` AS `approved_date`,
    `web_gastore`.`tbl_trn_order`.`rejected_by` AS `rejected_by`,
    `web_gastore`.`tbl_trn_order`.`rejected_date` AS `rejected_date`,
    `web_gastore`.`tbl_trn_order`.`order_id` AS `order_id`,
    `web_gastore`.`tbl_trn_order`.`remark_reject` AS `remark_reject`,
    `web_gastore`.`tbl_trn_order`.`remark` AS `remark`,
    `web_gastore`.`tbl_trn_order`.`id` AS `id`,
    `web_gastore`.`tbl_mst_product`.`kode_barang` AS `kode_barang`,
    `web_gastore`.`tbl_mst_product`.`nama_barang` AS `nama_barang`,
    `web_gastore`.`tbl_mst_product`.`type_barang` AS `type_barang`,
    `web_gastore`.`tbl_mst_product`.`jenis_asset` AS `jenis_asset`,
    `web_gastore`.`tbl_mst_product`.`kategori_id` AS `kategori_id`,
    `web_gastore`.`tbl_mst_product`.`merek` AS `merek`,
    `web_gastore`.`tbl_mst_product`.`warna` AS `warna`,
    `web_gastore`.`tbl_mst_product`.`satuan_id` AS `satuan_id`,
    `web_gastore`.`tbl_mst_product`.`ukuran` AS `ukuran`,
    `web_gastore`.`tbl_mst_product`.`model` AS `model`,
    `web_gastore`.`tbl_mst_product`.`harga` AS `harga`,
    `web_gastore`.`tbl_mst_product`.`deskripsi` AS `deskripsi`,
    `web_gastore`.`tbl_mst_product`.`images` AS `images`,
    `web_gastore`.`tbl_mst_product`.`updated_at` AS `updated_at`,
    `web_gastore`.`tbl_mst_product`.`created_at` AS `created_at`,
    `web_gastore`.`tbl_mst_product`.`created_by` AS `created_by`,
    `web_gastore`.`tbl_mst_product`.`updated_by` AS `updated_by`,
    `web_gastore`.`tbl_mst_product`.`is_deleted` AS `is_deleted`,
    `web_gastore`.`tbl_mst_product`.`is_actived` AS `is_actived`,
    `web_gastore`.`tbl_mst_product`.`stock_type` AS `stock_type`,
    `web_gastore`.`tbl_mst_product`.`special_order` AS `special_order`,
    `web_gastore`.`tbl_mst_department`.`name` AS `department`,
    `web_gastore`.`tbl_mst_department`.`code` AS `code_department`,
    `web_gastore`.`tbl_mst_kategori`.`name` AS `kategori_name`,
    `web_gastore`.`tbl_mst_satuan`.`code` AS `satuan_name`,
    `web_gastore`.`tbl_mst_jenis_asset`.`name` AS `jenis_asset_name`,
    `web_gastore`.`tbl_trn_stock`.`stock` AS `stock`,
    `reject`.`nama` AS `rejected_name`,
    `appr`.`nama` AS `approved_name`,
    `appr`.`sign` AS `approved_sign`,
    (
    select
        count(0)
    from
        `web_gastore`.`tbl_trn_order` `o2`
    where
        `o2`.`product_id` = `web_gastore`.`tbl_mst_product`.`id`) AS `order_count`
from
    (((((((((`web_gastore`.`tbl_trn_order`
left join `web_gastore`.`tbl_mst_product` on
    (`web_gastore`.`tbl_trn_order`.`product_id` = `web_gastore`.`tbl_mst_product`.`id`))
left join `web_gastore`.`tbl_mst_kategori` on
    (`web_gastore`.`tbl_mst_product`.`kategori_id` = `web_gastore`.`tbl_mst_kategori`.`id`))
left join `web_gastore`.`tbl_mst_satuan` on
    (`web_gastore`.`tbl_mst_product`.`satuan_id` = `web_gastore`.`tbl_mst_satuan`.`id`))
left join `web_gastore`.`tbl_mst_jenis_asset` on
    (`web_gastore`.`tbl_mst_product`.`jenis_asset` = `web_gastore`.`tbl_mst_jenis_asset`.`kode_asset`))
left join `web_gastore`.`tbl_trn_stock` on
    (`web_gastore`.`tbl_mst_product`.`id` = `web_gastore`.`tbl_trn_stock`.`product_id`))
left join `web_gastore`.`tbl_mst_department` on
    (`web_gastore`.`tbl_trn_order`.`department_id` = `web_gastore`.`tbl_mst_department`.`id`))
left join `web_gastore`.`tbl_sys_users` on
    (`web_gastore`.`tbl_sys_users`.`user_id` = `web_gastore`.`tbl_trn_order`.`created_by`))
left join `web_gastore`.`tbl_sys_users` `appr` on
    (`appr`.`user_id` = `web_gastore`.`tbl_trn_order`.`approved_by`))
left join `web_gastore`.`tbl_sys_users` `reject` on
    (`reject`.`user_id` = `web_gastore`.`tbl_trn_order`.`rejected_by`))
order by
    `web_gastore`.`tbl_trn_order`.`created_at` desc;


-- web_gastore.vw_usr_menu_access source

CREATE OR REPLACE
ALGORITHM = UNDEFINED VIEW `web_gastore`.`vw_usr_menu_access` AS
select
    `a`.`user_id` AS `user_id`,
    `a`.`role_id` AS `role_id`,
    `b`.`menu` AS `menu`,
    `b`.`menu_id` AS `menu_id`,
    `b`.`level` AS `level`,
    `b`.`sort` AS `sort`,
    `b`.`parameters` AS `parameters`,
    `b`.`parent_menu` AS `parent_menu`,
    `b`.`is_deleted` AS `is_deleted`,
    `b`.`url` AS `url`,
    `b`.`icon` AS `icon`,
    `c`.`is_actived` AS `is_actived`,
    `a`.`is_delete` AS `is_delete`,
    `a`.`is_create` AS `is_create`,
    `a`.`is_update` AS `is_update`,
    `a`.`is_read` AS `is_read`
from
    ((`web_gastore`.`tbl_sys_user_role_access` `a`
left join `web_gastore`.`tbl_sys_menu` `b` on
    (`b`.`menu_id` = `a`.`menu_id`))
left join `web_gastore`.`tbl_sys_role_access` `c` on
    (`c`.`role_id` = `a`.`role_id` and `c`.`menu_id` = `a`.`menu_id`));
/*
 Navicat Premium Data Transfer

 Source Server         : local-mysql
 Source Server Type    : MySQL
 Source Server Version : 100413
 Source Host           : localhost:3306
 Source Schema         : cobamajang

 Target Server Type    : MySQL
 Target Server Version : 100413
 File Encoding         : 65001

 Date: 27/12/2020 01:22:51
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for m_menu
-- ----------------------------
DROP TABLE IF EXISTS `m_menu`;
CREATE TABLE `m_menu`  (
  `id` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `judul` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `link` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `aktif` int(1) NULL DEFAULT NULL,
  `tingkat` int(11) NULL DEFAULT NULL,
  `urutan` int(11) NULL DEFAULT NULL,
  `add_button` int(1) NULL DEFAULT NULL,
  `edit_button` int(1) NULL DEFAULT NULL,
  `delete_button` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of m_menu
-- ----------------------------
INSERT INTO `m_menu` VALUES (1, 0, 'Dashboard', 'Dashboard', 'home', 'flaticon2-architecture-and-city', 1, 1, 1, 0, 0, 0);
INSERT INTO `m_menu` VALUES (2, 0, 'Setting (Administrator)', 'Setting', '', 'flaticon2-gear', 1, 1, 99, 0, 0, 0);
INSERT INTO `m_menu` VALUES (3, 2, 'Setting Menu', 'Setting Menu', 'set_menu', 'flaticon-grid-menu', 1, 2, 2, 1, 1, 1);
INSERT INTO `m_menu` VALUES (4, 2, 'Setting Role', 'Setting Role', 'set_role', 'flaticon-network', 1, 2, 1, 1, 1, 1);
INSERT INTO `m_menu` VALUES (6, 0, 'Master', 'Master', '', 'flaticon-folder-1', 1, 1, 2, 0, 0, 0);
INSERT INTO `m_menu` VALUES (7, 6, 'Data User', 'Data User', 'master_user', 'flaticon-users', 1, 2, 1, 1, 1, 1);
INSERT INTO `m_menu` VALUES (9, 0, 'Manajemen Konten', 'Manajemen Konten', '', 'flaticon-profile', 1, 1, 3, 0, 0, 0);
INSERT INTO `m_menu` VALUES (10, 9, 'Setting Harga', 'Setting Harga', 'set_harga', 'flaticon2-shopping-cart', 1, 2, 1, 1, 1, 1);
INSERT INTO `m_menu` VALUES (14, 0, 'Laporan', 'Laporan', '', 'flaticon-graph', 1, 1, 5, 0, 0, 0);
INSERT INTO `m_menu` VALUES (16, 14, 'Laporan Penjualan', 'Laporan Penjualan', 'lap_penjualan', 'flaticon-statistics', 1, 2, 1, 1, 1, 1);
INSERT INTO `m_menu` VALUES (17, 0, 'Transaksi', 'Transaksi', '', 'flaticon-list', 1, 1, 4, 0, 0, 0);
INSERT INTO `m_menu` VALUES (18, 17, 'Konfirmasi Penjualan', 'Konfirmasi Penjualan', 'confirm_jual', 'flaticon-interface-10', 1, 2, 1, 1, 1, 1);
INSERT INTO `m_menu` VALUES (19, 17, 'Verifikasi Klaim', 'Verifikasi Klaim', 'verify_klaim', 'flaticon-notes', 1, 2, 2, 1, 1, 1);
INSERT INTO `m_menu` VALUES (20, 17, 'Data Penjualan Selesai', 'Data Penjualan Selesai', 'penjualan_selesai', 'flaticon-price-tag', 1, 2, 3, 1, 1, 1);

-- ----------------------------
-- Table structure for m_role
-- ----------------------------
DROP TABLE IF EXISTS `m_role`;
CREATE TABLE `m_role`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '',
  `aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of m_role
-- ----------------------------
INSERT INTO `m_role` VALUES (1, 'Administrator', 'Level Administrator Role', 1);
INSERT INTO `m_role` VALUES (2, 'Staff Admin', 'Role Untuk Staff Admin', 1);
INSERT INTO `m_role` VALUES (3, 'Agen', 'Agen (Afiliate)', 1);

-- ----------------------------
-- Table structure for m_user
-- ----------------------------
DROP TABLE IF EXISTS `m_user`;
CREATE TABLE `m_user`  (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `id_role` int(64) NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL,
  `last_login` datetime(0) NULL DEFAULT NULL,
  `kode_user` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_lengkap` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_lahir` date NULL DEFAULT NULL,
  `jenis_kelamin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `no_telp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `thumb_gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `bank` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `rekening` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `is_agen` int(1) NULL DEFAULT NULL,
  `kode_agen` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kode_affiliate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_user
-- ----------------------------
INSERT INTO `m_user` VALUES (1, 1, 'admin', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2020-12-26 22:44:09', 'USR-00001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `m_user` VALUES (2, 1, 'coba', 'Tzg1eTllUlU2a2xNQk5yYktIM1pwUT09', NULL, NULL, 'USR-00002', 'coba-1602775328.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-15 22:22:08', '2020-10-15 22:43:54', '2020-10-15 22:58:50', NULL, NULL, NULL);
INSERT INTO `m_user` VALUES (7, 3, 'agen', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2020-12-26 22:51:20', 'USR-00003', NULL, 'agen mantap bgt', NULL, NULL, NULL, '12131212', 'files/img/user_img/agen-mantap-bgt-1609006883.jpg', 'files/img/user_img/thumbs/agen-mantap-bgt-1609006883_thumb.jpg', 'agen@gmail.com', 'ABC', '19289182', '2020-12-26 22:46:00', '2020-12-27 01:21:23', NULL, NULL, 'MEM-00001', '0Q2Z2');
INSERT INTO `m_user` VALUES (8, 3, 'andrew', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, NULL, 'USR-00004', NULL, 'Andrew Agen', NULL, NULL, NULL, '1298192', NULL, NULL, 'andrew@gmail.com', 'ABU', '131412', '2020-12-26 22:47:40', '2020-12-26 22:49:28', NULL, NULL, 'MEM-00002', 'BX43C');
INSERT INTO `m_user` VALUES (9, 3, 'anwar', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, NULL, 'USR-00005', NULL, 'Anwar Bubut', NULL, NULL, NULL, '12345', NULL, NULL, 'anwar@gmail.com', 'UGD', '1902910', '2020-12-26 22:50:44', '2020-12-26 22:51:04', NULL, NULL, 'MEM-00003', '4B4VS');

-- ----------------------------
-- Table structure for t_checkout
-- ----------------------------
DROP TABLE IF EXISTS `t_checkout`;
CREATE TABLE `t_checkout`  (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `telp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `harga` double(20, 2) NULL DEFAULT NULL,
  `harga_bruto` float(20, 2) NULL DEFAULT NULL COMMENT 'harga+ongkir',
  `order_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `is_confirm` int(1) NULL DEFAULT NULL,
  `status_confirm` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'diterima, pending, dibatalkan',
  `path_file` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `path_thumb` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `is_manual` int(1) NULL DEFAULT NULL COMMENT '1 : manual, null : payment gateway',
  `kode_agen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'kode agen',
  `kode_ref` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'kode referal (jika pembelian menggunakan link affiliate)',
  `is_agen_klaim` int(1) NULL DEFAULT 0 COMMENT 'di isi satu, jika agen lain melakukan claim atas transaksi ini',
  `is_verify_klaim` int(1) NULL DEFAULT 0 COMMENT 'di isi satu jika sudah dilakukan verifikasi oleh admin',
  `id_klaim_agen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'di isi id_klaim_agen (t_klaim_agen) melakukan klaim atas transaksi ini',
  `laba_agen_total` float(20, 2) NULL DEFAULT NULL COMMENT 'di isi laba dari agen yg melakukan klaim atas transaksi ini',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_checkout
-- ----------------------------
INSERT INTO `t_checkout` VALUES (1, 'agrn@gmail.com', 'agen mantap', '12131212', 2200000.00, 2200000.00, 'delWrQ03', '', '2020-12-26 22:46:00', NULL, NULL, 1, 'diterima', 'files/img/bukti_bayar/agen-mantap-1608997560.PNG', 'files/img/bukti_bayar/thumbs/agen-mantap-1608997560_thumb.PNG', 1, 'MEM-00001', NULL, 0, 0, NULL, NULL);
INSERT INTO `t_checkout` VALUES (2, 'andrew@gmail.com', 'Andrew Agen', '1298192', 2200000.00, 2200000.00, 'lGHDdEMW', '', '2020-12-26 22:47:40', NULL, NULL, 1, 'diterima', 'files/img/bukti_bayar/andrew-agen-1608997660.PNG', 'files/img/bukti_bayar/thumbs/andrew-agen-1608997660_thumb.PNG', 1, 'MEM-00002', '0Q2Z2', 1, 1, 'c2410183-6a3d-46db-8e0d-54ac88390a4f', 660000.00);
INSERT INTO `t_checkout` VALUES (3, 'anwar@gmail.com', 'Anwar Bubut', '12345', 2200000.00, 2200000.00, 'R2grIlI9', '', '2020-12-26 22:50:44', NULL, NULL, 1, 'diterima', 'files/img/bukti_bayar/anwar-bubut-1608997844.PNG', 'files/img/bukti_bayar/thumbs/anwar-bubut-1608997844_thumb.PNG', 1, 'MEM-00003', '0Q2Z2', 1, 1, 'c2410183-6a3d-46db-8e0d-54ac88390a4f', 660000.00);

-- ----------------------------
-- Table structure for t_email
-- ----------------------------
DROP TABLE IF EXISTS `t_email`;
CREATE TABLE `t_email`  (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `id_checkout` int(64) NOT NULL,
  `isi_email` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` datetime(0) NOT NULL,
  `updated_at` datetime(0) NOT NULL,
  `deleted_at` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_email
-- ----------------------------
INSERT INTO `t_email` VALUES (1, 1, '<p>Kepada Yth.</p>\n\n<ul>\n	<li>Nama : agen mantap</li>\n	<li>Email : agrn@gmail.com</li>\n	<li>Order id : delWrQ03</li>\n</ul>\n\n<p>Terima kasih telah melakukan pendaftaran sebagai BRAND AMBASSADOR. Berikut adalah link Affiliate Anda</p>\n\n<ul>\n	<li><strong>Link Affiliate: http://localhost/cobamajang/home/aff/0Q2Z2 </strong></li>\n</ul>\n\n<p>Anda dapat melihat link Affiliate anda pada member area. Login sesuai User Dan Password anda. Salam Sukses</p>\n', '2020-12-26 22:46:31', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `t_email` VALUES (2, 2, '<p>Kepada Yth.</p>\n\n<ul>\n	<li>Nama : Andrew Agen</li>\n	<li>Email : andrew@gmail.com</li>\n	<li>Order id : lGHDdEMW</li>\n</ul>\n\n<p>Terima kasih telah melakukan pendaftaran sebagai BRAND AMBASSADOR. Berikut adalah link Affiliate Anda</p>\n\n<ul>\n	<li><strong>Link Affiliate: http://localhost/cobamajang/home/aff/BX43C </strong></li>\n</ul>\n\n<p>Anda dapat melihat link Affiliate anda pada member area. Login sesuai User Dan Password anda. Salam Sukses</p>\n', '2020-12-26 22:49:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `t_email` VALUES (3, 3, '<p>Kepada Yth.</p>\n\n<ul>\n	<li>Nama : Anwar Bubut</li>\n	<li>Email : anwar@gmail.com</li>\n	<li>Order id : R2grIlI9</li>\n</ul>\n\n<p>Terima kasih telah melakukan pendaftaran sebagai BRAND AMBASSADOR. Berikut adalah link Affiliate Anda</p>\n\n<ul>\n	<li><strong>Link Affiliate: http://localhost/cobamajang/home/aff/4B4VS </strong></li>\n</ul>\n\n<p>Anda dapat melihat link Affiliate anda pada member area. Login sesuai User Dan Password anda. Salam Sukses</p>\n', '2020-12-26 22:51:04', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for t_harga
-- ----------------------------
DROP TABLE IF EXISTS `t_harga`;
CREATE TABLE `t_harga`  (
  `id` int(64) NOT NULL,
  `nilai_harga` float(20, 2) NULL DEFAULT NULL,
  `laba_agen` float(20, 2) NULL DEFAULT NULL COMMENT 'laba agen',
  `laba_agen_persen` int(3) NULL DEFAULT NULL COMMENT 'laba agen persentase (persentase)',
  `harga_coret` float(20, 2) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_harga
-- ----------------------------
INSERT INTO `t_harga` VALUES (1, 2200000.00, 660000.00, 30, 4400000.00, '2020-12-21 23:58:37', '2020-12-22 11:14:33', NULL);
INSERT INTO `t_harga` VALUES (2, 1000.00, 10.00, 1, 100.00, '2020-12-22 11:14:33', '2020-12-22 11:15:15', NULL);
INSERT INTO `t_harga` VALUES (3, 2200000.00, 660000.00, 30, 4400000.00, '2020-12-22 11:15:15', NULL, NULL);

-- ----------------------------
-- Table structure for t_klaim_agen
-- ----------------------------
DROP TABLE IF EXISTS `t_klaim_agen`;
CREATE TABLE `t_klaim_agen`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode_agen` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_user_verify` int(11) NULL DEFAULT NULL,
  `saldo_sebelum` float(20, 2) NULL DEFAULT NULL COMMENT 'uang yg sudah diklaim ke agen',
  `jumlah_klaim` float(20, 2) NULL DEFAULT NULL COMMENT 'jumlah uang yg akan diklem oleh agen',
  `saldo_sesudah` float(20, 2) NULL DEFAULT NULL COMMENT 'uang yg sudah diklaim + jumlah uang yg akan di klem',
  `datetime_klaim` datetime(0) NULL DEFAULT NULL,
  `datetime_verify` datetime(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `kode_klaim` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'sebagai kode refferal',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_klaim_agen
-- ----------------------------
INSERT INTO `t_klaim_agen` VALUES ('c2410183-6a3d-46db-8e0d-54ac88390a4f', 'MEM-00001', 1, 0.00, 1320000.00, 1320000.00, '2020-12-26 22:51:31', '2020-12-26 23:01:17', '2020-12-26 22:51:31', NULL, 'tQ8dcje7');

-- ----------------------------
-- Table structure for t_klaim_verify
-- ----------------------------
DROP TABLE IF EXISTS `t_klaim_verify`;
CREATE TABLE `t_klaim_verify`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_klaim_agen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_user` int(11) NULL DEFAULT NULL,
  `tanggal_verify` datetime(0) NULL DEFAULT NULL,
  `bank` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `rekening` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `bukti` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nilai_transfer` float(20, 2) NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT NULL,
  `bukti_thumb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kode_verify` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_klaim_verify
-- ----------------------------
INSERT INTO `t_klaim_verify` VALUES ('e6b328aa-609e-4f1e-9690-fea800863da0', 'c2410183-6a3d-46db-8e0d-54ac88390a4f', 1, '2020-12-26 23:01:17', 'ABU', '31212', 'files/img/bukti_verifikasi/agen-mantap-1608998477.PNG', 1320000.00, 1, 'files/img/bukti_verifikasi/thumbs/agen-mantap-1608998477_thumb.PNG', 'UOI8O');

-- ----------------------------
-- Table structure for t_log_harga
-- ----------------------------
DROP TABLE IF EXISTS `t_log_harga`;
CREATE TABLE `t_log_harga`  (
  `id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `harga_satuan` double(20, 2) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `diskon_agen` int(3) NULL DEFAULT NULL COMMENT 'besaran potongan agen',
  `harga_diskon_agen` double(20, 2) NULL DEFAULT NULL COMMENT 'nilai potongan agen',
  `is_aktif` int(1) NULL DEFAULT NULL,
  `diskon_paket` int(3) NULL DEFAULT NULL COMMENT 'besaran diskon',
  `harga_diskon_paket` double(20, 2) NULL DEFAULT NULL,
  `tanggal_berlaku` timestamp(0) NULL DEFAULT NULL,
  `jenis` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of t_log_harga
-- ----------------------------

-- ----------------------------
-- Table structure for t_role_menu
-- ----------------------------
DROP TABLE IF EXISTS `t_role_menu`;
CREATE TABLE `t_role_menu`  (
  `id_menu` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `add_button` int(1) NULL DEFAULT 0,
  `edit_button` int(1) NULL DEFAULT 0,
  `delete_button` int(1) NULL DEFAULT 0,
  INDEX `f_level_user`(`id_role`) USING BTREE,
  INDEX `id_menu`(`id_menu`) USING BTREE,
  CONSTRAINT `t_role_menu_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `m_role` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_role_menu_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `m_menu` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of t_role_menu
-- ----------------------------
INSERT INTO `t_role_menu` VALUES (1, 1, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (6, 1, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (7, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (9, 1, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (10, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (17, 1, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (18, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (19, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (20, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (14, 1, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (16, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (2, 1, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (4, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (3, 1, 1, 1, 1);

-- ----------------------------
-- Table structure for tbl_requesttransaksi
-- ----------------------------
DROP TABLE IF EXISTS `tbl_requesttransaksi`;
CREATE TABLE `tbl_requesttransaksi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_code` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status_message` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `transaction_id` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `order_id` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `gross_amount` decimal(20, 2) NULL DEFAULT NULL,
  `payment_type` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `transaction_time` datetime(0) NULL DEFAULT NULL,
  `transaction_status` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `bank` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `va_number` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fraud_status` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `bca_va_number` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `permata_va_number` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pdf_url` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `finish_redirect_url` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `bill_key` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `biller_code` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `opened` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 41 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_requesttransaksi
-- ----------------------------
INSERT INTO `tbl_requesttransaksi` VALUES (24, '407', 'Success, transaction is found', '9b94fecf-b579-485b-b8b3-0f229322e3f9', '1889380294', 500000.00, 'echannel', '2020-11-03 21:03:42', 'expire', '', '', 'accept', '-', '-', 'https://app.midtrans.com/snap/v1/transactions/a73d6098-6c27-41ea-8749-77ba69099ea2/pdf', 'http://bintang.majangdapatuang.com/?order_id=1889380294&status_code=201&transaction_status=pending', '681598214185', '70012', NULL);
INSERT INTO `tbl_requesttransaksi` VALUES (25, '200', 'Success, transaction is found', '709686b3-030a-45e6-bab1-8e0027923bf6', '341527899', 10000.00, 'bank_transfer', '2020-11-03 21:09:21', 'settlement', 'bni', '8578093826283502', 'accept', '-', '-', 'https://app.midtrans.com/snap/v1/transactions/0c11f030-46ce-4526-a2f7-2f7d5f84de65/pdf', 'http://bintang.majangdapatuang.com/?order_id=341527899&status_code=201&transaction_status=pending', '-', '-', NULL);
INSERT INTO `tbl_requesttransaksi` VALUES (26, '407', 'Success, transaction is found', '9882338e-5bbb-464d-8c9d-cdd9a63663c8', '1936077081', 10000.00, 'echannel', '2020-11-05 14:19:24', 'expire', '', '', 'accept', '-', '-', 'https://app.midtrans.com/snap/v1/transactions/aa5331d1-fbc1-4eca-afb1-b102b92abdd9/pdf', 'http://bintang.majangdapatuang.com/?order_id=1936077081&status_code=201&transaction_status=pending', '914788850003', '70012', NULL);
INSERT INTO `tbl_requesttransaksi` VALUES (27, '407', 'Success, transaction is found', '9882338e-5bbb-464d-8c9d-cdd9a63663c8', '1936077081', 10000.00, 'echannel', '2020-11-05 14:19:24', 'expire', '', '', 'accept', '-', '-', 'https://app.midtrans.com/snap/v1/transactions/aa5331d1-fbc1-4eca-afb1-b102b92abdd9/pdf', 'http://bintang.majangdapatuang.com/?order_id=1936077081&status_code=201&transaction_status=pending', '914788850003', '70012', NULL);
INSERT INTO `tbl_requesttransaksi` VALUES (28, '201', 'Transaksi sedang diproses', 'b1a74851-0380-41e2-9b73-8aa6d5972a1b', '424931254', 10000.00, 'echannel', '2020-11-05 15:04:11', 'pending', '-', '-', 'accept', '-', '-', 'https://app.midtrans.com/snap/v1/transactions/1d24b662-1ca9-41d0-a1b2-3ad01663c0cf/pdf', 'http://bintang.majangdapatuang.com/?order_id=424931254&status_code=201&transaction_status=pending', '210331707955', '70012', NULL);
INSERT INTO `tbl_requesttransaksi` VALUES (29, '201', 'Transaksi sedang diproses', 'b1a74851-0380-41e2-9b73-8aa6d5972a1b', '424931254', 10000.00, 'echannel', '2020-11-05 15:04:11', 'pending', '-', '-', 'accept', '-', '-', 'https://app.midtrans.com/snap/v1/transactions/1d24b662-1ca9-41d0-a1b2-3ad01663c0cf/pdf', 'http://bintang.majangdapatuang.com/?order_id=424931254&status_code=201&transaction_status=pending', '210331707955', '70012', NULL);
INSERT INTO `tbl_requesttransaksi` VALUES (30, '201', 'Transaksi sedang diproses', 'c4c6270c-e537-48b1-93a0-5101b080eeb8', '1490242659', 10000.00, 'echannel', '2020-11-05 15:13:02', 'pending', '-', '-', 'accept', '-', '-', 'https://app.midtrans.com/snap/v1/transactions/5a7ecb97-914a-4319-976c-2004c1391b34/pdf', 'http://bintang.majangdapatuang.com/?order_id=1490242659&status_code=201&transaction_status=pending', '753057611474', '70012', NULL);
INSERT INTO `tbl_requesttransaksi` VALUES (31, '201', 'Transaksi sedang diproses', '8a8e9650-125e-443f-a4ed-e0a1d5e0f170', '1061993891', 10000.00, 'echannel', '2020-11-05 15:14:56', 'pending', '-', '-', 'accept', '-', '-', 'https://app.midtrans.com/snap/v1/transactions/5d042ef8-8ffc-460e-9bd3-1931b3d2387b/pdf', 'http://bintang.majangdapatuang.com/?order_id=1061993891&status_code=201&transaction_status=pending', '157549030186', '70012', NULL);
INSERT INTO `tbl_requesttransaksi` VALUES (32, '201', 'Transaksi sedang diproses', '33226c4f-4712-4d41-94b9-53adc9fe6e1d', '1787716092', 10000.00, 'echannel', '2020-11-05 17:27:30', 'pending', '-', '-', 'accept', '-', '-', 'https://app.midtrans.com/snap/v1/transactions/54a4bcd4-7bff-4d69-ad70-adaff93e0fb7/pdf', 'http://bintang.majangdapatuang.com/?order_id=1787716092&status_code=201&transaction_status=pending', '844328628598', '70012', NULL);
INSERT INTO `tbl_requesttransaksi` VALUES (33, '201', 'Transaksi sedang diproses', 'fce32a46-16bf-4c67-a71b-7f2f68064be9', '1407904339', 500000.00, 'bank_transfer', '2020-11-06 14:13:03', 'pending', '-', '-', 'accept', '-', '-', 'https://app.midtrans.com/snap/v1/transactions/7aceebe6-258b-4836-a5b3-1cffb4d9bb6b/pdf', 'http://bintang.majangdapatuang.com/?order_id=1407904339&status_code=201&transaction_status=pending', '-', '-', NULL);
INSERT INTO `tbl_requesttransaksi` VALUES (34, '201', 'Transaksi sedang diproses', '36d8fd1e-b47b-43e6-a755-50b0d7775468', '1987764455', 500000.00, 'echannel', '2020-11-06 14:56:39', 'pending', '-', '-', 'accept', '-', '-', 'https://app.midtrans.com/snap/v1/transactions/2b805b2a-84f9-48a2-bf8e-e769061e39e6/pdf', 'http://bintang.majangdapatuang.com/?order_id=1987764455&status_code=201&transaction_status=pending', '387411650245', '70012', NULL);
INSERT INTO `tbl_requesttransaksi` VALUES (35, '201', 'Transaksi sedang diproses', '06b0a07d-3f83-4c88-b183-1c3c8129ba72', '1331370673', 500000.00, 'bank_transfer', '2020-11-06 15:53:40', 'pending', '-', '-', 'accept', '-', '-', 'https://app.midtrans.com/snap/v1/transactions/c71f6282-e4bc-443f-aeab-74c311f4e866/pdf', 'http://bintang.majangdapatuang.com/?order_id=1331370673&status_code=201&transaction_status=pending', '-', '-', NULL);
INSERT INTO `tbl_requesttransaksi` VALUES (36, '201', 'Transaksi sedang diproses', '425ea4c0-50cf-46a2-ada3-3a33ac82156f', '1923177401', 500000.00, 'echannel', '2020-11-06 15:53:53', 'pending', '-', '-', 'accept', '-', '-', 'https://app.midtrans.com/snap/v1/transactions/24dec3d3-a478-45a0-9c0d-13b25920c244/pdf', 'http://bintang.majangdapatuang.com/?order_id=1923177401&status_code=201&transaction_status=pending', '718306814426', '70012', NULL);
INSERT INTO `tbl_requesttransaksi` VALUES (37, '201', 'Transaksi sedang diproses', '9ac64869-11b1-4c47-a40f-14577bc23110', '1688502565', 500000.00, 'bank_transfer', '2020-11-06 16:13:21', 'pending', '-', '-', 'accept', '-', '-', 'https://app.midtrans.com/snap/v1/transactions/2a811bab-de17-4afc-a15c-8676a0b481b6/pdf', 'http://bintang.majangdapatuang.com/?order_id=1688502565&status_code=201&transaction_status=pending', '-', '-', NULL);
INSERT INTO `tbl_requesttransaksi` VALUES (38, '201', 'Transaksi sedang diproses', '197d648b-d103-4a63-bc6e-a331aed6c025', '1138324827', 500000.00, 'bank_transfer', '2020-11-06 16:18:49', 'pending', '-', '-', 'accept', '-', '8778003053516993', 'https://app.midtrans.com/snap/v1/transactions/520920f4-a54e-486d-93b0-443671d637a7/pdf', 'http://bintang.majangdapatuang.com/?order_id=1138324827&status_code=201&transaction_status=pending', '-', '-', NULL);
INSERT INTO `tbl_requesttransaksi` VALUES (39, '200', 'Success, transaction is found', 'f7180070-2e0c-4bc5-8b46-9c423da21476', '1391010273', 30000.00, 'bank_transfer', '2020-11-06 16:48:33', 'settlement', 'bni', '8578829459416468', 'accept', '-', '-', 'https://app.midtrans.com/snap/v1/transactions/79227f2f-49c5-4e38-b790-e14937b92536/pdf', 'http://bintang.majangdapatuang.com/?order_id=1391010273&status_code=201&transaction_status=pending', '-', '-', NULL);
INSERT INTO `tbl_requesttransaksi` VALUES (40, '500', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', NULL, '-', '-', NULL, NULL, '-', '-', NULL);

SET FOREIGN_KEY_CHECKS = 1;

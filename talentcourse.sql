/*
 Navicat Premium Data Transfer

 Source Server         : local-mysql
 Source Server Type    : MySQL
 Source Server Version : 100413
 Source Host           : localhost:3306
 Source Schema         : talentcourse

 Target Server Type    : MySQL
 Target Server Version : 100413
 File Encoding         : 65001

 Date: 27/10/2020 20:42:06
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for m_diskon
-- ----------------------------
DROP TABLE IF EXISTS `m_diskon`;
CREATE TABLE `m_diskon`  (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `besaran` int(20) NULL DEFAULT NULL COMMENT 'dalam persen',
  `kode_ref_diskon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_diskon
-- ----------------------------
INSERT INTO `m_diskon` VALUES (1, 'Diskon Akhir Tahun', 25, 'NewYear2020', '2020-10-17 21:58:14', NULL, NULL);

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
INSERT INTO `m_menu` VALUES (2, 0, 'Setting (Administrator)', 'Setting', NULL, 'flaticon2-gear', 1, 1, 5, 0, 0, 0);
INSERT INTO `m_menu` VALUES (3, 2, 'Setting Menu', 'Setting Menu', 'set_menu', 'flaticon-grid-menu', 1, 2, 2, 1, 1, 1);
INSERT INTO `m_menu` VALUES (4, 2, 'Setting Role', 'Setting Role', 'set_role', 'flaticon-network', 1, 2, 1, 1, 1, 1);
INSERT INTO `m_menu` VALUES (6, 0, 'Master', 'Master', '', 'flaticon-folder-1', 1, 1, 2, 0, 0, 0);
INSERT INTO `m_menu` VALUES (7, 6, 'Data User', 'Data User', 'master_user', 'flaticon-users', 1, 2, 1, 1, 1, 1);
INSERT INTO `m_menu` VALUES (8, 6, 'Data Diskon', 'Master Data Diskon', 'master_diskon', 'flaticon-price-tag', 1, 2, 2, 1, 1, 1);
INSERT INTO `m_menu` VALUES (9, 0, 'Manajemen Konten', 'Manajemen Konten', '', 'flaticon-profile', 1, 1, 3, 0, 0, 0);
INSERT INTO `m_menu` VALUES (10, 9, 'Setting Harga', 'Setting Harga', 'set_harga', 'flaticon2-shopping-cart', 1, 2, 1, 1, 1, 1);
INSERT INTO `m_menu` VALUES (11, 6, 'Data Talent', 'Master Data Talent', 'master_talent', 'flaticon-customer', 1, 2, 3, 1, 1, 1);
INSERT INTO `m_menu` VALUES (12, 9, 'Setting Aktif Talent', 'Setting Aktif Talent', 'set_aktif_talent', 'flaticon-user', 1, 2, 2, 1, 1, 1);
INSERT INTO `m_menu` VALUES (13, 9, 'Set Galeri Konten', 'Set Galeri Konten', 'set_galeri_konten', 'flaticon-user-settings', 1, 2, 3, 1, 1, 1);
INSERT INTO `m_menu` VALUES (14, 0, 'Laporan', 'Laporan', '', 'flaticon-graph', 1, 1, 4, 0, 0, 0);
INSERT INTO `m_menu` VALUES (15, 9, 'Setting Video Konten', 'Setting Video Konten', 'set_video_konten', 'flaticon-technology-2', 1, 2, 4, 1, 1, 1);
INSERT INTO `m_menu` VALUES (16, 14, 'Laporan Penjualan', 'Laporan Penjualan', 'lap_penjualan', 'flaticon-statistics', 1, 2, 1, 1, 1, 1);

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
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of m_role
-- ----------------------------
INSERT INTO `m_role` VALUES (1, 'Administrator', 'Level Administrator Role', 1);
INSERT INTO `m_role` VALUES (2, 'Staff Admin', 'Role Untuk Staff Admin', 1);

-- ----------------------------
-- Table structure for m_talent
-- ----------------------------
DROP TABLE IF EXISTS `m_talent`;
CREATE TABLE `m_talent`  (
  `id` int(11) NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `akun_ig` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `akun_fb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `akun_tw` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `foto_thumb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_talent
-- ----------------------------
INSERT INTO `m_talent` VALUES (1, 'via vallen', '<p>asahkshaksjhakshakshaksaksha</p>', '2020-10-19 22:08:44', '2020-10-19 23:07:34', NULL, '', '', '', 'files/img/talent_img/1/via-vallen-1603120124.jpg', 'files/img/talent_img/1/thumbs/via-vallen-1603120124_thumb.jpg');
INSERT INTO `m_talent` VALUES (2, 'anton', '<p>askjdkasjdkasjd kasdjkas jdkasjd kasjdkajs kajsd</p>\n\n<p>anmsmansm</p>', '2020-10-19 22:14:23', '2020-10-19 22:22:19', NULL, 'asa', 'asasaaaaa', 'as', 'files/img/talent_img/2/anton-1603120939.jpg', 'files/img/talent_img/2/thumbs/anton-1603120939_thumb.jpg');

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
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_user
-- ----------------------------
INSERT INTO `m_user` VALUES (1, 1, 'admin', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2020-10-27 00:38:10', 'USR-00001', NULL, NULL, NULL, NULL);
INSERT INTO `m_user` VALUES (2, 1, 'coba', 'Tzg1eTllUlU2a2xNQk5yYktIM1pwUT09', NULL, NULL, 'USR-00002', 'coba-1602775328.jpg', '2020-10-15 22:22:08', '2020-10-15 22:43:54', '2020-10-15 22:58:50');

-- ----------------------------
-- Table structure for t_aktif_talent
-- ----------------------------
DROP TABLE IF EXISTS `t_aktif_talent`;
CREATE TABLE `t_aktif_talent`  (
  `id` int(11) NOT NULL,
  `id_talent` int(11) NULL DEFAULT NULL,
  `created_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `deleted_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_aktif_talent
-- ----------------------------
INSERT INTO `t_aktif_talent` VALUES (1, 1, '2020-10-22 21:51:45', NULL, NULL);

-- ----------------------------
-- Table structure for t_checkout
-- ----------------------------
DROP TABLE IF EXISTS `t_checkout`;
CREATE TABLE `t_checkout`  (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `kode_ref` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `telp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'reguler/eksklusif',
  `harga` double(20, 2) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_checkout
-- ----------------------------
INSERT INTO `t_checkout` VALUES (1, 'oxqSwDoQ', 'masnur@ganteng.com', 'masnur', NULL, 'eksklusif', 1000000.00, '2020-10-24 19:03:49', NULL, NULL);
INSERT INTO `t_checkout` VALUES (2, 'Sk1pheB7', 'masnur@ganteng.com', 'masnur', NULL, 'eksklusif', 1000000.00, '2020-10-24 19:05:24', NULL, NULL);
INSERT INTO `t_checkout` VALUES (3, 'ms8rVtOz', 'masnur@ganteng.com', 'masnur', NULL, 'reguler', 400000.00, '2020-10-24 19:06:00', NULL, NULL);
INSERT INTO `t_checkout` VALUES (4, 'JlAiSaZG', 'aksjak@alskal.com', 'ulala', NULL, 'eksklusif', 1000000.00, '2020-10-24 22:25:33', NULL, NULL);
INSERT INTO `t_checkout` VALUES (5, 'VvCSuQfT', 'asa@gmail.com', 'masnur', NULL, 'reguler', 400000.00, '2020-10-24 22:27:49', NULL, NULL);

-- ----------------------------
-- Table structure for t_file_talent
-- ----------------------------
DROP TABLE IF EXISTS `t_file_talent`;
CREATE TABLE `t_file_talent`  (
  `id` int(64) NOT NULL,
  `id_talent` int(64) NULL DEFAULT NULL,
  `path_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `path_file_thumb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_file_talent
-- ----------------------------
INSERT INTO `t_file_talent` VALUES (1, 1, 'files/img/talent_img/1/1-via-vallen-1603125855.jpg', 'files/img/talent_img/1/thumbs/1-via-vallen-1603125855_thumb.jpg', '2020-10-19 23:44:15', NULL, '2020-10-24 22:54:05');
INSERT INTO `t_file_talent` VALUES (2, 1, 'files/img/talent_img/2/2-via-vallen-1603126013.jpg', 'files/img/talent_img/1/thumbs/2-via-vallen-1603126013_thumb.jpg', '2020-10-19 23:46:53', NULL, '2020-10-24 22:54:09');
INSERT INTO `t_file_talent` VALUES (3, 1, 'files/img/talent_img/3/3-via-vallen-1603209362.jpg', 'files/img/talent_img/1/thumbs/3-via-vallen-1603209362_thumb.jpg', '2020-10-20 22:56:02', NULL, '2020-10-24 22:54:14');
INSERT INTO `t_file_talent` VALUES (4, 1, 'files/img/talent_img/1/4-via-vallen-1603210084.jpeg', 'files/img/talent_img/1/thumbs/4-via-vallen-1603210084_thumb.jpeg', '2020-10-20 23:08:04', NULL, '2020-10-24 22:54:17');
INSERT INTO `t_file_talent` VALUES (5, 2, 'files/img/talent_img/2/5-anton-1603244548.jpg', 'files/img/talent_img/2/thumbs/5-anton-1603244548_thumb.jpg', '2020-10-21 08:42:28', NULL, NULL);
INSERT INTO `t_file_talent` VALUES (6, 2, 'files/img/talent_img/2/6-anton-1603244580.jpg', 'files/img/talent_img/2/thumbs/6-anton-1603244580_thumb.jpg', '2020-10-21 08:43:00', NULL, NULL);
INSERT INTO `t_file_talent` VALUES (7, 1, 'files/img/talent_img/1/7-via-vallen-1603383129.jpg', 'files/img/talent_img/1/thumbs/7-via-vallen-1603383129_thumb.jpg', '2020-10-22 23:12:09', NULL, '2020-10-24 22:54:21');
INSERT INTO `t_file_talent` VALUES (8, 1, 'files/img/talent_img/1/8-via-vallen-1603383332.jpg', 'files/img/talent_img/1/thumbs/8-via-vallen-1603383332_thumb.jpg', '2020-10-22 23:15:32', NULL, '2020-10-24 22:54:26');
INSERT INTO `t_file_talent` VALUES (9, 1, 'files/img/talent_img/1/9-via-vallen-1603383428.jpg', 'files/img/talent_img/1/thumbs/9-via-vallen-1603383428_thumb.jpg', '2020-10-22 23:17:08', NULL, '2020-10-24 22:54:31');
INSERT INTO `t_file_talent` VALUES (10, 1, 'files/img/talent_img/1/10-via-vallen-1603383925.jpg', 'files/img/talent_img/1/thumbs/10-via-vallen-1603383925_thumb.jpg', '2020-10-22 23:25:25', NULL, '2020-10-24 22:54:35');
INSERT INTO `t_file_talent` VALUES (11, 1, 'files/img/talent_img/1/11-via-vallen-1603384021.jpg', 'files/img/talent_img/1/thumbs/11-via-vallen-1603384021_thumb.jpg', '2020-10-22 23:27:01', NULL, '2020-10-24 22:54:40');
INSERT INTO `t_file_talent` VALUES (12, 1, 'files/img/talent_img/1/12-via-vallen-1603384282.jpg', 'files/img/talent_img/1/thumbs/12-via-vallen-1603384282_thumb.jpg', '2020-10-22 23:31:22', NULL, '2020-10-24 22:54:42');
INSERT INTO `t_file_talent` VALUES (13, 1, 'files/img/talent_img/1/13-via-vallen-1603384840.jpg', 'files/img/talent_img/1/thumbs/13-via-vallen-1603384840_thumb.jpg', '2020-10-22 23:40:40', NULL, '2020-10-24 22:54:47');
INSERT INTO `t_file_talent` VALUES (14, 1, 'files/img/talent_img/1/14-via-vallen-1603554901.jpg', 'files/img/talent_img/1/thumbs/14-via-vallen-1603554901_thumb.jpg', '2020-10-24 22:55:01', NULL, NULL);
INSERT INTO `t_file_talent` VALUES (15, 1, 'files/img/talent_img/1/15-via-vallen-1603554912.jpg', 'files/img/talent_img/1/thumbs/15-via-vallen-1603554912_thumb.jpg', '2020-10-24 22:55:12', NULL, NULL);
INSERT INTO `t_file_talent` VALUES (16, 1, 'files/img/talent_img/1/16-via-vallen-1603554924.jpg', 'files/img/talent_img/1/thumbs/16-via-vallen-1603554924_thumb.jpg', '2020-10-24 22:55:24', NULL, NULL);
INSERT INTO `t_file_talent` VALUES (17, 1, 'files/img/talent_img/1/17-via-vallen-1603554941.jpg', 'files/img/talent_img/1/thumbs/17-via-vallen-1603554941_thumb.jpg', '2020-10-24 22:55:41', NULL, NULL);
INSERT INTO `t_file_talent` VALUES (18, 1, 'files/img/talent_img/1/18-via-vallen-1603554970.jpg', 'files/img/talent_img/1/thumbs/18-via-vallen-1603554970_thumb.jpg', '2020-10-24 22:56:10', NULL, NULL);
INSERT INTO `t_file_talent` VALUES (19, 1, 'files/img/talent_img/1/19-via-vallen-1603554981.jpg', 'files/img/talent_img/1/thumbs/19-via-vallen-1603554981_thumb.jpg', '2020-10-24 22:56:21', NULL, NULL);
INSERT INTO `t_file_talent` VALUES (20, 1, 'files/img/talent_img/1/20-via-vallen-1603554993.jpg', 'files/img/talent_img/1/thumbs/20-via-vallen-1603554993_thumb.jpg', '2020-10-24 22:56:33', NULL, NULL);
INSERT INTO `t_file_talent` VALUES (21, 1, 'files/img/talent_img/1/21-via-vallen-1603555013.jpg', 'files/img/talent_img/1/thumbs/21-via-vallen-1603555013_thumb.jpg', '2020-10-24 22:56:53', NULL, NULL);

-- ----------------------------
-- Table structure for t_galeri_konten
-- ----------------------------
DROP TABLE IF EXISTS `t_galeri_konten`;
CREATE TABLE `t_galeri_konten`  (
  `id` int(11) NOT NULL,
  `id_talent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_t_file_talent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `urutan` int(5) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_galeri_konten
-- ----------------------------
INSERT INTO `t_galeri_konten` VALUES (1, '1', '3', 1, '2020-10-23 23:29:34', NULL, '2020-10-27 00:38:56');
INSERT INTO `t_galeri_konten` VALUES (2, '1', '1', 2, '2020-10-23 23:30:01', NULL, '2020-10-24 22:57:10');
INSERT INTO `t_galeri_konten` VALUES (3, '1', '4', 3, '2020-10-23 23:30:53', NULL, '2020-10-24 22:57:14');
INSERT INTO `t_galeri_konten` VALUES (4, '1', '8', 4, '2020-10-23 23:45:39', NULL, '2020-10-23 23:59:27');
INSERT INTO `t_galeri_konten` VALUES (5, '1', '10', 5, '2020-10-23 23:45:53', NULL, '2020-10-23 23:59:23');
INSERT INTO `t_galeri_konten` VALUES (6, '1', '8', 4, '2020-10-23 23:59:36', NULL, '2020-10-24 22:57:17');
INSERT INTO `t_galeri_konten` VALUES (7, '1', '14', 1, '2020-10-24 22:57:26', NULL, NULL);
INSERT INTO `t_galeri_konten` VALUES (8, '1', '15', 2, '2020-10-24 22:57:33', NULL, NULL);
INSERT INTO `t_galeri_konten` VALUES (9, '1', '16', 3, '2020-10-24 22:57:40', NULL, NULL);
INSERT INTO `t_galeri_konten` VALUES (10, '1', '17', 4, '2020-10-24 22:57:49', NULL, NULL);
INSERT INTO `t_galeri_konten` VALUES (11, '1', '18', 5, '2020-10-24 22:57:59', NULL, NULL);
INSERT INTO `t_galeri_konten` VALUES (12, '1', '19', 6, '2020-10-24 22:59:38', NULL, NULL);
INSERT INTO `t_galeri_konten` VALUES (13, '1', '20', 7, '2020-10-24 23:00:30', NULL, NULL);
INSERT INTO `t_galeri_konten` VALUES (14, '1', '21', 8, '2020-10-24 23:00:40', NULL, NULL);

-- ----------------------------
-- Table structure for t_harga
-- ----------------------------
DROP TABLE IF EXISTS `t_harga`;
CREATE TABLE `t_harga`  (
  `id` int(64) NOT NULL,
  `jenis_harga` int(1) NULL DEFAULT NULL COMMENT '1: reguler / 2: ekslusif',
  `is_diskon` int(1) NULL DEFAULT NULL,
  `id_m_diskon` int(64) NULL DEFAULT NULL,
  `id_talent` int(64) NULL DEFAULT NULL,
  `nilai_harga` float(20, 2) NULL DEFAULT NULL,
  `tgl_mulai_diskon` date NULL DEFAULT NULL,
  `tgl_akhir_diskon` date NULL DEFAULT NULL,
  `masa_berlaku_diskon` int(6) NULL DEFAULT NULL COMMENT 'satuan hari',
  `created_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_harga
-- ----------------------------
INSERT INTO `t_harga` VALUES (1, 1, 1, 1, 1, 400000.00, '2020-10-21', '2020-11-02', 12, '2020-10-21 22:53:19', '2020-10-22 21:33:22', NULL);
INSERT INTO `t_harga` VALUES (2, 2, 1, 1, 1, 1000000.00, '2020-10-22', '2020-10-25', 3, '2020-10-22 21:32:07', '2020-10-22 21:33:27', NULL);
INSERT INTO `t_harga` VALUES (3, 1, NULL, NULL, 1, 400000.00, NULL, NULL, NULL, '2020-10-22 21:33:22', '2020-10-23 21:47:53', NULL);
INSERT INTO `t_harga` VALUES (4, 2, NULL, NULL, 1, 1000000.00, NULL, NULL, NULL, '2020-10-22 21:33:27', '2020-10-23 21:48:26', NULL);
INSERT INTO `t_harga` VALUES (5, 1, 1, 1, 1, 400000.00, '2020-10-23', '2020-11-12', 20, '2020-10-23 21:47:53', '2020-10-23 21:48:32', NULL);
INSERT INTO `t_harga` VALUES (6, 2, 1, 1, 1, 1000000.00, '2020-10-23', '2020-11-17', 25, '2020-10-23 21:48:26', '2020-10-23 21:48:38', NULL);
INSERT INTO `t_harga` VALUES (7, 1, NULL, NULL, 1, 400000.00, NULL, NULL, NULL, '2020-10-23 21:48:32', '2020-10-24 00:06:38', NULL);
INSERT INTO `t_harga` VALUES (8, 2, NULL, NULL, 1, 1000000.00, NULL, NULL, NULL, '2020-10-23 21:48:38', '2020-10-24 00:07:20', NULL);
INSERT INTO `t_harga` VALUES (9, 1, 1, 1, 1, 400000.00, '2020-10-24', '2020-10-27', 3, '2020-10-24 00:06:38', '2020-10-25 23:28:54', NULL);
INSERT INTO `t_harga` VALUES (10, 2, 1, 1, 1, 1100000.00, '2020-10-24', '2020-10-27', 3, '2020-10-24 00:07:20', '2020-10-25 23:28:59', NULL);
INSERT INTO `t_harga` VALUES (11, 1, NULL, NULL, 1, 400000.00, NULL, NULL, NULL, '2020-10-25 23:28:54', '2020-10-25 23:31:02', NULL);
INSERT INTO `t_harga` VALUES (12, 2, NULL, NULL, 1, 1100000.00, NULL, NULL, NULL, '2020-10-25 23:28:59', '2020-10-25 23:31:31', NULL);
INSERT INTO `t_harga` VALUES (13, 1, 1, 1, 1, 400000.00, '2020-10-25', '2020-10-28', 3, '2020-10-25 23:31:02', NULL, NULL);
INSERT INTO `t_harga` VALUES (14, 2, 1, 1, 1, 1100000.00, '2020-10-25', '2020-10-28', 3, '2020-10-25 23:31:31', NULL, NULL);

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
INSERT INTO `t_role_menu` VALUES (8, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (11, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (9, 1, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (10, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (12, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (13, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (15, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (14, 1, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (16, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (2, 1, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (4, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (3, 1, 1, 1, 1);

-- ----------------------------
-- Table structure for t_video_konten
-- ----------------------------
DROP TABLE IF EXISTS `t_video_konten`;
CREATE TABLE `t_video_konten`  (
  `id` int(64) NOT NULL,
  `id_talent` int(64) NULL DEFAULT NULL,
  `id_t_video_talent` int(64) NULL DEFAULT NULL,
  `urutan` int(5) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_video_konten
-- ----------------------------
INSERT INTO `t_video_konten` VALUES (1, 1, 1, 1, '2020-10-25 20:43:56', NULL, '2020-10-27 00:42:06');
INSERT INTO `t_video_konten` VALUES (2, 1, 3, 1, '2020-10-27 00:44:55', NULL, '2020-10-27 00:47:50');
INSERT INTO `t_video_konten` VALUES (3, 1, 1, 1, '2020-10-27 00:47:57', NULL, NULL);

-- ----------------------------
-- Table structure for t_video_talent
-- ----------------------------
DROP TABLE IF EXISTS `t_video_talent`;
CREATE TABLE `t_video_talent`  (
  `id` int(64) NOT NULL,
  `id_talent` int(64) NULL DEFAULT NULL,
  `path_video` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_video_talent
-- ----------------------------
INSERT INTO `t_video_talent` VALUES (1, 1, 'files/img/talent_img/1/1-video-via-vallen-1603612269.mp4', '2020-10-25 14:51:09', NULL, NULL);
INSERT INTO `t_video_talent` VALUES (2, 1, 'files/img/talent_img/1/2-video-via-vallen-1603612532.mp4', '2020-10-25 14:55:32', NULL, '2020-10-25 14:58:27');
INSERT INTO `t_video_talent` VALUES (3, 1, 'files/img/talent_img/1/3-video-via-vallen-1603734283.mp4', '2020-10-27 00:44:43', NULL, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_requesttransaksi
-- ----------------------------
INSERT INTO `tbl_requesttransaksi` VALUES (1, '201', 'Transaksi sedang diproses', '7ca417b3-e336-4469-804c-ab5b0aed7c74', '1046922258', 1004000.00, 'bank_transfer', '2020-10-25 10:57:14', 'pending', '-', '-', 'accept', '02497307799', '-', 'https://app.sandbox.midtrans.com/snap/v1/transactions/27fbcd87-ef50-44e2-ae82-424c80cb79fb/pdf', 'http://example.com?order_id=1046922258&status_code=201&transaction_status=pending', '-', '-', NULL);
INSERT INTO `tbl_requesttransaksi` VALUES (2, '201', 'Transaksi sedang diproses', '1bae300b-ab85-4e99-9333-46418c3f064f', '1809334', 404000.00, 'cstore', '2020-10-25 22:04:38', 'pending', '-', '-', NULL, '-', '-', 'https://app.sandbox.midtrans.com/snap/v1/transactions/b4ef0617-ab9b-44c4-9c5d-9e7ecd11dafb/pdf', 'http://example.com?order_id=1809334&status_code=201&transaction_status=pending', '-', '-', NULL);

SET FOREIGN_KEY_CHECKS = 1;

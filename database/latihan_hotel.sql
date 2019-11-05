/*
Navicat MySQL Data Transfer

Source Server         : xampp_localhost
Source Server Version : 50620
Source Host           : localhost:3306
Source Database       : latihan_hotel

Target Server Type    : MYSQL
Target Server Version : 50620
File Encoding         : 65001

Date: 2019-11-05 15:05:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tbl_jasa`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_jasa`;
CREATE TABLE `tbl_jasa` (
  `id_jasa` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `unit_jasa` varchar(191) NOT NULL,
  `harga_jasa` bigint(20) NOT NULL,
  PRIMARY KEY (`id_jasa`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_jasa
-- ----------------------------
INSERT INTO `tbl_jasa` VALUES ('3', 'Laundry', '12000');

-- ----------------------------
-- Table structure for `tbl_kamar`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_kamar`;
CREATE TABLE `tbl_kamar` (
  `id_kamar` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_kamar` varchar(10) NOT NULL,
  `status_kamar` tinyint(1) NOT NULL,
  `harga_kamar` bigint(20) NOT NULL,
  `tgl_check_in` date NOT NULL,
  `tgl_check_out` date NOT NULL,
  PRIMARY KEY (`id_kamar`,`kode_kamar`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_kamar
-- ----------------------------
INSERT INTO `tbl_kamar` VALUES ('10', '103', '0', '450000', '2019-10-31', '2019-10-31');
INSERT INTO `tbl_kamar` VALUES ('12', '102', '0', '2500000', '2019-11-01', '2019-11-01');
INSERT INTO `tbl_kamar` VALUES ('13', '124', '0', '700000', '2019-11-05', '2019-11-05');

-- ----------------------------
-- Table structure for `tbl_tagihan`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_tagihan`;
CREATE TABLE `tbl_tagihan` (
  `no_transaksi` varchar(191) NOT NULL,
  `id_tamu` bigint(20) NOT NULL,
  `total_tagihan` bigint(20) NOT NULL,
  `isseud_date` date NOT NULL,
  PRIMARY KEY (`no_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_tagihan
-- ----------------------------
INSERT INTO `tbl_tagihan` VALUES ('TGH20191105144306', '19', '12500000', '2019-11-05');

-- ----------------------------
-- Table structure for `tbl_tamu`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_tamu`;
CREATE TABLE `tbl_tamu` (
  `id_tamu` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_kamar` bigint(20) NOT NULL,
  `nama` varchar(191) NOT NULL,
  `alamat` varchar(191) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `pekerjaan` varchar(191) NOT NULL,
  `no_telp` char(15) NOT NULL,
  PRIMARY KEY (`id_tamu`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_tamu
-- ----------------------------
INSERT INTO `tbl_tamu` VALUES ('19', '12', 'Ocang', 'Mangga 2', '0', 'Siswa SMK', '085240851516');

-- ----------------------------
-- Table structure for `tbl_transaksi_jasa`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_transaksi_jasa`;
CREATE TABLE `tbl_transaksi_jasa` (
  `no_transaksi` varchar(191) NOT NULL,
  `id_tamu` bigint(10) NOT NULL,
  `id_jasa` bigint(10) NOT NULL,
  `issued_date` date NOT NULL,
  PRIMARY KEY (`no_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_transaksi_jasa
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_user`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `id_user` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `user_level` enum('USER','ADMIN') NOT NULL,
  `id_tamu` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_user`,`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'ADMIN', null);

-- ----------------------------
-- View structure for `view_tagihan`
-- ----------------------------
DROP VIEW IF EXISTS `view_tagihan`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_tagihan` AS select `tbl_tagihan`.`no_transaksi` AS `no_transaksi`,`tbl_tagihan`.`id_tamu` AS `id_tamu`,`tbl_tagihan`.`total_tagihan` AS `total_tagihan`,`tbl_tagihan`.`isseud_date` AS `isseud_date`,`tbl_tamu`.`nama` AS `nama`,`tbl_tamu`.`id_kamar` AS `id_kamar`,`tbl_kamar`.`kode_kamar` AS `kode_kamar` from ((`tbl_tagihan` join `tbl_tamu` on((`tbl_tagihan`.`id_tamu` = `tbl_tamu`.`id_tamu`))) join `tbl_kamar` on((`tbl_tamu`.`id_kamar` = `tbl_kamar`.`id_kamar`))) ;

-- ----------------------------
-- View structure for `view_tamu`
-- ----------------------------
DROP VIEW IF EXISTS `view_tamu`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_tamu` AS select `tbl_tamu`.`id_tamu` AS `id_tamu`,`tbl_tamu`.`id_kamar` AS `id_kamar`,`tbl_tamu`.`nama` AS `nama`,`tbl_tamu`.`alamat` AS `alamat`,`tbl_tamu`.`status` AS `status`,`tbl_tamu`.`pekerjaan` AS `pekerjaan`,`tbl_tamu`.`no_telp` AS `no_telp`,`tbl_kamar`.`kode_kamar` AS `kode_kamar`,`tbl_kamar`.`tgl_check_in` AS `tgl_check_in`,`tbl_kamar`.`tgl_check_out` AS `tgl_check_out`,`tbl_kamar`.`harga_kamar` AS `harga_kamar`,`tbl_kamar`.`status_kamar` AS `status_kamar` from (`tbl_kamar` join `tbl_tamu` on((`tbl_tamu`.`id_kamar` = `tbl_kamar`.`id_kamar`))) ;

-- ----------------------------
-- View structure for `view_transaksi_jasa`
-- ----------------------------
DROP VIEW IF EXISTS `view_transaksi_jasa`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_transaksi_jasa` AS select `tbl_transaksi_jasa`.`no_transaksi` AS `no_transaksi`,`tbl_transaksi_jasa`.`id_tamu` AS `id_tamu`,`tbl_transaksi_jasa`.`id_jasa` AS `id_jasa`,`tbl_transaksi_jasa`.`issued_date` AS `issued_date`,`tbl_tamu`.`status` AS `status`,`tbl_tamu`.`nama` AS `nama`,`tbl_jasa`.`unit_jasa` AS `unit_jasa`,`tbl_jasa`.`harga_jasa` AS `harga_jasa`,`tbl_kamar`.`kode_kamar` AS `kode_kamar` from (((`tbl_transaksi_jasa` join `tbl_tamu` on((`tbl_transaksi_jasa`.`id_tamu` = `tbl_tamu`.`id_tamu`))) join `tbl_jasa` on((`tbl_transaksi_jasa`.`id_jasa` = `tbl_jasa`.`id_jasa`))) join `tbl_kamar` on((`tbl_tamu`.`id_kamar` = `tbl_kamar`.`id_kamar`))) ;

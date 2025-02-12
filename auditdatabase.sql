/*
 Navicat Premium Data Transfer

 Source Server         : mariaDB
 Source Server Type    : MariaDB
 Source Server Version : 110502
 Source Host           : localhost:3306
 Source Schema         : auditdatabase

 Target Server Type    : MariaDB
 Target Server Version : 110502
 File Encoding         : 65001

 Date: 08/02/2025 23:43:34
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for Bidang_Usaha
-- ----------------------------
DROP TABLE IF EXISTS `Bidang_Usaha`;
CREATE TABLE `Bidang_Usaha` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

-- ----------------------------
-- Records of Bidang_Usaha
-- ----------------------------
BEGIN;
INSERT INTO `Bidang_Usaha` VALUES (1, 'Pertanian, Perkebunan, Kehutanan, Peternakan, Kelautan dan Perikanan');
INSERT INTO `Bidang_Usaha` VALUES (2, 'Pertambangan dan Energi');
INSERT INTO `Bidang_Usaha` VALUES (3, 'Properti dan Konstruksi');
INSERT INTO `Bidang_Usaha` VALUES (4, 'Industri Pengolahan/Manufaktur');
INSERT INTO `Bidang_Usaha` VALUES (5, 'Perdagangan dan Jasa');
INSERT INTO `Bidang_Usaha` VALUES (6, 'Informasi, Komunikasi dan Transportasi');
INSERT INTO `Bidang_Usaha` VALUES (7, 'Sektor Keuangan - Perbankan');
INSERT INTO `Bidang_Usaha` VALUES (8, 'Sektor Keuangan - Asuransi dan Dana Pensiun');
INSERT INTO `Bidang_Usaha` VALUES (9, 'Sektor Keuangan - Lainnya');
INSERT INTO `Bidang_Usaha` VALUES (10, 'Industri Lainnya');
INSERT INTO `Bidang_Usaha` VALUES (11, 'Pemerintahan, Badan Internasional dan Organisasi Non Profit');
INSERT INTO `Bidang_Usaha` VALUES (12, 'Non Industri/Perorangan');
COMMIT;

-- ----------------------------
-- Table structure for Go_Publik
-- ----------------------------
DROP TABLE IF EXISTS `Go_Publik`;
CREATE TABLE `Go_Publik` (
  `ID` int(11) NOT NULL,
  `Description` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

-- ----------------------------
-- Records of Go_Publik
-- ----------------------------
BEGIN;
INSERT INTO `Go_Publik` VALUES (0, 'Tidak');
INSERT INTO `Go_Publik` VALUES (1, 'Ya');
COMMIT;

-- ----------------------------
-- Table structure for JASA_NON_ASURANSI
-- ----------------------------
DROP TABLE IF EXISTS `JASA_NON_ASURANSI`;
CREATE TABLE `JASA_NON_ASURANSI` (
  `id` int(11) NOT NULL,
  `nama_jasa` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of JASA_NON_ASURANSI
-- ----------------------------
BEGIN;
INSERT INTO `JASA_NON_ASURANSI` VALUES (1, 'Audit Kinerja');
INSERT INTO `JASA_NON_ASURANSI` VALUES (2, 'Internal Audit');
INSERT INTO `JASA_NON_ASURANSI` VALUES (3, 'Perpajakan');
INSERT INTO `JASA_NON_ASURANSI` VALUES (4, 'Kompilasi LK');
INSERT INTO `JASA_NON_ASURANSI` VALUES (5, 'Pembukuan');
INSERT INTO `JASA_NON_ASURANSI` VALUES (6, 'Prosedur Yang Disepakati Atas LK');
INSERT INTO `JASA_NON_ASURANSI` VALUES (7, 'Sistem Teknologi Informasi');
INSERT INTO `JASA_NON_ASURANSI` VALUES (8, 'Pembelian dan Penjualan Properti');
INSERT INTO `JASA_NON_ASURANSI` VALUES (9, 'Pengelolaan Terhadap Uang, Efek, dan/atau Produk Jasa Keuangan Lainnya');
INSERT INTO `JASA_NON_ASURANSI` VALUES (10, 'Pengelolaan Rekening Giro, Rekening Tabungan, Rekening Deposito, dan/atau Rekening Efek');
INSERT INTO `JASA_NON_ASURANSI` VALUES (11, 'Pengoperasian dan Pengelolaan Perusahaan');
INSERT INTO `JASA_NON_ASURANSI` VALUES (12, 'Pendirian, Pembelian, dan Penjualan Badan Usaha');
INSERT INTO `JASA_NON_ASURANSI` VALUES (99, 'Lainnya');
COMMIT;

-- ----------------------------
-- Table structure for Jenis_LK
-- ----------------------------
DROP TABLE IF EXISTS `Jenis_LK`;
CREATE TABLE `Jenis_LK` (
  `ID` int(11) NOT NULL,
  `Name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

-- ----------------------------
-- Records of Jenis_LK
-- ----------------------------
BEGIN;
INSERT INTO `Jenis_LK` VALUES (1, 'Tahunan');
INSERT INTO `Jenis_LK` VALUES (2, 'Interim');
COMMIT;

-- ----------------------------
-- Table structure for Kepemilikan
-- ----------------------------
DROP TABLE IF EXISTS `Kepemilikan`;
CREATE TABLE `Kepemilikan` (
  `ID` int(11) NOT NULL,
  `Name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of Kepemilikan
-- ----------------------------
BEGIN;
INSERT INTO `Kepemilikan` VALUES (1, 'Swasta');
INSERT INTO `Kepemilikan` VALUES (2, 'BUMN');
INSERT INTO `Kepemilikan` VALUES (3, 'BUMD');
INSERT INTO `Kepemilikan` VALUES (4, 'Sektor Publik');
INSERT INTO `Kepemilikan` VALUES (5, 'Koperasi');
INSERT INTO `Kepemilikan` VALUES (6, 'Yayasan');
COMMIT;

-- ----------------------------
-- Table structure for Konsolidasi
-- ----------------------------
DROP TABLE IF EXISTS `Konsolidasi`;
CREATE TABLE `Konsolidasi` (
  `ID` int(11) NOT NULL,
  `Description` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of Konsolidasi
-- ----------------------------
BEGIN;
INSERT INTO `Konsolidasi` VALUES (0, 'Tidak');
INSERT INTO `Konsolidasi` VALUES (1, 'Ya');
COMMIT;

-- ----------------------------
-- Table structure for Memiliki_NPWP
-- ----------------------------
DROP TABLE IF EXISTS `Memiliki_NPWP`;
CREATE TABLE `Memiliki_NPWP` (
  `ID` int(11) NOT NULL,
  `Description` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of Memiliki_NPWP
-- ----------------------------
BEGIN;
INSERT INTO `Memiliki_NPWP` VALUES (0, 'Tidak');
INSERT INTO `Memiliki_NPWP` VALUES (1, 'Ya');
COMMIT;

-- ----------------------------
-- Table structure for Negara
-- ----------------------------
DROP TABLE IF EXISTS `Negara`;
CREATE TABLE `Negara` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of Negara
-- ----------------------------
BEGIN;
INSERT INTO `Negara` VALUES (1, 'Afghanistan');
INSERT INTO `Negara` VALUES (2, 'Kepulauan Aland');
INSERT INTO `Negara` VALUES (3, 'Albania');
INSERT INTO `Negara` VALUES (4, 'Aljazair');
INSERT INTO `Negara` VALUES (5, 'Samoa Amerika');
INSERT INTO `Negara` VALUES (6, 'Andora');
INSERT INTO `Negara` VALUES (7, 'Angola');
INSERT INTO `Negara` VALUES (8, 'Anguilla');
INSERT INTO `Negara` VALUES (9, 'Argentina');
INSERT INTO `Negara` VALUES (10, 'Armenia');
INSERT INTO `Negara` VALUES (11, 'Aruba');
INSERT INTO `Negara` VALUES (12, 'Australia');
INSERT INTO `Negara` VALUES (13, 'Austria');
INSERT INTO `Negara` VALUES (14, 'Azerbaijan');
INSERT INTO `Negara` VALUES (15, 'Bahama');
INSERT INTO `Negara` VALUES (16, 'Bahrain');
INSERT INTO `Negara` VALUES (17, 'Bangladesh');
INSERT INTO `Negara` VALUES (18, 'Barbados');
INSERT INTO `Negara` VALUES (19, 'Belarussia');
INSERT INTO `Negara` VALUES (20, 'Belgia');
INSERT INTO `Negara` VALUES (21, 'Belize');
INSERT INTO `Negara` VALUES (22, 'Benin');
INSERT INTO `Negara` VALUES (23, 'Bermuda');
INSERT INTO `Negara` VALUES (24, 'Bhutan');
INSERT INTO `Negara` VALUES (25, 'Bolivia');
INSERT INTO `Negara` VALUES (26, 'Bosnia dan Herzegovina');
INSERT INTO `Negara` VALUES (27, 'Botswana');
INSERT INTO `Negara` VALUES (28, 'Pulau Bouvet');
INSERT INTO `Negara` VALUES (29, 'Brazil');
INSERT INTO `Negara` VALUES (30, 'Brunei Darussalam');
INSERT INTO `Negara` VALUES (31, 'Bulgaria');
INSERT INTO `Negara` VALUES (32, 'Burkina Faso');
INSERT INTO `Negara` VALUES (33, 'Burundi');
INSERT INTO `Negara` VALUES (34, 'Kamboja');
INSERT INTO `Negara` VALUES (35, 'Kamerun');
INSERT INTO `Negara` VALUES (36, 'Kanada');
INSERT INTO `Negara` VALUES (37, 'Cape Verde');
INSERT INTO `Negara` VALUES (38, 'Kepulauan Cayman');
INSERT INTO `Negara` VALUES (39, 'Republik Afrika Tengah');
INSERT INTO `Negara` VALUES (40, 'Chad');
INSERT INTO `Negara` VALUES (41, 'Chili');
INSERT INTO `Negara` VALUES (42, 'Republik Rakyat Tiongkok');
INSERT INTO `Negara` VALUES (43, 'Pulau Christmas');
INSERT INTO `Negara` VALUES (44, 'Kolombia');
INSERT INTO `Negara` VALUES (45, 'Komoros');
INSERT INTO `Negara` VALUES (46, 'Kongo');
INSERT INTO `Negara` VALUES (47, 'Cook Islands');
INSERT INTO `Negara` VALUES (48, 'Kosta Rika');
INSERT INTO `Negara` VALUES (49, 'Kroasia');
INSERT INTO `Negara` VALUES (50, 'Kuba');
INSERT INTO `Negara` VALUES (51, 'Cyprus');
INSERT INTO `Negara` VALUES (52, 'Ceko');
INSERT INTO `Negara` VALUES (53, 'Republik Demokrasi Kongo');
INSERT INTO `Negara` VALUES (54, 'Denmark');
INSERT INTO `Negara` VALUES (56, 'Djibouti');
INSERT INTO `Negara` VALUES (57, 'Dominika');
INSERT INTO `Negara` VALUES (58, 'Republik Dominika');
INSERT INTO `Negara` VALUES (59, 'Timor Timur');
INSERT INTO `Negara` VALUES (60, 'Ekuador');
INSERT INTO `Negara` VALUES (61, 'Mesir');
INSERT INTO `Negara` VALUES (62, 'El Salvador');
INSERT INTO `Negara` VALUES (63, 'Guinea Ekuator');
INSERT INTO `Negara` VALUES (64, 'Eritrea');
INSERT INTO `Negara` VALUES (65, 'Estonia');
INSERT INTO `Negara` VALUES (66, 'Ethiopia');
INSERT INTO `Negara` VALUES (67, 'Kepulauan Falkland');
INSERT INTO `Negara` VALUES (68, 'Kepulauan Faroe');
INSERT INTO `Negara` VALUES (69, 'Mikronesia');
INSERT INTO `Negara` VALUES (70, 'Fiji');
INSERT INTO `Negara` VALUES (71, 'Finlandia');
INSERT INTO `Negara` VALUES (72, 'Perancis');
INSERT INTO `Negara` VALUES (73, 'Guyana Perancis');
INSERT INTO `Negara` VALUES (74, 'Polinesia Perancis');
INSERT INTO `Negara` VALUES (75, 'Gabon');
INSERT INTO `Negara` VALUES (76, 'Gambia');
INSERT INTO `Negara` VALUES (77, 'Georgia');
INSERT INTO `Negara` VALUES (78, 'Jerman');
INSERT INTO `Negara` VALUES (79, 'Ghana');
INSERT INTO `Negara` VALUES (80, 'Gibraltar');
INSERT INTO `Negara` VALUES (81, 'Yunani');
INSERT INTO `Negara` VALUES (82, 'Greenland');
INSERT INTO `Negara` VALUES (83, 'Grenada');
INSERT INTO `Negara` VALUES (84, 'Guadeloupe');
INSERT INTO `Negara` VALUES (85, 'Guam');
INSERT INTO `Negara` VALUES (86, 'Guatemala');
INSERT INTO `Negara` VALUES (87, 'Guinea');
INSERT INTO `Negara` VALUES (88, 'Guinea - Bissau');
INSERT INTO `Negara` VALUES (89, 'Guyana');
INSERT INTO `Negara` VALUES (90, 'Haiti');
INSERT INTO `Negara` VALUES (91, 'Honduras');
INSERT INTO `Negara` VALUES (92, 'Hong Kong');
INSERT INTO `Negara` VALUES (93, 'Hungaria');
INSERT INTO `Negara` VALUES (94, 'Islandia');
INSERT INTO `Negara` VALUES (95, 'India');
INSERT INTO `Negara` VALUES (96, 'Indonesia');
INSERT INTO `Negara` VALUES (97, 'Iran');
INSERT INTO `Negara` VALUES (98, 'Irak');
INSERT INTO `Negara` VALUES (99, 'Irlandia');
INSERT INTO `Negara` VALUES (100, 'Israel');
INSERT INTO `Negara` VALUES (101, 'Italia');
INSERT INTO `Negara` VALUES (102, 'Ivory Coast');
INSERT INTO `Negara` VALUES (103, 'Jamaika');
INSERT INTO `Negara` VALUES (104, 'Jepang');
INSERT INTO `Negara` VALUES (105, 'Jordania');
INSERT INTO `Negara` VALUES (106, 'Kazakhstan');
INSERT INTO `Negara` VALUES (107, 'Kenya');
INSERT INTO `Negara` VALUES (108, 'Kiribati');
INSERT INTO `Negara` VALUES (109, 'Kuwait');
INSERT INTO `Negara` VALUES (110, 'Kyrgyzstan');
INSERT INTO `Negara` VALUES (111, 'Laos');
INSERT INTO `Negara` VALUES (112, 'Latvia');
INSERT INTO `Negara` VALUES (113, 'Lebanon');
INSERT INTO `Negara` VALUES (114, 'Lesotho');
INSERT INTO `Negara` VALUES (115, 'Liberia');
INSERT INTO `Negara` VALUES (116, 'Libya');
INSERT INTO `Negara` VALUES (117, 'Liechtenstein');
INSERT INTO `Negara` VALUES (118, 'Lithuania');
INSERT INTO `Negara` VALUES (119, 'Luksembourg');
INSERT INTO `Negara` VALUES (120, 'Makau');
INSERT INTO `Negara` VALUES (121, 'Makedonia');
INSERT INTO `Negara` VALUES (122, 'Madagaskar');
INSERT INTO `Negara` VALUES (123, 'Malawi');
INSERT INTO `Negara` VALUES (124, 'Malaysia');
INSERT INTO `Negara` VALUES (125, 'Maldiva');
INSERT INTO `Negara` VALUES (126, 'Mali');
INSERT INTO `Negara` VALUES (127, 'Malta');
INSERT INTO `Negara` VALUES (128, 'Kepulauan Marshall');
INSERT INTO `Negara` VALUES (129, 'Martinique');
INSERT INTO `Negara` VALUES (130, 'Mauritania');
INSERT INTO `Negara` VALUES (131, 'Mauritius');
INSERT INTO `Negara` VALUES (132, 'Mayotte');
INSERT INTO `Negara` VALUES (133, 'Meksiko');
INSERT INTO `Negara` VALUES (134, 'Moldova');
INSERT INTO `Negara` VALUES (135, 'Monako');
INSERT INTO `Negara` VALUES (136, 'Mongolia');
INSERT INTO `Negara` VALUES (137, 'Montserrat');
INSERT INTO `Negara` VALUES (138, 'Maroko');
INSERT INTO `Negara` VALUES (139, 'Mozambik');
INSERT INTO `Negara` VALUES (140, 'Myanmar');
INSERT INTO `Negara` VALUES (141, 'Namibia');
INSERT INTO `Negara` VALUES (142, 'Nauru');
INSERT INTO `Negara` VALUES (143, 'Nepal');
INSERT INTO `Negara` VALUES (144, 'Belanda');
INSERT INTO `Negara` VALUES (145, 'Antilles Belanda');
INSERT INTO `Negara` VALUES (146, 'Kaledonia Baru');
INSERT INTO `Negara` VALUES (147, 'Selandia Baru');
INSERT INTO `Negara` VALUES (148, 'Nikaragua');
INSERT INTO `Negara` VALUES (149, 'Niger');
INSERT INTO `Negara` VALUES (150, 'Nigeria');
INSERT INTO `Negara` VALUES (151, 'Niue');
INSERT INTO `Negara` VALUES (152, 'Pulau Norfolk');
INSERT INTO `Negara` VALUES (153, 'Korea Utara');
INSERT INTO `Negara` VALUES (154, 'Kepulauan Mariana Utara');
INSERT INTO `Negara` VALUES (155, 'Norwegia');
INSERT INTO `Negara` VALUES (156, 'Oman');
INSERT INTO `Negara` VALUES (157, 'Pakistan');
INSERT INTO `Negara` VALUES (158, 'Palau');
INSERT INTO `Negara` VALUES (159, 'Palestina');
INSERT INTO `Negara` VALUES (160, 'Panama');
INSERT INTO `Negara` VALUES (161, 'Papua Guini');
INSERT INTO `Negara` VALUES (162, 'Paraguay');
INSERT INTO `Negara` VALUES (163, 'Peru');
INSERT INTO `Negara` VALUES (164, 'Filipina');
INSERT INTO `Negara` VALUES (165, 'Kepulauan Pitcairn');
INSERT INTO `Negara` VALUES (166, 'Polandia');
INSERT INTO `Negara` VALUES (167, 'Portugal');
INSERT INTO `Negara` VALUES (168, 'Puerto Rico');
INSERT INTO `Negara` VALUES (169, 'Qatar');
INSERT INTO `Negara` VALUES (170, 'Reunion');
INSERT INTO `Negara` VALUES (171, 'Rumania');
INSERT INTO `Negara` VALUES (172, 'Rusia');
INSERT INTO `Negara` VALUES (173, 'Rwanda');
INSERT INTO `Negara` VALUES (174, 'Saint Kitts dan Nevis');
INSERT INTO `Negara` VALUES (175, 'Saint Lucia');
INSERT INTO `Negara` VALUES (176, 'Saint Pierre dan Miquelon');
INSERT INTO `Negara` VALUES (177, 'Samoa');
INSERT INTO `Negara` VALUES (178, 'San Marino');
INSERT INTO `Negara` VALUES (179, 'Sao Tome dan Principe');
INSERT INTO `Negara` VALUES (180, 'Arab Saudi');
INSERT INTO `Negara` VALUES (181, 'Senegal');
INSERT INTO `Negara` VALUES (182, 'Serbia dan Montenegro');
INSERT INTO `Negara` VALUES (183, 'Seychelles');
INSERT INTO `Negara` VALUES (184, 'Sierra Leone');
INSERT INTO `Negara` VALUES (185, 'Singapura');
INSERT INTO `Negara` VALUES (186, 'Slovakia');
INSERT INTO `Negara` VALUES (187, 'Slovenia');
INSERT INTO `Negara` VALUES (188, 'Kepulauan Solomon');
INSERT INTO `Negara` VALUES (189, 'Somalia');
INSERT INTO `Negara` VALUES (190, 'Afrika Selatan');
INSERT INTO `Negara` VALUES (191, 'Korea Selatan');
INSERT INTO `Negara` VALUES (192, 'Spanyol');
INSERT INTO `Negara` VALUES (193, 'Kepulauan Spratly');
INSERT INTO `Negara` VALUES (194, 'Sri Lanka');
INSERT INTO `Negara` VALUES (195, 'Sudan');
INSERT INTO `Negara` VALUES (196, 'Suriname');
INSERT INTO `Negara` VALUES (197, 'Svalbard dan Jan Mayen');
INSERT INTO `Negara` VALUES (198, 'Swaziland');
INSERT INTO `Negara` VALUES (199, 'Swedia');
INSERT INTO `Negara` VALUES (200, 'Swiss');
INSERT INTO `Negara` VALUES (201, 'Suriah');
INSERT INTO `Negara` VALUES (202, 'Taiwan');
INSERT INTO `Negara` VALUES (203, 'Tajikistan');
INSERT INTO `Negara` VALUES (204, 'Tanzania');
INSERT INTO `Negara` VALUES (205, 'Thailand');
INSERT INTO `Negara` VALUES (206, 'Togo');
INSERT INTO `Negara` VALUES (207, 'Tokelau');
INSERT INTO `Negara` VALUES (208, 'Tonga');
INSERT INTO `Negara` VALUES (209, 'Trinidad dan Tobago');
INSERT INTO `Negara` VALUES (210, 'Tunisia');
INSERT INTO `Negara` VALUES (211, 'Turki');
INSERT INTO `Negara` VALUES (212, 'Turkmenistan');
INSERT INTO `Negara` VALUES (213, 'Turks dan Kepulauan Caicos');
INSERT INTO `Negara` VALUES (214, 'Tuvalu');
INSERT INTO `Negara` VALUES (215, 'Uganda');
INSERT INTO `Negara` VALUES (216, 'Ukraina');
INSERT INTO `Negara` VALUES (217, 'Uni Emirat Arab');
INSERT INTO `Negara` VALUES (218, 'Inggris');
INSERT INTO `Negara` VALUES (219, 'Amerika Serikat');
INSERT INTO `Negara` VALUES (220, 'Uruguay');
INSERT INTO `Negara` VALUES (221, 'Kepulauan US Virgin');
INSERT INTO `Negara` VALUES (222, 'Uzbekistan');
INSERT INTO `Negara` VALUES (223, 'Vanuatu');
INSERT INTO `Negara` VALUES (224, 'Vatikan');
INSERT INTO `Negara` VALUES (225, 'Venezuela');
INSERT INTO `Negara` VALUES (226, 'Vietnam');
INSERT INTO `Negara` VALUES (227, 'Wallis dan Futuna');
INSERT INTO `Negara` VALUES (228, 'Sahara Barat');
INSERT INTO `Negara` VALUES (229, 'Yaman');
INSERT INTO `Negara` VALUES (230, 'Zambia');
INSERT INTO `Negara` VALUES (231, 'Zimbabwe');
COMMIT;

-- ----------------------------
-- Table structure for Opini
-- ----------------------------
DROP TABLE IF EXISTS `Opini`;
CREATE TABLE `Opini` (
  `ID` int(11) NOT NULL,
  `Name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

-- ----------------------------
-- Records of Opini
-- ----------------------------
BEGIN;
INSERT INTO `Opini` VALUES (1, 'WTP');
INSERT INTO `Opini` VALUES (2, 'WDP');
INSERT INTO `Opini` VALUES (3, 'TMP');
INSERT INTO `Opini` VALUES (4, 'Tidak Wajar');
COMMIT;

-- ----------------------------
-- Table structure for Propinsi
-- ----------------------------
DROP TABLE IF EXISTS `Propinsi`;
CREATE TABLE `Propinsi` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of Propinsi
-- ----------------------------
BEGIN;
INSERT INTO `Propinsi` VALUES (1, 'Bali');
INSERT INTO `Propinsi` VALUES (2, 'Bangka Belitung');
INSERT INTO `Propinsi` VALUES (3, 'Banten');
INSERT INTO `Propinsi` VALUES (4, 'Bengkulu');
INSERT INTO `Propinsi` VALUES (5, 'DI Yogyakarta');
INSERT INTO `Propinsi` VALUES (6, 'DKI Jakarta');
INSERT INTO `Propinsi` VALUES (7, 'Gorontalo');
INSERT INTO `Propinsi` VALUES (8, 'Jambi');
INSERT INTO `Propinsi` VALUES (9, 'Jawa Barat');
INSERT INTO `Propinsi` VALUES (10, 'Jawa Tengah');
INSERT INTO `Propinsi` VALUES (11, 'Jawa Timur');
INSERT INTO `Propinsi` VALUES (12, 'Kalimantan Barat');
INSERT INTO `Propinsi` VALUES (13, 'Kalimantan Selatan');
INSERT INTO `Propinsi` VALUES (14, 'Kalimantan Tengah');
INSERT INTO `Propinsi` VALUES (15, 'Kalimantan Timur');
INSERT INTO `Propinsi` VALUES (16, 'Kalimantan Utara');
INSERT INTO `Propinsi` VALUES (17, 'Kepulauan Riau');
INSERT INTO `Propinsi` VALUES (18, 'Lampung');
INSERT INTO `Propinsi` VALUES (19, 'Maluku');
INSERT INTO `Propinsi` VALUES (20, 'Maluku Utara');
INSERT INTO `Propinsi` VALUES (21, 'Nanggroe Aceh Darussalam');
INSERT INTO `Propinsi` VALUES (22, 'Nusa Tenggara Barat');
INSERT INTO `Propinsi` VALUES (23, 'Nusa Tenggara Timur');
INSERT INTO `Propinsi` VALUES (24, 'Papua');
INSERT INTO `Propinsi` VALUES (25, 'Papua Barat');
INSERT INTO `Propinsi` VALUES (26, 'Riau');
INSERT INTO `Propinsi` VALUES (27, 'Sulawesi Barat');
INSERT INTO `Propinsi` VALUES (28, 'Sulawesi Selatan');
INSERT INTO `Propinsi` VALUES (29, 'Sulawesi Tengah');
INSERT INTO `Propinsi` VALUES (30, 'Sulawesi Tenggara');
INSERT INTO `Propinsi` VALUES (31, 'Sulawesi Utara');
INSERT INTO `Propinsi` VALUES (32, 'Sumatera Barat');
INSERT INTO `Propinsi` VALUES (33, 'Sumatera Selatan');
INSERT INTO `Propinsi` VALUES (34, 'Sumatera Utara');
COMMIT;

-- ----------------------------
-- Table structure for Restatement
-- ----------------------------
DROP TABLE IF EXISTS `Restatement`;
CREATE TABLE `Restatement` (
  `ID` int(11) NOT NULL,
  `Description` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of Restatement
-- ----------------------------
BEGIN;
INSERT INTO `Restatement` VALUES (0, 'Tidak');
INSERT INTO `Restatement` VALUES (1, 'Ya');
COMMIT;

-- ----------------------------
-- Table structure for Standar
-- ----------------------------
DROP TABLE IF EXISTS `Standar`;
CREATE TABLE `Standar` (
  `ID` int(11) NOT NULL,
  `Name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

-- ----------------------------
-- Records of Standar
-- ----------------------------
BEGIN;
INSERT INTO `Standar` VALUES (1, 'SAK');
INSERT INTO `Standar` VALUES (2, 'SAK ETAP');
INSERT INTO `Standar` VALUES (3, 'SAK EMKM');
INSERT INTO `Standar` VALUES (4, 'SAK Syariah');
COMMIT;

-- ----------------------------
-- Table structure for klienaupusat
-- ----------------------------
DROP TABLE IF EXISTS `klienaupusat`;
CREATE TABLE `klienaupusat` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_KLIEN` varchar(255) NOT NULL,
  `NO_LAI` int(11) NOT NULL,
  `TGL_LAI` date NOT NULL,
  `RESTATEMENT` tinyint(4) NOT NULL,
  `NO_LAI_RESTATEMENT` int(11) DEFAULT NULL,
  `ALAMAT` varchar(255) NOT NULL,
  `PROPINSI` int(11) DEFAULT NULL,
  `NEGARA` int(11) NOT NULL,
  `MEMILIKI_NPWP` tinyint(4) NOT NULL,
  `NPWP` varchar(20) NOT NULL,
  `BIDANG_USAHA` int(11) NOT NULL,
  `GO_PUBLIK` tinyint(4) NOT NULL,
  `STANDAR` int(11) NOT NULL,
  `JENIS_LK` int(11) NOT NULL,
  `KEPEMILIKAN` int(11) NOT NULL,
  `OPINI` int(11) NOT NULL,
  `PERIODE_AWAL` date NOT NULL,
  `PERIODE_AKHIR` date NOT NULL,
  `AP_TAHUN_SEBELUM` varchar(255) NOT NULL,
  `PENANGGUNG_JAWAB` int(11) NOT NULL,
  `TAHUN_AUDIT` int(11) NOT NULL,
  `MATA_UANG_LABA_RUGI_BERSIH` int(11) NOT NULL,
  `LABA_RUGI_BERSIH` decimal(18,2) NOT NULL,
  `MATA_UANG_LABA_SEBELUM_PAJAK` int(11) NOT NULL,
  `LABA_SEBELUM_PAJAK` decimal(18,2) NOT NULL,
  `MATA_UANG_FEE_JASA` int(11) NOT NULL,
  `FEE_JASA` decimal(18,2) NOT NULL,
  `MATA_UANG_JUMLAH_PENGHASILAN_KOMPREHENSIF` int(11) NOT NULL,
  `JUMLAH_PENGHASILAN_KOMPREHENSIF` decimal(18,2) NOT NULL,
  `MATA_UANG_BEBAN_PAJAK` int(11) NOT NULL,
  `BEBAN_PAJAK` decimal(18,2) NOT NULL,
  `MATA_UANG_PENDAPATAN` int(11) NOT NULL,
  `PENDAPATAN` decimal(18,2) NOT NULL,
  `MATA_UANG_TOTAL_ASET` int(11) NOT NULL,
  `TOTAL_ASET` decimal(18,2) NOT NULL,
  `MATA_UANG_TOTAL_LIABILITAS` int(11) NOT NULL,
  `TOTAL_LIABILITAS` decimal(18,2) NOT NULL,
  `JAM_AUDIT_PENANGGUNG_JAWAB` int(11) NOT NULL,
  `KETERANGAN` text DEFAULT NULL,
  `NPWP16` bigint(20) NOT NULL,
  `NO_SURAT_PERIKATAN` int(11) NOT NULL,
  `TGL_SURAT_PERIKATAN` date DEFAULT NULL,
  `KONSOLIDASI` tinyint(4) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `NPWP` (`NPWP`),
  UNIQUE KEY `NPWP16` (`NPWP16`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of klienaupusat
-- ----------------------------
BEGIN;
INSERT INTO `klienaupusat` VALUES (1, 'Test aja', 123, '2012-12-12', 1, 123, 'Jakarta', 2, 2, 1, '11.111.111.1-111.111', 1, 1, 1, 1, 1, 1, '2015-12-12', '2016-12-12', 'test aja', 1, 1, 1, 1111.00, 1, 1111.00, 1, 111.00, 1, 111.00, 1, 1111.00, 1, 111.00, 1, 111.00, 1, 111.00, 100, NULL, 1111111111111111, 123, '2015-12-12', 0);
INSERT INTO `klienaupusat` VALUES (2, 'Test aja', 123, '2012-12-12', 1, 123, 'Jakarta', 2, 2, 1, '11.111.111.1-111.112', 1, 1, 1, 1, 1, 1, '2015-12-12', '2016-12-12', 'test aja', 1, 1, 1, 1111.00, 1, 1111.00, 1, 111.00, 1, 111.00, 1, 1111.00, 1, 111.00, 1, 111.00, 1, 111.00, 100, NULL, 1111111111111112, 123, '2015-12-12', 0);
INSERT INTO `klienaupusat` VALUES (3, 'Test aja', 123, '2012-12-12', 1, 123, 'Jakarta', 2, 2, 1, '11.111.111.1-111.113', 1, 1, 1, 1, 1, 1, '2015-12-12', '2016-12-12', 'test aja', 1, 1, 1, 1111.00, 1, 1111.00, 1, 111.00, 1, 111.00, 1, 1111.00, 1, 111.00, 1, 111.00, 1, 111.00, 100, NULL, 1111111111111113, 123, '2015-12-12', 0);
COMMIT;

-- ----------------------------
-- Table structure for kliennonasuransipusat
-- ----------------------------
DROP TABLE IF EXISTS `kliennonasuransipusat`;
CREATE TABLE `kliennonasuransipusat` (
  `NO_URUT` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_KLIEN` varchar(255) NOT NULL,
  `NO_LAPORAN` varchar(50) NOT NULL,
  `TGL_LAPORAN` date NOT NULL,
  `ALAMAT` varchar(255) NOT NULL,
  `NPWP` varchar(20) NOT NULL,
  `JASA_NON_ASURANS` int(11) NOT NULL,
  `BIDANG_USAHA` int(11) NOT NULL,
  `GO_PUBLIK` tinyint(4) NOT NULL,
  `KEPEMILIKAN` int(11) NOT NULL,
  `PERIODE_AWAL` date NOT NULL,
  `PERIODE_AKHIR` date NOT NULL,
  `PENANGGUNG_JAWAB` int(11) NOT NULL,
  `MATA_UANG_FEE_JASA` int(11) NOT NULL,
  `FEE_JASA` decimal(18,2) NOT NULL,
  `NPWP16` bigint(20) NOT NULL,
  PRIMARY KEY (`NO_URUT`),
  UNIQUE KEY `NO_LAPORAN` (`NO_LAPORAN`),
  UNIQUE KEY `NPWP` (`NPWP`),
  UNIQUE KEY `NPWP16` (`NPWP16`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of kliennonasuransipusat
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for mata_uang
-- ----------------------------
DROP TABLE IF EXISTS `mata_uang`;
CREATE TABLE `mata_uang` (
  `id` int(11) NOT NULL,
  `kode_mata_uang` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of mata_uang
-- ----------------------------
BEGIN;
INSERT INTO `mata_uang` VALUES (1, 'IDR');
INSERT INTO `mata_uang` VALUES (2, 'USD');
INSERT INTO `mata_uang` VALUES (3, 'CAD');
INSERT INTO `mata_uang` VALUES (4, 'DKK');
INSERT INTO `mata_uang` VALUES (5, 'HKD');
INSERT INTO `mata_uang` VALUES (6, 'MYR');
INSERT INTO `mata_uang` VALUES (7, 'NZD');
INSERT INTO `mata_uang` VALUES (8, 'NOK');
INSERT INTO `mata_uang` VALUES (9, 'GBP');
INSERT INTO `mata_uang` VALUES (10, 'SGD');
INSERT INTO `mata_uang` VALUES (11, 'SEK');
INSERT INTO `mata_uang` VALUES (12, 'CHF');
INSERT INTO `mata_uang` VALUES (13, 'JPY');
INSERT INTO `mata_uang` VALUES (14, 'MMK');
INSERT INTO `mata_uang` VALUES (15, 'INR');
INSERT INTO `mata_uang` VALUES (16, 'KWD');
INSERT INTO `mata_uang` VALUES (17, 'PKR');
INSERT INTO `mata_uang` VALUES (18, 'PHP');
INSERT INTO `mata_uang` VALUES (19, 'SAR');
INSERT INTO `mata_uang` VALUES (20, 'LKR');
INSERT INTO `mata_uang` VALUES (21, 'THB');
INSERT INTO `mata_uang` VALUES (22, 'BND');
INSERT INTO `mata_uang` VALUES (23, 'EUR');
INSERT INTO `mata_uang` VALUES (24, 'CNY');
INSERT INTO `mata_uang` VALUES (25, 'KRW');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;

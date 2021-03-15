#
# TABLE STRUCTURE FOR: a_user
#

DROP TABLE IF EXISTS `a_user`;

CREATE TABLE `a_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` enum('admin','operator') DEFAULT NULL,
  `foto` varchar(255) DEFAULT 'default.png',
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `a_user` (`id_user`, `nama_lengkap`, `username`, `password`, `level`, `foto`) VALUES (2, 'Administrator', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin', 'default.png');
INSERT INTO `a_user` (`id_user`, `nama_lengkap`, `username`, `password`, `level`, `foto`) VALUES (3, 'Boy', 'user', 'e10adc3949ba59abbe56e057f20f883e', 'operator', 'user_1592486193.png');


#
# TABLE STRUCTURE FOR: antrian
#

DROP TABLE IF EXISTS `antrian`;

CREATE TABLE `antrian` (
  `id_antrian` int(11) NOT NULL AUTO_INCREMENT,
  `no_antrian` varchar(10) DEFAULT NULL,
  `id_pasien` int(11) DEFAULT NULL,
  `status_kunjungan` enum('open','close') DEFAULT 'open',
  `create_at` datetime DEFAULT NULL,
  `konfirmasi` enum('y','t') DEFAULT 't',
  `date_konfirmasi` datetime DEFAULT NULL,
  `id_jadwal` int(11) DEFAULT NULL,
  `tgl_kunjungan` date DEFAULT NULL,
  `tujuan_kunjungan` text,
  `clinical_notes` text,
  `medications` text,
  PRIMARY KEY (`id_antrian`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;

INSERT INTO `antrian` (`id_antrian`, `no_antrian`, `id_pasien`, `status_kunjungan`, `create_at`, `konfirmasi`, `date_konfirmasi`, `id_jadwal`, `tgl_kunjungan`, `tujuan_kunjungan`, `clinical_notes`, `medications`) VALUES (6, 'ANT001', 4, 'open', '2020-10-25 23:58:56', 'y', '2020-12-03 21:35:30', 1, '2020-10-26', NULL, NULL, NULL);
INSERT INTO `antrian` (`id_antrian`, `no_antrian`, `id_pasien`, `status_kunjungan`, `create_at`, `konfirmasi`, `date_konfirmasi`, `id_jadwal`, `tgl_kunjungan`, `tujuan_kunjungan`, `clinical_notes`, `medications`) VALUES (7, 'ANT001', 5, 'open', '2020-10-26 00:00:10', 'y', '2020-12-03 21:35:30', 2, '2020-10-27', NULL, NULL, NULL);
INSERT INTO `antrian` (`id_antrian`, `no_antrian`, `id_pasien`, `status_kunjungan`, `create_at`, `konfirmasi`, `date_konfirmasi`, `id_jadwal`, `tgl_kunjungan`, `tujuan_kunjungan`, `clinical_notes`, `medications`) VALUES (12, 'ANT001', 10, 'open', '2020-11-01 16:14:52', 'y', '2020-12-03 21:35:30', 1, '2020-11-02', NULL, NULL, NULL);
INSERT INTO `antrian` (`id_antrian`, `no_antrian`, `id_pasien`, `status_kunjungan`, `create_at`, `konfirmasi`, `date_konfirmasi`, `id_jadwal`, `tgl_kunjungan`, `tujuan_kunjungan`, `clinical_notes`, `medications`) VALUES (13, 'ANT001', 11, 'open', '2020-11-03 12:45:07', 'y', '2020-12-03 21:35:30', 4, '2020-11-05', NULL, NULL, NULL);
INSERT INTO `antrian` (`id_antrian`, `no_antrian`, `id_pasien`, `status_kunjungan`, `create_at`, `konfirmasi`, `date_konfirmasi`, `id_jadwal`, `tgl_kunjungan`, `tujuan_kunjungan`, `clinical_notes`, `medications`) VALUES (14, 'ANT001', 12, 'open', '2020-11-03 12:46:49', 'y', '2020-12-03 21:35:30', 3, '2020-11-04', NULL, NULL, NULL);
INSERT INTO `antrian` (`id_antrian`, `no_antrian`, `id_pasien`, `status_kunjungan`, `create_at`, `konfirmasi`, `date_konfirmasi`, `id_jadwal`, `tgl_kunjungan`, `tujuan_kunjungan`, `clinical_notes`, `medications`) VALUES (31, 'ANT001', 18, 'open', '2020-12-03 15:51:22', 'y', '2020-12-03 21:35:30', 1, '2020-12-03', NULL, NULL, NULL);
INSERT INTO `antrian` (`id_antrian`, `no_antrian`, `id_pasien`, `status_kunjungan`, `create_at`, `konfirmasi`, `date_konfirmasi`, `id_jadwal`, `tgl_kunjungan`, `tujuan_kunjungan`, `clinical_notes`, `medications`) VALUES (34, 'ANT001', 10, 'open', '2020-12-03 17:13:27', 'y', '2020-12-03 21:35:30', 4, '2020-12-03', 'tidak ada', '<p>apa</p>', '<p>itya</p>');
INSERT INTO `antrian` (`id_antrian`, `no_antrian`, `id_pasien`, `status_kunjungan`, `create_at`, `konfirmasi`, `date_konfirmasi`, `id_jadwal`, `tgl_kunjungan`, `tujuan_kunjungan`, `clinical_notes`, `medications`) VALUES (36, 'ANT001', 22, 'open', '2020-12-03 21:02:57', 'y', '2021-01-17 10:44:31', 1, '2020-12-07', NULL, NULL, NULL);
INSERT INTO `antrian` (`id_antrian`, `no_antrian`, `id_pasien`, `status_kunjungan`, `create_at`, `konfirmasi`, `date_konfirmasi`, `id_jadwal`, `tgl_kunjungan`, `tujuan_kunjungan`, `clinical_notes`, `medications`) VALUES (37, 'ANT001', 23, 'close', '2020-12-03 21:19:55', 'y', '2020-12-03 21:35:30', 1, '2020-12-07', NULL, NULL, NULL);
INSERT INTO `antrian` (`id_antrian`, `no_antrian`, `id_pasien`, `status_kunjungan`, `create_at`, `konfirmasi`, `date_konfirmasi`, `id_jadwal`, `tgl_kunjungan`, `tujuan_kunjungan`, `clinical_notes`, `medications`) VALUES (38, 'ANT001', 24, 'open', '2020-12-03 21:20:42', 'y', '2020-12-03 21:35:30', 1, '2020-12-07', NULL, NULL, NULL);
INSERT INTO `antrian` (`id_antrian`, `no_antrian`, `id_pasien`, `status_kunjungan`, `create_at`, `konfirmasi`, `date_konfirmasi`, `id_jadwal`, `tgl_kunjungan`, `tujuan_kunjungan`, `clinical_notes`, `medications`) VALUES (39, '', 25, 'open', '2020-12-03 21:24:47', 't', '0000-00-00 00:00:00', 1, '2020-12-03', NULL, NULL, NULL);
INSERT INTO `antrian` (`id_antrian`, `no_antrian`, `id_pasien`, `status_kunjungan`, `create_at`, `konfirmasi`, `date_konfirmasi`, `id_jadwal`, `tgl_kunjungan`, `tujuan_kunjungan`, `clinical_notes`, `medications`) VALUES (41, NULL, 27, 'open', '2020-12-05 07:26:53', 'y', '2020-12-05 07:26:53', 1, '2020-12-05', NULL, NULL, NULL);


#
# TABLE STRUCTURE FOR: img_pasien
#

DROP TABLE IF EXISTS `img_pasien`;

CREATE TABLE `img_pasien` (
  `id_img` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(255) DEFAULT NULL,
  `id_pasien` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_img`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: jadwal
#

DROP TABLE IF EXISTS `jadwal`;

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `hari` varchar(30) DEFAULT NULL,
  `dari` time DEFAULT NULL,
  `sampai` time DEFAULT NULL,
  `dokter` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_jadwal`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO `jadwal` (`id_jadwal`, `hari`, `dari`, `sampai`, `dokter`) VALUES (1, 'Senin', '09:00:00', '22:00:00', 'Arif');
INSERT INTO `jadwal` (`id_jadwal`, `hari`, `dari`, `sampai`, `dokter`) VALUES (2, 'Selasa', '09:00:00', '22:00:00', 'Arif');
INSERT INTO `jadwal` (`id_jadwal`, `hari`, `dari`, `sampai`, `dokter`) VALUES (3, 'Rabu', '09:00:00', '22:00:00', 'Arif');
INSERT INTO `jadwal` (`id_jadwal`, `hari`, `dari`, `sampai`, `dokter`) VALUES (4, 'Kamis', '00:00:08', '00:00:10', 'Andi');


#
# TABLE STRUCTURE FOR: member
#

DROP TABLE IF EXISTS `member`;

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `no_alternatif` varchar(15) DEFAULT NULL,
  `alamat` text,
  PRIMARY KEY (`id_member`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

INSERT INTO `member` (`id_member`, `nama`, `email`, `password`, `no_telp`, `no_alternatif`, `alamat`) VALUES (1, 'Boy Kurniawan', 'boykurniawan123@gmail.com', '654321', '085273171136', '085273171136', 'jambi');
INSERT INTO `member` (`id_member`, `nama`, `email`, `password`, `no_telp`, `no_alternatif`, `alamat`) VALUES (2, 'Joko', 'joko@gmail.com', '123456', NULL, NULL, NULL);
INSERT INTO `member` (`id_member`, `nama`, `email`, `password`, `no_telp`, `no_alternatif`, `alamat`) VALUES (3, 'Joni', 'joni@gmail.com', '123456', '085273171136', '085273171136', 'jakarta');
INSERT INTO `member` (`id_member`, `nama`, `email`, `password`, `no_telp`, `no_alternatif`, `alamat`) VALUES (4, 'Arief', 'noncholesterol@yahoo.com', '12345', '0819292929', '235', 'Kompleks Teluk Gong');
INSERT INTO `member` (`id_member`, `nama`, `email`, `password`, `no_telp`, `no_alternatif`, `alamat`) VALUES (6, 'adrian', 'qwer@qwer.com', '1234', NULL, NULL, NULL);
INSERT INTO `member` (`id_member`, `nama`, `email`, `password`, `no_telp`, `no_alternatif`, `alamat`) VALUES (12, NULL, 'abal@abal.com', '123456', NULL, NULL, NULL);
INSERT INTO `member` (`id_member`, `nama`, `email`, `password`, `no_telp`, `no_alternatif`, `alamat`) VALUES (13, 'nana', 'vir_270886@yahoo.com', 'nana', '0811787878', '899889', 'kompleh duta indah');


#
# TABLE STRUCTURE FOR: pasien
#

DROP TABLE IF EXISTS `pasien`;

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `nama_ayah` varchar(100) DEFAULT NULL,
  `nama_ibu` varchar(100) DEFAULT NULL,
  `alamat` text,
  `no_telp` varchar(20) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `id_member` int(11) DEFAULT NULL,
  `aktif` enum('0','1') DEFAULT '1',
  PRIMARY KEY (`id_pasien`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

INSERT INTO `pasien` (`id_pasien`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `nama_ayah`, `nama_ibu`, `alamat`, `no_telp`, `no_hp`, `id_member`, `aktif`) VALUES (4, 'Joni', '1992-10-20', 'L', '', '', 'jakarta', '085273171136', '085273171136', 3, '1');
INSERT INTO `pasien` (`id_pasien`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `nama_ayah`, `nama_ibu`, `alamat`, `no_telp`, `no_hp`, `id_member`, `aktif`) VALUES (5, 'Johan', '2000-10-10', 'L', 'Joni', 'Junai', 'jakarta', '085273171136', '085273171136', 3, '1');
INSERT INTO `pasien` (`id_pasien`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `nama_ayah`, `nama_ibu`, `alamat`, `no_telp`, `no_hp`, `id_member`, `aktif`) VALUES (6, 'Adrian', '2020-10-21', 'P', '', '', 'a', '235', '235', 1, '0');
INSERT INTO `pasien` (`id_pasien`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `nama_ayah`, `nama_ibu`, `alamat`, `no_telp`, `no_hp`, `id_member`, `aktif`) VALUES (7, 'Adrian', '2020-10-05', 'P', '', '', 'dsfgsd', '346', '43', 1, '1');
INSERT INTO `pasien` (`id_pasien`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `nama_ayah`, `nama_ibu`, `alamat`, `no_telp`, `no_hp`, `id_member`, `aktif`) VALUES (9, 'Arief', '1992-06-24', NULL, '', '', 'a', '235', '235', 1, '0');
INSERT INTO `pasien` (`id_pasien`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `nama_ayah`, `nama_ibu`, `alamat`, `no_telp`, `no_hp`, `id_member`, `aktif`) VALUES (10, 'Boy Kurniawan', '2020-11-09', 'L', '', '', 'jambi', '085273171136', '085273171136', 1, '1');
INSERT INTO `pasien` (`id_pasien`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `nama_ayah`, `nama_ibu`, `alamat`, `no_telp`, `no_hp`, `id_member`, `aktif`) VALUES (11, 'Uru', '2020-11-04', 'L', NULL, NULL, 'Grenvil', '48844', '72827', 11, '1');
INSERT INTO `pasien` (`id_pasien`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `nama_ayah`, `nama_ibu`, `alamat`, `no_telp`, `no_hp`, `id_member`, `aktif`) VALUES (12, '', '2020-11-11', 'P', NULL, NULL, 'Grenvil', '48844', '72827', 11, '1');
INSERT INTO `pasien` (`id_pasien`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `nama_ayah`, `nama_ibu`, `alamat`, `no_telp`, `no_hp`, `id_member`, `aktif`) VALUES (13, 'Arief', '2019-12-30', NULL, NULL, NULL, 'Komp', '1', '08', 10, '1');
INSERT INTO `pasien` (`id_pasien`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `nama_ayah`, `nama_ibu`, `alamat`, `no_telp`, `no_hp`, `id_member`, `aktif`) VALUES (14, 'Afif', '2020-06-09', 'L', NULL, NULL, 'a', '235', '235', 1, '0');
INSERT INTO `pasien` (`id_pasien`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `nama_ayah`, `nama_ibu`, `alamat`, `no_telp`, `no_hp`, `id_member`, `aktif`) VALUES (15, 'Ac', '2020-11-01', NULL, NULL, NULL, 'a', '235', '235', 4, '0');
INSERT INTO `pasien` (`id_pasien`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `nama_ayah`, `nama_ibu`, `alamat`, `no_telp`, `no_hp`, `id_member`, `aktif`) VALUES (16, 'Virna', '2020-10-04', 'P', NULL, NULL, 'a', '235', '235', 10, '1');
INSERT INTO `pasien` (`id_pasien`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `nama_ayah`, `nama_ibu`, `alamat`, `no_telp`, `no_hp`, `id_member`, `aktif`) VALUES (17, 'Agus', '2020-11-10', 'L', NULL, NULL, 'Komp', '1', '08', 10, '0');
INSERT INTO `pasien` (`id_pasien`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `nama_ayah`, `nama_ibu`, `alamat`, `no_telp`, `no_hp`, `id_member`, `aktif`) VALUES (18, 'Arief', '1984-01-20', NULL, NULL, NULL, NULL, NULL, '123', 10, '1');
INSERT INTO `pasien` (`id_pasien`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `nama_ayah`, `nama_ibu`, `alamat`, `no_telp`, `no_hp`, `id_member`, `aktif`) VALUES (21, 'Asu', '1989-12-09', 'L', NULL, NULL, 'a', '235', '235', 4, '0');
INSERT INTO `pasien` (`id_pasien`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `nama_ayah`, `nama_ibu`, `alamat`, `no_telp`, `no_hp`, `id_member`, `aktif`) VALUES (22, 'bibi', '2008-09-11', 'P', NULL, NULL, 'kompleh duta indah', '899889', '0811787878', 4, '1');
INSERT INTO `pasien` (`id_pasien`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `nama_ayah`, `nama_ibu`, `alamat`, `no_telp`, `no_hp`, `id_member`, `aktif`) VALUES (23, 'Tes', '1990-10-01', 'L', NULL, NULL, 'kompleh duta indah', '899889', '0811787878', 4, '1');
INSERT INTO `pasien` (`id_pasien`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `nama_ayah`, `nama_ibu`, `alamat`, `no_telp`, `no_hp`, `id_member`, `aktif`) VALUES (24, 'As', '2000-10-01', 'L', NULL, NULL, 'kompleh duta indah', '899889', '0811787878', 1, '1');
INSERT INTO `pasien` (`id_pasien`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `nama_ayah`, `nama_ibu`, `alamat`, `no_telp`, `no_hp`, `id_member`, `aktif`) VALUES (25, 'Arief', '1989-10-01', NULL, NULL, NULL, NULL, NULL, '12312', 4, '1');
INSERT INTO `pasien` (`id_pasien`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `nama_ayah`, `nama_ibu`, `alamat`, `no_telp`, `no_hp`, `id_member`, `aktif`) VALUES (26, 'Tes123', '2020-01-01', NULL, NULL, NULL, NULL, NULL, '123', NULL, '1');
INSERT INTO `pasien` (`id_pasien`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `nama_ayah`, `nama_ibu`, `alamat`, `no_telp`, `no_hp`, `id_member`, `aktif`) VALUES (27, 'Tes123', '2020-01-01', NULL, NULL, NULL, NULL, NULL, '123', 4, '1');


#
# TABLE STRUCTURE FOR: rekam_medis
#

DROP TABLE IF EXISTS `rekam_medis`;

CREATE TABLE `rekam_medis` (
  `id_rekam_medis` int(11) NOT NULL AUTO_INCREMENT,
  `id_pasien` int(11) DEFAULT NULL,
  `riwayat_penyakit` text,
  `alergi` text,
  `imunisasi` text,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_rekam_medis`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO `rekam_medis` (`id_rekam_medis`, `id_pasien`, `riwayat_penyakit`, `alergi`, `imunisasi`, `create_at`, `update_at`) VALUES (1, 10, 'tidak ada', 'tidak ada', '<table cellspacing=\"0\" style=\"border-collapse:collapse\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"border-bottom:1px solid black; border-left:1px solid black; border-right:1px solid black; border-top:1px solid black; vertical-align:top; width:71px\">\r\n			<p>Hep-b</p>\r\n			</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:1px solid black; vertical-align:top; width:89px\">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:1px solid black; vertical-align:top; width:89px\">&nbsp;</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:1px solid black; vertical-align:top; width:89px\">&nbsp;</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:1px solid black; vertical-align:top; width:89px\">&nbsp;</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:1px solid black; vertical-align:top; width:89px\">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:1px solid black; border-left:1px solid black; border-right:1px solid black; border-top:none; vertical-align:top; width:71px\">\r\n			<p>BCG</p>\r\n			</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">\r\n			<p>1</p>\r\n			</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">\r\n			<p>2</p>\r\n			</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">&nbsp;</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">&nbsp;</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:1px solid black; border-left:1px solid black; border-right:1px solid black; border-top:none; vertical-align:top; width:71px\">\r\n			<p>Polio</p>\r\n			</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">&nbsp;</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">&nbsp;</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">&nbsp;</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:1px solid black; border-left:1px solid black; border-right:1px solid black; border-top:none; vertical-align:top; width:71px\">\r\n			<p>DPT</p>\r\n			</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">&nbsp;</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">&nbsp;</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">&nbsp;</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:1px solid black; border-left:1px solid black; border-right:1px solid black; border-top:none; vertical-align:top; width:71px\">\r\n			<p>Rotavirus</p>\r\n			</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">&nbsp;</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">&nbsp;</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">&nbsp;</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:1px solid black; border-left:1px solid black; border-right:1px solid black; border-top:none; vertical-align:top; width:71px\">\r\n			<p>PCV</p>\r\n			</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">&nbsp;</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">&nbsp;</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">&nbsp;</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:1px solid black; border-left:1px solid black; border-right:1px solid black; border-top:none; vertical-align:top; width:71px\">\r\n			<p>Hep-A</p>\r\n			</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">&nbsp;</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">&nbsp;</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">&nbsp;</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:1px solid black; border-left:1px solid black; border-right:1px solid black; border-top:none; vertical-align:top; width:71px\">\r\n			<p>Tifoid</p>\r\n			</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">&nbsp;</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">&nbsp;</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">&nbsp;</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px\">&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, NULL);


#
# TABLE STRUCTURE FOR: setting
#

DROP TABLE IF EXISTS `setting`;

CREATE TABLE `setting` (
  `id_setting` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `value` text,
  PRIMARY KEY (`id_setting`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

INSERT INTO `setting` (`id_setting`, `nama`, `value`) VALUES (1, 'email_pengirim', 'dr.ariefgunadi@gmail.com');
INSERT INTO `setting` (`id_setting`, `nama`, `value`) VALUES (2, 'password_pengirim', 'axhsmozfbefjbqha');
INSERT INTO `setting` (`id_setting`, `nama`, `value`) VALUES (3, 'email_admin', 'admin@dokterarief.com');
INSERT INTO `setting` (`id_setting`, `nama`, `value`) VALUES (4, 'akses_konfirmasi', '1');
INSERT INTO `setting` (`id_setting`, `nama`, `value`) VALUES (6, 'alamat', '<p>PRAKTER DOKTER<br />Ruko Golden Park No.7<br />Kel. Lengkong Karya, Kec. Serpong Utara<br />Kota Tanggerang Selatan<br />Telp. 0812 8888 2714</p>');


#
# TABLE STRUCTURE FOR: pemberitahuan
#

DROP TABLE IF EXISTS `pemberitahuan`;

CREATE TABLE `pemberitahuan` (
  `id_pemberitahuan` int(11) NOT NULL,
  `pemberitahuan` text,
  `aktif` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id_pemberitahuan`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `pemberitahuan` (`id_pemberitahuan`, `pemberitahuan`, `aktif`) VALUES (0, 'Tes', '1');



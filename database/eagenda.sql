-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.3.16-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table eagenda.initial_sistem
CREATE TABLE IF NOT EXISTS `initial_sistem` (
  `nama_lembaga` varchar(225) DEFAULT NULL,
  `nama_kontak_person` varchar(225) DEFAULT NULL,
  `telepon` varchar(225) DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL,
  `draft_surat_keluar` text DEFAULT NULL,
  `directory_arsip_surat` varchar(225) DEFAULT NULL,
  `nomor_otomatis_surat_keluar` int(11) DEFAULT NULL,
  `nomor_otomatis_surat_pelayanan` int(11) DEFAULT NULL,
  `alamat_lembaga` varchar(225) DEFAULT NULL,
  `nama_kota_lembaga` varchar(225) DEFAULT NULL,
  `nama_kecamatan_lembaga` varchar(225) DEFAULT NULL,
  `nama_kelurahan_lembaga` varchar(225) DEFAULT NULL,
  `logo_lembaga` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table eagenda.initial_sistem: ~1 rows (approximately)
/*!40000 ALTER TABLE `initial_sistem` DISABLE KEYS */;
INSERT INTO `initial_sistem` (`nama_lembaga`, `nama_kontak_person`, `telepon`, `email`, `draft_surat_keluar`, `directory_arsip_surat`, `nomor_otomatis_surat_keluar`, `nomor_otomatis_surat_pelayanan`, `alamat_lembaga`, `nama_kota_lembaga`, `nama_kecamatan_lembaga`, `nama_kelurahan_lembaga`, `logo_lembaga`) VALUES
	('Kelurahan Telaga Sari', 'KAMSANI', '0800000000', 'telagasaribalikpapan@gmail.com', NULL, 'c:\\xampp\\SiAgenTalas\\output\\arsip_surat', 201, 430, 'Jln. RE Martadinata No.10', 'Balikpapan', 'Balikpapan Kota', 'Telaga Sari', NULL);
/*!40000 ALTER TABLE `initial_sistem` ENABLE KEYS */;


-- Dumping structure for table eagenda.list_output_file
CREATE TABLE IF NOT EXISTS `list_output_file` (
  `id_output_file` int(11) NOT NULL AUTO_INCREMENT,
  `id_surat` int(11) NOT NULL,
  `jenis_surat` tinytext DEFAULT NULL,
  `nama_file` varchar(225) DEFAULT NULL,
  `keterangan_file` varchar(225) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_output_file`,`id_surat`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table eagenda.list_output_file: ~0 rows (approximately)
/*!40000 ALTER TABLE `list_output_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `list_output_file` ENABLE KEYS */;


-- Dumping structure for table eagenda.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table eagenda.migrations: ~1 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2021_04_05_055015_create_sessions_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;


-- Dumping structure for table eagenda.penduduk
CREATE TABLE IF NOT EXISTS `penduduk` (
  `id_penduduk` int(11) NOT NULL AUTO_INCREMENT,
  `nik_kependudukan` varchar(16) CHARACTER SET latin1 NOT NULL,
  `nama_lengkap_penduduk` char(50) CHARACTER SET latin1 DEFAULT NULL,
  `tempat_lahir` char(50) CHARACTER SET latin1 DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` char(1) CHARACTER SET latin1 DEFAULT 'L',
  `keterangan_gol_darah` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `alamat` varchar(225) CHARACTER SET latin1 DEFAULT NULL,
  `no_rt` varchar(3) CHARACTER SET latin1 DEFAULT NULL,
  `nama_kelurahan_penduduk` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `nama_kecamatan_penduduk` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `keterangan_agama` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `keterangan_ijazah_tertinggi` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `keterangan_status_kawin` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `keterangan_jenis_pekerjaan` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `kewarganegaraan` varchar(3) CHARACTER SET latin1 DEFAULT NULL,
  `nomor_kk` varchar(16) NOT NULL,
  `input_by` int(225) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_penduduk`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table eagenda.penduduk: ~2 rows (approximately)
/*!40000 ALTER TABLE `penduduk` DISABLE KEYS */;
INSERT INTO `penduduk` (`id_penduduk`, `nik_kependudukan`, `nama_lengkap_penduduk`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `keterangan_gol_darah`, `alamat`, `no_rt`, `nama_kelurahan_penduduk`, `nama_kecamatan_penduduk`, `keterangan_agama`, `keterangan_ijazah_tertinggi`, `keterangan_status_kawin`, `keterangan_jenis_pekerjaan`, `kewarganegaraan`, `nomor_kk`, `input_by`, `created_at`, `updated_at`) VALUES
	(1, '1111122222333330', 'hermawan rachman', 'balikpapan', '2021-02-26', 'L', 'A+', 'Jln. Blora No.18', '18', 'Klandasan ilir', 'Balikpapan Kota', 'Islam', 'D1 / D2 / D3\r', 'KAWIN', 'KARYAWAN SWASTA', 'WNI', '1111122222000001', NULL, '2021-04-17 16:17:16', '2021-04-17 16:17:16'),
	(2, '1111122222333331', 'ahmad ariyandi', 'samarinda', '2019-10-23', 'L', 'AB-', 'Jln. RE Martadinata No.23', '32', 'Telaga Sari', 'Balikpapan Kota', 'Islam', 'S2 / S3', 'KAWIN', 'PETERNAK', 'WNI', '1111122222000002', NULL, '0000-00-00 00:00:00', NULL);
/*!40000 ALTER TABLE `penduduk` ENABLE KEYS */;


-- Dumping structure for table eagenda.ref_agama
CREATE TABLE IF NOT EXISTS `ref_agama` (
  `id_agama` varchar(1) NOT NULL,
  `keterangan_agama` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_agama`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table eagenda.ref_agama: 7 rows
/*!40000 ALTER TABLE `ref_agama` DISABLE KEYS */;
INSERT INTO `ref_agama` (`id_agama`, `keterangan_agama`) VALUES
	('1', 'ISLAM'),
	('2', 'KRISTEN'),
	('3', 'KATHOLIK'),
	('4', 'HINDU'),
	('5', 'BUDHA'),
	('6', 'KONGHUCU'),
	('7', 'ALIRAN KEPERCAYAAN');
/*!40000 ALTER TABLE `ref_agama` ENABLE KEYS */;


-- Dumping structure for table eagenda.ref_daftar_syarat_surat_pelayanan
CREATE TABLE IF NOT EXISTS `ref_daftar_syarat_surat_pelayanan` (
  `id_syarat` int(2) NOT NULL AUTO_INCREMENT,
  `id_jenis_surat_pelayanan` int(2) DEFAULT NULL,
  `nama_persyaratan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_syarat`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table eagenda.ref_daftar_syarat_surat_pelayanan: 45 rows
/*!40000 ALTER TABLE `ref_daftar_syarat_surat_pelayanan` DISABLE KEYS */;
INSERT INTO `ref_daftar_syarat_surat_pelayanan` (`id_syarat`, `id_jenis_surat_pelayanan`, `nama_persyaratan`) VALUES
	(1, 1, 'NIB (Nomor Induk Bersama)'),
	(2, 1, 'Surat Pengantar RT'),
	(3, 1, 'KTP Penanggung Jawab Perusahaan'),
	(4, 1, 'KK (Kartu Keluarga) Penanggung Jawab Perusahaan'),
	(5, 1, 'IUMK Bagi Perusahaan Perorangan'),
	(6, 2, 'KK (Kartu Keluarga) Pemohon'),
	(7, 2, 'KTP Pemohon'),
	(8, 2, 'Surat Pengantar RT'),
	(9, 2, 'Surat pernyataan berpenghasilan tidak tetap yang mencakup nama pekerjaan dan jumlah penghasilan'),
	(10, 2, 'KTP Saksi 1'),
	(11, 2, 'KTP Saksi 2'),
	(12, 3, 'Pengantar RT'),
	(13, 3, 'KTP Pemohon'),
	(14, 3, 'KK Pemohon'),
	(15, 3, 'KTP Saksi 1 sesuai Surat Pernyataan'),
	(16, 3, 'KTP Saksi 2 sesuai Surat Pernyataan'),
	(17, 3, 'Surat pernyataan bermaterai belum pernah menikah yang ditandatangani 2 orang saksi'),
	(18, 4, 'Surat Pengantar RT'),
	(19, 4, 'KK Pemohon'),
	(20, 4, 'KTP Pemohon'),
	(21, 4, 'Pas Foto Ukuran 3x4 Latar Belakang Merah 2 Lembar'),
	(22, 4, 'Surat Keterangan Kerja/Kuliah/KK Penjamin'),
	(23, 5, 'Pemerintah Kota Balikpapan tidak memberikan layanan surat kuasa ahli waris. Surat Kuasa Ahli Waris c'),
	(24, 6, 'KTP Saksi Pertama'),
	(25, 6, 'KTP Saksi Kedua'),
	(26, 6, 'Surat pernyataan sebagai janda/duda dan belum menikah lagi yang ditandatangani 2 orang saksi'),
	(27, 6, 'Surat Pengantar RT'),
	(28, 6, 'KTP Pemohon'),
	(29, 6, 'KK Pemohon'),
	(30, 6, 'Akta Cerai / Akta Kematian Suami atau Istri'),
	(31, 7, 'Surat Pengantar RT'),
	(32, 7, 'KK Pemohon'),
	(33, 7, 'KTP Pemohon'),
	(34, 8, 'Akta Kelahiran'),
	(35, 8, 'Pas foto Pemohon ukuran 2 x 3 lembar dengan latar belakang warna biru'),
	(36, 8, 'Pas foto Calon Pasangan ukuran 2 x 3 lembar dengan latar belakang warna biru'),
	(37, 8, 'Akta Cerai/Akta Kematian (Untuk Duda/Janda yang cerai hidup/cerai mati)'),
	(38, 8, 'Surat Pernyataan untuk Menikah'),
	(39, 8, 'Surat Pengantar RT'),
	(40, 8, 'KTP Pemohon'),
	(41, 8, 'KK Pemohon'),
	(42, 8, 'KTP Saksi 1 yang tertera pada Surat Pernyataan untuk Menikah'),
	(43, 8, 'KTP Saksi 2 yang tertera pada Surat Pernyataan untuk Menikah'),
	(44, 8, 'KTP Ibu Pemohon'),
	(45, 8, 'KTP Bapak Pemohon');
/*!40000 ALTER TABLE `ref_daftar_syarat_surat_pelayanan` ENABLE KEYS */;


-- Dumping structure for table eagenda.ref_gol_darah
CREATE TABLE IF NOT EXISTS `ref_gol_darah` (
  `id_gol_darah` int(2) NOT NULL AUTO_INCREMENT,
  `keterangan_gol_darah` char(10) DEFAULT NULL,
  PRIMARY KEY (`id_gol_darah`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

-- Dumping data for table eagenda.ref_gol_darah: 13 rows
/*!40000 ALTER TABLE `ref_gol_darah` DISABLE KEYS */;
INSERT INTO `ref_gol_darah` (`id_gol_darah`, `keterangan_gol_darah`) VALUES
	(1, 'A'),
	(2, 'B'),
	(3, 'AB'),
	(4, 'O'),
	(5, 'A+'),
	(6, 'A-'),
	(7, 'B+'),
	(8, 'B-'),
	(9, 'AB+'),
	(10, 'AB-'),
	(11, 'O+'),
	(12, 'O-'),
	(13, 'TIDAK TAHU');
/*!40000 ALTER TABLE `ref_gol_darah` ENABLE KEYS */;


-- Dumping structure for table eagenda.ref_ijazah_tertinggi
CREATE TABLE IF NOT EXISTS `ref_ijazah_tertinggi` (
  `id_ijazah_tertinggi` int(1) NOT NULL,
  `keterangan_ijazah_tertinggi` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_ijazah_tertinggi`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table eagenda.ref_ijazah_tertinggi: 7 rows
/*!40000 ALTER TABLE `ref_ijazah_tertinggi` DISABLE KEYS */;
INSERT INTO `ref_ijazah_tertinggi` (`id_ijazah_tertinggi`, `keterangan_ijazah_tertinggi`) VALUES
	(0, 'Tidak punya ijazah\r'),
	(1, 'SD/sederajat\r'),
	(2, 'SMP/sederajat\r'),
	(3, 'SMA/sederajat\r'),
	(4, 'D1 / D2 / D3\r'),
	(5, 'D4 / S1\r'),
	(6, 'S2 / S3');
/*!40000 ALTER TABLE `ref_ijazah_tertinggi` ENABLE KEYS */;


-- Dumping structure for table eagenda.ref_jenis_pekerjaan
CREATE TABLE IF NOT EXISTS `ref_jenis_pekerjaan` (
  `id_jenis_pekerjaan` int(2) NOT NULL AUTO_INCREMENT,
  `keterangan_jenis_pekerjaan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_jenis_pekerjaan`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table eagenda.ref_jenis_pekerjaan: 89 rows
/*!40000 ALTER TABLE `ref_jenis_pekerjaan` DISABLE KEYS */;
INSERT INTO `ref_jenis_pekerjaan` (`id_jenis_pekerjaan`, `keterangan_jenis_pekerjaan`) VALUES
	(8, 'PERDAGANGAN'),
	(7, 'KEPOLISIAN RI'),
	(6, 'TENTARA NASIONAL INDONESIA'),
	(5, 'PEGAWAI NEGERI SIPIL (PNS)'),
	(4, 'PENSIUNAN'),
	(3, 'PELAJAR/MAHASISWA'),
	(2, 'MENGATUR RUMAH TANGGA'),
	(1, 'BELUM/TIDAK BEKERJA'),
	(9, 'PETANI/PEKEBUN'),
	(10, 'PETERNAK'),
	(11, 'NELAYAN/PERIKANAN'),
	(12, 'INDUSTRI'),
	(13, 'KONSTRUKSI'),
	(14, 'TRANSPORTASI'),
	(15, 'KARYAWAN SWASTA'),
	(16, 'KARYAWAN BUMN'),
	(17, 'KARYAWAN BUMD'),
	(18, 'KARYAWAN HONORER'),
	(19, 'BURUH HARIAN LEPAS'),
	(20, 'BURUH TANI/PERKEBUNAN'),
	(21, 'BURUH NELAYAN/PERIKANAN'),
	(22, 'BURUH PETERNAKAN'),
	(23, 'PEMBANTU RUMAH TANGGA'),
	(24, 'TUKANG CUKUR'),
	(25, 'TUKANG LISTRIK'),
	(26, 'TUKANG BATU'),
	(27, 'TUKANG KAYU'),
	(28, 'TUKANG SOL SEPATU'),
	(29, 'TUKANG LAS/PANDAI BESI'),
	(30, 'TUKANG JAHIT'),
	(31, 'TUKANG GIGI'),
	(32, 'PENATA RIAS'),
	(33, 'PENATA BUSANA'),
	(34, 'PENATA RAMBUT'),
	(35, 'MEKANIK'),
	(36, 'SENIMAN'),
	(37, 'TABIB'),
	(38, 'PARAJI'),
	(39, 'PERANCANG BUSANA'),
	(40, 'PENTERJEMAH'),
	(41, 'IMAM MESJID'),
	(42, 'PENDETA'),
	(43, 'PASTOR'),
	(44, 'WARTAWAN'),
	(45, 'USTADZ/MUBALIGH'),
	(46, 'JURU MASAK'),
	(47, 'PROMOTOR ACARA'),
	(48, 'ANGGOTA DPR-RI'),
	(49, 'ANGGOTA DPD'),
	(50, 'ANGGOTA BPK'),
	(51, 'PRESIDEN'),
	(52, 'WAKIL PRESIDEN'),
	(53, 'ANGGOTA MAHKAMAH KONSTITUSI'),
	(54, 'ANGGOTA KABINET/KEMENTERIAN'),
	(55, 'DUTA BESAR'),
	(56, 'GUBERNUR'),
	(57, 'WAKIL GUBERNUR'),
	(58, 'BUPATI'),
	(59, 'WAKIL BUPATI'),
	(60, 'WALIKOTA'),
	(61, 'WAKIL WALIKOTA'),
	(62, 'ANGGOTA DPRD PROVINSI'),
	(63, 'ANGGOTA DPRD KABUPATEN/KOTA'),
	(64, 'DOSEN'),
	(65, 'GURU'),
	(66, 'PILOT'),
	(67, 'PENGACARA'),
	(68, 'NOTARIS'),
	(69, 'ARSITEK'),
	(70, 'AKUNTAN'),
	(71, 'KONSULTAN'),
	(72, 'DOKTER'),
	(73, 'BIDAN'),
	(74, 'PERAWAT'),
	(75, 'APOTEKER'),
	(76, 'PSIKIATER/PSIKOLOG'),
	(77, 'PENYIAR TELEVISI'),
	(78, 'PENYIAR RADIO'),
	(79, 'PELAUT'),
	(80, 'PENELITI'),
	(81, 'SOPIR'),
	(82, 'PIALANG'),
	(83, 'PARANORMAL'),
	(84, 'PEDAGANG'),
	(85, 'PERANGKAT DESA'),
	(86, 'KEPALA DESA'),
	(87, 'BIARAWATI'),
	(88, 'WIRASWASTA'),
	(89, 'LAINNYA');
/*!40000 ALTER TABLE `ref_jenis_pekerjaan` ENABLE KEYS */;


-- Dumping structure for table eagenda.ref_jenis_surat_pelayanan
CREATE TABLE IF NOT EXISTS `ref_jenis_surat_pelayanan` (
  `id_jenis_surat_pelayanan` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `nama_jenis_surat_pelayanan` varchar(100) DEFAULT NULL,
  `template_surat_pelayanan` text DEFAULT NULL,
  `keterangan_tambahan` text DEFAULT NULL,
  PRIMARY KEY (`id_jenis_surat_pelayanan`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table eagenda.ref_jenis_surat_pelayanan: 8 rows
/*!40000 ALTER TABLE `ref_jenis_surat_pelayanan` DISABLE KEYS */;
INSERT INTO `ref_jenis_surat_pelayanan` (`id_jenis_surat_pelayanan`, `nama_jenis_surat_pelayanan`, `template_surat_pelayanan`, `keterangan_tambahan`) VALUES
	(1, 'Surat Keterangan Lokasi Usaha', 'Pemerintah Kota Balikpapan - \r\nKecamatan Balikpapan Kota - \r\nKelurahan Telaga Sari - \r\n[ SURAT KETERANGAN LOKASI USAHA ]', NULL),
	(2, 'Surat Keterangan Berpenghasilan Tidak Tetap', 'Pemerintah Kota Balikpapan - \r\nKecamatan Balikpapan Kota - \r\nKelurahan Telaga Sari - \r\n[ SURAT KETERANGAN BERPENGHASILAN TIDAK TETAP ]', NULL),
	(3, 'Surat Keterangan Belum Pernah Menikah', 'Pemerintah Kota Balikpapan - \r\nKecamatan Balikpapan Kota - \r\nKelurahan Telaga Sari - \r\n[ SURAT KETERANGAN BELUM PERNAH MENIKAH ]', NULL),
	(4, 'Surat Keterangan Bertempat Tinggal', 'Pemerintah Kota Balikpapan - \r\nKecamatan Balikpapan Kota - \r\nKelurahan Telaga Sari - \r\n[ SURAT KETERANGAN BERTEMPAT TINGGAL ]', NULL),
	(5, 'Surat Kuasa Ahli Waris', 'Pemerintah Kota Balikpapan - \r\nKecamatan Balikpapan Kota - \r\nKelurahan Telaga Sari - \r\n[ SURAT KETERANGAN AHLI WARIS ]', NULL),
	(6, 'Surat Keterangan Janda / Duda', 'Pemerintah Kota Balikpapan - \r\nKecamatan Balikpapan Kota - \r\nKelurahan Telaga Sari - \r\n[ SURAT KETERANGAN JANDA / DUDA ]', NULL),
	(7, 'Surat Keterangan Domisili (Bagi Warga ber KTP Setempat)', 'Pemerintah Kota Balikpapan - \r\nKecamatan Balikpapan Kota - \r\nKelurahan Telaga Sari - \r\n[ SURAT KETERANGAN DOMISILI ]', NULL),
	(8, 'Surat Pengantar Nikah', 'Pemerintah Kota Balikpapan - \r\nKecamatan Balikpapan Kota - \r\nKelurahan Telaga Sari \r\n[ SURAT PENGANTAR NIKAH ] \r\n', NULL);
/*!40000 ALTER TABLE `ref_jenis_surat_pelayanan` ENABLE KEYS */;


-- Dumping structure for table eagenda.ref_status_kawin
CREATE TABLE IF NOT EXISTS `ref_status_kawin` (
  `id_status_kawin` int(1) NOT NULL,
  `keterangan_status_kawin` char(20) DEFAULT NULL,
  PRIMARY KEY (`id_status_kawin`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

-- Dumping data for table eagenda.ref_status_kawin: 4 rows
/*!40000 ALTER TABLE `ref_status_kawin` DISABLE KEYS */;
INSERT INTO `ref_status_kawin` (`id_status_kawin`, `keterangan_status_kawin`) VALUES
	(1, 'BELUM KAWIN'),
	(2, 'KAWIN'),
	(3, 'CERAI HIDUP'),
	(4, 'CERAI MATI');
/*!40000 ALTER TABLE `ref_status_kawin` ENABLE KEYS */;


-- Dumping structure for table eagenda.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table eagenda.sessions: ~4 rows (approximately)
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('bPMjA7Cye6dHg0VhEPdOCDfQKoEXf6AIDblKO1KL', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.128 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoicWlIYURiWWhZT09nNUZRdTJNeURvRGlXUmhaNVY2dndGTmJmUUZFSyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ2OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vcmVmLXN1cmF0cGVsYXlhbmFuIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1619104603),
	('szW53zTm8uABt1uvzq3foMa9Rv2LxAn6FtyR2a9z', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.128 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiS3NvMG9kSWJzWHJYN0tTcG9TTWthSDZrcG93eldSM1FEU1FvWUV6cyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQzOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vc3VyYXQtcGVsYXlhbmFuIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1619097124);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;


-- Dumping structure for table eagenda.surat_keluar
CREATE TABLE IF NOT EXISTS `surat_keluar` (
  `id_surat_keluar` int(11) NOT NULL AUTO_INCREMENT,
  `status_final` tinyint(1) DEFAULT NULL,
  `nomor_surat` varchar(25) DEFAULT NULL,
  `nomor_surat_rujukan` varchar(50) DEFAULT NULL,
  `perihal_surat` varchar(100) DEFAULT NULL,
  `tanggal_surat` date DEFAULT NULL,
  `tujuan_surat` varchar(225) DEFAULT NULL,
  `tembusan_surat` varchar(225) DEFAULT NULL,
  `klasifikasi_surat` tinyint(1) DEFAULT NULL,
  `keterangan_lain` varchar(225) DEFAULT NULL,
  `ringkasan_surat` varchar(225) DEFAULT NULL,
  `nama_pejabat_ttd` varchar(50) DEFAULT NULL,
  `isi_surat` text DEFAULT NULL,
  `jumlah_file_scan` tinyint(225) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_surat_keluar`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table eagenda.surat_keluar: ~0 rows (approximately)
/*!40000 ALTER TABLE `surat_keluar` DISABLE KEYS */;
/*!40000 ALTER TABLE `surat_keluar` ENABLE KEYS */;


-- Dumping structure for table eagenda.surat_masuk
CREATE TABLE IF NOT EXISTS `surat_masuk` (
  `id_surat_masuk` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_surat` varchar(25) DEFAULT NULL,
  `perihal_surat` varchar(100) DEFAULT NULL,
  `tanggal_surat` date DEFAULT NULL,
  `asal_surat` varchar(100) DEFAULT NULL,
  `nama_pejabat_penerima_disposisi` varchar(50) DEFAULT NULL,
  `status_disposisi` tinyint(1) DEFAULT NULL,
  `keterangan_pemberi_disposisi` varchar(225) DEFAULT NULL,
  `keterangan_penerima_disposisi` varchar(225) DEFAULT NULL,
  `ringkasan_surat` varchar(225) DEFAULT NULL,
  `jumlah_file_scan` tinyint(225) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_surat_masuk`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table eagenda.surat_masuk: ~0 rows (approximately)
/*!40000 ALTER TABLE `surat_masuk` DISABLE KEYS */;
/*!40000 ALTER TABLE `surat_masuk` ENABLE KEYS */;


-- Dumping structure for table eagenda.surat_pelayanan
CREATE TABLE IF NOT EXISTS `surat_pelayanan` (
  `id_surat_pelayanan` int(11) NOT NULL AUTO_INCREMENT,
  `status_final` tinyint(1) DEFAULT NULL,
  `nomor_surat` varchar(25) DEFAULT NULL,
  `nama_jenis_surat_pelayanan` varchar(100) DEFAULT NULL,
  `tanggal_surat` date DEFAULT NULL,
  `nama_pejabat_pembuat` varchar(50) DEFAULT NULL,
  `jabatan` varchar(150) DEFAULT NULL,
  `nama_lengkap_penduduk` char(50) CHARACTER SET latin1 DEFAULT NULL,
  `tempat_lahir` char(50) CHARACTER SET latin1 DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `nik_kependudukan` varchar(16) CHARACTER SET latin1 NOT NULL,
  `nomor_kk` varchar(16) NOT NULL,
  `jenis_kelamin` char(1) CHARACTER SET latin1 DEFAULT NULL,
  `keterangan_jenis_pekerjaan` varchar(100) DEFAULT NULL,
  `kewarganegaraan` varchar(3) DEFAULT NULL,
  `keterangan_agama` varchar(20) DEFAULT NULL,
  `keterangan_status_kawin` varchar(20) DEFAULT NULL,
  `alamat` text CHARACTER SET latin1 DEFAULT NULL,
  `no_rt` varchar(3) CHARACTER SET latin1 DEFAULT NULL,
  `nama_kelurahan_penduduk` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `nama_kecamatan_penduduk` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `dasar_1` text DEFAULT NULL,
  `dasar_2` text DEFAULT NULL,
  `dasar_3` text DEFAULT NULL,
  `maksud_1` text DEFAULT NULL,
  `maksud_2` text DEFAULT NULL,
  `maksud_3` text DEFAULT NULL,
  `maksud_4` text DEFAULT NULL,
  `status_approval` tinyint(1) DEFAULT 0,
  `jumlah_file_scan` tinyint(2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_surat_pelayanan`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table eagenda.surat_pelayanan: ~0 rows (approximately)
/*!40000 ALTER TABLE `surat_pelayanan` DISABLE KEYS */;
/*!40000 ALTER TABLE `surat_pelayanan` ENABLE KEYS */;


-- Dumping structure for table eagenda.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_hp` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_user` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `users_email_unique` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table eagenda.users: ~3 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `nama_lengkap`, `username`, `email`, `jabatan`, `nomor_hp`, `password`, `role`, `status_user`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Bapak Kamsani', 'kamsani', 'kamsani@gmail.com', 'Lurah', '08000000', '$2y$10$aVd1Ni9zCEwHqLDZEE0J5.Cw5w9BQYI6hnukVNbKjJevrshKeG/9i', 'admin', '1', NULL, '2021-04-18 21:31:24', '0000-00-00 00:00:00'),
	(2, 'iwan (hermawan)', 'iwan', 'iwan@gmail.com', 'Kepala Seksi Pemerintahan dan Pelayanan Publik', '081111111', '$2y$10$aVd1Ni9zCEwHqLDZEE0J5.Cw5w9BQYI6hnukVNbKjJevrshKeG/9i', 'supervisor', '1', NULL, '2021-04-18 21:31:32', '0000-00-00 00:00:00'),
	(3, 'Riski Maulana Rahman', 'riski', 'riski@gmail.com', 'Staf Pemberdayaan Masyarakat', '089222222', '$2y$10$aVd1Ni9zCEwHqLDZEE0J5.Cw5w9BQYI6hnukVNbKjJevrshKeG/9i', 'admin', '1', NULL, '2021-04-18 21:31:55', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

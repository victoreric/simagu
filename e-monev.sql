-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 04, 2022 at 12:31 PM
-- Server version: 8.0.27
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-monev`
--

-- --------------------------------------------------------

--
-- Table structure for table `jemaat`
--

CREATE TABLE `jemaat` (
  `id_jemaat` int NOT NULL,
  `kd_jemaat` varchar(10) NOT NULL,
  `nama_jemaat` varchar(50) NOT NULL,
  `klasis` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `ketua_MJ` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jemaat`
--

INSERT INTO `jemaat` (`id_jemaat`, `kd_jemaat`, `nama_jemaat`, `klasis`, `alamat`, `ketua_MJ`) VALUES
(7, '001', 'SILO', 'Kota Ambon', 'Ambon', 'Pendeta gaga');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_kegiatan` int NOT NULL,
  `kd_jemaat` varchar(10) NOT NULL,
  `kd_seksi` varchar(10) NOT NULL,
  `kd_subseksi` varchar(10) NOT NULL,
  `nomor_kegiatan` varchar(50) NOT NULL,
  `periode` year NOT NULL,
  `kegiatan` varchar(200) NOT NULL,
  `indikator` varchar(200) NOT NULL,
  `capaian_keg` varchar(20) NOT NULL,
  `capaian_biaya` varchar(20) NOT NULL,
  `capaian_sasaran` varchar(20) NOT NULL,
  `capaian_waktu` varchar(20) NOT NULL,
  `capaian_tempat` varchar(20) NOT NULL,
  `nilai_capaian_keg` int NOT NULL,
  `nilai_biaya` int NOT NULL,
  `nilai_sasaran` int NOT NULL,
  `nilai_waktu` int NOT NULL,
  `nilai_tempat` int NOT NULL,
  `nilai_capaian` int NOT NULL,
  `nilai_kategori` varchar(20) NOT NULL,
  `nilai_capaian_subbidang` int NOT NULL,
  `realisasi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `kd_jemaat`, `kd_seksi`, `kd_subseksi`, `nomor_kegiatan`, `periode`, `kegiatan`, `indikator`, `capaian_keg`, `capaian_biaya`, `capaian_sasaran`, `capaian_waktu`, `capaian_tempat`, `nilai_capaian_keg`, `nilai_biaya`, `nilai_sasaran`, `nilai_waktu`, `nilai_tempat`, `nilai_capaian`, `nilai_kategori`, `nilai_capaian_subbidang`, `realisasi`) VALUES
(14, '001', 's-001', 'ss-001', 'L.8.5.1.J ', 2022, '    Koinonia bersama Jemaat dengan Jemaat Anggota PGI lainnya   ', '   Menjalin persekutuan bersama diantara anggota PGI   ', 'Sesuai Target', 'Sesuai Target', 'Sesuai Target', 'Sesuai Target', 'Sesuai Target', 2, 2, 2, 2, 2, 100, 'Sesuai Target', 2, 'Realisasi'),
(15, '001', 's-001', 'ss-001', 'L.8.5.2.J', 2022, 'Menjalin persekutuan bersama diantara anggota PGI  ', 'Menjalin persekutuan bersama diantara anggota PGI       ', 'Nihil Target', 'Nihil Target', 'Nihil Target', 'Nihil Target', 'Nihil Target', 0, 0, 0, 0, 0, 0, 'Nihil Target', 0, 'Tidak Realisasi'),
(17, '001', 's-001', 'ss-002', 'L.8.6.1.J', 2022, ' Komunikasi dan Kerjasama Lintas Iman ', ' Terlaksananya Koordinasi dan Komunikasi dalam menjaga kerukunan beragama bersama ulama disekitar Jemaat ', 'Sesuai Target', 'Sesuai Target', 'Sesuai Target', 'Sesuai Target', 'Sesuai Target', 2, 2, 2, 2, 2, 100, 'Sesuai Target', 2, 'Realisasi'),
(18, '001', 's-001', 'ss-002', 'L.8.9.1.J.', 2022, '     Edukasi Umat dan Pelayan Tentang Pluralisme Melalui Media Infokom Jemaat baik secara off line maupun on line     ', '     Terlaksananya Edukasi umat dan pelayan tentang pluralisme melalui media Infokom Jemaat baik secara offline maupun online sekali setiap bulan sepanjang tahun     ', 'Nihil Target', 'Nihil Target', 'Nihil Target', 'Nihil Target', 'Nihil Target', 0, 0, 0, 0, 0, 0, 'Nihil Target', 0, 'Tidak Realisasi'),
(19, '001', 's-001', 'ss-002', 'L.8.9.2.K-J', 2022, 'Khotbah Damai (Peace Sermon) tentang permasalahan social pada mimbar jemaat secara daring/luring sesuai kondisi jemaat.', 'Terlaksananya Khotbah Damai (Peace Sermoni) tentang permasalahan sosial pada masing-masing melalui mimbar-mimbar ibadah jemaat/uni/wadah pelayanan pada tahun 2022 sesuai materi bina umat LPJ    ', 'Nihil Target', 'Nihil Target', 'Nihil Target', 'Nihil Target', 'Nihil Target', 0, 0, 0, 0, 0, 0, 'Nihil Target', 0, 'Tidak Realisasi'),
(24, '001', 's-001', 'ss-003', 'U.11.1..J ', 2022, ' Kampanye Peduli Lingkungan Melalui Media Komunikasi Jemaat Secara Daring atau Luring Sesuai Kondisi Jemaat', 'Terlaksananya Kampanye Peduli Lingkungan Melalui Media Komunikasi Jemaat Secara daring setiap 2 bulan  pada tahun 2022', 'Sesuai Target', 'Lebih Target', 'Sesuai Target', 'Sesuai Target', 'Sesuai Target', 2, 3, 2, 2, 2, 110, 'Lebih Target', 3, 'Realisasi'),
(25, '001', 's-001', 'ss-003', 'U.11.1.7.J.', 2022, 'Sabtu Pagi Bersih Lingkungan', 'Terlaksananya Sabtu Pagi Bersih Lingkungan baik pada lokasi-lokasi gedung gereja, maupun lingkungan 10 sektor pelayanan sepanjang tahun\r\n2022', 'Sesuai Target', 'Lebih Target', 'Sesuai Target', 'Sesuai Target', 'Sesuai Target', 2, 3, 2, 2, 2, 110, 'Lebih Target', 3, 'Realisasi'),
(26, '001', 's-001', 'ss-003', 'U.11.1.8.J.', 2022, ' Aksi Peduli Lingkungan ', ' Terlaksananya peduli lingkungan dengan aksi menanam pohon umur panjang  disetiap sector pelayanan  ', 'Nihil Target', 'Nihil Target', 'Nihil Target', 'Nihil Target', 'Nihil Target', 0, 0, 0, 0, 0, 0, 'Nihil Target', 0, 'Tidak Realisasi'),
(28, '001', 's-001', 'ss-003', 'U.11.1.10.J.', 2002, 'Diskusi Umat Dengan Tema Degradasi Lingkungan dan Penanganannya', 'Terlaksananya diskusi umat dengan tema degradasi Lingkungan dan Penanganannya bagi perangkat pelayan di jemaat ', 'Nihil Target', 'Nihil Target', 'Nihil Target', 'Nihil Target', 'Nihil Target', 0, 0, 0, 0, 0, 0, 'Nihil Target', 0, 'Tidak Realisasi'),
(29, '001', 's-001', 'ss-003', 'U.11.1.11.J.', 2022, ' Serba-Serbi Informasi Kebijakan Pemerintah Kota dan Publikasi materi bina umat Terkait Lingkungan Melalui Media Infokom Jemaat\r\n ', ' Terlaksananya Serba-Serbi Informasi Kebijakan Pemerintah Kota dan Publikasi materi bina umat Terkait Lingkungan Melalui Media Infokom Jemaat dalam bentuk liflet dan website Jemaat\r\n ', 'Sesuai Target', 'Lebih Target', 'Sesuai Target', 'Sesuai Target', 'Sesuai Target', 2, 3, 2, 2, 2, 110, 'Lebih Target', 3, 'Realisasi'),
(30, '001', 's-001', 'ss-004', 'L.9.1.1.J. ', 2022, 'Mitigasi Bencana dan Penjemaatannya', 'Terlaksananya mitigasi bencana dan penjematannya dalam bentuk poster/marka bencana pada wilayah pelayanan jemaat pada tahun 2022', 'Lebih Target', 'Lebih Target', 'Sesuai Target', 'Sesuai Target', 'Sesuai Target', 3, 3, 2, 2, 2, 120, 'Lebih Target', 3, 'Realisasi'),
(31, '001', 's-001', 'ss-004', 'L.9.1.2.J.', 2022, 'Sosialisasi Pengurangan Resiko Bencana dan Adaptasi Perubahan Iklim', 'Terlaksananya Sosialisasi Pengurangan Resiko Bencana dan Adaptasi Perubahan Iklim', 'Nihil Target', 'Nihil Target', 'Nihil Target', 'Nihil Target', 'Nihil Target', 0, 0, 0, 0, 0, 0, 'Nihil Target', 0, 'Tidak Realisasi'),
(32, '001', 's-001', 'ss-004', 'L.9.1.3.J.', 2022, 'Operasionalisasi Sekreatariat Jemaat sebagai Pusat Data dan Informasi Bencana', 'Terbentuknya POSKO Pusat Data dan Informasi di tingkat Jemaat dengan memanfaatkan Sekertariat Kantor Jemaat pada Tahun 2022', 'Nihil Target', 'Nihil Target', 'Nihil Target', 'Nihil Target', 'Nihil Target', 0, 0, 0, 0, 0, 0, 'Nihil Target', 0, 'Tidak Realisasi'),
(33, '001', 's-001', 'ss-004', 'L.9.1.4.J.', 2022, 'Pengembangan Sistem Peringatan Dini Berbasis Jemaat', 'Tersediannya Aplikasi EWS Berbasi Jemaat', 'Nihil Target', 'Nihil Target', 'Nihil Target', 'Nihil Target', 'Nihil Target', 0, 0, 0, 0, 0, 0, 'Nihil Target', 0, 'Tidak Realisasi'),
(34, '001', 's-001', 'ss-004', 'L.9.1.6.J.', 2022, 'Integrasi Manajemen Resiko Bencana dalam bentuk yang sederhana ke dalam Materi Ajar SMTPI', 'Telaksananya Penyusunan Dokumen Pembelajaran tentang Manajemen Resiko Bencana dalam yang dapat di ajarkan kepada SMTPI', 'Nihil Target', 'Nihil Target', 'Nihil Target', 'Nihil Target', 'Nihil Target', 0, 0, 0, 0, 0, 0, 'Nihil Target', 0, 'Tidak Realisasi'),
(35, '001', 's-001', 'ss-004', 'L.9.1.9.J.', 2022, 'Bantuan Tanggap Darurat', 'Terlaksanaya pemberian bantuan tanggap darurat untuk penanganan bencana dan resikonya sesuai dengan  kondisi keuangan gereja di jemaat pada tahun 2022', 'Sesuai Target', 'Lebih Target', 'Sesuai Target', 'Sesuai Target', 'Lebih Target', 2, 3, 2, 2, 3, 120, 'Lebih Target', 3, 'Realisasi'),
(36, '001', 's-001', 'ss-004', 'L.9.1.10.J.', 2022, 'Pemetaan Lokasi Rawan Bencana Berbasis Digital', 'Tersedianya Peta Tematik Risiko Rawan Benca Jemaat dalam Format Digital maupun Shapefail', 'Nihil Target', 'Nihil Target', 'Nihil Target', 'Nihil Target', 'Nihil Target', 0, 0, 0, 0, 0, 0, 'Nihil Target', 0, 'Tidak Realisasi');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_login` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` int NOT NULL DEFAULT '1',
  `active` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `nama`, `username`, `password`, `level`, `active`) VALUES
(1, 'Victor Eric', 'victor', 'ffc150a160d37e92012c196b6af4160d', 1, 'Y'),
(2, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `seksi`
--

CREATE TABLE `seksi` (
  `id_seksi` int NOT NULL,
  `kd_seksi` varchar(10) NOT NULL,
  `kd_jemaat` varchar(10) NOT NULL,
  `nama_seksi` varchar(50) NOT NULL,
  `ketua` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `seksi`
--

INSERT INTO `seksi` (`id_seksi`, `kd_seksi`, `kd_jemaat`, `nama_seksi`, `ketua`) VALUES
(6, 's-001', '001', 'POS', 'Bapak'),
(7, 's-002', '001', 'PIPK', 'Ibu'),
(8, 's-003', '001', 'PPK', 'Bapak'),
(9, 's-004', '001', 'PTPU', 'Ibu');

-- --------------------------------------------------------

--
-- Table structure for table `subseksi`
--

CREATE TABLE `subseksi` (
  `id_subseksi` int NOT NULL,
  `kd_subseksi` varchar(10) NOT NULL,
  `kd_jemaat` varchar(10) NOT NULL,
  `kd_seksi` varchar(10) NOT NULL,
  `nama_subseksi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ketua_subseksi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subseksi`
--

INSERT INTO `subseksi` (`id_subseksi`, `kd_subseksi`, `kd_jemaat`, `kd_seksi`, `nama_subseksi`, `ketua_subseksi`) VALUES
(7, 'ss-001', '001', 's-001', 'Pembinaan Kerjasama Lintas Denomasi', 'Bapak'),
(8, 'ss-002', '001', 's-001', 'Pembinaan Kerjasama Antar Agama dan Aliran Kepercayaan', 'Ibu'),
(9, 'ss-003', '001', 's-001', 'Lingkungan Hidup dan Keutuhan Ciptaan', 'Bapak'),
(10, 'ss-004', '001', 's-001', 'Bencana Alam dan Sosial', 'Ibu'),
(11, 'ss-005', '001', 's-002', 'Pemberitaan  Injil', 'Bapak');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jemaat`
--
ALTER TABLE `jemaat`
  ADD PRIMARY KEY (`id_jemaat`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `seksi`
--
ALTER TABLE `seksi`
  ADD PRIMARY KEY (`id_seksi`);

--
-- Indexes for table `subseksi`
--
ALTER TABLE `subseksi`
  ADD PRIMARY KEY (`id_subseksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jemaat`
--
ALTER TABLE `jemaat`
  MODIFY `id_jemaat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id_kegiatan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `seksi`
--
ALTER TABLE `seksi`
  MODIFY `id_seksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `subseksi`
--
ALTER TABLE `subseksi`
  MODIFY `id_subseksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

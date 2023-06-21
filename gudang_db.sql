-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 21, 2023 at 02:26 PM
-- Server version: 8.0.32
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gudang_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `kode_kategori` varchar(10) NOT NULL,
  `kode_merek` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `detail_barang` varchar(150) NOT NULL,
  `stok_awal` int NOT NULL,
  `id_satuan_barang` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode_barang`, `nama_barang`, `kode_kategori`, `kode_merek`, `detail_barang`, `stok_awal`, `id_satuan_barang`) VALUES
('B-001', 'Kertas A4', 'K001', 'M-003', 'Kertas 80 gram putih', 0, 3),
('B-002', 'Kertas F4 70 gram', 'K001', 'M-003', '-', 0, 3),
('B-003', 'Kertas F4 80 gram', 'K001', 'M-003', '-', 0, 3),
('B-004', 'Tinta Printer Epson 003 Hitam', 'K001', 'M-002', 'Tinta hitam', 0, 5),
('B-005', 'Tinta Printer Epson 003 Merah', 'K001', 'M-002', '-', 0, 5),
('B-006', 'Tinta Printer Epson 003 Kuning', 'K001', 'M-002', '-', 0, 5),
('B-007', 'Tinta Printer Epson 003 Biru', 'K001', 'M-002', '-', 0, 5),
('B-008', 'Tinta Printer Epson 664 Hitam', 'K001', 'M-002', '-', 0, 5),
('B-009', 'Tinta Printer Epson 664 Kuning', 'K001', 'M-002', '-', 0, 5),
('B-010', 'Tinta Printer Epson 664 Merah', 'K001', 'M-002', '-', 0, 5),
('B-011', 'Tinta Printer Epson 664 Biru', 'K001', 'M-002', '-', 0, 5),
('B-012', 'Pena Baliner Hitam', 'K001', 'M-004', '-', 0, 4),
('B-013', 'Pena Joyco', 'K001', 'M-005', '-', 0, 4),
('B-014', 'Pena Pilot', 'K001', 'M-006', '-', 0, 4),
('B-015', 'Map File Bantex', 'K001', 'M-007', '-', 0, 1),
('B-016', 'Amplop Paperline', 'K001', 'M-008', '-', 0, 4),
('B-017', 'Tissu \"PASEO\"', 'K001', 'M-009', '-', 0, 12),
('B-018', 'Sabun Sunlight Botol', 'K001', 'M-010', '-', 0, 5),
('KB-909', 'Amplop Pipeline seeding', 'K001', 'M-003', 'baru ', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_bk` int NOT NULL,
  `nomor_surat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `tanggal_bk` date NOT NULL,
  `jumlah` int NOT NULL,
  `id_satuan_barang` int NOT NULL,
  `tujuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_bk`, `nomor_surat`, `kode_barang`, `tanggal_bk`, `jumlah`, `id_satuan_barang`, `tujuan`) VALUES
(1, '101/BK/UN.13.4.3.1/2023', 'B-001', '2023-01-30', 6, 3, 'Kaprodi Mesin'),
(2, '101/BK/UN.13.4.3.1/2023', 'B-002', '2023-01-30', 4, 3, 'Kemahasiswaan & Alumni'),
(7, '198/2023', 'B-004', '2023-02-04', 7, 5, 'Dekan'),
(8, '223', 'B-013', '2023-02-02', 2, 4, 'dekan'),
(9, '2343', 'B-013', '2022-12-15', 3, 4, 'WD2'),
(11, 'qe23123', 'B-002', '2023-02-02', 4, 3, 'Dekan'),
(12, '556', 'B-003', '2022-12-15', 2, 3, 'Dekan'),
(13, '84594/Un.454/2023', 'B-016', '2023-01-20', 3, 4, 'Latuhorte Wattimury');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_bm` int NOT NULL,
  `nomor_nota` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `tanggal_bm` date NOT NULL,
  `jumlah` int NOT NULL,
  `id_satuan_barang` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_bm`, `nomor_nota`, `kode_barang`, `tanggal_bm`, `jumlah`, `id_satuan_barang`) VALUES
(12, '99/blj/2023', 'B-002', '2023-01-05', 20, 3),
(13, '99/blj/2023', 'B-003', '2023-01-05', 15, 3),
(14, '99/blj/2023', 'B-004', '2023-01-05', 14, 5),
(15, '99/blj/2023', 'B-005', '2023-01-05', 10, 5),
(16, '99/blj/2023', 'B-006', '2023-01-05', 5, 5),
(17, '99/blj/2023', 'B-007', '2023-01-05', 5, 5),
(18, '99/blj/2023', 'B-008', '2023-01-05', 8, 5),
(19, '99/blj/2023', 'B-009', '2023-01-05', 8, 5),
(20, '99/blj/2023', 'B-011', '2023-01-05', 5, 5),
(23, '34/tt/2023', 'B-013', '2023-01-05', 20, 4),
(24, '45/lo/2023', 'B-013', '2023-01-20', 5, 4),
(27, '322', 'B-004', '2023-02-01', 2, 5),
(28, '4343', 'B-001', '2023-02-02', 5, 3),
(29, '5235', 'B-001', '2023-01-10', 7, 3),
(30, '546345', 'B-002', '2023-01-01', 5, 3),
(31, '1223', 'B-003', '2022-12-12', 10, 3),
(32, '12121', 'B-015', '2023-02-02', 100, 1),
(33, '1239/2022', 'B-013', '2022-12-12', 8, 4),
(35, '756/Ki/2023', 'B-016', '2023-01-10', 12, 4);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `kode_jenis` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kode_kategori` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `merek` varchar(50) NOT NULL,
  `tipe` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`kode_jenis`, `kode_kategori`, `jenis`, `merek`, `tipe`, `keterangan`) VALUES
('A-0034', 'K001', 'Keranjang', 'Premium', 'besar 45j', ''),
('J-002', 'K001 ', 'Kertas', ' Sinar Dunia', 'A4 80 gram', 'kertas putih'),
('J786', 'K123124354', 'Lampu Belajar', 'orion', '99i0', 'baru'),
('K004', 'K001 ', 'tes', 'tes', 'tes', 'tes');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kode_kategori` varchar(10) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kode_kategori`, `nama_kategori`) VALUES
('K001', 'Bahan habis pakai'),
('K002', 'Tanah'),
('K003', 'Peralatan dan Mesin'),
('K004', 'Gedung dan Bangunan');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_login` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` int NOT NULL DEFAULT '2',
  `active` char(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `nama`, `username`, `password`, `level`, `active`) VALUES
(1, 'victor', 'victor', 'ffc150a160d37e92012c196b6af4160d', 1, 'Y'),
(2, 'admin Fatek', 'admin', '0192023a7bbd73250516f069df18b500', 1, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `merek`
--

CREATE TABLE `merek` (
  `kode_merek` varchar(10) NOT NULL,
  `nama_merek` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `merek`
--

INSERT INTO `merek` (`kode_merek`, `nama_merek`) VALUES
('M-001', 'Canon'),
('M-002', 'Epson'),
('M-003', 'Sinar dunia'),
('M-004', 'Balliner'),
('M-005', 'Joyco'),
('M-006', 'Pilot'),
('M-007', 'Bantex'),
('M-008', 'Paperline'),
('M-009', 'PASEO'),
('M-010', 'Sunlight');

-- --------------------------------------------------------

--
-- Table structure for table `satuan_barang`
--

CREATE TABLE `satuan_barang` (
  `id_satuan` int NOT NULL,
  `nama_satuan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `satuan_barang`
--

INSERT INTO `satuan_barang` (`id_satuan`, `nama_satuan`) VALUES
(1, 'Buah'),
(2, 'Pack'),
(3, 'Rim'),
(4, 'Dos'),
(5, 'Botol'),
(6, 'Buku'),
(7, 'Lusin'),
(8, 'Kaleng'),
(9, 'Pasang'),
(12, 'Bungkus'),
(13, 'Roll');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_bk`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_bm`);

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`kode_jenis`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kode_kategori`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `merek`
--
ALTER TABLE `merek`
  ADD PRIMARY KEY (`kode_merek`);

--
-- Indexes for table `satuan_barang`
--
ALTER TABLE `satuan_barang`
  ADD PRIMARY KEY (`id_satuan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_bk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_bm` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `satuan_barang`
--
ALTER TABLE `satuan_barang`
  MODIFY `id_satuan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

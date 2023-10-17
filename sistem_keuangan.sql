-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2021 at 08:19 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_keuangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses_login`
--

CREATE TABLE `akses_login` (
  `id_akses` varchar(30) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `hak_akses` varchar(20) DEFAULT NULL,
  `status_aktif` varchar(10) DEFAULT NULL,
  `terakhir_online` datetime DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akses_login`
--

INSERT INTO `akses_login` (`id_akses`, `email`, `pass`, `hak_akses`, `status_aktif`, `terakhir_online`, `create_at`, `update_at`) VALUES
('akses131220210005', 'lisa@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'karyawan', NULL, NULL, '2021-12-13 09:30:17', NULL),
('akses181120210001', 'b@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'pemilik_toko', 'online', '2021-11-17 01:00:42', '2021-11-17 01:00:42', '2021-11-22 17:10:31'),
('akses181120210002', 'elvano@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'karyawan', NULL, NULL, '2021-11-18 22:01:21', '2021-12-13 09:28:09'),
('akses181120210003', 'agus@gmail.com', '5c3afb2f221f060be601709ebbe4a12c', 'karyawan', NULL, NULL, '2021-11-18 22:19:44', '2021-11-19 15:14:48'),
('akses231120210004', 'firman@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'karyawan', NULL, NULL, '2021-11-23 08:26:02', '2021-12-13 09:28:48');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(30) NOT NULL,
  `id_pengeluaran` varchar(30) DEFAULT NULL,
  `jenis_kain` varchar(50) DEFAULT NULL,
  `seri_kain` varchar(30) DEFAULT NULL,
  `warna_kain` varchar(20) DEFAULT NULL,
  `harga_beli` int(11) DEFAULT NULL,
  `harga_grosir` int(11) DEFAULT NULL,
  `harga_satuan` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `total_berat` int(11) DEFAULT NULL,
  `ket` text DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `id_pengeluaran`, `jenis_kain`, `seri_kain`, `warna_kain`, `harga_beli`, `harga_grosir`, `harga_satuan`, `stok`, `total_berat`, `ket`, `create_at`, `update_at`) VALUES
('brg231220210001', NULL, 'Cotton Combed', '30s', 'Merah', 900000, 800000, 980000, 2, 50, 'Combed 30s', '2021-12-15 13:27:33', '2021-12-23 19:46:59'),
('brg231220210002', NULL, 'Cotton Bamboo', '30s', 'Merah', 4500000, 90000, 98000, 2, 50, 'Cotton Combed 30s 2 roll\r\n', '2021-12-23 18:45:58', '2021-12-23 19:46:33');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` varchar(30) NOT NULL,
  `id_akses_login` varchar(30) DEFAULT NULL,
  `nama_karyawan` varchar(50) DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `jabatan` varchar(17) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_tlp` varchar(14) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `gaji` int(11) DEFAULT NULL,
  `status_gaji` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `id_akses_login`, `nama_karyawan`, `foto`, `jabatan`, `alamat`, `no_tlp`, `email`, `pass`, `gaji`, `status_gaji`, `created_at`, `update_at`) VALUES
('kar131220210004', 'akses131220210005', 'Kholisah Lustinasari', NULL, 'Kasir', 'Bandung, Jawa barat', '02131414141', 'lisa@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 500000, 'Belum', '2021-12-13 09:30:17', NULL),
('kar181120210001', 'akses181120210002', 'Aan Andrian K', NULL, 'Customer Service', 'Bandung', '081384233919', 'aan@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 2500000, 'Selesai', '2021-11-18 22:01:21', '2021-12-13 09:28:09'),
('kar181120210002', 'akses181120210003', 'Agus Sudaryono', NULL, 'Supir', 'bekasi', '081384233919', 'agus@gmail.com', '5c3afb2f221f060be601709ebbe4a12c', 2500000, 'Belum', '2021-11-18 22:19:44', '2021-11-19 15:14:48'),
('kar231120210003', 'akses231120210004', 'Firmansyah', NULL, 'Kasir', 'Bekasi Utara', '084112815005', 'lisa@gmail.com', '5c3afb2f221f060be601709ebbe4a12c', 550000, 'Belum', '2021-11-23 08:26:02', '2021-12-13 09:28:48');

-- --------------------------------------------------------

--
-- Table structure for table `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id_pemasukan` varchar(30) NOT NULL,
  `id_karyawan` varchar(30) NOT NULL,
  `id_transaksi` varchar(30) NOT NULL,
  `id` varchar(30) NOT NULL,
  `jenis_pemasukan` varchar(20) DEFAULT NULL,
  `jumlah_pemasukan` int(11) DEFAULT NULL,
  `ket` text DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemasukan`
--

INSERT INTO `pemasukan` (`id_pemasukan`, `id_karyawan`, `id_transaksi`, `id`, `jenis_pemasukan`, `jumlah_pemasukan`, `ket`, `create_at`, `update_at`) VALUES
('msk131220210001', 'kar131220210004', 'trn131220210001', 'pem181120210001', 'Pembelian', 25000000, 'cotton combed 30 s', '2021-11-17 01:00:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pemilik_toko`
--

CREATE TABLE `pemilik_toko` (
  `id` varchar(30) NOT NULL,
  `id_akses_login` varchar(30) DEFAULT NULL,
  `nama_pemilik` varchar(60) DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `no_tlp` varchar(14) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemilik_toko`
--

INSERT INTO `pemilik_toko` (`id`, `id_akses_login`, `nama_pemilik`, `foto`, `no_tlp`, `email`, `pass`, `create_at`, `update_at`) VALUES
('pem181120210001', 'akses181120210001', 'Anyar', NULL, '081384233222', 'b@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2021-11-22 14:09:39', '2021-11-22 17:10:31');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` varchar(30) NOT NULL,
  `id_karyawan` varchar(30) DEFAULT NULL,
  `id` varchar(30) DEFAULT NULL,
  `jenis_pengeluaran` varchar(20) DEFAULT NULL,
  `biaya_pengeluaran` int(11) DEFAULT NULL,
  `ket` text DEFAULT NULL,
  `bukti_foto` text DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `id_karyawan`, `id`, `jenis_pengeluaran`, `biaya_pengeluaran`, `ket`, `bukti_foto`, `status`, `created_at`, `update_at`) VALUES
('PENG070720210002', 'kar131220210004', 'pem181120210001', 'barang', 800000, 'timbangan', '1512105802matrix-60-x-50-pagar.jpg', 'confirm', '2021-12-08 18:03:12', '2021-12-15 10:58:02'),
('PENG070720210003', 'kar131220210004', 'pem181120210001', 'pembayaran', 100000, 'bayar bensin', '1512105956struk.jpg', 'confirm', '2021-12-07 18:00:14', '2021-12-15 10:59:56'),
('PENG141220210001', NULL, 'pem181120210001', 'gaji karyawan', 5000000, 'pembayaran gaji aan', '1412165604gambar.png', 'confirm', '2021-12-14 16:56:04', '2021-12-14 17:47:55'),
('PENG1412202110002', NULL, 'pem181120210001', 'pembayaran', 101600, 'pembayaran listrik toko', '1412165627sturk2-pln.png', 'confirm', '2021-12-14 16:56:27', '2021-12-14 17:47:45');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(30) NOT NULL,
  `id_barang` varchar(30) DEFAULT NULL,
  `id_karyawan` varchar(30) DEFAULT NULL,
  `nama_pelanggan` varchar(50) DEFAULT NULL,
  `detail_barang` text DEFAULT NULL,
  `jumlah_satuan` int(11) DEFAULT NULL,
  `total_jumlah` int(11) DEFAULT NULL,
  `signature_pembeli` text DEFAULT NULL,
  `signature_penjual` text DEFAULT NULL,
  `foto_transaksi` text DEFAULT NULL,
  `total_harga` bigint(20) DEFAULT NULL,
  `kembalian` bigint(20) DEFAULT NULL,
  `laba bersih` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_barang`, `id_karyawan`, `nama_pelanggan`, `detail_barang`, `jumlah_satuan`, `total_jumlah`, `signature_pembeli`, `signature_penjual`, `foto_transaksi`, `total_harga`, `kembalian`, `laba bersih`, `create_at`, `update_at`) VALUES
('trn131220210001', 'brg231220210002', 'kar131220210004', 'Joko', 'Cotton Combed, 2 roll', 1, 1, NULL, NULL, NULL, 25000000, 0, 500000, '2021-12-24 23:57:19', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses_login`
--
ALTER TABLE `akses_login`
  ADD PRIMARY KEY (`id_akses`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_pengeluaran` (`id_pengeluaran`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `id_akses_login` (`id_akses_login`);

--
-- Indexes for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id_pemasukan`),
  ADD KEY `id_karyawan` (`id_karyawan`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `pemilik_toko`
--
ALTER TABLE `pemilik_toko`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_akses_login` (`id_akses_login`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `id_karyawan` (`id_karyawan`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_barang` (`id_barang`) USING BTREE,
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_pengeluaran`) REFERENCES `pengeluaran` (`id_pengeluaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`id_akses_login`) REFERENCES `akses_login` (`id_akses`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD CONSTRAINT `pemasukan_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemasukan_ibfk_2` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemasukan_ibfk_3` FOREIGN KEY (`id`) REFERENCES `pemilik_toko` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemilik_toko`
--
ALTER TABLE `pemilik_toko`
  ADD CONSTRAINT `pemilik_toko_ibfk_1` FOREIGN KEY (`id_akses_login`) REFERENCES `akses_login` (`id_akses`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `pengeluaran_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengeluaran_ibfk_2` FOREIGN KEY (`id`) REFERENCES `pemilik_toko` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

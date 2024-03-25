-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2024 at 06:41 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sales`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(5) UNSIGNED NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `created_at`, `updated_at`) VALUES
(4, '002', 'Miranda', 8000, '2024-03-23 07:13:57', '2024-03-23 07:56:05'),
(5, '003', 'Herborist', 9500, '2024-03-23 07:55:51', '2024-03-23 07:55:51');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(2, '2024-03-23-013443', 'App\\Database\\Migrations\\AddOutlet', 'default', 'App', 1711179142, 1),
(3, '2024-03-23-132038', 'App\\Database\\Migrations\\AddBarang', 'default', 'App', 1711200583, 2),
(4, '2024-03-23-155336', 'App\\Database\\Migrations\\AddPenjualan', 'default', 'App', 1711210256, 3),
(5, '2024-03-23-160720', 'App\\Database\\Migrations\\AddDetailPenjualan', 'default', 'App', 1711210256, 3);

-- --------------------------------------------------------

--
-- Table structure for table `outlet`
--

CREATE TABLE `outlet` (
  `id` int(5) UNSIGNED NOT NULL,
  `kode_outlet` varchar(10) NOT NULL,
  `nama_outlet` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `pic` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `outlet`
--

INSERT INTO `outlet` (`id`, `kode_outlet`, `nama_outlet`, `alamat`, `pic`, `created_at`, `updated_at`) VALUES
(3, 'TKO-002', 'Hero', 'Ciledug', 'Rahmat', '2024-03-23 02:46:27', '2024-03-23 02:46:27'),
(4, 'TKO-003', 'Hari-hari', 'Bintaro', 'Gustavo', '2024-03-23 02:47:08', '2024-03-23 07:53:57'),
(5, 'TKO-004', 'Giant Express', 'Meruya', 'Felixs', '2024-03-23 03:17:35', '2024-03-23 03:17:56');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `id` int(5) UNSIGNED NOT NULL,
  `no_faktur` varchar(15) NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `qty` int(10) UNSIGNED NOT NULL,
  `harga` int(10) UNSIGNED NOT NULL,
  `sub_total` int(10) UNSIGNED NOT NULL,
  `created_user` varchar(50) NOT NULL DEFAULT 'admin',
  `edit_user` varchar(50) NOT NULL DEFAULT 'admin',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `penjualan_detail`
--

INSERT INTO `penjualan_detail` (`id`, `no_faktur`, `kode_barang`, `qty`, `harga`, `sub_total`, `created_user`, `edit_user`, `created_at`, `updated_at`) VALUES
(18, 'FAK-202403-001', '002', 1, 8000, 8000, 'admin', 'admin', '2024-03-25 05:31:27', '2024-03-25 05:31:27'),
(19, 'FAK-202403-001', '003', 1, 9500, 9500, 'admin', 'admin', '2024-03-25 05:31:27', '2024-03-25 05:31:27'),
(20, 'FAK-202403-002', '002', 10, 8000, 80000, 'admin', 'admin', '2024-03-25 05:31:56', '2024-03-25 05:31:56');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_header`
--

CREATE TABLE `penjualan_header` (
  `id` int(5) UNSIGNED NOT NULL,
  `no_faktur` varchar(15) NOT NULL,
  `tanggal_faktur` date NOT NULL,
  `kode_outlet` varchar(15) NOT NULL,
  `amount` int(10) UNSIGNED NOT NULL,
  `discount` int(10) UNSIGNED NOT NULL,
  `ppn` int(10) UNSIGNED NOT NULL,
  `total_amount` int(10) UNSIGNED NOT NULL,
  `created_user` varchar(50) NOT NULL DEFAULT 'admin',
  `edit_user` varchar(50) NOT NULL DEFAULT 'admin',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `penjualan_header`
--

INSERT INTO `penjualan_header` (`id`, `no_faktur`, `tanggal_faktur`, `kode_outlet`, `amount`, `discount`, `ppn`, `total_amount`, `created_user`, `edit_user`, `created_at`, `updated_at`) VALUES
(11, 'FAK-202403-001', '2024-03-25', 'TKO-002', 17500, 0, 1750, 17250, 'admin', 'admin', '2024-03-24 22:31:27', '2024-03-24 22:31:27'),
(12, 'FAK-202403-002', '2024-03-25', 'TKO-004', 80000, 0, 8000, 78000, 'admin', 'admin', '2024-03-24 22:31:56', '2024-03-24 22:31:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_barang` (`kode_barang`),
  ADD UNIQUE KEY `nama_barang` (`nama_barang`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outlet`
--
ALTER TABLE `outlet`
  ADD UNIQUE KEY `kode_outlet` (`kode_outlet`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `penjualan_header`
--
ALTER TABLE `penjualan_header`
  ADD UNIQUE KEY `no_faktur` (`no_faktur`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `outlet`
--
ALTER TABLE `outlet`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `penjualan_header`
--
ALTER TABLE `penjualan_header`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

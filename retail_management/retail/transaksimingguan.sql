-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2025 at 01:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `retail`
--

-- --------------------------------------------------------

--
-- Table structure for table `transaksimingguan`
--

CREATE TABLE `transaksimingguan` (
  `id` int(11) NOT NULL,
  `total_pendapatanperminggu` bigint(20) NOT NULL DEFAULT 0,
  `total_transaksiperminggu` int(11) NOT NULL DEFAULT 0,
  `total_produk_terjual` int(11) NOT NULL,
  `periode` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksimingguan`
--

INSERT INTO `transaksimingguan` (`id`, `total_pendapatanperminggu`, `total_transaksiperminggu`, `total_produk_terjual`, `periode`, `created_at`) VALUES
(1, 5200500000, 4927, 8932, '0000-00-00', '2025-09-29 11:31:37'),
(2, 5341160000, 3832, 6253, '0000-00-00', '2025-10-06 11:43:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transaksimingguan`
--
ALTER TABLE `transaksimingguan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaksimingguan`
--
ALTER TABLE `transaksimingguan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

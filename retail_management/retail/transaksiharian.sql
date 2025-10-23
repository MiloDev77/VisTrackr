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
-- Table structure for table `transaksiharian`
--

CREATE TABLE `transaksiharian` (
  `id` int(11) NOT NULL,
  `total_pendapatanperhari` bigint(20) NOT NULL DEFAULT 0,
  `total_transaksiperhari` int(11) NOT NULL DEFAULT 0,
  `total_produk_terjual` int(11) NOT NULL,
  `waktu` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksiharian`
--

INSERT INTO `transaksiharian` (`id`, `total_pendapatanperhari`, `total_transaksiperhari`, `total_produk_terjual`, `waktu`, `created_at`) VALUES
(1, 231400000, 243, 493, '0000-00-00', '2025-10-06 11:25:41'),
(2, 412000000, 231, 512, '0000-00-00', '2025-10-07 11:25:41'),
(3, 720120000, 525, 823, '0000-00-00', '2025-10-08 11:25:41'),
(4, 182020000, 211, 200, '0000-00-00', '2025-10-09 11:25:41'),
(5, 901000000, 629, 983, '0000-00-00', '2025-10-10 11:25:41'),
(6, 2000100000, 1201, 1845, '0000-00-00', '2025-10-11 11:25:41'),
(8, 900000000, 864, 1294, '2025-10-12', '2025-10-12 09:50:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transaksiharian`
--
ALTER TABLE `transaksiharian`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaksiharian`
--
ALTER TABLE `transaksiharian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

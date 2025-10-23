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
-- Table structure for table `transaksihariini`
--

CREATE TABLE `transaksihariini` (
  `id` int(11) NOT NULL,
  `pendapatan` bigint(20) NOT NULL,
  `total_produk_terjual` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksihariini`
--

INSERT INTO `transaksihariini` (`id`, `pendapatan`, `total_produk_terjual`, `tanggal`, `created_at`) VALUES
(10, 296800000, 14, '2025-10-15', '2025-10-15 14:59:35'),
(11, 184000000, 8, '2025-10-15', '2025-10-15 14:59:44'),
(14, 192000000, 8, '2025-10-16', '2025-10-16 02:56:55'),
(15, 91800000, 6, '2025-10-16', '2025-10-16 08:21:22'),
(16, 160000000, 10, '2025-10-16', '2025-10-16 08:21:36'),
(17, 210000000, 20, '2025-10-16', '2025-10-16 08:59:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transaksihariini`
--
ALTER TABLE `transaksihariini`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaksihariini`
--
ALTER TABLE `transaksihariini`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

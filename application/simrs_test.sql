-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 21, 2026 at 05:01 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simrs_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `spesialis` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id`, `nama`, `spesialis`, `no_hp`, `created_at`) VALUES
(1, 'Dr. Ahmad', 'Penyakit Dalam', '081211111111', '2026-05-21 04:02:50'),
(2, 'Dr. Rina', 'Anak', '081222222222', '2026-05-21 04:02:50'),
(9, 'Dr. anas', 'THT', '3217312', '2026-05-21 07:12:03'),
(10, 'Dokter 1', 'mata', '039829823912', '2026-05-21 07:29:58');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id` int NOT NULL,
  `nama_obat` varchar(100) DEFAULT NULL,
  `stok` int DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `stok`, `harga`, `created_at`) VALUES
(1, 'Paracetamol', 100, '5000.00', '2026-05-21 04:03:01'),
(2, 'Amoxicillin', 50, '12000.00', '2026-05-21 04:03:01'),
(3, 'Vitamin C kompleks', 100, '3000.00', '2026-05-21 04:03:01'),
(9, 'Vitamin D', 12, '20000.00', '2026-05-21 07:12:40'),
(10, 'Paramex', 12, '20000.00', '2026-05-21 07:26:00'),
(11, 'Bodrek', 20, '12000.00', '2026-05-21 07:26:12');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text,
  `no_hp` varchar(20) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `nama`, `alamat`, `no_hp`, `tanggal_lahir`, `created_at`) VALUES
(1, 'Budi Santoso', 'Sleman', '081234567890', '1999-05-10', '2026-05-21 04:02:16'),
(2, 'Siti Aminah ha', 'Bantul progo', '081298765432', '2000-08-21', '2026-05-21 04:02:16'),
(4, 'Rinta', 'jombang', '123891239812', '2026-05-19', '2026-05-21 04:48:03'),
(7, 'Ridwan', 'magelang', '293821831', '2026-05-27', '2026-05-21 06:46:58'),
(9, 'kopa', 'sleman', '42184932', '2026-04-29', '2026-05-21 07:11:40'),
(10, 'pasien 5', 'Bantul', '947897321', '2026-05-30', '2026-05-21 07:24:57');

-- --------------------------------------------------------

--
-- Table structure for table `resep`
--

CREATE TABLE `resep` (
  `id` int NOT NULL,
  `pasien_id` int DEFAULT NULL,
  `dokter_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `resep`
--

INSERT INTO `resep` (`id`, `pasien_id`, `dokter_id`, `user_id`, `tanggal`, `total`) VALUES
(1, 1, 1, 1, '2026-05-21', '40000.00'),
(4, 2, 1, 1, '2024-12-12', '56000.00'),
(10, 7, 2, 9, '2026-05-22', '38000.00'),
(11, 2, 1, 1, '2026-05-21', '152000.00'),
(12, 9, 9, 1, '2026-05-21', '52000.00'),
(13, 10, 9, 1, '2026-05-21', '76000.00');

-- --------------------------------------------------------

--
-- Table structure for table `resep_detail`
--

CREATE TABLE `resep_detail` (
  `id` int NOT NULL,
  `resep_id` int DEFAULT NULL,
  `obat_id` int DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `resep_detail`
--

INSERT INTO `resep_detail` (`id`, `resep_id`, `obat_id`, `qty`, `harga`, `subtotal`) VALUES
(23, 1, 1, 2, '5000.00', '10000.00'),
(24, 1, 3, 10, '3000.00', '30000.00'),
(34, 10, 3, 1, '3000.00', '3000.00'),
(35, 10, 1, 5, '5000.00', '25000.00'),
(36, 10, 1, 2, '5000.00', '10000.00'),
(37, 11, 1, 1, '5000.00', '5000.00'),
(38, 11, 3, 1, '3000.00', '3000.00'),
(39, 11, 2, 12, '12000.00', '144000.00'),
(40, 12, 9, 2, '20000.00', '40000.00'),
(41, 12, 2, 1, '12000.00', '12000.00'),
(42, 13, 10, 2, '20000.00', '40000.00'),
(43, 13, 11, 3, '12000.00', '36000.00'),
(44, 4, 1, 10, '5000.00', '50000.00'),
(45, 4, 3, 2, '3000.00', '6000.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'Shevabey Rahman', 'shevabey', '$2y$10$QSyqGR0P7ftOX3/XpfNBFOLvjLExptukj6xvgVRqOF/PhIZ2NJWtu', 'admin', '2026-05-21 03:31:38'),
(2, 'Administrator', 'admin', '0192023a7bbd73250516f069df18b500', 'admin', '2026-05-21 04:01:41'),
(3, 'Kasir', 'kasir', 'de28f8f7998f23ab4194b51a6029416f', 'kasir', '2026-05-21 04:01:41'),
(7, 'Patria Handung Jaya', 'patria', '$2y$10$5yP33XUphXsyyd5L9QP0eufEipsb.f1lSUE.u13wqIFoBB86sDCsK', 'admin', '2026-05-21 06:28:52'),
(9, 'orang kasir', 'kasiran', '202cb962ac59075b964b07152d234b70', 'kasir', '2026-05-21 06:44:48'),
(11, 'Dava ranta', 'Dava', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2026-05-21 07:24:16'),
(12, 'Dali', 'dali', '81dc9bdb52d04dc20036dbd8313ed055', 'kasir', '2026-05-21 07:24:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pasien_id` (`pasien_id`),
  ADD KEY `dokter_id` (`dokter_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `resep_detail`
--
ALTER TABLE `resep_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resep_id` (`resep_id`),
  ADD KEY `obat_id` (`obat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `resep`
--
ALTER TABLE `resep`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `resep_detail`
--
ALTER TABLE `resep_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `resep`
--
ALTER TABLE `resep`
  ADD CONSTRAINT `resep_ibfk_1` FOREIGN KEY (`pasien_id`) REFERENCES `pasien` (`id`),
  ADD CONSTRAINT `resep_ibfk_2` FOREIGN KEY (`dokter_id`) REFERENCES `dokter` (`id`),
  ADD CONSTRAINT `resep_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `resep_detail`
--
ALTER TABLE `resep_detail`
  ADD CONSTRAINT `resep_detail_ibfk_1` FOREIGN KEY (`resep_id`) REFERENCES `resep` (`id`),
  ADD CONSTRAINT `resep_detail_ibfk_2` FOREIGN KEY (`obat_id`) REFERENCES `obat` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

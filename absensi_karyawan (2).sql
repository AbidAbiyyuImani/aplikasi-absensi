-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 12, 2024 at 08:41 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi_karyawan`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int NOT NULL,
  `user_id` int NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_keluar` time DEFAULT NULL,
  `foto_absen` text NOT NULL,
  `foto_absen_keluar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `tanggal_absensi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `user_id`, `jam_masuk`, `jam_keluar`, `foto_absen`, `foto_absen_keluar`, `tanggal_absensi`) VALUES
(3, 3, '14:17:45', '14:41:04', '675a8e190d2b9.jpg', '675a939092248.jpg', '2024-12-12');

-- --------------------------------------------------------

--
-- Table structure for table `absensi_cuti`
--

CREATE TABLE `absensi_cuti` (
  `id_cuti` int NOT NULL,
  `user_id` int NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal_permohonan` date NOT NULL,
  `status_permohonan` enum('Menunggu Persetujuan','Disetujui','Ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `absensi_cuti`
--

INSERT INTO `absensi_cuti` (`id_cuti`, `user_id`, `keterangan`, `tanggal_permohonan`, `status_permohonan`) VALUES
(6, 3, 'Acara Keluarga Besar', '2024-12-12', 'Disetujui');

-- --------------------------------------------------------

--
-- Table structure for table `absensi_sakit`
--

CREATE TABLE `absensi_sakit` (
  `id_sakit` int NOT NULL,
  `user_id` int NOT NULL,
  `surat_sakit` text NOT NULL,
  `tanggal_permohonan` date NOT NULL,
  `status_permohonan` enum('Menunggu Persetujuan','Disetujui','Ditolak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `absensi_sakit`
--

INSERT INTO `absensi_sakit` (`id_sakit`, `user_id`, `surat_sakit`, `tanggal_permohonan`, `status_permohonan`) VALUES
(2, 3, '675a935b98034.png', '2024-12-12', 'Ditolak'),
(3, 3, '675a94e39e453.png', '2024-12-12', 'Disetujui');

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int NOT NULL,
  `nama_divisi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`) VALUES
(1, 'IT Support');

-- --------------------------------------------------------

--
-- Table structure for table `jam_kerja`
--

CREATE TABLE `jam_kerja` (
  `id_jam` int NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_keluar` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jam_kerja`
--

INSERT INTO `jam_kerja` (`id_jam`, `jam_masuk`, `jam_keluar`) VALUES
(1, '07:00:00', '15:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `nama_lengkap` text NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `level` enum('Super Admin','Admin','User') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `divisi_id` int DEFAULT NULL,
  `jam_id` int DEFAULT NULL,
  `foto` text NOT NULL,
  `password` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_lengkap`, `username`, `email`, `level`, `divisi_id`, `jam_id`, `foto`, `password`, `created_at`) VALUES
(2, 'Abid Abiyyu Imani', 'abid', 'abid.abiyyu490@smk.belajar.id', 'Super Admin', NULL, NULL, '675a339441efb.jpg', '202cb962ac59075b964b07152d234b70', '2024-12-12 00:51:32'),
(3, 'Fariz Fathin Imani', 'fariz', 'fariz12klo@gmail.com', 'User', NULL, NULL, '675a3488f0452.jpg', '202cb962ac59075b964b07152d234b70', '2024-12-12 00:55:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `absensi_user` (`user_id`);

--
-- Indexes for table `absensi_cuti`
--
ALTER TABLE `absensi_cuti`
  ADD PRIMARY KEY (`id_cuti`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `absensi_sakit`
--
ALTER TABLE `absensi_sakit`
  ADD PRIMARY KEY (`id_sakit`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`),
  ADD UNIQUE KEY `unique_nama_divisi` (`nama_divisi`);

--
-- Indexes for table `jam_kerja`
--
ALTER TABLE `jam_kerja`
  ADD PRIMARY KEY (`id_jam`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `user_jam` (`jam_id`),
  ADD KEY `user_divisi` (`divisi_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `absensi_cuti`
--
ALTER TABLE `absensi_cuti`
  MODIFY `id_cuti` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `absensi_sakit`
--
ALTER TABLE `absensi_sakit`
  MODIFY `id_sakit` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jam_kerja`
--
ALTER TABLE `jam_kerja`
  MODIFY `id_jam` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `absensi_cuti`
--
ALTER TABLE `absensi_cuti`
  ADD CONSTRAINT `absensi_cuti_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `absensi_sakit`
--
ALTER TABLE `absensi_sakit`
  ADD CONSTRAINT `absensi_sakit_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_divisi` FOREIGN KEY (`divisi_id`) REFERENCES `divisi` (`id_divisi`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_jam` FOREIGN KEY (`jam_id`) REFERENCES `jam_kerja` (`id_jam`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

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
  `foto_absen_keluar` text,
  `tanggal_absensi` date NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `absensi_cuti`
--

-- CREATE TABLE `absensi_cuti` (
--   `id_absensi_cuti` int NOT NULL,
--   `user_id` int NOT NULL,
--   `keterangan` text NOT NULL,
--   `tanggal_permohonan` date NOT NULL,
--   `status_permohonan` enum('Menunggu','Diterima','Ditolak') DEFAULT NULL
-- );

-- --------------------------------------------------------

--
-- Table structure for table `absensi_sakit`
--

-- CREATE TABLE `absensi_sakit` (
--   `id_absensi_sakit` int NOT NULL,
--   `user_id` int NOT NULL,
--   `surat_sakit` text NOT NULL,
--   `tanggal_permohonan` date NOT NULL,
--   `status_permohonan` enum('Menunggu','Diterima','Ditolak') NOT NULL
-- );

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int NOT NULL,
  `nama_divisi` varchar(255) NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `jam_kerja`
--

CREATE TABLE `jam_kerja` (
  `id_jk` int NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_pulang` time NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `nama_lengkap` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `level` enum('Admin','Karyawan') NOT NULL,
  `divisi_id` int DEFAULT NULL,
  `jk_id` int DEFAULT NULL,
  `foto` text NOT NULL,
  `password` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

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
-- ALTER TABLE `absensi_cuti`
--   ADD PRIMARY KEY (`id_absensi_cuti`),
--   ADD KEY `absensi_cuti_user` (`user_id`);

--
-- Indexes for table `absensi_sakit`
--
-- ALTER TABLE `absensi_sakit`
--   ADD PRIMARY KEY (`id_absensi_sakit`),
--   ADD KEY `absensi_sakit_user` (`user_id`);

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
  ADD PRIMARY KEY (`id_jk`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `unique_username` (`username`),
  ADD KEY `user_divisi` (`divisi_id`),
  ADD KEY `user_jk` (`jk_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `absensi_cuti`
--
-- ALTER TABLE `absensi_cuti`
--   MODIFY `id_absensi_cuti` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `absensi_sakit`
--
-- ALTER TABLE `absensi_sakit`
--   MODIFY `id_absensi_sakit` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jam_kerja`
--
ALTER TABLE `jam_kerja`
  MODIFY `id_jk` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `absensi_cuti`
--
-- ALTER TABLE `absensi_cuti`
--   ADD CONSTRAINT `absensi_cuti_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `absensi_sakit`
--
-- ALTER TABLE `absensi_sakit`
--   ADD CONSTRAINT `absensi_sakit_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`divisi_id`) REFERENCES `divisi` (`id_divisi`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`jk_id`) REFERENCES `jam_kerja` (`id_jk`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;
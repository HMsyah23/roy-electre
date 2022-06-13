-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2022 at 06:19 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `electre_roy`
--

-- --------------------------------------------------------

--
-- Table structure for table `calon_paskibrakas`
--

CREATE TABLE `calon_paskibrakas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nisn` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_depan` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_belakang` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asal_sekolah` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_sekolah` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_calon_anggota` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tinggi_badan` int(3) NOT NULL,
  `berat_badan` int(3) NOT NULL,
  `surat_pernyataan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surat_pengantar_kepsek` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scan_nilai_rapor` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_kartu_pelajar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sttb_sltp` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `surat_izin_orang_tua` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bmi` float DEFAULT NULL,
  `lari` int(3) DEFAULT NULL,
  `push_up` int(3) DEFAULT NULL,
  `pull_up` int(3) DEFAULT NULL,
  `squat_jump` int(3) DEFAULT NULL,
  `sit_up` int(3) DEFAULT NULL,
  `skor_pelatihan_baris_berbaris` int(3) DEFAULT NULL,
  `kesehatan_mental` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `validasi` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `tes_fisik` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `calon_paskibrakas`
--

INSERT INTO `calon_paskibrakas` (`id`, `user_id`, `nisn`, `nama_depan`, `nama_belakang`, `no_hp`, `tanggal_lahir`, `email`, `asal_sekolah`, `alamat_sekolah`, `jenis_kelamin`, `alamat`, `foto_calon_anggota`, `tinggi_badan`, `berat_badan`, `surat_pernyataan`, `surat_pengantar_kepsek`, `scan_nilai_rapor`, `foto_kartu_pelajar`, `sttb_sltp`, `surat_izin_orang_tua`, `bmi`, `lari`, `push_up`, `pull_up`, `squat_jump`, `sit_up`, `skor_pelatihan_baris_berbaris`, `kesehatan_mental`, `validasi`, `tes_fisik`) VALUES
(3, 5, '192332532632', 'Yuzrul', 'Azhar', '081247356120', '2006-06-08', 'yuzrul@gmail.com', 'SMA Negeri 1 Sendawar', 'Jl. Pattimura No.RT 29, Melak Ulu, Kec. Melak, Kabupaten Kutai Barat, Kalimantan Timur 75775', '1', 'Jl. Jauh', 'KaHbzgKkSDJGWie4WolYKBYmByxMY2VIlII27Egm.jpg', 182, 70, '{\"file\":\"UM9wiTphNRRqX0Spdk9GGvJifiox6uiMxc4kUehK.jpg\",\"validasi\":0,\"Keterangan\":\"\"}', '{\"file\":\"WsWaokgt71vPgYdraA3ggLdfCVfxcZ3pXrQHubSP.jpg\",\"validasi\":0,\"Keterangan\":\"\"}', '{\"file\":\"M3dywkhijmyadoD0uQPL7zuZyo90u5CHnyzGOyRX.jpg\",\"validasi\":0,\"Keterangan\":\"\"}', '{\"file\":\"K0w7irHkpzdPEmGMEhuW9aIEoeG5guLcuTQXLfQb.jpg\",\"validasi\":0,\"Keterangan\":\"\"}', '{\"file\":\"7N6KO2YYdLAPfLZkqZCSvTwoJYvgjA5z7oh909bX.jpg\",\"validasi\":0,\"Keterangan\":\"\"}', '{\"file\":\"BME6FAJLEl3MvjbVQcY0eZ1ofZMuutjx8fwZJanr.jpg\",\"validasi\":0,\"Keterangan\":\"\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1'),
(4, 6, '192332532635', 'Darma', 'Rahman', '081247356143', '2006-05-17', 'roy@gmail.com', 'SMAN 1 Penyinggahan', 'Jalan Ki Hajar Dewantara RT. 3, Penyinggahan Ilir, Penyinggahan, Penyinggahan Ilir, Kec. Penyinggahan, Kabupaten Kutai Barat, Kalimantan Timur 75763', '1', 'Jl. Jauh Sekali', 'xHHZkxlpMVMxvekJeqnOjR2rvGZcIv4VwUd9FAoG.jpg', 170, 65, '{\"file\":\"NBVYk4eJlJegVv9mqwXVSNACIijaPg7FvhME4IGq.jpg\",\"validasi\":0,\"Keterangan\":\"\"}', '{\"file\":\"Xm9SjQ8RIXqxQWihPZ9poHbDq5X01Ir8FjAns2rc.jpg\",\"validasi\":0,\"Keterangan\":\"\"}', '{\"file\":\"40iQGrJn2JB8nrBurUqOKa2lNaYyAmE4IyIxokja.jpg\",\"validasi\":0,\"Keterangan\":\"\"}', '{\"file\":\"QIeZSm2vZhJGg0PUk5KIXZQXQtWfAv7srbzgFclV.jpg\",\"validasi\":0,\"Keterangan\":\"\"}', '{\"file\":\"ApD7JlCPpxp64HbSKVZJPARShnHlnymIpyinV0Ht.jpg\",\"validasi\":0,\"Keterangan\":\"\"}', '{\"file\":\"GfLnu0y3jYmVur7L5AsAqcHjd1VOoJtZphpWZWg0.jpg\",\"validasi\":0,\"Keterangan\":\"\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1'),
(5, 7, '192332532123', 'Christian', 'Hermawan', '081247356547', '2005-06-09', 'her@gmail.com', 'SMAN 1 Penyinggahan', 'Jalan Ki Hajar Dewantara RT. 3, Penyinggahan Ilir, Penyinggahan, Penyinggahan Ilir, Kec. Penyinggahan, Kabupaten Kutai Barat, Kalimantan Timur 75763', '1', 'Jl. Jauh Sekali', 'n3piuofdppKr1RQNgv40rI1BIlDwuzUQAduRTgqe.jpg', 175, 68, '{\"file\":\"NTBsoSUkxWvOY40mM1Dsw2PycDKgt8DuBELY3oBq.jpg\",\"validasi\":0,\"Keterangan\":\"\"}', '{\"file\":\"HLR273tqaFOq2PdDMXLclZ8fSluan678CLDxrwky.jpg\",\"validasi\":0,\"Keterangan\":\"\"}', '{\"file\":\"w7Y6xLcfC4qcbzLF7qXccTgPBZ4qYm9IGFuc81wZ.jpg\",\"validasi\":0,\"Keterangan\":\"\"}', '{\"file\":\"zlT2QqE2kMdMMgJxD3gXSSveeUL808zrWLKZwqbl.jpg\",\"validasi\":0,\"Keterangan\":\"\"}', '{\"file\":\"6FgA0t6tx2ml7oCePzdVdp51LPSo69tic83gTA4D.jpg\",\"validasi\":0,\"Keterangan\":\"\"}', '{\"file\":\"wYx0l5DeCqwFSnmwf61bX59FYiBGMuSkaZV0nHUE.jpg\",\"validasi\":0,\"Keterangan\":\"\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1'),
(6, 8, '192332532133', 'Risky', 'Alhazar', '081247312345', '2005-12-07', 'risky@gmail.com', 'SMAN 1 Long Iram', 'Long Iram Kota, Kec. Long Iram, Kabupaten Kutai Barat, Kalimantan Timur 75576', '1', 'Jl. Jauh Banget', '2xWtQ6sPh5wejc51eSCmqiAJRyFPKeVvFcMQVXwa.jpg', 173, 60, '{\"file\":\"LJgWPGfRgideNbi4rJyqjNQXQMdxJ1MaYH99fYVi.jpg\",\"validasi\":0,\"Keterangan\":\"\"}', '{\"file\":\"ig8EFgYs871i2cFwzIY0Ld6L0Bdh7RJAN25CXnzf.jpg\",\"validasi\":0,\"Keterangan\":\"\"}', '{\"file\":\"LN56t73O0ysYkPiTa6uZy8GooSGHQ63onG4ecui6.jpg\",\"validasi\":0,\"Keterangan\":\"\"}', '{\"file\":\"XWp2Bwho0UjBfKVS26xB6IZVtvt0ME0h8i11c0Lt.jpg\",\"validasi\":0,\"Keterangan\":\"\"}', '{\"file\":\"t6P5fNSNCLiRM2SlRdAA90whH04RjzxWCYdkgJX8.jpg\",\"validasi\":0,\"Keterangan\":\"\"}', '{\"file\":\"zHvXZ78htlSZdGNhvZv0q5oVN2XIn57KtsGaPWkC.jpg\",\"validasi\":0,\"Keterangan\":\"\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kriterias`
--

CREATE TABLE `kriterias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe` enum('benefit','cost') COLLATE utf8mb4_unicode_ci NOT NULL,
  `bobot` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kriterias`
--

INSERT INTO `kriterias` (`id`, `kode`, `nama`, `tipe`, `bobot`) VALUES
(1, 'C1', 'Tinggi Badan', 'benefit', 5),
(2, 'C2', 'Indeks Massa Tubuh', 'benefit', 4),
(3, 'C3', 'Ketahanan Fisik', 'benefit', 5),
(4, 'C4', 'Skor Pelatihan Baris - ber Baris', 'benefit', 4),
(5, 'C5', 'Skor Tes Psikologi', 'benefit', 3);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_06_26_155546_create_calon_pendampings_table', 1),
(5, '2021_06_26_164906_create_kriterias_table', 1),
(6, '2021_06_26_164915_create_sub_kriterias_table', 1),
(7, '2021_06_26_165853_create_nilai_calon_pendampings_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_calon_paskibrakas`
--

CREATE TABLE `nilai_calon_paskibrakas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paskibraka_id` bigint(20) UNSIGNED NOT NULL,
  `tipe` int(1) NOT NULL,
  `sub_kriteria_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai_calon_paskibrakas`
--

INSERT INTO `nilai_calon_paskibrakas` (`id`, `paskibraka_id`, `tipe`, `sub_kriteria_id`) VALUES
(7, 3, 1, 21),
(8, 3, 1, 25),
(9, 3, 1, 28),
(10, 3, 1, 31),
(11, 3, 1, 36),
(12, 4, 1, 23),
(13, 4, 1, 25),
(14, 4, 1, 27),
(15, 4, 1, 32),
(16, 4, 1, 36),
(17, 5, 1, 22),
(18, 5, 1, 25),
(19, 5, 1, 29),
(20, 5, 1, 32),
(21, 5, 1, 36),
(22, 6, 1, 23),
(23, 6, 1, 25),
(24, 6, 1, 27),
(25, 6, 1, 33),
(26, 6, 1, 36);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_kriterias`
--

CREATE TABLE `sub_kriterias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe` int(1) NOT NULL,
  `id_kriteria` bigint(20) UNSIGNED NOT NULL,
  `kondisi` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_kriterias`
--

INSERT INTO `sub_kriterias` (`id`, `kode`, `tipe`, `id_kriteria`, `kondisi`, `nilai`) VALUES
(21, 'C11', 1, 1, '> 180 cm', '5'),
(22, 'C12', 1, 1, '175 cm - 180 cm', '4'),
(23, 'C13', 1, 1, '170 cm - 174 cm', '3'),
(24, 'C14', 1, 1, '< 170 cm', '2'),
(25, 'C21', 1, 2, 'Sangat Baik (18,5 - 22,9)', '5'),
(26, 'C22', 1, 2, 'Kurang Baik (< 18,5 atau > 23)', '2'),
(27, 'C31', 1, 3, 'Sangat Baik', '5'),
(28, 'C32', 1, 3, 'Baik', '4'),
(29, 'C33', 1, 3, 'Cukup Baik', '3'),
(30, 'C34', 1, 3, 'Kurang Baik', '2'),
(31, 'C41', 1, 4, 'Sangat Baik', '5'),
(32, 'C42', 1, 4, 'Baik', '4'),
(33, 'C43', 1, 4, 'Cukup Baik', '3'),
(34, 'C44', 1, 4, 'Baik', '2'),
(35, 'C51', 1, 5, 'Sangat Baik', '5'),
(36, 'C52', 1, 5, 'Baik', '4'),
(37, 'C53', 1, 5, 'Cukup Baik', '3'),
(38, 'C54', 1, 5, 'Kurang Baik', '2'),
(39, 'C11', 2, 1, '> 170 cm', '5'),
(40, 'C12', 2, 1, '165 cm - 170 cm', '4'),
(41, 'C13', 2, 1, '160 cm - 164 cm', '3'),
(42, 'C14', 2, 1, '< 160 cm', '2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `password`) VALUES
(1, 'Admin', '1', 'admin@admin.com', '$2a$12$KGhH0xjlAL.N7bMOWuDkgudJqkd3T8DssPqiz4nW05GDKhXQO2Psa'),
(5, 'Yuzrul', '2', 'ansyari@gmail.com', '$2y$10$8nVupaojVmYIC7zfAgqfAu8hG6CQGlY9hgda0rs8Py9x0.cqwchKq'),
(6, 'Darma', '2', 'roy@gmail.com', '$2y$10$L4TWpXk1sSuxCfwcj79Xu.WvwJO810m/Wyl/M6YsdE6VOHJbU3hOy'),
(7, 'Christian', '2', 'her@gmail.com', '$2y$10$m3adAXE/ypzJPkx7pMxvB.KM/HYxC...xLPOEtlXpdTI1GwUH5GOe'),
(8, 'Risky', '2', 'risky@gmail.com', '$2y$10$7swiTC6yCzauK.0CuAv2IuJ3lwBgnZRJFdjotJmb18XsxO0Vsh3gq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calon_paskibrakas`
--
ALTER TABLE `calon_paskibrakas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `calon_pendampings_id_user_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriterias`
--
ALTER TABLE `kriterias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_calon_paskibrakas`
--
ALTER TABLE `nilai_calon_paskibrakas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nilai_calon_pendampings_id_pendamping_foreign` (`paskibraka_id`),
  ADD KEY `nilai_calon_pendampings_c1_foreign` (`sub_kriteria_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `sub_kriterias`
--
ALTER TABLE `sub_kriterias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_kriterias_id_kriteria_foreign` (`id_kriteria`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calon_paskibrakas`
--
ALTER TABLE `calon_paskibrakas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kriterias`
--
ALTER TABLE `kriterias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nilai_calon_paskibrakas`
--
ALTER TABLE `nilai_calon_paskibrakas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `sub_kriterias`
--
ALTER TABLE `sub_kriterias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `calon_paskibrakas`
--
ALTER TABLE `calon_paskibrakas`
  ADD CONSTRAINT `calon_paskibrakas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nilai_calon_paskibrakas`
--
ALTER TABLE `nilai_calon_paskibrakas`
  ADD CONSTRAINT `nilai_calon_paskibrakas_paskibraka_id_foreign` FOREIGN KEY (`paskibraka_id`) REFERENCES `calon_paskibrakas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_calon_paskibrakas_sub_kriteria_id_foreign` FOREIGN KEY (`sub_kriteria_id`) REFERENCES `sub_kriterias` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_kriterias`
--
ALTER TABLE `sub_kriterias`
  ADD CONSTRAINT `sub_kriterias_id_kriteria_foreign` FOREIGN KEY (`id_kriteria`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

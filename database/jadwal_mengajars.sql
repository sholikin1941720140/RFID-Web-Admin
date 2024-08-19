-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Agu 2024 pada 19.22
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rfid`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_mengajars`
--

CREATE TABLE `jadwal_mengajars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dosen_id` bigint(20) UNSIGNED NOT NULL,
  `mata_kuliah_id` bigint(20) UNSIGNED NOT NULL,
  `hari` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jadwal_mengajars`
--

INSERT INTO `jadwal_mengajars` (`id`, `dosen_id`, `mata_kuliah_id`, `hari`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'Senin', '2024-08-12 17:14:44', '2024-08-12 17:14:44'),
(2, 3, 2, 'Selasa', '2024-08-12 17:15:30', '2024-08-12 17:15:30'),
(3, 3, 3, 'Rabu', '2024-08-12 17:16:32', '2024-08-12 17:16:32'),
(4, 2, 8, 'Rabu', '2024-08-12 17:17:10', '2024-08-12 17:17:10'),
(5, 2, 5, 'Kamis', '2024-08-12 17:18:13', '2024-08-12 17:18:13'),
(6, 3, 6, 'Kamis', '2024-08-12 17:18:33', '2024-08-12 17:18:33'),
(7, 3, 2, 'Jumat', '2024-08-12 17:19:22', '2024-08-12 17:19:22'),
(8, 2, 7, 'Jumat', '2024-08-12 17:20:09', '2024-08-12 17:20:09');

INSERT INTO `jadwal_mengajar_items` (`id`, `jadwal_mengajar_id`, `jam_id`, `created_at`, `updated_at`) VALUES
(1, 1, 9, '2024-08-12 17:14:44', '2024-08-12 17:14:44'),
(2, 1, 10, '2024-08-12 17:14:44', '2024-08-12 17:14:44'),
(3, 1, 11, '2024-08-12 17:14:44', '2024-08-12 17:14:44'),
(4, 1, 12, '2024-08-12 17:14:44', '2024-08-12 17:14:44'),
(5, 2, 7, '2024-08-12 17:15:30', '2024-08-12 17:15:30'),
(6, 2, 8, '2024-08-12 17:15:30', '2024-08-12 17:15:30'),
(7, 2, 9, '2024-08-12 17:15:30', '2024-08-12 17:15:30'),
(8, 2, 10, '2024-08-12 17:15:30', '2024-08-12 17:15:30'),
(9, 2, 11, '2024-08-12 17:15:30', '2024-08-12 17:15:30'),
(10, 2, 12, '2024-08-12 17:15:30', '2024-08-12 17:15:30'),
(11, 3, 8, '2024-08-12 17:16:32', '2024-08-12 17:16:32'),
(12, 3, 9, '2024-08-12 17:16:32', '2024-08-12 17:16:32'),
(13, 3, 10, '2024-08-12 17:16:32', '2024-08-12 17:16:32'),
(14, 3, 11, '2024-08-12 17:16:32', '2024-08-12 17:16:32'),
(15, 4, 2, '2024-08-12 17:17:10', '2024-08-12 17:17:10'),
(16, 4, 3, '2024-08-12 17:17:10', '2024-08-12 17:17:10'),
(17, 4, 4, '2024-08-12 17:17:10', '2024-08-12 17:17:10'),
(18, 4, 5, '2024-08-12 17:17:10', '2024-08-12 17:17:10'),
(19, 5, 1, '2024-08-12 17:18:13', '2024-08-12 17:18:13'),
(20, 5, 2, '2024-08-12 17:18:13', '2024-08-12 17:18:13'),
(21, 5, 3, '2024-08-12 17:18:13', '2024-08-12 17:18:13'),
(22, 5, 4, '2024-08-12 17:18:13', '2024-08-12 17:18:13'),
(23, 6, 7, '2024-08-12 17:18:33', '2024-08-12 17:18:33'),
(24, 6, 8, '2024-08-12 17:18:33', '2024-08-12 17:18:33'),
(25, 7, 1, '2024-08-12 17:19:22', '2024-08-12 17:19:22'),
(26, 7, 2, '2024-08-12 17:19:22', '2024-08-12 17:19:22'),
(27, 7, 3, '2024-08-12 17:19:22', '2024-08-12 17:19:22'),
(28, 7, 4, '2024-08-12 17:19:22', '2024-08-12 17:19:22'),
(29, 7, 5, '2024-08-12 17:19:22', '2024-08-12 17:19:22'),
(30, 7, 6, '2024-08-12 17:19:22', '2024-08-12 17:19:22'),
(31, 8, 9, '2024-08-12 17:20:09', '2024-08-12 17:20:09'),
(32, 8, 10, '2024-08-12 17:20:09', '2024-08-12 17:20:09'),
(33, 8, 11, '2024-08-12 17:20:09', '2024-08-12 17:20:09'),
(34, 8, 12, '2024-08-12 17:20:09', '2024-08-12 17:20:09');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jadwal_mengajars`
--
ALTER TABLE `jadwal_mengajars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_mengajars_dosen_id_foreign` (`dosen_id`),
  ADD KEY `jadwal_mengajars_mata_kuliah_id_foreign` (`mata_kuliah_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jadwal_mengajars`
--
ALTER TABLE `jadwal_mengajars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `jadwal_mengajars`
--
ALTER TABLE `jadwal_mengajars`
  ADD CONSTRAINT `jadwal_mengajars_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_mengajars_mata_kuliah_id_foreign` FOREIGN KEY (`mata_kuliah_id`) REFERENCES `mata_kuliahs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

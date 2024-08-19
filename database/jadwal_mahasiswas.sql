-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Agu 2024 pada 10.11
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
-- Struktur dari tabel `jadwal_mahasiswas`
--

CREATE TABLE `jadwal_mahasiswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jadwal_mahasiswas`
--

INSERT INTO `jadwal_mahasiswas` (`id`, `mahasiswa_id`, `created_at`, `updated_at`) VALUES
(1, 4, '2024-08-13 07:41:36', '2024-08-13 07:41:36');

INSERT INTO `jadwal_mahasiswa_items` (`id`, `jadwal_mahasiswa_id`, `jadwal_mengajar_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-08-13 07:41:36', '2024-08-13 07:41:36'),
(2, 1, 2, '2024-08-13 07:41:36', '2024-08-13 07:41:36'),
(3, 1, 4, '2024-08-13 07:41:36', '2024-08-13 07:41:36'),
(4, 1, 3, '2024-08-13 07:41:36', '2024-08-13 07:41:36'),
(5, 1, 5, '2024-08-13 07:41:36', '2024-08-13 07:41:36'),
(6, 1, 6, '2024-08-13 07:41:36', '2024-08-13 07:41:36'),
(7, 1, 8, '2024-08-13 07:41:36', '2024-08-13 07:41:36'),
(8, 1, 7, '2024-08-13 07:41:36', '2024-08-13 07:41:36');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jadwal_mahasiswas`
--
ALTER TABLE `jadwal_mahasiswas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_mahasiswas_mahasiswa_id_foreign` (`mahasiswa_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jadwal_mahasiswas`
--
ALTER TABLE `jadwal_mahasiswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `jadwal_mahasiswas`
--
ALTER TABLE `jadwal_mahasiswas`
  ADD CONSTRAINT `jadwal_mahasiswas_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

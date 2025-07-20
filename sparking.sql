-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jul 2025 pada 14.07
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
-- Database: `sparking`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `datakendaraan`
--

CREATE TABLE `datakendaraan` (
  `id_kendaraan` bigint(20) UNSIGNED NOT NULL,
  `id_pengguna` bigint(20) UNSIGNED NOT NULL,
  `jenis_kendaraan1` enum('mobil','motor') NOT NULL,
  `no_plat1` varchar(255) NOT NULL,
  `foto_kendaraan1` varchar(255) NOT NULL,
  `qr_code1` varchar(255) DEFAULT NULL,
  `status1` enum('aktif','nonAktif','ditolak') NOT NULL DEFAULT 'nonAktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_parkir`
--

CREATE TABLE `log_parkir` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `zona_id` bigint(20) UNSIGNED NOT NULL,
  `subzona_id` bigint(20) UNSIGNED NOT NULL,
  `nomor_slot` varchar(255) NOT NULL,
  `waktu_mulai` timestamp NULL DEFAULT NULL,
  `waktu_selesai` timestamp NULL DEFAULT NULL,
  `durasi` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_11_05_100111_create_user_colection', 1),
(2, '2024_11_05_101851_create_zona_colection', 1),
(3, '2024_11_05_101915_create_transaksi_colection', 1),
(4, '2024_11_12_015334_create_sessions_table', 1),
(5, '2024_11_25_141205_create_subzona_colection', 1),
(6, '2024_11_27_152152_create_slot_colection', 1),
(7, '2024_12_05_044127_create_datakendaraan_colection', 1),
(8, '2025_05_13_052804_tambah_kolom_onboarding_ke_tabel_pengguna', 1),
(9, '2025_05_21_063957_add_email_verified_at_to_pengguna_table', 1),
(10, '2025_05_22_092911_create_password_resets_table', 1),
(11, '2025_05_24_123515_add_camera_id_to_sub_zona_table', 1),
(12, '2025_05_26_045257_add_coordinates_to_slots_table', 1),
(13, '2025_05_26_142921_add_more_coordinates_to_slot_table', 1),
(14, '2025_06_07_100219_create_log_parkir_table', 1),
(15, '2025_06_17_112716_create_cache_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` bigint(20) UNSIGNED NOT NULL,
  `identitas` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `jenis_pengguna` enum('mahasiswa','dosen','karyawan','tamu') NOT NULL,
  `nama` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jenis_kendaraan` enum('mobil','motor') DEFAULT NULL,
  `no_plat` varchar(255) DEFAULT NULL,
  `foto_kendaraan` varchar(255) DEFAULT NULL,
  `foto_pengguna` varchar(255) DEFAULT NULL,
  `qr_code` varchar(255) DEFAULT NULL,
  `role` enum('admin','pengguna') NOT NULL DEFAULT 'pengguna',
  `status` enum('aktif','nonAktif','ditolak') NOT NULL DEFAULT 'nonAktif',
  `onboarding_step` int(11) NOT NULL DEFAULT 0,
  `onboarding_completed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `slot`
--

CREATE TABLE `slot` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subzona_id` bigint(20) UNSIGNED NOT NULL,
  `nomor_slot` int(11) NOT NULL,
  `keterangan` enum('Terisi','Tersedia','Perbaikan') NOT NULL DEFAULT 'Tersedia',
  `x1` int(11) NOT NULL DEFAULT 0,
  `y1` int(11) NOT NULL DEFAULT 0,
  `x2` int(11) NOT NULL DEFAULT 0,
  `y2` int(11) NOT NULL DEFAULT 0,
  `x3` int(11) NOT NULL DEFAULT 0,
  `y3` int(11) NOT NULL DEFAULT 0,
  `x4` int(11) NOT NULL DEFAULT 0,
  `y4` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `subzona`
--

CREATE TABLE `subzona` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `zona_id` bigint(20) UNSIGNED NOT NULL,
  `nama_subzona` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `camera_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` bigint(20) UNSIGNED NOT NULL,
  `id_pengguna` bigint(20) UNSIGNED NOT NULL,
  `zona_id` bigint(20) UNSIGNED NOT NULL,
  `waktu_masuk` timestamp NOT NULL DEFAULT current_timestamp(),
  `waktu_keluar` timestamp NULL DEFAULT NULL,
  `status_transaksi` enum('aktif','selesai','gagal') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `zona`
--

CREATE TABLE `zona` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_zona` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `fotozona` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `datakendaraan`
--
ALTER TABLE `datakendaraan`
  ADD PRIMARY KEY (`id_kendaraan`),
  ADD UNIQUE KEY `datakendaraan_no_plat1_unique` (`no_plat1`),
  ADD KEY `datakendaraan_id_pengguna_foreign` (`id_pengguna`);

--
-- Indeks untuk tabel `log_parkir`
--
ALTER TABLE `log_parkir`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_parkir_zona_id_foreign` (`zona_id`),
  ADD KEY `log_parkir_subzona_id_foreign` (`subzona_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD KEY `password_reset_tokens_email_index` (`email`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD UNIQUE KEY `pengguna_email_unique` (`email`),
  ADD UNIQUE KEY `pengguna_identitas_unique` (`identitas`),
  ADD UNIQUE KEY `pengguna_no_plat_unique` (`no_plat`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `slot`
--
ALTER TABLE `slot`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slot_subzona_id_nomor_slot_unique` (`subzona_id`,`nomor_slot`);

--
-- Indeks untuk tabel `subzona`
--
ALTER TABLE `subzona`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subzona_zona_id_nama_subzona_unique` (`zona_id`,`nama_subzona`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `transaksi_id_pengguna_foreign` (`id_pengguna`),
  ADD KEY `transaksi_zona_id_foreign` (`zona_id`);

--
-- Indeks untuk tabel `zona`
--
ALTER TABLE `zona`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `zona_nama_zona_unique` (`nama_zona`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `datakendaraan`
--
ALTER TABLE `datakendaraan`
  MODIFY `id_kendaraan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `log_parkir`
--
ALTER TABLE `log_parkir`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `slot`
--
ALTER TABLE `slot`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `subzona`
--
ALTER TABLE `subzona`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `zona`
--
ALTER TABLE `zona`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `datakendaraan`
--
ALTER TABLE `datakendaraan`
  ADD CONSTRAINT `datakendaraan_id_pengguna_foreign` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `log_parkir`
--
ALTER TABLE `log_parkir`
  ADD CONSTRAINT `log_parkir_subzona_id_foreign` FOREIGN KEY (`subzona_id`) REFERENCES `subzona` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `log_parkir_zona_id_foreign` FOREIGN KEY (`zona_id`) REFERENCES `zona` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `slot`
--
ALTER TABLE `slot`
  ADD CONSTRAINT `slot_subzona_id_foreign` FOREIGN KEY (`subzona_id`) REFERENCES `subzona` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `subzona`
--
ALTER TABLE `subzona`
  ADD CONSTRAINT `subzona_zona_id_foreign` FOREIGN KEY (`zona_id`) REFERENCES `zona` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_id_pengguna_foreign` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_zona_id_foreign` FOREIGN KEY (`zona_id`) REFERENCES `zona` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2025 at 06:14 AM
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
-- Database: `testing`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `module` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `target_id` bigint(20) UNSIGNED DEFAULT NULL,
  `target_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `user_name`, `module`, `action`, `target_id`, `target_name`, `description`, `meta`, `created_at`, `updated_at`) VALUES
(5, 8, 'Administrator', 'Berita', 'menghapus', 6, 'tes', 'Administrator menghapus berita \"tes\"', '{\"event\":\"deleted\",\"model\":\"App\\\\Models\\\\Berita\",\"id\":6}', '2025-11-14 06:10:41', '2025-11-14 06:10:41'),
(6, 8, 'Administrator', 'Berita', 'memperbarui', 1, 'Pemeriksaan kesehatan pegawaii', 'Administrator memperbarui berita \"Pemeriksaan kesehatan pegawaii\"', '{\"event\":\"updated\",\"model\":\"App\\\\Models\\\\Berita\",\"id\":1}', '2025-11-14 06:11:04', '2025-11-14 06:11:04'),
(7, 8, 'Administrator', 'Berita', 'memperbarui', 1, 'Pemeriksaan kesehatan pegawaii', 'Administrator memperbarui berita \"Pemeriksaan kesehatan pegawaii\"', '{\"event\":\"updated\",\"model\":\"App\\\\Models\\\\Berita\",\"id\":1}', '2025-11-14 06:13:47', '2025-11-14 06:13:47'),
(8, 19, 'AdminBackUp', 'Berita', 'memperbarui', 1, 'Pemeriksaan kesehatan pegawaii', 'AdminBackUp memperbarui berita \"Pemeriksaan kesehatan pegawaii\"', '{\"event\":\"updated\",\"model\":\"App\\\\Models\\\\Berita\",\"id\":1}', '2025-11-14 06:14:18', '2025-11-14 06:14:18'),
(9, 19, 'AdminBackUp', 'Struktur', 'memperbarui', 1, '1', 'AdminBackUp memperbarui struktur \"1\"', '{\"event\":\"updated\",\"model\":\"App\\\\Models\\\\Struktur\",\"id\":1}', '2025-11-14 21:52:57', '2025-11-14 21:52:57');

-- --------------------------------------------------------

--
-- Table structure for table `agendas`
--

CREATE TABLE `agendas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kegiatan` varchar(255) NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agendas`
--

INSERT INTO `agendas` (`id`, `kegiatan`, `tempat`, `tanggal`, `waktu`, `created_at`, `updated_at`) VALUES
(1, 'Pendampingan Pengisian Data Kinerja pada Aplikasi SADAYA', 'zoom meeting', '2025-09-06', '11:08:00', '2025-09-06 00:08:27', '2025-09-06 00:08:27');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL,
  `status` enum('Aktif','Nonaktif') NOT NULL DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `judul`, `deskripsi`, `gambar`, `urutan`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Banner 1', 'Banner urutan 1', 'banner/1757142546_s8UipormR2c3NHhwwtxw9XZ1gFJnhO9g7VxSZMka.jpg', 1, 'Aktif', '2025-09-06 00:09:06', '2025-09-06 00:09:06');

-- --------------------------------------------------------

--
-- Table structure for table `beritas`
--

CREATE TABLE `beritas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `isi` text NOT NULL,
  `gambar` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `beritas`
--

INSERT INTO `beritas` (`id`, `judul`, `kategori`, `tanggal`, `isi`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Pemeriksaan kesehatan pegawaii', 'Kesehatan dan Olahraga', '2025-11-14', 'Dalam rangka mendukung terciptanya pegawai yang sehat jasmani dan rohani serta guna meningkatkan kualitas kinerja aparatur, Dinas Perumahan dan Permukiman (DISPERUMKIM) Kota Bogor menyelenggarakan kegiatan pemeriksaan kesehatan bagi seluruh pegawai ASN maupun Non-ASN. Kegiatan ini dilaksanakan sebagai bagian dari program rutin pemeliharaan kesehatan pegawai, dengan tujuan untuk:\r\n\r\nMendeteksi dini potensi gangguan kesehatan yang dapat mempengaruhi produktivitas kerja, memberikan rujukan atau tindak lanjut medis kepada pegawai yang memerlukan penanganan lebih lanjut. Menumbuhkan kesadaran akan pentingnya pola hidup sehat di lingkungan kerja.\r\n\r\nAdapun pemeriksaan kesehatan meliputi:\r\n\r\n- Pemeriksaan tekanan darah dan gula darah\r\n\r\n- Pemeriksaan kolesterol\r\n\r\n- Pemeriksaan indeks massa tubuh (IMT)\r\n\r\n- Konsultasi kesehatan umum dengan tenaga medis', 'berita/1757142274.jpg', '2025-09-06 00:04:34', '2025-11-14 06:14:18');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `calendars`
--

CREATE TABLE `calendars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hari` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `kegiatan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `calendars`
--

INSERT INTO `calendars` (`id`, `hari`, `tanggal`, `kegiatan`, `created_at`, `updated_at`) VALUES
(1, 'Sabtu', '2025-09-06', 'Libur', '2025-09-06 00:07:47', '2025-09-06 00:07:47'),
(2, 'Senin', '2025-09-08', 'Apel Pagi', '2025-09-06 03:14:07', '2025-09-06 03:14:07');

-- --------------------------------------------------------

--
-- Table structure for table `carousels`
--

CREATE TABLE `carousels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `gambar` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carousels`
--

INSERT INTO `carousels` (`id`, `judul`, `deskripsi`, `urutan`, `gambar`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Carousel 1', 'Deskripsi carousel 1', 1, 'carousel/1757142403_dfSzRtOp4lZHKpopGcjfPrPGfhc076HfjElH6Ugb.jpg', 'Aktif', '2025-09-06 00:06:43', '2025-09-06 00:06:43');

-- --------------------------------------------------------

--
-- Table structure for table `dokumens`
--

CREATE TABLE `dokumens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dokumens`
--

INSERT INTO `dokumens` (`id`, `judul`, `deskripsi`, `kategori`, `file_path`, `created_at`, `updated_at`) VALUES
(1, 'Rekap Aduan', 'Rekap Aduan SIBADRA', 'Umum', 'dokumen/1757142441_vbic2wG2P9uqiL48K31CkqZJd14uLAT8CbIQKT9U.pdf', '2025-09-06 00:07:21', '2025-09-06 00:07:21'),
(2, 'asd', 'asdasdasdasd', 'asdasdasda', 'dokumen/1763107888_214-226.Accept_Infotex_TIF_Aang+Hadid+Hamdalah_Sistem+Pengaduan+Layanan+Masyarakat+Berbasis+Web+Menggunakan+Metode+Agile+Extreme+Programming.pdf', '2025-11-14 01:11:28', '2025-11-14 01:11:28');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galeris`
--

CREATE TABLE `galeris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal` date NOT NULL,
  `foto` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galeri_foto`
--

CREATE TABLE `galeri_foto` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul_album` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal` date NOT NULL,
  `foto` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galeri_foto`
--

INSERT INTO `galeri_foto` (`id`, `judul_album`, `deskripsi`, `tanggal`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'Apel Pagi Rutin', 'Apel', '2025-11-01', 'galeri/1757142326.jpg', '2025-09-06 00:05:26', '2025-11-14 00:38:21');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_08_22_073215_create_beritas_table', 1),
(5, '2025_08_22_073223_create_galeris_table', 1),
(6, '2025_08_22_073230_create_carousels_table', 1),
(7, '2025_08_22_073238_create_navbars_table', 1),
(8, '2025_08_22_073245_create_dokumens_table', 1),
(9, '2025_08_22_073258_create_videos_table', 1),
(10, '2025_08_22_080215_add_username_to_users_table', 1),
(11, '2025_08_22_083225_create_sambutan_table', 1),
(12, '2025_08_22_083236_create_profile_table', 1),
(13, '2025_08_22_083247_create_galeri_foto_table', 1),
(14, '2025_08_22_083259_create_video_galeri_table', 1),
(15, '2025_08_22_085414_update_sambutan_table_foto_pejabat', 1),
(16, '2025_08_22_085712_update_profile_table_foto', 1),
(17, '2025_08_22_085905_update_all_foto_columns_to_text', 1),
(18, '2025_09_01_152207_create_calendars_table', 1),
(19, '2025_09_01_152220_create_agendas_table', 1),
(20, '2025_09_01_152231_create_banners_table', 1),
(21, '2025_09_02_092149_create_visi_misis_table', 1),
(22, '2025_09_02_100717_create_pejabats_table', 1),
(23, '2025_09_03_000000_create_strukturs_table', 1),
(24, '2025_09_05_200900_create_template_pages_table', 1),
(25, '2025_09_05_201039_add_template_page_id_to_navbars_table', 1),
(26, '2025_11_14_000000_create_activity_logs_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `navbars`
--

CREATE TABLE `navbars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `template_page_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `link` varchar(255) NOT NULL DEFAULT '#',
  `is_dropdown` tinyint(1) NOT NULL DEFAULT 0,
  `sub_menu` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`sub_menu`)),
  `urutan` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `navbars`
--

INSERT INTO `navbars` (`id`, `template_page_id`, `nama`, `icon`, `link`, `is_dropdown`, `sub_menu`, `urutan`, `is_active`, `created_at`, `updated_at`) VALUES
(27, 22, 'Testing Menu', NULL, '#', 1, '[\"Ini Adalah Tes\"]', 1, 1, '2025-09-06 03:14:38', '2025-09-06 03:15:20');

-- --------------------------------------------------------

--
-- Table structure for table `pejabats`
--

CREATE TABLE `pejabats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `urutan` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pejabats`
--

INSERT INTO `pejabats` (`id`, `nama`, `jabatan`, `foto`, `urutan`, `created_at`, `updated_at`) VALUES
(1, 'KEPALA DISPERUMKIM KOTA BOGOR', 'KEPALA DISPERUMKIM KOTA BOGOR', 'pejabat/1757142191.png', 1, '2025-09-06 00:03:11', '2025-09-06 00:03:11');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` text NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `nama`, `jabatan`, `deskripsi`, `foto`, `email`, `telepon`, `created_at`, `updated_at`) VALUES
(1, 'Ir. H. Ahmad Syarif, M.M.', 'Kepala DISPERUMKIM Kota Bogor', 'Memiliki pengalaman lebih dari 20 tahun dalam bidang perumahan dan permukiman. Berhasil memimpin berbagai program pembangunan perumahan layak huni di Kota Bogor.', 'profile/default.jpg', 'kepala@disperumkim.bogor.go.id', '(0251) 123456', '2025-11-14 00:08:07', '2025-11-14 00:08:07');

-- --------------------------------------------------------

--
-- Table structure for table `sambutan`
--

CREATE TABLE `sambutan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `isi_sambutan` text NOT NULL,
  `nama_pejabat` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `foto_pejabat` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sambutan`
--

INSERT INTO `sambutan` (`id`, `isi_sambutan`, `nama_pejabat`, `jabatan`, `foto_pejabat`, `created_at`, `updated_at`) VALUES
(1, 'Assalamu\'alaikum wr.wb.\r\n312312\r\nRasa syukur terbesar selalu terhaturkan kepada Allah SWT, karena nikmat kesehatan dan kesempatan dari-Nya, masyarakat Kota Bogor tetap bersemangat menuju hidup sehat. Selamat datang di situs resmi Website Dinas Perumahan dan Permukiman Kota Bogor. Website Dinas Perumahan dan Permukiman ini memuat Profil Dinas Perumahan dan Permukiman dan informasi penting berbagai program dan kegiatan Dinas Perumahan dan Permukiman Kota Bogor, Kami harap website ini dapat bermanfaat dalam memberikan data dan informasi yang dapat digunakan oleh masyarakat.', 'IR. H. CHUSNUL ROZAQI, M.M', 'KEPALA DISPERUMKIM KOTA BOGOR', 'sambutan/1763107074.jpg', '2025-09-06 00:02:39', '2025-11-14 00:57:54'),
(2, 'Assalamu\'alaikum Warahmatullahi Wabarakatuh\n\nSelamat datang di website resmi Dinas Perumahan, Permukiman dan Kawasan Permukiman (DISPERUMKIM) Kota Bogor. Website ini merupakan media informasi dan komunikasi antara pemerintah dengan masyarakat dalam rangka memberikan pelayanan yang transparan, akuntabel, dan responsif.\n\nKami berkomitmen untuk terus meningkatkan kualitas pelayanan publik dalam bidang perumahan, permukiman, dan kawasan permukiman yang layak huni, aman, nyaman, dan berkelanjutan.\n\nTerima kasih atas kunjungan Anda.\n\nWassalamu\'alaikum Warahmatullahi Wabarakatuh\n\nKepala DISPERUMKIM Kota Bogor\n\nIr. H. Ahmad Syarif, M.M.', 'Ir. H. Ahmad Syarif, M.M.', 'Kepala DISPERUMKIM Kota Bogor', 'default.jpg', '2025-11-14 00:08:07', '2025-11-14 00:08:07');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Al1LJgTem6AEeqi8mwNbEvc0jmSy961ra7SKf28K', 8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQ3k3cFgzdW1hVnA5RUVTRG1mRmdEcjRVSUxTc09sWHU0QlRmbVBPRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo4O30=', 1763615546),
('QdJE9sRLBlkWRJrzBGMT6u1pqawkCvav1oluzKx2', 19, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiajdnZWxZODIzT3ZPbjFsRzZXOHFvT01BQWM4aDJkTTVreEJXRGVrcSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE5O30=', 1763109608),
('QfQKfrYVrzmgboEG4E3cQdUQuXXCoqHAMoZ4Uq2S', 19, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUEV1NFdZeUt6bDhmZHJtVmVJOThDZEI4VklBUzl0TUFZWGZKc2RxZCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE5O30=', 1763126059),
('t4RMvis2BRgu83bTM1GFImPBvCtOzDzrHJg5Oi3a', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY1R3bkFOaTQxUDN5SjByaVp5WGIyTXB3ckpaRTNReUxuVHdYekxSayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1763181031),
('VJeh1OFlcnzHrZlIZ1mU4yRjSN9VFqc7DT3mA5Db', 8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibTVKejJJYWFCM05lMEEyaE9HaGJ2R0FTRWhoc01KTHI0YmRjdVViNiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjg7czozOiJ1cmwiO2E6MDp7fX0=', 1763105161),
('vWhIzF1PHpOmUFFxQEomZxfJWtz0iTDm6hEQF3BT', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiY0RHZ2daQ21veE9oSFJoQUNvTXpYdjFWYW1TQThQSXVBT254U3lxMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1763098478),
('Y99f9unICylHnKNTRQ8qqTG0pFDmVFNIuQFs20L1', 19, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSmlJT3hJSW5kRlpFY2dzYUxwaDFEYXgxT0EzUmVuUGRENGFUczR1TSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE5O30=', 1763182378),
('yoxMHZWD2aDgxdmUBCZCYmaZs4HtGXWAMpUm4P09', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRktUVXM4THpEbVVIYmFua1dvekhJNTJlbEZhZU5ScDdxZWUxTndBQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1763100498);

-- --------------------------------------------------------

--
-- Table structure for table `strukturs`
--

CREATE TABLE `strukturs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gambar` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `strukturs`
--

INSERT INTO `strukturs` (`id`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'struktur/1763182376.jpg', '2025-09-06 00:09:21', '2025-11-14 21:52:57');

-- --------------------------------------------------------

--
-- Table structure for table `template_pages`
--

CREATE TABLE `template_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `navbar_id` bigint(20) UNSIGNED NOT NULL,
  `template_type` enum('berita','sambutan') NOT NULL,
  `judul_halaman` varchar(255) NOT NULL,
  `judul_content` varchar(255) NOT NULL,
  `isi_content` text NOT NULL,
  `tanggal` date NOT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `penulis` varchar(255) DEFAULT NULL,
  `nama_pejabat` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `foto_pejabat` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `template_pages`
--

INSERT INTO `template_pages` (`id`, `navbar_id`, `template_type`, `judul_halaman`, `judul_content`, `isi_content`, `tanggal`, `kategori`, `gambar`, `penulis`, `nama_pejabat`, `jabatan`, `foto_pejabat`, `slug`, `is_active`, `created_at`, `updated_at`) VALUES
(22, 27, 'sambutan', 'Menggunakan Template Sambutan', 'Menggunakan Template Sambutan', 'Ini adalah isi dari kontennya long text', '2025-09-06', NULL, NULL, NULL, 'Ini Adalah Judul', 'Ini Kategori', NULL, 'menggunakan-template-sambutan', 1, '2025-09-06 03:15:20', '2025-09-06 03:15:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(8, 'Administrator', 'admin', 'admin@disperumkim.bogor.go.id', '2025-11-14 00:02:09', '$2y$12$tmj44B0JYS2meaocAKheM.vuNhSOLpkkvrF3NnhiJ/9plu8s3zNLO', NULL, '2025-11-13 23:50:25', '2025-11-14 00:02:09'),
(19, 'AdminBackUp', 'admin1', 'admin1@disperum.com', NULL, '$2y$12$mUzm7sAe2Xeo4.pG4v9QsOYOX5QYhGXulqw/3qhcQswE/MKVSXEC6', NULL, '2025-11-14 00:52:45', '2025-11-14 00:52:45');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal` date NOT NULL,
  `video_id` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `judul`, `deskripsi`, `tanggal`, `video_id`, `url`, `created_at`, `updated_at`) VALUES
(1, 'PROFILE DISPERUMKIM KOTA BOGOR', 'Profile', '2025-09-06', 'kyvDBJOtMSM', 'https://youtu.be/kyvDBJOtMSM', '2025-09-06 00:06:00', '2025-09-06 00:06:00'),
(2, 'Video Profil DISPERUMKIM Kota Bogor', 'Video profil singkat tentang DISPERUMKIM Kota Bogor', '2024-01-25', 'dQw4w9WgXcQ', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', '2025-11-14 00:08:07', '2025-11-14 00:08:07');

-- --------------------------------------------------------

--
-- Table structure for table `video_galeri`
--

CREATE TABLE `video_galeri` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `url_video` varchar(255) NOT NULL,
  `thumbnail` text NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visi_misis`
--

CREATE TABLE `visi_misis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `tujuan_strategis` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visi_misis`
--

INSERT INTO `visi_misis` (`id`, `visi`, `misi`, `tujuan_strategis`, `created_at`, `updated_at`) VALUES
(1, 'Testing Visi misi', 'Test Visi misi', 'Test Visi misi', '2025-11-14 00:40:58', '2025-11-14 00:40:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `agendas`
--
ALTER TABLE `agendas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beritas`
--
ALTER TABLE `beritas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `calendars`
--
ALTER TABLE `calendars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carousels`
--
ALTER TABLE `carousels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokumens`
--
ALTER TABLE `dokumens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galeris`
--
ALTER TABLE `galeris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galeri_foto`
--
ALTER TABLE `galeri_foto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `navbars`
--
ALTER TABLE `navbars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `navbars_template_page_id_foreign` (`template_page_id`);

--
-- Indexes for table `pejabats`
--
ALTER TABLE `pejabats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sambutan`
--
ALTER TABLE `sambutan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `strukturs`
--
ALTER TABLE `strukturs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_pages`
--
ALTER TABLE `template_pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `template_pages_slug_unique` (`slug`),
  ADD KEY `template_pages_navbar_id_foreign` (`navbar_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video_galeri`
--
ALTER TABLE `video_galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visi_misis`
--
ALTER TABLE `visi_misis`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `agendas`
--
ALTER TABLE `agendas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `beritas`
--
ALTER TABLE `beritas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `calendars`
--
ALTER TABLE `calendars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `carousels`
--
ALTER TABLE `carousels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dokumens`
--
ALTER TABLE `dokumens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galeris`
--
ALTER TABLE `galeris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galeri_foto`
--
ALTER TABLE `galeri_foto`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `navbars`
--
ALTER TABLE `navbars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `pejabats`
--
ALTER TABLE `pejabats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sambutan`
--
ALTER TABLE `sambutan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `strukturs`
--
ALTER TABLE `strukturs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `template_pages`
--
ALTER TABLE `template_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `video_galeri`
--
ALTER TABLE `video_galeri`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visi_misis`
--
ALTER TABLE `visi_misis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `navbars`
--
ALTER TABLE `navbars`
  ADD CONSTRAINT `navbars_template_page_id_foreign` FOREIGN KEY (`template_page_id`) REFERENCES `template_pages` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `template_pages`
--
ALTER TABLE `template_pages`
  ADD CONSTRAINT `template_pages_navbar_id_foreign` FOREIGN KEY (`navbar_id`) REFERENCES `navbars` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

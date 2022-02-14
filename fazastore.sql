-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2022 at 03:59 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fazastore`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `categories_id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`barang_id`, `categories_id`, `nama_barang`, `gambar`, `harga`, `stok`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 3, 'Meja Ikea', '164292968453.jpg', 5000000, 21, 'Meja dengan design minimalis namun tahan lama dan tidak mudah lapuk, karena produk terbuat dari material kayu pilihan.', '2022-01-23 02:21:24', '2022-02-13 03:00:00'),
(2, 2, 'Kursi Vintage', '164292979431.jpg', 2500000, 0, 'Kursi dengan material berkualitas, tidak mudah robek dan pudar. Tinggi kursi : 1,7 meter, tahan hingga bobot 150 kg.', '2022-01-23 02:23:16', '2022-02-10 01:03:07'),
(3, 1, 'Lemari Retro', '164292989912.jpg', 4000000, 21, 'Tinggi lemari : 1,5 meter, terdiri atas 2 laci dan 2 penyimpanan.', '2022-01-23 02:24:59', '2022-02-13 03:24:39'),
(4, 2, 'Kursi Bar', '164465790729.jpg', 2000000, 3, 'test', '2022-02-12 02:25:07', '2022-02-12 04:01:30');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categories_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categories_id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Lemari', '2022-01-23 02:16:13', '2022-01-23 02:16:13'),
(2, 'Kursi', '2022-01-23 02:16:18', '2022-01-23 02:16:18'),
(3, 'Meja', '2022-01-23 02:16:29', '2022-01-23 02:16:29');

-- --------------------------------------------------------

--
-- Table structure for table `email_verifications`
--

CREATE TABLE `email_verifications` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_verifications`
--

INSERT INTO `email_verifications` (`email`, `code`) VALUES
('naufalnawaf24@gmail.com', '205203'),
('naufalnawaf24@gmail.com', '492615'),
('daffarifqhy09@gmail.com', '968912'),
('daffarifqhy09@gmail.com', '880890'),
('daffarifqhy09@gmail.com', '275379'),
('daffarifqhy09@gmail.com', '223208'),
('daffarifqhy09@gmail.com', '609592'),
('daffarifqhy09@gmail.com', '594009'),
('daffarifqhy09@gmail.com', '122453'),
('daffarifqhy09@gmail.com', '656510'),
('daffarifqhy09@gmail.com', '863044');

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
(3, '2021_12_02_041002_create_categories_table', 1),
(4, '2021_12_02_041003_create_barangs_table', 1),
(5, '2021_12_02_041321_create_pesanans_table', 1),
(6, '2021_12_02_041322_create_pesanan_details_table', 1),
(7, '2022_01_31_045259_add_penerima_to_pesanans_table', 2),
(8, '2022_02_13_073310_add_keterangan_to_pesanans_table', 3),
(9, '2022_02_13_104017_email_verification_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('udaffa09@gmail.com', '$2y$10$cZWDO9fqrv1IA0sUg3DqwOaMTVRIcg2N0oQV5STRs506K.VIYqtKO', '2022-02-12 02:31:37');

-- --------------------------------------------------------

--
-- Table structure for table `pesanans`
--

CREATE TABLE `pesanans` (
  `pesanan_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` int(11) NOT NULL,
  `jumlah_harga` int(11) NOT NULL,
  `bukti` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `penerima` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pesanans`
--

INSERT INTO `pesanans` (`pesanan_id`, `user_id`, `tanggal`, `status`, `kode`, `jumlah_harga`, `bukti`, `created_at`, `updated_at`, `penerima`, `keterangan`) VALUES
(1, 2, '2022-01-23', '3', 447, 13000000, '164293003640.jpg', '2022-01-23 02:26:55', '2022-01-30 23:46:49', '164361160984.jpg', NULL),
(2, 2, '2022-01-23', '3', 453, 6500000, '164293007874.jpg', '2022-01-23 02:27:33', '2022-01-30 23:49:55', '164361179547.jpg', NULL),
(3, 2, '2022-01-23', '3', 854, 7500000, '164293012410.jpg', '2022-01-23 02:28:13', '2022-01-30 23:50:32', '164361183217.jpg', NULL),
(4, 2, '2022-01-23', '3', 298, 14500000, '164360044477.jpg', '2022-01-23 02:28:58', '2022-01-30 23:51:52', '164361191242.jpg', NULL),
(5, 2, '2022-01-31', '3', 917, 9000000, '164360398661.jpg', '2022-01-30 21:39:13', '2022-01-30 23:53:06', '164361198670.jpg', NULL),
(6, 2, '2022-01-31', '3', 529, 5000000, '164361545517.jpg', '2022-01-31 00:50:42', '2022-01-31 00:57:47', NULL, NULL),
(7, 2, '2022-01-31', '2', 704, 4000000, '164361549058.jpg', '2022-01-31 00:51:22', '2022-01-31 01:09:13', NULL, NULL),
(11, 2, '2022-02-12', '4', 159, 9000000, '164466369016.jpg', '2022-02-12 01:12:27', '2022-02-13 00:26:03', NULL, NULL),
(12, 3, '2022-02-12', '3', 575, 10000000, '164465754386.jpg', '2022-02-12 02:16:36', '2022-02-12 02:29:00', '164465814015.jpg', NULL),
(15, 3, '2022-02-13', '4', 556, 5000000, '164473810959.jpg', '2022-02-13 00:41:38', '2022-02-13 00:57:13', NULL, 'Transfer anda tidak valid'),
(16, 3, '2022-02-13', '4', 919, 4000000, '164473813464.jpg', '2022-02-13 00:42:05', '2022-02-13 03:21:42', NULL, 'Pengajuan telah dikonfirmasi admin'),
(17, 3, '2022-02-13', '4', 390, 5000000, '164474639994.jpg', '2022-02-13 02:59:52', '2022-02-13 03:01:13', NULL, 'Stok barang tiba-tiba habis'),
(18, 3, '2022-02-13', '2', 802, 4000000, '164474787946.jpg', '2022-02-13 03:24:31', '2022-02-13 03:35:31', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_details`
--

CREATE TABLE `pesanan_details` (
  `detail_id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) NOT NULL,
  `pesanan_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `jumlah_harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pesanan_details`
--

INSERT INTO `pesanan_details` (`detail_id`, `barang_id`, `pesanan_id`, `jumlah`, `jumlah_harga`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 5000000, '2022-01-23 02:26:55', '2022-01-23 02:26:55'),
(2, 3, 1, 2, 8000000, '2022-01-23 02:27:08', '2022-01-23 02:27:08'),
(3, 2, 2, 1, 2500000, '2022-01-23 02:27:33', '2022-01-23 02:27:33'),
(4, 3, 2, 1, 4000000, '2022-01-23 02:27:44', '2022-01-23 02:27:44'),
(5, 1, 3, 1, 5000000, '2022-01-23 02:28:13', '2022-01-23 02:28:13'),
(6, 2, 3, 1, 2500000, '2022-01-23 02:28:35', '2022-01-23 02:28:35'),
(7, 2, 4, 1, 2500000, '2022-01-23 02:28:58', '2022-01-23 02:28:58'),
(8, 3, 4, 3, 12000000, '2022-01-23 02:29:10', '2022-01-30 20:39:47'),
(9, 3, 5, 1, 4000000, '2022-01-30 21:39:13', '2022-01-30 21:39:13'),
(10, 1, 5, 1, 5000000, '2022-01-30 21:39:23', '2022-01-30 21:39:23'),
(11, 1, 6, 1, 5000000, '2022-01-31 00:50:42', '2022-01-31 00:50:42'),
(12, 3, 7, 1, 4000000, '2022-01-31 00:51:22', '2022-01-31 00:51:22'),
(17, 1, 11, 1, 5000000, '2022-02-12 01:12:28', '2022-02-12 01:13:34'),
(18, 1, 12, 2, 10000000, '2022-02-12 02:16:38', '2022-02-12 02:16:38'),
(21, 4, 11, 2, 4000000, '2022-02-12 03:36:54', '2022-02-12 04:01:20'),
(22, 1, 15, 1, 5000000, '2022-02-13 00:41:38', '2022-02-13 00:41:38'),
(23, 3, 16, 1, 4000000, '2022-02-13 00:42:05', '2022-02-13 00:42:05'),
(24, 1, 17, 1, 5000000, '2022-02-13 02:59:52', '2022-02-13 02:59:52'),
(25, 3, 18, 1, 4000000, '2022-02-13 03:24:32', '2022-02-13 03:24:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rekening` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roles` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `email_verified_at`, `password`, `alamat`, `no_hp`, `rekening`, `roles`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin daffa', 'admindaffa@fazastore.com', NULL, '$2y$10$P5.kUGqLj/vpY8BACAg.1ehVLrPpcdcDHXnHMX26rTOcSrjI1j1Rm', NULL, '085544443333', '034101000743', 'ADMIN', NULL, NULL, '2022-01-23 02:34:09'),
(2, 'Daffa Ulhaq', 'udaffa09@gmail.com', NULL, '$2y$10$u0KNAEIHYAHIpMkeq0Pd5uhM5njZbia/yjJbux2kcjWylFeiRcqMu', 'Kampung Cangklek, Desa Sukamanah RT:04/01, Kec. Cugenang/ Cianjur', '087770966633', NULL, NULL, NULL, '2022-01-23 02:13:25', '2022-01-23 02:13:25'),
(3, 'Nawaf Naofal', 'nawaf09@gmail.com', NULL, '$2y$10$A8MgOcgpqpwk3lDJbPClUecGzTE/1aDYCNNFRAxAGmHxT8BwbaK8m', 'Kampung cangklek desa sukamanah rt 04 rw 05 kecamatan cugenang kabupaten cianjur', '087770966644', NULL, NULL, NULL, '2022-02-12 02:15:03', '2022-02-12 02:15:03'),
(4, 'Nawaf Naufal', 'naufalnawaf24@gmail.com', NULL, '$2y$10$Bdx0jn1XJSMnTAezikCff.yZ3P5/vyRXbPNbSHHXsVdUrcUv2y0sq', 'Kampung Cangklek, Desa Sukamanah RT:04/01, Kec. Cugenang/ Cianjur', '082127291418', NULL, NULL, NULL, '2022-02-14 06:59:32', '2022-02-14 06:59:32'),
(8, 'Daffa', 'daffarifqhy09@gmail.com', NULL, '$2y$10$DGJfXHJszyHntsR3ny194ODotL55lwaM4Qhd8JHZ8U9kdUkNJbooC', 'Kampung Cangklek, Desa Sukamanah RT:04/01, Kec. Cugenang/ Cianjur', '085221587527', NULL, NULL, NULL, '2022-02-14 07:34:05', '2022-02-14 07:34:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`barang_id`),
  ADD KEY `barangs_categories_id_foreign` (`categories_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categories_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pesanans`
--
ALTER TABLE `pesanans`
  ADD PRIMARY KEY (`pesanan_id`),
  ADD KEY `pesanans_user_id_foreign` (`user_id`);

--
-- Indexes for table `pesanan_details`
--
ALTER TABLE `pesanan_details`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `pesanan_details_pesanan_id_foreign` (`pesanan_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `barang_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pesanans`
--
ALTER TABLE `pesanans`
  MODIFY `pesanan_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pesanan_details`
--
ALTER TABLE `pesanan_details`
  MODIFY `detail_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barangs`
--
ALTER TABLE `barangs`
  ADD CONSTRAINT `barangs_categories_id_foreign` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`categories_id`);

--
-- Constraints for table `pesanans`
--
ALTER TABLE `pesanans`
  ADD CONSTRAINT `pesanans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `pesanan_details`
--
ALTER TABLE `pesanan_details`
  ADD CONSTRAINT `pesanan_details_pesanan_id_foreign` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanans` (`pesanan_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

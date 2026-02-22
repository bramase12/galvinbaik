-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2024 at 12:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fufastore`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` int(11) NOT NULL,
  `nama_akun` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `click_records`
--

CREATE TABLE `click_records` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `url_tujuan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `harga`, `nama_produk`, `image_url`, `deskripsi`, `url_tujuan`) VALUES
(18, 99999999.99, 'Arknights', 'uploads/673177074c02e.png', 'Akun sepuh pensi 5 bulan', 'https://discord.com/invite/NJYsxHZ6'),
(19, 99999999.99, 'Bloodstrike', 'uploads/673177ca9f4a9.png', 'akun bloodstrike yang gacor parah ygy k/d nya tinggi bgt ygy pernah top lb ', 'https://discord.com/invite/NJYsxHZ6'),
(20, 99999999.99, 'COC', 'uploads/6731784113345.png', 'Akun coc di jual karena kalah war clan', 'https://discord.com/invite/NJYsxHZ6'),
(21, 99999999.99, 'Akun ML', 'uploads/673178bd2bd66.png', 'Di jual akun karena butuh duwet', 'https://discord.com/invite/NJYsxHZ6'),
(22, 99999999.99, 'GENSHIN IMPACT ASELI JAWA', 'uploads/67317a316ad66.png', 'Akun ini pernah dimainkan verkun-tull', 'https://youtu.be/Ulc7lZbjGZo?si=CctslOcsTWivhcri'),
(23, 99999999.99, 'Ngep ngep 8b', 'uploads/67317aa14b674.png', 'Akun epep di jual karena jarang di pakai', 'https://discord.com/invite/NJYsxHZ6'),
(24, 99999999.99, 'Azur Lane', 'uploads/67317b939c74a.png', 'Ownernya mlas main', 'https://youtu.be/C2V4zGH6xt8?si=xDg747EYvxrYrw-D'),
(25, 99999999.99, 'mobil legen', 'uploads/67317d142d8e9.png', 'Butuh uang', 'https://discord.com/invite/NJYsxHZ6'),
(26, 99999999.99, 'Call Of Mobile', 'uploads/67317ded69332.png', 'senjatanya rahasia beli dulu baru lihat!!', 'https://discord.com/invite/NJYsxHZ6'),
(27, 99999999.99, 'Pabaji', 'uploads/673180af2f547.png', 'Akun Ampas gk pernah hoki', 'https://youtu.be/Aq5WXmQQooo?si=GT310PygFttx-8QQ'),
(28, 99999999.99, 'CODM', 'uploads/673181f578454.png', 'Jawa Jawa Jawa', 'https://discord.com/invite/NJYsxHZ6'),
(29, 99999999.99, 'api gratis', 'uploads/673185de59e19.png', 'sama kayak ml bu', 'https://discord.com/invite/NJYsxHZ6s');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` varchar(10) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `role`) VALUES
(4, 'user', '$2y$10$NgsDinPlZXf1q/MMF5S2NulD/xPVexG93OZIwEwCQcBPrbJiyfe8q', '2024-11-05 13:53:41', 'user'),
(5, 'adminjahat', '$2y$10$4VB2Ap.OAkbuS5EWjszhfeAcCEF0QEnudzYRjpBTXmhkscx.UWXo6', '2024-11-05 14:17:08', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `click_records`
--
ALTER TABLE `click_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `click_records`
--
ALTER TABLE `click_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `click_records`
--
ALTER TABLE `click_records`
  ADD CONSTRAINT `click_records_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `click_records_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

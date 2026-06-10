-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2026 at 05:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `regresi_linear`
--

-- --------------------------------------------------------

--
-- Table structure for table `dataset`
--

CREATE TABLE `dataset` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `literasi_digital` decimal(5,2) DEFAULT NULL,
  `kemudahan_penggunaan` decimal(5,2) DEFAULT NULL,
  `penggunaan_qris` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dataset`
--

INSERT INTO `dataset` (`id`, `nama`, `literasi_digital`, `kemudahan_penggunaan`, `penggunaan_qris`) VALUES
(3, 'Ade Niken Ayu Sinaga', 5.00, 4.33, 4.67),
(4, 'Adinda Febiola', 4.25, 5.00, 4.33),
(5, 'Aditya Rizki Pratomo', 5.00, 4.67, 5.00),
(6, 'Ahmad Fathur', 3.75, 4.00, 3.00),
(7, 'Ahmad Mauni Zm', 2.75, 2.00, 2.33),
(8, 'Ahmad Siddiq', 1.00, 1.00, 1.00),
(9, 'Aidil Syaputra', 3.50, 3.67, 3.67),
(10, 'Alhadi Alfarezi', 2.00, 2.00, 5.00),
(11, 'Alya', 4.00, 3.33, 3.33),
(12, 'Alya Anazwa Sinaga', 5.00, 4.33, 5.00),
(13, 'Alya Zahratunisa', 3.75, 4.67, 4.00),
(14, 'Alyah Octafia', 4.00, 3.67, 3.67),
(15, 'Amalia Sri Devi Lingga', 5.00, 5.00, 5.00),
(16, 'Amanda', 4.75, 3.33, 4.67),
(17, 'Amanda Putri', 4.75, 5.00, 4.67),
(18, 'Amanda Rizky Oktaviansyah', 4.75, 4.33, 4.67),
(19, 'Amanta Harahap', 4.75, 3.33, 5.00),
(20, 'Amel Lidya', 2.25, 3.00, 3.67),
(21, 'Andika Dwi Azhari', 4.25, 4.33, 4.33),
(22, 'Andika Rian', 3.75, 3.33, 3.67),
(23, 'Andre Setiawan', 4.00, 2.67, 2.00),
(24, 'Andrew Garfield', 4.25, 4.00, 4.00),
(25, 'Anggun Amalia', 4.50, 4.67, 5.00),
(26, 'Areindra Anjanna', 5.00, 5.00, 5.00),
(27, 'Argandy Sitinjak', 4.50, 4.33, 4.33),
(28, 'Aris Sanjaya', 3.75, 3.33, 2.67),
(29, 'Aspidayani', 4.25, 4.00, 4.00),
(30, 'Astria Wulandari', 4.25, 3.00, 3.67),
(31, 'Aulia', 3.25, 3.33, 2.67),
(32, 'Aulya Fani Madani', 5.00, 3.67, 4.00),
(33, 'Aurelia Putri Hakim Siregar', 3.75, 4.67, 4.67),
(34, 'Aurelia Siregar', 4.00, 4.00, 4.00),
(35, 'Avrillia Andhini', 4.75, 4.33, 4.67),
(36, 'Aya', 4.50, 3.67, 4.67),
(37, 'Azam Rafid Ardiansyah', 3.50, 3.00, 4.33),
(38, 'Aziz Ardiansyah', 4.00, 4.33, 5.00),
(39, 'Bambang Purwanto', 4.25, 3.67, 4.00),
(40, 'Bapak Koko', 1.00, 1.00, 1.00),
(41, 'Bella', 4.50, 4.67, 4.67),
(42, 'Benjamin Fajar Sesko', 5.00, 5.00, 5.00),
(43, 'Caca Putri', 2.75, 2.67, 4.00),
(44, 'Chairunnisyah Widi Pratiwi', 1.25, 1.33, 1.33),
(45, 'Cindy', 3.75, 3.33, 4.00),
(46, 'Cindy Aisyah Putri', 3.25, 3.33, 3.33),
(47, 'Cindy Kurnia Sari', 5.00, 5.00, 5.00),
(48, 'Cindy Yunika', 4.00, 4.00, 4.00),
(49, 'Cipa', 4.50, 4.00, 4.00),
(50, 'Cut Rodiah Ritonga', 3.50, 2.33, 4.33),
(51, 'Cynara Neisa', 4.25, 5.00, 5.00),
(52, 'Dafa Maulana', 4.25, 4.00, 5.00),
(53, 'Dafa Siregar', 4.00, 3.67, 4.00),
(54, 'Daffa Aidiva', 4.00, 4.00, 4.00),
(55, 'Dahlina, SP', 3.75, 3.67, 3.33),
(56, 'Dani Susilowati', 3.75, 3.00, 3.67),
(57, 'David Purba', 4.50, 3.67, 4.33),
(58, 'Dea Violinda', 4.00, 4.00, 4.00),
(59, 'Dede Fajru Pamungkas', 4.50, 4.33, 5.00),
(60, 'Desy Anggreini', 4.50, 4.67, 5.00),
(61, 'Deva Auli', 5.00, 5.00, 5.00),
(62, 'Dhavina', 4.75, 4.00, 4.67),
(63, 'Didy Chandra', 4.50, 4.67, 5.00),
(64, 'Dika Sitompul', 3.50, 3.00, 3.33),
(65, 'Dimas Aditya Pradana', 4.00, 4.00, 4.00),
(66, 'Dimas Agung Prasetyo', 2.00, 4.67, 3.67),
(67, 'Dindaca', 4.00, 1.33, 1.33),
(68, 'Dody Eka Pratama,St', 5.00, 5.00, 5.00),
(69, 'Elly Safnizar', 1.00, 1.00, 2.33),
(70, 'Elvi Damayanti', 4.50, 4.33, 4.00),
(71, 'Elvira Handayani', 5.00, 5.00, 5.00),
(72, 'Emita Dia', 3.00, 4.67, 4.33),
(73, 'Enda Tarigan', 3.00, 2.67, 3.67),
(74, 'Enjiw', 4.00, 3.67, 4.00),
(75, 'Erwin Saragih', 3.75, 5.00, 3.67),
(76, 'Fadlullah Arya Romadhoni', 4.75, 4.33, 5.00),
(77, 'Fahmi Ramadhan', 2.25, 1.67, 1.67),
(78, 'Faiz Rizki', 3.75, 3.67, 3.67),
(79, 'Fani', 3.25, 3.67, 3.67),
(80, 'Fanisa Aulia Putri', 2.00, 2.00, 2.00),
(81, 'Farel Sipayung', 4.25, 3.67, 4.00),
(82, 'Fauziah Sabila', 4.25, 4.33, 4.33),
(83, 'Ferdinan', 3.50, 4.00, 4.00),
(84, 'Fertina Hairani', 3.50, 4.67, 4.67),
(85, 'Fitrah', 3.00, 2.00, 3.00),
(86, 'Fitriansyah', 5.00, 5.00, 5.00),
(87, 'Franklin Wiliam', 4.00, 4.33, 4.33),
(88, 'Golfried Sinaga', 5.00, 4.33, 4.00),
(89, 'H.R Merdu Wira Jasa', 4.00, 4.00, 4.00),
(90, 'Habib Al-Rayaan Sungkar', 3.75, 4.00, 3.33),
(91, 'Hafizah Rahmi Lubis', 5.00, 5.00, 5.00),
(92, 'Hamdan Saputra', 3.75, 3.00, 3.00),
(93, 'Hanif Maulana', 4.25, 4.67, 5.00),
(94, 'Hannes Sitinjak', 5.00, 4.33, 3.67),
(95, 'Hari Priandana', 3.25, 4.33, 4.67),
(96, 'Haryza Firdaus', 4.75, 3.33, 4.00),
(97, 'Haya Atika Syafi\'ah', 2.00, 2.00, 2.67),
(98, 'Henita Yuliandari', 4.00, 4.00, 4.00),
(99, 'Hotmaida Girsang', 5.00, 5.00, 5.00),
(100, 'Ibnati Qumi Laila', 1.00, 1.00, 1.00),
(101, 'Ilham Pradana', 1.00, 1.00, 1.00),
(102, 'Immanuel Manalu', 5.00, 4.33, 5.00),
(103, 'Indah Fadila Sari', 1.25, 2.00, 2.33),
(104, 'Indrawan Syahputr', 3.75, 4.00, 4.00),
(105, 'Ir.Mhd Fais Sinaga', 4.00, 3.67, 4.00),
(106, 'Irgi Khalifah Akbar', 1.25, 2.33, 2.33),
(107, 'Iskandar Zulkarnain', 5.00, 4.67, 5.00),
(108, 'Jadiaman Manurung', 5.00, 5.00, 5.00),
(109, 'Jamal Musiala', 5.00, 4.67, 5.00),
(110, 'Jessica', 3.75, 2.67, 4.67),
(111, 'Jsd.Berutu', 3.75, 3.67, 4.00),
(112, 'Julia Anisa Damanik', 1.75, 1.67, 1.67),
(113, 'Julio Sanjaya Ritonga', 4.50, 4.00, 4.33),
(114, 'Junin Divasakira Saragih', 4.75, 4.33, 4.67),
(115, 'Justin Panjaitan', 4.50, 4.67, 4.67),
(116, 'Kelvin Zullal', 4.00, 3.67, 3.67),
(117, 'Kesuma Dewi', 5.00, 4.67, 5.00),
(118, 'Kesya Azahra', 1.75, 4.33, 3.67),
(119, 'Kiki Aulia', 4.00, 3.67, 4.00),
(120, 'Kiki Novran Siregar', 5.00, 5.00, 5.00),
(121, 'Laila Azizah', 4.75, 4.67, 5.00),
(122, 'Laila M Nasution', 4.75, 4.67, 5.00),
(123, 'Lastri Pertiwi', 5.00, 5.00, 5.00),
(124, 'Linda Patmawati', 4.25, 4.33, 4.33),
(125, 'Lupi', 5.00, 5.00, 4.33),
(126, 'M.Prayogi', 3.50, 4.00, 3.33),
(127, 'Madina Putri', 5.00, 5.00, 5.00),
(128, 'Maulana Dzikri Aryansyah', 2.75, 2.33, 3.67),
(129, 'Maya Sari', 1.00, 1.00, 1.00),
(130, 'Mean Manurung', 4.50, 5.00, 5.00),
(131, 'Mely Saputri', 5.00, 5.00, 5.00),
(132, 'Mhd Abdul Aziz', 5.00, 5.00, 5.00),
(133, 'Mhd Akbar Pranata Sinaga', 5.00, 5.00, 5.00),
(134, 'Mhd Delatra Apriansyah', 4.75, 4.33, 5.00),
(135, 'Mhd Hamid Akbar', 3.75, 2.67, 3.67),
(136, 'Mhd. Aldi Pratama Sinaga', 4.00, 3.67, 4.00),
(137, 'Mhd. Fauzal Pratama', 4.50, 4.33, 4.33),
(138, 'Mika', 5.00, 5.00, 5.00),
(139, 'Muhammad Abduh', 5.00, 4.67, 4.67),
(140, 'Muhammad Ardiansyah', 4.00, 3.33, 3.33),
(141, 'Muhammad Arief', 4.75, 5.00, 5.00),
(142, 'Muhammad Dwi Prabowo', 3.75, 3.33, 5.00),
(143, 'Muhammad Fauzi', 5.00, 5.00, 5.00),
(144, 'Muhammad Fikri Azhari', 2.00, 4.33, 4.00),
(145, 'Muhammad Ikmal Azhar', 5.00, 4.33, 4.00),
(146, 'Muhammad Mukmin Arif', 5.00, 5.00, 5.00),
(147, 'Muhammad Rasyid Damanik', 1.50, 2.33, 2.33),
(148, 'Muhammad Sahroni', 5.00, 5.00, 5.00),
(149, 'Muhammad Taufik', 3.00, 4.33, 4.00),
(150, 'Muhammad Trihardyansyah', 1.00, 2.33, 1.00),
(151, 'Muhammad Wijaya', 3.75, 3.33, 5.00),
(152, 'Muhammad Yamin', 1.00, 1.00, 1.00),
(153, 'Murniwati Sirait', 1.75, 2.00, 4.00),
(154, 'Muti Cantik', 4.00, 4.00, 4.00),
(155, 'Nabila Meilani', 3.50, 2.67, 3.33),
(156, 'Nabila Puspita Dewi', 1.00, 1.00, 1.00),
(157, 'Nadzwa', 4.25, 5.00, 4.67),
(158, 'Naila', 3.00, 2.67, 2.33),
(159, 'Nakta Jerymia Akbar Sinaga', 4.25, 3.67, 3.33),
(160, 'Naufal Batubara', 4.75, 3.33, 4.00),
(161, 'Nayla Riski', 4.00, 4.00, 4.00),
(162, 'Nazly', 5.00, 4.33, 4.67),
(163, 'Nazwa Sharfina', 4.50, 4.33, 4.00),
(164, 'Nia', 4.75, 4.33, 4.67),
(165, 'Niko Putra Ananda Hasibuan', 5.00, 4.67, 5.00),
(166, 'Noni Kumala Sari', 4.50, 3.33, 4.00),
(167, 'Noriza Hafni', 4.00, 4.00, 4.33),
(168, 'Novaardana', 4.75, 5.00, 5.00),
(169, 'Novianty', 3.00, 3.00, 3.00),
(170, 'Nur Aspidayani', 3.50, 3.67, 3.67),
(171, 'Nurdin Malik', 4.50, 5.00, 5.00),
(172, 'Nurlina Siregar', 3.25, 5.00, 5.00),
(173, 'Nurul Afifa Ramadani', 1.00, 1.00, 1.00),
(174, 'Nurul Hidayah', 4.50, 4.33, 5.00),
(175, 'Pardiansyah', 5.00, 5.00, 5.00),
(176, 'Pia', 5.00, 4.33, 4.67),
(177, 'Prity Salsabila', 5.00, 4.67, 5.00),
(178, 'Putra', 4.50, 4.67, 4.33),
(179, 'Putri Adiliya', 4.75, 3.67, 4.33),
(180, 'Putri Aguslima', 5.00, 5.00, 5.00),
(181, 'Putri Aulia', 3.75, 4.33, 5.00),
(182, 'Putri Dania', 4.00, 4.33, 5.00),
(183, 'Putri Pusvasari', 1.50, 4.33, 2.67),
(184, 'Rafa Nugroho', 4.00, 4.00, 3.67),
(185, 'Rahmat', 4.50, 3.67, 4.67),
(186, 'Raihan Lubis', 5.00, 5.00, 5.00),
(187, 'Rameria Saragih', 4.75, 5.00, 5.00),
(188, 'Rasel Desta Anjanna', 2.75, 3.67, 4.00),
(189, 'Ray Imam', 4.50, 4.33, 5.00),
(190, 'Ray Imam Rahmaja', 5.00, 4.33, 3.67),
(191, 'Reno Faqih', 4.75, 3.67, 4.67),
(192, 'Reva', 5.00, 4.67, 4.67),
(193, 'Reza', 4.25, 4.33, 5.00),
(194, 'Reza Fahlevi Lubis', 3.75, 4.00, 5.00),
(195, 'Reza Siregar', 5.00, 5.00, 5.00),
(196, 'Rian Setiawab', 4.75, 4.00, 4.33),
(197, 'Rifki Wawan Maulana', 4.75, 4.00, 4.00),
(198, 'Rio Akbar Apriliansyah Damanik', 4.25, 4.67, 4.67),
(199, 'Rionaldo Sibarani', 4.75, 5.00, 5.00),
(200, 'Ririn', 4.00, 4.33, 5.00),
(201, 'Ririn Desi Yanti Sinaga', 5.00, 5.00, 5.00),
(202, 'Ririn Rizvya', 5.00, 5.00, 5.00),
(203, 'Riski Pratama', 4.75, 4.67, 5.00),
(204, 'Rizky Dali', 4.25, 4.33, 3.33),
(205, 'Rizky Eko Syahputra Saragih', 5.00, 5.00, 5.00),
(206, 'Rizvy Azyura', 1.00, 2.00, 1.33),
(207, 'Ryan', 4.50, 4.33, 4.00),
(208, 'Saira Sugranti', 4.50, 4.33, 4.33),
(209, 'Salamah', 4.25, 4.00, 4.00),
(210, 'Sandy Hardiansyah', 1.25, 1.33, 1.00),
(211, 'Santi JJ', 4.75, 5.00, 5.00),
(212, 'Savina', 5.00, 5.00, 4.67),
(213, 'Selvia', 5.00, 4.67, 5.00),
(214, 'Serly Adela', 5.00, 4.33, 4.33),
(215, 'Shabrina Anwar Cantik Manis', 3.50, 3.33, 3.33),
(216, 'Silva Camara', 4.00, 4.33, 4.00),
(217, 'Siti Febriani', 5.00, 4.00, 4.33),
(218, 'Siti Nurdiana Wijaya', 4.00, 4.00, 3.00),
(219, 'Sri Lestari', 4.00, 4.00, 4.00),
(220, 'Sri Wahyu Ningsih', 3.25, 3.33, 3.67),
(221, 'Sucipto Mengkusumo', 3.75, 4.00, 3.67),
(222, 'Syakira Lian Umi', 4.00, 4.00, 4.00),
(223, 'Tengku Siti Bhasyari', 2.50, 2.33, 2.33),
(224, 'Tia Putri Anggraini P Tambun S', 5.00, 5.00, 5.00),
(225, 'Tika', 4.00, 3.00, 3.00),
(226, 'Togong', 5.00, 5.00, 4.00),
(227, 'Topek', 4.50, 4.67, 4.33),
(228, 'Tria', 4.50, 4.33, 3.00),
(229, 'Trisma', 3.25, 3.67, 3.67),
(230, 'Trisma Muliani', 4.25, 4.67, 4.00),
(231, 'Tuandi', 5.00, 5.00, 5.00),
(232, 'Tuparoh Mauli Danamik', 3.75, 4.00, 3.67),
(233, 'Ulfa Zufrina', 5.00, 3.67, 5.00),
(234, 'Uwi', 3.25, 2.67, 3.33),
(235, 'Vena Angriva Putri', 5.00, 5.00, 5.00),
(236, 'Vita Tarigan', 4.75, 4.33, 4.67),
(237, 'Wahyuda Ibnu', 5.00, 4.33, 4.67),
(238, 'Wardah', 4.00, 4.00, 4.00),
(239, 'Widya Amanda', 4.75, 4.67, 5.00),
(240, 'Windy Agustin', 4.25, 4.00, 3.00),
(241, 'Wira Aditya', 3.00, 2.00, 3.33),
(242, 'Wiwid Nofa Suciaty, S.Pd., M.Li.', 5.00, 4.33, 5.00),
(243, 'Wiwid Nur Sulistisni', 4.75, 4.00, 5.00),
(244, 'Yana', 4.50, 3.33, 5.00),
(245, 'Yanti', 5.00, 4.33, 4.67),
(246, 'Yenatalia', 1.50, 2.00, 2.33),
(247, 'Yuda Natanael Simangungsong', 4.50, 4.67, 4.33),
(248, 'Zahri Abimanyu', 5.00, 4.67, 5.00),
(249, 'Zaskia Tri Pranawita', 5.00, 5.00, 5.00),
(250, 'Zefa Alfriji', 4.75, 4.00, 4.67),
(251, 'Zidan', 4.75, 4.33, 5.00);

-- --------------------------------------------------------

--
-- Table structure for table `hasil_regresi`
--

CREATE TABLE `hasil_regresi` (
  `id` int(11) NOT NULL,
  `konstanta` double DEFAULT NULL,
  `b1` double DEFAULT NULL,
  `b2` double DEFAULT NULL,
  `r2` double DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dataset`
--
ALTER TABLE `dataset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hasil_regresi`
--
ALTER TABLE `hasil_regresi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dataset`
--
ALTER TABLE `dataset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;

--
-- AUTO_INCREMENT for table `hasil_regresi`
--
ALTER TABLE `hasil_regresi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

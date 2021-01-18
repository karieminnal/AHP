-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2020 at 07:21 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ahp_survey`
--

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(11) NOT NULL,
  `nama_divisi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`) VALUES
(1, 'LOGISTIK'),
(2, 'TEKNISI'),
(3, 'KEAMANAN'),
(4, 'CUSTOMER SERVICE'),
(5, 'KASIR'),
(6, 'CONTOH');

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(11) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `nilai_ahp` float NOT NULL,
  `tingkat_kepuasan` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `id_divisi`, `id_pelanggan`, `nilai_ahp`, `tingkat_kepuasan`) VALUES
(10, 1, 6, 0.451477, 45),
(11, 3, 6, 0.39764, 40),
(12, 4, 6, 0.483832, 48),
(13, 5, 6, 0.455995, 46),
(14, 1, 11, 0.385502, 39),
(15, 2, 11, 0.374601, 37),
(16, 3, 11, 0.423932, 42),
(17, 4, 11, 0.408494, 41),
(18, 5, 11, 0.408494, 41),
(19, 1, 12, 0.783334, 78);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `batas_1` float NOT NULL,
  `batas_2` float NOT NULL,
  `nama_nilai` varchar(100) NOT NULL,
  `prioritas` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `batas_1`, `batas_2`, `nama_nilai`, `prioritas`) VALUES
(1, 91, 100, 'Sangat Puas', 1),
(2, 81, 90, 'Puas', 0.66261),
(3, 71, 80, 'Cukup', 0.38274),
(4, 61, 70, 'Kurang', 0.20365),
(5, 0, 60, 'Buruk', 0.11249),
(6, 0, 35, 'sangat buruk', 0.32835);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_ahp`
--

CREATE TABLE `nilai_ahp` (
  `id` int(11) NOT NULL,
  `id_nilai_1` int(11) NOT NULL,
  `id_nilai_2` int(11) NOT NULL,
  `nilai_1` float NOT NULL,
  `nilai_2` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_ahp`
--

INSERT INTO `nilai_ahp` (`id`, `id_nilai_1`, `id_nilai_2`, `nilai_1`, `nilai_2`) VALUES
(86, 1, 2, 3, 0.33333),
(87, 1, 3, 5, 0.2),
(88, 1, 4, 7, 0.14286),
(89, 1, 5, 9, 0.11111),
(90, 1, 6, 1, 1),
(91, 2, 3, 3, 0.33333),
(92, 2, 4, 5, 0.2),
(93, 2, 5, 7, 0.14286),
(94, 2, 6, 3, 0.33333),
(95, 3, 4, 5, 0.2),
(96, 3, 5, 7, 0.14286),
(97, 3, 6, 1, 1),
(98, 4, 5, 5, 0.2),
(99, 4, 6, 1, 1),
(100, 5, 6, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `no_induk` varchar(20) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `id_divisi` int(11) DEFAULT NULL,
  `id_pengguna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `no_induk`, `nama_pegawai`, `alamat`, `no_hp`, `id_divisi`, `id_pengguna`) VALUES
(3, '14061903', 'Tema Gusti Pratama', 'Gang Bersama Santa Maria No.44 Kel. Gunung Ibul Kec. Prabumulih Timur Kota Prabumulih', '082372210507', 1, 14),
(4, '14061807', 'Yudha Agustian', 'Jl. Kapten Abdullah No. 64 Kel. Mangga Besar Kec. Prabumulih Utara', '082372210507', 1, 15),
(5, '14061811', 'Endang', 'Jalan Alipatan Gang Maar, Prabumulih Utara Kota Prabumulih', '082372210507', 3, 16),
(6, '14061808', 'Anda J.s ', 'Perum Prabu Indah Blok F4 No.05 Kel. Gunung Ibul Kec. Prabumulih Timur Kota Prabumulih', '082372210507', 2, 17),
(7, '14061809', 'Rizky Pratama', 'Prumnas Nias Permai Blok B8 No.20 Prabumulih Timur', '082372210507', 2, 18),
(8, '14062006', 'Rosyada Miranjulia', 'Prumnas Cendrawasih Blok B2 Prabumulih Timur', '082372210507', 4, 19),
(9, '14061501', 'Diva Alvero ', 'Jl. M. Yusuf Wahid, Sukajadi  Kec Prabumulih Timur', '082372210507', 5, 20),
(10, '123456', 'Velariza', 'Jl Sariasih 1 no 44 blok 2 Sarijadi Bandung', '082372210507', 3, 26);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `id_pengguna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `alamat`, `no_hp`, `id_pengguna`) VALUES
(6, 'Muhammad Fadli Ashidiqqie', 'Komplek Pertamina EP Asset 2, Mangga Besar, Prabumulih Timur', '082372210507', 12),
(7, 'Ansori Bahar', 'Prumnas Griya Sejahtera Blok G10, Gunung Ibul, Prabumulih Timur', '082372210507', 13),
(8, 'Muhammad Abi', 'Jln. Rama No.12 Wonosari Prabumulih Utara', '082372210507', 21),
(9, 'Arya Syahputra', 'Jln. Merak No. 205, Tugu Kecil, Prabumulih Timur', '082372210507', 22),
(10, 'Afrizal D', 'Prumnas Kepodang jln. Kaswari Blok C11 No. 03 Kel. Patih Galung, Prabumulih', '082372210507', 23),
(11, 'Velariza Alvioletta', 'Jalan Lubai Gunung Ibul Prabumulih Timur', '082372210507', 24),
(12, 'Velariza', 'Jl Sariasih 1 no 44 blok 2 Sarijadi Bandung', '082372210507', 25);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan_pertanyaan`
--

CREATE TABLE `pelanggan_pertanyaan` (
  `id` int(11) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_pertanyaan` int(11) NOT NULL,
  `id_nilai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan_pertanyaan`
--

INSERT INTO `pelanggan_pertanyaan` (`id`, `id_divisi`, `id_pelanggan`, `id_pertanyaan`, `id_nilai`) VALUES
(25, 1, 6, 2, 3),
(26, 1, 6, 3, 2),
(27, 1, 6, 4, 2),
(28, 1, 6, 5, 2),
(29, 1, 6, 6, 3),
(30, 1, 6, 7, 1),
(31, 1, 6, 8, 3),
(32, 3, 6, 20, 3),
(33, 3, 6, 21, 2),
(34, 3, 6, 22, 3),
(35, 3, 6, 23, 3),
(36, 3, 6, 24, 2),
(37, 3, 6, 25, 2),
(38, 3, 6, 26, 2),
(39, 4, 6, 29, 2),
(40, 4, 6, 30, 2),
(41, 4, 6, 34, 3),
(42, 4, 6, 42, 2),
(43, 4, 6, 43, 3),
(44, 4, 6, 44, 1),
(45, 4, 6, 45, 3),
(46, 5, 6, 46, 3),
(47, 5, 6, 47, 2),
(48, 5, 6, 48, 2),
(49, 5, 6, 49, 2),
(50, 5, 6, 50, 3),
(51, 5, 6, 51, 1),
(52, 5, 6, 52, 2),
(53, 1, 11, 2, 3),
(54, 1, 11, 3, 3),
(55, 1, 11, 4, 2),
(56, 1, 11, 5, 3),
(57, 1, 11, 6, 2),
(58, 1, 11, 7, 2),
(59, 1, 11, 8, 2),
(60, 2, 11, 13, 3),
(61, 2, 11, 14, 2),
(62, 2, 11, 15, 3),
(63, 2, 11, 16, 3),
(64, 2, 11, 17, 3),
(65, 2, 11, 18, 3),
(66, 2, 11, 19, 2),
(67, 3, 11, 20, 3),
(68, 3, 11, 21, 2),
(69, 3, 11, 22, 2),
(70, 3, 11, 23, 3),
(71, 3, 11, 24, 2),
(72, 3, 11, 25, 2),
(73, 3, 11, 26, 2),
(74, 4, 11, 29, 3),
(75, 4, 11, 30, 2),
(76, 4, 11, 34, 2),
(77, 4, 11, 42, 3),
(78, 4, 11, 43, 3),
(79, 4, 11, 44, 2),
(80, 4, 11, 45, 2),
(81, 5, 11, 46, 3),
(82, 5, 11, 47, 2),
(83, 5, 11, 48, 2),
(84, 5, 11, 49, 3),
(85, 5, 11, 50, 3),
(86, 5, 11, 51, 2),
(87, 5, 11, 52, 2),
(88, 1, 12, 2, 1),
(89, 1, 12, 3, 1),
(90, 1, 12, 4, 2),
(91, 1, 12, 5, 2),
(92, 1, 12, 6, 3),
(93, 1, 12, 7, 1),
(94, 1, 12, 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('Admin','Pegawai','Pelanggan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama_lengkap`, `username`, `password`, `level`) VALUES
(1, 'Administrator', 'admin', '$2y$10$EjmVjAni6qTcyis8xjFdHu7RQY7J7NXvTFsYOxGqFMAvFM9RaAggy', 'Admin'),
(12, 'Muhammad Fadli Ashidiqqie', 'mfadli', '$2y$10$EkZuFF8DA6WZslJyigJ1NOum28/BlHyHjkzrATPnnn5Hl1LE2DFVa', 'Pelanggan'),
(13, 'Ansori Bahar', 'ansori', '$2y$10$MWJJ2IJXzVuT8Et5NBzzve5Dy9iOV9Rg6HBWASi1wc1BYwXZSBAwu', 'Pelanggan'),
(14, 'Tema Gusti Pratama', 'temagusti', '$2y$10$tgp.BYwnKlec9xfob1e9le40QCgz0YyHdZqLQbNUm/7gDfjHaDjMe', 'Pegawai'),
(15, 'Yudha Agustian', 'yudhaa', '$2y$10$j9VR7gF9tuq/3zt6iZHKfeIF3EfOwZSpCIahokBberoBAIsxE4YU.', 'Pegawai'),
(16, 'Endang', 'endang', '$2y$10$H0Rl10sNd39noQNlZ6VIEOtTg.7LHeqL4PxUJd9IqXVpeZojUzjuG', 'Pegawai'),
(17, 'Anda J.s ', 'andajs', '$2y$10$N16KTFPlHSZctM6TguxpR.s0ZW1kY0ASsZdOd.ir9GquT6HHv.tEq', 'Pegawai'),
(18, 'Rizky Pratama', 'rizkyp', '$2y$10$brMX4YE2.rImH81PUfrzaOHeJA4DVhvTB2zU/fPypbVwpTG9yN3Z.', 'Pegawai'),
(19, 'Rosyada Miranjulia', 'rosyada', '$2y$10$HMC1W..xT1ZbzU/A6ei6U.H/.ip6hfmbsuZNP7xh3LFYOI7JeJLsK', 'Pegawai'),
(20, 'Diva Alvero ', 'divaalvero', '$2y$10$2HdO7KreCtqVkNOQzBaQyulj5dQCrL3.SHK6Dw.LrBdPiS6ueZLL6', 'Pegawai'),
(21, 'Muhammad Abi', 'muhammadabi', '$2y$10$jHA2IBiifFaRt4xv1qym4.8o4ZR3MmSiOiVXXtuv9Jy0nLHelgUJ2', 'Pelanggan'),
(22, 'Arya Syahputra', 'aryasyah', '$2y$10$8pWo7anJB3IzpDgp7vncWOCsuMU.1Qx9ogD76sGpgJmZNDcJqp7hy', 'Pelanggan'),
(23, 'Afrizal D', 'afrizal', '$2y$10$3ll3tYY6UEEwGLbvc897puSzM9Bu8puUfADhJMjCK1e8HtbKdzFZ2', 'Pelanggan'),
(24, 'Velariza Alvioletta', 'velarizalv', '$2y$10$6T0owtyBQ.8IQzpeIK/VBeAwtxM3Qw4F65oiKhCRnDhMPRsYoG7Pq', 'Pelanggan'),
(25, 'Velariza', 'velarizaalvioletta', '$2y$10$2ex25keba35kxvEGTyUZ/OB6yUjPFp/o6h7JccP3RcL1gtMuzvdbC', 'Pelanggan'),
(26, 'Velariza', 'velarizapegawai', '$2y$10$Juy662LBnYxqR5GhJPmNt.8jIgnLhzBeKxGZ7IUMp7yVU9WkkvKVW', 'Pegawai');

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `id_pertanyaan` int(11) NOT NULL,
  `kode_pertanyaan` varchar(10) NOT NULL,
  `nama_pertanyaan` text NOT NULL,
  `prioritas` float DEFAULT NULL,
  `id_divisi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pertanyaan`
--

INSERT INTO `pertanyaan` (`id_pertanyaan`, `kode_pertanyaan`, `nama_pertanyaan`, `prioritas`, `id_divisi`) VALUES
(2, 'P001', 'Tanggap dalam merespon pelanggan datang', 0.33062, 1),
(3, 'P002', 'Sopan dan Santun Terhadap Pelanggan', 0.21665, 1),
(4, 'P003', 'Komunikasi yang baik dalam pelayanan', 0.14822, 1),
(5, 'P004', 'Memahami Jobdesk', 0.14916, 1),
(6, 'P005', 'Menanggapi keluhan pelanggan dengan cepat', 0.08703, 1),
(7, 'P006', 'Berpakaian Sesuai Dengan Jobdesk', 0.04286, 1),
(8, 'P007', 'Kecepatan Dalam Menyelesaikan Jobdesk', 0.02547, 1),
(13, 'P008', 'Tanggap dalam merespon pelanggan datang', 0.33062, 2),
(14, 'P009', 'Sopan dan Santun Terhadap Pelanggan', 0.21665, 2),
(15, 'P010', 'Komunikasi Yang Baik Dalam Pelayanan', 0.14822, 2),
(16, 'P011', 'Memahami Jobdesk', 0.14916, 2),
(17, 'P012', 'Menanggapi Keluhan Pelanggan Dengan Cepat', 0.08703, 2),
(18, 'P013', 'Berpakaian Sesuai Dengan Jobdesk', 0.04286, 2),
(19, 'P014', 'Kecepatan Dalam Menyelesaikan Jobdesk', 0.02547, 2),
(20, 'P015', 'Tanggap dalam merespon pelanggan datang', 0.33062, 3),
(21, 'P016', 'Sopan dan Santun Terhadap Pelanggan', 0.21665, 3),
(22, 'P017', 'Komunikasi Yang Baik Dalam Pelayanan', 0.14822, 3),
(23, 'P018', 'Memahami Jobdesk', 0.14916, 3),
(24, 'P019', 'Menanggapi Keluhan Pelanggan Dengan Cepat', 0.08703, 3),
(25, 'P020', 'Berpakaian Sesuai Dengan Jobdesk', 0.04286, 3),
(26, 'P021', 'Kecepatan Dalam Menyelesaikan Pekerjaan', 0.02547, 3),
(29, 'P022', 'Tanggap dalam merespon pelanggan datang', 0.33062, 4),
(30, 'P023', 'Sopan dan Santun Terhadap Pelanggan', 0.21665, 4),
(34, 'P027', 'Komunikasi Yang Baik Dalam Pelayanan', 0.14822, 4),
(42, 'P028', 'Memahami Jobdesk', 0.14916, 4),
(43, 'P029', 'Menanggapi Keluhan Pelanggan Dengan Cepat', 0.08703, 4),
(44, 'P030', 'Berpakaian Sesuai Dengan Jobdesk', 0.04286, 4),
(45, 'P031', 'Kecepatan Dalam Menyelesaikan Jobdesk', 0.02547, 4),
(46, 'P032', 'Tanggap dalam merespon pelanggan datang', 0.33062, 5),
(47, 'P033', 'Sopan dan Santun Terhadap Pelanggan', 0.21665, 5),
(48, 'P034', 'Komunikasi Yang Baik Dalam Pelayanan', 0.14822, 5),
(49, 'P035', 'Memahami Jobdesk', 0.14916, 5),
(50, 'P036', 'Menanggapi Keluhan Pelanggan Dengan Cepat', 0.08703, 5),
(51, 'P037', 'Berpakaian Sesuai Dengan Jobdesk', 0.04286, 5),
(52, 'P038', 'Kecepatan Dalam Menyelesaikan Jobdesk', 0.02547, 5),
(53, 'P039', 'Contoh Pertanyaan', NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan_ahp`
--

CREATE TABLE `pertanyaan_ahp` (
  `id` int(11) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `id_pertanyaan_1` int(11) NOT NULL,
  `id_pertanyaan_2` int(11) NOT NULL,
  `nilai_1` float NOT NULL,
  `nilai_2` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pertanyaan_ahp`
--

INSERT INTO `pertanyaan_ahp` (`id`, `id_divisi`, `id_pertanyaan_1`, `id_pertanyaan_2`, `nilai_1`, `nilai_2`) VALUES
(203, 2, 13, 14, 7, 0.14286),
(204, 2, 13, 15, 7, 0.14286),
(205, 2, 13, 16, 1, 1),
(206, 2, 13, 17, 7, 0.14286),
(207, 2, 13, 18, 6, 0.16667),
(208, 2, 13, 19, 5, 0.2),
(209, 2, 14, 15, 5, 0.2),
(210, 2, 14, 16, 7, 0.14286),
(211, 2, 14, 17, 7, 0.14286),
(212, 2, 14, 18, 5, 0.2),
(213, 2, 14, 19, 3, 0.33333),
(214, 2, 15, 16, 5, 0.2),
(215, 2, 15, 17, 7, 0.14286),
(216, 2, 15, 18, 1, 1),
(217, 2, 15, 19, 9, 0.11111),
(218, 2, 16, 17, 7, 0.14286),
(219, 2, 16, 18, 5, 0.2),
(220, 2, 16, 19, 5, 0.2),
(221, 2, 17, 18, 7, 0.14286),
(222, 2, 17, 19, 7, 0.14286),
(223, 2, 18, 19, 3, 0.33333),
(224, 1, 2, 3, 7, 0.14286),
(225, 1, 2, 4, 7, 0.14286),
(226, 1, 2, 5, 1, 1),
(227, 1, 2, 6, 7, 0.14286),
(228, 1, 2, 7, 6, 0.16667),
(229, 1, 2, 8, 5, 0.2),
(230, 1, 3, 4, 5, 0.2),
(231, 1, 3, 5, 7, 0.14286),
(232, 1, 3, 6, 7, 0.14286),
(233, 1, 3, 7, 5, 0.2),
(234, 1, 3, 8, 3, 0.33333),
(235, 1, 4, 5, 5, 0.2),
(236, 1, 4, 6, 7, 0.14286),
(237, 1, 4, 7, 1, 1),
(238, 1, 4, 8, 9, 0.11111),
(239, 1, 5, 6, 7, 0.14286),
(240, 1, 5, 7, 5, 0.2),
(241, 1, 5, 8, 5, 0.2),
(242, 1, 6, 7, 7, 0.14286),
(243, 1, 6, 8, 7, 0.14286),
(244, 1, 7, 8, 3, 0.33333),
(273, 3, 20, 21, 7, 0.14286),
(274, 3, 20, 22, 7, 0.14286),
(275, 3, 20, 23, 1, 1),
(276, 3, 20, 24, 7, 0.14286),
(277, 3, 20, 25, 6, 0.16667),
(278, 3, 20, 26, 5, 0.2),
(279, 3, 21, 22, 5, 0.2),
(280, 3, 21, 23, 7, 0.14286),
(281, 3, 21, 24, 7, 0.14286),
(282, 3, 21, 25, 5, 0.2),
(283, 3, 21, 26, 3, 0.33333),
(284, 3, 22, 23, 5, 0.2),
(285, 3, 22, 24, 7, 0.14286),
(286, 3, 22, 25, 1, 1),
(287, 3, 22, 26, 9, 0.11111),
(288, 3, 23, 24, 7, 0.14286),
(289, 3, 23, 25, 5, 0.2),
(290, 3, 23, 26, 5, 0.2),
(291, 3, 24, 25, 7, 0.14286),
(292, 3, 24, 26, 7, 0.14286),
(293, 3, 25, 26, 3, 0.33333),
(315, 4, 29, 30, 7, 0.14286),
(316, 4, 29, 34, 7, 0.14286),
(317, 4, 29, 42, 1, 1),
(318, 4, 29, 43, 7, 0.14286),
(319, 4, 29, 44, 6, 0.16667),
(320, 4, 29, 45, 5, 0.2),
(321, 4, 30, 34, 5, 0.2),
(322, 4, 30, 42, 7, 0.14286),
(323, 4, 30, 43, 7, 0.14286),
(324, 4, 30, 44, 5, 0.2),
(325, 4, 30, 45, 3, 0.33333),
(326, 4, 34, 42, 5, 0.2),
(327, 4, 34, 43, 7, 0.14286),
(328, 4, 34, 44, 1, 1),
(329, 4, 34, 45, 9, 0.11111),
(330, 4, 42, 43, 7, 0.14286),
(331, 4, 42, 44, 5, 0.2),
(332, 4, 42, 45, 5, 0.2),
(333, 4, 43, 44, 7, 0.14286),
(334, 4, 43, 45, 7, 0.14286),
(335, 4, 44, 45, 3, 0.33333),
(385, 5, 46, 47, 7, 0.14286),
(386, 5, 46, 48, 7, 0.14286),
(387, 5, 46, 49, 1, 1),
(388, 5, 46, 50, 7, 0.14286),
(389, 5, 46, 51, 6, 0.16667),
(390, 5, 46, 52, 5, 0.2),
(391, 5, 46, 53, 1, 1),
(392, 5, 47, 48, 5, 0.2),
(393, 5, 47, 49, 7, 0.14286),
(394, 5, 47, 50, 7, 0.14286),
(395, 5, 47, 51, 5, 0.2),
(396, 5, 47, 52, 3, 0.33333),
(397, 5, 47, 53, 1, 1),
(398, 5, 48, 49, 5, 0.2),
(399, 5, 48, 50, 7, 0.14286),
(400, 5, 48, 51, 1, 1),
(401, 5, 48, 52, 9, 0.11111),
(402, 5, 48, 53, 5, 0.2),
(403, 5, 49, 50, 7, 0.14286),
(404, 5, 49, 51, 5, 0.2),
(405, 5, 49, 52, 5, 0.2),
(406, 5, 49, 53, 1, 1),
(407, 5, 50, 51, 7, 0.14286),
(408, 5, 50, 52, 7, 0.14286),
(409, 5, 50, 53, 1, 1),
(410, 5, 51, 52, 3, 0.33333),
(411, 5, 51, 53, 1, 1),
(412, 5, 52, 53, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_pelanggan` (`id_pelanggan`) USING BTREE,
  ADD KEY `id_divisi` (`id_divisi`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `nilai_ahp`
--
ALTER TABLE `nilai_ahp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_nilai_1` (`id_nilai_1`) USING BTREE,
  ADD KEY `id_nilai_2` (`id_nilai_2`) USING BTREE;

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `id_divisi` (`id_divisi`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`) USING BTREE,
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indexes for table `pelanggan_pertanyaan`
--
ALTER TABLE `pelanggan_pertanyaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pertanyaan` (`id_pertanyaan`) USING BTREE,
  ADD KEY `id_pelanggan` (`id_pelanggan`) USING BTREE,
  ADD KEY `id_nilai` (`id_nilai`) USING BTREE,
  ADD KEY `id_divisi` (`id_divisi`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`) USING BTREE;

--
-- Indexes for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`id_pertanyaan`),
  ADD KEY `pertanyaan_ibfk_1` (`id_divisi`) USING BTREE;

--
-- Indexes for table `pertanyaan_ahp`
--
ALTER TABLE `pertanyaan_ahp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pertanyaan_1` (`id_pertanyaan_1`) USING BTREE,
  ADD KEY `id_pertanyaan_2` (`id_pertanyaan_2`) USING BTREE,
  ADD KEY `id_divisi` (`id_divisi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nilai_ahp`
--
ALTER TABLE `nilai_ahp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pelanggan_pertanyaan`
--
ALTER TABLE `pelanggan_pertanyaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `id_pertanyaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `pertanyaan_ahp`
--
ALTER TABLE `pertanyaan_ahp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=413;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil`
--
ALTER TABLE `hasil`
  ADD CONSTRAINT `hasil_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `hasil_ibfk_2` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `nilai_ahp`
--
ALTER TABLE `nilai_ahp`
  ADD CONSTRAINT `nilai_ahp_ibfk_1` FOREIGN KEY (`id_nilai_1`) REFERENCES `nilai` (`id_nilai`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `nilai_ahp_ibfk_2` FOREIGN KEY (`id_nilai_2`) REFERENCES `nilai` (`id_nilai`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `pegawai_ibfk_2` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id_divisi`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `pelanggan_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `pelanggan_pertanyaan`
--
ALTER TABLE `pelanggan_pertanyaan`
  ADD CONSTRAINT `pelanggan_pertanyaan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `pelanggan_pertanyaan_ibfk_2` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan` (`id_pertanyaan`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `pelanggan_pertanyaan_ibfk_3` FOREIGN KEY (`id_nilai`) REFERENCES `nilai` (`id_nilai`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `pelanggan_pertanyaan_ibfk_4` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD CONSTRAINT `pertanyaan_ibfk_1` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id_divisi`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `pertanyaan_ahp`
--
ALTER TABLE `pertanyaan_ahp`
  ADD CONSTRAINT `pertanyaan_ahp_ibfk_1` FOREIGN KEY (`id_pertanyaan_1`) REFERENCES `pertanyaan` (`id_pertanyaan`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `pertanyaan_ahp_ibfk_2` FOREIGN KEY (`id_pertanyaan_2`) REFERENCES `pertanyaan` (`id_pertanyaan`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `pertanyaan_ahp_ibfk_3` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

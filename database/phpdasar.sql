-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2021 at 07:27 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpdasar`
--

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `npm` varchar(10) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `jurusan` varchar(20) DEFAULT NULL,
  `gambar` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `npm`, `nama`, `email`, `jurusan`, `gambar`) VALUES
(24, '20610228', 'ardhi al', 'ardhi@gmail.com', 'teknik indurstri', '60335fccdccd2.jpg'),
(25, '201610222', 'marwah', 'marwah@gmail.com', 'ekonomi', 'nama3.jpg'),
(26, '201610223', 'minel', 'minel@gmail.com', 'ekonomi', '6033606eccf65.jpg'),
(27, '201610225', 'alvin ardiansyah', 'alvinmomo@ymail.com', 'teknik informatika', 'nama2.jpg'),
(28, '201610222', 'nunu', 'nunu@gmail.com', 'kimia', 'D6xaCf9U8AEJ6ZR.jpg'),
(29, '201610244', 'gerald', 'gerald@gmail.com', 'teknik informatika', '6037697a94e9f.jpg'),
(30, '201610241', 'rizal', 'rizal@gmail.com', 'teknik lingkungan', '603769841e022.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$HzhW9WgI7hMLCRLXDCqTXewdi7R4iSbDdvTgKC.RKT.CIu5XPzw6G'),
(2, 'alvinardsn', '$2y$10$AwEWG5F.IpaaK/e5QOLUvutUrNjZyVk8R0NQe23tbghk7uPpIWNJ6'),
(3, 'nunu', '$2y$10$LcgOsvi5fYgmpZsAL9GSVOOA/4qMMVl4BgEt.y8MG8MrJVuCQ8Gt.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

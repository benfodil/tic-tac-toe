-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2021 at 01:48 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xo`
--

-- --------------------------------------------------------

--
-- Table structure for table `xo_game`
--

CREATE TABLE `xo_game` (
  `id` int(12) NOT NULL,
  `val` int(1) NOT NULL,
  `pub` int(1) NOT NULL,
  `code` int(8) NOT NULL,
  `up1` int(1) NOT NULL,
  `up2` int(1) NOT NULL,
  `p_now` int(1) NOT NULL,
  `win` int(1) NOT NULL,
  `b0` int(1) NOT NULL,
  `b1` int(1) NOT NULL,
  `b2` int(1) NOT NULL,
  `b3` int(1) NOT NULL,
  `b4` int(1) NOT NULL,
  `b5` int(1) NOT NULL,
  `b6` int(1) NOT NULL,
  `b7` int(1) NOT NULL,
  `b8` int(1) NOT NULL,
  `w0` int(1) NOT NULL,
  `w1` int(1) NOT NULL,
  `w2` int(1) NOT NULL,
  `time` timestamp(1) NOT NULL DEFAULT current_timestamp(1)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `xo_game`
--
ALTER TABLE `xo_game`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `xo_game`
--
ALTER TABLE `xo_game`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

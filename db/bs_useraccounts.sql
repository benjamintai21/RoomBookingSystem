-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2023 at 06:09 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bs_useraccounts`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_codes`
--

CREATE TABLE `tb_codes` (
  `p_id` int(11) NOT NULL,
  `p_code` varchar(20) NOT NULL,
  `discount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_codes`
--

INSERT INTO `tb_codes` (`p_id`, `p_code`, `discount`) VALUES
(9, 'project50', 50);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rooms`
--

CREATE TABLE `tb_rooms` (
  `r_ID` int(11) NOT NULL,
  `roomname` varchar(20) NOT NULL,
  `r_launch` varchar(11) NOT NULL,
  `roomsize` int(20) NOT NULL,
  `r_price` int(11) NOT NULL,
  `r_date` varchar(10) NOT NULL,
  `r_starttime` text NOT NULL,
  `r_endtime` text NOT NULL,
  `r_booked` int(11) NOT NULL,
  `rb_starttime` text NOT NULL,
  `rb_endtime` text NOT NULL,
  `UID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rooms`
--

INSERT INTO `tb_rooms` (`r_ID`, `roomname`, `r_launch`, `roomsize`, `r_price`, `r_date`, `r_starttime`, `r_endtime`, `r_booked`, `rb_starttime`, `rb_endtime`, `UID`) VALUES
(8, 'Lecture Room 3.1A', '0', 150, 100, '0', '0', '0', 0, '0', '0', 0),
(9, 'Lecture Room 4.1A', '0', 300, 200, '0', '0', '0', 0, '0', '0', 0),
(14, 'Lecture Room 1.1A', '1', 50, 231123, '191123', '0800', '1000', 0, '', '', 73),
(36, 'Lecture Room 2.1A', '0', 100, 80, '0', '0', '0', 0, '0', '0', 0),
(37, 'Lecture Room 5.1A', '0', 1000, 500, '0', '0', '0', 0, '0', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `UID` int(11) NOT NULL,
  `s_firstname` varchar(100) NOT NULL,
  `s_lastname` varchar(200) NOT NULL,
  `s_email` varchar(200) NOT NULL,
  `s_username` varchar(200) NOT NULL,
  `s_password` varchar(12) NOT NULL,
  `ADMIN` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`UID`, `s_firstname`, `s_lastname`, `s_email`, `s_username`, `s_password`, `ADMIN`) VALUES
(70, 'Benjamin', 'Tai', 'benjamin@gmail.com', 'student', 'student', 0),
(71, 'staff', 'tan', 'stafftan@gmail.com', 'staff', 'staff', 1),
(73, 'benjamin', 'tai', 'benjamin@gmail.com', 'ben', 'asdf1234', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_codes`
--
ALTER TABLE `tb_codes`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `tb_rooms`
--
ALTER TABLE `tb_rooms`
  ADD PRIMARY KEY (`r_ID`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`UID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_codes`
--
ALTER TABLE `tb_codes`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_rooms`
--
ALTER TABLE `tb_rooms`
  MODIFY `r_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

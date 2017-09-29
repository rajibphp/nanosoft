-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2017 at 09:50 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nanosoft`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `login` varchar(55) NOT NULL COMMENT 'fullName',
  `username` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `status` tinyint(2) NOT NULL COMMENT '0=inactive, 1=active',
  `role` tinyint(2) NOT NULL COMMENT '0=masterAdmin, >0=others from login_role tbl',
  `empId` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `login`, `username`, `password`, `status`, `role`, `empId`, `timestamp`) VALUES
(1, 'Master Admin', 'abhmasteradmin', 'e1e42d80cb8506c7900518ff58368ad3', 1, 1, 0, '2017-04-30 15:27:32'),
(6, 'Nanosoft', 'nanosoft', '485e3c97bce1b57a97880b769c0e214e', 1, 0, 0, '2017-09-28 08:09:30');

-- --------------------------------------------------------

--
-- Table structure for table `login_role`
--

CREATE TABLE `login_role` (
  `id` int(11) NOT NULL,
  `role` varchar(55) NOT NULL,
  `viewAcl` tinyint(4) DEFAULT NULL COMMENT '1=has permission',
  `addAcl` tinyint(4) DEFAULT NULL,
  `editAcl` tinyint(4) DEFAULT NULL,
  `deleteAcl` tinyint(4) DEFAULT NULL,
  `changeStatus` tinyint(4) DEFAULT NULL,
  `download` tinyint(4) DEFAULT NULL,
  `approveReject` tinyint(4) DEFAULT NULL,
  `allAcl` tinyint(4) DEFAULT NULL,
  `status` tinyint(2) NOT NULL COMMENT '1=fixed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_role`
--

INSERT INTO `login_role` (`id`, `role`, `viewAcl`, `addAcl`, `editAcl`, `deleteAcl`, `changeStatus`, `download`, `approveReject`, `allAcl`, `status`) VALUES
(1, 'Master Admin', 1, 1, 1, 1, 1, 1, 1, 1, 1),
(3, 'Superadmin', 1, 1, 1, 1, 1, 1, 1, 1, 0),
(4, 'Admin', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(5, 'DEMO', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(6, 'GLOBAL', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `gender` enum('Female','Male') NOT NULL COMMENT '0=male, 1=female',
  `age` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `gender`, `age`, `year`, `created_at`, `updated_at`) VALUES
(17, 'Rajib Hossain', 'Male', 310, 2015, '2017-09-29 00:55:12', '2017-09-28 19:29:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_role`
--
ALTER TABLE `login_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `login_role`
--
ALTER TABLE `login_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

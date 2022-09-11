-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 11, 2022 at 05:24 PM
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
-- Database: `yourshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `pass` varchar(20) DEFAULT NULL,
  `pp` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `roll` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `pass`, `pp`, `email`, `roll`) VALUES
(1, 'jon deo', '1122', 'my.jpg', 'example@mail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cid` int(11) NOT NULL,
  `cname` varchar(20) DEFAULT NULL,
  `sub` int(11) DEFAULT 0,
  `supsub` int(11) DEFAULT 0,
  `product` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `cname`, `sub`, `supsub`, `product`) VALUES
(10, 'Man Fashion', 4, 3, 4),
(11, 'Woman Fashion', 2, 3, 0),
(12, 'Kid Fashion', 0, 3, 0),
(13, 'Electronic', 0, 3, 0),
(14, 'Sport & Outdoor', 1, 3, 0),
(15, 'Phone', 1, 3, 0),
(16, 'kichen Accessories', 0, 3, 0),
(17, 'Smart Watch', 0, 0, 0),
(19, 'Automobile', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `eve`
--

CREATE TABLE `eve` (
  `eid` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `ooff` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `off`
--

CREATE TABLE `off` (
  `oid` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `ooff` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `oid` int(11) NOT NULL,
  `sta` int(11) DEFAULT 0,
  `pcode` varchar(20) DEFAULT NULL,
  `uid` int(11) NOT NULL,
  `addr` varchar(130) DEFAULT NULL,
  `adate` datetime NOT NULL DEFAULT current_timestamp(),
  `ddate` date DEFAULT NULL,
  `tprice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`oid`, `sta`, `pcode`, `uid`, `addr`, `adate`, `ddate`, `tprice`) VALUES
(3, 1, '63024036b1181', 1, 'khulna, boikali dhaka bangaldesh', '2022-08-10 00:00:00', '2022-08-30', 0),
(4, 1, '63024036b1182', 16, 'rundia narial sadar,naril bangladesh', '2022-08-24 00:00:00', '2022-08-31', 0),
(9, 1, '630244e61db35(1),', 1, 'dsad', '2022-09-11 14:43:01', NULL, 1440);

-- --------------------------------------------------------

--
-- Table structure for table `pdetails`
--

CREATE TABLE `pdetails` (
  `did` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `adate` datetime NOT NULL DEFAULT current_timestamp(),
  `rv` int(11) DEFAULT 0,
  `dis` varchar(500) DEFAULT NULL,
  `addinfo` varchar(100) DEFAULT NULL,
  `mupp` varchar(50) DEFAULT NULL,
  `color` varchar(40) DEFAULT NULL,
  `size` varchar(15) DEFAULT NULL,
  `sold` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pdetails`
--

INSERT INTO `pdetails` (`did`, `pid`, `adate`, `rv`, `dis`, `addinfo`, `mupp`, `color`, `size`, `sold`) VALUES
(13, 30, '2022-08-21 20:24:54', 5, 'This is a simple shart', '* 100% Cotton1\r\n* 100% Cotton\r\n* 100% Cotton', NULL, 'green,Black', 'M,XL,XXl', 0),
(15, 32, '2022-08-21 20:42:31', 7, 'This is a simple description', 'Hare is simple additional info', NULL, 'Black', 'S,M', 0),
(16, 33, '2022-08-21 20:43:53', 0, 'This is a simple description', 'Hare is simple additional info', NULL, 'Red,green,Blue,Black', 'S,M', 0),
(17, 34, '2022-08-21 20:44:54', 1, 'This is a simple description', 'Hare is simple additional info', NULL, 'green,Blue,Black', 'S,M', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pid` int(11) NOT NULL,
  `pcode` varchar(20) DEFAULT NULL,
  `pname` varchar(100) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `off` int(11) NOT NULL,
  `pp` varchar(100) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `catagory` varchar(6) NOT NULL,
  `m` int(11) NOT NULL DEFAULT 0,
  `s` int(11) NOT NULL DEFAULT 0,
  `su` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `pcode`, `pname`, `price`, `off`, `pp`, `stock`, `catagory`, `m`, `s`, `su`) VALUES
(30, '63024036b1181', 'man shart (white)', 2200, 23, 'man shart (white)163024036b1181.jpg', 22, '10,1,4', 10, 1, 4),
(32, '630244575f8c5', 'Black shoe', 2000, 11, 'Black shoe630244575f8c5.jpg', 10, '10,3', 10, 4, 0),
(33, '630244a92a960', 'Man\'s polo shart', 600, 0, 'Man\'s polo shart630244a92a960.jpg', 10, '10,1,3', 10, 1, 3),
(34, '630244e61db35', 'Mans panjabi', 1600, 10, 'Mans panjabi630244e61db35.jpg', 29, '10,4', 10, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subcata`
--

CREATE TABLE `subcata` (
  `sid` int(11) NOT NULL,
  `subname` varchar(20) DEFAULT NULL,
  `cid` int(11) NOT NULL,
  `sup` int(11) DEFAULT 0,
  `product` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcata`
--

INSERT INTO `subcata` (`sid`, `subname`, `cid`, `sup`, `product`) VALUES
(1, 'Shart', 10, 2, 3),
(2, 'Pant', 10, 0, 0),
(3, 'Shooes', 10, 0, 1),
(4, 'Panjabi', 10, 0, 1),
(7, 'lehanga', 11, 0, 0),
(8, 'shari', 11, 0, 0),
(9, 'football', 14, 0, 0),
(10, 'Samsung', 15, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sup`
--

CREATE TABLE `sup` (
  `suid` int(11) NOT NULL,
  `supname` varchar(20) DEFAULT NULL,
  `mcata` int(11) DEFAULT NULL,
  `sub` int(11) DEFAULT NULL,
  `product` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sup`
--

INSERT INTO `sup` (`suid`, `supname`, `mcata`, `sub`, `product`) VALUES
(3, 'Polo Shart', 1, 1, 1),
(4, 'Dress Shart', 1, 1, 1),
(5, 'Ball', 14, 9, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL,
  `pp` varchar(30) DEFAULT NULL,
  `adate` timestamp NOT NULL DEFAULT current_timestamp(),
  `address` varchar(100) DEFAULT NULL,
  `fav` varchar(100) DEFAULT NULL,
  `cart` varchar(100) DEFAULT NULL,
  `vkey` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `pass`, `pp`, `adate`, `address`, `fav`, `cart`, `vkey`, `status`, `phone`) VALUES
(1, 'dipto biswas', 'dip@gmail.com', 'disto', 'fds', '2022-08-08 17:19:34', 'fdsa', '32,', '34,', 'asf', 1, 0),
(16, 'dfsa dfas', 'dip@gmail.comd', 'abecffaa52f529a2b83b6612a7964b02', NULL, '2022-08-13 17:00:30', NULL, '', '', 'a2c50a963d74bde7ce48b88564f1062d1660410030', 0, 0),
(17, 'fasdf asdfas', 'dipfdsa@gmail.com', '3b712de48137572f3849aabd5666a4e3', NULL, '2022-09-11 14:57:38', NULL, NULL, NULL, '69e6129d623590d21468b79175bf11751662908258', 0, 1723763254),
(18, 'fsafas fasf', 'didp@gmail.com', '3b712de48137572f3849aabd5666a4e3', NULL, '2022-09-11 15:02:26', NULL, NULL, NULL, 'a34f4b232e668b0e88d9d03c5ad17d6d1662908546', 0, 1723763254),
(19, 'asdfasf asdfaf', 'dieep@gmail.com', '3b712de48137572f3849aabd5666a4e3', NULL, '2022-09-11 15:20:07', NULL, NULL, NULL, 'ec073ff32b8010b53c8ac83c287101011662909607', 0, 1723763254);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `eve`
--
ALTER TABLE `eve`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `off`
--
ALTER TABLE `off`
  ADD PRIMARY KEY (`oid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`oid`);

--
-- Indexes for table `pdetails`
--
ALTER TABLE `pdetails`
  ADD PRIMARY KEY (`did`),
  ADD KEY `fk_grade_id` (`pid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `subcata`
--
ALTER TABLE `subcata`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `sup`
--
ALTER TABLE `sup`
  ADD PRIMARY KEY (`suid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `eve`
--
ALTER TABLE `eve`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `off`
--
ALTER TABLE `off`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pdetails`
--
ALTER TABLE `pdetails`
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `subcata`
--
ALTER TABLE `subcata`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sup`
--
ALTER TABLE `sup`
  MODIFY `suid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pdetails`
--
ALTER TABLE `pdetails`
  ADD CONSTRAINT `fk_grade_id` FOREIGN KEY (`pid`) REFERENCES `product` (`pid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

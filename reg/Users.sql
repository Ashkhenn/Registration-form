-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 24, 2023 at 04:13 PM
-- Server version: 10.4.26-MariaDB-log
-- PHP Version: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `an`
--

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `UserId` int(11) NOT NULL,
  `FirstName` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LastName` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`UserId`, `FirstName`, `LastName`, `Email`, `Password`) VALUES
(12, 'Anna', 'Abarahmyan', 'annabrahamyan050103@gmail.com', '0313b84fcae0c10b4dc975a262d9dda0'),
(13, 'Ani', 'Abrahamyan', 'ani@gmail.com', '202cb962ac59075b964b07152d234b70'),
(14, 'Jungkook', 'Kim-Jeon', 'BTSbightooficial@gmail.com', '458aa305fd99e27859ed5302dcc26786'),
(15, 'Jungkook', 'Kim-Jeon$', 'BTSbightooficialo@gmail.com', '458aa305fd99e27859ed5302dcc26786'),
(16, '12!@$%$%$', 'anbsabs', '200312121@gmai.com', '12470fe406d44017d96eab37dd65fc14'),
(17, 'Anna', 'Abrahamyan!!!!!!!!!!!<?', 'asasa@mail.ru', 'f5bb0c8de146c67b44babbf4e6584cc0'),
(18, '123123', '123123', '123123@GMAIL.COM', '202cb962ac59075b964b07152d234b70'),
(19, 'Lilo', 'Loioi', 'lilo11@gmail.com', '202cb962ac59075b964b07152d234b70'),
(20, 'Anna', 'Abarahmyan', '123@gmail.com', '202cb962ac59075b964b07152d234b70'),
(21, 'Narine', 'Avetisyan', 'narine@mail.ru', '202cb962ac59075b964b07152d234b70'),
(22, 'Anna', 'Abrahamyan', 'anna@gmail.com', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserId`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

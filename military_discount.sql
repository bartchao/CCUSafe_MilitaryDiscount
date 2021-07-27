-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-07-27 06:16:40
-- 伺服器版本： 10.4.19-MariaDB
-- PHP 版本： 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `military_discount`
--

-- --------------------------------------------------------

--
-- 資料表結構 `course`
--

CREATE TABLE `course` (
  `CourseId` int(11) NOT NULL,
  `CourseName` varchar(45) NOT NULL,
  `Enable` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `course`
--

INSERT INTO `course` (`CourseId`, `CourseName`, `Enable`) VALUES
(1, '軍訓', 1),
(2, '三軍概要', 1),
(3, '孫子兵法', 1),
(4, '國防科技簡介', 1),
(5, '全民國防教育軍事訓練課程(軍訓)—國防科技', 1),
(6, '全民國防教育軍事訓練課程(軍訓)—國際情勢', 1),
(7, '全民國防教育軍事訓練課程(軍訓)—全民國防', 1),
(8, '全民國防教育軍事訓練課程(軍訓)—國防政策', 1),
(9, '全民國防教育軍事訓練課程(軍訓)—防衛動員', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `records`
--

CREATE TABLE `records` (
  `RecordId` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Grade` varchar(20) NOT NULL,
  `StudentId` varchar(10) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `DiscountDays` int(11) NOT NULL,
  `BirthDate` date NOT NULL,
  `ApplyDate` date NOT NULL,
  `CreateTime` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `records_course`
--

CREATE TABLE `records_course` (
  `TableId` int(11) NOT NULL,
  `RecordId` int(11) NOT NULL,
  `CourseId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `records_images`
--

CREATE TABLE `records_images` (
  `TableId` int(11) NOT NULL,
  `RecordId` int(11) NOT NULL,
  `ImagePath` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`CourseId`);

--
-- 資料表索引 `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`RecordId`);

--
-- 資料表索引 `records_course`
--
ALTER TABLE `records_course`
  ADD PRIMARY KEY (`TableId`),
  ADD KEY `record exist` (`RecordId`),
  ADD KEY `course exist` (`CourseId`);

--
-- 資料表索引 `records_images`
--
ALTER TABLE `records_images`
  ADD PRIMARY KEY (`TableId`),
  ADD KEY `records_images` (`RecordId`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `course`
--
ALTER TABLE `course`
  MODIFY `CourseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `records`
--
ALTER TABLE `records`
  MODIFY `RecordId` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `records_course`
--
ALTER TABLE `records_course`
  MODIFY `TableId` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `records_images`
--
ALTER TABLE `records_images`
  MODIFY `TableId` int(11) NOT NULL AUTO_INCREMENT;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `records_course`
--
ALTER TABLE `records_course`
  ADD CONSTRAINT `course exist` FOREIGN KEY (`CourseId`) REFERENCES `course` (`CourseId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `record exist` FOREIGN KEY (`RecordId`) REFERENCES `records` (`RecordId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- 資料表的限制式 `records_images`
--
ALTER TABLE `records_images`
  ADD CONSTRAINT `records_images` FOREIGN KEY (`RecordId`) REFERENCES `records` (`RecordId`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

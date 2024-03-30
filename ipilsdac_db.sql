-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 17, 2024 at 02:59 AM
-- Server version: 5.7.44-cll-lve
-- PHP Version: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ipilsdac_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_acadcon`
--

CREATE TABLE `tbl_acadcon` (
  `acadcon_id` int(11) NOT NULL,
  `acad_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `min` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_acadcon`
--

INSERT INTO `tbl_acadcon` (`acadcon_id`, `acad_id`, `grade_id`, `sub_id`, `min`) VALUES
(4, 1, 1, 1, '50'),
(5, 1, 1, 4, '50'),
(6, 1, 1, 5, '50'),
(7, 1, 1, 2, '40'),
(8, 1, 1, 6, '40'),
(9, 1, 1, 3, '45'),
(10, 1, 2, 1, '50'),
(11, 1, 2, 4, '50'),
(12, 1, 2, 5, '50'),
(13, 1, 2, 2, '40'),
(14, 1, 2, 6, '40'),
(15, 1, 2, 3, '45'),
(16, 1, 3, 1, '50'),
(17, 1, 3, 2, '50'),
(18, 1, 3, 3, '50'),
(19, 1, 3, 4, '50'),
(20, 1, 3, 5, '50'),
(21, 1, 3, 6, '50'),
(22, 1, 3, 7, '50'),
(23, 1, 4, 1, '50'),
(24, 1, 4, 4, '50'),
(25, 1, 4, 5, '50'),
(26, 1, 4, 6, '50'),
(27, 1, 4, 7, '50'),
(28, 1, 4, 2, '40'),
(29, 1, 4, 8, '40'),
(30, 1, 4, 9, '40'),
(31, 1, 5, 1, '50'),
(32, 1, 5, 4, '50'),
(33, 1, 5, 5, '50'),
(34, 1, 5, 6, '50'),
(35, 1, 5, 7, '50'),
(36, 1, 5, 2, '40'),
(37, 1, 5, 8, '40'),
(38, 1, 5, 10, '40'),
(39, 1, 6, 1, '50'),
(40, 1, 6, 4, '50'),
(41, 1, 6, 5, '50'),
(42, 1, 6, 7, '50'),
(43, 1, 6, 9, '50'),
(44, 1, 6, 2, '40'),
(45, 1, 6, 6, '40'),
(46, 1, 6, 8, '40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_academic`
--

CREATE TABLE `tbl_academic` (
  `acad_id` int(11) NOT NULL,
  `sy_id` int(11) NOT NULL,
  `program_name` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL,
  `stat_prep` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_academic`
--

INSERT INTO `tbl_academic` (`acad_id`, `sy_id`, `program_name`, `status`, `stat_prep`) VALUES
(1, 2, 'CLASS OF 2024-2025', 'Active', 'Done'),
(2, 3, 'CLASS OF 2025 - 2026', 'Inactive', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account`
--

CREATE TABLE `tbl_account` (
  `account_id` int(11) NOT NULL,
  `teach_id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_account`
--

INSERT INTO `tbl_account` (`account_id`, `teach_id`, `stud_id`, `email`, `password`, `type`) VALUES
(2, 1, 0, 'anonymousblackexcile@gmail.com', 'Torayno123', 'teacher'),
(3, 2, 0, 'ginalynbargo@gmail.com', 'c8I463Eq', 'teacher'),
(4, 3, 0, 'ecelynmandalupa123@gmail.com', 'wWSELopy', 'teacher'),
(5, 4, 0, 'nicetolentino96@gmail.com', 'r5_BTt2y', 'teacher'),
(19, 5, 0, 'abajararnelyn13@gmail.com', 'B$IqE2j&', 'teacher'),
(20, 6, 0, 'lilybethcedron@gmail.com', '!Z_gp#U2', 'teacher'),
(21, 0, 1, 'anonymousblackexcile@gmail.com', 'torayno123', 'Student'),
(22, 0, 2, 'berondojeffrey7@gmail.com', 'Berond15', 'Student'),
(23, 0, 3, 'ipilht202000187@wmsu.edu.ph', 'esterlita123', 'Student'),
(24, 0, 4, 'jufellucero@gmail.com', 'loyloy091234567', 'Student'),
(25, 0, 5, 'jufellucero@gmail.com', 'loyloy09123', 'Student'),
(26, 0, 6, 'tomodiane40@gmail.com', 'diane123', 'Student'),
(27, 0, 7, 'liezjocson2002@gmail.com', 'liezle123', 'Student'),
(28, 0, 8, 'yummymawi@gmail.com', 'yummy123', 'Student'),
(29, 0, 9, 'bicerajunne@gmail.com', '123123', 'Student'),
(30, 0, 10, 'tamparongclaire15@gmail.com', 'claire123', 'Student'),
(31, 0, 10, 'tamparongclaire15@gmail.com', 'claire123', 'Student'),
(32, 0, 11, 'cedrikjanbicera@gmail.com', '123412', 'Student'),
(33, 0, 12, 'anthonytorayno3@gmail.com', 'torayno123', 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_enroll`
--

CREATE TABLE `tbl_enroll` (
  `enroll_id` int(11) NOT NULL,
  `sy_id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `acad_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `stat_enroll` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_enroll`
--

INSERT INTO `tbl_enroll` (`enroll_id`, `sy_id`, `stud_id`, `acad_id`, `grade_id`, `section_id`, `status`, `stat_enroll`, `date`) VALUES
(1, 2, 1, 1, 1, 1, 'Regular', 'Enrolled', '2024-03-08'),
(2, 2, 3, 1, 1, 1, 'Regular', 'Enrolled', '2024-03-08'),
(3, 2, 5, 1, 1, 1, 'Regular', 'Enrolled', '2024-03-08'),
(4, 2, 6, 1, 1, 1, 'Regular', 'Enrolled', '2024-03-08'),
(5, 2, 7, 1, 1, 1, 'Regular', 'Enrolled', '2024-03-08'),
(6, 2, 8, 1, 1, 1, 'Regular', 'Pre-Enroll', '2024-03-08'),
(7, 2, 10, 1, 1, 1, 'Regular', 'Pre-Enroll', '2024-03-08'),
(8, 2, 9, 1, 1, 1, 'Regular', 'Pre-Enroll', '2024-03-08'),
(9, 2, 11, 1, 1, 1, 'Regular', 'Pre-Enroll', '2024-03-08'),
(10, 2, 12, 1, 1, 1, 'Regular', 'Pre-Enroll', '2024-03-16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_enrollsub`
--

CREATE TABLE `tbl_enrollsub` (
  `ensub_id` int(11) NOT NULL,
  `enroll_id` int(11) NOT NULL,
  `sy_id` int(11) NOT NULL,
  `acad_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `sched_id` int(11) NOT NULL,
  `load_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_enrollsub`
--

INSERT INTO `tbl_enrollsub` (`ensub_id`, `enroll_id`, `sy_id`, `acad_id`, `grade_id`, `sub_id`, `sched_id`, `load_id`) VALUES
(1, 1, 2, 1, 1, 1, 5, 1),
(2, 1, 2, 1, 1, 2, 6, 2),
(3, 1, 2, 1, 1, 3, 7, 3),
(4, 1, 2, 1, 1, 4, 8, 4),
(5, 1, 2, 1, 1, 5, 9, 5),
(6, 1, 2, 1, 1, 6, 10, 6),
(7, 2, 2, 1, 1, 1, 5, 1),
(8, 2, 2, 1, 1, 2, 6, 2),
(9, 2, 2, 1, 1, 3, 7, 3),
(10, 2, 2, 1, 1, 4, 8, 4),
(11, 2, 2, 1, 1, 5, 9, 5),
(12, 2, 2, 1, 1, 6, 10, 6),
(13, 3, 2, 1, 1, 1, 5, 1),
(14, 3, 2, 1, 1, 2, 6, 2),
(15, 3, 2, 1, 1, 3, 7, 3),
(16, 3, 2, 1, 1, 4, 8, 4),
(17, 3, 2, 1, 1, 5, 9, 5),
(18, 3, 2, 1, 1, 6, 10, 6),
(19, 7, 2, 1, 1, 1, 5, 1),
(20, 7, 2, 1, 1, 2, 6, 2),
(21, 7, 2, 1, 1, 3, 7, 3),
(22, 7, 2, 1, 1, 4, 8, 4),
(23, 7, 2, 1, 1, 5, 9, 5),
(24, 7, 2, 1, 1, 6, 10, 6),
(25, 4, 2, 1, 1, 1, 5, 1),
(26, 4, 2, 1, 1, 2, 6, 2),
(27, 4, 2, 1, 1, 3, 7, 3),
(28, 4, 2, 1, 1, 4, 8, 4),
(29, 4, 2, 1, 1, 5, 9, 5),
(30, 4, 2, 1, 1, 6, 10, 6),
(31, 5, 2, 1, 1, 1, 5, 1),
(32, 5, 2, 1, 1, 2, 6, 2),
(33, 5, 2, 1, 1, 3, 7, 3),
(34, 5, 2, 1, 1, 4, 8, 4),
(35, 5, 2, 1, 1, 5, 9, 5),
(36, 5, 2, 1, 1, 6, 10, 6),
(37, 6, 2, 1, 1, 1, 5, 1),
(38, 6, 2, 1, 1, 2, 6, 2),
(39, 6, 2, 1, 1, 3, 7, 3),
(40, 6, 2, 1, 1, 4, 8, 4),
(41, 6, 2, 1, 1, 5, 9, 5),
(42, 6, 2, 1, 1, 6, 10, 6),
(43, 6, 2, 1, 1, 1, 5, 1),
(44, 6, 2, 1, 1, 2, 6, 2),
(45, 6, 2, 1, 1, 3, 7, 3),
(46, 6, 2, 1, 1, 4, 8, 4),
(47, 6, 2, 1, 1, 5, 9, 5),
(48, 6, 2, 1, 1, 6, 10, 6),
(49, 8, 2, 1, 1, 1, 5, 1),
(50, 8, 2, 1, 1, 2, 6, 2),
(51, 8, 2, 1, 1, 3, 7, 3),
(52, 8, 2, 1, 1, 4, 8, 4),
(53, 8, 2, 1, 1, 5, 9, 5),
(54, 8, 2, 1, 1, 6, 10, 6),
(55, 9, 2, 1, 1, 1, 5, 1),
(56, 9, 2, 1, 1, 2, 6, 2),
(57, 9, 2, 1, 1, 3, 7, 3),
(58, 9, 2, 1, 1, 4, 8, 4),
(59, 9, 2, 1, 1, 5, 9, 5),
(60, 9, 2, 1, 1, 6, 10, 6),
(61, 10, 2, 1, 1, 1, 5, 1),
(62, 10, 2, 1, 1, 2, 6, 2),
(63, 10, 2, 1, 1, 3, 7, 3),
(64, 10, 2, 1, 1, 4, 8, 4),
(65, 10, 2, 1, 1, 5, 9, 5),
(66, 10, 2, 1, 1, 6, 10, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event`
--

CREATE TABLE `tbl_event` (
  `event_id` int(11) NOT NULL,
  `event_date` varchar(100) NOT NULL,
  `event_title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_event`
--

INSERT INTO `tbl_event` (`event_id`, `event_date`, `event_title`, `description`, `date`) VALUES
(8, '2024-03-11', 'Music Festival', 'School celebrate music festival on this month', '2024-03-08'),
(9, '2024-03-18', 'Sportfest', 'School celebrate sportfest on this month', '2024-03-08'),
(10, '2024-03-28', 'MAUNDAY THURSDAY', 'Maundy Thursday marks the event before Jesus Christ was crucified on the cross. Aside from fasting, most Filipinos refrain from activities such as drinking alcohol, eating meat and intercourse with their partners. Maundy Thursday is highlighted by the re-enactment of the Last Supper, which is organized by churches.', '2024-03-08'),
(11, '2024-03-29', 'GOOD FRIDAY', 'Good Friday is a Christian holiday commemorating the crucifixion of Jesus and his death at Calvary. It is observed during Holy Week as part of the Paschal Triduum. It is also known as Holy Friday, Great Friday, Great and Holy Friday, and Black Friday.', '2024-03-08'),
(13, '2024-05-01', 'LABOR DAY', 'Also known as \"Araw ng Manggagawa,\" Labor Day is a regular holiday in the Philippines and is celebrated every first of May. Other countries in the world also celebrate on the same date, and it is sometimes known as May Day. Such a worldwide celebration began with the eight-hour workday movement.', '2024-03-08'),
(15, '2024-04-01', 'AAA Evaluation , NDM', 'The Accrediting Association of Seventh-day Adventist Schools is\r\nthe accrediting body established by the Seventh-day Adventist Church to provide coordination,\r\nsupervision, and quality control of its education system. It is responsible for evaluating the\r\nimplementation of the Seventh-day Adventist philosophy of education in order to foster the unity\r\nand mission of the Church.', '2024-03-09'),
(16, '2024-04-09', 'Holiday ( Araw ng Kagitingan )', 'The Day of Valor, officially known as Araw ng Kagitingan, is a national observance in the Philippines which commemorates the fall of Bataan to Japanese troops during World War II.', '2024-03-09'),
(17, '2024-04-15', 'Kids for Jesus ( Season 2 )', 'Join us for fun Sabbath songs, exciting nature nuggets, interesting mission stories from around the world and each week\'s Sabbath School lesson!', '2024-03-09'),
(18, '2024-04-22', 'AAA EVALUATION , DM', 'This is official recognition by the Seventh-day Adventist church and is used to determine whether schools may apply for church funding. Its process support services, religious course material and the makeup of the teaching staff.', '2024-03-09'),
(19, '2024-03-25', 'NATIONAL HOLIDAY', 'NO CLASS', '2024-03-09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fee`
--

CREATE TABLE `tbl_fee` (
  `fee_id` int(11) NOT NULL,
  `sy_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `fee` varchar(200) NOT NULL,
  `amount` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_fee`
--

INSERT INTO `tbl_fee` (`fee_id`, `sy_id`, `grade_id`, `fee`, `amount`) VALUES
(1, 2, 1, 'ENTRANCE FEE', '3500'),
(2, 2, 2, 'ENTRANCE FEE', '3500'),
(3, 2, 3, 'ENTRANCE FEE', '3500'),
(4, 2, 4, 'ENTRANCE FEE', '3500'),
(5, 2, 5, 'ENTRANCE FEE', '3500'),
(6, 2, 6, 'ENTRANCE FEE', '3500'),
(7, 2, 1, 'TUITION FEE', '12100'),
(8, 2, 2, 'TUITION FEE', '12100'),
(9, 2, 3, 'TUITION FEE', '12100'),
(10, 2, 4, 'TUITION FEE', '12100'),
(11, 2, 5, 'TUITION FEE', '12100'),
(12, 2, 6, 'TUITION FEE', '12100'),
(13, 2, 1, 'HSF/PTA', '300'),
(14, 2, 2, 'HSF/PTA', '300'),
(15, 2, 3, 'HSF/PTA', '300'),
(16, 2, 4, 'HSF/PTA', '300'),
(17, 2, 5, 'HSF/PTA', '300'),
(18, 2, 6, 'HSF/PTA', '300'),
(19, 2, 1, 'BOOKS', '3256'),
(20, 2, 2, 'BOOKS', '3371'),
(21, 2, 3, 'BOOKS', '4241'),
(22, 2, 4, 'BOOKS', '4311'),
(23, 2, 5, 'BOOKS', '4161'),
(24, 2, 6, 'BOOKS', '4165'),
(25, 2, 2, 'TUITION FEE', '500');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gradelevel`
--

CREATE TABLE `tbl_gradelevel` (
  `grade_id` int(11) NOT NULL,
  `grade` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_gradelevel`
--

INSERT INTO `tbl_gradelevel` (`grade_id`, `grade`) VALUES
(1, 'GRADE 1'),
(2, 'GRADE 2'),
(3, 'GRADE 3'),
(4, 'GRADE 4'),
(5, 'GRADE 5'),
(6, 'GRADE 6');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grades`
--

CREATE TABLE `tbl_grades` (
  `grades_id` int(11) NOT NULL,
  `ensub_id` int(11) NOT NULL,
  `first_quarter` varchar(50) NOT NULL,
  `second_quarter` varchar(50) NOT NULL,
  `third_quarter` varchar(50) NOT NULL,
  `fourth_quarter` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gradstat`
--

CREATE TABLE `tbl_gradstat` (
  `gradstat_id` int(11) NOT NULL,
  `sched_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_load`
--

CREATE TABLE `tbl_load` (
  `load_id` int(11) NOT NULL,
  `sy_id` int(11) NOT NULL,
  `teach_id` int(11) NOT NULL,
  `sched_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_load`
--

INSERT INTO `tbl_load` (`load_id`, `sy_id`, `teach_id`, `sched_id`) VALUES
(1, 2, 1, 5),
(2, 2, 1, 6),
(3, 2, 1, 7),
(4, 2, 1, 8),
(5, 2, 1, 9),
(6, 2, 1, 10),
(7, 2, 2, 11);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notif`
--

CREATE TABLE `tbl_notif` (
  `notif_id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `enroll_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_notif`
--

INSERT INTO `tbl_notif` (`notif_id`, `stud_id`, `enroll_id`, `message`, `status`, `date`) VALUES
(1, 1, 1, 'Your application has been approved. Please go to the school and and pay the obligation. Thank you.', 'Closed', '2024-03-08'),
(2, 3, 2, 'Your application has been approved. Please go to the school and and pay the obligation. Thank you.', 'Closed', '2024-03-08'),
(3, 5, 3, 'Your application has been approved. Please go to the school and and pay the obligation. Thank you.', 'Closed', '2024-03-08'),
(4, 10, 7, 'Your application has been approved. Please go to the school and and pay the obligation. Thank you.', 'Closed', '2024-03-08'),
(5, 6, 4, 'Your application has been approved. Please go to the school and and pay the obligation. Thank you.', 'Closed', '2024-03-08'),
(6, 7, 5, 'Your application has been approved. Please go to the school and and pay the obligation. Thank you.', 'Closed', '2024-03-08'),
(7, 8, 6, 'Your application has been approved. Please go to the school and and pay the obligation. Thank you.', 'Closed', '2024-03-08'),
(8, 8, 6, 'Your application has been approved. Please go to the school and and pay the obligation. Thank you.', 'Closed', '2024-03-08'),
(9, 9, 8, 'Your application has been approved. Please go to the school and and pay the obligation. Thank you.', 'Closed', '2024-03-08'),
(10, 11, 9, 'Your application has been approved. Please go to the school and and pay the obligation. Thank you.', 'Closed', '2024-03-08'),
(11, 12, 10, 'Your application has been approved. Please go to the school and and pay the obligation. Thank you.', 'Closed', '2024-03-16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_official`
--

CREATE TABLE `tbl_official` (
  `official_id` int(11) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_no` varchar(200) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `photo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_official`
--

INSERT INTO `tbl_official` (`official_id`, `firstname`, `lastname`, `address`, `email`, `contact_no`, `gender`, `position`, `photo`) VALUES
(2, 'ERNA', 'FRANCO', 'IPIL ZAMBOANGA SIBUGAY', 'erma.tangso.franco@gmail.com', '09173200581', 'Female', 'School Principal', 'erna franco (2).jpg'),
(3, 'ECELYN', 'MANDALUPA', 'TIAYON, IPIL ZAMBOANGA SIBUGAY', 'ecelynmandalupa123@gmail.com', '09358466642', 'Female', 'Grade 1', 'ecelyn.png'),
(4, 'WINCEY ', 'FAUSTINO', 'SANITO, IPIL, ZAMBOANGA SIBUGAY', 'nicetolentino96@gmail.com', '09562611580', 'Female', 'Grade 5', 'wincey.png'),
(5, 'GINALYN ', 'MARCELINO', 'SANITO , IPIL, ZAMBOANGA SIBUGAY', 'ginalynbargo@gmail.com', '09368740697', 'Female', 'Kinder Adviser', 'ginalyn marcelino.jpg'),
(6, 'ARNELYN ', 'ABAJAR', 'Baluran, Tungawan Zamboanga Sibugay', 'abajararnelyn13@gmail.com', '09354222628', 'Female', 'Grade 2', 'arnelyn abajar (2).jpg'),
(7, 'LILYBETH ', 'CEDRON', 'PANGI, IPIL ZAMBOANGA SIBUGAY', 'lilybethcedron@gmail.com', '09974220190', 'Female', 'Grade 3', 'lilybeth cedron (2).jpg'),
(8, 'PERLIE ', 'PALIN', 'TAWAY, IPIL ZAMBOANGA SIBUGAY', 'pearl3.palin@gmail.com', '09978637863', 'Female', 'Grade 6', 'perlie palin (2).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room`
--

CREATE TABLE `tbl_room` (
  `room_id` int(11) NOT NULL,
  `room` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_room`
--

INSERT INTO `tbl_room` (`room_id`, `room`) VALUES
(1, 'ROOM 1'),
(2, 'ROOM 2'),
(3, 'ROOM 3'),
(4, 'ROOM 4'),
(5, 'ROOM 5'),
(6, 'ROOM 6'),
(7, 'COMPUTER LABORATORY');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedule`
--

CREATE TABLE `tbl_schedule` (
  `sched_id` int(11) NOT NULL,
  `sy_id` int(11) NOT NULL,
  `acad_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `teach_id` int(11) NOT NULL,
  `class_size` varchar(50) NOT NULL,
  `day` varchar(50) NOT NULL,
  `time_start` varchar(50) NOT NULL,
  `time_end` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_schedule`
--

INSERT INTO `tbl_schedule` (`sched_id`, `sy_id`, `acad_id`, `grade_id`, `sub_id`, `section_id`, `room_id`, `teach_id`, `class_size`, `day`, `time_start`, `time_end`) VALUES
(5, 2, 1, 1, 1, 1, 1, 1, '25', 'M-F', '08:30 AM', '09:20 AM'),
(6, 2, 1, 1, 2, 1, 1, 1, '25', 'M-F', '09:35 AM', '10:15 AM'),
(7, 2, 1, 1, 3, 1, 1, 1, '25', 'M-F', '10:15 AM', '11:00 AM'),
(8, 2, 1, 1, 4, 1, 1, 1, '25', 'M-F', '01:00 PM', '01:50 PM'),
(9, 2, 1, 1, 5, 1, 1, 1, '25', 'M-F', '01:50 PM', '02:40 PM'),
(10, 2, 1, 1, 6, 1, 1, 1, '25', 'M-F', '02:40 PM', '03:20 PM'),
(11, 2, 1, 2, 1, 2, 2, 2, '25', 'M-F', '08:30 AM', '09:20 AM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schoolyear`
--

CREATE TABLE `tbl_schoolyear` (
  `sy_id` int(11) NOT NULL,
  `start_year` int(11) NOT NULL,
  `end_year` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_schoolyear`
--

INSERT INTO `tbl_schoolyear` (`sy_id`, `start_year`, `end_year`, `status`) VALUES
(2, 2024, 2025, 'Active'),
(3, 2025, 2026, 'Inactive'),
(4, 2026, 2027, 'Inactive'),
(5, 2027, 2028, 'Inactive'),
(6, 2028, 2029, 'Inactive'),
(7, 2029, 2030, 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_section`
--

CREATE TABLE `tbl_section` (
  `section_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `section` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_section`
--

INSERT INTO `tbl_section` (`section_id`, `grade_id`, `section`) VALUES
(1, 1, 'DIAMOND'),
(2, 2, 'EARTH'),
(3, 3, 'CARBON'),
(4, 4, 'NARRA'),
(5, 5, 'MARLIN'),
(6, 6, 'STAGHORN CORAL');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `slider_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(200) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_slider`
--

INSERT INTO `tbl_slider` (`slider_id`, `title`, `description`, `photo`, `date`) VALUES
(3, 'Moving Up Ceremony', 'IPIL SDA ELEMENTARY SCHOOL Covid Version AWARDING 2019-2020 . Thank you for coming parents and students!!!', '123456.jpg', '2023-11-26'),
(4, 'CONGRATULATIONS GRADUATES!', 'We are Praying for your good achievements and a lot more fun and lesson in your new journey.. God speed!', '12345.jpg', '2023-11-26'),
(5, 'Join our Melody of Help and Compassion', 'come one, come all! lets help build ideas through your love gifts and donations', '1234.jpg', '2023-11-26'),
(7, 'School Site', 'IPIL SDA', '411062382_253249877665152_1411862710580008926_n.jpg', '2024-02-09'),
(8, 'BONIFACIO DAY', 'HOLIDAY FOR DEC 30, 2024', 'download.jpeg', '2024-02-27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `stud_id` int(11) NOT NULL,
  `stud_no` varchar(50) NOT NULL,
  `psa_no` varchar(200) NOT NULL,
  `lrn_number` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `ext_name` varchar(50) NOT NULL,
  `birth_date` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `mother_tongue` varchar(100) NOT NULL,
  `tribe` varchar(50) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `father_email` varchar(100) NOT NULL,
  `father_contact` varchar(50) NOT NULL,
  `mother_name` varchar(100) NOT NULL,
  `mother_email` varchar(100) NOT NULL,
  `mother_contact` varchar(50) NOT NULL,
  `guardian_name` varchar(100) NOT NULL,
  `guardian_email` varchar(100) NOT NULL,
  `guardian_contact` varchar(100) NOT NULL,
  `guard_stat` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `activation` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`stud_id`, `stud_no`, `psa_no`, `lrn_number`, `firstname`, `lastname`, `middlename`, `ext_name`, `birth_date`, `gender`, `address`, `religion`, `mother_tongue`, `tribe`, `father_name`, `father_email`, `father_contact`, `mother_name`, `mother_email`, `mother_contact`, `guardian_name`, `guardian_email`, `guardian_contact`, `guard_stat`, `password`, `activation`) VALUES
(1, '202403-001', '545511124', '11452151', 'ALYSSA', 'ANUARODIN', 'TORAYNO', '', '2017-04-28', 'FEMALE', 'MAGDAUP, IPIL ZAMBOANGA SIBUGAY', 'ISLAM', 'CEBUANO', 'MUSLIM', 'JEDRICK ANUARODIN', 'anonymousblackexcile@gmail.com', '09978637863', 'MELANY TORAYNO', 'anonymousblackexcile@gmail.com', '09978637863', 'MELANY TORAYNO', 'anonymousblackexcile@gmail.com', '09978637863', 'Active', 'torayno123', '023f70dca78041337dc4a0e0bbc84b10'),
(2, '202403-002', '11323222', '1221215215', 'JEFFREY ', 'BERONDO ', 'FERNANDEZ', '', '2017-11-15', 'MALE', 'MAGDAUP, IPIL ZAMBOANGA SIBUGAY', 'ROMAN CATHOLIC', 'CEBUANO', 'SUBANEN', 'JULITO BERONDO', 'berondojeffrey7@gmail.com', '09974726871', 'ROSARIO FERNANDEZ', 'berondojeffrey7@gmail.com', '09974726871', 'PERLA', 'berondojeffrey7@gmail.com', '09974726871', 'Active', 'Berond15', '87d4f1a69cce765f17390197865f1a33'),
(3, '202403-003', '121544455', '1541214244', 'JAY', 'BERONDO', 'LIMBUAN', '', '2017-01-29', 'MALE', 'TIMALANG, IPIL ZAMBOANGA SIBUGAY', 'ROMAN CATHOLIC', 'CEBUANO', 'SUBANEN', 'SIXTO BERONDO', 'ipilht202000187@wmsu.edu.ph', '09943640376', 'ESTERLITA BERONDO', 'ipilht202000187@wmsu.edu.ph', '09943640376', 'ESTERLITA BERONDO', 'ipilht202000187@wmsu.edu.ph', '09943640376', 'Active', 'esterlita123', 'cd4b4e54b785d1d07bf2935b6284eeb8'),
(4, '202403-004', '', '', 'John', 'Bonsh', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Rita bonsh', 'jufellucero@gmail.com', '09939377114', 'Active', 'loyloy091234567', 'c20fcbdb540a1daed928b6de283dd256'),
(5, '202403-005', '952512245425', '54854555285', 'JUFEL ', 'LUCERO ', 'CANONES', '', '2017-03-09', 'MALE', 'PRK GUMA', 'ROMAN CATHOLIC', 'BISAYA', 'BISAYA', 'JOHN MAR LUCERO', 'jufellucero@gmail.com', '09939377114', 'OFELIA LUCERO ', 'jufellucero@gmail.com', '09939377114', 'OFELIA LUCERO ', 'jufellucero@gmail.com', '09939377114', 'Active', 'loyloy09123', '9ae8f0f2de04aa0812598652495914b7'),
(6, '202403-006', '', '224677', 'DAN', 'TOMO', '', '', '3013-12-03', 'MALE', 'PSLOMOC TITAY ZAMBOANGA SIBUGAY', 'ROMAN CATHOLIC', 'CEBUANAO', 'SUBANANEN', 'MAR TOMO', 'tomodiane40@gmail.com', '09090224005', 'DIANE TOMO', 'tomodiane40@gmail.com', '09090224005', 'DIANE TOMO', 'tomodiane40@gmail.com', '09090224005', 'Active', 'diane123', '94e4fb3a6d39983e25c56bf148d7c1c0'),
(7, '202403-007', '', '23357', 'CARLOS ', 'NUNEZ', '', '', '2014-09-14', 'MALE', 'NEW CALAMBA ZAMBOANGA DEL NORTE', 'ROMAN CATHOLIC', 'CEBUANAO', 'FILIPINO', 'BONG NUNEZ', 'liezjocson2002@gmail.com', '09090224005', 'SUSAN MALANOG', 'liezjocson2002@gmail.com', '09090224005', 'SUSAN MALANOG', 'liezjocson2002@gmail.com', '09090224005', 'Active', 'liezle123', '1faaa490304c6710ef5a5a1fa9e89f6d'),
(8, '202403-008', '', '234567', 'KAREN', 'PADILLA', 'PNAGLIMA', '', '2013-10-17', 'FEMALE', 'PALOMOC TITAY ZAMBOANGA SIBUGAY', 'ROMAN CATHOLIC', 'CEBUANO', 'FILIPNO', 'ALDRIN PADILLA', 'yummymawi@gmail.com', '09090224005', 'MARITES PADILLA', 'yummymawi@gmail.com', '09090224005', 'MARITES PADILLA', 'yummymawi@gmail.com', '09090224005', 'Active', 'yummy123', '225ba6500b92caaff6c3f29d32aa5543'),
(9, '202403-009', '2546', '21655487944', 'DEZNE', 'BICERA', 'APOLINARIO', '', '2010-03-09', 'FEMALE', 'IPILHEIGTHS', 'SEVENTH DAY ADVENTIST', 'BISAYA', 'BISAYA', 'CARLO BICERA', 'bicerajunne@gmail.com', '09977239659', 'DEZAMAE BICERA', 'bicerajunne@gmail.com', '09965543269', 'CARLO BICERA', 'bicerajunne@gmail.com', '09977239659', 'Active', '123123', 'b9dba75c24abecd7d8897f8961621a1c'),
(10, '202403-009', '', '345677', 'MAURETTE', 'TAMPARONG', '', '', '2015-12-14', 'FEMALE', 'GATAS ZAMBNGA SIBUGAY', 'ROMAN CATHOLIC', 'CEBUANO', 'SUBANEN', 'RIDDEN BORLAS', 'tamparongclaire15@gmail.com', '09090224009', 'CLAIRE TAMPARONG', 'tamparongclaire15@gmail.com', '09090224009', 'CLAIRE TAMPARONG', 'tamparongclaire15@gmail.com', '09090224005', 'Active', 'claire123', 'c29642668c949f26aa9c779696f7b2f6'),
(11, '202403-010', '6653', '52466987894', 'TRIXTY FEOLYN', 'BICERA', 'CASIPONG', '', '2011-03-09', 'FEMALE', 'TITAY, ZAMBOANGA SIBUGAY', 'SEVENTH DAY ADVENTIST', 'BISAYA', 'FILIPINO', 'CEDRIC BICERA', 'cedrikjanbicera@gmail.com', '09459834102', 'SAM CASIPONG', 'cedrikjanbicera@gmail.com', '09886754265', 'CEDRIC BICERA', 'cedrikjanbicera@gmail.com', '09459834102', 'Active', '123412', 'a68cb95353f80a70d58ab3048cb06565'),
(12, '202403-011', '44484545', '4421241', 'ANTHONY', 'TORAYNO ', 'BERONDO', 'JR', '2017-09-20', 'MALE', 'MAGDAUP, IPIL ZAMBOANGA SIBUGAY', 'ROMAN CATHOLIC', 'CEBUANO', 'SUBANEN', 'ANTHONY TORAYNO SR', 'anthonytorayno3@gmail.com', '09978637863', 'PERLA SARANILLO BERONDO', 'anthonytorayno3@gmail.com', '09978637863', 'ANTHONY TORAYNO SR', 'anthonytorayno3@gmail.com', '09978637863', 'Active', 'torayno123', '2c415dfbca5b4c577998e6c4c3730954');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_studentpay`
--

CREATE TABLE `tbl_studentpay` (
  `studpay_id` int(11) NOT NULL,
  `sy_id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `or_no` varchar(50) NOT NULL,
  `payee_name` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `cash` varchar(100) NOT NULL,
  `date` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_studentpay`
--

INSERT INTO `tbl_studentpay` (`studpay_id`, `sy_id`, `stud_id`, `or_no`, `payee_name`, `amount`, `cash`, `date`, `time`) VALUES
(1, 2, 1, '12345', 'ALYSSA ANUARODIN', '5000', '5000', '2024-03-08', '05:36 PM'),
(2, 2, 3, '20244', 'JAY BERONDO', '3500', '3500', '2024-03-08', '10:57 PM'),
(3, 2, 5, '1215', 'JUFEL  LUCERO ', '5000', '5000', '2024-03-08', '11:17 PM'),
(4, 2, 5, '12244', 'JUFEL  LUCERO ', '325', '325', '2024-03-08', '11:18 PM'),
(5, 2, 6, '1152', 'DAN TOMO', '2000', '2000', '2024-03-08', '11:38 PM'),
(6, 2, 7, '20240309', 'CARLOS  NUNEZ', '3000', '3000', '2024-03-09', '01:57 AM'),
(7, 2, 7, '125541', 'CARLOS  NUNEZ', '5000', '5000', '2024-03-09', '02:40 AM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_studentpaycon`
--

CREATE TABLE `tbl_studentpaycon` (
  `paycon_id` int(11) NOT NULL,
  `sy_id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `fee_id` int(11) NOT NULL,
  `or_no` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_studentpaycon`
--

INSERT INTO `tbl_studentpaycon` (`paycon_id`, `sy_id`, `stud_id`, `fee_id`, `or_no`, `amount`, `date`, `time`) VALUES
(2, 2, 1, 7, '12345', '5000', '2024-03-08', '05:36 PM'),
(6, 2, 1, 19, '', '1000', '', ''),
(10, 2, 3, 1, '20244', '1000', '2024-03-08', '10:57 PM'),
(11, 2, 3, 19, '20244', '2500', '2024-03-08', '10:57 PM'),
(15, 2, 5, 7, '1215', '5000', '2024-03-08', '11:17 PM'),
(16, 2, 5, 19, '12244', '325', '2024-03-08', '11:18 PM'),
(17, 2, 6, 7, '1152', '2000', '2024-03-08', '11:38 PM'),
(19, 2, 7, 19, '20240309', '3000', '2024-03-09', '01:57 AM'),
(20, 2, 7, 7, '125541', '5000', '2024-03-09', '02:40 AM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_studentpayment`
--

CREATE TABLE `tbl_studentpayment` (
  `studpay_id` int(11) NOT NULL,
  `sy_id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `fee_id` int(11) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_studentpayment`
--

INSERT INTO `tbl_studentpayment` (`studpay_id`, `sy_id`, `stud_id`, `fee_id`, `amount`, `date`) VALUES
(1, 2, 1, 19, '3256', '2024-03-08'),
(2, 2, 1, 13, '300', '2024-03-08'),
(3, 2, 1, 7, '12100', '2024-03-08'),
(4, 2, 1, 1, '3500', '2024-03-08'),
(5, 2, 3, 19, '3256', '2024-03-08'),
(6, 2, 3, 13, '300', '2024-03-08'),
(7, 2, 3, 7, '12100', '2024-03-08'),
(8, 2, 3, 1, '3500', '2024-03-08'),
(9, 2, 5, 19, '3256', '2024-03-08'),
(10, 2, 5, 13, '300', '2024-03-08'),
(11, 2, 5, 7, '12100', '2024-03-08'),
(12, 2, 5, 1, '3500', '2024-03-08'),
(13, 2, 10, 19, '3256', '2024-03-08'),
(14, 2, 10, 13, '300', '2024-03-08'),
(15, 2, 10, 7, '12100', '2024-03-08'),
(16, 2, 10, 1, '3500', '2024-03-08'),
(17, 2, 6, 19, '3256', '2024-03-08'),
(18, 2, 6, 13, '300', '2024-03-08'),
(19, 2, 6, 7, '12100', '2024-03-08'),
(20, 2, 6, 1, '3500', '2024-03-08'),
(21, 2, 7, 19, '3256', '2024-03-08'),
(22, 2, 7, 13, '300', '2024-03-08'),
(23, 2, 7, 7, '12100', '2024-03-08'),
(24, 2, 7, 1, '3500', '2024-03-08'),
(25, 2, 8, 19, '3256', '2024-03-08'),
(26, 2, 8, 13, '300', '2024-03-08'),
(27, 2, 8, 7, '12100', '2024-03-08'),
(28, 2, 8, 1, '3500', '2024-03-08'),
(29, 2, 8, 19, '3256', '2024-03-08'),
(30, 2, 8, 13, '300', '2024-03-08'),
(31, 2, 8, 7, '12100', '2024-03-08'),
(32, 2, 8, 1, '3500', '2024-03-08'),
(33, 2, 9, 19, '3256', '2024-03-08'),
(34, 2, 9, 13, '300', '2024-03-08'),
(35, 2, 9, 7, '12100', '2024-03-08'),
(36, 2, 9, 1, '3500', '2024-03-08'),
(37, 2, 11, 19, '3256', '2024-03-08'),
(38, 2, 11, 13, '300', '2024-03-08'),
(39, 2, 11, 7, '12100', '2024-03-08'),
(40, 2, 11, 1, '3500', '2024-03-08'),
(41, 2, 12, 19, '3256', '2024-03-16'),
(42, 2, 12, 13, '300', '2024-03-16'),
(43, 2, 12, 7, '12100', '2024-03-16'),
(44, 2, 12, 1, '3500', '2024-03-16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subject`
--

CREATE TABLE `tbl_subject` (
  `sub_id` int(11) NOT NULL,
  `subject` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_subject`
--

INSERT INTO `tbl_subject` (`sub_id`, `subject`) VALUES
(1, 'ENGLISH'),
(2, 'ARALING PANLIPUNAN'),
(3, 'MOTHER TONGUE'),
(4, 'MATHEMATICS'),
(5, 'FILIPINO'),
(6, 'MAPEH'),
(7, 'SCIENCE'),
(8, 'COMPUTER'),
(9, 'TLE'),
(10, 'EPP');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacheduc`
--

CREATE TABLE `tbl_teacheduc` (
  `teachedu_id` int(11) NOT NULL,
  `teach_id` int(11) NOT NULL,
  `level` varchar(50) NOT NULL,
  `level_school` varchar(200) NOT NULL,
  `year_graduated` varchar(100) NOT NULL,
  `name_school` varchar(300) NOT NULL,
  `degree` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_teacheduc`
--

INSERT INTO `tbl_teacheduc` (`teachedu_id`, `teach_id`, `level`, `level_school`, `year_graduated`, `name_school`, `degree`) VALUES
(3, 6, '1', 'Primary', '1982', 'DUMARAO ELEMENTARY SCHOOL', ''),
(4, 6, '2', 'Secondary', '1986', 'OUR LADY OF THE SNOW INSTITUTE', ''),
(5, 6, '3', 'Tertiary', '1990', ' UNIVERSITY OF SAN AGUSTIN', 'BSC - ACCOUNTING'),
(6, 6, '5', 'Master', '1996', 'MOUNTAIN VIEW COLLEGE', 'BEED'),
(7, 5, '1', 'Primary', '2011', 'BALURAN ELEMENTARY SCHOOL', ''),
(8, 5, '2', 'Secondary', '2015', 'TUNGAWAN NATIONAL HIGHSCHOOL', ''),
(9, 5, '3', 'Tertiary', '2019', 'WMSU-TUNGAWAN EXTERNAL STUDIES UNIT', 'BATCHELOR OF ELEMENTARY EDUCATION (GENERAL EDUCATION)'),
(10, 2, '1', 'Primary', '1995', 'BALASAN SDA MULTIGRADE SCHOOL', ''),
(11, 2, '2', 'Secondary', '1999', 'LAON GANZON POLYTECHNIC COLLEGE', ''),
(12, 2, '3', 'Tertiary', '2004', 'ILOILO POLYTECHNIC STATE COLLEGE', 'B.S. IN INDUSTRIAL EDUCATION'),
(13, 4, '1', 'Primary', '2009', 'TUBI-ALLAH ELEMENTARY SCHOOL', ''),
(14, 4, '2', 'Secondary', '2013', 'LIBERTAD NATIONAL HIGH SCHOOL', ''),
(15, 4, '3', 'Tertiary', '2018', 'SOUTHERN DE ORO PHILIPPINE COLLEGE', 'BACHELOR OF ELEMENTARY EDUCATION (GENERAL EDUCATION CURRICULUM)');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacheli`
--

CREATE TABLE `tbl_teacheli` (
  `teacheli_id` int(11) NOT NULL,
  `teach_id` int(11) NOT NULL,
  `eligibility` varchar(500) NOT NULL,
  `rating` varchar(100) NOT NULL,
  `date_exam` varchar(100) NOT NULL,
  `place` varchar(500) NOT NULL,
  `license_number` varchar(500) NOT NULL,
  `date_validity` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_teacheli`
--

INSERT INTO `tbl_teacheli` (`teacheli_id`, `teach_id`, `eligibility`, `rating`, `date_exam`, `place`, `license_number`, `date_validity`) VALUES
(2, 6, 'LET', '88', '2024-03-09', 'PAGADIAN CITY', '1224896', '2027-03-09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacher`
--

CREATE TABLE `tbl_teacher` (
  `teach_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_no` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `civil_status` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `activation` varchar(100) NOT NULL,
  `photo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_teacher`
--

INSERT INTO `tbl_teacher` (`teach_id`, `firstname`, `lastname`, `address`, `email`, `contact_no`, `gender`, `civil_status`, `password`, `status`, `activation`, `photo`) VALUES
(1, 'ANTHONY', 'TORAYNO', 'MAGDAUP IPIL ZAMBOANGA SIBUGAY', 'anonymousblackexcile@gmail.com', '09978637863', 'Male', 'single', 'Torayno123', 'Active', '62175fcac075bfb3e03da91ea7e5ec1a', '415476219_1386442561965299_6780488645758914192_n.jpg'),
(2, 'GINALYN', 'MARCELINO', 'SANITO , IPIL, ZAMBOANGA SIBUGAY', 'ginalynbargo@gmail.com', '09368740697', 'Female', 'married', 'c8I463Eq', 'Active', 'fb66b9a02cdba7b6ff7b64da05826dd8', '431482145_1837832753331025_3898171952572787104_n.jpg'),
(3, 'ECELYN', 'MANDALUPA', 'TIAYON , IPIL ZAMBOANGA SIBUGAY ', 'ecelynmandalupa123@gmail.com', '09358466642', 'Female', 'married', 'wWSELopy', 'Active', '10f9b5c616115c8a1d7336b9efa833c4', '431484247_1787660898381236_2467872528017754644_n.jpg'),
(4, 'WINCEY', 'FAUSTINO', 'SANITO, IPIL, ZAMBOANGA SIBUGAY', 'nicetolentino96@gmail.com', '09652611580', 'Female', 'married', 'r5_BTt2y', 'Active', '099232967bc551476776a0bf8ed09d34', '431610063_1320518582676374_3642716623727818089_n.jpg'),
(5, 'ARNELYN', 'ABAJAR', 'Baluran, Tungawan Zamboanga Sibugay', 'abajararnelyn13@gmail.com', '09354222628', 'Female', 'single', 'B$IqE2j&', 'Active', '3cca245c80b60c6cfcfcc43d23246eb9', '431460429_934792547843614_684966850310224170_n.jpg'),
(6, 'LILYBETH', 'CEDRON', 'PANGI, IPIL ZAMBOANGA SIBUGAY', 'lilybethcedron@gmail.com', '09972440190', 'Female', 'married', '!Z_gp#U2', 'Active', '31ed313bbcf71a4b02b20b4c34d4ab11', '431608381_429068126229138_3136316720673971371_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_useraccount`
--

CREATE TABLE `tbl_useraccount` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_no` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `photo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_useraccount`
--

INSERT INTO `tbl_useraccount` (`user_id`, `firstname`, `lastname`, `email`, `contact_no`, `username`, `password`, `user_type`, `photo`) VALUES
(1, 'Anthony', 'Torayno', 'blackexcile@gmail.com', '09978637863', 'admin', '159357xywar123', 'Admin', '140429.jpg'),
(2, 'DEZAMAE', 'APOLINARIO', 'dezamaeapolinariobabeko28@gmail.com', '09553308198', '', 'dezamae123', 'Staff', 'chibi2.jpg'),
(3, 'LIEZLE', 'JOCSON', 'liezlejocson@gmail.com', '09514466235', '', 'jocson123', 'Registrar', '123.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_acadcon`
--
ALTER TABLE `tbl_acadcon`
  ADD PRIMARY KEY (`acadcon_id`);

--
-- Indexes for table `tbl_academic`
--
ALTER TABLE `tbl_academic`
  ADD PRIMARY KEY (`acad_id`);

--
-- Indexes for table `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `tbl_enroll`
--
ALTER TABLE `tbl_enroll`
  ADD PRIMARY KEY (`enroll_id`);

--
-- Indexes for table `tbl_enrollsub`
--
ALTER TABLE `tbl_enrollsub`
  ADD PRIMARY KEY (`ensub_id`);

--
-- Indexes for table `tbl_event`
--
ALTER TABLE `tbl_event`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `tbl_fee`
--
ALTER TABLE `tbl_fee`
  ADD PRIMARY KEY (`fee_id`);

--
-- Indexes for table `tbl_gradelevel`
--
ALTER TABLE `tbl_gradelevel`
  ADD PRIMARY KEY (`grade_id`);

--
-- Indexes for table `tbl_grades`
--
ALTER TABLE `tbl_grades`
  ADD PRIMARY KEY (`grades_id`);

--
-- Indexes for table `tbl_gradstat`
--
ALTER TABLE `tbl_gradstat`
  ADD PRIMARY KEY (`gradstat_id`);

--
-- Indexes for table `tbl_load`
--
ALTER TABLE `tbl_load`
  ADD PRIMARY KEY (`load_id`);

--
-- Indexes for table `tbl_notif`
--
ALTER TABLE `tbl_notif`
  ADD PRIMARY KEY (`notif_id`);

--
-- Indexes for table `tbl_official`
--
ALTER TABLE `tbl_official`
  ADD PRIMARY KEY (`official_id`);

--
-- Indexes for table `tbl_room`
--
ALTER TABLE `tbl_room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  ADD PRIMARY KEY (`sched_id`);

--
-- Indexes for table `tbl_schoolyear`
--
ALTER TABLE `tbl_schoolyear`
  ADD PRIMARY KEY (`sy_id`);

--
-- Indexes for table `tbl_section`
--
ALTER TABLE `tbl_section`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`stud_id`);

--
-- Indexes for table `tbl_studentpay`
--
ALTER TABLE `tbl_studentpay`
  ADD PRIMARY KEY (`studpay_id`);

--
-- Indexes for table `tbl_studentpaycon`
--
ALTER TABLE `tbl_studentpaycon`
  ADD PRIMARY KEY (`paycon_id`);

--
-- Indexes for table `tbl_studentpayment`
--
ALTER TABLE `tbl_studentpayment`
  ADD PRIMARY KEY (`studpay_id`);

--
-- Indexes for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `tbl_teacheduc`
--
ALTER TABLE `tbl_teacheduc`
  ADD PRIMARY KEY (`teachedu_id`);

--
-- Indexes for table `tbl_teacheli`
--
ALTER TABLE `tbl_teacheli`
  ADD PRIMARY KEY (`teacheli_id`);

--
-- Indexes for table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  ADD PRIMARY KEY (`teach_id`);

--
-- Indexes for table `tbl_useraccount`
--
ALTER TABLE `tbl_useraccount`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_acadcon`
--
ALTER TABLE `tbl_acadcon`
  MODIFY `acadcon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_academic`
--
ALTER TABLE `tbl_academic`
  MODIFY `acad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_account`
--
ALTER TABLE `tbl_account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_enroll`
--
ALTER TABLE `tbl_enroll`
  MODIFY `enroll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_enrollsub`
--
ALTER TABLE `tbl_enrollsub`
  MODIFY `ensub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `tbl_event`
--
ALTER TABLE `tbl_event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_fee`
--
ALTER TABLE `tbl_fee`
  MODIFY `fee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_gradelevel`
--
ALTER TABLE `tbl_gradelevel`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_grades`
--
ALTER TABLE `tbl_grades`
  MODIFY `grades_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_gradstat`
--
ALTER TABLE `tbl_gradstat`
  MODIFY `gradstat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_load`
--
ALTER TABLE `tbl_load`
  MODIFY `load_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_notif`
--
ALTER TABLE `tbl_notif`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_official`
--
ALTER TABLE `tbl_official`
  MODIFY `official_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_room`
--
ALTER TABLE `tbl_room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  MODIFY `sched_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_schoolyear`
--
ALTER TABLE `tbl_schoolyear`
  MODIFY `sy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_section`
--
ALTER TABLE `tbl_section`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `stud_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_studentpay`
--
ALTER TABLE `tbl_studentpay`
  MODIFY `studpay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_studentpaycon`
--
ALTER TABLE `tbl_studentpaycon`
  MODIFY `paycon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_studentpayment`
--
ALTER TABLE `tbl_studentpayment`
  MODIFY `studpay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_teacheduc`
--
ALTER TABLE `tbl_teacheduc`
  MODIFY `teachedu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_teacheli`
--
ALTER TABLE `tbl_teacheli`
  MODIFY `teacheli_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  MODIFY `teach_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_useraccount`
--
ALTER TABLE `tbl_useraccount`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.0.0-rc4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2013 at 03:56 PM
-- Server version: 5.6.11
-- PHP Version: 5.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `md`
--

-- --------------------------------------------------------

--
-- Table structure for table `criterias`
--

DROP TABLE IF EXISTS `criterias`;
CREATE TABLE IF NOT EXISTS `criterias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `public_name` varchar(256) NOT NULL,
  `weight` float NOT NULL,
  `type` tinyint(1) NOT NULL,
  `criteria_sentence` blob NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `criterias`
--

INSERT INTO `criterias` (`id`, `user_id`, `public_name`, `weight`, `type`, `criteria_sentence`, `timestamp`) VALUES
(1, 11, 'Html validation', 0.8, 2, 0x687474703a2f2f76616c696461746f722e77332e6f72672f636865636b2f3f667261676d656e743d24636f6e74657874266c616e673d68746d6c266d6574686f643d706f7374266f75747075743d6a736f6e2676616c69643d72657475726e20656d7074792824726573756c742d3e6d65737361676573293b, 1368261624),
(2, 11, 'Css validation', 0.5, 2, 0x687474703a2f2f6a69677361772e77332e6f72672f6373732d76616c696461746f722f76616c696461746f723f746578743d24636f6e74657874266c616e673d637373266f75747075743d6a736f6e266d6574686f643d6765742676616c69643d72657475726e2024726573756c742d3e63737376616c69646174696f6e2d3e76616c69646974793b, 1368261624);

-- --------------------------------------------------------

--
-- Table structure for table `hometasks`
--

DROP TABLE IF EXISTS `hometasks`;
CREATE TABLE IF NOT EXISTS `hometasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mājas darba ID',
  `zipID` int(11) NOT NULL COMMENT 'ID iegūts no paša zip faila',
  `title` varchar(128) NOT NULL COMMENT 'Mājas darba nosaukums',
  `isImported` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Vai zip faili ir ieimportēti vai nav.',
  `indexFile` varchar(128) NOT NULL,
  `term` int(11) NOT NULL COMMENT 'Izpildes termiņš',
  `timestamp` int(11) NOT NULL COMMENT 'Kad darbs izveidots',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Satur vispārīgus datus par mājas darbiem' AUTO_INCREMENT=14 ;

--
-- Dumping data for table `hometasks`
--

INSERT INTO `hometasks` (`id`, `zipID`, `title`, `isImported`, `indexFile`, `term`, `timestamp`) VALUES
(11, 6788, '1st Home Task', 1, 'index.php', 1368568800, 1368038115),
(12, 6788, 'test', 0, 'index.php', 1369515600, 1369212917),
(13, 6788, 'test', 1, 'index.php', 1369515600, 1369213657);

-- --------------------------------------------------------

--
-- Table structure for table `hometask_criterias`
--

DROP TABLE IF EXISTS `hometask_criterias`;
CREATE TABLE IF NOT EXISTS `hometask_criterias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hometask_id` int(11) NOT NULL,
  `criteria_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hometask_id` (`hometask_id`),
  KEY `criteria_id` (`criteria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `received_homeworks`
--

DROP TABLE IF EXISTS `received_homeworks`;
CREATE TABLE IF NOT EXISTS `received_homeworks` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Ieraksta ID',
  `homestaskID` int(11) NOT NULL COMMENT 'Mājas darba ID',
  `studentIDNumber` varchar(10) NOT NULL COMMENT 'Studenta ID',
  `sourcePath` varchar(128) NOT NULL COMMENT 'Fiziskā koda atrašanās vieta',
  `timestamp` int(11) NOT NULL COMMENT 'Kad ieraksts veikts',
  PRIMARY KEY (`id`),
  KEY `homestaskID` (`homestaskID`,`studentIDNumber`),
  KEY `studentID` (`studentIDNumber`),
  KEY `studentIDNumber` (`studentIDNumber`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Satur datus par iesūtītajiem mājas darbiem' AUTO_INCREMENT=187 ;

--
-- Dumping data for table `received_homeworks`
--

INSERT INTO `received_homeworks` (`id`, `homestaskID`, `studentIDNumber`, `sourcePath`, `timestamp`) VALUES
(1, 11, '1', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\1\\', 1368039790),
(2, 11, 'ag11111', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\ag11111\\', 1368039790),
(3, 11, 'az11112', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\az11112\\', 1368039790),
(4, 11, 'ak11280', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\ak11280\\', 1368039790),
(5, 11, 'ak11185', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\ak11185\\', 1368039790),
(6, 11, 'as11187', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\as11187\\', 1368039790),
(7, 11, 'az11094', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\az11094\\', 1368039790),
(8, 11, 'ab11202', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\ab11202\\', 1368039790),
(9, 11, 'az11068', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\az11068\\', 1368039790),
(10, 11, 'ab05059', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\ab05059\\', 1368039790),
(11, 11, 'ap11148', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\ap11148\\', 1368039790),
(12, 11, 'at11067', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\at11067\\', 1368039790),
(13, 11, 'ad09126', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\ad09126\\', 1368039790),
(14, 11, 'ag11097', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\ag11097\\', 1368039790),
(15, 11, 'ab11196', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\ab11196\\', 1368039790),
(16, 11, 'AR10098', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\AR10098\\', 1368039790),
(17, 11, 'ao11059', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\ao11059\\', 1368039790),
(18, 11, 'ab11161', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\ab11161\\', 1368039790),
(19, 11, 'AN10035', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\AN10035\\', 1368039790),
(20, 11, 'ao11022', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\ao11022\\', 1368039791),
(21, 11, 'bt11009', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\bt11009\\', 1368039791),
(22, 11, 'dk11066', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\dk11066\\', 1368039791),
(23, 11, 'dp11058', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\dp11058\\', 1368039791),
(24, 11, 'dd11035', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\dd11035\\', 1368039791),
(25, 11, 'dg11041', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\dg11041\\', 1368039791),
(26, 11, 'dk11064', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\dk11064\\', 1368039791),
(27, 11, 'dr07021', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\dr07021\\', 1368039791),
(28, 11, 'dd11043', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\dd11043\\', 1368039791),
(29, 11, 'eoo11018', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\eoo11018\\', 1368039791),
(30, 11, 'ek11137', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\ek11137\\', 1368039791),
(31, 11, 'es11072', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\es11072\\', 1368039791),
(32, 11, 'fz11002', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\fz11002\\', 1368039791),
(33, 11, 'gp08081md1', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\gp08081md1\\', 1368039791),
(34, 11, 'gv11017', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\gv11017\\', 1368039791),
(35, 11, 'gd11018', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\gd11018\\', 1368039791),
(36, 11, 'is11208', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\is11208\\', 1368039791),
(37, 11, 'ig11075', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\ig11075\\', 1368039791),
(38, 11, 'jk11108', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\jk11108\\', 1368039791),
(39, 11, 'jg11053', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\jg11053\\', 1368039791),
(40, 11, 'jr11046', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\jr11046\\', 1368039791),
(41, 11, 'jg11051', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\jg11051\\', 1368039791),
(42, 11, 'jg11061', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\jg11061\\', 1368039791),
(43, 11, 'jl11038', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\jl11038\\', 1368039791),
(44, 11, 'jo11021', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\jo11021\\', 1368039791),
(45, 11, 'jz11044', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\jz11044\\', 1368039791),
(46, 11, 'jm11068', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\jm11068\\', 1368039791),
(47, 11, 'kf11003', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\kf11003\\', 1368039791),
(48, 11, 'KM11039', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\KM11039\\', 1368039791),
(49, 11, 'ks11072', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\ks11072\\', 1368039791),
(50, 11, 'kz11060', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\kz11060\\', 1368039791),
(51, 11, 'kz11041', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\kz11041\\', 1368039791),
(52, 11, 'kb11072', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\kb11072\\', 1368039791),
(53, 11, 'ks11056', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\ks11056\\', 1368039791),
(54, 11, 'kk11101', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\kk11101\\', 1368039791),
(55, 11, 'kb11078', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\kb11078\\', 1368039791),
(56, 11, 'kf11005', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\kf11005\\', 1368039791),
(57, 11, 'ks11077', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\ks11077\\', 1368039791),
(58, 11, 'ls11120', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\ls11120\\', 1368039792),
(59, 11, 'ls11124', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\ls11124\\', 1368039792),
(60, 11, 'lk11194', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\lk11194\\', 1368039792),
(61, 11, 'mk11250', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\mk11250\\', 1368039792),
(62, 11, 'ms11148', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\ms11148\\', 1368039792),
(63, 11, 'mi11015', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\mi11015\\', 1368039792),
(64, 11, 'ms11146', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\ms11146\\', 1368039792),
(65, 11, 'mk11204', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\mk11204\\', 1368039792),
(66, 11, 'mk11252', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\mk11252\\', 1368039792),
(67, 11, 'ma11054', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\ma11054\\', 1368039792),
(68, 11, 'ml11053', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\ml11053\\', 1368039792),
(69, 11, 'mm11302', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\mm11302\\', 1368039792),
(70, 11, 'mo11039', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\mo11039\\', 1368039792),
(71, 11, 'ma11056', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\ma11056\\', 1368039792),
(72, 11, 'nk11023', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\nk11023\\', 1368039793),
(73, 11, 'nv10013', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\nv10013\\', 1368039793),
(74, 11, 'oz11012', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\oz11012\\', 1368039793),
(75, 11, 'pr11001', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\pr11001\\', 1368039793),
(76, 11, 're11003', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\re11003\\', 1368039793),
(77, 11, 'tt2', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\tt2\\', 1368039793),
(78, 11, 'RF11012', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\RF11012\\', 1368039793),
(79, 11, 'rz11017', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\rz11017\\', 1368039793),
(80, 11, 'rs11071', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\rs11071\\', 1368039793),
(81, 11, 'rh10008', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\rh10008\\', 1368039793),
(82, 11, 'sk11311', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\sk11311\\', 1368039793),
(83, 11, 'se11006', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\se11006\\', 1368039793),
(84, 11, 'ud11001', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\ud11001\\', 1368039793),
(85, 11, 'va11030', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\va11030\\', 1368039793),
(86, 11, 'vg11015', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\vg11015\\', 1368039793),
(87, 11, 'vr11015', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\vr11015\\', 1368039793),
(88, 11, 'vr11013', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\vr11013\\', 1368039793),
(89, 11, 'va11028', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\va11028\\', 1368039793),
(90, 11, 'vs10037', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\vs10037\\', 1368039793),
(91, 11, 'zb11024', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\zb11024\\', 1368039793),
(92, 11, 'eg11041', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\eg11041\\', 1368039793),
(93, 11, 'es10146', 'C:\\xampp\\htdocs\\md\\protected\\\\archive\\archive-johntestercom\\6788\\es10146\\', 1368039793),
(94, 13, '1', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\1\\', 1369219518),
(95, 13, 'ag11111', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\ag11111\\', 1369219518),
(96, 13, 'az11112', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\az11112\\', 1369219518),
(97, 13, 'ak11280', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\ak11280\\', 1369219518),
(98, 13, 'ak11185', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\ak11185\\', 1369219518),
(99, 13, 'as11187', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\as11187\\', 1369219518),
(100, 13, 'az11094', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\az11094\\', 1369219518),
(101, 13, 'ab11202', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\ab11202\\', 1369219518),
(102, 13, 'az11068', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\az11068\\', 1369219518),
(103, 13, 'ab05059', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\ab05059\\', 1369219518),
(104, 13, 'ap11148', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\ap11148\\', 1369219518),
(105, 13, 'at11067', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\at11067\\', 1369219518),
(106, 13, 'ad09126', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\ad09126\\', 1369219518),
(107, 13, 'ag11097', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\ag11097\\', 1369219519),
(108, 13, 'ab11196', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\ab11196\\', 1369219519),
(109, 13, 'AR10098', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\AR10098\\', 1369219519),
(110, 13, 'ao11059', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\ao11059\\', 1369219519),
(111, 13, 'ab11161', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\ab11161\\', 1369219519),
(112, 13, 'AN10035', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\AN10035\\', 1369219519),
(113, 13, 'ao11022', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\ao11022\\', 1369219519),
(114, 13, 'bt11009', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\bt11009\\', 1369219519),
(115, 13, 'dk11066', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\dk11066\\', 1369219519),
(116, 13, 'dp11058', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\dp11058\\', 1369219519),
(117, 13, 'dd11035', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\dd11035\\', 1369219519),
(118, 13, 'dg11041', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\dg11041\\', 1369219519),
(119, 13, 'dk11064', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\dk11064\\', 1369219519),
(120, 13, 'dr07021', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\dr07021\\', 1369219519),
(121, 13, 'dd11043', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\dd11043\\', 1369219519),
(122, 13, 'eoo11018', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\eoo11018\\', 1369219519),
(123, 13, 'ek11137', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\ek11137\\', 1369219519),
(124, 13, 'es11072', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\es11072\\', 1369219519),
(125, 13, 'fz11002', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\fz11002\\', 1369219519),
(126, 13, 'gp08081md1', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\gp08081md1\\', 1369219519),
(127, 13, 'gv11017', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\gv11017\\', 1369219519),
(128, 13, 'gd11018', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\gd11018\\', 1369219519),
(129, 13, 'is11208', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\is11208\\', 1369219519),
(130, 13, 'ig11075', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\ig11075\\', 1369219520),
(131, 13, 'jk11108', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\jk11108\\', 1369219520),
(132, 13, 'jg11053', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\jg11053\\', 1369219520),
(133, 13, 'jr11046', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\jr11046\\', 1369219520),
(134, 13, 'jg11051', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\jg11051\\', 1369219520),
(135, 13, 'jg11061', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\jg11061\\', 1369219520),
(136, 13, 'jl11038', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\jl11038\\', 1369219520),
(137, 13, 'jo11021', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\jo11021\\', 1369219520),
(138, 13, 'jz11044', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\jz11044\\', 1369219520),
(139, 13, 'jm11068', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\jm11068\\', 1369219520),
(140, 13, 'kf11003', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\kf11003\\', 1369219520),
(141, 13, 'KM11039', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\KM11039\\', 1369219520),
(142, 13, 'ks11072', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\ks11072\\', 1369219520),
(143, 13, 'kz11060', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\kz11060\\', 1369219520),
(144, 13, 'kz11041', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\kz11041\\', 1369219520),
(145, 13, 'kb11072', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\kb11072\\', 1369219520),
(146, 13, 'ks11056', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\ks11056\\', 1369219520),
(147, 13, 'kk11101', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\kk11101\\', 1369219520),
(148, 13, 'kb11078', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\kb11078\\', 1369219520),
(149, 13, 'kf11005', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\kf11005\\', 1369219520),
(150, 13, 'ks11077', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\ks11077\\', 1369219520),
(151, 13, 'ls11120', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\ls11120\\', 1369219520),
(152, 13, 'ls11124', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\ls11124\\', 1369219520),
(153, 13, 'lk11194', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\lk11194\\', 1369219520),
(154, 13, 'mk11250', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\mk11250\\', 1369219520),
(155, 13, 'ms11148', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\ms11148\\', 1369219520),
(156, 13, 'mi11015', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\mi11015\\', 1369219520),
(157, 13, 'ms11146', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\ms11146\\', 1369219520),
(158, 13, 'mk11204', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\mk11204\\', 1369219520),
(159, 13, 'mk11252', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\mk11252\\', 1369219520),
(160, 13, 'ma11054', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\ma11054\\', 1369219520),
(161, 13, 'ml11053', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\ml11053\\', 1369219520),
(162, 13, 'mm11302', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\mm11302\\', 1369219520),
(163, 13, 'mo11039', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\mo11039\\', 1369219520),
(164, 13, 'ma11056', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\ma11056\\', 1369219520),
(165, 13, 'nk11023', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\nk11023\\', 1369219520),
(166, 13, 'nv10013', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\nv10013\\', 1369219520),
(167, 13, 'oz11012', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\oz11012\\', 1369219520),
(168, 13, 'pr11001', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\pr11001\\', 1369219520),
(169, 13, 're11003', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\re11003\\', 1369219521),
(170, 13, 'tt2', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\tt2\\', 1369219521),
(171, 13, 'RF11012', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\RF11012\\', 1369219521),
(172, 13, 'rz11017', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\rz11017\\', 1369219521),
(173, 13, 'rs11071', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\rs11071\\', 1369219521),
(174, 13, 'rh10008', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\rh10008\\', 1369219521),
(175, 13, 'sk11311', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\sk11311\\', 1369219521),
(176, 13, 'se11006', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\se11006\\', 1369219521),
(177, 13, 'ud11001', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\ud11001\\', 1369219521),
(178, 13, 'va11030', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\va11030\\', 1369219521),
(179, 13, 'vg11015', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\vg11015\\', 1369219521),
(180, 13, 'vr11015', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\vr11015\\', 1369219521),
(181, 13, 'vr11013', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\vr11013\\', 1369219521),
(182, 13, 'va11028', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\va11028\\', 1369219521),
(183, 13, 'vs10037', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\vs10037\\', 1369219521),
(184, 13, 'zb11024', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\zb11024\\', 1369219521),
(185, 13, 'eg11041', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\eg11041\\', 1369219521),
(186, 13, 'es10146', 'C:\\projects\\MD-labosanas-sistema\\protected\\archive\\archive-johntest2\\6788\\es10146\\', 1369219521);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Ieraksta ID',
  `name` varchar(128) NOT NULL COMMENT 'Studenta vārds',
  `surname` varchar(128) NOT NULL COMMENT 'Studenta uzvārds',
  `studentIDNumber` varchar(10) NOT NULL COMMENT 'Studenta apliecības numurs',
  `timestamp` int(11) NOT NULL COMMENT 'Timestamp, kad ieraksts veikts',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Satur vispārīgus datus par studentiem' AUTO_INCREMENT=94 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `surname`, `studentIDNumber`, `timestamp`) VALUES
(1, 'Agnese', 'Skujiņa', '1', 1368038271),
(2, 'Agris', 'Ģērmanis', 'ag11111', 1368038272),
(3, 'Aleksandra', 'Zotova', 'az11112', 1368038272),
(4, 'Aleksandrs', 'Kurbatskis', 'ak11280', 1368038272),
(5, 'Aleksandrs', 'Kļimenko', 'ak11185', 1368038272),
(6, 'Aleksejs', 'Smišļajevs', 'as11187', 1368038272),
(7, 'Aleta', 'Zariņa', 'az11094', 1368038272),
(8, 'Alfrēds', 'Bendrups', 'ab11202', 1368038272),
(9, 'Anastasija', 'Zakomolkina', 'az11068', 1368038272),
(10, 'Andrejs', 'Bogdanovs', 'ab05059', 1368038273),
(11, 'Andris', 'Pakulis', 'ap11148', 1368038273),
(12, 'Andris', 'Tīsenkopfs', 'at11067', 1368038273),
(13, 'Anete', 'Didrihsone', 'ad09126', 1368038273),
(14, 'Anna', 'Guseva', 'ag11097', 1368038273),
(15, 'Armands', 'Baurovskis', 'ab11196', 1368038273),
(16, 'Armands', 'Einārs', 'AR10098', 1368038273),
(17, 'Armands', 'Ošiņš', 'ao11059', 1368038273),
(18, 'Artis', 'Burkevics', 'ab11161', 1368038273),
(19, 'Artūrs', 'Narņickis', 'AN10035', 1368038273),
(20, 'Artūrs', 'Olups', 'ao11022', 1368038273),
(21, 'Bruno', 'Treiguts', 'bt11009', 1368038273),
(22, 'Dana', 'Kukaine', 'dk11066', 1368038273),
(23, 'Daniels', 'Pitkevičs', 'dp11058', 1368038274),
(24, 'Deniss', 'Dmitrijevs', 'dd11035', 1368038274),
(25, 'Dmitrijs', 'Gaļļamovs', 'dg11041', 1368038274),
(26, 'Dzintars', 'Kanašēvics', 'dk11064', 1368038274),
(27, 'Dzintars', 'Rājevs', 'dr07021', 1368038274),
(28, 'Dāvis', 'Dreimanis', 'dd11043', 1368038274),
(29, 'Edgars', 'Ozols', 'eoo11018', 1368038274),
(30, 'Edgars', 'Ķemers', 'ek11137', 1368038274),
(31, 'Emil', 'Syundyukov', 'es11072', 1368038274),
(32, 'Francis', 'Zariņš', 'fz11002', 1368038274),
(33, 'Guna', 'Petrova', 'gp08081md1', 1368038274),
(34, 'Gustavs', 'Venters', 'gv11017', 1368038274),
(35, 'Gvido', 'Dzenis', 'gd11018', 1368038275),
(36, 'Igors', 'Šakurovs', 'is11208', 1368038275),
(37, 'Iļja', 'Gubins', 'ig11075', 1368038275),
(38, 'Janeks', 'Krasovskis', 'jk11108', 1368038275),
(39, 'Jans', 'Glagoļevs', 'jg11053', 1368038275),
(40, 'Jevgēnija', 'Ribalko', 'jr11046', 1368038275),
(41, 'Jānis', 'Galejs', 'jg11051', 1368038275),
(42, 'Jānis', 'Gulbinskis', 'jg11061', 1368038275),
(43, 'Jānis', 'Lācis', 'jl11038', 1368038275),
(44, 'Jānis', 'Ozoliņš', 'jo11021', 1368038275),
(45, 'Jānis', 'Zvirbulis', 'jz11044', 1368038275),
(46, 'Jūlija', 'Matjaša', 'jm11068', 1368038275),
(47, 'Kristaps', 'Freibergs', 'kf11003', 1368038275),
(48, 'Kristaps', 'Mikasenoks', 'KM11039', 1368038275),
(49, 'Kristaps', 'Straumēns', 'ks11072', 1368038276),
(50, 'Kristaps', 'Zariņš', 'kz11060', 1368038276),
(51, 'Kristers', 'Zīmecs', 'kz11041', 1368038276),
(52, 'Krišjānis', 'Balodis', 'kb11072', 1368038276),
(53, 'Krišjānis', 'Šmits', 'ks11056', 1368038276),
(54, 'Ksenija', 'Krilatiha', 'kk11101', 1368038276),
(55, 'Kārlis', 'Babris', 'kb11078', 1368038276),
(56, 'Kārlis', 'Freimanis', 'kf11005', 1368038276),
(57, 'Kārlis', 'Seņko', 'ks11077', 1368038276),
(58, 'Lauma', 'Šivare', 'ls11120', 1368038276),
(59, 'Laura', 'Silaraupe', 'ls11124', 1368038276),
(60, 'Laura', 'Ķezbere', 'lk11194', 1368038276),
(61, 'Maija', 'Ķemere', 'mk11250', 1368038276),
(62, 'Maksims', 'Savčuks', 'ms11148', 1368038276),
(63, 'Mareks', 'Indāns', 'mi11015', 1368038277),
(64, 'Marks', 'Slonimskis', 'ms11146', 1368038277),
(65, 'Monta', 'Kudiņa', 'mk11204', 1368038277),
(66, 'Mārcis', 'Kozulis', 'mk11252', 1368038277),
(67, 'Mārtiņš', 'Akermanis', 'ma11054', 1368038277),
(68, 'Mārtiņš', 'Laizāns', 'ml11053', 1368038277),
(69, 'Mārtiņš', 'Mieriņš', 'mm11302', 1368038277),
(70, 'Mārtiņš', 'Orups', 'mo11039', 1368038278),
(71, 'Mārtiņš', 'Ābele', 'ma11056', 1368038278),
(72, 'Nikolajs', 'Koņkovs', 'nk11023', 1368038278),
(73, 'Nikolajs', 'Vavilovs', 'nv10013', 1368038278),
(74, 'Oskars', 'Zandersons', 'oz11012', 1368038278),
(75, 'Pēteris', 'Rudzusīks', 'pr11001', 1368038278),
(76, 'Reinis', 'Elksnis', 're11003', 1368038278),
(77, 'Renārs', 'Vilnis', 'tt2', 1368038278),
(78, 'Rihards', 'Fridrihsons', 'RF11012', 1368038278),
(79, 'Ričards', 'Zālītis', 'rz11017', 1368038278),
(80, 'Roberts', 'Sīlis', 'rs11071', 1368038278),
(81, 'Romans', 'Habibuļins', 'rh10008', 1368038278),
(82, 'Sabīna', 'Kupča', 'sk11311', 1368038278),
(83, 'Sigurds', 'Eglītis', 'se11006', 1368038279),
(84, 'Uldis', 'Dzilna', 'ud11001', 1368038279),
(85, 'Valdis', 'Ādamsons', 'va11030', 1368038279),
(86, 'Valters', 'Gajevskis', 'vg11015', 1368038279),
(87, 'Vita', 'Reizupa', 'vr11015', 1368038279),
(88, 'Vitālijs', 'Rakovs', 'vr11013', 1368038279),
(89, 'Vladislavs', 'Antoņuks', 'va11028', 1368038279),
(90, 'Vladislavs', 'Sokurenko', 'vs10037', 1368038279),
(91, 'Zigmunds', 'Beļskis', 'zb11024', 1368038279),
(92, 'Ēriks', 'Gopaks', 'eg11041', 1368038279),
(93, 'Ēriks', 'Šarapovs', 'es10146', 1368038279);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `name` varchar(32) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `lastname`, `email`, `timestamp`) VALUES
(11, 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'John', 'Tester', 'john@tester.com', 1368037553),
(12, 'john', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'John', 'Tester', 'jo@hn.test', 1369212753),
(13, 'john1', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'John', 'Tester', 'jo@hn.test1', 1369212799),
(14, 'john2', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'John', 'Tester', 'jo@hn.test2', 1369212854);

-- --------------------------------------------------------

--
-- Table structure for table `user_hometasks`
--

DROP TABLE IF EXISTS `user_hometasks`;
CREATE TABLE IF NOT EXISTS `user_hometasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hometask_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`hometask_id`),
  KEY `hometask_id` (`hometask_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_hometasks`
--

INSERT INTO `user_hometasks` (`id`, `user_id`, `hometask_id`, `timestamp`) VALUES
(1, 11, 11, 1368038115),
(2, 12, 12, 1369212917),
(3, 14, 13, 1369213657);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `criterias`
--
ALTER TABLE `criterias`
  ADD CONSTRAINT `criterias_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `hometask_criterias`
--
ALTER TABLE `hometask_criterias`
  ADD CONSTRAINT `hometask_criterias_ibfk_1` FOREIGN KEY (`hometask_id`) REFERENCES `hometasks` (`id`),
  ADD CONSTRAINT `hometask_criterias_ibfk_2` FOREIGN KEY (`criteria_id`) REFERENCES `criterias` (`id`);

--
-- Constraints for table `received_homeworks`
--
ALTER TABLE `received_homeworks`
  ADD CONSTRAINT `received_homeworks_ibfk_1` FOREIGN KEY (`homestaskID`) REFERENCES `hometasks` (`id`);

--
-- Constraints for table `user_hometasks`
--
ALTER TABLE `user_hometasks`
  ADD CONSTRAINT `user_hometasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_hometasks_ibfk_2` FOREIGN KEY (`hometask_id`) REFERENCES `hometasks` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

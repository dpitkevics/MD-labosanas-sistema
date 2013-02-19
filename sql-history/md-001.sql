-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2013 at 12:28 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `hometasks`
--

DROP TABLE IF EXISTS `hometasks`;
CREATE TABLE IF NOT EXISTS `hometasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mājas darba ID',
  `zipID` int(11) NOT NULL COMMENT 'ID iegūts no paša zip faila',
  `title` varchar(128) NOT NULL COMMENT 'Mājas darba nosaukums',
  `isImported` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Vai zip faili ir ieimportēti vai nav.',
  `term` int(11) NOT NULL COMMENT 'Izpildes termiņš',
  `timestamp` int(11) NOT NULL COMMENT 'Kad darbs izveidots',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Satur vispārīgus datus par mājas darbiem' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `hometasks`
--

INSERT INTO `hometasks` (`id`, `zipID`, `title`, `isImported`, `term`, `timestamp`) VALUES
(1, 6788, '1st_homework', 1, 1361185380, 1360580580);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Satur datus par iesūtītajiem mājas darbiem' AUTO_INCREMENT=91 ;

--
-- Dumping data for table `received_homeworks`
--

INSERT INTO `received_homeworks` (`id`, `homestaskID`, `studentIDNumber`, `sourcePath`, `timestamp`) VALUES
(1, 1, 'ag11111', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\ag11111\\', 1360592634),
(2, 1, 'az11112', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\az11112\\', 1360592634),
(3, 1, 'ak11280', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\ak11280\\', 1360592634),
(4, 1, 'ak11185', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\ak11185\\', 1360592634),
(5, 1, 'as11187', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\as11187\\', 1360592634),
(6, 1, 'az11094', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\az11094\\', 1360592634),
(7, 1, 'ab11202', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\ab11202\\', 1360592634),
(8, 1, 'az11068', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\az11068\\', 1360592634),
(9, 1, 'ab05059', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\ab05059\\', 1360592635),
(10, 1, 'ap11148', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\ap11148\\', 1360592635),
(11, 1, 'at11067', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\at11067\\', 1360592635),
(12, 1, 'ad09126', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\ad09126\\', 1360592635),
(13, 1, 'ag11097', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\ag11097\\', 1360592635),
(14, 1, 'ab11196', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\ab11196\\', 1360592635),
(15, 1, 'AR10098', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\AR10098\\', 1360592635),
(16, 1, 'ao11059', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\ao11059\\', 1360592635),
(17, 1, 'ab11161', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\ab11161\\', 1360592635),
(18, 1, 'AN10035', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\AN10035\\', 1360592636),
(19, 1, 'ao11022', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\ao11022\\', 1360592637),
(20, 1, 'bt11009', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\bt11009\\', 1360592637),
(21, 1, 'dk11066', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\dk11066\\', 1360592637),
(22, 1, 'dp11058', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\dp11058\\', 1360592637),
(23, 1, 'dd11035', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\dd11035\\', 1360592637),
(24, 1, 'dg11041', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\dg11041\\', 1360592638),
(25, 1, 'dk11064', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\dk11064\\', 1360592638),
(26, 1, 'dr07021', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\dr07021\\', 1360592638),
(27, 1, 'dd11043', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\dd11043\\', 1360592638),
(28, 1, 'eoo11018', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\eoo11018\\', 1360592638),
(29, 1, 'ek11137', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\ek11137\\', 1360592638),
(30, 1, 'es11072', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\es11072\\', 1360592639),
(31, 1, 'fz11002', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\fz11002\\', 1360592639),
(32, 1, 'gv11017', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\gv11017\\', 1360592639),
(33, 1, 'gd11018', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\gd11018\\', 1360592639),
(34, 1, 'is11208', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\is11208\\', 1360592640),
(35, 1, 'ig11075', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\ig11075\\', 1360592640),
(36, 1, 'jk11108', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\jk11108\\', 1360592640),
(37, 1, 'jg11053', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\jg11053\\', 1360592640),
(38, 1, 'jr11046', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\jr11046\\', 1360592641),
(39, 1, 'jg11051', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\jg11051\\', 1360592641),
(40, 1, 'jg11061', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\jg11061\\', 1360592641),
(41, 1, 'jl11038', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\jl11038\\', 1360592641),
(42, 1, 'jo11021', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\jo11021\\', 1360592641),
(43, 1, 'jz11044', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\jz11044\\', 1360592641),
(44, 1, 'jm11068', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\jm11068\\', 1360592642),
(45, 1, 'kf11003', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\kf11003\\', 1360592642),
(46, 1, 'KM11039', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\KM11039\\', 1360592642),
(47, 1, 'ks11072', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\ks11072\\', 1360592642),
(48, 1, 'kz11060', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\kz11060\\', 1360592642),
(49, 1, 'kz11041', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\kz11041\\', 1360592643),
(50, 1, 'kb11072', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\kb11072\\', 1360592643),
(51, 1, 'ks11056', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\ks11056\\', 1360592643),
(52, 1, 'kk11101', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\kk11101\\', 1360592643),
(53, 1, 'kb11078', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\kb11078\\', 1360592643),
(54, 1, 'kf11005', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\kf11005\\', 1360592643),
(55, 1, 'ks11077', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\ks11077\\', 1360592643),
(56, 1, 'ls11120', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\ls11120\\', 1360592643),
(57, 1, 'ls11124', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\ls11124\\', 1360592643),
(58, 1, 'lk11194', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\lk11194\\', 1360592644),
(59, 1, 'mk11250', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\mk11250\\', 1360592644),
(60, 1, 'ms11148', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\ms11148\\', 1360592644),
(61, 1, 'mi11015', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\mi11015\\', 1360592644),
(62, 1, 'ms11146', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\ms11146\\', 1360592644),
(63, 1, 'mk11204', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\mk11204\\', 1360592644),
(64, 1, 'mk11252', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\mk11252\\', 1360592644),
(65, 1, 'ma11054', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\ma11054\\', 1360592644),
(66, 1, 'ml11053', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\ml11053\\', 1360592645),
(67, 1, 'mm11302', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\mm11302\\', 1360592645),
(68, 1, 'mo11039', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\mo11039\\', 1360592645),
(69, 1, 'ma11056', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\ma11056\\', 1360592645),
(70, 1, 'nk11023', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\nk11023\\', 1360592645),
(71, 1, 'nv10013', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\nv10013\\', 1360592645),
(72, 1, 'oz11012', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\oz11012\\', 1360592645),
(73, 1, 'pr11001', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\pr11001\\', 1360592645),
(74, 1, 're11003', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\re11003\\', 1360592646),
(75, 1, 'RF11012', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\RF11012\\', 1360592646),
(76, 1, 'rz11017', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\rz11017\\', 1360592646),
(77, 1, 'rs11071', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\rs11071\\', 1360592646),
(78, 1, 'rh10008', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\rh10008\\', 1360592646),
(79, 1, 'sk11311', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\sk11311\\', 1360592646),
(80, 1, 'se11006', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\se11006\\', 1360592646),
(81, 1, 'ud11001', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\ud11001\\', 1360592646),
(82, 1, 'va11030', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\va11030\\', 1360592646),
(83, 1, 'vg11015', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\vg11015\\', 1360592647),
(84, 1, 'vr11015', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\vr11015\\', 1360592647),
(85, 1, 'vr11013', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\vr11013\\', 1360592647),
(86, 1, 'va11028', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\va11028\\', 1360592648),
(87, 1, 'vs10037', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\vs10037\\', 1360592648),
(88, 1, 'zb11024', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\zb11024\\', 1360592648),
(89, 1, 'eg11041', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\eg11041\\', 1360592649),
(90, 1, 'es10146', 'C:\\xampp\\htdocs\\md\\protected\\..\\archive\\6788\\es10146\\', 1360592649);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Satur vispārīgus datus par studentiem' AUTO_INCREMENT=91 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `surname`, `studentIDNumber`, `timestamp`) VALUES
(1, 'Agris', 'Ģērmanis', 'ag11111', 1360592634),
(2, 'Aleksandra', 'Zotova', 'az11112', 1360592634),
(3, 'Aleksandrs', 'Kurbatskis', 'ak11280', 1360592634),
(4, 'Aleksandrs', 'Kļimenko', 'ak11185', 1360592634),
(5, 'Aleksejs', 'Smišļajevs', 'as11187', 1360592634),
(6, 'Aleta', 'Zariņa', 'az11094', 1360592634),
(7, 'Alfrēds', 'Bendrups', 'ab11202', 1360592634),
(8, 'Anastasija', 'Zakomolkina', 'az11068', 1360592634),
(9, 'Andrejs', 'Bogdanovs', 'ab05059', 1360592635),
(10, 'Andris', 'Pakulis', 'ap11148', 1360592635),
(11, 'Andris', 'Tīsenkopfs', 'at11067', 1360592635),
(12, 'Anete', 'Didrihsone', 'ad09126', 1360592635),
(13, 'Anna', 'Guseva', 'ag11097', 1360592635),
(14, 'Armands', 'Baurovskis', 'ab11196', 1360592635),
(15, 'Armands', 'Einārs', 'AR10098', 1360592635),
(16, 'Armands', 'Ošiņš', 'ao11059', 1360592635),
(17, 'Artis', 'Burkevics', 'ab11161', 1360592635),
(18, 'Artūrs', 'Narņickis', 'AN10035', 1360592636),
(19, 'Artūrs', 'Olups', 'ao11022', 1360592636),
(20, 'Bruno', 'Treiguts', 'bt11009', 1360592637),
(21, 'Dana', 'Kukaine', 'dk11066', 1360592637),
(22, 'Daniels', 'Pitkevičs', 'dp11058', 1360592637),
(23, 'Deniss', 'Dmitrijevs', 'dd11035', 1360592637),
(24, 'Dmitrijs', 'Gaļļamovs', 'dg11041', 1360592637),
(25, 'Dzintars', 'Kanašēvics', 'dk11064', 1360592638),
(26, 'Dzintars', 'Rājevs', 'dr07021', 1360592638),
(27, 'Dāvis', 'Dreimanis', 'dd11043', 1360592638),
(28, 'Edgars', 'Ozols', 'eoo11018', 1360592638),
(29, 'Edgars', 'Ķemers', 'ek11137', 1360592638),
(30, 'Emil', 'Syundyukov', 'es11072', 1360592639),
(31, 'Francis', 'Zariņš', 'fz11002', 1360592639),
(32, 'Gustavs', 'Venters', 'gv11017', 1360592639),
(33, 'Gvido', 'Dzenis', 'gd11018', 1360592639),
(34, 'Igors', 'Šakurovs', 'is11208', 1360592640),
(35, 'Iļja', 'Gubins', 'ig11075', 1360592640),
(36, 'Janeks', 'Krasovskis', 'jk11108', 1360592640),
(37, 'Jans', 'Glagoļevs', 'jg11053', 1360592640),
(38, 'Jevgēnija', 'Ribalko', 'jr11046', 1360592640),
(39, 'Jānis', 'Galejs', 'jg11051', 1360592641),
(40, 'Jānis', 'Gulbinskis', 'jg11061', 1360592641),
(41, 'Jānis', 'Lācis', 'jl11038', 1360592641),
(42, 'Jānis', 'Ozoliņš', 'jo11021', 1360592641),
(43, 'Jānis', 'Zvirbulis', 'jz11044', 1360592641),
(44, 'Jūlija', 'Matjaša', 'jm11068', 1360592641),
(45, 'Kristaps', 'Freibergs', 'kf11003', 1360592642),
(46, 'Kristaps', 'Mikasenoks', 'KM11039', 1360592642),
(47, 'Kristaps', 'Straumēns', 'ks11072', 1360592642),
(48, 'Kristaps', 'Zariņš', 'kz11060', 1360592642),
(49, 'Kristers', 'Zīmecs', 'kz11041', 1360592643),
(50, 'Krišjānis', 'Balodis', 'kb11072', 1360592643),
(51, 'Krišjānis', 'Šmits', 'ks11056', 1360592643),
(52, 'Ksenija', 'Krilatiha', 'kk11101', 1360592643),
(53, 'Kārlis', 'Babris', 'kb11078', 1360592643),
(54, 'Kārlis', 'Freimanis', 'kf11005', 1360592643),
(55, 'Kārlis', 'Seņko', 'ks11077', 1360592643),
(56, 'Lauma', 'Šivare', 'ls11120', 1360592643),
(57, 'Laura', 'Silaraupe', 'ls11124', 1360592643),
(58, 'Laura', 'Ķezbere', 'lk11194', 1360592644),
(59, 'Maija', 'Ķemere', 'mk11250', 1360592644),
(60, 'Maksims', 'Savčuks', 'ms11148', 1360592644),
(61, 'Mareks', 'Indāns', 'mi11015', 1360592644),
(62, 'Marks', 'Slonimskis', 'ms11146', 1360592644),
(63, 'Monta', 'Kudiņa', 'mk11204', 1360592644),
(64, 'Mārcis', 'Kozulis', 'mk11252', 1360592644),
(65, 'Mārtiņš', 'Akermanis', 'ma11054', 1360592644),
(66, 'Mārtiņš', 'Laizāns', 'ml11053', 1360592644),
(67, 'Mārtiņš', 'Mieriņš', 'mm11302', 1360592645),
(68, 'Mārtiņš', 'Orups', 'mo11039', 1360592645),
(69, 'Mārtiņš', 'Ābele', 'ma11056', 1360592645),
(70, 'Nikolajs', 'Koņkovs', 'nk11023', 1360592645),
(71, 'Nikolajs', 'Vavilovs', 'nv10013', 1360592645),
(72, 'Oskars', 'Zandersons', 'oz11012', 1360592645),
(73, 'Pēteris', 'Rudzusīks', 'pr11001', 1360592645),
(74, 'Reinis', 'Elksnis', 're11003', 1360592646),
(75, 'Rihards', 'Fridrihsons', 'RF11012', 1360592646),
(76, 'Ričards', 'Zālītis', 'rz11017', 1360592646),
(77, 'Roberts', 'Sīlis', 'rs11071', 1360592646),
(78, 'Romans', 'Habibuļins', 'rh10008', 1360592646),
(79, 'Sabīna', 'Kupča', 'sk11311', 1360592646),
(80, 'Sigurds', 'Eglītis', 'se11006', 1360592646),
(81, 'Uldis', 'Dzilna', 'ud11001', 1360592646),
(82, 'Valdis', 'Ādamsons', 'va11030', 1360592646),
(83, 'Valters', 'Gajevskis', 'vg11015', 1360592647),
(84, 'Vita', 'Reizupa', 'vr11015', 1360592647),
(85, 'Vitālijs', 'Rakovs', 'vr11013', 1360592647),
(86, 'Vladislavs', 'Antoņuks', 'va11028', 1360592648),
(87, 'Vladislavs', 'Sokurenko', 'vs10037', 1360592648),
(88, 'Zigmunds', 'Beļskis', 'zb11024', 1360592648),
(89, 'Ēriks', 'Gopaks', 'eg11041', 1360592649),
(90, 'Ēriks', 'Šarapovs', 'es10146', 1360592649);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `received_homeworks`
--
ALTER TABLE `received_homeworks`
  ADD CONSTRAINT `received_homeworks_ibfk_1` FOREIGN KEY (`homestaskID`) REFERENCES `hometasks` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

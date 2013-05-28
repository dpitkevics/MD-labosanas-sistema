-- phpMyAdmin SQL Dump
-- version 4.0.0-rc4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2013 at 05:19 PM
-- Server version: 5.6.11
-- PHP Version: 5.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

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
  `type` int(1) NOT NULL,
  `criteria_sentence` blob NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `criteria_types`
--

DROP TABLE IF EXISTS `criteria_types`;
CREATE TABLE IF NOT EXISTS `criteria_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `criterion_type` int(1) NOT NULL,
  `type_name` varchar(128) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `criterion_type` (`criterion_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `criteria_types`
--

INSERT INTO `criteria_types` (`id`, `criterion_type`, `type_name`, `timestamp`) VALUES
(1, 1, 'Basic Function', 1369471458),
(2, 2, 'Validation through Validator', 1369471458),
(3, 3, 'User defined Javascript validation', 1369471458),
(4, 4, 'User defined validation class', 1369471458);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Satur vispārīgus datus par mājas darbiem' AUTO_INCREMENT=13 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Satur datus par iesūtītajiem mājas darbiem' AUTO_INCREMENT=94 ;

-- --------------------------------------------------------

--
-- Table structure for table `received_homework_grades`
--

DROP TABLE IF EXISTS `received_homework_grades`;
CREATE TABLE IF NOT EXISTS `received_homework_grades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `received_homework_id` int(11) NOT NULL,
  `grade` int(1) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `received_homework_id` (`received_homework_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `verifyPassword` varchar(128) NOT NULL,
  `name` varchar(32) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `criterias`
--
ALTER TABLE `criterias`
  ADD CONSTRAINT `criterias_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `criterias_ibfk_2` FOREIGN KEY (`type`) REFERENCES `criteria_types` (`criterion_type`);

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
-- Constraints for table `received_homework_grades`
--
ALTER TABLE `received_homework_grades`
  ADD CONSTRAINT `received_homework_grades_ibfk_1` FOREIGN KEY (`received_homework_id`) REFERENCES `received_homeworks` (`id`);

--
-- Constraints for table `user_hometasks`
--
ALTER TABLE `user_hometasks`
  ADD CONSTRAINT `user_hometasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_hometasks_ibfk_2` FOREIGN KEY (`hometask_id`) REFERENCES `hometasks` (`id`);


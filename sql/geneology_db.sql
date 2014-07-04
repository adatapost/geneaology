-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2014 at 10:36 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `geneology_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `marriage`
--

CREATE TABLE IF NOT EXISTS `marriage` (
  `marriage_id` int(11) NOT NULL AUTO_INCREMENT,
  `male_id` int(11) DEFAULT NULL,
  `female_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`marriage_id`),
  KEY `male_id` (`male_id`,`female_id`),
  KEY `male_id_2` (`male_id`),
  KEY `female_id` (`female_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `marriage`
--

INSERT INTO `marriage` (`marriage_id`, `male_id`, `female_id`) VALUES
(1, 4, 6),
(2, 7, 9),
(3, 8, 10),
(6, 11, 26),
(9, 12, 36),
(4, 15, 17),
(7, 16, 28),
(5, 18, 23),
(8, 19, 31),
(10, 35, 38),
(11, 40, 42),
(12, 41, 43);

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `person_id` int(11) NOT NULL AUTO_INCREMENT,
  `father_id` int(11) DEFAULT NULL,
  `mother_id` int(11) DEFAULT NULL,
  `person_name` varchar(50) DEFAULT NULL,
  `gender` varchar(7) NOT NULL,
  PRIMARY KEY (`person_id`),
  KEY `father_id` (`father_id`,`mother_id`),
  KEY `mother_id` (`mother_id`),
  KEY `father_id_2` (`father_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`person_id`, `father_id`, `mother_id`, `person_name`, `gender`) VALUES
(4, NULL, NULL, 'Mohanbhai', 'Male'),
(6, NULL, NULL, 'Hiraben', 'Female'),
(7, 4, 6, 'Virabhai', 'Male'),
(8, 4, 6, 'Naranbhai', 'Male'),
(9, NULL, NULL, 'Samuben', 'Female'),
(10, NULL, NULL, 'Jyotiben', 'Female'),
(11, 8, 10, 'Rajesh', 'Male'),
(12, 8, 10, 'Nitesh', 'Male'),
(13, 8, 10, 'Jyostna', 'Female'),
(14, 8, 10, 'Sangita', 'Female'),
(15, 7, 9, 'Kanu', 'Male'),
(16, 7, 9, 'Yogesh', 'Male'),
(17, NULL, NULL, 'Dharmistha', 'Female'),
(18, 4, 6, 'Iswarbhai', 'Male'),
(19, 4, 6, 'Manibhai', 'Male'),
(20, 4, 6, 'Maniben', 'Female'),
(21, 4, 6, 'Santokben', 'Female'),
(22, 4, 6, 'Shantaben', 'Female'),
(23, NULL, NULL, 'Taraben', 'Female'),
(24, 15, 17, 'Hiral', 'Female'),
(25, 15, 17, 'Harsh', 'Male'),
(26, NULL, NULL, 'Jyostna', 'Female'),
(27, 11, 26, 'Mit', 'Male'),
(28, NULL, NULL, 'Aruna', 'Female'),
(29, 16, 28, 'Mayuri', 'Female'),
(30, 16, 28, 'Hetul', 'Male'),
(31, NULL, NULL, 'Narmbdaben', 'Female'),
(32, 19, 31, 'Chandrika', 'Female'),
(33, 19, 31, 'Anjana', 'Female'),
(34, 19, 31, 'Jayshree', 'Female'),
(35, 19, 31, 'Prakash', 'Male'),
(36, NULL, NULL, 'Geeta', 'Female'),
(37, 12, 36, 'Dhruvi', 'Female'),
(38, NULL, NULL, 'Komal', 'Female'),
(39, 35, 38, 'Vraj', 'Male'),
(40, 18, 23, 'Jignesh', 'Male'),
(41, 18, 23, 'Tushar', 'Male'),
(42, NULL, NULL, 'Komal', 'Female'),
(43, NULL, NULL, 'Bhavna', 'Female');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `marriage`
--
ALTER TABLE `marriage`
  ADD CONSTRAINT `fk_person_female` FOREIGN KEY (`female_id`) REFERENCES `person` (`person_id`),
  ADD CONSTRAINT `fk_person_male` FOREIGN KEY (`male_id`) REFERENCES `person` (`person_id`);

--
-- Constraints for table `person`
--
ALTER TABLE `person`
  ADD CONSTRAINT `fk_mother` FOREIGN KEY (`mother_id`) REFERENCES `person` (`person_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_father` FOREIGN KEY (`father_id`) REFERENCES `person` (`person_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

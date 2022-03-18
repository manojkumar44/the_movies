-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 18, 2022 at 04:36 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movies_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `directors`
--

DROP TABLE IF EXISTS `directors`;
CREATE TABLE IF NOT EXISTS `directors` (
  `dir_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `dir_fname` varchar(50) NOT NULL,
  `dir_lname` varchar(50) NOT NULL,
  PRIMARY KEY (`dir_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `directors_movies`
--

DROP TABLE IF EXISTS `directors_movies`;
CREATE TABLE IF NOT EXISTS `directors_movies` (
  `dir_id` smallint(5) UNSIGNED NOT NULL,
  `movie_id` smallint(5) UNSIGNED NOT NULL,
  PRIMARY KEY (`dir_id`,`movie_id`),
  KEY `movie_id` (`movie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

DROP TABLE IF EXISTS `genres`;
CREATE TABLE IF NOT EXISTS `genres` (
  `genre_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `genre` varchar(50) NOT NULL,
  PRIMARY KEY (`genre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`genre_id`, `genre`) VALUES
(1, 'Horror'),
(2, 'Action'),
(3, 'Comedy'),
(4, 'Science fiction'),
(5, 'Western'),
(6, 'Romance'),
(7, 'Crime'),
(8, 'Drama'),
(9, 'Animation'),
(10, 'Adventure'),
(11, 'Animation'),
(12, 'Historical'),
(13, 'Musical'),
(14, 'War'),
(15, 'Disaster'),
(16, 'Noir'),
(17, 'Slasher'),
(18, 'Martial Arts'),
(19, 'Mystery');

-- --------------------------------------------------------

--
-- Table structure for table `genres_movies`
--

DROP TABLE IF EXISTS `genres_movies`;
CREATE TABLE IF NOT EXISTS `genres_movies` (
  `genre_id` tinyint(3) UNSIGNED NOT NULL,
  `movie_id` smallint(5) UNSIGNED NOT NULL,
  PRIMARY KEY (`genre_id`,`movie_id`),
  KEY `movie_id` (`movie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `genres_movies`
--

INSERT INTO `genres_movies` (`genre_id`, `movie_id`) VALUES
(1, 23),
(2, 1),
(2, 22),
(2, 23),
(4, 22),
(4, 23),
(7, 1),
(8, 1),
(10, 22),
(10, 23),
(18, 1);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `movie_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `movie_title` varchar(50) NOT NULL,
  `movie_rating` decimal(2,1) NOT NULL,
  `year_released` smallint(4) UNSIGNED NOT NULL,
  PRIMARY KEY (`movie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `movie_title`, `movie_rating`, `year_released`) VALUES
(1, 'Enter The Dragon', '7.6', 1973),
(2, 'Grace', '5.2', 2009),
(3, 'The Girl with All the Gifts', '6.6', 2016),
(4, 'Kickboxer', '6.4', 1989),
(5, 'To Kill a Mockingbird', '8.3', 1962),
(6, 'Some Like It Hot', '8.2', 1959),
(7, 'The Day After Tomorrow', '6.4', 2004),
(8, 'Natural Born Killers', '7.2', 1994),
(9, 'Ghost', '7.1', 1990),
(10, 'Silence Of The Lambs', '8.6', 1991),
(11, 'The Karate Kid', '7.3', 1984),
(12, 'Apocalypto', '7.8', 2007),
(13, 'Hard Candy', '7.0', 2005),
(14, 'Dogtooth', '7.2', 2009),
(15, 'Die Hard', '8.3', 1988),
(16, 'Robocop', '7.6', 1987),
(17, 'The Nanny', '7.1', 1965),
(18, 'American Psycho', '7.6', 2000),
(19, 'The Beach', '6.6', 2000),
(20, 'Enemy Of The State', '7.3', 1998),
(21, 'Fast Color', '6.0', 2019),
(22, 'Escape from New York', '7.1', 1981),
(23, 'Aliens', '8.4', 1986),
(24, 'Touch of Evil', '8.0', 1958),
(25, 'X-Men: Days of Future Past', '8.0', 2014),
(26, 'The Hand that Rocks the Cradle', '6.7', 1992),
(27, 'Juno', '7.5', 2007),
(28, 'Minority Report', '7.7', 2002),
(29, 'Pulp Fiction', '8.9', 1994),
(30, 'Independence Day', '7.0', 1996),
(31, 'The Breakfast Club', '7.8', 1985),
(32, 'The Godfather: Part II', '9.0', 1974),
(34, 'Searching', '7.6', 2018),
(35, 'Captive State', '6.0', 2019),
(36, 'Crawl', '6.1', 2019),
(37, 'Mr. Smith Goes to Washington', '8.1', 1939),
(38, 'Rebel Without A Cause', '7.7', 1955),
(39, 'Taxi Driver', '8.3', 1976),
(40, 'Solace', '6.4', 2015),
(41, 'The Assistant', '6.3', 2019),
(42, 'The Dark Knight', '9.1', 2008),
(43, 'Bad Lieutenant: Port of Call New Orleans', '6.6', 2009),
(44, 'Drop Dead Gorgeous', '6.6', 1999);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `directors_movies`
--
ALTER TABLE `directors_movies`
  ADD CONSTRAINT `directors_movies_ibfk_1` FOREIGN KEY (`dir_id`) REFERENCES `directors` (`dir_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `directors_movies_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `genres_movies`
--
ALTER TABLE `genres_movies`
  ADD CONSTRAINT `genres_movies_ibfk_1` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`genre_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `genres_movies_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

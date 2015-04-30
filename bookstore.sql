-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2015 at 07:29 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `authorID` int(11) NOT NULL,
  `firstName` varchar(20) DEFAULT NULL,
  `lastName` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`authorID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`authorID`, `firstName`, `lastName`) VALUES
(1, 'David', 'Eiteman'),
(2, 'Arthur', 'Stonehill'),
(3, 'Michael', 'Moffett'),
(4, 'Philip', 'Adelman'),
(5, 'Alan', 'Marks'),
(6, 'Greg', 'Anderson'),
(7, 'William', 'Heward'),
(8, 'Kisha', 'Daniels'),
(9, 'Gerrelyn', 'Patterson'),
(10, 'Yolanda', 'Dunston'),
(11, 'William', 'Duiker'),
(12, 'Jackson', 'Spielvogel'),
(13, 'Jeremy', 'Popkin'),
(14, 'Abraham', 'Silberschatz'),
(15, 'Henry', 'Korth');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `ISBN13` varchar(15) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `publisher` varchar(50) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `edition` int(11) DEFAULT NULL,
  `categoryID` varchar(3) DEFAULT NULL,
  `availableNum` int(11) DEFAULT NULL,
  `price` double(6,2) DEFAULT NULL,
  `description` text,
  `frontpagePath` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`ISBN13`),
  KEY `categoryID` (`categoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`ISBN13`, `title`, `publisher`, `year`, `edition`, `categoryID`, `availableNum`, `price`, `description`, `frontpagePath`) VALUES
('9780073523323', 'Database System Concepts', 'McGraw-Hill Higher Education', 2010, 6, 'C2', 40, 187.92, 'The text is designed for a first course in databases at the junior/senior undergraduate level or the first year graduate level. It also contains additional material that can be used as supplements or as introductory material for an advanced course. Because the authors present concepts as intuitive descriptions, a familiarity with basic data structures, computer organization, and a high-level programming language are the only prerequisites. Important theoretical results are covered, but formal proofs are omitted. In place of proofs, figures and examples are used to suggest why a result is true.', '9780073523323.JPG'),
('9780132626163', 'Exceptional Children: An Introduction to Special E', 'Pearson', 2012, 2, 'C3', 48, 151.96, 'This leading text in the market comprehensively examines all aspects of disability. Using a categorical approach the authors provide students with a discussion of characteristics, etiology, and educational implications. Numerous boxes, profiling individuals with disabilities, emphasize the humanistic views of the authors and encourage students to view persons with disabilities in a positive way.', '9780132626163.JPG'),
('9780132743464', 'Multinational Business Finance', 'Prentice Hall', 2012, 13, 'C1', 49, 217.96, 'Renowned for its authoritative, comprehensive coverage of contemporary international finance, this market-leading text trains the leaders of tomorrow’s multinational enterprises to recognize and capitalize on the unique characteristics of global markets. Because the job of a manager is to make financial decisions that increase firm value, the authors have embedded real-world mini-cases throughout to apply chapter concepts to the types of situations managers of multinational firms face.', '9780132743464.JPG'),
('9780138129835', 'Small Business Finance', 'Pearson', 1997, 1, 'C1', 49, 94.50, 'This practical book is geared for individuals interested in starting a small business — primarily those organized as sole proprietorships, partnerships, or small Subchapter S corporations. The book includes solved problems for every chapter; end-of-chapter questions with answers; and open questions to encourage readers to utilize current business information; and detailed illustrations and tables. Of interest to those who desire to learn more about financial management, and can be used as a stepping stone toward learning finance on a corporate level.', '9780138129835.JPG'),
('9780205968459', 'A Short History of the French Revolution ', 'Pearson', 2014, 6, 'C4', 48, 47.45, 'Written for todays undergraduates, this up-to-date survey of the French Revolution and Napoleonic era offers a concise alternative to the longer texts geared to advanced study in the field. This text introduces students to the major events that comprise the story of the French Revolution; to the different ways in which historians have interpreted these event; to the political, social, and cultural origins of the Revolution; and to recent scholarship in the field.', '9780205968459.JPG'),
('9781305091207', 'World History', 'Cengage Learning', 2015, 8, 'C4', 50, 175.58, 'l time periods, to help readers understand the course of world history and make connections across chapters.', '9781305091207.JPG'),
('9781439080351', 'Connecting with Computer Science', 'Cengage Learning', 2010, 2, 'C2', 50, 144.30, 'Written for the beginning computing student, this text engages readers by relating core computer science topics to their industry application. The book is written in a comfortable, informal manner, and light humor is used throughout the text to maintain interest and enhance learning. All chapters contain a multitude of exercises, quizzes, and other opportunities for skill application.', '9781439080351.JPG'),
('9781452299822', 'The Ultimate Student Teaching Guide', 'SAGE Publications', 2014, 1, 'C3', 50, 41.18, 'Concise and focused on practical strategies, this engaging, lighthearted guide provides teacher candidates a road map for negotiating the complex and diverse terrain of pre-K through 12 schools, while providing opportunities to develop the skills of reflection that are crucial to becoming a successful practitioner. The Ultimate Student Teaching Guide, Second Edition, by Kisha N. Daniels, Gerrelyn C. Patterson, and Yolanda L. Dunston, provides practical, research-based, field-tested strategies that student teachers can immediately apply as they encounter school concerns, solve classroom challenges, negotiate social conflicts, and, new to this edition, navigate the job search and interview process. Thoroughly updated throughout, the Second Edition includes expanded coverage of workplace professionalism, an introduction to accreditation and the Common Core standards, and more.', '9781452299822.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `book_author`
--

CREATE TABLE IF NOT EXISTS `book_author` (
  `ISBN13` varchar(15) DEFAULT NULL,
  `authorID` int(11) DEFAULT NULL,
  KEY `ISBN13` (`ISBN13`),
  KEY `authorID` (`authorID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_author`
--

INSERT INTO `book_author` (`ISBN13`, `authorID`) VALUES
('9780132743464', 1),
('9780132743464', 2),
('9780132743464', 3),
('9780138129835', 4),
('9780138129835', 5),
('9781439080351', 6),
('9780132626163', 7),
('9781452299822', 8),
('9781452299822', 9),
('9781452299822', 10),
('9781305091207', 11),
('9781305091207', 12),
('9780205968459', 13),
('9780073523323', 14),
('9780073523323', 15);

-- --------------------------------------------------------

--
-- Table structure for table `book_order`
--

CREATE TABLE IF NOT EXISTS `book_order` (
  `ISBN13` varchar(15) DEFAULT NULL,
  `orderNo` int(11) DEFAULT NULL,
  `quantity` int(5) DEFAULT NULL,
  KEY `ISBN13` (`ISBN13`),
  KEY `orderNo` (`orderNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_order`
--

INSERT INTO `book_order` (`ISBN13`, `orderNo`, `quantity`) VALUES
('9780073523323', 1, 3),
('9780132626163', 1, 1),
('9780205968459', 1, 2),
('9780132743464', 1, 1),
('9780138129835', 2, 1),
('9780073523323', 2, 1),
('9780132626163', 2, 1),
('9780073523323', 3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `categoryID` varchar(3) NOT NULL,
  `categoryName` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `categoryName`) VALUES
('C1', 'Business'),
('C2', 'Computers'),
('C3', 'Education'),
('C4', 'History');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) DEFAULT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `street` varchar(40) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `state` varchar(10) DEFAULT NULL,
  `zipCode` varchar(15) DEFAULT NULL,
  `creditcardNum` varchar(12) DEFAULT NULL,
  `securityCode` varchar(3) DEFAULT NULL,
  `phoneNum` varchar(20) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`username`, `password`, `first_name`, `last_name`, `street`, `city`, `state`, `zipCode`, `creditcardNum`, `securityCode`, `phoneNum`, `email`) VALUES
('admin', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('alex', '1234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('kunchen', '123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('rd', '1234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('u', 'p', 'Bob', 'Glass', 'Spring garden road', 'Greensboro', 'NC', '27407', '123412341234', '123', '3363333333', 'uu@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

CREATE TABLE IF NOT EXISTS `customer_order` (
  `username` varchar(20) DEFAULT NULL,
  `orderNo` int(11) DEFAULT NULL,
  KEY `username` (`username`),
  KEY `orderNo` (`orderNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_order`
--

INSERT INTO `customer_order` (`username`, `orderNo`) VALUES
('rd', 1),
('rd', 2),
('rd', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `orderNo` int(11) NOT NULL AUTO_INCREMENT,
  `time` datetime DEFAULT NULL,
  `status` varchar(40) DEFAULT NULL,
  `creditNo` int(15) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `total` double(6,2) DEFAULT NULL,
  PRIMARY KEY (`orderNo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1001 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderNo`, `time`, `status`, `creditNo`, `address`, `total`) VALUES
(1, '2015-04-13 17:20:36', 'Processed', 123456, '750-3B Fulton Pl, Greensboro, NC 27401', 1028.58),
(2, '2015-04-13 17:21:16', 'Processed', 123456, '750-3B Fulton Pl, Greensboro, NC 27401', 434.38),
(3, '2015-04-14 18:23:07', 'Processed', 0, 'jdfakj', 1127.52);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE IF NOT EXISTS `shopping_cart` (
  `username` varchar(20) DEFAULT NULL,
  `ISBN13` varchar(15) DEFAULT NULL,
  `quantity` int(5) DEFAULT NULL,
  KEY `username` (`username`),
  KEY `ISBN13` (`ISBN13`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopping_cart`
--

INSERT INTO `shopping_cart` (`username`, `ISBN13`, `quantity`) VALUES
('rd', '9780073523323', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE IF NOT EXISTS `wishlist` (
  `username` varchar(20) DEFAULT NULL,
  `ISBN13` varchar(15) DEFAULT NULL,
  KEY `username` (`username`),
  KEY `ISBN13` (`ISBN13`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`username`, `ISBN13`) VALUES
('alex', '9780073523323'),
('alex', '9780132626163');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`);

--
-- Constraints for table `book_author`
--
ALTER TABLE `book_author`
  ADD CONSTRAINT `book_author_ibfk_1` FOREIGN KEY (`ISBN13`) REFERENCES `books` (`ISBN13`),
  ADD CONSTRAINT `book_author_ibfk_2` FOREIGN KEY (`authorID`) REFERENCES `author` (`authorID`);

--
-- Constraints for table `book_order`
--
ALTER TABLE `book_order`
  ADD CONSTRAINT `book_order_ibfk_1` FOREIGN KEY (`ISBN13`) REFERENCES `books` (`ISBN13`),
  ADD CONSTRAINT `book_order_ibfk_2` FOREIGN KEY (`orderNo`) REFERENCES `orders` (`orderNo`);

--
-- Constraints for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD CONSTRAINT `customer_order_ibfk_1` FOREIGN KEY (`username`) REFERENCES `customers` (`username`),
  ADD CONSTRAINT `customer_order_ibfk_2` FOREIGN KEY (`orderNo`) REFERENCES `orders` (`orderNo`);

--
-- Constraints for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD CONSTRAINT `shopping_cart_ibfk_1` FOREIGN KEY (`username`) REFERENCES `customers` (`username`),
  ADD CONSTRAINT `shopping_cart_ibfk_2` FOREIGN KEY (`ISBN13`) REFERENCES `books` (`ISBN13`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`username`) REFERENCES `customers` (`username`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`ISBN13`) REFERENCES `books` (`ISBN13`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

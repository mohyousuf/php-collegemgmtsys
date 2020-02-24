-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2019 at 05:33 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `title`, `msg`) VALUES
(1, 'Holiday Closing!', 'So that we can all spend valuable time with our families, this Thanksgiving and the following Friday will be paid holidays for all employees. Enjoy the long weekend!'),
(2, 'New Business Partner', 'Eric Doe has recently joined the law firm of Johnson and Johnson as a partner. The firm Johnson, Johnson, and Doe will continue at its present location of 1600 Main Street in Springfield under its new name. Mr. Doe is a graduate of Springfield Law School and specializes in criminal defense law.'),
(3, 'Bad News to Employee', 'I am sorry to report that Doe Enterprises has not renewed their contract for the next year. Since 20% of our business was with Doe, the loss will cause us to reduce our staff. It appears that there will be a partial layoff in June, but fortunately this will be offset somewhat by a number of retirements this summer.\n\nWe are working hard to reestablish our relationship with this company and to acquire new accounts abroad. Until we succeed we ask for your understanding and cooperation. With your help this will be only a temporary setback. We will keep you informed with weekly updates on e-mail.'),
(4, 'Celebration!', 'Doe Associates, a state leader in custom home designs, will celebrate its 50th anniversary with a week-long model home show beginning Monday, August 23, and ending August 30. The show will include daily guided tours of their latest designs at 1600 Main Street in Springfield. The public is invited to view the homes from 8:00 a.m. to 10:00 p.m. each day. Designers will be on hand to answer questions. Prizes, including a new car, will be awarded. Refreshments will be offered!\n\nFounded shortly after WWII by the Doe Brothers, the company has grown in five years to employ 90 full-time craftsmen. Dedicated to the creation of customized homes at a modest cost, Doe Associates is now the leader in custom home construction in Spring');

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `batch_id` varchar(10) CHARACTER SET utf8 NOT NULL,
  `module_id` varchar(10) CHARACTER SET utf8 NOT NULL,
  `s_uname` varchar(100) CHARACTER SET utf8 NOT NULL,
  `file` varchar(100) CHARACTER SET utf8 NOT NULL,
  `date` date NOT NULL,
  `title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`batch_id`, `module_id`, `s_uname`, `file`, `date`, `title`) VALUES
('COM1500', 'M10', 'yuziferr', 'COM1500_M10_yuziferr_Chapter 3.docx', '2019-06-11', 'Chapter 3'),
('COM1500', 'M280', 'yuziferr', 'COM1500_M280_yuziferr_Commerce Assessment.docx', '2019-06-12', 'Commerce Assessment'),
('COM1500', 'M10', 'yuziferr', 'COM1500_M10_yuziferr_Week 2.docx', '2013-12-31', 'Week 2');

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `batch_id` varchar(10) NOT NULL,
  `course_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`batch_id`, `course_id`) VALUES
('COM1000', 'C20'),
('COM1500', 'C20'),
('COM2000', 'C200'),
('COM2300', 'C200'),
('COM3200', 'C75'),
('COM4000', 'C90');

-- --------------------------------------------------------

--
-- Table structure for table `batch_student`
--

CREATE TABLE `batch_student` (
  `batch_id` varchar(10) NOT NULL,
  `s_uname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `batch_student`
--

INSERT INTO `batch_student` (`batch_id`, `s_uname`) VALUES
('COM1000', 'alpacino'),
('COM1000', 'brennan'),
('COM1000', 'jerkiss'),
('COM1000', 'keshwan'),
('COM1000', 'maya'),
('COM1000', 'wayne'),
('COM1000', 'zed'),
('COM1500', 'june'),
('COM1500', 'landen.bartoletti'),
('COM1500', 'marcos'),
('COM1500', 'napoleon.waelchi'),
('COM1500', 'natalia_smith'),
('COM1500', 'sherpherds'),
('COM1500', 'yuziferr'),
('COM2000', 'bertrand_okeefe'),
('COM2000', 'ellen'),
('COM2000', 'garth'),
('COM2000', 'harmon'),
('COM2000', 'hayden'),
('COM2000', 'jena_abshire'),
('COM2000', 'kathryne'),
('COM2000', 'maxwell'),
('COM2000', 'patsy_mayert'),
('COM2000', 'shaun.christiansen'),
('COM2300', 'elliott'),
('COM2300', 'koby'),
('COM2300', 'lea_torphy'),
('COM2300', 'olaf.hammes'),
('COM2300', 'royce_grady'),
('COM3200', 'edwin'),
('COM3200', 'flossie_goldner'),
('COM3200', 'hudson_robel'),
('COM3200', 'jameson'),
('COM3200', 'jarrell.funk'),
('COM3200', 'maryam'),
('COM3200', 'mike.powlowski'),
('COM4000', 'erwin.moore'),
('COM4000', 'gunner_lowe'),
('COM4000', 'helena_greenfelder'),
('COM4000', 'marion.hilll'),
('COM4000', 'telly');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `isbn` varchar(20) NOT NULL,
  `title` varchar(40) DEFAULT NULL,
  `year` varchar(40) DEFAULT NULL,
  `author` varchar(40) DEFAULT NULL,
  `qty` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`isbn`, `title`, `year`, `author`, `qty`) VALUES
('978-1-60309-069-8', 'August Moon', '2019', 'Diana Thung', '1'),
('978-1-60309-077-3', 'Any Empire', '2008', 'Nate Powell', '245'),
('978-1-60309-2395', 'American Elf 1999', '2019', 'James Kochalka', '500'),
('978-1-60309-347-7', 'Pinocchio, Vampire Slayer', '2010', 'Dusty Higgins', '459'),
('978-1-60309-405-4', 'The Aviator', '2002', 'Martin Scorsese', '255'),
('978-1-60309-428-3', 'Come Again', '2010', 'Nate Powell', '95'),
('978-1-60309-441-2', 'Highwayman', '2017', 'Koren Shadmi', '359'),
('978-1-60309-442-9', 'Belzebubs', '2016', 'JP Ahonen', '159'),
('978-1-60309-445-0', 'A Shining Beacon', '2016', 'James Albon', '781'),
('978-1-60309-450-4', 'They Called Us Enemy', '2007', 'Harmony Becker', '430'),
('978-1-60309-453-5', 'Why Did We Trust Him?', '2014', 'Shannon Wheeler', '750'),
('978-1-60309-462-7', 'An Embarrassment of Witches', '2015', 'Sophie Goldstein', '490'),
('978-1-891830-10-5', 'Nemo: Heart of Ice', '20019', 'Alan Moore', '900'),
('978-1-891830-22-8', 'Abe: Wrong for the Right Reasons', '2009', 'Glenn Dakin', '138'),
('978-1-891830-40-2', 'Beach Safari', '2017', 'Mawil', '249'),
('978-1-891830-55-6', 'Pulp Fiction', '1994', 'Quentin Tarantino', '4500'),
('978-1-891830-97-6', 'Fox Bunny Funny', '2008', 'Andy Hartzell', '899');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` varchar(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `duration` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `title`, `duration`) VALUES
('C20', 'Computer Science', 36),
('C200', 'Web and Mobile Application Development', 36),
('C75', 'Networking and Network Security', 36),
('C90', 'Business Management', 30);

-- --------------------------------------------------------

--
-- Table structure for table `course_module`
--

CREATE TABLE `course_module` (
  `course_id` varchar(10) NOT NULL,
  `module_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_module`
--

INSERT INTO `course_module` (`course_id`, `module_id`) VALUES
('C90', 'M202'),
('C90', 'M285'),
('C90', 'M350'),
('C90', 'M370'),
('C90', 'M380'),
('C90', 'M89'),
('C90', 'M99'),
('C90', 'M9'),
('C90', 'M4'),
('C200', 'M10'),
('C200', 'M15'),
('C200', 'M17'),
('C200', 'M18'),
('C200', 'M20'),
('C200', 'M4'),
('C200', 'M40'),
('C200', 'M400'),
('C200', 'M50'),
('C200', 'M59'),
('C200', 'M85'),
('C200', 'M9'),
('C200', 'M98'),
('C200', 'M960'),
('C200', 'M97'),
('C200', 'M995'),
('C200', 'M93'),
('C200', 'M200'),
('C200', 'M250'),
('C200', 'M20'),
('C75', 'M40'),
('C75', 'M50'),
('C75', 'M97'),
('C75', 'M280'),
('C75', 'M400'),
('C75', 'M56'),
('C75', 'M54'),
('C75', 'M10'),
('C75', 'M50'),
('C75', 'M59'),
('C75', 'M56'),
('C75', 'M40'),
('C75', 'M59'),
('C75', 'M85'),
('C75', 'M85'),
('C75', 'M15'),
('C75', 'M9'),
('C75', 'M9'),
('C75', 'M98'),
('C75', 'M400'),
('C75', 'M97'),
('C75', 'M98'),
('C75', 'M54'),
('C75', 'M17'),
('C75', 'M56'),
('C75', 'M97'),
('C75', 'M50'),
('C75', 'M54'),
('C75', 'M18'),
('C75', 'M56'),
('C75', 'M59'),
('C75', 'M20'),
('C75', 'M85'),
('C75', 'M4'),
('C75', 'M9'),
('C75', 'M280'),
('C75', 'M98'),
('C75', 'M40'),
('C75', 'M97'),
('C75', 'M400'),
('C75', 'M54'),
('C75', 'M50'),
('C75', 'M56'),
('C75', 'M59'),
('C75', 'M85'),
('C75', 'M9'),
('C75', 'M98'),
('C75', 'M97'),
('C75', 'M54'),
('C75', 'M56'),
('C20', 'M10'),
('C20', 'M15'),
('C20', 'M17'),
('C20', 'M18'),
('C20', 'M20'),
('C20', 'M4'),
('C20', 'M280'),
('C20', 'M40'),
('C20', 'M400'),
('C20', 'M50'),
('C20', 'M59'),
('C20', 'M85'),
('C20', 'M9'),
('C20', 'M98'),
('C20', 'M960'),
('C20', 'M97'),
('C20', 'M990');

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `batch_id` varchar(10) NOT NULL,
  `module_id` varchar(10) NOT NULL,
  `s_uname` varchar(100) NOT NULL,
  `grade` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`batch_id`, `module_id`, `s_uname`, `grade`) VALUES
('COM1000', 'M10', 'wayne', 'Distinction'),
('COM1000', 'M10', 'zed', 'Merit'),
('COM1000', 'M15', 'brennan', 'Merit'),
('COM1000', 'M15', 'jerkiss', 'Pass'),
('COM1000', 'M15', 'wayne', 'Pass'),
('COM1000', 'M280', 'alpacino', 'Distinction'),
('COM1000', 'M280', 'brennan', 'Merit'),
('COM1500', 'M10', 'june', 'Merit'),
('COM1500', 'M10', 'marcos', 'Distinction'),
('COM1500', 'M10', 'napoleon.waelchi', 'Merit'),
('COM1500', 'M10', 'natalia_smith', 'Merit'),
('COM1500', 'M15', 'sherpherds', 'Pass'),
('COM1500', 'M20', 'yuziferr', 'Pass'),
('COM1500', 'M280', 'landen.bartoletti', 'Pass'),
('COM1500', 'M280', 'yuziferr', 'Fail'),
('COM1500', 'M59', 'yuziferr', 'Pass'),
('COM1500', 'M960', 'yuziferr', 'Distinction'),
('COM1500', 'M98', 'yuziferr', 'Distinction'),
('COM1500', 'M995', 'yuziferr', 'Pass'),
('COM2000', 'M17', 'ellen', 'Distinction'),
('COM2000', 'M17', 'garth', 'Merit'),
('COM2000', 'M17', 'harmon', 'Distinction'),
('COM2000', 'M17', 'jena_abshire', 'Distinction'),
('COM2000', 'M17', 'kathryne', 'Merit'),
('COM2000', 'M17', 'patsy_mayert', 'Fail'),
('COM2300', 'M59', 'elliott', 'Distinction'),
('COM2300', 'M59', 'koby', 'Pass'),
('COM2300', 'M59', 'olaf.hammes', 'Distinction'),
('COM2300', 'M59', 'royce_grady', 'Merit'),
('COM3200', 'M18', 'jarrell.funk', 'Distinction'),
('COM3200', 'M40', 'hudson_robel', 'Merit'),
('COM3200', 'M54', 'jarrell.funk', 'Distinction'),
('COM4000', 'M350', 'erwin.moore', 'Distinction'),
('COM4000', 'M350', 'helena_greenfelder', 'Distinction'),
('COM4000', 'M350', 'marion.hilll', 'Merit'),
('COM4000', 'M350', 'telly', 'Merit'),
('COM4000', 'M380', 'erwin.moore', 'Merit'),
('COM4000', 'M380', 'marion.hilll', 'Distinction'),
('COM4000', 'M89', 'marion.hilll', 'Distinction');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE `lecturer` (
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`fname`, `lname`, `dob`, `address`, `email`, `phone`, `uname`, `pass`) VALUES
('Andres', 'Iannone', '1980-04-15', 'Italia Seville', 'andre@out-mail.com', '025123485', 'andre29', '000'),
('Christian', 'Guerrero', '1950-04-05', 'Seal St.', 'christ@jesus.com', '---', 'christboy', '199'),
('Elvie', 'Greenholt', '2019-05-10', 'Jeromyberg', 'Nat_Krajcik@giovani.org', '1-008-474-3901', 'cicero', '78456'),
('John', 'Wayne', '1940-05-11', 'Wild West', 'cowboy@gmail.com', ' 96 12 457 8963', 'cowboy', '456'),
('Craig', 'Larkin', '2019-05-18', 'East Kathleenland', 'Cheyanne_Stehr@katelin.co.uk', '020-876-8941', 'elian.terry', 'CJK45123'),
('Jack', 'Bautista', '2000-05-05', 'Dave Street', 'jackb@mail.com', '555', 'jackb', '888'),
('James', 'Fish', '2000-04-10', 'Pisces St', 'jaja@gmail.com', '---', 'jamesfish', '999'),
('James', 'Barbera', '2014-02-20', 'Price Street', 'jbarb@gmail.com', '0751231235', 'jbarb', '555'),
('John', 'Doe', '2000-11-20', 'Chapel Lane', 'johndoe@example.com', '070 123 4567', 'johndoe', 'johndoe999'),
('Jorge', 'Lorenzo', '2019-05-09', '80F, Colombo', 'jorge@gmail.com', '123', 'jorge', '1234'),
('Nick', 'Bateman', '1950-09-08', 'Mexico Street', 'nickbate@gmail.com', '1-653-150-7503', 'nickbat', 'nick123'),
('Suzanne', 'Yundt', '2019-05-09', 'North Rodrigo', 'Armand.Ferry@emmet.biz', '531-617-3845', 'tristin.walker', 'yondelll');

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `id` int(10) NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 NOT NULL,
  `module_id` varchar(100) CHARACTER SET utf8 NOT NULL,
  `file` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`id`, `title`, `module_id`, `file`) VALUES
(17, 'Assignment Brief', 'M200', 'M1011_Assignment Brief.docx'),
(18, 'Guidance', 'M20', 'M20_Guidance.docx'),
(19, 'Guidance II', 'M1011', 'M1011_Guidance II.docx'),
(21, 'Assignment Brief V', 'M1011', 'M1011_Assignment Brief V.PNG'),
(22, 'Assignment Brief V', 'M17', 'M17_Assignment Brief V.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `module_id` varchar(10) NOT NULL,
  `title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`module_id`, `title`) VALUES
('M10', 'Computing Fundamentals'),
('M1011', 'Introduction to C#'),
('M15', 'Programming I â€“ Thinking like a programmer'),
('M17', 'Computing Systems'),
('M18', 'Requirements Analysis and Design'),
('M20', 'Server Side Programming'),
('M200', 'JavaScript Frameworks 1'),
('M202', 'Business and the Business Environment'),
('M203', 'Marketing Essentials'),
('M250', 'JavaScript Frameworks 2'),
('M280', 'E-Commerce'),
('M285', 'Human Resource Management'),
('M33', 'Networking Concepts'),
('M350', 'Financial Accounting'),
('M370', 'Management and Operations'),
('M380', 'Management Accounting'),
('M4', 'Professional Environments 1'),
('M40', 'Database-Driven Application Development'),
('M400', 'Introduction to Programming'),
('M50', 'Web Development Basics'),
('M54', 'Cyber Security'),
('M56', 'Internet Protocols and Services'),
('M59', 'Advanced Data Modelling'),
('M85', 'Software Development Practice'),
('M89', 'Business Law'),
('M9', 'Professional Environments 2'),
('M93', 'Mobile Application Development'),
('M960', 'Algorithms 1'),
('M97', 'Programming III â€“ Patterns and Algorithms'),
('M98', 'Programming II â€“ Software Development'),
('M99', 'Global Business Environment'),
('M990', 'Introduction to JavaScript'),
('M995', 'Algorithms 2');

-- --------------------------------------------------------

--
-- Table structure for table `operator`
--

CREATE TABLE `operator` (
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `operator`
--

INSERT INTO `operator` (`fname`, `lname`, `dob`, `address`, `email`, `phone`, `uname`, `pass`) VALUES
('Yusuf', 'Hassen', '2000-11-20', 'Newland', 'yuziferrr@mail.com', ' 94754049979', 'admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `batch_id` varchar(10) NOT NULL,
  `l_uname` varchar(100) NOT NULL,
  `day` varchar(10) NOT NULL,
  `time` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`batch_id`, `l_uname`, `day`, `time`) VALUES
('COM1000', 'christboy', 'Wednesday', '03:03'),
('COM1000', 'christboy', 'Wednesday', '03:04'),
('COM1000', 'elian.terry', 'Tuesday', '08:00'),
('COM1000', 'jackb', 'Thursday', '00:00'),
('COM1000', 'jbarb', 'Sunday', '09:09'),
('COM1000', 'tristin.walker', 'Monday', '14:00'),
('COM1500', 'cicero', 'Saturday', '09:30'),
('COM1500', 'cicero', 'Sunday', '07:45'),
('COM1500', 'cowboy', 'Friday', '11:00'),
('COM2000', 'jackb', 'Wednesday', '10:00'),
('COM2000', 'jbarb', 'Saturday', '19:30'),
('COM2000', 'jorge', 'Thursday', '14:30'),
('COM2300', 'cicero', 'Thursday', '08:30'),
('COM2300', 'jamesfish', 'Wednesday', '12:30'),
('COM2300', 'jorge', 'Saturday', '10:45'),
('COM2300', 'tristin.walker', 'Thursday', '11:30'),
('COM3200', 'christboy', 'Saturday', '13:30'),
('COM3200', 'cowboy', 'Monday', '09:14'),
('COM3200', 'cowboy', 'Tuesday', '12:00'),
('COM3200', 'nickbat', 'Wednesday', '11:30'),
('COM4000', 'cicero', 'Friday', '07:30'),
('COM4000', 'cowboy', 'Sunday', '14:00'),
('COM4000', 'elian.terry', 'Friday', '10:30'),
('COM4000', 'jackb', 'Monday', '23:45'),
('COM4000', 'jbarb', 'Sunday', '23:00'),
('COM4000', 'jorge', 'Wednesday', '09:45');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`fname`, `lname`, `dob`, `address`, `email`, `phone`, `uname`, `pass`) VALUES
('Al', 'Pacino', '1950-05-10', 'Sicily, Italy', 'pacino@mail.com', '0751245896', 'alpacino', 'pacino555'),
('Garret', 'Auer', '2019-05-31', 'Steuberhaven', 'Alfreda@dell.net', '015-706-9155', 'bertrand_okeefe', '6523141C'),
('Brennan', 'Marquardt', '2019-05-03', 'West Mustafaside', 'Velda@osbaldo.biz', '1-881-597-7695', 'brennan', '4561'),
('Alejandra', 'Gaylord', '2019-05-12', 'Metzfurt', 'Mattie@laurine.biz', '355.245.8794', 'edwin', 'CDC45123'),
('Jovanny', 'Dare', '2019-05-06', 'West Bertramville', 'Zena@johnpaul.me', '1-308-141-4016', 'ellen', '46321'),
('Gerson', 'Mayert', '2015-11-30', 'New Phoebe', 'Curtis@regan.ca', '422.825.2483', 'elliott', '4415216'),
('Gregorio', 'HarÂªann', '2019-05-12', 'East Elliechester', 'Jacynthe@alexandrea.biz', '857.264.6970', 'erwin.moore', 'POIOS78456'),
('Baylee', 'Smith', '2019-05-12', 'Cristborough', 'Raquel_Kovacek@stanton.net', '595-786-7884', 'flossie_goldner', 'asd4412'),
('Jeanne', 'Schulist', '2019-05-05', 'East Russellmouth', 'Armani.Fay@daisy.name', '236.493.6874', 'garth', '787845'),
('Lemuel', 'Treutel', '2019-05-14', 'Lake Ethanborough', 'Antonietta@hildegard.io', '(464)213-5457', 'gunner_lowe', 'OPOS)*832'),
('Myrna', 'Turner', '2019-05-05', 'New Joana', 'Kathryne@zakary.net', '543-369-0267', 'harmon', '96451'),
('Everett', 'Maggio', '2019-05-05', 'Hughport', 'Eugenia@braxton.com', '457-472-9142', 'hayden', '7865'),
('Lucio', 'Schiller', '2019-05-17', 'Dickichester', 'Maverick@mckenna.name', '105.470.2970', 'helena_greenfelder', 'SKDO123'),
('Maiya', 'Ziemann', '2019-05-05', 'Oswaldfort', 'Junius@fermin.ca', '(950)902-9433', 'hudson_robel', 'XSZA11V'),
('Virginia', 'Cole', '2019-05-24', 'East Kianna', 'Heidi@madge.name', '1-933-645-5353', 'jameson', 'SSS5136X'),
('Cale', 'Donnelly', '2019-05-23', 'Rodolfoberg', 'Angus_Boehm@amelia.info', '1-796-598-1760', 'jarrell.funk', 'Terry14522'),
('Joany', 'Krajcik', '2019-05-31', 'Cronaborough', 'Hollis.Waters@vanessa.biz', '(844)089-5654', 'jena_abshire', 'CXZ12456'),
('Jerk', 'Bunny', '2500-02-03', 'Okay Dokie Street', 'jerk@mail.com', '07555555', 'jerkiss', 'boyboy555'),
('Ransom', 'Hamill', '2019-05-01', 'Lake Araview', 'Emma.Daugherty@aurelia.me', '1-139-729-2186', 'june', '7789'),
('Cornell', 'Jenkins', '2019-05-12', 'Langside', 'Estel_Ritchie@tressa.ca', '(862)764-3675', 'kathryne', '74562'),
('Keshawn', 'DuBuque', '2019-05-05', 'West Mustafaside', 'Claire@arthur.info', '(501)229-7796', 'keshwan', '7845'),
('Luther', 'Ondricka', '2019-05-05', 'New Cornelltown', 'Everett.Hirthe@jaycee.me', '(308)777-4328', 'koby', 'SDX1C5F'),
('Willie', 'Koss', '2019-05-05', 'Lake Evelinemouth', 'Christopher@alaina.com', '109.749.2307 x1954', 'landen.bartoletti', '123'),
('Hailey', 'Witting', '2019-05-20', 'Colbyside', 'Dortha@reed.net', '(336)880-5670', 'lea_torphy', 'VC7456'),
('Christ', 'Ritchie', '2019-05-22', 'North Sabrynaville', 'Melany_Legros@willa.us', '313.189.6720', 'marcos', '789'),
('Chaz', 'Larkin', '2019-05-17', 'Alishahaven', 'Flavie@kristin.biz', '1-335-947-3069', 'marion.hilll', 'IOPS(344'),
('Demarco', 'Keebler', '2019-05-12', 'New Scotty', 'Bobbie_Koelpin@alysa.com', '(426)887-2881', 'maryam', 'ASX1245632'),
('Fay', 'Batz', '2019-05-04', 'Estefaniamouth', 'Verner@russell.io', '317.951.9225', 'maxwell', '745631'),
('Karson', 'Anderson', '2019-05-12', 'South Enriquefurt', 'maya@deanna.net', '---', 'maya', 'maya555'),
('Jaden', 'Kling', '2019-05-17', 'Lake Lisettefort', 'Aiden@elza.com', '1-236-385-0991', 'mike.powlowski', 'CXS412563'),
('Lysanne', 'Rice', '2019-05-01', 'Leoburgh', 'Aileen_Emard@hayley.co.uk', '158-684-0299', 'napoleon.waelchi', '555'),
('Alanna', 'Heller', '2019-05-01', 'Ianborough', 'Willy@tate.net', '1-684-274-0263', 'natalia_smith', '456'),
('Ali', 'Denesik', '2019-05-19', 'East Elmoremouth', 'Vicente@dayne.name', '1-960-560-0597', 'olaf.hammes', 'df5454SSSX'),
('Corbin', 'Mertz', '2019-05-19', 'Rohanmouth', 'Cassidy_Hermiston@ceasar.biz', '1-381-684-7572', 'patsy_mayert', '456233'),
('Adrien', 'Lynch', '2019-05-09', 'Jeanview', 'Carlo_Stark@jena.ca', '1-030-422-8610', 'royce_grady', 'XCV4512'),
('Jamarcus', 'Parker', '2019-05-01', 'Port Torrance', 'Saige@adriana.name', '935-089-3723', 'shaun.christiansen', '745632'),
('Sherpherd', 'Justin', '1200-05-02', 'Bastin Joke', 'sherpherd-co@gmail.con', '0719999999', 'sherpherds', '8885511111'),
('Hailey', 'Kling', '2019-05-05', 'Bauchfort', 'Amparo.Beahan@mabel.info', '(696)502-6943', 'telly', 'S()_30'),
('Chadu', 'Wayne', '1990-02-11', 'Southern California', 'chad@gmail.comx', ' 94 75 145 29991', 'wayne', '000'),
('Yusuf', 'Hassen', '2000-11-20', 'Kings Land', 'yuziferr@gmail.com', '0755555555', 'yuziferr', '123'),
('Zed', 'Leppin', '2019-04-01', 'Noir Street', 'zed@mail.com', '0452222222', 'zed', '123');

-- --------------------------------------------------------

--
-- Table structure for table `student_book`
--

CREATE TABLE `student_book` (
  `s_uname` varchar(100) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_book`
--

INSERT INTO `student_book` (`s_uname`, `isbn`, `date`) VALUES
('alpacino', '978-1-60309-442-9', '2013-12-31'),
('alpacino', '978-1-891830-22-8', '2013-12-31'),
('brennan', '978-1-60309-441-2', '2019-06-11'),
('yuziferr', '978-1-60309-347-7', '2019-06-11'),
('yuziferr', '978-1-891830-22-8', '2019-06-11'),
('yuziferr', '978-1-891830-40-2', '2019-06-08'),
('yuziferr', '978-1-891830-97-6', '2019-06-11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD KEY `batch_id` (`batch_id`),
  ADD KEY `module_id` (`module_id`),
  ADD KEY `s_uname` (`s_uname`);

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`batch_id`),
  ADD KEY `fk_course` (`course_id`);

--
-- Indexes for table `batch_student`
--
ALTER TABLE `batch_student`
  ADD PRIMARY KEY (`batch_id`,`s_uname`),
  ADD KEY `s_uname` (`s_uname`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`isbn`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `course_module`
--
ALTER TABLE `course_module`
  ADD KEY `course_id` (`course_id`),
  ADD KEY `module_id` (`module_id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`batch_id`,`module_id`,`s_uname`),
  ADD KEY `module_id` (`module_id`),
  ADD KEY `s_uname` (`s_uname`);

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`uname`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_id` (`module_id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`batch_id`,`l_uname`,`day`,`time`),
  ADD KEY `l_uname` (`l_uname`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`uname`);

--
-- Indexes for table `student_book`
--
ALTER TABLE `student_book`
  ADD PRIMARY KEY (`s_uname`,`isbn`),
  ADD KEY `isbn` (`isbn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignment`
--
ALTER TABLE `assignment`
  ADD CONSTRAINT `assignment_ibfk_1` FOREIGN KEY (`batch_id`) REFERENCES `batch` (`batch_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assignment_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `module` (`module_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assignment_ibfk_3` FOREIGN KEY (`s_uname`) REFERENCES `student` (`uname`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `batch`
--
ALTER TABLE `batch`
  ADD CONSTRAINT `fk_course` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `batch_student`
--
ALTER TABLE `batch_student`
  ADD CONSTRAINT `batch_student_ibfk_1` FOREIGN KEY (`batch_id`) REFERENCES `batch` (`batch_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `batch_student_ibfk_2` FOREIGN KEY (`s_uname`) REFERENCES `student` (`uname`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_module`
--
ALTER TABLE `course_module`
  ADD CONSTRAINT `course_module_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_module_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `module` (`module_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `grade`
--
ALTER TABLE `grade`
  ADD CONSTRAINT `grade_ibfk_1` FOREIGN KEY (`batch_id`) REFERENCES `batch` (`batch_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grade_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `module` (`module_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grade_ibfk_3` FOREIGN KEY (`s_uname`) REFERENCES `student` (`uname`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `material_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `module` (`module_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `fk_schedul` FOREIGN KEY (`batch_id`) REFERENCES `batch` (`batch_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`l_uname`) REFERENCES `lecturer` (`uname`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_book`
--
ALTER TABLE `student_book`
  ADD CONSTRAINT `student_book_ibfk_2` FOREIGN KEY (`s_uname`) REFERENCES `student` (`uname`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_book_ibfk_3` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql300.epizy.com
-- Generation Time: Aug 29, 2021 at 08:31 PM
-- Server version: 5.6.48-88.0
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_29329584_exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `exam_code` varchar(9) NOT NULL,
  `no` int(3) NOT NULL,
  `answer` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `username`, `exam_code`, `no`, `answer`) VALUES
(1, 'martin', '123456789', 1, '1'),
(2, 'martin', '123456789', 4, 'A whole number'),
(3, 'martin', '123456789', 2, '25'),
(4, 'martin', '123456789', 3, '2'),
(5, 'martin', '123456789', 5, '.number'),
(6, 'martin', '123456789', 6, 'x   5y'),
(7, 'martin', '123456789', 7, ' '),
(8, 'martin', '123456789', 8, ''),
(9, 'martin', '123456789', 9, '*'),
(10, 'martin', '123456789', 10, '*');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(50) NOT NULL,
  `code` varchar(17) COLLATE utf8_bin NOT NULL,
  `subject` varchar(25) COLLATE utf8_bin NOT NULL,
  `acadmic_year` varchar(25) COLLATE utf8_bin NOT NULL,
  `no_questions` int(3) NOT NULL,
  `no_examiners` int(50) NOT NULL,
  `no_current_examiners` int(11) NOT NULL,
  `added_by` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` int(11) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `endless` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `code`, `subject`, `acadmic_year`, `no_questions`, `no_examiners`, `no_current_examiners`, `added_by`, `time`, `start`, `end`, `endless`) VALUES
(7, '123456789', 'Math', '2021', 10, 0, 0, 'admin', 205, '2021-08-05 10:35:00', '2021-08-05 20:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `exam_finished`
--

CREATE TABLE `exam_finished` (
  `id` int(11) NOT NULL,
  `code` varchar(9) NOT NULL,
  `user` varchar(50) NOT NULL,
  `time` int(11) NOT NULL,
  `mark` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_finished`
--

INSERT INTO `exam_finished` (`id`, `code`, `user`, `time`, `mark`) VALUES
(3, '123456789', 'Martin', 0, '7');

-- --------------------------------------------------------

--
-- Table structure for table `flags`
--

CREATE TABLE `flags` (
  `id` int(11) NOT NULL,
  `no_question` int(11) NOT NULL,
  `code` varchar(9) NOT NULL,
  `user` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `flags`
--

INSERT INTO `flags` (`id`, `no_question`, `code`, `user`) VALUES
(1, 1, '123456789', 'martin'),
(2, 2, '123456789', 'Martin'),
(3, 6, '123456789', 'Martin'),
(4, 8, '123456789', 'Martin');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(50) NOT NULL,
  `question` text NOT NULL,
  `choice1` text,
  `choice2` text,
  `choice3` text,
  `choice4` text,
  `choose` int(1) NOT NULL DEFAULT '1',
  `drawing` int(1) NOT NULL DEFAULT '0',
  `is_text` int(1) NOT NULL DEFAULT '0',
  `code` varchar(9) NOT NULL,
  `choose_answer` int(1) DEFAULT NULL,
  `added_by` varchar(50) NOT NULL,
  `no` int(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `choice1`, `choice2`, `choice3`, `choice4`, `choose`, `drawing`, `is_text`, `code`, `choose_answer`, `added_by`, `no`) VALUES
(1, '&nbsp;2   2', '&nbsp;2', '&nbsp;3', '&nbsp;4', '&nbsp;5', 1, 0, 0, '123456789', 3, 'admin', 1),
(2, '&nbsp;5 * 5', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', 0, 0, 1, '123456789', 1, 'admin', 2),
(3, '&nbsp;1   909', '&nbsp;910', '&nbsp;123', '&nbsp;32', '&nbsp;42', 1, 0, 0, '123456789', 1, 'admin', 3),
(4, '&nbsp;What is integer??', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', 0, 0, 1, '123456789', 1, 'admin', 4),
(5, '&nbsp;What is decimal???', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', 0, 0, 1, '123456789', 1, 'admin', 5),
(6, '&nbsp;How to write an algebraic expression??', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', 0, 0, 1, '123456789', 1, 'admin', 6),
(7, '&nbsp;How to add?', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', 0, 0, 1, '123456789', 1, 'admin', 7),
(8, '&nbsp;How to Multiply???', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', 0, 0, 1, '123456789', 1, 'admin', 8),
(9, '&nbsp;How to Multiply???', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', 0, 0, 1, '123456789', 1, 'admin', 9),
(10, '&nbsp;How to Multiply???', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', 0, 0, 1, '123456789', 1, 'admin', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `date` date NOT NULL,
  `gender` text,
  `avatar` text NOT NULL,
  `user_pos` varchar(25) NOT NULL DEFAULT 'nor',
  `academic_year` varchar(50) NOT NULL,
  `school` varchar(50) NOT NULL,
  `current_exam_code` varchar(9) NOT NULL DEFAULT 'none',
  `current_exam_time` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `date`, `gender`, `avatar`, `user_pos`, `academic_year`, `school`, `current_exam_code`, `current_exam_time`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@admin.org', 'admin', '2020-03-15', 'male', '', 'admin', '3rd', 'admin', 'none', ''),
(2, 'Martin', 'Sherif', 'Martin', 'martin@gmail.com', '1234', '2021-08-04', 'Male', 'images/default_pic.jpg', 'nor', '2021', 'Sahara', 'none', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_finished`
--
ALTER TABLE `exam_finished`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flags`
--
ALTER TABLE `flags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `exam_finished`
--
ALTER TABLE `exam_finished`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `flags`
--
ALTER TABLE `flags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

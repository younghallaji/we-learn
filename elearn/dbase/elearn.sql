-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 16, 2021 at 01:23 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearn`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `qid` int(11) DEFAULT NULL,
  `options` varchar(255) DEFAULT NULL,
  `answer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `qid`, `options`, `answer`) VALUES
(1, 1, 'Hyperlink Text Markup Lang', 0),
(2, 1, 'Hyperlink Text Markup Lang', 0),
(3, 1, 'HyperText Markup Learning', 0),
(4, 1, 'HyperText Markup Language', 1),
(5, 2, 'sodiq', 0),
(6, 2, 'Mutolib', 0),
(7, 2, 'Akin', 0),
(8, 2, 'Adio', 1),
(13, 3, 'Jesus', 0),
(14, 3, 'Allah', 1),
(15, 3, 'God of Iron', 0),
(16, 3, 'Muhammed', 0),
(17, 4, 'God', 0),
(18, 4, 'God Son', 0),
(19, 4, 'Prophet', 1),
(20, 4, 'God Brother', 0);

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `id` int(11) NOT NULL,
  `course` int(11) DEFAULT NULL,
  `assign_no` int(11) DEFAULT NULL,
  `question` text DEFAULT NULL,
  `sub_date` datetime DEFAULT NULL,
  `addedon` datetime NOT NULL DEFAULT current_timestamp(),
  `addedby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`id`, `course`, `assign_no`, `question`, `sub_date`, `addedon`, `addedby`) VALUES
(1, 3, 1, 'List and Explain the Generation of Computer', '2021-07-12 12:13:00', '2021-07-12 12:14:01', 2),
(2, 2, 1, 'Who are you', '2021-07-13 00:19:00', '2021-07-13 00:19:50', 2),
(3, 5, 2, 'What is questionnaire', '2021-07-14 13:51:00', '2021-07-13 16:50:23', 3);

-- --------------------------------------------------------

--
-- Table structure for table `chatroom`
--

CREATE TABLE `chatroom` (
  `id` int(11) NOT NULL,
  `sender` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `class_code` varchar(10) DEFAULT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chatroom`
--

INSERT INTO `chatroom` (`id`, `sender`, `message`, `class_code`, `datetime`) VALUES
(1, 5, 'hello', 'CUC-61174', '2021-07-11 14:10:35'),
(2, 5, 'hi', 'CUC-61174', '2021-07-11 14:29:15'),
(3, 5, 'How are you doing', 'CUC-61174', '2021-07-11 14:29:37'),
(4, 5, 'How is family', 'CUC-61174', '2021-07-11 14:29:42'),
(5, 4, 'How is studies', 'CUC-61174', '2021-07-11 14:29:48'),
(6, 5, 'What is your phone number', 'CUC-61174', '2021-07-11 14:29:57'),
(7, 3, 'Can we start class now', 'CUC-61174', '2021-07-11 14:30:14'),
(8, 5, 'Are we ready for today web Design and development class', 'CUC-61174', '2021-07-11 14:30:37'),
(9, 5, 'style=\"display:flex;flex-direction:column-reverse;\"', 'CUC-61174', '2021-07-11 14:30:43'),
(10, 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'CUC-61174', '2021-07-11 14:32:22'),
(11, 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'CUC-61174', '2021-07-11 14:32:32'),
(12, 5, 'hi', 'CUC-47784', '2021-07-11 14:33:01'),
(13, 4, 'Good day', 'CUC-47784', '2021-07-11 23:03:27'),
(14, 3, 'hello', 'CUC-47784', '2021-07-11 23:16:21'),
(15, 4, 'hi', 'CUC-47784', '2021-07-11 23:16:37'),
(16, 4, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'CUC-47784', '2021-07-11 23:17:53'),
(17, 2, 'Hi', 'CUC-61174', '2021-07-11 23:20:52'),
(18, 2, 'hi', 'CUC-61174', '2021-07-14 13:48:54');

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE `classroom` (
  `id` int(11) NOT NULL,
  `class_code` varchar(20) DEFAULT NULL,
  `classtitle` varchar(100) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `course` int(11) DEFAULT NULL,
  `time` varchar(11) DEFAULT NULL,
  `instructor` int(11) DEFAULT NULL,
  `createdon` varchar(15) DEFAULT NULL,
  `day` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`id`, `class_code`, `classtitle`, `duration`, `course`, `time`, `instructor`, `createdon`, `day`) VALUES
(1, 'CUC-61174', 'Web Development Classroom', NULL, 3, '21:00', 2, '2021-07-06', 'Monday'),
(2, 'CUC-12094', 'Programming Class', NULL, 2, '09:00', 2, '2021-07-06', 'Wednesday');

-- --------------------------------------------------------

--
-- Table structure for table `class_joined`
--

CREATE TABLE `class_joined` (
  `id` int(11) NOT NULL,
  `sid` int(11) DEFAULT NULL,
  `classcode` varchar(11) DEFAULT NULL,
  `banned` tinyint(1) DEFAULT 0,
  `suspend` tinyint(1) DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `joined` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_joined`
--

INSERT INTO `class_joined` (`id`, `sid`, `classcode`, `banned`, `suspend`, `deleted`, `joined`) VALUES
(1, 5, 'CUC-61174', 0, 0, 0, '2021-07-11 09:03:10'),
(2, 5, 'CUC-47784', 0, 0, 0, '2021-07-11 10:13:00'),
(3, 4, 'CUC-47784', 0, 0, 0, '2021-07-11 15:33:26');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `dept` varchar(11) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `createdon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `title`, `code`, `dept`, `level`, `createdby`, `createdon`) VALUES
(1, 'Introduction to Computing', 'COM 111', '1', '100', 1, '2021-06-24'),
(2, 'Introduction to programming', 'COM 112', '1', '200', 1, '2021-07-06'),
(3, 'Web Design and Development', 'COM 211', '1', '200', 1, '2021-07-06'),
(5, 'Statistical Theory 2', 'STA 311', '1', '300', 1, '2021-07-06');

-- --------------------------------------------------------

--
-- Table structure for table `course_allocation`
--

CREATE TABLE `course_allocation` (
  `id` int(11) NOT NULL,
  `course` int(11) DEFAULT NULL,
  `lecturer` int(11) DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `createdon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_allocation`
--

INSERT INTO `course_allocation` (`id`, `course`, `lecturer`, `createdby`, `createdon`) VALUES
(1, 3, 2, 1, '2021-06-25'),
(2, 2, 2, 1, '2021-06-25'),
(3, 5, 3, 1, '2021-06-25'),
(4, 3, 3, 1, '2021-06-25');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `hod` int(11) DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `createdon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `hod`, `createdby`, `createdon`) VALUES
(1, 'Computer Science', 2, 1, '2021-06-24'),
(2, 'Statistics and Mathematics', 3, 1, '2021-07-13');

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `id` int(11) NOT NULL,
  `course` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `type` int(2) DEFAULT NULL,
  `addedby` int(11) DEFAULT NULL,
  `addedon` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`id`, `course`, `title`, `link`, `type`, `addedby`, `addedon`) VALUES
(2, 3, 'Introduction to Computing', 'materials/272553.pdf', 1, 2, '2021-07-12 07:02:39'),
(3, 2, 'Introduction to Flutter', 'https://www.youtube.com/embed/1iWhGJQ5eF8', 2, 2, '2021-07-13 05:25:09');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `question` text DEFAULT NULL,
  `coursecode` int(11) DEFAULT NULL,
  `addedby` int(11) DEFAULT NULL,
  `addedon` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `question`, `coursecode`, `addedby`, `addedon`) VALUES
(1, 'What is the full meaning of HTML', 3, 2, '2021-07-06'),
(3, 'Who is Creator of the universe', 3, 2, NULL),
(4, 'Who is Jesus', 3, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `questionid` int(11) DEFAULT NULL,
  `courseid` int(11) DEFAULT NULL,
  `studentid` int(11) DEFAULT NULL,
  `result` int(11) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `questionid`, `courseid`, `studentid`, `result`, `answer`) VALUES
(1, 1, 3, 5, 0, 'Hyperlink Text Markup Lang'),
(2, 4, 3, 5, 0, 'God Son'),
(3, 3, 3, 5, 0, 'God of Iron'),
(4, 2, 3, 5, 0, 'Mutolib'),
(5, NULL, NULL, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `s_assignment`
--

CREATE TABLE `s_assignment` (
  `id` int(11) NOT NULL,
  `aid` int(11) DEFAULT NULL,
  `sid` int(11) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `datatime` datetime DEFAULT current_timestamp(),
  `file` varchar(255) DEFAULT NULL,
  `status` int(2) DEFAULT 0,
  `score` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `s_assignment`
--

INSERT INTO `s_assignment` (`id`, `aid`, `sid`, `cid`, `datatime`, `file`, `status`, `score`) VALUES
(1, 1, 5, 3, '2021-07-12 18:09:21', 'assignments/58157.doc', 2, 40),
(2, 3, 5, 3, '2021-07-13 17:03:36', 'assignments/978918.docx', 1, 30);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `matric` varchar(30) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `level` varchar(30) NOT NULL,
  `rank` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `fname`, `lname`, `phone`, `matric`, `department`, `level`, `rank`) VALUES
(1, 'admin@admin.com', '$2y$10$cTWCirNanr1495beA4lStu5uQR0WW/euD6m3.dqPC5cniBJWWvDDe', 1, 'Admin', 'Admin', NULL, NULL, NULL, '', NULL),
(2, 'admin@lecturer.com', '$2y$10$cTWCirNanr1495beA4lStu5uQR0WW/euD6m3.dqPC5cniBJWWvDDe', 2, 'Mutolib', 'Sodiq', '07068581708', NULL, '2', '', 'Assistant Lecturer'),
(3, 'younghallajinoni@gmail.com', '$2y$10$l7NWSSuOk1wZJfY86N3u3edAVxInAvCrdZWQyB7JoZFBmemmRq7zq', 2, 'Mutolib', 'Akinpelumi', '07068581708', NULL, '1', '', 'Senior Lecturer'),
(4, 'mutolib@gmail.com', '$2y$10$lRZ8e4PSqwl4.fTGUWM0vOEfuaGHckRBFJt/Bx98h2VdQdPcIMA4O', 3, 'Mutolib', 'Akinpelumi', '07068581708', 'hcsf/18/0001', '1', '100', NULL),
(5, 'younghallajinoni2@gmail.com', '$2y$10$UAcOBfqWEOWjm2y1g.9ycukzmhD2j3UVol5Y3hspcVj853Cv7ie7m', 3, 'Mutolib', 'Sodiq', '07068581708', 'hcsf/18/0045', '1', '200', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chatroom`
--
ALTER TABLE `chatroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_joined`
--
ALTER TABLE `class_joined`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_allocation`
--
ALTER TABLE `course_allocation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_assignment`
--
ALTER TABLE `s_assignment`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chatroom`
--
ALTER TABLE `chatroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `classroom`
--
ALTER TABLE `classroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `class_joined`
--
ALTER TABLE `class_joined`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `course_allocation`
--
ALTER TABLE `course_allocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `s_assignment`
--
ALTER TABLE `s_assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

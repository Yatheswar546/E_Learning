-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2023 at 11:36 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_learning`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `image` longblob DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `role` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `image`, `phone`, `password`, `role`) VALUES
(1, 'Vamsi Krishna', 'vamsi123@gmail.com', 0x34306233616265656265323032633962353538383764306262346462653737332e6a7067, '9745681023', '827ccb0eea8a706c4c34a16891f84e7b', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` longblob DEFAULT NULL,
  `createdat` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`, `image`, `createdat`) VALUES
(3, 'Web Development', 'Web Development is used very much now-a-days.', 0x31626165306365316231303335356263633066323634363939336337396239632e6a7067, '2023-03-11 04:04:36'),
(4, 'Data Science', 'Web Development is used very much now-a-days. It has high demand', 0x36313439306665326637643238613535633839663333346136646230623031342e6a706567, '2023-03-11 04:58:51'),
(5, 'Machine Learning', 'Machine Learning will boom in future...', 0x33656139336462363661323866343038303166393963616663653932643263392e6a706567, '2023-03-11 17:57:18');

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` int(11) NOT NULL,
  `userid` text DEFAULT NULL,
  `score` text DEFAULT NULL,
  `courseid` text DEFAULT NULL,
  `certificateid` text DEFAULT NULL,
  `time` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `userid`, `score`, `courseid`, `certificateid`, `time`) VALUES
(1, 'bab51882ee90b73d9b648654e107c4b0', '40', 'f2cd3ffe3ad2fbd66391d3e8e604baa6', 'certificate', '2023-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `category` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `video` longblob DEFAULT NULL,
  `image` longblob DEFAULT NULL,
  `price` text DEFAULT NULL,
  `type` text DEFAULT NULL,
  `courseid` text DEFAULT NULL,
  `createdat` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `category`, `description`, `video`, `image`, `price`, `type`, `courseid`, `createdat`) VALUES
(1, 'Web Development', 'Technology', 'Web Development is used very much now-a-days.', 0x36386535396562343066633331626136666133383464313964633136633637662e6d7034, 0x31626165306365316231303335356263633066323634363939336337396239632e6a7067, '$0.00', 'Free', 'd26354888e7f4270105ea4753b41df06', '2023-04-23'),
(2, 'Machine Learning', 'Technology', 'Machine Learning will boom in future...', 0x62366464643466626333353632343438393231346563333935323838356665332e6d7034, 0x36313439306665326637643238613535633839663333346136646230623031342e6a706567, '$50.00', 'Not Free', 'f2cd3ffe3ad2fbd66391d3e8e604baa6', '2023-04-23');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `id` int(11) NOT NULL,
  `userid` text DEFAULT NULL,
  `courseid` text DEFAULT NULL,
  `time` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`id`, `userid`, `courseid`, `time`) VALUES
(1, 'bab51882ee90b73d9b648654e107c4b0', 'd26354888e7f4270105ea4753b41df06', '2023-04-23'),
(2, 'bab51882ee90b73d9b648654e107c4b0', 'f2cd3ffe3ad2fbd66391d3e8e604baa6', '2023-04-23');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `que` text DEFAULT NULL,
  `ans` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `que`, `ans`) VALUES
(1, 'Can I just enroll in a single course?', 'Yes! To get started, click the course card that interests you and enroll. You can enroll and complete the course to earn a shareable certificate, or you can audit it to view the course materials for free. When you subscribe to a course that is part of a Certificate, you’re automatically subscribed to the full Certificate. Visit your learner dashboard to track your progress.'),
(4, 'Can I just enroll in a single course?', 'Yes! To get started, click the course card that interests you and enroll. You can enroll and complete the course to earn a shareable certificate, or you can audit it to view the course materials for free. When you subscribe to a course that is part of a Certificate, you’re automatically subscribed to the full Certificate. Visit your learner dashboard to track your progress.'),
(5, 'Can I just enroll in a single course?', 'Yes! To get started, click the course card that interests you and enroll. You can enroll and complete the course to earn a shareable certificate, or you can audit it to view the course materials for free. When you subscribe to a course that is part of a Certificate, you’re automatically subscribed to the full Certificate. Visit your learner dashboard to track your progress.');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `message` text DEFAULT NULL,
  `sendat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `name`, `email`, `phone`, `message`, `sendat`) VALUES
(1, 'Yatheswar Ethalapaka', 'yathe@gmail', ' 83753218371', 'This website has helped me alot in learning new courses', '2023-03-11 03:59:08'),
(2, 'Yatheswar Ethalapaka', 'yathe@gmail', ' 8544178371', 'Thank You !!!', '2023-03-11 05:03:22');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `fname` text DEFAULT NULL,
  `lname` text DEFAULT NULL,
  `branch` text DEFAULT NULL,
  `college` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` text DEFAULT NULL,
  `country` text DEFAULT NULL,
  `postal_code` text DEFAULT NULL,
  `about` text DEFAULT NULL,
  `image` longblob DEFAULT NULL,
  `profile_id` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `fname`, `lname`, `branch`, `college`, `address`, `city`, `country`, `postal_code`, `about`, `image`, `profile_id`) VALUES
(1, 'Vamsi Krishna', 'A', 'CSE', 'Veltech University', 'Yallabillivari Street , Reddy Kancharapalem', 'Visakhapatnam', 'India', '530008', 'I am a highly motivated computer science student with a strong passion for web development and coding. With a Codechef CCDSA certification (Foundation Level) under my belt, I have proven my ability to solve complex coding problems and understand fundamental algorithms and data structures.  I have completed several projects in web development, including a recent MERN stack project, which is a second-hand car agency where buyers can purchase second-hand cars, and dealers can add second-hand cars for sale. This project allowed me to apply my knowledge of MongoDB, Express, React, and Node.js to build a responsive and user-friendly platform that meets the needs of both buyers and sellers. During my recent internship as a Full Stack Developer, I worked on several projects, including a front-end project for a rental car agency using HTML, CSS, and JavaScript and a full-stack project for a graphic design consultancy using PHP and MySQL. I also had the opportunity to contribute to the development of an e-learning platform, where I served as the back-end developer.  Additionally, I have a basic understanding of machine learning and have worked on a few projects in this area. I have a keen eye for detail and strive to create clean and efficient code. As a Software Engineer Developer, I am confident that my skills and experience will enable me to make a valuable contribution to your team.', 0x36303139333664306462353331386230663666326131346138306462363438312e6a7067, 'bab51882ee90b73d9b648654e107c4b0');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `image` longblob DEFAULT NULL,
  `email` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `course` text DEFAULT NULL,
  `teacherid` text DEFAULT NULL,
  `joinedat` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `image`, `email`, `phone`, `course`, `teacherid`, `joinedat`) VALUES
(1, 'Anuradha', 0x35636563353436623939613633343934663432376530366335643864323033322e6a7067, 'anu@gmail', '8365478371', 'Web Develeopment', '43d5ae726ce050155389c71de4e7d3c3', '2023-03-11 02:58:16'),
(3, 'Harshi', 0x34303237366462376363656463656533363234326162653732363765376335302e6a7067, 'harshi@gmail', '8854178371', 'Data Science', '58e39d242d615857315780ffa6dc2c82', '2023-03-11 04:59:56');

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `role` text DEFAULT NULL,
  `userid` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `email`, `password`, `role`, `userid`) VALUES
(1, 'Vamsi Krishna', 'vamsistudent@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'user', 'bab51882ee90b73d9b648654e107c4b0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

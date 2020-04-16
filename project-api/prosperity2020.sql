-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2020 at 08:13 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prosperity2020`
--

-- --------------------------------------------------------

--
-- Table structure for table `certificate`
--

CREATE TABLE `certificate` (
  `id` int(11) NOT NULL,
  `educationid_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `certificate`
--

INSERT INTO `certificate` (`id`, `educationid_id`, `user_id`, `subject`, `grade`) VALUES
(1, 1, 1, 'Computer Science', 'Merit');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `projectid_id` int(11) NOT NULL,
  `message` varchar(800) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `projectid_id`, `message`, `image_id`) VALUES
(1, 28, 2, 'This is the real deal', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comment_images`
--

CREATE TABLE `comment_images` (
  `id` int(11) NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comment_images`
--

INSERT INTO `comment_images` (`id`, `file_path`) VALUES
(1, '5e851f856fe12_WIN_20191213_11_16_57_Pro.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `id` int(11) NOT NULL,
  `userid_id` int(11) NOT NULL,
  `school` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `edulevel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `userid_id`, `school`, `edulevel`, `startdate`, `enddate`) VALUES
(1, 1, 'University of Port-Harcourt', 'Masters', '2004-04-03', '2008-04-03'),
(2, 3, 'Niger Delta University', 'Bachelor Of Science Computer Science', '2006-04-10', '2010-04-10');

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE `experience` (
  `id` int(11) NOT NULL,
  `userid_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `jobplace` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `experience`
--

INSERT INTO `experience` (`id`, `userid_id`, `title`, `description`, `startdate`, `enddate`, `jobplace`) VALUES
(1, 1, 'Senior Developer', 'Worked as the team software architect', '2019-04-03', '2020-04-03', '');

-- --------------------------------------------------------

--
-- Table structure for table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200401215957', '2020-04-01 22:00:31'),
('20200401225803', '2020-04-01 22:58:19'),
('20200403202920', '2020-04-03 20:30:08'),
('20200403205705', '2020-04-03 21:00:10'),
('20200403210216', '2020-04-03 21:02:50'),
('20200407234450', '2020-04-07 23:45:57'),
('20200407235545', '2020-04-07 23:56:29'),
('20200407235705', '2020-04-07 23:57:23'),
('20200408120652', '2020-04-08 12:34:00'),
('20200409220248', '2020-04-09 22:03:25'),
('20200410125422', '2020-04-10 12:54:34'),
('20200410133632', '2020-04-10 13:36:42'),
('20200410140730', '2020-04-10 14:07:41');

-- --------------------------------------------------------

--
-- Table structure for table `ministries`
--

CREATE TABLE `ministries` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ministries`
--

INSERT INTO `ministries` (`id`, `name`, `code`, `user_id`, `image_id`) VALUES
(1, 'Works', '001', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ministry_image`
--

CREATE TABLE `ministry_image` (
  `id` int(11) NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ministry_image`
--

INSERT INTO `ministry_image` (`id`, `file_path`) VALUES
(1, '5e907ed04f3ee_WIN_20200410_07_58_15_Pro.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `community` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `startdate` date NOT NULL,
  `expectedenddate` date NOT NULL,
  `projectsummary` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `makepublic` tinyint(1) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `image_id`, `title`, `community`, `location`, `lga`, `startdate`, `expectedenddate`, `projectsummary`, `makepublic`, `cost`, `user_id`) VALUES
(1, NULL, 'Ondewari Walk way', 'Ondewari', 'Surighe compound', 'Southern Ijaw', '2020-01-03', '2020-10-03', 'Great Project', 1, '0.00', NULL),
(2, NULL, 'Six Class Rooms Building', 'Ondewari', 'Apuntuagha Compound', 'SILGA', '2020-04-09', '2020-04-09', 'Great One', 1, '30000.00', 17);

-- --------------------------------------------------------

--
-- Table structure for table `projects_ministries`
--

CREATE TABLE `projects_ministries` (
  `projects_id` int(11) NOT NULL,
  `ministries_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects_ministries`
--

INSERT INTO `projects_ministries` (`projects_id`, `ministries_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `projects_user`
--

CREATE TABLE `projects_user` (
  `projects_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects_user`
--

INSERT INTO `projects_user` (`projects_id`, `user_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `project_images`
--

CREATE TABLE `project_images` (
  `id` int(11) NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_images`
--

INSERT INTO `project_images` (`id`, `file_path`) VALUES
(1, '5e851ee4a043e_WIN_20191213_11_17_19_Pro.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `project_payments`
--

CREATE TABLE `project_payments` (
  `id` int(11) NOT NULL,
  `projectid_id` int(11) NOT NULL,
  `purpose` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `phase` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `careerobjs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `designation` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` tinytext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:simple_array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `careerobjs`, `sex`, `dob`, `phone`, `email`, `password`, `image_id`, `is_active`, `designation`, `roles`) VALUES
(1, 'string', 'Be a sensation', 'Male', '2020-04-03', '07038216819', 'iniakpothompson@gmail.com', 'inikst2011', 2, 0, '', ''),
(3, 'Thompson', 'great', 'male', '2800-04-04', '07038216819', 'iniakpoforex@gmail.com', '$2y$13$yp4TX7PHzoVcT/O4RvXf7u/b2GBDK43w7W.fTgVzRNr.eqUg3Y7jW', NULL, 1, '', ''),
(4, 'Thompson', 'great', 'male', '2800-04-04', '07038216819', 'iniakpof@gmail.com', '$2y$13$W6xJUXwQ5NbEbIXch2SHlO22bsG9q.4Y8qL6uX4oLKi4wbPmieDIe', NULL, 1, '', ''),
(6, 'Thompson', 'great', 'male', '2800-04-04', '07038216819', 'iniakpo@gmail.com', '$2y$13$q82Wdv4.oWGGvVO1sC.Qc.m/R5Mz8yYl9Qh44ZotllbjKtmIj64hG', NULL, 1, '', ''),
(7, 'Thompson', 'great', 'male', '2800-04-04', '07038216819', 'iniakp@gmail.com', '$2y$13$cKcKRC3fIG2AGICFhr3TU.kDntQNYnxSYkyEa2DQ61udHcgLe/LM2', NULL, 1, '', ''),
(8, 'Bongbai', 'great', 'male', '2800-04-04', '070382168098', 'bomgbai@gmail.com', '$2y$13$sIhS4VyW/dJAzTM6.qVVp.wqUXoOxfuk0cMiGoJdAgehG5kcX4SXC', NULL, 1, '', ''),
(9, 'Bongbai', 'great', 'male', '2800-04-06', '070382168098', 'emai@gmail.com', '$2y$13$C8Kbf0MoD4WnxjytlTpOLOFh0A.7T1M0OMgmFUfo1BtaKouTMsp/C', NULL, 1, '', ''),
(11, 'Okoro', 'Waoh!', 'male', '2020-01-07', '0709484738', 'emal@gmail.com', '$2y$13$yZ7xAdmJViBHwtEL5MOoTebGISn181ANm82ffnkpiL.QCNG6xsGmG', NULL, 1, '', ''),
(12, 'Okoro', 'Waoh!', 'male', '2020-01-07', '0709484738', 'emit@gmail.com', '$2y$13$dkViPmeXUxxzdpKUXaQfHukHtTIhlW2gXTuyZX/6Lb4vT80Y58ko6', NULL, 1, '', ''),
(13, 'Micha', 'Great one', 'string', '2020-04-07', '070854948484', 'emeka@gmail.com', 'wind', NULL, 1, '', ''),
(14, 'Okoro', 'Waoh!', 'male', '2020-01-07', '0709484738', 'emil@gmail.com', '$2y$13$YAJO6Uyh6aZbfjH0qX4QsuhfzH3dec/I53uR3Hfh1CTJICziF9il6', NULL, 0, 'COMMENTATOR', 'ROLE_COMMENTATOR'),
(16, 'Okoro', 'Waoh!', 'male', '2020-01-07', '0709484738', 'gov@gmail.com', '$2y$13$q0GmcJBJsj0ZOancQL88Lu8evvUjvsBrwl04HC07ufym1PVS1QxcO', NULL, 0, 'COMMENTATOR', ''),
(17, 'Okoro', 'Waoh!', 'male', '2020-01-07', '0709484738', 'govdo@gmail.com', '$2y$13$mGIjxvLcXWdFFYAhUOzhiuKMVSwqYBnaDD2TBNHkQ53YQwSBwxv6m', NULL, 0, 'Governor', 'ROLE_MINISTRY_DESK_OFFICER'),
(28, 'Emeka Okolo', 'Password Hashing works now with json registeration', 'male', '2018-02-23', '09707968958599', 'commentator@gmail.com', '$2y$13$d8aUMocTB0UuwXipZw5dLuqq6qXZLwBAI2nmArQl1OHwZbTSUuNQa', NULL, 0, 'COMMENTATOR', 'ROLE_COMMENTATOR'),
(29, 'Emeka Okolo', 'Subresoruces', 'male', '2018-02-23', '09707968958599', 'admin@gmail.com', '$2y$13$0PrMXlur0HSIZPb5YzoywOIBxz1tXcPT6urOWZCkWZrblYUuZJrX6', NULL, 0, 'Admin', 'ROLE_ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile_images`
--

CREATE TABLE `user_profile_images` (
  `id` int(11) NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_profile_images`
--

INSERT INTO `user_profile_images` (`id`, `file_path`) VALUES
(1, '5e851dfbcabcd_Wallpaper.JPG'),
(2, '5e868bc1d728a_WIN_20191213_11_17_19_Pro.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificate`
--
ALTER TABLE `certificate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_219CDA4AC8F853FD` (`educationid_id`),
  ADD KEY `IDX_219CDA4AA76ED395` (`user_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9474526C1BF02654` (`projectid_id`),
  ADD KEY `IDX_9474526C3DA5256D` (`image_id`),
  ADD KEY `IDX_9474526CA76ED395` (`user_id`);

--
-- Indexes for table `comment_images`
--
ALTER TABLE `comment_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DB0A5ED258E0A285` (`userid_id`);

--
-- Indexes for table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_590C10358E0A285` (`userid_id`);

--
-- Indexes for table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `ministries`
--
ALTER TABLE `ministries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_3A4E754A3DA5256D` (`image_id`),
  ADD KEY `IDX_3A4E754AA76ED395` (`user_id`);

--
-- Indexes for table `ministry_image`
--
ALTER TABLE `ministry_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5C93B3A43DA5256D` (`image_id`),
  ADD KEY `IDX_5C93B3A4A76ED395` (`user_id`);

--
-- Indexes for table `projects_ministries`
--
ALTER TABLE `projects_ministries`
  ADD PRIMARY KEY (`projects_id`,`ministries_id`),
  ADD KEY `IDX_8CF1E4B01EDE0F55` (`projects_id`),
  ADD KEY `IDX_8CF1E4B0D8602C38` (`ministries_id`);

--
-- Indexes for table `projects_user`
--
ALTER TABLE `projects_user`
  ADD PRIMARY KEY (`projects_id`,`user_id`),
  ADD KEY `IDX_B38D6A811EDE0F55` (`projects_id`),
  ADD KEY `IDX_B38D6A81A76ED395` (`user_id`);

--
-- Indexes for table `project_images`
--
ALTER TABLE `project_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_payments`
--
ALTER TABLE `project_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_589C10E91BF02654` (`projectid_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  ADD KEY `IDX_8D93D6493DA5256D` (`image_id`);

--
-- Indexes for table `user_profile_images`
--
ALTER TABLE `user_profile_images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certificate`
--
ALTER TABLE `certificate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comment_images`
--
ALTER TABLE `comment_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `experience`
--
ALTER TABLE `experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ministries`
--
ALTER TABLE `ministries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ministry_image`
--
ALTER TABLE `ministry_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project_images`
--
ALTER TABLE `project_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `project_payments`
--
ALTER TABLE `project_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user_profile_images`
--
ALTER TABLE `user_profile_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `certificate`
--
ALTER TABLE `certificate`
  ADD CONSTRAINT `FK_219CDA4AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_219CDA4AC8F853FD` FOREIGN KEY (`educationid_id`) REFERENCES `education` (`id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C1BF02654` FOREIGN KEY (`projectid_id`) REFERENCES `projects` (`id`),
  ADD CONSTRAINT `FK_9474526C3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `comment_images` (`id`),
  ADD CONSTRAINT `FK_9474526CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `education`
--
ALTER TABLE `education`
  ADD CONSTRAINT `FK_DB0A5ED258E0A285` FOREIGN KEY (`userid_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `experience`
--
ALTER TABLE `experience`
  ADD CONSTRAINT `FK_590C10358E0A285` FOREIGN KEY (`userid_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `ministries`
--
ALTER TABLE `ministries`
  ADD CONSTRAINT `FK_3A4E754A3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `ministry_image` (`id`),
  ADD CONSTRAINT `FK_3A4E754AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `FK_5C93B3A43DA5256D` FOREIGN KEY (`image_id`) REFERENCES `project_images` (`id`),
  ADD CONSTRAINT `FK_5C93B3A4A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `projects_ministries`
--
ALTER TABLE `projects_ministries`
  ADD CONSTRAINT `FK_8CF1E4B01EDE0F55` FOREIGN KEY (`projects_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_8CF1E4B0D8602C38` FOREIGN KEY (`ministries_id`) REFERENCES `ministries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects_user`
--
ALTER TABLE `projects_user`
  ADD CONSTRAINT `FK_B38D6A811EDE0F55` FOREIGN KEY (`projects_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B38D6A81A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_payments`
--
ALTER TABLE `project_payments`
  ADD CONSTRAINT `FK_589C10E91BF02654` FOREIGN KEY (`projectid_id`) REFERENCES `projects` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D6493DA5256D` FOREIGN KEY (`image_id`) REFERENCES `user_profile_images` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

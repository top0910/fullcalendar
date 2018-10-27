-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 16, 2017 at 03:38 PM
-- Server version: 5.6.35
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `strata_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `building_admins_tbl`
--

CREATE TABLE `building_admins_tbl` (
  `id` int(255) NOT NULL,
  `building_id` int(255) NOT NULL COMMENT 'FK ',
  `building_admin_id` int(255) DEFAULT NULL COMMENT 'FK',
  `user_id` int(255) DEFAULT NULL,
  `tenant_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `building_admins_tbl`
--

INSERT INTO `building_admins_tbl` (`id`, `building_id`, `building_admin_id`, `user_id`, `tenant_id`) VALUES
(5, 1, 18, NULL, NULL),
(6, 5, 11, NULL, NULL),
(7, 6, 17, NULL, NULL),
(9, 7, 19, NULL, NULL),
(10, 5, NULL, 23, NULL),
(11, 5, 24, NULL, NULL),
(12, 7, NULL, 25, NULL),
(13, 1, NULL, NULL, 26),
(14, 5, NULL, 27, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `building_dashboard`
--

CREATE TABLE `building_dashboard` (
  `id` int(255) NOT NULL,
  `building_id` int(255) NOT NULL,
  `banner_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `building_dashboard`
--

INSERT INTO `building_dashboard` (`id`, `building_id`, `banner_image`) VALUES
(2, 1, 'http://127.0.0.1/strata_new/assets/img/building_banner/1354.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `building_data`
--

CREATE TABLE `building_data` (
  `id` int(255) NOT NULL,
  `building_name` varchar(255) NOT NULL,
  `building_email` varchar(255) NOT NULL,
  `building_phone` varchar(255) NOT NULL,
  `building_admin_id` int(255) DEFAULT NULL,
  `building_units` int(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `building_title` varchar(200) NOT NULL COMMENT 'user building title',
  `building_text` text NOT NULL COMMENT 'user building text',
  `building_image` varchar(200) DEFAULT NULL COMMENT 'this is user building image'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `building_data`
--

INSERT INTO `building_data` (`id`, `building_name`, `building_email`, `building_phone`, `building_admin_id`, `building_units`, `status`, `created_at`, `updated_at`, `building_title`, `building_text`, `building_image`) VALUES
(1, 'Strata365.com', 'support@strata365.com', '604-789-6350', 18, 99, '1', '2017-12-12 03:29:17', '2017-12-11 10:37:02', '', '', ''),
(5, 'building1', 'building1@strata365.com', '+1987654321456', 11, 220, '1', '2017-12-14 10:30:46', '2017-12-10 04:53:48', 'Strata365 - Building1', 'building 1 text', 'http://127.0.0.1/strata_new/assets/img/building_banner/fantasy_banner_vector.jpg'),
(6, 'building_2', 'building2@gmail.com', '09987654312', 17, 11, '1', '2017-12-12 03:29:23', '2017-12-10 04:53:59', '', '', ''),
(7, 'building4', 'building4@demo.com', '9876543210', 19, 12, '1', '2017-12-13 03:01:22', '2017-12-11 10:38:28', 'Building 4', 'Some information about the building, like notice etc', 'http://127.0.0.1/strata_new/assets/img/building_banner/img_mouseover3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `calendar_events`
--

CREATE TABLE `calendar_events` (
  `id` int(255) NOT NULL,
  `title` varchar(500) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `calendar_events`
--

INSERT INTO `calendar_events` (`id`, `title`, `start`, `end`, `description`) VALUES
(1, 'Test Event', '2017-12-18 00:00:00', '0000-00-00 00:00:00', ''),
(2, 'New Event', '2017-12-19 00:00:00', '0000-00-00 00:00:00', ''),
(3, 'CRM - E-MAIL LISTING AND MARKETING SYSTEM', '2017-12-15 14:30:00', '2017-12-17 14:30:00', 'Front wheel tyres are tubeless. Extra assessories are all with the vehicle.'),
(4, 'Test Event', '2017-12-16 00:00:00', '2017-03-16 00:00:00', ''),
(5, 'New Event', '2017-12-23 00:00:00', '2017-03-23 00:00:00', ''),
(6, 'Binary MLM Website Script', '2017-12-15 14:30:00', '2017-12-16 14:30:00', 'Front wheel tyres are tubeless. Extra assessories are all with the vehicle.'),
(7, 'Ashwani Garg', '2017-12-18 14:30:00', '2017-12-19 14:30:00', 'Front wheel tyres are tubeless. Extra assessories are all with the vehicle.');

-- --------------------------------------------------------

--
-- Table structure for table `calender`
--

CREATE TABLE `calender` (
  `id` int(255) NOT NULL,
  `notice` varchar(200) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `main_landing_page`
--

CREATE TABLE `main_landing_page` (
  `id` int(255) NOT NULL,
  `building_id` int(255) NOT NULL,
  `admin_id` int(255) NOT NULL,
  `page_title` varchar(200) NOT NULL,
  `page_text` text NOT NULL,
  `sub_title1` varchar(200) NOT NULL,
  `sub_text1` text NOT NULL,
  `sub_title2` varchar(200) NOT NULL,
  `sub_text2` text NOT NULL,
  `sub_title3` varchar(200) NOT NULL,
  `sub_text3` text NOT NULL,
  `provide_title` varchar(200) NOT NULL,
  `provide_content` text NOT NULL,
  `about_text` text NOT NULL,
  `landing_email` varchar(200) NOT NULL,
  `landing_phone` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `main_landing_page`
--

INSERT INTO `main_landing_page` (`id`, `building_id`, `admin_id`, `page_title`, `page_text`, `sub_title1`, `sub_text1`, `sub_title2`, `sub_text2`, `sub_title3`, `sub_text3`, `provide_title`, `provide_content`, `about_text`, `landing_email`, `landing_phone`) VALUES
(1, 1, 1, 'Strata Management made easy to use and to follow up ', 'Home Text data', 'Sub Title 1', 'Sub Text 1', 'sub Title 2', 'Sub Text 2', 'Sub Title 3', 'Sub Text 3', 'Provide Title', 'Provide Content Provide Content Provide Content Provide Content Provide Content Provide Content', 'About Us About Us About Us About Us', 'akgarg007@gmail.com', '+919660025446');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(200) NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `building_unit` int(200) NOT NULL COMMENT 'Building Unit number of the User',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '1 = Active(default), 0 = Inactive',
  `user_role` enum('0','1','2','3') NOT NULL DEFAULT '2' COMMENT '0=Manager,1=Admin,2=User,3=Tenant',
  `user_ip` int(39) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_phone`, `building_unit`, `created_at`, `updated_at`, `status`, `user_role`, `user_ip`) VALUES
(1, 'Manager', 'manager@strata365.com', '123', '9660025446', 0, '2017-11-21 15:53:27', '2017-11-21 15:53:27', '1', '0', 0),
(11, 'admin1', 'admin1@demo.com', '123', '12312312', 11, '2017-12-06 17:00:36', '2017-12-06 17:00:36', '1', '1', 0),
(12, 'User3', 'user3@demo.com', '123', '+919660025446', 6, '2017-12-06 17:32:33', '2017-12-10 12:04:21', '1', '2', 0),
(14, 'Tenant User', 'akgarg008@gmail.com', '123', '9660025446', 10, '2017-12-07 02:20:04', '2017-12-10 01:45:29', '1', '3', 0),
(16, 'akgarg007', 'akgarg007@gmail.com', '123', '+919660025446', 11, '2017-12-10 02:12:20', '2017-12-10 01:45:51', '0', '2', 0),
(17, 'Admin 2', 'eclabsindasaia@gmail.com', '123123123', '08699215511', 123, '2017-12-10 05:28:36', '2017-12-10 05:28:36', '1', '1', 0),
(18, 'admin3', 'admin3@demo.com', '123', '9880067577', 23, '2017-12-10 08:37:44', '2017-12-10 08:37:44', '1', '1', 0),
(19, 'Admin4', 'admin4@demo.com', '123', '1234567890', 12, '2017-12-11 15:08:20', '2017-12-11 15:08:20', '1', '1', 0),
(20, 'user4', 'user4@demo.com', '123', '123123213', 0, '2017-12-11 16:26:53', '2017-12-11 16:26:53', '1', '2', 0),
(24, 'admin5', 'admin5@demo.com', '123', '9588972643', 1, '2017-12-14 04:37:14', '2017-12-14 05:45:04', '1', '1', 0),
(25, 'user5', 'user5@demo.com', '123', '983213123123', 3, '2017-12-14 04:39:14', '2017-12-14 05:45:15', '1', '2', 0),
(26, 'tenant1', 'tenant1@demo.com', '123', '12312313212', 2, '2017-12-14 04:48:50', '2017-12-14 05:45:09', '1', '3', 0),
(27, 'User7', 'user7@demo.com', '123', '9660025446', 2, '2017-12-14 10:17:28', '2017-12-14 10:17:28', '1', '2', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `building_admins_tbl`
--
ALTER TABLE `building_admins_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `building_dashboard`
--
ALTER TABLE `building_dashboard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `building_data`
--
ALTER TABLE `building_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calendar_events`
--
ALTER TABLE `calendar_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calender`
--
ALTER TABLE `calender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_landing_page`
--
ALTER TABLE `main_landing_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `building_admins_tbl`
--
ALTER TABLE `building_admins_tbl`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `building_dashboard`
--
ALTER TABLE `building_dashboard`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `building_data`
--
ALTER TABLE `building_data`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `calendar_events`
--
ALTER TABLE `calendar_events`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `calender`
--
ALTER TABLE `calender`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `main_landing_page`
--
ALTER TABLE `main_landing_page`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2016 at 04:29 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `darren_offerz`
--
CREATE DATABASE IF NOT EXISTS `darren_offerz` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `darren_offerz`;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(90) NOT NULL,
  `stripe_cust_id` varchar(90) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(90) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=normal clients, 2=admin userr',
  `description` text NOT NULL,
  `website` varchar(255) NOT NULL,
  `plan_start_date` varchar(90) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `oauth_token` varchar(255) NOT NULL,
  `oauth_secret_token` varchar(255) NOT NULL,
  `screen_name` varchar(255) NOT NULL,
  `twitter_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `username`, `stripe_cust_id`, `email`, `password`, `role`, `description`, `website`, `plan_start_date`, `plan_id`, `image_path`, `image_name`, `oauth_token`, `oauth_secret_token`, `screen_name`, `twitter_id`, `created_at`) VALUES
(1, 'John', 'Doe', '', 'john@example.com', 'email.com@gs.com', 1, '', '', '', 0, '', 'testing.png', '', '', '', '', '2015-10-29 12:07:34'),
(2, 'Vishal', 'vishal_betasoft', '', 'vishal@gmail.com', 'test', 1, '', '', '', 0, '', '', '', '', '', '', '2015-10-29 12:07:34'),
(3, 'tesing', 'testst', '', 'sdf@bgmail.om', 'test', 1, '', '', '', 0, '', 'yatch2.jpg', '', '', '', '', '2015-10-29 12:07:34'),
(4, 'Daren', 'darren', '', 'darren@gmail.com', 'test', 1, '', '', '', 0, '', '', '', '', '', '', '2015-10-29 12:24:40'),
(5, 'Under Armour23', 'test', '', 'test@gmail.com', 'test', 1, 'The leader in sports performance clothing with more professional athletes than all other brands combined.', '', '', 0, '', '6543f9e3f03ac59c99d778f501a2b16bimg_x.png', '', '', '', '', '2015-10-30 10:59:18'),
(6, 'vishalj', 'vishalj', '', 'vishalj@gmail.com', 'test', 1, '', '', '', 0, '', '', '', '', '', '', '2015-10-30 11:11:21'),
(8, 'vj', 'vishal', '', 'vishall@gmail.com', 'test', 1, '', '', '', 0, '', 'election.jpg', '', '', '', '', '2015-11-02 09:24:48'),
(9, 'vishaljaura', 'vishalj', '', 'vishalj@gmail.com', 'mind@123', 1, 'testing is great', '', '', 0, '', '', '', '', '', '', '2015-11-02 12:08:08'),
(10, 'vishal2', 'vishaljaura', '', 'vishaljaura@gmail.com', 'mind@123', 2, 'testing', '', '', 0, '', '8a8d9b461a8116097b39b04e9f005a21vishal.jpg', '412899549-RN2OETlVYX0GpVr8mwjJoRzFte0ONH6axyT4XTYo', 'Ep3amF53d98tO0ZKzfjlEOni1vtBdDAyg71dZfCXXCTEX', 'vkarora42', '412899549', '2015-11-20 07:33:43'),
(11, 'sdfksdfj', 'sdkfsjdflksdjf', '', 'sdflksjdf@vmia.com', 'test', 1, '', '', '', 0, '', '', '', '', '', '', '2015-11-20 07:54:30'),
(12, 'Testing33V', '', '', 'testV@gmail.com', 'testing', 1, '', '', '', 0, '', '', '', '', '', '', '2015-12-22 07:49:50'),
(13, '', '', '', '', '', 1, '', '', '', 0, '', '', '', '', '', '', '2015-12-23 09:36:04'),
(14, 'sdf', '', '', 'newww@gmail.com', '12345', 1, '', 'sdf', '', 0, '', '', '', '', '', '', '2015-12-23 09:37:10'),
(15, 'testingg', '', '', 'hte@gmail.com', '12345', 1, '', 'test.com', '', 2, '', '', '', '', '', '', '2015-12-23 10:37:19'),
(16, 'Testing33V', '', '', 'hestt@gmail.com', 'mind@123', 1, '', 'http://google.com', '2015-12-22', 2, '', '', '', '', '', '', '2015-12-23 10:52:23'),
(17, 'testing', 'viskumar', 'cus_7cDwem3czpbNTY', 'viskumar@betasoftsystems.com', '12345', 1, '', 'testin.com', '2015-12-27', 2, '', '', '', '', '', '', '2015-12-28 11:47:56');

-- --------------------------------------------------------

--
-- Table structure for table `client_queries`
--

CREATE TABLE IF NOT EXISTS `client_queries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_query` text NOT NULL,
  `client_id` int(11) NOT NULL,
  `status` varchar(90) NOT NULL,
  `response_content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `client_queries`
--

INSERT INTO `client_queries` (`id`, `content_query`, `client_id`, `status`, `response_content`, `created_at`) VALUES
(1, 'Testing conetnet', 5, '', '', '2015-11-13 08:10:14'),
(2, 'tst', 5, '', '', '2015-11-13 10:45:47'),
(3, 'new', 5, '', '', '2015-11-13 10:46:06'),
(4, 'Testing suport', 5, '', '', '2015-11-16 06:10:47'),
(5, 'Testing notes here', 5, '', '', '2015-11-16 12:13:59');

-- --------------------------------------------------------

--
-- Table structure for table `invites`
--

CREATE TABLE IF NOT EXISTS `invites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `team_id` int(11) NOT NULL,
  `is_accepted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=Not responded, 1= Accepted, 2= declined',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `invites`
--

INSERT INTO `invites` (`id`, `email`, `team_id`, `is_accepted`, `created_at`) VALUES
(1, 'viskumar@betasoftsystems.com', 1, 0, '2015-11-04 12:13:22'),
(3, 'visdf@gmail.com', 2, 0, '2015-11-04 12:19:41'),
(5, 'tommy@gmail.com', 3, 0, '2015-11-05 07:37:35'),
(6, 'chad@offerz.co', 4, 0, '2015-11-05 08:17:56'),
(8, 'test2@gmail.com', 5, 0, '2015-11-05 11:40:51'),
(9, 'vikash@betasoftsystems.com', 5, 0, '2015-11-05 11:40:51'),
(10, 'sukant@gmail.com', 4, 0, '2015-11-16 12:11:52'),
(11, 'sdf@gmail.com', 6, 1, '2015-11-30 11:19:04'),
(13, 'newmem23@betasoftsystems.com', 8, 0, '2016-01-21 09:59:34'),
(14, 'vishalj@gmail.com', 9, 0, '2015-11-24 10:04:24'),
(15, 'test@gmail.com', 8, 1, '2015-11-27 07:06:29'),
(17, 'test@gmail.com', 9, 0, '2016-01-21 09:54:51'),
(18, 'sdf@gmail.com', 10, 0, '2016-01-21 09:54:43'),
(19, 'new@gmail.com', 11, 0, '2016-01-05 05:55:59'),
(22, 'newww@gmail.com', 11, 0, '2016-01-05 06:00:13'),
(23, 'newmem23@gmail.com', 8, 0, '2016-01-21 10:00:15'),
(25, 'testtt@gmail.com', 13, 0, '2016-01-08 09:37:38'),
(26, 'sdf@gmail.com', 5, 0, '2016-01-15 07:12:56'),
(37, 'test222@gmail.com', 20, 1, '2016-01-21 10:08:50'),
(39, 'test222@gmail.com', 24, 0, '2016-01-22 11:06:07');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE IF NOT EXISTS `offers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `editable_text` text NOT NULL,
  `not_editable_text` text NOT NULL,
  `team_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `start_date` varchar(90) NOT NULL,
  `date_send_on` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `editable_text`, `not_editable_text`, `team_id`, `client_id`, `image_name`, `start_date`, `date_send_on`, `created_at`) VALUES
(4, 'Testing editabl333', 'not editable222', 4, 5, '1452575759yatch2.jpg', 'later', '2015-11-24', '2015-11-12 14:15:37'),
(5, 'Testingg212', 'n edittf', 5, 5, '14526770712f799ee2cab513adcdba81a8228bc05fapp_icon_square_edges.jpg', 'now', '', '2016-01-11 10:57:15'),
(7, 'grettre5', 'ereee2225', 12, 5, '1452765400.jpg', 'now', '', '2016-01-11 12:23:18'),
(8, 'testtt', 'sddf', 7, 5, '', 'later', '2016-01-22', '2016-01-14 11:14:43'),
(9, 'testing offer ', 'dssd', 6, 5, '', 'now', '', '2016-01-15 07:39:35');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE IF NOT EXISTS `plans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_name` varchar(90) NOT NULL,
  `plan_title` varchar(255) NOT NULL,
  `price` varchar(50) NOT NULL,
  `frequecy_plan` enum('daily','weekly','monthly','yearly') NOT NULL DEFAULT 'monthly',
  `description` text NOT NULL,
  `ambassador_limit` int(11) NOT NULL,
  `teams_limit` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=Enable, 0= Disabled',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `plan_name`, `plan_title`, `price`, `frequecy_plan`, `description`, `ambassador_limit`, `teams_limit`, `status`) VALUES
(1, 'individual', 'individual ', '99', 'monthly', 'testing', 10, 1, 1),
(2, 'Studio', 'Studio', '249', 'monthly', '', 50, 5, 1),
(3, 'Enterprise', 'Enterprise', '499', 'monthly', '', -1, -1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subc_id` varchar(90) NOT NULL,
  `client_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `subc_id`, `client_id`, `status`, `created_at`) VALUES
(4, 'sub_7cxyvVKtGrkcsm', 17, 'active', '2015-12-30 11:17:33');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `client_id` int(11) NOT NULL,
  `is_deleted` varchar(90) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `client_id`, `is_deleted`, `created_at`) VALUES
(1, 'Team 1', 5, '1453188613', '2015-11-04 12:13:22'),
(2, 'Team 2', 5, '1453188801', '2015-11-04 12:19:41'),
(3, 'Team 3', 5, '0', '2015-11-05 07:37:34'),
(4, 'Testing Team', 5, '0', '2015-11-05 08:17:56'),
(5, 'Team Atlanta', 5, '0', '2015-11-05 11:39:43'),
(6, 'testtt', 5, '0', '2015-11-17 09:29:09'),
(7, 'sdfsdf65', 5, '0', '2015-11-17 09:31:37'),
(8, 'TestingV', 10, '0', '2015-11-20 07:45:33'),
(9, 'NewAdmind team', 10, '0', '2015-11-24 10:04:24'),
(10, 'etrterte333', 5, '0', '2015-12-17 05:23:29'),
(11, 'testfgf65464', 5, '0', '2016-01-05 05:55:57'),
(12, 'MyNewTeam', 5, '0', '2016-01-06 11:20:28'),
(13, 'My another new team', 5, '0', '2016-01-08 09:37:35'),
(14, 'TESTINGGGG', 5, '1453283321', '2016-01-20 09:27:00'),
(15, 'TESTINGGGG', 5, '1453283309', '2016-01-20 09:32:26'),
(16, 'NEW TEAM AGAIN', 5, '1453283304', '2016-01-20 09:42:33'),
(17, 'testtttte', 5, '1453283300', '2016-01-20 09:44:39'),
(18, 'testtttte', 5, '1453283295', '2016-01-20 09:44:57'),
(19, 'testtttte', 5, '1453283325', '2016-01-20 09:45:58'),
(20, 'newteam23', 5, '0', '2016-01-20 09:56:58'),
(21, 'ANOthhh', 5, '0', '2016-01-21 09:49:34'),
(22, 'VICKYYTEMA', 5, '1453460793', '2016-01-22 11:05:06'),
(23, 'VICKYYTEMA', 5, '1453460789', '2016-01-22 11:05:39'),
(24, 'VICKYYTEMA', 5, '0', '2016-01-22 11:06:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(90) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(90) NOT NULL,
  `description` text NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `oauth_token` varchar(255) NOT NULL,
  `oauth_secret_token` varchar(255) NOT NULL,
  `screen_name` varchar(255) NOT NULL,
  `twitter_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `description`, `image_path`, `image_name`, `oauth_token`, `oauth_secret_token`, `screen_name`, `twitter_id`, `created_at`) VALUES
(4, 'Vishal2', '', 'test@gmail.com', 'rereee', '', '', '', '', '', '', '', '2015-11-26 09:59:43'),
(5, 'Vishal', '', 'sdf@gmail.com', '123456', '', '', '', '3005294516-iKWwf3sBavDHScNFomfi4WmWI78vpmScfQbbCGX', 'brZwTQfOidDq9qmNYfFXyAgkpdScx4PaUDXWiEsExOQ0q', 'sandeepsingla90', '3005294516', '2015-11-26 10:01:11'),
(6, 'Vishal', '', 'test222@gmail.com', '123456', '', '', '', '', '', 'vkarora42', '', '2015-11-26 10:41:55');

-- --------------------------------------------------------

--
-- Table structure for table `users_clients_relation`
--

CREATE TABLE IF NOT EXISTS `users_clients_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(255) NOT NULL,
  `client_id` int(11) NOT NULL,
  `request_status` tinyint(4) NOT NULL COMMENT '0=not responded, 1= accepted, 2= decliened',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users_clients_relation`
--

INSERT INTO `users_clients_relation` (`id`, `user_email`, `client_id`, `request_status`, `created_at`) VALUES
(7, 'test222@gmail.com', 5, 0, '2016-01-21 10:05:32');

-- --------------------------------------------------------

--
-- Table structure for table `users_queries`
--

CREATE TABLE IF NOT EXISTS `users_queries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_query` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(90) NOT NULL,
  `response_content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users_queries`
--

INSERT INTO `users_queries` (`id`, `content_query`, `user_id`, `status`, `response_content`, `created_at`) VALUES
(1, 'This is the message here for query', 5, '', 'this is my response', '2015-12-10 06:08:08'),
(2, 'Thsi is another query', 5, '', '', '2015-12-10 06:40:09'),
(3, 'This is the message here for query', 5, '', '', '2015-12-10 06:42:29');

-- --------------------------------------------------------

--
-- Table structure for table `user_offers`
--

CREATE TABLE IF NOT EXISTS `user_offers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=new( Not shared), 1=shared, 2=Declined',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `user_offers`
--

INSERT INTO `user_offers` (`id`, `user_id`, `offer_id`, `client_id`, `status`, `created_at`) VALUES
(1, 5, 28, 5, 2, '2015-11-30 11:48:16'),
(2, 6, 29, 5, 0, '2015-12-03 06:22:34'),
(3, 5, 30, 5, 0, '2015-12-03 06:41:23'),
(4, 5, 0, 0, 0, '2015-12-08 07:45:32'),
(5, 5, 28, 0, 1, '2015-12-08 07:45:32'),
(6, 5, 0, 0, 1, '2015-12-08 07:46:23'),
(7, 5, 0, 0, 1, '2015-12-08 07:46:23'),
(8, 6, 31, 5, 0, '2016-01-05 06:29:42'),
(9, 6, 8, 5, 0, '2016-01-14 11:14:44'),
(10, 5, 9, 5, 0, '2016-01-15 07:39:35');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

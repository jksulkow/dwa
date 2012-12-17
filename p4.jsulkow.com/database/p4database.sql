-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 17, 2012 at 02:51 PM
-- Server version: 5.5.25
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `jsulkowc_p4_jsulkow_com`
--

-- --------------------------------------------------------

--
-- Table structure for table `gifts`
--

CREATE TABLE `gifts` (
  `gift_id` int(11) NOT NULL AUTO_INCREMENT,
  `recipient_occasion_id` int(11) NOT NULL,
  `gift_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `location` varchar(255) CHARACTER SET utf8 NOT NULL,
  `got_it` tinyint(4) NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  PRIMARY KEY (`gift_id`),
  KEY `recipient_occasion_id` (`recipient_occasion_id`),
  KEY `recipient_occasion_id_2` (`recipient_occasion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ucs2 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `gifts`
--

INSERT INTO `gifts` (`gift_id`, `recipient_occasion_id`, `gift_name`, `location`, `got_it`, `created`, `modified`) VALUES
(10, 19, 'book', 'bookstore', 0, 1355106894, 1355106894),
(33, 19, 'shoes', 'shoestore', 0, 1355713457, 1355713457),
(34, 19, 'candy', 'confectioners', 0, 1355713497, 1355713497),
(35, 19, 'snuffbox', 'tobacconist', 0, 1355713515, 1355713515),
(36, 19, 'milk', 'dairy', 0, 1355713532, 1355713532),
(37, 19, 'earrings', 'jewellers', 0, 1355713829, 1355713829),
(38, 20, 'cravat', 'who knows', 0, 1355714501, 1355714501),
(41, 20, 'shoes', 'shoe store', 0, 1355715373, 1355715373);

-- --------------------------------------------------------

--
-- Table structure for table `occasions`
--

CREATE TABLE `occasions` (
  `occasion_id` int(11) NOT NULL AUTO_INCREMENT,
  `occasion_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `date` date NOT NULL,
  `birthday_recipient_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`occasion_id`),
  KEY `birthday_recipient_id` (`birthday_recipient_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ucs2 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `occasions`
--

INSERT INTO `occasions` (`occasion_id`, `occasion_name`, `date`, `birthday_recipient_id`) VALUES
(2, 'Christmas 2012', '2012-12-25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `recipients`
--

CREATE TABLE `recipients` (
  `recipient_id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'recipient as a user',
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  PRIMARY KEY (`recipient_id`),
  KEY `user_id` (`user_id`),
  KEY `user_id_2` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ucs2 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `recipients`
--

INSERT INTO `recipients` (`recipient_id`, `nickname`, `user_id`, `created`, `modified`) VALUES
(18, 'Emma', 7, 0, 0),
(19, 'Jane', 8, 0, 0),
(20, 'elizabeth', 9, 0, 0),
(21, 'Mr.', 10, 0, 0),
(22, 'Harriet', NULL, 1355019643, 1355019643),
(23, 'Mr. Knightley', NULL, 1355713850, 1355713850);

-- --------------------------------------------------------

--
-- Table structure for table `recipients_occasions`
--

CREATE TABLE `recipients_occasions` (
  `recipient_occasion_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_recipient_id` int(11) NOT NULL,
  `occasion_id` int(11) NOT NULL,
  `is_done` tinyint(4) NOT NULL,
  PRIMARY KEY (`recipient_occasion_id`),
  KEY `user_recipient_id` (`user_recipient_id`,`occasion_id`),
  KEY `occasion_id` (`occasion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ucs2 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `recipients_occasions`
--

INSERT INTO `recipients_occasions` (`recipient_occasion_id`, `user_recipient_id`, `occasion_id`, `is_done`) VALUES
(17, 19, 2, 0),
(18, 20, 2, 0),
(19, 21, 2, 1),
(20, 22, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ucs2 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `token`, `first_name`, `last_name`, `created`, `modified`) VALUES
(7, 'ewoodhouse@fake.com', 'ebf3142c44bc1a17a55d00d782b4d83485434160', 'c9e15f2a11d5f6005d21276e17359840b72a30fe', 'Emma', 'Woodhouse', 1354678958, 1354678958),
(8, 'jeyre@fake.com', 'ebf3142c44bc1a17a55d00d782b4d83485434160', '93e7651213ef8771c8181d2a09e888ad7f55ce84', 'Jane', 'Eyre', 1354679365, 1354679365),
(9, 'ebennet@fake.com', 'ebf3142c44bc1a17a55d00d782b4d83485434160', '120ed89441e09f44cc8d399dda59df3b2774fae4', 'elizabeth', 'bennet', 1354679402, 1354679402),
(10, 'darcy@fake.com', 'ebf3142c44bc1a17a55d00d782b4d83485434160', '3544bbd5a531e8f325ddc38c9044380c4ba5f65f', 'Mr.', 'Darcy', 1354761402, 1354761402);

-- --------------------------------------------------------

--
-- Table structure for table `users_recipients`
--

CREATE TABLE `users_recipients` (
  `user_recipient_id` int(11) NOT NULL AUTO_INCREMENT,
  `recipient_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`user_recipient_id`),
  KEY `recipient_id` (`recipient_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ucs2 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `users_recipients`
--

INSERT INTO `users_recipients` (`user_recipient_id`, `recipient_id`, `user_id`) VALUES
(19, 18, 9),
(20, 19, 9),
(21, 22, 7),
(22, 23, 7);

-- --------------------------------------------------------

--
-- Table structure for table `wishes`
--

CREATE TABLE `wishes` (
  `wish_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  PRIMARY KEY (`wish_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `wishes`
--

INSERT INTO `wishes` (`wish_id`, `user_id`, `item_name`, `created`, `modified`) VALUES
(1, 7, 'bicycle', 1355599294, 1355599294),
(2, 7, 'fountain pen', 1355599312, 1355599312),
(3, 7, 'lace', 1355601400, 1355601400),
(4, 7, 'gothic novel', 1355601434, 1355601434);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gifts`
--
ALTER TABLE `gifts`
  ADD CONSTRAINT `gifts_ibfk_1` FOREIGN KEY (`recipient_occasion_id`) REFERENCES `recipients_occasions` (`recipient_occasion_id`);

--
-- Constraints for table `recipients_occasions`
--
ALTER TABLE `recipients_occasions`
  ADD CONSTRAINT `recipients_occasions_ibfk_1` FOREIGN KEY (`user_recipient_id`) REFERENCES `users_recipients` (`user_recipient_id`),
  ADD CONSTRAINT `recipients_occasions_ibfk_2` FOREIGN KEY (`occasion_id`) REFERENCES `occasions` (`occasion_id`);

--
-- Constraints for table `users_recipients`
--
ALTER TABLE `users_recipients`
  ADD CONSTRAINT `users_recipients_ibfk_1` FOREIGN KEY (`recipient_id`) REFERENCES `recipients` (`recipient_id`),
  ADD CONSTRAINT `users_recipients_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `wishes`
--
ALTER TABLE `wishes`
  ADD CONSTRAINT `wishes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);


-- TODO : Implement db generation task

-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Nov 25, 2017 at 08:18 PM
-- Server version: 5.6.33-79.0-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vfmobo6d_caventa`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `get_work_overviews`$$
CREATE DEFINER=`vfmobo6d`@`localhost` PROCEDURE `get_work_overviews`(IN `given_sales_person_id` INT)
BEGIN
	
	DECLARE var_id INT;
	
	DECLARE done INT DEFAULT FALSE;
	DECLARE cur1 CURSOR FOR SELECT `works`.`id` FROM `works` WHERE `sales_person_id` = given_sales_person_id;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
	
	DROP TABLE IF EXISTS `work_overviews`;
	CREATE TEMPORARY TABLE IF NOT EXISTS `work_overviews` (
		`name` varchar(50) NOT NULL,
		`address` varchar(250) NOT NULL,
		`work_date` date NOT NULL,
		`total_advance` double DEFAULT NULL,
		`total_expense` double DEFAULT NULL
	) ENGINE=MyISAM DEFAULT CHARSET=latin1;

	OPEN cur1;
	
	read_loop: LOOP
		
		FETCH cur1 INTO var_id;
		
		IF done THEN
		  LEAVE read_loop;
		END IF;
		
		INSERT INTO `work_overviews`(`name`, `address`, `work_date`, `total_advance`, `total_expense`)
		SELECT `work_overview`.`name`,`work_overview`.`address`,`work_overview`.`work_date`,`work_overview`.`total_advance`,`work_overview`.`total_expense` FROM
			( SELECT * FROM 
				( SELECT `name`, `address`, `work_date`,`works`.`id` FROM `works` 
					WHERE `id` =var_id ) AS `works`
			JOIN
				( SELECT * FROM 
					( SELECT SUM( `work_advances`.`amount` ) AS total_advance,`work_advances`.`work_id` FROM `work_advances`
						WHERE  `work_advances`.`work_id`=var_id ) as `work_advances_sum`

				JOIN 
					( SELECT SUM( `work_expenses`.`amount` ) AS total_expense,`work_expenses`.`work_id` AS `expense_work_id` FROM `work_expenses` 
						WHERE `work_expenses`.`work_id`=var_id ) as `work_expenses_sum` ) 
			AS `work_advances_expenses_sum` ) 
		AS `work_overview`;
		
	END LOOP;
	
	CLOSE cur1;
	
	SELECT `name`, `address`, `work_date`, `total_advance`, `total_expense` FROM `work_overviews`;

END$$

--
-- Functions
--
DROP FUNCTION IF EXISTS `get_work_profit`$$
CREATE DEFINER=`vfmobo6d`@`localhost` FUNCTION `get_work_profit`(`given_work_id` INT) RETURNS float
BEGIN
  DECLARE advances FLOAT;
  DECLARE expenses FLOAT;
  
  SELECT SUM(amount) INTO advances FROM work_advances WHERE work_id=given_work_id;
  SELECT SUM(amount) INTO expenses FROM work_expenses WHERE work_id=given_work_id;
  
  RETURN (advances-expenses);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

DROP TABLE IF EXISTS `configuration`;
CREATE TABLE IF NOT EXISTS `configuration` (
  `system_status` tinyint(4) NOT NULL,
  `version_code` int(11) NOT NULL,
  `version_name` double NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`system_status`, `version_code`, `version_name`, `id`) VALUES
(1, 1, 1.11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_clear`
--

DROP TABLE IF EXISTS `payment_clear`;
CREATE TABLE IF NOT EXISTS `payment_clear` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clear_date` date NOT NULL DEFAULT '2017-11-14',
  `clear_time` time NOT NULL DEFAULT '18:00:00',
  `sales_person_id` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `payment_clear`
--

INSERT INTO `payment_clear` (`id`, `clear_date`, `clear_time`, `sales_person_id`) VALUES
(54, '2017-11-14', '19:03:38', 2),
(55, '2017-11-14', '19:59:43', 4),
(56, '2017-11-12', '18:00:00', 5);

-- --------------------------------------------------------

--
-- Table structure for table `sales_persons`
--

DROP TABLE IF EXISTS `sales_persons`;
CREATE TABLE IF NOT EXISTS `sales_persons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `sales_persons`
--

INSERT INTO `sales_persons` (`id`, `name`) VALUES
(1, 'Caventa'),
(2, 'Ameer'),
(4, 'Ansheer'),
(5, 'Anoop');

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

DROP TABLE IF EXISTS `works`;
CREATE TABLE IF NOT EXISTS `works` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `work_date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `insertion_date_time` datetime NOT NULL,
  `sales_person_id` int(11) NOT NULL,
  `deletion_date_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `works`
--

INSERT INTO `works` (`id`, `name`, `address`, `work_date`, `status`, `insertion_date_time`, `sales_person_id`, `deletion_date_time`) VALUES
(2, 'Birthday', 'c/o Anoop', '2017-10-21', 1, '2017-11-10 09:29:33', 1, NULL),
(3, 'Jamal wedding', 'Chembra', '2017-11-25', 0, '2017-11-10 10:06:54', 2, NULL),
(4, 'Vivek wedding', 'Thekkumuri', '2017-11-12', 1, '2017-11-10 10:12:36', 2, NULL),
(5, 'Hashim wedding', 'B.p angadi', '2017-11-30', 0, '2017-11-10 10:16:43', 4, NULL),
(6, 'Navas', 'Bp angadi', '2017-10-08', 1, '2017-11-10 10:21:59', 4, NULL),
(7, 'Ragesh wedding', 'Trikandiyur', '2017-12-18', 0, '2017-11-10 10:22:41', 5, NULL),
(8, 'Faisal', 'Tirur', '2017-10-30', 1, '2017-11-10 10:24:38', 5, NULL),
(9, 'Samad wedding', 'Ezhur', '2017-10-16', 1, '2017-11-10 10:26:00', 1, NULL),
(10, 'Mansoor wedding', 'Parassei', '2017-11-12', 1, '2017-11-10 10:28:49', 4, NULL),
(11, 'Shafeeq', 'vailathur', '2017-11-20', 1, '2017-11-10 10:29:14', 1, NULL),
(12, 'test', 'test', '2017-11-23', 0, '2017-11-20 21:54:51', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `work_advances`
--

DROP TABLE IF EXISTS `work_advances`;
CREATE TABLE IF NOT EXISTS `work_advances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL,
  `amount` double NOT NULL,
  `work_id` int(11) NOT NULL,
  `insertion_date_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `work_advances`
--

INSERT INTO `work_advances` (`id`, `description`, `amount`, `work_id`, `insertion_date_time`) VALUES
(2, '', 5000, 2, '2017-11-10 09:29:33'),
(3, '', 3000, 2, '2017-11-10 09:29:33'),
(17, '', 30000, 4, '2017-11-12 14:04:47'),
(16, '', 30000, 4, '2017-11-12 14:04:47'),
(7, '', 50000, 6, '2017-11-10 10:21:59'),
(8, '', 50000, 6, '2017-11-10 10:21:59'),
(9, '', 40000, 8, '2017-11-10 10:24:38'),
(10, '', 30000, 9, '2017-11-10 10:26:00'),
(18, 'ex', 10000, 4, '2017-11-12 14:04:47'),
(19, 'Advance', 1000, 10, '2017-11-12 21:21:27'),
(20, 'ad', 1000, 11, '2017-11-20 21:52:49'),
(21, 'test', 2500, 12, '2017-11-20 21:54:51');

-- --------------------------------------------------------

--
-- Table structure for table `work_expenses`
--

DROP TABLE IF EXISTS `work_expenses`;
CREATE TABLE IF NOT EXISTS `work_expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL,
  `amount` double NOT NULL,
  `work_id` int(11) NOT NULL,
  `insertion_date_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `work_expenses`
--

INSERT INTO `work_expenses` (`id`, `description`, `amount`, `work_id`, `insertion_date_time`) VALUES
(2, 'editing', 1000, 2, '2017-11-10 09:29:33'),
(27, 'ameer', 10000, 4, '2017-11-12 14:04:47'),
(26, 'editing', 6000, 4, '2017-11-12 14:04:47'),
(25, 'Vahid', 12000, 4, '2017-11-12 14:04:47'),
(24, 'printing', 5000, 4, '2017-11-12 14:04:47'),
(7, 'Ameer', 12000, 6, '2017-11-10 10:21:59'),
(8, 'Vahid', 15000, 6, '2017-11-10 10:21:59'),
(9, 'Safad', 15000, 6, '2017-11-10 10:21:59'),
(10, 'Printing', 10000, 6, '2017-11-10 10:21:59'),
(11, 'Editing', 12000, 6, '2017-11-10 10:21:59'),
(12, 'Ameer', 10000, 8, '2017-11-10 10:24:38'),
(13, 'Printing', 8000, 8, '2017-11-10 10:24:38'),
(14, 'Lijith', 8000, 9, '2017-11-10 10:26:00'),
(15, 'Printing', 8000, 9, '2017-11-10 10:26:00'),
(28, 'petrol', 500, 4, '2017-11-12 14:04:47'),
(29, 'Petrol', 500, 10, '2017-11-12 21:21:27'),
(30, 'vvvv', 50, 12, '2017-11-20 21:54:51');

-- --------------------------------------------------------

--
-- Table structure for table `work_profits`
--

DROP TABLE IF EXISTS `work_profits`;
CREATE TABLE IF NOT EXISTS `work_profits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `work_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `sales_person_id` int(11) NOT NULL,
  `insertion_date_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `work_profits`
--

INSERT INTO `work_profits` (`id`, `work_id`, `amount`, `sales_person_id`, `insertion_date_time`) VALUES
(18, 6, 14400, 1, '2017-11-13 00:00:00'),
(17, 6, 21600, 4, '2017-11-13 00:00:00'),
(16, 2, 7000, 1, '2017-11-13 00:00:00'),
(19, 4, 21900, 2, '2017-11-13 00:00:00'),
(20, 4, 14600, 1, '2017-11-13 00:00:00'),
(21, 8, 13200, 5, '2017-11-13 00:00:00'),
(22, 8, 8800, 1, '2017-11-13 00:00:00'),
(23, 9, 14000, 1, '2017-11-13 00:00:00'),
(24, 10, 300, 4, '2017-11-13 00:00:00'),
(25, 10, 200, 1, '2017-11-13 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

CREATE TABLE `works` (
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
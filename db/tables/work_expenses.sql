-- --------------------------------------------------------

--
-- Table structure for table `work_expenses`
--

CREATE TABLE `work_expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL,
  `amount` double NOT NULL,
  `work_id` int(11) NOT NULL,
  `insertion_date_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;
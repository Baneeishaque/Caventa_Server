-- --------------------------------------------------------

--
-- Table structure for table `work_profits`
--

CREATE TABLE `work_profits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `work_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `sales_person_id` int(11) NOT NULL,
  `insertion_date_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;
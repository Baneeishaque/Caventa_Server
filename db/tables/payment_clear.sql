-- --------------------------------------------------------

--
-- Table structure for table `payment_clear`
--

CREATE TABLE `payment_clear` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clear_date` date NOT NULL DEFAULT '2017-11-14',
  `clear_time` time NOT NULL DEFAULT '18:00:00',
  `sales_person_id` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;
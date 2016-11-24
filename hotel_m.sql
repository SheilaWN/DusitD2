-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 12, 2016 at 02:49 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hotel_m`
--

-- --------------------------------------------------------

--
-- Table structure for table `bsi_admin`
--

CREATE TABLE IF NOT EXISTS `bsi_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pass` varchar(255) CHARACTER SET latin1 NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 NOT NULL DEFAULT 'admin',
  `access_id` int(1) NOT NULL DEFAULT '0',
  `f_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `l_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `designation` varchar(255) CHARACTER SET latin1 NOT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bsi_admin`
--

INSERT INTO `bsi_admin` (`id`, `pass`, `username`, `access_id`, `f_name`, `l_name`, `email`, `designation`, `last_login`, `status`) VALUES
(1, '21232f297a57a5a743894a0e4a801fc3', 'admin', 1, 'Sheila', 'Wambui', 'swambui@gmail.com', 'Administrator', '2016-10-12 14:47:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bsi_adminmenu`
--

CREATE TABLE IF NOT EXISTS `bsi_adminmenu` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET latin1 NOT NULL,
  `url` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `parent_id` int(4) DEFAULT '0',
  `status` enum('Y','N') CHARACTER SET latin1 DEFAULT 'Y',
  `ord` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=75 ;

--
-- Dumping data for table `bsi_adminmenu`
--

INSERT INTO `bsi_adminmenu` (`id`, `name`, `url`, `parent_id`, `status`, `ord`) VALUES
(6, 'SETTING', '#', 0, 'Y', 9),
(31, 'Global Setting', 'global_setting.php', 6, 'Y', 1),
(33, 'HOTEL MANAGER', '#', 0, 'Y', 2),
(34, 'Room Manager', 'room_list.php', 33, 'Y', 1),
(35, 'RoomType Manager', 'roomtype.php', 33, 'Y', 2),
(36, 'PricePlan Manager', 'priceplan.php', 63, 'Y', 4),
(37, 'BOOKING MANAGER', '#', 0, 'Y', 4),
(39, 'View Booking List', 'view_bookings.php', 37, 'Y', 2),
(43, 'Payment Gateway', 'payment_gateway.php', 6, 'Y', 4),
(44, 'Email Contents', 'email_content.php', 6, 'Y', 5),
(59, 'Capacity Manager', 'admin_capacity.php', 33, 'Y', 3),
(61, 'Advance Payment', 'advance_payment.php', 63, 'Y', 6),
(63, 'PRICE MANAGER', '#', 0, 'Y', 3),
(66, 'Hotel Details', 'admin_hotel_details.php', 33, 'Y', 0),
(68, 'Room Blocking', 'admin_block_room.php', 37, 'Y', 6),
(70, 'Calendar View', 'calendar_view.php', 37, 'Y', 5),
(71, 'Customer Lookup', 'customerlookup.php', 37, 'Y', 4),
(72, 'Admin Menu Manager', 'adminmenu.list.php', 6, 'Y', 6),
(73, 'LANGUAGE MANAGER', '#', 0, 'Y', 6),
(74, 'Manage Languages', 'manage_langauge.php', 73, 'Y', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bsi_advance_payment`
--

CREATE TABLE IF NOT EXISTS `bsi_advance_payment` (
  `month_num` int(11) NOT NULL AUTO_INCREMENT,
  `month` varchar(255) CHARACTER SET latin1 NOT NULL,
  `deposit_percent` decimal(10,2) NOT NULL,
  PRIMARY KEY (`month_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `bsi_advance_payment`
--

INSERT INTO `bsi_advance_payment` (`month_num`, `month`, `deposit_percent`) VALUES
(1, 'January', '0.00'),
(2, 'February', '0.00'),
(3, 'March', '0.00'),
(4, 'April', '0.00'),
(5, 'May', '0.00'),
(6, 'June', '0.00'),
(7, 'July', '0.00'),
(8, 'August', '0.00'),
(9, 'September', '0.00'),
(10, 'October', '0.00'),
(11, 'November', '0.00'),
(12, 'December', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `bsi_bookings`
--

CREATE TABLE IF NOT EXISTS `bsi_bookings` (
  `booking_id` int(10) unsigned NOT NULL,
  `booking_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `start_date` date NOT NULL DEFAULT '0000-00-00',
  `end_date` date NOT NULL DEFAULT '0000-00-00',
  `client_id` int(10) unsigned DEFAULT NULL,
  `child_count` int(2) NOT NULL DEFAULT '0',
  `extra_guest_count` int(2) NOT NULL DEFAULT '0',
  `discount_coupon` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `total_cost` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `payment_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `payment_type` varchar(255) CHARACTER SET latin1 NOT NULL,
  `payment_success` tinyint(1) NOT NULL DEFAULT '0',
  `payment_txnid` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `paypal_email` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `special_id` int(10) unsigned NOT NULL DEFAULT '0',
  `special_requests` text CHARACTER SET latin1,
  `is_block` tinyint(4) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `block_name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`booking_id`),
  KEY `start_date` (`start_date`),
  KEY `end_date` (`end_date`),
  KEY `booking_time` (`discount_coupon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bsi_bookings`
--


-- --------------------------------------------------------

--
-- Table structure for table `bsi_capacity`
--

CREATE TABLE IF NOT EXISTS `bsi_capacity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET latin1 NOT NULL,
  `capacity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bsi_capacity`
--


-- --------------------------------------------------------

--
-- Table structure for table `bsi_cc_info`
--

CREATE TABLE IF NOT EXISTS `bsi_cc_info` (
  `booking_id` varchar(100) CHARACTER SET latin1 NOT NULL,
  `cardholder_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `card_type` varchar(50) CHARACTER SET latin1 NOT NULL,
  `card_number` blob NOT NULL,
  `expiry_date` varchar(10) CHARACTER SET latin1 NOT NULL,
  `ccv2_no` int(4) NOT NULL,
  PRIMARY KEY (`booking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bsi_cc_info`
--


-- --------------------------------------------------------

--
-- Table structure for table `bsi_clients`
--

CREATE TABLE IF NOT EXISTS `bsi_clients` (
  `client_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(64) CHARACTER SET latin1 DEFAULT NULL,
  `surname` varchar(64) CHARACTER SET latin1 DEFAULT NULL,
  `title` varchar(16) CHARACTER SET latin1 DEFAULT NULL,
  `street_addr` text CHARACTER SET latin1,
  `city` varchar(64) CHARACTER SET latin1 DEFAULT NULL,
  `province` varchar(128) CHARACTER SET latin1 DEFAULT NULL,
  `zip` varchar(64) CHARACTER SET latin1 DEFAULT NULL,
  `country` varchar(64) CHARACTER SET latin1 DEFAULT NULL,
  `phone` varchar(64) CHARACTER SET latin1 DEFAULT NULL,
  `fax` varchar(64) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(128) CHARACTER SET latin1 DEFAULT NULL,
  `additional_comments` text CHARACTER SET latin1,
  `ip` varchar(32) CHARACTER SET latin1 DEFAULT NULL,
  `existing_client` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`client_id`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bsi_clients`
--


-- --------------------------------------------------------

--
-- Table structure for table `bsi_configure`
--

CREATE TABLE IF NOT EXISTS `bsi_configure` (
  `conf_id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_key` varchar(100) CHARACTER SET latin1 NOT NULL,
  `conf_value` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`conf_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='bsi hotel configurations' AUTO_INCREMENT=32 ;

--
-- Dumping data for table `bsi_configure`
--

INSERT INTO `bsi_configure` (`conf_id`, `conf_key`, `conf_value`) VALUES
(1, 'conf_hotel_name', 'DusitD2'),
(2, 'conf_hotel_streetaddr', '99 xxxxx Road'),
(3, 'conf_hotel_city', 'Your City'),
(4, 'conf_hotel_state', 'Your State'),
(5, 'conf_hotel_country', 'USA'),
(6, 'conf_hotel_zipcode', '11211'),
(7, 'conf_hotel_phone', '+18778888972'),
(8, 'conf_hotel_fax', '+18778888972'),
(9, 'conf_hotel_email', 'swambui@gmail.com'),
(13, 'conf_currency_symbol', '$'),
(14, 'conf_currency_code', 'USD'),
(20, 'conf_tax_amount', '12.50'),
(21, 'conf_dateformat', 'mm/dd/yy'),
(22, 'conf_booking_exptime', '1000'),
(25, 'conf_enabled_deposit', '1'),
(26, 'conf_hotel_timezone', 'Asia/Calcutta'),
(27, 'conf_booking_turn_off', '0'),
(28, 'conf_min_night_booking', '2'),
(30, 'conf_notification_email', 'sales@bestsoftinc.com'),
(31, 'conf_price_with_tax', '0');

-- --------------------------------------------------------

--
-- Table structure for table `bsi_email_contents`
--

CREATE TABLE IF NOT EXISTS `bsi_email_contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_name` varchar(500) CHARACTER SET latin1 NOT NULL,
  `email_subject` varchar(500) CHARACTER SET latin1 NOT NULL,
  `email_text` longtext CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `bsi_email_contents`
--

INSERT INTO `bsi_email_contents` (`id`, `email_name`, `email_subject`, `email_text`) VALUES
(1, 'Confirmation Email', 'Confirmation of your successfull booking in our hotel', '<p><strong>Text can be chnage in admin panel</strong></p>\r\n'),
(2, 'Cancellation Email ', 'Cancellation Email subject', '<p><strong>Text can be chnage in admin panel</strong></p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `bsi_invoice`
--

CREATE TABLE IF NOT EXISTS `bsi_invoice` (
  `booking_id` int(10) NOT NULL,
  `client_name` varchar(500) CHARACTER SET latin1 NOT NULL,
  `client_email` varchar(500) CHARACTER SET latin1 NOT NULL,
  `invoice` longtext CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`booking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bsi_invoice`
--


-- --------------------------------------------------------

--
-- Table structure for table `bsi_language`
--

CREATE TABLE IF NOT EXISTS `bsi_language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_title` varchar(255) NOT NULL,
  `lang_code` varchar(10) NOT NULL,
  `lang_file` varchar(255) NOT NULL,
  `lang_default` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `bsi_language`
--

INSERT INTO `bsi_language` (`id`, `lang_title`, `lang_code`, `lang_file`, `lang_default`) VALUES
(1, 'English', 'en', 'english.php', 1),
(2, 'French', 'fr', 'french.php', 0),
(3, 'German', 'de', 'german.php', 0),
(4, 'Greek', 'el', 'greek.php', 0),
(5, 'Spanish', 'es', 'espanol.php', 0),
(6, 'Italian', 'it', 'italian.php', 0),
(7, 'Dutch', 'de', 'dutch.php', 0),
(8, 'Polish', 'pl', 'polish.php', 0),
(9, 'Portuguese', 'pt', 'portuguese.php', 0),
(10, 'Russian', 'ru', 'russian.php', 0),
(11, 'Turkish', 'tr', 'turkish.php', 0),
(12, 'Thai', 'th', 'thai.php', 0),
(13, 'Chinese', 'zh-CN', 'chinese.php', 0),
(14, 'Indonesian', 'id', 'indonesian.php', 0),
(15, 'Romanian', 'ro', 'romanian.php', 0),
(17, 'Japanese', 'ja', 'japanese.php', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bsi_payment_gateway`
--

CREATE TABLE IF NOT EXISTS `bsi_payment_gateway` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gateway_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `gateway_code` varchar(50) CHARACTER SET latin1 NOT NULL,
  `account` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `bsi_payment_gateway`
--

INSERT INTO `bsi_payment_gateway` (`id`, `gateway_name`, `gateway_code`, `account`, `enabled`) VALUES
(1, 'Paypal', 'pp', 'phpdev_1330251667_biz@aol.com', 1),
(2, 'Manual', 'poa', NULL, 1),
(3, 'Credit Card', 'cc', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bsi_priceplan`
--

CREATE TABLE IF NOT EXISTS `bsi_priceplan` (
  `plan_id` int(10) NOT NULL AUTO_INCREMENT,
  `roomtype_id` int(10) DEFAULT NULL,
  `capacity_id` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `sun` decimal(10,2) DEFAULT '0.00',
  `mon` decimal(10,2) DEFAULT '0.00',
  `tue` decimal(10,2) DEFAULT '0.00',
  `wed` decimal(10,2) DEFAULT '0.00',
  `thu` decimal(10,2) DEFAULT '0.00',
  `fri` decimal(10,2) DEFAULT '0.00',
  `sat` decimal(10,2) DEFAULT '0.00',
  `default_plan` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`plan_id`),
  KEY `priceplan` (`roomtype_id`,`capacity_id`,`start_date`,`end_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bsi_priceplan`
--


-- --------------------------------------------------------

--
-- Table structure for table `bsi_reservation`
--

CREATE TABLE IF NOT EXISTS `bsi_reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bookings_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bsi_reservation`
--


-- --------------------------------------------------------

--
-- Table structure for table `bsi_room`
--

CREATE TABLE IF NOT EXISTS `bsi_room` (
  `room_ID` int(10) NOT NULL AUTO_INCREMENT,
  `roomtype_id` int(10) DEFAULT NULL,
  `room_no` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `capacity_id` int(10) DEFAULT NULL,
  `no_of_child` int(11) NOT NULL DEFAULT '0',
  `extra_bed` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`room_ID`),
  KEY `roomtype_id` (`roomtype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bsi_room`
--


-- --------------------------------------------------------

--
-- Table structure for table `bsi_roomtype`
--

CREATE TABLE IF NOT EXISTS `bsi_roomtype` (
  `roomtype_ID` int(10) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `description` text CHARACTER SET latin1,
  `img` varchar(256) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`roomtype_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bsi_roomtype`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

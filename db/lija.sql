-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 23, 2019 at 04:18 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lija`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE IF NOT EXISTS `admin_users` (
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` varchar(128) NOT NULL DEFAULT '',
  `last_logon` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `no_logon` int(11) NOT NULL DEFAULT '0',
  `fname` varchar(32) NOT NULL DEFAULT '',
  `lname` varchar(32) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `usertype` int(1) NOT NULL DEFAULT '0',
  `email` varchar(64) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `added_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`username`, `password`, `last_logon`, `no_logon`, `fname`, `lname`, `address`, `usertype`, `email`, `image`, `added_on`, `modified_on`) VALUES
('safikul', 'wx+4NRpG2gm7BtCIRUbnXxduLPJxyMFgITPWsj4wmQw=', '2016-02-17 10:54:55', 12, 'Safikul', 'Islam', 'Berhampore', 2, 'safikulislam@gmail.com', '', '2014-12-15 10:10:42', '0000-00-00 00:00:00'),
('tistasoft', '8hh41fs1XJoeHgivFtMxhSXU9kPK9WAEtm5dSvsfcYg=', '2018-12-09 20:25:56', 41, 'safikul', 'Islam', 'Barasat', 0, 'safikul@gmail.com', '', '2016-02-17 12:32:36', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `blog_mst`
--

CREATE TABLE IF NOT EXISTS `blog_mst` (
  `blog_id` int(4) NOT NULL AUTO_INCREMENT,
  `domain` varchar(100) NOT NULL,
  `niche` varchar(40) NOT NULL,
  `da` decimal(5,2) NOT NULL,
  `pa` int(3) NOT NULL,
  `cf` decimal(5,0) NOT NULL,
  `tf` decimal(5,2) NOT NULL,
  `gip` int(6) NOT NULL,
  `mozr` int(2) NOT NULL,
  `alexa_traffic` int(12) NOT NULL,
  `organic_trafic` int(12) NOT NULL,
  `follow` tinyint(1) NOT NULL,
  `internal` tinyint(1) NOT NULL,
  `cost` int(4) NOT NULL,
  `review_type` tinyint(1) NOT NULL,
  `issue` tinyint(1) NOT NULL,
  `issue_comment` varchar(150) DEFAULT NULL,
  `int_email` varchar(100) DEFAULT NULL,
  `ext_email` varchar(100) DEFAULT NULL,
  `ext_contact_name` varchar(100) DEFAULT NULL,
  `ext_cost` int(4) DEFAULT NULL,
  `ex_url` varchar(200) NOT NULL,
  `domain_comments` varchar(200) DEFAULT NULL,
  `deliver_time` decimal(10,0) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_on` date NOT NULL,
  `updated_by` varchar(50) NOT NULL,
  `updated_on` date NOT NULL,
  `approved` varchar(4) NOT NULL,
  PRIMARY KEY (`blog_id`),
  UNIQUE KEY `domain` (`domain`),
  KEY `updated_by` (`updated_by`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `blog_mst`
--

INSERT INTO `blog_mst` (`blog_id`, `domain`, `niche`, `da`, `pa`, `cf`, `tf`, `gip`, `mozr`, `alexa_traffic`, `organic_trafic`, `follow`, `internal`, `cost`, `review_type`, `issue`, `issue_comment`, `int_email`, `ext_email`, `ext_contact_name`, `ext_cost`, `ex_url`, `domain_comments`, `deliver_time`, `created_by`, `created_on`, `updated_by`, `updated_on`, `approved`) VALUES
(1, 'bizmaa.com', 'Business', '13.00', 17, '12', '11.00', 0, 0, 985655, 245, 1, 1, 10, 0, 0, NULL, NULL, NULL, NULL, 10, '', NULL, '12', 'bappask@gmail.com', '2018-09-25', '', '2018-09-25', 'No'),
(2, 'https://www.elivestory.com', 'Multi', '28.00', 30, '36', '26.00', 0, 280000, 500, 8000, 1, 0, 20, 0, 0, '', '', '', '', 20, 'https://www.elivestory.com/not-sure-need-local-professional-house-painters-heres/', 'hi		 kk', '12', 'bappask@gmail.com', '2019-01-31', 'bappask@gmail.com', '2019-01-31', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `countries_id` int(11) NOT NULL AUTO_INCREMENT,
  `countries_name` varchar(64) NOT NULL DEFAULT '',
  `countries_iso_code_2` char(2) NOT NULL DEFAULT '',
  `countries_iso_code_3` char(3) NOT NULL DEFAULT '',
  `address_format_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`countries_id`),
  KEY `IDX_COUNTRIES_NAME` (`countries_name`),
  FULLTEXT KEY `full_index_country` (`countries_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=253 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`countries_id`, `countries_name`, `countries_iso_code_2`, `countries_iso_code_3`, `address_format_id`) VALUES
(1, 'Afghanistan', 'AF', 'AFG', 1),
(2, 'Albania', 'AL', 'ALB', 1),
(3, 'Algeria', 'DZ', 'DZA', 1),
(4, 'American Samoa', 'AS', 'ASM', 1),
(5, 'Andorra', 'AD', 'AND', 1),
(6, 'Angola', 'AO', 'AGO', 1),
(7, 'Anguilla', 'AI', 'AIA', 1),
(8, 'Antarctica', 'AQ', 'ATA', 1),
(9, 'Antigua and Barbuda', 'AG', 'ATG', 1),
(10, 'Argentina', 'AR', 'ARG', 1),
(11, 'Armenia', 'AM', 'ARM', 1),
(12, 'Aruba', 'AW', 'ABW', 1),
(13, 'Australia', 'AU', 'AUS', 1),
(14, 'Austria', 'AT', 'AUT', 5),
(15, 'Azerbaijan', 'AZ', 'AZE', 1),
(16, 'Bahamas', 'BS', 'BHS', 1),
(17, 'Bahrain', 'BH', 'BHR', 1),
(18, 'Bangladesh', 'BD', 'BGD', 1),
(19, 'Barbados', 'BB', 'BRB', 1),
(20, 'Belarus', 'BY', 'BLR', 1),
(21, 'Belgium', 'BE', 'BEL', 1),
(22, 'Belize', 'BZ', 'BLZ', 1),
(23, 'Benin', 'BJ', 'BEN', 1),
(24, 'Bermuda', 'BM', 'BMU', 1),
(25, 'Bhutan', 'BT', 'BTN', 1),
(26, 'Bolivia', 'BO', 'BOL', 1),
(27, 'Bosnia and Herzegowina', 'BA', 'BIH', 1),
(28, 'Botswana', 'BW', 'BWA', 1),
(29, 'Bouvet Island', 'BV', 'BVT', 1),
(30, 'Brazil', 'BR', 'BRA', 1),
(31, 'British Indian Ocean Territory', 'IO', 'IOT', 1),
(32, 'Brunei Darussalam', 'BN', 'BRN', 1),
(33, 'Bulgaria', 'BG', 'BGR', 1),
(34, 'Burkina Faso', 'BF', 'BFA', 1),
(35, 'Burundi', 'BI', 'BDI', 1),
(36, 'Cambodia', 'KH', 'KHM', 1),
(37, 'Cameroon', 'CM', 'CMR', 1),
(38, 'Canada', 'CA', 'CAN', 1),
(39, 'Cape Verde', 'CV', 'CPV', 1),
(40, 'Cayman Islands', 'KY', 'CYM', 1),
(41, 'Central African Republic', 'CF', 'CAF', 1),
(42, 'Chad', 'TD', 'TCD', 1),
(43, 'Chile', 'CL', 'CHL', 1),
(44, 'China', 'CN', 'CHN', 1),
(45, 'Christmas Island', 'CX', 'CXR', 1),
(46, 'Cocos (Keeling) Islands', 'CC', 'CCK', 1),
(47, 'Colombia', 'CO', 'COL', 1),
(48, 'Comoros', 'KM', 'COM', 1),
(49, 'Congo', 'CG', 'COG', 1),
(50, 'Cook Islands', 'CK', 'COK', 1),
(51, 'Costa Rica', 'CR', 'CRI', 1),
(52, 'Cote D''Ivoire', 'CI', 'CIV', 1),
(53, 'Croatia', 'HR', 'HRV', 1),
(54, 'Cuba', 'CU', 'CUB', 1),
(55, 'Cyprus', 'CY', 'CYP', 1),
(56, 'Czech Republic', 'CZ', 'CZE', 1),
(57, 'Denmark', 'DK', 'DNK', 1),
(58, 'Djibouti', 'DJ', 'DJI', 1),
(59, 'Dominica', 'DM', 'DMA', 1),
(60, 'Dominican Republic', 'DO', 'DOM', 1),
(61, 'East Timor', 'TP', 'TMP', 1),
(62, 'Ecuador', 'EC', 'ECU', 1),
(63, 'Egypt', 'EG', 'EGY', 1),
(64, 'El Salvador', 'SV', 'SLV', 1),
(65, 'Equatorial Guinea', 'GQ', 'GNQ', 1),
(66, 'Eritrea', 'ER', 'ERI', 1),
(67, 'Estonia', 'EE', 'EST', 1),
(68, 'Ethiopia', 'ET', 'ETH', 1),
(69, 'Falkland Islands (Malvinas)', 'FK', 'FLK', 1),
(70, 'Faroe Islands', 'FO', 'FRO', 1),
(71, 'Fiji', 'FJ', 'FJI', 1),
(72, 'Finland', 'FI', 'FIN', 1),
(73, 'France', 'FR', 'FRA', 1),
(74, 'France, Metropolitan', 'FX', 'FXX', 1),
(75, 'French Guiana', 'GF', 'GUF', 1),
(76, 'French Polynesia', 'PF', 'PYF', 1),
(77, 'French Southern Territories', 'TF', 'ATF', 1),
(78, 'Gabon', 'GA', 'GAB', 1),
(79, 'Gambia', 'GM', 'GMB', 1),
(80, 'Georgia', 'GE', 'GEO', 1),
(81, 'Germany', 'DE', 'DEU', 5),
(82, 'Ghana', 'GH', 'GHA', 1),
(83, 'Gibraltar', 'GI', 'GIB', 1),
(84, 'Greece', 'GR', 'GRC', 1),
(85, 'Greenland', 'GL', 'GRL', 1),
(86, 'Grenada', 'GD', 'GRD', 1),
(87, 'Guadeloupe', 'GP', 'GLP', 1),
(88, 'Guam', 'GU', 'GUM', 1),
(89, 'Guatemala', 'GT', 'GTM', 1),
(90, 'Guinea', 'GN', 'GIN', 1),
(91, 'Guinea-bissau', 'GW', 'GNB', 1),
(92, 'Guyana', 'GY', 'GUY', 1),
(93, 'Haiti', 'HT', 'HTI', 1),
(94, 'Heard and Mc Donald Islands', 'HM', 'HMD', 1),
(95, 'Honduras', 'HN', 'HND', 1),
(96, 'Hong Kong', 'HK', 'HKG', 1),
(97, 'Hungary', 'HU', 'HUN', 1),
(98, 'Iceland', 'IS', 'ISL', 1),
(99, 'India', 'IN', 'IND', 1),
(100, 'Indonesia', 'ID', 'IDN', 1),
(101, 'Iran (Islamic Republic of)', 'IR', 'IRN', 1),
(102, 'Iraq', 'IQ', 'IRQ', 1),
(103, 'Ireland', 'IE', 'IRL', 1),
(104, 'Israel', 'IL', 'ISR', 1),
(105, 'Italy', 'IT', 'ITA', 1),
(106, 'Jamaica', 'JM', 'JAM', 1),
(107, 'Japan', 'JP', 'JPN', 1),
(108, 'Jordan', 'JO', 'JOR', 1),
(109, 'Kazakhstan', 'KZ', 'KAZ', 1),
(110, 'Kenya', 'KE', 'KEN', 1),
(111, 'Kiribati', 'KI', 'KIR', 1),
(112, 'Korea, Democratic People''s Republic of', 'KP', 'PRK', 1),
(113, 'Korea, Republic of', 'KR', 'KOR', 1),
(114, 'Kuwait', 'KW', 'KWT', 1),
(115, 'Kyrgyzstan', 'KG', 'KGZ', 1),
(116, 'Lao People''s Democratic Republic', 'LA', 'LAO', 1),
(117, 'Latvia', 'LV', 'LVA', 1),
(118, 'Lebanon', 'LB', 'LBN', 1),
(119, 'Lesotho', 'LS', 'LSO', 1),
(120, 'Liberia', 'LR', 'LBR', 1),
(121, 'Libyan Arab Jamahiriya', 'LY', 'LBY', 1),
(122, 'Liechtenstein', 'LI', 'LIE', 1),
(123, 'Lithuania', 'LT', 'LTU', 1),
(124, 'Luxembourg', 'LU', 'LUX', 1),
(125, 'Macau', 'MO', 'MAC', 1),
(126, 'Macedonia', 'MK', 'MKD', 1),
(127, 'Madagascar', 'MG', 'MDG', 1),
(128, 'Malawi', 'MW', 'MWI', 1),
(129, 'Malaysia', 'MY', 'MYS', 1),
(130, 'Maldives', 'MV', 'MDV', 1),
(131, 'Mali', 'ML', 'MLI', 1),
(132, 'Malta', 'MT', 'MLT', 1),
(133, 'Marshall Islands', 'MH', 'MHL', 1),
(134, 'Martinique', 'MQ', 'MTQ', 1),
(135, 'Mauritania', 'MR', 'MRT', 1),
(136, 'Mauritius', 'MU', 'MUS', 1),
(137, 'Mayotte', 'YT', 'MYT', 1),
(138, 'Mexico', 'MX', 'MEX', 1),
(139, 'Micronesia, Federated States of', 'FM', 'FSM', 1),
(140, 'Moldova, Republic of', 'MD', 'MDA', 1),
(141, 'Monaco', 'MC', 'MCO', 1),
(142, 'Mongolia', 'MN', 'MNG', 1),
(143, 'Montserrat', 'MS', 'MSR', 1),
(144, 'Morocco', 'MA', 'MAR', 1),
(145, 'Mozambique', 'MZ', 'MOZ', 1),
(146, 'Myanmar', 'MM', 'MMR', 1),
(147, 'Namibia', 'NA', 'NAM', 1),
(148, 'Nauru', 'NR', 'NRU', 1),
(149, 'Nepal', 'NP', 'NPL', 1),
(150, 'Netherlands', 'NL', 'NLD', 1),
(151, 'Netherlands Antilles', 'AN', 'ANT', 1),
(152, 'New Caledonia', 'NC', 'NCL', 1),
(153, 'New Zealand', 'NZ', 'NZL', 1),
(154, 'Nicaragua', 'NI', 'NIC', 1),
(155, 'Niger', 'NE', 'NER', 1),
(156, 'Nigeria', 'NG', 'NGA', 1),
(157, 'Niue', 'NU', 'NIU', 1),
(158, 'Norfolk Island', 'NF', 'NFK', 1),
(159, 'Northern Mariana Islands', 'MP', 'MNP', 1),
(160, 'Norway', 'NO', 'NOR', 1),
(161, 'Oman', 'OM', 'OMN', 1),
(162, 'Pakistan', 'PK', 'PAK', 1),
(163, 'Palau', 'PW', 'PLW', 1),
(164, 'Panama', 'PA', 'PAN', 1),
(165, 'Papua New Guinea', 'PG', 'PNG', 1),
(166, 'Paraguay', 'PY', 'PRY', 1),
(167, 'Peru', 'PE', 'PER', 1),
(168, 'Philippines', 'PH', 'PHL', 1),
(169, 'Pitcairn', 'PN', 'PCN', 1),
(170, 'Poland', 'PL', 'POL', 1),
(171, 'Portugal', 'PT', 'PRT', 1),
(172, 'Puerto Rico', 'PR', 'PRI', 1),
(173, 'Qatar', 'QA', 'QAT', 1),
(174, 'Reunion', 'RE', 'REU', 1),
(175, 'Romania', 'RO', 'ROM', 1),
(176, 'Russian Federation', 'RU', 'RUS', 1),
(177, 'Rwanda', 'RW', 'RWA', 1),
(178, 'Saint Kitts and Nevis', 'KN', 'KNA', 1),
(179, 'Saint Lucia', 'LC', 'LCA', 1),
(180, 'Saint Vincent and the Grenadines', 'VC', 'VCT', 1),
(181, 'Samoa', 'WS', 'WSM', 1),
(182, 'San Marino', 'SM', 'SMR', 1),
(183, 'Sao Tome and Principe', 'ST', 'STP', 1),
(184, 'Saudi Arabia', 'SA', 'SAU', 1),
(185, 'Senegal', 'SN', 'SEN', 1),
(186, 'Seychelles', 'SC', 'SYC', 1),
(187, 'Sierra Leone', 'SL', 'SLE', 1),
(188, 'Singapore', 'SG', 'SGP', 4),
(189, 'Slovakia (Slovak Republic)', 'SK', 'SVK', 1),
(190, 'Slovenia', 'SI', 'SVN', 1),
(191, 'Solomon Islands', 'SB', 'SLB', 1),
(192, 'Somalia', 'SO', 'SOM', 1),
(193, 'South Africa', 'ZA', 'ZAF', 1),
(194, 'South Georgia + South Sandwich Islands', 'GS', 'SGS', 1),
(195, 'Spain', 'ES', 'ESP', 3),
(196, 'Sri Lanka', 'LK', 'LKA', 1),
(197, 'St. Helena', 'SH', 'SHN', 1),
(198, 'St. Pierre and Miquelon', 'PM', 'SPM', 1),
(199, 'Sudan', 'SD', 'SDN', 1),
(200, 'Suriname', 'SR', 'SUR', 1),
(201, 'Svalbard and Jan Mayen Islands', 'SJ', 'SJM', 1),
(202, 'Swaziland', 'SZ', 'SWZ', 1),
(203, 'Sweden', 'SE', 'SWE', 1),
(204, 'Switzerland', 'CH', 'CHE', 1),
(205, 'Syrian Arab Republic', 'SY', 'SYR', 1),
(206, 'Taiwan', 'TW', 'TWN', 1),
(207, 'Tajikistan', 'TJ', 'TJK', 1),
(208, 'Tanzania, United Republic of', 'TZ', 'TZA', 1),
(209, 'Thailand', 'TH', 'THA', 1),
(210, 'Togo', 'TG', 'TGO', 1),
(211, 'Tokelau', 'TK', 'TKL', 1),
(212, 'Tonga', 'TO', 'TON', 1),
(213, 'Trinidad and Tobago', 'TT', 'TTO', 1),
(214, 'Tunisia', 'TN', 'TUN', 1),
(215, 'Turkey', 'TR', 'TUR', 1),
(216, 'Turkmenistan', 'TM', 'TKM', 1),
(217, 'Turks and Caicos Islands', 'TC', 'TCA', 1),
(218, 'Tuvalu', 'TV', 'TUV', 1),
(219, 'Uganda', 'UG', 'UGA', 1),
(220, 'Ukraine', 'UA', 'UKR', 1),
(221, 'United Arab Emirates', 'AE', 'ARE', 1),
(222, 'United Kingdom', 'GB', 'GBR', 1),
(223, 'United States', 'US', 'USA', 2),
(224, 'United States Minor Outlying Islands', 'UM', 'UMI', 1),
(225, 'Uruguay', 'UY', 'URY', 1),
(226, 'Uzbekistan', 'UZ', 'UZB', 1),
(227, 'Vanuatu', 'VU', 'VUT', 1),
(228, 'Vatican City State (Holy See)', 'VA', 'VAT', 1),
(229, 'Venezuela', 'VE', 'VEN', 1),
(230, 'Viet Nam', 'VN', 'VNM', 1),
(231, 'Virgin Islands (British)', 'VG', 'VGB', 1),
(232, 'Virgin Islands (U.S.)', 'VI', 'VIR', 1),
(233, 'Wallis and Futuna Islands', 'WF', 'WLF', 1),
(234, 'Western Sahara', 'EH', 'ESH', 1),
(235, 'Yemen', 'YE', 'YEM', 1),
(236, 'Yugoslavia', 'YU', 'YUG', 1),
(237, 'Zaire', 'ZR', 'ZAR', 1),
(238, 'Zambia', 'ZM', 'ZMB', 1),
(239, 'Zimbabwe', 'ZW', 'ZWE', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_type` enum('1','2','3') NOT NULL DEFAULT '1',
  `member_id` varchar(32) NOT NULL DEFAULT '0',
  `user_name` varchar(64) NOT NULL DEFAULT '',
  `email` varchar(96) NOT NULL DEFAULT '',
  `password` varchar(128) NOT NULL DEFAULT '',
  `billing_name` varchar(100) NOT NULL,
  `fname` varchar(32) NOT NULL DEFAULT '',
  `lname` varchar(32) NOT NULL DEFAULT '',
  `gender` enum('male','female','na') NOT NULL DEFAULT 'na',
  `dob` date NOT NULL DEFAULT '0000-00-00',
  `status` enum('a','d') NOT NULL DEFAULT 'a',
  `image` varchar(128) NOT NULL DEFAULT '',
  `brief` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `organization` varchar(128) NOT NULL DEFAULT '',
  `featured` enum('Y','N') NOT NULL DEFAULT 'N',
  `profession` varchar(32) NOT NULL DEFAULT '',
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `verification_no` varchar(64) DEFAULT NULL,
  `acc_verified` enum('Y','N') NOT NULL DEFAULT 'N',
  `verified_by` varchar(128) DEFAULT NULL,
  `verified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `discount_offered` float(4,2) NOT NULL DEFAULT '0.00',
  `added_on` date NOT NULL,
  PRIMARY KEY (`customer_id`),
  FULLTEXT KEY `full_index_cus` (`member_id`,`user_name`,`email`,`fname`,`lname`,`image`,`brief`,`description`,`organization`,`profession`,`verification_no`,`verified_by`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_type`, `member_id`, `user_name`, `email`, `password`, `billing_name`, `fname`, `lname`, `gender`, `dob`, `status`, `image`, `brief`, `description`, `organization`, `featured`, `profession`, `sort_order`, `verification_no`, `acc_verified`, `verified_by`, `verified_on`, `discount_offered`, `added_on`) VALUES
(8, '1', '1', 'admin@gmail.com', 'admin@gmail.com', '/4XR6OujjcvCVSMTc+XDoKPohjMqgsahMDE9nlO/vr8=', '', 'Safikul', 'Islam', 'male', '2017-12-03', 'a', '', '', '', '', 'Y', 'Blogger', 0, NULL, 'Y', NULL, '0000-00-00 00:00:00', 0.00, '2017-12-03'),
(10, '1', '1', 'adminadmin@gmail.com', 'adminadmin@gmail.com', 'JGFYGwJnzK2y7mpcwUIVVNxfC9Cn5/9hqLxHb8TR+yg=', '', 'vbm', 'bvhbj,km', 'male', '2017-11-27', 'a', '', '', '', '', 'Y', 'Web Developer', 0, NULL, 'Y', NULL, '0000-00-00 00:00:00', 0.00, '2017-12-03'),
(11, '', '1', 'bappask@gmail.com', 'bappask@gmail.com', 'LOeyEczMIUm3+Fi0lZi8pQKp7Q1lMau/vwDzYNyNBg0=', 'Small SEO', 'Bappa', 'sk', 'male', '1988-09-01', 'a', 'Jovani-Long-Sleeve-And-Short-Sleeve-Dresses-11QIILT.png', '', '', '', 'Y', 'Web Developer', 0, 'Y', 'Y', '', '2017-12-03 21:50:33', 0.00, '2017-12-03'),
(12, '1', '1', 'tistasoftnjn@gmail.com', 'tistasoftnjn@gmail.com', 'BAHzrnXNrF2+9SB0zIikDrNDH9Sa8M+L/qRh14uouJo=', '', 'whgbvh', 'vhg', 'female', '1988-10-01', 'a', '', '', '', '', 'Y', 'Blogger', 0, '', 'Y', '', '2017-12-16 11:02:55', 0.00, '2017-12-16'),
(13, '', '1', 'safikul@gmail.com', 'safikul@gmail.com', '6pGUywAbbNT+93O38sB2JJlNVgLcjsHfRP+cNRwEWdg=', '', 'Safikul', 'Islam', 'male', '2018-06-10', 'a', 'SAFIKUL-ISLAM-13ZUFLO.jpg', '', 'Hii			hh', '', 'Y', 'Web Developer', 0, '', 'Y', '', '2018-06-10 19:30:03', 0.00, '2018-06-10');

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE IF NOT EXISTS `customer_address` (
  `customer_id` int(11) NOT NULL DEFAULT '0',
  `address1` varchar(64) NOT NULL DEFAULT '',
  `address2` varchar(64) NOT NULL DEFAULT '',
  `address3` varchar(64) NOT NULL DEFAULT '',
  `town` varchar(128) NOT NULL DEFAULT '0',
  `province` varchar(128) NOT NULL DEFAULT '0',
  `postal_code` varchar(16) NOT NULL DEFAULT '',
  `countries_id` int(3) NOT NULL DEFAULT '0',
  `phone1` varchar(20) NOT NULL DEFAULT '',
  `phone2` varchar(20) NOT NULL DEFAULT '',
  `fax` varchar(20) NOT NULL DEFAULT '',
  `mobile` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`customer_id`),
  FULLTEXT KEY `full_index_address` (`address1`,`address2`,`address3`,`town`,`province`,`postal_code`,`phone1`,`phone2`,`fax`,`mobile`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`customer_id`, `address1`, `address2`, `address3`, `town`, `province`, `postal_code`, `countries_id`, `phone1`, `phone2`, `fax`, `mobile`) VALUES
(13, '', '', '', '', '', '', 99, '', '', '', ''),
(12, '', '', '', '', '', '', 27, '', '', '', ''),
(11, 'Sydney, CAS', '', '', '', '', '2365', 13, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer_info`
--

CREATE TABLE IF NOT EXISTS `customer_info` (
  `info_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL DEFAULT '0',
  `no_logon` int(11) NOT NULL DEFAULT '0',
  `last_logon` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `added_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`info_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `customer_info`
--

INSERT INTO `customer_info` (`info_id`, `customer_id`, `no_logon`, `last_logon`, `added_on`, `modified_on`) VALUES
(11, 12, 1, '2017-12-16 11:02:55', '2017-12-16 11:02:55', '0000-00-00 00:00:00'),
(10, 11, 54, '2019-04-21 10:53:10', '2017-12-03 21:50:33', '0000-00-00 00:00:00'),
(9, 10, 1, '2017-12-03 20:57:25', '2017-12-03 20:57:25', '0000-00-00 00:00:00'),
(8, 9, 1, '2017-12-03 20:42:32', '2017-12-03 20:42:32', '0000-00-00 00:00:00'),
(12, 13, 45, '2018-11-09 17:12:12', '2018-06-10 19:30:03', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `domains`
--

CREATE TABLE IF NOT EXISTS `domains` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `domain` varchar(100) NOT NULL,
  `niche` int(12) NOT NULL,
  `da` int(3) NOT NULL,
  `pa` int(3) NOT NULL,
  `cf` int(3) NOT NULL,
  `tf` int(3) NOT NULL,
  `alexa_traffic` int(8) NOT NULL,
  `organic_traffic` int(8) NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `sprice` decimal(10,2) NOT NULL,
  `durl` varchar(100) NOT NULL,
  `dimage` varchar(140) NOT NULL,
  `selling_status` enum('0','1') NOT NULL,
  `seo_url` varchar(180) NOT NULL,
  `approved` varchar(5) NOT NULL,
  `added_by` varchar(60) NOT NULL,
  `added_on` date NOT NULL,
  `modified_by` varchar(30) NOT NULL,
  `modified_on` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `domain` (`domain`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `domains`
--

INSERT INTO `domains` (`id`, `domain`, `niche`, `da`, `pa`, `cf`, `tf`, `alexa_traffic`, `organic_traffic`, `price`, `sprice`, `durl`, `dimage`, `selling_status`, `seo_url`, `approved`, `added_by`, `added_on`, `modified_by`, `modified_on`) VALUES
(16, 'facebook.com/', 16, 100, 100, 98, 96, 2, 12365412, '50000.00', '50000.00', 'https://www.facebook.com', 'eye-care-16DFQ0L.jpg', '1', 'facebook/', 'No', 'bappask@gmail.com', '2019-02-05', '', '0000-00-00'),
(18, 'test', 9, 87, 84, 57, 65, 562, 456321, '5000.00', '5000.00', 'test.com', 'Bail-Bonds-181BFOX.jpg', '1', 'test/', 'No', 'bappask@gmail.com', '2019-02-05', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `domain_featured`
--

CREATE TABLE IF NOT EXISTS `domain_featured` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `domain_id` int(20) NOT NULL,
  `featured` varchar(120) NOT NULL,
  `added_on` date NOT NULL,
  `modified_on` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `domain_featured`
--

INSERT INTO `domain_featured` (`id`, `domain_id`, `featured`, `added_on`, `modified_on`) VALUES
(1, 5, 'feaured1 gyhf hghg hjggy bvhfggc gbvyh', '2018-10-27', '0000-00-00'),
(2, 5, 'Featured1', '2018-10-27', '0000-00-00'),
(3, 5, 'Articles', '2018-10-27', '0000-00-00'),
(4, 2, 'Design', '2018-10-27', '0000-00-00'),
(5, 2, 'Good Metrics', '2018-10-27', '0000-00-00'),
(6, 3, '10 + Content', '2018-10-27', '0000-00-00'),
(7, 3, 'Seo link', '2018-10-27', '0000-00-00'),
(8, 3, 'Good Metrics', '2018-10-27', '0000-00-00'),
(9, 3, 'Design', '2018-10-27', '0000-00-00'),
(10, 3, 'domain name', '2018-10-27', '0000-00-00'),
(11, 4, 'test1', '2018-11-07', '0000-00-00'),
(12, 4, 'test2', '2018-11-07', '0000-00-00'),
(13, 4, 'test3', '2018-11-07', '0000-00-00'),
(14, 4, 'content', '2019-01-08', '0000-00-00'),
(15, 4, 'good metrics', '2019-01-08', '0000-00-00'),
(16, 4, 'test', '2019-01-08', '0000-00-00'),
(17, 6, '100 + unique articles', '2019-02-04', '0000-00-00'),
(18, 6, 'Design', '2019-02-04', '0000-00-00'),
(19, 6, 'Top Ranking on google', '2019-02-04', '0000-00-00'),
(20, 6, '', '2019-02-04', '0000-00-00'),
(21, 7, '100 + Unique article', '2019-02-04', '0000-00-00'),
(22, 7, 'Design', '2019-02-04', '0000-00-00'),
(23, 7, '', '2019-02-04', '0000-00-00'),
(24, 8, '100 + Unique article', '2019-02-04', '0000-00-00'),
(25, 8, 'Design', '2019-02-04', '0000-00-00'),
(26, 9, '20 + unique articles', '2019-02-04', '0000-00-00'),
(27, 9, 'Design', '2019-02-04', '0000-00-00'),
(28, 10, '200+ articles', '2019-02-04', '0000-00-00'),
(29, 0, '200 + articles', '2019-02-04', '0000-00-00'),
(30, 0, 'articles', '2019-02-04', '0000-00-00'),
(31, 11, 'Articles', '2019-02-04', '0000-00-00'),
(32, 12, 'Articles', '2019-02-04', '0000-00-00'),
(33, 13, 'Design', '2019-02-04', '0000-00-00'),
(34, 13, 'Tools', '2019-02-04', '0000-00-00'),
(35, 14, 'Articles', '2019-02-05', '0000-00-00'),
(36, 15, 'design', '2019-02-05', '0000-00-00'),
(37, 16, '100 + Articles', '2019-02-05', '0000-00-00'),
(38, 16, 'Design', '2019-02-05', '0000-00-00'),
(39, 0, '100 + Articles', '2019-02-05', '0000-00-00'),
(40, 0, 'Domain name', '2019-02-05', '0000-00-00'),
(41, 0, 'Design', '2019-02-05', '0000-00-00'),
(42, 18, '100+ Articles', '2019-02-05', '0000-00-00'),
(43, 18, 'Design', '2019-02-05', '0000-00-00'),
(44, 0, 'Articles', '2019-02-05', '0000-00-00'),
(45, 0, 'Articles', '2019-02-05', '0000-00-00'),
(46, 0, 'Tools', '2019-02-05', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `hits_counter`
--

CREATE TABLE IF NOT EXISTS `hits_counter` (
  `Count_Id` bigint(255) NOT NULL AUTO_INCREMENT,
  `Count` int(11) NOT NULL DEFAULT '0',
  `added_on` date NOT NULL DEFAULT '0000-00-00',
  `month_year` varchar(6) NOT NULL DEFAULT '',
  PRIMARY KEY (`Count_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `niche_master`
--

CREATE TABLE IF NOT EXISTS `niche_master` (
  `niche_id` int(4) NOT NULL AUTO_INCREMENT,
  `niche_name` varchar(75) DEFAULT NULL,
  `seo_url` varchar(180) NOT NULL,
  `added_on` date NOT NULL,
  `added_by` varchar(30) NOT NULL,
  `modified_on` date NOT NULL,
  `modified_by` varchar(30) NOT NULL,
  PRIMARY KEY (`niche_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `niche_master`
--

INSERT INTO `niche_master` (`niche_id`, `niche_name`, `seo_url`, `added_on`, `added_by`, `modified_on`, `modified_by`) VALUES
(1, 'Auto\n', '', '2016-02-17', 'safikul', '0000-00-00', ''),
(2, 'Business\n', '', '2016-02-17', 'safikul', '0000-00-00', ''),
(3, 'Education\n', '', '2016-02-17', 'safikul', '0000-00-00', ''),
(4, 'Family\n', '', '2016-02-17', 'safikul', '0000-00-00', ''),
(5, 'Fashion\n', '', '2016-02-17', 'safikul', '0000-00-00', ''),
(6, 'Health\n', '', '2016-02-17', 'safikul', '0000-00-00', ''),
(7, 'Home\n', '', '2016-02-17', 'safikul', '0000-00-00', ''),
(8, 'Law\n', '', '2016-02-17', 'safikul', '0000-00-00', ''),
(9, 'News\n', '', '2016-02-17', 'safikul', '0000-00-00', ''),
(10, 'Others', '', '2016-02-24', 'safikul', '0000-00-00', ''),
(11, 'Sports', '', '2016-03-08', 'safikul', '0000-00-00', ''),
(12, 'Technology', '', '2016-03-08', '', '0000-00-00', ''),
(13, 'Travel', '', '0000-00-00', '', '0000-00-00', ''),
(14, 'Finance', '', '2017-12-01', 'Safikul', '0000-00-00', ''),
(15, 'Casino', '', '2017-12-01', 'Safikul', '0000-00-00', ''),
(16, 'Multi', '', '2017-12-01', 'Safikul', '0000-00-00', ''),
(17, 'Gaming', '', '2017-12-01', 'Safikul', '0000-00-00', ''),
(18, 'Adult', '', '2017-12-01', 'Safikul', '0000-00-00', ''),
(19, 'Real Estate', '', '2017-12-01', 'Safikul', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `orders_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL DEFAULT '0',
  `billing_name` varchar(100) NOT NULL DEFAULT '',
  `orders_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `orders_code` varchar(50) NOT NULL DEFAULT '',
  `delivery_name` varchar(64) NOT NULL DEFAULT '',
  `delivery_address1` varchar(64) NOT NULL DEFAULT '',
  `delivery_address2` varchar(32) DEFAULT NULL,
  `delivery_city` varchar(32) NOT NULL DEFAULT '',
  `delivery_postcode` varchar(10) NOT NULL DEFAULT '',
  `delivery_phone` varchar(20) DEFAULT NULL,
  `delivery_state` varchar(32) DEFAULT NULL,
  `delivery_country` int(3) NOT NULL DEFAULT '0',
  `billing_address1` varchar(64) NOT NULL DEFAULT '',
  `billing_address2` varchar(32) DEFAULT NULL,
  `billing_city` varchar(32) NOT NULL DEFAULT '',
  `billing_postcode` varchar(10) NOT NULL DEFAULT '',
  `billing_phone` varchar(20) DEFAULT NULL,
  `billing_state` varchar(32) DEFAULT NULL,
  `billing_country` int(3) NOT NULL DEFAULT '0',
  `last_modified` datetime DEFAULT NULL,
  `date_purchased` datetime DEFAULT NULL,
  `shipping_id` int(11) NOT NULL DEFAULT '0',
  `shipping_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `shipping_method` varchar(128) NOT NULL DEFAULT '',
  `orders_status_id` int(5) NOT NULL DEFAULT '0',
  `orders_date_finished` datetime DEFAULT NULL,
  `email` varchar(64) NOT NULL DEFAULT '',
  `description` text,
  `payment_method_id` enum('cash','credit card') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'credit card',
  `cc_name` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `cc_number` varchar(10) DEFAULT NULL,
  `coupon_id` int(11) NOT NULL DEFAULT '0',
  `discount_provided` double(10,2) NOT NULL DEFAULT '0.00',
  `currency_code` char(3) DEFAULT NULL,
  `currency_conversion_rate` double(12,4) DEFAULT NULL,
  PRIMARY KEY (`orders_id`),
  FULLTEXT KEY `full_index_order` (`orders_code`,`delivery_name`,`delivery_address1`,`delivery_address2`,`delivery_city`,`delivery_postcode`,`delivery_phone`,`delivery_state`,`billing_address1`,`billing_address2`,`billing_city`,`billing_postcode`,`billing_phone`,`billing_state`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_id`, `customer_id`, `billing_name`, `orders_amount`, `orders_code`, `delivery_name`, `delivery_address1`, `delivery_address2`, `delivery_city`, `delivery_postcode`, `delivery_phone`, `delivery_state`, `delivery_country`, `billing_address1`, `billing_address2`, `billing_city`, `billing_postcode`, `billing_phone`, `billing_state`, `billing_country`, `last_modified`, `date_purchased`, `shipping_id`, `shipping_cost`, `shipping_method`, `orders_status_id`, `orders_date_finished`, `email`, `description`, `payment_method_id`, `cc_name`, `cc_number`, `coupon_id`, `discount_provided`, `currency_code`, `currency_conversion_rate`) VALUES
(1, 11, 'South Agency', '0.00', 'ORDER-14042019D9297-1002', '', 'south.agency@gmail.com', '', '', '', '', '', 13, '', NULL, '', '', NULL, NULL, 0, '2019-04-14 15:38:59', '2019-04-14 15:38:59', 0, '0.00', '', 1, NULL, 'bappask@gmail.com', 'Hi..', 'credit card', NULL, NULL, 0, 0.00, NULL, NULL),
(2, 11, 'South Agency', '0.00', 'ORDER-15042019PBNV0-1003', '', 'south.agency@gmail.com', '', '', '2365', '', '', 13, '', NULL, '', '', NULL, NULL, 0, '2019-04-15 09:52:27', '2019-04-15 09:52:28', 0, '0.00', '', 1, NULL, 'bappask@gmail.com', '', 'credit card', NULL, NULL, 0, 0.00, NULL, NULL),
(3, 11, 'South Agency', '0.00', 'ORDER-15042019SZX23-1004', 'Bappa', 'south.agency@gmail.com', '', '', '2365', '', '', 13, '', NULL, '', '', NULL, NULL, 0, '2019-04-15 10:28:29', '2019-04-15 10:28:29', 0, '0.00', '', 1, NULL, 'bappask@gmail.com', '', 'credit card', NULL, NULL, 0, 0.00, NULL, NULL),
(4, 11, 'South Agency', '0.00', 'ORDER-15042019IJPGX-1005', 'Bappa', 'Sydney', '', '', '2365', '', '', 13, '', NULL, '', '', NULL, NULL, 0, '2019-04-15 10:45:19', '2019-04-15 10:45:19', 0, '0.00', '', 1, NULL, 'south.agency@gmail.com', 'Hi', 'credit card', NULL, NULL, 0, 0.00, NULL, NULL),
(5, 11, 'South Agency', '50000.00', 'ORDER-21042019ANQLO-1006', 'Bappa', 'Sydney', '', '', '2365', '', '', 13, '', NULL, '', '', NULL, NULL, 0, '2019-04-21 11:06:27', '2019-04-21 11:06:27', 0, '0.00', '', 1, NULL, 'bappask@gmail.com', '', 'credit card', NULL, NULL, 0, 0.00, NULL, NULL),
(6, 11, 'Small SEO', '55000.00', 'ORDER-21042019KAXNC-1007', 'Bappa', 'Sydney, CAS', '', '', '2365', '', '', 13, '', NULL, '', '', NULL, NULL, 0, '2019-04-21 15:14:54', '2019-04-21 15:14:54', 0, '0.00', '', 1, NULL, 'bappask@gmail.com', 'Hi..', 'credit card', NULL, NULL, 0, 0.00, NULL, NULL),
(7, 11, 'Small SEO', '5000.00', 'ORDER-2104201958WDC-1008', 'Bappa', 'Sydney, CAS', '', '', '2365', '', '', 13, '', NULL, '', '', NULL, NULL, 0, '2019-04-21 18:58:17', '2019-04-21 18:58:17', 0, '0.00', '', 1, NULL, 'bappask@gmail.com', '', 'credit card', NULL, NULL, 0, 0.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders_products`
--

CREATE TABLE IF NOT EXISTS `orders_products` (
  `orders_products_id` int(11) NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL DEFAULT '0',
  `product_type` varchar(40) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL DEFAULT '0',
  `product_model` varchar(12) DEFAULT NULL,
  `product_name` varchar(64) NOT NULL DEFAULT '',
  `product_price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `final_price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `products_tax` decimal(7,4) NOT NULL DEFAULT '0.0000',
  `product_quantity` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`orders_products_id`),
  FULLTEXT KEY `full_index_order_prod` (`product_model`,`product_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `orders_products`
--

INSERT INTO `orders_products` (`orders_products_id`, `orders_id`, `product_type`, `product_id`, `product_model`, `product_name`, `product_price`, `final_price`, `products_tax`, `product_quantity`) VALUES
(1, 1, 'domain', 16, '', '', '50000.0000', '50000.0000', '0.0000', 1),
(2, 2, 'domain', 16, '', 'facebook.com/', '50000.0000', '50000.0000', '0.0000', 1),
(3, 3, 'domain', 16, '', 'facebook.com/', '50000.0000', '50000.0000', '0.0000', 1),
(4, 4, 'domain', 16, '', 'facebook.com/', '50000.0000', '50000.0000', '0.0000', 1),
(5, 5, 'domain', 16, '', 'facebook.com/', '50000.0000', '50000.0000', '0.0000', 1),
(6, 6, 'domain', 16, '', 'facebook.com/', '50000.0000', '50000.0000', '0.0000', 1),
(7, 6, 'domain', 18, '', 'test', '5000.0000', '5000.0000', '0.0000', 1),
(8, 7, 'domain', 18, '', 'test', '5000.0000', '5000.0000', '0.0000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(21) NOT NULL AUTO_INCREMENT,
  `product_type_id` int(11) NOT NULL,
  `product_name` varchar(180) NOT NULL,
  `band` varchar(60) NOT NULL,
  `platform` varchar(30) NOT NULL,
  `dev_langues` varchar(60) NOT NULL,
  `version` varchar(30) NOT NULL,
  `proj_url` varchar(200) NOT NULL,
  `download_link` varchar(220) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(150) NOT NULL,
  `client_price` decimal(10,2) NOT NULL,
  `sales_price` decimal(10,2) NOT NULL,
  `offer` decimal(6,3) NOT NULL,
  `service_period` int(4) NOT NULL,
  `service_unit` varchar(8) NOT NULL,
  `services` varchar(200) NOT NULL,
  `sales_status` varchar(16) NOT NULL,
  `approved` varchar(5) NOT NULL,
  `page_title` varchar(260) NOT NULL,
  `url` varchar(128) NOT NULL,
  `seo_url` varchar(260) NOT NULL,
  `meta_tags` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `num_click` int(20) NOT NULL,
  `added_by` int(20) NOT NULL,
  `added_on` date NOT NULL,
  `modified_by` varchar(30) NOT NULL,
  `modified_on` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_type_id`, `product_name`, `band`, `platform`, `dev_langues`, `version`, `proj_url`, `download_link`, `description`, `image`, `client_price`, `sales_price`, `offer`, `service_period`, `service_unit`, `services`, `sales_status`, `approved`, `page_title`, `url`, `seo_url`, `meta_tags`, `meta_description`, `num_click`, `added_by`, `added_on`, `modified_by`, `modified_on`) VALUES
(1, 1, 'Medical Development Software', 'GFSR', 'Web', 'Java, c++', '23', 'webtechhelp.org/demo', '', 'Custom Healthcare Software Development. Oxagile builds custom medical software to help health systems, hospitals, clinics, assisted living facilities, and other providers improve patient outcomes, balance costs, and secure PHI', 'Could-Result-1K0TT.png', '200.00', '200.00', '0.000', 30, 'Day', 'Running and support', 'Yes', 'No', 'Medical Development Software', '', 'medical-development-software/', 'Java, Medical', 'Custom Healthcare Software Development. Oxagile builds custom medical software to help health systems', 0, 13, '2018-11-07', '', '0000-00-00'),
(2, 1, 'Medical Development Software', 'BBN', 'Web', 'Php, Css, Html, Javascript', '5.2', 'webtechhelp.org/demomd', '', 'Custom Healthcare Software Development. Oxagile builds custom medical software to help health systems, hospitals, clinics, assisted living facilities, and other providers improve patient outcomes, balance costs, and secure PHI', '1816725_1478842673414-3P94YL.jpg', '500.00', '500.00', '0.000', 30, 'Day', 'Install and support', 'Yes', 'No', 'Medical Development Software', '', 'medical-development-software-2/', 'tag1, tag2, tag3', 'Custom Healthcare Software Development. Oxagile builds custom medical software to help health systems', 0, 13, '2018-11-08', '', '0000-00-00'),
(3, 1, 'Attendance System', 'LIJA', 'Web', 'Php, Javascript, Css, Html', '3.6', 'webtechhelp.org/demo2', '', 'Attendance Management System. | Employee Time & Attendance Software India. | greytHR', 'Charlie-Challenge-3D9XA3.png', '200.00', '200.00', '0.000', 12, 'Day', 'live and support', 'Yes', 'No', 'Attendance System', '', 'attendance-system/', 'tag1, tag2, tag3', 'Attendance Management System. | Employee Time & Attendance Software India. | greytHR', 0, 13, '2018-11-08', '', '0000-00-00'),
(4, 1, 'Students Management Software', 'POI', 'Web', 'Php, Css, Javascript', '3.6', 'web.com/deom', '', 'A student management system helps schools to store, manage, and distribute this information. Some student management systems are designed to serve all of a school''s data management needs. Other student management systems are specialized.', '4-Inspection-Mistakes-That-You-Should-Avoid-4XZQYK.png', '200.00', '200.00', '0.000', 20, 'Day', 'live and support', 'Yes', 'No', 'Students Management Software', '', 'students-management-software/', 'tags1, Tags2', 'A student management system helps schools to store, manage, and distribute this information. Some student management systems are designed to serve', 0, 13, '2018-11-09', '', '0000-00-00'),
(5, 4, 'woocommerce products gallery', 'SRW', 'Web', 'PHP, Jquery, CSS, Html', '5.2', 'ser.com/demo', '', 'Science has proven that Product images have a massive impact on your stores conversion rates. WooCommerce Dynamic Gallery will bring your stores static image display to life.\n\nAs soon as you install WooCommerce Dynamic Gallery your Product pages image gallery is transformed into a dynamic scrolling product gallery with thumbnails displayed in a single row slider.', 'Gift-for-Wife-5OJ32U.jpg', '40.00', '40.00', '0.000', 10, 'Day', 'Install and support', 'Yes', 'No', 'woocommerce products gallery', '', 'woocommerce-products-gallery/', 'tag1, tag2, tag3', 'Science has proven that Product images have a massive impact on your stores conversion rates. WooCommerce Dynamic Gallery will bring your ', 0, 13, '2018-11-09', '', '0000-00-00'),
(6, 1, 'Online Dating', 'ASW', 'Web', 'PHP, CSS, JQUESRY', '6.1', 'gdsffytgvd.com/demo', '', 'OkCupid is the only dating app that knows you''re more substance than just a ... We also share information about your use of our site with our social media', 'CBD-OIL-6SG7CJ.png', '8000.00', '8000.00', '0.000', 30, 'Day', 'Support', 'Yes', 'No', 'Online Dating', '', 'online-dating/', 'dating', 'OkCupid is the only dating app that knows you''re more substance than just a ... We also share information about your use of our site with our social media', 0, 11, '2019-02-05', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `product_featured`
--

CREATE TABLE IF NOT EXISTS `product_featured` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `product_id` int(20) NOT NULL,
  `featured` varchar(120) NOT NULL,
  `added_by` varchar(30) NOT NULL,
  `added_on` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `product_featured`
--

INSERT INTO `product_featured` (`id`, `product_id`, `featured`, `added_by`, `added_on`) VALUES
(1, 0, 'service1', '', '2018-11-07'),
(2, 0, 'service2', '', '2018-11-07'),
(3, 0, 'service3', '', '2018-11-07'),
(4, 0, 'Service1', '', '2018-11-07'),
(5, 0, 'Service2', '', '2018-11-07'),
(6, 0, 'Service3', '', '2018-11-07'),
(7, 2, 'service1', '', '2018-11-08'),
(8, 2, 'service2', '', '2018-11-08'),
(9, 3, 'adddn1', '', '2018-11-08'),
(10, 3, 'adddn2', '', '2018-11-08'),
(11, 4, 'stud service1', '', '2018-11-09'),
(12, 4, 'stud service2', '', '2018-11-09'),
(13, 4, 'stud service3', '', '2018-11-09'),
(14, 5, 'photo1', '', '2018-11-09'),
(15, 5, 'photo2', '', '2018-11-09'),
(16, 5, 'photo3', '', '2018-11-09'),
(17, 6, 'Seo friendly', '', '2019-02-05');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE IF NOT EXISTS `product_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_type` varchar(120) NOT NULL,
  `seo_url` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `added_by` varchar(30) NOT NULL,
  `added_on` date NOT NULL,
  `modified_by` varchar(30) NOT NULL,
  `modified_on` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`id`, `product_type`, `seo_url`, `description`, `added_by`, `added_on`, `modified_by`, `modified_on`) VALUES
(1, 'Web Application', '', 'Medical, Account, Inventory, Production', 'Safikul', '2018-10-29', '', '0000-00-00'),
(2, 'Web Design', '', 'Web Design with HTML, CSS and Javascript', 'Safikul', '2018-11-07', '', '0000-00-00'),
(3, 'Tools', '', 'Inventory tools, SEO tools, Medical Management tools etc', 'Safikul', '2018-11-07', '', '0000-00-00'),
(4, 'Plugins', '', 'WordPress, Magento etc', 'Safikul', '2018-11-07', '', '0000-00-00'),
(5, 'Guest Posting Package', '', 'Guest Post on Real Blogs', 'Safikul', '2018-12-02', '', '0000-00-00'),
(6, 'Link Building Package', '', 'Link building on different niches blogs', 'Safikul', '2018-12-02', '', '0000-00-00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

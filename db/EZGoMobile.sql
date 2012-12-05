
-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 05, 2012 at 10:24 AM
-- Server version: 5.1.57
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `a3401683_cs4911`
--

-- --------------------------------------------------------

--
-- Table structure for table `Account`
--

CREATE TABLE `Account` (
  `accountID` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `offers` varchar(1) NOT NULL DEFAULT 'Y',
  `address` varchar(80) NOT NULL,
  `city` varchar(80) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` int(8) NOT NULL,
  PRIMARY KEY (`accountID`),
  UNIQUE KEY `userName` (`userName`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `Account`
--

INSERT INTO `Account` VALUES(1, 'trey', 'abc', 'test@test.com', 'N', '', '', 'AL', 0);
INSERT INTO `Account` VALUES(2, 'tim', 'abc', 'update@update.com', 'N', '123 Tech Square', 'Lilburn', 'GA', 30321);
INSERT INTO `Account` VALUES(3, 'Madhu', '123', 'mtondepu@gmail.com', 'n', '', '', '', 0);
INSERT INTO `Account` VALUES(4, 'poppie', 'abc', 'poppie@test.com', 'n', '', '', '', 0);
INSERT INTO `Account` VALUES(5, 'ezgo', 'abc', 'ezgo@test.com', 'y', '', '', '', 0);
INSERT INTO `Account` VALUES(15, 'timm', 'abc', 'ti,m@gatech.edu', 'N', '123 tech square', 'atlanta', 'GA', 30047);
INSERT INTO `Account` VALUES(11, 'steve', 'dumb', 'Steve@Steve.com', 'Y', '1234', 'Steveville', 'AK', 0);
INSERT INTO `Account` VALUES(14, 'treyy', '', '', 'N', '', '', 'AL', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Account_Vehicle`
--

CREATE TABLE `Account_Vehicle` (
  `accountId` int(11) NOT NULL DEFAULT '0',
  `serialNumber` int(11) NOT NULL DEFAULT '0',
  `instanceId` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`instanceId`),
  KEY `serialNumber` (`serialNumber`),
  KEY `accountId` (`accountId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `Account_Vehicle`
--

INSERT INTO `Account_Vehicle` VALUES(1, 10, 1);
INSERT INTO `Account_Vehicle` VALUES(1, 1, 8);
INSERT INTO `Account_Vehicle` VALUES(1, 1234567890, 10);
INSERT INTO `Account_Vehicle` VALUES(1, 11, 7);
INSERT INTO `Account_Vehicle` VALUES(2, 6, 9);
INSERT INTO `Account_Vehicle` VALUES(2, 1234567890, 11);

-- --------------------------------------------------------

--
-- Table structure for table `Availability_LU`
--

CREATE TABLE `Availability_LU` (
  `availabilityId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`availabilityId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Availability_LU`
--

INSERT INTO `Availability_LU` VALUES(1, 'Available');
INSERT INTO `Availability_LU` VALUES(2, 'On Backorder');

-- --------------------------------------------------------

--
-- Table structure for table `Dealers`
--

CREATE TABLE `Dealers` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(80) COLLATE latin1_general_ci NOT NULL,
  `address` varchar(80) COLLATE latin1_general_ci NOT NULL,
  `city` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `state` varchar(2) COLLATE latin1_general_ci NOT NULL,
  `zip` int(5) NOT NULL,
  `phone` varchar(14) COLLATE latin1_general_ci NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `url` varchar(80) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `Dealers`
--

INSERT INTO `Dealers` VALUES(1, 'Action Specialty Carts, LLC', '4000 Venture Drive', 'Duluth', 'GA', 30096, '(770) 888-0892', 33.9487, 84.1431, 'www.ascarts.com');
INSERT INTO `Dealers` VALUES(2, 'HiLine Golf Carts of Atlanta', '2820 N. Peachtree Ind Blvd', 'Duluth', 'GA', 30097, '(770) 232-9330', 34.0229, -84.1461, 'www.hilinegolfcart.com');
INSERT INTO `Dealers` VALUES(3, 'Action Specialty Carts, LLC', '1005 Holcomb Woods Parkway', 'Roswell', 'GA', 30076, '(770) 888-0892', 34.0176, -84.3118, 'www.ascarts.com');
INSERT INTO `Dealers` VALUES(4, 'Action Specialty Carts, LLC', '6180 Parkway North Drive', 'Cumming', 'GA', 30040, '(770) 880-0892', 34.1669, -84.1861, 'www.ascarts.com');
INSERT INTO `Dealers` VALUES(5, 'Carts Atlanta', '1680 Lower Roswell Rd', 'Marietta', 'GA', 30068, '(770) 321-9300', 33.9518, -84.5036, 'www.golfcartsatlanta.com');
INSERT INTO `Dealers` VALUES(6, 'HiLine Golf Carts of Atlanta', '5825 B Holiday Road', 'Buford', 'GA', 30518, '(770) 614-0053', 34.1528, -83.9847, 'www.hilinegolfcart.com');
INSERT INTO `Dealers` VALUES(7, 'Action Specialty Carts, LLC', '2911 George Busbee Parkway', 'Kennesaw', 'GA', 30144, '(770) 888-0892', 34.0249, -84.5694, 'www.ascarts.com');
INSERT INTO `Dealers` VALUES(8, 'Fat Boys Golf Carts, LLC', '10445 Old Atlanta Hwy, Suite A', 'Covington', 'GA', 30014, '(678) 625-0711', 33.6083, -83.8755, 'www.fatboyscarts.com');
INSERT INTO `Dealers` VALUES(9, 'North Atlanta Golf Cars', '8660 Hwy 53 East', 'Dawsonville', 'GA', 30534, '(706) 265-2189', 34.3354, -84.0214, 'www.northatlantagolfcars.com');
INSERT INTO `Dealers` VALUES(10, 'Watkinsville Golf Cart', '300 Jerry Smith Drive, Ste A', 'Watkinsville', 'GA', 30677, '(706) 769-2095', 33.8521, -83.3992, '');

-- --------------------------------------------------------

--
-- Table structure for table `EZGOTV`
--

CREATE TABLE `EZGOTV` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(80) COLLATE latin1_general_ci NOT NULL,
  `URL` varchar(80) COLLATE latin1_general_ci NOT NULL,
  `Image` varchar(80) COLLATE latin1_general_ci NOT NULL,
  `Category` varchar(80) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=72 ;

--
-- Dumping data for table `EZGOTV`
--

INSERT INTO `EZGOTV` VALUES(1, 'E-Z-GO Rear Shock Installation', 'https://m.youtube.com/details?v=jDuoWtVuRQw', 'http://i.ytimg.com/vi/jDuoWtVuRQw/3.jpg', 'Installation');
INSERT INTO `EZGOTV` VALUES(2, 'E-Z-GO Heavy Duty Leaf Springs Installation', 'https://m.youtube.com/details?v=tn-9ibLzAqM', 'http://i.ytimg.com/vi/tn-9ibLzAqM/3.jpg', 'Installation');
INSERT INTO `EZGOTV` VALUES(3, 'E-Z-GO RXV Sun Top Installation', 'https://m.youtube.com/details?v=L-gGr9FGGqo', 'http://i.ytimg.com/vi/L-gGr9FGGqo/3.jpg', 'Installtion');
INSERT INTO `EZGOTV` VALUES(4, 'E-Z-GO RXV Windshield Kit Installation', 'https://m.youtube.com/details?v=9CGUOYK2tf4', 'http://i.ytimg.com/vi/9CGUOYK2tf4/3.jpg', 'Installation');
INSERT INTO `EZGOTV` VALUES(5, 'Introducing "My Vehicle" by ShopEZGO.com', 'https://m.youtube.com/details?v=DUxXSYEk1F4', 'http://i.ytimg.com/vi/DUxXSYEk1F4/3.jpg', 'Misc');
INSERT INTO `EZGOTV` VALUES(6, 'E-Z-GO Lift Kit Installation', 'https://m.youtube.com/details?v=SWtgJddwuCk', 'http://i.ytimg.com/vi/SWtgJddwuCk/3.jpg', 'Installation');
INSERT INTO `EZGOTV` VALUES(7, 'E-Z-GO Personality Plug Installation', 'https://m.youtube.com/details?v=7bAR4W9ytO0', 'http://i.ytimg.com/vi/7bAR4W9ytO0/3.jpg', 'Installation');
INSERT INTO `EZGOTV` VALUES(8, 'E-Z-GO MPT Serial Number Look-Up', 'https://m.youtube.com/details?v=j9kU3phktmk', 'http://i.ytimg.com/vi/j9kU3phktmk/3.jpg', 'Misc');
INSERT INTO `EZGOTV` VALUES(9, 'E-Z-GO Front Shock Installation', 'https://m.youtube.com/details?v=QR0Epsi2Nac', 'http://i.ytimg.com/vi/QR0Epsi2Nac/3.jpg', 'Installation');
INSERT INTO `EZGOTV` VALUES(10, 'E-Z-GO 2Five Serial Number Look-Up', 'https://m.youtube.com/details?v=6bjtWmtCuXk', 'http://i.ytimg.com/vi/6bjtWmtCuXk/3.jpg', 'Misc');
INSERT INTO `EZGOTV` VALUES(11, 'E-Z-GO Marathon Serial Number Look-Up', 'https://m.youtube.com/details?v=JOhULCIrduE', 'http://i.ytimg.com/vi/JOhULCIrduE/3.jpg', 'Misc');
INSERT INTO `EZGOTV` VALUES(12, 'E-Z-GO Medalist Serial Number Look-Up', 'https://m.youtube.com/details?v=6qyGhi8KRr8', 'http://i.ytimg.com/vi/6qyGhi8KRr8/3.jpg', 'Misc');
INSERT INTO `EZGOTV` VALUES(13, 'E-Z-GO RXV Serial Number Look-Up', 'https://m.youtube.com/details?v=Oj-KgoM7rKY', 'http://i.ytimg.com/vi/Oj-KgoM7rKY/3.jpg', 'Misc');
INSERT INTO `EZGOTV` VALUES(14, 'E-Z-GO Serial Number Overview', 'https://m.youtube.com/details?v=QUAx0D32jKE', 'http://i.ytimg.com/vi/QUAx0D32jKE/3.jpg', 'Misc');
INSERT INTO `EZGOTV` VALUES(15, 'E-Z-GO ST Serial Number Look-Up', 'https://m.youtube.com/details?v=UMg-kkQZJsI', 'http://i.ytimg.com/vi/UMg-kkQZJsI/3.jpg', 'Misc');
INSERT INTO `EZGOTV` VALUES(16, 'E-Z-GO TXT Serial Number Look-Up', 'https://m.youtube.com/details?v=2HRujpmgBdE', 'http://i.ytimg.com/vi/2HRujpmgBdE/3.jpg', 'Misc');
INSERT INTO `EZGOTV` VALUES(17, 'E-Z-GO Workhorse Serial Number Look-Up', 'https://m.youtube.com/details?v=vcXnnXAHZa0', 'http://i.ytimg.com/vi/vcXnnXAHZa0/3.jpg', 'Misc');
INSERT INTO `EZGOTV` VALUES(18, 'E-Z-GO Steering Wheel (Fibertech Silver Formula)', 'https://m.youtube.com/details?v=8NAzC-qFaMs', 'http://i.ytimg.com/vi/8NAzC-qFaMs/3.jpg', 'Installation');
INSERT INTO `EZGOTV` VALUES(19, 'E-Z-GO TXT PTV Kit', 'https://m.youtube.com/details?v=xXgAcWzr_LA', 'http://i.ytimg.com/vi/xXgAcWzr_LA/3.jpg', 'Installation');
INSERT INTO `EZGOTV` VALUES(20, 'E-Z-GO Under Seat Locking Storage Tray', 'https://m.youtube.com/details?v=SNXIElBbKIU', 'http://i.ytimg.com/vi/SNXIElBbKIU/3.jpg', 'Installation');
INSERT INTO `EZGOTV` VALUES(21, 'E-Z-GO Bushing for Leaf Spring', 'https://m.youtube.com/details?v=kXhDHVf6FdQ', 'http://i.ytimg.com/vi/kXhDHVf6FdQ/3.jpg', 'Installation');
INSERT INTO `EZGOTV` VALUES(22, 'E-Z-GO Hour Meter Kit for Gas Vehicles', 'https://m.youtube.com/details?v=at-iRE8gNeo', 'http://i.ytimg.com/vi/at-iRE8gNeo/3.jpg', 'Installation');
INSERT INTO `EZGOTV` VALUES(23, 'E-Z-GO Hour Meter for Electric Vehicles', 'https://m.youtube.com/details?v=Kvl-yLs6lbs', 'http://i.ytimg.com/vi/Kvl-yLs6lbs/3.jpg', 'Installation');
INSERT INTO `EZGOTV` VALUES(24, 'E-Z-GO SS Wheel Covers', 'https://m.youtube.com/details?v=DKCkm98jHV4', 'http://i.ytimg.com/vi/DKCkm98jHV4/3.jpg', 'Installation');
INSERT INTO `EZGOTV` VALUES(25, 'E-Z-GO Shock Boots', 'https://m.youtube.com/details?v=yGGd7x24gUk', 'http://i.ytimg.com/vi/yGGd7x24gUk/3.jpg', 'Installation');
INSERT INTO `EZGOTV` VALUES(26, 'E-Z-GO Rear Flip Seat Kit Installation', 'goo.gl/hhCzV', 'http://goo.gl/CKn4E', 'Installation');
INSERT INTO `EZGOTV` VALUES(27, 'E-Z-GO Portable Seat Cooling System', 'http://goo.gl/gZ1nt', 'http://goo.gl/1CA05', 'Installation');
INSERT INTO `EZGOTV` VALUES(28, 'E-Z-GO 5-Panel Mirror Installation', 'http://goo.gl/jSMXc', 'http://goo.gl/JJ8p8', 'Installation');
INSERT INTO `EZGOTV` VALUES(29, 'E-Z-GO 80" Top Kit Installation', 'http://goo.gl/333Yl', 'http://goo.gl/UeOSQ', 'Installation');
INSERT INTO `EZGOTV` VALUES(30, 'E-Z-GO 3-Sided Enclosure', 'http://goo.gl/6CN8f', 'http://goo.gl/8RWrj', 'Installation');
INSERT INTO `EZGOTV` VALUES(31, 'E-Z-GO TXT Windshield Installation', 'http://goo.gl/XtcUF', 'http://goo.gl/epter', 'Installation');
INSERT INTO `EZGOTV` VALUES(32, 'E-Z-GO Brake Shoe Replacement', 'http://goo.gl/biKdd', 'http://goo.gl/LTiQ4', 'Installation');
INSERT INTO `EZGOTV` VALUES(33, 'E-Z-GO Brake Drum Installation', 'http://goo.gl/qBEl9', 'http://goo.gl/ieIti', 'Installation');
INSERT INTO `EZGOTV` VALUES(34, 'E-Z-GO Black Out Kit', 'http://goo.gl/Yoc1A', 'http://goo.gl/TWrgr', 'Installation');
INSERT INTO `EZGOTV` VALUES(35, 'E-Z-GO Forward, Neutral, &amp; Reverse Handle', '', '', 'Installation');
INSERT INTO `EZGOTV` VALUES(36, 'E-Z-GO Ignition Switch', 'http://goo.gl/5mQug', 'http://goo.gl/7LJAJ', 'Installation');
INSERT INTO `EZGOTV` VALUES(37, 'E-Z-GO DC to DC Converter', 'http://goo.gl/ZMff6', 'http://goo.gl/q3E7m', 'Installation');
INSERT INTO `EZGOTV` VALUES(38, 'E-Z-GO TXT/Medalist Black Brushguard', 'http://goo.gl/1djt8', 'http://goo.gl/wWrct', 'Installation');
INSERT INTO `EZGOTV` VALUES(39, 'E-Z-GO Steel Bed', 'http://goo.gl/xwKE2', 'http://goo.gl/ATAfK', 'Installation');
INSERT INTO `EZGOTV` VALUES(40, 'E-Z-GO Front Shock Absorber', 'http://goo.gl/SDXPl', 'http://goo.gl/WGBd7', 'Installation');
INSERT INTO `EZGOTV` VALUES(41, 'E-Z-GO Tire Repair Kit', 'http://goo.gl/OlgwW', 'http://goo.gl/HPi0w', 'Installation');
INSERT INTO `EZGOTV` VALUES(42, 'E-Z-GO Lift Kit', 'http://goo.gl/IQNtD', 'http://goo.gl/Tk0Sw', 'Featured');
INSERT INTO `EZGOTV` VALUES(43, 'E-Z-GO Portable Seat Cooling System', 'http://goo.gl/gZ1nt', 'http://goo.gl/1CA05', 'Featured');
INSERT INTO `EZGOTV` VALUES(44, 'E-Z-GO iPad Mount', 'http://goo.gl/Wcm4t', 'http://goo.gl/LYKvs', 'Featured');
INSERT INTO `EZGOTV` VALUES(45, 'E-Z-GO 3 & 6 Can Storage & Tube Coolers', 'http://goo.gl/6Gwz2', 'http://goo.gl/vMiGw', 'Featured');
INSERT INTO `EZGOTV` VALUES(46, 'E-Z-GO Parking Mat', 'http://goo.gl/OAJyK', 'http://goo.gl/IcWtz', 'Featured');
INSERT INTO `EZGOTV` VALUES(47, 'E-Z-GO Wheel Lock', 'http://goo.gl/W6lYN', 'http://goo.gl/stZ8p', 'Featured');
INSERT INTO `EZGOTV` VALUES(48, 'E-Z-GO Universal Electronic Docking Station', 'http://goo.gl/pMKAL', 'http://goo.gl/dw7X9', 'Featured');
INSERT INTO `EZGOTV` VALUES(49, 'E-Z-GO Solar Top Panel', 'http://goo.gl/PTjga', 'http://goo.gl/yEvsk', 'Featured');
INSERT INTO `EZGOTV` VALUES(50, 'E-Z-GO Shock Boots', 'https://m.youtube.com/details?v=yGGd7x24gUk', 'http://i.ytimg.com/vi/yGGd7x24gUk/3.jpg', 'Featured');
INSERT INTO `EZGOTV` VALUES(51, 'E-Z-GO SS Wheel Covers', 'https://m.youtube.com/details?v=DKCkm98jHV4', 'http://i.ytimg.com/vi/DKCkm98jHV4/3.jpg', 'Featured');
INSERT INTO `EZGOTV` VALUES(52, 'E-Z-GO Lift Kit', 'http://goo.gl/IQNtD', 'http://goo.gl/Tk0Sw', 'Performance');
INSERT INTO `EZGOTV` VALUES(53, 'E-Z-GO Limited Slip Differential', 'http://goo.gl/kLHWN', 'http://goo.gl/3pVYv', 'Performance');
INSERT INTO `EZGOTV` VALUES(54, 'E-Z-GO Solar Top Panel', 'http://goo.gl/PTjga', 'http://goo.gl/yEvsk', 'Performance');
INSERT INTO `EZGOTV` VALUES(55, 'E-Z-GO 23" Terra Trac Tire with 12" Black Optimus Faced Wheel Package', 'http://goo.gl/MpJdG', 'http://goo.gl/NSHNw', 'Performance');
INSERT INTO `EZGOTV` VALUES(56, 'E-Z-GO 23" Terra Trac Tire with 12" Machined Optimus Wheel Package', 'http://goo.gl/Kzya4', 'http://goo.gl/0DkVf', 'Performance');
INSERT INTO `EZGOTV` VALUES(57, 'E-Z-GO 18.5" Duro Tire with 12" Black Optimus Faced Wheel', 'http://goo.gl/pFtM0', 'http://goo.gl/gQx3r', 'Performance');
INSERT INTO `EZGOTV` VALUES(58, 'E-Z-GO Battery Filling System', 'http://goo.gl/czufG', 'http://goo.gl/dF8UR', 'Maintenance');
INSERT INTO `EZGOTV` VALUES(59, 'E-Z-GO 4 Gauge Battery Wire Package', 'http://goo.gl/P26eh', 'http://goo.gl/Wmvkz', 'Maintenance');
INSERT INTO `EZGOTV` VALUES(60, 'E-Z-GO Battery Maintenance Kit', 'http://goo.gl/ldO6J', 'http://goo.gl/Hww3i', 'Maintenance');
INSERT INTO `EZGOTV` VALUES(61, 'E-Z-GO Tire Repair Kit', 'http://goo.gl/lSLht', 'http://goo.gl/U0wa3', 'Maintenance');
INSERT INTO `EZGOTV` VALUES(62, 'E-Z-GO Tune-Up Kit', 'http://goo.gl/sZjmx', 'http://goo.gl/b5GRo', 'Maintenance');
INSERT INTO `EZGOTV` VALUES(63, 'E-Z-GO Brake Shoe Replacement', 'http://goo.gl/76ld0', 'http://goo.gl/d3ojO', 'Maintenance');
INSERT INTO `EZGOTV` VALUES(64, 'E-Z-GO Brake Drum Installation', 'http://goo.gl/uoSC7', 'http://goo.gl/BXrdW', 'Maintenance');
INSERT INTO `EZGOTV` VALUES(65, 'E-Z-GO Hour Meter for Gas Vehicles', 'http://goo.gl/3dCzw', 'http://goo.gl/bnM3i', 'Maintenance');
INSERT INTO `EZGOTV` VALUES(66, 'E-Z-GO Hour Meter for Electric Vehicles', 'http://goo.gl/LWUlG', 'http://goo.gl/gzJco', 'Maintenance');
INSERT INTO `EZGOTV` VALUES(67, 'E-Z-GO Rear Shock Absorber', 'http://goo.gl/KVEfX', 'http://goo.gl/dbtQD', 'Maintenance');
INSERT INTO `EZGOTV` VALUES(68, 'E-Z-GO Front Shock Absorber', 'http://goo.gl/voEZZ', 'http://goo.gl/VTSNd', 'Maintenance');
INSERT INTO `EZGOTV` VALUES(69, 'E-Z-GO Heavy Duty Rear Leaf Springs', 'http://goo.gl/XklQu', 'http://goo.gl/v7uG1', 'Maintenance');
INSERT INTO `EZGOTV` VALUES(70, 'E-Z-GO Bushing for Leaf Spring', 'http://goo.gl/6QzrP', 'http://goo.gl/tivTF', 'Maintenance');
INSERT INTO `EZGOTV` VALUES(71, 'E-Z-GO 3-Sided Enclosure', 'http://goo.gl/Lu3Hr', 'http://goo.gl/1hTvq', 'Maintenance');

-- --------------------------------------------------------

--
-- Table structure for table `Fuel_LU`
--

CREATE TABLE `Fuel_LU` (
  `fuelId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`fuelId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Fuel_LU`
--

INSERT INTO `Fuel_LU` VALUES(1, 'Gas', NULL);
INSERT INTO `Fuel_LU` VALUES(2, 'Electric 48V', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Model_LU`
--

CREATE TABLE `Model_LU` (
  `modelId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`modelId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `Model_LU`
--

INSERT INTO `Model_LU` VALUES(1, 'Shuttle', NULL);
INSERT INTO `Model_LU` VALUES(2, 'Terrain', NULL);
INSERT INTO `Model_LU` VALUES(3, '2FIVE', NULL);
INSERT INTO `Model_LU` VALUES(4, 'TXT', NULL);
INSERT INTO `Model_LU` VALUES(5, 'Express', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Part`
--

CREATE TABLE `Part` (
  `partNumber` varchar(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `description` varchar(4000) DEFAULT NULL,
  `availabilityId` int(11) DEFAULT NULL,
  `partSubcategoryId` int(11) NOT NULL,
  `image` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`partNumber`),
  KEY `partSubcategoryId` (`partSubcategoryId`),
  KEY `availabilityId` (`availabilityId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Part`
--

INSERT INTO `Part` VALUES('70046G02', 'Battery Rack', 120.39, 'Battery Rack is used on 1994-current E-Z-GO Electric Medalist, TXT, Shuttle, Workhorse, and MPT (Multi-Purpose Truck) 80', 1, 4, 'http://www.shopezgo.com/images/BatteryRack.image.jpeg?size=100&width=130&mid=f7cade80b7cc92b991cf4d2806d6bd78');
INSERT INTO `Part` VALUES('72719G03P', 'Engine Skid Plate', 31.79, '', 1, 4, 'http://www.shopezgo.com/images/EngineSkidPlate.image.jpeg?size=100&width=130&mid=e515df0d202ae52fcebb14295743063b');
INSERT INTO `Part` VALUES('70628G02', '4-Hole Column Frame', 1071.32, 'Used on all 2001-current E-Z-GO Gas & Electric Vehicles EXCEPT: RXV, 2Five, ST 4x4, ST 400, Woods Boundary MAV 400, ST 4', 1, 3, 'http://www.shopezgo.com/images/4HoleColumnFrame.image.jpeg?size=100&width=130&mid=b6e584419a62da6229cf347e5ccfa166');
INSERT INTO `Part` VALUES('72010G01', 'Front Engine Frame-Gas', 60.12, 'Used on 1994-2008 E-Z-GO Gas Vehicles', 1, 3, 'http://www.shopezgo.com/images/FrontEngineFrameGas.image.jpeg?size=100&width=130&mid=aa68c75c4a77c87f97fb686b2f068676');
INSERT INTO `Part` VALUES('70714G02', 'Brake Cable Assembly', 81.63, 'Used on 1988-1992 E-Z-GO Gas & Electric Marathon Models', 1, 2, 'http://www.shopezgo.com/images/BrakeCableAssembly.image.jpeg?size=100&width=130&mid=c22abfa379f38b5b0411bc11fa9bf92f');
INSERT INTO `Part` VALUES('70968G14', 'Brake Cable', 36.73, '', 1, 2, 'http://www.shopezgo.com/images/BrakeCable.image.jpeg?size=100&width=130&mid=f5e62af885293cf4d511ceef31e61c80');
INSERT INTO `Part` VALUES('28082G01P', 'Equalizer Bracket', 2.04, 'http://www.shopezgo.com/images/EqualizerBracket.image.jpeg?size=100&width=130&mid=f08b7ac8aa30a2a9ab34394e200e1a71', 1, 1, 'http://www.shopezgo.com/images/EqualizerBracket.image.jpeg?size=100&width=130&mid=f08b7ac8aa30a2a9ab34394e200e1a71');
INSERT INTO `Part` VALUES('608201', 'Brake Cable Bracket, Driver Side', 10.2, 'Used on 1994-current E-Z-GO Gas & Electric TXT, Medalist, ST 400, Woods Boundary MAV 400, ST Sport, ST Sport 2+2, Clays', 1, 1, 'http://www.shopezgo.com/images/BrakeCableBracketDriverSide.image.jpeg?size=100&width=130&mid=6e7d5d259be7bf56ed79029c4e621f44');
INSERT INTO `Part` VALUES('70536G01M', 'Front Square Axle', 110.19, 'Used on 1994-2001 E-Z-GO TXT, Medalist & Workhorse Vehicles', 1, 3, 'http://www.shopezgo.com/images/FrontSquareAxle.image.jpeg?size=100&width=130&mid=7f24d240521d99071c93af3917215ef7');
INSERT INTO `Part` VALUES('72701G02P', 'Accelerator Cable Bracket', 5.1, 'For use with E-Z-GO Gas MPT 800 Utility Vehicle,2004-2005', 1, 5, 'http://www.shopezgo.com/images/AcceleratorCableBracket.image.jpeg?size=100&width=130&mid=2e1b24a664f5e9c18f407b2f9c73e821');
INSERT INTO `Part` VALUES('72055G01P', 'Accelerator Cable Bracket', 3.58, '', 1, 5, 'http://www.shopezgo.com/images/AcceleratorCableBracket.image.jpeg?size=100&width=130&mid=067a26d87265ea39030f5bd82408ce7c');
INSERT INTO `Part` VALUES('25653G01P', 'Accelerator Cable Bracket for 4-Cycle Differential', 12.24, 'The Accelerator Cable Bracket is an OEM (Original Equipment Manufacturer) replacement bracket needed for the assembly of related components in the accelerator and governor linkage. This bracket is used on vehicles with 4-cycle rear axles.', 1, 5, 'http://www.shopezgo.com/images/AcceleratorCableBracketfor4CycleDifferentials.image.jpeg?size=100&width=130&mid=159c1ffe5b61b41b3c4d8f4c2150f6c4');
INSERT INTO `Part` VALUES('70116G02', 'Accelerator Pedal Bracket', 32.65, 'Accelerator Pedal Bracket for use with E-Z-GO Utility Vehicles', 1, 5, 'http://www.shopezgo.com/images/AcceleratorPedalBracket.image.jpeg?size=100&width=130&mid=5c80985bd40b8ce792f8c786bb23fe54');
INSERT INTO `Part` VALUES('72703G02P', 'Throttle Cable Mount Bracket', 5.1, '', 1, 5, 'http://www.shopezgo.com/images/ThrottleCableMountBracket.image.jpeg?size=100&width=130&mid=c9f06bc7b46d0247a91c8fc665c13d0e');
INSERT INTO `Part` VALUES('72714G01', 'Throttle Cable - 52.06"', 30.61, 'Used on 2002-2009 E-Z-GO Gas TXT, Workhorse-MPT (Multi-Purpose Truck) 800/1200, and select ST Models', 1, 6, 'http://www.shopezgo.com/images/ThrottleCable5206.image.jpeg?size=100&width=130&mid=84d2004bf28a2095230e8e14993d398d');
INSERT INTO `Part` VALUES('25694G01', 'Accelerator Cable (4-Cycle) 33-11/16"', 15.3, 'Used on 1991-1996 E-Z-GO Gas Marathon and 804 Vehicles with a 4-Cycle, Fuji-Robin Engine', 1, 6, 'http://www.shopezgo.com/images/AcceleratorCable(4Cycle)331116.image.jpeg?size=100&width=130&mid=07c5807d0d927dcd0980f86024e5208b');
INSERT INTO `Part` VALUES('72706G01', 'Accelerator Cable Bushing', 2.56, '', 1, 7, 'http://www.shopezgo.com/images/AcceleratorCableBushing.image.jpeg?size=100&width=130&mid=b19aa25ff58940d974234b48391b9549');
INSERT INTO `Part` VALUES('27081G01', 'Accelerator Shaft Arm Assembly', 28.57, 'Used on 1990-1997 E-Z-GO Gas 875 and GX1500 Industrial Vehicles', 1, 7, 'http://www.shopezgo.com/images/AcceleratorShaftArmAssembly.image.jpeg?size=100&width=130&mid=99607461cdb9c26e2bd5f31b12dcf27a');
INSERT INTO `Part` VALUES('27844G01', 'Accelerator Pad Kit', 8.16, 'Used on 1992-mid year 2008 E-Z-GO Gas & Electric Vehicles', 1, 8, 'http://www.shopezgo.com/images/AcceleratorPadKit.image.jpeg?size=100&width=130&mid=7e889fb76e0e07c11733550f2a6c7a5a');
INSERT INTO `Part` VALUES('33509G01', 'Accelerator Pedal', 89.79, '', 1, 8, 'http://www.shopezgo.com/images/AcceleratorPedal.image.jpeg?size=100&width=130&mid=533fa796b43291fc61a9e812a50c3fb6');
INSERT INTO `Part` VALUES('25737G01', '4-Cycle Carburetor Link Rod Assembly', 15.3, 'Used on 1991-2008 E-Z-GO Gas Vehicles with a 4-Cycle Engine', 1, 9, 'http://www.shopezgo.com/images/4CycleCarburetorLinkRodAssembly.image.jpeg?size=100&width=130&mid=60243f9b1ac2dba11ff8131c8f4431e0');
INSERT INTO `Part` VALUES('73332G01', 'Accelerator Rod', 14.59, 'Used on 2000-Current E-Z-GO Electric TXT, 875, 881, Shuttle 950, 4/6 Passenger Shuttle, Shuttle 4X, Express L4-S4, Expre', 1, 9, 'http://www.shopezgo.com/images/AcceleratorRod.image.jpeg?size=100&width=130&mid=d6cf4da5ced8580c991e16fb54faa1b6');
INSERT INTO `Part` VALUES('26446G01', 'Accelerator Pedal Return Spring', 14.28, '', 1, 10, 'http://www.shopezgo.com/images/AcceleratorPedalReturnSpring.image.jpeg?size=100&width=130&mid=54391c872fe1c8b4f98095c5d6ec7ec7');
INSERT INTO `Part` VALUES('23578G1', 'Compression Spring', 2.04, 'Used on 1989-2009 E-Z-GO Gas Vehicles', 1, 10, 'http://www.shopezgo.com/images/CompressionSpring.image.jpeg?size=100&width=130&mid=64c53a52cb3bd1a01c03a64db985c0cc');
INSERT INTO `Part` VALUES('72598G01', 'Air Cleaner Top Assembly With Bracket', 73.46, '', 1, 11, 'http://www.shopezgo.com/images/AirCleanerTopAssemblyWithBracket.image.jpeg?size=100&width=130&mid=ce5140df15d046a66883807d18d0264b');
INSERT INTO `Part` VALUES('26634G01', 'Air Cleaner Assembly (4-Cycle)', 114.27, 'Used on 1991-1994 E-Z-GO Gas & Electric Marathon Models', 1, 11, 'http://www.shopezgo.com/images/AirCleanerAssembly(4Cycle).image.jpeg?size=100&width=130&mid=6cd67d9b6f0150c77bda2eda01ae484c');
INSERT INTO `Part` VALUES('72604G01', 'Air Cleaner Clip', 9.18, 'Used on 1996-2009 E-Z-GO Gas Industrial and Utility Vehicles', 1, 12, 'http://www.shopezgo.com/images/AirCleanerClip.image.jpeg?size=100&width=130&mid=82b8a3434904411a9fdc43ca87cee70c');
INSERT INTO `Part` VALUES('72599G01', 'Air Cleaner Cover', 53.06, 'Used on 1996-2009 E-Z-GO Gas Industrial and Utility Vehicles', 1, 12, 'http://www.shopezgo.com/images/AirCleanerCover.image.jpeg?size=100&width=130&mid=021bbc7ee20b71134d53e20206bd6feb');
INSERT INTO `Part` VALUES('72368G01', 'Air Filter Element (4-Cycle Engines)', 0, '', 1, 13, 'http://www.shopezgo.com/images/AirFilterElement(4CycleEngines).image.jpeg?size=100&width=130&mid=03e0704b5690a2dee1861dc3ad3316c9');
INSERT INTO `Part` VALUES('26635G01', 'Air Filter Element (4-Cycle, Through 12/94)', 0, '', 1, 13, 'http://www.shopezgo.com/images/AirFilterElement(4CycleThrough1294).image.jpeg?size=100&width=130&mid=26588e932c7ccfa1df309280702fe1b5');
INSERT INTO `Part` VALUES('601910', 'Air Filter Tube', 26.93, '', 1, 14, 'http://www.shopezgo.com/images/AirFilterTube.image.jpeg?size=100&width=130&mid=a787f02ed34fd886eb6d49e60d9c9120');
INSERT INTO `Part` VALUES('72637G02', 'Air Intake Hose, 26"', 98.77, '', 1, 14, 'http://www.shopezgo.com/images/AirIntakeHose26.image.jpeg?size=100&width=130&mid=27d8d40b22f812a1ba6c26f8ef7df480');
INSERT INTO `Part` VALUES('74733G02', 'Caliper Assembly (Driver''s Side)', 165.29, 'Used on 2004-current E-Z-GO Gas & Electric 4/6-Passenger Shuttle, ST Express, MPT 800/1000/1200, Cushman Bellhop and Cus', 1, 16, 'http://www.shopezgo.com/images/CaliperAssembly(DriversSide).image.jpeg?size=100&width=130&mid=8ab8dff7441eda91aa7bb26becb3afd3');
INSERT INTO `Part` VALUES('73790G01', 'Front Brake Caliper ST 4X4', 91.83, 'Used on E-Z-GO Gas ST 4x4 Models', 1, 16, 'http://www.shopezgo.com/images/FrontBrakeCaliperST4X4.image.jpeg?size=100&width=130&mid=7137debd45ae4d0ab9aa953017286b20');
INSERT INTO `Part` VALUES('19186G1P', 'Brake Drum/Hub Assembly (Electric)', 53.06, 'Used on 1982-current E-Z-GO Electric Non-Turf and 1982-1996 2-Cycle Gas Vehicles', 1, 17, 'http://www.shopezgo.com/images/BrakeDrumHubAssembly(Electric).image.jpeg?size=100&width=130&mid=46771d1f432b42343f56f791422a4991');
INSERT INTO `Part` VALUES('17953G2', 'Brake Drum (1/2"Lug Stud-Industrial)', 229.99, 'Used on 1994-current E-Z-GO Gas Vehicles', 1, 17, 'http://www.shopezgo.com/images/BrakeDrum(12quot3bLugStudIndustrial).image.jpeg?size=100&width=130&mid=8c7bbbba95c1025975e548cee86dfadc');
INSERT INTO `Part` VALUES('610065', '6" Motor Brake Assembly', 224.47, 'Used on 2/22/2009-current E-Z-GO Electric RXV Vehicles', 1, 18, 'http://www.shopezgo.com/images/6MotorBrakeAssembly.image.jpeg?size=100&width=130&mid=3bcf6eecb2611212e088d0d91f2ade9c');
INSERT INTO `Part` VALUES('23363G1', 'Adjuster Body - Block Complete', 38.77, 'Adjuster body for use with E-Z-GO Marathon Golf Cars and 875 Industrial Vehicles', 1, 18, 'http://www.shopezgo.com/images/AdjusterBodyBlockComplete.image.jpeg?size=100&width=130&mid=0cd6a652ed1f7811192db1f700c8f0e7');
INSERT INTO `Part` VALUES('614297', 'Brake Pads Kit', 79.59, 'Used on 2010-current E-Z-GO Electric 2Five Vehicles', 1, 19, 'http://www.shopezgo.com/images/BrakePadsKit.image.jpeg?size=100&width=130&mid=fd0a5a5e367a0955d81278062ef37429');
INSERT INTO `Part` VALUES('34574G01', 'Hydraulic Disc Brake Pad Kit (4/pkg)', 134.68, 'Fits GXI/GXT/XI/XT-875 and 950 Series Vehicles', 1, 19, 'http://www.shopezgo.com/images/HydraulicDiscBrakePadKit(4pkg).image.jpeg?size=100&width=130&mid=4172f3101212a2009c74b547b6ddf935');
INSERT INTO `Part` VALUES('70690G02', 'Brake Pedal Assembly (for Vehicles with Lights)', 175.49, 'Brake Pedal Assembly (for Vehicles with Lights) is used on most 1994-current vehicles with Brake Lights', 1, 20, 'http://www.shopezgo.com/images/BrakePedalAssembly(forVehicleswithLights).image.jpeg?size=100&width=130&mid=6cfe0e6127fa25df2a0ef2ae1067d915');
INSERT INTO `Part` VALUES('70258G03P', 'Brake Pedal Plate', 8.81, 'Used on 1994-current E-Z-GO Golf, Turf and Industrial Vehicles', 1, 20, 'http://www.shopezgo.com/images/BrakePedalPlate.image.jpeg?size=100&width=130&mid=c4b31ce7d95c75ca70d50c19aef08bf1');
INSERT INTO `Part` VALUES('73625G01', '8" Front Rotor for ST 4X4', 71.42, 'Used on E-Z-GO Gas ST 4x4 Models', 1, 87, 'http://www.shopezgo.com/images/8FrontRotorforST4X4.image.jpeg?size=100&width=130&mid=515ab26c135e92ed8bf3a594d67e4ade');
INSERT INTO `Part` VALUES('23364G1', 'Brake Shoe Set (2 Per Set)', 69.99, 'Brake Shoe Set is used on 1989-1996 E-Z-GO Vehicles with mechanical brakes', 1, 21, 'http://www.shopezgo.com/images/BrakeShoeSet(2PerSet).image.jpeg?size=100&width=130&mid=10a5ab2db37feedfdeaab192ead4ac0e');
INSERT INTO `Part` VALUES('32822G1', 'Brake Shoe', 79.59, 'Used on 1991-1997 E-Z-GO Gas & Electric 775, 875, Shuttle 950, and Oasis Vehicles with Hydraulic Brakes', 1, 21, 'http://www.shopezgo.com/images/BrakeShoe.image.jpeg?size=100&width=130&mid=feade1d2047977cd0cefdafc40175a99');
INSERT INTO `Part` VALUES('36050G02', 'Disc Brake Assembly (Passenger''s Side)', 459.14, 'Used on 1998-2004 E-Z-GO Gas & Electric 875, 881 & Shuttle 950 Vehicles', 1, 22, 'http://www.shopezgo.com/images/DiscBrakeAssembly(PassengersSide).image.jpeg?size=100&width=130&mid=1e51e0f3b6b60070219ccb91bb619a6b');
INSERT INTO `Part` VALUES('70643G01', 'Master Cylinder Service Kit- 1" Diameter Bore', 357.11, 'Used on 1994-1997 E-Z-GO Gas & Electric Vehicles', 1, 23, 'http://www.shopezgo.com/images/MasterCylinderServiceKit1DiameterBore.image.jpeg?size=100&width=130&mid=437d7d1d97917cd627a34a6a0fb41136');
INSERT INTO `Part` VALUES('70643G02', 'Master Cylinder Service Kit- 7/8" Diameter Bore', 357.11, 'Used on 1998-current E-Z-GO Gas & Electric Vehicles', 1, 23, 'http://www.shopezgo.com/images/MasterCylinderServiceKit78DiameterBore.image.jpeg?size=100&width=130&mid=142949df56ea8ae0be8b5306971900a4');
INSERT INTO `Part` VALUES('612189', 'Mechanical Brake Assembly - 4084- Echlin- RH', 132.64, 'Used on 1996-current E-Z-GO Vehicles with mechanical brakes', 1, 24, 'http://www.shopezgo.com/images/MechanicalBrakeAssembly4084EchlinRH.image.jpeg?size=100&width=130&mid=359f38463d487e9e29bd20e24f0c050a');
INSERT INTO `Part` VALUES('612211', 'Mechanical Brake Assembly- 4084- Echlin- LH', 132.64, 'Used on 1996-current E-Z-GO Vehicles with mechanical brakes', 1, 24, 'http://www.shopezgo.com/images/MechanicalBrakeAssembly4084EchlinLH.image.jpeg?size=100&width=130&mid=2bd7f907b7f5b6bbd91822c0c7b835f6');
INSERT INTO `Part` VALUES('74177G01', 'Park Brake Lever (Foot Operated)', 255.08, 'Used on 1996-2000 E-Z-GO Gas & Electric 6-Passenger Shuttle/MG5 Vehicles', 1, 25, 'http://www.shopezgo.com/images/ParkBrakeLever(FootOperated).image.jpeg?size=100&width=130&mid=d811406316b669ad3d370d78b51b1d2e');
INSERT INTO `Part` VALUES('70256G01', 'Park Brake Pedal Pad for E-Z-GO Medalist/TXT', 5.96, 'Fits 1994-Current E-Z-GO TXT and Medalist Electric and Gas Vehicles', 1, 25, 'http://www.shopezgo.com/images/ParkBrakePedalPadforEZGOMedalistTXT.image.jpeg?size=100&width=130&mid=0ebf197205c00fc6e0aac7261a8c1bdc');
INSERT INTO `Part` VALUES('71205G01', 'FNR Handle', 4.08, 'Used on 1996-current E-Z-GO Gas & Electric Vehicles with a mechanical direction selector', 1, 26, 'http://www.shopezgo.com/images/FNRHandle.image.jpeg?size=100&width=130&mid=692f93be8c7a41525c0baf2076aecfb4');
INSERT INTO `Part` VALUES('27537G01', 'FNR Shaft-4Cycle (From 05/93)', 13.26, '', 1, 26, 'http://www.shopezgo.com/images/FNRShaft4Cycle(From0593).image.jpeg?size=100&width=130&mid=470e7a4f017a5476afb7eeb3f8b96f9b');
INSERT INTO `Part` VALUES('601016', 'Console Insert Plate for Forward & Reverse Switch', 6.12, 'Used on 1994-current E-Z-GO PDS (Precision Drive System) Vehicles with Key Switch and Forward & Reverse Switch', 1, 27, 'http://www.shopezgo.com/images/ConsoleInsertPlateforForwardReverseSwitch.image.jpeg?size=100&width=130&mid=781397bc0630d47ab531ea850bddcf63');
INSERT INTO `Part` VALUES('74316G01', 'FNR Console Plate', 2.75, '', 1, 27, 'http://www.shopezgo.com/images/FNRConsolePlate.image.jpeg?size=100&width=130&mid=7ce30eeb956b8bbdecfdb304b556edba');
INSERT INTO `Part` VALUES('26739G01', 'Ball Bearing (6207)', 22.44, '', 1, 28, 'http://www.shopezgo.com/images/BallBearing(6207).image.jpeg?size=100&width=130&mid=270edd69788dce200a3b395a6da6fdb7');
INSERT INTO `Part` VALUES('23520G1', 'Ball Bearing Input Gear', 12.24, 'Used on 1989-current E-Z-GO Gas & Electric Vehicles', 1, 28, 'http://www.shopezgo.com/images/BallBearingInputGear.image.jpeg?size=100&width=130&mid=49ae49a23f67c759bf4fc791ba842aa2');
INSERT INTO `Part` VALUES('74498G02', 'Choke Throttle Bracket', 9.18, 'Choke Throttle Bracket for use with E-Z-GO Utility Vehicles', 1, 29, 'http://www.shopezgo.com/images/ChokeThrottleBracket.image.jpeg?size=100&width=130&mid=d3aeec875c479e55d1cdeea161842ec6');
INSERT INTO `Part` VALUES('609312M', 'Isomount Positioning Bracket', 24.95, '', 1, 29, 'http://www.shopezgo.com/images/IsomountPositioningBracket.image.jpeg?size=100&width=130&mid=b1790a55a67906c18bd9a046e17c5935');
INSERT INTO `Part` VALUES('26615G01', 'Camshaft', 316.29, 'Used on E-Z-GO Vehicles manufactured from 1992-November 2003', 1, 30, 'http://www.shopezgo.com/images/Camshaft.image.jpeg?size=100&width=130&mid=cd3bbc2d7ca1bbdc055acf58609e6c24');
INSERT INTO `Part` VALUES('72329G01', 'Fixed Machined Cam (28 Degree)', 65.3, 'Used on E-Z-GO Gas Vehicles', 1, 30, 'http://www.shopezgo.com/images/FixedMachinedCam(28Degree).image.jpeg?size=100&width=130&mid=785736838d7b51f2cabb00e6b28a8969');
INSERT INTO `Part` VALUES('14031G1', '2 Cycle Carburetor Gasket', 4.08, 'Used on 1989-1993 E-Z-GO Gas Marathon Models', 1, 31, 'http://www.shopezgo.com/images/2CycleCarburetorGasket.image.jpeg?size=100&width=130&mid=7c220a2091c26a7f5e9f1cfb099511e3');
INSERT INTO `Part` VALUES('72605G01', 'Baffle', 3.06, 'Carburetor Baffle - used in E-Z-GO Gas Vehicles', 1, 31, 'http://www.shopezgo.com/images/Baffle.image.jpeg?size=100&width=130&mid=d3d80b656929a5bc0fa34381bf42fbdd');
INSERT INTO `Part` VALUES('72558G01', 'Carburetor Assembly - 4 Cycle - #90 Jet - Pre-MCI', 265.28, 'Carburetor Assembly - 4 Cycle - #90 Jet - Pre-MCI is used on 1994-2003 E-Z-GO Turf, Industrial, and Commercial 4-Cycle E', 1, 32, 'http://www.shopezgo.com/images/CarburetorAssembly4Cycle90JetPreMCI.image.jpeg?size=100&width=130&mid=a01610228fe998f515a72dd730294d87');
INSERT INTO `Part` VALUES('72840G01', 'Carburetor Assembly - 13MM - Venturi - 9HP', 161.21, 'Used on 2004-2008 E-Z-GO Vehicles', 1, 32, 'http://www.shopezgo.com/images/CarburetorAssembly13MMVenturi9HP.image.jpeg?size=100&width=130&mid=beed13602b9b0e6ecb5b568ff5058f07');
INSERT INTO `Part` VALUES('25693G01', 'Choke Control Assembly for 4-Cycle Vehicles', 17.34, 'Used on 1992-1996 E-Z-GO Gas, 4-Cycle Vehicles', 1, 33, 'http://www.shopezgo.com/images/ChokeControlAssemblyfor4CycleVehicles.image.jpeg?size=100&width=130&mid=1ecfb463472ec9115b10c292ef8bc986');
INSERT INTO `Part` VALUES('72401G02', 'Choke Control Assembly - Workhorse', 51.02, 'Used on 1996-2008 E-Z-GO Gas Vehicles', 1, 33, 'http://www.shopezgo.com/images/ChokeControlAssemblyWorkhorse.image.jpeg?size=100&width=130&mid=65cc2c8205a05d7379fa3a6386f710e1');
INSERT INTO `Part` VALUES('26952G01', 'Drive Clutch - 4-Cycle', 377.52, 'Drive Clutch 4-Cycle is for use with E-Z-GO 4-Cycle Golf Cars and Utility Vehicles', 1, 34, 'http://www.shopezgo.com/images/DriveClutch4Cycle.image.jpeg?size=100&width=130&mid=e94550c93cd70fe748e6982b3439ad3b');
INSERT INTO `Part` VALUES('26301G03', 'Driven Clutch 4-Cycle, 28 Degree', 295.89, 'Used on 1998-2008 E-Z-GO Gas Golf Car and Utility Vehicles', 1, 34, 'http://www.shopezgo.com/images/DrivenClutch4Cycle28Degree.image.jpeg?size=100&width=130&mid=d4c2e4a3297fe25a71d030b67eb83bfc');
INSERT INTO `Part` VALUES('72513G01', 'Bearing Cover (Main)', 255.08, '', 1, 35, 'http://www.shopezgo.com/images/BearingCover(Main).image.jpeg?size=100&width=130&mid=2321994d85d661d792223f647000c65f');
INSERT INTO `Part` VALUES('72877G01', 'Breather Cover', 30.61, 'Used on 2002-mid year 2008 E-Z-GO Gas Vehicles with a 350cc Fuji-Robin Engine', 1, 35, 'http://www.shopezgo.com/images/BreatherCover.image.jpeg?size=100&width=130&mid=da974f5eba1948690c83e9c3b43ffd87');
INSERT INTO `Part` VALUES('608902', '295CC Engine Rebuild Gasket Kit', 77.55, '295CC Engine Rebuild Gasket Kit is used on E-Z-GO 4-Cycle Pre-MCI 295cc Engines manufactured before November 2003', 1, 36, 'http://www.shopezgo.com/images/295CCEngineRebuildGasketKit.image.jpeg?size=100&width=130&mid=f3173935ed8ac4bf073c1bcd63171f8a');
INSERT INTO `Part` VALUES('608901', '350CC Engine Rebuild Gasket Kit', 77.55, '350CC Engine Rebuild Gasket Kit is used on E-Z-GO 4-Cycle Pre-MCI 350cc Engines manufactured before November 2003', 1, 36, 'http://www.shopezgo.com/images/350CCEngineRebuildGasketKit.image.jpeg?size=100&width=130&mid=a368b0de8b91cfb3f91892fbf1ebd4b2');
INSERT INTO `Part` VALUES('26593G01', 'Bent Dipstick/Oil Gauge for 295cc, 4-Cycle Engines', 18.36, 'Used on E-Z-GO Gas Vehicles with a 295cc, 4-Cycle Fuji-Robin Engine', 1, 37, 'http://www.shopezgo.com/images/BentDipstickOilGaugefor295cc4CycleEngines.image.jpeg?size=100&width=130&mid=9718db12cae6be37f7349779007ee589');
INSERT INTO `Part` VALUES('606390', 'Dipstick - Oil Level Gauge', 73.46, 'Used on 2008-current E-Z-GO Gas Vehicles', 1, 37, 'http://www.shopezgo.com/images/DipstickOilLevelGauge.image.jpeg?size=100&width=130&mid=0ae1dd3954ee840075de1395771b6c9c');
INSERT INTO `Part` VALUES('72054G01', 'CVT Drive Belt', 36.06, 'This drive belt is used on E-Z-GO vehicles with Continously Variable Transmissions', 1, 38, 'http://www.shopezgo.com/images/CVTDriveBelt.image.jpeg?size=100&width=130&mid=d7322ed717dedf1eb4e6e52a37ea7bcd');
INSERT INTO `Part` VALUES('72328G01', 'Severe Duty CVT Drive Belt', 71.42, 'This heavy duty drive belt is recommended for use on all E-Z-GO 4-Cycle Vehicles', 1, 38, 'http://www.shopezgo.com/images/SevereDutyCVTDriveBelt.image.jpeg?size=100&width=130&mid=5d616dd38211ebb5d6ec52986674b6e4');
INSERT INTO `Part` VALUES('26633G01', 'Exhaust Manifold', 142.84, 'Used on 1992-2003 E-Z-GO Gas Vehicles with a 295cc or 350cc Fuji-Robin Engine', 1, 39, 'http://www.shopezgo.com/images/ExhaustManifold.image.jpeg?size=100&width=130&mid=e37b08dd3015330dcbb5d6663667b8b8');
INSERT INTO `Part` VALUES('75745G01', 'Exhaust Pipe for ST 480', 104.07, 'Used on 2001-2009 E-Z-GO Gas ST 480 and Woods Boundary MAV 480 Vehicles', 1, 39, 'http://www.shopezgo.com/images/ExhaustPipeforST480.image.jpeg?size=100&width=130&mid=73d915c91b99b170993ea97d875a6330');
INSERT INTO `Part` VALUES('26641G01', 'Complete Engine Blower Housing', 34.69, 'Used on 1992-2003 E-Z-GO Gas Vehicles with a 295cc or 350cc Engine', 1, 40, 'http://www.shopezgo.com/images/CompleteEngineBlowerHousing.image.jpeg?size=100&width=130&mid=752d25a1f8dbfb2d656bac3094bfb81c');
INSERT INTO `Part` VALUES('26703G01', 'Cooling Blower Fan', 30.61, '', 1, 40, 'http://www.shopezgo.com/images/CoolingBlowerFan.image.jpeg?size=100&width=130&mid=2ef3e50fd7c1091dda165f25be7f64fd');
INSERT INTO `Part` VALUES('14151G1', 'Fuel Pump', 53.06, 'Used on 1982-1988 E-Z-GO Gas 2-Cycle, Marathon Vehicles', 1, 41, 'http://www.shopezgo.com/images/FuelPump.image.jpeg?size=100&width=130&mid=3c7781a36bcd6cf08c11a970fbe0e2a6');
INSERT INTO `Part` VALUES('24233G1', 'Fuel Pump (3PG-Non Remote)', 46.93, 'Used on 1989-1991 E-Z-GO Gas Marathon & PC4 Vehicles', 1, 41, 'http://www.shopezgo.com/images/FuelPump(3PGNonRemote).image.jpeg?size=100&width=130&mid=250cf8b51c773f3f8dc8b4be867a9a02');
INSERT INTO `Part` VALUES('610654', 'Engine Retro-Fit Kit', 459.14, 'Used on E-Z-GO Gas Vehicles manufactured prior to November 2003 (MCI) with a Fuji-Robin Engine', 1, 42, 'http://www.shopezgo.com/images/EngineRetroFitKit.image.jpeg?size=100&width=130&mid=b65f2ecd2900ba6ae49a14d9c4b16fb4');
INSERT INTO `Part` VALUES('606982', 'Exhaust Pipe Header', 53.06, 'Used on 2008-current E-Z-GO Gas RXV and 2009-current TXT, MPT, Shuttle, and ST Sport Vehicles (Not for use on Fuji-Robin', 1, 42, 'http://www.shopezgo.com/images/ExhaustPipeHeader.image.jpeg?size=100&width=130&mid=eeaebbffb5d29ff62799637fc51adb7b');
INSERT INTO `Part` VALUES('603593', 'Choke Gasket', 2.04, 'Used on 2008-current E-Z-GO Gas Vehicles with a Kawasaki Engine', 1, 43, 'http://www.shopezgo.com/images/ChokeGasket.image.jpeg?size=100&width=130&mid=0530e22dea41e24a039563139cdc215e');
INSERT INTO `Part` VALUES('603580', 'RXV Carburetor Gasket for Kawasaki Engines', 2.32, 'Used on 2008-current E-Z-GO Gas RXV Vehicles', 1, 43, 'http://www.shopezgo.com/images/RXVCarburetorGasketforKawasakiEngines.image.jpeg?size=100&width=130&mid=3e3aa687770f55c704ca997c3be81634');
INSERT INTO `Part` VALUES('26780G01', '4-Cycle Differential Governor Base', 108.15, 'Used on E-Z-GO Gas ST 480 Vehicles & Woods Boundary MAV 480 Vehicles', 1, 44, 'http://www.shopezgo.com/images/4CycleDifferentialGovernorBase.image.jpeg?size=100&width=130&mid=4aeae10ea1c6433c926cdfa558d31134');
INSERT INTO `Part` VALUES('25738G01', '4-Cycle Governor Arm Spring/Accelerator Bracket', 15.3, 'Used on 1991-2009 E-Z-GO Gas Marathon, TXT, Medalist, select Workhorse, ST and Industrial Vehicles', 1, 44, 'http://www.shopezgo.com/images/4CycleGovernorArmSpringAcceleratorBracket.image.jpeg?size=100&width=130&mid=4a5876b450b45371f6cfe5047ac8cd45');
INSERT INTO `Part` VALUES('26720G01', '4-Cycle O-Ring Filler Cap', 5.1, 'Used on 1992-2008 E-Z-GO Gas Vehicles with a 4-Cycle Fuji-Robin Engine', 1, 45, 'http://www.shopezgo.com/images/4CycleORingFillerCap.image.jpeg?size=100&width=130&mid=6244b2ba957c48bc64582cf2bcec3d04');
INSERT INTO `Part` VALUES('26721G01', 'Breather Grommet', 22.12, '', 1, 45, 'http://www.shopezgo.com/images/BreatherGrommet.image.jpeg?size=100&width=130&mid=73f715c6cc2b110fc67503ba813f7f0e');
INSERT INTO `Part` VALUES('603586', 'Float Valve', 38.77, 'Used on 2008-current E-Z-GO Gas Vehicles with a Kawasaki Engine', 1, 46, 'http://www.shopezgo.com/images/FloatValve.image.jpeg?size=100&width=130&mid=e0c7ccc47b2613c82d1073a4214deecc');
INSERT INTO `Part` VALUES('25262G01', 'Intake Chamber (4-Cycle Engine)', 97.95, '', 1, 46, 'http://www.shopezgo.com/images/IntakeChamber(4CycleEngine).image.jpeg?size=100&width=130&mid=ae87a54e183c075c494c4d397d126a66');
INSERT INTO `Part` VALUES('26591G01', 'Oil Filter - 9HP & 11HP Engines', 25.51, 'This oil filter is used on E-Z-GO Vehicles to prolong and maintain engine performance', 1, 47, 'http://www.shopezgo.com/images/OilFilter9HP11HPEngines.image.jpeg?size=100&width=130&mid=59c33016884a62116be975a9bb8257e3');
INSERT INTO `Part` VALUES('72538G01', 'Oil Dipstick (9 & 11HP)', 17.34, '', 1, 47, 'http://www.shopezgo.com/images/OilDipstick(911HP).image.jpeg?size=100&width=130&mid=0768281a05da9f27df178b5c39a51263');
INSERT INTO `Part` VALUES('26711G01', '4-Cycle Oil Pump O-Ring', 7.14, 'Used on 1992 thru mid-year 2008 E-Z-GO 4-Cycle Vehicles with the 295cc and 350cc Fuji-Robin Engine', 1, 48, 'http://www.shopezgo.com/images/4CycleOilPumpORing.image.jpeg?size=100&width=130&mid=fd4f21f2556dad0ea8b7a5c04eabebda');
INSERT INTO `Part` VALUES('26743G01', 'Balancer Shaft Oil Seal (20 x 32 x 6")', 9.18, 'Used on 1991-current E-Z-GO 4-Cycle Vehicles with the 295cc and 350cc Fuji-Robin Engine', 1, 48, 'http://www.shopezgo.com/images/BalancerShaftOilSeal(20x32x6).image.jpeg?size=100&width=130&mid=e27a949795bbe863f31c3b79a2686770');
INSERT INTO `Part` VALUES('72395G01', '295 CC Piston Over .25', 71.42, '', 1, 49, 'http://www.shopezgo.com/images/295CCPistonOver25.image.jpeg?size=100&width=130&mid=ed519dacc89b2bead3f453b0b05a4a8b');
INSERT INTO `Part` VALUES('72393G01', '295CC Piston (2002)', 34.69, '', 1, 49, 'http://www.shopezgo.com/images/295CCPiston(2002).image.jpeg?size=100&width=130&mid=36d7534290610d9b7e9abed244dd2f28');
INSERT INTO `Part` VALUES('72859G01', 'Breather Plate', 5.1, 'Used on 2002-mid year 2008 E-Z-GO Gas Vehicles with a 295cc or 350cc Fuji-Robin Engine', 1, 50, 'http://www.shopezgo.com/images/BreatherPlate.image.jpeg?size=100&width=130&mid=f291e10ec3263bd7724556d62e70e25d');
INSERT INTO `Part` VALUES('72676G01', 'Complete Breather Plate', 8.16, 'Used on 1992-2003 4-Cycle Fuji-Robin Engines, including TXT, 4/6-Passenger Shuttle, ST 350, ST Sport, ST Sport 2+2, Clay', 1, 50, 'http://www.shopezgo.com/images/CompleteBreatherPlate.image.jpeg?size=100&width=130&mid=543e83748234f7cbab21aa0ade66565f');
INSERT INTO `Part` VALUES('27851G01', 'Cam Pulley Tool (4-Cycle)', 326.49, '', 1, 51, 'http://www.shopezgo.com/images/CamPulleyTool(4Cycle).image.jpeg?size=100&width=130&mid=2ca65f58e35d9ad45bf7f3ae5cfd08f1');
INSERT INTO `Part` VALUES('26614G01', 'Drive Pulley (4-Cycle)', 20.4, '', 1, 51, 'http://www.shopezgo.com/images/DrivePulley(4Cycle).image.jpeg?size=100&width=130&mid=7f6caf1f0ba788cd7953d817724c2b6e');
INSERT INTO `Part` VALUES('603543', 'Push Rod for RXV Vehicles', 23.46, 'Used on 2008-current E-Z-GO Gas RXV Vehicles, and vehicles with a Kawasaki Engine', 1, 52, 'http://www.shopezgo.com/images/PushRodforRXVVehicles.image.jpeg?size=100&width=130&mid=4eff0720836a198b6174eecf02cbfdbf');
INSERT INTO `Part` VALUES('603542', 'Push-Rod Guide', 6.12, 'Used on 2008-current E-Z-GO Gas RXV Vehicles, and vehicles with a Kawasaki Engine', 1, 52, 'http://www.shopezgo.com/images/PushRodGuide.image.jpeg?size=100&width=130&mid=9f93557d309f655ff06f109a08dcf7c4');
INSERT INTO `Part` VALUES('750276PKG', '295cc MCI Rebuild Kit wit Oversized Piston', 1, 'Used on E-Z-GO Gas Vehicles with a 295cc MCI Engine', 1, 53, 'http://www.shopezgo.com/images/295ccMCIRebuildKitwitOversizedPiston.image.jpeg?size=100&width=130&mid=0de5d1a081a3095d62b416e44e055e7a');
INSERT INTO `Part` VALUES('750277PKG', '350 Pre MCI Engine Rebuild Kit with Oversized Pist', 1, 'Used on E-Z-GO Gas Vehicles with a 350cc Pre-MCI Engine', 1, 53, 'http://www.shopezgo.com/images/350PreMCIEngineRebuildKitwithOversizedPiston.image.jpeg?size=100&width=130&mid=dfbd282c18300fa0eccceea6c5fac41f');
INSERT INTO `Part` VALUES('25691G01', 'Shift Control Cable, 4-Cycle Vehicles', 25.51, 'Used on 1991-2001 E-Z-GO 4-Cycle Gas Vehicles', 1, 54, 'http://www.shopezgo.com/images/ShiftControlCable4CycleVehicles.image.jpeg?size=100&width=130&mid=500e75a036dc2d7d2fec5da1b71d36cc');
INSERT INTO `Part` VALUES('72341G01', 'Shift Control Cable - Workhorse', 36.73, 'Used on 1996-2001 E-Z-GO Gas Workhorse 1200, Refresher and select ST Models', 1, 54, 'http://www.shopezgo.com/images/ShiftControlCableWorkhorse.image.jpeg?size=100&width=130&mid=ef50c335cca9f340bde656363ebd02fd');
INSERT INTO `Part` VALUES('26733G01', 'Spark Plug Wire Set, 4-Cycle Engines', 21.9, 'Used on 1993-2006 E-Z-GO Gas TXT, Marathon, Shuttle, select ST Models, and Workhorse Vehicles', 1, 55, 'http://www.shopezgo.com/images/SparkPlugWireSet4CycleEngines.image.jpeg?size=100&width=130&mid=df263d996281d984952c07998dc54358');
INSERT INTO `Part` VALUES('25523G4', 'Spark Plug for 11 HP Pre-MCI & MCI Engines', 5.1, 'Used on 1992-2005 E-Z-GO Gas Models with the 295cc and 350cc Fuji-Robin Engine', 1, 55, 'http://www.shopezgo.com/images/SparkPlugfor11HPPreMCIMCIEngines.image.jpeg?size=100&width=130&mid=b4a528955b84f584974e92d025a75d1f');
INSERT INTO `Part` VALUES('625715', 'AMD Starter Generator', 377.78, 'Used on 1991-current E-Z-GO Gas TXT, 4/6 Passenger Shuttle, Medalist, RXV, 804, 875, Shuttle 950, ST 350, ST 400, Woods', 1, 56, 'http://www.shopezgo.com/images/AMDStarterGenerator.image.jpeg?size=100&width=130&mid=ab013ca67cf2d50796b0c11d1b8bc95d');
INSERT INTO `Part` VALUES('26658G01', 'Brush Starter, 4 Cycle (4 Required)', 28.57, 'Used on 1991-current E-Z-GO 4-Cycle Vehicles and is compatible with Club Car, Columbia and Yamaha Vehicles', 1, 56, 'http://www.shopezgo.com/images/BrushStarter4Cycle(4Required).image.jpeg?size=100&width=130&mid=0353ab4cbed5beae847a7ff6e220b5cf');
INSERT INTO `Part` VALUES('26872G01', '4-Cycle Starter/Generator Front Bearing', 15.3, '', 1, 57, 'http://www.shopezgo.com/images/4CycleStarterGeneratorFrontBearing.image.jpeg?size=100&width=130&mid=51d92be1c60d1db1d2e5e7a07da55b26');
INSERT INTO `Part` VALUES('26878G01', 'Starter/Generator Front Cover', 93.87, '', 1, 57, 'http://www.shopezgo.com/images/StarterGeneratorFrontCover.image.jpeg?size=100&width=130&mid=428fca9bc1921c25c5121f9da7815cde');
INSERT INTO `Part` VALUES('15800G1', 'Throttle adjusting screw', 1.02, 'Used on 1989-1993 2 Cycle Gas Marathon Vehicles', 1, 58, 'http://www.shopezgo.com/images/Throttleadjustingscrew.image.jpeg?size=100&width=130&mid=c0c783b5fc0d7d808f1d14a6e9c8280d');
INSERT INTO `Part` VALUES('18442G1', 'Throttle Spring Ring', 1.99, 'Used on 1989-1992 2 Cycle Gas Marathon Vehicles', 1, 58, 'http://www.shopezgo.com/images/ThrottleSpringRing.image.jpeg?size=100&width=130&mid=b613e70fd9f59310cf0a8d33de3f2800');
INSERT INTO `Part` VALUES('26628G01', 'Idler Complete', 177.54, 'Used on 1992-current E-Z-GO Vehicles with 295cc & 350cc Pre-MCI and MCI Engines', 1, 59, 'http://www.shopezgo.com/images/IdlerComplete.image.jpeg?size=100&width=130&mid=e995f98d56967d946471af29d7bf99f1');
INSERT INTO `Part` VALUES('26630G01', 'Outer Timing Belt Cover (for Fuji-Robin Engines)', 32.65, '', 1, 59, 'http://www.shopezgo.com/images/OuterTimingBeltCover(forFujiRobinEngines).image.jpeg?size=100&width=130&mid=fc8fdb29501a6289b7bc8b0bdd8155df');
INSERT INTO `Part` VALUES('602872', 'Forward and Reverse Bell Crank for ST 4X4', 34.69, 'Used on E-Z-GO Gas ST 4x4 Models', 1, 60, 'http://www.shopezgo.com/images/ForwardandReverseBellCrankforST4X4.image.jpeg?size=100&width=130&mid=02ae6a786bbf135d3d223cbc0e770b6e');
INSERT INTO `Part` VALUES('72686G01', 'ST 4x4 Transmission Indicator Switch', 24.48, 'Used on 2004-2008 E-Z-GO Gas ST 4x4 Vehicles', 1, 60, 'http://www.shopezgo.com/images/ST4x4TransmissionIndicatorSwitch.image.jpeg?size=100&width=130&mid=6098ed616e715171f0dabad60a8e5197');
INSERT INTO `Part` VALUES('74369G01', '295cc & 350cc Engine Service Kit', 426.49, 'Used on 1998-2008 E-Z-GO Gas TXT, ST Sport II, and Workhorse-MPT 800 Vehicles', 1, 61, 'http://www.shopezgo.com/images/295cc350ccEngineServiceKit.image.jpeg?size=100&width=130&mid=5a0b8489ce264d4ff8dac4cce46ff8a0');
INSERT INTO `Part` VALUES('609251', '4-Cycle Engine Tune-Up Kit with Cylinder Air Filte', 79.59, '4-Cycle Engine Tune-Up Kit With Cylinder Air Filter is used on 1994-current E-Z-GO Vehicles with the 350cc 4-Cycle Engin', 1, 61, 'http://www.shopezgo.com/images/4CycleEngineTuneUpKitwithCylinderAirFilter.image.jpeg?size=100&width=130&mid=b4568df26077653eeadf29596708c94b');
INSERT INTO `Part` VALUES('72510G01', '4-Cycle Valve Collet', 1.54, 'Used on 1992-current E-Z-GO Gas Vehicles with a 295cc or 350cc (Pre-MCI/MCI) Fuji-Robin Engine', 1, 62, 'http://www.shopezgo.com/images/4CycleValveCollet.image.jpeg?size=100&width=130&mid=c8758b517083196f05ac29810b924aca');
INSERT INTO `Part` VALUES('72394G01', 'Camshaft (MCI Engines)', 234.67, 'Used on 2002-mid year 2008 E-Z-GO Gas Vehicles with a 295cc or 350cc Fuji-Robin Engine', 1, 62, 'http://www.shopezgo.com/images/Camshaft(MCIEngines).image.jpeg?size=100&width=130&mid=2000f6325dfc4fc3201fc45ed01c7a5d');
INSERT INTO `Part` VALUES('26675G01', '40mm Bolt', 4.08, 'Used in cylinder head and valve assemblies for E-Z-GO 1991-1994 Gas Marathon Vehicles', 1, 63, 'http://www.shopezgo.com/images/40mmBolt.image.jpeg?size=100&width=130&mid=020bf2c45e7bb322f89a226bd2c5d41b');
INSERT INTO `Part` VALUES('26673G01', '50mm Bolt', 4.08, 'Used in cylinder head and valve assemblies for E-Z-GO 1991-1994 Gas Marathon Vehicles', 1, 63, 'http://www.shopezgo.com/images/50mmBolt.image.jpeg?size=100&width=130&mid=c90e274d55309db944076afb3ff9c391');
INSERT INTO `Part` VALUES('71570G01', 'Acetal Bushing', 4.08, 'Used on 2004-2009 E-Z-GO Gas & Electric Vehicles', 1, 64, 'http://www.shopezgo.com/images/AcetalBushing.image.jpeg?size=100&width=130&mid=2e0aca891f2a8aedf265edf533a6d9a8');
INSERT INTO `Part` VALUES('17161G1', 'Bushing & Seal Assembly', 4.08, 'Used on 1989-2001 E-Z-GO Gas & Electric Vehicles', 1, 64, 'http://www.shopezgo.com/images/BushingSealAssembly.image.jpeg?size=100&width=130&mid=1651cf0d2f737d7adeab84d339dbabd3');
INSERT INTO `Part` VALUES('11391G6', 'Hose Clamp, #56', 3.06, '', 1, 66, 'http://www.shopezgo.com/images/HoseClamp56.image.jpeg?size=100&width=130&mid=5a2756a3cb9cde852cad3c97e120b656');
INSERT INTO `Part` VALUES('11391G7', 'Hose Clamp, 1.56-2.50 Diameter', 5.1, 'Used on 2006-current E-Z-GO Gas TXT, 4/6 Passenger Shuttle, RXV, ST 350, ST 4x4, ST 400, Woods Boundary MAV 400, ST Spor', 1, 66, 'http://www.shopezgo.com/images/HoseClamp156250Diameter.image.jpeg?size=100&width=130&mid=5a2756a3cb9cde852cad3c97e120b656');
INSERT INTO `Part` VALUES('17470G1', 'Tubing - Fuel', 5.1, 'Fits E-Z-GO Gas and Electric Golf Cars and Utility Vehicles', 1, 67, 'http://www.shopezgo.com/images/TubingFuel.image.jpeg?size=100&width=130&mid=e94fe9ac8dc10dd8b9a239e6abee2848');
INSERT INTO `Part` VALUES('73815G01', 'Fuel Cap', 30.56, 'Used on 2004-2007 E-Z-GO Gas ST 4x4 Vehicles', 1, 68, 'http://www.shopezgo.com/images/FuelCap.image.jpeg?size=100&width=130&mid=e49eb6523da9e1c347bc148ea8ac55d3');
INSERT INTO `Part` VALUES('14099G2', 'Fuel Cap W/Gauge', 25.95, '', 1, 68, 'http://www.shopezgo.com/images/FuelCapWGauge.image.jpeg?size=100&width=130&mid=faa9afea49ef2ff029a833cccc778fd0');
INSERT INTO `Part` VALUES('22238G2', 'Plastic Knob, 3/8-16 x 1.5', 16.32, '', 1, 69, 'http://www.shopezgo.com/images/PlasticKnob3816x15.image.jpeg?size=100&width=130&mid=aba22f748b1a6dff75bda4fd1ee9fe07');
INSERT INTO `Part` VALUES('70233G01', 'Shaft For Shift Lever For Electric Medalist', 17.34, '', 1, 69, 'http://www.shopezgo.com/images/ShaftForShiftLeverForElectricMedalist.image.jpeg?size=100&width=130&mid=4b6538a44a1dfdc2b83477cd76dee98e');
INSERT INTO `Part` VALUES('00734G5', '#10-32 Lock Nut', 1.02, '', 1, 70, 'http://www.shopezgo.com/images/1032LockNut.image.jpeg?size=100&width=130&mid=1a3f91fead97497b1a96d6104ad339f6');
INSERT INTO `Part` VALUES('71003G03', '#8 Speed Nut', 1.54, '#8 Speed nut for use with E-Z-GO Golf Cars and Utility Vehicles', 1, 70, 'http://www.shopezgo.com/images/8SpeedNut.image.jpeg?size=100&width=130&mid=5e6d27a7a8a8330df4b53240737ccc85');
INSERT INTO `Part` VALUES('819160', 'Cushman Rubber Shear Mount', 85.71, '', 1, 71, 'http://www.shopezgo.com/images/CushmanRubberShearMount.image.jpeg?size=100&width=130&mid=86a2f353e1e6692c05fe83d6fc79cf9d');
INSERT INTO `Part` VALUES('70113G01', 'Adjustable Rubber Bumper', 1.25, 'Used on 1991-current E-Z-GO Gas & Electric Vehicles', 1, 71, 'http://www.shopezgo.com/images/AdjustableRubberBumper.image.jpeg?size=100&width=130&mid=3f998e713a6e02287c374fd26835d87e');
INSERT INTO `Part` VALUES('26709G01', 'Camshaft Dowel Pin', 7.14, 'Used on 1992-mid year 2008 E-Z-GO Gas Vehicles with a 295cc or 350cc Fuji-Robin Engine', 1, 72, 'http://www.shopezgo.com/images/CamshaftDowelPin.image.jpeg?size=100&width=130&mid=3c7417b8df0daf23f39f445e740c7a43');
INSERT INTO `Part` VALUES('71571G01', 'Clevis Pin', 3.06, 'Clevis Pin used on Truck Bed of E-Z-GO Utility Vehicle', 1, 72, 'http://www.shopezgo.com/images/ClevisPin.image.jpeg?size=100&width=130&mid=eb9fc349601c69352c859c1faa287874');
INSERT INTO `Part` VALUES('75124G01', 'Bumper Plug', 6.12, 'Used on E-Z-GO Gas & Electric Vehicles, including other manufacturers'' vehicles', 1, 73, 'http://www.shopezgo.com/images/BumperPlug.image.jpeg?size=100&width=130&mid=c2890d44d06bafb6c7b4aa194857ccbc');
INSERT INTO `Part` VALUES('19853G1', 'End Cap/Plug', 2.04, 'Cap/Plug/Tube 1"', 1, 73, 'http://www.shopezgo.com/images/EndCapPlug.image.jpeg?size=100&width=130&mid=acf06cdd9c744f969958e1f085554c8b');
INSERT INTO `Part` VALUES('14601G11', 'Aluminum Rivet 3/16 X 9/16"', 1.02, 'Used on 1996-current E-Z-GO Gas & Electric Vehicles', 1, 74, 'http://www.shopezgo.com/images/AluminumRivet316X916.image.jpeg?size=100&width=130&mid=f12f2b34a0c3174269c19e21c07dee68');
INSERT INTO `Part` VALUES('14601G10', 'Aluminum Rivet 5/32', 0.66, 'Fits body/recept/seat filler', 1, 74, 'http://www.shopezgo.com/images/AluminumRivet532.image.jpeg?size=100&width=130&mid=d1942a3ab01eb59220e2b3a46e7ef09d');
INSERT INTO `Part` VALUES('00588G4', '10-24 x1/2 Threaded Screw', 0.78, '', 1, 75, 'http://www.shopezgo.com/images/1024x12ThreadedScrew.image.jpeg?size=100&width=130&mid=ee0e95249268b86ff2053bef214bfeda');
INSERT INTO `Part` VALUES('00438G7', '5/16-18 X 7/8 Screw', 1.54, '', 1, 75, 'http://www.shopezgo.com/images/51618X78Screw.image.jpeg?size=100&width=130&mid=e8dfff4676a47048d6f0c4ef899593dd');
INSERT INTO `Part` VALUES('71034G01', 'Loctite Flange Sealant', 61.22, 'For Commercial, Golf, Industrial, Turf, Utility, ATV''s, Boats or Automotive Use; Universal Applications', 1, 76, 'http://www.shopezgo.com/images/LoctiteFlangeSealant.image.jpeg?size=100&width=130&mid=ac0b236e346da355400a90fcc7e28be6');
INSERT INTO `Part` VALUES('26761G01', '4-Cycle Input Shaft/Differential Oil Seal', 6.12, 'Used on 1992-current E-Z-GO Vehicles with a 4-Cycle Fuji-Robin Engine', 1, 77, 'http://www.shopezgo.com/images/4CycleInputShaftDifferentialOilSeal.image.jpeg?size=100&width=130&mid=1cd138d0499a68f4bb72bee04bbec2d7');
INSERT INTO `Part` VALUES('12092G1', 'Grease Seal', 7.14, 'Used on 1991-current Gas & Electric TXT, 4/6-Passenger Shuttle, 640, 775, 875, 881, Shuttle 950, ST Express, Workhorse-M', 1, 77, 'http://www.shopezgo.com/images/GreaseSeal.image.jpeg?size=100&width=130&mid=8b8388180314a337c9aa3c5aa8e2f37a');
INSERT INTO `Part` VALUES('75048G01', '1/2" Spacer', 3.58, '', 1, 78, 'http://www.shopezgo.com/images/12Spacer.image.jpeg?size=100&width=130&mid=0663a4ddceacb40b095eda264a85f15c');
INSERT INTO `Part` VALUES('26797G01', '17 X 2 4 Cycle Differential Spacer', 7.14, '4 Cycle Transaxle 1992- Current Drivers Side Input Shaft - Shop Rebuild', 1, 78, 'http://www.shopezgo.com/images/17X24CycleDifferentialSpacer.image.jpeg?size=100&width=130&mid=6ee69d3769e832ec77c9584e0b7ba112');
INSERT INTO `Part` VALUES('23463G1', '1989-1993 Compression Spring', 10.2, 'Brake compression spring for use with E-Z-GO Golf Vehicles', 1, 79, 'http://www.shopezgo.com/images/19891993CompressionSpring.image.jpeg?size=100&width=130&mid=54fda78aa8a09b4d77b5aaec57b75028');
INSERT INTO `Part` VALUES('25727G01', '4-Cycle Washer Clip for Shifter Cable', 0.52, 'Used on 1991-current E-Z-GO Gas Vehicles', 1, 79, 'http://www.shopezgo.com/images/4CycleWasherClipforShifterCable.image.jpeg?size=100&width=130&mid=cd63a3eec3319fd9c84c942a08316e00');
INSERT INTO `Part` VALUES('605969', 'Run Tow Switch Boot Rubber', 15.3, 'Run Tow Switch Rubber Boot for use with E-Z-GO RXV Golf Cars', 1, 80, 'http://www.shopezgo.com/images/RunTowSwitchBootRubber.image.jpeg?size=100&width=130&mid=fd69dbe29f156a7ef876a40a94f65599');
INSERT INTO `Part` VALUES('15121G1', '3/8 Flat Washer', 1.02, 'Used on 1989-current E-Z-GO Gas & Electric Vehicles', 1, 81, 'http://www.shopezgo.com/images/38FlatWasher.image.jpeg?size=100&width=130&mid=43a115cbd6f4788924537365be3d6012');
INSERT INTO `Part` VALUES('26695G01', '6.5 mm x 22mm Washer', 1.02, '', 1, 81, 'http://www.shopezgo.com/images/65mmx22mmWasher.image.jpeg?size=100&width=130&mid=186fb23a33995d91ce3c2212189178c8');
INSERT INTO `Part` VALUES('750ST480BLANK', 'ST 480 Blank Key', 4.42, 'Used on ST 480 & Woods Boundary MAV 480 Vehicles', 1, 82, 'http://www.shopezgo.com/images/ST480BlankKey.image.jpeg?size=100&width=130&mid=ad71c82b22f4f65b9398f76d8be4c615');
INSERT INTO `Part` VALUES('83407', 'Cole Hersee Blank Key', 5.1, '', 1, 82, 'http://www.shopezgo.com/images/ColeHerseeBlankKey.image.jpeg?size=100&width=130&mid=f516dfb84b9051ed85b89cdc3a8ab7f5');
INSERT INTO `Part` VALUES('601015', 'Key Console Plate, TXT Medalist', 6.12, 'Used on all E-Z-GO TXT and Medalist Vehicles with "key only" console plates', 1, 83, 'http://www.shopezgo.com/images/KeyConsolePlateTXTMedalist.image.jpeg?size=100&width=130&mid=ddd9dda6bfaf0bb1525a8a27c3ee6131');
INSERT INTO `Part` VALUES('611284', 'Key Switch for Gas RXV', 20.4, 'Used on 2008-current E-Z-GO Gas RXV Vehicles', 1, 83, 'http://www.shopezgo.com/images/KeySwitchforGasRXV.image.jpeg?size=100&width=130&mid=11338326597d14a1f7c745853f4d50a8');
INSERT INTO `Part` VALUES('17063G1', 'Standard Ignition Key', 2.05, 'Used as a replacement key for 1976-current Gas & Electric E-Z-GO Golf Cars & Utility Vehicles Except RXV Vehciles', 1, 84, 'http://www.shopezgo.com/images/StandardIgnitionKey.image.jpeg?size=100&width=130&mid=051928341be67dcba03f0e04104d9047');
INSERT INTO `Part` VALUES('611282', 'RXV Keys (Set of 2 Each)', 5.1, 'Used on 2008-current Gas & Electric RXV Vehicles', 1, 84, 'http://www.shopezgo.com/images/RXVKeys(Setof2Each).image.jpeg?size=100&width=130&mid=d045c59a90d7587d8d671b5f5aec4e7c');
INSERT INTO `Part` VALUES('614031', 'Cable for 48 Volt TXT Handheld Unit', 70.7, 'Used on E-Z-GO TXT 48 Volt Vehicles for the Handheld Unit', 1, 85, 'http://www.shopezgo.com/images/Cablefor48VoltTXTHandheldUnit.image.jpeg?size=100&width=130&mid=9704a4fc48ae88598dcbdcdf57f3fdef');
INSERT INTO `Part` VALUES('27481G01', 'Digital Multi-Meter', 357.11, 'Used on E-Z-GO Gas & Electric Vehicles', 1, 85, 'http://www.shopezgo.com/images/DigitalMultiMeter.image.jpeg?size=100&width=130&mid=9ee70b7987a735c046ac30a1556272c8');
INSERT INTO `Part` VALUES('627098', 'Cadex Gun Probes', 775, '', 1, 86, 'http://www.shopezgo.com/images/CadexGunProbes.image.jpeg?size=100&width=130&mid=a3a3e8b30dd6eadfc78c77bb2b8e6b60');
INSERT INTO `Part` VALUES('608429', 'Clutch Puller Tool, RXV', 46.93, 'Used on 2008-current E-Z-GO Gas RXV Models, and any vehicle with a 2008-current Kawasaki Engine', 1, 86, 'http://www.shopezgo.com/images/ClutchPullerToolRXV.image.jpeg?size=100&width=130&mid=9b72e31dac81715466cd580a448cf823');
INSERT INTO `Part` VALUES('613294', 'Brake Line Hanger', 14.28, 'Used on 2010-current E-Z-GO Electric 2Five Vehicles', 1, 1, 'http://www.shopezgo.com/images/BrakeLineHanger.image.jpeg?size=100&width=130&mid=30ba105754346aaf47509089d2287f2a');

-- --------------------------------------------------------

--
-- Table structure for table `Part_Category_LU`
--

CREATE TABLE `Part_Category_LU` (
  `categoryId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`categoryId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `Part_Category_LU`
--

INSERT INTO `Part_Category_LU` VALUES(1, 'Brakes', NULL);
INSERT INTO `Part_Category_LU` VALUES(2, 'Frames', NULL);
INSERT INTO `Part_Category_LU` VALUES(3, 'Accelerator & Throttle', NULL);
INSERT INTO `Part_Category_LU` VALUES(4, 'Air Intake Systems', NULL);
INSERT INTO `Part_Category_LU` VALUES(5, 'Direction Selector', NULL);
INSERT INTO `Part_Category_LU` VALUES(6, 'Engine & Muffler', NULL);
INSERT INTO `Part_Category_LU` VALUES(7, 'Hardware', NULL);
INSERT INTO `Part_Category_LU` VALUES(8, 'Keys', NULL);
INSERT INTO `Part_Category_LU` VALUES(9, 'Specialty Tools', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Part_Subcategory_LU`
--

CREATE TABLE `Part_Subcategory_LU` (
  `subcategoryId` int(11) NOT NULL AUTO_INCREMENT,
  `categoryId` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`subcategoryId`),
  KEY `categoryId` (`categoryId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=88 ;

--
-- Dumping data for table `Part_Subcategory_LU`
--

INSERT INTO `Part_Subcategory_LU` VALUES(1, 1, 'Brackets', '');
INSERT INTO `Part_Subcategory_LU` VALUES(2, 1, 'Brake Cables', '');
INSERT INTO `Part_Subcategory_LU` VALUES(3, 2, 'Frames', '');
INSERT INTO `Part_Subcategory_LU` VALUES(4, 2, 'Frame Components', '');
INSERT INTO `Part_Subcategory_LU` VALUES(5, 3, 'Accelerator & Throttle Brackets', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(6, 3, 'Accelerator & Throttle Cables', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(7, 3, 'Accelerator & Throttle Components', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(8, 3, 'Accelerator & Throttle Pedals', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(9, 3, 'Accelerator & Throttle Rods', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(10, 3, 'Accelerator & Throttle Springs', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(11, 4, 'Air Filter Assemblies and Housings', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(12, 4, 'Air Filter Components', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(13, 4, 'Air Filter Cleaners', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(14, 4, 'Air Hoses and Tubes', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(87, 1, 'Brake Rotors', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(16, 1, 'Brake Calipers', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(17, 1, 'Brake Drums', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(18, 1, 'Brake Hardware & Components', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(19, 1, 'Brake Pads', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(20, 1, 'Brake Pedals', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(21, 1, 'Brake Shoes', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(22, 1, 'Disc Brakes', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(23, 1, 'Hydraulic Brakes & Components', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(24, 1, 'Mechanical Brakes', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(25, 1, 'Parking Brake', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(26, 5, 'FNR', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(27, 5, 'Plates', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(28, 6, 'Bearings', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(29, 6, 'Brackets', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(30, 6, 'Camshaft', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(31, 6, 'Carburetor Components', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(32, 6, 'Carburetors', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(33, 6, 'Choke Cables & Linkage', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(34, 6, 'Clutches', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(35, 6, 'Covers', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(36, 6, 'Cylinder Head & Crankcase', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(37, 6, 'Dipsticks', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(38, 6, 'Drive Belts', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(39, 6, 'Exhaust', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(40, 6, 'Fan & Blower Housings', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(41, 6, 'Fuel System', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(42, 6, 'Gas Engines', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(43, 6, 'Gaskets', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(44, 6, 'Governor', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(45, 6, 'Hardware', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(46, 6, 'Intake', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(47, 6, 'Oil Filters', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(48, 6, 'Oil Seals', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(49, 6, 'Pistons & Piston Components', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(50, 6, 'Plates', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(51, 6, 'Pulleys', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(52, 6, 'Push Rods', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(53, 6, 'Rebuild Kits', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(54, 6, 'Shifter Cables', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(55, 6, 'Spark Plugs', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(56, 6, 'Starter', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(57, 6, 'Start, Generator Components', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(58, 6, 'Throttle Components', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(59, 6, 'Timing', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(60, 6, 'Transmission', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(61, 6, 'Tune Up Kits', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(62, 6, 'Valves', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(63, 7, 'Bolts', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(64, 7, 'Bushings', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(65, 7, 'Caps', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(66, 7, 'Clamps', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(67, 7, 'Fuel', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(68, 7, 'Fuel Caps', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(69, 7, 'Handles & Knobs', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(70, 7, 'Nuts', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(71, 7, 'Other', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(72, 7, 'Pins', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(73, 7, 'Plugs', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(74, 7, 'Rivets', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(75, 7, 'Screws', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(76, 7, 'Sealant', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(77, 7, 'Seals', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(78, 7, 'Spacers', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(79, 7, 'Springs', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(80, 7, 'Switch Covers', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(81, 7, 'Washers', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(82, 8, 'Blank Keys', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(83, 8, 'Key Switches', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(84, 8, 'Replacement Keys', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(85, 9, 'Diagnostic Tools', NULL);
INSERT INTO `Part_Subcategory_LU` VALUES(86, 9, 'Maintenance Tools', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Shopping_Cart`
--

CREATE TABLE `Shopping_Cart` (
  `accountId` int(11) NOT NULL DEFAULT '0',
  `partNumber` varchar(20) NOT NULL DEFAULT '0',
  `instanceID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`instanceID`),
  KEY `accountId` (`accountId`),
  KEY `partNumber` (`partNumber`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `Shopping_Cart`
--

INSERT INTO `Shopping_Cart` VALUES(1, '26635G01', 29);
INSERT INTO `Shopping_Cart` VALUES(1, '72701G02P', 28);
INSERT INTO `Shopping_Cart` VALUES(1, 'test', 27);

-- --------------------------------------------------------

--
-- Table structure for table `Submodel_LU`
--

CREATE TABLE `Submodel_LU` (
  `submodelId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`submodelId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `Submodel_LU`
--

INSERT INTO `Submodel_LU` VALUES(1, '250', NULL);
INSERT INTO `Submodel_LU` VALUES(2, '1000', NULL);
INSERT INTO `Submodel_LU` VALUES(3, '4 Passenger', NULL);
INSERT INTO `Submodel_LU` VALUES(4, 'Submodel A', NULL);
INSERT INTO `Submodel_LU` VALUES(5, 'Submodel B', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Vehicle_Type`
--

CREATE TABLE `Vehicle_Type` (
  `serialNumber` int(11) NOT NULL,
  `modelId` int(11) NOT NULL,
  `fuelId` int(11) NOT NULL,
  `submodelId` int(11) NOT NULL,
  `yearId` int(11) NOT NULL,
  `image` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`serialNumber`),
  KEY `modelId` (`modelId`),
  KEY `fuelId` (`fuelId`),
  KEY `submodelId` (`submodelId`),
  KEY `yearId` (`yearId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Vehicle_Type`
--

INSERT INTO `Vehicle_Type` VALUES(1, 1, 1, 1, 1, 'http://www.shopezgo.com/images/application.jpeg?size=120&width=0&mid=99a2103fcf4f2c44d1f9f75553274025');
INSERT INTO `Vehicle_Type` VALUES(2, 1, 1, 1, 2, 'http://www.shopezgo.com/images/application.jpeg?size=120&width=0&mid=cdf28f8b7d14ab02d12a2329d71e4079');
INSERT INTO `Vehicle_Type` VALUES(3, 1, 1, 2, 1, 'http://www.shopezgo.com/images/application.jpeg?size=120&width=0&mid=58d2d622ed4026cae2e56dffc5818a11');
INSERT INTO `Vehicle_Type` VALUES(4, 1, 1, 2, 2, 'http://www.shopezgo.com/images/application.jpeg?size=120&width=0&mid=cdf28f8b7d14ab02d12a2329d71e4079');
INSERT INTO `Vehicle_Type` VALUES(5, 1, 2, 1, 1, 'http://www.shopezgo.com/images/application.jpeg?size=120&width=0&mid=fc2e6a440b94f64831840137698021e1');
INSERT INTO `Vehicle_Type` VALUES(6, 1, 2, 1, 2, 'http://www.shopezgo.com/images/application.jpeg?size=120&width=0&mid=cdf28f8b7d14ab02d12a2329d71e4079');
INSERT INTO `Vehicle_Type` VALUES(7, 1, 2, 2, 1, 'http://www.shopezgo.com/images/application.jpeg?size=120&width=0&mid=f3adde26e4fd2dcbfbc56c48396a6d23');
INSERT INTO `Vehicle_Type` VALUES(8, 1, 2, 2, 2, 'http://www.shopezgo.com/images/application.jpeg?size=120&width=0&mid=99a2103fcf4f2c44d1f9f75553274025');
INSERT INTO `Vehicle_Type` VALUES(9, 2, 1, 1, 1, 'http://www.shopezgo.com/images/application.jpeg?size=120&width=0&mid=4ddb5b8d603f88e9de689f3230234b47');
INSERT INTO `Vehicle_Type` VALUES(1234567890, 3, 2, 3, 1, 'images/2five.jpeg');
INSERT INTO `Vehicle_Type` VALUES(10, 4, 2, 4, 1, 'http://www.shopezgo.com/images/application.jpeg?size=120&width=0&mid=713fd63d76c8a57b16fc433fb4ae718a');
INSERT INTO `Vehicle_Type` VALUES(11, 5, 1, 5, 3, 'http://www.shopezgo.com/images/application.jpeg?size=120&width=0&mid=b154e7b21b2ff0a14d96affa6d3fb958');

-- --------------------------------------------------------

--
-- Table structure for table `Vehicle_Type_Part`
--

CREATE TABLE `Vehicle_Type_Part` (
  `serialNumber` int(11) NOT NULL DEFAULT '0',
  `partNumber` varchar(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`serialNumber`,`partNumber`),
  KEY `partId` (`partNumber`),
  KEY `serialNumber` (`serialNumber`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Vehicle_Type_Part`
--

INSERT INTO `Vehicle_Type_Part` VALUES(10, '608201');
INSERT INTO `Vehicle_Type_Part` VALUES(10, '70046G02');
INSERT INTO `Vehicle_Type_Part` VALUES(10, '70628G02');
INSERT INTO `Vehicle_Type_Part` VALUES(10, '72719G03P');
INSERT INTO `Vehicle_Type_Part` VALUES(11, '70046G02');
INSERT INTO `Vehicle_Type_Part` VALUES(1234567890, '27081G01');
INSERT INTO `Vehicle_Type_Part` VALUES(1234567890, '70536G01M');

-- --------------------------------------------------------

--
-- Table structure for table `Year_LU`
--

CREATE TABLE `Year_LU` (
  `yearId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`yearId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `Year_LU`
--

INSERT INTO `Year_LU` VALUES(1, '2012', NULL);
INSERT INTO `Year_LU` VALUES(2, '2011', NULL);
INSERT INTO `Year_LU` VALUES(3, '2010', NULL);

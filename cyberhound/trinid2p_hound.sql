/*
* Copyright (c) 2019 Red Alert Labs S.A.S.
* All Rights Reserved.
*
* This software is the confidential and proprietary information of
* Red Alert Labs S.A.S. (Confidential Information). You shall not
* disclose such Confidential Information and shall use it only in
* accordance with the terms of the license agreement you entered
* into with Red Alert Labs S.A.S.
*
* RED ALERT LABS S.A.S. MAKES NO REPRESENTATIONS OR WARRANTIES ABOUT THE
* SUITABILITY OF THE SOFTWARE, EITHER EXPRESS OR IMPLIED, INCLUDING
* BUT NOT LIMITED TO THE IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS
* FOR A PARTICULAR PURPOSE, OR NON-INFRINGEMENT. RED ALERT LABS S.A.S. SHALL
* NOT BE LIABLE FOR ANY DAMAGES SUFFERED BY LICENSEE AS A RESULT OF USING,
* MODIFYING OR DISTRIBUTING THIS SOFTWARE OR ITS DERIVATIVES.
*/
-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 17, 2020 at 08:01 AM
-- Server version: 5.5.61-38.13-log
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trinid2p_hound`
--

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE `device` (
  `id` int(11) NOT NULL,
  `postedby` varchar(1024) DEFAULT NULL,
  `doa` varchar(1024) DEFAULT NULL,
  `dev_name` varchar(1024) DEFAULT NULL,
  `dev_type` varchar(1024) DEFAULT NULL,
  `manu_name` varchar(1024) DEFAULT NULL,
  `model_num` varchar(1024) DEFAULT NULL,
  `ip_add` varchar(1024) DEFAULT NULL,
  `sensor_type` varchar(1024) DEFAULT NULL,
  `cloud_type` varchar(1024) DEFAULT NULL,
  `commercial_name` varchar(1024) DEFAULT NULL,
  `process` varchar(1024) DEFAULT NULL,
  `datarate` varchar(1024) DEFAULT NULL,
  `storecap` varchar(1024) DEFAULT NULL,
  `connect_type` varchar(1024) DEFAULT NULL,
  `data_security` varchar(1024) DEFAULT NULL,
  `comm_range` varchar(1024) DEFAULT NULL,
  `dynamic_nature` varchar(1024) DEFAULT NULL,
  `protocol_used` varchar(1024) DEFAULT NULL,
  `battery_life` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`id`, `postedby`, `doa`, `dev_name`, `dev_type`, `manu_name`, `model_num`, `ip_add`, `sensor_type`, `cloud_type`, `commercial_name`, `process`, `datarate`, `storecap`, `connect_type`, `data_security`, `comm_range`, `dynamic_nature`, `protocol_used`, `battery_life`) VALUES
(2, '5', '28-10-2019', 'Google Home', 'Smart Speaker', 'Google', '', 'NA', 'Capacitive touch sensor | Ambient light', 'Google Cloud', 'Google Home', 'Marvell 88DE3006 Armada 1500 Mini Plus dual-core ARM Cortex-A7 media processor', 'NA', 'NA', 'Wi-Fi 802.11b / g / n / ac (2.4 GHz / 5 GHz)', 'NA', 'NA', 'Yes', 'TCP / IP', 'NA'),
(3, '5', '31-10-2019', 'Amazon Echo', 'Smart Speaker', 'Amazon', '456788', '123.', '', 'AWS', '', '', '', '', '', '', '', '', '', ''),
(6, '5', '22-11-2019', 'Philips Hue', 'Smart Light', 'Philips', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(7, '5', '22-11-2019', 'Nest Cam', 'Smart Camera', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `internal`
--

CREATE TABLE `internal` (
  `id` int(11) NOT NULL,
  `ven_name` varchar(1024) DEFAULT NULL,
  `dev_name` varchar(1024) DEFAULT NULL,
  `vul_id` varchar(1024) DEFAULT NULL,
  `published` varchar(1024) DEFAULT NULL,
  `modified` varchar(1024) DEFAULT NULL,
  `cvss` varchar(1024) DEFAULT NULL,
  `cvssvector` varchar(1024) DEFAULT NULL,
  `assigner` varchar(1024) DEFAULT NULL,
  `summary` blob
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `internal`
--

INSERT INTO `internal` (`id`, `ven_name`, `dev_name`, `vul_id`, `published`, `modified`, `cvss`, `cvssvector`, `assigner`, `summary`) VALUES
(8, 'Google', 'Home', 'CVE-2018-12716', '2018-06-25T02:29:00', '2018-08-24T14:53:00', '3.3', 'AV:A/AC:L/Au:N/C:P/I:N/A:N', 'cve@mitre.org', 0x546865204150492073657276696365206f6e20476f6f676c6520486f6d6520616e64204368726f6d65636173742064657669636573206265666f7265206d69642d4a756c79203230313820646f6573206e6f742070726576656e7420444e5320726562696e64696e672061747461636b732066726f6d2072656164696e6720746865207363616e5f726573756c7473204a534f4e20646174612c20776869636820616c6c6f77732072656d6f74652061747461636b65727320746f2064657465726d696e652074686520706879736963616c206c6f636174696f6e206f66206d6f7374207765622062726f7773657273206279206c657665726167696e67207468652070726573656e6365206f66206f6e65206f662074686573652064657669636573206f6e20697473206c6f63616c206e6574776f726b2c2065787472616374696e6720746865207363616e5f726573756c7473206273736964206669656c64732c20616e642073656e64696e67207468657365206669656c647320696e20612067656f6c6f636174696f6e2f76312f67656f6c6f6361746520476f6f676c65204d6170732047656f6c6f636174696f6e2041504920726571756573742e),
(9, 'Philips', 'Hue', 'CVE-2017-14797', '2017-10-01T01:29:00', '2017-11-21T02:29:00', '7.9', 'AV:A/AC:M/Au:N/C:C/I:C/A:C', 'cve@mitre.org', 0x4c61636b206f66205472616e73706f727420456e6372797074696f6e20696e20746865207075626c69632041504920696e205068696c697073204875652042726964676520425342303032205357203137303730343039333220616c6c6f77732072656d6f74652061747461636b65727320746f207265616420415049206b6579732028616e6420636f6e73657175656e746c79206279706173732074686520707573686c696e6b2070726f74656374696f6e206d656368616e69736d2c20616e64206f627461696e20636f6d706c65746520636f6e74726f6c206f662074686520636f6e6e6563746564206163636573736f7269657329206279206c657665726167696e6720746865206162696c69747920746f20736e69666620485454502074726166666963206f6e20746865206c6f63616c20696e7472616e6574206e6574776f726b2e);

-- --------------------------------------------------------

--
-- Table structure for table `ref_links`
--

CREATE TABLE `ref_links` (
  `id` int(11) NOT NULL,
  `vul_id` varchar(1024) DEFAULT NULL,
  `ref_links` varchar(1024) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref_links`
--

INSERT INTO `ref_links` (`id`, `vul_id`, `ref_links`) VALUES
(41, 'CVE-2018-11567', 'https://info.checkmarx.com/hubfs/Amazon_Echo_Research.pdf'),
(40, 'CVE-2018-11567', 'https://www.yahoo.com/news/amazon-alexa-bug-let-hackers-104609600.html'),
(39, 'CVE-2018-11567', 'https://www.wired.com/story/amazon-echo-alexa-skill-spying/'),
(38, 'CVE-2018-11567', 'https://www.checkmarx.com/2018/04/25/eavesdropping-with-amazon-alexa/'),
(37, 'CVE-2018-11567', 'https://info.checkmarx.com/hubfs/Amazon_Echo_Research.pdf'),
(35, 'CVE-2018-11567', 'https://www.wired.com/story/amazon-echo-alexa-skill-spying/'),
(36, 'CVE-2018-11567', 'https://www.yahoo.com/news/amazon-alexa-bug-let-hackers-104609600.html'),
(34, 'CVE-2018-11567', 'https://www.checkmarx.com/2018/04/25/eavesdropping-with-amazon-alexa/'),
(33, 'CVE-2018-11567', 'https://info.checkmarx.com/hubfs/Amazon_Echo_Research.pdf'),
(29, 'CVE-2018-12716', 'https://krebsonsecurity.com/2018/06/google-to-fix-location-data-leak-in-google-home-chromecast/'),
(32, 'CVE-2018-12716', 'https://www.wired.com/story/chromecast-roku-sonos-dns-rebinding-vulnerability/'),
(31, 'CVE-2018-12716', 'https://www.tripwire.com/state-of-security/vert/googles-newest-feature-find-my-home/'),
(30, 'CVE-2018-12716', 'https://medium.com/@brannondorsey/attacking-private-networks-from-the-internet-with-dns-rebinding-ea7098a2d325'),
(42, 'CVE-2018-11567', 'https://www.checkmarx.com/2018/04/25/eavesdropping-with-amazon-alexa/'),
(43, 'CVE-2018-11567', 'https://www.wired.com/story/amazon-echo-alexa-skill-spying/'),
(44, 'CVE-2018-11567', 'https://www.yahoo.com/news/amazon-alexa-bug-let-hackers-104609600.html'),
(45, 'CVE-2018-11567', 'https://info.checkmarx.com/hubfs/Amazon_Echo_Research.pdf'),
(46, 'CVE-2018-11567', 'https://www.checkmarx.com/2018/04/25/eavesdropping-with-amazon-alexa/'),
(47, 'CVE-2018-11567', 'https://www.wired.com/story/amazon-echo-alexa-skill-spying/'),
(48, 'CVE-2018-11567', 'https://www.yahoo.com/news/amazon-alexa-bug-let-hackers-104609600.html'),
(49, 'CVE-2017-14797', 'https://www.tiferrei.com/philips-we-need-to-talk'),
(50, 'CVE-2018-11567', 'https://info.checkmarx.com/hubfs/Amazon_Echo_Research.pdf'),
(51, 'CVE-2018-11567', 'https://www.checkmarx.com/2018/04/25/eavesdropping-with-amazon-alexa/'),
(52, 'CVE-2018-11567', 'https://www.wired.com/story/amazon-echo-alexa-skill-spying/'),
(53, 'CVE-2018-11567', 'https://www.yahoo.com/news/amazon-alexa-bug-let-hackers-104609600.html'),
(54, 'CVE-2018-11567', 'https://info.checkmarx.com/hubfs/Amazon_Echo_Research.pdf'),
(55, 'CVE-2018-11567', 'https://www.checkmarx.com/2018/04/25/eavesdropping-with-amazon-alexa/'),
(56, 'CVE-2018-11567', 'https://www.wired.com/story/amazon-echo-alexa-skill-spying/'),
(57, 'CVE-2018-11567', 'https://www.yahoo.com/news/amazon-alexa-bug-let-hackers-104609600.html');

-- --------------------------------------------------------

--
-- Table structure for table `uaccess`
--

CREATE TABLE `uaccess` (
  `id` int(11) NOT NULL,
  `username` varchar(1024) DEFAULT NULL,
  `password` varchar(1024) DEFAULT NULL,
  `fullname` varchar(1024) DEFAULT NULL,
  `emailaddress` varchar(1024) DEFAULT NULL,
  `contactnumber` varchar(1024) DEFAULT NULL,
  `utype` varchar(1024) NOT NULL DEFAULT 'User',
  `attempts` int(11) NOT NULL DEFAULT '0',
  `retry_time` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uaccess`
--

INSERT INTO `uaccess` (`id`, `username`, `password`, `fullname`, `emailaddress`, `contactnumber`, `utype`, `attempts`, `retry_time`) VALUES
(4, 'prathin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Prashanth Rathinavel', 'rathinavelprashanth@gmail.com', '0123456789', 'Admin', 0, NULL),
(5, 'prashanth_r', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Prashanth Rathinavel', 'rathinavelprashanth@gmail.com', '123456789', 'User', 0, NULL),
(6, 'sbeena', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Sreedevi BEENA', 'sreedevibeena@xyz.com', '0123456789', 'Admin', 0, NULL),
(7, 'fasameer', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Sameer FA', 'samervj@gmail.com', '9965485042', 'User', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_vulnerability`
--

CREATE TABLE `user_vulnerability` (
  `id` int(11) NOT NULL,
  `vulnerability` blob,
  `ven_name` varchar(1024) DEFAULT NULL,
  `dev_name` varchar(1024) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_vulnerability`
--

INSERT INTO `user_vulnerability` (`id`, `vulnerability`, `ven_name`, `dev_name`) VALUES
(2, 0x476f6f676c65204368726f6d65204f53206265666f72652032362e302e313431302e35372072656c696573206f6e20612050616e676f2070616e676f2d7574696c732e6320726561645f636f6e66696720696d706c656d656e746174696f6e2074686174206c6f6164732074686520636f6e74656e7473206f6620746865202e70616e676f72632066696c6520696e207468652075736572277320686f6d65206469726563746f72792c20616e64207468652066696c65207265666572656e636564206279207468652050414e474f5f52435f46494c4520656e7669726f6e6d656e74207661726961626c652c20776869636820616c6c6f77732061747461636b65727320746f2062797061737320696e74656e64656420616363657373207265737472696374696f6e7320766961206372616674656420636f6e66696775726174696f6e20646174612e, 'Google', 'Home');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `internal`
--
ALTER TABLE `internal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_links`
--
ALTER TABLE `ref_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uaccess`
--
ALTER TABLE `uaccess`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_vulnerability`
--
ALTER TABLE `user_vulnerability`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `device`
--
ALTER TABLE `device`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `internal`
--
ALTER TABLE `internal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ref_links`
--
ALTER TABLE `ref_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `uaccess`
--
ALTER TABLE `uaccess`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_vulnerability`
--
ALTER TABLE `user_vulnerability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

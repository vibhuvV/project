-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2019 at 12:59 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `datetimerec`
--

CREATE TABLE `datetimerec` (
  `id` int(11) NOT NULL,
  `logintime` time NOT NULL,
  `logouttime` time NOT NULL,
  `logindate` date NOT NULL,
  `comments` varchar(200) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `datetimerec`
--

INSERT INTO `datetimerec` (`id`, `logintime`, `logouttime`, `logindate`, `comments`, `userid`) VALUES
(1, '14:12:59', '15:09:00', '2019-06-24', '', 1),
(2, '14:12:59', '15:09:00', '2019-06-24', 'Kya', 1),
(3, '14:12:59', '15:28:10', '2019-06-24', '', 6),
(4, '14:12:59', '15:09:48', '2019-06-24', '', 3),
(5, '14:12:59', '15:09:00', '2019-06-24', '', 1),
(6, '14:12:59', '15:09:48', '2019-06-24', '', 3),
(7, '14:12:59', '15:09:00', '2019-06-24', '', 1),
(8, '14:12:59', '15:09:00', '2019-06-24', '', 1),
(10, '17:48:00', '10:12:25', '2019-06-29', 'hjkhkj', 6),
(11, '10:12:30', '15:09:00', '2019-06-25', '', 1),
(12, '04:08:00', '16:52:00', '2019-06-22', 'kghj,j', 6),
(13, '10:19:45', '10:22:43', '2019-06-25', '', 5),
(14, '10:22:49', '15:09:00', '2019-06-25', '', 1),
(15, '10:23:24', '15:09:00', '2019-06-25', '', 1),
(16, '11:19:30', '15:09:00', '2019-06-25', '', 1),
(17, '11:24:37', '15:09:00', '2019-06-25', '', 1),
(18, '11:26:34', '15:09:48', '2019-06-25', '', 3),
(19, '11:29:13', '15:09:00', '2019-06-25', '', 1),
(20, '12:00:22', '15:09:00', '2019-06-25', '', 1),
(21, '12:35:40', '15:09:00', '2019-06-25', '', 1),
(22, '11:48:12', '15:09:00', '2019-06-25', '', 1),
(23, '11:53:06', '15:09:00', '2019-06-26', '', 1),
(24, '12:59:33', '15:09:00', '2019-06-26', '', 1),
(25, '13:52:20', '15:09:48', '2019-06-26', '', 3),
(26, '15:59:29', '15:09:00', '2019-06-26', '', 1),
(27, '19:58:29', '15:09:00', '2019-07-01', '', 1),
(28, '20:14:44', '15:09:00', '2019-07-01', '', 1),
(29, '20:29:18', '15:09:00', '2019-07-01', '', 1),
(30, '20:37:43', '15:09:00', '2019-07-01', '', 1),
(31, '15:06:21', '15:09:00', '2019-07-05', '', 1),
(32, '15:09:30', '15:09:48', '2019-07-05', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `permissionid` int(11) NOT NULL,
  `permissionname` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`permissionid`, `permissionname`, `status`) VALUES
(1, 'Dashboard', 'active'),
(2, 'Users', 'active'),
(3, 'Role', 'active'),
(4, 'Permission', 'active'),
(5, 'Project', 'active'),
(6, 'Revenue', 'active'),
(7, 'Timesheet', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `projectname` varchar(50) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `budget` varchar(20) NOT NULL,
  `managerallocated` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `projectname`, `startdate`, `enddate`, `status`, `budget`, `managerallocated`) VALUES
(1, 'Contacts Management System', '2019-06-25', '2019-06-25', 'inactive', '50000', 'Rachel Green'),
(2, 'Billing Management System', '2019-06-26', '2019-06-25', 'inactive', '30000', 'Chandler'),
(3, 'E-kart Website', '2019-06-26', '0000-00-00', 'active', '40000', 'Chandler'),
(4, 'NetPrime', '2019-06-26', '0000-00-00', 'active', '80000', 'Rachel Green'),
(5, 'project', '2019-06-26', '0000-00-00', 'active', '40210', 'Chandler'),
(6, 'Apollo', '2017-01-18', '2017-01-31', 'inactive', '20000', 'Chandler'),
(7, 'Barracuda', '2017-06-15', '2017-07-19', 'inactive', '40000', 'Gunther'),
(8, 'Aurora', '2017-11-17', '2017-12-31', 'inactive', '80000', 'Rachel Green'),
(9, 'Blue Moon', '2018-01-17', '2019-02-21', 'inactive', '90000', 'Gunther'),
(10, 'Camelot', '2018-03-22', '2018-06-29', 'inactive', '120000', 'Chandler'),
(11, 'Cinnamon', '2018-07-11', '2018-10-31', 'inactive', '200000', 'Ross'),
(12, 'Duraflame', '2018-11-21', '2018-12-28', 'inactive', '200000', 'Chandler'),
(13, 'ElectroBOOM', '2016-05-11', '2016-06-13', 'inactive', '60000', 'Ross');

-- --------------------------------------------------------

--
-- Table structure for table `relation`
--

CREATE TABLE `relation` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `permissionid` int(11) NOT NULL,
  `roleid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `relation`
--

INSERT INTO `relation` (`id`, `userid`, `permissionid`, `roleid`) VALUES
(1, 0, 1, 1),
(2, 0, 2, 1),
(3, 0, 3, 1),
(4, 0, 4, 1),
(5, 0, 5, 1),
(6, 0, 6, 1),
(7, 0, 7, 1),
(8, 0, 1, 2),
(9, 0, 5, 2),
(10, 0, 6, 2),
(11, 0, 7, 2),
(12, 0, 1, 3),
(13, 1, 1, 1),
(14, 1, 2, 1),
(15, 1, 3, 1),
(16, 1, 4, 1),
(17, 1, 5, 1),
(18, 1, 6, 1),
(19, 1, 7, 1),
(8038, 7, 1, 3),
(8041, 6, 1, 3),
(8042, 3, 1, 2),
(8043, 3, 5, 2),
(8044, 3, 6, 2),
(8045, 3, 7, 2),
(8046, 5, 1, 3),
(8047, 0, 7, 3),
(8048, 6, 7, 3),
(8049, 5, 7, 3),
(8050, 6, 1, 2),
(8051, 6, 5, 2),
(8052, 6, 7, 2),
(8053, 8, 1, 2),
(8054, 8, 5, 2),
(8055, 8, 6, 2),
(8056, 8, 7, 2),
(8057, 8, 1, 2),
(8058, 8, 5, 2),
(8059, 8, 6, 2),
(8060, 8, 7, 2),
(8061, 8, 1, 2),
(8062, 8, 5, 2),
(8063, 8, 7, 2),
(8064, 5, 1, 2),
(8065, 5, 6, 2),
(8066, 5, 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `revenue`
--

CREATE TABLE `revenue` (
  `id` int(11) NOT NULL,
  `projectid` int(11) NOT NULL,
  `invoiceamount` varchar(50) NOT NULL,
  `datecreated` date NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `revenue`
--

INSERT INTO `revenue` (`id`, `projectid`, `invoiceamount`, `datecreated`, `status`) VALUES
(1, 1, '60000', '2019-06-25', 'paid'),
(2, 2, '45465', '2019-06-15', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `roleid` int(11) NOT NULL,
  `rolename` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`roleid`, `rolename`, `status`) VALUES
(1, 'admin', 'active'),
(2, 'manager', 'active'),
(3, 'student', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `userid` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`userid`, `name`, `email`, `username`, `password`, `role`, `status`, `image`) VALUES
(1, 'Vaibhav Verma', 'vaibhavvermavibhu@gmail.com', 'vibhu', '3ffc152ec119740c1ba87b2dfc550cb7', 'admin', 'active', 'sideImage1.png'),
(3, 'Chandler', 'chandlerbing@mail.com', 'chandler', '738aa8d3bc02eb8712acd0eb2cf6dfd5', 'manager', 'active', 'sideImage.png'),
(5, 'Ross', 'rossgeller@mail.com', 'ross', '706d7a7c105402f35f679eb789321d11', 'manager', 'active', 'sideImage1.png'),
(6, 'Rachel Green', 'rachelgreenm@mail.com', 'rachel', '03d88a434aea3924fba828d9e86078ca', 'manager', 'active', 'sideImage.png'),
(7, 'joey', 'joey@mail.com', 'joey', 'd6ba0682d75eb986237fb6b594f8a31f', 'student', 'active', 'bgimg.jpg'),
(8, 'Gunther', 'gunther@cengralperk.com', 'gunther', '900e201a6aa7b0b1ce8218782d6142b6', 'manager', 'active', 'sideImage.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datetimerec`
--
ALTER TABLE `datetimerec`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`permissionid`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relation`
--
ALTER TABLE `relation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `revenue`
--
ALTER TABLE `revenue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleid`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `datetimerec`
--
ALTER TABLE `datetimerec`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `permissionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `relation`
--
ALTER TABLE `relation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8067;

--
-- AUTO_INCREMENT for table `revenue`
--
ALTER TABLE `revenue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `roleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

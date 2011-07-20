-- phpMyAdmin SQL Dump
-- version 3.3.2deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 20, 2011 at 08:06 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.2-1ubuntu4.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pdu_readings`
--

-- --------------------------------------------------------

--
-- Table structure for table `06_2011_june_readings`
--

CREATE TABLE IF NOT EXISTS `06_2011_june_readings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reading_time` datetime NOT NULL,
  `device_name` varchar(128) NOT NULL,
  `socket` int(11) NOT NULL,
  `current` int(11) NOT NULL,
  `voltage` int(11) NOT NULL,
  `active_power` int(11) NOT NULL,
  `app_power` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `index_device_and_socket` (`device_name`,`socket`),
  KEY `index_device` (`device_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2509941 ;

-- --------------------------------------------------------

--
-- Table structure for table `07_2011_july_readings`
--

CREATE TABLE IF NOT EXISTS `07_2011_july_readings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reading_time` datetime NOT NULL,
  `device_name` varchar(128) NOT NULL,
  `socket` int(11) NOT NULL,
  `current` int(11) NOT NULL,
  `voltage` int(11) NOT NULL,
  `active_power` int(11) NOT NULL,
  `app_power` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2227781 ;

-- --------------------------------------------------------

--
-- Table structure for table `pdu_ip`
--

CREATE TABLE IF NOT EXISTS `pdu_ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(128) NOT NULL,
  `device_name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `Totaled_Readings_Minute`
--

CREATE TABLE IF NOT EXISTS `Totaled_Readings_Minute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reading_time` datetime NOT NULL,
  `device_name` varchar(128) NOT NULL,
  `active_power` int(11) NOT NULL,
  `app_power` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=187497 ;

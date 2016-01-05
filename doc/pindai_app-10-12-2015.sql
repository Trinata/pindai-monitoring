-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 10, 2015 at 02:10 PM
-- Server version: 5.5.40-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pindai_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `ck_activity`
--

CREATE TABLE IF NOT EXISTS `ck_activity` (
  `id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL COMMENT '1:content;2:norma;3:peraturan;4:produk;5:program;6:sig;7:user',
  `activity_value` varchar(50) NOT NULL,
  `n_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ck_activity_log`
--

CREATE TABLE IF NOT EXISTS `ck_activity_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `activity_desc` varchar(250) NOT NULL,
  `source` varchar(20) NOT NULL,
  `datetimes` datetime NOT NULL,
  `n_status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ck_admin_member`
--

CREATE TABLE IF NOT EXISTS `ck_admin_member` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `name` varchar(46) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `menu_akses` varchar(300) DEFAULT NULL,
  `username` varchar(46) DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '1:admin, 2:verifikator, 3:evaluator, 4: balai',
  `salt` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `n_status` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ck_admin_member`
--

INSERT INTO `ck_admin_member` (`id`, `name`, `nickname`, `email`, `register_date`, `menu_akses`, `username`, `type`, `salt`, `password`, `n_status`) VALUES
(1, 'admin', 'admin', 'admin@example.com', '2014-08-07 15:56:36', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24', 'admin', 1, 'codekir v3.0', 'b2e982d12c95911b6abeacad24e256ff3fa47fdb', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ck_menu`
--

CREATE TABLE IF NOT EXISTS `ck_menu` (
  `menuID` int(2) NOT NULL AUTO_INCREMENT,
  `menuDesc` varchar(50) DEFAULT NULL,
  `menuParent` int(2) DEFAULT NULL,
  `menuPath` varchar(100) DEFAULT NULL,
  `menuIcon` varchar(100) DEFAULT NULL,
  `menuStatus` int(11) NOT NULL,
  `menuAksesLogin` int(11) NOT NULL,
  PRIMARY KEY (`menuID`),
  KEY `menuID` (`menuID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

-- --------------------------------------------------------

--
-- Table structure for table `ck_menu_parent`
--

CREATE TABLE IF NOT EXISTS `ck_menu_parent` (
  `menuParentID` int(2) NOT NULL AUTO_INCREMENT,
  `menuParentDesc` varchar(20) DEFAULT NULL,
  `menuOrder` int(11) NOT NULL,
  PRIMARY KEY (`menuParentID`),
  KEY `menuParentID` (`menuParentID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- Table structure for table `ck_template`
--

CREATE TABLE IF NOT EXISTS `ck_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `data` varchar(500) NOT NULL,
  `n_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ck_user_group`
--

CREATE TABLE IF NOT EXISTS `ck_user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `is_login` int(11) NOT NULL,
  `menu_access` varchar(300) DEFAULT NULL,
  `data` longtext,
  `n_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ck_user_group`
--

INSERT INTO `ck_user_group` (`id`, `name`, `is_login`, `menu_access`, `data`, `n_status`) VALUES
(1, 'Administrator', 1, '1,2,3,4,5,6', NULL, 1),
(2, 'Data entry', 1, '1,2,3', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ck_user_member`
--

CREATE TABLE IF NOT EXISTS `ck_user_member` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `nik` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `username` varchar(16) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `jenis_kelamin` tinyint(1) DEFAULT NULL,
  `tempat_lahir` tinytext,
  `tanggal_lahir` date DEFAULT NULL,
  `pendidikan` varchar(255) DEFAULT NULL,
  `institusi` tinytext,
  `jenis_pekerjaan` varchar(255) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `hp` tinytext,
  `alamat` text,
  `hak_akses` varchar(300) DEFAULT NULL,
  `other_data` text,
  `type` int(11) DEFAULT NULL COMMENT '1:admin,2:user',
  `salt` varchar(200) DEFAULT NULL,
  `login_count` int(11) NOT NULL DEFAULT '0',
  `email_token` varchar(255) DEFAULT NULL,
  `is_online` int(11) NOT NULL DEFAULT '0',
  `n_status` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ck_user_member`
--

INSERT INTO `ck_user_member` (`id`, `nik`, `name`, `username`, `email`, `password`, `register_date`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `pendidikan`, `institusi`, `jenis_pekerjaan`, `image`, `hp`, `alamat`, `hak_akses`, `other_data`, `type`, `salt`, `login_count`, `email_token`, `is_online`, `n_status`) VALUES
(1, '123', 'admin', 'admin', 'admin@admin.com', 'b2e982d12c95911b6abeacad24e256ff3fa47fdb', '2015-11-16 17:00:00', 1, NULL, '2015-11-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'codekir v3.0', 0, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pindai_news_content`
--

CREATE TABLE IF NOT EXISTS `pindai_news_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_ind` varchar(200) DEFAULT NULL,
  `title_en` varchar(200) DEFAULT NULL,
  `intro_ind` varchar(300) DEFAULT NULL,
  `intro_en` varchar(300) DEFAULT NULL,
  `detail_ind` text,
  `detail_en` text,
  `mode` int(11) NOT NULL DEFAULT '0',
  `media_cat_id` int(11) NOT NULL DEFAULT '0',
  `media_id` int(11) NOT NULL DEFAULT '0',
  `language` int(11) NOT NULL DEFAULT '1',
  `rubric_id` int(11) NOT NULL DEFAULT '0',
  `data` text,
  `tags` varchar(300) DEFAULT NULL,
  `edisi` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  `publish_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `n_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pindai_news_content_repo`
--

CREATE TABLE IF NOT EXISTS `pindai_news_content_repo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `news_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `n_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pindai_ref_company`
--

CREATE TABLE IF NOT EXISTS `pindai_ref_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `industry_id` int(11) NOT NULL DEFAULT '0',
  `email` varchar(100) DEFAULT NULL,
  `template` varchar(500) DEFAULT NULL,
  `color` varchar(500) DEFAULT NULL,
  `noise` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `data` longtext,
  `n_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pindai_ref_industry`
--

CREATE TABLE IF NOT EXISTS `pindai_ref_industry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `n_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pindai_ref_journalist`
--

CREATE TABLE IF NOT EXISTS `pindai_ref_journalist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `alias` varchar(100) DEFAULT NULL,
  `n_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pindai_ref_journalist`
--

INSERT INTO `pindai_ref_journalist` (`id`, `name`, `alias`, `n_status`) VALUES
(1, 'ovan pulu', NULL, 2),
(2, 'ovan pulu', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pindai_ref_media`
--

CREATE TABLE IF NOT EXISTS `pindai_ref_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `media_category` int(11) NOT NULL DEFAULT '0',
  `pic` varchar(100) DEFAULT NULL,
  `data` longtext,
  `n_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pindai_ref_media`
--

INSERT INTO `pindai_ref_media` (`id`, `name`, `media_category`, `pic`, `data`, `n_status`) VALUES
(1, 'coba', 0, 'tes', 'a:2:{s:5:"color";s:7:"#000000";s:8:"advprice";s:3:"111";}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pindai_ref_media_category`
--

CREATE TABLE IF NOT EXISTS `pindai_ref_media_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `data` longtext,
  `n_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pindai_ref_media_category`
--

INSERT INTO `pindai_ref_media_category` (`id`, `name`, `description`, `data`, `n_status`) VALUES
(1, 'Cetak1', 'test aja masuk gk', 'a:1:{s:5:"color";s:8:"#932C551";}', 2),
(2, 'coba', 'ada', 'a:1:{s:5:"color";s:7:"#DE5353";}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pindai_ref_mindshare`
--

CREATE TABLE IF NOT EXISTS `pindai_ref_mindshare` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `company_id` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  `data` longtext,
  `n_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pindai_ref_rubrik`
--

CREATE TABLE IF NOT EXISTS `pindai_ref_rubrik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `data` varchar(300) DEFAULT NULL,
  `n_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pindai_ref_rubrik`
--

INSERT INTO `pindai_ref_rubrik` (`id`, `name`, `data`, `n_status`) VALUES
(1, 'sadasda a', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pindai_ref_source`
--

CREATE TABLE IF NOT EXISTS `pindai_ref_source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `data` varchar(300) DEFAULT NULL,
  `n_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pindai_ref_source`
--

INSERT INTO `pindai_ref_source` (`id`, `name`, `position`, `data`, `n_status`) VALUES
(1, 'tess1', 'aab', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pindai_ref_topic`
--

CREATE TABLE IF NOT EXISTS `pindai_ref_topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `n_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pindai_ref_topic`
--

INSERT INTO `pindai_ref_topic` (`id`, `name`, `n_status`) VALUES
(1, 'ada data mantab', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pindai_report`
--

CREATE TABLE IF NOT EXISTS `pindai_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `company_id` int(11) NOT NULL DEFAULT '0',
  `create_date` int(11) NOT NULL DEFAULT '1',
  `n_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

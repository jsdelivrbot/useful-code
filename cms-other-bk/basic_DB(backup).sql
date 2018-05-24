-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- 主機: localhost
-- 建立日期: Jun 29, 2016, 10:08 AM
-- 伺服器版本: 5.0.51
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- 資料庫: `test`
-- 

-- --------------------------------------------------------

-- 
-- 資料表格式： `address_book_set`
-- 

CREATE TABLE `address_book_set` (
  `a_id` int(11) NOT NULL auto_increment,
  `a_title` tinytext collate utf8_unicode_ci,
  `a_subtitle` tinytext collate utf8_unicode_ci,
  `a_content` text collate utf8_unicode_ci,
  `a_class1` tinytext collate utf8_unicode_ci,
  `a_class2` text collate utf8_unicode_ci,
  `a_gender` tinyint(4) default NULL,
  `a_email` tinytext collate utf8_unicode_ci,
  `a_tel` tinytext collate utf8_unicode_ci,
  `a_address` tinytext collate utf8_unicode_ci,
  `a_display_name` tinytext collate utf8_unicode_ci,
  `a_year` tinytext collate utf8_unicode_ci,
  `a_month` tinytext collate utf8_unicode_ci,
  `a_day` tinytext collate utf8_unicode_ci,
  `a_status` tinyint(1) default '0',
  `a_epaper` tinyint(1) default '0',
  `a_date` datetime default NULL,
  PRIMARY KEY  (`a_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- 列出以下資料庫的數據： `address_book_set`
-- 


-- --------------------------------------------------------

-- 
-- 資料表格式： `admin`
-- 

CREATE TABLE `admin` (
  `user_id` int(11) NOT NULL auto_increment,
  `user_name` varchar(30) collate utf8_unicode_ci default NULL,
  `user_password` varchar(30) collate utf8_unicode_ci default NULL,
  `user_level` int(4) default NULL,
  `user_limit` tinyint(4) default '2',
  `user_active` tinyint(1) default '1',
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- 
-- 列出以下資料庫的數據： `admin`
-- 

INSERT INTO `admin` VALUES (1, 'admin', 'admin', 1, 1, 1);
INSERT INTO `admin` VALUES (3, 'tester', 'tester', 2, 2, 1);

-- --------------------------------------------------------

-- 
-- 資料表格式： `a_set`
-- 

CREATE TABLE `a_set` (
  `a_id` int(11) NOT NULL auto_increment,
  `a_title` varchar(30) collate utf8_unicode_ci default NULL,
  `a_1` tinyint(4) default NULL,
  `a_2` tinyint(4) default NULL,
  `a_3` tinyint(4) default NULL,
  `a_4` tinyint(4) default NULL,
  `a_5` tinyint(4) default NULL,
  `a_6` tinyint(4) default NULL,
  `a_7` tinyint(4) default NULL,
  `a_8` tinyint(4) default NULL,
  `a_9` tinyint(4) default NULL,
  `a_10` tinyint(4) default NULL,
  `a_11` tinyint(4) default NULL,
  `a_12` tinyint(4) default NULL,
  `a_13` tinyint(4) default NULL,
  `a_14` tinyint(4) default NULL,
  `a_15` tinyint(4) default NULL,
  `a_16` tinyint(4) default NULL,
  PRIMARY KEY  (`a_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- 
-- 列出以下資料庫的數據： `a_set`
-- 

INSERT INTO `a_set` VALUES (1, '系統管理員', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `a_set` VALUES (2, '資料更新員', 0, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

-- 
-- 資料表格式： `class_set`
-- 

CREATE TABLE `class_set` (
  `c_id` int(11) NOT NULL auto_increment,
  `c_title` tinytext collate utf8_unicode_ci,
  `c_content` text collate utf8_unicode_ci,
  `c_class` tinytext collate utf8_unicode_ci,
  `c_link` tinytext collate utf8_unicode_ci,
  `c_level` tinyint(4) default NULL,
  `c_active` tinyint(1) NOT NULL default '1',
  `c_parent` tinytext collate utf8_unicode_ci,
  `c_sort` int(11) default NULL,
  PRIMARY KEY  (`c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- 列出以下資料庫的數據： `class_set`
-- 


-- --------------------------------------------------------

-- 
-- 資料表格式： `data_set`
-- 

CREATE TABLE `data_set` (
  `d_id` int(11) NOT NULL auto_increment,
  `d_sn` tinytext collate utf8_unicode_ci,
  `d_title` tinytext collate utf8_unicode_ci,
  `d_title_en` tinytext collate utf8_unicode_ci,
  `d_content` text collate utf8_unicode_ci,
  `d_class1` tinytext collate utf8_unicode_ci,
  `d_class2` text collate utf8_unicode_ci,
  `d_parent` tinytext collate utf8_unicode_ci COMMENT '產品第二層',
  `d_class3` text collate utf8_unicode_ci,
  `d_class4` text collate utf8_unicode_ci,
  `d_class5` text collate utf8_unicode_ci,
  `d_class6` text collate utf8_unicode_ci,
  `d_tag` text collate utf8_unicode_ci,
  `d_data1` tinytext collate utf8_unicode_ci,
  `d_data2` tinytext collate utf8_unicode_ci,
  `d_data3` tinytext collate utf8_unicode_ci,
  `d_data4` tinytext collate utf8_unicode_ci,
  `d_data5` tinytext collate utf8_unicode_ci,
  `d_data6` tinytext collate utf8_unicode_ci,
  `d_data7` tinytext collate utf8_unicode_ci,
  `d_data8` tinytext collate utf8_unicode_ci,
  `d_data9` tinytext collate utf8_unicode_ci,
  `d_data10` tinytext collate utf8_unicode_ci,
  `d_data11` tinytext collate utf8_unicode_ci,
  `d_data12` tinytext collate utf8_unicode_ci,
  `d_data13` tinytext collate utf8_unicode_ci,
  `d_data14` tinytext collate utf8_unicode_ci,
  `d_data15` tinytext collate utf8_unicode_ci,
  `d_data16` tinytext collate utf8_unicode_ci,
  `d_data17` datetime default NULL,
  `d_data18` tinytext collate utf8_unicode_ci,
  `d_data19` tinytext collate utf8_unicode_ci,
  `d_data20` text collate utf8_unicode_ci,
  `d_data21` text collate utf8_unicode_ci,
  `d_data22` text collate utf8_unicode_ci,
  `d_data23` text collate utf8_unicode_ci,
  `d_authorize` tinyint(1) default '1',
  `d_youtube_code` tinytext collate utf8_unicode_ci,
  `d_imgType` tinyint(4) default '1',
  `d_decade` date default NULL COMMENT '年代',
  `d_date` datetime default NULL,
  `d_edit_date` datetime default NULL,
  `d_active` tinyint(1) default '1',
  `d_sort` int(11) default '1',
  PRIMARY KEY  (`d_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- 列出以下資料庫的數據： `data_set`
-- 


-- --------------------------------------------------------

-- 
-- 資料表格式： `file_set`
-- 

CREATE TABLE `file_set` (
  `file_d_id` int(11) default NULL,
  `file_id` int(11) NOT NULL auto_increment,
  `file_type` tinytext collate utf8_unicode_ci,
  `file_name` tinytext collate utf8_unicode_ci,
  `file_content` text collate utf8_unicode_ci,
  `file_title` tinytext collate utf8_unicode_ci,
  `file_link1` tinytext collate utf8_unicode_ci,
  `file_link2` tinytext collate utf8_unicode_ci,
  `file_link3` tinytext collate utf8_unicode_ci,
  `file_link4` tinytext collate utf8_unicode_ci,
  `file_link5` tinytext collate utf8_unicode_ci,
  `file_show_type` tinyint(1) default '0',
  `file_width` tinyint(1) default '0',
  `file_height` tinyint(1) default '0',
  PRIMARY KEY  (`file_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- 列出以下資料庫的數據： `file_set`
-- 


-- --------------------------------------------------------

-- 
-- 資料表格式： `index_set`
-- 

CREATE TABLE `index_set` (
  `object_id` int(11) default NULL COMMENT '現在指定的ID',
  `object_prev_id` int(11) default NULL COMMENT '之前的ID',
  `type` tinytext collate utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- 列出以下資料庫的數據： `index_set`
-- 


-- --------------------------------------------------------

-- 
-- 資料表格式： `menu`
-- 

CREATE TABLE `menu` (
  `menu_id` int(12) unsigned NOT NULL auto_increment,
  `menu_title` varchar(255) collate utf8_unicode_ci default NULL,
  `menu_link` varchar(255) collate utf8_unicode_ci default NULL,
  `menu_use` varchar(255) collate utf8_unicode_ci default NULL,
  `menu_pageTitle1` varchar(255) collate utf8_unicode_ci default NULL,
  `menu_pageTitle2` varchar(255) collate utf8_unicode_ci default NULL,
  `menu_pageTitle3` varchar(255) collate utf8_unicode_ci default NULL,
  `menu_pageTitle4` varchar(255) collate utf8_unicode_ci default NULL,
  `menu_pageTitle5` varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`menu_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

-- 
-- 列出以下資料庫的數據： `menu`
-- 

INSERT INTO `menu` VALUES (1, 'authority', 'authority_list.php', '#main_menu_1', '權限管理-列表', '權限管理-新增', '權限管理-修改', '權限管理-刪除', NULL);

-- --------------------------------------------------------

-- 
-- 資料表格式： `message_set`
-- 

CREATE TABLE `message_set` (
  `m_id` int(10) unsigned NOT NULL auto_increment,
  `m_d_id` int(10) unsigned NOT NULL default '0',
  `m_title` text collate utf8_unicode_ci,
  `m_content` text collate utf8_unicode_ci,
  `m_date` datetime default NULL,
  `m_name` text collate utf8_unicode_ci,
  `m_email` text collate utf8_unicode_ci,
  `m_type` varchar(7) collate utf8_unicode_ci default NULL,
  `m_ip` tinytext collate utf8_unicode_ci,
  `m_m_id` int(11) default NULL,
  `m_rem_id` int(11) default NULL,
  PRIMARY KEY  (`m_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- 列出以下資料庫的數據： `message_set`
-- 


-- --------------------------------------------------------

-- 
-- 資料表格式： `terms`
-- 

CREATE TABLE `terms` (
  `term_id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(200) collate utf8_unicode_ci NOT NULL default '',
  `slug` varchar(200) collate utf8_unicode_ci default NULL,
  `term_group` bigint(10) NOT NULL default '0',
  `term_type` tinyint(4) default '1',
  `term_active` tinyint(2) NOT NULL default '1',
  `term_sort` int(11) default '1',
  PRIMARY KEY  (`term_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- 列出以下資料庫的數據： `terms`
-- 


-- --------------------------------------------------------

-- 
-- 資料表格式： `term_relationships`
-- 

CREATE TABLE `term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL default '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL default '0',
  `term_order` int(11) NOT NULL default '0',
  PRIMARY KEY  (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- 列出以下資料庫的數據： `term_relationships`
-- 


-- --------------------------------------------------------

-- 
-- 資料表格式： `term_taxonomy`
-- 

CREATE TABLE `term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL auto_increment,
  `term_id` bigint(20) unsigned NOT NULL default '0',
  `taxonomy` varchar(32) collate utf8_unicode_ci NOT NULL default '',
  `description` longtext collate utf8_unicode_ci,
  `parent` bigint(20) unsigned NOT NULL default '0',
  `count` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- 列出以下資料庫的數據： `term_taxonomy`
-- 


-- --------------------------------------------------------

-- 
-- 資料表格式： `webcount`
-- 

CREATE TABLE `webcount` (
  `count_id` int(11) NOT NULL auto_increment,
  `count_ip` varchar(50) collate utf8_unicode_ci default NULL,
  `count_time` datetime default NULL,
  PRIMARY KEY  (`count_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- 列出以下資料庫的數據： `webcount`
-- 


-- --------------------------------------------------------

-- 
-- 資料表格式： `zipcode`
-- 

CREATE TABLE `zipcode` (
  `Id` bigint(20) NOT NULL auto_increment,
  `City` varchar(10) character set utf8 collate utf8_unicode_ci default NULL,
  `Area` varchar(10) character set utf8 collate utf8_unicode_ci default NULL,
  `ZipCode` char(3) character set utf8 collate utf8_unicode_ci default NULL,
  `c_id` int(11) default NULL COMMENT '對應縣市',
  `z_date` date default NULL,
  PRIMARY KEY  (`Id`),
  KEY `City` (`City`,`Area`,`ZipCode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 列出以下資料庫的數據： `zipcode`
-- 


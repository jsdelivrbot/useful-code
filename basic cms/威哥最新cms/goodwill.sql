-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生時間： 2017 年 06 月 28 日 02:44
-- 伺服器版本: 5.5.52-MariaDB
-- PHP 版本： 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `goodwill`
--

-- --------------------------------------------------------

--
-- 資料表結構 `address_book_set`
--

CREATE TABLE IF NOT EXISTS `address_book_set` (
  `a_id` int(11) NOT NULL,
  `a_title` tinytext COLLATE utf8_unicode_ci,
  `a_subtitle` tinytext COLLATE utf8_unicode_ci,
  `a_content` text COLLATE utf8_unicode_ci,
  `a_class1` tinytext COLLATE utf8_unicode_ci,
  `a_class2` text COLLATE utf8_unicode_ci,
  `a_gender` tinyint(4) DEFAULT NULL,
  `a_email` tinytext COLLATE utf8_unicode_ci,
  `a_tel` tinytext COLLATE utf8_unicode_ci,
  `a_address` tinytext COLLATE utf8_unicode_ci,
  `a_display_name` tinytext COLLATE utf8_unicode_ci,
  `a_year` tinytext COLLATE utf8_unicode_ci,
  `a_month` tinytext COLLATE utf8_unicode_ci,
  `a_day` tinytext COLLATE utf8_unicode_ci,
  `a_status` tinyint(1) DEFAULT '0',
  `a_epaper` tinyint(1) DEFAULT '0',
  `a_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `user_id` int(11) NOT NULL,
  `user_account` tinytext COLLATE utf8_unicode_ci,
  `user_password` text COLLATE utf8_unicode_ci,
  `user_name` tinytext COLLATE utf8_unicode_ci COMMENT '作者名',
  `user_content` text COLLATE utf8_unicode_ci COMMENT '作者簡介',
  `user_column` tinytext COLLATE utf8_unicode_ci COMMENT '作者主要專欄',
  `user_tag_txt` text COLLATE utf8_unicode_ci COMMENT '主要專欄文字',
  `user_class` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '作者分類',
  `user_level` int(4) DEFAULT NULL,
  `user_limit` tinyint(4) DEFAULT '2',
  `user_type` tinyint(4) DEFAULT '0',
  `user_active` tinyint(1) DEFAULT '1',
  `user_status` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_loginerr` tinyint(4) DEFAULT '0',
  `user_sort` int(11) DEFAULT NULL,
  `user_date` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `admin`
--

INSERT INTO `admin` (`user_id`, `user_account`, `user_password`, `user_name`, `user_content`, `user_column`, `user_tag_txt`, `user_class`, `user_level`, `user_limit`, `user_type`, `user_active`, `user_status`, `user_loginerr`, `user_sort`, `user_date`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, 'active', 0, NULL, NULL),
(7, 'tester', 'f5d1278e8109edd94e1e4197e04873b9', NULL, NULL, NULL, NULL, NULL, 2, 2, 1, 1, 'active', 0, NULL, NULL),
(10, 'test3', '8ad8757baa8564dc136c1e07507f4a98', NULL, NULL, NULL, NULL, NULL, 2, 2, 1, 1, 'active', 0, NULL, NULL),
(11, 'Polysh', '65f127dd6f4e96015eb8bc44adee6b5f', 'Polysh', '喜歡以繪畫的方式記錄生活，由於感概現代人習慣快速的生活步調，卻鮮少放慢速度去感受生活週遭的美，試著受環境各種味道的衝擊，而不是一如往常，只按下快門來快速捕捉眼前的事物，相信會有不同於以往的感動與體驗。\r\n\r\n另外，也希望透過畫作提醒大家珍惜生活中稍縱即逝的事物，我們身邊有許多文化與建築正快速的消失中，我們往往容易忽略身邊的幸福，把擁有的視為理所當然，等到失去後才感到後悔，希望能透過畫作，喚醒大家對於家鄉的關懷，進而思考我們該如何為這個土地盡一份心力。', '1,3,4', '專欄作家,Columnist,旅行,Travel,人物,People,文化,Culture,', '8', 5, 2, 0, 1, 'active', 0, 1, '2017-06-18 15:21:49'),
(12, 'author1', 'b312ba4ffd5245fa2a1ab819ec0d0347', '散場二三事', '喜歡以繪畫的方式記錄生活，由於感概現代人習慣快速的生活步調，卻鮮少放慢速度去感受生活週遭的美，試著受環境各種味道的衝擊，而不是一如往常，只按下快門來快速捕捉眼前的事物，相信會有不同於以往的感動與體驗。\r\n\r\n另外，也希望透過畫作提醒大家珍惜生活中稍縱即逝的事物，我們身邊有許多文化與建築正快速的消失中，我們往往容易忽略身邊的幸福，把擁有的視為理所當然，等到失去後才感到後悔，希望能透過畫作，喚醒大家對於家鄉的關懷，進而思考我們該如何為這個土地盡一份心力。', '1,4,7', '專欄作家,Columnist,旅行,Travel,文化,Culture,愛,Love,', '8', 5, 2, 0, 1, 'active', 0, 2, '2017-06-18 15:50:47');

-- --------------------------------------------------------

--
-- 資料表結構 `admin_log`
--

CREATE TABLE IF NOT EXISTS `admin_log` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_account` tinytext COLLATE utf8_unicode_ci,
  `user_limit` tinyint(4) DEFAULT NULL,
  `user_active` tinyint(1) DEFAULT NULL,
  `login_date` datetime DEFAULT NULL,
  `logout_date` datetime DEFAULT NULL,
  `login_ip` tinytext COLLATE utf8_unicode_ci,
  `login_status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logout_status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logout_page` tinytext COLLATE utf8_unicode_ci,
  `HTTP_USER_AGENT` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `admin_log`
--

INSERT INTO `admin_log` (`log_id`, `user_id`, `user_account`, `user_limit`, `user_active`, `login_date`, `logout_date`, `login_ip`, `login_status`, `logout_status`, `logout_page`, `HTTP_USER_AGENT`) VALUES
(1, 1, 'admin', 1, 1, '2017-06-17 13:45:21', '2017-06-17 13:50:54', '::1', 'Success', 'Logout Success', '/goodwill/cms/authority_edit.php', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'),
(2, 1, 'admin', 1, 1, '2017-06-17 13:51:08', '2017-06-17 16:20:29', '::1', 'Success', 'Logout Success', '/goodwill/cms/author_add.php', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'),
(3, 1, 'admin', 1, 1, '2017-06-17 16:23:36', '2017-06-17 16:25:23', '::1', 'Success', 'Logout Success', '/goodwill/cms/author_add.php', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'),
(4, 1, 'admin', 1, 1, '2017-06-17 16:26:06', '2017-06-20 00:32:49', '::1', 'Success', 'Logout Success', '/goodwill/cms/author_edit.php', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'),
(5, 11, 'Polysh', 2, 1, '2017-06-20 00:32:55', '2017-06-20 00:33:56', '::1', 'Success', 'Logout Success', '/goodwill/cms/article_add.php', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'),
(6, 12, 'author1', 2, 1, '2017-06-20 00:34:01', '2017-06-20 00:34:17', '::1', 'Success', 'Logout Success', '/goodwill/cms/article_add.php', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'),
(7, 1, 'admin', 1, 1, '2017-06-20 00:34:26', '2017-06-20 02:06:22', '::1', 'Success', 'Logout Success', '/goodwill/cms/article_add.php', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'),
(8, 1, 'admin', 1, 1, '2017-06-20 02:06:30', '2017-06-20 19:44:04', '::1', 'Success', 'Logout Success', '/goodwill/cms/authorityC_edit.php', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'),
(9, NULL, 'aPolysh', NULL, NULL, '2017-06-20 02:07:27', NULL, '::1', 'LoginFailed', NULL, '/goodwill/cms/login.php', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.90 Safari/537.36 Vivaldi/1.91.867.38'),
(10, 11, 'Polysh', 2, 1, '2017-06-20 02:07:32', NULL, '::1', 'Success', NULL, NULL, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.90 Safari/537.36 Vivaldi/1.91.867.38'),
(11, NULL, 'addmin', NULL, NULL, '2017-06-20 19:44:12', NULL, '::1', 'LoginFailed', NULL, '/goodwill/cms/login.php', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'),
(12, 1, 'admin', 1, 1, '2017-06-20 19:44:23', '2017-06-20 20:56:16', '::1', 'Success', 'Logout Success', '/goodwill/cms/authorityC_edit.php', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'),
(13, 1, 'admin', 1, 1, '2017-06-20 20:56:26', '2017-06-20 23:09:27', '::1', 'Success', 'Logout Success', '/goodwill/cms/authorityC_edit.php', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'),
(14, 1, 'admin', 1, 1, '2017-06-20 23:09:36', NULL, '::1', 'Success', NULL, NULL, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.104 Safari/537.36'),
(15, 1, 'admin', 1, 1, '2017-06-21 02:11:49', '2017-06-21 02:19:48', '218.173.159.243', 'Success', 'Logout Success', '/cms/article_list.php', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.104 Safari/537.36'),
(16, 11, 'Polysh', 2, 1, '2017-06-21 02:19:53', NULL, '218.173.159.243', 'Success', NULL, NULL, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.104 Safari/537.36'),
(17, 1, 'admin', 1, 1, '2017-06-21 16:59:01', NULL, '220.134.122.153', 'Success', NULL, NULL, 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'),
(18, NULL, NULL, NULL, NULL, NULL, '2017-06-21 23:07:57', '218.173.159.243', NULL, 'Unusual Access', '/cms/article_list.php?sel=1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.109 Safari/537.36'),
(19, 1, 'admin', 1, 1, '2017-06-21 23:17:10', NULL, '220.134.122.153', 'Success', NULL, NULL, 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'),
(20, 1, 'admin', 1, 1, '2017-06-23 14:44:01', '2017-06-23 14:44:18', '36.237.100.86', 'Success', 'Logout Success', '/cms/authorityC_edit.php', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.109 Safari/537.36'),
(21, 1, 'admin', 1, 1, '2017-06-23 14:44:25', NULL, '36.237.100.86', 'Success', NULL, NULL, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.109 Safari/537.36'),
(22, 1, 'admin', 1, 1, '2017-06-23 14:54:35', NULL, '60.249.19.226', 'Success', NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.109 Safari/537.36'),
(23, 1, 'admin', 1, 1, '2017-06-23 14:56:25', NULL, '60.249.19.226', 'Success', NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'),
(24, NULL, NULL, NULL, NULL, NULL, '2017-06-26 15:45:22', '60.249.19.226', NULL, 'Unusual Access', '/cms/articleT_list.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.109 Safari/537.36'),
(25, 1, 'admin', 1, 1, '2017-06-26 15:51:49', NULL, '60.249.19.226', 'Success', NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.109 Safari/537.36'),
(26, NULL, NULL, NULL, NULL, NULL, '2017-06-26 23:03:53', '218.173.163.73', NULL, 'Unusual Access', '/cms/article_list.php', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.109 Safari/537.36'),
(27, 1, 'admin', 1, 1, '2017-06-26 23:04:05', NULL, '218.173.163.73', 'Success', NULL, NULL, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.109 Safari/537.36'),
(28, 1, 'admin', 1, 1, '2017-06-28 03:26:52', NULL, '220.134.122.153', 'Success', NULL, NULL, 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'),
(29, NULL, NULL, NULL, NULL, NULL, '2017-06-28 03:27:56', '111.248.197.155', NULL, 'Unusual Access', '/cms/articleSubT_list.php', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.109 Safari/537.36'),
(30, 1, 'admin', 1, 1, '2017-06-28 03:28:14', NULL, '111.248.197.155', 'Success', NULL, NULL, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.109 Safari/537.36'),
(31, 1, 'admin', 1, 1, '2017-06-28 10:11:22', NULL, '220.134.122.153', 'Success', NULL, NULL, 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36'),
(32, 1, 'admin', 1, 1, '2017-06-28 10:35:16', NULL, '220.134.122.153', 'Success', NULL, NULL, 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36');

-- --------------------------------------------------------

--
-- 資料表結構 `a_set`
--

CREATE TABLE IF NOT EXISTS `a_set` (
  `a_id` int(11) NOT NULL,
  `a_title` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `a_1` int(11) DEFAULT NULL,
  `a_2` int(11) DEFAULT NULL,
  `a_3` int(11) DEFAULT NULL,
  `a_4` int(11) DEFAULT NULL,
  `a_5` int(11) DEFAULT NULL,
  `a_6` int(11) DEFAULT NULL,
  `a_7` int(11) DEFAULT NULL,
  `a_8` int(11) DEFAULT NULL,
  `a_9` int(11) DEFAULT NULL,
  `a_10` int(11) DEFAULT NULL,
  `a_11` int(11) DEFAULT NULL,
  `a_12` int(11) DEFAULT NULL,
  `a_13` int(11) DEFAULT NULL,
  `a_14` int(11) DEFAULT NULL,
  `a_15` int(11) DEFAULT NULL,
  `a_16` int(11) DEFAULT NULL,
  `a_type` tinytext COLLATE utf8_unicode_ci
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `a_set`
--

INSERT INTO `a_set` (`a_id`, `a_title`, `a_1`, `a_2`, `a_3`, `a_4`, `a_5`, `a_6`, `a_7`, `a_8`, `a_9`, `a_10`, `a_11`, `a_12`, `a_13`, `a_14`, `a_15`, `a_16`, `a_type`) VALUES
(1, '系統管理員', 210, 210, 210, 210, 210, 210, 210, 15, 15, 15, 210, 1, NULL, NULL, NULL, NULL, '1'),
(2, '資料更新員', 0, 0, 0, 0, 15, 15, 0, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, '1'),
(5, '作者', 0, 0, 0, 210, 0, 0, 0, 0, 0, 0, 6, 1, NULL, NULL, NULL, NULL, '0'),
(6, '測試管理', 0, 0, 210, 210, 0, 0, 0, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, '1'),
(7, '測試管理2', 0, 0, 0, 210, 0, 0, 0, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, '1');

-- --------------------------------------------------------

--
-- 資料表結構 `class_set`
--

CREATE TABLE IF NOT EXISTS `class_set` (
  `c_id` int(11) NOT NULL,
  `c_title` tinytext COLLATE utf8_unicode_ci,
  `c_title_en` tinytext COLLATE utf8_unicode_ci,
  `c_content` text COLLATE utf8_unicode_ci,
  `c_class` tinytext COLLATE utf8_unicode_ci,
  `c_link` tinytext COLLATE utf8_unicode_ci,
  `c_level` tinyint(4) DEFAULT NULL,
  `c_active` tinyint(1) NOT NULL DEFAULT '1',
  `c_parent` tinytext COLLATE utf8_unicode_ci,
  `c_sort` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `data_set`
--

CREATE TABLE IF NOT EXISTS `data_set` (
  `d_id` int(11) NOT NULL,
  `d_title` tinytext COLLATE utf8_unicode_ci,
  `d_title_en` tinytext COLLATE utf8_unicode_ci,
  `d_content` text COLLATE utf8_unicode_ci,
  `d_class1` tinytext COLLATE utf8_unicode_ci,
  `d_class2` text COLLATE utf8_unicode_ci,
  `d_class3` text COLLATE utf8_unicode_ci,
  `d_class4` text COLLATE utf8_unicode_ci,
  `d_class5` text COLLATE utf8_unicode_ci,
  `d_class6` text COLLATE utf8_unicode_ci,
  `d_tag` text COLLATE utf8_unicode_ci,
  `d_tag_txt` text COLLATE utf8_unicode_ci,
  `d_data1` text COLLATE utf8_unicode_ci,
  `d_data2` text COLLATE utf8_unicode_ci,
  `d_data3` text COLLATE utf8_unicode_ci,
  `d_data4` text COLLATE utf8_unicode_ci,
  `d_price1` int(11) DEFAULT '0',
  `d_price2` int(11) DEFAULT '0',
  `d_price3` int(11) DEFAULT '0',
  `d_inventory` tinyint(4) DEFAULT '0',
  `d_sale` tinyint(1) DEFAULT '0',
  `d_new_product` tinyint(1) DEFAULT '0',
  `d_date` datetime DEFAULT NULL,
  `d_startdate` date DEFAULT '0000-00-00',
  `d_enddate` date DEFAULT '0000-00-00',
  `d_active` tinyint(1) DEFAULT '1',
  `d_pub` tinyint(4) DEFAULT '1',
  `d_sort` int(11) DEFAULT '1',
  `d_recommend` int(11) DEFAULT '0' COMMENT '推薦故事'
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `data_set`
--

INSERT INTO `data_set` (`d_id`, `d_title`, `d_title_en`, `d_content`, `d_class1`, `d_class2`, `d_class3`, `d_class4`, `d_class5`, `d_class6`, `d_tag`, `d_tag_txt`, `d_data1`, `d_data2`, `d_data3`, `d_data4`, `d_price1`, `d_price2`, `d_price3`, `d_inventory`, `d_sale`, `d_new_product`, `d_date`, `d_startdate`, `d_enddate`, `d_active`, `d_pub`, `d_sort`, `d_recommend`) VALUES
(6, '首頁Banner', NULL, NULL, 'bannersHome', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2017-06-11 20:18:28', '0000-00-00', '0000-00-00', 1, NULL, 1, 0),
(7, '首頁Banner2', NULL, NULL, 'bannersHome', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2017-06-11 20:18:38', '0000-00-00', '0000-00-00', 1, NULL, 2, 0),
(8, '讓旅人成為更好的人', 'New humanities，heart moving', NULL, 'articleTBanner', NULL, NULL, NULL, NULL, NULL, '1', '旅行,Travel,', NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2017-06-14 00:00:00', '0000-00-00', '0000-00-00', 1, NULL, 1, 0),
(9, '讓土地發光', 'New humanities，heart moving', NULL, 'articleTBanner', '2', NULL, NULL, NULL, NULL, '2', '土地,Land,', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0, '2017-06-14 00:00:00', '0000-00-00', '0000-00-00', 1, NULL, 1, 0),
(10, '讓努力的人被看見', 'New humanities，heart moving', NULL, 'articleTBanner', '3', NULL, NULL, NULL, NULL, '3', '人物,People,', NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2017-06-14 00:00:00', '0000-00-00', '0000-00-00', 1, NULL, 1, 0),
(11, NULL, NULL, NULL, 'articleTBanner', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2017-06-18 17:03:33', '0000-00-00', '0000-00-00', NULL, NULL, 1, 0),
(12, '讓美學融入日常', 'New humanities，heart moving', NULL, 'articleTBanner', '5', NULL, NULL, NULL, NULL, '5', '藝術,Art,', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0, '2017-06-14 00:00:00', '0000-00-00', '0000-00-00', 1, NULL, 1, 0),
(13, '食文化，心價值', 'New humanities，heart moving', NULL, 'articleTBanner', '6', NULL, NULL, NULL, NULL, '6', '好食,Diet,', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0, '2017-06-14 00:00:00', '0000-00-00', '0000-00-00', 1, NULL, 1, 0),
(14, '種一顆心，開花結果', 'New humanities，heart moving', NULL, 'articleTBanner', '7', NULL, NULL, NULL, NULL, '7', '愛,Love,', NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2017-06-14 00:00:00', '0000-00-00', '0000-00-00', 1, NULL, 1, 0),
(15, NULL, 'Travel', NULL, 'articleTContentBanner', '1', NULL, NULL, NULL, NULL, '1', '旅行,Travel,', NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2017-06-14 00:00:00', '0000-00-00', '0000-00-00', 1, NULL, 1, 0),
(16, NULL, 'Land', NULL, 'articleTContentBanner', '2', NULL, NULL, NULL, NULL, '2', '土地,Land,', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0, '2017-06-14 00:00:00', '0000-00-00', '0000-00-00', 1, NULL, 1, 0),
(17, NULL, 'People', NULL, 'articleTContentBanner', '3', NULL, NULL, NULL, NULL, '3', '人物,People,', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0, '2017-06-14 00:00:00', '0000-00-00', '0000-00-00', 1, NULL, 1, 0),
(18, NULL, 'Culture', NULL, 'articleTContentBanner', '4', NULL, NULL, NULL, NULL, '4', '文化,Culture,', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0, '2017-06-14 00:00:00', '0000-00-00', '0000-00-00', 1, NULL, 1, 0),
(19, NULL, 'Art', NULL, 'articleTContentBanner', '5', NULL, NULL, NULL, NULL, '5', '藝術,Art,', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0, '2017-06-14 00:00:00', '0000-00-00', '0000-00-00', 1, NULL, 1, 0),
(20, NULL, 'Diet', NULL, 'articleTContentBanner', '6', NULL, NULL, NULL, NULL, '6', '好食,Diet,', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0, '2017-06-14 00:00:00', '0000-00-00', '0000-00-00', 1, NULL, 1, 0),
(21, NULL, 'Love', NULL, 'articleTContentBanner', '7', NULL, NULL, NULL, NULL, '7', '愛,Love,', NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0, '2017-06-14 00:00:00', '0000-00-00', '0000-00-00', 1, NULL, 1, 0),
(22, '森林作家', 'FOREST AUTHOR', NULL, 'authorBanner', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2017-06-19 00:28:48', '0000-00-00', '0000-00-00', 1, NULL, 1, 0),
(24, '在美瑛的一年', NULL, '<p><img src="../source/detail-1.jpg" alt="" width="1280" height="791" /></p>\r\n<p>&nbsp;</p>\r\n<p>2010年六月，薰衣草森林到日本北海道中部的美瑛開了「緩慢」。多年以來，常碰到有人問，為什麼我們要離開台灣，千里迢迢地到日本的鄉鎮去開民宿呢？<br />我常跟朋友說，很多去過美瑛的人，回來之後都得了一種「想再回去的相思病」，我也不例外。<br />美瑛很美，它曾經獲選為全日本「最美麗的村莊」第一名，約莫整個台北市的2.5倍大，但只住了一萬一千人，放眼望去多是起起伏伏的緩丘，種植了不同花草，到了春天、夏天百花齊放，好像造物者的手在大地上織了五彩繽紛的花毯。這個地方對我們也很有意義，因為慧君就是受到當地薰衣草田照片的啟發，才開了薰衣草森林。（註：慧君，薰衣草森林的另一位創辦人）</p>\r\n<p>&nbsp;</p>\r\n<p><img src="../source/detail-2.jpg" alt="" width="1280" height="1809" /></p>\r\n<p>&nbsp;</p>\r\n<p>當時，我們默默地許下一個心願，「北海道是薰衣草的故鄉，那麼有一天，薰衣草森林能否也在這北海道最美的地方開民宿，種下屬於我們的薰衣草呢？」<br />在找尋過程中，得知在當地氛圍、服務都最具口碑的「僻靜」民宿主人想回神奈川縣退休，正在找人接手經營。那時，薰衣草森林才剛在奮起湖和金瓜石成立「緩慢」，團隊裡也沒有很多懂日文的人，加上日本物價又比台灣貴，重重限制下，我們還是毅然決然地前往全世界服務標竿之地日本，接受挑戰。<br />還記得，美瑛的緩慢要開張前，我們從台灣寄送一整貨櫃的餐具、毛巾、備品等營業用品，結果因為品項太多，拉長了檢核時間。眼看開幕在即，我和一些後來再去幫忙的夥伴，行李箱裡只放幾件衣服，其他都塞滿毛巾和文宣品，每當回想起此事，都不禁莞爾。<br />美瑛一年約有130萬觀光客造訪，但全都集中在夏天，尤其是七月。十一月到隔年四月，美瑛便進入冰封雪季，現在一月最高溫負6度，這是生在台灣的你我很難想像的。比起我們在山上偶爾因為下雨、颱風而停業，美瑛人碰到的自然挑戰更加艱困。<br />一年之中有180天處於不能營業的雪季，但美瑛人從沒因此氣餒或鬆懈。沒錯，冬天很冷，客人不會來，所以像種植葡萄、瓜果的多田農場的主人多田先生，便周遊台灣、法國進修最新農產技術，等待春天融雪之際，讓農作有更好的收成。但如果想吸引客人來呢？美瑛人想出在二、三月間辦「雪上繪藝術節」，在一片白茫茫的雪地上，用對環境友善的蛋殼和融雪劑做顏料，廣邀全日本遊客一起和居民們畫出當年主題創作。<br />直到在美瑛待了一年後，我才更加理解，美瑛的美，是美在人們努力克服老天爺給的考驗；美瑛的美，是美在能鼓舞人心。</p>\r\n<p>&nbsp;</p>\r\n<p><img src="../source/detail-3.jpg" alt="" width="1280" height="928" /></p>', 'article', '1', '10', NULL, '散場二三事', '12', '12', '一日遊,', '2010年六月，薰衣草森林到日本北海道中部的美瑛開了「緩慢」。多年以來，常碰到有人問，為什麼我們要離開台灣，千里迢迢地到日本的鄉鎮去開民宿呢？\r\n\r\n我常跟朋友說，很多去過美瑛的人，回來之後都得了一種「想再回去的相思病」，我也不例外。\r\n美瑛很美，它曾經獲選為全日本「最美麗的村莊」第一名，約莫整個台北市的2.5倍大，但只住了一萬一千人，放眼望去多是起起伏伏的緩丘，種植了不同花草，到了春天、夏天百花齊放，好像造物者的手在大地上織了五彩繽紛的花毯。這個地方對我們也很有意義，因為慧君就是受到當地薰衣草田照片的啟發，才開了薰衣草森林。（註：慧君，薰衣草森林的另一位創辦人）', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, '2017-06-20 00:00:00', '0000-00-00', '0000-00-00', 1, 1, 1, 1),
(25, '關於我們', NULL, '真正的幸福，並不是待在光明之中\r\n從遠處凝望光明，朝他奮力奔去\r\n在那忘我的時間裡，才有人生真正的充實——安藤忠雄\r\n\r\n《故事森林》Goodwill stories 是由薰衣草森林股份有限公司所成立的網路新媒體，在負面新聞滿天飛的今日，我們相信，在這片土地上，仍然有一群不屬於鎂光燈的人們，透過對土地與人的善意、對夢想的堅持與對生活美學的投入，默默寫著，屬於自己，真實動人的小人物大故事。\r\n\r\n透過「旅行、土地、人物、文化、藝術、食育與愛」等七大主題，我們希望能串連有相同理念的朋友們，共同打造一個傳遞正面與溫暖能量的故事平台。\r\n\r\n誠摯地邀請您，在此種下美好的故事種子，\r\n與我們一同茁壯，一座，閃爍幸福的森林。', 'about', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '若您認同《故事森林》的理念，並有任何形式的合作提案與想法，不管是內容合作、採訪邀稿、體驗課程、活動策展、演講邀約、問題諮詢、公益合作、品牌企劃或資源交換……等等，請來信《故事森林》信箱102556@lavendercottage.com留下您的提案、想法與聯絡資訊，將有專人與您聯繫。歡迎您走入森林，以善意形塑創意，與我們一起，激盪出最溫暖的故事漣漪。\r\n\r\n\r\n\r\n', NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, '2017-06-18 19:55:40', '0000-00-00', '0000-00-00', 1, 1, 1, 0),
(26, '關於故事森林', 'About us', NULL, 'aboutBanner', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2017-06-19 21:04:58', '0000-00-00', '0000-00-00', 1, NULL, 1, 0),
(27, '版權聲明', 'Copyright', NULL, 'clauseBanner', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2017-06-20 20:19:57', '0000-00-00', '0000-00-00', 1, NULL, 1, 0),
(28, '版權聲明', NULL, NULL, 'clause', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, '2017-06-20 20:36:25', '0000-00-00', '0000-00-00', 1, 1, 1, 0),
(29, '走入故事森林，與我們共同執筆', '寫下獨一無二的故事，留下探險生命的足跡。', NULL, 'weneeduTopBanner', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2017-06-20 21:20:11', '0000-00-00', '0000-00-00', 1, NULL, 1, 0),
(30, '我們找的就是你', 'A contented mind is a perpetual feast.', NULL, 'weneeduBottomBanner', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2017-06-20 21:24:17', '0000-00-00', '0000-00-00', 1, 1, 1, 0),
(31, '誠徵撰稿作家', NULL, '如果你熱愛自然品味生活，喜歡出門旅行冒險，又剛好愛拍照會寫作，樂於和別人分享你的精采故事，請趕快加入我們吧！我們等的就是你。', 'weneedu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'COME ON\r\nBABE\r\nWE NEED YOU!!', NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2017-06-20 21:48:25', '0000-00-00', '0000-00-00', 1, 1, 1, 0),
(35, '薰衣草森林', NULL, NULL, 'partner', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, '2017-06-20 23:04:04', '0000-00-00', '0000-00-00', 1, 1, 1, 0),
(36, '桐花村', NULL, NULL, 'partner', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, '2017-06-20 23:05:43', '0000-00-00', '0000-00-00', 1, 1, 2, 0),
(37, '緩.慢', NULL, NULL, 'partner', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, '2017-06-20 23:06:11', '0000-00-00', '0000-00-00', 1, 1, 3, 0),
(38, '心之芳庭', NULL, NULL, 'partner', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, '2017-06-20 23:06:57', '0000-00-00', '0000-00-00', 1, 1, 4, 0),
(39, '好好', NULL, NULL, 'partner', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, '2017-06-20 23:07:25', '0000-00-00', '0000-00-00', 1, 1, 5, 0),
(40, '緩慢文旅', NULL, NULL, 'partner', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, '2017-06-20 23:07:41', '0000-00-00', '0000-00-00', 1, 1, 6, 0),
(41, '森林島嶼', NULL, NULL, 'partner', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, '2017-06-20 23:08:12', '0000-00-00', '0000-00-00', 1, 1, 7, 0),
(42, '當塵埃淹沒天際：KAY SAGE，深嵌於生命底層的孤獨印象', NULL, 'LWbeI5jqWxA', 'indexVideo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2017-06-21 00:44:15', '0000-00-00', '0000-00-00', 1, 1, 1, 0),
(45, '12345', NULL, '<p>5456456456456</p>', 'article', '2', '13', NULL, 'Polysh', '11', '12', '一日遊,', '5454564564564', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, '2017-06-28 00:00:00', '0000-00-00', '0000-00-00', 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `file_set`
--

CREATE TABLE IF NOT EXISTS `file_set` (
  `file_d_id` int(11) DEFAULT NULL,
  `file_id` int(11) NOT NULL,
  `file_type` tinytext COLLATE utf8_unicode_ci,
  `file_name` tinytext COLLATE utf8_unicode_ci,
  `file_title` tinytext COLLATE utf8_unicode_ci,
  `file_content` text COLLATE utf8_unicode_ci,
  `file_link1` tinytext COLLATE utf8_unicode_ci,
  `file_link2` tinytext COLLATE utf8_unicode_ci,
  `file_link3` tinytext COLLATE utf8_unicode_ci,
  `file_link4` tinytext COLLATE utf8_unicode_ci,
  `file_link5` tinytext COLLATE utf8_unicode_ci,
  `file_link6` tinytext COLLATE utf8_unicode_ci,
  `file_show_type` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `file_set`
--

INSERT INTO `file_set` (`file_d_id`, `file_id`, `file_type`, `file_name`, `file_title`, `file_content`, `file_link1`, `file_link2`, `file_link3`, `file_link4`, `file_link5`, `file_link6`, `file_show_type`) VALUES
(8, 6, 'image', 'articleTBanner_994551cf268e48a17e3ac948c4ce00fc.jpg', '新人文，心感動', NULL, 'upload_image/articleTBanner/articleTBanner_994551cf268e48a17e3ac948c4ce00fc.jpg', 'upload_image/articleTBanner/articleTBanner_994551cf268e48a17e3ac948c4ce00fc_s100.jpg', NULL, NULL, NULL, NULL, 1),
(9, 7, 'image', 'articleTBanner_a3e6130a3b9ec45ed8a3aab00408bae4.jpg', '新人文，心感動', NULL, 'upload_image/articleTBanner/articleTBanner_a3e6130a3b9ec45ed8a3aab00408bae4.jpg', 'upload_image/articleTBanner/articleTBanner_a3e6130a3b9ec45ed8a3aab00408bae4_s100.jpg', NULL, NULL, NULL, NULL, 1),
(10, 9, 'image', 'articleTBanner_e7ad7b354969e2de3f450577a024d614.jpg', 'banner', NULL, 'upload_image/articleTBanner/articleTBanner_e7ad7b354969e2de3f450577a024d614.jpg', 'upload_image/articleTBanner/articleTBanner_e7ad7b354969e2de3f450577a024d614_s100.jpg', NULL, NULL, NULL, NULL, 1),
(11, 10, 'image', 'articleTBanner_1d77b381cbed9d903ae08b86478feabc.jpg', NULL, NULL, 'upload_image/articleTBanner/articleTBanner_1d77b381cbed9d903ae08b86478feabc.jpg', 'upload_image/articleTBanner/articleTBanner_1d77b381cbed9d903ae08b86478feabc_s100.jpg', NULL, NULL, NULL, NULL, 1),
(12, 11, 'image', 'articleTBanner_da76c62e7543bfae6318bbcd84eae511.jpg', NULL, NULL, 'upload_image/articleTBanner/articleTBanner_da76c62e7543bfae6318bbcd84eae511.jpg', 'upload_image/articleTBanner/articleTBanner_da76c62e7543bfae6318bbcd84eae511_s100.jpg', NULL, NULL, NULL, NULL, 1),
(13, 12, 'image', 'articleTBanner_642ce7324b93fd4839821005bf817569.jpg', NULL, NULL, 'upload_image/articleTBanner/articleTBanner_642ce7324b93fd4839821005bf817569.jpg', 'upload_image/articleTBanner/articleTBanner_642ce7324b93fd4839821005bf817569_s100.jpg', NULL, NULL, NULL, NULL, 1),
(14, 14, 'image', 'articleTBanner_5473d412ce70e48a4b897e3dabf1fd48.jpg', NULL, NULL, 'upload_image/articleTBanner/articleTBanner_5473d412ce70e48a4b897e3dabf1fd48.jpg', 'upload_image/articleTBanner/articleTBanner_5473d412ce70e48a4b897e3dabf1fd48_s100.jpg', NULL, NULL, NULL, NULL, 1),
(15, 16, 'image', 'articleTContentBanner_e1aa050ec2343a4f27244aded55078df.jpg', 'Travel', NULL, 'upload_image/articleTContentBanner/articleTContentBanner_e1aa050ec2343a4f27244aded55078df.jpg', 'upload_image/articleTContentBanner/articleTContentBanner_e1aa050ec2343a4f27244aded55078df_s100.jpg', NULL, NULL, NULL, NULL, 1),
(16, 17, 'image', 'articleTContentBanner_b97be6b83b6db4c22269347201cd122f.jpg', NULL, NULL, 'upload_image/articleTContentBanner/articleTContentBanner_b97be6b83b6db4c22269347201cd122f.jpg', 'upload_image/articleTContentBanner/articleTContentBanner_b97be6b83b6db4c22269347201cd122f_s100.jpg', NULL, NULL, NULL, NULL, 1),
(17, 18, 'image', 'articleTContentBanner_385a8fd26cf0d6ecc54132ef46e42994.jpg', 'People', NULL, 'upload_image/articleTContentBanner/articleTContentBanner_385a8fd26cf0d6ecc54132ef46e42994.jpg', 'upload_image/articleTContentBanner/articleTContentBanner_385a8fd26cf0d6ecc54132ef46e42994_s100.jpg', NULL, NULL, NULL, NULL, 1),
(18, 19, 'image', 'articleTContentBanner_01b79eb8419e69f8ae08ce0f79715d3a.jpg', 'Culture', NULL, 'upload_image/articleTContentBanner/articleTContentBanner_01b79eb8419e69f8ae08ce0f79715d3a.jpg', 'upload_image/articleTContentBanner/articleTContentBanner_01b79eb8419e69f8ae08ce0f79715d3a_s100.jpg', NULL, NULL, NULL, NULL, 1),
(19, 20, 'image', 'articleTContentBanner_32b49b0324f9451a456672cd628192ca.jpg', 'Art', NULL, 'upload_image/articleTContentBanner/articleTContentBanner_32b49b0324f9451a456672cd628192ca.jpg', 'upload_image/articleTContentBanner/articleTContentBanner_32b49b0324f9451a456672cd628192ca_s100.jpg', NULL, NULL, NULL, NULL, 1),
(20, 21, 'image', 'articleTContentBanner_f4a03dd4ddb33c3590fd3b4f7558da99.jpg', 'Diet', NULL, 'upload_image/articleTContentBanner/articleTContentBanner_f4a03dd4ddb33c3590fd3b4f7558da99.jpg', 'upload_image/articleTContentBanner/articleTContentBanner_f4a03dd4ddb33c3590fd3b4f7558da99_s100.jpg', NULL, NULL, NULL, NULL, 1),
(21, 22, 'image', 'articleTContentBanner_2f670ed3d2c9c0b6155e8b50817eac86.jpg', 'Love', NULL, 'upload_image/articleTContentBanner/articleTContentBanner_2f670ed3d2c9c0b6155e8b50817eac86.jpg', 'upload_image/articleTContentBanner/articleTContentBanner_2f670ed3d2c9c0b6155e8b50817eac86_s100.jpg', NULL, NULL, NULL, NULL, 1),
(12, 24, 'imageAuthor', 'author_51539dff8a6d991448f3ab1735193591.jpg', NULL, NULL, 'upload_image/author/author_51539dff8a6d991448f3ab1735193591.jpg', 'upload_image/author/author_51539dff8a6d991448f3ab1735193591_s100.jpg', NULL, NULL, NULL, NULL, 1),
(11, 27, 'imageAuthor', 'author_d6f15016585630d3f7669229a5e6337c.jpg', 'Polysh', NULL, 'upload_image/author/author_d6f15016585630d3f7669229a5e6337c.jpg', 'upload_image/author/author_d6f15016585630d3f7669229a5e6337c_s100.jpg', NULL, NULL, NULL, NULL, 1),
(22, 30, 'image', 'authorBanner_04fba58ea7401d2d457c6daef8913736.jpg', '森林作家', NULL, 'upload_image/authorBanner/authorBanner_04fba58ea7401d2d457c6daef8913736.jpg', 'upload_image/authorBanner/authorBanner_04fba58ea7401d2d457c6daef8913736_s100.jpg', NULL, NULL, NULL, NULL, 1),
(24, 38, 'image', 'articleListCover_632ebb4157751015869504c77b1444ae.jpg', '在美瑛的一年', NULL, 'upload_image/articleListCover/articleListCover_632ebb4157751015869504c77b1444ae.jpg', 'upload_image/articleListCover/articleListCover_632ebb4157751015869504c77b1444ae_s100.jpg', NULL, NULL, NULL, NULL, 1),
(24, 39, 'imageCover', 'articleCover_cb05c4994a9364080af01281f23d0048.jpg', '在美瑛的一年', NULL, 'upload_image/articleCover/articleCover_cb05c4994a9364080af01281f23d0048.jpg', 'upload_image/articleCover/articleCover_cb05c4994a9364080af01281f23d0048_s100.jpg', NULL, NULL, NULL, NULL, 1),
(26, 41, 'image', 'aboutBanner_13cfdac35321777b12012d84be9105f5.jpg', '關於故事森林', NULL, 'upload_image/aboutBanner/aboutBanner_13cfdac35321777b12012d84be9105f5.jpg', 'upload_image/aboutBanner/aboutBanner_13cfdac35321777b12012d84be9105f5_s100.jpg', NULL, NULL, NULL, NULL, 1),
(27, 43, 'image', 'clauseBanner_67515663b548c6e192fe60d6cbf99d0c.jpg', '版權聲明', NULL, 'upload_image/clauseBanner/clauseBanner_67515663b548c6e192fe60d6cbf99d0c.jpg', 'upload_image/clauseBanner/clauseBanner_67515663b548c6e192fe60d6cbf99d0c_s100.jpg', NULL, NULL, NULL, NULL, 1),
(29, 44, 'image', 'weneeduTopBanner_a0f25a645822acaa64905ac8426ee9b4.jpg', '走入故事森林，與我們共同執筆', NULL, 'upload_image/weneeduTopBanner/weneeduTopBanner_a0f25a645822acaa64905ac8426ee9b4.jpg', 'upload_image/weneeduTopBanner/weneeduTopBanner_a0f25a645822acaa64905ac8426ee9b4_s100.jpg', NULL, NULL, NULL, NULL, 1),
(30, 45, 'image', 'weneeduBottomBanner_ba62a9005fe24b758ea1d131adda3d44.jpg', '我們找的就是你', NULL, 'upload_image/weneeduBottomBanner/weneeduBottomBanner_ba62a9005fe24b758ea1d131adda3d44.jpg', 'upload_image/weneeduBottomBanner/weneeduBottomBanner_ba62a9005fe24b758ea1d131adda3d44_s100.jpg', NULL, NULL, NULL, NULL, 1),
(31, 48, 'image', 'weneedu_d13f7d8a335015497511adc7fb8f295a.jpg', 'WE NEED YOU!!', NULL, 'upload_image/weneedu/weneedu_d13f7d8a335015497511adc7fb8f295a.jpg', 'upload_image/weneedu/weneedu_d13f7d8a335015497511adc7fb8f295a_s100.jpg', NULL, NULL, NULL, NULL, 1),
(31, 49, 'imageMobile', 'weneeduMobile_46af9c5f627a1a62ec7de383a8296422.jpg', 'WE NEED YOU!!', NULL, 'upload_image/weneeduMobile/weneeduMobile_46af9c5f627a1a62ec7de383a8296422.jpg', 'upload_image/weneeduMobile/weneeduMobile_46af9c5f627a1a62ec7de383a8296422_s100.jpg', NULL, NULL, NULL, NULL, 0),
(35, 55, 'image', 'partner_4d8b7333bb61e99bf27084a8249ffec1.png', '薰衣草森林', NULL, 'upload_image/partner/partner_4d8b7333bb61e99bf27084a8249ffec1@2x.png', 'upload_image/partner/partner_4d8b7333bb61e99bf27084a8249ffec1@1x.png', NULL, NULL, NULL, NULL, 0),
(36, 56, 'image', 'partner_42ca93eaa0bfc86e87581ec2fedfc77a.png', '桐花村', NULL, 'upload_image/partner/partner_42ca93eaa0bfc86e87581ec2fedfc77a@2x.png', 'upload_image/partner/partner_42ca93eaa0bfc86e87581ec2fedfc77a@1x.png', NULL, NULL, NULL, NULL, 1),
(37, 57, 'image', 'partner_7c5a06d0d20e7dfae6a396dc31f9b7f9.png', '緩.慢', NULL, 'upload_image/partner/partner_7c5a06d0d20e7dfae6a396dc31f9b7f9@2x.png', 'upload_image/partner/partner_7c5a06d0d20e7dfae6a396dc31f9b7f9@1x.png', NULL, NULL, NULL, NULL, 1),
(38, 58, 'image', 'partner_4160a45c6556903d25db0692acb9bf7a.png', '心之芳庭', NULL, 'upload_image/partner/partner_4160a45c6556903d25db0692acb9bf7a@2x.png', 'upload_image/partner/partner_4160a45c6556903d25db0692acb9bf7a@1x.png', NULL, NULL, NULL, NULL, 1),
(39, 59, 'image', 'partner_7904f87324ae3c2d368dc1e1d92aba05.png', '好好', NULL, 'upload_image/partner/partner_7904f87324ae3c2d368dc1e1d92aba05@2x.png', 'upload_image/partner/partner_7904f87324ae3c2d368dc1e1d92aba05@1x.png', NULL, NULL, NULL, NULL, 1),
(40, 60, 'image', 'partner_a578a483199d9babd0c47f14073febce.png', '緩慢文旅', NULL, 'upload_image/partner/partner_a578a483199d9babd0c47f14073febce@2x.png', 'upload_image/partner/partner_a578a483199d9babd0c47f14073febce@1x.png', NULL, NULL, NULL, NULL, 1),
(41, 61, 'image', 'partner_03bf85b2097a29064376d039a136766c.png', '森林島嶼', NULL, 'upload_image/partner/partner_03bf85b2097a29064376d039a136766c@2x.png', 'upload_image/partner/partner_03bf85b2097a29064376d039a136766c@1x.png', NULL, NULL, NULL, NULL, 1),
(42, 64, 'image', 'indexVideo_7838332a1164fed3bbabd20685c31e57.jpg', '當塵埃淹沒天際：KAY SAGE，深嵌於生命底層的孤獨印象', NULL, 'upload_image/indexVideo/indexVideo_7838332a1164fed3bbabd20685c31e57.jpg', 'upload_image/indexVideo/indexVideo_7838332a1164fed3bbabd20685c31e57_s100.jpg', NULL, NULL, NULL, NULL, 1),
(42, 65, 'imageMobile', 'indexVideoMobile_d3e24ad4b05e0d8171dcd85e27468e3a.jpg', '當塵埃淹沒天際：KAY SAGE，深嵌於生命底層的孤獨印象', NULL, 'upload_image/indexVideoMobile/indexVideoMobile_d3e24ad4b05e0d8171dcd85e27468e3a.jpg', 'upload_image/indexVideoMobile/indexVideoMobile_d3e24ad4b05e0d8171dcd85e27468e3a_s100.jpg', NULL, NULL, NULL, NULL, 1),
(7, 69, 'image', 'banners_9f6b86894322b5c75ee95e7496f38e9b.jpg', NULL, NULL, 'upload_image/banners/banners_9f6b86894322b5c75ee95e7496f38e9b.jpg', 'upload_image/banners/banners_9f6b86894322b5c75ee95e7496f38e9b_s100.jpg', NULL, NULL, NULL, NULL, 1),
(6, 70, 'image', 'banners_5ae60e6ca135d11b0c3dc3855b677c6e.jpg', NULL, NULL, 'upload_image/banners/banners_5ae60e6ca135d11b0c3dc3855b677c6e.jpg', 'upload_image/banners/banners_5ae60e6ca135d11b0c3dc3855b677c6e_s100.jpg', NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `member_set`
--

CREATE TABLE IF NOT EXISTS `member_set` (
  `m_id` int(11) NOT NULL,
  `m_class2` tinytext COLLATE utf8_unicode_ci,
  `m_class3` tinytext COLLATE utf8_unicode_ci,
  `m_name` tinytext COLLATE utf8_unicode_ci,
  `m_account` tinytext COLLATE utf8_unicode_ci,
  `m_password` text COLLATE utf8_unicode_ci,
  `m_gender` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_birthyear` tinytext COLLATE utf8_unicode_ci,
  `m_birthmonth` tinytext COLLATE utf8_unicode_ci,
  `m_birthday` tinytext COLLATE utf8_unicode_ci,
  `m_email` tinytext COLLATE utf8_unicode_ci,
  `m_phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_cellphone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_zip` int(11) DEFAULT NULL,
  `m_city` tinytext COLLATE utf8_unicode_ci,
  `m_canton` tinytext COLLATE utf8_unicode_ci,
  `m_address` tinytext COLLATE utf8_unicode_ci,
  `m_content` text COLLATE utf8_unicode_ci COMMENT '農友簡介',
  `m_sn` tinytext COLLATE utf8_unicode_ci COMMENT '綠生生產履歷編號',
  `m_fname` tinytext COLLATE utf8_unicode_ci COMMENT '產銷班或農場名稱',
  `m_item` text COLLATE utf8_unicode_ci COMMENT '主要生產項目',
  `m_faddress` tinytext COLLATE utf8_unicode_ci COMMENT '農地位置',
  `m_fzip` int(11) DEFAULT NULL,
  `m_fcity` tinytext COLLATE utf8_unicode_ci,
  `m_fcanton` tinytext COLLATE utf8_unicode_ci,
  `m_area` tinytext COLLATE utf8_unicode_ci COMMENT '栽培總面積',
  `m_map` text COLLATE utf8_unicode_ci COMMENT 'google map code',
  `m_epaper` tinyint(4) DEFAULT '0',
  `m_level` tinyint(4) DEFAULT '2',
  `m_active` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `menu_id` int(12) unsigned NOT NULL,
  `menu_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_use` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_pageTitle1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_pageTitle2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_pageTitle3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_pageTitle4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_pageTitle5` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_title`, `menu_link`, `menu_use`, `menu_pageTitle1`, `menu_pageTitle2`, `menu_pageTitle3`, `menu_pageTitle4`, `menu_pageTitle5`) VALUES
(1, 'authority', 'authority_list.php', '#main_menu_1', '權限管理-列表', '權限管理-新增', '權限管理-修改', '權限管理-刪除', NULL),
(2, 'banners', 'banners_list.php', '#main_menu_2', '首頁Banner廣告-列表', '首頁Banner廣告-新增', '首頁Banner廣告-修改', '首頁Banner廣告-刪除', NULL),
(3, 'articleT', 'articleT_list.php', '#main_menu_3', '列表', '新增', '修改', '刪除', NULL),
(4, 'article', 'article_list.php', '#main_menu_4', '-列表', '-新增', '-修改', '-刪除', NULL),
(5, 'author', 'author_list.php', '#main_menu_5', '-列表', '-新增', '-修改', '-刪除', NULL),
(6, 'events', 'events_list.php', '#main_menu_6', '-列表', '-修改', '-刪除', NULL, NULL),
(7, 'partner', 'partner_list.php', '#main_menu_7', '-列表', '-修改', '-刪除', NULL, NULL),
(8, 'about', 'about_list', '#main_menu_8', NULL, NULL, NULL, NULL, NULL),
(9, 'clause', 'clause_list', '#main_menu_9', NULL, NULL, NULL, NULL, NULL),
(10, 'weneedu', 'weneedu_list', '#main_menu_10', NULL, NULL, NULL, NULL, NULL),
(11, 'articleTag', 'articleTag_list', '#main_menu_11', NULL, NULL, NULL, NULL, NULL),
(12, 'epaper', 'epaper_list', '#main_menu_12', NULL, NULL, NULL, NULL, NULL),
(13, 'download', 'download_list', '#main_menu_13', NULL, NULL, NULL, NULL, NULL),
(14, 'farmer', 'farmer_list', '#main_menu_14', NULL, NULL, NULL, NULL, NULL),
(15, 'shopProcess', 'shopProcess_list', '#main_menu_15', NULL, NULL, NULL, NULL, NULL),
(16, 'message', 'message_list', '#main_menu_16', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `message_set`
--

CREATE TABLE IF NOT EXISTS `message_set` (
  `m_id` int(10) unsigned NOT NULL,
  `m_d_id` int(10) unsigned NOT NULL DEFAULT '0',
  `m_title` text COLLATE utf8_unicode_ci,
  `m_content` text COLLATE utf8_unicode_ci,
  `m_date` datetime DEFAULT NULL,
  `m_name` text COLLATE utf8_unicode_ci,
  `m_email` text COLLATE utf8_unicode_ci,
  `m_type` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_ip` tinytext COLLATE utf8_unicode_ci,
  `m_m_id` int(11) DEFAULT NULL,
  `m_rem_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `tab_set`
--

CREATE TABLE IF NOT EXISTS `tab_set` (
  `tab_d_id` int(11) DEFAULT '0',
  `tab_id` int(11) NOT NULL,
  `tab_type` tinytext COLLATE utf8_unicode_ci,
  `tab_title` tinytext COLLATE utf8_unicode_ci,
  `tab_content` text COLLATE utf8_unicode_ci,
  `tab_data1` text COLLATE utf8_unicode_ci,
  `tab_sort` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `tab_set`
--

INSERT INTO `tab_set` (`tab_d_id`, `tab_id`, `tab_type`, `tab_title`, `tab_content`, `tab_data1`, `tab_sort`) VALUES
(28, 6, 'clauseSection', '版權聲明', 'Copyright', 'Copyright © 2017 薰衣草森林股份有限公司. All rights reserved. 版權所有，禁止擅自轉貼節錄', 1),
(28, 7, 'clauseSection', '內容版權', 'Content copyright', '內容授權來源主要由個人創作、合作媒體提供之內容、及網友投稿之內容，皆會標明出處及來源。相關作品引用請標明出處，全文引用請來信或洽詢原作者，如相關內容不宜請來信告知，我們將下架處理。', 2),
(28, 8, 'clauseSection', '隱私權政策', 'Privacy policy', '《故事森林》為「薰衣草森林股份有限公司」所經營，為了尊重個人隱私保護，聲明下列要點，向所有使用者說明薰衣草森林之相關企業之隱私權保護政策。我們希望您清楚瞭解我們使用資訊的方式，以及我們保障您隱私權的各種措施。\r\n\r\n當您瀏覽《故事森林》網站，即表示您已閱讀、瞭解並同意接受本政策之所有內容。薰衣草森林之相關企業有權於任何時間修改或變更本政策之內容。建議您隨時注意該等修改或變更。對您個人資料的蒐集，謹遵守中華民國「個人資料保護法」之規範。', 3),
(28, 9, 'clauseSection', '一、在使用者同意下提供的個人資料', NULL, '向您蒐集之個人資料，將僅限使用於與薰衣草森林之相關企業合於營業登記項目或章程所載及業務需要之客戶管理、行銷及營業範圍內相關服務使用，期限自取得起使日至特定目的終止日為止。例如，您註冊為《故事森林》會員、在森林島嶼購物、在緩慢民宿網站訂購房間、使用相關服務或參加其他活動時，為了便於和使用者連繫、完成交易、提供服務、處理訂房或訂購程序、以及增加對會員的了解，以提供更好的服務，《故事森林》網站會將您的會員資料提供給薰衣草森林之相關企業網站使用。', 4),
(28, 10, 'clauseSection', '二、網頁的使用與變更', NULL, '您在《故事森林》網站的互動服務上，可自由填寫電子郵件信箱的地址，以供互動及溝通之用途。這個資訊可能經由網路傳播被其他網友者利用，此類行為非本網站所能控制，若造成您的困擾，薰衣草森林之相關企業並不對此負責。\r\n\r\n《故事森林》網站為服務網友，在部分網頁中會提供相關網站的連結，網友可藉由這些連結，直接點選到感興趣的網站，但是本網站不負責保護網友在這些經由本網站而連結到訪的網站中的隱私權。', 5),
(28, 11, 'clauseSection', '三、與我們連絡', NULL, '如果您對《故事森林》的隱私權政策或與個人資料有任何疑問，歡迎您聯絡反應：Mail：service@lavendercottage.com.tw。您亦可拒絕提供相關之個人資料，惟可能無法及時享有《故事森林》提供之相關活動與獲取各項資訊之權利。', 6),
(31, 12, 'weneeduSection', '森林夥伴的精神是什麼', 'What is the spirit of the forest partner', '作為深信公共性的書寫平台，我們歡迎多元意見表態，促成更好的知識傳遞與交流，森林夥伴的精神是，\r\n\r\n尊重多元：思辨的目的是為了開啟多元空間，我們邀請你為深信的信念辯護，也傾聽與自己不同意見的聲音。\r\n\r\n知識含量：知識是基石，鍛鍊獨立思考，不急著批判反對，而要反覆思辨，從知識走出一條行動之路。\r\n\r\n以人為本：事件是死的，而人是活的，永遠以人為核心，長出報導的溫暖生命。', 1),
(31, 13, 'weneeduSection', '最後的最後，與你相遇的投稿流程', 'The last of the last, with you to meet the submission flow', '如果你也期待跟故事森林相遇，想成為書寫深度評論的森林夥伴，你可以這麼做，\r\n\r\n投稿流程：請投稿至 content@Goodwill stories，並且在信件標題寫下【投稿森林夥伴，我是 ＿＿＿ 】，用夾帶檔案附上你的文稿。（若是同時能附上多篇，我們也能直接針對文稿特色做建議與討論）\r\n\r\n若稿件經採用，編輯將於一週內回覆，給予文章修改回饋。若稿件未經採用，我們會於兩週內統一回覆。', 2),
(31, 14, 'weneeduSection', '長期徵稿', 'Long solicitation', '《故事森林》歡迎您投稿關於旅行、土地、人物、文化、食育、愛、藝術等七個主題的文章，邀請您以文字搭配照片或影片，分享生活中美好的感動。讓您的故事成為一顆種子，茁壯出森林中的一方風景；不管是小小的一段文字、一張照片、甚至一句話，都能在思想的漣漪裡發酵，影響來自各方的旅人們。', 3),
(31, 15, 'weneeduSection', '主題徵稿', 'Topical contributions', '除了長期徵稿之外，《故事森林》每個時節都有特定的徵稿主題，邀請您由不同的觀點發想，用文字與我們共築一片美好森林。\r\n\r\n來稿請以 Office Word 寄到《故事森林》信箱102556@lavendercottage.com\r\n建議字數為1,000字左右（搭配三到五張以上的照片或十分鐘內的影片），但仍保持您的創作彈性，文章可以是數百字的短篇或兩千字內的中篇甚至字數更多的長篇，重點是能把您的感動清楚傳遞，來稿請於文末附上100字內的作者自介。\r\n\r\n若附件有文章相關的照片、圖片或影片作品，圖片附檔格式請為 jpg.或 png.，並附上簡單說明，我們會註明授權來自該作者的創作；圖像影片若非您的作品，請告知我們圖片、影片來源，以便判定使用權限，讀者投書稿件，《故事森林》保有更改標題和選擇是否刊登的權利，一旦刊登，您投稿的文章會出現在《故事森林》網站、APP、與相關的FB專頁，以及與故事森林有合作關係的媒體平台，讓更多讀者看見您用心寫下的故事。當您長期投稿，刊登了五篇作品後，我們會邀請您成為《故事森林》的駐站作家，為特別的您留下一個專屬的故事舞台。\r\n\r\n這世界，其實比我們想像中溫暖的多，別讓好故事寂寞。', 4);

-- --------------------------------------------------------

--
-- 資料表結構 `terms`
--

CREATE TABLE IF NOT EXISTS `terms` (
  `term_id` bigint(20) unsigned NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_en` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `term_group` bigint(10) NOT NULL DEFAULT '0',
  `term_active` tinyint(2) NOT NULL DEFAULT '1',
  `term_sort` int(11) DEFAULT '1',
  `term_recommend` int(11) DEFAULT '0' COMMENT '推薦文章分類'
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `terms`
--

INSERT INTO `terms` (`term_id`, `name`, `name_en`, `slug`, `term_group`, `term_active`, `term_sort`, `term_recommend`) VALUES
(1, '旅行', 'Travel', '%E6%97%85%E8%A1%8C', 0, 1, 1, 1),
(2, '土地', 'Land', '%E5%9C%9F%E5%9C%B0', 0, 1, 2, 1),
(3, '人物', 'People', '%E4%BA%BA%E7%89%A9', 0, 1, 3, 0),
(4, '文化', 'Culture', '%E6%96%87%E5%8C%96', 0, 1, 4, 1),
(5, '藝術', 'Art', '%E8%97%9D%E8%A1%93', 0, 1, 5, 1),
(6, '好食', 'Diet', '%E5%A5%BD%E9%A3%9F', 0, 1, 6, 0),
(7, '愛', 'Love', '%E6%84%9B', 0, 1, 7, 0),
(8, '專欄作家', 'Columnist', '%E5%B0%88%E6%AC%84%E4%BD%9C%E5%AE%B6', 0, 1, 1, 0),
(9, '撰稿作家', 'Guest Writer', '%E6%92%B0%E7%A8%BF%E4%BD%9C%E5%AE%B6', 0, 1, 2, 0),
(10, '輕旅行', 'Trip', '%E8%BC%95%E6%97%85%E8%A1%8C', 0, 1, 1, 0),
(12, '一日遊', NULL, '%E4%B8%80%E6%97%A5%E9%81%8A', 0, 1, 1, 0),
(13, '愛護大地', 'myplace', '%E6%84%9B%E8%AD%B7%E5%A4%A7%E5%9C%B0', 0, 1, 2, 0),
(14, '時光的純釀', 'Time of pure brewing', '%E6%99%82%E5%85%89%E7%9A%84%E7%B4%94%E9%87%80', 0, 1, 1, 0),
(15, '點亮日常', ' Light up everyday', '%E9%BB%9E%E4%BA%AE%E6%97%A5%E5%B8%B8', 0, 1, 2, 0),
(16, '仰望夢想', 'Look up to the dream', '%E4%BB%B0%E6%9C%9B%E5%A4%A2%E6%83%B3', 0, 1, 1, 0),
(17, '哲學視角', ' Philosophical perspective', '%E5%93%B2%E5%AD%B8%E8%A6%96%E8%A7%92', 0, 1, 2, 0),
(18, '微笑的力量', 'The power of smile', '%E5%BE%AE%E7%AC%91%E7%9A%84%E5%8A%9B%E9%87%8F', 0, 1, 1, 0),
(19, '城市色彩', 'City colors', '%E5%9F%8E%E5%B8%82%E8%89%B2%E5%BD%A9', 0, 1, 2, 0),
(20, '感知台灣', ' Perceive Taiwan', '%E6%84%9F%E7%9F%A5%E5%8F%B0%E7%81%A3', 0, 1, 1, 0),
(21, '共下學好食', 'A total of good food', '%E5%85%B1%E4%B8%8B%E5%AD%B8%E5%A5%BD%E9%A3%9F', 0, 1, 2, 0),
(22, '品嚐滋味', ' Taste the taste', '%E5%93%81%E5%9A%90%E6%BB%8B%E5%91%B3', 0, 1, 1, 0),
(23, '關係日記', 'Relationship diary', '%E9%97%9C%E4%BF%82%E6%97%A5%E8%A8%98', 0, 1, 2, 0),
(24, '一個人的派對', 'A person''s party', '%E4%B8%80%E5%80%8B%E4%BA%BA%E7%9A%84%E6%B4%BE%E5%B0%8D', 0, 1, 1, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `term_relationships`
--

CREATE TABLE IF NOT EXISTS `term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `term_relationships`
--

INSERT INTO `term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(8, 1, 1),
(9, 2, 1),
(10, 3, 1),
(12, 5, 1),
(13, 6, 1),
(14, 7, 1),
(15, 1, 1),
(16, 2, 1),
(17, 3, 1),
(18, 4, 1),
(19, 5, 1),
(20, 6, 1),
(21, 7, 1),
(22, 9, 1),
(24, 12, 0),
(45, 12, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `term_taxonomy`
--

CREATE TABLE IF NOT EXISTS `term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) COLLATE utf8_unicode_ci DEFAULT '',
  `description` longtext COLLATE utf8_unicode_ci,
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `term_taxonomy`
--

INSERT INTO `term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'articleT', NULL, 0, 0),
(2, 2, 'articleT', NULL, 0, 0),
(3, 3, 'articleT', NULL, 0, 0),
(4, 4, 'articleT', NULL, 0, 0),
(5, 5, 'articleT', NULL, 0, 0),
(6, 6, 'articleT', NULL, 0, 0),
(7, 7, 'articleT', NULL, 0, 0),
(8, 8, 'authorT', NULL, 0, 0),
(9, 9, 'authorT', NULL, 0, 0),
(10, 10, 'articleSubT', NULL, 1, 0),
(11, 12, 'articleTag', NULL, 0, 0),
(12, 13, 'articleSubT', NULL, 2, 0),
(13, 14, 'articleSubT', NULL, 2, 0),
(14, 15, 'articleSubT', NULL, 3, 0),
(15, 16, 'articleSubT', NULL, 3, 0),
(16, 17, 'articleSubT', NULL, 4, 0),
(17, 18, 'articleSubT', NULL, 4, 0),
(18, 19, 'articleSubT', NULL, 5, 0),
(19, 20, 'articleSubT', NULL, 5, 0),
(20, 21, 'articleSubT', NULL, 6, 0),
(21, 22, 'articleSubT', NULL, 6, 0),
(22, 23, 'articleSubT', NULL, 7, 0),
(23, 24, 'articleSubT', NULL, 7, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `vitae_set`
--

CREATE TABLE IF NOT EXISTS `vitae_set` (
  `v_id` int(11) NOT NULL,
  `v_d_id` int(11) DEFAULT NULL,
  `v_class1` tinytext COLLATE utf8_unicode_ci,
  `v_name` tinytext COLLATE utf8_unicode_ci,
  `v_gender` tinyint(4) DEFAULT NULL,
  `v_phone` tinytext COLLATE utf8_unicode_ci,
  `v_ages` tinytext COLLATE utf8_unicode_ci,
  `v_email` text COLLATE utf8_unicode_ci,
  `v_address` text COLLATE utf8_unicode_ci,
  `v_content` text COLLATE utf8_unicode_ci,
  `v_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `webcount`
--

CREATE TABLE IF NOT EXISTS `webcount` (
  `count_id` int(11) NOT NULL,
  `visitors_times` int(11) DEFAULT '0',
  `count_ip` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `count_time` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `webcount`
--

INSERT INTO `webcount` (`count_id`, `visitors_times`, `count_ip`, `count_time`) VALUES
(1, 1477542, NULL, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `zipcode`
--

CREATE TABLE IF NOT EXISTS `zipcode` (
  `Id` bigint(20) NOT NULL,
  `City` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Area` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ZipCode` char(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `c_id` int(11) DEFAULT NULL COMMENT '對應縣市',
  `z_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `address_book_set`
--
ALTER TABLE `address_book_set`
  ADD PRIMARY KEY (`a_id`);

--
-- 資料表索引 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`user_id`);

--
-- 資料表索引 `admin_log`
--
ALTER TABLE `admin_log`
  ADD PRIMARY KEY (`log_id`);

--
-- 資料表索引 `a_set`
--
ALTER TABLE `a_set`
  ADD PRIMARY KEY (`a_id`);

--
-- 資料表索引 `class_set`
--
ALTER TABLE `class_set`
  ADD PRIMARY KEY (`c_id`);

--
-- 資料表索引 `data_set`
--
ALTER TABLE `data_set`
  ADD PRIMARY KEY (`d_id`);

--
-- 資料表索引 `file_set`
--
ALTER TABLE `file_set`
  ADD PRIMARY KEY (`file_id`);

--
-- 資料表索引 `member_set`
--
ALTER TABLE `member_set`
  ADD PRIMARY KEY (`m_id`);

--
-- 資料表索引 `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- 資料表索引 `message_set`
--
ALTER TABLE `message_set`
  ADD PRIMARY KEY (`m_id`);

--
-- 資料表索引 `tab_set`
--
ALTER TABLE `tab_set`
  ADD PRIMARY KEY (`tab_id`);

--
-- 資料表索引 `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`term_id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `name` (`name`);

--
-- 資料表索引 `term_relationships`
--
ALTER TABLE `term_relationships`
  ADD PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  ADD KEY `term_taxonomy_id` (`term_taxonomy_id`);

--
-- 資料表索引 `term_taxonomy`
--
ALTER TABLE `term_taxonomy`
  ADD PRIMARY KEY (`term_taxonomy_id`),
  ADD UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  ADD KEY `taxonomy` (`taxonomy`);

--
-- 資料表索引 `vitae_set`
--
ALTER TABLE `vitae_set`
  ADD PRIMARY KEY (`v_id`);

--
-- 資料表索引 `webcount`
--
ALTER TABLE `webcount`
  ADD PRIMARY KEY (`count_id`);

--
-- 資料表索引 `zipcode`
--
ALTER TABLE `zipcode`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `City` (`City`,`Area`,`ZipCode`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `address_book_set`
--
ALTER TABLE `address_book_set`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `admin`
--
ALTER TABLE `admin`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- 使用資料表 AUTO_INCREMENT `admin_log`
--
ALTER TABLE `admin_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- 使用資料表 AUTO_INCREMENT `a_set`
--
ALTER TABLE `a_set`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- 使用資料表 AUTO_INCREMENT `class_set`
--
ALTER TABLE `class_set`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `data_set`
--
ALTER TABLE `data_set`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- 使用資料表 AUTO_INCREMENT `file_set`
--
ALTER TABLE `file_set`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=72;
--
-- 使用資料表 AUTO_INCREMENT `member_set`
--
ALTER TABLE `member_set`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(12) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- 使用資料表 AUTO_INCREMENT `message_set`
--
ALTER TABLE `message_set`
  MODIFY `m_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `tab_set`
--
ALTER TABLE `tab_set`
  MODIFY `tab_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- 使用資料表 AUTO_INCREMENT `terms`
--
ALTER TABLE `terms`
  MODIFY `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- 使用資料表 AUTO_INCREMENT `term_taxonomy`
--
ALTER TABLE `term_taxonomy`
  MODIFY `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- 使用資料表 AUTO_INCREMENT `vitae_set`
--
ALTER TABLE `vitae_set`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `webcount`
--
ALTER TABLE `webcount`
  MODIFY `count_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- 使用資料表 AUTO_INCREMENT `zipcode`
--
ALTER TABLE `zipcode`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 13, 2015 at 12:22 PM
-- Server version: 5.5.20
-- PHP Version: 5.2.9-2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `derdao`
--

-- --------------------------------------------------------

--
-- Table structure for table `address_book_set`
--

CREATE TABLE IF NOT EXISTS `address_book_set` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `a_date` datetime DEFAULT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_password` tinytext COLLATE utf8_unicode_ci,
  `user_level` int(4) DEFAULT NULL,
  `user_limit` tinyint(4) DEFAULT '2',
  `user_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_id`, `user_name`, `user_password`, `user_level`, `user_limit`, `user_active`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1, 1),
(2, 'ccc', '9df62e693988eb4e1e1444ece0578579', 2, 2, 1),
(3, 'tester', 'f5d1278e8109edd94e1e4197e04873b9', 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `a_set`
--

CREATE TABLE IF NOT EXISTS `a_set` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_title` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `a_1` tinyint(4) DEFAULT NULL,
  `a_2` tinyint(4) DEFAULT NULL,
  `a_3` tinyint(4) DEFAULT NULL,
  `a_4` tinyint(4) DEFAULT NULL,
  `a_5` tinyint(4) DEFAULT NULL,
  `a_6` tinyint(4) DEFAULT NULL,
  `a_7` tinyint(4) DEFAULT NULL,
  `a_8` tinyint(4) DEFAULT NULL,
  `a_9` tinyint(4) DEFAULT NULL,
  `a_10` tinyint(4) DEFAULT NULL,
  `a_11` tinyint(4) DEFAULT NULL,
  `a_12` tinyint(4) DEFAULT NULL,
  `a_13` tinyint(4) DEFAULT NULL,
  `a_14` tinyint(4) DEFAULT NULL,
  `a_15` tinyint(4) DEFAULT NULL,
  `a_16` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `a_set`
--

INSERT INTO `a_set` (`a_id`, `a_title`, `a_1`, `a_2`, `a_3`, `a_4`, `a_5`, `a_6`, `a_7`, `a_8`, `a_9`, `a_10`, `a_11`, `a_12`, `a_13`, `a_14`, `a_15`, `a_16`) VALUES
(1, '系統管理員', 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '資料更新員', 0, 1, 1, 1, 1, 1, 0, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `baskets`
--

CREATE TABLE IF NOT EXISTS `baskets` (
  `basketID` int(11) NOT NULL AUTO_INCREMENT,
  `basketSession` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `productID` int(11) DEFAULT NULL,
  `name` tinytext COLLATE utf8_unicode_ci,
  `qty` tinytext COLLATE utf8_unicode_ci,
  `serial_num` tinytext COLLATE utf8_unicode_ci,
  `price_status` tinyint(2) DEFAULT NULL,
  `dir_price` int(11) DEFAULT '0',
  `coll_price_1` int(11) DEFAULT '0',
  `coll_price_2` int(11) DEFAULT '0',
  `coll_price_3` int(11) DEFAULT '0',
  `coll_price_4` int(11) DEFAULT '0',
  `coll_tiem_1` int(11) DEFAULT '0',
  `coll_tiem_2` int(11) DEFAULT '0',
  `coll_tiem_3` int(11) DEFAULT '0',
  `coll_tiem_4` int(11) DEFAULT '0',
  `discount` int(11) DEFAULT '0',
  `discount_num` int(11) DEFAULT '0',
  `freight` int(11) DEFAULT '1',
  `freight_costs` int(11) DEFAULT '0',
  `assembly_costs` int(11) DEFAULT '0',
  `delivery_fee` int(11) DEFAULT '0',
  `weight` int(11) DEFAULT '0',
  `subtotal` int(11) DEFAULT '0',
  PRIMARY KEY (`basketID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `class_set`
--

CREATE TABLE IF NOT EXISTS `class_set` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_title` tinytext COLLATE utf8_unicode_ci,
  `c_content` text COLLATE utf8_unicode_ci,
  `c_class` tinytext COLLATE utf8_unicode_ci,
  `c_link` tinytext COLLATE utf8_unicode_ci,
  `c_level` tinyint(4) DEFAULT NULL,
  `c_active` tinyint(1) NOT NULL DEFAULT '1',
  `c_parent` tinytext COLLATE utf8_unicode_ci,
  `c_sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `class_set`
--

INSERT INTO `class_set` (`c_id`, `c_title`, `c_content`, `c_class`, `c_link`, `c_level`, `c_active`, `c_parent`, `c_sort`) VALUES
(1, '海鮮', NULL, NULL, NULL, NULL, 1, 'newsC', 1),
(2, '美食', NULL, NULL, NULL, NULL, 1, 'newsC', 2);

-- --------------------------------------------------------

--
-- Table structure for table `data_set`
--

CREATE TABLE IF NOT EXISTS `data_set` (
  `d_id` int(11) NOT NULL AUTO_INCREMENT,
  `d_title` tinytext COLLATE utf8_unicode_ci,
  `d_content` text COLLATE utf8_unicode_ci,
  `d_class1` tinytext COLLATE utf8_unicode_ci,
  `d_class2` text COLLATE utf8_unicode_ci,
  `d_class3` text COLLATE utf8_unicode_ci,
  `d_class4` text COLLATE utf8_unicode_ci,
  `d_class5` text COLLATE utf8_unicode_ci,
  `d_class6` text COLLATE utf8_unicode_ci,
  `d_tag` text COLLATE utf8_unicode_ci,
  `d_price1` int(11) DEFAULT '0',
  `d_price2` int(11) DEFAULT '0',
  `d_price3` int(11) DEFAULT '0',
  `d_inventory` tinyint(4) DEFAULT '0',
  `d_sale` tinyint(1) DEFAULT '0',
  `d_new_product` tinyint(1) DEFAULT '0',
  `d_date` datetime DEFAULT NULL,
  `d_active` tinyint(1) DEFAULT '1',
  `d_sort` int(11) DEFAULT '1',
  PRIMARY KEY (`d_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `data_set`
--

INSERT INTO `data_set` (`d_id`, `d_title`, `d_content`, `d_class1`, `d_class2`, `d_class3`, `d_class4`, `d_class5`, `d_class6`, `d_tag`, `d_price1`, `d_price2`, `d_price3`, `d_inventory`, `d_sale`, `d_new_product`, `d_date`, `d_active`, `d_sort`) VALUES
(1, 'Banner1', NULL, 'banners', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2015-09-04 08:00:14', 1, 1),
(2, 'Banner2', NULL, 'banners', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, '2015-09-04 08:05:26', 1, 2),
(3, 'Banner3', NULL, 'banners', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, '2015-09-04 08:07:57', 1, 3),
(4, 'Banner4', NULL, 'banners', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, '2015-09-04 08:08:17', 1, 4),
(5, 'Banner5', NULL, 'banners', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, '2015-09-04 08:08:38', 1, 5),
(7, '關於我們', '『合發』之後的每艘船，川爸都取名叫『新合發』。這三個字也是身為川爸子女的我們童年最期望看到的。小時候的我們都瘦的像猴子，因為我們有小朋友的通病：挑食。在資源匱乏的小漁村，除了雜貨店的『乖乖』和『科學麵』，能吃的東西就只有魚。魚要好吃，就要新鮮。川爸為了讓我們不挑食，只好絞盡腦汁提供最『青』的魚。先換艘馬力大一點的船吧！『合發』雖然輕薄短小又具有歷史意義，但它的速度實在有點慢。再『青』的魚透過引擎冒黑煙的『合發 』長時間運送，到我們餐桌時也『青』不起來了。', 'about', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2015-09-04 08:23:42', 1, 1),
(8, '聯絡我們', '雲林縣口湖鄉成龍村成龍197號', 'contact', '23.5593433,120.1685486', '05-797-2153', NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2015-09-04 09:27:35', 1, 1),
(10, '番仔挖烏魚子介紹', '<p><img src="../source/news-list2.png" alt="" width="805" height="480" /><br /><br />『合發』之後的每艘船，川爸都取名叫『新合發』。這三個字也是身為川爸子女的我們童年最期望看到的。小時候的我們都瘦的像猴子，因為我們有小朋友的通病：挑食。在資源匱乏的小漁村，除了雜貨店的『乖乖』和『科學麵』，能吃的東西就只有魚。魚要好吃，就要新鮮。川爸為了讓我們不挑食，只好絞盡腦汁提供最『青』的魚。先換艘馬力大一點的船吧！『合發』雖然輕薄短小又具有歷史意義，但它的速度實在有點慢。再『青』的魚透過引擎冒黑煙的『合發 』長時間運送，到我們餐桌時也『青』不起來了。</p>', 'news', '1', '2015', NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, '2015-09-09 06:27:00', 1, 1),
(11, '番仔挖烏魚子介紹', '<p><img src="../source/news-list.png" alt="" width="805" height="480" /><br /><br /> 『合發』之後的每艘船，川爸都取名叫『新合發』。這三個字也是身為川爸子女的我們童年最期望看到的。小時候的我們都瘦的像猴子，因為我們有小朋友的通病：挑食。在資源匱乏的小漁村，除了雜貨店的『乖乖』和『科學麵』，能吃的東西就只有魚。魚要好吃，就要新鮮。川爸為了讓我們不挑食，只好絞盡腦汁提供最『青』的魚。先換艘馬力大一點的船吧！『合發』雖然輕薄短小又具有歷史意義，但它的速度實在有點慢。再『青』的魚透過引擎冒黑煙的『合發 』長時間運送，到我們餐桌時也『青』不起來了。</p>', 'news', '1', '2014', NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, '2014-09-08 06:27:59', 1, 2),
(12, '鮪魚檢驗報告', '<p><img src="../source/news-list.png" alt="" width="805" height="480" /><br /><br /> <img src="../source/news-list2.png" alt="" width="805" height="480" /><br /><br /></p>\r\n<p>『合發』之後的每艘船，川爸都取名叫『新合發』。這三個字也是身為川爸子女的我們童年最期望看到的。小時候的我們都瘦的像猴子，因為我們有小朋友的通病：挑食。在資源匱乏的小漁村，除了雜貨店的『乖乖』和『科學麵』，能吃的東西就只有魚。魚要好吃，就要新鮮。川爸為了讓我們不挑食，只好絞盡腦汁提供最『青』的魚。先換艘馬力大一點的船吧！『合發』雖然輕薄短小又具有歷史意義，但它的速度實在有點慢。再『青』的魚透過引擎冒黑煙的『合發 』長時間運送，到我們餐桌時也『青』不起來了。</p>', 'news', '2', '2015', NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2015-09-07 06:29:13', 1, 1),
(13, '番仔挖烏魚子 - 五兩一片', '<p><img src="../source/detail-img1.png" alt="" width="750" height="532" /></p>\r\n<p><img src="../source/detail-img2.png" alt="" width="750" height="532" /><br /><img src="../source/detail-img3.png" alt="" width="750" height="532" /></p>', 'products', '2', '<p class="notep">成分：烏魚子、鹽</p>\r\n<p class="notep">產地：彰化芳苑</p>\r\n<p class="notep">重量：187g &plusmn; 5%</p>\r\n<p class="notep">保存方式：冷凍</p>\r\n<p class="notep">保存期限：180天</p>\r\n<p class="notep">商品圖片僅供參考</p>\r\n<p class="notep">歡迎來電團購</p>\r\n<p class="notep">購物滿3,000元，免運</p>', '<p class="notep2">烏魚子冷凍過後呈土黃色為正常現象，待退冰過後便會還原成琥珀色</p>\r\n<p class="notep2">開封後，如未食用完畢，請以保鮮膜封存於冰箱</p>', NULL, NULL, '2', 1390, 999, 0, 0, 0, 0, '2015-09-09 07:27:47', 1, 1),
(17, '番仔挖烏魚子 - 六兩一片', '<p><img src="../source/detail-img3.png" alt="" width="750" height="532" /></p>\r\n<p><img src="../source/detail-img1.png" alt="" width="750" height="532" /></p>\r\n<p><img src="../source/detail-img2.png" alt="" width="750" height="532" /></p>', 'products', '2', '<p class="notep">成分：烏魚子、鹽</p>\r\n<p class="notep">產地：彰化芳苑</p>\r\n<p class="notep">重量：187g &plusmn; 5%</p>\r\n<p class="notep">保存方式：冷凍</p>\r\n<p class="notep">保存期限：180天</p>\r\n<p class="notep">商品圖片僅供參考</p>\r\n<p class="notep">歡迎來電團購</p>\r\n<p class="notep">購物滿3,000元，免運</p>', '<p class="notep2">烏魚子冷凍過後呈土黃色為正常現象，待退冰過後便會還原成琥珀色</p>\r\n<p class="notep2">開封後，如未食用完畢，請以保鮮膜封存於冰箱</p>', NULL, NULL, '2', 1580, 40, 0, 0, 0, 0, '2015-09-09 08:00:42', 1, 1),
(18, '烏魚子 - 五兩二片', '<p><img src="../source/detail-img2.png" alt="" width="750" height="532" /></p>\r\n<p><img src="../source/detail-img1.png" alt="" width="750" height="532" /></p>\r\n<p><img src="../source/detail-img3.png" alt="" width="750" height="532" /></p>', 'products', '3', '<p class="notep">成分：烏魚子、鹽</p>\r\n<p class="notep">產地：彰化芳苑</p>\r\n<p class="notep">重量：187g &plusmn; 5%</p>\r\n<p class="notep">保存方式：冷凍</p>\r\n<p class="notep">保存期限：180天</p>\r\n<p class="notep">商品圖片僅供參考</p>\r\n<p class="notep">歡迎來電團購</p>\r\n<p class="notep">購物滿3,000元，免運</p>', '<p class="notep2">烏魚子冷凍過後呈土黃色為正常現象，待退冰過後便會還原成琥珀色</p>\r\n<p class="notep2">開封後，如未食用完畢，請以保鮮膜封存於冰箱</p>', NULL, NULL, '3', 1300, 100, 0, 0, 0, 0, '2015-09-09 08:02:20', 1, 1),
(19, '冷凍番仔挖烏魚子 - 五兩一片', '<p><img src="../source/detail-img1.png" alt="" width="750" height="532" /></p>\r\n<p><img src="../source/detail-img2.png" alt="" width="750" height="532" /></p>\r\n<p><img src="../source/detail-img3.png" alt="" width="750" height="532" /></p>', 'products', '1', '<p class="notep">成分：烏魚子、鹽</p>\r\n<p class="notep">產地：彰化芳苑</p>\r\n<p class="notep">重量：187g &plusmn; 5%</p>\r\n<p class="notep">保存方式：冷凍</p>\r\n<p class="notep">保存期限：180天</p>\r\n<p class="notep">商品圖片僅供參考</p>\r\n<p class="notep">歡迎來電團購</p>\r\n<p class="notep">購物滿3,000元，免運</p>', '<p class="notep2">烏魚子冷凍過後呈土黃色為正常現象，待退冰過後便會還原成琥珀色</p>\r\n<p class="notep2">開封後，如未食用完畢，請以保鮮膜封存於冰箱</p>', NULL, NULL, '1', 2100, 30, 0, 0, 0, 0, '2015-09-09 08:06:35', 1, 1),
(20, '冷凍番仔挖烏魚子 - 八兩一片', '<p><img src="../source/detail-img3.png" alt="" width="750" height="532" /></p>\r\n<p><img src="../source/detail-img1.png" alt="" width="750" height="532" /></p>\r\n<p><img src="../source/detail-img2.png" alt="" width="750" height="532" /></p>', 'products', '1', '<p class="notep">成分：烏魚子、鹽</p>\r\n<p class="notep">產地：彰化芳苑</p>\r\n<p class="notep">重量：187g &plusmn; 5%</p>\r\n<p class="notep">保存方式：冷凍</p>\r\n<p class="notep">保存期限：180天</p>\r\n<p class="notep">商品圖片僅供參考</p>\r\n<p class="notep">歡迎來電團購</p>\r\n<p class="notep">購物滿3,000元，免運</p>', '<p class="notep2">烏魚子冷凍過後呈土黃色為正常現象，待退冰過後便會還原成琥珀色</p>\r\n<p class="notep2">開封後，如未食用完畢，請以保鮮膜封存於冰箱</p>', NULL, NULL, '1', 3000, 20, 0, 0, 0, 0, '2015-09-11 15:04:56', 1, 1),
(21, '番仔挖烏魚子 - 十兩一包', '<p><img src="../source/detail-img3.png" alt="" width="750" height="532" /></p>\r\n<p><img src="../source/detail-img1.png" alt="" width="750" height="532" /></p>\r\n<p><img src="../source/detail-img2.png" alt="" width="750" height="532" /></p>', 'products', '3', '<p class="notep">成分：烏魚子、鹽</p>\r\n<p class="notep">產地：彰化芳苑</p>\r\n<p class="notep">重量：187g &plusmn; 5%</p>\r\n<p class="notep">保存方式：冷凍</p>\r\n<p class="notep">保存期限：180天</p>\r\n<p class="notep">商品圖片僅供參考</p>\r\n<p class="notep">歡迎來電團購</p>\r\n<p class="notep">購物滿3,000元，免運</p>', '<p class="notep2">烏魚子冷凍過後呈土黃色為正常現象，待退冰過後便會還原成琥珀色</p>\r\n<p class="notep2">開封後，如未食用完畢，請以保鮮膜封存於冰箱</p>', NULL, NULL, '3', 6000, 5, 0, 0, 0, 0, '2015-09-11 15:06:12', 1, 1),
(22, '番仔挖烏魚子 - 六兩六片', '<p><img src="../source/detail-img3.png" alt="" width="750" height="532" /></p>\r\n<p><img src="../source/detail-img1.png" alt="" width="750" height="532" /></p>\r\n<p><img src="../source/detail-img2.png" alt="" width="750" height="532" /></p>', 'products', '1', '<p class="notep">成分：烏魚子、鹽</p>\r\n<p class="notep">產地：彰化芳苑</p>\r\n<p class="notep">重量：187g &plusmn; 5%</p>\r\n<p class="notep">保存方式：冷凍</p>\r\n<p class="notep">保存期限：180天</p>\r\n<p class="notep">商品圖片僅供參考</p>\r\n<p class="notep">歡迎來電團購</p>\r\n<p class="notep">購物滿3,000元，免運</p>', '<p class="notep2">烏魚子冷凍過後呈土黃色為正常現象，待退冰過後便會還原成琥珀色</p>\r\n<p class="notep2">開封後，如未食用完畢，請以保鮮膜封存於冰箱</p>', NULL, NULL, '1', 1290, 20, 0, 0, 0, 0, '2015-09-11 15:07:26', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `epaper_set`
--

CREATE TABLE IF NOT EXISTS `epaper_set` (
  `e_id` int(11) NOT NULL AUTO_INCREMENT,
  `e_title` tinytext COLLATE utf8_unicode_ci,
  `e_content` text COLLATE utf8_unicode_ci,
  `e_class1` tinytext COLLATE utf8_unicode_ci,
  `e_class2` int(11) DEFAULT '0',
  `e_date` datetime DEFAULT NULL,
  `e_active` tinyint(2) DEFAULT '0',
  `e_sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`e_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `file_set`
--

CREATE TABLE IF NOT EXISTS `file_set` (
  `file_d_id` int(11) DEFAULT NULL,
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_type` tinytext COLLATE utf8_unicode_ci,
  `file_name` tinytext COLLATE utf8_unicode_ci,
  `file_title` tinytext COLLATE utf8_unicode_ci,
  `file_link1` tinytext COLLATE utf8_unicode_ci,
  `file_link2` tinytext COLLATE utf8_unicode_ci,
  `file_link3` tinytext COLLATE utf8_unicode_ci,
  `file_link4` tinytext COLLATE utf8_unicode_ci,
  `file_link5` tinytext COLLATE utf8_unicode_ci,
  `file_show_type` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=67 ;

--
-- Dumping data for table `file_set`
--

INSERT INTO `file_set` (`file_d_id`, `file_id`, `file_type`, `file_name`, `file_title`, `file_link1`, `file_link2`, `file_link3`, `file_link4`, `file_link5`, `file_show_type`) VALUES
(1, 2, 'image', 'banners_2.jpg', 'Banner1', 'upload_image/banners/banners_2.jpg', 'upload_image/banners/banners_2_s100.jpg', NULL, NULL, NULL, 1),
(2, 3, 'image', 'banners_3.jpg', 'Banner2', 'upload_image/banners/banners_3.jpg', 'upload_image/banners/banners_3_s100.jpg', NULL, NULL, NULL, 1),
(3, 4, 'image', 'banners_4.jpg', 'Banner3', 'upload_image/banners/banners_4.jpg', 'upload_image/banners/banners_4_s100.jpg', NULL, NULL, NULL, 1),
(4, 5, 'image', 'banners_5.jpg', 'Banner4', 'upload_image/banners/banners_5.jpg', 'upload_image/banners/banners_5_s100.jpg', NULL, NULL, NULL, 1),
(5, 6, 'image', 'banners_6.jpg', 'Banner5', 'upload_image/banners/banners_6.jpg', 'upload_image/banners/banners_6_s100.jpg', NULL, NULL, NULL, 1),
(7, 8, 'image', 'about_7.png', '關於我們', 'upload_image/about/about_7.png', 'upload_image/about/about_7_s100.png', NULL, NULL, NULL, 1),
(7, 11, 'image', 'about_11.jpg', '關於我們', 'upload_image/about/about_11.jpg', 'upload_image/about/about_11_s100.jpg', NULL, NULL, NULL, 1),
(7, 13, 'image', 'about_13.png', '關於我們', 'upload_image/about/about_13.png', 'upload_image/about/about_13_s100.png', NULL, NULL, NULL, 1),
(7, 14, 'image', 'about_14.jpg', '關於我們', 'upload_image/about/about_14.jpg', 'upload_image/about/about_14_s100.jpg', NULL, NULL, NULL, 1),
(7, 15, 'image', 'about_15.jpg', '關於我們', 'upload_image/about/about_15.jpg', 'upload_image/about/about_15_s100.jpg', NULL, NULL, NULL, 1),
(8, 17, 'image', 'contact_17.png', '聯絡我們標題', 'upload_image/contact/contact_17.png', 'upload_image/contact/contact_17_s100.png', NULL, NULL, NULL, 1),
(10, 20, 'image', 'news_18.png', '番仔挖烏魚子介紹', 'upload_image/news/news_18.png', 'upload_image/news/news_18_s100.png', NULL, NULL, NULL, 1),
(11, 21, 'image', 'news_21.png', '番仔挖烏魚子介紹', 'upload_image/news/news_21.png', 'upload_image/news/news_21_s100.png', NULL, NULL, NULL, 1),
(12, 22, 'image', 'news_22.jpg', '鮪魚檢驗報告', 'upload_image/news/news_22.jpg', 'upload_image/news/news_22_s100.jpg', NULL, NULL, NULL, 1),
(13, 23, 'image', 'products_23.png', '番仔挖烏魚子 - 五兩一片', 'upload_image/products/products_23.png', 'upload_image/products/products_23_s100.png', 'upload_image/products/products_23_s301.png', NULL, NULL, 1),
(13, 24, 'image', 'products_24.jpg', '番仔挖烏魚子 - 五兩一片', 'upload_image/products/products_24.jpg', 'upload_image/products/products_24_s100.jpg', 'upload_image/products/products_24_s301.jpg', NULL, NULL, 1),
(13, 25, 'image', 'products_25.jpg', '番仔挖烏魚子 - 五兩一片', 'upload_image/products/products_25.jpg', 'upload_image/products/products_25_s100.jpg', 'upload_image/products/products_25_s301.jpg', NULL, NULL, 1),
(13, 26, 'image', 'products_26.png', '番仔挖烏魚子 - 五兩一片', 'upload_image/products/products_26.png', 'upload_image/products/products_26_s100.png', 'upload_image/products/products_26_s301.png', NULL, NULL, 1),
(17, 43, 'image', 'products_27.png', '番仔挖烏魚子 - 六兩一片', 'upload_image/products/products_27.png', 'upload_image/products/products_27_s100.png', 'upload_image/products/products_27_s301.png', NULL, NULL, 1),
(17, 44, 'image', 'products_28.png', '番仔挖烏魚子 - 六兩一片', 'upload_image/products/products_28.png', 'upload_image/products/products_28_s100.png', 'upload_image/products/products_28_s301.png', NULL, NULL, 1),
(17, 45, 'image', 'products_29.png', '番仔挖烏魚子 - 六兩一片', 'upload_image/products/products_29.png', 'upload_image/products/products_29_s100.png', 'upload_image/products/products_29_s301.png', NULL, NULL, 1),
(17, 46, 'image', 'products_30.png', '番仔挖烏魚子 - 六兩一片', 'upload_image/products/products_30.png', 'upload_image/products/products_30_s100.png', 'upload_image/products/products_30_s301.png', NULL, NULL, 1),
(18, 47, 'image', 'products_47.png', '烏魚子 - 五兩二片', 'upload_image/products/products_47.png', 'upload_image/products/products_47_s100.png', 'upload_image/products/products_47_s301.png', NULL, NULL, 1),
(18, 48, 'image', 'products_48.png', '烏魚子 - 五兩二片', 'upload_image/products/products_48.png', 'upload_image/products/products_48_s100.png', 'upload_image/products/products_48_s301.png', NULL, NULL, 1),
(18, 49, 'image', 'products_49.png', '烏魚子 - 五兩二片', 'upload_image/products/products_49.png', 'upload_image/products/products_49_s100.png', 'upload_image/products/products_49_s301.png', NULL, NULL, 1),
(18, 50, 'image', 'products_50.png', '烏魚子 - 五兩二片', 'upload_image/products/products_50.png', 'upload_image/products/products_50_s100.png', 'upload_image/products/products_50_s301.png', NULL, NULL, 1),
(19, 51, 'image', 'products_51.png', '冷凍番仔挖烏魚子 - 五兩一片', 'upload_image/products/products_51.png', 'upload_image/products/products_51_s100.png', 'upload_image/products/products_51_s301.png', NULL, NULL, 1),
(19, 52, 'image', 'products_52.png', '冷凍番仔挖烏魚子 - 五兩一片', 'upload_image/products/products_52.png', 'upload_image/products/products_52_s100.png', 'upload_image/products/products_52_s301.png', NULL, NULL, 1),
(19, 53, 'image', 'products_53.png', '冷凍番仔挖烏魚子 - 五兩一片', 'upload_image/products/products_53.png', 'upload_image/products/products_53_s100.png', 'upload_image/products/products_53_s301.png', NULL, NULL, 1),
(19, 54, 'image', 'products_54.png', '冷凍番仔挖烏魚子 - 五兩一片', 'upload_image/products/products_54.png', 'upload_image/products/products_54_s100.png', 'upload_image/products/products_54_s301.png', NULL, NULL, 1),
(20, 55, 'image', 'products_55.png', '冷凍番仔挖烏魚子 - 八兩一片', 'upload_image/products/products_55.png', 'upload_image/products/products_55_s100.png', 'upload_image/products/products_55_s301.png', NULL, NULL, 1),
(20, 56, 'image', 'products_56.png', '冷凍番仔挖烏魚子 - 八兩一片', 'upload_image/products/products_56.png', 'upload_image/products/products_56_s100.png', 'upload_image/products/products_56_s301.png', NULL, NULL, 1),
(20, 57, 'image', 'products_57.png', '冷凍番仔挖烏魚子 - 八兩一片', 'upload_image/products/products_57.png', 'upload_image/products/products_57_s100.png', 'upload_image/products/products_57_s301.png', NULL, NULL, 1),
(20, 58, 'image', 'products_58.png', '冷凍番仔挖烏魚子 - 八兩一片', 'upload_image/products/products_58.png', 'upload_image/products/products_58_s100.png', 'upload_image/products/products_58_s301.png', NULL, NULL, 1),
(21, 59, 'image', 'products_59.jpg', '番仔挖烏魚子 - 十兩一包', 'upload_image/products/products_59.jpg', 'upload_image/products/products_59_s100.jpg', 'upload_image/products/products_59_s301.jpg', NULL, NULL, 1),
(21, 60, 'image', 'products_60.jpg', '番仔挖烏魚子 - 十兩一包', 'upload_image/products/products_60.jpg', 'upload_image/products/products_60_s100.jpg', 'upload_image/products/products_60_s301.jpg', NULL, NULL, 1),
(21, 61, 'image', 'products_61.jpg', '番仔挖烏魚子 - 十兩一包', 'upload_image/products/products_61.jpg', 'upload_image/products/products_61_s100.jpg', 'upload_image/products/products_61_s301.jpg', NULL, NULL, 1),
(21, 62, 'image', 'products_62.jpg', '番仔挖烏魚子 - 十兩一包', 'upload_image/products/products_62.jpg', 'upload_image/products/products_62_s100.jpg', 'upload_image/products/products_62_s301.jpg', NULL, NULL, 1),
(22, 63, 'image', 'products_63.png', '番仔挖烏魚子 - 六兩六片', 'upload_image/products/products_63.png', 'upload_image/products/products_63_s100.png', 'upload_image/products/products_63_s301.png', NULL, NULL, 1),
(22, 64, 'image', 'products_64.png', '番仔挖烏魚子 - 六兩六片', 'upload_image/products/products_64.png', 'upload_image/products/products_64_s100.png', 'upload_image/products/products_64_s301.png', NULL, NULL, 1),
(22, 65, 'image', 'products_65.png', '番仔挖烏魚子 - 六兩六片', 'upload_image/products/products_65.png', 'upload_image/products/products_65_s100.png', 'upload_image/products/products_65_s301.png', NULL, NULL, 1),
(22, 66, 'image', 'products_66.png', '番仔挖烏魚子 - 六兩六片', 'upload_image/products/products_66.png', 'upload_image/products/products_66_s100.png', 'upload_image/products/products_66_s301.png', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `member_set`
--

CREATE TABLE IF NOT EXISTS `member_set` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `m_date` datetime DEFAULT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=180 ;

--
-- Dumping data for table `member_set`
--

INSERT INTO `member_set` (`m_id`, `m_class2`, `m_class3`, `m_name`, `m_account`, `m_password`, `m_gender`, `m_birthyear`, `m_birthmonth`, `m_birthday`, `m_email`, `m_phone`, `m_cellphone`, `m_zip`, `m_city`, `m_canton`, `m_address`, `m_content`, `m_sn`, `m_fname`, `m_item`, `m_faddress`, `m_fzip`, `m_fcity`, `m_fcanton`, `m_area`, `m_map`, `m_epaper`, `m_level`, `m_active`, `m_date`) VALUES
(164, NULL, NULL, '測試人員測試人員測試', 'williams', 'williams', '1', NULL, NULL, NULL, 'williamshsu@gmail.com', NULL, '0937-686482', 804, '高雄市', '鼓山區', '中山路123號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2012-06-01 17:08:24'),
(165, NULL, NULL, 'williamsT', 'williamsT', 'williamsT', '0', '2004', '04', '04', 'williams188@yahoho.com', '07-7808955', '0937-684587', 200, '基隆市', '仁愛區', '建榮路76號3F-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2012-07-02 15:35:50'),
(166, NULL, NULL, 'williamsT2', 'williamsT2', 'williamsT2', '1', NULL, NULL, NULL, 'wwwwww@yahoo.com.tw', NULL, '08-4756321', 200, '基隆市', '仁愛區', '九如四路11111', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2012-07-02 15:57:27'),
(167, NULL, NULL, 'williamsTs', 'williamsTs', 'williamsTs', '0', '1980', '05', '09', 'williams188@msn.com', '0928123321', '08-7799000', 552, '南投縣', '集集鎮', '和興村和興路194號 ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2012-07-18 16:24:59'),
(168, NULL, NULL, 'williamA', 'williamA', 'williamA', '0', '1995', '08', '08', 'william@yahoho.com', '0987-456321', '0937-686483', 363, '苗栗縣', '公館鄉', '請輸入地址請輸入地址請輸入地址請輸入地址', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2012-07-26 01:07:19'),
(169, NULL, NULL, '徐先生', 'williamsTe', 'williamsTe', '1', '1990', '06', '20', 'williamshsu@gmail.com', NULL, '0937-684587', 804, '高雄市', '鼓山區', '文化西路 39 號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2012-07-27 16:01:51'),
(170, 'farmer', NULL, '姜仁和', 'farmer1', 'farmer1', '1', NULL, NULL, NULL, NULL, '(049)2920620', NULL, 800, '高雄市', '新興區', '南豐村中正路84號', '<p>姜仁和農友是所有農戶中最年長的，在部落更有舉足輕重的地位。他多年務農，經驗很豐富，但他發現農產量愈趨下降，是因為土地長時施打農藥，破壞了土壤的關係，於是他嘗試了綠生農法，用無毒有效的有機肥來讓土壤再一次活化。他說:這應該就是祖先的方法，我們應該要多加利用珍惜祖先的智慧。他目前種植青椒與南瓜，產量與品質，深得顧客的喜愛。</p>', 'A007', '眉溪綠生農場', '南瓜、青椒', '大同段52號', 800, '高雄市', '新興區', '0.3公頃', '<iframe width="686" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com.tw/maps?t=m&q=23.947626,121.076449&ie=UTF8&brcurrent=3,0x3468d97048bbee65:0xb2e74e030c74b71a,0,0x3468d6aa1a5d49ad:0x1348fba95f17f6da&ll=23.947665,121.07646&spn=0.027455,0.058966&z=14&output=embed"></iframe><br /><small><a href="https://www.google.com.tw/maps?t=m&q=23.947626,121.076449&ie=UTF8&brcurrent=3,0x3468d97048bbee65:0xb2e74e030c74b71a,0,0x3468d6aa1a5d49ad:0x1348fba95f17f6da&ll=23.947665,121.07646&spn=0.027455,0.058966&z=14&source=embed">顯示詳細地圖</a></small>', 0, 1, '1', '2013-10-24 16:31:05'),
(173, 'farmer', NULL, '李梅香', 'farmer3', 'farmer3', '0', NULL, NULL, NULL, NULL, '(049)2920051', NULL, 546, '南投縣', '仁愛鄉', '南豐村松原巷100號', '<p>在部落住家旁約0.27分地，李梅香農友種植當歸，她頗自豪地說:我種的當歸，品質很好，消費者常主動跟她聯絡要購買。目前參與此計畫的農戶，她是唯一種植當歸的農戶，每次收成，她送來理貨場時，當歸濃厚的香味，必定瀰漫整個空氣中。</p>', 'A009', '眉溪綠生農場', '當歸', '大同段244號', 546, '南投縣', '仁愛鄉', '0.27公頃', '<iframe width="686" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com.tw/maps?t=m&q=23.947626,121.076449&ie=UTF8&brcurrent=3,0x3468d97048bbee65:0xb2e74e030c74b71a,0,0x3468d6aa1a5d49ad:0x1348fba95f17f6da&ll=23.947665,121.07646&spn=0.027455,0.058966&z=14&output=embed"></iframe><br /><small><a href="https://www.google.com.tw/maps?t=m&q=23.947626,121.076449&ie=UTF8&brcurrent=3,0x3468d97048bbee65:0xb2e74e030c74b71a,0,0x3468d6aa1a5d49ad:0x1348fba95f17f6da&ll=23.947665,121.07646&spn=0.027455,0.058966&z=14&source=embed" >顯示詳細地圖</a></small>', 0, 1, '1', '2013-10-25 15:46:42'),
(174, 'normal', NULL, 'williams22', 'williams2', 'williams22', '0', '1993', '09', '15', 'williams2@yahoo.com', '0918123321', '05-4563217', 546, '南投縣', '仁愛鄉', '南豐村中正路90-5號s', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2013-10-28 03:02:57'),
(175, NULL, NULL, 'william', 'william', 'william', '1', NULL, NULL, '2015/09/09', 'william@yahoo.com', '0987654321', NULL, NULL, NULL, NULL, 'williamwilliamwilliamwilliam', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-11 12:58:31'),
(176, NULL, NULL, 'william3', 'william3', 'william3', '1', '1989', '02', '15', 'william3@gmail.com', '0978654123', NULL, 653, '雲林縣', '口湖鄉', '成龍村成龍197號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-11 13:04:22'),
(177, NULL, NULL, 'william4', 'william4', 'william4', '0', '1989', '02', '02', 'william4@gmail.com', '0978654123', NULL, 711, '台南市', '歸仁區', '成龍村成龍197號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-11 13:08:35'),
(178, NULL, NULL, 'william', 'williamc', 'williamc', '0', '2015', '10', '01', NULL, '0987456311', NULL, 110, '台北市', '信義區', 'williamcwilliamcwilliamc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-11 13:33:11'),
(179, NULL, NULL, 'williams', 'william@yahoo.com', 'fd820a2b4461bddd116c1518bc4b0f77', NULL, '2010', '01', '01', 'williams@yahoo.com', '0937452147', NULL, 821, '高雄市', '路竹區', '成龍村成龍1917號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-11 13:35:09');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `menu_id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `menu_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_use` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_pageTitle1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_pageTitle2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_pageTitle3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_pageTitle4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_pageTitle5` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_title`, `menu_link`, `menu_use`, `menu_pageTitle1`, `menu_pageTitle2`, `menu_pageTitle3`, `menu_pageTitle4`, `menu_pageTitle5`) VALUES
(1, 'authority', 'authority_list.php', '#main_menu_1', '權限管理-列表', '權限管理-新增', '權限管理-修改', '權限管理-刪除', NULL),
(2, 'banners', 'bannersHome_list.php', '#main_menu_2', '首頁Banner廣告-列表', '首頁Banner廣告-新增', '首頁Banner廣告-修改', '首頁Banner廣告-刪除', NULL),
(3, 'news', 'news_list.php', '#main_menu_3', '最新訊息-列表', '最新訊息-新增', '最新訊息-修改', '最新訊息-刪除', NULL),
(4, 'products', 'products_list.php', '#main_menu_4', '商品介紹-列表', '商品介紹-新增', '商品介紹-修改', '商品介紹-刪除', NULL),
(5, 'member', 'member_list.php', '#main_menu_5', '會員專區-列表', '會員專區-新增', '會員專區-修改', '會員專區-刪除', NULL),
(6, 'orders', 'orders_list.php', '#main_menu_6', '訂單管理-列表', '訂單管理-修改', '訂單管理-刪除', NULL, NULL),
(7, 'about', 'about_list.php', '#main_menu_7', '聯絡我們-列表', '聯絡我們-修改', '聯絡我們-刪除', NULL, NULL),
(8, 'contact', 'contact_list', '#main_menu_8', NULL, NULL, NULL, NULL, NULL),
(9, 'activity', 'activity_list', '#main_menu_9', NULL, NULL, NULL, NULL, NULL),
(10, 'about', 'about_list', '#main_menu_10', NULL, NULL, NULL, NULL, NULL),
(11, 'location', 'location_list', '#main_menu_11', NULL, NULL, NULL, NULL, NULL),
(12, 'links', 'links_list', '#main_menu_12', NULL, NULL, NULL, NULL, NULL),
(13, 'download', 'download_list', '#main_menu_13', NULL, NULL, NULL, NULL, NULL),
(14, 'farmer', 'farmer_list', '#main_menu_14', NULL, NULL, NULL, NULL, NULL),
(15, 'shopProcess', 'shopProcess_list', '#main_menu_15', NULL, NULL, NULL, NULL, NULL),
(16, 'message', 'message_list', '#main_menu_16', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `message_set`
--

CREATE TABLE IF NOT EXISTS `message_set` (
  `m_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `m_d_id` int(10) unsigned NOT NULL DEFAULT '0',
  `m_title` text COLLATE utf8_unicode_ci,
  `m_content` text COLLATE utf8_unicode_ci,
  `m_date` datetime DEFAULT NULL,
  `m_name` text COLLATE utf8_unicode_ci,
  `m_email` text COLLATE utf8_unicode_ci,
  `m_type` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_ip` tinytext COLLATE utf8_unicode_ci,
  `m_m_id` int(11) DEFAULT NULL,
  `m_rem_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `m_baskets`
--

CREATE TABLE IF NOT EXISTS `m_baskets` (
  `basketID` int(11) NOT NULL AUTO_INCREMENT,
  `basketSession` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `itemID` tinytext COLLATE utf8_unicode_ci,
  `productID` int(11) DEFAULT NULL,
  `class` tinyint(4) DEFAULT '0',
  `productName` tinytext COLLATE utf8_unicode_ci,
  `qty` tinytext COLLATE utf8_unicode_ci,
  `qtyLimit` tinyint(4) DEFAULT NULL COMMENT '可購買數量限制',
  `serial_num` tinytext COLLATE utf8_unicode_ci,
  `d_inventory` float DEFAULT NULL,
  `d_size1` tinyint(4) DEFAULT NULL,
  `d_size2` tinyint(4) DEFAULT NULL,
  `d_price1` int(11) DEFAULT '0',
  `d_price2` int(11) DEFAULT '0',
  `d_price3` int(11) DEFAULT '0',
  `d_sale` tinyint(2) DEFAULT '0',
  `d_price4` int(11) DEFAULT '0',
  `unit` tinytext COLLATE utf8_unicode_ci COMMENT 'd_class4 單位',
  `perUnit` int(11) DEFAULT NULL COMMENT 'd_class5 每單位數量',
  `d_new_product` tinyint(2) DEFAULT '0',
  `file_link2` tinytext COLLATE utf8_unicode_ci,
  `subtotal` int(11) DEFAULT '0',
  `mb_ip` tinytext COLLATE utf8_unicode_ci,
  `mb_time` datetime DEFAULT NULL,
  `m_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`basketID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=51 ;

--
-- Dumping data for table `m_baskets`
--

INSERT INTO `m_baskets` (`basketID`, `basketSession`, `itemID`, `productID`, `class`, `productName`, `qty`, `qtyLimit`, `serial_num`, `d_inventory`, `d_size1`, `d_size2`, `d_price1`, `d_price2`, `d_price3`, `d_sale`, `d_price4`, `unit`, `perUnit`, `d_new_product`, `file_link2`, `subtotal`, `mb_ip`, `mb_time`, `m_id`) VALUES
(40, 'nmmi75kv2tou7bbpesniafjic6', NULL, 22, 1, '番仔挖烏魚子 - 六兩六片', '2', 20, '', NULL, NULL, NULL, 1290, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_66_s301.png', 2580, '::1', '2015-09-12 23:19:12', NULL),
(41, '29muldur88s4qsbje4qt3fet52', NULL, 21, 1, '番仔挖烏魚子 - 十兩一包', '1', 5, '', NULL, NULL, NULL, 6000, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_62_s301.jpg', 6000, '::1', '2015-09-13 03:21:47', NULL),
(50, 'nduck33ccajfr0f42fqqm083b5', NULL, 22, 1, '番仔挖烏魚子 - 六兩六片', '1', 20, '', NULL, NULL, NULL, 1290, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_66_s301.png', 1290, '::1', '2015-09-13 16:14:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE IF NOT EXISTS `order_item` (
  `oi_id` int(11) NOT NULL AUTO_INCREMENT,
  `o_id` int(11) DEFAULT NULL,
  `d_id` int(11) DEFAULT NULL,
  `d_class` int(11) DEFAULT NULL,
  `d_name` text COLLATE utf8_unicode_ci,
  `price_status` tinytext COLLATE utf8_unicode_ci,
  `serial_num` varchar(23) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `d_price1` int(11) DEFAULT '0',
  `d_price2` int(11) DEFAULT '0',
  `d_price3` int(11) DEFAULT '0',
  `d_sale` int(11) DEFAULT '0',
  `d_price4` int(11) DEFAULT '0',
  `unit` tinytext COLLATE utf8_unicode_ci,
  `perUnit` int(11) DEFAULT NULL,
  `pic` tinytext COLLATE utf8_unicode_ci,
  `d_new_p` tinyint(2) DEFAULT '0',
  `subtotal` int(11) DEFAULT '0',
  PRIMARY KEY (`oi_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`oi_id`, `o_id`, `d_id`, `d_class`, `d_name`, `price_status`, `serial_num`, `qty`, `d_price1`, `d_price2`, `d_price3`, `d_sale`, `d_price4`, `unit`, `perUnit`, `pic`, `d_new_p`, `subtotal`) VALUES
(1, 1, 22, 1, '番仔挖烏魚子 - 六兩六片', NULL, NULL, 2, 1290, NULL, NULL, 0, 0, NULL, NULL, 'upload_image/products/products_66_s301.png', 0, 2580),
(2, 2, 22, 1, '番仔挖烏魚子 - 六兩六片', NULL, NULL, 1, 1290, NULL, NULL, 0, 0, NULL, NULL, 'upload_image/products/products_66_s301.png', 0, 1290),
(3, 2, 19, 1, '冷凍番仔挖烏魚子 - 五兩一片', NULL, NULL, 1, 2100, NULL, NULL, 0, 0, NULL, NULL, 'upload_image/products/products_54_s301.png', 0, 2100),
(4, 3, 18, 1, '烏魚子 - 五兩二片', NULL, NULL, 1, 1300, NULL, NULL, 0, 0, NULL, NULL, 'upload_image/products/products_50_s301.png', 0, 1300),
(5, 4, 13, 1, '番仔挖烏魚子 - 五兩一片', NULL, NULL, 1, 1390, NULL, NULL, 0, 0, NULL, NULL, 'upload_image/products/products_26_s301.png', 0, 1390),
(6, 4, 17, 1, '番仔挖烏魚子 - 六兩一片', NULL, NULL, 1, 1580, NULL, NULL, 0, 0, NULL, NULL, 'upload_image/products/products_30_s301.png', 0, 1580),
(7, 5, 22, 1, '番仔挖烏魚子 - 六兩六片', NULL, NULL, 1, 1290, NULL, NULL, 0, 0, NULL, NULL, 'upload_image/products/products_66_s301.png', 0, 1290),
(8, 6, 20, 1, '冷凍番仔挖烏魚子 - 八兩一片', NULL, NULL, 1, 3000, NULL, NULL, 0, 0, NULL, NULL, 'upload_image/products/products_58_s301.png', 0, 3000),
(9, 7, 22, 1, '番仔挖烏魚子 - 六兩六片', NULL, NULL, 1, 1290, NULL, NULL, 0, 0, NULL, NULL, 'upload_image/products/products_66_s301.png', 0, 1290);

-- --------------------------------------------------------

--
-- Table structure for table `order_set`
--

CREATE TABLE IF NOT EXISTS `order_set` (
  `o_id` int(11) NOT NULL AUTO_INCREMENT,
  `o_number` tinytext COLLATE utf8_unicode_ci,
  `client` tinytext COLLATE utf8_unicode_ci,
  `c_gender` tinyint(2) DEFAULT NULL,
  `phone` varchar(23) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cellphone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` tinytext COLLATE utf8_unicode_ci,
  `address` tinytext COLLATE utf8_unicode_ci,
  `zipcode` tinyint(5) DEFAULT NULL,
  `r_client` tinytext COLLATE utf8_unicode_ci,
  `r_gender` tinyint(2) DEFAULT NULL,
  `r_phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `r_cellphone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `r_email` tinytext COLLATE utf8_unicode_ci,
  `r_address` tinytext COLLATE utf8_unicode_ci,
  `r_zipcode` tinyint(5) DEFAULT NULL,
  `invoice` int(11) DEFAULT NULL,
  `insn` text COLLATE utf8_unicode_ci,
  `inname` text COLLATE utf8_unicode_ci,
  `in_zipcode` tinyint(5) DEFAULT NULL,
  `inadd` text COLLATE utf8_unicode_ci,
  `in_phone` tinytext COLLATE utf8_unicode_ci,
  `payment` tinyint(2) DEFAULT '0',
  `card_status` tinyint(2) DEFAULT '0',
  `cash_status` tinyint(2) DEFAULT '0',
  `bank_status` tinyint(2) DEFAULT '0',
  `transport_status` tinyint(2) DEFAULT '0',
  `m_id` int(11) DEFAULT NULL,
  `tfee` int(11) DEFAULT NULL,
  `SubTotalAll` int(11) DEFAULT '0',
  `GrandTotal` int(11) DEFAULT '0',
  `transport` tinyint(2) DEFAULT '0',
  `delivery` tinyint(2) DEFAULT '0',
  `TrackingNum` tinytext COLLATE utf8_unicode_ci,
  `remitter` tinytext COLLATE utf8_unicode_ci,
  `remitter_AC` varchar(20) COLLATE utf8_unicode_ci DEFAULT '0',
  `remitter_money` varchar(30) COLLATE utf8_unicode_ci DEFAULT '0',
  `remitter_time` varchar(30) COLLATE utf8_unicode_ci DEFAULT '0000-00-00 00:00',
  `remitter_active` tinyint(1) DEFAULT '0',
  `datetime` datetime DEFAULT NULL,
  `notation` text COLLATE utf8_unicode_ci,
  `m_account` tinytext COLLATE utf8_unicode_ci,
  `RID` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`o_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `order_set`
--

INSERT INTO `order_set` (`o_id`, `o_number`, `client`, `c_gender`, `phone`, `cellphone`, `email`, `address`, `zipcode`, `r_client`, `r_gender`, `r_phone`, `r_cellphone`, `r_email`, `r_address`, `r_zipcode`, `invoice`, `insn`, `inname`, `in_zipcode`, `inadd`, `in_phone`, `payment`, `card_status`, `cash_status`, `bank_status`, `transport_status`, `m_id`, `tfee`, `SubTotalAll`, `GrandTotal`, `transport`, `delivery`, `TrackingNum`, `remitter`, `remitter_AC`, `remitter_money`, `remitter_time`, `remitter_active`, `datetime`, `notation`, `m_account`, `RID`) VALUES
(1, 'TD15091200001', '王大明', 1, NULL, '0987456321', 'williamboss@pchome.com.tw', '高雄市岡山區成龍村成龍197號', 127, '王大明', 1, NULL, '0987456321', 'williamboss@pchome.com.tw', '高雄市岡山區成龍村成龍197號', 127, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 0, NULL, 0, NULL, 150, 2580, 2730, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-13 02:17:05', NULL, NULL, NULL),
(2, 'TD15091300002', 'william', 1, NULL, '0984463211', 'william@yahoo.com', '台中市西屯區文華路100巷31號號', 127, 'william', 1, NULL, '0984463211', 'william@yahoo.com', '台中市西屯區文華路100巷31號號', 127, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, 0, NULL, 150, 3390, 3540, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-13 03:33:06', NULL, NULL, NULL),
(3, 'TD15091300003', 'william', 1, NULL, '0984463211', 'william@yahoo.com', '雲林縣口湖鄉成龍村成龍197號', 127, 'william', 1, NULL, '0984463211', 'william@yahoo.com', '雲林縣口湖鄉成龍村成龍197號', 127, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, NULL, 150, 1300, 1450, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-13 03:56:41', '備註：請歐巴馬親自送來，請歐巴馬親自送來，請歐巴馬親自送來，請歐巴馬親自送來，請歐巴馬親自送來\r\n\r\n備註：請歐巴馬親自送來，請歐巴馬親自送來，請歐巴馬親自送來，請歐巴馬親自送來，請歐巴馬親自送來', NULL, NULL),
(4, 'TD15091300004', 'william', 1, NULL, '0984463211', 'william@yahoo.com', '屏東縣里港鄉成龍村成龍197號', 127, 'william', 1, NULL, '0984463211', 'william@yahoo.com', '屏東縣里港鄉成龍村成龍197號', 127, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, NULL, 150, 2970, 3120, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-13 04:10:29', '的訂單資料成立後，依訂單專屬的帳號資訊，請您依據此組帳號進行轉帳即可；提醒您需於到貨日2天前完成匯款，以利如期出貨。', NULL, NULL),
(5, 'TD15091300005', 'william', 1, NULL, '0984463211', 'william@yahoo.com', '雲林縣口湖鄉成龍村成龍197號', 127, 'william', 1, NULL, '0984463211', 'william@yahoo.com', '雲林縣口湖鄉成龍村成龍197號', 127, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 0, NULL, 150, 1290, 1440, NULL, NULL, NULL, '帳戶名', '12355', '1440', '2015-09-10 07:49', 1, '2015-09-13 04:17:57', '備註備註備註備註\r\n\r\n\r\n備註備註備註', NULL, NULL),
(6, 'TD15091300006', 'william', 1, NULL, '0984463211', 'william@yahoo.com', '雲林縣口湖鄉成龍村成龍197號', 127, 'william', 1, NULL, '0984463211', 'william@yahoo.com', '雲林縣口湖鄉成龍村成龍197號', 127, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 0, NULL, 150, 3000, 3150, NULL, NULL, NULL, '王小明', '12135', '5000', '2015-09-13 04:25', 1, '2015-09-13 04:19:50', NULL, NULL, NULL),
(7, 'TD15091300007', 'william', 1, NULL, '0984463211', 'william@yahoo.com', '雲林縣口湖鄉成龍村成龍197號', 127, 'william', 1, NULL, '0984463211', 'william@yahoo.com', '雲林縣口湖鄉成龍村成龍197號', 127, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, 179, 150, 1290, 1440, NULL, NULL, NULL, '王小明', '12345', '3150', '2015-09-13 07:48', 1, '2015-09-13 04:27:02', NULL, 'william@yahoo.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `response_set`
--

CREATE TABLE IF NOT EXISTS `response_set` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `r_o_id` int(11) NOT NULL,
  `r_status` int(3) DEFAULT '-1',
  `r_lidm` tinytext COLLATE utf8_unicode_ci,
  `r_lastPan4` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `r_authAmt` tinytext COLLATE utf8_unicode_ci,
  `r_authCode` tinytext COLLATE utf8_unicode_ci,
  `r_xid` tinytext COLLATE utf8_unicode_ci,
  `r_authTime` tinytext COLLATE utf8_unicode_ci,
  `r_errcode` tinytext COLLATE utf8_unicode_ci,
  `r_errDesc` tinytext COLLATE utf8_unicode_ci,
  `r_cardBrand` tinytext COLLATE utf8_unicode_ci,
  `r_pan` tinytext COLLATE utf8_unicode_ci,
  `r_order_date` datetime DEFAULT NULL,
  `r_response_date` datetime DEFAULT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE IF NOT EXISTS `terms` (
  `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `slug` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0',
  `term_active` tinyint(2) NOT NULL DEFAULT '1',
  `term_sort` int(11) DEFAULT '1',
  PRIMARY KEY (`term_id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`term_id`, `name`, `slug`, `term_group`, `term_active`, `term_sort`) VALUES
(1, '冷凍食品', '%E5%86%B7%E5%87%8D%E9%A3%9F%E5%93%81', 0, 1, 1),
(2, '空運來台', '%E7%A9%BA%E9%81%8B%E4%BE%86%E5%8F%B0', 0, 1, 2),
(3, '現撈海鮮', '%E7%8F%BE%E6%92%88%E6%B5%B7%E9%AE%AE', 0, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `term_relationships`
--

CREATE TABLE IF NOT EXISTS `term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `term_relationships`
--

INSERT INTO `term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(13, 2, 2),
(17, 2, 1),
(18, 3, 2),
(19, 1, 3),
(20, 1, 2),
(21, 3, 1),
(22, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `term_taxonomy`
--

CREATE TABLE IF NOT EXISTS `term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `term_taxonomy`
--

INSERT INTO `term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'post_tag', '', 0, 0),
(2, 2, 'post_tag', '', 0, 0),
(3, 3, 'post_tag', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vitae_set`
--

CREATE TABLE IF NOT EXISTS `vitae_set` (
  `v_id` int(11) NOT NULL AUTO_INCREMENT,
  `v_d_id` int(11) DEFAULT NULL,
  `v_class1` tinytext COLLATE utf8_unicode_ci,
  `v_name` tinytext COLLATE utf8_unicode_ci,
  `v_gender` tinyint(4) DEFAULT NULL,
  `v_phone` tinytext COLLATE utf8_unicode_ci,
  `v_ages` tinytext COLLATE utf8_unicode_ci,
  `v_email` text COLLATE utf8_unicode_ci,
  `v_address` text COLLATE utf8_unicode_ci,
  `v_content` text COLLATE utf8_unicode_ci,
  `v_date` datetime DEFAULT NULL,
  PRIMARY KEY (`v_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `webcount`
--

CREATE TABLE IF NOT EXISTS `webcount` (
  `count_id` int(11) NOT NULL AUTO_INCREMENT,
  `count_ip` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `count_time` datetime DEFAULT NULL,
  PRIMARY KEY (`count_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `zipcode`
--

CREATE TABLE IF NOT EXISTS `zipcode` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `City` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Area` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ZipCode` char(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `c_id` int(11) DEFAULT NULL COMMENT '對應縣市',
  `z_date` date DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `City` (`City`,`Area`,`ZipCode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

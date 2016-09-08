-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生日期: 2016 年 04 月 19 日 11:01
-- 伺服器版本: 5.5.20
-- PHP 版本: 5.2.9-2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `chunhanstudio`
--

-- --------------------------------------------------------

--
-- 表的結構 `address_book_set`
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
-- 表的結構 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_password` tinytext COLLATE utf8_unicode_ci,
  `user_level` int(4) DEFAULT NULL,
  `user_limit` tinyint(4) DEFAULT '2',
  `user_active` tinyint(1) DEFAULT '1',
  `user_status` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_loginerr` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- 轉存資料表中的資料 `admin`
--

INSERT INTO `admin` (`user_id`, `user_name`, `user_password`, `user_level`, `user_limit`, `user_active`, `user_status`, `user_loginerr`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1, 1, 'active', 0),
(7, 'tester', 'f5d1278e8109edd94e1e4197e04873b9', 2, 2, 1, 'active', 0),
(9, 'aaaaaa', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', 4, 2, 1, 'active', 0);

-- --------------------------------------------------------

--
-- 表的結構 `admin_log`
--

CREATE TABLE IF NOT EXISTS `admin_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_limit` tinyint(4) DEFAULT NULL,
  `user_active` tinyint(1) DEFAULT NULL,
  `login_date` datetime DEFAULT NULL,
  `logout_date` datetime DEFAULT NULL,
  `login_ip` tinytext COLLATE utf8_unicode_ci,
  `login_status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logout_status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logout_page` tinytext COLLATE utf8_unicode_ci,
  `HTTP_USER_AGENT` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- 轉存資料表中的資料 `admin_log`
--

INSERT INTO `admin_log` (`log_id`, `user_id`, `user_name`, `user_limit`, `user_active`, `login_date`, `logout_date`, `login_ip`, `login_status`, `logout_status`, `logout_page`, `HTTP_USER_AGENT`) VALUES
(1, 1, 'admin', 1, 1, '2016-04-19 16:40:20', NULL, '::1', 'Success', NULL, NULL, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36'),
(2, 1, 'admin', 1, 1, '2016-04-19 16:44:45', '2016-04-19 16:44:48', '::1', 'Success', 'Logout Success', '/chunhanstudio/cms/first.php', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36');

-- --------------------------------------------------------

--
-- 表的結構 `a_set`
--

CREATE TABLE IF NOT EXISTS `a_set` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- 轉存資料表中的資料 `a_set`
--

INSERT INTO `a_set` (`a_id`, `a_title`, `a_1`, `a_2`, `a_3`, `a_4`, `a_5`, `a_6`, `a_7`, `a_8`, `a_9`, `a_10`, `a_11`, `a_12`, `a_13`, `a_14`, `a_15`, `a_16`) VALUES
(1, '系統管理員', 210, 210, 210, 210, 105, 105, 15, 15, 15, 15, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '資料更新員', 0, 0, 0, 0, 15, 15, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的結構 `baskets`
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
-- 表的結構 `class_set`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- 轉存資料表中的資料 `class_set`
--

INSERT INTO `class_set` (`c_id`, `c_title`, `c_content`, `c_class`, `c_link`, `c_level`, `c_active`, `c_parent`, `c_sort`) VALUES
(1, '產品資訊', NULL, NULL, NULL, NULL, 1, 'newsC', 2),
(3, '小知識', NULL, NULL, NULL, NULL, 1, 'newsC', 3),
(4, '活動公告', NULL, NULL, NULL, NULL, 1, 'newsC', 1);

-- --------------------------------------------------------

--
-- 表的結構 `data_set`
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
  `d_data1` text COLLATE utf8_unicode_ci,
  `d_data2` text COLLATE utf8_unicode_ci,
  `d_data3` text COLLATE utf8_unicode_ci,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=63 ;

--
-- 轉存資料表中的資料 `data_set`
--

INSERT INTO `data_set` (`d_id`, `d_title`, `d_content`, `d_class1`, `d_class2`, `d_class3`, `d_class4`, `d_class5`, `d_class6`, `d_tag`, `d_data1`, `d_data2`, `d_data3`, `d_price1`, `d_price2`, `d_price3`, `d_inventory`, `d_sale`, `d_new_product`, `d_date`, `d_active`, `d_sort`) VALUES
(7, '關於C+H', '  特殊剪裁的版型，做自己想做的衣服，不隨波逐流！ C+H 是由兩姐妹Chun和Hanㄧ起成立，姊姊淳淳讀的是室內設計，妹妹勻涵則是念應用外語，皆非時裝本科系的她們，因為喜愛服飾打扮，也長期翻閱日本裝苑雜誌，對於服飾都有一段時間的瞭解與研究後產生興趣，進而去學習了服裝剪裁，並在2010年成立了品牌 C+H。 \r\n\r\n  深受山本耀司獨特版型造型影響，C+H 也將自己定位於一個未知數的幾何圖形，某些不規則的造型訴說著人人都可以在制式的體制下來表現非制式的自我獨特性，也許時尚會隨著時間的潮流而轉變，但她們深信，創造個人獨特風格才是會令人留下永久的印象。剪裁方面則有不受男女之分的中性、不規則的交錯堆疊和想傳遞的一些理念來作為發揮的題材。\r\n', 'about', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2015-11-04 08:23:42', 1, 1),
(8, '聯絡我們', '台中市豐原區三民路44巷11號', 'contact', '24.254458, 120.721743', NULL, 'chunhanstudio@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2015-11-24 09:27:35', 1, 1),
(10, '| 新裝上市 |', '<p>C+H 2016SS Unlimited<br />___________________<br />| 新裝上市 |</p>\r\n<p><img src="../source/12400993_1075175832526033_2209490418911139630_n.jpg" alt="" width="263" height="395" /></p>', 'news', '1', '2016', '<p>C+H 2016SS Unlimited<br />___________________<br />| 新裝上市 |</p>\r\n<p><img src="../source/12400993_1075175832526033_2209490418911139630_n.jpg" alt="" width="263" height="395" /></p>', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2016-03-31 06:27:00', 1, 4),
(18, 'pit 生肌乳 50ML', '<p style="text-align: center;"><img src="../source/pb-1.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: center;"><img src="../source/pb-2.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: center;"><img src="../source/pb-3.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: left;">漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>\r\n<p style="text-align: center;"><img src="../source/pb-1.jpg" alt="" width="680" height="450" /></p>', 'products', '3', '<p>天然修護、舒緩肌膚不適、<br />提升肌膚對環境傷害的保護力,<br />可以使用在臉部或身體任何部位, 私密嬌嫩部位表面亦可使用。</p>\r\n<p>強化表皮防護能力<br />舒緩各式乾裂脫屑<br />舒緩乾燥引起的皮膚癢</p>\r\n<p>成分：中藥材</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：高雄</p>\r\n<p>商品圖片僅供參考</p>', '<p class="notep">容量:50ml</p>\r\n<p class="notep">保存期限：2年</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">一般化妝品免備查</p>', NULL, NULL, '3', '<p>天然修護、舒緩肌膚不適、<br />提升肌膚對環境傷害的保護力,<br />可以使用在臉部或身體任何部位, 私密嬌嫩部位表面亦可使用。</p>\r\n<p>強化表皮防護能力<br />舒緩各式乾裂脫屑<br />舒緩乾燥引起的皮膚癢</p>\r\n<p>成分：中藥材</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：高雄</p>\r\n<p>商品圖片僅供參考</p>', '<p style="text-align: center;"><img src="../source/pb-1.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: center;"><img src="../source/pb-2.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: center;"><img src="../source/pb-3.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: left;">漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>\r\n<p style="text-align: center;"><img src="../source/pb-1.jpg" alt="" width="680" height="450" /></p>', '<p class="notep">容量:50ml</p>\r\n<p class="notep">保存期限：2年</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">一般化妝品免備查</p>', 1800, 30, 0, NULL, NULL, NULL, '2015-11-09 08:02:20', 1, 1),
(19, 'KHÁNG修護凝露10ML', '<p style="text-align: center;"><img src="../source/pb-1.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: center;"><img src="../source/pb-2.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: center;"><img src="../source/pb-3.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: left;">漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>', 'products', '1', '<p>天然修護、舒緩肌膚不適、<br />提升肌膚對環境傷害的保護力,<br />可以使用在臉部或身體任何部位, 私密嬌嫩部位表面亦可使用。</p>\r\n<p>成分：中藥材</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：高雄</p>\r\n<p>商品圖片僅供參考</p>', '<p class="notep">容量:10ml</p>\r\n<p class="notep">保存期限：2年</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">一般化妝品免備查</p>', NULL, NULL, '1', '<p>天然修護、舒緩肌膚不適、<br />提升肌膚對環境傷害的保護力,<br />可以使用在臉部或身體任何部位, 私密嬌嫩部位表面亦可使用。</p>\r\n<p>成分：中藥材</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：高雄</p>\r\n<p>商品圖片僅供參考</p>', '<p style="text-align: center;"><img src="../source/pb-1.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: center;"><img src="../source/pb-2.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: center;"><img src="../source/pb-3.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: left;">漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>', '<p class="notep">容量:10ml</p>\r\n<p class="notep">保存期限：2年</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">一般化妝品免備查</p>', 1399, 20, 0, NULL, NULL, NULL, '2015-11-09 08:06:35', 1, 1),
(20, 'pit 生肌乳 20ML', '<p style="text-align: center;"><img src="../source/pb-2.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: center;"><img src="../source/pb-3.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: center;"><img src="../source/pb-1.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: left;">漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>', 'products', '3', '<p>天然修護、舒緩肌膚不適、<br />提升肌膚對環境傷害的保護力,<br />可以使用在臉部或身體任何部位, 私密嬌嫩部位表面亦可使用。</p>\r\n<p>強化表皮防護能力<br />舒緩各式乾裂脫屑<br />舒緩乾燥引起的皮膚癢</p>\r\n<p>成分：中藥材</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：高雄</p>\r\n<p>商品圖片僅供參考</p>', '<p class="notep">容量:20ml</p>\r\n<p class="notep">保存期限：2年</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">一般化妝品免備查</p>', NULL, NULL, '3', '<p>天然修護、舒緩肌膚不適、<br />提升肌膚對環境傷害的保護力,<br />可以使用在臉部或身體任何部位, 私密嬌嫩部位表面亦可使用。</p>\r\n<p>強化表皮防護能力<br />舒緩各式乾裂脫屑<br />舒緩乾燥引起的皮膚癢</p>\r\n<p>成分：中藥材</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：高雄</p>\r\n<p>商品圖片僅供參考</p>', '<p style="text-align: center;"><img src="../source/pb-2.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: center;"><img src="../source/pb-3.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: center;"><img src="../source/pb-1.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: left;">漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>', '<p class="notep">容量:20ml</p>\r\n<p class="notep">保存期限：2年</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">一般化妝品免備查</p>', 900, 20, 0, NULL, NULL, NULL, '2015-11-11 15:04:56', 1, 1),
(23, '訂購單', NULL, 'download', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2015-11-14 00:31:44', 1, 1),
(26, 'pit 生肌乳 30ML', '<p style="text-align: center;"><img src="../source/pb-1.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: center;"><img src="../source/pb-2.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: center;"><img src="../source/pb-3.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: left;">漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>\r\n<p style="text-align: center;"><img src="../source/pb-1.jpg" alt="" width="680" height="450" /></p>', 'products', '3', '<p>天然修護、舒緩肌膚不適、<br />提升肌膚對環境傷害的保護力,<br />可以使用在臉部或身體任何部位, 私密嬌嫩部位表面亦可使用。</p>\r\n<p>強化表皮防護能力<br />舒緩各式乾裂脫屑<br />舒緩乾燥引起的皮膚癢</p>\r\n<p>成分：中藥材</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：高雄</p>\r\n<p>商品圖片僅供參考</p>', '<p class="notep">容量:30ml</p>\r\n<p class="notep">保存期限：2年</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">一般化妝品免備查</p>', NULL, NULL, '3', '<p>天然修護、舒緩肌膚不適、<br />提升肌膚對環境傷害的保護力,<br />可以使用在臉部或身體任何部位, 私密嬌嫩部位表面亦可使用。</p>\r\n<p>強化表皮防護能力<br />舒緩各式乾裂脫屑<br />舒緩乾燥引起的皮膚癢</p>\r\n<p>成分：中藥材</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：高雄</p>\r\n<p>商品圖片僅供參考</p>', '<p style="text-align: center;"><img src="../source/pb-1.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: center;"><img src="../source/pb-2.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: center;"><img src="../source/pb-3.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: left;">漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>\r\n<p style="text-align: center;"><img src="../source/pb-1.jpg" alt="" width="680" height="450" /></p>', '<p class="notep">容量:30ml</p>\r\n<p class="notep">保存期限：2年</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">一般化妝品免備查</p>', 1115, 20, 0, NULL, NULL, NULL, '2015-11-14 21:06:59', 1, 1),
(35, '期待期待', '<p>近日進入了趕工黑暗期，除了春夏裝，我們還開發了許多新<wbr />商品～～期待期待，美美一系列～</p>', 'news', '1', '2016', '<p>近日進入了趕工黑暗期，除了春夏裝，我們還開發了許多新<wbr />商品～～期待期待，美美一系列～</p>', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2016-03-16 21:26:41', 1, 1),
(45, '| 無限 |', '<p>| 無限 |</p>\r\n<p>將自己放在一個未知的直線上，<br />無限延伸的實驗與挑戰，<br />它，是時間催化出的產物，<span class="text_exposed_show"><br />透過重組、再利用，轉為生生不息的無限永續，<br />然而每一次的動作都是一場華麗地突破。</span></p>\r\n<div class="text_exposed_show">\r\n<p>本季部分商品為拆解式服裝，可將衣身拉鍊處拆解重組，<br />所謂可拆解式衣服是可將此季服裝某部位拆解延伸搭配至下季服裝，<br />進而提倡慢時尚與賦予服裝的多功能性與重複利用性，減少資源的浪費。<br />如果你們也有跟我一樣的相同理念，就請分享出去吧。<br />----------------------------------------------------------<br />MODEL | 吳菈蕊<br />HAIR | NAMI Hair Design Studio</p>\r\n<p>攝影:C+H<br />平面:C+H<br />----------------------------------------------------------<br />預購95折中至4/20（請私訊）<br />5/6統一出貨<br /><a class="profileLink" href="https://www.facebook.com/ilovepinkoi/">Pinkoi</a> 與FB 同時線上預購中 | <br /><a href="http://www.pinkoi.com/store/chfashion2010" target="_blank" rel="nofollow">http://www.pinkoi.com/store/chfashion2010</a></p>\r\n</div>', 'news', '1', '2016', '<p>| 無限 |</p>\r\n<p>將自己放在一個未知的直線上，<br />無限延伸的實驗與挑戰，<br />它，是時間催化出的產物，<span class="text_exposed_show"><br />透過重組、再利用，轉為生生不息的無限永續，<br />然而每一次的動作都是一場華麗地突破。</span></p>\r\n<div class="text_exposed_show">\r\n<p>本季部分商品為拆解式服裝，可將衣身拉鍊處拆解重組，<br />所謂可拆解式衣服是可將此季服裝某部位拆解延伸搭配至下季服裝，<br />進而提倡慢時尚與賦予服裝的多功能性與重複利用性，減少資源的浪費。<br />如果你們也有跟我一樣的相同理念，就請分享出去吧。<br />----------------------------------------------------------<br />MODEL | 吳菈蕊<br />HAIR | NAMI Hair Design Studio</p>\r\n<p>攝影:C+H<br />平面:C+H<br />----------------------------------------------------------<br />預購95折中至4/20（請私訊）<br />5/6統一出貨<br /><a class="profileLink" href="https://www.facebook.com/ilovepinkoi/">Pinkoi</a> 與FB 同時線上預購中 | <br /><a href="http://www.pinkoi.com/store/chfashion2010" target="_blank" rel="nofollow">http://www.pinkoi.com/store/chfashion2010</a></p>\r\n</div>', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2016-03-31 23:56:43', 1, 3),
(54, '首頁Banner2', NULL, 'banners', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2016-04-14 11:37:21', 1, 2),
(55, '加班中。。。。', '<p>加班中。。。。晚點告訴你們我們在幹嘛，不然你們先逛一下新一季好了。<br /><a href="http://www.pinkoi.com/store/chfashion2010" target="_blank" rel="nofollow">http://www.pinkoi.com/store/chfashion2010</a></p>', 'news', '1', '2016', '<p>加班中。。。。晚點告訴你們我們在幹嘛，不然你們先逛一下新一季好了。<br /><a href="http://www.pinkoi.com/store/chfashion2010" target="_blank" rel="nofollow">http://www.pinkoi.com/store/chfashion2010</a></p>', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2016-04-10 19:45:29', 1, 2),
(58, '首頁Banner1', NULL, 'banners', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2016-04-14 11:54:51', 1, 1),
(59, '免運費設定', NULL, 'freight', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3000, 60, 0, 0, 0, 0, '2016-04-15 17:00:35', 1, 1),
(60, '灰藍洋裝/可拆解式上衣', '<p style="text-align: left;"><img src="../source/pb-1.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: left;"><img src="../source/pb-2.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: left;"><img src="../source/pb-3.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: left;">2016 / SS / Unlimited | 無限 | 將自己放在一個未知的直線上，無限延伸的實驗與挑戰， /它/ 是時間催化出的產物，<br />透過重組、再利用，轉為生生不息的無限永續，然而每一次的動作都是一場華麗地突破。本季部分商品為拆解式服裝，可將衣身拉鍊處拆解重組，所謂可拆解式衣服是可將此季服裝某部位拆解延伸搭配至下季服裝，進而提倡慢時尚與賦予服裝的多功能性與重複利用性，減少資源的浪費。如果你們也有跟我一樣的相同理念，就請分享出去吧。</p>', 'products', '1', '<p>尺寸 | FREE SIZE肩寬 | 37-40cm<br />衣長 | 最短40/最長100cm<br />衣寬 | 47cm<br />袖長 | 20cm</p>\r\n<p>MODEL | 163cm</p>\r\n<p>材質 | 棉/聚質纖維</p>\r\n<p>產地 | 台灣<br />商品圖片僅供參考</p>', '<p class="notep">/ 使用及保養方式 / 衣物從打版至裁縫為全手工製作,因此清洗時可將衣物放入洗衣袋內清洗,方可讓您選購的衣物更耐穿。</p>\r\n<p class="notep">About C+H /chun + Han / 很像雙胞胎的姊妹</p>', NULL, NULL, '1', '<p>尺寸 | FREE SIZE肩寬 | 37-40cm<br />衣長 | 最短40/最長100cm<br />衣寬 | 47cm<br />袖長 | 20cm</p>\r\n<p>MODEL | 163cm</p>\r\n<p>材質 | 棉/聚質纖維</p>\r\n<p>產地 | 台灣<br />商品圖片僅供參考</p>', '<p style="text-align: left;"><img src="../source/pb-1.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: left;"><img src="../source/pb-2.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: left;"><img src="../source/pb-3.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: left;">2016 / SS / Unlimited | 無限 | 將自己放在一個未知的直線上，無限延伸的實驗與挑戰， /它/ 是時間催化出的產物，<br />透過重組、再利用，轉為生生不息的無限永續，然而每一次的動作都是一場華麗地突破。本季部分商品為拆解式服裝，可將衣身拉鍊處拆解重組，所謂可拆解式衣服是可將此季服裝某部位拆解延伸搭配至下季服裝，進而提倡慢時尚與賦予服裝的多功能性與重複利用性，減少資源的浪費。如果你們也有跟我一樣的相同理念，就請分享出去吧。</p>', '<p class="notep">/ 使用及保養方式 / 衣物從打版至裁縫為全手工製作,因此清洗時可將衣物放入洗衣袋內清洗,方可讓您選購的衣物更耐穿。</p>\r\n<p class="notep">About C+H /chun + Han / 很像雙胞胎的姊妹</p>', 4280, 10, 0, NULL, NULL, NULL, '2016-04-14 16:01:33', 1, 1),
(61, '展覽資訊', '<p>真誠邀請你們～</p>\r\n<p>展覽資訊：<br />2016台灣文博會 CREATIVE EXPO TAIWAN<br />日期｜04/20-4/24 | 4/22~4/24一般民眾入場3天時間<span class="text_exposed_show"><br />時間｜AM10:00-PM06:00 (4/22、23至PM09:00)<br />地點｜松山文創園區 信義區光復南路133號<br />攤位｜4號倉庫 S4-002 / 風格配件</span></p>\r\n<div class="text_exposed_show">\r\n<p>|官網連結|<br /><a href="https://www.facebook.com/l.php?u=https%3A%2F%2Fcreativexpo.tw%2F&amp;h=cAQHUcqk9AQG2kpDRp00725Febq-A8X2y1LOxu_eEj63e_g&amp;enc=AZNm-7G0ogq9t1FbCbflKU_VXkP5XsNV8MI9qP04VEK2XWAMwr0wJb_eZAHK_emrY-Phs20i89fxEKFQVMQ2Ws8phsuoBPPDk1uBKePznne01_ZOiLunHP0YAhcxhfiPvm39BB-zuM7aGHxv_vwiIKFVgHU_aSwGXdeILhrZb1FIfwzOlNjXu3VUn7Bfr0XPU0nCxUuQX8-eaitAMnJ7_flc&amp;s=1" target="_blank" rel="nofollow">https://creativexpo.tw/</a></p>\r\n<p>現場多了很多從未曝光新商品！一起來搶先看吧！</p>\r\n<p><a class="_58cn" href="https://www.facebook.com/hashtag/chstudio2010?source=feed_text&amp;story_id=1085926624784287" type="" data-ft="{"><span class="_58cl">‪#&lrm;</span><span class="_58cm">chstudio2010‬</span></a> <a class="_58cn" href="https://www.facebook.com/hashtag/2016%E8%87%BA%E7%81%A3%E6%96%87%E5%8D%9A%E6%9C%83?source=feed_text&amp;story_id=1085926624784287" type="" data-ft="{"><span class="_58cl">‪#&lrm;</span><span class="_58cm">2016臺灣文博會‬</span></a> <a class="_58cn" href="https://www.facebook.com/hashtag/fashion?source=feed_text&amp;story_id=1085926624784287" type="" data-ft="{"><span class="_58cl">‪#&lrm;</span><span class="_58cm">fashion‬</span></a> <a class="_58cn" href="https://www.facebook.com/hashtag/gray?source=feed_text&amp;story_id=1085926624784287" type="" data-ft="{"><span class="_58cl">‪#&lrm;</span><span class="_58cm">gray‬</span></a> <a class="_58cn" href="https://www.facebook.com/hashtag/black?source=feed_text&amp;story_id=1085926624784287" type="" data-ft="{"><span class="_58cl">‪#&lrm;</span><span class="_58cm">black‬</span></a> <a class="_58cn" href="https://www.facebook.com/hashtag/design?source=feed_text&amp;story_id=1085926624784287" type="" data-ft="{"><span class="_58cl">‪#&lrm;</span><span class="_58cm">design‬</span></a> <a class="_58cn" href="https://www.facebook.com/hashtag/taiwan?source=feed_text&amp;story_id=1085926624784287" type="" data-ft="{"><span class="_58cl">‪#&lrm;</span><span class="_58cm">taiwan‬</span></a><a class="_58cn" href="https://www.facebook.com/hashtag/taichung?source=feed_text&amp;story_id=1085926624784287" type="" data-ft="{"><span class="_58cl">‪#&lrm;</span><span class="_58cm">taichung‬</span></a> <a class="_58cn" href="https://www.facebook.com/hashtag/%E5%8F%B0%E7%81%A3%E7%8D%A8%E7%AB%8B%E8%A8%AD%E8%A8%88%E5%B8%AB?source=feed_text&amp;story_id=1085926624784287" type="" data-ft="{"><span class="_58cl">‪#&lrm;</span><span class="_58cm">台灣獨立設計師‬</span></a> <a class="_58cn" href="https://www.facebook.com/hashtag/2016ss?source=feed_text&amp;story_id=1085926624784287" type="" data-ft="{"><span class="_58cl">‪#&lrm;</span><span class="_58cm">2016SS‬</span></a> <a class="_58cn" href="https://www.facebook.com/hashtag/%E6%98%A5%E5%A4%8F%E8%A3%9D?source=feed_text&amp;story_id=1085926624784287" type="" data-ft="{"><span class="_58cl">‪#&lrm;</span><span class="_58cm">春夏裝‬</span></a> <a class="_58cn" href="https://www.facebook.com/hashtag/%E8%97%8D%E7%81%B0?source=feed_text&amp;story_id=1085926624784287" type="" data-ft="{"><span class="_58cl">‪#&lrm;</span><span class="_58cm">藍灰‬</span></a></p>\r\n</div>', 'news', '4', '2016', '<p>真誠邀請你們～</p>\r\n<p>展覽資訊：<br />2016台灣文博會 CREATIVE EXPO TAIWAN<br />日期｜04/20-4/24 | 4/22~4/24一般民眾入場3天時間<span class="text_exposed_show"><br />時間｜AM10:00-PM06:00 (4/22、23至PM09:00)<br />地點｜松山文創園區 信義區光復南路133號<br />攤位｜4號倉庫 S4-002 / 風格配件</span></p>\r\n<div class="text_exposed_show">\r\n<p>|官網連結|<br /><a href="https://www.facebook.com/l.php?u=https%3A%2F%2Fcreativexpo.tw%2F&amp;h=cAQHUcqk9AQG2kpDRp00725Febq-A8X2y1LOxu_eEj63e_g&amp;enc=AZNm-7G0ogq9t1FbCbflKU_VXkP5XsNV8MI9qP04VEK2XWAMwr0wJb_eZAHK_emrY-Phs20i89fxEKFQVMQ2Ws8phsuoBPPDk1uBKePznne01_ZOiLunHP0YAhcxhfiPvm39BB-zuM7aGHxv_vwiIKFVgHU_aSwGXdeILhrZb1FIfwzOlNjXu3VUn7Bfr0XPU0nCxUuQX8-eaitAMnJ7_flc&amp;s=1" target="_blank" rel="nofollow">https://creativexpo.tw/</a></p>\r\n<p>現場多了很多從未曝光新商品！一起來搶先看吧！</p>\r\n<p><a class="_58cn" href="https://www.facebook.com/hashtag/chstudio2010?source=feed_text&amp;story_id=1085926624784287" type="" data-ft="{"><span class="_58cl">‪#&lrm;</span><span class="_58cm">chstudio2010‬</span></a> <a class="_58cn" href="https://www.facebook.com/hashtag/2016%E8%87%BA%E7%81%A3%E6%96%87%E5%8D%9A%E6%9C%83?source=feed_text&amp;story_id=1085926624784287" type="" data-ft="{"><span class="_58cl">‪#&lrm;</span><span class="_58cm">2016臺灣文博會‬</span></a> <a class="_58cn" href="https://www.facebook.com/hashtag/fashion?source=feed_text&amp;story_id=1085926624784287" type="" data-ft="{"><span class="_58cl">‪#&lrm;</span><span class="_58cm">fashion‬</span></a> <a class="_58cn" href="https://www.facebook.com/hashtag/gray?source=feed_text&amp;story_id=1085926624784287" type="" data-ft="{"><span class="_58cl">‪#&lrm;</span><span class="_58cm">gray‬</span></a> <a class="_58cn" href="https://www.facebook.com/hashtag/black?source=feed_text&amp;story_id=1085926624784287" type="" data-ft="{"><span class="_58cl">‪#&lrm;</span><span class="_58cm">black‬</span></a> <a class="_58cn" href="https://www.facebook.com/hashtag/design?source=feed_text&amp;story_id=1085926624784287" type="" data-ft="{"><span class="_58cl">‪#&lrm;</span><span class="_58cm">design‬</span></a> <a class="_58cn" href="https://www.facebook.com/hashtag/taiwan?source=feed_text&amp;story_id=1085926624784287" type="" data-ft="{"><span class="_58cl">‪#&lrm;</span><span class="_58cm">taiwan‬</span></a><a class="_58cn" href="https://www.facebook.com/hashtag/taichung?source=feed_text&amp;story_id=1085926624784287" type="" data-ft="{"><span class="_58cl">‪#&lrm;</span><span class="_58cm">taichung‬</span></a> <a class="_58cn" href="https://www.facebook.com/hashtag/%E5%8F%B0%E7%81%A3%E7%8D%A8%E7%AB%8B%E8%A8%AD%E8%A8%88%E5%B8%AB?source=feed_text&amp;story_id=1085926624784287" type="" data-ft="{"><span class="_58cl">‪#&lrm;</span><span class="_58cm">台灣獨立設計師‬</span></a> <a class="_58cn" href="https://www.facebook.com/hashtag/2016ss?source=feed_text&amp;story_id=1085926624784287" type="" data-ft="{"><span class="_58cl">‪#&lrm;</span><span class="_58cm">2016SS‬</span></a> <a class="_58cn" href="https://www.facebook.com/hashtag/%E6%98%A5%E5%A4%8F%E8%A3%9D?source=feed_text&amp;story_id=1085926624784287" type="" data-ft="{"><span class="_58cl">‪#&lrm;</span><span class="_58cm">春夏裝‬</span></a> <a class="_58cn" href="https://www.facebook.com/hashtag/%E8%97%8D%E7%81%B0?source=feed_text&amp;story_id=1085926624784287" type="" data-ft="{"><span class="_58cl">‪#&lrm;</span><span class="_58cm">藍灰‬</span></a></p>\r\n</div>', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2016-04-14 16:05:39', 1, 1),
(62, '會員規範', '<p>歡迎來到『C+H』會員中心！為保障您的權益，請於註冊成為『C+H』會員並使用『C+H』網站（以下簡稱本公司）服務前，請先詳細閱讀本同意書所有內容，尤其當您在線上點選「同意」鍵，表示您已註冊為本公司會員或同意使用本公司所提供之任何服務，即視為您已閱讀本同意書，並同意遵守以下所有同意書之會員規範。<br /> <br />一.<br />加入『C+H』會員：<br /> <br />1.遵守會員規範及法律規定您了解您於本公司註冊成為會員後，可使用本公司服務。當會員使用本公司服務時，即表示同意接受本公司之會員規範及所有注意事項之拘束，並遵守當地之法律規定。<br /> <br />2.加入本公司會員是完全免費，只要進行個人的一些基本資料登錄即可成為會員。但是您提供之個人資料若有填寫不實，或原所登錄之資料已不符合真實而未更新，或有任何誤導之嫌，本公司保留隨時終止您會員資格及使用各項服務資格之權利。<br /> <br />3.會員有義務妥善保管在本公司之帳號與密碼，並為此組帳號與密碼登入系統後所進行之一切活動負責。為維護會員自身權益，請勿將帳號與密碼洩露或提供予第三人知悉，或出借或轉讓他人使用。若會員發現帳號或密碼遭人非法使用或有任何異常破壞使用安全之情形時，應立即通知本公司。<br /> <br />4.會員規範之修改<br /> 本公司保留隨時修改本會員規範之權利，本公司將於修改會員規範時，於首頁公告修改之事實，不另作會員個別通知。如果會員不同意修改的內容，請勿繼續使用本公司服務。如果會員繼續使用本公司服務，則視為會員已同意並接受本規範該等增訂或修改內容之拘束。<br /> <br />5.服務之停止與更改<br /> 本公司保留隨時停止或更改各項服務內容或終止任一會員帳戶服務之權利，且無需事先通知會員。無論任何情形，就停止或更改服務或終止會員帳戶服務所可能產生之困擾、不便或損害，本公司對任何會員或第三人均不負任何責任。<br /> <br />6.會員應瞭解並同意，本公司可能因公司、其他協力廠商或相關電信業者網路系統軟硬體設備之故障或失靈、或人為操作上之疏失而全部或一部中斷、暫時無法使用、遲延、或造成資料傳輸或儲存上之錯誤、或遭第三人侵入系統篡改或偽造變造資料等，會員不得因此而要求任何補償或賠償。<br /> <br />二.<br />加入會員的用途與便利：<br /> <br />1.會員可享有「訂單查詢、匯款回報&hellip;等等。」<br /> <br />2.基於和會員保持良好互動，本公司會不定期於網站的最新消息發佈訊息。<br /> <br />三.<br />會員身份終止和本公司的義務與服務：<br /> <br />1.若會員決定終止本公司會員資格，請直接以電子郵件的方式通知我們，我們會儘快註銷您的會員資料。<br /> <br />2.會員有通知取消本公司會員資格之義務，並自停止會員身份日起，即喪失所有本公司所提供之優惠及權益。<br /> <br />3.為避免惡意情事發生致使會員應享權益損失，當會員通知本公司停止會員身份時，本公司將再次以電話確認無誤後，再進行註銷會員資格。<br /> <br />四.<br />會員的隱私權保障：<br /> <br />1.<br />除了以下四點情況(除外條款)：<br /> A.中華民國法律之相關規定。<br /> B.受司法機關或其他有權機關基於法定程序之要求。<br /> C.為維護其他會員或第三人之權益。<br /> <br />2.<br />對於會員所登錄或留存之個人資料，在未獲得會員同意以前，本公司絕不對外揭露會員之姓名、聯絡地址、聯絡電話、電子郵件地址及其他依法受保護之個人資料。<br /> <br />五.<br />會員其他相關規範<br /> <br />1.<br />本公司對於會員使用各項服務、或無法使用各項服務所致生之任何直接、間接、衍生、或特別損害，不負任何賠償責任。若會員使用之服務係有對價者，本公司僅於會員所付之對價範圍內，負賠償責任。<br /> <br />2.<br />上述賠償責任限制，若依法為不得限制者，則限制規定將不予適用。<br /> <br />3.<br />本公司網站上之所有著作及資料，其著作權、專利權、商標、營業秘密、其他智慧財產權、所有權或其他權利，均為本公司或其權利人所有，除事先經本公司或其權利人之合法授權外，會員不得擅自重製、傳輸、改作、編輯或以其他任何形式、基於任何目的加以使用，否則應負所有法律責任。<br /> <br />4.<br />因會員違反相關法令或違背本同意書之任一會員條款，致本公司或其關係企業、受僱人、受託人、代理人及其他相關履行輔助人因此而受有損害或支出費用（包括且限於因進行民事、刑事及行政程序所支出之律師費用）時，會員應負擔損害賠償責任或填補其費用。<br /> <br />5.<br />本同意書之解釋及適用、以及會員因使用本服務而與本公司間所生之權利義務關係，應依中華民國法令解釋適用之。其因此所生之爭議，以台灣台中地方法院為第一審管。</p>', 'member_rule', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, '2016-02-23 23:24:08', NULL, 1);

-- --------------------------------------------------------

--
-- 表的結構 `epaper_set`
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
-- 表的結構 `file_set`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=140 ;

--
-- 轉存資料表中的資料 `file_set`
--

INSERT INTO `file_set` (`file_d_id`, `file_id`, `file_type`, `file_name`, `file_title`, `file_link1`, `file_link2`, `file_link3`, `file_link4`, `file_link5`, `file_show_type`) VALUES
(7, 8, 'image', 'about_8.jpg', '關於C+H', 'upload_image/about/about_8.jpg', 'upload_image/about/about_8_s100.jpg', NULL, NULL, NULL, 1),
(10, 20, 'image', 'news_20.jpg', NULL, 'upload_image/news/news_20.jpg', 'upload_image/news/news_20_s100.jpg', NULL, NULL, NULL, 1),
(19, 51, 'image', 'products_51.jpg', NULL, 'upload_image/products/products_51.jpg', 'upload_image/products/products_51_s100.jpg', 'upload_image/products/products_51_s301.jpg', NULL, NULL, 1),
(19, 52, 'image', 'products_52.jpg', NULL, 'upload_image/products/products_52.jpg', 'upload_image/products/products_52_s100.jpg', 'upload_image/products/products_52_s301.jpg', NULL, NULL, 1),
(19, 53, 'image', 'products_53.jpg', NULL, 'upload_image/products/products_53.jpg', 'upload_image/products/products_53_s100.jpg', 'upload_image/products/products_53_s301.jpg', NULL, NULL, 1),
(19, 54, 'image', 'products_54.jpg', NULL, 'upload_image/products/products_54.jpg', 'upload_image/products/products_54_s100.jpg', 'upload_image/products/products_54_s301.jpg', NULL, NULL, 1),
(23, 67, 'file', 'news_67.jpg', '預購單', 'upload_file/news/news_67.jpg', NULL, NULL, NULL, NULL, 0),
(26, 81, 'image', 'products_81.jpg', NULL, 'upload_image/products/products_81.jpg', 'upload_image/products/products_81_s100.jpg', 'upload_image/products/products_81_s301.jpg', NULL, NULL, 1),
(26, 82, 'image', 'products_82.jpg', NULL, 'upload_image/products/products_82.jpg', 'upload_image/products/products_82_s100.jpg', 'upload_image/products/products_82_s301.jpg', NULL, NULL, 1),
(26, 83, 'image', 'products_83.jpg', NULL, 'upload_image/products/products_83.jpg', 'upload_image/products/products_83_s100.jpg', 'upload_image/products/products_83_s301.jpg', NULL, NULL, 1),
(26, 84, 'image', 'products_84.jpg', NULL, 'upload_image/products/products_84.jpg', 'upload_image/products/products_84_s100.jpg', 'upload_image/products/products_84_s301.jpg', NULL, NULL, 1),
(35, 108, 'image', 'news_108.jpg', NULL, 'upload_image/news/news_108.jpg', 'upload_image/news/news_108_s100.jpg', NULL, NULL, NULL, 1),
(45, 109, 'image', 'news_109.jpg', NULL, 'upload_image/news/news_109.jpg', 'upload_image/news/news_109_s100.jpg', NULL, NULL, NULL, 0),
(54, 118, 'image', 'banners_118.jpg', NULL, 'upload_image/banners/banners_118.jpg', 'upload_image/banners/banners_118_s100.jpg', NULL, NULL, NULL, 1),
(55, 122, 'image', 'news_122.jpg', NULL, 'upload_image/news/news_122.jpg', 'upload_image/news/news_122_s100.jpg', NULL, NULL, NULL, 1),
(58, 123, 'image', 'banners_123.jpg', 'Banner1', 'upload_image/banners/banners_123.jpg', 'upload_image/banners/banners_123_s100.jpg', NULL, NULL, NULL, 1),
(60, 124, 'image', 'products_124.jpg', NULL, 'upload_image/products/products_124.jpg', 'upload_image/products/products_124_s100.jpg', 'upload_image/products/products_124_s301.jpg', NULL, NULL, 1),
(60, 125, 'image', 'products_125.jpg', NULL, 'upload_image/products/products_125.jpg', 'upload_image/products/products_125_s100.jpg', 'upload_image/products/products_125_s301.jpg', NULL, NULL, 1),
(60, 126, 'image', 'products_126.jpg', NULL, 'upload_image/products/products_126.jpg', 'upload_image/products/products_126_s100.jpg', 'upload_image/products/products_126_s301.jpg', NULL, NULL, 1),
(61, 127, 'image', 'news_127.jpg', NULL, 'upload_image/news/news_127.jpg', 'upload_image/news/news_127_s100.jpg', NULL, NULL, NULL, 1),
(60, 130, 'image', 'products_130.jpg', NULL, 'upload_image/products/products_130.jpg', 'upload_image/products/products_130_s100.jpg', 'upload_image/products/products_130_s301.jpg', NULL, NULL, 1),
(20, 131, 'image', 'products_131.jpg', NULL, 'upload_image/products/products_131.jpg', 'upload_image/products/products_131_s100.jpg', 'upload_image/products/products_131_s301.jpg', NULL, NULL, 1),
(20, 132, 'image', 'products_132.jpg', NULL, 'upload_image/products/products_132.jpg', 'upload_image/products/products_132_s100.jpg', 'upload_image/products/products_132_s301.jpg', NULL, NULL, 1),
(20, 133, 'image', 'products_133.jpg', NULL, 'upload_image/products/products_133.jpg', 'upload_image/products/products_133_s100.jpg', 'upload_image/products/products_133_s301.jpg', NULL, NULL, 1),
(20, 134, 'image', 'products_134.jpg', NULL, 'upload_image/products/products_134.jpg', 'upload_image/products/products_134_s100.jpg', 'upload_image/products/products_134_s301.jpg', NULL, NULL, 1),
(18, 135, 'image', 'products_135.jpg', NULL, 'upload_image/products/products_135.jpg', 'upload_image/products/products_135_s100.jpg', 'upload_image/products/products_135_s301.jpg', NULL, NULL, 1),
(18, 136, 'image', 'products_136.jpg', NULL, 'upload_image/products/products_136.jpg', 'upload_image/products/products_136_s100.jpg', 'upload_image/products/products_136_s301.jpg', NULL, NULL, 1),
(18, 137, 'image', 'products_137.jpg', NULL, 'upload_image/products/products_137.jpg', 'upload_image/products/products_137_s100.jpg', 'upload_image/products/products_137_s301.jpg', NULL, NULL, 1),
(18, 138, 'image', 'products_138.jpg', NULL, 'upload_image/products/products_138.jpg', 'upload_image/products/products_138_s100.jpg', 'upload_image/products/products_138_s301.jpg', NULL, NULL, 1),
(7, 139, 'image', 'about_139.jpg', '關於C+H', 'upload_image/about/about_139.jpg', 'upload_image/about/about_139_s100.jpg', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- 表的結構 `member_set`
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
  `m_country` tinytext COLLATE utf8_unicode_ci,
  `m_country_code` tinytext COLLATE utf8_unicode_ci,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=236 ;

--
-- 轉存資料表中的資料 `member_set`
--

INSERT INTO `member_set` (`m_id`, `m_class2`, `m_class3`, `m_name`, `m_account`, `m_password`, `m_gender`, `m_birthyear`, `m_birthmonth`, `m_birthday`, `m_email`, `m_phone`, `m_cellphone`, `m_zip`, `m_city`, `m_canton`, `m_address`, `m_country`, `m_country_code`, `m_content`, `m_sn`, `m_fname`, `m_item`, `m_faddress`, `m_fzip`, `m_fcity`, `m_fcanton`, `m_area`, `m_map`, `m_epaper`, `m_level`, `m_active`, `m_date`) VALUES
(179, 'normal', NULL, 'williams', 'william@yahoo.com', 'fd820a2b4461bddd116c1518bc4b0f77', NULL, '2010', '01', '01', 'williams@yahoo.com', '0937452147', NULL, 821, '高雄市', '路竹區', '成龍村成龍1917號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-11 13:35:09'),
(180, NULL, NULL, '高興', 'link7311@gmail.com', '381ea8c597e366e5b27d847bb721e420', '1', NULL, NULL, NULL, 'link7311@gmail.com', '0937100194', NULL, 407, '台中市', '西屯區', '文華路150巷31號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2015-09-13 23:12:14'),
(181, NULL, NULL, '高高', 'studio.goods@gmail.com', '381ea8c597e366e5b27d847bb721e420', '1', NULL, NULL, NULL, 'studio.goods@gmail.com', '0937100194', NULL, 407, '台中市', '西屯區', '文華路150巷31號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2015-09-14 01:02:30'),
(184, NULL, NULL, '威廉', 'williambossmailg@gmail.com', '240154152063f20a59e078e6d9946c75', '1', '2000', '02', '02', 'williambossmailg@gmail.com', '0987456321', NULL, 824, '高雄市', '燕巢區', '鄉成龍村成龍197號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-14 02:13:29'),
(226, NULL, NULL, 'williamshsu', 'williamshsu@gmail.com', '045b9c5bbe1ac11a293460dcee026865', '2', '2015', '10', '31', 'williamshsu@gmail.com', '08-7555478', NULL, 925, '屏東縣', '新埤鄉', '成龍路190號1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-10-15 23:20:06'),
(227, NULL, NULL, '威廉', 'williamboss@pchome.com.tw', 'ead159cebe79f55b6876240906fbf47f', '1', '1979', '05', '09', 'williamboss@pchome.com.tw', '08-7456987', NULL, 909, '屏東縣', '麟洛鄉', '中山路87號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-11-02 16:17:36'),
(228, NULL, NULL, 'williamboss2', 'williamboss2@pchome.com.tw', 'eae9f6ebed56f19d465a3a35ffd68901', '1', '1979', '05', '24', 'williamboss2@pchome.com.tw', '0984456324', NULL, 821, '高雄市', '路竹區', '中華路120號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-11-05 15:36:30'),
(229, NULL, NULL, 'williamshsu3', 'williamshsu3@gmail.com', 'a959a04f30eca63bc93e74119d561525', '1', '1980', '07', '31', 'williamshsu3@gmail.com', '0987463254', NULL, 951, '台東縣', '綠島鄉', '地址地址地址地址地址地址', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2016-02-24 16:35:10'),
(230, NULL, NULL, 'sssssss', 'wsss@yahoo.com', '8dfd6c2364ea784cf3db56235f47bfcd', '1', '2016', '03', '24', 'wsss@yahoo.com', '0984463257', NULL, 900, '屏東縣', '屏東市', 'wsss@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2016-03-31 16:33:24'),
(231, NULL, NULL, 'ttttttttttt', 'wwwww@gmail.com', 'bf26ca27bdb6b8ebbc6282d44c32abce', '0', '2016', '04', '01', 'wwwww@gmail.com', '08-7444574', NULL, 110, '台北市', '信義區', 'wwwww@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2016-03-31 16:38:22'),
(232, NULL, NULL, 'ttttttttttt', 'wwwww@gmail.com', 'bf26ca27bdb6b8ebbc6282d44c32abce', '0', '2016', '04', '01', 'wwwww@gmail.com', '08-7444574', NULL, 110, '台北市', '信義區', 'wwwww@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2016-03-31 16:39:16'),
(233, NULL, NULL, 'vvvvvvvvvvvv', 'sss@yahoo.com', '0b2e349f4b0d519a764f20e2a3460d12', '1', '2016', '03', '02', 'sss@yahoo.com', '0974587965', NULL, 110, '台北市', '信義區', 'sss@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2016-03-31 16:40:09'),
(234, NULL, NULL, 'ffffffffff', 'cccccc@yahoo.com.tw', '61a9e4e548b4a33b537bbf1d798e829c', '1', '2016', '03', '19', 'cccccc@yahoo.com.tw', '0963214587', NULL, 110, '台北市', '信義區', 'cccccc@yahoo.com.tw', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2016-03-31 16:46:36'),
(235, NULL, NULL, 'williamshsu22', 'williamshsu2@yahoo.com', '3ade429db9a1c07d83c84b30120ce2d5', NULL, '1988', '05', '26', 'williamshsu22@yahoo.com', '+8867444510', NULL, 90911, NULL, NULL, '台中北市豐原區三民路44巷11號', 'Taiwan (台灣)', 'tw', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2016-04-19 14:10:00');

-- --------------------------------------------------------

--
-- 表的結構 `menu`
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
-- 轉存資料表中的資料 `menu`
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
(9, 'download', 'download_list', '#main_menu_9', NULL, NULL, NULL, NULL, NULL),
(10, 'freight', 'freight_list', '#main_menu_10', NULL, NULL, NULL, NULL, NULL),
(11, 'location', 'location_list', '#main_menu_11', NULL, NULL, NULL, NULL, NULL),
(12, 'links', 'links_list', '#main_menu_12', NULL, NULL, NULL, NULL, NULL),
(13, 'download', 'download_list', '#main_menu_13', NULL, NULL, NULL, NULL, NULL),
(14, 'farmer', 'farmer_list', '#main_menu_14', NULL, NULL, NULL, NULL, NULL),
(15, 'shopProcess', 'shopProcess_list', '#main_menu_15', NULL, NULL, NULL, NULL, NULL),
(16, 'message', 'message_list', '#main_menu_16', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的結構 `message_set`
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
-- 表的結構 `m_baskets`
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
  `file_link3` tinytext COLLATE utf8_unicode_ci,
  `subtotal` int(11) DEFAULT '0',
  `mb_ip` tinytext COLLATE utf8_unicode_ci,
  `mb_time` datetime DEFAULT NULL,
  `m_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`basketID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- 轉存資料表中的資料 `m_baskets`
--

INSERT INTO `m_baskets` (`basketID`, `basketSession`, `itemID`, `productID`, `class`, `productName`, `qty`, `qtyLimit`, `serial_num`, `d_inventory`, `d_size1`, `d_size2`, `d_price1`, `d_price2`, `d_price3`, `d_sale`, `d_price4`, `unit`, `perUnit`, `d_new_product`, `file_link2`, `file_link3`, `subtotal`, `mb_ip`, `mb_time`, `m_id`) VALUES
(1, 'h70ib5sembeldceiknra4lk2i4', NULL, 26, 1, 'pit 生肌乳 30ML', '1', 20, '', NULL, NULL, NULL, 1115, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s100.jpg', 'upload_image/products/products_84_s301.jpg', 1115, '::1', '2015-12-14 17:05:45', NULL),
(2, 'mi9q7c7oeob3am67hgf5tgu446', NULL, 26, 1, 'pit 生肌乳 30ML', '1', 20, '', NULL, NULL, NULL, 1115, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s100.jpg', 'upload_image/products/products_84_s301.jpg', 1115, '::1', '2016-02-23 22:16:12', NULL),
(7, 'kmtui2sg0d5vhb9tps168sd364', NULL, 60, 1, 'KHÁNG修護凝露12ML', '1', 10, '', NULL, NULL, NULL, 480, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_130_s100.jpg', 'upload_image/products/products_130_s301.jpg', 480, '::1', '2016-02-24 03:06:51', NULL),
(9, '2rjhjfc96j4lh0n7669fjvnic5', NULL, 26, 1, 'pit 生肌乳 30ML', '1', 20, '', NULL, NULL, NULL, 1115, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s100.jpg', 'upload_image/products/products_84_s301.jpg', 1115, '::1', '2016-02-24 16:38:03', NULL),
(10, 'v9da6uevvc9q07a45fu4omcoh5', NULL, 60, 1, 'KHÁNG修護凝露12ML', '1', 10, '', NULL, NULL, NULL, 499, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_130_s100.jpg', 'upload_image/products/products_130_s301.jpg', 499, '::1', '2016-03-23 14:59:19', NULL),
(15, 'ah9bp75h7dasl4volhod6iaqb3', NULL, 60, 1, 'KHÁNG修護凝露12ML', '1', 10, '', NULL, NULL, NULL, 499, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_130_s100.jpg', 'upload_image/products/products_130_s301.jpg', 499, '::1', '2016-04-01 16:48:29', NULL);

-- --------------------------------------------------------

--
-- 表的結構 `order_item`
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
  `pic2` tinytext COLLATE utf8_unicode_ci,
  `d_new_p` tinyint(2) DEFAULT '0',
  `subtotal` int(11) DEFAULT '0',
  PRIMARY KEY (`oi_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- 轉存資料表中的資料 `order_item`
--

INSERT INTO `order_item` (`oi_id`, `o_id`, `d_id`, `d_class`, `d_name`, `price_status`, `serial_num`, `qty`, `d_price1`, `d_price2`, `d_price3`, `d_sale`, `d_price4`, `unit`, `perUnit`, `pic`, `pic2`, `d_new_p`, `subtotal`) VALUES
(1, 1, 26, 1, 'pit 生肌乳 30ML', NULL, NULL, 2, 1115, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_84_s301.jpg', 'upload_image/products/products_84_s100.jpg', NULL, 2230),
(2, 1, 18, 1, 'pit 生肌乳 50ML', NULL, NULL, 1, 1800, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_138_s301.jpg', 'upload_image/products/products_138_s100.jpg', NULL, 1800),
(3, 2, 60, 1, 'KHÁNG修護凝露12ML', NULL, NULL, 2, 499, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_130_s301.jpg', 'upload_image/products/products_130_s100.jpg', NULL, 998),
(4, 3, 26, 1, 'pit 生肌乳 30ML', NULL, NULL, 1, 1115, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_84_s301.jpg', 'upload_image/products/products_84_s100.jpg', NULL, 1115),
(5, 4, 26, 1, 'pit 生肌乳 30ML', NULL, NULL, 1, 1115, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_84_s301.jpg', 'upload_image/products/products_84_s100.jpg', NULL, 1115),
(6, 6, 20, 1, 'pit 生肌乳 20ML', NULL, NULL, 1, 900, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_134_s301.jpg', 'upload_image/products/products_134_s100.jpg', NULL, 900),
(7, 7, 20, 1, 'pit 生肌乳 20ML', NULL, NULL, 1, 900, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_134_s301.jpg', 'upload_image/products/products_134_s100.jpg', NULL, 900),
(8, 8, 26, 1, 'pit 生肌乳 30ML', NULL, NULL, 2, 1115, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_84_s301.jpg', 'upload_image/products/products_84_s100.jpg', NULL, 2230),
(9, 8, 60, 1, '灰藍洋裝/可拆解式上衣', NULL, NULL, 1, 4280, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_130_s301.jpg', 'upload_image/products/products_130_s100.jpg', NULL, 4280),
(10, 9, 60, 1, '灰藍洋裝/可拆解式上衣', NULL, NULL, 1, 4280, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_130_s301.jpg', 'upload_image/products/products_130_s100.jpg', NULL, 4280);

-- --------------------------------------------------------

--
-- 表的結構 `order_set`
--

CREATE TABLE IF NOT EXISTS `order_set` (
  `o_id` int(11) NOT NULL AUTO_INCREMENT,
  `o_number` tinytext COLLATE utf8_unicode_ci,
  `client` tinytext COLLATE utf8_unicode_ci,
  `c_gender` tinyint(2) DEFAULT NULL,
  `phone` varchar(23) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cellphone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` tinytext COLLATE utf8_unicode_ci,
  `country_code` tinytext COLLATE utf8_unicode_ci,
  `address` tinytext COLLATE utf8_unicode_ci,
  `zipcode` tinytext COLLATE utf8_unicode_ci,
  `r_client` tinytext COLLATE utf8_unicode_ci,
  `r_gender` tinyint(2) DEFAULT NULL,
  `r_phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `r_cellphone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `r_email` tinytext COLLATE utf8_unicode_ci,
  `r_country_code` tinytext COLLATE utf8_unicode_ci,
  `r_address` tinytext COLLATE utf8_unicode_ci,
  `r_zipcode` tinytext COLLATE utf8_unicode_ci,
  `invoice` int(11) DEFAULT NULL,
  `insn` text COLLATE utf8_unicode_ci,
  `inname` text COLLATE utf8_unicode_ci,
  `in_zipcode` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- 轉存資料表中的資料 `order_set`
--

INSERT INTO `order_set` (`o_id`, `o_number`, `client`, `c_gender`, `phone`, `cellphone`, `email`, `country_code`, `address`, `zipcode`, `r_client`, `r_gender`, `r_phone`, `r_cellphone`, `r_email`, `r_country_code`, `r_address`, `r_zipcode`, `invoice`, `insn`, `inname`, `in_zipcode`, `inadd`, `in_phone`, `payment`, `card_status`, `cash_status`, `bank_status`, `transport_status`, `m_id`, `tfee`, `SubTotalAll`, `GrandTotal`, `transport`, `delivery`, `TrackingNum`, `remitter`, `remitter_AC`, `remitter_money`, `remitter_time`, `remitter_active`, `datetime`, `notation`, `m_account`, `RID`) VALUES
(1, 'TD15120100001', '威廉', 1, NULL, '08-7456987', 'williamboss@pchome.com.tw', NULL, '屏東縣麟洛鄉中山路87號', '909', '威廉', 1, NULL, '08-7456987', 'williamboss@pchome.com.tw', NULL, '屏東縣麟洛鄉中山路87號', '909', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, 227, 100, 4030, 4130, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-12-01 15:27:05', '何時會出貨呢?', 'williamboss@pchome.com.tw', NULL),
(2, 'TD16022400001', 'williamshsu3', 1, NULL, '0987463254', 'williamshsu3@gmail.com', NULL, '台東縣綠島鄉地址地址地址地址地址地址', '951', 'williams', 1, NULL, '0987463254', 'williamshsu3@gmail.com', NULL, '台東縣綠島鄉地址地址地址地址地址地址', '951', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, NULL, 0, 998, 998, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2016-02-24 16:33:39', NULL, NULL, NULL),
(3, 'TD16033100001', 'sssssss', 1, NULL, '0984463257', 'wsss@yahoo.com', NULL, '屏東縣屏東市wsss@yahoo.com', '900', 'sssssss', 1, NULL, '0984463257', 'wsss@yahoo.com', NULL, '屏東縣屏東市wsss@yahoo.com', '900', NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, NULL, 0, 1115, 1115, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2016-03-31 16:32:04', 'wsss@yahoo.com', NULL, NULL),
(4, 'TD16033100002', 'ttttttttttt', 0, NULL, '08-7444574', 'wwwww@gmail.com', NULL, '台北市信義區wwwww@gmail.com', '110', 'ttttttttttt', 0, NULL, '08-7444574', 'wwwww@gmail.com', NULL, '台北市信義區wwwww@gmail.com', '110', NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, NULL, 0, 1115, 1115, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2016-03-31 16:37:42', NULL, NULL, NULL),
(5, 'TD16033100003', 'ttttttttttt', 0, NULL, '08-7444574', 'wwwww@gmail.com', NULL, '台北市信義區wwwww@gmail.com', '110', 'ttttttttttt', 0, NULL, '08-7444574', 'wwwww@gmail.com', NULL, '台北市信義區wwwww@gmail.com', '110', NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, 232, 0, 1115, 1115, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2016-03-31 16:37:42', NULL, NULL, NULL),
(6, 'TD16033100004', 'vvvvvvvvvvvv', 1, NULL, '0974587965', 'sss@yahoo.com', NULL, '台北市信義區sss@yahoo.com', '110', 'vvvvvvvvvvvv', 1, NULL, '0974587965', 'sss@yahoo.com', NULL, '台北市信義區sss@yahoo.com', '110', NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, 233, 0, 900, 900, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2016-03-31 16:39:38', NULL, NULL, NULL),
(7, 'TD16033100005', 'ffffffffff', 1, NULL, '0963214587', 'cccccc@yahoo.com.tw', NULL, '台北市信義區cccccc@yahoo.com.tw', '110', 'ffffffffff', 1, NULL, '0963214587', 'cccccc@yahoo.com.tw', NULL, '台北市信義區cccccc@yahoo.com.tw', '110', NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, 234, 0, 900, 900, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2016-03-31 16:46:03', NULL, 'cccccc@yahoo.com.tw', NULL),
(8, 'CHS16041900001', '很好設計', NULL, NULL, '0987458745', 'will@yahoo.com', NULL, '台中市豐原區三民路44巷11號', '8456', '很好設計', NULL, NULL, '0987458745', 'will@yahoo.com', NULL, '台中市豐原區三民路44巷11號', '8456', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, NULL, 0, 6510, 6510, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2016-04-19 12:51:36', '備註哦', 'will@yahoo.com', NULL),
(9, 'CHS16041900002', '很好設計2', NULL, NULL, '+886975487412', 'ewi@yahoo.com', 'tw', 'Taiwan (台灣)台中市豐原區三民路44巷11號', '87459', '很好設計2', NULL, NULL, '+886975487412', 'ewi@yahoo.com', 'tw', 'Taiwan (台灣)台中市豐原區三民路44巷11號', '87459', NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, NULL, 0, 4280, 4280, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2016-04-19 12:58:10', '備註\r\n備註備註', 'ewi@yahoo.com', NULL);

-- --------------------------------------------------------

--
-- 表的結構 `response_set`
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
-- 表的結構 `terms`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- 轉存資料表中的資料 `terms`
--

INSERT INTO `terms` (`term_id`, `name`, `slug`, `term_group`, `term_active`, `term_sort`) VALUES
(1, '上衣', '%E4%B8%8A%E8%A1%A3', 0, 1, 1),
(3, '洋裝', '%E6%B4%8B%E8%A3%9D', 0, 1, 2),
(4, '褲子', '%E8%A4%B2%E5%AD%90', 0, 1, 3),
(5, '外套', '%E5%A4%96%E5%A5%97', 0, 1, 4),
(6, '帽子', '%E5%B8%BD%E5%AD%90', 0, 1, 5),
(7, '包包', '%E5%8C%85%E5%8C%85', 0, 1, 6),
(8, '配件', '%E9%85%8D%E4%BB%B6', 0, 1, 7);

-- --------------------------------------------------------

--
-- 表的結構 `term_relationships`
--

CREATE TABLE IF NOT EXISTS `term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 轉存資料表中的資料 `term_relationships`
--

INSERT INTO `term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(13, 2, 2),
(17, 2, 1),
(18, 3, 3),
(19, 1, 2),
(20, 3, 2),
(26, 3, 1),
(60, 1, 1);

-- --------------------------------------------------------

--
-- 表的結構 `term_taxonomy`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- 轉存資料表中的資料 `term_taxonomy`
--

INSERT INTO `term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'post_tag', '', 0, 0),
(3, 3, 'post_tag', '', 0, 0),
(4, 4, 'post_tag', '', 0, 0),
(5, 5, 'post_tag', '', 0, 0),
(6, 6, 'post_tag', '', 0, 0),
(7, 7, 'post_tag', '', 0, 0),
(8, 8, 'post_tag', '', 0, 0);

-- --------------------------------------------------------

--
-- 表的結構 `vitae_set`
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
-- 表的結構 `webcount`
--

CREATE TABLE IF NOT EXISTS `webcount` (
  `count_id` int(11) NOT NULL AUTO_INCREMENT,
  `count_ip` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `count_time` datetime DEFAULT NULL,
  PRIMARY KEY (`count_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的結構 `zipcode`
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

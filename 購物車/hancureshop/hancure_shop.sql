-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- 主機: localhost
-- 建立日期: Jun 01, 2016, 06:15 AM
-- 伺服器版本: 5.0.51
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- 資料庫: `hancure_shop`
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
  `user_password` tinytext collate utf8_unicode_ci,
  `user_level` int(4) default NULL,
  `user_limit` tinyint(4) default '2',
  `user_active` tinyint(1) default '1',
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

-- 
-- 列出以下資料庫的數據： `admin`
-- 

INSERT INTO `admin` VALUES (1, 'hancure', '548b24803e2532289f55570090d3867b', 1, 1, 1);
INSERT INTO `admin` VALUES (7, 'tester', '548b24803e2532289f55570090d3867b', 2, 2, 1);
INSERT INTO `admin` VALUES (8, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1, 1);

-- --------------------------------------------------------

-- 
-- 資料表格式： `a_set`
-- 

CREATE TABLE `a_set` (
  `a_id` int(11) NOT NULL auto_increment,
  `a_title` varchar(30) collate utf8_unicode_ci default NULL,
  `a_1` int(11) default NULL,
  `a_2` int(11) default NULL,
  `a_3` int(11) default NULL,
  `a_4` int(11) default NULL,
  `a_5` int(11) default NULL,
  `a_6` int(11) default NULL,
  `a_7` int(11) default NULL,
  `a_8` int(11) default NULL,
  `a_9` int(11) default NULL,
  `a_10` int(11) default NULL,
  `a_11` int(11) default NULL,
  `a_12` int(11) default NULL,
  `a_13` int(11) default NULL,
  `a_14` int(11) default NULL,
  `a_15` int(11) default NULL,
  `a_16` int(11) default NULL,
  PRIMARY KEY  (`a_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- 
-- 列出以下資料庫的數據： `a_set`
-- 

INSERT INTO `a_set` VALUES (1, '系統管理員', 210, 210, 210, 210, 105, 105, 15, 15, 15, 15, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `a_set` VALUES (2, '資料更新員', 0, 0, 0, 0, 15, 15, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

-- 
-- 資料表格式： `baskets`
-- 

CREATE TABLE `baskets` (
  `basketID` int(11) NOT NULL auto_increment,
  `basketSession` varchar(50) collate utf8_unicode_ci default NULL,
  `productID` int(11) default NULL,
  `name` tinytext collate utf8_unicode_ci,
  `qty` tinytext collate utf8_unicode_ci,
  `serial_num` tinytext collate utf8_unicode_ci,
  `price_status` tinyint(2) default NULL,
  `dir_price` int(11) default '0',
  `coll_price_1` int(11) default '0',
  `coll_price_2` int(11) default '0',
  `coll_price_3` int(11) default '0',
  `coll_price_4` int(11) default '0',
  `coll_tiem_1` int(11) default '0',
  `coll_tiem_2` int(11) default '0',
  `coll_tiem_3` int(11) default '0',
  `coll_tiem_4` int(11) default '0',
  `discount` int(11) default '0',
  `discount_num` int(11) default '0',
  `freight` int(11) default '1',
  `freight_costs` int(11) default '0',
  `assembly_costs` int(11) default '0',
  `delivery_fee` int(11) default '0',
  `weight` int(11) default '0',
  `subtotal` int(11) default '0',
  PRIMARY KEY  (`basketID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- 列出以下資料庫的數據： `baskets`
-- 


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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- 
-- 列出以下資料庫的數據： `class_set`
-- 

INSERT INTO `class_set` VALUES (1, '產品資訊', NULL, NULL, NULL, NULL, 1, 'newsC', 2);
INSERT INTO `class_set` VALUES (3, '小知識', NULL, NULL, NULL, NULL, 1, 'newsC', 3);
INSERT INTO `class_set` VALUES (4, '活動公告', NULL, NULL, NULL, NULL, 1, 'newsC', 1);

-- --------------------------------------------------------

-- 
-- 資料表格式： `data_set`
-- 

CREATE TABLE `data_set` (
  `d_id` int(11) NOT NULL auto_increment,
  `d_title` tinytext collate utf8_unicode_ci,
  `d_content` text collate utf8_unicode_ci,
  `d_class1` tinytext collate utf8_unicode_ci,
  `d_class2` text collate utf8_unicode_ci,
  `d_class3` text collate utf8_unicode_ci,
  `d_class4` text collate utf8_unicode_ci,
  `d_class5` text collate utf8_unicode_ci,
  `d_class6` text collate utf8_unicode_ci,
  `d_tag` text collate utf8_unicode_ci,
  `d_data1` text collate utf8_unicode_ci,
  `d_data2` text collate utf8_unicode_ci,
  `d_data3` text collate utf8_unicode_ci,
  `d_price1` int(11) default '0',
  `d_price2` int(11) default '0',
  `d_price3` int(11) default '0',
  `d_inventory` tinyint(4) default '0',
  `d_sale` tinyint(1) default '0',
  `d_new_product` tinyint(1) default '0',
  `d_date` datetime default NULL,
  `d_active` tinyint(1) default '1',
  `d_sort` int(11) default '1',
  PRIMARY KEY  (`d_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=74 ;

-- 
-- 列出以下資料庫的數據： `data_set`
-- 

INSERT INTO `data_set` VALUES (7, '關於我們', '漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。\r\n\r\n傳承於中醫千年智慧的漢速敷，最早之初乃是由吳信誼醫師將珍珠、龍腦等珍貴藥材製成現代劑型應用於臨床外用，因為此藥膏生肌長肉效果迅速與藥材珍貴因此取名為黑玉生肌膏，療效受到皮膚病及傷口患者肯定，方便使用的劑型更大受歡迎，讓我們決心投入中藥漢方的外用市場。', 'about', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2015-11-04 08:23:42', 1, 1);
INSERT INTO `data_set` VALUES (8, '聯絡我們', '高雄市三民區鼎中路213號3F', 'contact', '22.663720, 120.319145', '+886 7 3106766', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2015-11-24 09:27:35', 1, 1);
INSERT INTO `data_set` VALUES (10, 'pit 生肌乳', '<p>天然修護、舒緩肌膚不適、<br />提升肌膚對環境傷害的保護力,<br />可以使用在臉部或身體任何部位, 私密嬌嫩部位表面亦可使用。</p>\r\n<p>強化表皮防護能力<br />舒緩各式乾裂脫屑<br />舒緩乾燥引起的皮膚癢</p>\r\n<p>成分：中藥材</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：高雄</p>\r\n<p>商品圖片僅供參考</p>', 'news', '1', '2015', '<p>天然修護、舒緩肌膚不適、<br />提升肌膚對環境傷害的保護力,<br />可以使用在臉部或身體任何部位, 私密嬌嫩部位表面亦可使用。</p>\r\n<p>強化表皮防護能力<br />舒緩各式乾裂脫屑<br />舒緩乾燥引起的皮膚癢</p>\r\n<p>成分：中藥材</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：高雄</p>\r\n<p>商品圖片僅供參考</p>', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2015-11-09 06:27:00', 1, 1);
INSERT INTO `data_set` VALUES (18, 'pït 生肌乳 30 ml', '<p style="text-align: center;"><img src="../source/IMG_1092_s_150dpi.png" alt="" width="680" height="415" /><img src="../source/pb-3.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: left;">漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>\r\n<p style="text-align: center;">&nbsp;</p>', 'products', '3', '<p>強化表皮防護能力<br />舒緩各式乾裂脫屑<br />舒緩乾燥引起的皮膚癢</p>\r\n<p>成分：草本萃取精華</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：台灣</p>\r\n<p>商品圖片為 : <br />1。p&iuml;t 生肌乳 30 ml<br />2。kh&aacute;ng 黑玉修護凝露&nbsp;12 ml</p>', '<p class="notep">容量:30 ml</p>\r\n<p class="notep">保存期限：2年</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">一般化妝品免備查</p>', NULL, NULL, '3', '<p>強化表皮防護能力<br />舒緩各式乾裂脫屑<br />舒緩乾燥引起的皮膚癢</p>\r\n<p>成分：草本萃取精化</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：台灣</p>\r\n<p>商品圖片為 : <br />1。p&iuml;t 生肌乳 30 ml<br />2。kh&aacute;ng 黑玉修護凝露&nbsp;12 ml</p>', '<p style="text-align: center;"><img src="../source/IMG_1092_s_150dpi.png" alt="" width="680" height="415" /><img src="../source/pb-3.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: left;">漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>\r\n<p style="text-align: center;">&nbsp;</p>', '<p class="notep">容量:30 ml</p>\r\n<p class="notep">保存期限：2年</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">一般化妝品免備查</p>', 1380, 10, 0, NULL, NULL, NULL, '2015-11-09 08:02:20', 1, 1);
INSERT INTO `data_set` VALUES (19, 'kháng 修護凝露 12 ml', '<p style="text-align: center;"><img src="../source/pb-2.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: center;"><img src="../source/pb-3.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: left;">漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>', 'products', '1', '<p>天然修護、舒緩肌膚不適、<br />提升肌膚對環境傷害的保護力,<br />可以使用在臉部或身體任何部位,<br />私密嬌嫩部位表面亦可使用。</p>\r\n<p>成分：草本萃取精華</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：台灣</p>\r\n<p>商品圖片為 : <br />1。kh&aacute;ng 黑玉修護凝露&nbsp;12 ml<br /> 2。p&iuml;t 生肌乳 30 ml</p>', '<p class="notep">容量:12 ml</p>\r\n<p class="notep">保存期限：2年</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">一般化妝品免備查&nbsp;</p>', NULL, NULL, '1', '<p>天然修護、舒緩肌膚不適、<br />提升肌膚對環境傷害的保護力,<br />可以使用在臉部或身體任何部位,<br />私密嬌嫩部位表面亦可使用。</p>\r\n<p>成分：草本萃取精華</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：台灣</p>\r\n<p>商品圖片為 : <br />1。kh&aacute;ng 黑玉修護凝露&nbsp;12 ml<br /> 2。p&iuml;t 生肌乳 30 ml</p>', '<p style="text-align: center;"><img src="../source/pb-2.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: center;"><img src="../source/pb-3.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: left;">漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>', '<p class="notep">容量:12 ml</p>\r\n<p class="notep">保存期限：2年</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">一般化妝品免備查</p>\r\n<p>&nbsp;</p>', 490, 10, 0, NULL, NULL, NULL, '2015-11-09 08:06:35', 1, 1);
INSERT INTO `data_set` VALUES (20, 'pït 生肌乳 30 ml [緊緊相護陪伴組]', '<p style="text-align: center;"><img src="../source/IMG_1092_s_150dpi.png" alt="" width="680" height="415" /><img src="../source/pb-3.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: center;">&nbsp;</p>\r\n<p style="text-align: left;">漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>', 'products', '3', '<p>強化表皮防護能力<br />舒緩各式乾裂脫屑<br />舒緩乾燥引起的皮膚癢</p>\r\n<p>成分：草本萃取精華</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：台灣</p>\r\n<p>商品圖片為 : <br />1。p&iuml;t 生肌乳 30 ml<br />2。kh&aacute;ng 黑玉修護凝露&nbsp;12 ml</p>', '<p class="notep">容量:30 ml X 2</p>\r\n<p class="notep">保存期限：2年</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">一般化妝品免備查</p>', NULL, NULL, '3', '<p>強化表皮防護能力<br />舒緩各式乾裂脫屑<br />舒緩乾燥引起的皮膚癢</p>\r\n<p>成分：草本萃取精華</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：台灣</p>\r\n<p>商品圖片為 : <br />1。p&iuml;t 生肌乳 30 ml<br />2。kh&aacute;ng 黑玉修護凝露&nbsp;12 ml</p>', '<p style="text-align: center;"><img src="../source/IMG_1092_s_150dpi.png" alt="" width="680" height="415" /><img src="../source/pb-3.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: center;">&nbsp;</p>\r\n<p style="text-align: left;">漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>', '<p class="notep">容量:30 ml X 2</p>\r\n<p class="notep">保存期限：2年</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">一般化妝品免備查</p>', 2360, 10, 0, NULL, NULL, NULL, '2015-11-11 15:04:56', 1, 1);
INSERT INTO `data_set` VALUES (23, '訂購單*****測試檔*****', NULL, 'download', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2015-11-14 00:31:44', 1, 1);
INSERT INTO `data_set` VALUES (26, 'pit 生肌乳 30ML', '<p style="text-align: center;"><img src="../source/pb-1.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: center;"><img src="../source/pb-2.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: center;"><img src="../source/pb-3.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: left;">漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>\r\n<p style="text-align: center;"><img src="../source/pb-1.jpg" alt="" width="680" height="450" /></p>', 'products', '3', '<p>天然修護、舒緩肌膚不適、<br />提升肌膚對環境傷害的保護力,<br />可以使用在臉部或身體任何部位, 私密嬌嫩部位表面亦可使用。</p>\r\n<p>強化表皮防護能力<br />舒緩各式乾裂脫屑<br />舒緩乾燥引起的皮膚癢</p>\r\n<p>成分：中藥材</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：高雄</p>\r\n<p>商品圖片僅供參考</p>', '<p class="notep">容量:30ml</p>\r\n<p class="notep">保存期限：2年</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">一般化妝品免備查</p>\r\n<table style="height: 81px;" width="172">\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;容量:</td>\r\n<td>&nbsp;30 ml</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;保存期限：</td>\r\n<td>&nbsp;2年</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;產地：</td>\r\n<td>&nbsp;台灣</td>\r\n</tr>\r\n<tr>\r\n<td colspan="2">&nbsp;一般化妝品免備查&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', NULL, NULL, '3', '<p>天然修護、舒緩肌膚不適、<br />提升肌膚對環境傷害的保護力,<br />可以使用在臉部或身體任何部位, 私密嬌嫩部位表面亦可使用。</p>\r\n<p>強化表皮防護能力<br />舒緩各式乾裂脫屑<br />舒緩乾燥引起的皮膚癢</p>\r\n<p>成分：中藥材</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：高雄</p>\r\n<p>商品圖片僅供參考</p>', '<p style="text-align: center;"><img src="../source/pb-1.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: center;"><img src="../source/pb-2.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: center;"><img src="../source/pb-3.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: left;">漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>\r\n<p style="text-align: center;"><img src="../source/pb-1.jpg" alt="" width="680" height="450" /></p>', '<p class="notep">容量:30ml</p>\r\n<p class="notep">保存期限：2年</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">一般化妝品免備查</p>', 1380, 1, 0, NULL, NULL, NULL, '2015-11-14 21:06:59', 0, 1);
INSERT INTO `data_set` VALUES (35, '健康的醫學', '<p>漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>', 'news', '3', '2015', '<p>漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2015-09-14 21:26:41', 1, 1);
INSERT INTO `data_set` VALUES (45, NULL, '<p>漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>\r\n<p>傳承於中醫千年智慧的漢速敷，最早之初乃是由吳信誼醫師將珍珠、龍腦等珍貴藥材製成現代劑型應用於臨床外用，因為此藥膏生肌長肉效果迅速與藥材珍貴因此取名為黑玉生肌膏，療效受到皮膚病及傷口患者肯定，方便使用的劑型更大受歡迎，讓我們決心投入中藥漢方的外用市場。</p>', 'news', '4', '2015', '<p>漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>\r\n<p>傳承於中醫千年智慧的漢速敷，最早之初乃是由吳信誼醫師將珍珠、龍腦等珍貴藥材製成現代劑型應用於臨床外用，因為此藥膏生肌長肉效果迅速與藥材珍貴因此取名為黑玉生肌膏，療效受到皮膚病及傷口患者肯定，方便使用的劑型更大受歡迎，讓我們決心投入中藥漢方的外用市場。</p>', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2015-11-16 23:56:43', 0, 3);
INSERT INTO `data_set` VALUES (54, NULL, NULL, 'banners', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2015-11-30 19:37:21', 1, 1);
INSERT INTO `data_set` VALUES (55, '歡慶官網全新上線!! 滿499免運優惠進行中~', '<p>漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>\r\n<p>傳承於中醫千年智慧的漢速敷，最早之初乃是由吳信誼醫師將珍珠、龍腦等珍貴藥材製成現代劑型應用於臨床外用，因為此藥膏生肌長肉效果迅速與藥材珍貴因此取名為黑玉生肌膏，療效受到皮膚病及傷口患者肯定，方便使用的劑型更大受歡迎，讓我們決心投入中藥漢方的外用市場。</p>', 'news', '4', '2015', '<p>漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>\r\n<p>傳承於中醫千年智慧的漢速敷，最早之初乃是由吳信誼醫師將珍珠、龍腦等珍貴藥材製成現代劑型應用於臨床外用，因為此藥膏生肌長肉效果迅速與藥材珍貴因此取名為黑玉生肌膏，療效受到皮膚病及傷口患者肯定，方便使用的劑型更大受歡迎，讓我們決心投入中藥漢方的外用市場。</p>', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2015-11-17 19:45:29', 1, 2);
INSERT INTO `data_set` VALUES (58, NULL, 'http://www.hancure.com/', 'banners', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2015-11-30 19:54:51', 0, 5);
INSERT INTO `data_set` VALUES (59, '免運費設定', NULL, 'freight', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 499, 100, 0, 0, 0, 0, '2016-03-12 00:00:00', 1, 1);
INSERT INTO `data_set` VALUES (60, 'kháng 修護凝露 12 ml [持續修護雙重奏]', '<p style="text-align: center;"><img src="../source/pb-2.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: center;">&nbsp;</p>\r\n<p style="text-align: center;"><img src="../source/pb-3.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: left;">漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>', 'products', '1', '<p>天然修護、舒緩肌膚不適、<br />提升肌膚對環境傷害的保護力,<br />可以使用在臉部或身體任何部位,<br />私密嬌嫩部位表面亦可使用。</p>\r\n<p>成分：草本萃取精華</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：台灣</p>\r\n<p>商品圖片為 : <br />1。kh&aacute;ng 黑玉修護凝露&nbsp;12 ml<br /> 2。p&iuml;t 生肌乳 30 ml</p>', '<p class="notep">容量:12 ml X 2</p>\r\n<p class="notep">保存期限：2年</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">一般化妝品免備查</p>', NULL, NULL, '1', '<p>天然修護、舒緩肌膚不適、<br />提升肌膚對環境傷害的保護力,<br />可以使用在臉部或身體任何部位,<br />私密嬌嫩部位表面亦可使用。</p>\r\n<p>成分：草本萃取精華</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：台灣</p>\r\n<p>商品圖片為 : <br />1。kh&aacute;ng 黑玉修護凝露&nbsp;12 ml<br /> 2。p&iuml;t 生肌乳 30 ml</p>', '<p style="text-align: center;"><img src="../source/pb-2.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: center;"><img src="../source/pb-3.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: left;">漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>', '<p class="notep">容量:12ml&nbsp;X 2</p>\r\n<p class="notep">保存期限：2年</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">一般化妝品免備查</p>', 780, 10, 0, NULL, NULL, NULL, '2015-11-27 16:01:33', 1, 1);
INSERT INTO `data_set` VALUES (61, '最新消息', '<p>漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>', 'news', '4', '2015', '<p style="text-align: center;">漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2015-11-27 16:05:39', 0, 1);
INSERT INTO `data_set` VALUES (62, 'banner3', NULL, 'banners', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2015-12-23 13:04:47', 1, 3);
INSERT INTO `data_set` VALUES (64, 'banner4', NULL, 'banners', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2015-12-23 13:19:04', 1, 4);
INSERT INTO `data_set` VALUES (66, NULL, NULL, 'banners', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, '2016-03-12 09:26:07', 1, 2);
INSERT INTO `data_set` VALUES (67, 'tsíng 兄弟膏 15 ml', '<p><img style="margin-right: auto; margin-left: auto; display: block;" src="../source/Hancure_%E6%A8%A1%E6%93%AC%E5%9C%96_2.jpg" alt="" width="600" height="280" /></p>\r\n<p>&nbsp;</p>\r\n<p><img style="margin-right: auto; margin-left: auto; display: block;" src="../source/%E5%85%84%E5%BC%9F%E8%86%8F%E6%88%90%E5%88%86.png" alt="" width="600" height="160" /></p>\r\n<p style="text-align: left;">&nbsp;</p>\r\n<p style="text-align: left;">漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>', 'products', '4', '<p>舒緩適用。<br />蘊含高效草本植物活性成分。<br />獨家研製的清涼配方及天然木質芳香，使您得以消除壓力。<br />運動員隨身常備，適用於激烈運動、格鬥運動後肌膚調理舒緩不適。</p>\r\n<p>成分：草本萃取精華</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：台灣</p>\r\n<p>商品圖片為 : <br />1。ts&iacute;ng 兄弟膏 15 ml</p>', '<p class="notep">容量:15 ml</p>\r\n<p class="notep">保存期限：3年</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">一般化妝品免備查</p>', NULL, NULL, '4', '<p>舒緩適用。<br />蘊含高效草本植物活性成分。<br />獨家研製的清涼配方及天然木質芳香，使您得以消除壓力。<br />運動員隨身常備，適用於激烈運動、格鬥運動後肌膚調理舒緩不適。</p>\r\n<p>成分：草本萃取精華</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：台灣</p>\r\n<p>商品圖片為 : <br />1。ts&iacute;ng 兄弟膏 15 ml</p>', '<p><img style="margin-right: auto; margin-left: auto; display: block;" src="../source/Hancure_%E6%A8%A1%E6%93%AC%E5%9C%96_2.jpg" alt="" width="600" height="280" /></p>\r\n<p>&nbsp;</p>\r\n<p><img style="margin-right: auto; margin-left: auto; display: block;" src="../source/%E5%85%84%E5%BC%9F%E8%86%8F%E6%88%90%E5%88%86.png" alt="" width="600" height="160" /></p>\r\n<p style="text-align: left;">漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>', '<p class="notep">容量:15 ml</p>\r\n<p class="notep">保存期限：3年</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">一般化妝品免備查</p>', 550, 10, 0, NULL, NULL, NULL, '2016-03-12 09:38:13', 1, 1);
INSERT INTO `data_set` VALUES (68, 'tsíng 兄弟膏 15 ml [兄弟相親相愛分享組]', '<p><img style="margin-right: auto; margin-left: auto; display: block;" src="../source/Hancure_%E6%A8%A1%E6%93%AC%E5%9C%96_2.jpg" alt="" width="600" height="280" /></p>\r\n<p>&nbsp;</p>\r\n<p><img style="margin-right: auto; margin-left: auto; display: block;" src="../source/%E5%85%84%E5%BC%9F%E8%86%8F%E6%88%90%E5%88%86.png" alt="" width="600" height="160" /></p>\r\n<p style="text-align: left;">&nbsp;</p>\r\n<p style="text-align: left;">漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>', 'products', '4', '<p>舒緩適用。<br />蘊含高效草本植物活性成分。<br />獨家研製的清涼配方及天然木質芳香，使您得以消除壓力。<br />運動員隨身常備，適用於激烈運動、格鬥運動後肌膚調理舒緩不適。</p>\r\n<p>成分：草本萃取精華</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：台灣</p>\r\n<p>商品圖片為 : <br />1。ts&iacute;ng 兄弟膏 15 ml</p>', '<p class="notep">容量:15 ml X 2</p>\r\n<p class="notep">保存期限：3年</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">一般化妝品免備查</p>', NULL, NULL, '4', '<p>舒緩適用。<br />蘊含高效草本植物活性成分。<br />獨家研製的清涼配方及天然木質芳香，使您得以消除壓力。<br />運動員隨身常備，適用於激烈運動、格鬥運動後肌膚調理舒緩不適。</p>\r\n<p>成分：草本萃取精華</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：台灣</p>\r\n<p>商品圖片為 : <br />1。ts&iacute;ng 兄弟膏 15 ml</p>', '<p><img style="margin-right: auto; margin-left: auto; display: block;" src="../source/Hancure_%E6%A8%A1%E6%93%AC%E5%9C%96_2.jpg" alt="" width="600" height="280" /></p>\r\n<p>&nbsp;</p>\r\n<p><img style="margin-right: auto; margin-left: auto; display: block;" src="../source/%E5%85%84%E5%BC%9F%E8%86%8F%E6%88%90%E5%88%86.png" alt="" width="600" height="160" /></p>\r\n<p style="text-align: left;">漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>', '<p class="notep">容量:15 ml X 2</p>\r\n<p class="notep">保存期限：3年</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">一般化妝品免備查</p>', 918, 10, 0, 0, 0, 0, '2016-03-12 10:00:01', 1, 1);
INSERT INTO `data_set` VALUES (69, 'tsíng 兄弟膏 2 ml [試用隨身瓶]', '<p><img style="margin-right: auto; margin-left: auto; display: block;" src="../source/Hancure_%E6%A8%A1%E6%93%AC%E5%9C%96_2.jpg" alt="" width="600" height="280" /></p>\r\n<p>&nbsp;</p>\r\n<p><img style="margin-right: auto; margin-left: auto; display: block;" src="../source/%E5%85%84%E5%BC%9F%E8%86%8F%E6%88%90%E5%88%86.png" alt="" width="600" height="160" /></p>\r\n<p style="text-align: left;">&nbsp;</p>\r\n<p style="text-align: left;">漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>', 'products', '4', '<p>舒緩適用。<br />蘊含高效草本植物活性成分。<br />獨家研製的清涼配方及天然木質芳香，使您得以消除壓力。<br />運動員隨身常備，適用於激烈運動、格鬥運動後肌膚調理舒緩不適。</p>\r\n<p>成分：草本萃取精華</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：台灣</p>\r\n<p>商品圖片為 : <br />1。ts&iacute;ng 兄弟膏 15 ml</p>', '<p class="notep">容量:2 ml</p>\r\n<p class="notep">保存期限：3年</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">一般化妝品免備查</p>', NULL, NULL, '4', '<p>舒緩適用。<br />蘊含高效草本植物活性成分。<br />獨家研製的清涼配方及天然木質芳香，使您得以消除壓力。<br />運動員隨身常備，適用於激烈運動、格鬥運動後肌膚調理舒緩不適。</p>\r\n<p>成分：草本萃取精華</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：台灣</p>\r\n<p>商品圖片為 : <br />1。ts&iacute;ng 兄弟膏 15 ml</p>', '<p><img style="margin-right: auto; margin-left: auto; display: block;" src="../source/Hancure_%E6%A8%A1%E6%93%AC%E5%9C%96_2.jpg" alt="" width="600" height="280" /></p>\r\n<p>&nbsp;</p>\r\n<p><img style="margin-right: auto; margin-left: auto; display: block;" src="../source/%E5%85%84%E5%BC%9F%E8%86%8F%E6%88%90%E5%88%86.png" alt="" width="600" height="160" /></p>\r\n<p style="text-align: left;">&nbsp;</p>\r\n<p style="text-align: left;">漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>', '<p class="notep">容量:2 ml</p>\r\n<p class="notep">保存期限：3年</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">一般化妝品免備查</p>', 110, 10, 0, 0, 0, 0, '2016-03-12 10:13:15', 1, 1);
INSERT INTO `data_set` VALUES (70, 'kháng 修護凝露 2 ml [試用隨身瓶]', '<p style="text-align: center;"><img src="../source/pb-2.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: center;"><img src="../source/pb-3.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: left;">漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>', 'products', '1', '<p>天然修護、舒緩肌膚不適、<br />提升肌膚對環境傷害的保護力,<br />可以使用在臉部或身體任何部位,<br />私密嬌嫩部位表面亦可使用。</p>\r\n<p>成分：草本萃取精華</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：台灣</p>\r\n<p>商品圖片為 : <br />1。kh&aacute;ng 黑玉修護凝露&nbsp;12 ml<br /> 2。p&iuml;t 生肌乳 30 ml</p>', '<p class="notep">容量:2 ml</p>\r\n<p class="notep">保存期限：2年</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">一般化妝品免備查</p>', NULL, NULL, '1', '<p>天然修護、舒緩肌膚不適、<br />提升肌膚對環境傷害的保護力,<br />可以使用在臉部或身體任何部位,<br />私密嬌嫩部位表面亦可使用。</p>\r\n<p>成分：草本萃取精華</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：台灣</p>\r\n<p>商品圖片為 : <br />1。kh&aacute;ng 黑玉修護凝露&nbsp;12 ml<br /> 2。p&iuml;t 生肌乳 30 ml</p>', '<p style="text-align: center;"><img src="../source/pb-2.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: center;"><img src="../source/pb-3.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: left;">漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>', '<p class="notep">容量:2 ml</p>\r\n<p class="notep">保存期限：2年</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">一般化妝品免備查</p>', 100, 10, 0, NULL, NULL, NULL, '2016-03-12 12:02:43', 1, 1);
INSERT INTO `data_set` VALUES (71, 'pït 生肌乳 2 ml [試用隨身瓶]', '<p style="text-align: center;"><img src="../source/IMG_1092_s_150dpi.png" alt="" width="680" height="415" /><img src="../source/pb-3.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: left;">漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>\r\n<p style="text-align: center;">&nbsp;</p>', 'products', '3', '<p>強化表皮防護能力<br />舒緩各式乾裂脫屑<br />舒緩乾燥引起的皮膚癢</p>\r\n<p>成分：草本萃取精華</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：台灣</p>\r\n<p>商品圖片為 : <br />1。p&iuml;t 生肌乳 30 ml<br />2。kh&aacute;ng 黑玉修護凝露&nbsp;12 ml</p>', '<p class="notep">容量:2 ml</p>\r\n<p class="notep">保存期限：2年</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">一般化妝品免備查</p>', NULL, NULL, '3', '<p>強化表皮防護能力<br />舒緩各式乾裂脫屑<br />舒緩乾燥引起的皮膚癢</p>\r\n<p>成分：草本萃取精華</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：台灣</p>\r\n<p>商品圖片為 : <br />1。p&iuml;t 生肌乳 30 ml<br />2。kh&aacute;ng 黑玉修護凝露&nbsp;12 ml</p>', '<p style="text-align: center;"><img src="../source/IMG_1092_s_150dpi.png" alt="" width="680" height="415" /><img src="../source/pb-3.jpg" alt="" width="680" height="450" /></p>\r\n<p style="text-align: left;">漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>\r\n<p style="text-align: center;">&nbsp;</p>', '<p class="notep">容量:2 ml</p>\r\n<p class="notep">保存期限：2年</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">一般化妝品免備查</p>', 110, 10, 0, 0, 0, 0, '2016-03-14 11:03:33', 1, 1);
INSERT INTO `data_set` VALUES (72, '漢速敷 經典傳承 2 ml [隨身必備三劍客]', '<p><img src="../source/pb-2.jpg" alt="" width="680" height="450" /><img src="../source/IMG_1092_s_150dpi.png" alt="" width="680" height="415" /><img src="../source/Hancure_%E6%A8%A1%E6%93%AC%E5%9C%96_2.jpg" alt="" width="680" height="317" /></p>\r\n<p>&nbsp;</p>\r\n<p>漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>', 'products', '5', '<p>1. kh&aacute;ng 黑玉修護凝露 2 ml<br />天然修護、舒緩肌膚不適、<br />提升肌膚對環境傷害的保護力,<br />可以使用在臉部或身體任何部位,<br />私密嬌嫩部位表面亦可使用。</p>\r\n<p>2. p&iuml;t 黑玉生肌乳 2 ml<br />強化表皮防護能力<br />舒緩各式乾裂脫屑<br />舒緩乾燥引起的皮膚癢</p>\r\n<p>3. ts&iacute;ng 兄弟膏 2 ml<br />舒緩適用。<br />蘊含高效草本植物活性成分。<br />獨家研製的清涼配方及天然木質芳香，<br />使您得以消除壓力。<br />運動員隨身常備，適用於激烈運動、<br />格鬥運動後肌膚調理舒緩不適。</p>\r\n<p>成分：草本萃取精華</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：台灣</p>\r\n<p>商品圖片為 : <br />1。kh&aacute;ng 黑玉修護凝露&nbsp;12 ml<br />2。p&iuml;t 生肌乳 30 ml<br />3。ts&iacute;ng 兄弟膏 15 ml</p>', '<p class="notep">容量:<br />1. kh&aacute;ng 黑玉修護凝露 2 ml X 1<br />2. p&iuml;t 黑玉生肌乳 2 ml X 1<br />3. ts&iacute;ng 兄弟膏 2 ml X 1</p>\r\n<p class="notep">保存期限：3年</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">一般化妝品免備查</p>', NULL, NULL, '5', '<p>1. kh&aacute;ng 黑玉修護凝露 2 ml<br />天然修護、舒緩肌膚不適、<br />提升肌膚對環境傷害的保護力,<br />可以使用在臉部或身體任何部位,<br />私密嬌嫩部位表面亦可使用。</p>\r\n<p>2. p&iuml;t 黑玉生肌乳 2 ml<br />強化表皮防護能力<br />舒緩各式乾裂脫屑<br />舒緩乾燥引起的皮膚癢</p>\r\n<p>3. ts&iacute;ng 兄弟膏 2 ml<br />舒緩適用。<br />蘊含高效草本植物活性成分。<br />獨家研製的清涼配方及天然木質芳香，<br />使您得以消除壓力。<br />運動員隨身常備，適用於激烈運動、<br />格鬥運動後肌膚調理舒緩不適。</p>\r\n<p>成分：草本萃取精華</p>\r\n<p>保存期限：詳細請見包裝盒</p>\r\n<p>產地：台灣</p>\r\n<p>商品圖片為 : <br />1。kh&aacute;ng 黑玉修護凝露&nbsp;12 ml<br />2。p&iuml;t 生肌乳 30 ml<br />3。ts&iacute;ng 兄弟膏 15 ml</p>', '<p><img src="../source/pb-2.jpg" alt="" width="680" height="450" /><img src="../source/IMG_1092_s_150dpi.png" alt="" width="680" height="415" /><img src="../source/Hancure_%E6%A8%A1%E6%93%AC%E5%9C%96_2.jpg" alt="" width="680" height="317" /></p>\r\n<p>&nbsp;</p>\r\n<p>漢方曾經是維繫千萬人生命健康的醫學，古早、天然而實用。在時間的洪流中，歷久而彌新。可惜由於教育嚴重西化，主政者嘗試以簡單物理化學來探索中醫理論和用藥精神，導致現代民眾對漢方的認識早已殘破不堪。漢速敷集結臨床堅持中醫理論的中醫師，還原經典智慧，成就現代傳承。繼承不是為了嘩眾取寵，只盼扎實跟隨祖先步履，讓漢速敷成為漢方獨一無二的研究發揚基地，好好地將經典與健康交給下一代。</p>', '<p class="notep">容量:<br />1. kh&aacute;ng 黑玉修護凝露 2 ml X 1<br />2. p&iuml;t 黑玉生肌乳 2 ml X 1<br />3. ts&iacute;ng 兄弟膏 2 ml X 1</p>\r\n<p class="notep">保存期限：3年</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">一般化妝品免備查</p>', 290, 10, 0, 0, 0, 0, '2016-03-14 11:12:08', 1, 1);
INSERT INTO `data_set` VALUES (73, '會員規範', '<p>歡迎來到『HanCure 漢速敷』會員中心！為保障您的權益，請於註冊成為『HanCure 漢速敷』會員並使用『HanCure 漢速敷』網站（以下簡稱本公司）服務前，請先詳細閱讀本同意書所有內容，尤其當您在線上點選「同意」鍵，表示您已註冊為本公司會員或同意使用本公司所提供之任何服務，即視為您已閱讀本同意書，並同意遵守以下所有同意書之會員規範。<br /> <br />一.<br />加入『HanCure 漢速敷』會員：<br /> <br />1.遵守會員規範及法律規定您了解您於本公司註冊成為會員後，可使用本公司服務。當會員使用本公司服務時，即表示同意接受本公司之會員規範及所有注意事項之拘束，並遵守當地之法律規定。<br /> <br />2.加入本公司會員是完全免費，只要進行個人的一些基本資料登錄即可成為會員。但是您提供之個人資料若有填寫不實，或原所登錄之資料已不符合真實而未更新，或有任何誤導之嫌，本公司保留隨時終止您會員資格及使用各項服務資格之權利。<br /> <br />3.會員有義務妥善保管在本公司之帳號與密碼，並為此組帳號與密碼登入系統後所進行之一切活動負責。為維護會員自身權益，請勿將帳號與密碼洩露或提供予第三人知悉，或出借或轉讓他人使用。若會員發現帳號或密碼遭人非法使用或有任何異常破壞使用安全之情形時，應立即通知本公司。<br /> <br />4.會員規範之修改<br /> 本公司保留隨時修改本會員規範之權利，本公司將於修改會員規範時，於首頁公告修改之事實，不另作會員個別通知。如果會員不同意修改的內容，請勿繼續使用本公司服務。如果會員繼續使用本公司服務，則視為會員已同意並接受本規範該等增訂或修改內容之拘束。<br /> <br />5.服務之停止與更改<br /> 本公司保留隨時停止或更改各項服務內容或終止任一會員帳戶服務之權利，且無需事先通知會員。無論任何情形，就停止或更改服務或終止會員帳戶服務所可能產生之困擾、不便或損害，本公司對任何會員或第三人均不負任何責任。<br /> <br />6.會員應瞭解並同意，本公司可能因公司、其他協力廠商或相關電信業者網路系統軟硬體設備之故障或失靈、或人為操作上之疏失而全部或一部中斷、暫時無法使用、遲延、或造成資料傳輸或儲存上之錯誤、或遭第三人侵入系統篡改或偽造變造資料等，會員不得因此而要求任何補償或賠償。<br /> <br />二.<br />加入會員的用途與便利：<br /> <br />1.會員可享有「訂單查詢、匯款回報&hellip;等等。」<br /> <br />2.基於和會員保持良好互動，本公司會不定期於網站的最新消息發佈訊息。<br /> <br />三.<br />會員身份終止和本公司的義務與服務：<br /> <br />1.若會員決定終止本公司會員資格，請直接以電子郵件的方式通知我們，我們會儘快註銷您的會員資料。<br /> <br />2.會員有通知取消本公司會員資格之義務，並自停止會員身份日起，即喪失所有本公司所提供之優惠及權益。<br /> <br />3.為避免惡意情事發生致使會員應享權益損失，當會員通知本公司停止會員身份時，本公司將再次以電話確認無誤後，再進行註銷會員資格。<br /> <br />四.<br />會員的隱私權保障：<br /> <br />1.<br />除了以下四點情況(除外條款)：<br /> A.中華民國法律之相關規定。<br /> B.受司法機關或其他有權機關基於法定程序之要求。<br /> C.為維護其他會員或第三人之權益。<br /> <br />2.<br />對於會員所登錄或留存之個人資料，在未獲得會員同意以前，本公司絕不對外揭露會員之姓名、聯絡地址、聯絡電話、電子郵件地址及其他依法受保護之個人資料。<br /> <br />五.<br />會員其他相關規範<br /> <br />1.<br />本公司對於會員使用各項服務、或無法使用各項服務所致生之任何直接、間接、衍生、或特別損害，不負任何賠償責任。若會員使用之服務係有對價者，本公司僅於會員所付之對價範圍內，負賠償責任。<br /> <br />2.<br />上述賠償責任限制，若依法為不得限制者，則限制規定將不予適用。<br /> <br />3.<br />本公司網站上之所有著作及資料，其著作權、專利權、商標、營業秘密、其他智慧財產權、所有權或其他權利，均為本公司或其權利人所有，除事先經本公司或其權利人之合法授權外，會員不得擅自重製、傳輸、改作、編輯或以其他任何形式、基於任何目的加以使用，否則應負所有法律責任。<br /> <br />4.<br />因會員違反相關法令或違背本同意書之任一會員條款，致本公司或其關係企業、受僱人、受託人、代理人及其他相關履行輔助人因此而受有損害或支出費用（包括且限於因進行民事、刑事及行政程序所支出之律師費用）時，會員應負擔損害賠償責任或填補其費用。<br /> <br />5.<br />本同意書之解釋及適用、以及會員因使用本服務而與本公司間所生之權利義務關係，應依中華民國法令解釋適用之。其因此所生之爭議，以台灣高雄地方法院為第一審管。</p>', 'member_rule', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, '2016-03-21 16:46:44', NULL, 1);

-- --------------------------------------------------------

-- 
-- 資料表格式： `epaper_set`
-- 

CREATE TABLE `epaper_set` (
  `e_id` int(11) NOT NULL auto_increment,
  `e_title` tinytext collate utf8_unicode_ci,
  `e_content` text collate utf8_unicode_ci,
  `e_class1` tinytext collate utf8_unicode_ci,
  `e_class2` int(11) default '0',
  `e_date` datetime default NULL,
  `e_active` tinyint(2) default '0',
  `e_sort` int(11) default NULL,
  PRIMARY KEY  (`e_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- 列出以下資料庫的數據： `epaper_set`
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
  `file_title` tinytext collate utf8_unicode_ci,
  `file_link1` tinytext collate utf8_unicode_ci,
  `file_link2` tinytext collate utf8_unicode_ci,
  `file_link3` tinytext collate utf8_unicode_ci,
  `file_link4` tinytext collate utf8_unicode_ci,
  `file_link5` tinytext collate utf8_unicode_ci,
  `file_show_type` tinyint(1) default '0',
  PRIMARY KEY  (`file_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=165 ;

-- 
-- 列出以下資料庫的數據： `file_set`
-- 

INSERT INTO `file_set` VALUES (7, 8, 'image', 'about_8.jpg', '關於我們', 'upload_image/about/about_8.jpg', 'upload_image/about/about_8_s100.jpg', NULL, NULL, NULL, 1);
INSERT INTO `file_set` VALUES (10, 20, 'image', 'news_20.jpg', NULL, 'upload_image/news/news_20.jpg', 'upload_image/news/news_20_s100.jpg', NULL, NULL, NULL, 1);
INSERT INTO `file_set` VALUES (19, 51, 'image', 'products_51.jpg', NULL, 'upload_image/products/products_51.jpg', 'upload_image/products/products_51_s100.jpg', 'upload_image/products/products_51_s301.jpg', NULL, NULL, 1);
INSERT INTO `file_set` VALUES (19, 52, 'image', 'products_52.jpg', NULL, 'upload_image/products/products_52.jpg', 'upload_image/products/products_52_s100.jpg', 'upload_image/products/products_52_s301.jpg', NULL, NULL, 1);
INSERT INTO `file_set` VALUES (23, 67, 'file', 'news_67.jpg', '預購單', 'upload_file/news/news_67.jpg', NULL, NULL, NULL, NULL, 0);
INSERT INTO `file_set` VALUES (26, 81, 'image', 'products_81.jpg', NULL, 'upload_image/products/products_81.jpg', 'upload_image/products/products_81_s100.jpg', 'upload_image/products/products_81_s301.jpg', NULL, NULL, 1);
INSERT INTO `file_set` VALUES (26, 82, 'image', 'products_82.jpg', NULL, 'upload_image/products/products_82.jpg', 'upload_image/products/products_82_s100.jpg', 'upload_image/products/products_82_s301.jpg', NULL, NULL, 1);
INSERT INTO `file_set` VALUES (26, 83, 'image', 'products_83.jpg', NULL, 'upload_image/products/products_83.jpg', 'upload_image/products/products_83_s100.jpg', 'upload_image/products/products_83_s301.jpg', NULL, NULL, 1);
INSERT INTO `file_set` VALUES (26, 84, 'image', 'products_84.jpg', NULL, 'upload_image/products/products_84.jpg', 'upload_image/products/products_84_s100.jpg', 'upload_image/products/products_84_s301.jpg', NULL, NULL, 1);
INSERT INTO `file_set` VALUES (35, 108, 'image', 'news_108.jpg', NULL, 'upload_image/news/news_108.jpg', 'upload_image/news/news_108_s100.jpg', NULL, NULL, NULL, 1);
INSERT INTO `file_set` VALUES (45, 109, 'image', 'news_109.jpg', NULL, 'upload_image/news/news_109.jpg', 'upload_image/news/news_109_s100.jpg', NULL, NULL, NULL, 1);
INSERT INTO `file_set` VALUES (55, 122, 'image', 'news_122.jpg', NULL, 'upload_image/news/news_122.jpg', 'upload_image/news/news_122_s100.jpg', NULL, NULL, NULL, 1);
INSERT INTO `file_set` VALUES (60, 124, 'image', 'products_124.jpg', NULL, 'upload_image/products/products_124.jpg', 'upload_image/products/products_124_s100.jpg', 'upload_image/products/products_124_s301.jpg', NULL, NULL, 1);
INSERT INTO `file_set` VALUES (60, 125, 'image', 'products_125.jpg', NULL, 'upload_image/products/products_125.jpg', 'upload_image/products/products_125_s100.jpg', 'upload_image/products/products_125_s301.jpg', NULL, NULL, 1);
INSERT INTO `file_set` VALUES (61, 127, 'image', 'news_127.jpg', NULL, 'upload_image/news/news_127.jpg', 'upload_image/news/news_127_s100.jpg', NULL, NULL, NULL, 1);
INSERT INTO `file_set` VALUES (20, 132, 'image', 'products_132.jpg', NULL, 'upload_image/products/products_132.jpg', 'upload_image/products/products_132_s100.jpg', 'upload_image/products/products_132_s301.jpg', NULL, NULL, 1);
INSERT INTO `file_set` VALUES (18, 135, 'image', 'products_135.jpg', NULL, 'upload_image/products/products_135.jpg', 'upload_image/products/products_135_s100.jpg', 'upload_image/products/products_135_s301.jpg', NULL, NULL, 1);
INSERT INTO `file_set` VALUES (54, 143, 'image', 'banners_143.jpg', NULL, 'upload_image/banners/banners_143.jpg', 'upload_image/banners/banners_143_s100.jpg', NULL, NULL, NULL, 1);
INSERT INTO `file_set` VALUES (58, 144, 'image', 'banners_144.jpg', NULL, 'upload_image/banners/banners_144.jpg', 'upload_image/banners/banners_144_s100.jpg', NULL, NULL, NULL, 1);
INSERT INTO `file_set` VALUES (62, 145, 'image', 'banners_145.jpg', NULL, 'upload_image/banners/banners_145.jpg', 'upload_image/banners/banners_145_s100.jpg', NULL, NULL, NULL, 1);
INSERT INTO `file_set` VALUES (64, 146, 'image', 'banners_146.jpg', NULL, 'upload_image/banners/banners_146.jpg', 'upload_image/banners/banners_146_s100.jpg', NULL, NULL, NULL, 1);
INSERT INTO `file_set` VALUES (18, 147, 'image', 'products_147.jpg', NULL, 'upload_image/products/products_147.jpg', 'upload_image/products/products_147_s100.jpg', 'upload_image/products/products_147_s301.jpg', NULL, NULL, 1);
INSERT INTO `file_set` VALUES (66, 150, 'image', 'banners_148.jpg', NULL, 'upload_image/banners/banners_148.jpg', 'upload_image/banners/banners_148_s100.jpg', NULL, NULL, NULL, 1);
INSERT INTO `file_set` VALUES (67, 152, 'image', 'products_152.png', NULL, 'upload_image/products/products_152.png', 'upload_image/products/products_152_s100.png', 'upload_image/products/products_152_s301.png', NULL, NULL, 0);
INSERT INTO `file_set` VALUES (67, 153, 'image', 'products_153.png', NULL, 'upload_image/products/products_153.png', 'upload_image/products/products_153_s100.png', 'upload_image/products/products_153_s301.png', NULL, NULL, 1);
INSERT INTO `file_set` VALUES (68, 154, 'image', 'products_154.png', NULL, 'upload_image/products/products_154.png', 'upload_image/products/products_154_s100.png', 'upload_image/products/products_154_s301.png', NULL, NULL, 0);
INSERT INTO `file_set` VALUES (68, 155, 'image', 'products_155.png', NULL, 'upload_image/products/products_155.png', 'upload_image/products/products_155_s100.png', 'upload_image/products/products_155_s301.png', NULL, NULL, 1);
INSERT INTO `file_set` VALUES (69, 156, 'image', 'products_156.png', NULL, 'upload_image/products/products_156.png', 'upload_image/products/products_156_s100.png', 'upload_image/products/products_156_s301.png', NULL, NULL, 0);
INSERT INTO `file_set` VALUES (69, 157, 'image', 'products_157.png', NULL, 'upload_image/products/products_157.png', 'upload_image/products/products_157_s100.png', 'upload_image/products/products_157_s301.png', NULL, NULL, 1);
INSERT INTO `file_set` VALUES (70, 159, 'image', 'products_159.jpg', NULL, 'upload_image/products/products_159.jpg', 'upload_image/products/products_159_s100.jpg', 'upload_image/products/products_159_s301.jpg', NULL, NULL, 1);
INSERT INTO `file_set` VALUES (70, 160, 'image', 'products_160.jpg', NULL, 'upload_image/products/products_160.jpg', 'upload_image/products/products_160_s100.jpg', 'upload_image/products/products_160_s301.jpg', NULL, NULL, 1);
INSERT INTO `file_set` VALUES (20, 161, 'image', 'products_161.png', NULL, 'upload_image/products/products_161.png', 'upload_image/products/products_161_s100.png', 'upload_image/products/products_161_s301.png', NULL, NULL, 1);
INSERT INTO `file_set` VALUES (71, 162, 'image', 'products_162.jpg', NULL, 'upload_image/products/products_162.jpg', 'upload_image/products/products_162_s100.jpg', 'upload_image/products/products_162_s301.jpg', NULL, NULL, 1);
INSERT INTO `file_set` VALUES (71, 163, 'image', 'products_163.jpg', NULL, 'upload_image/products/products_163.jpg', 'upload_image/products/products_163_s100.jpg', 'upload_image/products/products_163_s301.jpg', NULL, NULL, 1);
INSERT INTO `file_set` VALUES (72, 164, 'image', 'products_164.png', NULL, 'upload_image/products/products_164.png', 'upload_image/products/products_164_s100.png', 'upload_image/products/products_164_s301.png', NULL, NULL, 1);

-- --------------------------------------------------------

-- 
-- 資料表格式： `member_set`
-- 

CREATE TABLE `member_set` (
  `m_id` int(11) NOT NULL auto_increment,
  `m_class2` tinytext collate utf8_unicode_ci,
  `m_class3` tinytext collate utf8_unicode_ci,
  `m_name` tinytext collate utf8_unicode_ci,
  `m_account` tinytext collate utf8_unicode_ci,
  `m_password` text collate utf8_unicode_ci,
  `m_gender` varchar(10) collate utf8_unicode_ci default NULL,
  `m_birthyear` tinytext collate utf8_unicode_ci,
  `m_birthmonth` tinytext collate utf8_unicode_ci,
  `m_birthday` tinytext collate utf8_unicode_ci,
  `m_email` tinytext collate utf8_unicode_ci,
  `m_phone` varchar(50) collate utf8_unicode_ci default NULL,
  `m_cellphone` varchar(50) collate utf8_unicode_ci default NULL,
  `m_zip` int(11) default NULL,
  `m_city` tinytext collate utf8_unicode_ci,
  `m_canton` tinytext collate utf8_unicode_ci,
  `m_address` tinytext collate utf8_unicode_ci,
  `m_content` text collate utf8_unicode_ci COMMENT '農友簡介',
  `m_sn` tinytext collate utf8_unicode_ci COMMENT '綠生生產履歷編號',
  `m_fname` tinytext collate utf8_unicode_ci COMMENT '產銷班或農場名稱',
  `m_item` text collate utf8_unicode_ci COMMENT '主要生產項目',
  `m_faddress` tinytext collate utf8_unicode_ci COMMENT '農地位置',
  `m_fzip` int(11) default NULL,
  `m_fcity` tinytext collate utf8_unicode_ci,
  `m_fcanton` tinytext collate utf8_unicode_ci,
  `m_area` tinytext collate utf8_unicode_ci COMMENT '栽培總面積',
  `m_map` text collate utf8_unicode_ci COMMENT 'google map code',
  `m_epaper` tinyint(4) default '0',
  `m_level` tinyint(4) default '2',
  `m_active` varchar(10) collate utf8_unicode_ci default NULL,
  `m_date` datetime default NULL,
  PRIMARY KEY  (`m_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=239 ;

-- 
-- 列出以下資料庫的數據： `member_set`
-- 

INSERT INTO `member_set` VALUES (179, 'normal', NULL, 'williams', 'william@yahoo.com', 'fd820a2b4461bddd116c1518bc4b0f77', NULL, '2010', '01', '01', 'williams@yahoo.com', '0937452147', NULL, 821, '高雄市', '路竹區', '成龍村成龍1917號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-11 13:35:09');
INSERT INTO `member_set` VALUES (180, NULL, NULL, '高興', 'link7311@gmail.com', '381ea8c597e366e5b27d847bb721e420', '1', NULL, NULL, NULL, 'link7311@gmail.com', '0937100194', NULL, 407, '台中市', '西屯區', '文華路150巷31號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2015-09-13 23:12:14');
INSERT INTO `member_set` VALUES (181, NULL, NULL, '高高', 'studio.goods@gmail.com', '381ea8c597e366e5b27d847bb721e420', '1', NULL, NULL, NULL, 'studio.goods@gmail.com', '0937100194', NULL, 407, '台中市', '西屯區', '文華路150巷31號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2015-09-14 01:02:30');
INSERT INTO `member_set` VALUES (184, NULL, NULL, '威廉', 'williambossmailg@gmail.com', '240154152063f20a59e078e6d9946c75', '1', '2000', '02', '02', 'williambossmailg@gmail.com', '0987456321', NULL, 824, '高雄市', '燕巢區', '鄉成龍村成龍197號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-14 02:13:29');
INSERT INTO `member_set` VALUES (227, NULL, NULL, '威廉', 'williamboss@pchome.com.tw', 'ead159cebe79f55b6876240906fbf47f', '1', '1979', '05', '09', 'williamboss@pchome.com.tw', '08-7456987', NULL, 909, '屏東縣', '麟洛鄉', '中山路87號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-11-02 16:17:36');
INSERT INTO `member_set` VALUES (228, NULL, NULL, 'williamboss2', 'williamboss2@pchome.com.tw', 'eae9f6ebed56f19d465a3a35ffd68901', '1', '1979', '05', '24', 'williamboss2@pchome.com.tw', '0984456324', NULL, 821, '高雄市', '路竹區', '中華路120號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-11-05 15:36:30');
INSERT INTO `member_set` VALUES (229, NULL, NULL, 'ML', 'xiaoma31@yahoo.com.tw', '4d5bdeb4e1d33c14294a5d5a0bccb207', '0', '1977', '01', '29', 'xiaoma31@yahoo.com.tw', '0912199389', NULL, 807, '高雄市', '三民區', '汾陽路70號12樓', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2016-01-25 10:17:40');
INSERT INTO `member_set` VALUES (230, NULL, NULL, 'happy', 'rj.rd@doctor.com', '6d043a06e736117b7ebb97710eab1904', '0', '1977', '01', '29', 'rj.rd@doctor.com', '0912199389', NULL, 807, '高雄市', '三民區', '213路', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2016-02-22 16:15:21');
INSERT INTO `member_set` VALUES (231, NULL, NULL, 'yj', 'immortal128125@hotmail.com', '5081bd4797e390190e02d4bcd105cee9', '0', '2016', '04', '08', 'immortal128125@hotmail.com', '0912307854', NULL, 807, '高雄市', '三民區', '鼎中路213號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2016-03-14 06:40:39');
INSERT INTO `member_set` VALUES (232, NULL, NULL, 'YL', 'dr.wu@doctor.com', '4d5bdeb4e1d33c14294a5d5a0bccb207', '0', '1977', '03', '15', 'dr.wu@doctor.com', '0912199389', NULL, 110, '台北市', '信義區', 'happy st', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2016-03-14 12:10:11');
INSERT INTO `member_set` VALUES (236, NULL, NULL, '很好設計測試4', 'williamshsu@gmail.com', '045b9c5bbe1ac11a293460dcee026865', '1', '1989', '03', '01', 'williamshsu@gmail.com', '0937686482', NULL, 407, '台中市', '西屯區', '文華路150巷31號1樓', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2016-03-31 09:55:10');
INSERT INTO `member_set` VALUES (237, NULL, NULL, 'Happy', 'marylin231@hotmail.com', '4d5bdeb4e1d33c14294a5d5a0bccb207', '0', '1977', '04', '12', 'marylin231@hotmail.com', '0912199389', NULL, 800, '高雄市', '新興區', 'wenheng231', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2016-04-12 04:55:34');
INSERT INTO `member_set` VALUES (238, NULL, NULL, '洪家豪', 'thehouger@hotmail.com', '962600b60fb581e2b8e6db25d3ec6962', '1', '1982', '05', '22', 'thehouger@hotmail.com', '0921327741', NULL, 413, '台中市', '霧峰區', '四德路275巷66弄1號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2016-05-18 09:20:37');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

-- 
-- 列出以下資料庫的數據： `menu`
-- 

INSERT INTO `menu` VALUES (1, 'authority', 'authority_list.php', '#main_menu_1', '權限管理-列表', '權限管理-新增', '權限管理-修改', '權限管理-刪除', NULL);
INSERT INTO `menu` VALUES (2, 'banners', 'bannersHome_list.php', '#main_menu_2', '首頁Banner廣告-列表', '首頁Banner廣告-新增', '首頁Banner廣告-修改', '首頁Banner廣告-刪除', NULL);
INSERT INTO `menu` VALUES (3, 'news', 'news_list.php', '#main_menu_3', '最新訊息-列表', '最新訊息-新增', '最新訊息-修改', '最新訊息-刪除', NULL);
INSERT INTO `menu` VALUES (4, 'products', 'products_list.php', '#main_menu_4', '商品介紹-列表', '商品介紹-新增', '商品介紹-修改', '商品介紹-刪除', NULL);
INSERT INTO `menu` VALUES (5, 'member', 'member_list.php', '#main_menu_5', '會員專區-列表', '會員專區-新增', '會員專區-修改', '會員專區-刪除', NULL);
INSERT INTO `menu` VALUES (6, 'orders', 'orders_list.php', '#main_menu_6', '訂單管理-列表', '訂單管理-修改', '訂單管理-刪除', NULL, NULL);
INSERT INTO `menu` VALUES (7, 'about', 'about_list.php', '#main_menu_7', '聯絡我們-列表', '聯絡我們-修改', '聯絡我們-刪除', NULL, NULL);
INSERT INTO `menu` VALUES (8, 'contact', 'contact_list', '#main_menu_8', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menu` VALUES (9, 'download', 'download_list', '#main_menu_9', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menu` VALUES (10, 'freight', 'freight_list', '#main_menu_10', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menu` VALUES (11, 'location', 'location_list', '#main_menu_11', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menu` VALUES (12, 'links', 'links_list', '#main_menu_12', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menu` VALUES (13, 'download', 'download_list', '#main_menu_13', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menu` VALUES (14, 'farmer', 'farmer_list', '#main_menu_14', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menu` VALUES (15, 'shopProcess', 'shopProcess_list', '#main_menu_15', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `menu` VALUES (16, 'message', 'message_list', '#main_menu_16', NULL, NULL, NULL, NULL, NULL);

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
-- 資料表格式： `m_baskets`
-- 

CREATE TABLE `m_baskets` (
  `basketID` int(11) NOT NULL auto_increment,
  `basketSession` varchar(50) collate utf8_unicode_ci default NULL,
  `itemID` tinytext collate utf8_unicode_ci,
  `productID` int(11) default NULL,
  `class` tinyint(4) default '0',
  `productName` tinytext collate utf8_unicode_ci,
  `qty` tinytext collate utf8_unicode_ci,
  `qtyLimit` tinyint(4) default NULL COMMENT '可購買數量限制',
  `serial_num` tinytext collate utf8_unicode_ci,
  `d_inventory` float default NULL,
  `d_size1` tinyint(4) default NULL,
  `d_size2` tinyint(4) default NULL,
  `d_price1` int(11) default '0',
  `d_price2` int(11) default '0',
  `d_price3` int(11) default '0',
  `d_sale` tinyint(2) default '0',
  `d_price4` int(11) default '0',
  `unit` tinytext collate utf8_unicode_ci COMMENT 'd_class4 單位',
  `perUnit` int(11) default NULL COMMENT 'd_class5 每單位數量',
  `d_new_product` tinyint(2) default '0',
  `file_link2` tinytext collate utf8_unicode_ci,
  `file_link3` tinytext collate utf8_unicode_ci,
  `subtotal` int(11) default '0',
  `mb_ip` tinytext collate utf8_unicode_ci,
  `mb_time` datetime default NULL,
  `m_id` int(11) default NULL,
  PRIMARY KEY  (`basketID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=61 ;

-- 
-- 列出以下資料庫的數據： `m_baskets`
-- 

INSERT INTO `m_baskets` VALUES (1, '355ed644f12da389bd0950486d7f3711', NULL, 60, 1, 'KHÁNG修護凝露12ML', '1', 10, '', NULL, NULL, NULL, 1490, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_130_s100.jpg', 'upload_image/products/products_130_s301.jpg', 1490, '114.47.138.166', '2015-12-01 08:52:22', NULL);
INSERT INTO `m_baskets` VALUES (2, '355ed644f12da389bd0950486d7f3711', NULL, 19, 1, 'KHÁNG修護凝露10ML', '1', 20, '', NULL, NULL, NULL, 1399, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s100.jpg', 'upload_image/products/products_54_s301.jpg', 1399, '114.47.138.166', '2015-12-01 08:52:22', NULL);
INSERT INTO `m_baskets` VALUES (3, 'f2d015badffcaf1652ceb510373700fb', NULL, 26, 1, 'pit 生肌乳 30ML', '6', 20, '', NULL, NULL, NULL, 1115, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s100.jpg', 'upload_image/products/products_84_s301.jpg', 6690, '36.234.37.158', '2015-12-01 09:26:02', NULL);
INSERT INTO `m_baskets` VALUES (4, '54ed598ed01f9a53470916b7d22c5a31', NULL, 60, 1, 'KHÁNG修護凝露12ML', '1', 10, '', NULL, NULL, NULL, 1490, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_130_s100.jpg', 'upload_image/products/products_130_s301.jpg', 1490, '36.234.37.158', '2015-12-01 09:26:32', NULL);
INSERT INTO `m_baskets` VALUES (5, '95eb553189d7234e7b7d680f05dce402', NULL, 18, 1, 'pit 生肌乳 50ML', '1', 30, '', NULL, NULL, NULL, 1800, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_138_s100.jpg', 'upload_image/products/products_138_s301.jpg', 1800, '114.47.117.200', '2015-12-04 08:18:57', NULL);
INSERT INTO `m_baskets` VALUES (6, '8faac40bf2d0c0baaa96e1e61bb14205', NULL, 26, 1, 'pit 生肌乳 30ML', '1', 1, '', NULL, NULL, NULL, 1380, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s100.jpg', 'upload_image/products/products_84_s301.jpg', 1380, '220.143.0.189', '2015-12-22 02:03:45', NULL);
INSERT INTO `m_baskets` VALUES (7, '022a069374544e57caa5b31819ba0245', NULL, 20, 1, 'pit 生肌乳 15ML', '1', 1, '', NULL, NULL, NULL, 1380, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_134_s100.jpg', 'upload_image/products/products_134_s301.jpg', 1380, '114.41.141.189', '2016-01-17 10:36:46', NULL);
INSERT INTO `m_baskets` VALUES (9, '9883cae1c4ecdef27cd3c9b2b90b8aa0', NULL, 26, 1, 'pit 生肌乳 30ML', '1', 1, '', NULL, NULL, NULL, 1380, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s100.jpg', 'upload_image/products/products_84_s301.jpg', 1380, '220.142.248.180', '2016-01-25 02:30:54', NULL);
INSERT INTO `m_baskets` VALUES (10, '3cc7494b83e0cc797c258944044bc297', NULL, 19, 1, 'KHÁNG修護凝露12ML', '1', 1, '', NULL, NULL, NULL, 490, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_52_s100.jpg', 'upload_image/products/products_52_s301.jpg', 490, '101.139.155.7', '2016-01-27 09:37:41', NULL);
INSERT INTO `m_baskets` VALUES (11, 'daa546587fc5b8c7b29083731ec537a8', NULL, 19, 1, 'KHÁNG修護凝露12ML', '1', 1, '', NULL, NULL, NULL, 490, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_52_s100.jpg', 'upload_image/products/products_52_s301.jpg', 490, '114.41.129.88', '2016-02-03 10:18:47', NULL);
INSERT INTO `m_baskets` VALUES (12, '2ff8f004c67ef4d13c805a2fda721b15', NULL, 18, 1, 'pit 生肌乳 30ML', '1', 1, '', NULL, NULL, NULL, 1380, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_147_s100.jpg', 'upload_image/products/products_147_s301.jpg', 1380, '114.38.33.54', '2016-02-16 05:46:53', NULL);
INSERT INTO `m_baskets` VALUES (14, '1455f817b4aec9511ec71be3f6ec7e5c', NULL, 18, 1, 'pit 生肌乳 30ML', '1', 1, '', NULL, NULL, NULL, 1380, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_147_s100.jpg', 'upload_image/products/products_147_s301.jpg', 1380, '218.173.5.47', '2016-02-22 06:39:53', NULL);
INSERT INTO `m_baskets` VALUES (15, '8052f1cd2bfc0861cca8b3bc58bb013a', NULL, 18, 1, 'pit 生肌乳 30ML', '1', 1, '', NULL, NULL, NULL, 1380, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_147_s100.jpg', 'upload_image/products/products_147_s301.jpg', 1380, '59.120.17.18', '2016-02-24 04:40:44', NULL);
INSERT INTO `m_baskets` VALUES (16, '7a3a0f6d84242d8e204395f4a9730206', NULL, 19, 1, 'KHÁNG修護凝露12ML', '1', 1, '', NULL, NULL, NULL, 490, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_52_s100.jpg', 'upload_image/products/products_52_s301.jpg', 490, '218.173.142.140', '2016-02-26 09:50:47', NULL);
INSERT INTO `m_baskets` VALUES (17, '7a3a0f6d84242d8e204395f4a9730206', NULL, 18, 1, 'pit 生肌乳 30ML', '1', 1, '', NULL, NULL, NULL, 1380, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_147_s100.jpg', 'upload_image/products/products_147_s301.jpg', 1380, '218.173.142.140', '2016-02-26 09:50:47', NULL);
INSERT INTO `m_baskets` VALUES (18, 'bdb901e71ac27a5becdbf275783deb65', NULL, 19, 1, 'KHÁNG修護凝露12ML', '1', 1, '', NULL, NULL, NULL, 490, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_52_s100.jpg', 'upload_image/products/products_52_s301.jpg', 490, '36.237.221.217', '2016-02-29 09:32:38', NULL);
INSERT INTO `m_baskets` VALUES (19, 'bdb901e71ac27a5becdbf275783deb65', NULL, 18, 1, 'pit 生肌乳 30ML', '1', 1, '', NULL, NULL, NULL, 1380, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_147_s100.jpg', 'upload_image/products/products_147_s301.jpg', 1380, '36.237.221.217', '2016-02-29 09:32:38', NULL);
INSERT INTO `m_baskets` VALUES (20, '71c9280c805e9f17018a194031880c6c', NULL, 19, 1, 'KHÁNG修護凝露12ML', '1', 1, '', NULL, NULL, NULL, 490, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_52_s100.jpg', 'upload_image/products/products_52_s301.jpg', 490, '101.139.157.50', '2016-03-01 07:45:21', NULL);
INSERT INTO `m_baskets` VALUES (21, '59a6299f34990c7c1dc1db676395e465', NULL, 19, 1, 'KHÁNG修護凝露12ML', '1', 1, '', NULL, NULL, NULL, 490, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_52_s100.jpg', 'upload_image/products/products_52_s301.jpg', 490, '111.83.231.69', '2016-03-01 09:44:13', NULL);
INSERT INTO `m_baskets` VALUES (22, 'e2d4955618f64a0b31d5589fba6de539', NULL, 19, 1, 'KHÁNG修護凝露12ML', '1', 1, '', NULL, NULL, NULL, 490, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_52_s100.jpg', 'upload_image/products/products_52_s301.jpg', 490, '114.40.181.124', '2016-03-03 13:10:33', NULL);
INSERT INTO `m_baskets` VALUES (23, 'fbedbc97e40ad5ebfd5748a4e69c936e', NULL, 18, 1, 'pit 生肌乳 30ML', '1', 1, '', NULL, NULL, NULL, 1380, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_147_s100.jpg', 'upload_image/products/products_147_s301.jpg', 1380, '114.26.232.194', '2016-03-04 06:57:35', NULL);
INSERT INTO `m_baskets` VALUES (24, 'eb1c1bae405ea162a6f33dbf018c8e2b', NULL, 19, 1, 'KHÁNG修護凝露12ML', '1', 1, '', NULL, NULL, NULL, 490, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_52_s100.jpg', 'upload_image/products/products_52_s301.jpg', 490, '42.72.123.156', '2016-03-07 09:12:00', NULL);
INSERT INTO `m_baskets` VALUES (25, '5739cb3695698cae1a510e05e6b54904', NULL, 19, 1, 'KHÁNG修護凝露12ML', '1', 1, '', NULL, NULL, NULL, 490, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_52_s100.jpg', 'upload_image/products/products_52_s301.jpg', 490, '220.143.5.68', '2016-03-09 01:04:51', NULL);
INSERT INTO `m_baskets` VALUES (26, '947ebe362a37c5fcf597835a78084467', NULL, 19, 1, 'KHÁNG修護凝露12ML', '1', 1, '', NULL, NULL, NULL, 490, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_52_s100.jpg', 'upload_image/products/products_52_s301.jpg', 490, '220.143.5.68', '2016-03-09 01:06:55', NULL);
INSERT INTO `m_baskets` VALUES (27, '10fe505f9b41ce1ff672a9e35561bcba', NULL, 19, 1, 'KHÁNG修護凝露12ML', '1', 1, '', NULL, NULL, NULL, 490, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_52_s100.jpg', 'upload_image/products/products_52_s301.jpg', 490, '220.143.5.68', '2016-03-09 01:12:50', NULL);
INSERT INTO `m_baskets` VALUES (28, 'f45cd3e56e39c9c3d43b623a046100f5', NULL, 18, 1, 'pit 生肌乳 30ML', '1', 1, '', NULL, NULL, NULL, 1380, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_147_s100.jpg', 'upload_image/products/products_147_s301.jpg', 1380, '220.143.5.68', '2016-03-09 01:23:56', NULL);
INSERT INTO `m_baskets` VALUES (30, '6f0a7bda1f996c8919c072fdda0a7dcd', NULL, 67, 1, 'tsíng 兄弟膏 15 ml', '1', 1, '', NULL, NULL, NULL, 550, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_153_s100.png', 'upload_image/products/products_153_s301.png', 550, '220.143.4.170', '2016-03-14 06:36:10', NULL);
INSERT INTO `m_baskets` VALUES (32, 'b21a3b5124e269ab209922ae27bbdf84', NULL, 19, 1, 'kháng 修護凝露 12 ml', '10', 10, '', NULL, NULL, NULL, 490, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_52_s100.jpg', 'upload_image/products/products_52_s301.jpg', 4900, '220.143.4.170', '2016-03-14 06:56:24', NULL);
INSERT INTO `m_baskets` VALUES (35, '45c7a67445ae13c61dd1f1dbbc54a228', NULL, 19, 1, 'kháng 修護凝露 12 ml', '1', 10, '', NULL, NULL, NULL, 490, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_52_s100.jpg', 'upload_image/products/products_52_s301.jpg', 490, '114.40.172.53', '2016-03-14 12:31:25', NULL);
INSERT INTO `m_baskets` VALUES (36, 'b15db2ec47ca73f153a5a4dcb9a05e7d', NULL, 19, 1, 'kháng 修護凝露 12 ml', '2', 10, '', NULL, NULL, NULL, 490, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_52_s100.jpg', 'upload_image/products/products_52_s301.jpg', 980, '125.227.35.41', '2016-03-15 07:43:57', NULL);
INSERT INTO `m_baskets` VALUES (37, 'b15db2ec47ca73f153a5a4dcb9a05e7d', NULL, 67, 1, 'tsíng 兄弟膏 15 ml', '1', 10, '', NULL, NULL, NULL, 550, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_153_s100.png', 'upload_image/products/products_153_s301.png', 550, '223.140.51.93', '2016-03-16 02:30:20', NULL);
INSERT INTO `m_baskets` VALUES (38, '60a70202aea89f8281235af2e10bf70a', NULL, 72, 1, '漢速敷 經典傳承 2 ml [隨身必備三劍客]', '2', 10, '', NULL, NULL, NULL, 290, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_164_s100.png', 'upload_image/products/products_164_s301.png', 580, '114.26.233.135', '2016-03-18 13:29:27', NULL);
INSERT INTO `m_baskets` VALUES (39, '9473e2ac769f9b790c85ccdad3c1b9cf', NULL, 72, 1, '漢速敷 經典傳承 2 ml [隨身必備三劍客]', '1', 10, '', NULL, NULL, NULL, 290, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_164_s100.png', 'upload_image/products/products_164_s301.png', 290, '114.26.233.135', '2016-03-18 12:41:46', NULL);
INSERT INTO `m_baskets` VALUES (40, '60a70202aea89f8281235af2e10bf70a', NULL, 18, 1, 'pït 生肌乳 30 ml', '1', 10, '', NULL, NULL, NULL, 1380, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_147_s100.jpg', 'upload_image/products/products_147_s301.jpg', 1380, '114.26.233.135', '2016-03-18 13:29:27', NULL);
INSERT INTO `m_baskets` VALUES (41, '60a70202aea89f8281235af2e10bf70a', NULL, 19, 1, 'kháng 修護凝露 12 ml', '1', 10, '', NULL, NULL, NULL, 490, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_52_s100.jpg', 'upload_image/products/products_52_s301.jpg', 490, '114.26.233.135', '2016-03-18 13:29:27', NULL);
INSERT INTO `m_baskets` VALUES (42, '60a70202aea89f8281235af2e10bf70a', NULL, 67, 1, 'tsíng 兄弟膏 15 ml', '1', 10, '', NULL, NULL, NULL, 550, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_153_s100.png', 'upload_image/products/products_153_s301.png', 550, '114.26.233.135', '2016-03-18 13:29:27', NULL);
INSERT INTO `m_baskets` VALUES (43, 'e4373f0104471afe428b82712d3b6d4c', NULL, 67, 1, 'tsíng 兄弟膏 15 ml', '1', 10, '', NULL, NULL, NULL, 550, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_153_s100.png', 'upload_image/products/products_153_s301.png', 550, '111.82.157.72', '2016-03-24 12:33:25', NULL);
INSERT INTO `m_baskets` VALUES (45, '1e6f77f86debfcd29d886a89a7c1b25e', NULL, 72, 1, '漢速敷 經典傳承 2 ml [隨身必備三劍客]', '1', 10, '', NULL, NULL, NULL, 290, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_164_s100.png', 'upload_image/products/products_164_s301.png', 290, '118.171.1.72', '2016-03-31 08:31:42', NULL);
INSERT INTO `m_baskets` VALUES (52, '557573faf2914e8306e1a42fe9af9b0a', NULL, 72, 1, '漢速敷 經典傳承 2 ml [隨身必備三劍客]', '1', 10, '', NULL, NULL, NULL, 290, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_164_s100.png', 'upload_image/products/products_164_s301.png', 290, '220.143.0.42', '2016-04-12 06:04:48', NULL);
INSERT INTO `m_baskets` VALUES (53, 'e3d14b38278c65b13196689718b864e3', NULL, 18, 1, 'pït 生肌乳 30 ml', '9', 10, '', NULL, NULL, NULL, 1380, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_147_s100.jpg', 'upload_image/products/products_147_s301.jpg', 12420, '114.41.131.238', '2016-04-14 15:47:15', NULL);
INSERT INTO `m_baskets` VALUES (54, '262ecec0d1fd9f2c5a9a52f365205e5e', NULL, 72, 1, '漢速敷 經典傳承 2 ml [隨身必備三劍客]', '1', 10, '', NULL, NULL, NULL, 290, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_164_s100.png', 'upload_image/products/products_164_s301.png', 290, '223.140.63.158', '2016-04-27 12:35:16', NULL);
INSERT INTO `m_baskets` VALUES (55, '730a6740267d0ae65ab0bb897db164d3', NULL, 67, 1, 'tsíng 兄弟膏 15 ml', '1', 10, '', NULL, NULL, NULL, 550, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_153_s100.png', 'upload_image/products/products_153_s301.png', 550, '223.140.126.219', '2016-04-28 02:57:40', NULL);
INSERT INTO `m_baskets` VALUES (57, '1fbcce1339beda6f58f0ab6ad79d9682', NULL, 60, 1, 'kháng 修護凝露 12 ml [持續修護雙重奏]', '1', 10, '', NULL, NULL, NULL, 780, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_125_s100.jpg', 'upload_image/products/products_125_s301.jpg', 780, '180.176.125.68', '2016-05-11 12:24:45', NULL);
INSERT INTO `m_baskets` VALUES (59, 'b1822c46ded732420e81050dfacfb5cd', NULL, 67, 1, 'tsíng 兄弟膏 15 ml', '1', 10, '', NULL, NULL, NULL, 550, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_153_s100.png', 'upload_image/products/products_153_s301.png', 550, '220.143.206.171', '2016-05-20 02:44:05', NULL);
INSERT INTO `m_baskets` VALUES (60, '71ce411ddebaf70b97c13148af5b5650', NULL, 67, 1, 'tsíng 兄弟膏 15 ml', '1', 10, '', NULL, NULL, NULL, 550, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_153_s100.png', 'upload_image/products/products_153_s301.png', 550, '42.72.183.129', '2016-05-27 09:34:47', NULL);

-- --------------------------------------------------------

-- 
-- 資料表格式： `order_item`
-- 

CREATE TABLE `order_item` (
  `oi_id` int(11) NOT NULL auto_increment,
  `o_id` int(11) default NULL,
  `d_id` int(11) default NULL,
  `d_class` int(11) default NULL,
  `d_name` text collate utf8_unicode_ci,
  `price_status` tinytext collate utf8_unicode_ci,
  `serial_num` varchar(23) collate utf8_unicode_ci default NULL,
  `qty` int(11) default NULL,
  `d_price1` int(11) default '0',
  `d_price2` int(11) default '0',
  `d_price3` int(11) default '0',
  `d_sale` int(11) default '0',
  `d_price4` int(11) default '0',
  `unit` tinytext collate utf8_unicode_ci,
  `perUnit` int(11) default NULL,
  `pic` tinytext collate utf8_unicode_ci,
  `pic2` tinytext collate utf8_unicode_ci,
  `d_new_p` tinyint(2) default '0',
  `subtotal` int(11) default '0',
  PRIMARY KEY  (`oi_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

-- 
-- 列出以下資料庫的數據： `order_item`
-- 

INSERT INTO `order_item` VALUES (1, 1, 26, 1, 'pit 生肌乳 30ML', NULL, NULL, 2, 1115, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_84_s301.jpg', 'upload_image/products/products_84_s100.jpg', NULL, 2230);
INSERT INTO `order_item` VALUES (2, 1, 18, 1, 'pit 生肌乳 50ML', NULL, NULL, 1, 1800, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_138_s301.jpg', 'upload_image/products/products_138_s100.jpg', NULL, 1800);
INSERT INTO `order_item` VALUES (3, 2, 60, 1, 'KHÁNG修護凝露12ML', NULL, NULL, 1, 1490, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_130_s301.jpg', 'upload_image/products/products_130_s100.jpg', NULL, 1490);
INSERT INTO `order_item` VALUES (4, 2, 19, 1, 'KHÁNG修護凝露10ML', NULL, NULL, 1, 1399, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_54_s301.jpg', 'upload_image/products/products_54_s100.jpg', NULL, 1399);
INSERT INTO `order_item` VALUES (5, 3, 72, 1, '漢速敷 經典傳承 2 ml [隨身必備三劍客]', NULL, NULL, 1, 290, NULL, NULL, 0, 0, NULL, NULL, 'upload_image/products/products_164_s301.png', 'upload_image/products/products_164_s100.png', 0, 290);
INSERT INTO `order_item` VALUES (6, 4, 72, 1, '漢速敷 經典傳承 2 ml [隨身必備三劍客]', NULL, NULL, 1, 290, NULL, NULL, 0, 0, NULL, NULL, 'upload_image/products/products_164_s301.png', 'upload_image/products/products_164_s100.png', 0, 290);
INSERT INTO `order_item` VALUES (7, 5, 68, 1, 'tsíng 兄弟膏 15 ml [兄弟相親相愛分享組]', NULL, NULL, 1, 918, NULL, NULL, 0, 0, NULL, NULL, 'upload_image/products/products_155_s301.png', 'upload_image/products/products_155_s100.png', 0, 918);
INSERT INTO `order_item` VALUES (8, 6, 70, 1, 'kháng 修護凝露 2 ml [試用隨身瓶]', NULL, NULL, 1, 100, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_160_s301.jpg', 'upload_image/products/products_160_s100.jpg', NULL, 100);
INSERT INTO `order_item` VALUES (9, 7, 67, 1, 'tsíng 兄弟膏 15 ml', NULL, NULL, 1, 550, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_153_s301.png', 'upload_image/products/products_153_s100.png', NULL, 550);
INSERT INTO `order_item` VALUES (10, 8, 19, 1, 'kháng 修護凝露 12 ml', NULL, NULL, 2, 490, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_52_s301.jpg', 'upload_image/products/products_52_s100.jpg', NULL, 980);
INSERT INTO `order_item` VALUES (11, 9, 67, 1, 'tsíng 兄弟膏 15 ml', NULL, NULL, 1, 550, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_153_s301.png', 'upload_image/products/products_153_s100.png', NULL, 550);
INSERT INTO `order_item` VALUES (12, 10, 68, 1, 'tsíng 兄弟膏 15 ml [兄弟相親相愛分享組]', NULL, NULL, 1, 918, NULL, NULL, 0, 0, NULL, NULL, 'upload_image/products/products_155_s301.png', 'upload_image/products/products_155_s100.png', 0, 918);
INSERT INTO `order_item` VALUES (13, 11, 67, 1, 'tsíng 兄弟膏 15 ml', NULL, NULL, 1, 550, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_153_s301.png', 'upload_image/products/products_153_s100.png', NULL, 550);

-- --------------------------------------------------------

-- 
-- 資料表格式： `order_set`
-- 

CREATE TABLE `order_set` (
  `o_id` int(11) NOT NULL auto_increment,
  `o_number` tinytext collate utf8_unicode_ci,
  `client` tinytext collate utf8_unicode_ci,
  `c_gender` tinyint(2) default NULL,
  `phone` varchar(23) collate utf8_unicode_ci default NULL,
  `cellphone` varchar(30) collate utf8_unicode_ci default NULL,
  `email` tinytext collate utf8_unicode_ci,
  `address` tinytext collate utf8_unicode_ci,
  `zipcode` int(11) default NULL,
  `r_client` tinytext collate utf8_unicode_ci,
  `r_gender` tinyint(2) default NULL,
  `r_phone` varchar(20) collate utf8_unicode_ci default NULL,
  `r_cellphone` varchar(30) collate utf8_unicode_ci default NULL,
  `r_email` tinytext collate utf8_unicode_ci,
  `r_address` tinytext collate utf8_unicode_ci,
  `r_zipcode` int(11) default NULL,
  `invoice` int(11) default NULL,
  `insn` text collate utf8_unicode_ci,
  `inname` text collate utf8_unicode_ci,
  `in_zipcode` int(11) default NULL,
  `inadd` text collate utf8_unicode_ci,
  `in_phone` tinytext collate utf8_unicode_ci,
  `payment` tinyint(2) default '0',
  `card_status` tinyint(2) default '0',
  `cash_status` tinyint(2) default '0',
  `bank_status` tinyint(2) default '0',
  `transport_status` tinyint(2) default '0',
  `m_id` int(11) default NULL,
  `tfee` int(11) default NULL,
  `SubTotalAll` int(11) default '0',
  `GrandTotal` int(11) default '0',
  `transport` tinyint(2) default '0',
  `delivery` tinyint(2) default '0',
  `TrackingNum` tinytext collate utf8_unicode_ci,
  `remitter` tinytext collate utf8_unicode_ci,
  `remitter_AC` varchar(20) collate utf8_unicode_ci default '0',
  `remitter_money` varchar(30) collate utf8_unicode_ci default '0',
  `remitter_time` varchar(30) collate utf8_unicode_ci default '0000-00-00 00:00',
  `remitter_active` tinyint(1) default '0',
  `datetime` datetime default NULL,
  `notation` text collate utf8_unicode_ci,
  `m_account` tinytext collate utf8_unicode_ci,
  `RID` text collate utf8_unicode_ci,
  PRIMARY KEY  (`o_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

-- 
-- 列出以下資料庫的數據： `order_set`
-- 

INSERT INTO `order_set` VALUES (1, 'TD15120100001', '威廉', 1, NULL, '08-7456987', 'williamboss@pchome.com.tw', '屏東縣麟洛鄉中山路87號', 909, '威廉', 1, NULL, '08-7456987', 'williamboss@pchome.com.tw', '屏東縣麟洛鄉中山路87號', 909, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 0, 227, 100, 4030, 4130, NULL, NULL, NULL, '徐威廉', '54321', '4130', '2015-12-01 17:00', 1, '2015-12-01 15:27:05', '何時會出貨呢?', 'williamboss@pchome.com.tw', NULL);
INSERT INTO `order_set` VALUES (2, 'TD15120100002', '威廉', 1, NULL, '08-7456987', 'williamboss@pchome.com.tw', '屏東縣麟洛鄉中山路87號', 909, '威廉', 1, NULL, '08-7456987', 'williamboss@pchome.com.tw', '屏東縣麟洛鄉中山路87號', 909, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, 227, 0, 2889, 2889, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-12-01 16:52:59', '請問預計何時會出貨呢?\r\n謝謝', 'williamboss@pchome.com.tw', NULL);
INSERT INTO `order_set` VALUES (3, 'TD16033100001', '很好設計測試', 0, NULL, '0937686482', 'williamshsu@gmail.com', '台中市西屯區文華路150巷31號1樓', 407, '很好設計測試', 0, NULL, '0937686482', 'williamshsu@gmail.com', '台中市西屯區文華路150巷31號1樓', 407, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, NULL, 100, 290, 390, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2016-03-31 15:36:44', '很好設計測試中', NULL, NULL);
INSERT INTO `order_set` VALUES (4, 'TD16033100002', '很好設計測試2', 0, NULL, '0937686482', 'williamshsu@gmail.com', '台中市西屯區文華路150巷31號1樓', 407, '很好設計測試2', 0, NULL, '0937686482', 'williamshsu@gmail.com', '台中市西屯區文華路150巷31號1樓', 407, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, 234, 100, 290, 390, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2016-03-31 16:48:43', '很好設計測試2', 'williamshsu@gmail.com', NULL);
INSERT INTO `order_set` VALUES (5, 'TD16033100003', '很好設計測試3', 1, NULL, '0937686482', 'williamshsu@gmail.com', '台中市西屯區文華路150巷31號1樓', 407, '很好設計測試3', 1, NULL, '0937686482', 'williamshsu@gmail.com', '台中市西屯區文華路150巷31號1樓', 407, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, 235, 0, 918, 918, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2016-03-31 16:51:45', '很好設計測試3', 'williamshsu@gmail.com', NULL);
INSERT INTO `order_set` VALUES (6, 'TD16033100004', '很好設計測試4', 1, NULL, '0937686482', 'williamshsu@gmail.com', '台中市西屯區文華路150巷31號1樓', 407, '很好設計測試4', 1, NULL, '0937686482', 'williamshsu@gmail.com', '台中市西屯區文華路150巷31號1樓', 407, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, 236, 100, 100, 200, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2016-03-31 16:53:55', '很好設計測試4', 'williamshsu@gmail.com', NULL);
INSERT INTO `order_set` VALUES (7, 'TD16041200001', 'Happy', 0, NULL, '0912199389', 'marylin231@hotmail.com', '高雄市新興區wenheng231', 800, 'Happy', 0, NULL, '0912199389', 'marylin231@hotmail.com', '高雄市新興區wenheng231', 800, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, 237, 0, 550, 550, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2016-04-12 11:52:47', NULL, 'marylin231@hotmail.com', NULL);
INSERT INTO `order_set` VALUES (8, 'TD16041200002', 'Happy', 0, NULL, '0912199389', 'marylin231@hotmail.com', '高雄市新興區wenheng231', 800, 'Happy', 0, NULL, '0912199389', 'marylin231@hotmail.com', '高雄市新興區wenheng231', 800, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, 237, 0, 980, 980, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2016-04-12 11:56:48', NULL, 'marylin231@hotmail.com', NULL);
INSERT INTO `order_set` VALUES (9, 'TD16041200003', 'Happy', 0, NULL, '0912199389', 'marylin231@hotmail.com', '高雄市新興區wenheng231', 800, 'Happy', 0, NULL, '0912199389', 'marylin231@hotmail.com', '高雄市新興區wenheng231', 800, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, 237, 0, 550, 550, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2016-04-12 11:59:22', NULL, 'marylin231@hotmail.com', NULL);
INSERT INTO `order_set` VALUES (10, 'TD16051100001', 'ML', 0, NULL, '0912199389', 'xiaoma31@yahoo.com.tw', '高雄市三民區汾陽路70號12樓', 807, 'ML', 0, NULL, '0912199389', 'xiaoma31@yahoo.com.tw', '高雄市三民區汾陽路70號12樓', 807, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, 229, 0, 918, 918, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2016-05-11 10:39:19', NULL, 'xiaoma31@yahoo.com.tw', NULL);
INSERT INTO `order_set` VALUES (11, 'TD16051800001', '洪家豪', 1, NULL, '0921327741', 'thehouger@hotmail.com', '台中市霧峰區四德路275巷66弄1號', 413, '洪家豪', 1, NULL, '0921327741', 'thehouger@hotmail.com', '台中市霧峰區四德路275巷66弄1號', 413, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, 238, 0, 550, 550, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2016-05-18 09:24:24', '請於下午5點過後再送達，謝謝！', 'thehouger@hotmail.com', NULL);

-- --------------------------------------------------------

-- 
-- 資料表格式： `response_set`
-- 

CREATE TABLE `response_set` (
  `r_id` int(11) NOT NULL auto_increment,
  `r_o_id` int(11) NOT NULL,
  `r_status` int(3) default '-1',
  `r_lidm` tinytext collate utf8_unicode_ci,
  `r_lastPan4` varchar(4) collate utf8_unicode_ci default NULL,
  `r_authAmt` tinytext collate utf8_unicode_ci,
  `r_authCode` tinytext collate utf8_unicode_ci,
  `r_xid` tinytext collate utf8_unicode_ci,
  `r_authTime` tinytext collate utf8_unicode_ci,
  `r_errcode` tinytext collate utf8_unicode_ci,
  `r_errDesc` tinytext collate utf8_unicode_ci,
  `r_cardBrand` tinytext collate utf8_unicode_ci,
  `r_pan` tinytext collate utf8_unicode_ci,
  `r_order_date` datetime default NULL,
  `r_response_date` datetime default NULL,
  PRIMARY KEY  (`r_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- 列出以下資料庫的數據： `response_set`
-- 


-- --------------------------------------------------------

-- 
-- 資料表格式： `terms`
-- 

CREATE TABLE `terms` (
  `term_id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(200) collate utf8_unicode_ci NOT NULL default '',
  `slug` varchar(200) collate utf8_unicode_ci NOT NULL default '',
  `term_group` bigint(10) NOT NULL default '0',
  `term_active` tinyint(2) NOT NULL default '1',
  `term_sort` int(11) default '1',
  PRIMARY KEY  (`term_id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

-- 
-- 列出以下資料庫的數據： `terms`
-- 

INSERT INTO `terms` VALUES (1, '黑玉修護凝露', '%E9%BB%91%E7%8E%89%E4%BF%AE%E8%AD%B7%E5%87%9D%E9%9C%B2', 0, 1, 1);
INSERT INTO `terms` VALUES (3, '黑玉生肌乳', '%E9%BB%91%E7%8E%89%E7%94%9F%E8%82%8C%E4%B9%B3', 0, 1, 2);
INSERT INTO `terms` VALUES (4, '漢速敷 兄弟膏', '%E6%BC%A2%E9%80%9F%E6%95%B7+%E5%85%84%E5%BC%9F%E8%86%8F', 0, 1, 3);
INSERT INTO `terms` VALUES (5, '漢速敷 經典傳承', '%E6%BC%A2%E9%80%9F%E6%95%B7+%E7%B6%93%E5%85%B8%E5%82%B3%E6%89%BF', 0, 1, 4);

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

INSERT INTO `term_relationships` VALUES (13, 2, 2);
INSERT INTO `term_relationships` VALUES (17, 2, 1);
INSERT INTO `term_relationships` VALUES (18, 3, 1);
INSERT INTO `term_relationships` VALUES (19, 1, 1);
INSERT INTO `term_relationships` VALUES (20, 3, 2);
INSERT INTO `term_relationships` VALUES (26, 3, 4);
INSERT INTO `term_relationships` VALUES (60, 1, 2);
INSERT INTO `term_relationships` VALUES (67, 4, 1);
INSERT INTO `term_relationships` VALUES (68, 4, 2);
INSERT INTO `term_relationships` VALUES (69, 4, 3);
INSERT INTO `term_relationships` VALUES (70, 1, 3);
INSERT INTO `term_relationships` VALUES (71, 3, 3);
INSERT INTO `term_relationships` VALUES (72, 5, 1);

-- --------------------------------------------------------

-- 
-- 資料表格式： `term_taxonomy`
-- 

CREATE TABLE `term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL auto_increment,
  `term_id` bigint(20) unsigned NOT NULL default '0',
  `taxonomy` varchar(32) collate utf8_unicode_ci NOT NULL default '',
  `description` longtext collate utf8_unicode_ci NOT NULL,
  `parent` bigint(20) unsigned NOT NULL default '0',
  `count` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

-- 
-- 列出以下資料庫的數據： `term_taxonomy`
-- 

INSERT INTO `term_taxonomy` VALUES (1, 1, 'post_tag', '', 0, 0);
INSERT INTO `term_taxonomy` VALUES (3, 3, 'post_tag', '', 0, 0);
INSERT INTO `term_taxonomy` VALUES (4, 4, 'post_tag', '', 0, 0);
INSERT INTO `term_taxonomy` VALUES (5, 5, 'post_tag', '', 0, 0);

-- --------------------------------------------------------

-- 
-- 資料表格式： `vitae_set`
-- 

CREATE TABLE `vitae_set` (
  `v_id` int(11) NOT NULL auto_increment,
  `v_d_id` int(11) default NULL,
  `v_class1` tinytext collate utf8_unicode_ci,
  `v_name` tinytext collate utf8_unicode_ci,
  `v_gender` tinyint(4) default NULL,
  `v_phone` tinytext collate utf8_unicode_ci,
  `v_ages` tinytext collate utf8_unicode_ci,
  `v_email` text collate utf8_unicode_ci,
  `v_address` text collate utf8_unicode_ci,
  `v_content` text collate utf8_unicode_ci,
  `v_date` datetime default NULL,
  PRIMARY KEY  (`v_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- 列出以下資料庫的數據： `vitae_set`
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


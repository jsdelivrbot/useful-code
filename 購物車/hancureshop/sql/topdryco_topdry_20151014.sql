-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 14, 2015 at 01:54 PM
-- Server version: 5.6.26-cll-lve
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `topdryco_topdry`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_id`, `user_name`, `user_password`, `user_level`, `user_limit`, `user_active`) VALUES
(1, 'topdry', 'a665ceaafda0cff5c91bd40b2e18bbdd', 1, 1, 1),
(7, 'bigtree', 'e7e37960001852a35ff173af5e199699', 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `a_set`
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
-- Dumping data for table `a_set`
--

INSERT INTO `a_set` (`a_id`, `a_title`, `a_1`, `a_2`, `a_3`, `a_4`, `a_5`, `a_6`, `a_7`, `a_8`, `a_9`, `a_10`, `a_11`, `a_12`, `a_13`, `a_14`, `a_15`, `a_16`) VALUES
(1, '系統管理員', 210, 210, 210, 210, 105, 105, 15, 15, 15, 15, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '資料更新員', 0, 0, 0, 0, 15, 15, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `class_set`
--

INSERT INTO `class_set` (`c_id`, `c_title`, `c_content`, `c_class`, `c_link`, `c_level`, `c_active`, `c_parent`, `c_sort`) VALUES
(1, '產品資訊', NULL, NULL, NULL, NULL, 1, 'newsC', 2),
(3, '小知識', NULL, NULL, NULL, NULL, 1, 'newsC', 3),
(4, '活動公告', NULL, NULL, NULL, NULL, 1, 'newsC', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=60 ;

--
-- Dumping data for table `data_set`
--

INSERT INTO `data_set` (`d_id`, `d_title`, `d_content`, `d_class1`, `d_class2`, `d_class3`, `d_class4`, `d_class5`, `d_class6`, `d_tag`, `d_price1`, `d_price2`, `d_price3`, `d_inventory`, `d_sale`, `d_new_product`, `d_date`, `d_active`, `d_sort`) VALUES
(1, 'Banner1', NULL, 'banners', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2015-09-04 08:00:14', 1, 4),
(7, '關於我們', '「小罐子點心鋪 TOPDRY」 ! \r\n全新品牌上市：品牌設定、視覺形象、產品包裝皆為專業設計團隊全新打造。 \r\n自產自製自銷：完善的產銷機制,全方位嚴加控管所有產品的質量與產量。  \r\n年輕團隊經營：八年級的李承軒帶領著一個年輕的團隊,用創新的思維經營。 \r\n新鮮健康美味：食材皆為在地生產,收成後馬上進行加工,保留自然原味。 \r\n真空慢炸技術：真空環境降低油炸沸點,藉此達到脫水,使食材酥脆可口。 \r\n\r\n「小罐子點心鋪 TOPDRY」提供透過低溫真空慢炸技術製成的休閒食品,再搭配離心脫油處理,完整保留食材天然色澤、香氣等,亦可降低油脂劣化程度,「小罐子點心鋪 TOPDRY」無負擔的新食感主義,讓享用美味的同時,更吃進了營養健康, 有別於過去對油炸休閒食品的刻板印象,獨特酥脆的爽口感,讓人總忍不住再多吃幾口。\r\n\r\n【這一蚵，超好吃的啦】\r\n鮮美海味，自然甘甜真空低溫慢炸的技術，保留蚵仔的風味以及尺寸，帶著鮮美海味的自然甘甜，不管是在清晨七點鐘或是凌晨三點鐘，隨時都可以吃到的營養美味的新食感。這一「蚵」起撈後，仔細進行去殼、清洗後，將水嫩飽滿的新鮮蚵仔進行真空低溫慢炸，再搭配離心脫油處理，有別於傳統油炸休閒食品，口感酥脆不油膩，完整鎖住鮮味，留住天然營養！真空低溫慢炸後的蚵仔保證風味不流失，尺寸不縮水！這一「蚵」帶勁的好口味，不管現在幾點，無論身在何處，冰友啊～喜歡海味的你，一定不能錯過，享用大海小菜超easy！用來點心、下酒都適合！\r\n\r\n【頂級地瓜薯條 - 金薯C】\r\n純素保證 / 嚴選台農57號地瓜,純素食,葷素者皆宜,吃的輕鬆又健康。\r\n絕不添加 / 用天然⾷材,不添加化學成分、香精、合成調味。\r\n滋味濃郁 / 雲林優良的氣候環境,種植出的作物碩大飽滿味道好。\r\n\r\n透過低溫真空慢炸技術製成，製作過程僅添加少許的糖鹽，主要是要帶出地瓜本身的香氣與鮮甜，完整保留食材天然色澤、香氣等,亦可降低油脂劣化程度,「小罐子點心鋪 TOPDRY」無負擔的新食感主義,讓享用美味的同時,更吃進了營養健康。\r\n\r\n', 'about', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2015-09-04 08:23:42', 1, 1),
(8, '聯絡我們', '雲林縣口湖鄉成龍村成龍197號', 'contact', '23.5593433,120.1685486', '0925-266-198', NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2015-09-04 09:27:35', 1, 1),
(10, '【新品上市】這一蚵，超好吃的啦！鮮美海味 自然甘甜', '<p><span style="font-size: 18pt; color: #ff9900;">【超鮮味 這一蚵 全新上市】</span></p>\r\n<p><span style="font-size: 14pt;">Topdry在大家的期待下，經過不斷的研發以及修正，終於又推出了一個萬眾矚目的新產品：這一蚵，同樣透過真空低溫慢炸的技術，保留蚵仔的風味以及尺寸，帶著鮮美海味的自然甘甜，讓大家不管是在清晨七點鐘或是凌晨三點鐘，隨時都可以吃到的海味新食感，冰友啊～喜歡海味的你，一定不能錯過，享用大海小菜超easy！用來點心、下酒都適合！！</span></p>\r\n<p><span style="font-size: 14pt;">&nbsp;</span></p>\r\n<p>&nbsp;</p>\r\n<p><img src="../source/%E6%9C%80%E6%96%B0%E6%B6%88%E6%81%AF-01.jpg" alt="" width="805" height="480" /></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 'news', '1', '2015', NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2015-09-09 06:27:00', 1, 1),
(18, '小罐子點心鋪【這一蚵 x 3入輕巧盒】上市優惠中', '<p><strong><span style="font-size: 24pt; color: #ff0000;">&nbsp;TOPDRY歡慶官網全新上線!!!★這一蚵3入上市優惠價 225/盒</span></strong></p>\r\n<p><span style="font-size: 14pt;">★ 全館不限品項滿十盒免運費 </span></p>\r\n<p><span style="font-size: 14pt;">★本優惠活動即日起至10/5日止</span></p>\r\n<p><span style="font-size: 14pt;">-</span></p>\r\n<p><span style="color: #ff9900; font-size: 24pt;"><strong>【這一蚵，超好吃的啦】</strong></span></p>\r\n<p><span style="font-size: 12pt; color: #ff9900;">鮮美海味，自然甘甜真空低溫慢炸的技術，保留蚵仔的風味以及尺寸，</span></p>\r\n<p><span style="font-size: 12pt; color: #ff9900;">帶著鮮美海味的自然甘甜，不管是在清晨七點鐘或是凌晨三點鐘，</span></p>\r\n<p><span style="font-size: 12pt; color: #ff9900;">隨時都可以吃到的營養美味的新食感。</span></p>\r\n<p><span style="font-size: 12pt; color: #ff9900;">&nbsp;</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style="font-size: 12pt;">蚵仔的好滋味，這一「蚵」最了解，富含優質蛋白質、低脂肪、低膽固醇，</span></p>\r\n<p><span style="font-size: 12pt;">高營養價值近乎於奶類食品，濃郁鮮美的滋味彷彿就是&ldquo;大海中的牛奶&rdquo;！</span></p>\r\n<p><span style="font-size: 10pt; color: #ff9900;">這一「蚵」起撈後，仔細進行去殼、清洗後，將水嫩飽滿的新鮮蚵仔進行真空低溫慢炸，</span></p>\r\n<p><span style="font-size: 10pt; color: #ff9900;">再搭配離心脫油處理，有別於傳統油炸休閒食品，口感酥脆不油膩，完整鎖住鮮味，留住天然營養！</span></p>\r\n<p><span style="font-size: 10pt; color: #ff9900;">真空低溫慢炸後的蚵仔保證風味不流失，尺寸不縮水！這一「蚵」帶勁的好口味，不管現在幾點，</span></p>\r\n<p><span style="font-size: 10pt; color: #ff9900;">無論身在何處，冰友啊～喜歡海味的你，一定不能錯過，享用大海小菜超easy！用來點心、下酒都適合！</span></p>\r\n<p><img src="../source/%E9%80%99%E4%B8%80%E8%9A%B5-005.jpg" alt="" /><img src="../source/%E9%80%99%E4%B8%80%E8%9A%B5-002.jpg" alt="" width="750" height="532" /><img src="../source/%E9%80%99%E4%B8%80%E8%9A%B5-%E4%B8%89%E5%85%A5-001.jpg" alt="" width="750" height="532" /></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 'products', '3', '<p class="notep">成分：蚵仔、鹽、油</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">重量：25g&plusmn;5%(每包)</p>\r\n<p class="notep">保存方式：避免陽光直射及高溫潮濕處，建議放置乾冷之場所，開封後，請放置冰箱冷藏</p>\r\n<p class="notep">保存期限：6個月</p>', '<p>蚵仔的好滋味，這一「蚵」最了解，富含優質蛋白質、低脂肪、低膽固醇，高營養價值近乎於奶類食品，濃郁鮮美的滋味彷彿就是&ldquo;大海中的牛奶&rdquo;！</p>\r\n<p>這一「蚵」起撈後，由人工仔細進行去殼、清洗後，將水嫩飽滿的新鮮蚵仔進行真空低溫慢炸，再搭配離心脫油處理，有別於傳統油炸休閒食品，口感酥脆不油膩，完整鎖住鮮味，留住天然營養！</p>\r\n<p>真空低溫慢炸後的蚵仔保證風味不流失，尺寸不縮水！這一「蚵」有原味椒鹽、檸檬椒鹽兩種鹹香帶勁的好口味，不管現在幾點，無論身在何處，冰友啊～喜歡海味的你，一定不能錯過，享用大海小菜超easy！用來點心、下酒都適合！</p>', NULL, NULL, '3', 225, 100, 0, NULL, NULL, NULL, '2015-09-09 08:02:20', 1, 1),
(19, '小罐子點心鋪【金薯C x 10入禮盒】', '<p style="text-align: center;"><strong><span style="font-size: 24pt; color: #ff0000;">&nbsp;TOPDRY歡慶官網全新上線!!!</span></strong></p>\r\n<p style="text-align: center;"><span style="font-size: 14pt;">★ 全館不限品項滿12盒免運費</span></p>\r\n<p style="text-align: center;"><span style="font-size: 14pt;"><span style="font-size: 10pt;"> (同一人購買,不限商品大小盒總數為12盒)</span></span></p>\r\n<p style="text-align: center;"><span style="font-size: 14pt;">★未滿12盒，運費酌收100元</span></p>\r\n<p>&nbsp;</p>\r\n<h3 dir="ltr" style="text-align: center;"><span style="font-size: 18pt; color: #0000ff;">金薯C，吃了就金素Ｃ</span></h3>\r\n<h3 style="text-align: center;"><span style="color: #0000ff;">☀雲林縣水林鄉金黃色的台農57號地瓜</span></h3>\r\n<h3 style="text-align: center;"><span style="color: #0000ff;">☀低鹽、低油、低卡與眾不同的薯條</span></h3>\r\n<h3 style="text-align: center;"><span style="color: #0000ff;">☀地瓜含有豐富維他命C</span></h3>\r\n<p style="text-align: center;"><span style="font-size: 8pt;">&nbsp;</span></p>\r\n<p style="text-align: center;"><span style="color: #993300; font-size: 8pt;">地瓜經過清洗後，經過人工削皮、挑選，再加少許的糖、鹽保鮮與提味</span></p>\r\n<p style="text-align: center;"><span style="color: #993300; font-size: 8pt;">再將黃金地瓜進行真空低溫慢炸，搭配離心脫油處理，有別於傳統油炸休閒食品</span></p>\r\n<p style="text-align: center;"><span style="color: #993300; font-size: 8pt;">讓地瓜有鬆脆香甜的口感且營養完全保留，堅持原味，低鹽、低卡與低鈉無負擔</span></p>\r\n<p style="text-align: center;"><span style="font-family: impact, chicago; color: #993300; font-size: 8pt;">十成原料，只有2成的成品，既營養且稀有</span></p>\r\n<p style="text-align: center;"><span style="font-family: impact, chicago; color: #993300;"><img src="../source/TOPDRY-%E7%94%A2%E5%93%81%E5%A4%A7%E9%A0%AD-15.jpg" alt="" width="901" height="601" /></span></p>\r\n<p style="text-align: center;"><span style="font-family: impact, chicago; color: #993300;"><img src="../source/C-007_1.jpg" alt="" width="750" height="532" /></span></p>\r\n<p style="text-align: center;"><span style="font-family: impact, chicago; color: #993300;"><img src="../source/TOPDRY-%E5%A4%A7-09.jpg" alt="" width="750" height="540" /></span></p>', 'products', '1', '<p class="notep">成分：地瓜、糖、鹽、油</p>\r\n<p class="notep">產地：台灣口湖鄉</p>\r\n<p class="notep">重量：25g&plusmn;5%(每包)</p>\r\n<p class="notep">保存方式：避免陽光直射及高溫潮濕處，建議放置乾冷之場所，開封後，請放置冰箱冷藏</p>\r\n<p class="notep">最佳賞味期限：6個月</p>\r\n<p class="notep">保存期限：一年</p>', '<p><span style="font-size: 12pt;"><strong>【純素保證】</strong>嚴選台農57號地瓜,純素食,葷素者皆宜,吃的輕鬆又健康。</span></p>\r\n<p><span style="font-size: 12pt;"><strong>【絕不添加】</strong>用天然⾷材,不添加化學成分、香精、合成調味。</span></p>\r\n<p><span style="font-size: 12pt;"><strong>【滋味濃郁】</strong>雲林優良的氣候環境,種植出的作物碩大飽滿味道好。</span></p>\r\n<p style="text-align: left;"><strong><span style="font-size: 12pt;">&nbsp;<span style="color: #000000;">地瓜營養成分</span></span></strong></p>\r\n<p><span style="font-size: 12pt;">&nbsp;蛋白質、脂肪、醣類纖維素、鈣、鈉、磷、鐵、胡蘿蔔素、<span lang="EN-US">B1</span>、<span lang="EN-US">B2</span>、<span lang="EN-US">C</span>，及賴氨酸和亞油酸，每<span lang="EN-US">100</span>公克 &nbsp;地瓜的胡蘿蔔素含量<span lang="EN-US">1.31</span>毫克，含維生素<span lang="EN-US">C30</span>毫克，賴氨酸<span lang="EN-US">26</span>毫克。地瓜還有一種特殊的黏液蛋白，能維 &nbsp;持人體血管壁的彈性，防止動脈硬化，促進膽固醇的排泄，減少皮下脂肪。</span></p>', NULL, NULL, '1', 400, 20, 0, NULL, NULL, NULL, '2015-09-09 08:06:35', 1, 1),
(20, '小罐子點心鋪【金薯C x 4入輕巧盒】', '<p style="text-align: center;"><strong><span style="font-size: 24pt; color: #ff0000;">&nbsp;TOPDRY歡慶官網全新上線!!!</span></strong></p>\r\n<p style="text-align: center;"><span style="font-size: 14pt;">★ 全館不限品項滿12盒免運費</span></p>\r\n<p style="text-align: center;"><span style="font-size: 14pt;"><span style="font-size: 10pt;"> (同一人購買,不限商品大小盒總數為12盒)</span></span></p>\r\n<p style="text-align: center;"><span style="font-size: 14pt;">★未滿12盒，運費酌收100元</span></p>\r\n<p style="text-align: center;">&nbsp;</p>\r\n<h3 dir="ltr" style="text-align: center;"><span style="font-size: 18pt; color: #0000ff;">金薯C，吃了就金素Ｃ</span></h3>\r\n<h3 style="text-align: center;"><span style="color: #0000ff;">☀雲林縣水林鄉金黃色的台農57號地瓜</span></h3>\r\n<h3 style="text-align: center;"><span style="color: #0000ff;">☀低鹽、低油、低卡與眾不同的薯條</span></h3>\r\n<h3 style="text-align: center;"><span style="color: #0000ff;">☀地瓜含有豐富維他命C</span></h3>\r\n<p style="text-align: center;"><span style="font-size: 8pt;">&nbsp;</span></p>\r\n<p style="text-align: center;"><span style="color: #993300; font-size: 8pt;">地瓜經過清洗後，經過人工削皮、挑選，再加少許的糖、鹽保鮮與提味</span></p>\r\n<p style="text-align: center;"><span style="color: #993300; font-size: 8pt;">再將黃金地瓜進行真空低溫慢炸，搭配離心脫油處理，有別於傳統油炸休閒食品</span></p>\r\n<p style="text-align: center;"><span style="color: #993300; font-size: 8pt;">讓地瓜有鬆脆香甜的口感且營養完全保留，堅持原味，低鹽、低卡與低鈉無負擔</span></p>\r\n<p style="text-align: center;"><span style="font-family: impact, chicago; color: #993300; font-size: 8pt;">十成原料，只有2成的成品，既營養且稀有</span></p>\r\n<p><img src="../source/TOPDRY-%E7%94%A2%E5%93%81%E5%A4%A7%E9%A0%AD-14.jpg" alt="" width="901" height="601" /></p>\r\n<p>&nbsp;</p>\r\n<p><img src="../source/%E9%87%91%E8%96%AFC-007.jpg" alt="" width="750" height="532" /></p>\r\n<p>&nbsp;<img src="../source/TOPDRY-%E5%A4%A7-09.jpg" alt="" width="750" height="540" /></p>', 'products', '1', '<p class="notep">成分：地瓜、糖、鹽、油</p>\r\n<p class="notep">產地：台灣口湖鄉</p>\r\n<p class="notep">重量：25g&plusmn;5%(每包)</p>\r\n<p class="notep">保存方式：避免陽光直射及高溫潮濕處，建議放置乾冷之場所，開封後，請放置冰箱冷藏</p>\r\n<p class="notep">最佳賞味期限：6個月</p>\r\n<p class="notep">保存期限：一年</p>', '<p><span style="font-size: 12pt;"><strong>【純素保證】</strong>嚴選台農57號地瓜,純素食,葷素者皆宜,吃的輕鬆又健康。</span></p>\r\n<p><span style="font-size: 12pt;"><strong>【絕不添加】</strong>用天然⾷材,不添加化學成分、香精、合成調味。</span></p>\r\n<p><span style="font-size: 12pt;"><strong>【滋味濃郁】</strong>雲林優良的氣候環境,種植出的作物碩大飽滿味道好</span>。</p>\r\n<p style="text-align: left;"><strong><span style="font-size: 12pt;">&nbsp;<span style="color: #000000;">地瓜營養成分</span></span></strong></p>\r\n<p><span style="font-size: 12pt;">&nbsp;蛋白質、脂肪、醣類纖維素、鈣、鈉、磷、鐵、胡蘿蔔素、<span lang="EN-US">B1</span>、<span lang="EN-US">B2</span>、<span lang="EN-US">C</span>，及賴氨酸和亞油酸，每<span lang="EN-US">100</span>公克 &nbsp;地瓜的胡蘿蔔素含量<span lang="EN-US">1.31</span>毫克，含維生素<span lang="EN-US">C30</span>毫克，賴氨酸<span lang="EN-US">26</span>毫克。地瓜還有一種特殊的黏液蛋白，能維 &nbsp;持人體血管壁的彈性，防止動脈硬化，促進膽固醇的排泄，減少皮下脂肪。</span></p>', NULL, NULL, '1', 180, 20, 0, NULL, NULL, NULL, '2015-09-11 15:04:56', 1, 1),
(23, '訂購單', NULL, 'download', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2015-09-14 00:31:44', 1, 1),
(24, '小罐子點心鋪【金薯C x 4入輕巧盒】中秋團在一起 ● 下單區', '<p><span style="color: #ff6600; font-size: 24pt;"><strong>【金薯C四入中秋特賣區】</strong></span></p>\r\n<p><span style="color: #ff6600; font-size: 12pt;"><strong>一筆單為二十盒，每售出十筆即抽一張500元711禮卷贈送</strong></span></p>\r\n<p><img src="../source/TOPDRY-%E5%A4%A7-01.jpg" alt="" width="750" height="540" /></p>\r\n<p><img src="../source/%E9%87%91%E8%96%AFC-002.jpg" alt="" width="750" height="532" /><img src="../source/C-007_2.jpg" alt="" width="750" height="532" /></p>', 'products', '1', '<p class="notep">成分：地瓜、糖、鹽、油</p>\r\n<p class="notep">產地：台灣口湖鄉</p>\r\n<p class="notep">重量：25g&plusmn;5%(每包)</p>\r\n<p class="notep">保存方式：避免陽光直射及高溫潮濕處，建議放置乾冷之場所，開封後，請放置冰箱冷藏</p>\r\n<p class="notep">最佳賞味期限：6個月</p>\r\n<p class="notep">保存期限：一年</p>', '<p><span style="font-size: 12pt;"><strong>【純素保證】</strong>嚴選台農57號地瓜,純素食,葷素者皆宜,吃的輕鬆又健康。</span></p>\r\n<p><span style="font-size: 12pt;"><strong>【絕不添加】</strong>用天然⾷材,不添加化學成分、香精、合成調味。</span></p>\r\n<p><span style="font-size: 12pt;"><strong>【滋味濃郁】</strong>雲林優良的氣候環境,種植出的作物碩大飽滿味道好。</span></p>', NULL, NULL, '1', 180, 20, 0, NULL, NULL, NULL, '2015-09-14 20:53:27', 0, 1),
(26, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】上市優惠中', '<p><strong><span style="font-size: 24pt; color: #ff0000;">&nbsp;TOPDRY歡慶官網全新上線!!!★這一蚵6入上市優惠價 450/盒</span></strong></p>\r\n<p><span style="font-size: 14pt;">★ 全館不限品項滿十盒免運費 </span></p>\r\n<p><span style="font-size: 14pt;">★本優惠活動即日起至10/5日止</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style="font-size: 14pt;">-</span></p>\r\n<p><span style="color: #ff9900;"><strong><span style="font-size: 24pt;">【這一蚵，超好吃的啦】</span></strong></span></p>\r\n<p><span style="font-size: 12pt; color: #ff9900;">鮮美海味，自然甘甜真空低溫慢炸的技術，保留蚵仔的風味以及尺寸，</span></p>\r\n<p><span style="font-size: 12pt; color: #ff9900;">帶著鮮美海味的自然甘甜，不管是在清晨七點鐘或是凌晨三點鐘，</span></p>\r\n<p><span style="font-size: 12pt; color: #ff9900;">隨時都可以吃到的營養美味的新食感。</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style="font-size: 19px;">-</span></p>\r\n<p><span style="font-size: 12pt;">蚵仔的好滋味，這一「蚵」最了解，富含優質蛋白質、低脂肪、低膽固醇，</span></p>\r\n<p><span style="font-size: 12pt;">高營養價值近乎於奶類食品，濃郁鮮美的滋味彷彿就是&ldquo;大海中的牛奶&rdquo;！</span></p>\r\n<p><span style="font-size: 10pt; color: #ff9900;">這一「蚵」起撈後，仔細進行去殼、清洗後，將水嫩飽滿的新鮮蚵仔進行真空低溫慢炸，</span></p>\r\n<p><span style="font-size: 10pt; color: #ff9900;">再搭配離心脫油處理，有別於傳統油炸休閒食品，口感酥脆不油膩，完整鎖住鮮味，留住天然營養！</span></p>\r\n<p><span style="font-size: 10pt; color: #ff9900;">真空低溫慢炸後的蚵仔保證風味不流失，尺寸不縮水！這一「蚵」帶勁的好口味，不管現在幾點，</span></p>\r\n<p><span style="font-size: 10pt; color: #ff9900;">無論身在何處，冰友啊～喜歡海味的你，一定不能錯過，享用大海小菜超easy！用來點心、下酒都適合！</span></p>\r\n<p><img src="../source/%E9%80%99%E4%B8%80%E8%9A%B5-006.jpg" alt="" width="750" height="532" /></p>\r\n<p><img src="../source/-005_1.jpg" alt="" width="750" height="532" /></p>\r\n<p><img src="../source/%E9%80%99%E4%B8%80%E8%9A%B5-%E5%85%AD%E5%85%A5-001.jpg" alt="" width="750" height="532" /><img src="../source/%E9%80%99%E4%B8%80%E8%9A%B5-007.jpg" alt="" width="750" height="532" /></p>', 'products', '3', '<p class="notep">成分：蚵仔、鹽、油</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">重量：25g&plusmn;5%(每包)</p>\r\n<p class="notep">保存方式：避免陽光直射及高溫潮濕處，建議放置乾冷之場所，開封後，請放置冰箱冷藏</p>\r\n<p class="notep">最佳賞味期限：6個月</p>\r\n<p class="notep">保存期限：一年</p>', '<p>蚵仔的好滋味，這一「蚵」最了解，富含優質蛋白質、低脂肪、低膽固醇，高營養價值近乎於奶類食品，濃郁鮮美的滋味彷彿就是&ldquo;大海中的牛奶&rdquo;！</p>\r\n<p>這一「蚵」起撈後，由人工仔細進行去殼、清洗後，將水嫩飽滿的新鮮蚵仔進行真空低溫慢炸，再搭配離心脫油處理，有別於傳統油炸休閒食品，口感酥脆不油膩，完整鎖住鮮味，留住天然營養！</p>\r\n<p>真空低溫慢炸後的蚵仔保證風味不流失，尺寸不縮水！這一「蚵」帶勁的好口味，不管現在幾點，無論身在何處，冰友啊～喜歡海味的你，一定不能錯過，享用大海小菜超easy！用來點心、下酒都適合！</p>', NULL, NULL, '3', 450, 20, 0, NULL, NULL, NULL, '2015-09-14 21:06:59', 1, 1),
(27, '小罐子點心鋪【這一蚵 x 3入輕巧盒】★ 買十免運', '<p><span style="color: #ff6600; font-size: 24pt;"><strong>【這一蚵三入中秋特賣區】</strong></span></p>\r\n<p><span style="color: #ff6600; font-size: 14pt;"><strong>立即下單享優惠，<span style="text-decoration: underline; color: #ff0000;">10/9</span>全面出貨</strong></span></p>\r\n<p><img src="../source/%E9%80%99%E4%B8%80%E8%9A%B5-%E4%B8%AD%E7%A7%8B%E4%B8%89%E5%85%A5-001.jpg" alt="" width="750" height="532" /><img src="../source/%E9%80%99%E4%B8%80%E8%9A%B5-004.jpg" alt="" width="750" height="532" /><img src="../source/%E9%80%99%E4%B8%80%E8%9A%B5-003.jpg" alt="" width="750" height="532" /></p>', 'products', '3', '<p class="notep">成分：蚵仔、鹽、油</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">重量：25g&plusmn;5%(每包)</p>\r\n<p class="notep">保存方式：避免陽光直射及高溫潮濕處，建議放置乾冷之場所，開封後，請放置冰箱冷藏</p>\r\n<p class="notep">保存期限：6個月</p>', '<p>蚵仔的好滋味，這一「蚵」最了解，富含優質蛋白質、低脂肪、低膽固醇，高營養價值近乎於奶類食品，濃郁鮮美的滋味彷彿就是&ldquo;大海中的牛奶&rdquo;！</p>\r\n<p>這一「蚵」起撈後，由人工仔細進行去殼、清洗後，將水嫩飽滿的新鮮蚵仔進行真空低溫慢炸，再搭配離心脫油處理，有別於傳統油炸休閒食品，口感酥脆不油膩，完整鎖住鮮味，留住天然營養！</p>\r\n<p>真空低溫慢炸後的蚵仔保證風味不流失，尺寸不縮水！這一「蚵」有原味椒鹽、檸檬椒鹽兩種鹹香帶勁的好口味，不管現在幾點，無論身在何處，冰友啊～喜歡海味的你，一定不能錯過，享用大海小菜超easy！用來點心、下酒都適合！</p>', NULL, NULL, '3', 225, 20, 0, NULL, NULL, NULL, '2015-09-14 21:11:20', 0, 1),
(28, '小罐子點心鋪【這一蚵 x 6入好禮讚】 ★ 買十免運', '<p>&nbsp;</p>\r\n<p><span style="color: #ff6600; font-size: 24pt;"><strong>【這一蚵六入中秋特賣區】</strong></span></p>\r\n<p><span style="color: #ff6600; font-size: 14pt;"><strong>立即下單享優惠，<span style="text-decoration: underline; color: #ff0000;">10/9</span>全面出貨</strong></span></p>\r\n<p><img src="../source/%E9%80%99%E4%B8%80%E8%9A%B5-%E4%B8%AD%E7%A7%8B%E5%85%AD%E5%85%A5-001.jpg" alt="" width="750" height="532" /><img src="../source/%E9%80%99%E4%B8%80%E8%9A%B5-005.jpg" alt="" width="750" height="532" /><img src="../source/news_18-1.jpg" alt="" width="805" height="480" /></p>', 'products', '3', '<p class="notep">成分：蚵仔、鹽、油</p>\r\n<p class="notep">產地：台灣</p>\r\n<p class="notep">重量：25g&plusmn;5%(每包)</p>\r\n<p class="notep">保存方式：避免陽光直射及高溫潮濕處，建議放置乾冷之場所，開封後，請放置冰箱冷藏</p>\r\n<p class="notep">保存期限：6個月</p>', '<p>蚵仔的好滋味，這一「蚵」最了解，富含優質蛋白質、低脂肪、低膽固醇，高營養價值近乎於奶類食品，濃郁鮮美的滋味彷彿就是&ldquo;大海中的牛奶&rdquo;！</p>\r\n<p>這一「蚵」起撈後，由人工仔細進行去殼、清洗後，將水嫩飽滿的新鮮蚵仔進行真空低溫慢炸，再搭配離心脫油處理，有別於傳統油炸休閒食品，口感酥脆不油膩，完整鎖住鮮味，留住天然營養！</p>\r\n<p>真空低溫慢炸後的蚵仔保證風味不流失，尺寸不縮水！這一「蚵」有原味椒鹽、檸檬椒鹽兩種鹹香帶勁的好口味，不管現在幾點，無論身在何處，冰友啊～喜歡海味的你，一定不能錯過，享用大海小菜超easy！用來點心、下酒都適合！</p>', NULL, NULL, '3', 450, 20, 0, NULL, NULL, NULL, '2015-09-14 21:15:46', 0, 1),
(35, '何謂「真空低溫慢炸」', '<p>簡單來說，就是在真空的環境中用低於120度的油溫進行慢炸，真空的環境可完美隔絕空氣，讓油品不易變質，還具有優越的脫水效果，維持蚵仔酥脆，保鮮美味更持久！</p>\r\n<p>&nbsp;</p>\r\n<p>大家都清楚了嗎～</p>', 'news', '3', '2015', NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2015-09-14 21:26:41', 1, 1),
(42, NULL, NULL, 'banners', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2015-09-14 21:42:00', 1, 3),
(44, NULL, NULL, 'banners', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, '2015-09-14 21:44:13', 1, 5),
(45, NULL, NULL, 'news', '4', '2015', NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2015-09-16 23:56:43', 1, 2),
(54, NULL, NULL, 'banners', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, '2015-09-17 19:37:21', 1, 2),
(55, 'TOPDRY歡慶官網全新上線!!!', '<p><span style="font-size: 18pt; color: #ff6600;">【全館不限品項滿十盒免運費 】</span></p>\r\n<p><span style="font-size: 18pt; color: #ff6600;">【本優惠活動即日起至10/5日止】 </span></p>\r\n<p><span style="font-size: 18pt; color: #ff6600;">【本優惠活動統一出貨日為10/9號】</span></p>\r\n<p><span style="font-size: 18pt; color: #ff6600;">【只購買金薯C單一品項滿十盒可搶先出貨】</span></p>\r\n<p>&nbsp;</p>', 'news', '4', '2015', NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '2015-09-17 19:45:29', 1, 1),
(58, NULL, NULL, 'banners', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, '2015-09-17 19:54:51', 1, 1),
(59, '免運費設定', NULL, 'freight', NULL, NULL, NULL, NULL, NULL, NULL, 12, 0, 0, 0, 0, 0, '2015-09-18 17:00:35', 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=124 ;

--
-- Dumping data for table `file_set`
--

INSERT INTO `file_set` (`file_d_id`, `file_id`, `file_type`, `file_name`, `file_title`, `file_link1`, `file_link2`, `file_link3`, `file_link4`, `file_link5`, `file_show_type`) VALUES
(1, 2, 'image', 'banners_2.jpg', 'Banner1', 'upload_image/banners/banners_2.jpg', 'upload_image/banners/banners_2_s100.jpg', NULL, NULL, NULL, 1),
(7, 8, 'image', 'about_8.jpg', '關於我們', 'upload_image/about/about_8.jpg', 'upload_image/about/about_8_s100.jpg', NULL, NULL, NULL, 1),
(7, 11, 'image', 'about_11.jpg', '關於我們', 'upload_image/about/about_11.jpg', 'upload_image/about/about_11_s100.jpg', NULL, NULL, NULL, 1),
(10, 20, 'image', 'news_20.jpg', '這一蚵', 'upload_image/news/news_20.jpg', 'upload_image/news/news_20_s100.jpg', NULL, NULL, NULL, 1),
(18, 47, 'image', 'products_47.jpg', '這一蚵三', 'upload_image/products/products_47.jpg', 'upload_image/products/products_47_s100.jpg', 'upload_image/products/products_47_s301.jpg', NULL, NULL, 1),
(18, 48, 'image', 'products_48.jpg', '這一蚵三', 'upload_image/products/products_48.jpg', 'upload_image/products/products_48_s100.jpg', 'upload_image/products/products_48_s301.jpg', NULL, NULL, 1),
(18, 49, 'image', 'products_49.jpg', '這一蚵三', 'upload_image/products/products_49.jpg', 'upload_image/products/products_49_s100.jpg', 'upload_image/products/products_49_s301.jpg', NULL, NULL, 1),
(18, 50, 'image', 'products_50.jpg', '這一蚵三入', 'upload_image/products/products_50.jpg', 'upload_image/products/products_50_s100.jpg', 'upload_image/products/products_50_s301.jpg', NULL, NULL, 1),
(19, 51, 'image', 'products_51.jpg', '金薯C：十入', 'upload_image/products/products_51.jpg', 'upload_image/products/products_51_s100.jpg', 'upload_image/products/products_51_s301.jpg', NULL, NULL, 1),
(19, 52, 'image', 'products_52.jpg', '金薯C：十入', 'upload_image/products/products_52.jpg', 'upload_image/products/products_52_s100.jpg', 'upload_image/products/products_52_s301.jpg', NULL, NULL, 1),
(19, 53, 'image', 'products_53.jpg', '金薯C：十入', 'upload_image/products/products_53.jpg', 'upload_image/products/products_53_s100.jpg', 'upload_image/products/products_53_s301.jpg', NULL, NULL, 1),
(19, 54, 'image', 'products_54.jpg', '金薯C：十入', 'upload_image/products/products_54.jpg', 'upload_image/products/products_54_s100.jpg', 'upload_image/products/products_54_s301.jpg', NULL, NULL, 1),
(23, 67, 'file', 'news_67.jpg', '預購單', 'upload_file/news/news_67.jpg', NULL, NULL, NULL, NULL, 0),
(8, 68, 'image', 'contact_68.png', NULL, 'upload_image/contact/contact_68.png', 'upload_image/contact/contact_68_s100.png', NULL, NULL, NULL, 1),
(20, 69, 'image', 'products_69.jpg', NULL, 'upload_image/products/products_69.jpg', 'upload_image/products/products_69_s100.jpg', 'upload_image/products/products_69_s301.jpg', NULL, NULL, 1),
(20, 70, 'image', 'products_70.jpg', NULL, 'upload_image/products/products_70.jpg', 'upload_image/products/products_70_s100.jpg', 'upload_image/products/products_70_s301.jpg', NULL, NULL, 1),
(20, 71, 'image', 'products_71.jpg', NULL, 'upload_image/products/products_71.jpg', 'upload_image/products/products_71_s100.jpg', 'upload_image/products/products_71_s301.jpg', NULL, NULL, 1),
(20, 72, 'image', 'products_72.jpg', NULL, 'upload_image/products/products_72.jpg', 'upload_image/products/products_72_s100.jpg', 'upload_image/products/products_72_s301.jpg', NULL, NULL, 1),
(24, 73, 'image', 'products_73.jpg', NULL, 'upload_image/products/products_73.jpg', 'upload_image/products/products_73_s100.jpg', 'upload_image/products/products_73_s301.jpg', NULL, NULL, 1),
(24, 74, 'image', 'products_74.jpg', NULL, 'upload_image/products/products_74.jpg', 'upload_image/products/products_74_s100.jpg', 'upload_image/products/products_74_s301.jpg', NULL, NULL, 1),
(24, 75, 'image', 'products_75.jpg', NULL, 'upload_image/products/products_75.jpg', 'upload_image/products/products_75_s100.jpg', 'upload_image/products/products_75_s301.jpg', NULL, NULL, 1),
(24, 76, 'image', 'products_76.jpg', NULL, 'upload_image/products/products_76.jpg', 'upload_image/products/products_76_s100.jpg', 'upload_image/products/products_76_s301.jpg', NULL, NULL, 1),
(26, 81, 'image', 'products_81.jpg', NULL, 'upload_image/products/products_81.jpg', 'upload_image/products/products_81_s100.jpg', 'upload_image/products/products_81_s301.jpg', NULL, NULL, 1),
(26, 82, 'image', 'products_82.jpg', NULL, 'upload_image/products/products_82.jpg', 'upload_image/products/products_82_s100.jpg', 'upload_image/products/products_82_s301.jpg', NULL, NULL, 1),
(26, 83, 'image', 'products_83.jpg', NULL, 'upload_image/products/products_83.jpg', 'upload_image/products/products_83_s100.jpg', 'upload_image/products/products_83_s301.jpg', NULL, NULL, 1),
(26, 84, 'image', 'products_84.jpg', NULL, 'upload_image/products/products_84.jpg', 'upload_image/products/products_84_s100.jpg', 'upload_image/products/products_84_s301.jpg', NULL, NULL, 1),
(27, 85, 'image', 'products_85.jpg', NULL, 'upload_image/products/products_85.jpg', 'upload_image/products/products_85_s100.jpg', 'upload_image/products/products_85_s301.jpg', NULL, NULL, 1),
(27, 86, 'image', 'products_86.jpg', NULL, 'upload_image/products/products_86.jpg', 'upload_image/products/products_86_s100.jpg', 'upload_image/products/products_86_s301.jpg', NULL, NULL, 1),
(27, 87, 'image', 'products_87.jpg', NULL, 'upload_image/products/products_87.jpg', 'upload_image/products/products_87_s100.jpg', 'upload_image/products/products_87_s301.jpg', NULL, NULL, 1),
(27, 88, 'image', 'products_88.jpg', NULL, 'upload_image/products/products_88.jpg', 'upload_image/products/products_88_s100.jpg', 'upload_image/products/products_88_s301.jpg', NULL, NULL, 1),
(28, 89, 'image', 'products_89.jpg', NULL, 'upload_image/products/products_89.jpg', 'upload_image/products/products_89_s100.jpg', 'upload_image/products/products_89_s301.jpg', NULL, NULL, 1),
(28, 90, 'image', 'products_90.jpg', NULL, 'upload_image/products/products_90.jpg', 'upload_image/products/products_90_s100.jpg', 'upload_image/products/products_90_s301.jpg', NULL, NULL, 1),
(28, 91, 'image', 'products_91.jpg', NULL, 'upload_image/products/products_91.jpg', 'upload_image/products/products_91_s100.jpg', 'upload_image/products/products_91_s301.jpg', NULL, NULL, 1),
(28, 92, 'image', 'products_92.jpg', NULL, 'upload_image/products/products_92.jpg', 'upload_image/products/products_92_s100.jpg', 'upload_image/products/products_92_s301.jpg', NULL, NULL, 1),
(42, 105, 'image', 'banners_105.jpg', NULL, 'upload_image/banners/banners_105.jpg', 'upload_image/banners/banners_105_s100.jpg', NULL, NULL, NULL, 1),
(44, 107, 'image', 'banners_106.jpg', NULL, 'upload_image/banners/banners_106.jpg', 'upload_image/banners/banners_106_s100.jpg', NULL, NULL, NULL, 1),
(35, 108, 'image', 'news_108.jpg', NULL, 'upload_image/news/news_108.jpg', 'upload_image/news/news_108_s100.jpg', NULL, NULL, NULL, 1),
(45, 109, 'image', 'news_109.jpg', NULL, 'upload_image/news/news_109.jpg', 'upload_image/news/news_109_s100.jpg', NULL, NULL, NULL, 1),
(54, 118, 'image', 'banners_113.jpg', NULL, 'upload_image/banners/banners_113.jpg', 'upload_image/banners/banners_113_s100.jpg', NULL, NULL, NULL, 1),
(55, 122, 'image', 'news_122.jpg', NULL, 'upload_image/news/news_122.jpg', 'upload_image/news/news_122_s100.jpg', NULL, NULL, NULL, 1),
(58, 123, 'image', 'banners_123.jpg', NULL, 'upload_image/banners/banners_123.jpg', 'upload_image/banners/banners_123_s100.jpg', NULL, NULL, NULL, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=226 ;

--
-- Dumping data for table `member_set`
--

INSERT INTO `member_set` (`m_id`, `m_class2`, `m_class3`, `m_name`, `m_account`, `m_password`, `m_gender`, `m_birthyear`, `m_birthmonth`, `m_birthday`, `m_email`, `m_phone`, `m_cellphone`, `m_zip`, `m_city`, `m_canton`, `m_address`, `m_content`, `m_sn`, `m_fname`, `m_item`, `m_faddress`, `m_fzip`, `m_fcity`, `m_fcanton`, `m_area`, `m_map`, `m_epaper`, `m_level`, `m_active`, `m_date`) VALUES
(179, 'normal', NULL, 'williams', 'william@yahoo.com', 'fd820a2b4461bddd116c1518bc4b0f77', NULL, '2010', '01', '01', 'williams@yahoo.com', '0937452147', NULL, 821, '高雄市', '路竹區', '成龍村成龍1917號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-11 13:35:09'),
(180, NULL, NULL, '高興', 'link7311@gmail.com', '381ea8c597e366e5b27d847bb721e420', '1', NULL, NULL, NULL, 'link7311@gmail.com', '0937100194', NULL, 407, '台中市', '西屯區', '文華路150巷31號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2015-09-13 23:12:14'),
(181, NULL, NULL, '高高', 'studio.goods@gmail.com', '381ea8c597e366e5b27d847bb721e420', '1', NULL, NULL, NULL, 'studio.goods@gmail.com', '0937100194', NULL, 407, '台中市', '西屯區', '文華路150巷31號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2015-09-14 01:02:30'),
(184, NULL, NULL, '威廉', 'williambossmailg@gmail.com', '240154152063f20a59e078e6d9946c75', '1', '2000', '02', '02', 'williambossmailg@gmail.com', '0987456321', NULL, 824, '高雄市', '燕巢區', '鄉成龍村成龍197號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-14 02:13:29'),
(185, NULL, NULL, 'julie', 'julieli63@gmail.com', '1036f56c3611e7eb6f78a950b2d76017', '0', '1984', '07', '23', 'julieli63@gmail.com', '0918034103', NULL, 112, '台北市', '北投區', '大業路566號2樓', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-14 13:26:21'),
(186, NULL, NULL, '陳詩婷', 'a7749586@gmail.com', 'eab20fcf8a19c7e6673d3fa89049d206', '0', '1991', '09', '26', 'a7749586@gmail.com', '0985683008', NULL, 526, '彰化縣', '二林鎮', '梅芳里太平路100號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-14 18:02:00'),
(187, NULL, NULL, '陳慧娟', 'elisa1204@gmail.com', '9e1201beb7240a1f4e7d2de10bc81516', '0', '1973', '12', '04', 'elisa1204@gmail.com', '0958388188', NULL, 235, '新北市', '中和區', '自立路36-19號1樓', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-18 12:17:41'),
(188, NULL, NULL, '張淑華', 'berry941003@yahoo.con.tw', '00e8a672996ac3554a9892db5e450f16', '0', '1969', '10', '28', 'berry941003@yahoo.con.tw', '0939522679', NULL, 243, '新北市', '泰山區', '泰林路2段507-2號7樓', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-18 12:18:05'),
(189, NULL, NULL, '張椀婷', 'vivian640930@yahoo.com.tw', 'cb5d2e4ed382217f668b1b772d421169', '0', '1975', '09', '30', 'vivian640930@yahoo.com.tw', '0918530538', NULL, 231, '新北市', '新店區', '中正路539-1號1樓', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-18 12:24:48'),
(190, NULL, NULL, '張瓊敏', 'mabel690227@hotmail.com', 'f522727c44c22ada9e848a1230c23bf0', '0', '1980', '04', '12', 'mabel690227@hotmail.com', '0952032725', NULL, 104, '台北市', '中山區', '新生北路2段28巷1號8樓之3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-18 12:25:54'),
(191, NULL, NULL, '徐靜思', 's338881@yahoo.com.tw', 'b147604f9b05256ecb2a544aca67d0e3', '0', '1978', '01', '22', 's338881@yahoo.com.tw', '0925318319', NULL, 804, '高雄市', '鼓山區', '龍水路227號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-18 12:35:08'),
(192, NULL, NULL, '邱香琪', 'miga56789@yahoo.com.tw', 'f5a41e7f5ed4d299d4c15786684336aa', '0', '1975', '07', '13', 'miga56789@yahoo.com.tw', '0913050561', NULL, 220, '新北市', '板橋區', '三民路一段一巷12號4樓', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-18 12:39:58'),
(193, NULL, NULL, '何素卿', 'teresa_ho0932@yahoo.com.t', 'aa567e75f640abbcdd3d8babcd10f1b9', '0', '1969', '01', '30', 'teresa_ho0932@yahoo.com.t', '0925570267', NULL, 330, '桃園市', '桃園區', '中山東路32-25號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-18 12:37:10'),
(194, NULL, NULL, '張育慈', 'a1993823@yahoo.com.tw', 'f4c4764776ff72db5463ddc8f30e8141', '0', '1993', '08', '23', 'a1993823@yahoo.com.tw', '0975609530', NULL, 334, '桃園市', '八德區', '介壽路一段202號2樓', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-18 12:57:31'),
(195, NULL, NULL, '陳韶婕', 'wangmian27@yahoo.com', 'fd64a771a3a46a7d1b3ad1391de2efe9', '0', '2015', '09', '18', 'wangmian27@yahoo.com', '0933269591', NULL, 892, '金門縣', '金寧鄉', '湖下233號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-18 13:46:30'),
(196, NULL, NULL, '羅靜雲', 'room1212@kimo.com', 'e086d3858ada72ef341c251e5d7fdbed', '0', '1981', '11', '26', 'room1212@kimo.com', '0972155566', NULL, 302, '新竹縣', '竹北市', '新民街326巷14號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-18 14:21:56'),
(197, NULL, NULL, '楊芯慈', 'andy223485861@yahoo.com.tw', 'e9305196b06a148cea124d46d28af83d', '0', '1986', '04', '28', 'andy223485861@yahoo.com.tw', '0905590343', NULL, 433, '台中市', '沙鹿區', '鎮南路二段91號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-18 15:06:16'),
(198, NULL, NULL, '張語玲', 'nico3539@yahoo.com.tw', 'bebdd9525a3d4e46d7b98599aa3b2d1c', '0', '2015', '10', '07', 'nico3539@yahoo.com.tw', '0931850938', NULL, 830, '高雄市', '鳳山區', '五甲二路218號1F', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-18 14:45:52'),
(199, NULL, NULL, '張媛臻', 'myjill0105@gmail.com', 'fcb2f05d274768bf52a22e1fe6016474', '0', '1989', '01', '05', 'myjill0105@gmail.com', '0972073852', NULL, 407, '台中市', '西屯區', '大鵬路37號3樓', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-18 15:26:02'),
(200, NULL, NULL, '徐雪容', 'angelwing966@yahoo.com.tw', '4157fe64222da9d1f2ccd11e476f8906', '0', '1977', '02', '18', 'angelwing966@yahoo.com.tw', '0958966739', NULL, 100, '台北市', '中正區', '汀州路1段172號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-18 16:23:35'),
(201, NULL, NULL, '鍾佩庭', 'peiting7722@gmail.com', '3f828c816ee0c5583930b06ca3a66ea4', '0', '1988', '02', '02', 'peiting7722@gmail.com', '0985220154', NULL, 111, '台北市', '士林區', '基河路128號B1(台北青少年)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-18 17:38:10'),
(202, NULL, NULL, '張夏萍', 'sherry01092002@yahoo.com.tw', '58d4c22958bd24c79841f81307cacd5a', '0', '2015', '09', '18', 'sherry01092002@yahoo.com.tw', '0910093063', NULL, 252, '新北市', '三芝區', '長勤街26號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-18 18:06:37'),
(203, NULL, NULL, '郭怡萍', 'b239733@yahoo.com.tw', 'd67637c17573c58271a097f97aee78ab', '0', '1988', '04', '23', 'b239733@yahoo.com.tw', '0961296147', NULL, 711, '台南市', '歸仁區', '民族北街17巷2號10樓之三', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-18 20:22:43'),
(204, NULL, NULL, '黃志凱', 'kaiandgreen@gmail.com', 'b2a9a16d67bddbb905264b3136f3c831', '1', '1983', '07', '03', 'kaiandgreen@gmail.com', '0930775393', NULL, 220, '新北市', '板橋區', '新北市板橋區校前街40巷1號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-18 21:01:20'),
(205, NULL, NULL, 'teresa', 'teresa_ho0932@yahoo.com.tw', '32eddc3745d6aa55d3d57dee2aee203d', '0', '1969', '01', '30', 'teresa_ho0932@yahoo.com.tw', '0925570267', NULL, 330, '桃園市', '桃園區', '中山東路32-25 號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-18 21:08:56'),
(206, NULL, NULL, '蘇韋豪', 'lovebaby.1980@gmail.com', '971cf5023b0dbe1103af4983bddd857d', '1', '1978', '04', '25', 'lovebaby.1980@gmail.com', '0918055753', NULL, 600, '嘉義市', '西區', '新榮路124號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-18 22:28:01'),
(207, NULL, NULL, '邱雅琦', 'bad123362@gmail.com', '0269ce37c16afa28bd4d7abd9cbd7c6b', '0', '1992', '12', '25', 'bad123362@gmail.com', '0976570552', NULL, 912, '屏東縣', '內埔鄉', '福泰路3-1號6樓608室', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-18 22:29:01'),
(208, NULL, NULL, '邱怡紋', 'katie20012001@msn.com', '89adfac3ecafaa271732cf22c01b2a13', '0', '1987', '01', '17', 'katie20012001@msn.com', '0928039382', NULL, 104, '台北市', '中山區', '龍江路137巷11號4樓', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-18 23:25:26'),
(209, NULL, NULL, '吳麗月', 'yueh5458@livemail.tw', '2682822659f6961832e6218e54f77bf9', '0', '1971', '09', '13', 'yueh5458@livemail.tw', '0917289185', NULL, 235, '新北市', '中和區', '景安路79巷37弄14-5號1樓', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-18 23:44:20'),
(210, NULL, NULL, '林柏廷', 'h730606@gmail.com', '56e02d754ba89c799fc709047835aced', NULL, '1984', '06', '06', 'h730606@gmail.com', '0921951319', NULL, 220, '新北市', '板橋區', '三民路2段123巷26之2號3F\r\n', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-18 23:42:17'),
(211, NULL, NULL, '曾婉倩', 'kinki812301@yahoo.com.tw', 'd911e1faf084bfd8a159a8727a593476', '0', '1983', '05', '06', 'kinki812301@yahoo.com.tw', '0963035488', NULL, 242, '新北市', '新莊區', '中興街6之4號4樓', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-19 00:11:01'),
(212, NULL, NULL, '曾培綸', 'rita7388@msn.com', 'a2c243f5aa1a513a7b0f056059551f35', '0', '1970', '11', '08', 'rita7388@msn.com', '0910561548', NULL, 406, '台中市', '北屯區', '太和一街41號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-19 10:32:35'),
(213, NULL, NULL, '陳姿君', 'shin75310@yahoo.com.tw', 'ed5c372c31eb5ad05c801ac33dfc9fcb', '0', '1986', '03', '10', 'shin75310@yahoo.com.tw', '0970389297', NULL, 500, '彰化縣', '彰化市', '建國東路308號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-19 20:49:52'),
(214, NULL, NULL, '溫冕棋', 'wenmian7@gmail.com', 'f6c65667c1b7f780ea31287b6cd7c03f', '0', '1991', '11', '07', 'wenmian7@gmail.com', '0976624609', NULL, 302, '新竹縣', '竹北市', '國盛街252號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-19 23:54:16'),
(215, NULL, NULL, '陳奕岑', 'ivychen03@yahoo.com.tw', '7a6d9cd4571a3e6ed1f3f3870b81f938', '0', '1974', '10', '03', 'ivychen03@yahoo.com.tw', '0911858831', NULL, 408, '台中市', '南屯區', '文心路一段186號14樓之8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-21 09:28:04'),
(216, NULL, NULL, '蕭雪霞', 'michelle_77.tw@yahoo.com.tw', 'da5b60c675ed10f423198f7692ae6cbb', '0', '1977', '03', '02', 'michelle_77.tw@yahoo.com.tw', '0926265593', NULL, 270, '宜蘭縣', '蘇澳鎮', '嶺脚路53號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-21 15:08:24'),
(217, NULL, NULL, '陳黎儀', 'joan@datafast.com.tw', 'f242480023e6bcd98e951e084bddc9f6', '0', '1980', '11', '11', 'joan@datafast.com.tw', '0911206287', NULL, 221, '新北市', '汐止區', '汐止區康寧街169巷27-1號6樓', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-22 00:13:57'),
(218, NULL, NULL, '許博揚', 'zinix55@gmail.com', '4119fe8d5a4ce937333777f384b631fb', '1', '2015', '09', '22', 'zinix55@gmail.com', '0919942625', NULL, 236, '新北市', '土城區', '立德路29巷6號4樓', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-22 14:10:45'),
(219, NULL, NULL, '羅禹婷', 'yuting012822@gmail.com', 'c9ec4fa77ea696e57d31ddc38c299594', '0', '1900', '01', '28', 'yuting012822@gmail.com', '0912684390', NULL, 360, '苗栗縣', '苗栗市', '水源里育民街57巷1號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-22 19:59:58'),
(220, NULL, NULL, '王裔淇', 'dora730204@yahoo.com.tw', '22f7f3b75d8929eb73d7c9256f9b61f3', '0', '1979', '02', '04', 'dora730204@yahoo.com.tw', '0911887994', NULL, 732, '台南市', '白河區', '關領里43之2號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-23 17:47:29'),
(221, NULL, NULL, '林相逸', 'anitasheeping@yahoo.com.tw', '19440f3b1df2e7ad5821ccdd228677e9', '0', '1979', '10', '25', 'anitasheeping@yahoo.com.tw', '0939272133', NULL, 221, '新北市', '汐止區', '汐止區新台五路一段171號19樓', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-09-25 01:31:12'),
(222, NULL, NULL, '蔡佩君', 'cheesebakaka@gmail.com', '7c9058d85bb0746ba2dde5cc306c87ed', '0', '1985', '08', '08', 'cheesebakaka@gmail.com', '0912658808', NULL, 655, '雲林縣', '元長鄉', '鹿北村永鹿路11-1號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-10-02 21:58:59'),
(223, NULL, NULL, '邱靖惠', 'playboy11201028@yahoo.com.tw', '057a7c7334307288fb80262d74b5640d', '0', '1984', '11', '20', 'playboy11201028@yahoo.com.tw', '0976547537', NULL, 330, '桃園市', '桃園區', '忠一路11巷7號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-10-06 22:48:07'),
(224, NULL, NULL, '陳逢時', 'u9772132@gmail.com', 'dfcabc7b5bb42676342a3b5ef819c69e', '1', '1990', '05', '18', 'u9772132@gmail.com', '0920773977', NULL, 100, '台北市', '中正區', '汀洲路2段309號1樓', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-10-07 18:12:22'),
(225, NULL, NULL, '陳志明', 'geenming@hotmail.com', '5c0b3c4ffae7f2f024bc13d38a705ec1', '1', '1990', '11', '26', 'geenming@hotmail.com', '0921202834', NULL, 885, '澎湖縣', '湖西鄉', '湖西村173號', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, '1', '2015-10-08 19:59:23');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=407 ;

--
-- Dumping data for table `m_baskets`
--

INSERT INTO `m_baskets` (`basketID`, `basketSession`, `itemID`, `productID`, `class`, `productName`, `qty`, `qtyLimit`, `serial_num`, `d_inventory`, `d_size1`, `d_size2`, `d_price1`, `d_price2`, `d_price3`, `d_sale`, `d_price4`, `unit`, `perUnit`, `d_new_product`, `file_link2`, `subtotal`, `mb_ip`, `mb_time`, `m_id`) VALUES
(40, 'nmmi75kv2tou7bbpesniafjic6', NULL, 22, 1, '番仔挖烏魚子 - 六兩六片', '2', 20, '', NULL, NULL, NULL, 1290, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_66_s301.png', 2580, '::1', '2015-09-12 23:19:12', NULL),
(41, '29muldur88s4qsbje4qt3fet52', NULL, 21, 1, '番仔挖烏魚子 - 十兩一包', '1', 5, '', NULL, NULL, NULL, 6000, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_62_s301.jpg', 6000, '::1', '2015-09-13 03:21:47', NULL),
(50, 'nduck33ccajfr0f42fqqm083b5', NULL, 22, 1, '番仔挖烏魚子 - 六兩六片', '1', 20, '', NULL, NULL, NULL, 1290, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_66_s301.png', 1290, '::1', '2015-09-13 16:14:10', NULL),
(58, '853a084966556c93bc31d976e0a18fb6', NULL, 21, 1, '番仔挖烏魚子 - 十兩一包', '1', 5, '', NULL, NULL, NULL, 6000, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_62_s301.jpg', 6000, '218.173.144.64', '2015-09-14 02:16:17', NULL),
(59, '853a084966556c93bc31d976e0a18fb6', NULL, 13, 1, '番仔挖烏魚子 - 五兩一片', '5', 127, '', NULL, NULL, NULL, 1390, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_26_s301.png', 6950, '218.173.144.64', '2015-09-14 02:16:17', NULL),
(66, 'f9bb99acff2033720622ff23e5acca43', NULL, 17, 1, '番仔挖烏魚子 - 六兩一片', '1', 40, '', NULL, NULL, NULL, 1580, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_30_s301.png', 1580, '218.173.144.64', '2015-09-14 13:20:25', NULL),
(71, '6b439efa48b3af7f5ebe7eb04b355bae', NULL, 22, 1, '金薯C：四入', '3', 20, '', NULL, NULL, NULL, 1290, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_66_s301.png', 3870, '111.253.243.113', '2015-09-14 18:20:04', NULL),
(72, 'f91691d88ea6a761e819670b6d871c20', NULL, 22, 1, '金薯C：四入', '3', 20, '', NULL, NULL, NULL, 1290, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_66_s301.png', 3870, '111.253.243.113', '2015-09-14 19:27:10', NULL),
(74, '950d6f076bc29106732c08f2e443647c', NULL, 25, 1, '小罐子點心鋪【金薯C x 10入有禮子】中秋團在一起 ● 下單區', '1', 20, '', NULL, NULL, NULL, 4000, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_80_s301.jpg', 4000, '101.13.41.172', '2015-09-15 00:04:21', NULL),
(75, '950d6f076bc29106732c08f2e443647c', NULL, 27, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】中秋團團GO ★ 買十送一下單區', '1', 20, '', NULL, NULL, NULL, 2250, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_88_s301.jpg', 2250, '101.13.41.172', '2015-09-15 00:04:21', NULL),
(77, '2a8fe6a08ee799f25300e9390be7b639', NULL, 28, 1, '小罐子點心鋪【這一蚵 x 6入好禮讚】中秋團團GO ★ 買十送一下單區', '1', 20, '', NULL, NULL, NULL, 4500, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_92_s301.jpg', 4500, '39.8.69.155', '2015-09-15 17:14:49', NULL),
(81, 'ea3fec8ab418c58f5a9c5ee47a8570eb', NULL, 24, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】中秋團在一起 ● 下單區', '1', 20, '', NULL, NULL, NULL, 3600, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_76_s301.jpg', 3600, '101.13.41.172', '2015-09-15 18:26:15', NULL),
(83, 'ae5b0e1aa33a1591e64e6e097a122827', NULL, 27, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】中秋團團GO ★ 買十送一下單區', '1', 20, '', NULL, NULL, NULL, 2250, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_88_s301.jpg', 2250, '36.233.21.21', '2015-09-16 16:57:36', NULL),
(85, 'a5a97d94cf6168af2af2c9ca575a551c', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '36.235.185.185', '2015-09-16 21:13:35', NULL),
(86, 'a5a97d94cf6168af2af2c9ca575a551c', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】', '8', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 1800, '36.235.185.185', '2015-09-16 21:13:35', NULL),
(87, 'a5a97d94cf6168af2af2c9ca575a551c', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', '6', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 2700, '36.235.185.185', '2015-09-16 21:13:35', NULL),
(88, 'a5a97d94cf6168af2af2c9ca575a551c', NULL, 27, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】中秋團團GO ★ 買十送一下單區', '1', 20, '', NULL, NULL, NULL, 2250, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_88_s301.jpg', 2250, '36.235.185.185', '2015-09-16 21:13:35', NULL),
(89, 'cfd33ca14eb94f51dfee5dab22ccf37c', NULL, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', '1', 20, '', NULL, NULL, NULL, 180, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_72_s301.jpg', 180, '36.235.185.185', '2015-09-16 21:15:14', NULL),
(90, '1ff74351dfa26f9b0507c055fe16b0f6', NULL, 25, 1, '小罐子點心鋪【金薯C x 10入有禮子】中秋團在一起 ● 下單區', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_80_s301.jpg', 400, '36.235.188.182', '2015-09-16 21:22:57', NULL),
(91, 'cfd33ca14eb94f51dfee5dab22ccf37c', NULL, 25, 1, '小罐子點心鋪【金薯C x 10入有禮子】中秋團在一起 ● 下單區', '3', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_80_s301.jpg', 1200, '36.235.188.182', '2015-09-16 21:27:52', NULL),
(92, 'ff19f5b358477c85d255452065f73742', NULL, 25, 1, '小罐子點心鋪【金薯C x 10入有禮子】中秋團在一起 ● 下單區', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_80_s301.jpg', 400, '218.173.153.237', '2015-09-16 21:30:05', NULL),
(94, '89cc4eb72bf452ed9c671c8123795297', NULL, 25, 1, '小罐子點心鋪【金薯C x 10入有禮子】中秋團在一起 ● 下單區', '5', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_80_s301.jpg', 2000, '218.173.153.237', '2015-09-16 21:51:36', NULL),
(101, 'cafdab9746132c9416ecc93b62b1866c', NULL, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', '8', 20, '', NULL, NULL, NULL, 180, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_72_s301.jpg', 1440, '101.14.178.240', '2015-09-16 22:01:23', NULL),
(102, 'cafdab9746132c9416ecc93b62b1866c', NULL, 25, 1, '小罐子點心鋪【金薯C x 10入有禮子】中秋團在一起 ● 下單區', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_80_s301.jpg', 400, '101.14.178.240', '2015-09-16 22:05:08', NULL),
(104, '9f1d099d7a4d6b86d1a044779cdfce44', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】', '1', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 225, '101.14.178.240', '2015-09-16 22:20:10', NULL),
(105, '9f1d099d7a4d6b86d1a044779cdfce44', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', '4', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 1800, '101.14.178.240', '2015-09-16 22:29:56', NULL),
(107, 'cb104e199e036e0223d0f3686122c338', NULL, 28, 1, '小罐子點心鋪【這一蚵 x 6入好禮讚】中秋團團GO ★ 買十送一下單區', '12', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_92_s301.jpg', 5400, '114.26.239.188', '2015-09-17 00:49:45', NULL),
(116, 'b5352ff5b0a5d428f7f4e6352a83c60a', NULL, 27, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】中秋團團GO ★ 買十送一下單區', '1', 20, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_88_s301.jpg', 225, '111.82.105.230', '2015-09-17 14:39:38', NULL),
(117, 'dced8508de12ff2be1135fe6af3c2086', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', '1', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 450, '49.217.53.61', '2015-09-17 14:44:48', NULL),
(120, '980221cdaf0a21b7b66ed032d3c2bb39', NULL, 25, 1, '小罐子點心鋪【金薯C x 10入有禮子】中秋團在一起 ● 下單區', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_80_s301.jpg', 400, '61.230.107.32', '2015-09-17 16:42:18', NULL),
(124, '829cbcd72b1fa0aa926bcd580db7a4fe', NULL, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', '6', 20, '', NULL, NULL, NULL, 180, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_72_s301.jpg', 1080, '101.14.250.21', '2015-09-18 12:17:53', NULL),
(125, '2efcba25b5763874d12d44ead18db1b4', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '2', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 800, '1.171.46.157', '2015-09-18 12:21:10', NULL),
(126, '2efcba25b5763874d12d44ead18db1b4', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', '2', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 900, '1.171.46.157', '2015-09-18 12:21:10', NULL),
(127, '41107b8700ca7b1ac40ce846f9791a51', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '3', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 1200, '118.160.52.116', '2015-09-18 12:21:44', NULL),
(128, 'd06c1d7272eb6a172584286271466fe1', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '49.214.117.145', '2015-09-18 12:24:35', NULL),
(129, 'e05ae7d2fb65ff17cc3275c8b99b63e7', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '3', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 1200, '61.230.149.186', '2015-09-18 12:30:09', NULL),
(130, '0235a2c8ffecaa11294c4affe2f15b93', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】', '1', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 225, '101.15.32.140', '2015-09-18 12:27:48', NULL),
(131, 'e44a78106cf5228040b754502ab65803', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '61.230.78.102', '2015-09-18 12:32:37', NULL),
(132, '72649d9229aea931efb886939a4874aa', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】', '1', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 225, '110.30.64.208', '2015-09-18 12:32:55', NULL),
(133, '72649d9229aea931efb886939a4874aa', NULL, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', '1', 20, '', NULL, NULL, NULL, 180, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_72_s301.jpg', 180, '110.30.64.208', '2015-09-18 12:32:55', NULL),
(135, '692ffdefbeb20e7d6be19aba2c344748', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '10', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 4000, '111.253.241.16', '2015-09-18 12:36:41', NULL),
(136, 'b5f12398ee3d4965bee32a9a11a373bd', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】', '1', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 225, '101.15.113.36', '2015-09-18 12:40:18', NULL),
(137, 'b5f12398ee3d4965bee32a9a11a373bd', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '101.15.113.36', '2015-09-18 12:40:18', NULL),
(138, 'd144f3a401d2825d4c828287fbb3b04b', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '2', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 800, '101.15.115.121', '2015-09-18 12:39:56', NULL),
(140, 'b5f12398ee3d4965bee32a9a11a373bd', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', '2', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 900, '101.15.113.36', '2015-09-18 12:40:18', NULL),
(141, 'a9188bec83a782498eaa41d89976c956', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '101.14.232.208', '2015-09-18 12:44:05', NULL),
(142, '5b025469e43f1b0bfe91cf64eec9e91e', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '49.217.5.115', '2015-09-18 12:48:46', NULL),
(143, '5b025469e43f1b0bfe91cf64eec9e91e', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', '1', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 450, '49.217.5.115', '2015-09-18 12:48:46', NULL),
(145, 'b58f2fa7fdec5d337f4d77a74f162f0d', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '180.217.241.172', '2015-09-18 12:59:08', NULL),
(146, '66d4b100e2b83df7ada5818b826afbeb', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '101.139.189.181', '2015-09-18 12:54:31', NULL),
(147, 'b58f2fa7fdec5d337f4d77a74f162f0d', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', '1', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 450, '180.217.241.172', '2015-09-18 12:59:08', NULL),
(148, '66d4b100e2b83df7ada5818b826afbeb', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】', '1', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 225, '101.139.189.181', '2015-09-18 12:54:31', NULL),
(150, '9b0999a364363d7e675cc36396a8e28b', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '2', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 800, '117.19.177.53', '2015-09-18 12:56:19', NULL),
(151, '24c4eb430d0c5f21b7500db651df0f9e', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '3', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 1200, '110.28.77.64', '2015-09-18 12:57:14', NULL),
(152, 'b58f2fa7fdec5d337f4d77a74f162f0d', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】', '2', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 450, '180.217.241.172', '2015-09-18 12:59:08', NULL),
(153, '6cf4a2a95bee715d5b2f671fe67eae6f', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '4', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 1600, '117.19.177.53', '2015-09-18 12:58:27', NULL),
(155, 'f20ef93109b8f638caf0991322e4e2f5', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '118.232.216.236', '2015-09-18 13:12:22', NULL),
(156, 'f20ef93109b8f638caf0991322e4e2f5', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】', '1', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 225, '118.232.216.236', '2015-09-18 13:12:22', NULL),
(157, 'e5f59e0566a170b85c0f6c0de17a9fde', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '2', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 800, '223.138.118.185', '2015-09-18 13:13:41', NULL),
(158, 'e245828698a5a95014cc12b05708971d', NULL, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', '1', 20, '', NULL, NULL, NULL, 180, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_72_s301.jpg', 180, '110.26.159.48', '2015-09-18 13:21:40', NULL),
(159, 'df35fe07c51bed1f460950ed57b5124c', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '2', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 800, '101.15.228.169', '2015-09-18 13:23:26', NULL),
(160, '857199d052ed3ebbef88caf3e5c28c31', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '223.138.201.48', '2015-09-18 13:27:05', NULL),
(161, '857199d052ed3ebbef88caf3e5c28c31', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', '1', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 450, '223.138.201.48', '2015-09-18 13:27:05', NULL),
(162, '1fc1213ef3a016d928a83852ecd95ede', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '36.229.80.206', '2015-09-18 13:27:10', NULL),
(163, '49131f2ef51a686d6a0ace5ecbedca93', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '101.14.226.86', '2015-09-18 13:31:01', NULL),
(165, 'c4ad26b21e2ced2d1e55e75d6188acb3', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '49.214.34.42', '2015-09-18 13:39:53', NULL),
(166, 'a1012ce8463e1db68a3e8910bc4abb27', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '4', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 1600, '124.199.97.84', '2015-09-18 13:44:32', NULL),
(167, '7325fe5d9f8232eb56def00ada1d052e', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '59.126.2.123', '2015-09-18 13:44:15', NULL),
(168, 'a1012ce8463e1db68a3e8910bc4abb27', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】', '4', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 900, '124.199.97.84', '2015-09-18 13:44:32', NULL),
(169, 'a5643712caaab21b27ed47f6f5978ef0', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '220.132.77.142', '2015-09-18 13:44:33', NULL),
(173, 'f4edfc4675e034022948c0bab32e21ad', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '118.168.118.77', '2015-09-18 13:55:13', NULL),
(174, '0f323ed6156bfa885c492be92b0be821', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '111.82.7.223', '2015-09-18 13:56:01', NULL),
(176, 'f2651bde4efe4e1a5fc773b25664ffd6', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '223.138.163.185', '2015-09-18 13:59:24', NULL),
(177, 'cb6b5a082318dadf4039e6acad078e94', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '223.137.9.163', '2015-09-18 14:08:06', NULL),
(178, 'cb6b5a082318dadf4039e6acad078e94', NULL, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', '1', 20, '', NULL, NULL, NULL, 180, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_72_s301.jpg', 180, '223.137.9.163', '2015-09-18 14:08:06', NULL),
(179, 'a49f8468d91bb3136a1661ceca195f90', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '117.19.80.6', '2015-09-18 14:10:29', NULL),
(180, '7192b47587d1c1ca13ad537c0be8fe65', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '1.175.238.7', '2015-09-18 14:09:43', NULL),
(181, '93fc0a5e990334b0af73ee05fd0d43ad', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '36.231.153.246', '2015-09-18 14:10:05', NULL),
(182, 'a49f8468d91bb3136a1661ceca195f90', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', '1', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 450, '117.19.80.6', '2015-09-18 14:10:29', NULL),
(185, '6880bfb8a7e85480048c8b24c5eb87df', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '111.83.139.196', '2015-09-18 14:42:07', NULL),
(186, '1ed8a1468d19e9661d6d14d1207a85c7', NULL, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', '1', 20, '', NULL, NULL, NULL, 180, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_72_s301.jpg', 180, '119.77.178.21', '2015-09-18 14:42:37', NULL),
(187, '6880bfb8a7e85480048c8b24c5eb87df', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】', '1', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 225, '111.83.139.196', '2015-09-18 14:42:07', NULL),
(188, '1ed8a1468d19e9661d6d14d1207a85c7', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】', '1', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 225, '119.77.178.21', '2015-09-18 14:42:37', NULL),
(189, '849e5f58bb1762b984c326a39c16fa6d', NULL, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', '10', 20, '', NULL, NULL, NULL, 180, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_72_s301.jpg', 1800, '39.9.220.4', '2015-09-18 14:45:59', NULL),
(191, 'a2c8afee43d8935566a12f71713a95f3', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '39.8.2.98', '2015-09-18 15:10:37', NULL),
(192, '4d85b5e70e56c81d406c8ff2cafd39a3', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', '1', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 450, '111.82.33.32', '2015-09-18 15:10:57', NULL),
(193, 'd7c804dee08074c74b19e71d3d913af8', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', '2', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 900, '111.82.71.32', '2015-09-18 15:11:35', NULL),
(194, 'd7c804dee08074c74b19e71d3d913af8', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '111.82.71.32', '2015-09-18 15:11:35', NULL),
(195, '8611a2d311ddb505aca9ec6bdbb77a16', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', '1', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 450, '59.115.115.151', '2015-09-18 15:13:42', NULL),
(198, '03e10df8e4b7ba3e5f94243145ff9b88', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '117.19.2.204', '2015-09-18 15:21:45', NULL),
(204, '84707b05d88e8cf910c3ec7403ae28a2', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】', '1', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 225, '61.223.93.211', '2015-09-18 15:29:41', NULL),
(206, '1e36ec9b5a27c965ba8040dc50c5c0d0', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', '2', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 900, '59.115.115.151', '2015-09-18 15:39:41', NULL),
(207, 'b66683a61ac849aad57da1e610d5da69', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '5', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 2000, '60.250.98.46', '2015-09-18 15:40:48', NULL),
(208, 'c669769ff61d5b16d1da7bbc7d5fb0fd', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '101.8.124.216', '2015-09-18 15:41:12', NULL),
(209, 'c42ea637316d38a76fa6a5efa508ab9a', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '10', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 4000, '111.253.241.16', '2015-09-18 15:44:42', NULL),
(212, '6045921d4972605dcb341a7ef4387cd6', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】', '1', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 225, '39.9.99.102', '2015-09-18 16:00:07', NULL),
(215, '383bfcb75030ed04f37f27a26514e071', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '60.248.34.46', '2015-09-18 16:03:39', NULL),
(216, 'a4326bbe6b2f7ac7c1c3378c89f6f447', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '4', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 1600, '223.136.21.229', '2015-09-18 16:10:57', NULL),
(217, 'a4326bbe6b2f7ac7c1c3378c89f6f447', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', '3', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 1350, '223.136.21.229', '2015-09-18 16:10:57', NULL),
(218, '83b5157860877f1a6e10ba20b83b632e', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '2', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 800, '59.115.111.207', '2015-09-18 16:26:14', NULL),
(224, 'f3d1fc82358900541f9165d16b2fed74', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '49.214.103.13', '2015-09-18 16:37:39', NULL),
(227, '51986c9c62a83dfc43f161e6af4c53b4', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '4', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 1600, '223.136.21.229', '2015-09-18 16:50:52', NULL),
(229, '51986c9c62a83dfc43f161e6af4c53b4', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', '3', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 1350, '223.136.21.229', '2015-09-18 16:50:52', NULL),
(230, '4a1de7a8f9aa207df203440bed4198eb', NULL, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', '6', 20, '', NULL, NULL, NULL, 180, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_72_s301.jpg', 1080, '59.120.76.112', '2015-09-18 17:00:31', NULL),
(231, '74f68439f09e7dd96a127b759d6290a3', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', '9', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 4050, '218.173.153.237', '2015-09-18 17:02:42', NULL),
(237, '158ff3dfd2815c5f07a0783c501fc980', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '1.164.147.190', '2015-09-18 17:26:48', NULL),
(239, 'f000042b30fa76bd442e16c2877466b9', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '125.231.168.191', '2015-09-18 17:49:25', NULL),
(240, 'f000042b30fa76bd442e16c2877466b9', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】', '1', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 225, '125.231.168.191', '2015-09-18 17:49:25', NULL),
(241, '5b32a4348efd6cf3708de1b6af89540d', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '9', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 3600, '36.232.123.196', '2015-09-18 17:51:44', NULL),
(242, 'e56a8201bbb59c40516d45f620fa75cf', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '3', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 1200, '223.139.120.205', '2015-09-18 17:58:16', NULL),
(245, 'fbf8ec5dbb808a450087a9514d293438', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '27.246.157.114', '2015-09-18 18:07:11', NULL),
(246, 'fbf8ec5dbb808a450087a9514d293438', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', '1', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 450, '27.246.157.114', '2015-09-18 18:07:11', NULL),
(247, 'e2431adfbeba8963ebca48bc17f41b2c', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】', '1', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 225, '101.14.163.140', '2015-09-18 18:10:25', NULL),
(250, '8f0ede4be35f8cfc4bdb6cfa59aa6200', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '10', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 4000, '1.164.89.162', '2015-09-18 18:50:24', NULL),
(251, '8f0ede4be35f8cfc4bdb6cfa59aa6200', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', '1', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 450, '1.164.89.162', '2015-09-18 18:50:24', NULL),
(254, '4d8a3b54fd79387b5c8a1ff49e3af2a3', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '13', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 5200, '110.30.162.27', '2015-09-18 19:00:50', NULL),
(255, '984f459aa3e20da3244d23ed08d799a7', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', '10', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 4500, '36.235.147.211', '2015-09-18 19:03:00', NULL),
(257, '37d3903181095a0081843fca2e169b59', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '2', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 800, '218.166.133.39', '2015-09-18 19:53:48', NULL),
(258, 'b6027a996328fa2861ec761be69e5b8c', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '2', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 800, '36.234.43.5', '2015-09-18 20:01:06', NULL),
(259, '5f8e716562d72bf7e5693d3806760103', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '110.28.83.15', '2015-09-18 20:02:24', NULL),
(260, 'b477cfec5396607458852cfd05ec710b', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', '3', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 1350, '101.14.164.207', '2015-09-18 20:19:58', NULL),
(261, 'b477cfec5396607458852cfd05ec710b', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '2', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 800, '101.14.164.207', '2015-09-18 20:19:58', NULL),
(263, '7ff98f6b3c82212424e1f31fca71cf79', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', '1', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 450, '101.15.49.86', '2015-09-18 20:30:28', NULL),
(264, '7ff98f6b3c82212424e1f31fca71cf79', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '101.15.49.86', '2015-09-18 20:30:28', NULL),
(265, '961e5343b93ae93917a2123603c177eb', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', '1', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 450, '36.231.176.89', '2015-09-18 20:51:00', NULL),
(266, '961e5343b93ae93917a2123603c177eb', NULL, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', '1', 20, '', NULL, NULL, NULL, 180, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_72_s301.jpg', 180, '36.231.176.89', '2015-09-18 20:51:00', NULL),
(267, '89e89231ab11375bf2e1de64c9334c77', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', '1', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 450, '122.116.186.26', '2015-09-18 20:55:54', NULL),
(268, '89e89231ab11375bf2e1de64c9334c77', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '122.116.186.26', '2015-09-18 20:55:54', NULL),
(271, '4ac2737356b26dbb31bf17d358e5339a', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', '2', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 900, '1.165.83.128', '2015-09-18 21:12:24', NULL),
(272, '4ac2737356b26dbb31bf17d358e5339a', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '2', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 800, '1.165.83.128', '2015-09-18 21:12:24', NULL),
(273, '4ac2737356b26dbb31bf17d358e5339a', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】', '2', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 450, '1.165.83.128', '2015-09-18 21:12:24', NULL),
(275, 'd3dd01a73eccb63abcf2326eb388f5cb', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】', '1', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 225, '111.240.31.57', '2015-09-18 21:46:06', NULL),
(276, '7fcf1ccf1a58e0c5dc0aaee2e4637c75', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '3', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 1200, '114.46.209.20', '2015-09-18 22:16:50', NULL),
(277, '7fcf1ccf1a58e0c5dc0aaee2e4637c75', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】', '1', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 225, '114.46.209.20', '2015-09-18 22:16:50', NULL),
(278, '965907feaffa3b84cae6ef55f74cbba1', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '2', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 800, '175.180.121.61', '2015-09-18 22:32:43', NULL),
(280, '0eb14915aae71c0a26186b45614b9518', NULL, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', '7', 20, '', NULL, NULL, NULL, 180, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_72_s301.jpg', 1260, '175.180.121.61', '2015-09-18 22:34:12', NULL),
(281, '63ae47f548890c46cee7dd7380f59d61', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', '1', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 450, '101.15.160.94', '2015-09-18 22:55:45', NULL),
(282, '63ae47f548890c46cee7dd7380f59d61', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '101.15.160.94', '2015-09-18 22:55:45', NULL),
(283, '10bd34b569d4565e7e1a83975a685851', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', '1', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 450, '106.65.135.205', '2015-09-18 23:07:00', NULL),
(284, '0b46851d9db0be508c55483c77910745', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】', '1', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 225, '61.224.79.157', '2015-09-18 23:11:52', NULL),
(285, '1192848db229052d9f581847969968ad', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '39.8.2.98', '2015-09-18 23:12:30', NULL),
(286, '5b3bb71d701c12976b28f3bf17512b30', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】', '1', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 225, '101.15.176.187', '2015-09-18 23:24:11', NULL),
(287, '9841d54fbdaab1dc575287113a879494', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】', '1', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 225, '123.204.126.182', '2015-09-18 23:25:01', NULL),
(288, '4e108f1766731f05433a62f86948c004', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', '1', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 450, '223.136.33.112', '2015-09-18 23:28:17', NULL),
(291, '8e4a6bb6bdd8e6ba886cc93b41653bc2', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '1.164.106.146', '2015-09-19 00:02:01', NULL),
(292, '8e4a6bb6bdd8e6ba886cc93b41653bc2', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】', '1', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 225, '1.164.106.146', '2015-09-19 00:02:01', NULL),
(293, '86d6d8f489617686ff83af3f713795cc', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '223.137.205.137', '2015-09-19 00:06:04', NULL),
(294, 'd0f96516888638f10bcdf0173c2f1591', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '59.102.137.204', '2015-09-19 00:34:14', NULL),
(296, '14ca3438820f30db7e66b0a814180465', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '223.143.104.220', '2015-09-19 04:57:12', NULL),
(297, '4b2b45aee287aaf21ba92fa19e894b04', NULL, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', '1', 20, '', NULL, NULL, NULL, 180, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_72_s301.jpg', 180, '49.218.53.182', '2015-09-19 06:43:52', NULL),
(302, 'd443ca148188df6122a99be8d8058fcf', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '114.38.79.189', '2015-09-19 10:32:11', NULL),
(303, 'd443ca148188df6122a99be8d8058fcf', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', '1', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 450, '114.38.79.189', '2015-09-19 10:32:11', NULL),
(305, '34c2d644409efd6f866c5d719a3a6fe8', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '4', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 1600, '110.30.212.39', '2015-09-19 13:23:15', NULL),
(306, '458d15afd5681e27eeaab9b8c91ea649', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】', '1', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 225, '114.46.163.124', '2015-09-19 13:48:18', NULL),
(307, '458d15afd5681e27eeaab9b8c91ea649', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '114.46.163.124', '2015-09-19 13:48:18', NULL),
(309, '468c6a61a418f9740847f413f87b2fbd', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', '1', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 450, '223.136.18.46', '2015-09-19 15:27:57', NULL),
(310, '468c6a61a418f9740847f413f87b2fbd', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】', '1', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 225, '223.136.18.46', '2015-09-19 15:27:57', NULL),
(314, '5e7df8edb1eb8e9e95980994798421d5', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '4', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 1600, '220.129.96.53', '2015-09-19 16:06:32', NULL),
(315, 'e5877de650197c34f21121f5d14a1174', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '39.9.204.200', '2015-09-19 16:10:27', NULL),
(317, 'b37ddcdee1adc096c81bcfba062951cf', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '2', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 800, '140.129.121.77', '2015-09-19 18:20:23', NULL),
(318, '95add1c38b2eb79545f8af058d48650e', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '180.217.188.16', '2015-09-19 20:33:28', NULL),
(323, 'a2f6297d0c297322892a89dba97d92d5', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】搶先預購10/9出貨', '1', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 450, '101.13.227.159', '2015-09-19 23:49:33', NULL),
(324, '62bfda0ee33a1f14ce4aa01660af20b0', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '27.246.43.243', '2015-09-19 23:54:10', NULL),
(325, '03cf4f7d7a9eb750efde77be0e2d644c', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】搶先預購10/9出貨', '1', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 225, '122.116.50.93', '2015-09-20 17:29:11', NULL),
(329, 'f6177c75e44e1028a7c1b4ac4d6a9809', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '36.232.125.97', '2015-09-21 16:48:14', NULL),
(330, 'f6177c75e44e1028a7c1b4ac4d6a9809', NULL, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', '1', 20, '', NULL, NULL, NULL, 180, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_72_s301.jpg', 180, '36.232.125.97', '2015-09-21 16:48:14', NULL),
(331, '920a4f0f700cdde3890ff8a1f16881ff', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】搶先預購10/9出貨', '10', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 4500, '36.232.125.97', '2015-09-21 16:55:09', NULL),
(333, 'f2715786614e1f816a1a7929e96545f3', NULL, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', '1', 20, '', NULL, NULL, NULL, 180, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_72_s301.jpg', 180, '118.167.20.25', '2015-09-22 00:19:39', NULL),
(334, '353cb5bc247a200bc4359e7887fbac7e', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】搶先預購10/9出貨', '1', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 225, '39.13.72.244', '2015-09-22 00:20:07', NULL),
(335, '353cb5bc247a200bc4359e7887fbac7e', NULL, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', '1', 20, '', NULL, NULL, NULL, 180, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_72_s301.jpg', 180, '39.13.72.244', '2015-09-22 00:20:07', NULL),
(338, 'eb8398071963d18935db6bd24f62e76b', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】搶先預購10/9出貨', '1', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 450, '112.105.124.4', '2015-09-22 16:50:12', NULL),
(339, 'eb8398071963d18935db6bd24f62e76b', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '112.105.124.4', '2015-09-22 16:50:12', NULL),
(340, '8ae8b6adabc5d768531321316429e5d6', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '2', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 800, '223.137.148.127', '2015-09-22 20:03:24', NULL),
(343, '71c4f46b0855732df97fd0004b756455', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】搶先預購10/9出貨', '1', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 225, '112.105.20.18', '2015-09-23 13:23:33', NULL),
(344, '71c4f46b0855732df97fd0004b756455', NULL, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', '1', 20, '', NULL, NULL, NULL, 180, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_72_s301.jpg', 180, '112.105.20.18', '2015-09-23 13:23:33', NULL),
(347, '078384786a9c1b42f06bd79e3ff27b6e', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '2', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 800, '118.232.89.71', '2015-09-23 17:54:24', NULL),
(348, '864b1d4f759f110c77feff79d0c5b288', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '223.138.194.156', '2015-09-23 23:18:46', NULL),
(349, 'f444f5ca0694c1c52b36c30010912920', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】搶先預購10/9出貨', '1', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 450, '111.82.146.112', '2015-09-24 07:13:03', NULL),
(357, 'cd96b9b9075350c4cde2e539ea046ff5', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '49.218.35.47', '2015-09-25 01:34:10', NULL),
(358, 'cd96b9b9075350c4cde2e539ea046ff5', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】搶先預購10/9出貨', '1', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 450, '49.218.35.47', '2015-09-25 01:34:10', NULL),
(362, '7c908a8a54e539a533585a65ea1fec6e', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '180.218.18.237', '2015-09-25 14:49:45', NULL),
(364, 'fb411a90d445e20f6cdfc8a9641cad8c', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】搶先預購10/9出貨', '1', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 450, '36.231.19.184', '2015-09-28 00:50:03', NULL),
(365, 'fb411a90d445e20f6cdfc8a9641cad8c', NULL, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', '1', 20, '', NULL, NULL, NULL, 180, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_72_s301.jpg', 180, '36.231.19.184', '2015-09-28 00:50:03', NULL),
(366, '6c108a2bc467039bcb5467de4fe97202', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '20', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 8000, '223.139.174.212', '2015-09-28 16:13:32', NULL),
(367, '53efffd0304ec885af50be625b30ac6a', NULL, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', '1', 20, '', NULL, NULL, NULL, 180, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_72_s301.jpg', 180, '111.255.138.84', '2015-09-28 23:27:11', NULL),
(371, 'a6bbaa05cc60cc19db202dd45ffdff57', NULL, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', '2', 20, '', NULL, NULL, NULL, 180, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_72_s301.jpg', 360, '122.117.212.207', '2015-10-01 17:00:44', NULL),
(372, 'a6bbaa05cc60cc19db202dd45ffdff57', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】搶先預購10/9出貨', '1', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 225, '122.117.212.207', '2015-10-01 17:00:44', NULL),
(375, 'a2497bdbf58cc2b5ce5a0a55c5cc80df', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '117.19.101.60', '2015-10-02 23:02:37', NULL);
INSERT INTO `m_baskets` (`basketID`, `basketSession`, `itemID`, `productID`, `class`, `productName`, `qty`, `qtyLimit`, `serial_num`, `d_inventory`, `d_size1`, `d_size2`, `d_price1`, `d_price2`, `d_price3`, `d_sale`, `d_price4`, `unit`, `perUnit`, `d_new_product`, `file_link2`, `subtotal`, `mb_ip`, `mb_time`, `m_id`) VALUES
(376, 'a2497bdbf58cc2b5ce5a0a55c5cc80df', NULL, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', '10', 20, '', NULL, NULL, NULL, 180, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_72_s301.jpg', 1800, '117.19.101.60', '2015-10-02 23:02:37', NULL),
(377, '5b48f88d4e5de7a393f286a79be13f74', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】搶先預購10/9出貨', '5', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 1125, '115.83.23.33', '2015-10-03 17:38:30', NULL),
(378, '4bd8cd4f38978ea1853b5459857bf358', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '4', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 1600, '223.137.52.211', '2015-10-04 03:35:50', NULL),
(379, '00cbd07abccaf4aae0c8dbc9af3b0bc9', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】搶先預購10/9出貨', '1', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 450, '36.228.250.6', '2015-10-04 20:55:44', NULL),
(380, '00cbd07abccaf4aae0c8dbc9af3b0bc9', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '36.228.250.6', '2015-10-04 20:55:44', NULL),
(381, 'c183505a43dd05b4b0bac1f1f226f05d', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】搶先預購10/9出貨', '2', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 450, '61.231.204.241', '2015-10-05 22:39:27', NULL),
(383, '85ed644b798ef2494712e19b2c3852c6', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】搶先預購10/9出貨', '1', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 450, '1.175.149.249', '2015-10-05 22:55:16', NULL),
(384, 'a6f625b5dfad7a26af247e9c13842b30', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】搶先預購10/9出貨', '1', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 450, '36.234.35.208', '2015-10-06 22:06:43', NULL),
(386, '28ef020f5f055147b99ad609cdde325f', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】搶先預購10/9出貨', '1', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 450, '111.249.237.65', '2015-10-06 23:27:59', NULL),
(389, '06f59b72e1d2fc17cbbf9f675dc33e7f', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】搶先預購10/9出貨', '1', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 225, '118.160.87.196', '2015-10-07 18:12:20', NULL),
(391, 'd2d65afa4cbbe03a9407ec2e8c78d86d', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】搶先預購10/9出貨', '1', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 450, '1.175.152.68', '2015-10-07 21:45:40', NULL),
(394, '72a19a2319b300b1df58bcab06e52aae', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】上市優惠中', '1', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 225, '220.136.192.62', '2015-10-10 14:28:07', NULL),
(396, 'f875247dae5c5e7559eaddde950fdd07', NULL, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】上市優惠中', '1', 100, '', NULL, NULL, NULL, 225, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_50_s301.jpg', 225, '101.139.165.28', '2015-10-12 19:35:19', NULL),
(397, 'a6f625b5dfad7a26af247e9c13842b30', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '114.41.137.70', '2015-10-12 21:38:04', NULL),
(399, '6fad8c7e9bea4b9699b810201bfb10b3', NULL, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', '9', 20, '', NULL, NULL, NULL, 180, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_72_s301.jpg', 1620, '114.41.137.70', '2015-10-13 13:35:22', NULL),
(400, '240ab4062e414dbaa1bc748d41e401e4', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】上市優惠中', '1', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 450, '223.137.40.247', '2015-10-13 17:36:52', NULL),
(401, 'a0273cb7f6db4e1b41e501cbe8c44421', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】上市優惠中', '1', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 450, '175.98.128.162', '2015-10-13 17:41:09', NULL),
(402, 'a0273cb7f6db4e1b41e501cbe8c44421', NULL, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', '1', 20, '', NULL, NULL, NULL, 400, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_54_s301.jpg', 400, '175.98.128.162', '2015-10-13 17:41:09', NULL),
(404, '03717f2c008f84715dfa20f9379bab84', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】上市優惠中', '1', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 450, '1.175.28.129', '2015-10-13 23:52:35', NULL),
(405, '00ff8f8a50a383163db7f28ef1903334', NULL, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】上市優惠中', '1', 20, '', NULL, NULL, NULL, 450, 0, 0, 0, 0, NULL, NULL, 0, 'upload_image/products/products_84_s301.jpg', 450, '220.132.214.190', '2015-10-13 23:56:22', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=117 ;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`oi_id`, `o_id`, `d_id`, `d_class`, `d_name`, `price_status`, `serial_num`, `qty`, `d_price1`, `d_price2`, `d_price3`, `d_sale`, `d_price4`, `unit`, `perUnit`, `pic`, `d_new_p`, `subtotal`) VALUES
(34, 29, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', NULL, NULL, 4, 400, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_54_s301.jpg', NULL, 1600),
(35, 30, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', NULL, NULL, 1, 400, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_54_s301.jpg', NULL, 400),
(36, 30, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', NULL, NULL, 1, 180, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_72_s301.jpg', NULL, 180),
(37, 31, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', NULL, NULL, 5, 180, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_72_s301.jpg', NULL, 900),
(38, 32, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', NULL, NULL, 3, 400, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_54_s301.jpg', NULL, 1200),
(39, 33, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', NULL, NULL, 1, 400, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_54_s301.jpg', NULL, 400),
(40, 34, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', NULL, NULL, 8, 400, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_54_s301.jpg', NULL, 3200),
(43, 37, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', NULL, NULL, 1, 450, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_84_s301.jpg', NULL, 450),
(44, 37, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', NULL, NULL, 1, 400, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_54_s301.jpg', NULL, 400),
(49, 42, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', NULL, NULL, 1, 400, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_54_s301.jpg', NULL, 400),
(50, 42, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】', NULL, NULL, 1, 225, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_50_s301.jpg', NULL, 225),
(52, 45, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', NULL, NULL, 1, 180, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_72_s301.jpg', NULL, 180),
(54, 47, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】', NULL, NULL, 1, 225, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_50_s301.jpg', NULL, 225),
(55, 47, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', NULL, NULL, 1, 180, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_72_s301.jpg', NULL, 180),
(56, 48, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', NULL, NULL, 2, 400, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_54_s301.jpg', NULL, 800),
(57, 49, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', NULL, NULL, 2, 400, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_54_s301.jpg', NULL, 800),
(58, 49, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', NULL, NULL, 2, 450, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_84_s301.jpg', NULL, 900),
(59, 50, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', NULL, NULL, 1, 400, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_54_s301.jpg', NULL, 400),
(60, 51, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', NULL, NULL, 1, 400, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_54_s301.jpg', NULL, 400),
(64, 54, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', NULL, NULL, 1, 450, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_84_s301.jpg', NULL, 450),
(65, 54, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', NULL, NULL, 1, 400, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_54_s301.jpg', NULL, 400),
(66, 55, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', NULL, NULL, 10, 400, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_54_s301.jpg', NULL, 4000),
(67, 56, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', NULL, NULL, 4, 400, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_54_s301.jpg', NULL, 1600),
(68, 57, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', NULL, NULL, 1, 400, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_54_s301.jpg', NULL, 400),
(69, 57, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', NULL, NULL, 2, 450, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_84_s301.jpg', NULL, 900),
(71, 59, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】', NULL, NULL, 1, 225, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_50_s301.jpg', NULL, 225),
(72, 59, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', NULL, NULL, 1, 180, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_72_s301.jpg', NULL, 180),
(73, 60, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', NULL, NULL, 1, 400, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_54_s301.jpg', NULL, 400),
(74, 61, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', NULL, NULL, 1, 180, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_72_s301.jpg', NULL, 180),
(77, 63, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', NULL, NULL, 1, 400, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_54_s301.jpg', NULL, 400),
(78, 63, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', NULL, NULL, 1, 450, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_84_s301.jpg', NULL, 450),
(79, 64, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】', NULL, NULL, 2, 225, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_50_s301.jpg', NULL, 450),
(80, 65, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】', NULL, NULL, 2, 450, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_84_s301.jpg', NULL, 900),
(81, 66, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', NULL, NULL, 2, 400, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_54_s301.jpg', NULL, 800),
(82, 67, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】搶先預購10/9出貨', NULL, NULL, 2, 450, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_84_s301.jpg', NULL, 900),
(83, 67, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', NULL, NULL, 1, 400, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_54_s301.jpg', NULL, 400),
(84, 67, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】搶先預購10/9出貨', NULL, NULL, 3, 225, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_50_s301.jpg', NULL, 675),
(85, 67, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', NULL, NULL, 4, 180, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_72_s301.jpg', NULL, 720),
(86, 68, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', NULL, NULL, 2, 400, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_54_s301.jpg', NULL, 800),
(87, 68, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', NULL, NULL, 1, 180, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_72_s301.jpg', NULL, 180),
(88, 69, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', NULL, NULL, 4, 400, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_54_s301.jpg', NULL, 1600),
(89, 70, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】搶先預購10/9出貨', NULL, NULL, 2, 450, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_84_s301.jpg', NULL, 900),
(90, 71, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】搶先預購10/9出貨', NULL, NULL, 2, 450, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_84_s301.jpg', NULL, 900),
(91, 72, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】搶先預購10/9出貨', NULL, NULL, 1, 450, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_84_s301.jpg', NULL, 450),
(92, 72, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', NULL, NULL, 1, 400, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_54_s301.jpg', NULL, 400),
(94, 74, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', NULL, NULL, 5, 180, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_72_s301.jpg', NULL, 900),
(95, 75, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', NULL, NULL, 1, 400, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_54_s301.jpg', NULL, 400),
(96, 75, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】搶先預購10/9出貨', NULL, NULL, 1, 450, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_84_s301.jpg', NULL, 450),
(97, 76, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', NULL, NULL, 2, 180, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_72_s301.jpg', NULL, 360),
(98, 76, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', NULL, NULL, 7, 400, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_54_s301.jpg', NULL, 2800),
(99, 76, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】搶先預購10/9出貨', NULL, NULL, 2, 225, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_50_s301.jpg', NULL, 450),
(100, 76, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】搶先預購10/9出貨', NULL, NULL, 5, 450, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_84_s301.jpg', NULL, 2250),
(101, 77, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', NULL, NULL, 1, 400, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_54_s301.jpg', NULL, 400),
(102, 77, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】搶先預購10/9出貨', NULL, NULL, 1, 450, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_84_s301.jpg', NULL, 450),
(103, 78, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】搶先預購10/9出貨', NULL, NULL, 1, 450, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_84_s301.jpg', NULL, 450),
(104, 78, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', NULL, NULL, 2, 400, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_54_s301.jpg', NULL, 800),
(105, 78, 20, 1, '小罐子點心鋪【金薯C x 4入輕巧盒】', NULL, NULL, 1, 180, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_72_s301.jpg', NULL, 180),
(106, 79, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', NULL, NULL, 3, 400, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_54_s301.jpg', NULL, 1200),
(107, 80, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', NULL, NULL, 1, 400, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_54_s301.jpg', NULL, 400),
(108, 80, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】搶先預購10/9出貨', NULL, NULL, 1, 450, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_84_s301.jpg', NULL, 450),
(109, 81, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】搶先預購10/9出貨', NULL, NULL, 1, 450, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_84_s301.jpg', NULL, 450),
(110, 82, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】搶先預購10/9出貨', NULL, NULL, 2, 450, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_84_s301.jpg', NULL, 900),
(111, 83, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', NULL, NULL, 4, 400, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_54_s301.jpg', NULL, 1600),
(112, 84, 19, 1, '小罐子點心鋪【金薯C x 10入禮盒】', NULL, NULL, 1, 400, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_54_s301.jpg', NULL, 400),
(113, 85, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】搶先預購10/9出貨', NULL, NULL, 1, 450, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_84_s301.jpg', NULL, 450),
(114, 86, 18, 1, '小罐子點心鋪【這一蚵 x 3入輕巧盒】搶先預購10/9出貨', NULL, NULL, 1, 225, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_50_s301.jpg', NULL, 225),
(115, 87, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】上市優惠中', NULL, NULL, 1, 450, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_84_s301.jpg', NULL, 450),
(116, 88, 26, 1, '小罐子點心鋪【這一蚵 x 6入好禮時尚盒】上市優惠中', NULL, NULL, 3, 450, NULL, NULL, NULL, 0, NULL, NULL, 'upload_image/products/products_84_s301.jpg', NULL, 1350);

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
  `zipcode` int(11) DEFAULT NULL,
  `r_client` tinytext COLLATE utf8_unicode_ci,
  `r_gender` tinyint(2) DEFAULT NULL,
  `r_phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `r_cellphone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `r_email` tinytext COLLATE utf8_unicode_ci,
  `r_address` tinytext COLLATE utf8_unicode_ci,
  `r_zipcode` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=89 ;

--
-- Dumping data for table `order_set`
--

INSERT INTO `order_set` (`o_id`, `o_number`, `client`, `c_gender`, `phone`, `cellphone`, `email`, `address`, `zipcode`, `r_client`, `r_gender`, `r_phone`, `r_cellphone`, `r_email`, `r_address`, `r_zipcode`, `invoice`, `insn`, `inname`, `in_zipcode`, `inadd`, `in_phone`, `payment`, `card_status`, `cash_status`, `bank_status`, `transport_status`, `m_id`, `tfee`, `SubTotalAll`, `GrandTotal`, `transport`, `delivery`, `TrackingNum`, `remitter`, `remitter_AC`, `remitter_money`, `remitter_time`, `remitter_active`, `datetime`, `notation`, `m_account`, `RID`) VALUES
(29, 'TD15091800001', '張瓊敏', 0, NULL, '0952032725', 'mabel690227@hotmail.com', '台北市中山區新生北路2段28巷1號8樓之3', 104, '張瓊敏', 0, NULL, '0952032725', 'mabel690227@hotmail.com', '台北市中山區新生北路2段28巷1號8樓之3', 104, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 2, 1, 190, 100, 1600, 1700, NULL, NULL, NULL, '張瓊敏', '86428', '1700', '2015-10-08 12:21', 1, '2015-09-18 12:40:03', NULL, 'mabel690227@hotmail.com', NULL),
(30, 'TD15091800002', '張育慈', 0, NULL, '0975609530', 'a1993823@yahoo.com.tw', '桃園市八德區介壽路一段202號2樓', 334, '張育慈', 0, NULL, '0975609530', 'a1993823@yahoo.com.tw', '桃園市八德區介壽路一段202號2樓', 334, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 0, NULL, 1, NULL, 100, 580, 680, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-18 12:56:02', NULL, NULL, NULL),
(31, 'TD15091800003', '張嘉芳', 0, NULL, '0919976392', 'changesu0319@hotmail.com', '桃園市中壢區大圳路一段1170號', 320, '張嘉芳', 0, NULL, '0919976392', 'changesu0319@hotmail.com', '桃園市中壢區大圳路一段1170號', 320, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 0, NULL, 1, NULL, 100, 900, 1000, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-18 13:05:57', NULL, NULL, NULL),
(32, 'TD15091800004', '王怡婷', 0, NULL, '0913123115', 'a325919@yahoo.com.tw', '新北市汐止區福德二路215號4樓之一', 221, '王怡婷', 0, NULL, '0913123115', 'a325919@yahoo.com.tw', '新北市汐止區福德二路215號4樓之一', 221, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 0, NULL, 1, NULL, 100, 1200, 1300, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-18 13:34:03', NULL, NULL, NULL),
(33, 'TD15091800005', '徐湘硯', 0, NULL, '0920765565', 'seya2049@gmail.com', '台北市南港區東明街53號6樓', 115, '徐湘硯', 0, NULL, '0920765565', 'seya2049@gmail.com', '台北市南港區東明街53號6樓', 115, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 0, NULL, 1, NULL, 100, 400, 500, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-18 13:56:37', NULL, NULL, NULL),
(34, 'TD15091800006', '何宜儒', 0, NULL, '0912201527', 'shelly830kimo@yahoo.com.tw', '台中市太平區中興路47號', 411, '何宜儒', 0, NULL, '0912201527', 'shelly830kimo@yahoo.com.tw', '台中市太平區中興路47號', 411, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 0, NULL, 1, NULL, 100, 3200, 3300, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-18 15:08:13', NULL, NULL, NULL),
(37, 'TD15091800007', '張媛臻', 0, NULL, '0972073852', 'Myjill0105@gmail.com', '台中市西屯區大鵬路37號3樓', 407, '洪明鴻', 1, NULL, '0938612255', 'Myjill0105@gmail.com', '台中市西屯區工業十二路6號', 407, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, NULL, 100, 850, 950, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-18 15:22:42', NULL, NULL, NULL),
(42, 'TD15091800008', '張語玲', 0, NULL, '0931850938', 'nico3539@yahoo.com.tw', '高雄市鳳山區高雄市鳳山區', 830, '張語玲', 0, NULL, '0931850938', 'nico3539@yahoo.com.tw', '高雄市鳳山區高雄市鳳山區', 830, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, NULL, 100, 625, 725, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-18 15:29:42', '五甲二路218號1樓', NULL, NULL),
(45, 'TD15091800009', '林妤貞', 0, NULL, '0988491279', 'hihi0409@gmail.com', '台北市萬華區水源路205號3樓', 108, '林妤貞', 0, NULL, '0988491279', 'hihi0409@gmail.com', '台北市萬華區水源路205號3樓', 108, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 0, NULL, 1, NULL, 100, 180, 280, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-18 16:01:38', NULL, NULL, NULL),
(47, 'TD15091800010', '徐雪容', 0, NULL, '0958966739', 'angelwing966@yahoo.com.tw', '台北市中正區汀州路1段172號', 100, '徐雪容', 0, NULL, '0958966739', 'angelwing966@yahoo.com.tw', '台北市中正區汀州路1段172號', 100, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, 200, 100, 405, 505, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-18 16:29:02', '請星期日不要送貨---謝謝', 'angelwing966@yahoo.com.tw', NULL),
(48, 'TD15091800011', '陳姿婷', 0, NULL, '0939606649', 'ctt740730@gmail.com', '彰化縣員林市育英路96之4號', 510, '陳姿婷', 0, NULL, '0939606649', 'ctt740730@gmail.com', '彰化縣員林市育英路96之4號', 510, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 0, NULL, 1, NULL, 100, 800, 900, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-18 16:35:02', NULL, NULL, NULL),
(49, 'TD15091800012', '陸秀蓉', 0, NULL, '0975053618', 'a0975053618@gmail.com', '台中市太平區大仁街26巷1號6樓之二', 411, '陸秀蓉', 0, NULL, '0975053618', 'a0975053618@gmail.com', '台中市太平區大仁街26巷1號6樓之二', 411, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, NULL, 100, 1700, 1800, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-18 16:51:44', NULL, NULL, NULL),
(50, 'TD15091800013', '薛靜倫', 0, NULL, '0920671205', 'apple0612@hotmai.Com.tw', '高雄市苓雅區苓雅二路203号3樓', 802, '薛靜倫', 0, NULL, '0920671205', 'apple0612@hotmai.Com.tw', '高雄市苓雅區苓雅二路203号3樓', 802, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 0, NULL, 1, NULL, 100, 400, 500, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-18 17:05:00', NULL, NULL, NULL),
(51, 'TD15091800014', '鍾佩庭', 0, NULL, '0985220154', 'peiting7722@gmail.com', '台北市士林區基河路128號B1(台北青少年)', 111, '鍾佩庭', 0, NULL, '0985220154', 'peiting7722@gmail.com', '台北市士林區基河路128號B1(台北青少年)', 111, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 2, 1, 201, 100, 400, 500, NULL, NULL, NULL, '鍾佩庭', '91913', '500', '2015-09-19 10:28', 1, '2015-09-18 17:47:42', NULL, 'peiting7722@gmail.com', NULL),
(54, 'TD15091800015', '張夏萍', 0, NULL, '0910093063', 'sherry01092002@yahoo.com.tw', '新北市三芝區長勤街26號', 252, '張夏萍', 0, NULL, '0910093063', 'sherry01092002@yahoo.com.tw', '新北市三芝區長勤街26號', 252, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, 202, 100, 850, 950, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-18 19:00:05', NULL, 'sherry01092002@yahoo.com.tw', NULL),
(55, 'TD15091800016', '林靚盈', 0, NULL, '0917087319', 'a0917087319@gmail.com', '高雄市大社區三民路62巷138號', 815, '林靚盈', 0, NULL, '0917087319', 'a0917087319@gmail.com', '高雄市大社區三民路62巷138號', 815, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 0, NULL, 1, NULL, 0, 4000, 4000, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-18 19:23:32', NULL, NULL, NULL),
(56, 'TD15091800017', '郭怡萍', 0, NULL, '0961296147', 'b239733@yahoo.com.tw', '台南市歸仁區民族北街17巷2號十樓之三', 711, '郭怡萍', 0, NULL, '0961296147', 'b239733@yahoo.com.tw', '台南市歸仁區民族北街17巷2號十樓之三', 711, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 0, NULL, 1, NULL, 100, 1600, 1700, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-18 20:26:25', NULL, NULL, NULL),
(57, 'TD15091800018', 'teresa', 0, NULL, '0925570267', 'teresa_ho0932@yahoo.com.tw', '桃園市桃園區中山東路32-25 號', 330, 'teresa', 0, NULL, '0925570267', 'teresa_ho0932@yahoo.com.tw', '桃園市桃園區中山東路32-25 號', 330, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, NULL, 100, 1300, 1400, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-18 21:11:08', NULL, NULL, NULL),
(59, 'TD15091800019', '林柏廷', 1, NULL, '0921951319', 'h730606@gmail.com', '新北市板橋區三民路2段123巷26之2號3F', 220, '林柏廷', 1, NULL, '0921951319', 'h730606@gmail.com', '新北市板橋區三民路2段123巷26之2號3f', 220, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, 210, 100, 405, 505, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-18 23:47:26', '請打市內電話:0229576835', 'h730606@gmail.com', NULL),
(60, 'TD15091900001', '曾婉倩', 0, NULL, '0963035488', 'kinki812301@yahoo.com.tw', '新北市新莊區中興街6之4號4樓', 242, '曾婉倩', 0, NULL, '0963035488', 'kinki812301@yahoo.com.tw', '新北市新莊區中興街6之4號4樓', 242, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 2, 1, 211, 100, 400, 500, NULL, NULL, NULL, '曾婉倩', '39160', '500', '2015-09-19 23:13', 1, '2015-09-19 00:13:01', NULL, 'kinki812301@yahoo.com.tw', NULL),
(61, 'TD15091900002', '詹筱婷', 0, NULL, '0961285685', 'sisicoffee@yahoo.com.tw', '宜蘭縣礁溪鄉龍潭村龍泉路148巷44號', 262, '詹筱婷', 0, NULL, '0961285685', 'sisicoffee@yahoo.com.tw', '宜蘭縣礁溪鄉龍潭村龍泉路148巷44號', 262, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 0, NULL, 1, NULL, 100, 180, 280, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-19 03:57:50', NULL, NULL, NULL),
(63, 'TD15091900004', '曾培綸', 0, NULL, '0910561548', 'rita7388@msn.com', '台中市北屯區太和一街41號', 406, '曾培綸', 0, NULL, '0910561548', 'rita7388@msn.com', '台中市北屯區太和一街41號', 406, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, 212, 100, 850, 950, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-19 10:40:42', NULL, 'rita7388@msn.com', NULL),
(64, 'TD15091900005', '陳蓓萱', 0, NULL, '0937880883', 'yeinnight@gmail.com', '新北市新店區永安街56巷6-2號3樓', 231, '陳蓓萱', 0, NULL, '02-29440481', 'yeinnight@gmail.com', '新北市新店區永安街56巷6-2號3樓', 231, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, NULL, 100, 450, 550, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-19 15:27:13', NULL, NULL, NULL),
(65, 'TD15091900006', '邱怡紋', 0, NULL, '0928039382', 'katie20012001@msn.com', '台北市中山區龍江路137巷11號4樓', 104, '邱怡紋', 0, NULL, '0928039382', 'katie20012001@msn.com', '台北市中山區龍江路137巷11號4樓', 104, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 2, 0, 208, 100, 900, 1000, NULL, NULL, NULL, '邱怡紋', '41680', '1000', '2015-09-21', 1, '2015-09-19 15:55:47', NULL, 'katie20012001@msn.com', NULL),
(66, 'TD15091900007', '侯詠婕', 0, NULL, '0975879518', 'yjhou@fitipower.com', '新竹縣竹北市嘉興一街6號6樓', 302, '侯詠婕', 0, NULL, '0975879518', 'yjhou@fitipower.com', '新竹縣竹北市嘉興一街6號6樓', 302, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 0, NULL, 1, NULL, 100, 800, 900, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-19 16:34:12', NULL, NULL, NULL),
(67, 'TD15091900008', '賴玉芳', 0, NULL, '0988783922', 'A0988783922@gmail.com.tw', '桃園市桃園區龍鳳三街65巷40號2樓', 330, '賴玉芳', 0, NULL, '0988783922', 'A0988783922@gmail.com.tw', '桃園市桃園區龍鳳三街65巷40號2樓', 330, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, NULL, 0, 2695, 2695, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-19 21:42:40', NULL, NULL, NULL),
(68, 'TD15092100001', '陳奕岑', 0, NULL, '0911858831', 'ivychen03@yahoo.com.tw', '台中市南屯區文心路一段186號14樓之8', 408, '陳奕岑', 0, NULL, '0911858831', 'ivychen03@yahoo.com.tw', '台中市南屯區文心路一段186號14樓之8', 408, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 2, 1, 215, 100, 980, 1080, NULL, NULL, NULL, '陳奕岑', '43588', '1080', '2015/09/21', 1, '2015-09-21 09:31:08', NULL, 'ivychen03@yahoo.com.tw', NULL),
(69, 'TD15092100002', '蕭雪霞', 0, NULL, '0926265593', 'michelle_77.tw@yahoo.com.tw', '宜蘭縣五結鄉利工二路100號', 268, '蕭雪霞', 0, NULL, '0926265593', 'michelle_77.tw@yahoo.com.tw', '宜蘭縣五結鄉利工二路100號', 268, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 2, 1, 216, 100, 1600, 1700, NULL, NULL, NULL, '蕭雪霞', '76774', '1700', '2015-09-21 15:15', 1, '2015-09-21 15:12:23', NULL, 'michelle_77.tw@yahoo.com.tw', NULL),
(70, 'TD15092200001', '陳盛文', 1, NULL, '0921369016', '1020401@joysong.com.tw', '台中市北屯區大連西路56巷26號', 406, '陳盛文', 1, NULL, '0921369016', '1020401@joysong.com.tw', '台中市北屯區大連西路56巷26號', 406, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, NULL, 100, 900, 1000, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-22 13:14:39', NULL, NULL, NULL),
(71, 'TD15092200002', '許博揚', 1, NULL, '0919942625', 'zinix55@gmail.com', '新北市土城區立德路29巷6號4樓', 236, '許博揚', 1, NULL, '0919942625', 'zinix55@gmail.com', '新北市土城區立德路29巷6號4樓', 236, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, 218, 100, 900, 1000, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-22 14:16:35', NULL, 'zinix55@gmail.com', NULL),
(72, 'TD15092300001', '劉素嬌', 0, NULL, '0910944058', 'may16693@yahoo.com', '新竹縣竹北市新生街22巷2號', 302, '劉素嬌', 0, NULL, '0910944058', 'may16693@yahoo.com', '新竹縣竹北市新生街22巷2號', 302, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, NULL, 100, 850, 950, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-23 06:08:09', NULL, NULL, NULL),
(74, 'TD15092400001', '陳姿婷', 0, NULL, '0939606649', 'ctt740730@gmail.com', '彰化縣員林市彰化縣員林鎮育英路96之4號', 510, '陳姿婷', 0, NULL, '0939606649', 'ctt740730@gmail.com', '彰化縣員林市彰化縣員林鎮育英路96之4號', 510, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, NULL, 100, 900, 1000, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-24 15:22:46', NULL, NULL, NULL),
(75, 'TD15092400002', '洪毓苹', 0, NULL, '0989243761', 'snoopbie@gmail.com', '台南市北區文賢路596巷17號', 704, '洪毓苹', 0, NULL, '0989243761', 'snoopbie@gmail.com', '台南市北區文賢路596巷17號', 704, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, NULL, 100, 850, 950, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-24 17:31:25', NULL, NULL, NULL),
(76, 'TD15092400003', '林怡蓉', 0, NULL, '0919677611', 'forever730708@yahoo.com.tw', '台中市豐原區和平街20-1號', 420, '林怡蓉', 0, NULL, '0919677611', 'forever730708@yahoo.com.tw', '台中市豐原區和平街20-1號', 420, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, NULL, 0, 5860, 5860, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-24 22:08:23', NULL, NULL, NULL),
(77, 'TD15092500001', '林相逸', 0, NULL, '0939272133', 'anitasheeping@yahoo.com.tw', '新北市汐止區汐止區新台五路一段171號19樓', 221, '林相逸', 0, NULL, '0939272133', 'anitasheeping@yahoo.com.tw', '新北市汐止區汐止區新台五路一段171號19樓', 221, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 2, 0, 221, 100, 850, 950, NULL, NULL, NULL, '林相逸', '64741', '950', '2015-10-08 12:20', 1, '2015-09-25 01:34:10', NULL, 'anitasheeping@yahoo.com.tw', NULL),
(78, 'TD15092500002', '廖偉翰', 1, NULL, '0936099670', 'rehtorb14@livemail.tw', '高雄市鳳山區中山東路227號', 830, '廖偉翰', 1, NULL, '0936099670', 'rehtorb14@livemail.tw', '高雄市鳳山區中山東路227號', 830, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, NULL, 100, 1430, 1530, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-25 08:41:40', NULL, NULL, NULL),
(79, 'TD15092500003', '王裔淇', 0, NULL, '0911887994', 'Dora730204@yahoo.com.tw', '台南市白河區關嶺里43之2號', 732, '王裔淇', 0, NULL, '0911887994', 'Dora730204@yahoo.com.tw', '台南市白河區關嶺里43之2號', 732, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 1, NULL, 1, NULL, 100, 1200, 1300, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-25 17:40:51', NULL, NULL, NULL),
(80, 'TD15092900001', '林小惠', 0, NULL, '0952607969', 'vivian@kinghon.com.tw', '台南市東區東安路126號', 701, '林小惠', 0, NULL, '0952607969', 'vivian@kinghon.com.tw', '台南市東區東安路126號', 701, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, NULL, 100, 850, 950, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-29 19:00:51', NULL, NULL, NULL),
(81, 'TD15093000001', '鄭志明', 1, NULL, '0953788877', 'gb0953788@yahoo.com.tw', '屏東縣屏東市古松西巷18號', 900, '鄭志明', 1, NULL, '0953788877', 'gb0953788@yahoo.com.tw', '屏東縣屏東市古松西巷18號', 900, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, NULL, 100, 450, 550, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-09-30 03:03:15', NULL, NULL, NULL),
(82, 'TD15100200001', '蔡佩君', 0, NULL, '0912658808', 'cheesebakaka@gmail.com', '雲林縣元長鄉鹿北村永鹿路11-1號', 655, '蔡佩君', 0, NULL, '0912658808', 'cheesebakaka@gmail.com', '雲林縣元長鄉鹿北村永鹿路11-1號', 655, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, NULL, 100, 900, 1000, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-10-02 21:57:48', NULL, NULL, NULL),
(83, 'TD15100400001', '曾婉倩', 0, NULL, '0963035488', 'kinki812301@yahoo.com.tw', '新北市新莊區中興街6之4號4樓', 242, '曾婉倩', 0, NULL, '0963035488', 'kinki812301@yahoo.com.tw', '新北市新莊區中興街6之4號4樓', 242, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 0, 211, 100, 1600, 1700, NULL, NULL, NULL, '曾婉倩', '01481', '1700', '2015-10-04 22:41', 1, '2015-10-04 03:36:36', NULL, 'kinki812301@yahoo.com.tw', NULL),
(84, 'TD15100600001', '邱靖惠', 0, NULL, '0976547537', 'playboy11201028@yahoo.com.tw', '桃園市桃園區忠一路11巷7號', 330, '邱靖惠', 0, NULL, '0976547537', 'playboy11201028@yahoo.com.tw', '桃園市桃園區復興路275號(桃園慈護宮媽祖廟 服務台2號)', 330, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, 223, 100, 400, 500, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-10-06 22:51:06', NULL, 'playboy11201028@yahoo.com.tw', NULL),
(85, 'TD15100700001', '李佩樺', 0, NULL, '0929082999', 'x38x116@gmail.com', '屏東縣東港鎮沿海五路243號', 928, '李佩樺', 0, NULL, '0929082999', 'x38x116@gmail.com', '屏東縣東港鎮沿海五路243號', 928, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, NULL, 100, 450, 550, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-10-07 00:34:24', NULL, NULL, NULL),
(86, 'TD15100700002', '邱柏豪', 1, NULL, '0911616606', 'mp3070765@yahoo.com.tw', '南投縣埔里鎮北平街35之13號', 545, '邱柏豪', 1, NULL, '0911616606', 'mp3070765@yahoo.com.tw', '南投縣埔里鎮北平街35之13號', 545, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, NULL, 100, 225, 325, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-10-07 21:15:57', '下午在送貨!', NULL, NULL),
(87, 'TD15101200001', '蕭乙晴', 0, NULL, '0981357375', 'missing01290129@yahoo.com.tw', '屏東縣屏東市廣東路954巷34弄19號', 900, '蕭乙晴', 0, NULL, '0981357375', 'missing01290129@yahoo.com.tw', '屏東縣屏東市廣東路954巷34弄19號', 900, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, NULL, 100, 450, 550, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-10-12 19:21:06', NULL, NULL, NULL),
(88, 'TD15101300001', '謝家豪', 1, NULL, '0909137419', 'super9327@yahoo.com.tw', '彰化縣埤頭鄉興農村中南路271號', 523, '謝家豪', 1, NULL, '0909137419', 'super9327@yahoo.com.tw', '彰化縣埤頭鄉興農村中南路271號', 523, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, 0, NULL, 100, 1350, 1450, NULL, NULL, NULL, NULL, '0', '0', '0000-00-00 00:00', 0, '2015-10-13 23:30:17', NULL, NULL, NULL);

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
(1, '乾燥蔬果類', '%E4%B9%BE%E7%87%A5%E8%94%AC%E6%9E%9C%E9%A1%9E', 0, 1, 1),
(3, '乾燥海產類', '%E4%B9%BE%E7%87%A5%E6%B5%B7%E7%94%A2%E9%A1%9E', 0, 1, 2);

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
(18, 3, 4),
(19, 1, 2),
(20, 1, 3),
(24, 1, 1),
(26, 3, 3),
(27, 3, 2),
(28, 3, 1);

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

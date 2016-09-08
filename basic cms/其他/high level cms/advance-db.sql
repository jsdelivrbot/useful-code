-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2016-08-22 07:49:50
-- 伺服器版本: 5.7.11
-- PHP 版本： 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `advance-db`
--

-- --------------------------------------------------------

--
-- 資料表結構 `address_book_set`
--

CREATE TABLE `address_book_set` (
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

CREATE TABLE `admin` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_password` tinytext COLLATE utf8_unicode_ci,
  `user_level` int(4) DEFAULT NULL,
  `user_limit` tinyint(4) DEFAULT '2',
  `user_active` tinyint(1) DEFAULT '1',
  `user_status` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_loginerr` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `admin`
--

INSERT INTO `admin` (`user_id`, `user_name`, `user_password`, `user_level`, `user_limit`, `user_active`, `user_status`, `user_loginerr`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1, 1, 'active', 0),
(7, 'tester', 'f5d1278e8109edd94e1e4197e04873b9', 2, 2, 1, 'active', 0),
(9, 'aaaaaa', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', 4, 2, 1, 'active', 0),
(10, 'ryder-test', '3b712de48137572f3849aabd5666a4e3', 3, 2, 1, 'active', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `admin_log`
--

CREATE TABLE `admin_log` (
  `log_id` int(11) NOT NULL,
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
  `HTTP_USER_AGENT` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `a_set`
--

CREATE TABLE `a_set` (
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
  `a_16` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `a_set`
--

INSERT INTO `a_set` (`a_id`, `a_title`, `a_1`, `a_2`, `a_3`, `a_4`, `a_5`, `a_6`, `a_7`, `a_8`, `a_9`, `a_10`, `a_11`, `a_12`, `a_13`, `a_14`, `a_15`, `a_16`) VALUES
(1, '系統管理員', 210, 210, 210, 210, 210, 210, 210, 210, 210, 210, 210, 210, NULL, NULL, NULL, NULL),
(2, '資料更新員', 0, 0, 0, 0, 15, 15, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '測試', 0, 30, 30, 30, 0, 0, 0, 0, 0, 0, 0, 3, NULL, NULL, NULL, NULL),
(4, '新增的', 210, 210, 210, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `baskets`
--

CREATE TABLE `baskets` (
  `basketID` int(11) NOT NULL,
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
  `subtotal` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `class_set`
--

CREATE TABLE `class_set` (
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

CREATE TABLE `data_set` (
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
  `d_active` tinyint(1) DEFAULT '1',
  `d_pub` tinyint(4) DEFAULT '1',
  `d_sort` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `epaper_set`
--

CREATE TABLE `epaper_set` (
  `e_id` int(11) NOT NULL,
  `e_title` tinytext COLLATE utf8_unicode_ci,
  `e_content` text COLLATE utf8_unicode_ci,
  `e_class1` tinytext COLLATE utf8_unicode_ci,
  `e_class2` int(11) DEFAULT '0',
  `e_date` datetime DEFAULT NULL,
  `e_active` tinyint(2) DEFAULT '0',
  `e_sort` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `file_set`
--

CREATE TABLE `file_set` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `member_set`
--

CREATE TABLE `member_set` (
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

CREATE TABLE `menu` (
  `menu_id` int(12) UNSIGNED NOT NULL,
  `menu_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_use` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_pageTitle1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_pageTitle2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_pageTitle3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_pageTitle4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_pageTitle5` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_title`, `menu_link`, `menu_use`, `menu_pageTitle1`, `menu_pageTitle2`, `menu_pageTitle3`, `menu_pageTitle4`, `menu_pageTitle5`) VALUES
(1, 'authority', 'authority_list.php', '#main_menu_1', '權限管理-列表', '權限管理-新增', '權限管理-修改', '權限管理-刪除', NULL),
(2, 'indexSet', 'indexSet_list.php', '#main_menu_2', '首頁Banner廣告-列表', '首頁Banner廣告-新增', '首頁Banner廣告-修改', '首頁Banner廣告-刪除', NULL),
(3, 'about', 'about_list.php', '#main_menu_3', '列表', '新增', '修改', '刪除', NULL),
(4, 'story', 'story_list.php', '#main_menu_4', '-列表', '-新增', '-修改', '-刪除', NULL),
(5, 'news', 'news_list.php', '#main_menu_5', '-列表', '-新增', '-修改', '-刪除', NULL),
(6, 'share', 'share_list.php', '#main_menu_6', '-列表', '-修改', '-刪除', NULL, NULL),
(7, 'characteristic', 'characteristic_list.php', '#main_menu_7', '-列表', '-修改', '-刪除', NULL, NULL),
(8, 'branch', 'branch_list', '#main_menu_8', NULL, NULL, NULL, NULL, NULL),
(9, 'gallery', 'gallery_list', '#main_menu_9', NULL, NULL, NULL, NULL, NULL),
(10, 'otherSet', 'otherSet_list', '#main_menu_10', NULL, NULL, NULL, NULL, NULL),
(11, 'schooleducation', 'schooleducation_list', '#main_menu_11', NULL, NULL, NULL, NULL, NULL),
(12, 'environment', 'environment_list', '#main_menu_12', NULL, NULL, NULL, NULL, NULL),
(13, 'download', 'download_list', '#main_menu_13', NULL, NULL, NULL, NULL, NULL),
(14, 'farmer', 'farmer_list', '#main_menu_14', NULL, NULL, NULL, NULL, NULL),
(15, 'shopProcess', 'shopProcess_list', '#main_menu_15', NULL, NULL, NULL, NULL, NULL),
(16, 'message', 'message_list', '#main_menu_16', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `message_set`
--

CREATE TABLE `message_set` (
  `m_id` int(10) UNSIGNED NOT NULL,
  `m_d_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
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
-- 資料表結構 `m_baskets`
--

CREATE TABLE `m_baskets` (
  `basketID` int(11) NOT NULL,
  `basketSession` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `itemID` tinytext COLLATE utf8_unicode_ci,
  `productID` int(11) DEFAULT NULL,
  `class` tinyint(4) DEFAULT '0',
  `productName` tinytext COLLATE utf8_unicode_ci,
  `qty` tinytext COLLATE utf8_unicode_ci,
  `qtyLimit` tinyint(4) DEFAULT NULL COMMENT AS `可購買數量限制`,
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
  `perUnit` int(11) DEFAULT NULL COMMENT AS `d_class5 每單位數量`,
  `d_new_product` tinyint(2) DEFAULT '0',
  `file_link2` tinytext COLLATE utf8_unicode_ci,
  `file_link3` tinytext COLLATE utf8_unicode_ci,
  `subtotal` int(11) DEFAULT '0',
  `mb_ip` tinytext COLLATE utf8_unicode_ci,
  `mb_time` datetime DEFAULT NULL,
  `m_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `order_item`
--

CREATE TABLE `order_item` (
  `oi_id` int(11) NOT NULL,
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
  `subtotal` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `order_set`
--

CREATE TABLE `order_set` (
  `o_id` int(11) NOT NULL,
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
  `DeviceType` char(6) COLLATE utf8_unicode_ci DEFAULT 'PC' COMMENT '購買時裝置Device',
  `RID` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `response_set`
--

CREATE TABLE `response_set` (
  `r_id` int(11) NOT NULL,
  `r_o_id` int(11) NOT NULL,
  `r_status` int(3) DEFAULT '-1',
  `r_lidm` tinytext COLLATE utf8_unicode_ci,
  `ReturnStatus` int(11) DEFAULT '-1' COMMENT '伺服端返回狀態',
  `MerchantID` char(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT AS `return-廠商編號`,
  `MerchantTradeNo` char(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT AS `return-廠商交易編號`,
  `PaymentDate` datetime DEFAULT NULL COMMENT AS `return-付款時間`,
  `PaymentType` text COLLATE utf8_unicode_ci COMMENT 'return-付款方式',
  `PaymentTypeChargeFee` tinytext COLLATE utf8_unicode_ci COMMENT 'return-通路費',
  `RtnCode` tinytext COLLATE utf8_unicode_ci COMMENT 'return-交易狀態',
  `RtnMsg` tinytext COLLATE utf8_unicode_ci COMMENT 'return-交易訊息',
  `SimulatePaid` int(11) DEFAULT NULL COMMENT AS `return-是否為模擬付款`,
  `TradeAmt` int(11) DEFAULT NULL COMMENT AS `return-交易金額`,
  `TradeDate` datetime DEFAULT NULL COMMENT AS `return-訂單成立時間`,
  `TradeNo` char(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT AS `return-AllPay交易編號`,
  `ReturnTime` datetime DEFAULT NULL COMMENT AS `return-返回時間`,
  `r_MerchantID` char(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT AS `AllPay提供的廠商編號`,
  `r_MerchantTradeNo` char(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT AS `廠商交易編號`,
  `r_RtnCode` int(11) DEFAULT NULL COMMENT AS `交易狀態`,
  `r_RtnMsg` tinytext COLLATE utf8_unicode_ci COMMENT '返回訊息或商品名稱',
  `r_SimulatePaid` int(11) DEFAULT NULL COMMENT AS `是否為模擬付款`,
  `r_PaymentDate` datetime DEFAULT NULL COMMENT AS `付款時間`,
  `r_PaymentType` tinytext COLLATE utf8_unicode_ci COMMENT '付款方式',
  `r_PaymentTypeChargeFee` int(11) DEFAULT NULL COMMENT AS `通路費`,
  `r_TradeAmt` int(11) DEFAULT NULL COMMENT AS `交易金額`,
  `r_TradeDate` datetime DEFAULT NULL COMMENT AS `訂單成立時間`,
  `r_TradeNo` char(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT AS `AllPay的交易編號`,
  `r_gwsr` int(11) DEFAULT NULL COMMENT AS `卡-授權交易單號`,
  `r_process_date` datetime DEFAULT NULL COMMENT AS `卡-處理時間`,
  `r_auth_code` char(6) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT AS `卡-授權碼`,
  `r_amount` int(11) DEFAULT NULL COMMENT AS `卡-金額`,
  `r_eci` int(11) DEFAULT NULL COMMENT AS `卡-3D(VBV)`,
  `r_card4no` char(4) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT AS `卡-末4碼`,
  `r_card6no` char(6) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT AS `卡-前6碼`,
  `r_PeriodAmount` int(11) DEFAULT NULL COMMENT AS `卡-每次授權金額`,
  `r_PeriodType` tinytext COLLATE utf8_unicode_ci COMMENT '卡-所設定的週期種類',
  `r_TotalSuccessAmount` int(11) DEFAULT NULL COMMENT AS `卡-已成功授權的金額合計`,
  `r_TotalSuccessTimes` int(11) DEFAULT NULL COMMENT AS `卡-已成功授權的次數`,
  `r_ExecTimes` int(11) DEFAULT NULL COMMENT AS `卡-所設定的執行次數(定期定額)`,
  `r_Frequency` int(11) DEFAULT NULL COMMENT AS `卡-所設定的執行頻率(定期定額)`,
  `r_staed` int(11) DEFAULT NULL COMMENT AS `卡-各期金額`,
  `r_stage` int(11) DEFAULT NULL COMMENT AS `卡-分期數`,
  `r_stast` int(11) DEFAULT NULL COMMENT AS `卡-頭期金額`,
  `r_red_dan` int(11) DEFAULT NULL COMMENT AS `卡-紅利扣點`,
  `r_red_de_amt` int(11) DEFAULT NULL COMMENT AS `卡-紅利折抵金額`,
  `r_red_ok_amt` int(11) DEFAULT NULL COMMENT AS `卡-實際扣款金額`,
  `r_red_yet` int(11) DEFAULT NULL COMMENT AS `卡-紅利剩餘點數`,
  `r_PayFrom` char(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT AS `CVSorBARCODE-繳費超商`,
  `r_PaymentNo` char(14) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT AS `CVSorBARCODE-繳費代碼`,
  `r_AlipayID` char(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT AS `Alipay-付款人支付寶的系統編號`,
  `r_AlipayTradeNo` char(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT AS `Alipay-支付寶交易編號`,
  `r_ATMAccBank` char(3) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT AS `ATM-銀行代碼`,
  `r_ATMAccNo` char(5) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT AS `ATM-帳號後五碼`,
  `r_WebATMAccBank` char(3) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT AS `WebATM-銀行代碼`,
  `r_WebATMAccNo` char(5) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT AS `WebATM-帳號後五碼`,
  `r_WebATMBankName` char(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT AS `WebATM-銀行名`,
  `r_TenpayTradeNo` char(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT AS `Tenpay-財付通交易編號`,
  `r_CheckMacValue` tinytext COLLATE utf8_unicode_ci COMMENT '驗查碼',
  `r_order_date` datetime DEFAULT NULL,
  `r_response_date` datetime DEFAULT NULL COMMENT AS `瀏覽器端返回時間`
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `tab_set`
--

CREATE TABLE `tab_set` (
  `tab_d_id` int(11) DEFAULT '0',
  `tab_id` int(11) NOT NULL,
  `tab_type` tinytext COLLATE utf8_unicode_ci,
  `tab_title` tinytext COLLATE utf8_unicode_ci,
  `tab_content` text COLLATE utf8_unicode_ci,
  `tab_data1` text COLLATE utf8_unicode_ci,
  `tab_sort` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `terms`
--

CREATE TABLE `terms` (
  `term_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_en` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `term_group` bigint(10) NOT NULL DEFAULT '0',
  `term_active` tinyint(2) NOT NULL DEFAULT '1',
  `term_sort` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `term_relationships`
--

CREATE TABLE `term_relationships` (
  `object_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `term_taxonomy`
--

CREATE TABLE `term_taxonomy` (
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) COLLATE utf8_unicode_ci DEFAULT '',
  `description` longtext COLLATE utf8_unicode_ci,
  `parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `vitae_set`
--

CREATE TABLE `vitae_set` (
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

CREATE TABLE `webcount` (
  `count_id` int(11) NOT NULL,
  `visitors_times` int(11) DEFAULT '0',
  `count_ip` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `count_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `zipcode`
--

CREATE TABLE `zipcode` (
  `Id` bigint(20) NOT NULL,
  `City` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Area` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ZipCode` char(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `c_id` int(11) DEFAULT NULL COMMENT AS `對應縣市`,
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
-- 資料表索引 `baskets`
--
ALTER TABLE `baskets`
  ADD PRIMARY KEY (`basketID`);

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
-- 資料表索引 `epaper_set`
--
ALTER TABLE `epaper_set`
  ADD PRIMARY KEY (`e_id`);

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
-- 資料表索引 `m_baskets`
--
ALTER TABLE `m_baskets`
  ADD PRIMARY KEY (`basketID`);

--
-- 資料表索引 `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`oi_id`);

--
-- 資料表索引 `order_set`
--
ALTER TABLE `order_set`
  ADD PRIMARY KEY (`o_id`);

--
-- 資料表索引 `response_set`
--
ALTER TABLE `response_set`
  ADD PRIMARY KEY (`r_id`);

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- 使用資料表 AUTO_INCREMENT `admin_log`
--
ALTER TABLE `admin_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `a_set`
--
ALTER TABLE `a_set`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用資料表 AUTO_INCREMENT `baskets`
--
ALTER TABLE `baskets`
  MODIFY `basketID` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `class_set`
--
ALTER TABLE `class_set`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `data_set`
--
ALTER TABLE `data_set`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `epaper_set`
--
ALTER TABLE `epaper_set`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `file_set`
--
ALTER TABLE `file_set`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `member_set`
--
ALTER TABLE `member_set`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- 使用資料表 AUTO_INCREMENT `message_set`
--
ALTER TABLE `message_set`
  MODIFY `m_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `m_baskets`
--
ALTER TABLE `m_baskets`
  MODIFY `basketID` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `order_item`
--
ALTER TABLE `order_item`
  MODIFY `oi_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `order_set`
--
ALTER TABLE `order_set`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `response_set`
--
ALTER TABLE `response_set`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `tab_set`
--
ALTER TABLE `tab_set`
  MODIFY `tab_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `terms`
--
ALTER TABLE `terms`
  MODIFY `term_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `term_taxonomy`
--
ALTER TABLE `term_taxonomy`
  MODIFY `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `vitae_set`
--
ALTER TABLE `vitae_set`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `webcount`
--
ALTER TABLE `webcount`
  MODIFY `count_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `zipcode`
--
ALTER TABLE `zipcode`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

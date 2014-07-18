-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.16 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             8.3.0.4796
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for sq_demo
DROP DATABASE IF EXISTS `sq_demo`;
CREATE DATABASE IF NOT EXISTS `sq_demo` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `sq_demo`;


-- Dumping structure for table sq_demo.stock_info
DROP TABLE IF EXISTS `stock_info`;
CREATE TABLE IF NOT EXISTS `stock_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stock_code` varchar(50) NOT NULL DEFAULT '0' COMMENT '股票代码',
  `stock_name` varchar(50) NOT NULL DEFAULT '0' COMMENT '股票名称',
  `stock_price` float NOT NULL DEFAULT '0' COMMENT '当前价格',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='股票信息';

-- Dumping data for table sq_demo.stock_info: 3 rows
DELETE FROM `stock_info`;
/*!40000 ALTER TABLE `stock_info` DISABLE KEYS */;
INSERT INTO `stock_info` (`id`, `stock_code`, `stock_name`, `stock_price`) VALUES
	(2, 'sz002190', '成飞集成', 59),
	(3, 'sz002726', '龙大肉食', 17.06),
	(4, 'sh600000', '浦发银行', 9.05);
/*!40000 ALTER TABLE `stock_info` ENABLE KEYS */;


-- Dumping structure for table sq_demo.trade_order
DROP TABLE IF EXISTS `trade_order`;
CREATE TABLE IF NOT EXISTS `trade_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `regdate` date DEFAULT NULL COMMENT '创建日期',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '发起者',
  `user_name` varchar(50) NOT NULL DEFAULT '0' COMMENT '用户名',
  `fng_nick` varchar(50) NOT NULL DEFAULT '0' COMMENT '用户昵称',
  `order_type` int(11) NOT NULL DEFAULT '0' COMMENT '类型 0:个人单 1:官方团单',
  `stock_id` int(11) NOT NULL DEFAULT '0' COMMENT '股票ID',
  `stock_code` varchar(50) NOT NULL DEFAULT '0' COMMENT '股票代码',
  `stock_name` varchar(50) NOT NULL DEFAULT '0' COMMENT '股票名称',
  `buying_rate` float NOT NULL DEFAULT '0' COMMENT '买入价',
  `is_deal` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否成交',
  `liquidate_date` datetime NOT NULL COMMENT '平仓时间',
  `selling_rate` float NOT NULL DEFAULT '0' COMMENT '卖出价',
  `limit_min` float NOT NULL DEFAULT '0' COMMENT '总额下限',
  `limit_max` float NOT NULL DEFAULT '0' COMMENT '总额上限',
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='个人单和官方团单';

-- Dumping data for table sq_demo.trade_order: 1 rows
DELETE FROM `trade_order`;
/*!40000 ALTER TABLE `trade_order` DISABLE KEYS */;
INSERT INTO `trade_order` (`order_id`, `regdate`, `user_id`, `user_name`, `fng_nick`, `order_type`, `stock_id`, `stock_code`, `stock_name`, `buying_rate`, `is_deal`, `liquidate_date`, `selling_rate`, `limit_min`, `limit_max`) VALUES
	(1, '2014-07-18', 4, 'tester01', '赵四', 0, 4, 'sh600000', '浦发银行', 9.1, 0, '0000-00-00 00:00:00', 0, 0, 0);
/*!40000 ALTER TABLE `trade_order` ENABLE KEYS */;


-- Dumping structure for table sq_demo.trade_order_log
DROP TABLE IF EXISTS `trade_order_log`;
CREATE TABLE IF NOT EXISTS `trade_order_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL DEFAULT '0' COMMENT '跟单编号',
  `order_type` tinyint(4) DEFAULT NULL COMMENT '跟单类型 0:个单 1:团单',
  `regdate` date DEFAULT NULL COMMENT '创建日期',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `user_name` varchar(50) NOT NULL DEFAULT '0' COMMENT '用户名',
  `fng_nick` varchar(50) NOT NULL DEFAULT '0' COMMENT 'FNG昵称',
  `stock_id` int(11) NOT NULL DEFAULT '0' COMMENT '股票ID',
  `stock_code` varchar(50) NOT NULL DEFAULT '0' COMMENT '股票代码',
  `stock_name` varchar(50) NOT NULL DEFAULT '0' COMMENT '股票名称',
  `buying_rate` float NOT NULL DEFAULT '0' COMMENT '买入价',
  `is_deal` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否成交',
  `liquidate_date` datetime NOT NULL COMMENT '平仓时间',
  `selling_rate` float NOT NULL DEFAULT '0' COMMENT '卖出价',
  `amount` int(11) DEFAULT '0' COMMENT '买入数量',
  `user_quota` float DEFAULT '0' COMMENT '用户配比',
  `income` float DEFAULT '0' COMMENT '本单收入',
  `stampduty` float DEFAULT '0' COMMENT '交易税',
  `occupancycost` float DEFAULT '0' COMMENT '资金占用费',
  `benefitsharing` float DEFAULT '0' COMMENT '受益分成',
  `initiatorsharing` float DEFAULT '0' COMMENT '发起人分成',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='个人单和官方团单';

-- Dumping data for table sq_demo.trade_order_log: 4 rows
DELETE FROM `trade_order_log`;
/*!40000 ALTER TABLE `trade_order_log` DISABLE KEYS */;
INSERT INTO `trade_order_log` (`id`, `order_id`, `order_type`, `regdate`, `user_id`, `user_name`, `fng_nick`, `stock_id`, `stock_code`, `stock_name`, `buying_rate`, `is_deal`, `liquidate_date`, `selling_rate`, `amount`, `user_quota`, `income`, `stampduty`, `occupancycost`, `benefitsharing`, `initiatorsharing`) VALUES
	(1, 1, 0, '2014-07-18', 4, 'tester01', '赵四', 4, 'sh600000', '浦发银行', 9.1, 1, '2014-07-18 11:49:35', 9.31, 1000, 11.5, 2625, 19.9, 418.6, 525, 262.5),
	(2, 1, 0, '2014-07-18', 8, 'tester05', '刘溜', 4, 'sh600000', '浦发银行', 9.1, 1, '2014-07-18 11:49:35', 9.31, 1500, 11.5, 3937.5, 19.9, 627.9, 787.5, 393.75),
	(3, 1, 0, '2014-07-18', 7, 'tester04', '何九', 4, 'sh600000', '浦发银行', 9.1, 1, '2014-07-18 11:49:35', 9.31, 1000, 10.5, 2415, 19.9, 382.2, 483, 241.5),
	(4, 1, 0, '2014-07-18', 5, 'tester02', '李三', 4, 'sh600000', '浦发银行', 9.1, 1, '2014-07-18 11:49:35', 9.31, 1500, 11.5, 3937.5, 19.9, 627.9, 787.5, 393.75);
/*!40000 ALTER TABLE `trade_order_log` ENABLE KEYS */;


-- Dumping structure for table sq_demo.user_charge_log
DROP TABLE IF EXISTS `user_charge_log`;
CREATE TABLE IF NOT EXISTS `user_charge_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `opt_date` datetime DEFAULT NULL COMMENT '充值日期',
  `opt_amount` int(11) NOT NULL DEFAULT '0' COMMENT '充值数量',
  `opt_balance` int(11) NOT NULL DEFAULT '0' COMMENT '充值后余额',
  `opt_source` varchar(50) NOT NULL DEFAULT '0' COMMENT '充值来源',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户充值记录';

-- Dumping data for table sq_demo.user_charge_log: 0 rows
DELETE FROM `user_charge_log`;
/*!40000 ALTER TABLE `user_charge_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_charge_log` ENABLE KEYS */;


-- Dumping structure for table sq_demo.user_followship
DROP TABLE IF EXISTS `user_followship`;
CREATE TABLE IF NOT EXISTS `user_followship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regdate` datetime DEFAULT NULL COMMENT '加关注时间',
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `user_name` varchar(50) DEFAULT NULL COMMENT '用户名',
  `user_be_followed` int(11) DEFAULT NULL COMMENT '被关注用户ID',
  `user_be_followed_name` varchar(50) DEFAULT NULL COMMENT '被关注用户名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='用户关注关系';

-- Dumping data for table sq_demo.user_followship: 3 rows
DELETE FROM `user_followship`;
/*!40000 ALTER TABLE `user_followship` DISABLE KEYS */;
INSERT INTO `user_followship` (`id`, `regdate`, `user_id`, `user_name`, `user_be_followed`, `user_be_followed_name`) VALUES
	(1, '2014-07-03 21:36:47', 5, '李三', 4, '赵四'),
	(2, '2014-07-03 21:38:29', 7, '何九', 4, '赵四'),
	(3, '2014-07-03 21:38:39', 8, '刘溜', 4, '赵四');
/*!40000 ALTER TABLE `user_followship` ENABLE KEYS */;


-- Dumping structure for table sq_demo.user_info
DROP TABLE IF EXISTS `user_info`;
CREATE TABLE IF NOT EXISTS `user_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL COMMENT '用户名',
  `fng_nick` varchar(50) DEFAULT NULL COMMENT 'FNG昵称',
  `password` varchar(50) DEFAULT NULL COMMENT '密码',
  `regdate` datetime DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `trade_password` varchar(50) DEFAULT NULL COMMENT '交易密码',
  `qq` varchar(50) DEFAULT NULL,
  `weibo` varchar(50) DEFAULT NULL,
  `alipay` varchar(50) DEFAULT NULL,
  `user_level` int(11) DEFAULT '0' COMMENT '用户等级',
  `user_profile_img` varchar(50) DEFAULT '0' COMMENT '用户头像图片',
  `is_faqigendan` tinyint(4) DEFAULT '0' COMMENT '能否发起跟单',
  `user_quota` float DEFAULT '0' COMMENT '用户配比',
  `fng_balance` float DEFAULT NULL COMMENT 'FNG币',
  `fng_winscore` float DEFAULT NULL COMMENT '获利积分',
  `fng_losescore` float DEFAULT NULL COMMENT '霉运积分',
  `fng_recommend` tinyint(4) DEFAULT NULL COMMENT '是否推荐 0:默认 1:推荐',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='用户信息';

-- Dumping data for table sq_demo.user_info: 8 rows
DELETE FROM `user_info`;
/*!40000 ALTER TABLE `user_info` DISABLE KEYS */;
INSERT INTO `user_info` (`id`, `username`, `fng_nick`, `password`, `regdate`, `email`, `mobile`, `trade_password`, `qq`, `weibo`, `alipay`, `user_level`, `user_profile_img`, `is_faqigendan`, `user_quota`, `fng_balance`, `fng_winscore`, `fng_losescore`, `fng_recommend`) VALUES
	(4, 'tester01', '赵四', '111111', '2014-06-16 22:44:02', 'tester@user.com', '13100131000', NULL, NULL, NULL, NULL, 3, '/image/avatar.jpg', 0, 11.5, 0, 0, 0, 1),
	(5, 'tester02', '李三', '111111', '2014-06-17 22:58:15', 'tester@user.com', '13100131000', NULL, NULL, NULL, NULL, 0, '/image/avatar.jpg', 0, 11.5, 0, 0, 0, 0),
	(6, 'tester03', '王五', '111111', '2014-06-17 22:59:30', 'tester@user.com', '13100131000', NULL, NULL, NULL, NULL, 0, '/image/avatar.jpg', 0, 0, 0, 0, 0, 0),
	(7, 'tester04', '何九', '111111', '2014-06-28 20:49:17', 'tester@user.com', '13100131000', NULL, NULL, NULL, NULL, 0, '/image/avatar.jpg', 0, 11.5, 0, 0, 0, 1),
	(8, 'tester05', '刘溜', '111111', '2014-06-28 20:54:18', 'tester@user.com', '13100131000', NULL, NULL, NULL, NULL, 0, '/image/avatar.jpg', 0, 11.5, 0, 0, 0, 0),
	(9, 'tester06', '尤七', '111111', '2014-06-28 22:29:03', 'tester@user.com', '13100131000', NULL, NULL, NULL, NULL, 1, '/image/avatar.jpg', 0, 0, 0, 0, 0, 0),
	(10, 'tester07', '桑八', '111111', '2014-06-28 22:51:36', 'tester@user.com', '13100131000', NULL, NULL, NULL, NULL, 0, '/image/avatar.jpg', 0, 11.5, 0, 0, 0, 1),
	(11, 'O\'reilly', '苏十', '111111', '2014-06-28 23:33:27', 'tester@user.com', '13100131000', NULL, NULL, NULL, NULL, 2, '/image/avatar.jpg', 0, 0, 0, 0, 0, 0);
/*!40000 ALTER TABLE `user_info` ENABLE KEYS */;


-- Dumping structure for table sq_demo.user_trade_log
DROP TABLE IF EXISTS `user_trade_log`;
CREATE TABLE IF NOT EXISTS `user_trade_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `opt_date` datetime DEFAULT NULL,
  `opt_stock_id` int(11) DEFAULT NULL COMMENT '股票ID',
  `opt_stock_name` varchar(50) DEFAULT NULL COMMENT '股票名称',
  `opt_entrust_price` varchar(50) DEFAULT NULL COMMENT '委托价格',
  `opt_amount` int(11) DEFAULT NULL COMMENT '买入股数',
  `opt_income` int(11) DEFAULT NULL COMMENT '收入',
  `opt_expend` int(11) DEFAULT NULL COMMENT '支出',
  `opt_type` varchar(50) DEFAULT NULL COMMENT '操作类型',
  `opt_memo` varchar(50) DEFAULT NULL COMMENT '备注',
  `opt_quota` int(11) DEFAULT NULL COMMENT '配比倍数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='交易（操盘）记录';

-- Dumping data for table sq_demo.user_trade_log: 0 rows
DELETE FROM `user_trade_log`;
/*!40000 ALTER TABLE `user_trade_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_trade_log` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

CREATE DATABASE  IF NOT EXISTS `sq_demo` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `sq_demo`;
-- MySQL dump 10.13  Distrib 5.6.19, for osx10.7 (i386)
--
-- Host: localhost    Database: sq_demo
-- ------------------------------------------------------
-- Server version	5.6.20

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `stock_info`
--

DROP TABLE IF EXISTS `stock_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stock_code` varchar(50) NOT NULL DEFAULT '0' COMMENT '股票代码',
  `stock_name` varchar(50) NOT NULL DEFAULT '0' COMMENT '股票名称',
  `stock_price` float NOT NULL DEFAULT '0' COMMENT '当前价格',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='股票信息';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_info`
--

LOCK TABLES `stock_info` WRITE;
/*!40000 ALTER TABLE `stock_info` DISABLE KEYS */;
INSERT INTO `stock_info` VALUES (4,'sh600000','浦发银行',9.9);
/*!40000 ALTER TABLE `stock_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trade_order`
--

DROP TABLE IF EXISTS `trade_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trade_order` (
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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='个人单和官方团单';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trade_order`
--

LOCK TABLES `trade_order` WRITE;
/*!40000 ALTER TABLE `trade_order` DISABLE KEYS */;
INSERT INTO `trade_order` VALUES (10,'2014-12-07',4,'tester01','赵四',0,4,'sh600000','浦发银行',10,0,'0000-00-00 00:00:00',0,0,0);
/*!40000 ALTER TABLE `trade_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trade_order_log`
--

DROP TABLE IF EXISTS `trade_order_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trade_order_log` (
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
  `is_initiator` varchar(45) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='个人单和官方团单';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trade_order_log`
--

LOCK TABLES `trade_order_log` WRITE;
/*!40000 ALTER TABLE `trade_order_log` DISABLE KEYS */;
INSERT INTO `trade_order_log` VALUES (24,10,0,'2014-12-07',4,'tester01','赵四',4,'sh600000','浦发银行',10,1,'2014-12-07 09:47:12',10.37,2000,11.5,9250,19.9,920,1662.02,0,'1'),(25,10,0,'2014-12-07',6,'tester03','王五',4,'sh600000','浦发银行',10,1,'2014-12-07 09:47:12',10.37,1000,11.5,4625,19.9,460,829.02,331.608,'0'),(26,10,0,'2014-12-07',7,'tester04','何九',4,'sh600000','浦发银行',10,1,'2014-12-07 09:47:12',10.37,1200,11.5,5550,19.9,552,995.62,398.248,'0'),(27,10,0,'2014-12-07',5,'tester02','李三',4,'sh600000','浦发银行',10,1,'2014-12-07 09:47:12',10.37,1800,11.5,8325,19.9,828,1495.42,598.168,'0');
/*!40000 ALTER TABLE `trade_order_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_charge_log`
--

DROP TABLE IF EXISTS `user_charge_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_charge_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `opt_date` datetime DEFAULT NULL COMMENT '充值日期',
  `opt_amount` int(11) NOT NULL DEFAULT '0' COMMENT '充值数量',
  `opt_balance` int(11) NOT NULL DEFAULT '0' COMMENT '充值后余额',
  `opt_source` varchar(50) NOT NULL DEFAULT '0' COMMENT '充值来源',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户充值记录';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_charge_log`
--

LOCK TABLES `user_charge_log` WRITE;
/*!40000 ALTER TABLE `user_charge_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_charge_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_followship`
--

DROP TABLE IF EXISTS `user_followship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_followship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regdate` datetime DEFAULT NULL COMMENT '加关注时间',
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `user_name` varchar(50) DEFAULT NULL COMMENT '用户名',
  `user_be_followed` int(11) DEFAULT NULL COMMENT '被关注用户ID',
  `user_be_followed_name` varchar(50) DEFAULT NULL COMMENT '被关注用户名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='用户关注关系';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_followship`
--

LOCK TABLES `user_followship` WRITE;
/*!40000 ALTER TABLE `user_followship` DISABLE KEYS */;
INSERT INTO `user_followship` VALUES (1,'2014-07-03 21:36:47',5,'李三',4,'赵四'),(2,'2014-07-03 21:38:29',7,'何九',4,'赵四'),(3,'2014-07-03 21:38:39',8,'刘溜',4,'赵四'),(4,'2014-07-03 21:38:39',6,'王五',4,'赵四'),(5,'2014-07-03 21:38:39',9,'尤七',4,'赵四'),(6,'2014-07-03 21:38:39',10,'桑八',4,'赵四');
/*!40000 ALTER TABLE `user_followship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_info`
--

DROP TABLE IF EXISTS `user_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_info` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_info`
--

LOCK TABLES `user_info` WRITE;
/*!40000 ALTER TABLE `user_info` DISABLE KEYS */;
INSERT INTO `user_info` VALUES (4,'tester01','赵四','111111','2014-06-16 22:44:02','tester@user.com','13100131000',NULL,NULL,NULL,NULL,3,'/image/avatar.jpg',0,11.5,0,0,0,1),(5,'tester02','李三','111111','2014-06-17 22:58:15','tester@user.com','13100131000',NULL,NULL,NULL,NULL,0,'/image/avatar.jpg',0,11.5,0,0,0,0),(6,'tester03','王五','111111','2014-06-17 22:59:30','tester@user.com','13100131000',NULL,NULL,NULL,NULL,0,'/image/avatar.jpg',0,11.5,0,0,0,0),(7,'tester04','何九','111111','2014-06-28 20:49:17','tester@user.com','13100131000',NULL,NULL,NULL,NULL,0,'/image/avatar.jpg',0,11.5,0,0,0,0),(8,'tester05','刘溜','111111','2014-06-28 20:54:18','tester@user.com','13100131000',NULL,NULL,NULL,NULL,0,'/image/avatar.jpg',0,11.5,0,0,0,0),(9,'tester06','尤七','111111','2014-06-28 22:29:03','tester@user.com','13100131000',NULL,NULL,NULL,NULL,1,'/image/avatar.jpg',0,11.5,0,0,0,0),(10,'tester07','桑八','111111','2014-06-28 22:51:36','tester@user.com','13100131000',NULL,NULL,NULL,NULL,0,'/image/avatar.jpg',0,11.5,0,0,0,0),(11,'O\'reilly','苏十','111111','2014-06-28 23:33:27','tester@user.com','13100131000',NULL,NULL,NULL,NULL,2,'/image/avatar.jpg',0,11.5,0,0,0,0);
/*!40000 ALTER TABLE `user_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_trade_log`
--

DROP TABLE IF EXISTS `user_trade_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_trade_log` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_trade_log`
--

LOCK TABLES `user_trade_log` WRITE;
/*!40000 ALTER TABLE `user_trade_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_trade_log` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-12-07 17:13:42

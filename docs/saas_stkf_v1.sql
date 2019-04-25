# ************************************************************
# Sequel Pro SQL dump
# Database: saas_stkf_v1
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table app_error_logs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `app_error_logs`;

CREATE TABLE `app_error_logs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `app_name` varchar(30) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT 'app 名字',
  `request_uri` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '请求uri',
  `content` text CHARACTER SET utf8 NOT NULL COMMENT '日志内容',
  `ip` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT 'ip',
  `ua` varchar(1000) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT 'ua信息',
  `cookies` varchar(1000) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT 'cookie信息。如果有的话',
  `created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '插入时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='app错误日表';



# Dump of table chat_history
# ------------------------------------------------------------

DROP TABLE IF EXISTS `chat_history`;

CREATE TABLE `chat_history` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cmd` varchar(20) NOT NULL COMMENT '指令',
  `f_name` varchar(32) NOT NULL DEFAULT '0' COMMENT '发送方昵称',
  `f_code` varchar(32) NOT NULL DEFAULT '' COMMENT '发送方code',
  `f_avatar` varchar(250) NOT NULL DEFAULT '' COMMENT '发送方头像',
  `to_name` varchar(32) NOT NULL DEFAULT '' COMMENT '接收方昵称',
  `to_code` varchar(32) NOT NULL DEFAULT '' COMMENT '接收方code',
  `to_avatar` varchar(250) NOT NULL DEFAULT '' COMMENT '接收方头像',
  `content` varchar(1000) NOT NULL DEFAULT '' COMMENT '发送内容',
  `source` tinyint(3) NOT NULL DEFAULT '1' COMMENT '来源 1：访客 2：客服 3：系统',
  `updated_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `chat_history` WRITE;
/*!40000 ALTER TABLE `chat_history` DISABLE KEYS */;

INSERT INTO `chat_history` (`id`, `cmd`, `f_name`, `f_code`, `f_avatar`, `to_name`, `to_code`, `to_avatar`, `content`, `source`, `updated_time`, `created_time`)
VALUES
	(145,'chat','游客_1476','0ad865ca4bdef9cbbddbf0b708c3bfda','http://v1.stkf.test/static/images/kf_default_avatar?ver=1556113951','','','http://v1.stkf.test/static/images/kf_default_avatar?ver=1556113951','dff',1,'2019-04-24 21:52:36','2019-04-24 21:52:36'),
	(146,'chat','游客_8242','0ad865ca4bdef9cbbddbf0b708c3bfda','http://v1.stkf.test/static/images/kf_default_avatar?ver=1556114858','客服郭大爷','90f6d632','http://v1.stkf.test/static/images/kf_default_avatar?ver=1556114859','你好呀',1,'2019-04-24 22:07:48','2019-04-24 22:07:48'),
	(147,'chat','客服郭大爷','90f6d632','http://v1.stkf.test/static/images/kf_default_avatar?ver=1556114870','游客_8242','0ad865ca4bdef9cbbddbf0b708c3bfda','','我很好',2,'2019-04-24 22:07:57','2019-04-24 22:07:57'),
	(148,'chat','游客_6199','0ad865ca4bdef9cbbddbf0b708c3bfda','http://v1.stkf.test/static/images/kf_default_avatar?ver=1556115149','客服郭大爷','90f6d632','http://v1.stkf.test/static/images/kf_default_avatar?ver=1556115150','客服在吗？',1,'2019-04-24 22:12:53','2019-04-24 22:12:53'),
	(149,'chat','客服郭大爷','90f6d632','http://v1.stkf.test/static/images/kf_default_avatar?ver=1556115147','游客_6199','0ad865ca4bdef9cbbddbf0b708c3bfda','','在的，你想咋地',2,'2019-04-24 22:13:00','2019-04-24 22:13:00'),
	(150,'chat','游客_4490','0ad865ca4bdef9cbbddbf0b708c3bfda','http://v1.stkf.test/static/images/kf_default_avatar?ver=1556115421','客服郭大爷','90f6d632','http://v1.stkf.test/static/images/kf_default_avatar?ver=1556115422','来了',1,'2019-04-24 22:17:05','2019-04-24 22:17:05'),
	(151,'chat','客服郭大爷','90f6d632','http://v1.stkf.test/static/images/kf_default_avatar?ver=1556115147','游客_6199','0ad865ca4bdef9cbbddbf0b708c3bfda','','你怎么又来了',2,'2019-04-24 22:17:12','2019-04-24 22:17:12'),
	(152,'chat','游客_4490','0ad865ca4bdef9cbbddbf0b708c3bfda','http://v1.stkf.test/static/images/kf_default_avatar?ver=1556115421','客服郭大爷','90f6d632','http://v1.stkf.test/static/images/kf_default_avatar?ver=1556115422','我也不想来了',1,'2019-04-24 22:17:22','2019-04-24 22:17:22'),
	(153,'chat','客服郭大爷','90f6d632','http://v1.stkf.test/static/images/kf_default_avatar?ver=1556115147','游客_6199','0ad865ca4bdef9cbbddbf0b708c3bfda','','那就886',2,'2019-04-24 22:17:28','2019-04-24 22:17:28');

/*!40000 ALTER TABLE `chat_history` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table guest
# ------------------------------------------------------------

DROP TABLE IF EXISTS `guest`;

CREATE TABLE `guest` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `f_name` varchar(32) NOT NULL DEFAULT '0' COMMENT '发送方昵称',
  `f_code` varchar(32) NOT NULL DEFAULT '' COMMENT '发送方code',
  `f_avatar` varchar(250) NOT NULL DEFAULT '' COMMENT '发送方头像',
  `f_clientid` varchar(32) NOT NULL DEFAULT '' COMMENT 'ws服务分配的客户端id',
  `kf_code` varchar(32) NOT NULL DEFAULT '' COMMENT '服务的客服sn',
  `online_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '在线状态 1：在线 0：不在线',
  `updated_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_f_code` (`f_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='服务过的客户或者来到我们页面的客户';

LOCK TABLES `guest` WRITE;
/*!40000 ALTER TABLE `guest` DISABLE KEYS */;

INSERT INTO `guest` (`id`, `f_name`, `f_code`, `f_avatar`, `f_clientid`, `kf_code`, `online_status`, `updated_time`, `created_time`)
VALUES
	(1,'访客','0ad865ca4bdef9cbbddbf0b708c3bfda','http://v1.stkf.test/static/images/kf_default_avatar?ver=1556113782','7f0000010fa200000017','90f6d632',0,'2019-04-25 00:07:17','2019-04-24 21:49:42'),
	(2,'访客','eb6be14ec4e483ce7b4d8ce57fc2bbf3','http://v1.stkf.test/static/images/kf_default_avatar?ver=1556116035','7f0000010fa100000002','',0,'2019-04-24 22:27:24','2019-04-24 22:27:15');

/*!40000 ALTER TABLE `guest` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table guest_queue
# ------------------------------------------------------------

DROP TABLE IF EXISTS `guest_queue`;

CREATE TABLE `guest_queue` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `f_name` varchar(32) NOT NULL DEFAULT '0' COMMENT '发送方昵称',
  `f_code` varchar(32) NOT NULL DEFAULT '' COMMENT '发送方code',
  `f_avatar` varchar(250) NOT NULL DEFAULT '' COMMENT '发送方头像',
  `f_clientid` varchar(32) NOT NULL DEFAULT '' COMMENT 'ws服务分配的客户端id',
  `updated_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_merchant_id` (`f_code`),
  KEY `idx_f_client_id` (`f_clientid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='客户待服务';



# Dump of table guest_service_log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `guest_service_log`;

CREATE TABLE `guest_service_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `guest_code` varchar(32) NOT NULL DEFAULT '' COMMENT '游客code',
  `guest_name` varchar(32) NOT NULL COMMENT '游客昵称',
  `guest_avatar` varchar(255) NOT NULL DEFAULT '' COMMENT '游客头像',
  `guest_client_id` varchar(64) NOT NULL DEFAULT '' COMMENT '游客客服系统分配的客户端id',
  `guest_ip` varchar(20) NOT NULL DEFAULT '' COMMENT '游客的ip',
  `kf_code` varchar(32) NOT NULL DEFAULT '' COMMENT '客服code',
  `begin_time` datetime DEFAULT NULL COMMENT '服务开始时间',
  `end_time` datetime DEFAULT NULL COMMENT '服务结束时间',
  `updated_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `idx_created_time` (`created_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='服务客户历史表';

LOCK TABLES `guest_service_log` WRITE;
/*!40000 ALTER TABLE `guest_service_log` DISABLE KEYS */;

INSERT INTO `guest_service_log` (`id`, `guest_code`, `guest_name`, `guest_avatar`, `guest_client_id`, `guest_ip`, `kf_code`, `begin_time`, `end_time`, `updated_time`, `created_time`)
VALUES
	(129,'0ad865ca4bdef9cbbddbf0b708c3bfda','游客_8242','http://v1.stkf.test/static/images/kf_default_avatar?ver=1556114858','7f0000010fa000000001','192.168.22.1','90f6d632','2019-04-24 22:07:39','2019-04-24 22:08:04','2019-04-24 22:08:04','2019-04-24 22:07:39'),
	(130,'0ad865ca4bdef9cbbddbf0b708c3bfda','游客_6199','http://v1.stkf.test/static/images/kf_default_avatar?ver=1556115149','7f0000010fa100000001','192.168.22.1','90f6d632','2019-04-24 22:12:30','2019-04-24 22:13:08','2019-04-24 22:13:08','2019-04-24 22:12:30'),
	(131,'0ad865ca4bdef9cbbddbf0b708c3bfda','游客_4490','http://v1.stkf.test/static/images/kf_default_avatar?ver=1556115421','7f0000010fa000000003','192.168.22.1','90f6d632','2019-04-24 22:17:02','2019-04-24 22:17:36','2019-04-24 22:17:36','2019-04-24 22:17:02'),
	(132,'0ad865ca4bdef9cbbddbf0b708c3bfda','游客_7287','http://v1.stkf.test/static/images/kf_default_avatar?ver=1556115461','7f0000010fa000000004','192.168.22.1','90f6d632','2019-04-24 22:17:42','2019-04-24 22:17:44','2019-04-24 22:17:44','2019-04-24 22:17:42');

/*!40000 ALTER TABLE `guest_service_log` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table guest_servicing
# ------------------------------------------------------------

DROP TABLE IF EXISTS `guest_servicing`;

CREATE TABLE `guest_servicing` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `guest_code` varchar(32) NOT NULL DEFAULT '' COMMENT '游客code',
  `guest_name` varchar(32) NOT NULL COMMENT '游客昵称',
  `guest_ip` varchar(20) NOT NULL COMMENT '游客ip',
  `guest_avatar` varchar(255) NOT NULL DEFAULT '' COMMENT '游客头像',
  `guest_client_id` varchar(64) NOT NULL DEFAULT '' COMMENT '游客客服系统分配的客户端id',
  `kf_code` varchar(32) NOT NULL DEFAULT '' COMMENT '客服code',
  `service_log_id` int(11) NOT NULL DEFAULT '0' COMMENT '服务日志id',
  `updated_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_merchant_guest_code` (`guest_code`),
  KEY `idx_kf_code` (`kf_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='正在服务的客户';



# Dump of table guest_trace
# ------------------------------------------------------------

DROP TABLE IF EXISTS `guest_trace`;

CREATE TABLE `guest_trace` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cmd` varchar(20) NOT NULL DEFAULT '' COMMENT '动作',
  `f_code` varchar(64) NOT NULL DEFAULT '' COMMENT '游客的uuid',
  `f_clientid` varchar(32) NOT NULL DEFAULT '' COMMENT '游客ws的clientid',
  `ua` varchar(500) NOT NULL DEFAULT '' COMMENT '浏览器UA',
  `ip` varchar(32) NOT NULL DEFAULT '' COMMENT '游客ip',
  `referer` varchar(1500) NOT NULL DEFAULT '' COMMENT '游客referer',
  `talk_url` varchar(500) NOT NULL DEFAULT '' COMMENT '浏览页面',
  `source` varchar(100) NOT NULL DEFAULT '' COMMENT '来源域名',
  `client_browser` varchar(50) NOT NULL DEFAULT '' COMMENT '浏览器',
  `client_browser_version` varchar(40) NOT NULL DEFAULT '' COMMENT '浏览器版本号',
  `client_os` varchar(20) NOT NULL DEFAULT '' COMMENT '客户端操作系统',
  `client_os_version` varchar(40) NOT NULL DEFAULT '' COMMENT '操作系统版本号',
  `client_device` varchar(20) NOT NULL DEFAULT '' COMMENT '客户端设备',
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `idx_created_time` (`created_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `guest_trace` WRITE;
/*!40000 ALTER TABLE `guest_trace` DISABLE KEYS */;

INSERT INTO `guest_trace` (`id`, `cmd`, `f_code`, `f_clientid`, `ua`, `ip`, `referer`, `talk_url`, `source`, `client_browser`, `client_browser_version`, `client_os`, `client_os_version`, `client_device`, `created_time`)
VALUES
	(2337,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 21:46:59'),
	(2338,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 21:49:42'),
	(2339,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 21:51:43'),
	(2340,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 21:52:31'),
	(2341,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 21:54:31'),
	(2342,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 21:54:36'),
	(2343,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 21:56:57'),
	(2344,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:01:06'),
	(2345,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:06:16'),
	(2346,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:07:09'),
	(2347,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:07:15'),
	(2348,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:07:39'),
	(2349,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:08:04'),
	(2350,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:10:17'),
	(2351,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:12:29'),
	(2352,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:13:14'),
	(2353,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:17:02'),
	(2354,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:17:42'),
	(2355,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:17:44'),
	(2356,'guest_in','eb6be14ec4e483ce7b4d8ce57fc2bbf3','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10.13; rv:66.0) Gecko/20100101 Firefox/66.0','192.168.22.1','http://v1.stkf.test/user/login','http://v1.stkf.test/','v1.stkf.test','Firefox','66.0','OS X','10.13','pc','2019-04-24 22:27:15'),
	(2357,'guest_in','eb6be14ec4e483ce7b4d8ce57fc2bbf3','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10.13; rv:66.0) Gecko/20100101 Firefox/66.0','192.168.22.1','http://v1.stkf.test/user/login','http://v1.stkf.test/','v1.stkf.test','Firefox','66.0','OS X','10.13','pc','2019-04-24 22:27:16'),
	(2358,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:29:43'),
	(2359,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:30:59'),
	(2360,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:31:02'),
	(2361,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:31:03'),
	(2362,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:31:06'),
	(2363,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:31:08'),
	(2364,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:31:11'),
	(2365,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:31:20'),
	(2366,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:31:30'),
	(2367,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:31:44'),
	(2368,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:31:51'),
	(2369,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:31:54'),
	(2370,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:31:58'),
	(2371,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:32:54'),
	(2372,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:33:03'),
	(2373,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:36:37'),
	(2374,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:39:37'),
	(2375,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:39:57'),
	(2376,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:40:17'),
	(2377,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:41:23'),
	(2378,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:41:29'),
	(2379,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:41:45'),
	(2380,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:42:10'),
	(2381,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:44:19'),
	(2382,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:44:35'),
	(2383,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:44:48'),
	(2384,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:44:51'),
	(2385,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:44:58'),
	(2386,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:52:35'),
	(2387,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:52:35'),
	(2388,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:53:49'),
	(2389,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:55:00'),
	(2390,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:55:09'),
	(2391,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:56:14'),
	(2392,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 22:56:24'),
	(2393,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:05:29'),
	(2394,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:05:30'),
	(2395,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:05:37'),
	(2396,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:05:38'),
	(2397,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:05:38'),
	(2398,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:05:40'),
	(2399,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:05:51'),
	(2400,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:06:32'),
	(2401,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:08:23'),
	(2402,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:11:48'),
	(2403,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:11:49'),
	(2404,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:13:25'),
	(2405,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:13:47'),
	(2406,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:14:41'),
	(2407,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:14:54'),
	(2408,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:15:07'),
	(2409,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:16:43'),
	(2410,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:21:30'),
	(2411,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:21:47'),
	(2412,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:26:50'),
	(2413,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:27:04'),
	(2414,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:27:25'),
	(2415,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:28:07'),
	(2416,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:29:01'),
	(2417,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:29:34'),
	(2418,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:30:04'),
	(2419,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:30:20'),
	(2420,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:30:47'),
	(2421,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:32:06'),
	(2422,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:32:17'),
	(2423,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:34:12'),
	(2424,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:34:14'),
	(2425,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:34:15'),
	(2426,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:34:15'),
	(2427,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:34:28'),
	(2428,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:34:28'),
	(2429,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:34:28'),
	(2430,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:34:28'),
	(2431,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:35:06'),
	(2432,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:35:24'),
	(2433,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:37:25'),
	(2434,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:37:34'),
	(2435,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:38:10'),
	(2436,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:38:18'),
	(2437,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:38:45'),
	(2438,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:39:15'),
	(2439,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:39:17'),
	(2440,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:39:25'),
	(2441,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:39:50'),
	(2442,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:40:28'),
	(2443,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:40:43'),
	(2444,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:41:17'),
	(2445,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:41:44'),
	(2446,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:41:44'),
	(2447,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:43:42'),
	(2448,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:44:37'),
	(2449,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:52:45'),
	(2450,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:52:47'),
	(2451,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:52:52'),
	(2452,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:53:14'),
	(2453,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-24 23:53:41'),
	(2454,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-25 00:04:10'),
	(2455,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-25 00:04:48'),
	(2456,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-25 00:05:02'),
	(2457,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-25 00:06:21'),
	(2458,'guest_in','0ad865ca4bdef9cbbddbf0b708c3bfda','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36','192.168.22.1','http://v1.stkf.test/merchant/stat/browser','http://v1.stkf.test/','v1.stkf.test','Chrome','73.0.3683.103','OS X','10.13.4','pc','2019-04-25 00:07:11');

/*!40000 ALTER TABLE `guest_trace` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table merchant
# ------------------------------------------------------------

DROP TABLE IF EXISTS `merchant`;

CREATE TABLE `merchant` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `login_name` varchar(30) NOT NULL DEFAULT '' COMMENT '登录用户名',
  `login_pwd` varchar(32) NOT NULL DEFAULT '' COMMENT '登录密码',
  `login_salt` varchar(32) NOT NULL DEFAULT '' COMMENT '随机加密字符串',
  `sn` varchar(10) NOT NULL DEFAULT '' COMMENT '会员唯一编号',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1：有效 0：无效',
  `updated_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_sn` (`sn`),
  KEY `uk_login_name` (`login_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商户表';

LOCK TABLES `merchant` WRITE;
/*!40000 ALTER TABLE `merchant` DISABLE KEYS */;

INSERT INTO `merchant` (`id`, `login_name`, `login_pwd`, `login_salt`, `sn`, `status`, `updated_time`, `created_time`)
VALUES
	(1,'54php.cn','88a1b06cdacc34317141ff427f24a4d0','zj6v@vgRE2sdqdQl','556d8bf3',1,'2019-04-24 15:49:59','2019-04-10 22:29:50');

/*!40000 ALTER TABLE `merchant` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table merchant_staff
# ------------------------------------------------------------

DROP TABLE IF EXISTS `merchant_staff`;

CREATE TABLE `merchant_staff` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nickname` varchar(30) NOT NULL DEFAULT '' COMMENT '昵称',
  `sn` varchar(32) NOT NULL DEFAULT '' COMMENT '标识',
  `avatar` varchar(255) NOT NULL DEFAULT '' COMMENT '头像',
  `login_name` varchar(20) NOT NULL DEFAULT '' COMMENT '登录用户名',
  `login_pwd` varchar(32) NOT NULL DEFAULT '' COMMENT '登录密码',
  `login_salt` varchar(32) NOT NULL DEFAULT '' COMMENT '登录密码随机码',
  `status` tinyint(3) NOT NULL DEFAULT '1' COMMENT '状态',
  `online_status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '在线状态',
  `last_active_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最后活跃时间',
  `updated_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后更新时间',
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '插入时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_merchant_id_login_name` (`login_name`),
  KEY `uk_sn` (`sn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='商服员工客服';

LOCK TABLES `merchant_staff` WRITE;
/*!40000 ALTER TABLE `merchant_staff` DISABLE KEYS */;

INSERT INTO `merchant_staff` (`id`, `nickname`, `sn`, `avatar`, `login_name`, `login_pwd`, `login_salt`, `status`, `online_status`, `last_active_time`, `updated_time`, `created_time`)
VALUES
	(3,'客服郭大爷','90f6d632','kf_default_avatar','54php.cn','65c7c4859c1e29190c752b31732100ce','Yis7@8i@NRK2EgKM',1,0,'2019-04-24 22:36:29','2019-04-24 22:36:29','2019-04-24 16:51:31');

/*!40000 ALTER TABLE `merchant_staff` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table stat_daily_access_source
# ------------------------------------------------------------

DROP TABLE IF EXISTS `stat_daily_access_source`;

CREATE TABLE `stat_daily_access_source` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL COMMENT '日期',
  `source` varchar(50) NOT NULL COMMENT '来源',
  `total_number` int(11) NOT NULL DEFAULT '0' COMMENT '来源总次数',
  `updated_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后一次更新时间',
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_date_source` (`date`,`source`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商户访问来源日统计';

LOCK TABLES `stat_daily_access_source` WRITE;
/*!40000 ALTER TABLE `stat_daily_access_source` DISABLE KEYS */;

INSERT INTO `stat_daily_access_source` (`id`, `date`, `source`, `total_number`, `updated_time`, `created_time`)
VALUES
	(100,sysdate(),'v1.stkf.test',21,'2019-04-24 22:27:18','2019-04-24 22:26:23');

/*!40000 ALTER TABLE `stat_daily_access_source` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table stat_daily_browser
# ------------------------------------------------------------

DROP TABLE IF EXISTS `stat_daily_browser`;

CREATE TABLE `stat_daily_browser` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL COMMENT '日期',
  `client_browser` varchar(50) NOT NULL DEFAULT '' COMMENT '浏览器名称',
  `total_number` int(11) NOT NULL DEFAULT '0' COMMENT '总次数',
  `updated_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后一次更新时间',
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '插入时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_date_browser` (`date`,`client_browser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商户浏览器日统计';

LOCK TABLES `stat_daily_browser` WRITE;
/*!40000 ALTER TABLE `stat_daily_browser` DISABLE KEYS */;

INSERT INTO `stat_daily_browser` (`id`, `date`, `client_browser`, `total_number`, `updated_time`, `created_time`)
VALUES
	(72,sysdate(),'Chrome',19,'2019-04-24 22:27:18','2019-04-24 22:26:23'),
	(73,sysdate(),'Firefox',2,'2019-04-24 22:27:18','2019-04-24 22:27:18');

/*!40000 ALTER TABLE `stat_daily_browser` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- 主机: localhost
-- 生成日期: 2012 年 09 月 08 日 20:41
-- 服务器版本: 5.0.51
-- PHP 版本: 5.4.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- 数据库: `imuyunco_muyundb`
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `tbl_a_vip`
-- 

CREATE TABLE `tbl_a_vip` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(7) NOT NULL,
  `growthline` mediumint(9) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `tbl_a_vip`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `tbl_c_article`
-- 

CREATE TABLE `tbl_c_article` (
  `id` int(11) NOT NULL auto_increment,
  `fieldcat_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `filename` varchar(127) default NULL,
  `wordcount` int(11) NOT NULL,
  `srclang_id` int(11) NOT NULL,
  `tgtlang_id` int(11) NOT NULL,
  `starttime` datetime default NULL,
  `comptime` datetime default NULL,
  `edittime` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- 导出表中的数据 `tbl_c_article`
-- 

INSERT INTO `tbl_c_article` VALUES (1, 0, 1, NULL, 10, 0, 1, '2012-09-08 19:01:27', '2012-09-08 19:01:51', '2012-09-08 11:46:35');
INSERT INTO `tbl_c_article` VALUES (2, 0, 2, NULL, 10, 0, 1, NULL, NULL, '2012-09-08 15:48:35');

-- --------------------------------------------------------

-- 
-- 表的结构 `tbl_c_comm`
-- 

CREATE TABLE `tbl_c_comm` (
  `id` int(11) NOT NULL auto_increment,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `msg` varchar(255) NOT NULL,
  `sendtime` datetime NOT NULL,
  `read` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `tbl_c_comm`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `tbl_c_complaint`
-- 

CREATE TABLE `tbl_c_complaint` (
  `order_id` int(11) NOT NULL,
  `remark` text NOT NULL,
  `time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- 导出表中的数据 `tbl_c_complaint`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `tbl_c_consume`
-- 

CREATE TABLE `tbl_c_consume` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `content` varchar(31) NOT NULL,
  `amount` varchar(31) NOT NULL,
  `audit` int(11) NOT NULL default '0',
  `edittime` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- 
-- 导出表中的数据 `tbl_c_consume`
-- 

INSERT INTO `tbl_c_consume` VALUES (1, 100001, 'Web Consume', '3', 1, '2012-09-08 15:42:41');
INSERT INTO `tbl_c_consume` VALUES (2, 100001, 'Text Spending', '-2', 1, '2012-09-08 15:46:09');
INSERT INTO `tbl_c_consume` VALUES (3, 100001, 'Web Consume', '200', 0, '2012-09-08 16:38:30');
INSERT INTO `tbl_c_consume` VALUES (4, 100001, 'Web Consume', '200', 1, '2012-09-08 16:38:31');
INSERT INTO `tbl_c_consume` VALUES (5, 100001, 'Text Spending', '-2', 1, '2012-09-08 16:39:14');

-- --------------------------------------------------------

-- 
-- 表的结构 `tbl_c_coupon`
-- 

CREATE TABLE `tbl_c_coupon` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(15) NOT NULL,
  `discount` double NOT NULL,
  `referral` int(11) NOT NULL,
  `present` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `tbl_c_coupon`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `tbl_c_evaluation`
-- 

CREATE TABLE `tbl_c_evaluation` (
  `user_id` int(11) NOT NULL,
  `valuator_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `evaluation` text NOT NULL,
  `score` int(11) NOT NULL,
  `evaluatetime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- 导出表中的数据 `tbl_c_evaluation`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `tbl_c_express`
-- 

CREATE TABLE `tbl_c_express` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(15) NOT NULL,
  `price` int(11) NOT NULL,
  `trackingnum` varchar(31) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `tbl_c_express`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `tbl_c_group`
-- 

CREATE TABLE `tbl_c_group` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `tbl_c_group`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `tbl_c_invoice`
-- 

CREATE TABLE `tbl_c_invoice` (
  `id` int(11) NOT NULL auto_increment,
  `org` varchar(31) NOT NULL,
  `titile` varchar(31) NOT NULL,
  `content_id` int(11) NOT NULL,
  `applytime` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `tbl_c_invoice`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `tbl_c_msg`
-- 

CREATE TABLE `tbl_c_msg` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(15) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(31) NOT NULL,
  `theme` varchar(31) NOT NULL,
  `content` text NOT NULL,
  `service_id` int(11) default NULL,
  `remark` text NOT NULL,
  `finishtime` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `tbl_c_msg`
-- 

INSERT INTO `tbl_c_msg` VALUES (1, '钟嘉聪', '13480205903', 'zhongjiacong@gmail.com', '我有建议', '我的建议是...', 100003, '你去答案饭吧', '2012-08-15 17:27:52');

-- --------------------------------------------------------

-- 
-- 表的结构 `tbl_c_order`
-- 

CREATE TABLE `tbl_c_order` (
  `id` int(11) NOT NULL auto_increment,
  `subject` varchar(31) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `express_id` int(11) NOT NULL,
  `deadline` datetime NOT NULL,
  `audit` int(11) NOT NULL default '0',
  `submittime` datetime NOT NULL,
  `paytime` datetime default NULL,
  `deliverytime` datetime default NULL,
  `remark` text NOT NULL,
  `orderstate_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- 导出表中的数据 `tbl_c_order`
-- 

INSERT INTO `tbl_c_order` VALUES (1, '第一单', 100001, 0, 0, '2012-09-08 11:46:35', 1, '2012-09-08 11:46:35', '2012-09-08 15:46:09', '2012-09-08 19:01:51', '试试', 0);
INSERT INTO `tbl_c_order` VALUES (2, '第二单', 100001, 0, 0, '2012-09-08 15:48:35', 0, '2012-09-08 15:48:35', '2012-09-08 16:39:14', NULL, '试试', 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `tbl_c_recharge`
-- 

CREATE TABLE `tbl_c_recharge` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `way` int(11) NOT NULL default '0',
  `amount` varchar(31) NOT NULL,
  `audit` int(11) NOT NULL default '0',
  `edittime` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- 
-- 导出表中的数据 `tbl_c_recharge`
-- 

INSERT INTO `tbl_c_recharge` VALUES (1, 100001, 0, '100', 1, '2012-08-13 07:43:22');
INSERT INTO `tbl_c_recharge` VALUES (2, 100001, 0, '200', 1, '2012-08-13 07:45:32');
INSERT INTO `tbl_c_recharge` VALUES (3, 100001, 0, '200', 0, '2012-08-13 07:45:34');
INSERT INTO `tbl_c_recharge` VALUES (4, 100001, 2, '-1.2', 1, '2012-08-13 07:46:36');
INSERT INTO `tbl_c_recharge` VALUES (5, 100001, 2, '-1.08', 1, '2012-08-13 14:59:39');
INSERT INTO `tbl_c_recharge` VALUES (6, 100001, 2, '-0.96', 1, '2012-08-13 16:12:32');
INSERT INTO `tbl_c_recharge` VALUES (7, 100001, 2, '0', 1, '2012-08-13 16:37:20');
INSERT INTO `tbl_c_recharge` VALUES (8, 100001, 2, '0', 1, '2012-08-13 16:41:04');
INSERT INTO `tbl_c_recharge` VALUES (9, 100001, 2, '0', 1, '2012-08-13 16:50:34');
INSERT INTO `tbl_c_recharge` VALUES (10, 100002, 0, '34', 0, '2012-08-15 13:42:59');
INSERT INTO `tbl_c_recharge` VALUES (11, 100016, 2, '0', 1, '2012-08-15 17:16:17');
INSERT INTO `tbl_c_recharge` VALUES (12, 100001, 0, '200', 0, '2012-08-15 19:17:50');
INSERT INTO `tbl_c_recharge` VALUES (13, 100008, 2, '-0.84', 1, '2012-08-17 21:59:36');

-- --------------------------------------------------------

-- 
-- 表的结构 `tbl_c_record`
-- 

CREATE TABLE `tbl_c_record` (
  `id` int(11) NOT NULL auto_increment,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `trans_id` int(11) default NULL,
  `ori_lang` int(11) NOT NULL,
  `tgt_lang` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime default NULL,
  `sender_visible` int(11) DEFAULT NULL,
  `receiver_visible` int(11) DEFAULT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `tbl_c_record`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `tbl_c_sentence`
-- 

CREATE TABLE `tbl_c_sentence` (
  `id` int(11) NOT NULL auto_increment,
  `interpreter_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `sentencenum` int(11) NOT NULL,
  `original` text NOT NULL,
  `translation` text NOT NULL,
  `edittime` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- 导出表中的数据 `tbl_c_sentence`
-- 

INSERT INTO `tbl_c_sentence` VALUES (1, 100012, 1, 0, '测试一下，应该不错。', 'test, must be perfect.', '2012-09-08 11:46:35');
INSERT INTO `tbl_c_sentence` VALUES (2, 0, 2, 0, '试试hi分街道口接口肥大', '', '2012-09-08 15:48:35');

-- --------------------------------------------------------

-- 
-- 表的结构 `tbl_c_term`
-- 

CREATE TABLE `tbl_c_term` (
  `id` int(11) NOT NULL auto_increment,
  `interpreter_id` int(11) NOT NULL,
  `sentence_id` int(11) NOT NULL,
  `termnum` int(11) NOT NULL,
  `original` text NOT NULL,
  `translation` text NOT NULL,
  `edittime` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `tbl_c_term`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `tbl_c_user`
-- 

CREATE TABLE `tbl_c_user` (
  `id` int(11) NOT NULL auto_increment,
  `accountcat_id` int(11) NOT NULL default '0',
  `privilege_id` int(11) NOT NULL default '0',
  `email` varchar(31) NOT NULL,
  `loginpassword` varchar(40) NOT NULL,
  `paypassword` varchar(40) NOT NULL,
  `nickname` varchar(31) NOT NULL,
  `realname` varchar(15) NOT NULL,
  `gender_id` int(11) NOT NULL default '0',
  `birthday` date NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `introduce` text NOT NULL,
  `address` text NOT NULL,
  `postcode` varchar(6) NOT NULL,
  `enabled` int(11) NOT NULL default '0',
  `verifycode` varchar(20) NOT NULL,
  `registertime` datetime NOT NULL,
  `lastlogintime` datetime NOT NULL,
  `pushtoken` varchar(64) default NULL,
  `session_id` varchar(160) default NULL,
  `company` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100032 ;

-- 
-- 导出表中的数据 `tbl_c_user`
-- 

INSERT INTO `tbl_c_user` VALUES (100001, 0, 5, 'zhongjiacong@gmail.com', '10470c3b4b1fed12c3baac014be15fac67c6e815', '', 'zhongjiacong', '', 2, '1970-01-01', '13480205903', '', '', '', '', 1, '', '2012-07-09 21:13:50', '2012-09-08 19:02:10', '', '2_MX4xNjkzNzg4Mn5-VGh1IEF1ZyAxNiAwMzoyNjoxNSBQRFQgMjAxMn4wLjAzNDIwNDMwNH4', '');
INSERT INTO `tbl_c_user` VALUES (100002, 0, 0, '184492896@qq.com', '10470c3b4b1fed12c3baac014be15fac67c6e815', '', '184492896', '', 0, '0000-00-00', '110', '', '', '', '', 1, '', '2012-07-09 23:01:28', '2012-08-19 13:57:28', NULL, '1_MX4xNjkzNzg4Mn5-V2VkIEF1ZyAxNSAyMjo1ODowMCBQRFQgMjAxMn4wLjQzMTMyNDU0fg', '');
INSERT INTO `tbl_c_user` VALUES (100003, 0, 1, 'service@muyun.com', '53ae2fc6cf0b62b3ec601f8e5e8187629137794f', '', 'service', '', 0, '0000-00-00', '13480205903', '', '', '', '', 1, '', '2012-07-10 14:07:42', '2012-08-15 17:26:47', NULL, NULL, '');
INSERT INTO `tbl_c_user` VALUES (100004, 0, 0, '29519260@qq.com', '0a8ed381d3e00b45aa418ad317b08ad0286384e2', '', '29519260', '', 0, '0000-00-00', '13824436126', '', '', '', '', 1, '', '2012-07-10 17:09:19', '2012-07-10 17:09:19', NULL, NULL, '');
INSERT INTO `tbl_c_user` VALUES (100005, 0, 0, 'ciiry@live.cn', '15cfb8c5208a294c905798906259f24d019473c3', '', 'ciiry', '', 0, '0000-00-00', '13552134931', '', '', '', '', 1, 'cd98f00b204e9800', '2012-07-10 17:11:37', '2012-07-10 17:11:37', NULL, NULL, '');
INSERT INTO `tbl_c_user` VALUES (100006, 0, 0, 'cydhx@163.com', '15e56bc016048b50323204244ef2125cc411d904', '', 'cydhx', '', 0, '0000-00-00', '15172491806', '', '', '', '', 1, 'ecf8427e', '2012-07-10 17:21:01', '2012-07-10 17:21:01', NULL, NULL, '');
INSERT INTO `tbl_c_user` VALUES (100007, 0, 0, 'taoxiance@dxwsoft.com', '952d37e87ad687178d9ddc6ee3a03c92bf1f6549', '', 'taoxiance', '', 0, '0000-00-00', '15904262199', '', '', '', '', 1, '0998ecf8427e', '2012-07-10 17:33:01', '2012-07-10 17:33:01', NULL, NULL, '');
INSERT INTO `tbl_c_user` VALUES (100008, 0, 2, '384114771@qq.com', '10470c3b4b1fed12c3baac014be15fac67c6e815', '', '384114771', '', 0, '0000-00-00', '13450228963', '', '', '', '', 1, '4e9800998ecf8427e', '2012-07-16 22:25:31', '2012-08-17 21:58:26', NULL, NULL, '');
INSERT INTO `tbl_c_user` VALUES (100011, 0, 0, 'iddmbr@gmail.com', '3299ae4ae1db5099a9350df9344da5cefe4a9a1a', '', 'iddmbr', '', 0, '0000-00-00', '15902053571', '', '', '', '', 1, 'a6cab4a563d4dff3f52d', '2012-08-12 22:22:49', '2012-08-17 12:41:12', '', '1_MX4xNjkzNzg4Mn43NC4xMjUuMTc4LjMwflRodSBBdWcgMTYgMDQ6MDQ6MzEgUERUIDIwMTJ-MC4xMzIyNDk0N34', '');
INSERT INTO `tbl_c_user` VALUES (100012, 0, 2, 'zhongjiacong@outlook.com', '53ae2fc6cf0b62b3ec601f8e5e8187629137794f', '', 'zhongjiacong', '', 0, '1970-01-01', '13480205903', '', '', '', '', 1, 'f7a7e73ec83fc9d600d7', '2012-08-12 22:23:10', '2012-09-08 17:41:31', '', '1_MX4xNjkzNzg4Mn5-VGh1IEF1ZyAxNiAwMDo0MTozOCBQRFQgMjAxMn4wLjUyMjYxMDh-', '');
INSERT INTO `tbl_c_user` VALUES (100014, 0, 0, 'lancy1014@gmail.com', 'b3fb23062beff9a821890d6e92110c60f1e7f8d8', '', 'lancy1014', '', 0, '0000-00-00', '15902063569', '', '', '', '', 1, 'a70cc2a16994e75c4', '2012-08-14 21:13:50', '2012-08-17 17:39:07', '54ff7879bb43ea083f67208151321046e0641ce21f0d028f67058863e25af3f4', '1_MX4xNjkzNzg4Mn4xMTYuMjUzLjgxLjIxflR1ZSBBdWcgMTQgMTA6MzM6MTAgUERUIDIwMTJ-MC43ODQ4MDA2fg', '');
INSERT INTO `tbl_c_user` VALUES (100015, 0, 0, '184492896@sina.com', '10470c3b4b1fed12c3baac014be15fac67c6e815', '', '184492896', '', 0, '0000-00-00', '13430294454', '', '', '', '', 1, 'cf140c39cf28b7a', '2012-08-15 13:53:11', '2012-08-15 13:53:11', '', NULL, '');
INSERT INTO `tbl_c_user` VALUES (100016, 0, 5, 'eric.gzmy@foxmail.com', '4a127a71fefe60d41f947d0a70c459fbd49f139d', '', 'eric.gzmy', '', 0, '1970-01-01', '13580392452', '', '', '', '', 1, '978063105baa8aa3d7df', '2012-08-15 17:11:20', '2012-08-16 16:49:59', NULL, '2_MX4xNjkzNzg4Mn4xMTMuMTA4LjEzMy40Mn5UaHUgQXVnIDE2IDAzOjQ2OjEyIFBEVCAyMDEyfjAuMDEyNzk0ODUyfg', '');
INSERT INTO `tbl_c_user` VALUES (100017, 0, 0, 'zhongjiacong@126.com', '53ae2fc6cf0b62b3ec601f8e5e8187629137794f', '', 'zhongjiacong', '', 0, '0000-00-00', '13480205903', '', '', '', '', 1, 'd4c6d9d1e2d0ce63c11d', '2012-08-15 19:14:13', '2012-08-15 19:14:55', NULL, NULL, '');
INSERT INTO `tbl_c_user` VALUES (100019, 0, 0, 'lijhong3@mail2.sysu.edu.cn', '10470c3b4b1fed12c3baac014be15fac67c6e815', '', 'lijhong3', '', 0, '0000-00-00', '13580523356', '', '', '', '', 1, '4f72dbef610ef4782a0b', '2012-08-16 18:23:46', '2012-08-17 14:26:50', NULL, '2_MX4xNjkzNzg4Mn5-VGh1IEF1ZyAxNiAwNDowODoxNSBQRFQgMjAxMn4wLjI4NzQyMzl-', '');
INSERT INTO `tbl_c_user` VALUES (100020, 0, 0, 'omegaleedh@gmail.com', '10470c3b4b1fed12c3baac014be15fac67c6e815', '', 'omegaleedh', '', 0, '0000-00-00', '13580523356', '', '', '', '', 1, '56c12ce3a21d8017c45e', '2012-08-16 18:27:33', '2012-08-16 18:29:18', NULL, NULL, '');
INSERT INTO `tbl_c_user` VALUES (100026, 0, 0, 'zhongjiacong@000.com', '10470c3b4b1fed12c3baac014be15fac67c6e815', '', 'zhongjiacong', '', 0, '0000-00-00', '13480205903', '', '', '', '', 0, '024f2c608d7bc95fe504', '2012-09-08 20:01:30', '2012-09-08 20:01:30', NULL, NULL, '');
INSERT INTO `tbl_c_user` VALUES (100031, 0, 0, '172367155@qq.com', '10470c3b4b1fed12c3baac014be15fac67c6e815', '', '172367155', '', 0, '0000-00-00', '13480205903', '', '', '', '', 1, '5b66c85829e20de06e34', '2012-09-08 20:32:02', '2012-09-08 20:32:11', NULL, NULL, '');

-- --------------------------------------------------------

-- 
-- 表的结构 `tbl_i_sysintro`
-- 

CREATE TABLE `tbl_i_sysintro` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(15) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `tbl_i_sysintro`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `tbl_u_couponbag`
-- 

CREATE TABLE `tbl_u_couponbag` (
  `user_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `gettime` datetime NOT NULL,
  `usetime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- 导出表中的数据 `tbl_u_couponbag`
-- 

INSERT INTO `tbl_u_couponbag` VALUES (4, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- 表的结构 `tbl_u_fieldclassify`
-- 

CREATE TABLE `tbl_u_fieldclassify` (
  `classifyobject_id` int(11) NOT NULL,
  `fieldcategory_id` int(11) NOT NULL,
  `interpreter_id` int(11) NOT NULL,
  `price` varchar(31) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- 导出表中的数据 `tbl_u_fieldclassify`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `tbl_u_friend`
-- 

CREATE TABLE `tbl_u_friend` (
  `id` int(11) NOT NULL auto_increment,
  `fans_id` int(11) NOT NULL,
  `follow_id` int(11) NOT NULL,
  `note` text NOT NULL,
  `group_id` int(11) NOT NULL default '0',
  `favor` int(11) NOT NULL default '0',
  `addtime` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `fansfollow` (`fans_id`,`follow_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- 
-- 导出表中的数据 `tbl_u_friend`
-- 

INSERT INTO `tbl_u_friend` VALUES (1, 100011, 100011, 0, 0, '2012-08-14 00:00:00');
INSERT INTO `tbl_u_friend` VALUES (2, 100011, 100014, 0, 0, '2012-08-14 00:00:00');
INSERT INTO `tbl_u_friend` VALUES (3, 100014, 100011, 0, 0, '2012-08-14 00:00:00');
INSERT INTO `tbl_u_friend` VALUES (4, 100014, 100014, 0, 0, '2012-08-14 00:00:00');
INSERT INTO `tbl_u_friend` VALUES (5, 100014, 100013, 0, 0, '2012-08-14 00:00:00');
INSERT INTO `tbl_u_friend` VALUES (16, 100001, 100013, 0, 0, '2012-08-16 21:01:34');
INSERT INTO `tbl_u_friend` VALUES (8, 100013, 100001, 0, 0, '2012-08-15 00:00:00');
INSERT INTO `tbl_u_friend` VALUES (17, 100001, 100003, 0, 0, '2012-08-16 21:03:56');
INSERT INTO `tbl_u_friend` VALUES (10, 100016, 100001, 0, 0, '2012-08-15 00:00:00');
INSERT INTO `tbl_u_friend` VALUES (12, 100013, 100016, 0, 0, '2012-08-15 00:00:00');
INSERT INTO `tbl_u_friend` VALUES (14, 100011, 100013, 0, 0, '2012-08-16 00:00:00');
INSERT INTO `tbl_u_friend` VALUES (15, 100011, 100016, 0, 0, '2012-08-16 00:00:00');

-- --------------------------------------------------------

-- 
-- 表的结构 `tbl_u_spreadtable`
-- 

CREATE TABLE `tbl_u_spreadtable` (
  `article_id` int(11) NOT NULL,
  `price` varchar(31) NOT NULL,
  `translator_id` int(11) default NULL,
  UNIQUE KEY `articleprice` (`article_id`,`translator_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- 导出表中的数据 `tbl_u_spreadtable`
-- 

INSERT INTO `tbl_u_spreadtable` VALUES (1, '2', 100012);
INSERT INTO `tbl_u_spreadtable` VALUES (2, '2', NULL);

-- --------------------------------------------------------

-- 
-- 表的结构 `tbl_u_staff`
-- 

CREATE TABLE `tbl_u_staff` (
  `user_id` int(11) NOT NULL,
  `onworktime` time NOT NULL,
  `offworktime` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- 导出表中的数据 `tbl_u_staff`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `tbl_u_userlang`
-- 

CREATE TABLE `tbl_u_userlang` (
  `user_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  UNIQUE KEY `userlang` (`user_id`,`lang_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- 导出表中的数据 `tbl_u_userlang`
-- 

INSERT INTO `tbl_u_userlang` VALUES (100001, 0);
INSERT INTO `tbl_u_userlang` VALUES (100011, 0);
INSERT INTO `tbl_u_userlang` VALUES (100012, 0);
INSERT INTO `tbl_u_userlang` VALUES (100012, 1);
INSERT INTO `tbl_u_userlang` VALUES (100013, 0);
INSERT INTO `tbl_u_userlang` VALUES (100014, 0);
INSERT INTO `tbl_u_userlang` VALUES (100015, 0);
INSERT INTO `tbl_u_userlang` VALUES (100016, 0);
INSERT INTO `tbl_u_userlang` VALUES (100016, 1);
INSERT INTO `tbl_u_userlang` VALUES (100017, 0);
INSERT INTO `tbl_u_userlang` VALUES (100018, 1);
INSERT INTO `tbl_u_userlang` VALUES (100019, 0);
INSERT INTO `tbl_u_userlang` VALUES (100019, 1);
INSERT INTO `tbl_u_userlang` VALUES (100020, 1);
INSERT INTO `tbl_u_userlang` VALUES (100021, 0);
INSERT INTO `tbl_u_userlang` VALUES (100026, 0);
INSERT INTO `tbl_u_userlang` VALUES (100027, 0);
INSERT INTO `tbl_u_userlang` VALUES (100028, 0);
INSERT INTO `tbl_u_userlang` VALUES (100029, 0);
INSERT INTO `tbl_u_userlang` VALUES (100030, 0);
INSERT INTO `tbl_u_userlang` VALUES (100031, 0);

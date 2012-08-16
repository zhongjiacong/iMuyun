-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- 主机: localhost
-- 生成日期: 2012 年 08 月 16 日 12:47
-- 服务器版本: 5.0.51
-- PHP 版本: 5.2.6

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- 
-- 导出表中的数据 `tbl_c_article`
-- 

INSERT INTO `tbl_c_article` VALUES (12, 0, 11, NULL, 11, 0, 1, NULL, NULL, '2012-08-15 04:48:40');
INSERT INTO `tbl_c_article` VALUES (17, 0, 15, 'Avatar.jpg', 0, 0, 1, '2012-08-15 05:16:42', '2012-08-15 05:32:45', '2012-08-15 05:16:00');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- 导出表中的数据 `tbl_c_msg`
-- 

INSERT INTO `tbl_c_msg` VALUES (1, '钟嘉聪', '13480205903', 'zhongjiacong@gmail.com', '试试', '我的内容', 100003, '没问题快快快', '2012-08-07 16:11:35');
INSERT INTO `tbl_c_msg` VALUES (2, '钟嘉聪', '13480205903', 'zhongjiacong@gmail.com', '试试', '看看', NULL, '', NULL);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- 
-- 导出表中的数据 `tbl_c_order`
-- 

INSERT INTO `tbl_c_order` VALUES (15, '第二单', 100001, 0, 0, '2012-08-15 05:16:00', 1, '2012-08-15 05:16:00', '2012-08-15 05:16:04', '2012-08-15 05:32:45', '', 0);
INSERT INTO `tbl_c_order` VALUES (11, '第一单', 100001, 0, 0, '2012-08-15 04:48:40', 0, '2012-08-15 04:48:40', NULL, NULL, '', 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

-- 
-- 导出表中的数据 `tbl_c_recharge`
-- 

INSERT INTO `tbl_c_recharge` VALUES (1, 100001, 0, '17', 1, '2012-08-10 22:58:16');
INSERT INTO `tbl_c_recharge` VALUES (2, 100001, 0, '100', 0, '2012-08-13 06:12:18');
INSERT INTO `tbl_c_recharge` VALUES (12, 100001, 2, '-4.8', 1, '2012-08-13 07:40:17');
INSERT INTO `tbl_c_recharge` VALUES (13, 100001, 2, '-3.48', 1, '2012-08-13 14:02:08');
INSERT INTO `tbl_c_recharge` VALUES (14, 100001, 2, '-0.36', 1, '2012-08-13 15:33:46');
INSERT INTO `tbl_c_recharge` VALUES (15, 100001, 2, '-0.72', 1, '2012-08-13 16:26:28');
INSERT INTO `tbl_c_recharge` VALUES (16, 100001, 2, '-0.96', 1, '2012-08-13 16:47:22');
INSERT INTO `tbl_c_recharge` VALUES (17, 100001, 2, '0', 1, '2012-08-15 05:11:56');
INSERT INTO `tbl_c_recharge` VALUES (18, 100001, 2, '0', 1, '2012-08-15 05:16:04');

-- --------------------------------------------------------

-- 
-- 表的结构 `tbl_c_sentence`
-- 

CREATE TABLE `tbl_c_sentence` (
  `id` int(11) NOT NULL auto_increment,
  `article_id` int(11) NOT NULL,
  `sentencenum` int(11) NOT NULL,
  `original` text NOT NULL,
  `translation` text NOT NULL,
  `edittime` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- 
-- 导出表中的数据 `tbl_c_sentence`
-- 

INSERT INTO `tbl_c_sentence` VALUES (7, 12, 0, '中交解放路圣诞节父路径', '', '2012-08-15 04:48:40');

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
  `pushToken` text,
  `company` varchar(31) default NULL,
  `session_id` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100023 ;

-- 
-- 导出表中的数据 `tbl_c_user`
-- 

INSERT INTO `tbl_c_user` VALUES (100001, 0, 5, 'zhongjiacong@gmail.com', '3915da4d2d16dd5a69b6204cacb8a2a1d9e79f34', '', 'zhongjiacong', '钟嘉聪', 2, '2012-08-15', '13480205903', '020-39334161', '不要忘记自己最初的梦想', '广东广州中山大学', '510006', 1, '', '2012-07-09 21:13:50', '2012-08-16 04:53:13', NULL, NULL, NULL);
INSERT INTO `tbl_c_user` VALUES (100002, 0, 0, '184492896@qq.com', '10470c3b4b1fed12c3baac014be15fac67c6e815', '', '184492896', '', 0, '1970-01-01', '110', '', '', '', '', 1, '', '2012-07-09 23:01:28', '2012-07-09 23:01:28', NULL, NULL, NULL);
INSERT INTO `tbl_c_user` VALUES (100003, 0, 2, 'translator@muyun.com', '53ae2fc6cf0b62b3ec601f8e5e8187629137794f', '', '172367155', '', 0, '1992-05-20', '13480205903', '', '', '', '', 1, '', '2012-07-10 14:07:42', '2012-08-13 13:10:47', NULL, NULL, NULL);
INSERT INTO `tbl_c_user` VALUES (100004, 0, 0, '29519260@qq.com', '0a8ed381d3e00b45aa418ad317b08ad0286384e2', '', '29519260', '', 0, '0000-00-00', '13824436126', '', '', '', '', 1, '', '2012-07-10 17:09:19', '2012-07-10 17:09:19', NULL, NULL, NULL);
INSERT INTO `tbl_c_user` VALUES (100005, 0, 0, 'ciiry@live.cn', '15cfb8c5208a294c905798906259f24d019473c3', '', 'ciiry', '', 0, '0000-00-00', '13552134931', '', '', '', '', 1, 'cd98f00b204e9800', '2012-07-10 17:11:37', '2012-07-10 17:11:37', NULL, NULL, NULL);
INSERT INTO `tbl_c_user` VALUES (100006, 0, 0, 'cydhx@163.com', '15e56bc016048b50323204244ef2125cc411d904', '', 'cydhx', '', 0, '0000-00-00', '15172491806', '', '', '', '', 1, 'ecf8427e', '2012-07-10 17:21:01', '2012-07-10 17:21:01', NULL, NULL, NULL);
INSERT INTO `tbl_c_user` VALUES (100007, 0, 0, 'taoxiance@dxwsoft.com', '952d37e87ad687178d9ddc6ee3a03c92bf1f6549', '', 'taoxiance', '', 0, '0000-00-00', '15904262199', '', '', '', '', 1, '0998ecf8427e', '2012-07-10 17:33:01', '2012-07-10 17:33:01', NULL, NULL, NULL);
INSERT INTO `tbl_c_user` VALUES (100008, 0, 0, 'zjc@gmail.com', '2ca8dfbdaeda5f475cc0eacc02a5733645fec403', '', 'zjc', '', 0, '0000-00-00', '13480205903', '', '', '', '', 1, '1d8cd98f00b204e98009', '2012-07-23 11:16:53', '2012-07-23 11:16:53', NULL, NULL, NULL);
INSERT INTO `tbl_c_user` VALUES (100019, 0, 0, 'zhongjiacong@outlook.com', '53ae2fc6cf0b62b3ec601f8e5e8187629137794f', '', 'zhongjiacong', '', 0, '0000-00-00', '13480205903', '', '', '', '', 1, '543aaf6b92ed0148ef86', '2012-08-14 13:39:50', '2012-08-15 23:30:38', NULL, NULL, NULL);
INSERT INTO `tbl_c_user` VALUES (100022, 0, 0, '172367155@qq.com', '53ae2fc6cf0b62b3ec601f8e5e8187629137794f', '', '172367155', '', 0, '0000-00-00', '13480205903', '', '', '', '', 1, '5680867ac3eebee38bc0', '2012-08-15 23:45:21', '2012-08-15 23:46:04', NULL, NULL, NULL);

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
  `group_id` int(11) NOT NULL default '0',
  `addtime` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `fansfollow` (`fans_id`,`follow_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- 导出表中的数据 `tbl_u_friend`
-- 

INSERT INTO `tbl_u_friend` VALUES (6, 100001, 100008, 0, '2012-08-16 18:06:38');
INSERT INTO `tbl_u_friend` VALUES (4, 100001, 100022, 0, '2012-08-16 17:33:22');

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

INSERT INTO `tbl_u_spreadtable` VALUES (7, '0.48', NULL);
INSERT INTO `tbl_u_spreadtable` VALUES (12, '1.32', NULL);
INSERT INTO `tbl_u_spreadtable` VALUES (17, '0', 100003);

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
INSERT INTO `tbl_u_userlang` VALUES (100001, 2);
INSERT INTO `tbl_u_userlang` VALUES (100019, 0);
INSERT INTO `tbl_u_userlang` VALUES (100020, 0);
INSERT INTO `tbl_u_userlang` VALUES (100021, 0);
INSERT INTO `tbl_u_userlang` VALUES (100022, 0);

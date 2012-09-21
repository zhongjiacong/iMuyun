-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- 主机: localhost
-- 生成日期: 2012 年 09 月 21 日 16:56
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
  `price` varchar(15) NOT NULL,
  `srclang_id` int(11) NOT NULL,
  `tgtlang_id` int(11) NOT NULL,
  `edittime` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=100001 ;

-- 
-- 导出表中的数据 `tbl_c_article`
-- 


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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=100001 ;

-- 
-- 导出表中的数据 `tbl_c_consume`
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=100001 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=100001 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `tbl_c_msg`
-- 


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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=100001 ;

-- 
-- 导出表中的数据 `tbl_c_order`
-- 


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
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=100001 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `tbl_c_sentence`
-- 


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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=100001 ;

-- 
-- 导出表中的数据 `tbl_c_user`
-- 


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
  `favor` int(11) NOT NULL default '0',
  `addtime` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `fansfollow` (`fans_id`,`follow_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `tbl_u_friend`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `tbl_u_spreadtable`
-- 

CREATE TABLE `tbl_u_spreadtable` (
  `article_id` int(11) NOT NULL,
  `translator_id` int(11) default NULL,
  `filename` varchar(255) default NULL,
  `starttime` datetime default NULL,
  `comptime` datetime default NULL,
  UNIQUE KEY `articleprice` (`article_id`,`translator_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- 导出表中的数据 `tbl_u_spreadtable`
-- 


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


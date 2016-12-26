/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : ncre

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-12-21 21:05:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `yunzhi_subject`
-- ----------------------------
DROP TABLE IF EXISTS `yunzhi_subject`;
CREATE TABLE `yunzhi_subject` (
  `number` tinyint(10) unsigned NOT NULL COMMENT '科目号',
  `title` varchar(30) DEFAULT NULL COMMENT '科目名称',
  PRIMARY KEY (`number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yunzhi_subject
-- ----------------------------

/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : ncre

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-01-03 10:56:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `yunzhi_tickets`
-- ----------------------------
DROP TABLE IF EXISTS `yunzhi_tickets`;
CREATE TABLE `yunzhi_tickets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '考场信息ID',
  `zjh` char(18) DEFAULT NULL COMMENT '身份证号',
  `zkzh` char(16) DEFAULT NULL COMMENT '准考证号',
  `kch` tinyint(10) DEFAULT NULL COMMENT '考场号',
  `pch` tinyint(10) DEFAULT NULL COMMENT '批次号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yunzhi_tickets
-- ----------------------------
INSERT INTO `yunzhi_tickets` VALUES ('1', '140602199012109044', '6147120048040124', '4', '3');
INSERT INTO `yunzhi_tickets` VALUES ('2', '120223199310150164', '6547120048010327', '1', '6');
INSERT INTO `yunzhi_tickets` VALUES ('3', '120112199208130461', '6547120048060294', '6', '5');
INSERT INTO `yunzhi_tickets` VALUES ('4', '140624199505150035', '6547120048060065', '6', '2');

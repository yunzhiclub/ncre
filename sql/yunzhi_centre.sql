/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : ncre

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-12-21 21:05:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `yunzhi_centre`
-- ----------------------------
DROP TABLE IF EXISTS `yunzhi_centre`;
CREATE TABLE `yunzhi_centre` (
  `number` int(10) unsigned NOT NULL COMMENT '考点代码',
  `title` varchar(30) DEFAULT NULL COMMENT '考点名称',
  PRIMARY KEY (`number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yunzhi_centre
-- ----------------------------

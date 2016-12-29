/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : ncre

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-12-28 21:35:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `yunzhi_score`
-- ----------------------------
DROP TABLE IF EXISTS `yunzhi_score`;
CREATE TABLE `yunzhi_score` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `ZJH` char(30) DEFAULT NULL COMMENT '证件号',
  `ZKZH` char(30) DEFAULT NULL COMMENT '准考证号',
  `CJ` smallint(10) unsigned DEFAULT NULL COMMENT '成绩',
  `ZSBH` varchar(30) DEFAULT NULL COMMENT '证书编号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yunzhi_score
-- ----------------------------
INSERT INTO `yunzhi_score` VALUES ('2', '230103199011133940', '1547120048040151', '82', '15471200006796');
INSERT INTO `yunzhi_score` VALUES ('3', '120109199210086553', '1547120048040152', '0', '              ');
INSERT INTO `yunzhi_score` VALUES ('4', '511023199605110015', '1547120048040153', '0', '              ');
INSERT INTO `yunzhi_score` VALUES ('5', '120114198803270010', '1547120048040154', '97', '15471200006690');
INSERT INTO `yunzhi_score` VALUES ('6', '230103199011133940', '1547120048040151', '82', '15471200006796');
INSERT INTO `yunzhi_score` VALUES ('7', '120109199210086553', '1547120048040152', '0', '              ');
INSERT INTO `yunzhi_score` VALUES ('8', '511023199605110015', '1547120048040153', '0', '              ');
INSERT INTO `yunzhi_score` VALUES ('9', '120114198803270010', '1547120048040154', '97', '15471200006690');
INSERT INTO `yunzhi_score` VALUES ('10', '230103199011133940', '1547120048040151', '82', '15471200006796');
INSERT INTO `yunzhi_score` VALUES ('11', '120109199210086553', '1547120048040152', '0', '              ');
INSERT INTO `yunzhi_score` VALUES ('12', '511023199605110015', '1547120048040153', '0', '              ');
INSERT INTO `yunzhi_score` VALUES ('13', '120114198803270010', '1547120048040154', '97', '15471200006690');

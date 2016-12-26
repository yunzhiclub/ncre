/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : ncre

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-12-21 21:05:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `yunzhi_score`
-- ----------------------------
DROP TABLE IF EXISTS `yunzhi_score`;
CREATE TABLE `yunzhi_score` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `ZKZH` char(30) DEFAULT NULL COMMENT '准考证号',
  `BMH` char(30) DEFAULT NULL COMMENT '报名号',
  `XM` varchar(16) DEFAULT '' COMMENT '姓名',
  `XB` tinyint(10) unsigned DEFAULT NULL COMMENT '性别',
  `ZJH` char(30) DEFAULT NULL COMMENT '证件号',
  `CJ` smallint(10) unsigned DEFAULT NULL COMMENT '成绩',
  `ZSBH` varchar(30) DEFAULT NULL COMMENT '证书编号',
  `BZ` varchar(30) DEFAULT NULL COMMENT '备注',
  `deleted` tinyint(10) unsigned DEFAULT NULL COMMENT '是否删除',
  `subject_number` tinyint(10) unsigned DEFAULT NULL COMMENT '科目号',
  `examin_time` tinyint(10) unsigned DEFAULT NULL COMMENT '考次号',
  `centre_number` int(10) unsigned DEFAULT NULL COMMENT '考点号',
  `examin_station` tinyint(10) unsigned DEFAULT NULL COMMENT '考场号',
  `batch` tinyint(10) unsigned DEFAULT NULL COMMENT '批次',
  `seat` int(10) unsigned DEFAULT NULL COMMENT '座位号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yunzhi_score
-- ----------------------------
INSERT INTO `yunzhi_score` VALUES ('1', null, null, '', null, null, '1', null, null, null, null, null, null, null, null, null);

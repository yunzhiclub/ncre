/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : ncre

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-12-23 17:39:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `yunzhi_user`
-- ----------------------------
DROP TABLE IF EXISTS `yunzhi_user`;
CREATE TABLE `yunzhi_user` (
  `openid` char(28) NOT NULL DEFAULT '' COMMENT '微信openID',
  `idcardnum` varchar(20) DEFAULT '' COMMENT '身份证号',
  `is_receivemsg` int(10) unsigned DEFAULT NULL COMMENT '是否接收推送消息',
  PRIMARY KEY (`openid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yunzhi_user
-- ----------------------------
INSERT INTO `yunzhi_user` VALUES ('oiz0exAmEEq7SBIjy84XzQ5AO7SA', '130225199911112222', '1');
INSERT INTO `yunzhi_user` VALUES ('oOwB6s7gxdbD6b-2nLYvYuBSEhWM', '130225199911112222', '0');
INSERT INTO `yunzhi_user` VALUES ('oOwB6s9zWPgqDXOGVNP_FgVyubs8', '130225199911112222', '1');

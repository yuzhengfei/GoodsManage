/*
Navicat MySQL Data Transfer

Source Server         : 本机
Source Server Version : 50711
Source Host           : localhost:3306
Source Database       : goodsManage

Target Server Type    : MYSQL
Target Server Version : 50711
File Encoding         : 65001

Date: 2016-11-25 12:36:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `goodsManage_admin`
-- ----------------------------
DROP TABLE IF EXISTS `goodsManage_admin`;
CREATE TABLE `goodsManage_admin` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  `password` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goodsManage_admin
-- ----------------------------
INSERT INTO `goodsManage_admin` VALUES ('1', 'admin', '123');

-- ----------------------------
-- Table structure for goodsManage_goods
-- ----------------------------
DROP TABLE IF EXISTS `goodsManage_goods`;
CREATE TABLE `goodsManage_goods` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `img` text NOT NULL,
  `info` text NOT NULL,
  `count` int(8) NOT NULL,
  `sellingPrice` double(10,0) NOT NULL,
  `purchasePrice` double(10,0) NOT NULL,
  `provider` varchar(20) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goodsManage_goods
-- ----------------------------

-- ----------------------------
-- Table structure for `goodsManage_order`
-- ----------------------------
DROP TABLE IF EXISTS `goodsManage_order`;
CREATE TABLE `goodsManage_order` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `ordernumber` varchar(10) NOT NULL,
  `user_id` int(8) NOT NULL,
  `create_at` datetime NOT NULL,
  `price` double(10,0) NOT NULL,
  `provider_id` int(8) NOT NULL, 
  `type` double(10,0) NOT NULL,  
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goodsManage_order
-- ----------------------------

-- ----------------------------
-- Table structure for goodsManage_order_item
-- ----------------------------
DROP TABLE IF EXISTS `goodsManage_order_item`;
CREATE TABLE `goodsManage_order_item` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `goods_id` int(8) NOT NULL,
  `count` int(3) NOT NULL,
  `price` double(10,0) NOT NULL,
  `ordernumber` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goodsManage_order_item
-- ----------------------------

-- ----------------------------
-- Table structure for `laptop_cart`
-- ----------------------------
DROP TABLE IF EXISTS `goodsManage_provider`;
CREATE TABLE `goodsManage_provider` (
  `id` INT(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `person` varchar(10) NOT NULL,
  `adress` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of laptop_cart
-- ----------------------------





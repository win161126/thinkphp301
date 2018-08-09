/*
Navicat MySQL Data Transfer

Source Server         : cd
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : tp0301

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-07-24 14:00:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tp_address`
-- ----------------------------
DROP TABLE IF EXISTS `tp_address`;
CREATE TABLE `tp_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL,
  `province` char(15) NOT NULL,
  `city` char(15) NOT NULL,
  `country` char(15) NOT NULL,
  `address` varchar(50) NOT NULL,
  `linkman` char(15) NOT NULL,
  `mobile` char(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `fox` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_address
-- ----------------------------
INSERT INTO `tp_address` VALUES ('1', '2', '北京', '市辖区', '东城区', '民族大道', '陈大', '15777777777', '0', '530000');
INSERT INTO `tp_address` VALUES ('2', '2', '广西', '南宁市', '青秀区', '民族古城路口', '陈大', '15777777777', '0', '530000');
INSERT INTO `tp_address` VALUES ('3', '2', '广西', '南宁市', '西乡塘区', '大学路', '陈大', '15777777777', '1', '530000');
INSERT INTO `tp_address` VALUES ('4', '3', '北京', '市辖区', '东城区', '民族大道111', '陈大', '15777777777', '1', '530000');

-- ----------------------------
-- Table structure for `tp_attribute`
-- ----------------------------
DROP TABLE IF EXISTS `tp_attribute`;
CREATE TABLE `tp_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `typeid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_attribute
-- ----------------------------
INSERT INTO `tp_attribute` VALUES ('1', '颜色', '1');
INSERT INTO `tp_attribute` VALUES ('2', '内存', '1');
INSERT INTO `tp_attribute` VALUES ('3', '颜色', '3');
INSERT INTO `tp_attribute` VALUES ('4', '物理内存', '3');

-- ----------------------------
-- Table structure for `tp_brand`
-- ----------------------------
DROP TABLE IF EXISTS `tp_brand`;
CREATE TABLE `tp_brand` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_brand
-- ----------------------------
INSERT INTO `tp_brand` VALUES ('1', '雅思兰黛', '', '雅思兰黛');
INSERT INTO `tp_brand` VALUES ('2', '欧莱雅', '', '欧莱雅');
INSERT INTO `tp_brand` VALUES ('3', '大宝', '', '大宝');

-- ----------------------------
-- Table structure for `tp_cart`
-- ----------------------------
DROP TABLE IF EXISTS `tp_cart`;
CREATE TABLE `tp_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `ctime` int(11) NOT NULL,
  `state` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_cart
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_category`
-- ----------------------------
DROP TABLE IF EXISTS `tp_category`;
CREATE TABLE `tp_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `fid` int(11) NOT NULL COMMENT '父级id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_category
-- ----------------------------
INSERT INTO `tp_category` VALUES ('1', '新闻中心', '0');
INSERT INTO `tp_category` VALUES ('2', '产品中心', '0');
INSERT INTO `tp_category` VALUES ('3', '国内新闻', '1');
INSERT INTO `tp_category` VALUES ('4', '国外新闻', '1');
INSERT INTO `tp_category` VALUES ('6', '行业新闻', '1');
INSERT INTO `tp_category` VALUES ('7', '产品系列', '2');
INSERT INTO `tp_category` VALUES ('11', '新闻咨询', '1');
INSERT INTO `tp_category` VALUES ('12', '关于我们', '0');
INSERT INTO `tp_category` VALUES ('13', '公司介绍', '12');
INSERT INTO `tp_category` VALUES ('14', '公司历程', '12');
INSERT INTO `tp_category` VALUES ('15', '公司荣誉', '12');
INSERT INTO `tp_category` VALUES ('16', '团队介绍', '12');
INSERT INTO `tp_category` VALUES ('17', '足球', '4');
INSERT INTO `tp_category` VALUES ('18', '篮球123', '4');
INSERT INTO `tp_category` VALUES ('19', 'NBA', '18');
INSERT INTO `tp_category` VALUES ('21', '面部护肤', '2');
INSERT INTO `tp_category` VALUES ('22', '面膜', '21');
INSERT INTO `tp_category` VALUES ('23', '洗面奶', '21');
INSERT INTO `tp_category` VALUES ('24', '保湿水', '21');

-- ----------------------------
-- Table structure for `tp_level`
-- ----------------------------
DROP TABLE IF EXISTS `tp_level`;
CREATE TABLE `tp_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `fid` int(11) NOT NULL,
  `modules` varchar(15) NOT NULL,
  `controller` varchar(15) NOT NULL,
  `action` varchar(15) NOT NULL,
  `state` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_level
-- ----------------------------
INSERT INTO `tp_level` VALUES ('1', '系统', '0', '', '', '', '1');
INSERT INTO `tp_level` VALUES ('2', '品牌管理', '0', 'admin', 'Brand', '', '1');
INSERT INTO `tp_level` VALUES ('3', '品牌添加', '2', 'admin', 'Brand', 'brandAdd', '1');
INSERT INTO `tp_level` VALUES ('4', '品牌列表', '2', 'admin', 'Brand', 'brandList', '1');
INSERT INTO `tp_level` VALUES ('5', '分类管理', '0', 'admin', 'Category', '', '1');
INSERT INTO `tp_level` VALUES ('6', '商品管理', '0', 'admin', 'Product', '', '1');
INSERT INTO `tp_level` VALUES ('7', '权限管理', '0', 'admin', 'Level', '', '1');
INSERT INTO `tp_level` VALUES ('8', '角色管理', '0', 'admin', 'Role', '', '1');
INSERT INTO `tp_level` VALUES ('9', '分类添加', '5', 'admin', 'Category', 'cateAdd', '1');
INSERT INTO `tp_level` VALUES ('10', '分类列表', '5', 'admin', 'Category', 'cateList', '1');
INSERT INTO `tp_level` VALUES ('11', '权限添加', '7', 'admin', 'Level', 'levelAdd', '1');
INSERT INTO `tp_level` VALUES ('12', '权限列表', '7', 'admin', 'Level', 'levelList', '1');
INSERT INTO `tp_level` VALUES ('13', '商品添加', '6', 'admin', 'Product', 'proAdd', '1');
INSERT INTO `tp_level` VALUES ('14', '商品列表', '6', 'admin', 'Product', 'proList', '1');
INSERT INTO `tp_level` VALUES ('15', '角色添加', '8', 'admin', 'Role', 'roleAdd', '1');
INSERT INTO `tp_level` VALUES ('16', '角色列表', '8', 'admin', 'Role', 'roleList', '1');
INSERT INTO `tp_level` VALUES ('17', '商品类型', '6', 'admin', 'Type', 'typeList', '1');
INSERT INTO `tp_level` VALUES ('18', '类型添加', '6', 'admin', 'Type', 'typeAdd', '0');
INSERT INTO `tp_level` VALUES ('19', '类型编辑', '6', 'admin', 'Type', 'typeUpdate', '0');
INSERT INTO `tp_level` VALUES ('20', '类型删除', '6', 'admin', 'Type', 'typeDelete', '0');
INSERT INTO `tp_level` VALUES ('21', '属性列表', '6', 'admin', 'Attribute', 'attrList', '0');
INSERT INTO `tp_level` VALUES ('22', '属性添加', '6', 'admin', 'Attribute', 'attrAdd', '0');
INSERT INTO `tp_level` VALUES ('23', '属性编辑', '6', 'admin', 'Attribute', 'attrUpdate', '0');
INSERT INTO `tp_level` VALUES ('24', '属性删除', '6', 'admin', 'Attribute', 'attrDelete', '0');

-- ----------------------------
-- Table structure for `tp_manager`
-- ----------------------------
DROP TABLE IF EXISTS `tp_manager`;
CREATE TABLE `tp_manager` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uname` varchar(18) NOT NULL,
  `pwd` char(32) NOT NULL,
  `rid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_manager
-- ----------------------------
INSERT INTO `tp_manager` VALUES ('1', '123', '2c36f1f31ec0018a2e84ff820c2ae7f0', '0');
INSERT INTO `tp_manager` VALUES ('4', '111', 'e96d8cb1e61997cef989f81dfa13d275', '2');

-- ----------------------------
-- Table structure for `tp_member`
-- ----------------------------
DROP TABLE IF EXISTS `tp_member`;
CREATE TABLE `tp_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` char(18) NOT NULL,
  `upwd` char(32) NOT NULL,
  `cname` varchar(18) NOT NULL,
  `sex` tinyint(4) NOT NULL,
  `age` tinyint(4) NOT NULL,
  `phone` char(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ctime` int(11) NOT NULL,
  `ip` varchar(18) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_member
-- ----------------------------
INSERT INTO `tp_member` VALUES ('1', '15888888888', '2c36f1f31ec0018a2e84ff820c2ae7f0', '', '0', '0', '', '', '0', '');
INSERT INTO `tp_member` VALUES ('2', '15777777777', '2c36f1f31ec0018a2e84ff820c2ae7f0', '', '0', '0', '', '', '0', '');
INSERT INTO `tp_member` VALUES ('3', '13555555555', '2c36f1f31ec0018a2e84ff820c2ae7f0', '', '0', '0', '', '', '0', '');
INSERT INTO `tp_member` VALUES ('4', '13333333333', '2c36f1f31ec0018a2e84ff820c2ae7f0', '', '0', '0', '', '', '0', '');
INSERT INTO `tp_member` VALUES ('5', '13222222222', '2c36f1f31ec0018a2e84ff820c2ae7f0', '', '0', '0', '', '', '1531364238', '');
INSERT INTO `tp_member` VALUES ('6', '13111111111', '2c36f1f31ec0018a2e84ff820c2ae7f0', '', '0', '0', '', '', '1531364473', '127.0.0.1');

-- ----------------------------
-- Table structure for `tp_money`
-- ----------------------------
DROP TABLE IF EXISTS `tp_money`;
CREATE TABLE `tp_money` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL,
  `cash` float NOT NULL,
  `pwd` char(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_money
-- ----------------------------
INSERT INTO `tp_money` VALUES ('1', '2', '500', '123');
INSERT INTO `tp_money` VALUES ('2', '0', '500', '0');

-- ----------------------------
-- Table structure for `tp_options`
-- ----------------------------
DROP TABLE IF EXISTS `tp_options`;
CREATE TABLE `tp_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_options
-- ----------------------------
INSERT INTO `tp_options` VALUES ('1', '1', '黑色');
INSERT INTO `tp_options` VALUES ('2', '1', '白色');
INSERT INTO `tp_options` VALUES ('3', '1', '红色');
INSERT INTO `tp_options` VALUES ('4', '2', '32G');
INSERT INTO `tp_options` VALUES ('5', '2', '64G');
INSERT INTO `tp_options` VALUES ('6', '2', '128G');
INSERT INTO `tp_options` VALUES ('7', '3', '红色');
INSERT INTO `tp_options` VALUES ('8', '3', '白色');
INSERT INTO `tp_options` VALUES ('9', '3', '黑色');
INSERT INTO `tp_options` VALUES ('10', '3', '玫瑰金');
INSERT INTO `tp_options` VALUES ('11', '4', '500G');
INSERT INTO `tp_options` VALUES ('12', '4', '1T');

-- ----------------------------
-- Table structure for `tp_orders`
-- ----------------------------
DROP TABLE IF EXISTS `tp_orders`;
CREATE TABLE `tp_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` varchar(30) NOT NULL,
  `mid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `price` float NOT NULL,
  `linkman` varchar(15) NOT NULL,
  `mobile` char(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `state` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `ctime` int(11) NOT NULL,
  `mtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_orders
-- ----------------------------
INSERT INTO `tp_orders` VALUES ('1', '20180718271118', '2', '13', '3', '264', '陈大', '15777777777', '广西南宁市西乡塘区大学路', '2', '0', '1531881177', '0');
INSERT INTO `tp_orders` VALUES ('2', '20180718271118', '2', '12', '10', '1000', '陈大', '15777777777', '广西南宁市西乡塘区大学路', '2', '0', '1531881177', '0');
INSERT INTO `tp_orders` VALUES ('3', '20180718253535', '2', '12', '1', '100', '陈大', '15777777777', '广西南宁市西乡塘区大学路', '1', '0', '1531881316', '0');
INSERT INTO `tp_orders` VALUES ('4', '20180718298586', '2', '13', '1', '88', '陈大', '15777777777', '北京市辖区东城区民族大道', '1', '0', '1531881428', '0');
INSERT INTO `tp_orders` VALUES ('5', '20180718251472', '2', '13', '2', '176', '陈大', '15777777777', '广西南宁市青秀区民族古城路口', '1', '0', '1531881554', '0');
INSERT INTO `tp_orders` VALUES ('6', '20180718211238', '2', '12', '1', '100', '陈大', '15777777777', '广西南宁市青秀区民族古城路口', '1', '0', '1531881606', '0');
INSERT INTO `tp_orders` VALUES ('7', '20180718277784', '2', '13', '1', '88', '陈大', '15777777777', '广西南宁市青秀区民族古城路口', '1', '0', '1531881816', '0');
INSERT INTO `tp_orders` VALUES ('8', '20180718242855', '2', '12', '1', '100', '陈大', '15777777777', '广西南宁市青秀区民族古城路口', '2', '0', '1531882891', '0');
INSERT INTO `tp_orders` VALUES ('9', '20180718245908', '2', '12', '5', '500', '陈大', '15777777777', '广西南宁市青秀区民族古城路口', '2', '0', '1531900901', '0');
INSERT INTO `tp_orders` VALUES ('10', '20180718254492', '2', '13', '3', '264', '陈大', '15777777777', '广西南宁市青秀区民族古城路口', '1', '0', '1531906523', '0');
INSERT INTO `tp_orders` VALUES ('11', '20180718231918', '2', '13', '11', '968', '陈大', '15777777777', '广西南宁市青秀区民族古城路口', '2', '0', '1531907029', '0');
INSERT INTO `tp_orders` VALUES ('12', '20180718380836', '3', '12', '1', '100', '陈大', '15777777777', '北京市辖区东城区民族大道111', '2', '0', '1531908099', '0');
INSERT INTO `tp_orders` VALUES ('13', '20180719214883', '2', '12', '5', '500', '陈大', '15777777777', '广西南宁市青秀区民族古城路口', '2', '1', '1531964119', '0');
INSERT INTO `tp_orders` VALUES ('14', '20180719289978', '2', '12', '6', '600', '陈大', '15777777777', '广西南宁市青秀区民族古城路口', '2', '0', '1531968207', '0');
INSERT INTO `tp_orders` VALUES ('15', '20180719210204', '2', '12', '8', '800', '陈大', '15777777777', '广西南宁市西乡塘区大学路', '2', '0', '1531968432', '0');

-- ----------------------------
-- Table structure for `tp_product`
-- ----------------------------
DROP TABLE IF EXISTS `tp_product`;
CREATE TABLE `tp_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `introduction` varchar(250) NOT NULL,
  `bid` int(5) NOT NULL,
  `cid` int(5) NOT NULL,
  `number` varchar(30) NOT NULL,
  `market` decimal(5,2) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `num` int(5) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `picture` text NOT NULL,
  `content` text NOT NULL,
  `ctime` int(11) NOT NULL,
  `utime` int(11) NOT NULL,
  `typeid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_product
-- ----------------------------
INSERT INTO `tp_product` VALUES ('17', 'fewfe', '', '2', '21', '23432', '88.00', '80.00', '45', '', '', '', '1532310928', '1532310928', '0');
INSERT INTO `tp_product` VALUES ('18', 'fewfe', '', '2', '21', '23432', '88.00', '80.00', '45', '', '', '', '1532310938', '1532310938', '0');
INSERT INTO `tp_product` VALUES ('16', '111', '111', '2', '7', '12312412', '999.99', '999.99', '421', '', '', '', '1532310270', '1532310270', '0');
INSERT INTO `tp_product` VALUES ('14', '123', '123', '1', '7', '8797', '111.00', '111.00', '100', '', '', '', '1532310130', '1532310130', '0');
INSERT INTO `tp_product` VALUES ('15', '111', '111', '2', '7', '12312412', '999.99', '999.99', '421', '', '', '', '1532310231', '1532310231', '0');
INSERT INTO `tp_product` VALUES ('11', 'retre', 'tth', '2', '3', '44', '44.00', '44.00', '44', '', '', '', '1531725340', '1531725340', '0');
INSERT INTO `tp_product` VALUES ('12', '芦荟面膜', '芦荟面膜', '1', '22', '123', '110.00', '100.00', '18', './public/static/admin/upload/2018-07-17/thumb/5b4d3f63002b4.jpg', './public/static/admin/upload/2018-07-17/5b4d3f63002b4.jpg,./public/static/admin/upload/2018-07-17/5b4d3f63029c4.jpg,./public/static/admin/upload/2018-07-17/5b4d3f63029c4.jpg,./public/static/admin/upload/2018-07-17/5b4d3f63029c4.jpg,./public/static/admin/upload/2018-07-17/5b4d3f63050d4.jpg', '', '1531789155', '1531789210', '0');
INSERT INTO `tp_product` VALUES ('13', '日日面膜', '日日面膜', '2', '22', '456', '90.00', '88.00', '100', './public/static/admin/upload/2018-07-17/thumb/5b4d3f916b9b5.jpg', './public/static/admin/upload/2018-07-17/5b4d3f916b9b5.jpg,./public/static/admin/upload/2018-07-17/5b4d3f916b9b5.jpg,./public/static/admin/upload/2018-07-17/5b4d3f916b9b5.jpg,./public/static/admin/upload/2018-07-17/5b4d3f916b9b5.jpg,./public/static/admin/upload/2018-07-17/5b4d3f916b9b5.jpg,./public/static/admin/upload/2018-07-17/5b4d3f916b9b5.jpg', '', '1531789201', '1531789201', '0');
INSERT INTO `tp_product` VALUES ('19', 'fewfe', '', '2', '21', '23432', '88.00', '80.00', '45', '', '', '', '1532311032', '1532311032', '0');
INSERT INTO `tp_product` VALUES ('20', 'fewfe', '', '2', '21', '23432', '88.00', '80.00', '45', '', '', '', '1532311096', '1532311096', '0');
INSERT INTO `tp_product` VALUES ('21', 'fewfe', '', '2', '21', '23432', '88.00', '80.00', '45', '', '', '', '1532311110', '1532311110', '0');
INSERT INTO `tp_product` VALUES ('22', 'fewfe', '', '2', '21', '23432', '88.00', '80.00', '45', '', '', '', '1532311195', '1532311195', '0');
INSERT INTO `tp_product` VALUES ('23', 'fewfe', '', '2', '21', '23432', '88.00', '80.00', '45', '', '', '', '1532311233', '1532311233', '0');
INSERT INTO `tp_product` VALUES ('24', '123', '', '2', '7', '123', '999.99', '999.99', '213', '', '', '', '1532312043', '1532312043', '0');
INSERT INTO `tp_product` VALUES ('25', '123', '', '2', '7', '123', '999.99', '999.99', '213', '', '', '', '1532312048', '1532312048', '0');
INSERT INTO `tp_product` VALUES ('26', '123', '', '2', '7', '123', '999.99', '999.99', '213', '', '', '', '1532312079', '1532312079', '0');
INSERT INTO `tp_product` VALUES ('27', 'fefes', '', '2', '7', '', '0.00', '234.00', '0', '', '', '', '1532312341', '1532312341', '0');
INSERT INTO `tp_product` VALUES ('28', 'fefe', '', '2', '7', '', '0.00', '234.00', '0', '', '', '', '1532312437', '1532312437', '0');
INSERT INTO `tp_product` VALUES ('29', 'fefe', '', '2', '7', '', '0.00', '234.00', '0', '', '', '', '1532312441', '1532312441', '0');
INSERT INTO `tp_product` VALUES ('30', 'fwe', '', '2', '7', '', '0.00', '123.00', '0', '', '', '', '1532312831', '1532312831', '0');
INSERT INTO `tp_product` VALUES ('31', 'fwe', '', '2', '7', '', '0.00', '123.00', '0', '', '', '', '1532312837', '1532312837', '0');
INSERT INTO `tp_product` VALUES ('32', 'fefe', '', '2', '7', '', '0.00', '999.99', '0', '', '', '', '1532312965', '1532312965', '0');
INSERT INTO `tp_product` VALUES ('33', 'fefe', '', '2', '7', '', '0.00', '999.99', '0', '', '', '', '1532313061', '1532313061', '0');
INSERT INTO `tp_product` VALUES ('34', 'fefe', '', '2', '7', '', '0.00', '999.99', '0', '', '', '', '1532313114', '1532313114', '0');
INSERT INTO `tp_product` VALUES ('35', 'fefe', '', '2', '7', '', '0.00', '999.99', '0', '', '', '', '1532313238', '1532313238', '0');
INSERT INTO `tp_product` VALUES ('36', 'fefe', '', '2', '7', '', '0.00', '999.99', '0', '', '', '', '1532313389', '1532313389', '0');
INSERT INTO `tp_product` VALUES ('37', 'fefe', '', '2', '7', '', '0.00', '999.99', '0', '', '', '', '1532313456', '1532313456', '0');
INSERT INTO `tp_product` VALUES ('38', 'fefe', '', '2', '7', '', '0.00', '999.99', '0', '', '', '', '1532313462', '1532313462', '0');
INSERT INTO `tp_product` VALUES ('39', 'fefe', '', '2', '7', '', '0.00', '999.99', '0', '', '', '', '1532313494', '1532313494', '0');

-- ----------------------------
-- Table structure for `tp_role`
-- ----------------------------
DROP TABLE IF EXISTS `tp_role`;
CREATE TABLE `tp_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(10) NOT NULL,
  `level` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_role
-- ----------------------------
INSERT INTO `tp_role` VALUES ('2', '普通管理员', '1|2|3|4');

-- ----------------------------
-- Table structure for `tp_spec`
-- ----------------------------
DROP TABLE IF EXISTS `tp_spec`;
CREATE TABLE `tp_spec` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `name` char(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_spec
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_stock`
-- ----------------------------
DROP TABLE IF EXISTS `tp_stock`;
CREATE TABLE `tp_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `attrid` varchar(7) NOT NULL,
  `attrname` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `stock` int(11) NOT NULL,
  `number` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_stock
-- ----------------------------
INSERT INTO `tp_stock` VALUES ('1', '39', '2_4', '颜色:白色 内存:32G', '1', '2', '3');
INSERT INTO `tp_stock` VALUES ('2', '39', '2_5', '颜色:白色 内存:64G', '6', '5', '4');

-- ----------------------------
-- Table structure for `tp_type`
-- ----------------------------
DROP TABLE IF EXISTS `tp_type`;
CREATE TABLE `tp_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_type
-- ----------------------------
INSERT INTO `tp_type` VALUES ('1', '手机');
INSERT INTO `tp_type` VALUES ('2', '美容');
INSERT INTO `tp_type` VALUES ('3', '电脑');

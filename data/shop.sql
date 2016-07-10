CREATE DATABASE IF NOT EXISTS `shop`;
USE `shop`;
--管理员表
DROP TABLE IF EXISTS `shop_admin`;
CREATE TABLE `shop_admin`(
`id` tinyint unsigned auto_increment key,
`username` varchar(20) not null unique,
`password` char(32) not null,
`email` varchar(50) not null
);

--分类表
DROP TABLE IF EXISTS `shop_cate`;
CREATE TABLE `shop_cate`(
`id` smallint unsigned auto_increment key,
`cName` varchar(50) unique
);
--商品表
DROP TABLE IF EXISTS `shop_pro`;
CREATE TABLE `shop_pro`(
`id` int unsigned auto_increment key,
`pName` varchar(50) not null unique,
`pSn` varchar(50) not null,
`pNum` int unsigned default 1,
`mPrice` decimal(10,2) not null,
`iPrice` decimal(10,2) not null,
`pDesc` text,
`pImg` varchar(50) not null,
`pubTime` int unsigned not null,
`isShow` tinyint(1) default 1,
`isHot` tinyint(1) default 0,
`cId` smallint unsigned not null
);
--用户表
DROP TABLE IF EXISTS`shop_user`;
CREATE TABLE `shop_user`(
`id` int unsigned auto_increment key,
`unsername` varchar(20) not null unique,
`password` char(32) not null,
`sex` enum(`男`,`女`,`保密`) not null default `保密`，
`face` varchar(50) not null,
`regTime` int unsigned not null
);

--相册表
DROP TABLE IF EXISTS `shop_album`;
CREATE TABLE `shop_album`(
`id` int unsigned auto_increment key,
`pid` int unsigned not null,
`albumPath` varchar(50) not null
);



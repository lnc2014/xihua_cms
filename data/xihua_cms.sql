/*
SQLyog Ultimate v11.27 (32 bit)
MySQL - 5.6.17 : Database - xihua_cms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`xihua_cms` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `xihua_cms`;

/*Table structure for table `xihua_admin` */

DROP TABLE IF EXISTS `xihua_admin`;

CREATE TABLE `xihua_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL DEFAULT '' COMMENT '管理登录账号',
  `psw` varchar(50) NOT NULL DEFAULT '' COMMENT '管理登录密码',
  `auth` varchar(50) DEFAULT '' COMMENT '保留字段，权限控制',
  `flag` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是不是有效，1为有效。',
  `last_login_time` timestamp NULL DEFAULT NULL COMMENT '最近登录时间',
  `last_ip` varchar(250) DEFAULT NULL COMMENT '最后登录的IP',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `xihua_admin` */

/*Table structure for table `xihua_post` */

DROP TABLE IF EXISTS `xihua_post`;

CREATE TABLE `xihua_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL DEFAULT '0' COMMENT '文章分类ID',
  `post_title` varchar(100) NOT NULL DEFAULT '' COMMENT '文章标题',
  `post_author` varchar(50) NOT NULL DEFAULT '' COMMENT '文章作者',
  `post_content` mediumtext NOT NULL COMMENT '文章内容',
  `post_intro` varchar(500) NOT NULL DEFAULT '' COMMENT '文章简介',
  `post_pic` varchar(250) NOT NULL DEFAULT '' COMMENT '文章封面图片地址',
  `recommend` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否被推荐',
  `read_time` int(11) DEFAULT '0' COMMENT '阅读次数',
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `flag` tinyint(1) DEFAULT NULL COMMENT '是否有效',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `xihua_post` */

/*Table structure for table `xihua_post_cat` */

DROP TABLE IF EXISTS `xihua_post_cat`;

CREATE TABLE `xihua_post_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(100) NOT NULL DEFAULT '' COMMENT '文章分类名称',
  `cat_intro` varchar(250) DEFAULT '' COMMENT '文章分类简介',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `flag` tinyint(4) DEFAULT '1' COMMENT '是否有效',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `xihua_post_cat` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

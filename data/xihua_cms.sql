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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `xihua_admin` */

insert  into `xihua_admin`(`id`,`user_name`,`psw`,`auth`,`flag`,`last_login_time`,`last_ip`) values (1,'admin','21232f297a57a5a743894a0e4a801fc3','',1,'2016-12-31 14:35:02',NULL);

/*Table structure for table `xihua_banner` */

DROP TABLE IF EXISTS `xihua_banner`;

CREATE TABLE `xihua_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT 'banner标题',
  `link_url` varchar(250) NOT NULL DEFAULT '' COMMENT 'banner跳转地址',
  `banner` varchar(250) NOT NULL DEFAULT '' COMMENT 'banner图片地址',
  `banner_intro` varchar(250) NOT NULL DEFAULT '' COMMENT '图片介绍',
  `is_show` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是不是展示，1为展示，其他的为不展示',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `xihua_banner` */

insert  into `xihua_banner`(`id`,`title`,`link_url`,`banner`,`banner_intro`,`is_show`,`create_time`,`update_time`) values (2,'banner测试22','http://xihua_cms/index.php/web/post_detail/9','upload/20170104/20170104151346_429.jpg','我就是来测试的333',1,'2017-01-04 15:13:48','2017-01-04 16:02:03'),(3,'测试一号','','upload/20170104/20170104161614_286.jpg','测试',1,'2017-01-04 16:16:18','2017-01-04 16:16:18');

/*Table structure for table `xihua_comment` */

DROP TABLE IF EXISTS `xihua_comment`;

CREATE TABLE `xihua_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL DEFAULT '0' COMMENT '文章ID',
  `name` varchar(250) NOT NULL DEFAULT '' COMMENT '姓名',
  `email` varchar(100) NOT NULL DEFAULT '' COMMENT 'email',
  `comment` varchar(500) NOT NULL DEFAULT '' COMMENT '评论',
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `flag` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否有效',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '评论状态，1为审核通过，0为待审核，2为不通过审核',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1为评论，2为留言',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `xihua_comment` */

insert  into `xihua_comment`(`id`,`post_id`,`name`,`email`,`comment`,`create_time`,`update_time`,`flag`,`status`,`type`) values (1,1,'测试','li5nongcheng@126.com','试试评论怎么样','2017-01-03 23:04:29',NULL,1,1,1),(2,1,'测试','li5nongcheng@126.com','试试评论怎么样','2017-01-03 23:04:29',NULL,1,1,1),(3,1,'测试','li5nongcheng@126.com','试试评论怎么样','2017-01-03 23:04:29',NULL,1,1,1),(4,1,'测试','li5nongcheng@126.com','试试评论怎么样','2017-01-03 23:04:29',NULL,1,1,1),(5,5,'测试','li5nongcheng@126.com','试试评论怎么样','2017-01-03 23:04:29',NULL,1,1,1),(6,6,'测试','li5nongcheng@126.com','试试评论怎么样','2017-01-03 23:04:29',NULL,1,1,1),(7,1,'测试','li5nongcheng@126.com','试试评论怎么样','2017-01-03 23:04:29',NULL,1,1,1),(8,0,'测试','li5nongcheng@126.com','试试评论怎么样','2017-01-03 23:04:29',NULL,1,1,1),(9,6,'3','2@126.com','3','2017-01-04 11:36:46','2017-01-04 11:36:46',1,1,1);

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
  `comment` int(11) NOT NULL DEFAULT '0' COMMENT '评论次数',
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `flag` tinyint(1) DEFAULT NULL COMMENT '是否有效',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `xihua_post` */

insert  into `xihua_post`(`id`,`cat_id`,`post_title`,`post_author`,`post_content`,`post_intro`,`post_pic`,`recommend`,`read_time`,`comment`,`create_time`,`update_time`,`flag`) values (1,1,'文章测试','李农成','<p>三地三地艾斯德斯大</p>','文章简介测试                                                                ','upload/20170104/20170104005128_545.jpg',0,2,0,'2017-01-02 15:41:35','2017-01-04 00:51:31',1),(5,1,'董小姐','李农成','<h1>             个哈哈</h1>','研究是','upload/20170104/20170104005100_514.jpg',0,0,0,'2017-01-02 16:59:31','2017-01-04 00:51:09',1),(6,1,'杨姣是个大美女','杨姣','<p>nice to meet u</p>','杨姣是个傻逼','upload/20170104/20170104001430_606.jpg',0,34,0,'2017-01-02 21:51:30','2017-01-04 00:14:33',1),(7,1,'李农成','李农成','<p>李农成是个大帅哥<br></p>','李农成是个大帅哥','upload/20170102/20170102215540_566.jpg',0,0,0,'2017-01-02 21:55:52','2017-01-02 21:55:52',1),(8,1,'内画是个啥','袁腾','<p>家居 摸到家啦 </p>','内画是个大的作品啥的','upload/20170104/20170104160617_457.jpg',1,26,0,'2017-01-04 01:05:16','2017-01-04 16:06:49',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `xihua_post_cat` */

insert  into `xihua_post_cat`(`id`,`cat_name`,`cat_intro`,`create_time`,`update_time`,`flag`) values (1,'新闻动态','讲述新闻动态2','2017-01-02 16:37:13','2017-01-02 16:38:41',1),(3,'与昂及','数据的看见','2017-01-02 16:56:41','2017-01-02 16:56:41',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

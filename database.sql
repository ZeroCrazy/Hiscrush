/*
Navicat MySQL Data Transfer

Source Server         : server ovh
Source Server Version : 50568
Source Host           : 141.95.160.199:3306
Source Database       : twain

Target Server Type    : MYSQL
Target Server Version : 50568
File Encoding         : 65001

Date: 2023-03-12 21:30:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT 'assets/images/avatar.png',
  `admin_id` int(11) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `privacity` enum('open','closed') DEFAULT 'open',
  `verified` enum('1') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('4', 'Programador', 'assets/images/avatar.png', '1', '#9c27b0', 'open', null);
INSERT INTO `categories` VALUES ('5', 'Músico', 'assets/images/avatar.png', '1', '#9c27b0', 'open', null);
INSERT INTO `categories` VALUES ('9', 'Webmasters', 'assets/images/avatar.png', '1', '#1741a0', 'closed', '1');
INSERT INTO `categories` VALUES ('14', 'Real Madrid', 'assets/images/avatar.png', '2', '#09cece', 'open', null);
INSERT INTO `categories` VALUES ('15', 'animalistas', 'assets/images/avatar.png', '2', '#0fb6c8', 'open', null);
INSERT INTO `categories` VALUES ('16', 'la lista de schindler', 'assets/images/avatar.png', '2', '#9c27b0', 'open', null);
INSERT INTO `categories` VALUES ('17', 'Canarios ', 'assets/images/avatar.png', '35', '#9c27b0', 'open', null);
INSERT INTO `categories` VALUES ('21', 'lgtbi', 'assets/images/avatar.png', '2', '#ee48dd', 'open', null);
INSERT INTO `categories` VALUES ('27', 'Fútbol Club Barcelona', 'assets/images/avatar.png', '2', '#9f04d2', 'open', null);

-- ----------------------------
-- Table structure for opinions
-- ----------------------------
DROP TABLE IF EXISTS `opinions`;
CREATE TABLE `opinions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of opinions
-- ----------------------------

-- ----------------------------
-- Table structure for ranks
-- ----------------------------
DROP TABLE IF EXISTS `ranks`;
CREATE TABLE `ranks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `prefix` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ranks
-- ----------------------------
INSERT INTO `ranks` VALUES ('1', 'Usuario', null);
INSERT INTO `ranks` VALUES ('2', 'Premium', '[VIP]');
INSERT INTO `ranks` VALUES ('3', 'Moderador', '[MOD]');
INSERT INTO `ranks` VALUES ('4', 'Administrador', '[ADM]');
INSERT INTO `ranks` VALUES ('5', 'Fundador', '[FND]');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `rank` varchar(255) DEFAULT '1',
  `num_preguntas` varchar(255) DEFAULT '0',
  `full_name` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `reg_date` datetime DEFAULT NULL,
  `new_messages` enum('yes','no') DEFAULT 'no',
  `instagram_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `gender` enum('IDK','H','M') DEFAULT 'IDK',
  `avatar` varchar(255) DEFAULT 'assets/images/avatar.png',
  `last_avatar` varchar(255) DEFAULT NULL,
  `amount_visits` int(11) DEFAULT '0',
  `category_id` int(11) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `verified` enum('1') DEFAULT NULL,
  `country` varchar(255) DEFAULT 'IDK',
  `biografia` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `last_on` datetime DEFAULT NULL,
  `show_prefix` enum('yes','no') DEFAULT 'no',
  `show_last_online` enum('no','yes') DEFAULT 'yes',
  `show_comment_profile` enum('yes','no') DEFAULT 'yes',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', null, '', '5', '3', 'ZeroCrazy', 'contacto@codetech.es', '2019-04-17 12:34:11', 'no', 'daniel98gd', 'zero_crazy98', 'https://www.facebook.com/dani.garzoon', 'H', 'assets/images/uploads/f0be8f3bc23df009513f80e0d25905d7.jpg', 'assets/images/uploads/f0be8f3bc23df009513f80e0d25905d7.jpg', '114', '9', null, '1', 'ES', '', '#0e9d0c', '2023-03-12 21:27:50', 'no', 'no', 'no');
INSERT INTO `users` VALUES ('2', 'demo', null, null, '1', '17', 'Demo', 'contacto@codetech.es', '2019-04-17 12:55:01', 'yes', null, null, null, 'H', 'assets/images/uploads/d759ee892185548fbd4c503c5ac29264.jpg', 'assets/images/uploads/d759ee892185548fbd4c503c5ac29264.jpg', '65', '9', null, '1', 'ES', null, '#ff0fff', '2019-07-31 12:04:56', 'no', 'yes', 'yes');

-- ----------------------------
-- Table structure for users_comments
-- ----------------------------
DROP TABLE IF EXISTS `users_comments`;
CREATE TABLE `users_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT 'usuario que le ha comentado // $_SESSION[''id'']',
  `group_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `anonymous` enum('yes','no') DEFAULT 'no',
  `private` enum('yes','no') DEFAULT 'no',
  `ip` varchar(255) DEFAULT NULL COMMENT 'capte la dirección ip por si las moscas',
  `hidden` enum('yes','no') DEFAULT 'no',
  `user_commented` varchar(255) DEFAULT NULL COMMENT 'usuario a quien le has comentado',
  `date_reg` datetime DEFAULT NULL COMMENT 'fecha que se ha comentado',
  `content` varchar(9999) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users_comments
-- ----------------------------

-- ----------------------------
-- Table structure for users_comments_likes
-- ----------------------------
DROP TABLE IF EXISTS `users_comments_likes`;
CREATE TABLE `users_comments_likes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_id_liked` varchar(255) DEFAULT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `yeslike` enum('1') DEFAULT NULL,
  `nolike` enum('1') DEFAULT NULL,
  `date_reg` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users_comments_likes
-- ----------------------------

-- ----------------------------
-- Table structure for users_instagram
-- ----------------------------
DROP TABLE IF EXISTS `users_instagram`;
CREATE TABLE `users_instagram` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `instagram_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users_instagram
-- ----------------------------

-- ----------------------------
-- Table structure for users_likes
-- ----------------------------
DROP TABLE IF EXISTS `users_likes`;
CREATE TABLE `users_likes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_liked` int(11) DEFAULT NULL,
  `yeslike` enum('1') DEFAULT NULL,
  `nolike` enum('1') DEFAULT NULL,
  `date_reg` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users_likes
-- ----------------------------

-- ----------------------------
-- Table structure for users_reporteds
-- ----------------------------
DROP TABLE IF EXISTS `users_reporteds`;
CREATE TABLE `users_reporteds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_id_reported` varchar(255) DEFAULT NULL,
  `estado` enum('resolved','pending') DEFAULT 'pending',
  `hidden` enum('yes','no') DEFAULT 'no',
  `reason` varchar(255) DEFAULT NULL,
  `content` varchar(9999) DEFAULT NULL,
  `date_reg` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users_reporteds
-- ----------------------------

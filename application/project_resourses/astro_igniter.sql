/*
 Navicat Premium Data Transfer

 Source Server         : PHP 5.6
 Source Server Type    : MariaDB
 Source Server Version : 100134
 Source Host           : localhost:3306
 Source Schema         : astro_igniter

 Target Server Type    : MariaDB
 Target Server Version : 100134
 File Encoding         : 65001

 Date: 22/05/2023 09:01:00
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for attachments
-- ----------------------------
DROP TABLE IF EXISTS `attachments`;
CREATE TABLE `attachments`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NULL DEFAULT NULL,
  `url` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `task_id`(`task_id`) USING BTREE,
  CONSTRAINT `attachments_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of attachments
-- ----------------------------

-- ----------------------------
-- Table structure for backgrounds
-- ----------------------------
DROP TABLE IF EXISTS `backgrounds`;
CREATE TABLE `backgrounds`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of backgrounds
-- ----------------------------

-- ----------------------------
-- Table structure for priority_levels
-- ----------------------------
DROP TABLE IF EXISTS `priority_levels`;
CREATE TABLE `priority_levels`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of priority_levels
-- ----------------------------
INSERT INTO `priority_levels` VALUES (1, 'high');
INSERT INTO `priority_levels` VALUES (2, 'medium');
INSERT INTO `priority_levels` VALUES (3, 'low');

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `background_id` int(11) NULL DEFAULT NULL,
  `theme_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  INDEX `background_id`(`background_id`) USING BTREE,
  INDEX `theme_id`(`theme_id`) USING BTREE,
  CONSTRAINT `settings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `settings_ibfk_2` FOREIGN KEY (`background_id`) REFERENCES `backgrounds` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `settings_ibfk_3` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of settings
-- ----------------------------

-- ----------------------------
-- Table structure for statuses
-- ----------------------------
DROP TABLE IF EXISTS `statuses`;
CREATE TABLE `statuses`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of statuses
-- ----------------------------
INSERT INTO `statuses` VALUES (1, 'to do');
INSERT INTO `statuses` VALUES (2, 'in progress');
INSERT INTO `statuses` VALUES (3, 'complete');

-- ----------------------------
-- Table structure for tasks
-- ----------------------------
DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `body` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `start_date` date NULL DEFAULT NULL,
  `due_date` date NULL DEFAULT NULL,
  `user_id` int(11) NULL DEFAULT NULL,
  `status_id` int(11) NULL DEFAULT NULL,
  `priority_level_id` int(11) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  INDEX `status_id`(`status_id`) USING BTREE,
  INDEX `priority_level_id`(`priority_level_id`) USING BTREE,
  CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tasks_ibfk_3` FOREIGN KEY (`priority_level_id`) REFERENCES `priority_levels` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 81 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tasks
-- ----------------------------
INSERT INTO `tasks` VALUES (41, 'Add view task functionality', 'finish the view task functionality.', '2023-05-18', '2023-05-18', 1, 1, 1, '2023-05-18 16:54:55', '2023-05-18 16:54:55');
INSERT INTO `tasks` VALUES (42, 'test functionality', 'test funcs', '2001-01-01', '2001-01-01', 1, 1, 3, '2023-05-18 17:23:17', '2023-05-18 17:23:17');
INSERT INTO `tasks` VALUES (43, 'add changes', 'add the changes ', '2002-02-02', '2002-02-02', 1, 1, 2, '2023-05-18 17:24:47', '2023-05-18 17:24:47');
INSERT INTO `tasks` VALUES (80, 'test edit func', 'funcs', '2200-02-02', '2020-02-20', 5, 1, 1, '2023-05-19 17:41:42', '2023-05-19 17:41:42');

-- ----------------------------
-- Table structure for themes
-- ----------------------------
DROP TABLE IF EXISTS `themes`;
CREATE TABLE `themes`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of themes
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profile_picture` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'user', 'user@gmail.com', '$2y$10$bfUOBKRZ95eeeIiYiosh6efJKhuZBMOycPqCpyk/GdVDUoOE9Ay5O', 'user-avatar.png', '2023-05-17 15:24:48', '2023-05-17 15:30:53');
INSERT INTO `users` VALUES (2, 'user 2', 'user2@gmail.com', '$2y$10$Uv.5GtGLE3F5u07yw6Y1UONAv5t1SWhV7MjP9dhf/jpf4OhA4iK.e', 'user-avatar.png', '2023-05-17 15:30:41', '2023-05-17 15:30:41');
INSERT INTO `users` VALUES (3, 'user 3', 'user3@gmail.com', '$2y$10$/WVqWNsJiIewX9kTdN3qRO6NkJFvw4jkzCG5kO3DyZi7/o/DrRfSu', 'user-avatar.png', '2023-05-17 17:10:34', '2023-05-17 17:10:34');
INSERT INTO `users` VALUES (4, 'test user', 'test@gmail.com', '$2y$10$ciazJn3PT4NHgqgtlsIEpePeOSE91Y3OLE9Ce0XUKdk9eOubAlEXe', 'user-avatar.png', '2023-05-17 18:02:49', '2023-05-17 18:02:49');
INSERT INTO `users` VALUES (5, 'william', 'william@gmail.com', '$2y$10$53vbOpYCR9lyALjfj/NjxeNUAcMo/wrEavknMlWm7B6SOz0NJRqeG', 'user-avatar.png', '2023-05-19 09:02:45', '2023-05-19 09:02:45');

SET FOREIGN_KEY_CHECKS = 1;

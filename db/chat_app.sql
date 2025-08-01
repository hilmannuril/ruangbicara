/*
 Navicat Premium Data Transfer

 Source Server         : MY_CONN
 Source Server Type    : MySQL
 Source Server Version : 50516
 Source Host           : localhost:3306
 Source Schema         : chat_app

 Target Server Type    : MySQL
 Target Server Version : 50516
 File Encoding         : 65001

 Date: 13/06/2025 10:20:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for messages
-- ----------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `message` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of messages
-- ----------------------------
INSERT INTO `messages` VALUES (17, 'hilman', 'hgkjzsgjdhfgasdgfawde', '2025-06-12 06:19:23');
INSERT INTO `messages` VALUES (18, 'hilman', 'asdasfasdfgsad', '2025-06-12 06:23:06');
INSERT INTO `messages` VALUES (19, 'hilman', 'asdfgasdv', '2025-06-12 06:23:13');
INSERT INTO `messages` VALUES (20, 'hilman', 'Apa kabar ya', '2025-06-12 06:23:39');
INSERT INTO `messages` VALUES (21, 'hilman', 'Selamat datang', '2025-06-12 06:23:42');
INSERT INTO `messages` VALUES (22, 'adnan', 'haloo pak', '2025-06-12 08:00:52');
INSERT INTO `messages` VALUES (23, 'hilman', 'udah belajar', '2025-06-12 08:00:59');
INSERT INTO `messages` VALUES (24, 'maman', 'Hai', '2025-06-13 10:19:43');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'hilman');
INSERT INTO `users` VALUES (2, 'Pengajar');
INSERT INTO `users` VALUES (3, 'Eza');
INSERT INTO `users` VALUES (4, 'hilman');
INSERT INTO `users` VALUES (5, 'hilman@stiki.ac.id');
INSERT INTO `users` VALUES (6, 'maman');
INSERT INTO `users` VALUES (7, 'adnan');
INSERT INTO `users` VALUES (8, 'hilman');
INSERT INTO `users` VALUES (9, 'nasmdja');
INSERT INTO `users` VALUES (10, 'hilman');
INSERT INTO `users` VALUES (11, 'hilman');
INSERT INTO `users` VALUES (12, 'jagoan');
INSERT INTO `users` VALUES (13, 'hilman');
INSERT INTO `users` VALUES (14, 'jajang');
INSERT INTO `users` VALUES (15, 'Goman');
INSERT INTO `users` VALUES (16, 'jojo');
INSERT INTO `users` VALUES (17, 'hanhan');
INSERT INTO `users` VALUES (18, 'jajang');
INSERT INTO `users` VALUES (19, 'hilman');
INSERT INTO `users` VALUES (20, 'hilman');
INSERT INTO `users` VALUES (21, 'adnan');
INSERT INTO `users` VALUES (22, 'maman');

SET FOREIGN_KEY_CHECKS = 1;

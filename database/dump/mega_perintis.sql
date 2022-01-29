/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100419
 Source Host           : localhost:3306
 Source Schema         : mega_perintis

 Target Server Type    : MySQL
 Target Server Version : 100419
 File Encoding         : 65001

 Date: 29/01/2022 21:45:46
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for m_access_key
-- ----------------------------
DROP TABLE IF EXISTS `m_access_key`;
CREATE TABLE `m_access_key`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(450) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `expired_at` datetime(0) NOT NULL,
  `flag_active` tinyint(1) NULL DEFAULT NULL COMMENT '0 INACTIVE | 1 ACTIVE',
  `created_by` int(11) NOT NULL,
  `created_at` datetime(0) NOT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_access_key
-- ----------------------------
INSERT INTO `m_access_key` VALUES (1, 'eyJpdiI6InNZa0NlYWdEUnluSGIyUHpLUGJCY3c9PSIsInZhbHVlIjoiKzl3U3NXcEtUVnlzU2VaUVo4L1FmbUlYKzI4SzA1V2lKT29rdXFDaGV5TFd2NHQwcnN0bE9kS0pSNitRcDNNUERuQWZ0YktkSitScmRTeXB5UDRSZUJ6YXFVVDUrZi9PNkRyNlhRTXhnM0pMUkcrSUZCTnpmMElleTJoNlNxWXdMRjlVN2s2ZE95Y2l2Y3gzTFpJS3FSNGVHMEl2cTg5SzJPRXZPU1pGeGJQbEk3VDU0OSsrVzRtZC9SRTY2MXp1IiwibWFjIjoiYzA4MmU0MjJmNGI4YjA1OTI3ODFkNDJkNzczYmM2ZGUwOWZlNTc1YjMwMjcwNzg3N2RjNzg5ZDM1ZGVjNjdlMCIsInRhZyI6IiJ9', '2022-01-30 19:00:57', 0, 1, '2022-01-29 19:00:57', NULL, NULL);
INSERT INTO `m_access_key` VALUES (2, 'eyJpdiI6IlZaUXJDeGxSRG1oVFhCcWl4RklqUGc9PSIsInZhbHVlIjoiV215TjhxUHpSaDhIaUtGaXNnOUsxV0tnTmVtZUUvU3FBNEdvSkJNbnNxS0xyL0hZekRsRWdHZGowNG13ckZleWtKcnAvajNNSEIvUmg4dERVd3FrQ0RtZU9UNnZnTmhITGI3WjU0a3FkeFdvR1JUc0NqN3dLbUVURGd3STBxL0dPbzl0RDMrc3BhMWRBdno2cTA4YUxCM1Q5WXFvZHY3Z0NaVFo5eHhYcWZpYUJ3L0FGRG9yNGxqNTYrZGNqRjRQIiwibWFjIjoiNTM2NjRiNjJkNjNkM2Q1ZThjNGM2MTMxNzIwNDM4NjBhZGU4YmUwZTU5MmQ5NzY5MGM2OGI0MDljOGE1MTVhYSIsInRhZyI6IiJ9', '2022-01-30 19:01:18', 0, 1, '2022-01-29 19:01:18', 1, NULL);
INSERT INTO `m_access_key` VALUES (3, 'eyJpdiI6IlF5NDgrRTlhbGVYRzFKVFRTaGFONkE9PSIsInZhbHVlIjoiMzBVYnUrK05oUUpQV1grcit0R3BxSFlqL2pIRTAvdWxQRlR1dzhEemJ2NjNiRlkySlp6c2VuSGROQWV4ZzJtcWtic0d3OFQ5WkNJaEhyZTBBd1lWMDBCVktWQWJzQlloTS9LbElyV1g0NkFUeUVaT2d0TytreUk4UGhnR3FQQXVYZWw1dk1qZlRDaUFKUmp0M2J4WDNMTmt6MjZOTWxHTkVmeWVpNkZ0NlBUUFE5NndlQ2I0Q1dhZW1BRzNMNGYrIiwibWFjIjoiMmM2MzQxZjc0ZjFkZGM0YTljMDgwNGFkODg1YzZmZjFkOTI4ZDgwYTQyNTVhNWFkNjY4MWViYThhZjVjNzc2NCIsInRhZyI6IiJ9', '2022-01-30 19:10:46', 1, 1, '2022-01-29 19:10:46', NULL, NULL);

-- ----------------------------
-- Table structure for m_product
-- ----------------------------
DROP TABLE IF EXISTS `m_product`;
CREATE TABLE `m_product`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime(0) NOT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_product
-- ----------------------------
INSERT INTO `m_product` VALUES (1, 'Asus ROG 2021', 'Laptop/Notebook khusus gaming tahun 2021 keluaran Asus', 1, '2022-01-29 19:11:05', NULL, NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `username` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `flag_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_at` datetime(0) NOT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Agus Suandi', 'agus.suandi', 'agussuandi48@gmail.com', '$2a$12$eACeSQ46QsrctiQSkE46uOMCXlCpk1Mcgup7Z0yrHdVV.EMD35BPe', 1, 1, '2022-01-29 17:17:42', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;

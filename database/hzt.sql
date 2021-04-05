/*
 Navicat Premium Data Transfer

 Source Server         : 111
 Source Server Type    : MySQL
 Source Server Version : 100406
 Source Host           : localhost:3306
 Source Schema         : hzt

 Target Server Type    : MySQL
 Target Server Version : 100406
 File Encoding         : 65001

 Date: 05/04/2021 22:29:36
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for bills
-- ----------------------------
DROP TABLE IF EXISTS `bills`;
CREATE TABLE `bills`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_number` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tax_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `user_id` int(11) NULL DEFAULT NULL,
  `company_name` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `product_id` int(11) NULL DEFAULT NULL,
  `quantity` double(10, 2) NULL DEFAULT NULL,
  `total_amount` double(10, 2) NULL DEFAULT NULL,
  `bill_date` date NULL DEFAULT NULL,
  `days_of_credit` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `days_till_due` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT 0,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `bill_doc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bills
-- ----------------------------
INSERT INTO `bills` VALUES (5, 'Factura 001-001-000000382', '1793042716001', 2, 'LECHE EN POLVO DESCREMADA', 1, 25.00, 156.15, '2021-03-25', NULL, NULL, 1, '2021-03-24 20:38:08', '2021-03-27 09:42:57', NULL);
INSERT INTO `bills` VALUES (8, 'Factura 001-001-000000384', '1793042716001', 2, 'MELO BARBATO DIANA MARIA MELO BARBATO DIANA MARIA', 1, 45.00, 250.55, '2021-03-22', NULL, NULL, 1, '2021-03-24 21:31:27', '2021-03-27 09:42:42', NULL);
INSERT INTO `bills` VALUES (9, 'Factura 001-001-000000384', '1793042716001', 2, 'MELO BARBATO DIANA MARIA MELO BARBATO DIANA MARIA', 1, 30.00, 100.00, '2021-03-23', NULL, NULL, 1, '2021-03-24 21:32:52', '2021-03-27 09:42:52', NULL);
INSERT INTO `bills` VALUES (10, 'Factura 001-001-000000383', '1793042716001', 5, 'BARBATO DIANA', 2, 25.00, 134.50, '2021-03-21', NULL, NULL, 2, '2021-03-24 22:00:31', '2021-03-24 22:00:31', NULL);
INSERT INTO `bills` VALUES (11, 'Factura 001-001-000000384', '1793042716001', 5, 'BARBATO DIANA', 2, 25.00, 130.00, '2021-03-20', NULL, NULL, 2, '2021-03-24 22:00:56', '2021-03-24 22:00:56', NULL);
INSERT INTO `bills` VALUES (12, 'Factura 001-001-000000387', '1793042716001', 5, 'BARBATO DIANA', 3, 25.00, 200.00, '2021-03-19', NULL, NULL, 2, '2021-03-24 22:01:11', '2021-03-24 22:01:11', NULL);
INSERT INTO `bills` VALUES (13, 'Factura 001-001-000000388', '1793042716001', 5, 'BARBATO DIANA', 2, 25.00, 90.00, '2021-03-10', NULL, NULL, 2, '2021-03-24 22:01:25', '2021-03-24 22:01:25', NULL);
INSERT INTO `bills` VALUES (14, 'Factura 001-001-000000388', '1793042716001', 5, 'BARBATO DIANA', 4, 25.00, 149.00, '2021-03-12', NULL, NULL, 0, '2021-03-24 22:01:35', '2021-03-25 20:52:55', NULL);
INSERT INTO `bills` VALUES (15, 'Factura 001-001-000000388', '1793042716001', 5, 'BARBATO DIANA', 5, 25.00, 300.00, '2021-03-15', NULL, NULL, 2, '2021-03-24 22:01:41', '2021-03-24 22:01:41', NULL);
INSERT INTO `bills` VALUES (16, 'Factura 001-001-000000388', '1793042716001', 5, 'BARBATO DIANA', 6, 25.00, 250.00, '2021-03-16', NULL, NULL, 0, '2021-03-24 22:01:49', '2021-03-25 20:53:06', NULL);
INSERT INTO `bills` VALUES (17, 'Factura 001-001-000000382', '1793042716001', 2, 'DIANA MARIA', 2, 45.00, 234.00, '2021-03-17', NULL, NULL, 1, '2021-03-24 22:03:20', '2021-03-27 09:42:11', NULL);
INSERT INTO `bills` VALUES (18, 'Factura 001-001-000000382', '1793042716001', 2, 'DIANA MARIA', 1, 45.00, 221.00, '2021-03-18', NULL, NULL, 1, '2021-03-24 22:03:29', '2021-03-27 09:42:26', NULL);
INSERT INTO `bills` VALUES (19, 'Factura 001-001-000000382', '1793042716001', 2, 'DIANA MARIA', 3, 45.00, 187.00, '2021-03-19', NULL, NULL, 1, '2021-03-24 22:03:34', '2021-03-27 09:42:32', NULL);
INSERT INTO `bills` VALUES (20, 'Factura 001-001-000000382', '1793042716001', 2, 'DIANA MARIA', 4, 45.00, 154.00, '2021-03-20', NULL, NULL, 1, '2021-03-24 22:03:42', '2021-03-27 09:42:37', NULL);
INSERT INTO `bills` VALUES (21, 'Factura 001-001-000000382', '1793042716001', 2, 'DIANA MARIA', 4, 45.00, 130.00, '2021-03-22', NULL, NULL, 1, '2021-03-24 22:03:49', '2021-03-27 09:42:48', NULL);
INSERT INTO `bills` VALUES (22, 'Factura 001-001-000000382', '1793042716001', 4, 'MARIA', 3, 45.00, 130.00, '2021-03-13', NULL, NULL, 1, '2021-03-24 22:04:09', '2021-03-24 22:04:09', NULL);
INSERT INTO `bills` VALUES (23, 'Factura 001-001-000000382', '1793042716001', 4, 'MARIA', 5, 45.00, 154.00, '2021-03-14', NULL, NULL, 1, '2021-03-24 22:04:16', '2021-03-24 22:04:16', NULL);
INSERT INTO `bills` VALUES (24, 'Factura 001-001-000000382', '1793042716001', 4, 'MARIA', 5, 45.00, 167.00, '2021-03-16', NULL, NULL, 1, '2021-03-24 22:04:21', '2021-03-24 22:04:21', NULL);
INSERT INTO `bills` VALUES (25, 'Factura 001-001-000000382', '1793042716001', 4, 'MARIA', 5, 45.00, 158.00, '2021-03-18', NULL, NULL, 0, '2021-03-24 22:04:26', '2021-03-25 20:53:12', NULL);
INSERT INTO `bills` VALUES (26, 'Factura 001-001-000000382', '1793042716001', 4, 'MARIA', 6, 45.00, 198.00, '2021-03-20', NULL, NULL, 0, '2021-03-24 22:04:32', '2021-03-25 20:53:23', NULL);
INSERT INTO `bills` VALUES (27, 'new-bill-00231023', '2674354784835', 2, 'MArko', 6, 24.00, 896.00, '2021-03-24', NULL, NULL, 1, '2021-03-27 09:44:14', '2021-03-27 09:44:14', NULL);
INSERT INTO `bills` VALUES (28, 'Bill-23300012', '746573939', 5, 'Larlenda', 3, 40.00, 897.00, '2021-03-24', NULL, NULL, 2, '2021-03-27 09:45:12', '2021-03-27 09:45:12', NULL);
INSERT INTO `bills` VALUES (29, '34567890', '134578', 5, 'sdxfr', 3, 55.00, 1800.00, '2021-03-22', NULL, NULL, 2, '2021-03-27 11:15:31', '2021-03-27 11:15:31', NULL);
INSERT INTO `bills` VALUES (30, '123456789', '4342352356', 5, 'ffdsfsff', 5, 45.00, 560.00, '2021-04-02', NULL, NULL, 1, '2021-04-05 10:50:14', '2021-04-05 10:50:14', '');
INSERT INTO `bills` VALUES (31, '123456789', '4342352356', 5, 'ffdsfsff', 5, 45.00, 560.00, '2021-04-02', NULL, NULL, 1, '2021-04-05 10:51:49', '2021-04-05 11:05:27', '');
INSERT INTO `bills` VALUES (32, '123456789', '4342352356', 5, 'ffdsfsff', 5, 45.00, 560.00, '2021-04-02', NULL, NULL, 1, '2021-04-05 10:52:31', '2021-04-05 10:52:31', '09c962fbdc8eb3036aca2c2e36009871.docx');

-- ----------------------------
-- Table structure for notifications
-- ----------------------------
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `detail` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT 0,
  `created_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of notifications
-- ----------------------------
INSERT INTO `notifications` VALUES (1, 5, 'Confirmed your goal status : $1751.50 You will receive $35.03 .', 1, '2021-03-27 10:30:07');
INSERT INTO `notifications` VALUES (2, 2, 'Honey Dev has been reached goal score. $1500.00 / $1800.00 .', 1, '2021-03-27 11:15:31');
INSERT INTO `notifications` VALUES (3, 5, 'Confirmed your goal status : $1800.00 You will receive $36.00 .', 1, '2021-03-27 11:21:37');
INSERT INTO `notifications` VALUES (4, 2, 'Honey Dev has been reached goal score. $1,500.00/$1,680.00 .', 0, '2021-04-05 10:52:31');

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 'Product 1', '2021-04-03 23:57:23', '2021-04-03 23:57:28');
INSERT INTO `products` VALUES (2, 'Product 2', '2021-04-03 23:57:49', '2021-04-03 23:58:05');
INSERT INTO `products` VALUES (3, 'Product 3', '2021-04-03 23:57:51', '2021-04-03 23:58:08');
INSERT INTO `products` VALUES (4, 'Product 4', '2021-04-03 23:57:54', '2021-04-03 23:58:11');
INSERT INTO `products` VALUES (5, 'Product 5', '2021-04-03 23:57:57', '2021-04-03 23:58:15');
INSERT INTO `products` VALUES (6, 'Product 6', '2021-04-03 23:58:03', '2021-04-03 23:58:18');
INSERT INTO `products` VALUES (7, 'Product 8', '2021-04-05 02:07:02', '2021-04-05 02:07:16');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `first_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `surname` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `role` int(1) NULL DEFAULT 0,
  `status` int(1) NULL DEFAULT 0,
  `goal` double(11, 2) NULL DEFAULT 0,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_verified` int(1) NULL DEFAULT 0,
  `goal_status` double(10, 2) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (2, 'john123', 'John', 'Marko', 'f5bb0c8de146c67b44babbf4e6584cc0', 1, 1, 1000.50, '2021-03-22 22:58:40', '2021-03-30 22:51:18', 'info@john.com', 0, 2328.70);
INSERT INTO `users` VALUES (4, 'richmond', 'Richmond', 'Handson', 'fba390e8f139bedc115d6489af4fcb72', 0, 0, 1200.00, '2021-03-22 23:02:42', '2021-03-27 09:26:18', 'info@richmond.com', 0, 451.00);
INSERT INTO `users` VALUES (5, 'honeydev', 'Honey', 'Dev', 'fba390e8f139bedc115d6489af4fcb72', 0, 1, 1500.00, '2021-03-23 22:25:37', '2021-04-05 11:05:27', 'honeydev@gmail.com', 0, 1680.00);

SET FOREIGN_KEY_CHECKS = 1;

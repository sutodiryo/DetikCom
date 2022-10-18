/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100421
 Source Host           : localhost:3306
 Source Schema         : db_detik

 Target Server Type    : MySQL
 Target Server Version : 100421
 File Encoding         : 65001

 Date: 18/10/2022 18:54:11
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for transaction
-- ----------------------------
DROP TABLE IF EXISTS `transaction`;
CREATE TABLE `transaction` (
  `invoice_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `item_name` varchar(250) DEFAULT NULL,
  `amount` double(10,2) DEFAULT NULL,
  `payment_type` varchar(50) DEFAULT NULL,
  `customer_name` varchar(250) DEFAULT NULL,
  `merchant_id` int(11) DEFAULT NULL,
  `references_id` varchar(100) DEFAULT NULL,
  `number_va` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

SET FOREIGN_KEY_CHECKS = 1;

/*
 Navicat Premium Data Transfer

 Source Server         : sovta
 Source Server Type    : MySQL
 Source Server Version : 100315
 Source Host           : localhost:3306
 Source Schema         : auctions

 Target Server Type    : MySQL
 Target Server Version : 100315
 File Encoding         : 65001

 Date: 18/06/2019 21:06:01
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins`  (
  `admin_id` int(7) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ended_at` datetime(0) NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`admin_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES (1, NULL, 1);

-- ----------------------------
-- Table structure for bids
-- ----------------------------
DROP TABLE IF EXISTS `bids`;
CREATE TABLE `bids`  (
  `bid_id` int(7) UNSIGNED NOT NULL AUTO_INCREMENT,
  `amount` decimal(10, 2) NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `user_id` int(7) UNSIGNED NOT NULL,
  `listing_id` int(7) UNSIGNED NOT NULL,
  PRIMARY KEY (`bid_id`) USING BTREE,
  INDEX `bids_users_fk`(`user_id`) USING BTREE,
  INDEX `bids_listings_fk`(`listing_id`) USING BTREE,
  CONSTRAINT `bids_listings_fk` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`listing_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `bids_users_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bids
-- ----------------------------
INSERT INTO `bids` VALUES (3, 500.00, '2019-06-17 01:07:36', 8, 18);
INSERT INTO `bids` VALUES (4, 1200.00, '2019-06-17 01:30:23', 8, 16);
INSERT INTO `bids` VALUES (5, 600.00, '2019-06-17 19:23:37', 8, 18);
INSERT INTO `bids` VALUES (6, 700.00, '2019-06-17 19:23:44', 8, 18);
INSERT INTO `bids` VALUES (7, 800.00, '2019-06-17 19:25:00', 8, 18);

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `category_id` int(7) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(7) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`) USING BTREE,
  UNIQUE INDEX `categories_name_uk`(`name`) USING BTREE,
  INDEX `categories_parent_id_fk`(`parent_id`) USING BTREE,
  CONSTRAINT `categories_parent_id_fk` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`category_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (1, 'Books', NULL);
INSERT INTO `categories` VALUES (2, 'Journals', 1);
INSERT INTO `categories` VALUES (3, 'Music', NULL);
INSERT INTO `categories` VALUES (4, 'CDs', 3);
INSERT INTO `categories` VALUES (5, 'Toys & Games', NULL);
INSERT INTO `categories` VALUES (6, 'Action Figures', 5);
INSERT INTO `categories` VALUES (7, 'Dolls', 5);
INSERT INTO `categories` VALUES (8, 'Board Games', 5);
INSERT INTO `categories` VALUES (9, 'Cars', NULL);
INSERT INTO `categories` VALUES (10, 'Mobile Phones', NULL);
INSERT INTO `categories` VALUES (11, 'Collectibles', NULL);
INSERT INTO `categories` VALUES (12, 'Art', 11);
INSERT INTO `categories` VALUES (13, 'Antiques', 11);
INSERT INTO `categories` VALUES (14, 'Coins & Paper', 11);
INSERT INTO `categories` VALUES (15, 'Paintings', 12);
INSERT INTO `categories` VALUES (16, 'Ceramics', 12);
INSERT INTO `categories` VALUES (17, 'Photography', 12);
INSERT INTO `categories` VALUES (18, 'Magazines', 1);
INSERT INTO `categories` VALUES (19, 'Vinyl', 3);

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments`  (
  `comment_id` int(7) UNSIGNED NOT NULL AUTO_INCREMENT,
  `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `user_id` int(7) UNSIGNED NOT NULL,
  `listing_id` int(7) UNSIGNED NOT NULL,
  PRIMARY KEY (`comment_id`) USING BTREE,
  INDEX `comments_users_fk`(`user_id`) USING BTREE,
  INDEX `comments_listings_fk`(`listing_id`) USING BTREE,
  CONSTRAINT `comments_listings_fk` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`listing_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `comments_users_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers`  (
  `customer_id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `bank_account_number` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `shipping_address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `payment_method` enum('Credit Card','Mobile Payment','Bank Transfer','Ewallet','Prepaid Card','Direct Deposit','Cash') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`customer_id`) USING BTREE,
  UNIQUE INDEX `customers_bank_account_number_uk`(`bank_account_number`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES (7, '1043634663463', 'Sveti Nikola 9', 'Credit Card');
INSERT INTO `customers` VALUES (8, '1043638663467', 'Jablanicka 20', 'Credit Card');
INSERT INTO `customers` VALUES (9, '45245245445', 'Hollywood 10', 'Credit Card');
INSERT INTO `customers` VALUES (10, '6043624663467', 'Sveti Nikola 11', 'Credit Card');
INSERT INTO `customers` VALUES (11, '1043634663479', 'Vrbnicka 2', 'Credit Card');
INSERT INTO `customers` VALUES (13, '1043623563479', 'Vrbnicka 2', 'Credit Card');
INSERT INTO `customers` VALUES (14, '1043749651463', 'Car Dusan 10', 'Direct Deposit');

-- ----------------------------
-- Table structure for listings
-- ----------------------------
DROP TABLE IF EXISTS `listings`;
CREATE TABLE `listings`  (
  `listing_id` int(7) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `expires_at` datetime(0) NOT NULL,
  `starting_price` decimal(10, 2) NOT NULL,
  `buyout_price` decimal(10, 2) NULL DEFAULT NULL,
  `title` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(7) UNSIGNED NOT NULL,
  `category_id` int(7) UNSIGNED NOT NULL,
  PRIMARY KEY (`listing_id`) USING BTREE,
  INDEX `listings_users_fk`(`user_id`) USING BTREE,
  INDEX `listings_categories_fk`(`category_id`) USING BTREE,
  CONSTRAINT `listings_categories_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `listings_users_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of listings
-- ----------------------------
INSERT INTO `listings` VALUES (10, '2019-06-15 03:16:09', '2020-10-10 10:10:00', 1500.00, 0.00, 'Proba 1', 'gdasgdssd', 'auctions/Paintings/formula.jpg', 7, 15);
INSERT INTO `listings` VALUES (11, '2019-06-15 22:43:54', '2019-12-10 10:10:00', 1500.00, 0.00, 'The Clash - Londong Calling', 'Great album!', 'auctions/Vinyl/1.jpg', 7, 19);
INSERT INTO `listings` VALUES (14, '2019-06-15 22:47:24', '2019-12-03 08:00:00', 750.00, 0.00, 'Jimi Hendrix - Axis Bold as Love', 'It\'s Jimmy.', 'auctions/Vinyl/4.jpg', 7, 19);
INSERT INTO `listings` VALUES (16, '2019-06-15 22:48:52', '2019-08-05 03:00:00', 1000.00, 1500.00, 'Pink Floyd - Animals', 'Bid on you crazy bidder!', 'auctions/Vinyl/6.jpg', 7, 19);
INSERT INTO `listings` VALUES (18, '2019-06-15 22:50:30', '2019-10-15 20:00:00', 450.00, 0.00, 'The Doors - LA Woman', 'Doors', 'auctions/Vinyl/8.jpg', 7, 19);
INSERT INTO `listings` VALUES (19, '2019-06-15 22:51:01', '2019-10-18 20:00:00', 2450.00, 0.00, 'Motorhead - Ace of Spades', 'The only card i need...', 'auctions/Vinyl/9.jpg', 7, 19);
INSERT INTO `listings` VALUES (20, '2019-06-15 22:51:58', '2019-11-30 07:00:00', 1350.00, 0.00, 'David Bowie - The Rise and Fall of Ziggy Stardust ', 'Don\'t forget the Spiders from Mars', 'auctions/Vinyl/10.jpg', 7, 19);
INSERT INTO `listings` VALUES (21, '2019-06-16 02:48:58', '2020-11-11 00:00:00', 500.00, 750.00, 'edgar allan poe', 'Collection of stories.', 'auctions/Books/11.jpg', 8, 1);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `user_id` int(7) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `forename` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `phone` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `admin_id` int(7) UNSIGNED NULL DEFAULT NULL,
  `customer_id` int(7) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE,
  UNIQUE INDEX `users_username_uk`(`username`) USING BTREE,
  UNIQUE INDEX `users_password_uk`(`password`) USING BTREE,
  UNIQUE INDEX `users_email_uk`(`email`) USING BTREE,
  INDEX `users_admins_fk`(`admin_id`) USING BTREE,
  INDEX `users_customers_fk`(`customer_id`) USING BTREE,
  CONSTRAINT `users_admins_fk` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`admin_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `users_customers_fk` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (2, 'Sovta', 'Outlaws', 'Bojan', 'Sovtic', 'Vrbnicka 28', '0642574803', 'bojansovtic92@gmail.com', '2019-06-14 00:58:36', 1, NULL);
INSERT INTO `users` VALUES (4, 'Jedi', 'abe1dbfa0e6a2d98b0099060beed9e00', 'Marko', 'Nikolic', '', '', 'mnikolic@gmail.com', '2019-06-14 03:50:56', NULL, 7);
INSERT INTO `users` VALUES (5, 'Dragan', '425df8baeab41d64506332481ab19e08', 'Dragan', 'Simic', 'Jablanicka 20', '0657892148', 'gigi@gmail.com', '2019-06-14 23:23:13', NULL, 8);
INSERT INTO `users` VALUES (6, 'Lemi', 'ce7379bc4669f40da498d9328fe6df16', 'Lemi', 'Kilmister', '', '', 'lemi@gmail.com', '2019-06-14 23:25:06', NULL, 9);
INSERT INTO `users` VALUES (7, 'Test', '$2y$10$oj02i5o4Dz8LkuD8C0/cGu/7qFIGtb8lMVRPrnww3U3t3lXzui8Au', 'Bojan', 'Sovtic', '', '', 'admin@gmail.com', '2019-06-14 23:51:25', NULL, 13);
INSERT INTO `users` VALUES (8, 'Bidder', '$2y$10$0eFupdIWn21SqqbliKDyfumN4Cg/6Anio.1cfN1mKswNFog07tsli', 'Nikola', 'Stojanovic', '', '', 'bidder@gmail.com', '2019-06-16 02:47:41', NULL, 14);

-- ----------------------------
-- Triggers structure for table bids
-- ----------------------------
DROP TRIGGER IF EXISTS `bids_bis_trg`;
delimiter ;;
CREATE TRIGGER `bids_bis_trg` BEFORE INSERT ON `bids` FOR EACH ROW BEGIN
	IF NEW.amount < (SELECT MAX(amount) FROM bids WHERE listing_id = NEW.listing_id) + 100 THEN
		SIGNAL SQLSTATE '50005' SET MESSAGE_TEXT = "Bid must be at least 100 or more higher than the current max bid.";
		END IF;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table bids
-- ----------------------------
DROP TRIGGER IF EXISTS `bids_bup_trg`;
delimiter ;;
CREATE TRIGGER `bids_bup_trg` BEFORE UPDATE ON `bids` FOR EACH ROW BEGIN
	IF NEW.amount < (SELECT MAX(amount) FROM bids WHERE listing_id = NEW.listing_id) + 100 THEN
		SIGNAL SQLSTATE '50005' SET MESSAGE_TEXT = "Bid must be at least 100 or more higher than the current max bid.";
		END IF;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table listings
-- ----------------------------
DROP TRIGGER IF EXISTS `listings_bis_trg`;
delimiter ;;
CREATE TRIGGER `listings_bis_trg` BEFORE INSERT ON `listings` FOR EACH ROW BEGIN
	IF NEW.starting_price < 100 THEN
			SIGNAL SQLSTATE '50001' SET MESSAGE_TEXT = "Starting price must be equal or above 100.";
	END IF;
	
	IF NEW.expires_at < date_add(NOW(), INTERVAL 30 DAY) THEN
			SIGNAL SQLSTATE '50003' SET MESSAGE_TEXT = "Expire date must be 30 or more days later.";
		END IF;
	
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table listings
-- ----------------------------
DROP TRIGGER IF EXISTS `listings_bup_trg`;
delimiter ;;
CREATE TRIGGER `listings_bup_trg` BEFORE UPDATE ON `listings` FOR EACH ROW BEGIN
	IF NEW.starting_price < 100 THEN
			SIGNAL SQLSTATE '50001' SET MESSAGE_TEXT = "Starting price must be equal or above 100.";
	END IF;
	
	IF NEW.expires_at < date_add(NOW(), INTERVAL 30 DAY) THEN
			SIGNAL SQLSTATE '50003' SET MESSAGE_TEXT = "Expire date must be 30 or more days later.";
		END IF;
	
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table users
-- ----------------------------
DROP TRIGGER IF EXISTS `users_bis_trg`;
delimiter ;;
CREATE TRIGGER `users_bis_trg` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
	IF NEW.admin_id IS NULL && NEW.customer_id IS NULL THEN
			SIGNAL SQLSTATE '50004' SET MESSAGE_TEXT = "User must be admin or customer.";
	END IF;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table users
-- ----------------------------
DROP TRIGGER IF EXISTS `users_bup_trg`;
delimiter ;;
CREATE TRIGGER `users_bup_trg` BEFORE UPDATE ON `users` FOR EACH ROW BEGIN
	IF NEW.admin_id IS NULL && NEW.customer_id IS NULL THEN
			SIGNAL SQLSTATE '50004' SET MESSAGE_TEXT = "User must be admin or customer.";
	END IF;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;

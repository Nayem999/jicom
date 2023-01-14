#
# TABLE STRUCTURE FOR: tec_adv_collection
#

DROP TABLE IF EXISTS `tec_adv_collection`;

CREATE TABLE `tec_adv_collection` (
  `adv_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `adv_collection` int(11) NOT NULL,
  `total_collection` int(11) NOT NULL,
  `today_collect_id` int(11) DEFAULT NULL,
  `add_date` datetime NOT NULL,
  `note` varchar(255) NOT NULL,
  `store_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`adv_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

INSERT INTO `tec_adv_collection` (`adv_id`, `customer_id`, `adv_collection`, `total_collection`, `today_collect_id`, `add_date`, `note`, `store_id`) VALUES ('1', '3', '0', '10000', '1', '2020-07-29 18:03:56', '', '1');
INSERT INTO `tec_adv_collection` (`adv_id`, `customer_id`, `adv_collection`, `total_collection`, `today_collect_id`, `add_date`, `note`, `store_id`) VALUES ('2', '3', '0', '20000', '2', '2020-08-09 20:03:24', '<p>A.K COMPUTER</p><p>ISLAMI BANK</p><p>CHEQUE# 8657124</p><p>date: 20/08/2020</p>', '1');
INSERT INTO `tec_adv_collection` (`adv_id`, `customer_id`, `adv_collection`, `total_collection`, `today_collect_id`, `add_date`, `note`, `store_id`) VALUES ('3', '4', '0', '70', '3', '2020-08-27 20:27:23', '<p>FOR BHUIYAN TECHNOLOGY PAY7MENT</p>', '1');
INSERT INTO `tec_adv_collection` (`adv_id`, `customer_id`, `adv_collection`, `total_collection`, `today_collect_id`, `add_date`, `note`, `store_id`) VALUES ('4', '3', '0', '18000', '4', '2020-08-30 19:37:38', '<p>CHEQUE#,8657130 , DATE: 13/09/2020</p><p>ISLAMI BANK LTD.</p>', '1');
INSERT INTO `tec_adv_collection` (`adv_id`, `customer_id`, `adv_collection`, `total_collection`, `today_collect_id`, `add_date`, `note`, `store_id`) VALUES ('5', '3', '0', '18800', '5', '2020-08-30 19:38:49', '<p>CHEQUE# 8657131, DATE: 20/09/2020</p><p>ISLAMI BANK LTD.</p>', '1');
INSERT INTO `tec_adv_collection` (`adv_id`, `customer_id`, `adv_collection`, `total_collection`, `today_collect_id`, `add_date`, `note`, `store_id`) VALUES ('6', '3', '0', '2200', '6', '2020-08-30 19:40:13', '<p>CHEQUE # 8657132, DATE: 20/09/2020</p><p>ISLAMI BANK LTD.</p>', '1');
INSERT INTO `tec_adv_collection` (`adv_id`, `customer_id`, `adv_collection`, `total_collection`, `today_collect_id`, `add_date`, `note`, `store_id`) VALUES ('7', '3', '0', '3000', '7', '2020-08-30 19:53:10', '<p>S.M MAHMUD SHARAFAT</p><p>CASH COLLECTION</p>', '1');
INSERT INTO `tec_adv_collection` (`adv_id`, `customer_id`, `adv_collection`, `total_collection`, `today_collect_id`, `add_date`, `note`, `store_id`) VALUES ('8', '5', '0', '9500', '8', '2020-08-30 20:29:11', '<p>bill # 4</p>', '1');
INSERT INTO `tec_adv_collection` (`adv_id`, `customer_id`, `adv_collection`, `total_collection`, `today_collect_id`, `add_date`, `note`, `store_id`) VALUES ('9', '4', '0', '6300', '9', '2020-09-12 19:43:03', '<p>CASH COLLECTION (  for TR COMPUTER PAYMENT)</p>', '1');
INSERT INTO `tec_adv_collection` (`adv_id`, `customer_id`, `adv_collection`, `total_collection`, `today_collect_id`, `add_date`, `note`, `store_id`) VALUES ('10', '5', '0', '4500', '10', '2020-09-12 19:47:03', '<p>CASH COLLECTION ( S.M MAHMUD SHARAFAT )</p>', '1');
INSERT INTO `tec_adv_collection` (`adv_id`, `customer_id`, `adv_collection`, `total_collection`, `today_collect_id`, `add_date`, `note`, `store_id`) VALUES ('11', '5', '0', '8000', '11', '2020-09-14 18:17:28', '<p>cash collection</p>', '1');
INSERT INTO `tec_adv_collection` (`adv_id`, `customer_id`, `adv_collection`, `total_collection`, `today_collect_id`, `add_date`, `note`, `store_id`) VALUES ('12', '5', '0', '850', '12', '2020-09-14 19:31:33', '', '1');
INSERT INTO `tec_adv_collection` (`adv_id`, `customer_id`, `adv_collection`, `total_collection`, `today_collect_id`, `add_date`, `note`, `store_id`) VALUES ('13', '5', '0', '8000', '13', '2020-09-20 11:59:09', '<p>DATE: 20/09/2020</p><p>CASH</p>', '1');
INSERT INTO `tec_adv_collection` (`adv_id`, `customer_id`, `adv_collection`, `total_collection`, `today_collect_id`, `add_date`, `note`, `store_id`) VALUES ('14', '10', '0', '4750', '14', '2020-09-24 19:24:01', '<p>DATE: 24/09/2020</p><p>Sep 24 2020 7:18PM 1524203491061001 00530210005329 CREATIVE CITY TECHNOLO CCT TBL TRUST BANK LTD. EFT 4,750.00<br></p>', '1');
INSERT INTO `tec_adv_collection` (`adv_id`, `customer_id`, `adv_collection`, `total_collection`, `today_collect_id`, `add_date`, `note`, `store_id`) VALUES ('15', '8', '0', '19600', '15', '2020-09-27 16:24:30', '<p>DATE: 26/09/2020</p><p>COLLECTION BY C. CARD BRACK BANK</p>', '1');
INSERT INTO `tec_adv_collection` (`adv_id`, `customer_id`, `adv_collection`, `total_collection`, `today_collect_id`, `add_date`, `note`, `store_id`) VALUES ('16', '9', '0', '2000', '16', '2020-09-27 18:35:47', '<p>DATE: 26/09/2020</p>', '1');
INSERT INTO `tec_adv_collection` (`adv_id`, `customer_id`, `adv_collection`, `total_collection`, `today_collect_id`, `add_date`, `note`, `store_id`) VALUES ('17', '12', '0', '10000', '17', '2020-10-01 19:28:20', '<p>28/09/2020</p><p>CS, BRAC BANK</p>', '1');
INSERT INTO `tec_adv_collection` (`adv_id`, `customer_id`, `adv_collection`, `total_collection`, `today_collect_id`, `add_date`, `note`, `store_id`) VALUES ('18', '12', '0', '9000', '18', '2020-10-01 19:28:58', '<p>30/09/2020</p><p>CS, BRAC BANK</p>', '1');
INSERT INTO `tec_adv_collection` (`adv_id`, `customer_id`, `adv_collection`, `total_collection`, `today_collect_id`, `add_date`, `note`, `store_id`) VALUES ('19', '5', '0', '8000', '19', '2020-10-06 15:32:41', '<p>DATE: 05/10/2020</p><p>3,000+5,000= 10,000/=</p>', '1');
INSERT INTO `tec_adv_collection` (`adv_id`, `customer_id`, `adv_collection`, `total_collection`, `today_collect_id`, `add_date`, `note`, `store_id`) VALUES ('20', '14', '0', '9350', '20', '2020-10-12 15:09:14', '<p>DATE: 12/10/2020</p><p>CASH COLLECTION</p>', '1');
INSERT INTO `tec_adv_collection` (`adv_id`, `customer_id`, `adv_collection`, `total_collection`, `today_collect_id`, `add_date`, `note`, `store_id`) VALUES ('21', '13', '0', '9500', '21', '2020-10-13 16:42:10', '<p>DATE: 13/10/2020</p><p>BY CS BRAC BANK</p><p>CHEQUE# 4852389 = 8,000/=</p><p>BANK CHARGE       = 1500/=</p>', '1');
INSERT INTO `tec_adv_collection` (`adv_id`, `customer_id`, `adv_collection`, `total_collection`, `today_collect_id`, `add_date`, `note`, `store_id`) VALUES ('22', '11', '0', '3550', '23', '2020-10-21 19:48:24', '<p>DATE: 21/10/2020</p><p>CASH FOR UCC PAYMENT</p>', '1');
INSERT INTO `tec_adv_collection` (`adv_id`, `customer_id`, `adv_collection`, `total_collection`, `today_collect_id`, `add_date`, `note`, `store_id`) VALUES ('23', '8', '0', '800', '26', '2020-12-13 19:00:29', '<p>DATE: 12/12/2020</p><p>BKASH</p>', '1');


#
# TABLE STRUCTURE FOR: tec_adv_payment
#

DROP TABLE IF EXISTS `tec_adv_payment`;

CREATE TABLE `tec_adv_payment` (
  `adv_id` int(11) NOT NULL AUTO_INCREMENT,
  `suppliers_id` int(11) NOT NULL,
  `adv_amount` int(11) NOT NULL,
  `total_payment` int(11) NOT NULL,
  `add_date` datetime NOT NULL,
  `today_payment_id` int(11) NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `store_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`adv_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tec_adv_payment` (`adv_id`, `suppliers_id`, `adv_amount`, `total_payment`, `add_date`, `today_payment_id`, `note`, `store_id`) VALUES ('2', '1', '0', '9500', '2020-07-29 18:07:53', '2', '<p>CASH</p>', '1');
INSERT INTO `tec_adv_payment` (`adv_id`, `suppliers_id`, `adv_amount`, `total_payment`, `add_date`, `today_payment_id`, `note`, `store_id`) VALUES ('3', '1', '0', '15000', '2020-08-10 14:35:57', '3', '<p>DATE: 09/08/2020</p><p>M.R # 0669</p><p>CASH</p>', '1');
INSERT INTO `tec_adv_payment` (`adv_id`, `suppliers_id`, `adv_amount`, `total_payment`, `add_date`, `today_payment_id`, `note`, `store_id`) VALUES ('4', '1', '0', '3500', '2020-08-11 12:40:30', '4', '<p>DATE: 11/08/2020</p><p>M.R # 0690</p><p>CASH</p>', '1');
INSERT INTO `tec_adv_payment` (`adv_id`, `suppliers_id`, `adv_amount`, `total_payment`, `add_date`, `today_payment_id`, `note`, `store_id`) VALUES ('5', '2', '0', '650', '2020-08-11 19:43:48', '5', '<p>CASH PAYMENT for INV. # 4280</p>', '1');
INSERT INTO `tec_adv_payment` (`adv_id`, `suppliers_id`, `adv_amount`, `total_payment`, `add_date`, `today_payment_id`, `note`, `store_id`) VALUES ('6', '3', '0', '28000', '2020-08-20 17:02:57', '6', '<p>DATE: 20/08/2020</p><p>CHEQUE#0391837</p><p>TRUST BANK</p>', '1');
INSERT INTO `tec_adv_payment` (`adv_id`, `suppliers_id`, `adv_amount`, `total_payment`, `add_date`, `today_payment_id`, `note`, `store_id`) VALUES ('7', '2', '0', '70', '2020-08-27 20:25:02', '7', '', '1');
INSERT INTO `tec_adv_payment` (`adv_id`, `suppliers_id`, `adv_amount`, `total_payment`, `add_date`, `today_payment_id`, `note`, `store_id`) VALUES ('8', '1', '0', '21000', '2020-08-30 19:35:08', '8', '<p>STAN NO: 025449, TRAN DATE: 30-08-2020</p>', '1');
INSERT INTO `tec_adv_payment` (`adv_id`, `suppliers_id`, `adv_amount`, `total_payment`, `add_date`, `today_payment_id`, `note`, `store_id`) VALUES ('9', '1', '0', '2760', '2020-09-08 14:16:40', '9', '<p>DATE: 29/08/2020</p>', '1');
INSERT INTO `tec_adv_payment` (`adv_id`, `suppliers_id`, `adv_amount`, `total_payment`, `add_date`, `today_payment_id`, `note`, `store_id`) VALUES ('10', '1', '0', '700', '2020-09-08 14:20:28', '10', '<p>DATE: 02/09/2020</p><p>INV.# 20001025</p><p>WEBCAME: CHINA ORIGIN, 720P WITH BUIL T-IN</p><p>MICROPHONE 1 PCS PURCHASES RETURN</p><p><br></p>', '1');
INSERT INTO `tec_adv_payment` (`adv_id`, `suppliers_id`, `adv_amount`, `total_payment`, `add_date`, `today_payment_id`, `note`, `store_id`) VALUES ('11', '7', '0', '22400', '2020-09-12 17:43:14', '11', '<p>DATE: 13/09/2020</p><p>TRUST BANK</p><p>CHEQUE # 0391846</p>', '1');
INSERT INTO `tec_adv_payment` (`adv_id`, `suppliers_id`, `adv_amount`, `total_payment`, `add_date`, `today_payment_id`, `note`, `store_id`) VALUES ('12', '6', '0', '6300', '2020-09-12 17:45:13', '12', '<p>CASH PAYMENT</p><p>DATE: 12/09/2020</p>', '1');
INSERT INTO `tec_adv_payment` (`adv_id`, `suppliers_id`, `adv_amount`, `total_payment`, `add_date`, `today_payment_id`, `note`, `store_id`) VALUES ('13', '1', '0', '18000', '2020-09-14 19:25:00', '13', '<p>CHEQUE # 0391847</p><p>DATE: 15/09/2020</p><p>TRUST BANK ( CCT)</p>', '1');
INSERT INTO `tec_adv_payment` (`adv_id`, `suppliers_id`, `adv_amount`, `total_payment`, `add_date`, `today_payment_id`, `note`, `store_id`) VALUES ('14', '5', '0', '850', '2020-09-14 19:32:09', '14', '', '1');
INSERT INTO `tec_adv_payment` (`adv_id`, `suppliers_id`, `adv_amount`, `total_payment`, `add_date`, `today_payment_id`, `note`, `store_id`) VALUES ('15', '1', '0', '9600', '2020-09-19 19:51:01', '15', '<p>DATE: 20/09/2020</p><p>TRUST BANK </p><p>CHEQUE # 0391850</p>', '1');
INSERT INTO `tec_adv_payment` (`adv_id`, `suppliers_id`, `adv_amount`, `total_payment`, `add_date`, `today_payment_id`, `note`, `store_id`) VALUES ('16', '1', '0', '9200', '2020-10-12 13:04:43', '16', '<p>DATE: 12/10/2020</p><p>TRUST BANK</p><p>CHEQUE# 0391857</p>', '1');
INSERT INTO `tec_adv_payment` (`adv_id`, `suppliers_id`, `adv_amount`, `total_payment`, `add_date`, `today_payment_id`, `note`, `store_id`) VALUES ('17', '1', '0', '9200', '2020-10-12 15:21:51', '17', '<p>DATE: 12/10/2020</p><p>CHEQUE# 0391858</p><p>TRUST BANK</p>', '1');
INSERT INTO `tec_adv_payment` (`adv_id`, `suppliers_id`, `adv_amount`, `total_payment`, `add_date`, `today_payment_id`, `note`, `store_id`) VALUES ('18', '4', '0', '5100', '2020-10-13 16:39:23', '18', '<p>DATE:13/10/2020</p><p>CASH</p>', '1');
INSERT INTO `tec_adv_payment` (`adv_id`, `suppliers_id`, `adv_amount`, `total_payment`, `add_date`, `today_payment_id`, `note`, `store_id`) VALUES ('19', '1', '0', '18000', '2020-10-15 14:02:33', '19', '<p>DATE: 15/10/2020</p><p>INV.# 20001283</p><p>CHEQUE # 0391859</p><p>TRUST BANK</p>', '1');
INSERT INTO `tec_adv_payment` (`adv_id`, `suppliers_id`, `adv_amount`, `total_payment`, `add_date`, `today_payment_id`, `note`, `store_id`) VALUES ('20', '1', '0', '18000', '2020-10-19 13:02:39', '20', '<p>DATE: 21/09/2020</p><p>CHEQUE# 0391849</p><p>TRUST BANK</p>', '1');
INSERT INTO `tec_adv_payment` (`adv_id`, `suppliers_id`, `adv_amount`, `total_payment`, `add_date`, `today_payment_id`, `note`, `store_id`) VALUES ('21', '8', '0', '3800', '2020-10-21 17:57:50', '21', '<p>INV.# 5257</p><p>CASH PAYMENT</p>', '1');
INSERT INTO `tec_adv_payment` (`adv_id`, `suppliers_id`, `adv_amount`, `total_payment`, `add_date`, `today_payment_id`, `note`, `store_id`) VALUES ('22', '1', '0', '900', '2020-10-22 19:07:54', '22', '<p>DATE: 22/10/2020</p><p>INV.# 20001337</p><p>CASH PAYMENT</p>', '1');
INSERT INTO `tec_adv_payment` (`adv_id`, `suppliers_id`, `adv_amount`, `total_payment`, `add_date`, `today_payment_id`, `note`, `store_id`) VALUES ('23', '1', '0', '10000', '2020-11-18 12:35:04', '23', '<p>M.R # A001RPT20001245</p>', '1');
INSERT INTO `tec_adv_payment` (`adv_id`, `suppliers_id`, `adv_amount`, `total_payment`, `add_date`, `today_payment_id`, `note`, `store_id`) VALUES ('24', '9', '0', '4400', '2020-12-09 18:19:21', '24', '<p>INV.# Ari- 1752/20</p>', '1');
INSERT INTO `tec_adv_payment` (`adv_id`, `suppliers_id`, `adv_amount`, `total_payment`, `add_date`, `today_payment_id`, `note`, `store_id`) VALUES ('25', '1', '0', '13600', '2020-12-19 16:34:09', '25', '<p>DATE: 19/12/2020</p><p>INV.# A001INV20001572</p>', '1');
INSERT INTO `tec_adv_payment` (`adv_id`, `suppliers_id`, `adv_amount`, `total_payment`, `add_date`, `today_payment_id`, `note`, `store_id`) VALUES ('26', '1', '0', '1800', '2020-12-21 16:44:25', '26', '<p>DATE: 21/12/2020</p><p>INV.# A001INV20001586</p><p>CASH</p>', '1');
INSERT INTO `tec_adv_payment` (`adv_id`, `suppliers_id`, `adv_amount`, `total_payment`, `add_date`, `today_payment_id`, `note`, `store_id`) VALUES ('27', '1', '0', '10000', '2020-12-23 16:56:06', '27', '<p>CHEQUE DATE: 24/12/2020</p><p>CHEQUE # 0391865</p><p>TRUST BANK ( CCT)</p>', '1');


#
# TABLE STRUCTURE FOR: tec_attachment
#

DROP TABLE IF EXISTS `tec_attachment`;

CREATE TABLE `tec_attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(55) NOT NULL,
  `persons_id` int(11) DEFAULT NULL,
  `note_category_id` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL COMMENT 'receive/pay',
  `attachment` varchar(255) NOT NULL,
  `note` text,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: tec_attachment_log
#

DROP TABLE IF EXISTS `tec_attachment_log`;

CREATE TABLE `tec_attachment_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(55) NOT NULL,
  `persons_id` int(11) DEFAULT NULL,
  `note_category_id` int(11) NOT NULL,
  `note_category` varchar(100) DEFAULT NULL,
  `persons` varchar(100) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL COMMENT 'receive/pay',
  `attachment` varchar(255) NOT NULL,
  `note` text,
  `attachment_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: tec_bank_account
#

DROP TABLE IF EXISTS `tec_bank_account`;

CREATE TABLE `tec_bank_account` (
  `bank_account_id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_no` varchar(255) NOT NULL,
  `current_amount` varchar(255) NOT NULL,
  `create_date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `store_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bank_account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `tec_bank_account` (`bank_account_id`, `bank_name`, `account_name`, `account_no`, `current_amount`, `create_date`, `status`, `store_id`) VALUES ('2', 'TRUST BANK LTD.', 'CREATIVE CITY TECHNOLOGIES', '0053 0210005329', '398312', '2020-01-29', '1', '1');


#
# TABLE STRUCTURE FOR: tec_bank_pending
#

DROP TABLE IF EXISTS `tec_bank_pending`;

CREATE TABLE `tec_bank_pending` (
  `pending_id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `cheque_no` varchar(255) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `insert_date` datetime NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 DEFAULT 'pending',
  `payment_type` tinyint(4) DEFAULT NULL COMMENT '1=Customer Collection/2=Supplier Payment',
  `todayP_Payment` int(11) DEFAULT NULL,
  `collection_id` int(11) DEFAULT NULL,
  `store_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pending_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

INSERT INTO `tec_bank_pending` (`pending_id`, `amount`, `bank_id`, `cheque_no`, `supplier_id`, `customer_id`, `insert_date`, `type`, `payment_type`, `todayP_Payment`, `collection_id`, `store_id`) VALUES ('1', '20000', '2', '8657124', NULL, '3', '2020-08-09 20:03:24', 'Approved', '1', NULL, '2', '1');
INSERT INTO `tec_bank_pending` (`pending_id`, `amount`, `bank_id`, `cheque_no`, `supplier_id`, `customer_id`, `insert_date`, `type`, `payment_type`, `todayP_Payment`, `collection_id`, `store_id`) VALUES ('2', '28000', '2', '0391837', '3', NULL, '2020-08-20 17:02:57', 'Approved', '2', '6', NULL, '1');
INSERT INTO `tec_bank_pending` (`pending_id`, `amount`, `bank_id`, `cheque_no`, `supplier_id`, `customer_id`, `insert_date`, `type`, `payment_type`, `todayP_Payment`, `collection_id`, `store_id`) VALUES ('3', '18000', '2', '8657130', NULL, '3', '2020-08-30 19:37:38', 'Approved', '1', NULL, '4', '1');
INSERT INTO `tec_bank_pending` (`pending_id`, `amount`, `bank_id`, `cheque_no`, `supplier_id`, `customer_id`, `insert_date`, `type`, `payment_type`, `todayP_Payment`, `collection_id`, `store_id`) VALUES ('4', '18800', '2', '8657131', NULL, '3', '2020-08-30 19:38:49', 'Approved', '1', NULL, '5', '1');
INSERT INTO `tec_bank_pending` (`pending_id`, `amount`, `bank_id`, `cheque_no`, `supplier_id`, `customer_id`, `insert_date`, `type`, `payment_type`, `todayP_Payment`, `collection_id`, `store_id`) VALUES ('5', '2200', '2', '8657132', NULL, '3', '2020-08-30 19:40:13', 'Approved', '1', NULL, '6', '1');
INSERT INTO `tec_bank_pending` (`pending_id`, `amount`, `bank_id`, `cheque_no`, `supplier_id`, `customer_id`, `insert_date`, `type`, `payment_type`, `todayP_Payment`, `collection_id`, `store_id`) VALUES ('6', '22400', '2', '0391846', '7', NULL, '2020-09-12 17:43:14', 'Approved', '2', '11', NULL, '1');
INSERT INTO `tec_bank_pending` (`pending_id`, `amount`, `bank_id`, `cheque_no`, `supplier_id`, `customer_id`, `insert_date`, `type`, `payment_type`, `todayP_Payment`, `collection_id`, `store_id`) VALUES ('7', '18000', '2', '0391847', '1', NULL, '2020-09-14 19:25:00', 'Approved', '2', '13', NULL, '1');
INSERT INTO `tec_bank_pending` (`pending_id`, `amount`, `bank_id`, `cheque_no`, `supplier_id`, `customer_id`, `insert_date`, `type`, `payment_type`, `todayP_Payment`, `collection_id`, `store_id`) VALUES ('8', '9600', '2', '0391850', '1', NULL, '2020-09-19 19:51:01', 'Approved', '2', '15', NULL, '1');
INSERT INTO `tec_bank_pending` (`pending_id`, `amount`, `bank_id`, `cheque_no`, `supplier_id`, `customer_id`, `insert_date`, `type`, `payment_type`, `todayP_Payment`, `collection_id`, `store_id`) VALUES ('9', '9200', '2', '0391857', '1', NULL, '2020-10-12 13:04:43', 'Approved', '2', '16', NULL, '1');
INSERT INTO `tec_bank_pending` (`pending_id`, `amount`, `bank_id`, `cheque_no`, `supplier_id`, `customer_id`, `insert_date`, `type`, `payment_type`, `todayP_Payment`, `collection_id`, `store_id`) VALUES ('10', '9200', '2', '0391858', '1', NULL, '2020-10-12 15:21:51', 'Approved', '2', '17', NULL, '1');
INSERT INTO `tec_bank_pending` (`pending_id`, `amount`, `bank_id`, `cheque_no`, `supplier_id`, `customer_id`, `insert_date`, `type`, `payment_type`, `todayP_Payment`, `collection_id`, `store_id`) VALUES ('11', '18000', '2', '0391859', '1', NULL, '2020-10-15 14:02:33', 'Approved', '2', '19', NULL, '1');
INSERT INTO `tec_bank_pending` (`pending_id`, `amount`, `bank_id`, `cheque_no`, `supplier_id`, `customer_id`, `insert_date`, `type`, `payment_type`, `todayP_Payment`, `collection_id`, `store_id`) VALUES ('12', '18000', '2', '0391849', '1', NULL, '2020-10-19 13:02:39', 'Approved', '2', '20', NULL, '1');
INSERT INTO `tec_bank_pending` (`pending_id`, `amount`, `bank_id`, `cheque_no`, `supplier_id`, `customer_id`, `insert_date`, `type`, `payment_type`, `todayP_Payment`, `collection_id`, `store_id`) VALUES ('13', '10000', '2', '0391865', '1', NULL, '2020-12-23 16:56:06', 'pending', '2', '27', NULL, '1');


#
# TABLE STRUCTURE FOR: tec_bank_pending_donations
#

DROP TABLE IF EXISTS `tec_bank_pending_donations`;

CREATE TABLE `tec_bank_pending_donations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `donations_persons_id` int(11) DEFAULT NULL,
  `donations_pay_id` int(11) DEFAULT NULL,
  `payment_type` varchar(20) DEFAULT NULL COMMENT 'card/cheque',
  `type` varchar(20) DEFAULT NULL COMMENT 'receive/pay',
  `bank_id` int(11) DEFAULT NULL,
  `bank_status` varchar(20) DEFAULT NULL COMMENT 'Approved/Pending',
  `cheque_or_card_no` varchar(100) DEFAULT NULL,
  `amount` double(25,2) DEFAULT NULL,
  `transactions_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: tec_bank_pending_expenses
#

DROP TABLE IF EXISTS `tec_bank_pending_expenses`;

CREATE TABLE `tec_bank_pending_expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expenses_id` int(11) DEFAULT NULL,
  `expens_category_id` int(11) DEFAULT NULL,
  `transactions_id` int(11) NOT NULL,
  `payment_type` varchar(20) DEFAULT NULL COMMENT 'card/cheque',
  `type` varchar(20) DEFAULT NULL COMMENT 'receive/pay',
  `bank_id` int(11) DEFAULT NULL,
  `bank_status` varchar(20) DEFAULT NULL COMMENT 'Approved/Pending',
  `cheque_or_card_no` varchar(100) DEFAULT NULL,
  `amount` double(25,2) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: tec_bank_pending_loan
#

DROP TABLE IF EXISTS `tec_bank_pending_loan`;

CREATE TABLE `tec_bank_pending_loan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_id` int(11) DEFAULT NULL,
  `loner_id` int(11) DEFAULT NULL,
  `payment_type` varchar(20) DEFAULT NULL COMMENT 'card/cheque',
  `type` varchar(20) DEFAULT NULL COMMENT 'receive/pay',
  `bank_id` int(11) DEFAULT NULL,
  `bank_status` varchar(20) DEFAULT NULL COMMENT 'Approved/Pending',
  `cheque_or_card_no` varchar(100) DEFAULT NULL,
  `amount` double(25,2) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `tec_bank_pending_loan` (`id`, `loan_id`, `loner_id`, `payment_type`, `type`, `bank_id`, `bank_status`, `cheque_or_card_no`, `amount`, `created_at`, `created_by`) VALUES ('1', '40', '10', 'cheque', 'receive', '2', 'Approved', '6622360', '85000.00', '2020-09-17 05:38:53', '34');
INSERT INTO `tec_bank_pending_loan` (`id`, `loan_id`, `loner_id`, `payment_type`, `type`, `bank_id`, `bank_status`, `cheque_or_card_no`, `amount`, `created_at`, `created_by`) VALUES ('2', '63', '4', 'cheque', 'pay', '2', 'Approved', '0391860', '26295.00', '2020-10-15 07:39:59', '34');


#
# TABLE STRUCTURE FOR: tec_bank_pending_salary
#

DROP TABLE IF EXISTS `tec_bank_pending_salary`;

CREATE TABLE `tec_bank_pending_salary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paysalary_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `transactions_id` int(11) NOT NULL,
  `payment_type` varchar(20) DEFAULT NULL COMMENT 'card/cheque',
  `type` varchar(20) DEFAULT NULL COMMENT 'receive/pay',
  `bank_id` int(11) DEFAULT NULL,
  `bank_status` varchar(20) DEFAULT NULL COMMENT 'Approved/Pending',
  `cheque_or_card_no` varchar(100) DEFAULT NULL,
  `amount` double(25,2) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: tec_brands
#

DROP TABLE IF EXISTS `tec_brands`;

CREATE TABLE `tec_brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `name` varchar(55) NOT NULL,
  `image` varchar(100) DEFAULT 'no_image.png',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

INSERT INTO `tec_brands` (`id`, `code`, `name`, `image`) VALUES ('1', '8.2', 'GENERAL POWER', 'no_image.png');
INSERT INTO `tec_brands` (`id`, `code`, `name`, `image`) VALUES ('2', 'general power', 'GENERAL POWER', 'no_image.png');
INSERT INTO `tec_brands` (`id`, `code`, `name`, `image`) VALUES ('3', 'cs', 'CS', 'no_image.png');
INSERT INTO `tec_brands` (`id`, `code`, `name`, `image`) VALUES ('4', 'wav link', 'WAV LINK', 'no_image.png');
INSERT INTO `tec_brands` (`id`, `code`, `name`, `image`) VALUES ('5', 'china', 'CHINA', 'no_image.png');
INSERT INTO `tec_brands` (`id`, `code`, `name`, `image`) VALUES ('6', 'powercon', 'POWERCON', 'no_image.png');
INSERT INTO `tec_brands` (`id`, `code`, `name`, `image`) VALUES ('7', 'a4 tech', 'A4 TECH', 'no_image.png');
INSERT INTO `tec_brands` (`id`, `code`, `name`, `image`) VALUES ('8', 'a4 tech', 'A4 TECH', 'no_image.png');
INSERT INTO `tec_brands` (`id`, `code`, `name`, `image`) VALUES ('9', 'logitech', 'LOGITECH', 'no_image.png');
INSERT INTO `tec_brands` (`id`, `code`, `name`, `image`) VALUES ('10', 'adp cat 6', 'ADP CAT 6', 'no_image.png');
INSERT INTO `tec_brands` (`id`, `code`, `name`, `image`) VALUES ('11', 'tenda', 'TENDA', 'no_image.png');
INSERT INTO `tec_brands` (`id`, `code`, `name`, `image`) VALUES ('12', 'pilot view', 'PILOT VIEW', 'no_image.png');
INSERT INTO `tec_brands` (`id`, `code`, `name`, `image`) VALUES ('13', 'transcend', 'TRANSCEND', 'no_image.png');
INSERT INTO `tec_brands` (`id`, `code`, `name`, `image`) VALUES ('14', 'canon', 'CANON', 'no_image.png');


#
# TABLE STRUCTURE FOR: tec_categories
#

DROP TABLE IF EXISTS `tec_categories`;

CREATE TABLE `tec_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(55) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `image` varchar(100) DEFAULT 'no_image.png',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO `tec_categories` (`id`, `code`, `name`, `parent_id`, `image`) VALUES ('1', '8.2', 'BATTERY 8.2 AH', '0', 'no_image.png');
INSERT INTO `tec_categories` (`id`, `code`, `name`, `parent_id`, `image`) VALUES ('3', 'battery', 'BATTERY', '0', 'no_image.png');
INSERT INTO `tec_categories` (`id`, `code`, `name`, `parent_id`, `image`) VALUES ('4', 'toner', 'TONER', '0', 'no_image.png');
INSERT INTO `tec_categories` (`id`, `code`, `name`, `parent_id`, `image`) VALUES ('5', 'router', 'ROUTER', '0', 'no_image.png');
INSERT INTO `tec_categories` (`id`, `code`, `name`, `parent_id`, `image`) VALUES ('6', 'webcam', 'WEBCAM', '0', 'no_image.png');
INSERT INTO `tec_categories` (`id`, `code`, `name`, `parent_id`, `image`) VALUES ('7', 'ups', 'UPS', '0', 'no_image.png');
INSERT INTO `tec_categories` (`id`, `code`, `name`, `parent_id`, `image`) VALUES ('8', 'head phone', 'HEAD PHONE ', '0', 'no_image.png');
INSERT INTO `tec_categories` (`id`, `code`, `name`, `parent_id`, `image`) VALUES ('9', 'hd720p', 'WEBCAM', '0', 'no_image.png');
INSERT INTO `tec_categories` (`id`, `code`, `name`, `parent_id`, `image`) VALUES ('10', 'cable', 'CABLE', '0', 'no_image.png');
INSERT INTO `tec_categories` (`id`, `code`, `name`, `parent_id`, `image`) VALUES ('11', 'tv', 'LED TV', '0', 'no_image.png');
INSERT INTO `tec_categories` (`id`, `code`, `name`, `parent_id`, `image`) VALUES ('12', 'ssd', 'SSD', '0', 'no_image.png');


#
# TABLE STRUCTURE FOR: tec_combo_items
#

DROP TABLE IF EXISTS `tec_combo_items`;

CREATE TABLE `tec_combo_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `item_code` varchar(20) NOT NULL,
  `quantity` decimal(12,4) NOT NULL,
  `price` decimal(25,2) DEFAULT NULL,
  `cost` decimal(25,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: tec_customers
#

DROP TABLE IF EXISTS `tec_customers`;

CREATE TABLE `tec_customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `cf1` varchar(255) NOT NULL,
  `cf2` varchar(255) NOT NULL,
  `phone` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `store_id` int(11) DEFAULT NULL,
  `opening_blance` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

INSERT INTO `tec_customers` (`id`, `name`, `cf1`, `cf2`, `phone`, `email`, `store_id`, `opening_blance`) VALUES ('2', 'A1 NETWORK', '65, GREEN ROAD, (3rd Floor), DHAKA - 1205', '', '8801931111777, 8801711826343, 8801621111777', '', '1', '0');
INSERT INTO `tec_customers` (`id`, `name`, `cf1`, `cf2`, `phone`, `email`, `store_id`, `opening_blance`) VALUES ('3', 'AK COMPUTER SYSTEM', '326,ALPANA PLAZA (2nd Floor ),51, NEW ELEPHANT ROAD, DHAKA-1205', '', '8801676699830', 'akcomputersystem@yahoo.com', '1', '0');
INSERT INTO `tec_customers` (`id`, `name`, `cf1`, `cf2`, `phone`, `email`, `store_id`, `opening_blance`) VALUES ('4', 'THE ELECTRO HOUSE', 'SUVASTU ARCADE, SHOP # 104-105, (1ST FLOOR), 46-48 NEW ELEPHANT ROAD, DHAKA', '', '8801906121121, 88029612050', 'info@electrohousebd.com', '1', '0');
INSERT INTO `tec_customers` (`id`, `name`, `cf1`, `cf2`, `phone`, `email`, `store_id`, `opening_blance`) VALUES ('5', 'TECH DEAL', 'shop# L1-115, BS BHABAN (1st Floor), HOUSE# 75-76, LABORATORY ROAD,( NEW ELEPHANT ROAD), DHAKA', '', '8801913538988', 'techdealbd@gmail.com', '1', '0');
INSERT INTO `tec_customers` (`id`, `name`, `cf1`, `cf2`, `phone`, `email`, `store_id`, `opening_blance`) VALUES ('6', 'CREATIVE COMPUTERS &amp; COMMUNICATIONS', '75-76 BS BHABAN, ( L-3-108), SCIENCE LABORATORY ROAD,', '', '880258616304, 88029661891', '', '1', '0');
INSERT INTO `tec_customers` (`id`, `name`, `cf1`, `cf2`, `phone`, `email`, `store_id`, `opening_blance`) VALUES ('7', 'CCT OFFICE', '75-76 BS BHOBON, (L6-103), LABRATORY ROAD, NEW ELEPHANT ROAD,DHAKA', '', '88029634223', '', '1', '0');
INSERT INTO `tec_customers` (`id`, `name`, `cf1`, `cf2`, `phone`, `email`, `store_id`, `opening_blance`) VALUES ('8', 'COMPUTER WORLD (PABNA)', 'ELAHI MARKET, KASHINATHPUR, PABNA', '', '8801718300301', '', '1', '0');
INSERT INTO `tec_customers` (`id`, `name`, `cf1`, `cf2`, `phone`, `email`, `store_id`, `opening_blance`) VALUES ('9', 'TELEWAVE', '72, NEW ELEPHANT ROAD, MONSUR BHABAN (1st Floor), DHAKA-1205.', '', '8801711462367', 'info@telewavebd.com', '1', '0');
INSERT INTO `tec_customers` (`id`, `name`, `cf1`, `cf2`, `phone`, `email`, `store_id`, `opening_blance`) VALUES ('10', 'COMPUTER VISION (KHULNA)', '320/335 JALIL TOWER (2ND FLOOR), 77 JESSORE ROAD, KHULNA', '', '8801712995552, 8801822525555, 8801842995552, 8801842995553', 'computervision007@gmail.com', '1', '0');
INSERT INTO `tec_customers` (`id`, `name`, `cf1`, `cf2`, `phone`, `email`, `store_id`, `opening_blance`) VALUES ('11', 'COMPUTER SQUADRON', '75-76 BS BHOBON, (L6-103), LABRATORY ROAD, NEW ELEPHANT ROAD,DHAKA', '', '8801917999333', 'computersquadron1@gmail.com', '1', '0');
INSERT INTO `tec_customers` (`id`, `name`, `cf1`, `cf2`, `phone`, `email`, `store_id`, `opening_blance`) VALUES ('12', 'ANAS COMPUTER (RANGPUR)', 'MOSTOFA COMPLEX MARKET, (1ST FLOOR) JAHAJ COMPANY, RANGPUR - 5400', '', '8801740985545, 8801971985545', 'smanasrp@gmail.com', '1', '0');
INSERT INTO `tec_customers` (`id`, `name`, `cf1`, `cf2`, `phone`, `email`, `store_id`, `opening_blance`) VALUES ('13', 'RUBY COMPUTER (SAIDPUR)', 'AMIN PLAZA, SAIDPUR', '', '8801714034599', '', '1', '0');
INSERT INTO `tec_customers` (`id`, `name`, `cf1`, `cf2`, `phone`, `email`, `store_id`, `opening_blance`) VALUES ('14', 'THREE STAR TRADING CO.', '44, NEW ELEPHANT ROAD, SIDDIQUI PLAZA, (GRAND FLOOR) DHAKA- 1205', '', '8801919231209, 880258612088, 88029664323', '', '1', '0');
INSERT INTO `tec_customers` (`id`, `name`, `cf1`, `cf2`, `phone`, `email`, `store_id`, `opening_blance`) VALUES ('15', 'TRIVA IT LIMITED', 'SHOP NO: 116, ICT BHABAN, NEW ELEPHANT ROAD, DHAKA-1205', '', '8801632736769, 8801872128260, 880143536343, 8801963845470', 'ittriva@gmail.com', '1', '0');


#
# TABLE STRUCTURE FOR: tec_designation
#

DROP TABLE IF EXISTS `tec_designation`;

CREATE TABLE `tec_designation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `destination` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tec_designation` (`id`, `destination`) VALUES ('1', 'BUSINESS');
INSERT INTO `tec_designation` (`id`, `destination`) VALUES ('2', 'BUSINESS');
INSERT INTO `tec_designation` (`id`, `destination`) VALUES ('3', 'GOVERNMENT SERVICE');
INSERT INTO `tec_designation` (`id`, `destination`) VALUES ('4', 'PRIVATE SERVICE');
INSERT INTO `tec_designation` (`id`, `destination`) VALUES ('5', 'SERVICE');


#
# TABLE STRUCTURE FOR: tec_donations_pay
#

DROP TABLE IF EXISTS `tec_donations_pay`;

CREATE TABLE `tec_donations_pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` decimal(10,0) NOT NULL,
  `donations_persons_id` int(11) NOT NULL,
  `entry_date` datetime DEFAULT NULL,
  `type` varchar(100) NOT NULL,
  `payment_type` varchar(20) DEFAULT NULL COMMENT 'cash/bank',
  `bankname` text,
  `bank_id` int(11) DEFAULT NULL,
  `cheque_or_card_no` varchar(100) DEFAULT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `tec_donations_pay` (`id`, `amount`, `donations_persons_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('1', '1100', '1', '2020-09-30 00:00:00', '', 'cash', NULL, NULL, NULL, '<p>DATE: 30/09/2020</p><p><p>Transaction ID : IB71209812445200930041249</p><p>Transfer From : : 1524203491061001 - Name : COMPUTER SQUADRON</p><p>To bKash Account No : 01792111113</p><p>To bKash Account Name : MOHAMMAD SHAHRIAR KHAN</p><p>Transfer Amount : : Tk 1,100.00</p><p>Transaction Particular : IB/STAN/BKASH/01792111113</p><p>STAN No : 183815</p><p>Transfer Date : 30-9-2020 04:13:52</p><br></p>');


#
# TABLE STRUCTURE FOR: tec_donations_persons
#

DROP TABLE IF EXISTS `tec_donations_persons`;

CREATE TABLE `tec_donations_persons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `cf1` varchar(255) NOT NULL,
  `cf2` varchar(255) NOT NULL,
  `phone` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `opening_balance` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `tec_donations_persons` (`id`, `name`, `cf1`, `cf2`, `phone`, `email`, `opening_balance`) VALUES ('1', 'ENTREPRENEURS CLUB OF BANGLADESH LIMITED (E-CLUB)', 'H # 50, (4th FLOOR), LAKE CIRCUS ROAD, KOLABAGAN, DHAKA - 1205', '', '01792111113', 'query.eclub@gmail.com', '0');


#
# TABLE STRUCTURE FOR: tec_employee
#

DROP TABLE IF EXISTS `tec_employee`;

CREATE TABLE `tec_employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `mather_name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `position` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `basic_salary` varchar(10) NOT NULL,
  `join_date` date NOT NULL,
  `satus` int(11) NOT NULL DEFAULT '1',
  `entry_date` int(11) NOT NULL,
  `update_date` date DEFAULT NULL,
  `store_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `tec_employee` (`id`, `name`, `father_name`, `mather_name`, `date_of_birth`, `position`, `address`, `phone`, `email`, `basic_salary`, `join_date`, `satus`, `entry_date`, `update_date`, `store_id`) VALUES ('1', 'Abdul mazid', 'A', 'A', '0000-00-00', 'Sales manager', '', '01821915515', 'mazid@wedothewebs.com', '5000', '2020-01-01', '1', '0', NULL, '1');


#
# TABLE STRUCTURE FOR: tec_expens_category
#

DROP TABLE IF EXISTS `tec_expens_category`;

CREATE TABLE `tec_expens_category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT 'no_image.png',
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tec_expens_category` (`cat_id`, `code`, `name`, `image`) VALUES ('6', 'entertainment', 'ENTERTAINMENT', 'no_image.png');
INSERT INTO `tec_expens_category` (`cat_id`, `code`, `name`, `image`) VALUES ('2', 'Salary', 'Salary', 'no_image.png');
INSERT INTO `tec_expens_category` (`cat_id`, `code`, `name`, `image`) VALUES ('3', 'others', 'OTHERS', 'no_image.png');
INSERT INTO `tec_expens_category` (`cat_id`, `code`, `name`, `image`) VALUES ('4', 'cct office', 'CCT OFFICE', 'no_image.png');
INSERT INTO `tec_expens_category` (`cat_id`, `code`, `name`, `image`) VALUES ('5', 'cct_marketing', 'OFFICIAL MARKETING', 'no_image.png');


#
# TABLE STRUCTURE FOR: tec_expenses
#

DROP TABLE IF EXISTS `tec_expenses`;

CREATE TABLE `tec_expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reference` varchar(50) NOT NULL,
  `amount` decimal(25,2) NOT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `created_by` varchar(55) NOT NULL,
  `attachment` varchar(55) DEFAULT NULL,
  `store_id` int(11) NOT NULL DEFAULT '1',
  `emp_pay_id` int(11) DEFAULT NULL,
  `partner_id` int(11) DEFAULT NULL,
  `c_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `sale_return_id` int(11) DEFAULT NULL,
  `purhases_return_id` int(11) DEFAULT NULL,
  `paid_by` varchar(50) NOT NULL DEFAULT 'cash',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `tec_expenses` (`id`, `date`, `reference`, `amount`, `note`, `created_by`, `attachment`, `store_id`, `emp_pay_id`, `partner_id`, `c_id`, `customer_id`, `supplier_id`, `sale_return_id`, `purhases_return_id`, `paid_by`) VALUES ('1', '2020-08-13 17:05:00', 'GIFT', '2500.00', '<p>CIVIL AVIATION</p>', '34', NULL, '1', NULL, NULL, '3', NULL, NULL, NULL, NULL, 'cash');
INSERT INTO `tec_expenses` (`id`, `date`, `reference`, `amount`, `note`, `created_by`, `attachment`, `store_id`, `emp_pay_id`, `partner_id`, `c_id`, `customer_id`, `supplier_id`, `sale_return_id`, `purhases_return_id`, `paid_by`) VALUES ('2', '2020-08-13 17:07:58', 'NEW WEBSITE', '5100.00', '<p>CS NEW WEBSITE</p>', '34', NULL, '1', NULL, NULL, '3', NULL, NULL, NULL, NULL, 'cash');
INSERT INTO `tec_expenses` (`id`, `date`, `reference`, `amount`, `note`, `created_by`, `attachment`, `store_id`, `emp_pay_id`, `partner_id`, `c_id`, `customer_id`, `supplier_id`, `sale_return_id`, `purhases_return_id`, `paid_by`) VALUES ('3', '2020-10-06 18:05:51', 'S.M MAHMUD SHARAFAT ', '8000.00', '<p>CASH</p>', '34', NULL, '1', NULL, NULL, '5', NULL, NULL, NULL, NULL, 'cash');


#
# TABLE STRUCTURE FOR: tec_gift_cards
#

DROP TABLE IF EXISTS `tec_gift_cards`;

CREATE TABLE `tec_gift_cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `card_no` varchar(20) NOT NULL,
  `value` decimal(25,2) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `balance` decimal(25,2) NOT NULL,
  `expiry` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `card_no` (`card_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: tec_groups
#

DROP TABLE IF EXISTS `tec_groups`;

CREATE TABLE `tec_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `tec_groups` (`id`, `name`, `description`) VALUES ('1', 'admin', 'Administrator');
INSERT INTO `tec_groups` (`id`, `name`, `description`) VALUES ('2', 'manager', 'Manager');
INSERT INTO `tec_groups` (`id`, `name`, `description`) VALUES ('3', 'staff', 'Staff');


#
# TABLE STRUCTURE FOR: tec_handcash
#

DROP TABLE IF EXISTS `tec_handcash`;

CREATE TABLE `tec_handcash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entry_date` date NOT NULL,
  `amount` int(11) NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=139 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('1', '2020-02-04', '0', '');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('2', '2020-07-29', '0', 'CASH');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('3', '2020-08-09', '18000', 'CASH');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('4', '2020-08-10', '0', 'CASH');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('5', '2020-08-11', '0', 'CASH');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('6', '2020-08-12', '0', 'CASH');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('7', '2020-08-13', '15750', 'CASH');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('8', '2020-08-14', '15750', 'FRI DAY');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('9', '2020-08-15', '15750', 'HOLIDAY');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('10', '2020-08-16', '15750', 'CASH');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('11', '2020-08-17', '0', 'CASH');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('12', '2020-08-18', '0', 'CASH');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('13', '2020-08-19', '0', 'CASH');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('14', '2020-08-20', '0', 'CASH');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('15', '2020-08-21', '0', 'FRI DAY');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('16', '2020-08-22', '0', 'CASH');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('17', '2020-08-23', '0', 'CASH');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('18', '2020-08-24', '0', 'CASH');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('19', '2020-08-25', '0', 'CASH');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('20', '2020-08-26', '0', 'CASH');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('21', '2020-08-27', '0', 'CASH');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('22', '2020-08-28', '0', 'FRI DAY');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('23', '2020-08-29', '0', 'CASH');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('24', '2020-08-30', '9500', 'CASH');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('25', '2020-08-31', '0', 'CASH');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('26', '2020-09-01', '0', 'CASH');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('27', '2020-09-02', '0', 'CASH');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('28', '2020-09-03', '0', 'CASH');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('29', '2020-09-04', '0', 'FRI DAY');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('30', '2020-09-05', '0', 'CASH');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('31', '2020-09-06', '0', 'WAV LINK - 11 PCS');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('32', '2020-09-07', '0', 'WAV LINK - 11 PCS');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('33', '2020-09-08', '0', 'WAV LINK - 11 PCS');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('34', '2020-09-09', '0', 'WAV LINK - 11 PCS');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('35', '2020-09-12', '0', 'WAV LINK - 1, TENDA -12');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('36', '2020-09-13', '0', 'WAV LINK-1, TENDA-12, TONER-2');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('37', '2020-09-14', '8000', 'WAV LINK-1, TENDA-12, TONER-2');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('38', '2020-09-15', '0', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-2,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('39', '2020-09-16', '0', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-2,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('40', '2020-09-17', '0', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-2,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('41', '2020-09-18', '0', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-2,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('42', '2020-09-19', '0', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-2,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('43', '2020-09-20', '0', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-2,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('44', '2020-09-20', '0', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-2,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('45', '2020-09-21', '0', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-2,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('46', '2020-09-22', '0', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-2,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('47', '2020-09-23', '0', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-2,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('48', '2020-09-24', '0', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-9,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('49', '2020-09-25', '0', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-9,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('50', '2020-09-26', '0', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-1,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('51', '2020-09-27', '0', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-1,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('52', '2020-09-28', '0', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-1,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('53', '2020-09-29', '0', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-1,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('54', '2020-09-30', '0', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-1,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('55', '2020-10-01', '0', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-1,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('56', '2020-10-02', '0', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-1,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('57', '2020-10-04', '0', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-1,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('58', '2020-10-05', '0', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-1,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('59', '2020-10-06', '0', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-1,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('60', '2020-10-07', '0', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-1,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('61', '2020-10-08', '0', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-1,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('62', '2020-10-09', '0', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-1,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('63', '2020-10-10', '0', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-1,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('64', '2020-10-11', '0', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-1,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('67', '2020-10-13', '9550', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-1,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('66', '2020-10-12', '6650', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-1,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('68', '2020-10-14', '550', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-1,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('69', '2020-10-15', '250', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-1,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('70', '2020-10-16', '250', 'FRI DAY');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('71', '2020-10-17', '250', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-1,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('72', '2020-10-18', '250', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-1,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('73', '2020-10-19', '250', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-1,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('74', '2020-10-20', '250', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-1,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('75', '2020-10-21', '0', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-1,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('76', '2020-10-22', '1000', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('77', '2020-10-23', '1000', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('78', '2020-10-24', '1000', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('79', '2020-10-25', '1000', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('80', '2020-10-26', '1000', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('81', '2020-10-27', '0', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('82', '2020-10-28', '0', 'WAV LINK-1, TENDA-12, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('83', '2020-10-29', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('84', '2020-10-30', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('85', '2020-10-31', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('86', '2020-11-01', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('87', '2020-11-02', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('88', '2020-11-03', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('89', '2020-11-04', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('90', '2020-11-05', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('91', '2020-11-06', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('92', '2020-11-07', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('93', '2020-11-08', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('94', '2020-11-09', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('95', '2020-11-10', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('96', '2020-11-11', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('97', '2020-11-12', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('98', '2020-11-13', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('99', '2020-11-14', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('100', '2020-11-15', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('101', '2020-11-16', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('102', '2020-11-17', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('103', '2020-11-18', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('104', '2020-11-19', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('105', '2020-11-20', '0', 'FRI DAY');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('106', '2020-11-21', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('107', '2020-11-22', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('108', '2020-11-23', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('109', '2020-11-24', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('110', '2020-11-25', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('111', '2020-11-26', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('112', '2020-11-27', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('113', '2020-11-28', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('114', '2020-11-29', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('115', '2020-11-30', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('116', '2020-12-01', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('117', '2020-12-02', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('118', '2020-12-03', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('119', '2020-12-04', '0', 'FRI DAY');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('120', '2020-12-05', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('121', '2020-12-06', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('122', '2020-12-07', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('123', '2020-12-08', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('124', '2020-12-09', '0', 'CASH');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('125', '2020-12-10', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('126', '2020-12-11', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('127', '2020-12-12', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('128', '2020-12-13', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('129', '2020-12-14', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('130', '2020-12-15', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('131', '2020-12-16', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('132', '2020-12-17', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('133', '2020-12-18', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('134', '2020-12-19', '1000', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('135', '2020-12-20', '0', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('136', '2020-12-21', '100', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('137', '2020-12-22', '100', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');
INSERT INTO `tec_handcash` (`id`, `entry_date`, `amount`, `note`) VALUES ('138', '2020-12-23', '100', 'WAV LINK-1, TENDA-11, TONER-2,BATTERY-0,');


#
# TABLE STRUCTURE FOR: tec_liftprofit
#

DROP TABLE IF EXISTS `tec_liftprofit`;

CREATE TABLE `tec_liftprofit` (
  `liftprofit_id` int(11) NOT NULL AUTO_INCREMENT,
  `partner_id` int(11) NOT NULL,
  `month_id` varchar(2) NOT NULL,
  `year` year(4) NOT NULL,
  `amount` varchar(10) NOT NULL,
  `commission` varchar(10) NOT NULL,
  `note` text NOT NULL,
  `pay_date` datetime NOT NULL,
  PRIMARY KEY (`liftprofit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: tec_loaner
#

DROP TABLE IF EXISTS `tec_loaner`;

CREATE TABLE `tec_loaner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `organization` text,
  `cf1` text NOT NULL,
  `cf2` text NOT NULL,
  `phone` text,
  `email` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO `tec_loaner` (`id`, `name`, `occupation`, `organization`, `cf1`, `cf2`, `phone`, `email`, `status`) VALUES ('1', 'MR. MD. MUSTAFIZUR RAHMAN KHAN', 'BUSINESS', 'CAPRICORN COMPUTERS', '75-76 B. S. BHABON (L6), LABRATORY ROAD, NEW ELEPHANT ROAD, DHAKA - 1205', '74, LABORATORY ROAD, LILY ARCADE, DHAKA - 1205, BANGLADESH', '01711306143, 9674963', '', '1');
INSERT INTO `tec_loaner` (`id`, `name`, `occupation`, `organization`, `cf1`, `cf2`, `phone`, `email`, `status`) VALUES ('2', 'THE ELECTRO HOUSE', 'BUSINESS', 'TEH', '75-76 B. S. BHABON (L6-103), LABRATORY ROAD, NEW ELEPHANT ROAD, DHAKA - 1205', 'SUVASTU ARCADE, SHOP # 104-105, LEVEL # 1, 46-48 NEW ELEPHANT ROAD, DHAKA -1205', '01906121121, 9612050', '', '1');
INSERT INTO `tec_loaner` (`id`, `name`, `occupation`, `organization`, `cf1`, `cf2`, `phone`, `email`, `status`) VALUES ('3', 'COMPUTER SQUADRON', 'BUSINESS', 'CS', '75-76 B. S. BHABON (L6-103), LABRATORY ROAD, NEW ELEPHANT ROAD, DHAKA - 1205', '', '01917999333, 9634223', '', '1');
INSERT INTO `tec_loaner` (`id`, `name`, `occupation`, `organization`, `cf1`, `cf2`, `phone`, `email`, `status`) VALUES ('4', 'S. M. MAHMUD SHARAFAT', 'BUSINESS', 'COMPUTER SQUADRON', '75-76 B. S. BHABON (L6-103), LABRATORY ROAD, NEW ELEPHANT ROAD, DHAKA - 1205', 'SUVASTU ARCADE, SHOP # 104-105, LEVEL # 1, 46-48 NEW ELEPHANT ROAD, DHAKA -1205', '01915799982', '', '1');
INSERT INTO `tec_loaner` (`id`, `name`, `occupation`, `organization`, `cf1`, `cf2`, `phone`, `email`, `status`) VALUES ('5', 'SAJEDA HOSSAIN', 'BUSINESS', '', 'MOHAMMADPUR , DHAKA.', '', '01715855361', '', '1');
INSERT INTO `tec_loaner` (`id`, `name`, `occupation`, `organization`, `cf1`, `cf2`, `phone`, `email`, `status`) VALUES ('6', 'S. M. MAHMUD ARAFAT', 'GOVERNMENT SERVICE', 'BANGLADESH AIR FORCE', 'DHAKA CANTONMENT, DHAKA', 'BASE BASHAR, BANGLADESH AIR FORCE', '', '', '1');
INSERT INTO `tec_loaner` (`id`, `name`, `occupation`, `organization`, `cf1`, `cf2`, `phone`, `email`, `status`) VALUES ('7', 'S. M. MAHMUD FARHAD', 'PRIVATE SERVICE', '', 'DHAKA CANTONMENT, DHAKA', '', '', '', '1');
INSERT INTO `tec_loaner` (`id`, `name`, `occupation`, `organization`, `cf1`, `cf2`, `phone`, `email`, `status`) VALUES ('8', 'ISMAT ARA', 'BUSINESS', '', 'PANTHAPATH, KOLABAGAN, DHAKA', '', '', '', '1');
INSERT INTO `tec_loaner` (`id`, `name`, `occupation`, `organization`, `cf1`, `cf2`, `phone`, `email`, `status`) VALUES ('9', 'D. GULSHAN ARA', 'SERVICE', 'JAGANNATH UNIVERSITY', 'ELEPHANT ROAD, DHAKA', 'UNIVERSITY OF DHAKA', '', '', '1');
INSERT INTO `tec_loaner` (`id`, `name`, `occupation`, `organization`, `cf1`, `cf2`, `phone`, `email`, `status`) VALUES ('10', 'WC BARKAT', 'GOVERNMENT SERVICE', '', 'MIRPUR STAFF COLLEGE', '', '01746179353', '', '1');


#
# TABLE STRUCTURE FOR: tec_login_attempts
#

DROP TABLE IF EXISTS `tec_login_attempts`;

CREATE TABLE `tec_login_attempts` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: tec_marge
#

DROP TABLE IF EXISTS `tec_marge`;

CREATE TABLE `tec_marge` (
  `marge_id` int(11) NOT NULL AUTO_INCREMENT,
  `marge_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `mage_date` datetime NOT NULL,
  PRIMARY KEY (`marge_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: tec_marge_laser
#

DROP TABLE IF EXISTS `tec_marge_laser`;

CREATE TABLE `tec_marge_laser` (
  `laser_id` int(11) NOT NULL AUTO_INCREMENT,
  `laser_date` datetime NOT NULL,
  `customer_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `laser_note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`laser_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: tec_note_category
#

DROP TABLE IF EXISTS `tec_note_category`;

CREATE TABLE `tec_note_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(55) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: tec_partner
#

DROP TABLE IF EXISTS `tec_partner`;

CREATE TABLE `tec_partner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `mather_name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `position` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `partner_part` varchar(10) NOT NULL,
  `join_date` date NOT NULL,
  `satus` int(11) NOT NULL DEFAULT '1',
  `entry_date` int(11) NOT NULL,
  `update_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: tec_payloaner
#

DROP TABLE IF EXISTS `tec_payloaner`;

CREATE TABLE `tec_payloaner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` decimal(10,0) NOT NULL,
  `loaner_id` int(11) NOT NULL,
  `entry_date` datetime DEFAULT NULL,
  `type` varchar(100) NOT NULL,
  `payment_type` varchar(20) DEFAULT NULL COMMENT 'cash/bank',
  `bankname` text,
  `bank_id` int(11) DEFAULT NULL,
  `cheque_or_card_no` varchar(100) DEFAULT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;

INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('1', '1000', '1', '2020-01-29 00:00:00', 'receive', 'cash', NULL, NULL, NULL, '');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('2', '1000', '3', '2020-01-29 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('3', '1000', '3', '2020-02-03 00:00:00', 'receive', 'cash', NULL, NULL, NULL, '');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('4', '1000', '1', '2020-02-03 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>LOAN BACK</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('5', '500', '3', '2020-07-29 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>CASH</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('6', '18000', '3', '2020-08-09 00:00:00', 'receive', 'cash', NULL, NULL, NULL, '<p>DATE: 09/08/2020</p><p>for BATTERY 15,000/=</p><p>     BOSS         3,000/=</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('7', '3000', '3', '2020-08-10 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>CASH RETURN</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('8', '3000', '3', '2020-08-11 00:00:00', 'receive', 'cash', NULL, NULL, NULL, '<p>DATE: 11/08/2020</p><p>CASH CS to CCT for Battery payment</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('9', '500', '4', '2020-08-11 00:00:00', 'receive', 'cash', NULL, NULL, NULL, '<p>DATE: 11/08/2020</p><p>CASH for Battery payment</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('10', '500', '3', '2020-08-11 00:00:00', 'receive', 'cash', NULL, NULL, NULL, '<p>CASH for BHUIYAN TECHNOLOGY</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('11', '150', '4', '2020-08-11 00:00:00', 'receive', 'cash', NULL, NULL, NULL, '<p>CASH</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('12', '1000000', '5', '2020-08-12 00:00:00', 'receive', 'cash', NULL, NULL, NULL, '<p>B.F</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('13', '100000', '6', '2020-08-13 00:00:00', 'receive', 'cash', NULL, NULL, NULL, '');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('14', '50000', '8', '2020-08-13 00:00:00', 'receive', 'cash', NULL, NULL, NULL, '');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('15', '76650', '2', '2020-08-13 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>FOR S.ONE COMPUTER PAYMENT TV</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('16', '100000', '8', '2020-08-16 00:00:00', 'receive', 'cash', NULL, NULL, NULL, '<p>DATE: 16/08/2020</p><p><br></p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('17', '73000', '2', '2020-08-16 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>DATE: 16/08/2020</p><p>CASH 72,000+ 1,000</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('18', '2800', '3', '2020-08-16 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p><br></p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('19', '21010', '2', '2020-08-16 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('20', '5000', '2', '2020-08-17 00:00:00', 'receive', 'cash', NULL, NULL, NULL, '<p>Return Loan TEH 5,000/=</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('21', '150000', '3', '2020-08-17 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('22', '20750', '4', '2020-08-17 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('23', '250000', '3', '2020-08-18 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>DATE: 18/08/2020</p><p>CHEQUE# 0391834</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('24', '100000', '3', '2020-08-19 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>DATE: 19/08/2020</p><p>TRUST BANK CHEQUE# 0391835</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('25', '15500', '3', '2020-08-20 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>DATE: 20/08/2020</p><p>CHEQUE# 0391836</p><p>TRUST BANK</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('26', '5600', '3', '2020-08-23 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>TRUST BANK</p><p>CHEQUE # 0391838</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('27', '20000', '3', '2020-08-23 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>TRUST BANK </p><p>CHEQUE # 0391839</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('28', '30000', '3', '2020-08-24 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>DATE: 24/08/2020</p><p>CHEQUE # 0391840</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('29', '30000', '3', '2020-08-26 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>TRUST BANK </p><p>CHEQUE# 0391841</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('30', '85000', '3', '2020-08-27 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>TRUST BANK</p><p>CHEQUE# 0391843</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('31', '44000', '2', '2020-08-27 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>TRUST BANK</p><p>CHEQUE# 0391844</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('32', '21000', '3', '2020-08-30 00:00:00', 'receive', 'cash', NULL, NULL, NULL, '<p>STAN NO: 025449, TRAN DATE: 30-08-2020</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('33', '3000', '4', '2020-08-30 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>A K COMPUTER SYSTEM</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('34', '9500', '3', '2020-08-31 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>DATE: 31/08/2020</p><p>CASH LOAN FOR BRAC BANK DEPOSIT</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('35', '3460', '4', '2020-09-08 00:00:00', 'receive', 'cash', NULL, NULL, NULL, '<p>DATE: 29/08/2020</p><p>LOAN FROM S.M MAHMUD SHARAFAT</p><p>PAYMENT CREATIVE COMPUTER 2,760/=</p><p>WEBCAME: CHINA 720P PURCHASES RETURN 700/=</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('36', '4500', '4', '2020-09-12 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>( TECH DEAL)</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('37', '22400', '3', '2020-09-13 00:00:00', 'receive', 'cash', NULL, NULL, NULL, '<p>DATE: 13/09/2020</p><p>FOR DEPOSIT TRUST BANK (SOUTH BANGLA PAYMENT)</p><p><br></p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('38', '14000', '3', '2020-09-15 00:00:00', 'receive', 'cash', NULL, NULL, NULL, '<p>CASH FOR CCT TRUST BANK DIPOSIT</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('39', '22000', '3', '2020-09-16 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('40', '85000', '10', '2020-09-17 00:00:00', 'receive', 'cheque', NULL, '2', '6622360', '<p>DATE: 17/09/2020</p><p>TRUST BANK </p><p>CHEQUE# 6622360, </p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('41', '130000', '4', '2020-09-17 00:00:00', 'receive', 'card', 'BRAC BANK', NULL, '4186 50** **** 8588', '<p>S.M MAHMUD SHARAFAT</p><p>CARD# 4186 50** **** 8588</p><p>DATE: 17/09/2020</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('42', '130000', '4', '2020-09-17 00:00:00', 'pay', 'card', 'BRAC BANK', NULL, '4186 50** **** 8588', '<p>ADJUSTMENT </p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('43', '27600', '3', '2020-09-20 00:00:00', 'receive', 'cash', NULL, NULL, NULL, '<p>DATE: 20/09/2020</p><p>CS BRAC BANK CHEQUE# 5461024</p><p>CASH DEPOSIT CCT TRUST BANK</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('44', '8000', '2', '2020-09-20 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>DATE: 20/09/2020</p><p>CASH </p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('45', '90000', '3', '2020-09-22 00:00:00', 'receive', 'cash', NULL, NULL, NULL, '<p>DATE: 21/09/2020</p><p>LOAN RETURN FROM CS FOR CCT TRUST</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('46', '26000', '3', '2020-09-27 00:00:00', 'receive', 'cash', NULL, NULL, NULL, '<p>DATE: 27/09/2020</p><p><br></p><p><br></p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('47', '25000', '3', '2020-09-27 00:00:00', 'receive', 'cash', NULL, NULL, NULL, '<p>DATE: 27/09/2020</p><p><br></p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('48', '25000', '5', '2020-09-27 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>DATE: 27/09/2020</p><p>RETURN LOAN SAJEDA HOSSAIN</p><p>SHAHJALAL ISLAMI BANK </p><p>A/C# 400312100053095</p><p>ENTY: CS 55/2</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('49', '19600', '3', '2020-09-27 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>DATE:26/09/2020</p><p>(From COMPUTER WORLD PABNA )</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('50', '2000', '3', '2020-09-27 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>DATE: 26/09/2020</p><p>TELEWAVE</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('51', '15000', '3', '2020-09-29 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>DATE: 29/09/2020</p><p>TRUST BANK CHEQUE# 0391851</p><p><br></p><p><br></p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('52', '16000', '3', '2020-09-30 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>DATE: 30/09/2020</p><p>LOAN CS FOR PREMIER C. CARD</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('53', '11963', '3', '2020-09-30 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>DATE: 30/09/2020</p><p>LOAN CS FOR KHAN ENTERPRISE ( SINGAPUR AIR TICKET )</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('54', '1100', '3', '2020-09-30 00:00:00', 'receive', 'cash', NULL, NULL, NULL, '<p>DATE: 30/09/2020</p><p><p>Transaction ID : IB71209812445200930041249</p><p>Transfer From : : 1524203491061001 - Name : COMPUTER SQUADRON</p><p>To bKash Account No : 01792111113</p><p>To bKash Account Name : MOHAMMAD SHAHRIAR KHAN</p><p>Transfer Amount : : Tk 1,100.00</p><p>Transaction Particular : IB/STAN/BKASH/01792111113</p><p>STAN No : 183815</p><p>Transfer Date : 30-9-2020 04:13:52</p><br></p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('55', '29680', '3', '2020-10-01 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>LOAN CS FOR OFFICE RENT NOV-DEC\'2019</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('56', '19000', '3', '2020-10-01 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>DATE: 01/10/2020</p><p>LONE BY BRAC BANK AC</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('57', '10000', '3', '2020-10-04 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>DATE: 04/10/2020</p><p>CCT TRUST BANK</p><p>CHEQUE # 0391855</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('58', '18000', '3', '2020-10-06 00:00:00', 'receive', 'cash', NULL, NULL, NULL, '<p>DATE: 06/10/2020</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('59', '16000', '3', '2020-10-08 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>DATE: 08/10/2020</p><p>CHEQUE# 0391856</p><p>CCT TRUST BANK</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('60', '2700', '3', '2020-10-12 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>cash</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('61', '1500', '3', '2020-10-13 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>DATE: 13/10/2020</p><p>FOR CS DBBL BANK CHARGE</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('62', '9000', '2', '2020-10-14 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>DATE: 14/10/2020</p><p>CASH</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('63', '26295', '4', '2020-10-15 00:00:00', 'pay', 'cheque', NULL, '2', '0391860', '<p>CHEQUE DATE: 15/10/2020</p><p>CHEQUE # 0391860</p><p>TRUST BANK</p><p>FOR DIGITAL MART</p><p><br></p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('64', '25000', '3', '2020-10-25 00:00:00', 'receive', 'cash', NULL, NULL, NULL, '<p>CASH</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('65', '25000', '5', '2020-10-25 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>DATE: 25/10/2020</p><p>CASH DEPOSIT </p><p>SHAHJALAL ISLAMI BANK</p><p>AC# 3095</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('66', '1000', '3', '2020-10-27 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>DATE: 27/10/2020</p><p>CASH</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('67', '2000', '3', '2020-11-05 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>DATE: 05/11/2020</p><p>CHEQUE# 0391861</p><p>TRUST BANK</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('68', '9350', '2', '2020-11-18 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>CASH FOR SERVICE CHARGE</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('69', '10000', '4', '2020-11-18 00:00:00', 'receive', 'cash', NULL, NULL, NULL, '<p>CASH LOAN FOR PAYMENT CCC</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('70', '10000', '3', '2020-11-25 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>CASH</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('71', '4000', '4', '2020-11-25 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>CASH</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('72', '4400', '4', '2020-12-09 00:00:00', 'receive', 'cash', NULL, NULL, NULL, '<p>FOR J.A.N ASSOCIATES PAYMENT</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('73', '800', '3', '2020-12-13 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>COMPUTER WORLD ( PABNA) BKASH</p>');
INSERT INTO `tec_payloaner` (`id`, `amount`, `loaner_id`, `entry_date`, `type`, `payment_type`, `bankname`, `bank_id`, `cheque_or_card_no`, `note`) VALUES ('74', '1000', '3', '2020-12-20 00:00:00', 'pay', 'cash', NULL, NULL, NULL, '<p>CASH</p>');


#
# TABLE STRUCTURE FOR: tec_payments
#

DROP TABLE IF EXISTS `tec_payments`;

CREATE TABLE `tec_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `sale_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `transaction_id` varchar(50) DEFAULT NULL,
  `paid_by` varchar(20) NOT NULL,
  `cheque_no` varchar(20) DEFAULT NULL,
  `cc_no` varchar(20) DEFAULT NULL,
  `cc_holder` varchar(25) DEFAULT NULL,
  `cc_month` varchar(2) DEFAULT NULL,
  `cc_year` varchar(4) DEFAULT NULL,
  `cc_type` varchar(20) DEFAULT NULL,
  `amount` decimal(25,2) NOT NULL,
  `currency` varchar(3) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `attachment` varchar(55) DEFAULT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `pos_paid` decimal(25,2) DEFAULT '0.00',
  `pos_balance` decimal(25,2) DEFAULT '0.00',
  `gc_no` varchar(20) DEFAULT NULL,
  `reference` varchar(50) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `store_id` int(11) NOT NULL DEFAULT '1',
  `payment_type` varchar(20) NOT NULL DEFAULT 'sale',
  `service_id` int(11) DEFAULT NULL,
  `collect_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('1', '2020-07-29 18:03:00', '1', '3', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '10000.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', 'sale', NULL, '1');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('2', '2020-08-09 20:03:00', '2', '3', NULL, 'cheque', NULL, NULL, NULL, NULL, NULL, NULL, '20000.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', 'sale', NULL, '2');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('3', '2020-08-27 20:27:00', '3', '4', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '70.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', 'sale', NULL, '3');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('4', '2020-08-30 19:37:00', '5', '3', NULL, 'cheque', NULL, NULL, NULL, NULL, NULL, NULL, '3000.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', 'sale', NULL, '4');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('5', '2020-08-30 19:37:00', '6', '3', NULL, 'cheque', NULL, NULL, NULL, NULL, NULL, NULL, '15000.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', 'sale', NULL, '4');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('6', '2020-08-30 19:38:00', '6', '3', NULL, 'cheque', NULL, NULL, NULL, NULL, NULL, NULL, '18800.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', 'sale', NULL, '5');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('7', '2020-08-30 19:40:00', '6', '3', NULL, 'cheque', NULL, NULL, NULL, NULL, NULL, NULL, '2200.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', 'sale', NULL, '6');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('8', '2020-08-30 19:53:00', '6', '3', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '3000.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', 'sale', NULL, '7');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('9', '2020-08-30 20:29:00', '4', '5', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '9500.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', 'sale', NULL, '8');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('10', '2020-09-12 19:43:00', '3', '4', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '6300.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', 'sale', NULL, '9');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('11', '2020-09-12 19:47:00', '7', '5', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '1100.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', 'sale', NULL, '10');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('12', '2020-09-12 19:47:00', '10', '5', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '2350.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', 'sale', NULL, '10');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('13', '2020-09-12 19:47:00', '12', '5', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '1050.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', 'sale', NULL, '10');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('14', '2020-09-14 18:17:00', '12', '5', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '850.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', 'sale', NULL, '11');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('15', '2020-09-14 18:17:00', '17', '5', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '4000.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', 'sale', NULL, '11');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('16', '2020-09-14 18:17:00', '20', '5', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '3150.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', 'sale', NULL, '11');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('17', '2020-09-14 19:31:00', '20', '5', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '850.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', 'sale', NULL, '12');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('18', '2020-09-20 11:59:00', '21', '5', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '8000.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', 'sale', NULL, '13');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('19', '2020-09-24 19:24:00', '24', '10', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '4750.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', 'sale', NULL, '14');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('20', '2020-09-27 16:24:00', '16', '8', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '14000.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', 'sale', NULL, '15');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('21', '2020-09-27 16:24:00', '19', '8', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '5600.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', 'sale', NULL, '15');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('22', '2020-09-27 18:35:00', '15', '9', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '2000.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', 'sale', NULL, '16');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('23', '2020-10-01 19:28:00', '25', '12', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '10000.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', 'sale', NULL, '17');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('24', '2020-10-01 19:28:00', '25', '12', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '9000.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', 'sale', NULL, '18');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('25', '2020-10-06 15:32:00', '23', '5', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '8000.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', 'sale', NULL, '19');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('26', '2020-10-12 15:09:00', '26', '14', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '9350.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', 'sale', NULL, '20');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('27', '2020-10-13 16:42:00', '27', '13', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '9500.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', 'sale', NULL, '21');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('28', '2020-10-15 13:55:02', '28', '14', NULL, 'cash', '', '', '', '', '', '', '18700.00', NULL, '34', NULL, '', '18700.00', '0.00', '', NULL, NULL, NULL, '1', 'sale', NULL, '22');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('29', '2020-10-21 19:48:00', '29', '11', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '3550.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', 'sale', NULL, '23');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('30', '2020-10-22 19:14:20', '30', '15', NULL, 'cash', '', '', '', '', '', '', '1900.00', NULL, '34', NULL, '', '1900.00', '0.00', '', NULL, NULL, NULL, '1', 'sale', NULL, '24');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('31', '2020-11-18 11:24:33', '32', '3', NULL, 'cash', '', '', '', '', '', '', '9350.00', NULL, '34', NULL, '', '9350.00', '0.00', '', NULL, NULL, NULL, '1', 'sale', NULL, '25');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('32', '2020-12-13 19:00:00', '19', '8', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '800.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', 'sale', NULL, '26');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('33', '2020-12-19 16:30:51', '34', '5', NULL, 'cash', '', '', '', '', '', '', '14600.00', NULL, '34', NULL, '', '14600.00', '0.00', '', NULL, NULL, NULL, '1', 'sale', NULL, '27');
INSERT INTO `tec_payments` (`id`, `date`, `sale_id`, `customer_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `payment_type`, `service_id`, `collect_id`) VALUES ('34', '2020-12-21 16:39:08', '35', '15', NULL, 'cash', '', '', '', '', '', '', '1900.00', NULL, '34', NULL, '', '1900.00', '0.00', '', NULL, NULL, NULL, '1', 'sale', NULL, '28');


#
# TABLE STRUCTURE FOR: tec_paysalary
#

DROP TABLE IF EXISTS `tec_paysalary`;

CREATE TABLE `tec_paysalary` (
  `pay_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `month_id` varchar(2) NOT NULL,
  `year` year(4) NOT NULL,
  `paid_by` varchar(50) DEFAULT NULL,
  `amount` varchar(10) NOT NULL,
  `commission` varchar(10) NOT NULL,
  `note` text NOT NULL,
  `pay_date` datetime NOT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`pay_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: tec_persons
#

DROP TABLE IF EXISTS `tec_persons`;

CREATE TABLE `tec_persons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `cf1` varchar(255) NOT NULL,
  `cf2` varchar(255) NOT NULL,
  `phone` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: tec_pettycash
#

DROP TABLE IF EXISTS `tec_pettycash`;

CREATE TABLE `tec_pettycash` (
  `pettycash_id` int(11) NOT NULL AUTO_INCREMENT,
  `entry_date` datetime NOT NULL,
  `amount` int(11) NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`pettycash_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tec_pettycash` (`pettycash_id`, `entry_date`, `amount`, `note`) VALUES ('1', '2020-02-04 17:40:00', '0', '<p>0</p>');
INSERT INTO `tec_pettycash` (`pettycash_id`, `entry_date`, `amount`, `note`) VALUES ('2', '2020-11-12 18:55:00', '-308267', '<p>00.00</p>');
INSERT INTO `tec_pettycash` (`pettycash_id`, `entry_date`, `amount`, `note`) VALUES ('3', '2020-11-16 15:12:00', '-308267', '<p>00.00</p>');
INSERT INTO `tec_pettycash` (`pettycash_id`, `entry_date`, `amount`, `note`) VALUES ('4', '2020-11-17 19:01:00', '-308267', '<p>00.00</p>');
INSERT INTO `tec_pettycash` (`pettycash_id`, `entry_date`, `amount`, `note`) VALUES ('5', '2020-11-18 12:40:00', '-308917', '<p>00.00</p>');
INSERT INTO `tec_pettycash` (`pettycash_id`, `entry_date`, `amount`, `note`) VALUES ('6', '2020-11-18 20:04:00', '-308917', '<p>00.00</p>');
INSERT INTO `tec_pettycash` (`pettycash_id`, `entry_date`, `amount`, `note`) VALUES ('7', '2020-12-19 18:39:00', '-297517', '<p>1000.00</p>');
INSERT INTO `tec_pettycash` (`pettycash_id`, `entry_date`, `amount`, `note`) VALUES ('8', '2020-12-20 16:48:00', '-297517', '<p>00.00</p>');
INSERT INTO `tec_pettycash` (`pettycash_id`, `entry_date`, `amount`, `note`) VALUES ('9', '2020-12-21 18:52:00', '-297417', '<p>100.00</p>');
INSERT INTO `tec_pettycash` (`pettycash_id`, `entry_date`, `amount`, `note`) VALUES ('10', '2020-12-22 15:13:00', '-297417', '<p>100.00</p>');
INSERT INTO `tec_pettycash` (`pettycash_id`, `entry_date`, `amount`, `note`) VALUES ('11', '2020-12-23 16:57:00', '-297417', '<p>100.00</p>');


#
# TABLE STRUCTURE FOR: tec_pro_sequence
#

DROP TABLE IF EXISTS `tec_pro_sequence`;

CREATE TABLE `tec_pro_sequence` (
  `sequence_id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL DEFAULT '0',
  `purchases_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `sequence` varchar(255) NOT NULL,
  `status` int(11) DEFAULT '0',
  `entry_date` datetime NOT NULL,
  PRIMARY KEY (`sequence_id`)
) ENGINE=InnoDB AUTO_INCREMENT=242 DEFAULT CHARSET=utf8;

INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('1', '1', '1', '1', '1', '2013197402969', '1', '2020-07-29 16:24:55');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('2', '1', '1', '1', '1', '2013197402970', '1', '2020-07-29 16:24:55');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('3', '1', '1', '1', '1', '2013197402971', '1', '2020-07-29 16:24:55');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('4', '1', '1', '1', '1', '2013197402972', '1', '2020-07-29 16:24:55');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('5', '1', '1', '1', '1', '2013197402973', '1', '2020-07-29 16:24:55');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('6', '1', '1', '1', '1', '2013197402974', '1', '2020-07-29 16:24:55');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('7', '1', '1', '1', '1', '2013197402975', '1', '2020-07-29 16:24:55');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('8', '1', '1', '1', '1', '2013197402976', '1', '2020-07-29 16:24:55');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('9', '1', '1', '1', '1', '2013197402977', '1', '2020-07-29 16:24:55');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('10', '1', '1', '1', '1', '2013197402978', '1', '2020-07-29 16:24:55');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('11', '3', '1', '2', '2', '22C09970', '1', '2020-08-09 17:24:30');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('12', '3', '1', '2', '2', '22C9971', '1', '2020-08-09 17:24:30');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('13', '3', '1', '2', '2', '22C9972', '1', '2020-08-09 17:24:30');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('14', '3', '1', '2', '2', '22C9973', '1', '2020-08-09 17:24:30');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('15', '3', '1', '2', '2', '22C9974', '1', '2020-08-09 17:24:30');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('16', '3', '1', '2', '2', '22C9975', '1', '2020-08-09 17:24:30');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('17', '3', '1', '2', '2', '22C9976', '1', '2020-08-09 17:24:30');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('18', '3', '1', '2', '2', '22C9977', '1', '2020-08-09 17:24:30');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('19', '3', '1', '2', '2', '22C9978', '1', '2020-08-09 17:24:30');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('20', '3', '1', '2', '2', '22C9979', '1', '2020-08-09 17:24:30');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('21', '3', '1', '2', '2', '22C9980', '1', '2020-08-09 17:24:30');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('22', '3', '1', '2', '2', '22C9981', '1', '2020-08-09 17:24:30');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('23', '3', '1', '2', '2', '22C9982', '1', '2020-08-09 17:24:30');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('24', '3', '1', '2', '2', '22C9983', '1', '2020-08-09 17:24:30');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('25', '3', '1', '2', '2', '22C9984', '1', '2020-08-09 17:24:30');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('26', '3', '1', '2', '2', '22C9985', '1', '2020-08-09 17:24:30');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('27', '3', '1', '2', '2', '22C9986', '1', '2020-08-09 17:24:30');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('28', '3', '1', '2', '2', '22C9987', '1', '2020-08-09 17:24:30');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('29', '3', '1', '2', '2', '22C9988', '1', '2020-08-09 17:24:30');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('30', '3', '1', '2', '2', '22C9989', '1', '2020-08-09 17:24:30');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('31', '5', '1', '4', '3', 'RT00206012004101', '1', '2020-08-20 16:48:23');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('32', '5', '1', '4', '3', 'RT206012004102', '1', '2020-08-20 16:48:23');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('33', '5', '1', '4', '3', 'RT206012004103', '1', '2020-08-20 16:48:23');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('34', '5', '1', '4', '3', 'RT206012004104', '1', '2020-08-20 16:48:23');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('35', '5', '1', '4', '3', 'RT206012004105', '1', '2020-08-20 16:48:23');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('36', '5', '1', '4', '3', 'RT206012004106', '1', '2020-08-20 16:48:23');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('37', '5', '1', '4', '3', 'RT206012004107', '1', '2020-08-20 16:48:23');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('38', '5', '1', '4', '3', 'RT206012004108', '1', '2020-08-20 16:48:23');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('39', '5', '1', '4', '3', 'RT206012004109', '1', '2020-08-20 16:48:23');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('40', '5', '1', '4', '3', 'RT206012004110', '1', '2020-08-20 16:48:23');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('41', '5', '1', '4', '16', 'RT206012004111', '1', '2020-08-20 16:48:23');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('42', '5', '1', '4', '16', 'RT206012004112', '1', '2020-08-20 16:48:23');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('43', '5', '1', '4', '16', 'RT206012004113', '1', '2020-08-20 16:48:23');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('44', '5', '1', '4', '16', 'RT206012004114', '1', '2020-08-20 16:48:23');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('45', '5', '1', '4', '16', 'RT206012004115', '1', '2020-08-20 16:48:23');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('46', '5', '1', '4', '16', 'RT206012004116', '1', '2020-08-20 16:48:23');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('47', '5', '1', '4', '16', 'RT206012004117', '1', '2020-08-20 16:48:23');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('48', '5', '1', '4', '16', 'RT206012004118', '1', '2020-08-20 16:48:23');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('49', '5', '1', '4', '16', 'RT206012004119', '1', '2020-08-20 16:48:23');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('50', '5', '1', '4', '0', 'RT206012004120', '0', '2020-08-20 16:48:23');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('51', '5', '1', '5', '16', 'RT000228051902125', '1', '2020-08-20 17:00:44');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('52', '2', '1', '6', '4', '2013197403039', '1', '2020-08-30 11:18:07');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('53', '2', '1', '6', '4', '2013197403040', '1', '2020-08-30 11:18:07');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('54', '2', '1', '6', '4', '2013197403041', '1', '2020-08-30 11:18:07');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('55', '2', '1', '6', '4', '2013197403042', '1', '2020-08-30 11:18:07');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('56', '2', '1', '6', '4', '2013197403043', '1', '2020-08-30 11:18:07');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('57', '2', '1', '6', '4', '2013197403044', '1', '2020-08-30 11:18:07');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('58', '2', '1', '6', '4', '2013197403045', '1', '2020-08-30 11:18:07');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('59', '2', '1', '6', '4', '2013197403046', '1', '2020-08-30 11:18:07');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('60', '2', '1', '6', '4', '2013197403047', '1', '2020-08-30 11:18:07');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('61', '2', '1', '6', '4', '2013197403048', '1', '2020-08-30 11:18:07');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('62', '2', '1', '7', '5', '2013197403025', '1', '2020-08-30 11:26:34');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('63', '2', '1', '7', '5', '2013197403026', '1', '2020-08-30 11:26:34');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('64', '2', '1', '7', '5', '2013197403027', '1', '2020-08-30 11:26:34');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('65', '2', '1', '8', '6', '22C08986', '1', '2020-08-30 16:14:32');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('66', '2', '1', '8', '6', '22C8987', '1', '2020-08-30 16:14:32');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('67', '2', '1', '8', '6', '22C8988', '1', '2020-08-30 16:14:32');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('68', '2', '1', '8', '6', '22C8989', '1', '2020-08-30 16:14:32');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('69', '2', '1', '8', '6', '22C8990', '1', '2020-08-30 16:14:32');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('70', '2', '1', '8', '6', '22C8991', '1', '2020-08-30 16:14:32');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('71', '2', '1', '8', '6', '22C8992', '1', '2020-08-30 16:14:32');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('72', '2', '1', '8', '6', '22C8993', '1', '2020-08-30 16:14:32');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('73', '2', '1', '8', '6', '22C8994', '1', '2020-08-30 16:14:32');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('74', '2', '1', '8', '6', '22C8995', '1', '2020-08-30 16:14:32');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('75', '2', '1', '8', '6', '22C8996', '1', '2020-08-30 16:14:32');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('76', '2', '1', '8', '6', '22C8997', '1', '2020-08-30 16:14:32');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('77', '2', '1', '8', '6', '22C8998', '1', '2020-08-30 16:14:32');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('78', '2', '1', '8', '6', '22C8999', '1', '2020-08-30 16:14:33');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('79', '2', '1', '8', '6', '22C9000', '1', '2020-08-30 16:14:33');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('80', '2', '1', '8', '6', '22C9001', '1', '2020-08-30 16:14:33');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('81', '2', '1', '8', '6', '22C9002', '1', '2020-08-30 16:14:33');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('82', '2', '1', '8', '6', '22C9003', '1', '2020-08-30 16:14:33');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('83', '2', '1', '8', '6', '22C9004', '1', '2020-08-30 16:14:33');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('84', '2', '1', '8', '6', '22C9005', '1', '2020-08-30 16:14:33');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('85', '2', '1', '8', '6', '22C9006', '1', '2020-08-30 16:14:33');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('86', '2', '1', '8', '6', '22C9007', '1', '2020-08-30 16:14:33');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('87', '2', '1', '8', '6', '22C9008', '1', '2020-08-30 16:14:33');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('88', '2', '1', '8', '6', '22C9009', '1', '2020-08-30 16:14:33');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('89', '2', '1', '8', '6', '22C9010', '1', '2020-08-30 16:14:33');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('90', '2', '1', '8', '6', '22C9011', '1', '2020-08-30 16:14:33');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('91', '2', '1', '8', '6', '22C9012', '1', '2020-08-30 16:14:33');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('92', '2', '1', '8', '6', '22C9013', '1', '2020-08-30 16:14:33');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('93', '2', '1', '8', '6', '22C9014', '1', '2020-08-30 16:14:33');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('94', '2', '1', '8', '6', '22C9015', '1', '2020-08-30 16:14:33');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('95', '2', '1', '8', '6', '22C9036', '1', '2020-08-30 16:14:33');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('96', '2', '1', '8', '6', '22C9037', '1', '2020-08-30 16:14:33');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('97', '2', '1', '8', '6', '22C9038', '1', '2020-08-30 16:14:33');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('98', '2', '1', '8', '6', '22C9039', '1', '2020-08-30 16:14:33');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('99', '2', '1', '8', '6', '22C9040', '1', '2020-08-30 16:14:33');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('100', '2', '1', '8', '6', '22C9041', '1', '2020-08-30 16:14:33');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('101', '2', '1', '8', '6', '22C9042', '1', '2020-08-30 16:14:33');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('102', '2', '1', '8', '6', '22C9043', '1', '2020-08-30 16:14:33');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('103', '2', '1', '8', '6', '22C9044', '1', '2020-08-30 16:14:33');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('104', '2', '1', '8', '6', '22C9045', '1', '2020-08-30 16:14:33');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('105', '9', '1', '10', '10', 'C2412617120275', '1', '2020-09-08 19:02:02');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('106', '2', '1', '11', '12', '22C08404', '1', '2020-09-10 16:11:15');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('107', '2', '1', '11', '12', '22C08407', '1', '2020-09-10 16:11:15');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('108', '11', '1', '13', '14', '2026LZ5206F9', '1', '2020-09-10 20:26:56');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('109', '2', '1', '15', '15', '22C08410', '1', '2020-09-12 16:22:16');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('110', '2', '1', '15', '15', '22C08408', '1', '2020-09-12 16:22:16');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('111', '13', '1', '16', '0', 'E6334010033003366', '0', '2020-09-12 17:13:19');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('112', '13', '1', '16', '0', 'E6334010033003342', '0', '2020-09-12 17:13:19');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('113', '13', '1', '16', '18', 'E6334010033003353', '1', '2020-09-12 17:13:19');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('114', '13', '1', '16', '0', 'E6334010033003347', '0', '2020-09-12 17:13:19');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('115', '13', '1', '16', '18', 'E6334010033003356', '1', '2020-09-12 17:13:20');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('116', '13', '1', '16', '18', 'E6334010033003345', '1', '2020-09-12 17:13:20');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('117', '13', '1', '16', '18', 'E6334010033003152', '1', '2020-09-12 17:13:20');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('118', '13', '1', '16', '18', 'E6334010033003359', '1', '2020-09-12 17:13:20');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('119', '13', '1', '16', '0', 'E6334010033003242', '0', '2020-09-12 17:13:20');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('120', '13', '1', '16', '31', 'E6334010033003145', '1', '2020-09-12 17:13:20');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('121', '13', '1', '16', '0', 'E6334010033003340', '0', '2020-09-12 17:13:20');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('122', '13', '1', '16', '18', 'E6334010033003331', '1', '2020-09-12 17:13:20');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('123', '13', '1', '16', '0', 'E6334010033003365', '0', '2020-09-12 17:13:20');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('124', '13', '1', '16', '18', 'E6334010033003120', '1', '2020-09-12 17:13:20');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('125', '13', '1', '16', '0', 'E6334010033003328', '0', '2020-09-12 17:13:20');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('126', '13', '1', '16', '0', 'E6334010033003300', '0', '2020-09-12 17:13:20');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('127', '13', '1', '16', '18', 'E6334010033003004', '1', '2020-09-12 17:13:20');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('128', '13', '1', '16', '0', 'E6334010033003363', '0', '2020-09-12 17:13:20');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('129', '13', '1', '16', '0', 'E6334010033003367', '0', '2020-09-12 17:13:20');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('130', '13', '1', '16', '0', 'E6334010033003339', '0', '2020-09-12 17:13:20');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('131', '2', '1', '17', '17', '22C08518', '1', '2020-09-12 17:22:00');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('132', '2', '1', '17', '17', '22C08519', '1', '2020-09-12 17:22:00');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('133', '2', '1', '17', '17', '22C08520', '1', '2020-09-12 17:22:00');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('134', '2', '1', '17', '17', '22C08405', '1', '2020-09-12 17:22:00');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('135', '13', '1', '18', '18', 'E6334010033013624', '1', '2020-09-12 17:40:10');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('136', '13', '1', '18', '18', 'E6334010033013752', '1', '2020-09-12 17:40:10');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('137', '2', '1', '19', '20', '22C08406', '1', '2020-09-12 18:55:25');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('138', '2', '1', '19', '20', '22C08403', '1', '2020-09-12 18:55:25');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('139', '2', '1', '20', '20', '22C08521', '1', '2020-09-12 19:00:07');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('140', '2', '1', '20', '20', '22C08522', '1', '2020-09-12 19:00:07');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('141', '2', '1', '21', '21', '22C08643', '1', '2020-09-15 16:22:35');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('142', '2', '1', '21', '21', '22C08644', '1', '2020-09-15 16:22:35');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('143', '2', '1', '21', '21', '22C08645', '1', '2020-09-15 16:22:35');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('144', '2', '1', '21', '21', '22C08646', '1', '2020-09-15 16:22:35');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('145', '2', '1', '21', '21', '22C08647', '1', '2020-09-15 16:22:35');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('146', '2', '1', '21', '21', '22C08648', '1', '2020-09-15 16:22:35');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('147', '2', '1', '21', '24', '22C08649', '1', '2020-09-15 16:22:35');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('148', '2', '1', '21', '24', '22C08650', '1', '2020-09-15 16:22:35');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('149', '2', '1', '21', '21', '22C08641', '1', '2020-09-15 16:22:35');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('150', '2', '1', '21', '21', '22C08642', '1', '2020-09-15 16:22:35');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('151', '14', '1', '22', '22', '2013197403216', '1', '2020-09-19 13:00:09');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('152', '2', '1', '23', '25', '22C07691', '1', '2020-09-24 15:57:17');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('153', '2', '1', '23', '25', '22C7692', '1', '2020-09-24 15:57:17');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('154', '2', '1', '23', '25', '22C7693', '1', '2020-09-24 15:57:17');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('155', '2', '1', '23', '25', '22C7694', '1', '2020-09-24 15:57:17');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('156', '2', '1', '23', '25', '22C7695', '1', '2020-09-24 15:57:17');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('157', '2', '1', '23', '25', '22C7696', '1', '2020-09-24 15:57:17');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('158', '2', '1', '23', '25', '22C7697', '1', '2020-09-24 15:57:17');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('159', '2', '1', '23', '25', '22C7698', '1', '2020-09-24 15:57:17');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('160', '2', '1', '23', '25', '22C7699', '1', '2020-09-24 15:57:17');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('161', '2', '1', '23', '24', '22C7700', '1', '2020-09-24 15:57:17');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('162', '2', '1', '23', '23', '22C7701', '1', '2020-09-24 15:57:17');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('163', '2', '1', '23', '23', '22C7702', '1', '2020-09-24 15:57:17');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('164', '2', '1', '23', '23', '22C7703', '1', '2020-09-24 15:57:17');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('165', '2', '1', '23', '23', '22C7704', '1', '2020-09-24 15:57:17');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('166', '2', '1', '23', '23', '22C7705', '1', '2020-09-24 15:57:17');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('167', '2', '1', '23', '23', '22C7706', '1', '2020-09-24 15:57:17');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('168', '2', '1', '23', '23', '22C7707', '1', '2020-09-24 15:57:17');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('169', '2', '1', '23', '23', '22C7708', '1', '2020-09-24 15:57:17');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('170', '2', '1', '23', '24', '22C7709', '1', '2020-09-24 15:57:17');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('171', '2', '1', '23', '24', '22C7710', '1', '2020-09-24 15:57:17');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('172', '2', '1', '24', '25', '22C07594', '1', '2020-09-26 11:59:52');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('173', '2', '1', '24', '25', '22C07595', '1', '2020-09-26 11:59:52');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('174', '2', '1', '24', '25', '22C07596', '1', '2020-09-26 11:59:52');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('175', '2', '1', '24', '25', '22C07597', '1', '2020-09-26 11:59:52');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('176', '2', '1', '24', '25', '22C07598', '1', '2020-09-26 11:59:52');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('177', '2', '1', '24', '25', '22C07599', '1', '2020-09-26 11:59:52');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('178', '2', '1', '24', '25', '22C07600', '1', '2020-09-26 11:59:52');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('179', '2', '1', '24', '25', '22C07779', '1', '2020-09-26 11:59:52');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('180', '2', '1', '24', '30', '22C07780', '1', '2020-09-26 11:59:52');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('181', '2', '1', '24', '25', '22C07591', '1', '2020-09-26 11:59:52');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('182', '2', '1', '24', '25', '22C07592', '1', '2020-09-26 11:59:52');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('183', '2', '1', '24', '25', '22C07593', '1', '2020-09-26 11:59:52');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('184', '2', '1', '25', '26', '22C07761', '1', '2020-10-12 13:02:26');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('185', '2', '1', '25', '26', '22C07762', '1', '2020-10-12 13:02:26');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('186', '2', '1', '25', '26', '22C07763', '1', '2020-10-12 13:02:26');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('187', '2', '1', '25', '26', '22C07764', '1', '2020-10-12 13:02:26');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('188', '2', '1', '25', '26', '22C07765', '1', '2020-10-12 13:02:26');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('189', '2', '1', '25', '26', '22C07766', '1', '2020-10-12 13:02:26');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('190', '2', '1', '25', '26', '22C07767', '1', '2020-10-12 13:02:26');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('191', '2', '1', '25', '26', '22C07768', '1', '2020-10-12 13:02:26');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('192', '2', '1', '25', '26', '22C07769', '1', '2020-10-12 13:02:26');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('193', '2', '1', '25', '26', '22C07770', '1', '2020-10-12 13:02:26');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('194', '2', '1', '26', '27', '22C07141', '1', '2020-10-12 15:02:08');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('195', '2', '1', '26', '27', '22C07142', '1', '2020-10-12 15:02:08');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('196', '2', '1', '26', '27', '22C07143', '1', '2020-10-12 15:02:08');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('197', '2', '1', '26', '27', '22C07144', '1', '2020-10-12 15:02:08');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('198', '2', '1', '26', '27', '22C07145', '1', '2020-10-12 15:02:08');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('199', '2', '1', '26', '27', '22C07146', '1', '2020-10-12 15:02:08');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('200', '2', '1', '26', '27', '22C07147', '1', '2020-10-12 15:02:08');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('201', '2', '1', '26', '27', '22C07148', '1', '2020-10-12 15:02:08');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('202', '2', '1', '26', '27', '22C07149', '1', '2020-10-12 15:02:08');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('203', '2', '1', '26', '27', '22C07150', '1', '2020-10-12 15:02:08');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('204', '2', '1', '26', '0', 'false', '0', '2020-10-13 14:33:04');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('205', '2', '1', '25', '0', 'false', '0', '2020-10-13 14:33:19');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('206', '2', '1', '27', '28', '22C08251', '1', '2020-10-15 13:52:43');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('207', '2', '1', '27', '28', '22C08252', '1', '2020-10-15 13:52:43');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('208', '2', '1', '27', '28', '22C08253', '1', '2020-10-15 13:52:43');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('209', '2', '1', '27', '28', '22C08254', '1', '2020-10-15 13:52:43');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('210', '2', '1', '27', '28', '22C08255', '1', '2020-10-15 13:52:43');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('211', '2', '1', '27', '28', '22C08256', '1', '2020-10-15 13:52:43');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('212', '2', '1', '27', '28', '22C08257', '1', '2020-10-15 13:52:43');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('213', '2', '1', '27', '28', '22C08258', '1', '2020-10-15 13:52:43');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('214', '2', '1', '27', '28', '22C08259', '1', '2020-10-15 13:52:43');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('215', '2', '1', '27', '28', '22C08260', '1', '2020-10-15 13:52:43');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('216', '2', '1', '27', '28', '22C08261', '1', '2020-10-15 13:52:43');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('217', '2', '1', '27', '28', '22C08262', '1', '2020-10-15 13:52:43');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('218', '2', '1', '27', '28', '22C08263', '1', '2020-10-15 13:52:43');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('219', '2', '1', '27', '28', '22C08264', '1', '2020-10-15 13:52:43');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('220', '2', '1', '27', '28', '22C08265', '1', '2020-10-15 13:52:43');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('221', '2', '1', '27', '28', '22C08266', '1', '2020-10-15 13:52:43');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('222', '2', '1', '27', '28', '22C08267', '1', '2020-10-15 13:52:43');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('223', '2', '1', '27', '28', '22C08268', '1', '2020-10-15 13:52:43');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('224', '2', '1', '27', '28', '22C08269', '1', '2020-10-15 13:52:43');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('225', '2', '1', '27', '28', '22C08270', '1', '2020-10-15 13:52:43');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('226', '15', '1', '28', '29', 'G040942047', '1', '2020-10-21 17:25:38');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('227', '2', '1', '29', '30', '22C09438', '1', '2020-10-22 18:51:48');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('228', '2', '1', '30', '32', '22C06311', '1', '2020-11-18 11:22:39');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('229', '2', '1', '30', '32', '22C06312', '1', '2020-11-18 11:22:39');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('230', '2', '1', '30', '32', '22C06313', '1', '2020-11-18 11:22:39');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('231', '2', '1', '30', '32', '22C06314', '1', '2020-11-18 11:22:39');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('232', '2', '1', '30', '32', '22C06315', '1', '2020-11-18 11:22:39');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('233', '2', '1', '30', '32', '22C06316', '1', '2020-11-18 11:22:39');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('234', '2', '1', '30', '32', '22C06317', '1', '2020-11-18 11:22:39');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('235', '2', '1', '30', '32', '22C06318', '1', '2020-11-18 11:22:39');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('236', '2', '1', '30', '32', '22C06319', '1', '2020-11-18 11:22:39');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('237', '2', '1', '30', '32', '22C06320', '1', '2020-11-18 11:22:39');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('238', '16', '1', '31', '33', '20200430H3A', '1', '2020-12-09 15:33:19');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('239', '17', '1', '32', '34', '201912270097', '1', '2020-12-19 16:24:54');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('240', '2', '1', '33', '35', '22C06686', '1', '2020-12-21 16:31:30');
INSERT INTO `tec_pro_sequence` (`sequence_id`, `pro_id`, `store_id`, `purchases_id`, `sales_id`, `sequence`, `status`, `entry_date`) VALUES ('241', '2', '1', '33', '35', '22C06687', '1', '2020-12-21 16:31:30');


#
# TABLE STRUCTURE FOR: tec_product_store_qty
#

DROP TABLE IF EXISTS `tec_product_store_qty`;

CREATE TABLE `tec_product_store_qty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `quantity` decimal(12,2) NOT NULL DEFAULT '0.00',
  `price` decimal(25,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `store_id` (`store_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

INSERT INTO `tec_product_store_qty` (`id`, `product_id`, `store_id`, `quantity`, `price`) VALUES ('1', '1', '1', '0.00', NULL);
INSERT INTO `tec_product_store_qty` (`id`, `product_id`, `store_id`, `quantity`, `price`) VALUES ('2', '3', '1', '0.00', NULL);
INSERT INTO `tec_product_store_qty` (`id`, `product_id`, `store_id`, `quantity`, `price`) VALUES ('3', '4', '1', '2.00', NULL);
INSERT INTO `tec_product_store_qty` (`id`, `product_id`, `store_id`, `quantity`, `price`) VALUES ('4', '5', '1', '1.00', NULL);
INSERT INTO `tec_product_store_qty` (`id`, `product_id`, `store_id`, `quantity`, `price`) VALUES ('5', '2', '1', '0.00', NULL);
INSERT INTO `tec_product_store_qty` (`id`, `product_id`, `store_id`, `quantity`, `price`) VALUES ('6', '6', '1', '0.00', NULL);
INSERT INTO `tec_product_store_qty` (`id`, `product_id`, `store_id`, `quantity`, `price`) VALUES ('7', '7', '1', '0.00', NULL);
INSERT INTO `tec_product_store_qty` (`id`, `product_id`, `store_id`, `quantity`, `price`) VALUES ('8', '9', '1', '0.00', NULL);
INSERT INTO `tec_product_store_qty` (`id`, `product_id`, `store_id`, `quantity`, `price`) VALUES ('9', '10', '1', '0.00', NULL);
INSERT INTO `tec_product_store_qty` (`id`, `product_id`, `store_id`, `quantity`, `price`) VALUES ('10', '11', '1', '0.00', NULL);
INSERT INTO `tec_product_store_qty` (`id`, `product_id`, `store_id`, `quantity`, `price`) VALUES ('11', '12', '1', '0.00', NULL);
INSERT INTO `tec_product_store_qty` (`id`, `product_id`, `store_id`, `quantity`, `price`) VALUES ('12', '13', '1', '11.00', NULL);
INSERT INTO `tec_product_store_qty` (`id`, `product_id`, `store_id`, `quantity`, `price`) VALUES ('13', '14', '1', '0.00', NULL);
INSERT INTO `tec_product_store_qty` (`id`, `product_id`, `store_id`, `quantity`, `price`) VALUES ('14', '15', '1', '0.00', NULL);
INSERT INTO `tec_product_store_qty` (`id`, `product_id`, `store_id`, `quantity`, `price`) VALUES ('15', '16', '1', '0.00', NULL);
INSERT INTO `tec_product_store_qty` (`id`, `product_id`, `store_id`, `quantity`, `price`) VALUES ('16', '17', '1', '0.00', NULL);


#
# TABLE STRUCTURE FOR: tec_products
#

DROP TABLE IF EXISTS `tec_products`;

CREATE TABLE `tec_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` char(255) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT '1',
  `brands_id` int(11) NOT NULL,
  `price` decimal(25,2) NOT NULL,
  `image` varchar(255) DEFAULT 'no_image.png',
  `tax` varchar(20) DEFAULT NULL,
  `cost` decimal(25,2) DEFAULT NULL,
  `tax_method` tinyint(1) DEFAULT '1',
  `quantity` decimal(15,2) DEFAULT '0.00',
  `barcode_symbology` varchar(20) NOT NULL DEFAULT 'code39',
  `type` varchar(20) NOT NULL DEFAULT 'standard',
  `details` text,
  `alert_quantity` decimal(10,2) DEFAULT '0.00',
  `sequence` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

INSERT INTO `tec_products` (`id`, `code`, `name`, `category_id`, `brands_id`, `price`, `image`, `tax`, `cost`, `tax_method`, `quantity`, `barcode_symbology`, `type`, `details`, `alert_quantity`, `sequence`) VALUES ('1', '82', 'GENERAL POWER 8.2', '1', '0', '0.00', 'no_image.png', '0', '950.00', '0', '0.00', 'code39', 'standard', '', '0.00', '');
INSERT INTO `tec_products` (`id`, `code`, `name`, `category_id`, `brands_id`, `price`, `image`, `tax`, `cost`, `tax_method`, `quantity`, `barcode_symbology`, `type`, `details`, `alert_quantity`, `sequence`) VALUES ('2', 'battery', 'BATTERY: GENERAL POWER 12V 8.2AH', '1', '0', '0.00', 'no_image.png', '0', '900.00', '0', '0.00', 'code39', 'standard', '', '0.00', '');
INSERT INTO `tec_products` (`id`, `code`, `name`, `category_id`, `brands_id`, `price`, `image`, `tax`, `cost`, `tax_method`, `quantity`, `barcode_symbology`, `type`, `details`, `alert_quantity`, `sequence`) VALUES ('3', '8209', 'BATTERY: GENERAL POWER 12 V  8.2 AH', '3', '0', '0.00', 'no_image.png', '0', '925.00', '0', '0.00', 'code39', 'standard', '', '0.00', '');
INSERT INTO `tec_products` (`id`, `code`, `name`, `category_id`, `brands_id`, `price`, `image`, `tax`, `cost`, `tax_method`, `quantity`, `barcode_symbology`, `type`, `details`, `alert_quantity`, `sequence`) VALUES ('4', 'toner', '85_Toner_85A/325/35A/312', '4', '0', '0.00', 'no_image.png', '0', '360.00', '0', '2.00', 'code39', 'standard', '', '0.00', '');
INSERT INTO `tec_products` (`id`, `code`, `name`, `category_id`, `brands_id`, `price`, `image`, `tax`, `cost`, `tax_method`, `quantity`, `barcode_symbology`, `type`, `details`, `alert_quantity`, `sequence`) VALUES ('5', 'WN532N2', 'WL-WN532N2:  4x5dBi Antenna N300 Wireless Router', '5', '0', '0.00', 'no_image.png', '0', '1272.73', '0', '1.00', 'code39', 'standard', '', '0.00', '');
INSERT INTO `tec_products` (`id`, `code`, `name`, `category_id`, `brands_id`, `price`, `image`, `tax`, `cost`, `tax_method`, `quantity`, `barcode_symbology`, `type`, `details`, `alert_quantity`, `sequence`) VALUES ('6', '1080P', 'WEBCAM: CHINA ORIGIN, 1080P WITH BUIL T-IN MICROPHONE', '6', '0', '0.00', 'no_image.png', '0', '900.00', '0', '0.00', 'code39', 'standard', '', '0.00', '');
INSERT INTO `tec_products` (`id`, `code`, `name`, `category_id`, `brands_id`, `price`, `image`, `tax`, `cost`, `tax_method`, `quantity`, `barcode_symbology`, `type`, `details`, `alert_quantity`, `sequence`) VALUES ('7', '720P', 'WEBCAM: CHINA ORIGIN, 720P WITH BUIL T-IN MICROPHONE', '6', '0', '0.00', 'no_image.png', '0', '700.00', '0', '0.00', 'code39', 'standard', '', '0.00', '');
INSERT INTO `tec_products` (`id`, `code`, `name`, `category_id`, `brands_id`, `price`, `image`, `tax`, `cost`, `tax_method`, `quantity`, `barcode_symbology`, `type`, `details`, `alert_quantity`, `sequence`) VALUES ('8', '650', 'POWERCON 650 VA UPS', '7', '0', '0.00', 'no_image.png', '0', '0.00', '0', '0.00', 'code39', 'standard', '', '0.00', '');
INSERT INTO `tec_products` (`id`, `code`, `name`, `category_id`, `brands_id`, `price`, `image`, `tax`, `cost`, `tax_method`, `quantity`, `barcode_symbology`, `type`, `details`, `alert_quantity`, `sequence`) VALUES ('9', 'powercon', 'POWERCON 650 VA UPS', '7', '0', '0.00', 'no_image.png', '0', '2300.00', '0', '0.00', 'code39', 'standard', '', '0.00', '');
INSERT INTO `tec_products` (`id`, `code`, `name`, `category_id`, `brands_id`, `price`, `image`, `tax`, `cost`, `tax_method`, `quantity`, `barcode_symbology`, `type`, `details`, `alert_quantity`, `sequence`) VALUES ('10', 'HS30', 'HEAD PHONE A4 TECH MULTIMEDIA HS-30', '8', '0', '0.00', 'no_image.png', '0', '850.00', '0', '0.00', 'code39', 'standard', '', '0.00', '');
INSERT INTO `tec_products` (`id`, `code`, `name`, `category_id`, `brands_id`, `price`, `image`, `tax`, `cost`, `tax_method`, `quantity`, `barcode_symbology`, `type`, `details`, `alert_quantity`, `sequence`) VALUES ('11', 'hd720p', 'WEBCAM LOGITECH HD-720P/30FPS C270', '9', '0', '0.00', 'no_image.png', '0', '2800.00', '0', '0.00', 'code39', 'standard', '', '0.00', '');
INSERT INTO `tec_products` (`id`, `code`, `name`, `category_id`, `brands_id`, `price`, `image`, `tax`, `cost`, `tax_method`, `quantity`, `barcode_symbology`, `type`, `details`, `alert_quantity`, `sequence`) VALUES ('12', 'CAT6', 'CABLE ADP CAT 6 305 METER BOX', '10', '0', '0.00', 'no_image.png', '0', '3150.00', '0', '0.00', 'code39', 'standard', '', '0.00', '');
INSERT INTO `tec_products` (`id`, `code`, `name`, `category_id`, `brands_id`, `price`, `image`, `tax`, `cost`, `tax_method`, `quantity`, `barcode_symbology`, `type`, `details`, `alert_quantity`, `sequence`) VALUES ('13', '300mbpsmodelf3', 'WIRELESS ROUTER TENDA 300 mbps MODEL: F3.', '5', '0', '0.00', 'no_image.png', '0', '1018.18', '0', '11.00', 'code39', 'standard', '', '0.00', '');
INSERT INTO `tec_products` (`id`, `code`, `name`, `category_id`, `brands_id`, `price`, `image`, `tax`, `cost`, `tax_method`, `quantity`, `barcode_symbology`, `type`, `details`, `alert_quantity`, `sequence`) VALUES ('14', '32INCH', 'PILOT VIEW TV : 32 INCH TV CHINA', '11', '0', '0.00', 'no_image.png', '0', '9600.00', '0', '0.00', 'code39', 'standard', '', '0.00', '');
INSERT INTO `tec_products` (`id`, `code`, `name`, `category_id`, `brands_id`, `price`, `image`, `tax`, `cost`, `tax_method`, `quantity`, `barcode_symbology`, `type`, `details`, `alert_quantity`, `sequence`) VALUES ('15', '256GB', 'TRANSCEND SSD TS256GSSD230S 256GB, 2.5\" SSD230S, SATA3, 3D TLC, ALUMINUM CASE', '12', '0', '0.00', 'no_image.png', '0', '3800.00', '0', '0.00', 'code39', 'standard', '', '0.00', '');
INSERT INTO `tec_products` (`id`, `code`, `name`, `category_id`, `brands_id`, `price`, `image`, `tax`, `cost`, `tax_method`, `quantity`, `barcode_symbology`, `type`, `details`, `alert_quantity`, `sequence`) VALUES ('16', 'cartridge326', 'CANON CARTRIDGE 326', '4', '0', '0.00', 'no_image.png', '0', '4400.00', '0', '0.00', 'code39', 'standard', '', '0.00', '');
INSERT INTO `tec_products` (`id`, `code`, `name`, `category_id`, `brands_id`, `price`, `image`, `tax`, `cost`, `tax_method`, `quantity`, `barcode_symbology`, `type`, `details`, `alert_quantity`, `sequence`) VALUES ('17', '1KVA', 'UPS: GENERAL POWER 1 KVA ON LINE', '7', '0', '0.00', 'no_image.png', '0', '13600.00', '0', '0.00', 'code39', 'standard', '', '0.00', '');


#
# TABLE STRUCTURE FOR: tec_purchase_items
#

DROP TABLE IF EXISTS `tec_purchase_items`;

CREATE TABLE `tec_purchase_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` decimal(15,2) NOT NULL,
  `cost` decimal(25,2) NOT NULL,
  `foreign_cost` decimal(10,0) NOT NULL,
  `subtotal` decimal(25,2) NOT NULL,
  `store_id` int(11) NOT NULL,
  `expiry_year` decimal(25,2) NOT NULL,
  `expiry_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('1', '1', '1', '10.00', '950.00', '0', '9500.00', '1', '6.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('2', '2', '3', '20.00', '925.00', '0', '18500.00', '1', '6.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('3', '3', '4', '2.00', '360.00', '0', '720.00', '1', '0.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('4', '4', '5', '20.00', '1400.00', '0', '28000.00', '1', '0.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('5', '5', '5', '1.00', '0.00', '0', '0.00', '1', '0.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('6', '6', '2', '10.00', '920.00', '0', '9200.00', '1', '6.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('7', '7', '2', '3.00', '920.00', '0', '2760.00', '1', '6.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('8', '8', '2', '40.00', '920.00', '0', '36800.00', '1', '6.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('9', '9', '6', '1.00', '900.00', '0', '900.00', '1', '0.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('10', '9', '7', '1.00', '700.00', '0', '700.00', '1', '0.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('11', '10', '9', '1.00', '2300.00', '0', '2300.00', '1', '1.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('12', '11', '2', '2.00', '920.00', '0', '1840.00', '1', '6.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('13', '12', '10', '1.00', '850.00', '0', '850.00', '1', '0.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('14', '13', '11', '1.00', '2800.00', '0', '2800.00', '1', '0.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('15', '14', '12', '2.00', '3150.00', '0', '6300.00', '1', '0.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('16', '15', '2', '2.00', '920.00', '0', '1840.00', '1', '6.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('17', '16', '13', '20.00', '1120.00', '0', '22400.00', '1', '1.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('18', '17', '2', '4.00', '920.00', '0', '3680.00', '1', '6.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('19', '18', '13', '2.00', '0.00', '0', '0.00', '1', '1.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('20', '19', '2', '2.00', '920.00', '0', '1840.00', '1', '6.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('21', '20', '2', '2.00', '920.00', '0', '1840.00', '1', '6.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('22', '21', '2', '10.00', '920.00', '0', '9200.00', '1', '6.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('23', '22', '14', '1.00', '9600.00', '0', '9600.00', '1', '365.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('24', '23', '2', '20.00', '910.00', '0', '18200.00', '1', '6.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('25', '24', '2', '12.00', '920.00', '0', '11040.00', '1', '6.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('28', '26', '2', '10.00', '900.00', '0', '9000.00', '0', '6.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('29', '25', '2', '10.00', '900.00', '0', '9000.00', '0', '6.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('30', '27', '2', '20.00', '900.00', '0', '18000.00', '1', '6.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('31', '28', '15', '1.00', '3800.00', '0', '3800.00', '1', '5.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('32', '29', '2', '1.00', '900.00', '0', '900.00', '1', '6.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('33', '30', '2', '10.00', '900.00', '0', '9000.00', '1', '6.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('34', '31', '16', '1.00', '4400.00', '0', '4400.00', '1', '0.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('35', '32', '17', '1.00', '13600.00', '0', '13600.00', '1', '1.00', '0000-00-00');
INSERT INTO `tec_purchase_items` (`id`, `purchase_id`, `product_id`, `quantity`, `cost`, `foreign_cost`, `subtotal`, `store_id`, `expiry_year`, `expiry_date`) VALUES ('36', '33', '2', '2.00', '900.00', '0', '1800.00', '1', '0.00', '0000-00-00');


#
# TABLE STRUCTURE FOR: tec_purchase_payments
#

DROP TABLE IF EXISTS `tec_purchase_payments`;

CREATE TABLE `tec_purchase_payments` (
  `p_pay_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `purchases_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `transaction_id` varchar(50) DEFAULT NULL,
  `paid_by` varchar(20) NOT NULL,
  `cheque_no` varchar(20) DEFAULT NULL,
  `cc_no` varchar(20) DEFAULT NULL,
  `cc_holder` varchar(25) DEFAULT NULL,
  `cc_month` varchar(2) DEFAULT NULL,
  `cc_year` varchar(4) DEFAULT NULL,
  `cc_type` varchar(20) DEFAULT NULL,
  `amount` decimal(25,2) NOT NULL,
  `currency` varchar(3) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `attachment` varchar(55) DEFAULT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `pos_paid` decimal(25,2) DEFAULT '0.00',
  `pos_balance` decimal(25,2) DEFAULT '0.00',
  `gc_no` varchar(20) DEFAULT NULL,
  `reference` varchar(50) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `store_id` int(11) NOT NULL DEFAULT '1',
  `todayP_Payment` int(11) DEFAULT NULL,
  PRIMARY KEY (`p_pay_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('2', '2020-07-29 18:07:00', '1', '1', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '9500.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '2');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('3', '2020-08-10 14:35:00', '2', '1', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '15000.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '3');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('4', '2020-08-11 12:40:00', '2', '1', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '3500.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '4');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('5', '2020-08-11 19:43:00', '3', '2', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '650.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '5');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('6', '2020-08-20 17:02:00', '4', '3', NULL, 'Cheque', '0391837', NULL, NULL, NULL, NULL, NULL, '28000.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '6');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('7', '2020-08-27 20:25:00', '3', '2', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '70.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '7');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('8', '2020-08-30 19:35:00', '6', '1', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '9200.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '8');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('9', '2020-08-30 19:35:00', '7', '1', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '2760.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '8');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('10', '2020-08-30 19:35:00', '8', '1', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '9040.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '8');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('11', '2020-09-08 14:16:00', '8', '1', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '2760.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '9');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('12', '2020-09-08 14:20:00', '8', '1', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '700.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '10');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('13', '2020-09-12 17:43:00', '16', '7', NULL, 'Cheque', '0391846', NULL, NULL, NULL, NULL, NULL, '22400.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '11');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('14', '2020-09-12 17:45:00', '14', '6', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '6300.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '12');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('15', '2020-09-14 19:25:00', '8', '1', NULL, 'Cheque', '0391847', NULL, NULL, NULL, NULL, NULL, '18000.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '13');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('16', '2020-09-14 19:32:00', '12', '5', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '850.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '14');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('17', '2020-09-19 19:51:00', '8', '1', NULL, 'Cheque', '0391850', NULL, NULL, NULL, NULL, NULL, '6300.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '15');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('18', '2020-09-19 19:51:00', '9', '1', NULL, 'Cheque', '0391850', NULL, NULL, NULL, NULL, NULL, '1600.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '15');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('19', '2020-09-19 19:51:00', '11', '1', NULL, 'Cheque', '0391850', NULL, NULL, NULL, NULL, NULL, '1700.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '15');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('20', '2020-10-12 13:04:00', '11', '1', NULL, 'Cheque', '0391857', NULL, NULL, NULL, NULL, NULL, '140.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '16');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('21', '2020-10-12 13:04:00', '15', '1', NULL, 'Cheque', '0391857', NULL, NULL, NULL, NULL, NULL, '1840.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '16');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('22', '2020-10-12 13:04:00', '17', '1', NULL, 'Cheque', '0391857', NULL, NULL, NULL, NULL, NULL, '3680.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '16');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('23', '2020-10-12 13:04:00', '19', '1', NULL, 'Cheque', '0391857', NULL, NULL, NULL, NULL, NULL, '1840.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '16');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('24', '2020-10-12 13:04:00', '20', '1', NULL, 'Cheque', '0391857', NULL, NULL, NULL, NULL, NULL, '1700.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '16');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('25', '2020-10-12 15:21:00', '20', '1', NULL, 'Cheque', '0391858', NULL, NULL, NULL, NULL, NULL, '140.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '17');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('26', '2020-10-12 15:21:00', '21', '1', NULL, 'Cheque', '0391858', NULL, NULL, NULL, NULL, NULL, '9060.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '17');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('27', '2020-10-13 16:39:00', '10', '4', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '2300.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '18');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('28', '2020-10-13 16:39:00', '13', '4', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '2800.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '18');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('29', '2020-10-15 14:02:00', '21', '1', NULL, 'Cheque', '0391859', NULL, NULL, NULL, NULL, NULL, '140.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '19');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('30', '2020-10-15 14:02:00', '22', '1', NULL, 'Cheque', '0391859', NULL, NULL, NULL, NULL, NULL, '9600.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '19');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('31', '2020-10-15 14:02:00', '23', '1', NULL, 'Cheque', '0391859', NULL, NULL, NULL, NULL, NULL, '8260.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '19');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('32', '2020-10-19 13:02:00', '23', '1', NULL, 'Cheque', '0391849', NULL, NULL, NULL, NULL, NULL, '9940.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '20');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('33', '2020-10-19 13:02:00', '24', '1', NULL, 'Cheque', '0391849', NULL, NULL, NULL, NULL, NULL, '8060.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '20');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('34', '2020-10-21 17:57:00', '28', '8', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '3800.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '21');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('35', '2020-10-22 19:07:00', '24', '1', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '900.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '22');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('36', '2020-11-18 12:35:00', '24', '1', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '2080.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '23');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('37', '2020-11-18 12:35:00', '25', '1', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '7920.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '23');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('38', '2020-12-09 18:19:00', '31', '9', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '4400.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '24');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('39', '2020-12-19 16:34:00', '25', '1', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '1080.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '25');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('40', '2020-12-19 16:34:00', '26', '1', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '9000.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '25');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('41', '2020-12-19 16:34:00', '27', '1', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '3520.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '25');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('42', '2020-12-21 16:44:00', '27', '1', NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, '1800.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '26');
INSERT INTO `tec_purchase_payments` (`p_pay_id`, `date`, `purchases_id`, `supplier_id`, `transaction_id`, `paid_by`, `cheque_no`, `cc_no`, `cc_holder`, `cc_month`, `cc_year`, `cc_type`, `amount`, `currency`, `created_by`, `attachment`, `note`, `pos_paid`, `pos_balance`, `gc_no`, `reference`, `updated_by`, `updated_at`, `store_id`, `todayP_Payment`) VALUES ('43', '2020-12-23 16:56:00', '27', '1', NULL, 'Cheque', '0391865', NULL, NULL, NULL, NULL, NULL, '10000.00', NULL, '34', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, '1', '27');


#
# TABLE STRUCTURE FOR: tec_purchases
#

DROP TABLE IF EXISTS `tec_purchases`;

CREATE TABLE `tec_purchases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(55) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `note` varchar(1000) NOT NULL,
  `total` decimal(25,2) NOT NULL,
  `paid` varchar(255) NOT NULL DEFAULT '0',
  `deu` varchar(255) NOT NULL DEFAULT '0',
  `attachment` varchar(255) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `received` tinyint(1) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `store_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('1', 'INV.# 0823', '2020-07-29 16:23:00', '', '9500.00', '9500', '0', NULL, '1', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('2', 'INV. # 00861', '2020-08-09 17:19:00', '', '18500.00', '18500', '0', NULL, '1', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('3', 'INV.#4280 (09/08/2020)', '2020-08-10 13:55:00', '', '720.00', '720', '0', NULL, '2', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('4', 'INV.# SO-39692', '2020-08-20 16:37:00', '<p>DATE:20/08/2020</p><p>WAV LINK WIRELESS-N300 ROUTER</p><p>20 PCS + 1 PCS</p>', '28000.00', '28000', '0', NULL, '3', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('5', 'INV.# SO-39692', '2020-08-20 16:58:00', '<p>DATE : 20/08/2020</p><p>1 PCS</p>', '0.00', '0', '0', NULL, '3', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('6', 'INV.# 6644', '2020-08-30 11:10:00', '<p>BILL # 6644</p>', '9200.00', '9200', '0', NULL, '1', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('7', 'INV.# 0992 (29/08/20)', '2020-08-30 11:23:00', '<p>DATE: 29/08/2020</p><p>INV.#0992</p>', '2760.00', '2760', '0', NULL, '1', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('8', '8.2 BATTERY-40 pcs', '2020-08-30 16:08:00', '', '36800.00', '36800', '0', NULL, '1', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('9', 'INV.# 1025 (02/09/2020)', '2020-09-03 13:07:00', '<p>DATE: 02/09/2020</p><p>INV.# 20001025</p>', '1600.00', '1600', '0', NULL, '1', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('10', 'INV. # 351', '2020-09-08 19:01:00', '', '2300.00', '2300', '0', NULL, '4', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('11', 'INV.# 001078', '2020-09-10 16:08:00', '', '1840.00', '1840', '0', NULL, '1', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('12', 'INV# 00369', '2020-09-10 20:12:00', '', '850.00', '850', '0', NULL, '5', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('13', 'INV.# 00590', '2020-09-10 20:25:00', '', '2800.00', '2800', '0', NULL, '4', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('14', 'INV. # 004159', '2020-09-12 15:55:00', '', '6300.00', '6300', '0', NULL, '6', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('15', 'INV. 1086', '2020-09-12 16:01:00', '', '1840.00', '1840', '0', NULL, '1', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('16', 'INV.# 001041', '2020-09-12 17:02:00', '', '22400.00', '22400', '0', NULL, '7', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('17', 'INV.# 1088', '2020-09-12 17:19:00', '', '3680.00', '3680', '0', NULL, '1', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('18', 'INV.# 007193', '2020-09-12 17:36:00', '', '0.00', '0', '0', NULL, '7', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('19', 'INV.# 1090', '2020-09-12 18:53:00', '', '1840.00', '1840', '0', NULL, '1', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('20', 'INV. #1091', '2020-09-12 18:58:00', '', '1840.00', '1840', '0', NULL, '1', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('21', 'INV. # 001111', '2020-09-15 16:15:00', '', '9200.00', '9200', '0', NULL, '1', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('22', 'INV.# 001135', '2020-09-19 12:57:00', '<p>DATE: 18/09/2020</p>', '9600.00', '9600', '0', NULL, '1', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('23', 'INV. # A001INV20001169', '2020-09-24 15:52:00', '<p>DATE: 24/09/2020</p><p>INV. # A001INV20001169</p>', '18200.00', '18200', '0', NULL, '1', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('24', 'INV. # A001INV20001171', '2020-09-26 11:54:00', '<p>DATE: 26/09/2020</p>', '11040.00', '11040', '0', NULL, '1', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('25', 'INV. # 20001264', '2020-10-12 12:58:00', '<p>DATE: 12/10/20250</p><p>INV.# 20001264</p>', '9000.00', '9000', '0', NULL, '1', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('26', 'INV. # 20001267', '2020-10-12 14:58:00', '<p>DATE: 12/10/2020</p><p>INV.# 20001267</p>', '9000.00', '9000', '0', NULL, '1', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('27', 'INV.# 20001283', '2020-10-15 13:43:00', '<p>DATE: 15/10/2020</p><p>INV.# 20001283</p>', '18000.00', '15320', '2680', NULL, '1', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('28', 'A006INV20005257', '2020-10-21 17:23:00', '<p>DATE: 21/10/2020</p>', '3800.00', '3800', '0', NULL, '8', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('29', 'INV.# 20001337', '2020-10-22 18:50:00', '<p>DATE: 22/10/2020</p><p>INV# 20001337</p>', '900.00', '0', '900', NULL, '1', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('30', 'INV.# 20001443', '2020-11-18 11:19:00', '<p>DATE: 18/11/2020</p><p>INV.# 20001443</p>', '9000.00', '0', '9000', NULL, '1', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('31', 'ARI-1752/20', '2020-12-09 15:32:00', '<p>S/L NO: 2020-04-30H3A</p>', '4400.00', '4400', '0', NULL, '9', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('32', 'INV.# A001INV20001572', '2020-12-19 16:22:00', '<p>DATE: 19/12/2020</p><p>INV.#A001INV20001572</p>', '13600.00', '0', '13600', NULL, '1', '1', '34', '1');
INSERT INTO `tec_purchases` (`id`, `reference`, `date`, `note`, `total`, `paid`, `deu`, `attachment`, `supplier_id`, `received`, `created_by`, `store_id`) VALUES ('33', 'INV.# A001INV20001586', '2020-12-21 16:29:00', '<p>INV.# A001INV20001586<br></p>', '1800.00', '0', '1800', NULL, '1', '1', '34', '1');


#
# TABLE STRUCTURE FOR: tec_quotation
#

DROP TABLE IF EXISTS `tec_quotation`;

CREATE TABLE `tec_quotation` (
  `quotation_id` int(11) NOT NULL AUTO_INCREMENT,
  `quotation_title` varchar(255) NOT NULL,
  `quotation_date` datetime NOT NULL,
  `quotation_details` text NOT NULL,
  `quotation_mail` varchar(255) NOT NULL,
  PRIMARY KEY (`quotation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: tec_registers
#

DROP TABLE IF EXISTS `tec_registers`;

CREATE TABLE `tec_registers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `cash_in_hand` decimal(25,2) NOT NULL,
  `status` varchar(10) NOT NULL,
  `total_cash` decimal(25,2) DEFAULT NULL,
  `total_cheques` int(11) DEFAULT NULL,
  `total_cc_slips` int(11) DEFAULT NULL,
  `total_cash_submitted` decimal(25,2) NOT NULL,
  `total_cheques_submitted` int(11) NOT NULL,
  `total_cc_slips_submitted` int(11) NOT NULL,
  `note` text,
  `closed_at` timestamp NULL DEFAULT NULL,
  `transfer_opened_bills` varchar(50) DEFAULT NULL,
  `closed_by` int(11) DEFAULT NULL,
  `store_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `tec_registers` (`id`, `date`, `user_id`, `cash_in_hand`, `status`, `total_cash`, `total_cheques`, `total_cc_slips`, `total_cash_submitted`, `total_cheques_submitted`, `total_cc_slips_submitted`, `note`, `closed_at`, `transfer_opened_bills`, `closed_by`, `store_id`) VALUES ('1', '2020-01-07 14:43:19', '1', '0.00', 'open', NULL, NULL, NULL, '0.00', '0', '0', NULL, NULL, NULL, NULL, '0');
INSERT INTO `tec_registers` (`id`, `date`, `user_id`, `cash_in_hand`, `status`, `total_cash`, `total_cheques`, `total_cc_slips`, `total_cash_submitted`, `total_cheques_submitted`, `total_cc_slips_submitted`, `note`, `closed_at`, `transfer_opened_bills`, `closed_by`, `store_id`) VALUES ('2', '2020-07-29 17:39:57', '34', '0.00', 'open', NULL, NULL, NULL, '0.00', '0', '0', NULL, NULL, NULL, NULL, '1');
INSERT INTO `tec_registers` (`id`, `date`, `user_id`, `cash_in_hand`, `status`, `total_cash`, `total_cheques`, `total_cc_slips`, `total_cash_submitted`, `total_cheques_submitted`, `total_cc_slips_submitted`, `note`, `closed_at`, `transfer_opened_bills`, `closed_by`, `store_id`) VALUES ('3', '2020-07-29 21:00:51', '27', '0.00', 'open', NULL, NULL, NULL, '0.00', '0', '0', NULL, NULL, NULL, NULL, '0');


#
# TABLE STRUCTURE FOR: tec_sale_items
#

DROP TABLE IF EXISTS `tec_sale_items`;

CREATE TABLE `tec_sale_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` decimal(15,2) NOT NULL,
  `unit_price` decimal(25,2) NOT NULL,
  `net_unit_price` decimal(25,2) NOT NULL,
  `discount` varchar(20) DEFAULT NULL,
  `item_discount` decimal(25,2) DEFAULT NULL,
  `tax` int(20) DEFAULT NULL,
  `item_tax` decimal(25,2) DEFAULT NULL,
  `subtotal` decimal(25,2) NOT NULL,
  `real_unit_price` decimal(25,2) DEFAULT NULL,
  `cost` decimal(25,2) DEFAULT '0.00',
  `store_id` int(11) NOT NULL,
  `warranty_year` varchar(255) DEFAULT NULL,
  `warranty_date` date NOT NULL,
  `return_item_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('1', '1', '1', '10.00', '1000.00', '1000.00', '0', '0.00', '0', '0.00', '10000.00', '1000.00', '950.00', '1', '6 MONTHS WARRANTY', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('3', '2', '3', '20.00', '1000.00', '1000.00', '0', '0.00', '0', '0.00', '20000.00', '1000.00', '925.00', '0', '6 MONTHS WARRANTY', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('4', '3', '5', '10.00', '1400.00', '1400.00', '0', '0.00', '0', '0.00', '14000.00', '1400.00', '1400.00', '1', '', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('5', '4', '2', '10.00', '950.00', '950.00', '0', '0.00', '0', '0.00', '9500.00', '950.00', '920.00', '1', '', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('6', '5', '2', '3.00', '1000.00', '1000.00', '0', '0.00', '0', '0.00', '3000.00', '1000.00', '920.00', '1', '6 MONTHS WARRANTY', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('8', '6', '2', '40.00', '975.00', '975.00', '0', '0.00', '0', '0.00', '39000.00', '975.00', '920.00', '0', '6 MONTHS WARRANTY', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('9', '7', '6', '1.00', '1100.00', '1100.00', '0', '0.00', '0', '0.00', '1100.00', '1100.00', '900.00', '1', '', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('12', '10', '9', '1.00', '2350.00', '2350.00', '0', '0.00', '0', '0.00', '2350.00', '2350.00', '2300.00', '1', '1 YEAR WARRANTY', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('13', '11', '7', '1.00', '0.00', '0.00', '0', '0.00', '0', '0.00', '0.00', '0.00', '700.00', '1', '', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('14', '12', '2', '2.00', '950.00', '950.00', '0', '0.00', '0', '0.00', '1900.00', '950.00', '920.00', '1', '6 MONTHS WARRANTY', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('15', '13', '10', '1.00', '850.00', '850.00', '0', '0.00', '0', '0.00', '850.00', '850.00', '850.00', '1', '', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('16', '14', '11', '1.00', '2800.00', '2800.00', '0', '0.00', '0', '0.00', '2800.00', '2800.00', '2800.00', '1', '', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('17', '15', '2', '2.00', '1000.00', '1000.00', '0', '0.00', '0', '0.00', '2000.00', '1000.00', '920.00', '1', '6 MONTHS WARRANTY', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('18', '16', '5', '10.00', '1400.00', '1400.00', '0', '0.00', '0', '0.00', '14000.00', '1400.00', '1272.73', '1', '1 YEAR WARRANTY', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('19', '17', '2', '4.00', '1000.00', '1000.00', '0', '0.00', '0', '0.00', '4000.00', '1000.00', '920.00', '1', '6 MONTHS WARRANTY', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('20', '18', '13', '10.00', '1120.00', '1120.00', '0', '0.00', '0', '0.00', '11200.00', '1120.00', '1018.18', '1', '', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('21', '19', '12', '2.00', '3200.00', '3200.00', '0', '0.00', '0', '0.00', '6400.00', '3200.00', '3150.00', '1', '', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('22', '20', '2', '4.00', '1000.00', '1000.00', '0', '0.00', '0', '0.00', '4000.00', '1000.00', '920.00', '1', '6 MONTHS WARRANTY', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('23', '21', '2', '8.00', '1000.00', '1000.00', '0', '0.00', '0', '0.00', '8000.00', '1000.00', '920.00', '1', '6 MONTHS WARRANTY', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('24', '22', '14', '1.00', '9600.00', '9600.00', '0', '0.00', '0', '0.00', '9600.00', '9600.00', '9600.00', '1', '365 DAYS', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('25', '23', '2', '8.00', '1000.00', '1000.00', '0', '0.00', '0', '0.00', '8000.00', '1000.00', '910.91', '1', '6 MONTHS WARRANTY', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('26', '24', '2', '5.00', '950.00', '950.00', '0', '0.00', '0', '0.00', '4750.00', '950.00', '910.91', '1', '6 MONTHS WARRANTY', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('27', '25', '2', '20.00', '950.00', '950.00', '0', '0.00', '0', '0.00', '19000.00', '950.00', '916.10', '1', '6 MONTHS WARRANTY', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('28', '26', '2', '10.00', '935.00', '935.00', '0', '0.00', '0', '0.00', '9350.00', '935.00', '919.65', '1', '6 MONTHS WARRANTY', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('29', '27', '2', '10.00', '950.00', '950.00', '0', '0.00', '0', '0.00', '9500.00', '950.00', '919.97', '1', '6 MONTHS WARRANTY', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('30', '28', '2', '20.00', '935.00', '935.00', '0', '0.00', '0', '0.00', '18700.00', '935.00', '900.00', '1', '', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('31', '29', '15', '1.00', '3800.00', '3800.00', '0', '0.00', '0', '0.00', '3800.00', '3800.00', '3800.00', '1', '5 YEARS', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('32', '30', '2', '2.00', '950.00', '950.00', '0', '0.00', '0', '0.00', '1900.00', '950.00', '900.00', '1', '6 MONTHS WARRANTY', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('33', '31', '13', '1.00', '1200.00', '1200.00', '0', '0.00', '0', '0.00', '1200.00', '1200.00', '1018.18', '1', '', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('34', '32', '2', '10.00', '935.00', '935.00', '0', '0.00', '0', '0.00', '9350.00', '935.00', '900.00', '1', '6 MONTHS WARRANTY', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('35', '33', '16', '1.00', '4400.00', '4400.00', '0', '0.00', '0', '0.00', '4400.00', '4400.00', '4400.00', '1', '', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('36', '34', '17', '1.00', '14600.00', '14600.00', '0', '0.00', '0', '0.00', '14600.00', '14600.00', '13600.00', '1', '1 YEAR WARRANTY', '0000-00-00', NULL);
INSERT INTO `tec_sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('37', '35', '2', '2.00', '950.00', '950.00', '0', '0.00', '0', '0.00', '1900.00', '950.00', '900.00', '1', '6 MONTHS WARRANTY', '0000-00-00', NULL);


#
# TABLE STRUCTURE FOR: tec_sale_items_log
#

DROP TABLE IF EXISTS `tec_sale_items_log`;

CREATE TABLE `tec_sale_items_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `sale_log_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` decimal(15,2) NOT NULL,
  `unit_price` decimal(25,2) NOT NULL,
  `net_unit_price` decimal(25,2) NOT NULL,
  `discount` varchar(20) DEFAULT NULL,
  `item_discount` decimal(25,2) DEFAULT NULL,
  `tax` int(20) DEFAULT NULL,
  `item_tax` decimal(25,2) DEFAULT NULL,
  `subtotal` decimal(25,2) NOT NULL,
  `real_unit_price` decimal(25,2) DEFAULT NULL,
  `cost` decimal(25,2) DEFAULT '0.00',
  `store_id` int(11) NOT NULL,
  `warranty_year` varchar(255) NOT NULL,
  `warranty_date` date DEFAULT NULL,
  `return_item_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('1', '1', '1', '1', '10.00', '1000.00', '1000.00', '0', '0.00', '0', '0.00', '10000.00', '1000.00', '950.00', '1', '6 MONTHS WARRANTY', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('2', '2', '2', '3', '20.00', '1000.00', '1000.00', '0', '0.00', '0', '0.00', '20000.00', '1000.00', '925.00', '1', '', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('3', '2', '0', '3', '20.00', '1000.00', '1000.00', '0', '0.00', '0', '0.00', '20000.00', '1000.00', '925.00', '0', '6 MONTHS WARRANTY', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('4', '3', '3', '5', '10.00', '1400.00', '1400.00', '0', '0.00', '0', '0.00', '14000.00', '1400.00', '1400.00', '1', '', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('5', '4', '4', '2', '10.00', '950.00', '950.00', '0', '0.00', '0', '0.00', '9500.00', '950.00', '920.00', '1', '', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('6', '5', '5', '2', '3.00', '1000.00', '1000.00', '0', '0.00', '0', '0.00', '3000.00', '1000.00', '920.00', '1', '6 MONTHS WARRANTY', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('7', '6', '6', '2', '40.00', '920.00', '920.00', '0', '0.00', '0', '0.00', '36800.00', '920.00', '920.00', '1', '6 MONTHS WARRANTY', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('8', '6', '0', '2', '40.00', '975.00', '975.00', '0', '0.00', '0', '0.00', '39000.00', '975.00', '920.00', '0', '6 MONTHS WARRANTY', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('9', '7', '7', '6', '1.00', '1100.00', '1100.00', '0', '0.00', '0', '0.00', '1100.00', '1100.00', '900.00', '1', '', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('10', '8', '8', '9', '1.00', '2350.00', '2350.00', '0', '0.00', '0', '0.00', '2350.00', '2350.00', '2300.00', '1', '1 YEAR WARRANTY', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('11', '9', '9', '9', '1.00', '2350.00', '2350.00', '0', '0.00', '0', '0.00', '2350.00', '2350.00', '2300.00', '1', '1 YEAR WARRANTY', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('12', '10', '10', '9', '1.00', '2350.00', '2350.00', '0', '0.00', '0', '0.00', '2350.00', '2350.00', '2300.00', '1', '1 YEAR WARRANTY', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('13', '11', '11', '7', '1.00', '0.00', '0.00', '0', '0.00', '0', '0.00', '0.00', '0.00', '700.00', '1', '', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('14', '12', '12', '2', '2.00', '950.00', '950.00', '0', '0.00', '0', '0.00', '1900.00', '950.00', '920.00', '1', '6 MONTHS WARRANTY', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('15', '13', '13', '10', '1.00', '850.00', '850.00', '0', '0.00', '0', '0.00', '850.00', '850.00', '850.00', '1', '', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('16', '14', '14', '11', '1.00', '2800.00', '2800.00', '0', '0.00', '0', '0.00', '2800.00', '2800.00', '2800.00', '1', '', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('17', '15', '15', '2', '2.00', '1000.00', '1000.00', '0', '0.00', '0', '0.00', '2000.00', '1000.00', '920.00', '1', '6 MONTHS WARRANTY', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('18', '16', '16', '5', '10.00', '1400.00', '1400.00', '0', '0.00', '0', '0.00', '14000.00', '1400.00', '1272.73', '1', '1 YEAR WARRANTY', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('19', '17', '17', '2', '4.00', '1000.00', '1000.00', '0', '0.00', '0', '0.00', '4000.00', '1000.00', '920.00', '1', '6 MONTHS WARRANTY', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('20', '18', '18', '13', '10.00', '1120.00', '1120.00', '0', '0.00', '0', '0.00', '11200.00', '1120.00', '1018.18', '1', '', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('21', '19', '19', '12', '2.00', '3200.00', '3200.00', '0', '0.00', '0', '0.00', '6400.00', '3200.00', '3150.00', '1', '', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('22', '20', '20', '2', '4.00', '1000.00', '1000.00', '0', '0.00', '0', '0.00', '4000.00', '1000.00', '920.00', '1', '6 MONTHS WARRANTY', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('23', '21', '21', '2', '8.00', '1000.00', '1000.00', '0', '0.00', '0', '0.00', '8000.00', '1000.00', '920.00', '1', '6 MONTHS WARRANTY', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('24', '22', '22', '14', '1.00', '9600.00', '9600.00', '0', '0.00', '0', '0.00', '9600.00', '9600.00', '9600.00', '1', '365 DAYS', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('25', '23', '23', '2', '8.00', '1000.00', '1000.00', '0', '0.00', '0', '0.00', '8000.00', '1000.00', '910.91', '1', '6 MONTHS WARRANTY', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('26', '24', '24', '2', '5.00', '950.00', '950.00', '0', '0.00', '0', '0.00', '4750.00', '950.00', '910.91', '1', '6 MONTHS WARRANTY', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('27', '25', '25', '2', '20.00', '950.00', '950.00', '0', '0.00', '0', '0.00', '19000.00', '950.00', '916.10', '1', '6 MONTHS WARRANTY', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('28', '26', '26', '2', '10.00', '935.00', '935.00', '0', '0.00', '0', '0.00', '9350.00', '935.00', '919.65', '1', '6 MONTHS WARRANTY', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('29', '27', '27', '2', '10.00', '950.00', '950.00', '0', '0.00', '0', '0.00', '9500.00', '950.00', '919.97', '1', '6 MONTHS WARRANTY', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('30', '28', '28', '2', '20.00', '935.00', '935.00', '0', '0.00', '0', '0.00', '18700.00', '935.00', '900.00', '1', '', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('31', '29', '29', '15', '1.00', '3800.00', '3800.00', '0', '0.00', '0', '0.00', '3800.00', '3800.00', '3800.00', '1', '5 YEARS', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('32', '30', '30', '2', '2.00', '950.00', '950.00', '0', '0.00', '0', '0.00', '1900.00', '950.00', '900.00', '1', '6 MONTHS WARRANTY', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('33', '31', '31', '13', '1.00', '1200.00', '1200.00', '0', '0.00', '0', '0.00', '1200.00', '1200.00', '1018.18', '1', '', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('34', '32', '32', '2', '10.00', '935.00', '935.00', '0', '0.00', '0', '0.00', '9350.00', '935.00', '900.00', '1', '6 MONTHS WARRANTY', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('35', '33', '33', '16', '1.00', '4400.00', '4400.00', '0', '0.00', '0', '0.00', '4400.00', '4400.00', '4400.00', '1', '', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('36', '34', '34', '17', '1.00', '14600.00', '14600.00', '0', '0.00', '0', '0.00', '14600.00', '14600.00', '13600.00', '1', '1 YEAR WARRANTY', NULL, NULL);
INSERT INTO `tec_sale_items_log` (`id`, `sale_id`, `sale_log_id`, `product_id`, `quantity`, `unit_price`, `net_unit_price`, `discount`, `item_discount`, `tax`, `item_tax`, `subtotal`, `real_unit_price`, `cost`, `store_id`, `warranty_year`, `warranty_date`, `return_item_id`) VALUES ('37', '35', '35', '2', '2.00', '950.00', '950.00', '0', '0.00', '0', '0.00', '1900.00', '950.00', '900.00', '1', '6 MONTHS WARRANTY', NULL, NULL);


#
# TABLE STRUCTURE FOR: tec_sales
#

DROP TABLE IF EXISTS `tec_sales`;

CREATE TABLE `tec_sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(55) NOT NULL,
  `total` decimal(25,2) NOT NULL,
  `product_discount` decimal(25,2) DEFAULT NULL,
  `order_discount_id` varchar(20) DEFAULT NULL,
  `order_discount` decimal(25,2) DEFAULT NULL,
  `total_discount` decimal(25,2) DEFAULT NULL,
  `product_tax` decimal(25,2) DEFAULT NULL,
  `order_tax_id` varchar(20) DEFAULT NULL,
  `order_tax` decimal(25,2) DEFAULT NULL,
  `total_tax` decimal(25,2) DEFAULT NULL,
  `grand_total` decimal(25,2) NOT NULL,
  `total_items` int(11) DEFAULT NULL,
  `total_quantity` decimal(15,2) DEFAULT NULL,
  `paid` decimal(25,2) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `rounding` decimal(8,2) DEFAULT NULL,
  `store_id` int(11) NOT NULL DEFAULT '1',
  `sales_type` varchar(20) NOT NULL DEFAULT 'sale',
  `service_id` int(11) DEFAULT NULL,
  `warranty` varchar(35) NOT NULL DEFAULT 'Not',
  `paid_by` varchar(255) NOT NULL,
  `return_id` int(11) DEFAULT NULL,
  `invno` int(11) DEFAULT NULL,
  `collection_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('1', '2020-07-29 17:41:16', '3', 'AK COMPUTER SYSTEM', '10000.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '10000.00', '1', '10.00', '10000.00', '34', NULL, NULL, '', 'paid', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '0');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('2', '2020-08-09 17:26:57', '3', 'AK COMPUTER SYSTEM', '20000.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '20000.00', '1', '20.00', '20000.00', '27', '27', '2020-08-09 17:36:24', '', 'paid', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '0');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('3', '2020-08-20 16:56:27', '4', 'THE ELECTRO HOUSE', '14000.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '14000.00', '1', '10.00', '6370.00', '34', NULL, NULL, 'DATE&colon; 20&sol;08&sol;2020\r&NewLine;', 'partial', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '0');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('4', '2020-08-30 11:20:37', '5', 'TECH DEAL', '9500.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '9500.00', '1', '10.00', '9500.00', '34', NULL, NULL, '', 'paid', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '0');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('5', '2020-08-30 11:33:10', '3', 'AK COMPUTER SYSTEM', '3000.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '3000.00', '1', '3.00', '3000.00', '34', NULL, NULL, 'DATE&colon; 29&sol;08&sol;2020', 'paid', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '0');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('6', '2020-08-30 16:20:38', '3', 'AK COMPUTER SYSTEM', '39000.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '39000.00', '1', '40.00', '39000.00', '27', '27', '2020-08-30 19:18:02', '', 'paid', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '0');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('7', '2020-09-03 13:11:29', '5', 'TECH DEAL', '1100.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '1100.00', '1', '1.00', '1100.00', '34', NULL, NULL, 'DATE 02&sol;09&sol;2020', 'paid', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '0');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('10', '2020-09-08 19:02:57', '5', 'TECH DEAL', '2350.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '2350.00', '1', '1.00', '2350.00', '34', NULL, NULL, '', 'paid', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '0');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('11', '2020-09-08 19:43:04', '6', 'CREATIVE COMUTERS & COMMUNICATIONS', '0.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '0.00', '1', '1.00', '0.00', '34', NULL, NULL, '', 'paid', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '0');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('12', '2020-09-10 16:13:22', '5', 'TECH DEAL', '1900.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '1900.00', '1', '2.00', '1900.00', '34', NULL, NULL, '', 'paid', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '0');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('13', '2020-09-10 20:17:48', '7', 'CCT OFFICE', '850.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '850.00', '1', '1.00', '0.00', '34', NULL, NULL, '', 'due', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '0');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('14', '2020-09-10 20:27:43', '7', 'CCT OFFICE', '2800.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '2800.00', '1', '1.00', '0.00', '34', NULL, NULL, '', 'due', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '0');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('15', '2020-09-12 16:31:15', '9', 'TELEWAVE', '2000.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '2000.00', '1', '2.00', '2000.00', '34', NULL, NULL, '', 'paid', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '0');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('16', '2020-09-12 17:26:09', '8', 'COMPUTER WORLD (PABNA)', '14000.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '14000.00', '1', '10.00', '14000.00', '34', NULL, NULL, '', 'paid', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '0');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('17', '2020-09-12 17:34:53', '5', 'TECH DEAL', '4000.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '4000.00', '1', '4.00', '4000.00', '34', NULL, NULL, '', 'paid', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '0');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('18', '2020-09-12 17:52:53', '4', 'THE ELECTRO HOUSE', '11200.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '11200.00', '1', '10.00', '0.00', '34', NULL, NULL, '', 'due', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '0');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('19', '2020-09-12 17:56:20', '8', 'COMPUTER WORLD (PABNA)', '6400.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '6400.00', '1', '2.00', '6400.00', '34', NULL, NULL, '', 'paid', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '0');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('20', '2020-09-12 19:00:57', '5', 'TECH DEAL', '4000.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '4000.00', '1', '4.00', '4000.00', '34', NULL, NULL, '', 'paid', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '0');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('21', '2020-09-15 16:27:38', '5', 'TECH DEAL', '8000.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '8000.00', '1', '8.00', '8000.00', '34', NULL, NULL, '', 'paid', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '0');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('22', '2020-09-19 13:08:18', '4', 'THE ELECTRO HOUSE', '9600.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '9600.00', '1', '1.00', '0.00', '34', NULL, NULL, 'DATE&colon; 18&sol;09&sol;2020', 'due', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '0');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('23', '2020-09-24 16:05:12', '5', 'TECH DEAL', '8000.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '8000.00', '1', '8.00', '8000.00', '34', NULL, NULL, '', 'paid', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '0');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('24', '2020-09-24 16:13:35', '10', 'COMPUTER VISION (KHULNA)', '4750.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '4750.00', '1', '5.00', '4750.00', '34', NULL, NULL, '', 'paid', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '0');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('25', '2020-09-26 12:25:37', '12', 'ANAS COMPUTER (RANGPUR)', '19000.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '19000.00', '1', '20.00', '19000.00', '34', NULL, NULL, 'DATE&colon; 26&sol;09&sol;2020', 'paid', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '0');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('26', '2020-10-12 14:31:50', '14', 'THREE STAR TRADING CO.', '9350.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '9350.00', '1', '10.00', '9350.00', '34', NULL, NULL, '', 'paid', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '0');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('27', '2020-10-12 15:03:45', '13', 'RUBY COMPUTER (SAIDPUR)', '9500.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '9500.00', '1', '10.00', '9500.00', '34', NULL, NULL, '', 'paid', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '0');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('28', '2020-10-15 13:55:01', '14', 'THREE STAR TRADING CO.', '18700.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '18700.00', '1', '20.00', '18700.00', '34', NULL, NULL, 'CASH ', 'paid', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '22');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('29', '2020-10-21 17:27:15', '11', 'COMPUTER SQUADRON', '3800.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '3800.00', '1', '1.00', '3550.00', '34', NULL, NULL, '', 'partial', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '0');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('30', '2020-10-22 19:14:19', '15', 'TRIVA IT LIMITED', '1900.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '1900.00', '1', '2.00', '1900.00', '34', NULL, NULL, '', 'paid', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '24');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('31', '2020-10-29 17:00:51', '11', 'COMPUTER SQUADRON', '1200.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '1200.00', '1', '1.00', '0.00', '34', NULL, NULL, '', 'due', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '0');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('32', '2020-11-18 11:24:32', '3', 'AK COMPUTER SYSTEM', '9350.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '9350.00', '1', '10.00', '9350.00', '34', NULL, NULL, '', 'paid', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '25');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('33', '2020-12-09 15:34:37', '11', 'COMPUTER SQUADRON', '4400.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '4400.00', '1', '1.00', '0.00', '34', NULL, NULL, '', 'due', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '0');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('34', '2020-12-19 16:30:50', '5', 'TECH DEAL', '14600.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '14600.00', '1', '1.00', '14600.00', '34', NULL, NULL, '', 'paid', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '27');
INSERT INTO `tec_sales` (`id`, `date`, `customer_id`, `customer_name`, `total`, `product_discount`, `order_discount_id`, `order_discount`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `grand_total`, `total_items`, `total_quantity`, `paid`, `created_by`, `updated_by`, `updated_at`, `note`, `status`, `rounding`, `store_id`, `sales_type`, `service_id`, `warranty`, `paid_by`, `return_id`, `invno`, `collection_id`) VALUES ('35', '2020-12-21 16:39:07', '15', 'TRIVA IT LIMITED', '1900.00', '0.00', NULL, '0.00', '0.00', '0.00', NULL, '0.00', '0.00', '1900.00', '1', '2.00', '1900.00', '34', NULL, NULL, '', 'paid', '0.00', '1', 'sale', NULL, 'Not', 'cash', NULL, NULL, '28');


#
# TABLE STRUCTURE FOR: tec_sales_log
#

DROP TABLE IF EXISTS `tec_sales_log`;

CREATE TABLE `tec_sales_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(55) NOT NULL,
  `total` decimal(25,2) NOT NULL,
  `product_discount` decimal(25,2) DEFAULT NULL,
  `order_discount_id` varchar(20) DEFAULT NULL,
  `order_discount` decimal(25,2) DEFAULT NULL,
  `total_discount` decimal(25,2) DEFAULT NULL,
  `product_tax` decimal(25,2) DEFAULT NULL,
  `order_tax_id` varchar(20) DEFAULT NULL,
  `order_tax` decimal(25,2) DEFAULT NULL,
  `total_tax` decimal(25,2) DEFAULT NULL,
  `grand_total` decimal(25,2) NOT NULL,
  `total_items` int(11) DEFAULT NULL,
  `total_quantity` decimal(15,2) DEFAULT NULL,
  `paid` decimal(25,2) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `rounding` decimal(8,2) DEFAULT NULL,
  `store_id` int(11) NOT NULL DEFAULT '1',
  `sales_type` varchar(20) NOT NULL DEFAULT 'sale',
  `type` varchar(20) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `warranty` varchar(35) NOT NULL DEFAULT 'Not',
  `paid_by` varchar(255) NOT NULL,
  `expenses_id` int(11) DEFAULT NULL,
  `return_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: tec_salesreturn
#

DROP TABLE IF EXISTS `tec_salesreturn`;

CREATE TABLE `tec_salesreturn` (
  `sreturn_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_submit` datetime NOT NULL,
  `sale_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `total` varchar(20) DEFAULT NULL,
  `paid` varchar(20) DEFAULT NULL,
  `total_items` int(11) DEFAULT NULL,
  `total_quantity` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `status` varchar(100) DEFAULT 'returned',
  `updated_at` datetime DEFAULT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`sreturn_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: tec_service
#

DROP TABLE IF EXISTS `tec_service`;

CREATE TABLE `tec_service` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_submit` datetime NOT NULL,
  `sale_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `total` varchar(20) DEFAULT NULL,
  `paid` varchar(20) DEFAULT NULL,
  `total_items` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `store_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: tec_service_parts
#

DROP TABLE IF EXISTS `tec_service_parts`;

CREATE TABLE `tec_service_parts` (
  `parts_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `parts_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_cost` varchar(25) NOT NULL,
  `subtotal` varchar(25) NOT NULL,
  PRIMARY KEY (`parts_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: tec_service_promlem
#

DROP TABLE IF EXISTS `tec_service_promlem`;

CREATE TABLE `tec_service_promlem` (
  `problem_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `item_id` varchar(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `problem` text NOT NULL,
  `suspect` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`problem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: tec_sessions
#

DROP TABLE IF EXISTS `tec_sessions`;

CREATE TABLE `tec_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tec_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('03c315b385695d4982422bff97a83f0e41e7ebff', '35.223.145.37', '1608466943', '__ci_last_regenerate|i:1608466943;');
INSERT INTO `tec_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('0998658d583c21ea46ad13b7e0170c17d0c6c02d', '103.239.252.209', '1608547306', '__ci_last_regenerate|i:1608547025;identity|s:24:\"cctbangladesh@cct.com.bd\";username|s:13:\"cctbangladesh\";email|s:24:\"cctbangladesh@cct.com.bd\";user_id|s:2:\"34\";first_name|s:13:\"CREATIVE CITY\";last_name|s:12:\"TECHNOLOGIES\";created_on|s:24:\"Wed 29 Jan 2020 06:45 PM\";old_last_login|s:10:\"1608461167\";last_ip|s:15:\"103.239.252.209\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"2\";store_id|s:1:\"1\";register_id|s:1:\"2\";cash_in_hand|s:4:\"0.00\";register_open_time|s:19:\"2020-07-29 17:39:57\";');
INSERT INTO `tec_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('0f9cf6f100bf8f44c416b087274a0226a55c01f1', '103.239.252.209', '1608555195', '__ci_last_regenerate|i:1608555195;');
INSERT INTO `tec_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('1a1ff2b516ed680687d9cf4eb33c029585689820', '35.223.145.37', '1608475582', '__ci_last_regenerate|i:1608475582;');
INSERT INTO `tec_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('2ea05e1323722ea6da991ea2b04c170056e9723f', '103.239.252.209', '1608461345', '__ci_last_regenerate|i:1608461345;');
INSERT INTO `tec_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('34775d93bee404a6c58010b9eeea9ceb353e19c9', '103.239.252.209', '1608565971', '__ci_last_regenerate|i:1608565971;');
INSERT INTO `tec_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('37559625a31cfd0e209860eb7139550fc77ba984', '209.17.96.138', '1608655692', '__ci_last_regenerate|i:1608655692;');
INSERT INTO `tec_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('3b552ad6bf36b934d459365797ac6e3c8c37c209', '138.246.253.24', '1608390853', '__ci_last_regenerate|i:1608390853;');
INSERT INTO `tec_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('4adb81759d1ed1066b5b55c8cd10036b7d7f6d0a', '103.239.252.209', '1608546814', '__ci_last_regenerate|i:1608546689;identity|s:24:\"cctbangladesh@cct.com.bd\";username|s:13:\"cctbangladesh\";email|s:24:\"cctbangladesh@cct.com.bd\";user_id|s:2:\"34\";first_name|s:13:\"CREATIVE CITY\";last_name|s:12:\"TECHNOLOGIES\";created_on|s:24:\"Wed 29 Jan 2020 06:45 PM\";old_last_login|s:10:\"1608461167\";last_ip|s:15:\"103.239.252.209\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"2\";store_id|s:1:\"1\";register_id|s:1:\"2\";cash_in_hand|s:4:\"0.00\";register_open_time|s:19:\"2020-07-29 17:39:57\";');
INSERT INTO `tec_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('5ecfdfb9530778368e9dfc217412e06a7f22f6b0', '103.239.252.209', '1608628411', '__ci_last_regenerate|i:1608628411;');
INSERT INTO `tec_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('63a05441769b9950ffcea11b07e3a418217b9e53', '209.17.96.82', '1608633710', '__ci_last_regenerate|i:1608633710;');
INSERT INTO `tec_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('6664c3a941533bc4201b0d005ced0f5cf93739b6', '103.239.252.209', '1608721052', '__ci_last_regenerate|i:1608720752;identity|s:24:\"cctbangladesh@cct.com.bd\";username|s:13:\"cctbangladesh\";email|s:24:\"cctbangladesh@cct.com.bd\";user_id|s:2:\"34\";first_name|s:13:\"CREATIVE CITY\";last_name|s:12:\"TECHNOLOGIES\";created_on|s:24:\"Wed 29 Jan 2020 06:45 PM\";old_last_login|s:10:\"1608628343\";last_ip|s:15:\"103.239.252.209\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"2\";store_id|s:1:\"1\";register_id|s:1:\"2\";cash_in_hand|s:4:\"0.00\";register_open_time|s:19:\"2020-07-29 17:39:57\";');
INSERT INTO `tec_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('6c993dff2f649fe32c69d5a5286c54f951d135bc', '103.239.252.209', '1608547536', '__ci_last_regenerate|i:1608547378;identity|s:24:\"cctbangladesh@cct.com.bd\";username|s:13:\"cctbangladesh\";email|s:24:\"cctbangladesh@cct.com.bd\";user_id|s:2:\"34\";first_name|s:13:\"CREATIVE CITY\";last_name|s:12:\"TECHNOLOGIES\";created_on|s:24:\"Wed 29 Jan 2020 06:45 PM\";old_last_login|s:10:\"1608461167\";last_ip|s:15:\"103.239.252.209\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"2\";store_id|s:1:\"1\";register_id|s:1:\"2\";cash_in_hand|s:4:\"0.00\";register_open_time|s:19:\"2020-07-29 17:39:57\";');
INSERT INTO `tec_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('6dd348b09b0edeec41597a7108d9585f8f81ddd1', '103.239.252.209', '1608546631', '__ci_last_regenerate|i:1608546351;identity|s:24:\"cctbangladesh@cct.com.bd\";username|s:13:\"cctbangladesh\";email|s:24:\"cctbangladesh@cct.com.bd\";user_id|s:2:\"34\";first_name|s:13:\"CREATIVE CITY\";last_name|s:12:\"TECHNOLOGIES\";created_on|s:24:\"Wed 29 Jan 2020 06:45 PM\";old_last_login|s:10:\"1608461167\";last_ip|s:15:\"103.239.252.209\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"2\";store_id|s:1:\"1\";register_id|s:1:\"2\";cash_in_hand|s:4:\"0.00\";register_open_time|s:19:\"2020-07-29 17:39:57\";');
INSERT INTO `tec_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('7a8d468057161bba18ad1c805205e84c83a12693', '103.239.252.209', '1608551364', '__ci_last_regenerate|i:1608551363;identity|s:24:\"cctbangladesh@cct.com.bd\";username|s:13:\"cctbangladesh\";email|s:24:\"cctbangladesh@cct.com.bd\";user_id|s:2:\"34\";first_name|s:13:\"CREATIVE CITY\";last_name|s:12:\"TECHNOLOGIES\";created_on|s:24:\"Wed 29 Jan 2020 06:45 PM\";old_last_login|s:10:\"1608461167\";last_ip|s:15:\"103.239.252.209\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"2\";store_id|s:1:\"1\";register_id|s:1:\"2\";cash_in_hand|s:4:\"0.00\";register_open_time|s:19:\"2020-07-29 17:39:57\";');
INSERT INTO `tec_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('7ba84f4b0863fe5abde38d05be0cfe546395a27d', '35.223.145.37', '1608466943', '__ci_last_regenerate|i:1608466943;');
INSERT INTO `tec_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('8a2c49758a68dcb34949de027430a8abb3397b89', '35.223.145.37', '1608475582', '__ci_last_regenerate|i:1608475582;');
INSERT INTO `tec_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('c5405bf3471fec1e01390eeda48a56d8e2adb616', '103.239.252.209', '1608381711', '__ci_last_regenerate|i:1608381711;');
INSERT INTO `tec_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('d801d8bcb88dfcecb89698747cc9b0d44f18d47a', '103.239.252.209', '1608721093', '__ci_last_regenerate|i:1608721060;identity|s:24:\"cctbangladesh@cct.com.bd\";username|s:13:\"cctbangladesh\";email|s:24:\"cctbangladesh@cct.com.bd\";user_id|s:2:\"34\";first_name|s:13:\"CREATIVE CITY\";last_name|s:12:\"TECHNOLOGIES\";created_on|s:24:\"Wed 29 Jan 2020 06:45 PM\";old_last_login|s:10:\"1608628343\";last_ip|s:15:\"103.239.252.209\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"2\";store_id|s:1:\"1\";register_id|s:1:\"2\";cash_in_hand|s:4:\"0.00\";register_open_time|s:19:\"2020-07-29 17:39:57\";');


#
# TABLE STRUCTURE FOR: tec_settings
#

DROP TABLE IF EXISTS `tec_settings`;

CREATE TABLE `tec_settings` (
  `setting_id` int(1) NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) NOT NULL,
  `site_name` varchar(55) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `dateformat` varchar(20) DEFAULT NULL,
  `timeformat` varchar(20) DEFAULT NULL,
  `default_email` varchar(100) NOT NULL,
  `language` varchar(20) NOT NULL,
  `version` varchar(5) NOT NULL DEFAULT '1.0',
  `theme` varchar(20) NOT NULL,
  `timezone` varchar(255) NOT NULL DEFAULT '0',
  `protocol` varchar(20) NOT NULL DEFAULT 'mail',
  `smtp_host` varchar(255) DEFAULT NULL,
  `smtp_user` varchar(100) DEFAULT NULL,
  `smtp_pass` varchar(255) DEFAULT NULL,
  `smtp_port` varchar(10) DEFAULT '25',
  `smtp_crypto` varchar(5) DEFAULT NULL,
  `mmode` tinyint(1) NOT NULL,
  `captcha` tinyint(1) NOT NULL DEFAULT '1',
  `mailpath` varchar(55) DEFAULT NULL,
  `currency_prefix` varchar(3) NOT NULL,
  `default_customer` int(11) NOT NULL,
  `default_tax_rate` varchar(20) NOT NULL,
  `rows_per_page` int(2) NOT NULL,
  `total_rows` int(2) NOT NULL,
  `header` varchar(1000) NOT NULL,
  `footer` varchar(1000) NOT NULL,
  `warranty` text NOT NULL,
  `bsty` tinyint(4) NOT NULL,
  `display_kb` tinyint(4) NOT NULL,
  `default_category` int(11) NOT NULL,
  `default_discount` varchar(20) NOT NULL,
  `item_addition` tinyint(1) NOT NULL,
  `barcode_symbology` varchar(55) NOT NULL,
  `pro_limit` tinyint(4) NOT NULL,
  `decimals` tinyint(1) NOT NULL DEFAULT '2',
  `thousands_sep` varchar(2) NOT NULL DEFAULT ',',
  `decimals_sep` varchar(2) NOT NULL DEFAULT '.',
  `focus_add_item` varchar(55) DEFAULT NULL,
  `add_customer` varchar(55) DEFAULT NULL,
  `toggle_category_slider` varchar(55) DEFAULT NULL,
  `cancel_sale` varchar(55) DEFAULT NULL,
  `suspend_sale` varchar(55) DEFAULT NULL,
  `print_order` varchar(55) DEFAULT NULL,
  `print_bill` varchar(55) DEFAULT NULL,
  `finalize_sale` varchar(55) DEFAULT NULL,
  `today_sale` varchar(55) DEFAULT NULL,
  `open_hold_bills` varchar(55) DEFAULT NULL,
  `close_register` varchar(55) DEFAULT NULL,
  `java_applet` tinyint(1) NOT NULL,
  `receipt_printer` varchar(55) DEFAULT NULL,
  `pos_printers` varchar(255) DEFAULT NULL,
  `cash_drawer_codes` varchar(55) DEFAULT NULL,
  `char_per_line` tinyint(4) DEFAULT '42',
  `rounding` tinyint(1) DEFAULT '0',
  `pin_code` varchar(20) DEFAULT NULL,
  `stripe` tinyint(1) DEFAULT NULL,
  `stripe_secret_key` varchar(100) DEFAULT NULL,
  `stripe_publishable_key` varchar(100) DEFAULT NULL,
  `purchase_code` varchar(100) DEFAULT NULL,
  `envato_username` varchar(50) DEFAULT NULL,
  `theme_style` varchar(25) DEFAULT 'green',
  `after_sale_page` tinyint(1) DEFAULT NULL,
  `overselling` tinyint(1) DEFAULT '1',
  `multi_store` tinyint(1) DEFAULT NULL,
  `position` varchar(255) NOT NULL,
  `sarvice_info` text NOT NULL,
  `uniqcode` varchar(255) NOT NULL,
  `p_count` int(11) NOT NULL,
  `api_key` varchar(255) DEFAULT NULL,
  `sender_id` varchar(255) DEFAULT NULL,
  `supplier_sms` text,
  `customer_sms` text,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `tec_settings` (`setting_id`, `logo`, `site_name`, `tel`, `dateformat`, `timeformat`, `default_email`, `language`, `version`, `theme`, `timezone`, `protocol`, `smtp_host`, `smtp_user`, `smtp_pass`, `smtp_port`, `smtp_crypto`, `mmode`, `captcha`, `mailpath`, `currency_prefix`, `default_customer`, `default_tax_rate`, `rows_per_page`, `total_rows`, `header`, `footer`, `warranty`, `bsty`, `display_kb`, `default_category`, `default_discount`, `item_addition`, `barcode_symbology`, `pro_limit`, `decimals`, `thousands_sep`, `decimals_sep`, `focus_add_item`, `add_customer`, `toggle_category_slider`, `cancel_sale`, `suspend_sale`, `print_order`, `print_bill`, `finalize_sale`, `today_sale`, `open_hold_bills`, `close_register`, `java_applet`, `receipt_printer`, `pos_printers`, `cash_drawer_codes`, `char_per_line`, `rounding`, `pin_code`, `stripe`, `stripe_secret_key`, `stripe_publishable_key`, `purchase_code`, `envato_username`, `theme_style`, `after_sale_page`, `overselling`, `multi_store`, `position`, `sarvice_info`, `uniqcode`, `p_count`, `api_key`, `sender_id`, `supplier_sms`, `customer_sms`) VALUES ('1', 'icon1.png', 'CREATIVECITY', '00000', 'D j M Y', 'h:i A', 'corporate.sharafat@gmail.com', 'english', '4.0.5', 'default', 'Asia/Kuala_Lumpur', 'mail', 'pop.gmail.com', 'noreply@spos.tecdiary.my', '', '25', '', '0', '0', NULL, 'BDT', '2', '0', '50', '30', '<p>75-76 B.S. Bhabon, (L6-103), Laboratory Road, New Elephant Road, Dhaka-1205, Bangladesh<br></p>\r\n', 'Thanks for being with <strong>  CREATIVE CITY TECHNOLOGIES !!</strong> <br>\r\n', '<p><br></p>', '3', '0', '1', '0', '1', '', '20', '2', ',', '.', 'ALT+F1', 'ALT+F2', 'ALT+F10', 'ALT+F5', 'ALT+F6', 'ALT+F11', 'ALT+F12', 'ALT+F8', 'Ctrl+F1', 'Ctrl+F2', 'ALT+F7', '0', '', '', '', '42', '1', '2122', '1', 'sk_test_jHf4cEzAYtgcXvgWPCsQAn50', 'pk_test_beat8SWPORb0OVdF2H77A7uG', '9cefb35d-62de-4e01-940e-217f6fe947e5', 'wedothewebs', 'green', NULL, '1', NULL, 'Sales manager, Staff', '<p><br></p>', '1854098', '1', 'C20070235fc5d89dc52509.77444942', 'CCT', 'Dear {name} , Tk. {paid_balance}/= has been paid. Remaining Balance - Tk. {remaining_balance}/= Regards, CREATIVE CITY TECHNOLOGIES Call: 01917999333\r\n', 'Dear Valued Customer, Your due Balance Tk. {remaining_balance}/=.You\'re requested to pay the remaining balance ASAP. Regards, CREATIVE CITY TECHNOLOGIES Call: 01917999333\r\n');


#
# TABLE STRUCTURE FOR: tec_sms_corner
#

DROP TABLE IF EXISTS `tec_sms_corner`;

CREATE TABLE `tec_sms_corner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `user_type` int(11) DEFAULT NULL COMMENT '1 for customer/ 2 for supplier',
  `user_id` int(11) DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `message` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `tec_sms_corner` (`id`, `name`, `user_type`, `user_id`, `phone_no`, `message`, `created_at`) VALUES ('1', 'CREATIVE COMPUTERS &amp; COMMUNICATIONS first', '2', '1', '+8801748068118', 'Dear CREATIVE COMPUTERS &amp; COMMUNICATIONS , Tk. 9600/= has been paid. Remaining Balance - Tk. -37980/= Regards, CREATIVE CITY TECHNOLOGIES Call: 01917999333\r\n', '2020-12-02 18:14:21');
INSERT INTO `tec_sms_corner` (`id`, `name`, `user_type`, `user_id`, `phone_no`, `message`, `created_at`) VALUES ('2', 'CREATIVE COMPUTERS &amp; COMMUNICATIONS second', '2', '1', '+8801685807302', 'Dear CREATIVE COMPUTERS &amp; COMMUNICATIONS , Tk. 700/= has been paid. Remaining Balance - Tk. -37980/= Regards, CREATIVE CITY TECHNOLOGIES Call: 01917999333\r\n', '2020-12-02 18:14:43');
INSERT INTO `tec_sms_corner` (`id`, `name`, `user_type`, `user_id`, `phone_no`, `message`, `created_at`) VALUES ('3', 'COMPUTER WORLD (PABNA)', '1', '8', '8801915799982', 'Dear Valued Customer, Your due Balance Tk. 800/=.You\'re requested to pay the remaining balance ASAP. Regards, CREATIVE CITY TECHNOLOGIES Call: 01917999333\r\n', '2020-12-10 18:51:21');


#
# TABLE STRUCTURE FOR: tec_sreturn_items
#

DROP TABLE IF EXISTS `tec_sreturn_items`;

CREATE TABLE `tec_sreturn_items` (
  `sreturn_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `sreturn_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` decimal(15,2) NOT NULL,
  `unit_price` decimal(25,2) NOT NULL,
  `net_unit_price` decimal(25,2) NOT NULL,
  `discount` varchar(20) DEFAULT NULL,
  `item_discount` decimal(25,2) DEFAULT NULL,
  `tax` int(20) DEFAULT NULL,
  `item_tax` decimal(25,2) DEFAULT NULL,
  `subtotal` decimal(25,2) NOT NULL,
  `real_unit_price` decimal(25,2) DEFAULT NULL,
  `cost` decimal(25,2) DEFAULT '0.00',
  `store_id` int(11) NOT NULL,
  `return_amount` int(11) NOT NULL,
  `return_qty` int(11) NOT NULL,
  `sale_item_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `problem` varchar(255) NOT NULL,
  `sequence_id` varchar(255) NOT NULL,
  PRIMARY KEY (`sreturn_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: tec_stores
#

DROP TABLE IF EXISTS `tec_stores`;

CREATE TABLE `tec_stores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `code` varchar(20) NOT NULL,
  `logo` varchar(255) DEFAULT 'logo.png',
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `address1` varchar(50) DEFAULT NULL,
  `address2` varchar(50) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `postal_code` varchar(8) DEFAULT NULL,
  `country` varchar(25) DEFAULT NULL,
  `currency_code` varchar(3) NOT NULL,
  `receipt_header` text NOT NULL,
  `receipt_footer` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `tec_stores` (`id`, `name`, `code`, `logo`, `email`, `phone`, `address1`, `address2`, `city`, `state`, `postal_code`, `country`, `currency_code`, `receipt_header`, `receipt_footer`) VALUES ('1', 'Creativecity', 'POS', 'logo.png', 'wedothewebs@gmail.com', '012345678', 'Address Line ddd', 'Address Line ddd', 'Petaling Jaya', 'Selangor', '46000', 'Bangladesh', 'BDT', 'This is receipt header for storeddd', 'This is receipt footer for storedd');


#
# TABLE STRUCTURE FOR: tec_suppliers
#

DROP TABLE IF EXISTS `tec_suppliers`;

CREATE TABLE `tec_suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `cf1` varchar(255) NOT NULL,
  `cf2` varchar(255) NOT NULL,
  `phone` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `store_id` int(255) NOT NULL,
  `opening_blance` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO `tec_suppliers` (`id`, `name`, `cf1`, `cf2`, `phone`, `email`, `store_id`, `opening_blance`) VALUES ('1', 'CREATIVE COMPUTERS &amp; COMMUNICATIONS', '75 BS BHABAN ( L-3-108 ), SCIENCE LABORATORY  ( NEW ELEPHANT ROAD ), DHAKA-1205', '', '8801979225995', 'ccc@ccanvas.net', '1', '0');
INSERT INTO `tec_suppliers` (`id`, `name`, `cf1`, `cf2`, `phone`, `email`, `store_id`, `opening_blance`) VALUES ('2', 'BHUIYAN TECHNOLOGY', 'SR# 110, LEVEL # 4, 75/76 NEW ELEPHANT ROAD, BS BHABAN, DHAKA-1205.', '', '8801819478964, 8801772562525, 8801885080909', 'bhuiyanpc@yahoo.com', '1', '0');
INSERT INTO `tec_suppliers` (`id`, `name`, `cf1`, `cf2`, `phone`, `email`, `store_id`, `opening_blance`) VALUES ('3', 'RASA TECHNOLOGIES', 'FERDAUSI PLAZA (5th Floor),334 ELEPHANT ROAD, DHAKA-1205', '', '8801670934654, 8801611150715', '', '1', '0');
INSERT INTO `tec_suppliers` (`id`, `name`, `cf1`, `cf2`, `phone`, `email`, `store_id`, `opening_blance`) VALUES ('4', 'COMPUTER SQUADRON', '75-76 BS BHOBON, (L6-103), LABRATORY ROAD, NEW ELEPHANT ROAD,DHAKA', '', '8801917999333', 'computersquadron1@gmail.com', '1', '0');
INSERT INTO `tec_suppliers` (`id`, `name`, `cf1`, `cf2`, `phone`, `email`, `store_id`, `opening_blance`) VALUES ('5', 'TECH DEAL', 'shop# L1-115, BS BHABAN (1st Floor), HOUSE# 75-76, LABORATORY ROAD,( NEW ELEPHANT ROAD), DHAKA', '', '8801316318910', 'techdealbd@gmail.com', '1', '0');
INSERT INTO `tec_suppliers` (`id`, `name`, `cf1`, `cf2`, `phone`, `email`, `store_id`, `opening_blance`) VALUES ('6', 'TR COMPUTER', 'SIDDIQUE PLAZA, SHOP# 09, GROUND FLOOR, 44, NEW ELEPHANT ROAD, DHAKA-1205', '', '8801721265352, 8801612004343', 'trcomputer69@gmail.com', '1', '0');
INSERT INTO `tec_suppliers` (`id`, `name`, `cf1`, `cf2`, `phone`, `email`, `store_id`, `opening_blance`) VALUES ('7', 'SOUTH BANGLA COMPUTERS', '', '', '8801713315288, 8801678040444', '', '1', '0');
INSERT INTO `tec_suppliers` (`id`, `name`, `cf1`, `cf2`, `phone`, `email`, `store_id`, `opening_blance`) VALUES ('8', 'U C C', 'SQUARE TOWER, FLAT# 2D,2ND FLOOR, 36/6, MIRPUR ROAD (BASHUNDHARA LANE), DHAKA.', '', '8801844058748, 09610202020 EXT. 510-520', 'info@ucc-bd.com', '1', '0');
INSERT INTO `tec_suppliers` (`id`, `name`, `cf1`, `cf2`, `phone`, `email`, `store_id`, `opening_blance`) VALUES ('9', 'J.A.N. ASSOCIATES', '@ARIYAN TRADE INTERNATIONAL', 'SHOP # 536-537, LEVEL # 5, MULTIPLAN CENTER, DHAKA', '', '', '1', '0');


#
# TABLE STRUCTURE FOR: tec_suspended_items
#

DROP TABLE IF EXISTS `tec_suspended_items`;

CREATE TABLE `tec_suspended_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `suspend_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` decimal(15,2) NOT NULL,
  `unit_price` decimal(25,2) NOT NULL,
  `net_unit_price` decimal(25,2) NOT NULL,
  `discount` varchar(20) DEFAULT NULL,
  `item_discount` decimal(25,2) DEFAULT NULL,
  `tax` int(20) DEFAULT NULL,
  `item_tax` decimal(25,2) DEFAULT NULL,
  `subtotal` decimal(25,2) NOT NULL,
  `real_unit_price` decimal(25,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: tec_suspended_sales
#

DROP TABLE IF EXISTS `tec_suspended_sales`;

CREATE TABLE `tec_suspended_sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(55) NOT NULL,
  `total` decimal(25,2) NOT NULL,
  `product_discount` decimal(25,2) DEFAULT NULL,
  `order_discount_id` varchar(20) DEFAULT NULL,
  `order_discount` decimal(25,2) DEFAULT NULL,
  `total_discount` decimal(25,2) DEFAULT NULL,
  `product_tax` decimal(25,2) DEFAULT NULL,
  `order_tax_id` varchar(20) DEFAULT NULL,
  `order_tax` decimal(25,2) DEFAULT NULL,
  `total_tax` decimal(25,2) DEFAULT NULL,
  `grand_total` decimal(25,2) NOT NULL,
  `total_items` int(11) DEFAULT NULL,
  `total_quantity` decimal(15,2) DEFAULT NULL,
  `paid` decimal(25,2) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `hold_ref` varchar(255) DEFAULT NULL,
  `store_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: tec_today_collection
#

DROP TABLE IF EXISTS `tec_today_collection`;

CREATE TABLE `tec_today_collection` (
  `today_collect_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_date` datetime NOT NULL,
  `payment_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `store_id` int(11) DEFAULT '0',
  PRIMARY KEY (`today_collect_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tec_today_collection` (`today_collect_id`, `payment_date`, `payment_amount`, `customer_id`, `payment_note`, `store_id`) VALUES ('1', '2020-07-29 18:03:56', '10000', '3', '', '1');
INSERT INTO `tec_today_collection` (`today_collect_id`, `payment_date`, `payment_amount`, `customer_id`, `payment_note`, `store_id`) VALUES ('2', '2020-08-09 20:03:24', '20000', '3', '<p>A.K COMPUTER</p><p>ISLAMI BANK</p><p>CHEQUE# 8657124</p><p>date: 20/08/2020</p>', '1');
INSERT INTO `tec_today_collection` (`today_collect_id`, `payment_date`, `payment_amount`, `customer_id`, `payment_note`, `store_id`) VALUES ('3', '2020-08-27 20:27:23', '70', '4', '<p>FOR BHUIYAN TECHNOLOGY PAY7MENT</p>', '1');
INSERT INTO `tec_today_collection` (`today_collect_id`, `payment_date`, `payment_amount`, `customer_id`, `payment_note`, `store_id`) VALUES ('4', '2020-08-30 19:37:38', '18000', '3', '<p>CHEQUE#,8657130 , DATE: 13/09/2020</p><p>ISLAMI BANK LTD.</p>', '1');
INSERT INTO `tec_today_collection` (`today_collect_id`, `payment_date`, `payment_amount`, `customer_id`, `payment_note`, `store_id`) VALUES ('5', '2020-08-30 19:38:49', '18800', '3', '<p>CHEQUE# 8657131, DATE: 20/09/2020</p><p>ISLAMI BANK LTD.</p>', '1');
INSERT INTO `tec_today_collection` (`today_collect_id`, `payment_date`, `payment_amount`, `customer_id`, `payment_note`, `store_id`) VALUES ('6', '2020-08-30 19:40:13', '2200', '3', '<p>CHEQUE # 8657132, DATE: 20/09/2020</p><p>ISLAMI BANK LTD.</p>', '1');
INSERT INTO `tec_today_collection` (`today_collect_id`, `payment_date`, `payment_amount`, `customer_id`, `payment_note`, `store_id`) VALUES ('7', '2020-08-30 19:53:10', '3000', '3', '<p>S.M MAHMUD SHARAFAT</p><p>CASH COLLECTION</p>', '1');
INSERT INTO `tec_today_collection` (`today_collect_id`, `payment_date`, `payment_amount`, `customer_id`, `payment_note`, `store_id`) VALUES ('8', '2020-08-30 20:29:11', '9500', '5', '<p>bill # 4</p>', '1');
INSERT INTO `tec_today_collection` (`today_collect_id`, `payment_date`, `payment_amount`, `customer_id`, `payment_note`, `store_id`) VALUES ('9', '2020-09-12 19:43:03', '6300', '4', '<p>CASH COLLECTION (  for TR COMPUTER PAYMENT)</p>', '1');
INSERT INTO `tec_today_collection` (`today_collect_id`, `payment_date`, `payment_amount`, `customer_id`, `payment_note`, `store_id`) VALUES ('10', '2020-09-12 19:47:03', '4500', '5', '<p>CASH COLLECTION ( S.M MAHMUD SHARAFAT )</p>', '1');
INSERT INTO `tec_today_collection` (`today_collect_id`, `payment_date`, `payment_amount`, `customer_id`, `payment_note`, `store_id`) VALUES ('11', '2020-09-14 18:17:28', '8000', '5', '<p>cash collection</p>', '1');
INSERT INTO `tec_today_collection` (`today_collect_id`, `payment_date`, `payment_amount`, `customer_id`, `payment_note`, `store_id`) VALUES ('12', '2020-09-14 19:31:33', '850', '5', '', '1');
INSERT INTO `tec_today_collection` (`today_collect_id`, `payment_date`, `payment_amount`, `customer_id`, `payment_note`, `store_id`) VALUES ('13', '2020-09-20 11:59:09', '8000', '5', '<p>DATE: 20/09/2020</p><p>CASH</p>', '1');
INSERT INTO `tec_today_collection` (`today_collect_id`, `payment_date`, `payment_amount`, `customer_id`, `payment_note`, `store_id`) VALUES ('14', '2020-09-24 19:24:01', '4750', '10', '<p>DATE: 24/09/2020</p><p>Sep 24 2020 7:18PM 1524203491061001 00530210005329 CREATIVE CITY TECHNOLO CCT TBL TRUST BANK LTD. EFT 4,750.00<br></p>', '1');
INSERT INTO `tec_today_collection` (`today_collect_id`, `payment_date`, `payment_amount`, `customer_id`, `payment_note`, `store_id`) VALUES ('15', '2020-09-27 16:24:30', '19600', '8', '<p>DATE: 26/09/2020</p><p>COLLECTION BY C. CARD BRACK BANK</p>', '1');
INSERT INTO `tec_today_collection` (`today_collect_id`, `payment_date`, `payment_amount`, `customer_id`, `payment_note`, `store_id`) VALUES ('16', '2020-09-27 18:35:46', '2000', '9', '<p>DATE: 26/09/2020</p>', '1');
INSERT INTO `tec_today_collection` (`today_collect_id`, `payment_date`, `payment_amount`, `customer_id`, `payment_note`, `store_id`) VALUES ('17', '2020-10-01 19:28:20', '10000', '12', '<p>28/09/2020</p><p>CS, BRAC BANK</p>', '1');
INSERT INTO `tec_today_collection` (`today_collect_id`, `payment_date`, `payment_amount`, `customer_id`, `payment_note`, `store_id`) VALUES ('18', '2020-10-01 19:28:57', '9000', '12', '<p>30/09/2020</p><p>CS, BRAC BANK</p>', '1');
INSERT INTO `tec_today_collection` (`today_collect_id`, `payment_date`, `payment_amount`, `customer_id`, `payment_note`, `store_id`) VALUES ('19', '2020-10-06 15:32:40', '8000', '5', '<p>DATE: 05/10/2020</p><p>3,000+5,000= 10,000/=</p>', '1');
INSERT INTO `tec_today_collection` (`today_collect_id`, `payment_date`, `payment_amount`, `customer_id`, `payment_note`, `store_id`) VALUES ('20', '2020-10-12 15:09:14', '9350', '14', '<p>DATE: 12/10/2020</p><p>CASH COLLECTION</p>', '1');
INSERT INTO `tec_today_collection` (`today_collect_id`, `payment_date`, `payment_amount`, `customer_id`, `payment_note`, `store_id`) VALUES ('21', '2020-10-13 16:42:10', '9500', '13', '<p>DATE: 13/10/2020</p><p>BY CS BRAC BANK</p><p>CHEQUE# 4852389 = 8,000/=</p><p>BANK CHARGE       = 1500/=</p>', '1');
INSERT INTO `tec_today_collection` (`today_collect_id`, `payment_date`, `payment_amount`, `customer_id`, `payment_note`, `store_id`) VALUES ('22', '2020-10-15 13:55:02', '18700', '14', '', '1');
INSERT INTO `tec_today_collection` (`today_collect_id`, `payment_date`, `payment_amount`, `customer_id`, `payment_note`, `store_id`) VALUES ('23', '2020-10-21 19:48:24', '3550', '11', '<p>DATE: 21/10/2020</p><p>CASH FOR UCC PAYMENT</p>', '1');
INSERT INTO `tec_today_collection` (`today_collect_id`, `payment_date`, `payment_amount`, `customer_id`, `payment_note`, `store_id`) VALUES ('24', '2020-10-22 19:14:20', '1900', '15', '', '1');
INSERT INTO `tec_today_collection` (`today_collect_id`, `payment_date`, `payment_amount`, `customer_id`, `payment_note`, `store_id`) VALUES ('25', '2020-11-18 11:24:33', '9350', '3', '', '1');
INSERT INTO `tec_today_collection` (`today_collect_id`, `payment_date`, `payment_amount`, `customer_id`, `payment_note`, `store_id`) VALUES ('26', '2020-12-13 19:00:29', '800', '8', '<p>DATE: 12/12/2020</p><p>BKASH</p>', '1');
INSERT INTO `tec_today_collection` (`today_collect_id`, `payment_date`, `payment_amount`, `customer_id`, `payment_note`, `store_id`) VALUES ('27', '2020-12-19 16:30:51', '14600', '5', '', '1');
INSERT INTO `tec_today_collection` (`today_collect_id`, `payment_date`, `payment_amount`, `customer_id`, `payment_note`, `store_id`) VALUES ('28', '2020-12-21 16:39:08', '1900', '15', '', '1');


#
# TABLE STRUCTURE FOR: tec_today_purchase_payment
#

DROP TABLE IF EXISTS `tec_today_purchase_payment`;

CREATE TABLE `tec_today_purchase_payment` (
  `today_payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_date` datetime NOT NULL,
  `payment_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'cash',
  `cheque_no` int(255) DEFAULT NULL,
  `payment_note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `store_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`today_payment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tec_today_purchase_payment` (`today_payment_id`, `payment_date`, `payment_amount`, `supplier_id`, `type`, `cheque_no`, `payment_note`, `store_id`) VALUES ('2', '2020-07-29 18:07:53', '9500', '1', 'cash', NULL, '<p>CASH</p>', '1');
INSERT INTO `tec_today_purchase_payment` (`today_payment_id`, `payment_date`, `payment_amount`, `supplier_id`, `type`, `cheque_no`, `payment_note`, `store_id`) VALUES ('3', '2020-08-10 14:35:57', '15000', '1', 'cash', NULL, '<p>DATE: 09/08/2020</p><p>M.R # 0669</p><p>CASH</p>', '1');
INSERT INTO `tec_today_purchase_payment` (`today_payment_id`, `payment_date`, `payment_amount`, `supplier_id`, `type`, `cheque_no`, `payment_note`, `store_id`) VALUES ('4', '2020-08-11 12:40:30', '3500', '1', 'cash', NULL, '<p>DATE: 11/08/2020</p><p>M.R # 0690</p><p>CASH</p>', '1');
INSERT INTO `tec_today_purchase_payment` (`today_payment_id`, `payment_date`, `payment_amount`, `supplier_id`, `type`, `cheque_no`, `payment_note`, `store_id`) VALUES ('5', '2020-08-11 19:43:48', '650', '2', 'cash', NULL, '<p>CASH PAYMENT for INV. # 4280</p>', '1');
INSERT INTO `tec_today_purchase_payment` (`today_payment_id`, `payment_date`, `payment_amount`, `supplier_id`, `type`, `cheque_no`, `payment_note`, `store_id`) VALUES ('6', '2020-08-20 17:02:57', '28000', '3', 'Cheque', '391837', '<p>DATE: 20/08/2020</p><p>CHEQUE#0391837</p><p>TRUST BANK</p>', '1');
INSERT INTO `tec_today_purchase_payment` (`today_payment_id`, `payment_date`, `payment_amount`, `supplier_id`, `type`, `cheque_no`, `payment_note`, `store_id`) VALUES ('7', '2020-08-27 20:25:02', '70', '2', 'cash', NULL, '', '1');
INSERT INTO `tec_today_purchase_payment` (`today_payment_id`, `payment_date`, `payment_amount`, `supplier_id`, `type`, `cheque_no`, `payment_note`, `store_id`) VALUES ('8', '2020-08-30 19:35:08', '21000', '1', 'cash', NULL, '<p>STAN NO: 025449, TRAN DATE: 30-08-2020</p>', '1');
INSERT INTO `tec_today_purchase_payment` (`today_payment_id`, `payment_date`, `payment_amount`, `supplier_id`, `type`, `cheque_no`, `payment_note`, `store_id`) VALUES ('9', '2020-09-08 14:16:40', '2760', '1', 'cash', NULL, '<p>DATE: 29/08/2020</p>', '1');
INSERT INTO `tec_today_purchase_payment` (`today_payment_id`, `payment_date`, `payment_amount`, `supplier_id`, `type`, `cheque_no`, `payment_note`, `store_id`) VALUES ('10', '2020-09-08 14:20:28', '700', '1', 'cash', NULL, '<p>DATE: 02/09/2020</p><p>INV.# 20001025</p><p>WEBCAME: CHINA ORIGIN, 720P WITH BUIL T-IN</p><p>MICROPHONE 1 PCS PURCHASES RETURN</p><p><br></p>', '1');
INSERT INTO `tec_today_purchase_payment` (`today_payment_id`, `payment_date`, `payment_amount`, `supplier_id`, `type`, `cheque_no`, `payment_note`, `store_id`) VALUES ('11', '2020-09-12 17:43:14', '22400', '7', 'Cheque', '391846', '<p>DATE: 13/09/2020</p><p>TRUST BANK</p><p>CHEQUE # 0391846</p>', '1');
INSERT INTO `tec_today_purchase_payment` (`today_payment_id`, `payment_date`, `payment_amount`, `supplier_id`, `type`, `cheque_no`, `payment_note`, `store_id`) VALUES ('12', '2020-09-12 17:45:13', '6300', '6', 'cash', NULL, '<p>CASH PAYMENT</p><p>DATE: 12/09/2020</p>', '1');
INSERT INTO `tec_today_purchase_payment` (`today_payment_id`, `payment_date`, `payment_amount`, `supplier_id`, `type`, `cheque_no`, `payment_note`, `store_id`) VALUES ('13', '2020-09-14 19:25:00', '18000', '1', 'Cheque', '391847', '<p>CHEQUE # 0391847</p><p>DATE: 15/09/2020</p><p>TRUST BANK ( CCT)</p>', '1');
INSERT INTO `tec_today_purchase_payment` (`today_payment_id`, `payment_date`, `payment_amount`, `supplier_id`, `type`, `cheque_no`, `payment_note`, `store_id`) VALUES ('14', '2020-09-14 19:32:09', '850', '5', 'cash', NULL, '', '1');
INSERT INTO `tec_today_purchase_payment` (`today_payment_id`, `payment_date`, `payment_amount`, `supplier_id`, `type`, `cheque_no`, `payment_note`, `store_id`) VALUES ('15', '2020-09-19 19:51:01', '9600', '1', 'Cheque', '391850', '<p>DATE: 20/09/2020</p><p>TRUST BANK </p><p>CHEQUE # 0391850</p>', '1');
INSERT INTO `tec_today_purchase_payment` (`today_payment_id`, `payment_date`, `payment_amount`, `supplier_id`, `type`, `cheque_no`, `payment_note`, `store_id`) VALUES ('16', '2020-10-12 13:04:43', '9200', '1', 'Cheque', '391857', '<p>DATE: 12/10/2020</p><p>TRUST BANK</p><p>CHEQUE# 0391857</p>', '1');
INSERT INTO `tec_today_purchase_payment` (`today_payment_id`, `payment_date`, `payment_amount`, `supplier_id`, `type`, `cheque_no`, `payment_note`, `store_id`) VALUES ('17', '2020-10-12 15:21:51', '9200', '1', 'Cheque', '391858', '<p>DATE: 12/10/2020</p><p>CHEQUE# 0391858</p><p>TRUST BANK</p>', '1');
INSERT INTO `tec_today_purchase_payment` (`today_payment_id`, `payment_date`, `payment_amount`, `supplier_id`, `type`, `cheque_no`, `payment_note`, `store_id`) VALUES ('18', '2020-10-13 16:39:22', '5100', '4', 'cash', NULL, '<p>DATE:13/10/2020</p><p>CASH</p>', '1');
INSERT INTO `tec_today_purchase_payment` (`today_payment_id`, `payment_date`, `payment_amount`, `supplier_id`, `type`, `cheque_no`, `payment_note`, `store_id`) VALUES ('19', '2020-10-15 14:02:33', '18000', '1', 'Cheque', '391859', '<p>DATE: 15/10/2020</p><p>INV.# 20001283</p><p>CHEQUE # 0391859</p><p>TRUST BANK</p>', '1');
INSERT INTO `tec_today_purchase_payment` (`today_payment_id`, `payment_date`, `payment_amount`, `supplier_id`, `type`, `cheque_no`, `payment_note`, `store_id`) VALUES ('20', '2020-10-19 13:02:39', '18000', '1', 'Cheque', '391849', '<p>DATE: 21/09/2020</p><p>CHEQUE# 0391849</p><p>TRUST BANK</p>', '1');
INSERT INTO `tec_today_purchase_payment` (`today_payment_id`, `payment_date`, `payment_amount`, `supplier_id`, `type`, `cheque_no`, `payment_note`, `store_id`) VALUES ('21', '2020-10-21 17:57:50', '3800', '8', 'cash', NULL, '<p>INV.# 5257</p><p>CASH PAYMENT</p>', '1');
INSERT INTO `tec_today_purchase_payment` (`today_payment_id`, `payment_date`, `payment_amount`, `supplier_id`, `type`, `cheque_no`, `payment_note`, `store_id`) VALUES ('22', '2020-10-22 19:07:54', '900', '1', 'cash', NULL, '<p>DATE: 22/10/2020</p><p>INV.# 20001337</p><p>CASH PAYMENT</p>', '1');
INSERT INTO `tec_today_purchase_payment` (`today_payment_id`, `payment_date`, `payment_amount`, `supplier_id`, `type`, `cheque_no`, `payment_note`, `store_id`) VALUES ('23', '2020-11-18 12:35:04', '10000', '1', 'cash', NULL, '<p>M.R # A001RPT20001245</p>', '1');
INSERT INTO `tec_today_purchase_payment` (`today_payment_id`, `payment_date`, `payment_amount`, `supplier_id`, `type`, `cheque_no`, `payment_note`, `store_id`) VALUES ('24', '2020-12-09 18:19:21', '4400', '9', 'cash', NULL, '<p>INV.# Ari- 1752/20</p>', '1');
INSERT INTO `tec_today_purchase_payment` (`today_payment_id`, `payment_date`, `payment_amount`, `supplier_id`, `type`, `cheque_no`, `payment_note`, `store_id`) VALUES ('25', '2020-12-19 16:34:09', '13600', '1', 'cash', NULL, '<p>DATE: 19/12/2020</p><p>INV.# A001INV20001572</p>', '1');
INSERT INTO `tec_today_purchase_payment` (`today_payment_id`, `payment_date`, `payment_amount`, `supplier_id`, `type`, `cheque_no`, `payment_note`, `store_id`) VALUES ('26', '2020-12-21 16:44:25', '1800', '1', 'cash', NULL, '<p>DATE: 21/12/2020</p><p>INV.# A001INV20001586</p><p>CASH</p>', '1');
INSERT INTO `tec_today_purchase_payment` (`today_payment_id`, `payment_date`, `payment_amount`, `supplier_id`, `type`, `cheque_no`, `payment_note`, `store_id`) VALUES ('27', '2020-12-23 16:56:06', '10000', '1', 'Cheque', '391865', '<p>CHEQUE DATE: 24/12/2020</p><p>CHEQUE # 0391865</p><p>TRUST BANK ( CCT)</p>', '1');


#
# TABLE STRUCTURE FOR: tec_tranjiction
#

DROP TABLE IF EXISTS `tec_tranjiction`;

CREATE TABLE `tec_tranjiction` (
  `tranjiction_id` int(11) NOT NULL AUTO_INCREMENT,
  `tran_amount` varchar(25) NOT NULL,
  `bank_account_id` int(11) NOT NULL,
  `tran_date` datetime NOT NULL,
  `tran_type` int(11) DEFAULT NULL,
  `pettytobankt` varchar(255) DEFAULT NULL,
  `pedding_cheque` int(11) DEFAULT NULL,
  `loan_pending_id` int(11) DEFAULT NULL,
  `tran_note` text NOT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`tranjiction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('1', '1000000', '2', '2020-08-12 18:37:07', '1', '1', NULL, NULL, 'B.F', '1');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('2', '150000', '2', '2020-08-13 12:41:57', '1', '1', NULL, NULL, '', '1');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('3', '100000', '2', '2020-08-13 12:50:17', '0', '0', NULL, NULL, 'DATE: 13/08/2020\r\nCHEQUE# 0391831', '1');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('4', '100000', '2', '2020-08-16 17:14:27', '1', '1', NULL, NULL, 'MRS ISMAT ARA ', '1');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('5', '100000', '2', '2020-08-16 17:16:30', '0', '0', NULL, NULL, 'DATE: 16/08/2020\r\nCHEQUE# 0391832\r\n', '1');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('6', '150000', '2', '2020-08-17 18:12:14', '0', '0', NULL, NULL, 'DATE: 17/08/2020\r\nTRUST BANK CHEQUE # 0391833\r\nfor COMPUTER SQUADRON', '1');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('7', '250000', '2', '2020-08-18 16:09:16', '0', '0', NULL, NULL, 'DATE: 18/08/2020\r\nCHEQUE# 0391834', '1');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('8', '100000', '2', '2020-08-19 16:25:40', '0', '0', NULL, NULL, 'DATE: 19/08/2020\r\nTRUST BANK\r\nCHEQUE# 0391835', '1');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('9', '15500', '2', '2020-08-20 17:04:16', '0', '0', NULL, NULL, 'DATE: 20/08/2020\r\nCHEQUE# 0391836\r\nTRUST BANK', '1');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('10', '5600', '2', '2020-08-23 17:15:55', '0', '0', NULL, NULL, 'DATE: 23/08/2020\r\nCHEQUE # 0391838', '1');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('11', '20000', '2', '2020-08-23 17:17:45', '0', '0', NULL, NULL, 'DATE: 23/08/2020\r\nCHEQUE # 0391839', '1');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('12', '30000', '2', '2020-08-24 15:54:13', '0', '0', NULL, NULL, 'DATE: 24/08/2020\r\nCHEQUE # 0391840', '1');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('13', '30000', '2', '2020-08-26 19:21:13', '0', '0', NULL, NULL, 'DATE: 26/08/2020\r\nCHEQUE # 0391841', '1');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('14', '85000', '2', '2020-08-27 16:59:16', '0', '0', NULL, NULL, 'DATE: 27/08/2020\r\nCHEQUE # 0391843', '1');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('15', '44000', '2', '2020-08-27 17:00:19', '0', '0', NULL, NULL, 'DATE: 27/08/2020\r\nCHEQUE # 0391844', '1');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('16', '28000', '2', '2020-09-10 20:07:44', '0', NULL, '2', NULL, '', '0');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('17', '20000', '2', '2020-09-10 20:08:06', '1', NULL, '1', NULL, '', '0');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('18', '22400', '2', '2020-09-13 17:26:04', '1', '1', NULL, NULL, 'DATE: 13/09/2020\r\nCOMPUTER SQUADRON (BRAC BANK)', '1');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('19', '22000', '2', '2020-09-15 16:36:45', '1', '1', NULL, NULL, 'CASH DEPOSIT', '1');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('20', '22000', '2', '2020-09-16 18:37:12', '0', '0', NULL, NULL, 'DATE: 16/09/2020\r\nCHEQUE # 0391848\r\nTRUST BANK', '1');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('21', '85000.00', '2', '2020-09-17 18:27:38', '1', NULL, NULL, '1', '', '0');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('22', '27600', '2', '2020-09-20 16:59:46', '1', '1', NULL, NULL, 'DATE: 20/09/2020\r\nCS CASH DEPOSIT CCT TRUST BANK', '1');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('23', '90000', '2', '2020-09-22 17:22:59', '1', '1', NULL, NULL, 'DATE:21/09/2020\r\nCS CITY BANK CHEQUE # 4332368  CASH', '1');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('24', '4750', '2', '2020-09-24 19:25:09', '1', '1', NULL, NULL, 'DATE: 24/09/2020\r\nSep 24 2020 7:18PM 1524203491061001 00530210005329 CREATIVE CITY TECHNOLO CCT TBL TRUST BANK LTD. EFT 4,750.00', '1');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('25', '26000', '2', '2020-09-27 12:54:26', '1', '1', NULL, NULL, 'DATE: 27/09/2020\r\n', '1');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('26', '15000', '2', '2020-09-29 15:28:38', '0', '0', NULL, NULL, 'DATE: 29/09/2020\r\nCHEQUE # 0391851\r\nCASH FOR CS ( TEH & CCT TRADE LYCENC', '1');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('27', '16000', '2', '2020-09-30 15:55:14', '0', '0', NULL, NULL, 'DATE: 30/09/2020\r\nCHEQUE# 0391853\r\nFOR CS LOAN', '1');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('28', '11963', '2', '2020-09-30 15:56:23', '0', '0', NULL, NULL, 'DATE: 30/09/2020\r\nCHEQUE # 03918852\r\nFOR CS LOAN', '1');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('29', '29680', '2', '2020-10-01 16:20:52', '0', '0', NULL, NULL, 'DATE: 01/10/2020\r\nTRUST BANK \r\nCHEQUE# 0391854\r\n', '1');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('30', '10000', '2', '2020-10-04 18:39:57', '0', '0', NULL, NULL, 'DATE: 04/10/2020\r\nCCT TRUST BANK\r\nCHEQUE # 0391855', '1');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('31', '18000', '2', '2020-10-06 15:31:03', '1', '1', NULL, NULL, 'DATE: 06/10/2020', '1');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('32', '16000', '2', '2020-10-08 16:42:16', '0', '0', NULL, NULL, 'DATE: 08/10/2020\r\nCHEQUE# 0391856\r\nCCC TRUST BANK', '1');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('33', '9200', '2', '2020-10-13 14:23:42', '0', NULL, '10', NULL, '', '0');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('34', '9200', '2', '2020-10-13 14:23:48', '0', NULL, '9', NULL, '', '0');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('35', '9600', '2', '2020-10-13 14:23:58', '0', NULL, '8', NULL, '', '0');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('36', '18000', '2', '2020-10-13 14:24:07', '0', NULL, '7', NULL, '', '0');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('37', '22400', '2', '2020-10-13 14:24:15', '0', NULL, '6', NULL, '', '0');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('38', '2200', '2', '2020-10-13 14:24:31', '1', NULL, '5', NULL, '', '0');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('39', '18800', '2', '2020-10-13 14:24:37', '1', NULL, '4', NULL, '', '0');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('40', '18000', '2', '2020-10-13 14:24:44', '1', NULL, '3', NULL, '', '0');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('41', '19000', '2', '2020-10-15 15:31:36', '1', '1', NULL, NULL, 'DATE: 15/10/2020\r\nCASH DIPOSIT', '1');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('42', '2000', '2', '2020-11-05 19:43:20', '0', '0', NULL, NULL, 'DATE: 05/11/2020\r\nCHEQUE# 0391861\r\nTRUST BANK', '1');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('43', '18000', '2', '2020-11-11 20:20:50', '0', NULL, '12', NULL, '', '0');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('44', '18000', '2', '2020-11-11 20:20:57', '0', NULL, '11', NULL, '', '0');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('45', '26295.00', '2', '2020-11-11 20:21:32', '1', NULL, NULL, '2', '', '0');
INSERT INTO `tec_tranjiction` (`tranjiction_id`, `tran_amount`, `bank_account_id`, `tran_date`, `tran_type`, `pettytobankt`, `pedding_cheque`, `loan_pending_id`, `tran_note`, `store_id`) VALUES ('46', '14000', '2', '2020-11-25 16:07:23', '0', '0', NULL, NULL, 'DATE: 25/11/2020\r\nCHEQUE # 0391862\r\nTRUST BANK', '1');


#
# TABLE STRUCTURE FOR: tec_transfers
#

DROP TABLE IF EXISTS `tec_transfers`;

CREATE TABLE `tec_transfers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `from_warehouse_id` int(11) NOT NULL,
  `from_warehouse_name` varchar(255) NOT NULL,
  `to_warehouse_id` int(11) NOT NULL,
  `to_warehouse_name` varchar(255) NOT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `total` decimal(25,4) DEFAULT NULL,
  `grand_total` decimal(25,4) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `status` varchar(55) NOT NULL DEFAULT 'pending',
  `shipping` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `attachment` varchar(55) DEFAULT NULL,
  `reference` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: tec_transfers_items
#

DROP TABLE IF EXISTS `tec_transfers_items`;

CREATE TABLE `tec_transfers_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transfers_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quentity` int(11) NOT NULL,
  `cost` decimal(10,0) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  `sequence` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: tec_user_logins
#

DROP TABLE IF EXISTS `tec_user_logins`;

CREATE TABLE `tec_user_logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=307 DEFAULT CHARSET=utf8;

INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('1', '1', NULL, '103.218.25.62', 'wedothewebs@gmail.com', '2020-01-07 02:43:12');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('2', '1', NULL, '103.218.25.62', 'wedothewebs@gmail.com', '2020-01-07 04:25:58');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('3', '1', NULL, '103.91.229.182', 'wedothewebs@gmail.com', '2020-01-07 04:39:02');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('4', '27', NULL, '202.84.40.123', 'corporate.sharafat@gmail.com', '2020-01-07 12:46:59');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('5', '27', NULL, '43.245.235.138', 'corporate.sharafat@gmail.com', '2020-01-08 09:58:30');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('6', '27', NULL, '43.245.235.138', 'corporate.sharafat@gmail.com', '2020-01-09 06:01:21');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('7', '27', NULL, '202.84.40.123', 'corporate.sharafat@gmail.com', '2020-01-09 16:42:10');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('8', '1', NULL, '103.218.25.62', 'wedothewebs@gmail.com', '2020-01-11 01:23:30');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('9', '27', NULL, '43.245.235.138', 'corporate.sharafat@gmail.com', '2020-01-11 09:15:48');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('10', '27', NULL, '43.245.235.138', 'corporate.sharafat@gmail.com', '2020-01-13 06:12:45');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('11', '27', NULL, '43.245.235.138', 'corporate.sharafat@gmail.com', '2020-01-13 10:39:07');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('12', '27', NULL, '43.245.235.138', 'corporate.sharafat@gmail.com', '2020-01-14 05:00:13');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('13', '27', NULL, '43.245.235.138', 'corporate.sharafat@gmail.com', '2020-01-14 05:00:19');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('14', '27', NULL, '43.245.235.138', 'corporate.sharafat@gmail.com', '2020-01-15 01:53:10');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('15', '27', NULL, '43.245.235.138', 'corporate.sharafat@gmail.com', '2020-01-15 07:08:53');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('16', '27', NULL, '43.245.235.138', 'corporate.sharafat@gmail.com', '2020-01-17 05:02:58');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('17', '27', NULL, '43.245.235.138', 'corporate.sharafat@gmail.com', '2020-01-19 02:45:40');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('18', '27', NULL, '43.245.235.138', 'corporate.sharafat@gmail.com', '2020-01-20 08:50:59');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('19', '1', NULL, '103.218.24.32', 'wedothewebs@gmail.com', '2020-01-21 00:49:30');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('20', '27', NULL, '43.245.235.138', 'corporate.sharafat@gmail.com', '2020-01-22 00:56:34');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('21', '27', NULL, '43.245.235.138', 'corporate.sharafat@gmail.com', '2020-01-24 05:19:57');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('22', '27', NULL, '43.245.235.138', 'corporate.sharafat@gmail.com', '2020-01-26 00:57:14');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('23', '27', NULL, '43.245.235.138', 'corporate.sharafat@gmail.com', '2020-01-28 00:34:08');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('24', '27', NULL, '43.245.235.138', 'corporate.sharafat@gmail.com', '2020-01-29 02:26:18');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('25', '27', NULL, '43.245.235.138', 'corporate.sharafat@gmail.com', '2020-01-29 06:36:32');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('26', '27', NULL, '43.245.235.138', 'corporate.sharafat@gmail.com', '2020-01-29 10:13:30');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('27', '27', NULL, '43.245.235.138', 'corporate.sharafat@gmail.com', '2020-01-30 04:46:58');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('28', '27', NULL, '103.109.238.106', 'corporate.sharafat@gmail.com', '2020-01-31 06:18:31');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('29', '27', NULL, '103.109.238.106', 'corporate.sharafat@gmail.com', '2020-01-31 08:56:56');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('30', '27', NULL, '103.109.238.106', 'corporate.sharafat@gmail.com', '2020-02-02 02:10:41');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('31', '27', NULL, '103.109.238.106', 'corporate.sharafat@gmail.com', '2020-02-02 09:18:28');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('32', '27', NULL, '103.109.238.106', 'corporate.sharafat@gmail.com', '2020-02-03 09:47:12');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('33', '27', NULL, '103.109.238.106', 'corporate.sharafat@gmail.com', '2020-02-04 04:14:43');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('34', '27', NULL, '103.109.238.106', 'corporate.sharafat@gmail.com', '2020-02-05 05:20:29');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('35', '27', NULL, '103.109.238.106', 'corporate.sharafat@gmail.com', '2020-02-05 10:25:08');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('36', '27', NULL, '103.120.202.49', 'corporate.sharafat@gmail.com', '2020-02-06 02:45:19');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('37', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-02-08 05:46:08');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('38', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-02-10 02:00:42');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('39', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-02-10 07:47:02');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('40', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-02-12 08:52:43');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('41', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-02-12 09:27:26');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('42', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-02-13 03:48:36');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('43', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-02-13 09:15:35');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('44', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-02-15 01:31:18');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('45', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-02-16 03:06:16');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('46', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-02-18 04:56:23');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('47', '27', NULL, '202.84.40.123', 'corporate.sharafat@gmail.com', '2020-03-27 05:24:27');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('48', '27', NULL, '202.84.40.123', 'corporate.sharafat@gmail.com', '2020-03-27 11:29:06');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('49', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-07-20 03:13:56');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('50', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-07-20 03:17:57');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('51', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-07-20 05:25:49');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('52', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-07-20 23:52:52');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('53', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-07-26 07:30:53');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('54', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-07-27 05:14:21');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('55', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-07-29 04:07:07');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('56', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-07-29 08:57:03');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('57', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-07-29 23:37:35');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('58', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-07-30 02:15:29');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('59', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-08-09 01:55:56');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('60', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-09 05:49:22');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('61', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-08-09 06:19:08');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('62', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-08-09 08:53:54');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('63', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-09 08:57:44');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('64', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-08-09 23:56:59');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('65', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-10 02:46:53');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('66', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-11 01:36:57');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('67', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-08-11 03:52:15');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('68', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-11 07:06:44');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('69', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-08-11 07:12:02');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('70', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-11 08:40:55');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('71', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-11 08:53:55');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('72', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-12 05:40:27');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('73', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-08-12 07:17:15');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('74', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-08-12 09:59:02');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('75', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-08-12 23:47:24');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('76', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-13 01:38:28');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('77', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-13 05:03:05');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('78', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-08-13 05:51:59');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('79', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-08-16 05:35:14');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('80', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-08-16 05:41:05');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('81', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-16 05:54:23');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('82', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-17 06:33:46');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('83', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-08-17 08:46:23');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('84', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-17 23:25:04');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('85', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-08-18 01:13:52');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('86', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-18 05:05:35');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('87', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-18 23:40:52');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('88', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-19 05:24:06');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('89', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-08-19 05:39:40');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('90', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-20 03:11:47');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('91', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-08-20 03:52:41');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('92', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-20 08:53:47');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('93', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-08-21 06:25:44');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('94', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-22 08:14:59');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('95', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-23 03:25:16');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('96', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-23 06:01:13');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('97', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-08-23 10:36:33');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('98', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-24 04:52:32');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('99', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-08-24 07:09:24');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('100', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-08-25 02:09:27');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('101', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-26 02:50:07');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('102', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-26 08:04:00');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('103', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-08-26 09:49:51');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('104', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-27 05:53:12');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('105', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-27 09:24:16');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('106', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-08-27 10:08:04');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('107', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-08-28 04:33:14');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('108', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-29 02:23:06');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('109', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-08-29 06:55:48');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('110', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-08-29 10:00:55');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('111', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-30 00:03:38');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('112', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-08-30 02:10:42');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('113', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-30 04:39:00');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('114', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-08-30 07:08:29');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('115', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-30 08:13:04');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('116', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-30 09:28:27');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('117', '27', NULL, '202.84.40.123', 'corporate.sharafat@gmail.com', '2020-08-30 15:21:32');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('118', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-31 01:34:16');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('119', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-08-31 06:58:31');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('120', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-01 23:50:10');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('121', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-02 08:53:31');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('122', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-03 01:53:55');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('123', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-03 07:30:20');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('124', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-09-04 07:55:41');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('125', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-05 06:24:04');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('126', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-05 08:53:08');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('127', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-06 23:59:15');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('128', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-07 03:11:31');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('129', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-09-07 07:38:50');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('130', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-08 00:02:15');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('131', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-08 02:59:38');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('132', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-08 03:25:58');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('133', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-08 08:46:29');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('134', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-08 23:59:07');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('135', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-09 07:42:23');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('136', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-10 04:51:07');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('137', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-10 08:33:45');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('138', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-09-10 09:03:37');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('139', '27', NULL, '202.84.40.123', 'corporate.sharafat@gmail.com', '2020-09-11 16:35:39');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('140', '27', NULL, '202.84.40.123', 'corporate.sharafat@gmail.com', '2020-09-11 17:02:08');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('141', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-12 04:48:17');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('142', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-09-12 06:13:13');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('143', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-09-13 01:01:21');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('144', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-13 06:12:59');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('145', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-14 01:31:02');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('146', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-14 07:09:43');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('147', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-09-14 10:56:45');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('148', '27', NULL, '202.84.40.123', 'corporate.sharafat@gmail.com', '2020-09-14 14:46:00');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('149', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-14 23:36:15');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('150', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-15 05:15:17');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('151', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-15 23:49:04');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('152', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-16 04:37:56');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('153', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-16 07:09:07');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('154', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-17 05:32:44');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('155', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-09-17 07:21:43');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('156', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-17 09:21:50');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('157', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-18 23:55:24');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('158', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-19 08:38:43');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('159', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-20 00:44:03');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('160', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-20 04:07:08');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('161', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-20 08:53:27');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('162', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-22 06:18:47');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('163', '27', NULL, '27.147.202.233', 'corporate.sharafat@gmail.com', '2020-09-22 06:20:25');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('164', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-23 04:59:02');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('165', '27', NULL, '202.84.40.123', 'corporate.sharafat@gmail.com', '2020-09-23 10:23:22');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('166', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-24 02:36:39');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('167', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-09-24 04:25:46');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('168', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-24 08:17:17');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('169', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-09-25 02:32:11');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('170', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-09-25 03:31:36');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('171', '27', NULL, '202.84.40.123', 'corporate.sharafat@gmail.com', '2020-09-25 13:39:26');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('172', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-25 23:51:57');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('173', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-09-26 01:02:59');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('174', '27', NULL, '43.245.121.97', 'corporate.sharafat@gmail.com', '2020-09-26 07:40:40');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('175', '27', NULL, '43.245.121.97', 'corporate.sharafat@gmail.com', '2020-09-26 07:40:41');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('176', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-26 08:29:26');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('177', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-27 01:51:47');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('178', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-27 05:04:02');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('179', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-27 08:30:08');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('180', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-28 08:30:56');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('181', '27', NULL, '202.84.40.123', 'corporate.sharafat@gmail.com', '2020-09-28 23:19:57');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('182', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-29 04:26:38');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('183', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-30 04:49:59');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('184', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-09-30 05:25:15');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('185', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-09-30 05:44:50');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('186', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-01 00:04:56');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('187', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-10-01 04:09:16');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('188', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-01 05:19:24');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('189', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-10-01 08:14:36');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('190', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-01 08:26:00');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('191', '27', NULL, '202.84.40.123', 'corporate.sharafat@gmail.com', '2020-10-02 14:30:16');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('192', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-03 01:45:14');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('193', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-04 07:33:24');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('194', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-05 00:16:10');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('195', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-05 02:22:39');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('196', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-05 08:58:22');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('197', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-06 04:29:13');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('198', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-06 06:48:41');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('199', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-10-06 06:57:44');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('200', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-07 01:16:21');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('201', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-07 06:00:07');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('202', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-08 02:14:38');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('203', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-08 05:40:46');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('204', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-08 08:45:43');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('205', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-10-10 01:41:13');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('206', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-11 23:53:50');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('207', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-10-12 02:09:22');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('208', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-10-12 06:10:17');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('209', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-12 09:59:05');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('210', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-13 00:47:06');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('211', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-10-13 03:22:59');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('212', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-13 03:23:04');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('213', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-14 04:54:02');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('214', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-14 23:40:57');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('215', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-15 02:30:58');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('216', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-15 07:32:54');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('217', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-10-15 10:40:13');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('218', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-17 07:53:54');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('219', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-17 07:54:02');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('220', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-17 07:56:14');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('221', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-17 23:50:54');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('222', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-19 00:31:02');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('223', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-21 06:14:51');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('224', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-10-21 09:01:46');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('225', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-22 06:37:16');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('226', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-23 23:50:07');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('227', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-24 04:36:40');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('228', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-24 07:52:49');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('229', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-25 06:56:37');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('230', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-27 00:41:53');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('231', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-27 23:41:55');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('232', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-28 06:56:33');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('233', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-28 07:23:35');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('234', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-29 05:59:33');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('235', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-10-31 08:11:59');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('236', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-11-01 07:03:46');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('237', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-11-02 05:42:31');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('238', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-11-03 03:40:22');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('239', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-11-03 04:06:00');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('240', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-11-04 06:18:35');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('241', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-11-04 06:41:42');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('242', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-11-05 07:41:16');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('243', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-11-07 05:48:33');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('244', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-11-09 03:24:39');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('245', '27', NULL, '185.217.71.162', 'corporate.sharafat@gmail.com', '2020-11-09 05:46:25');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('246', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-11-11 04:18:03');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('247', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-11-11 07:41:24');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('248', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-11-12 06:54:58');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('249', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-11-13 22:41:27');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('250', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-11-14 07:56:00');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('251', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-11-16 03:11:33');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('252', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-11-17 06:52:23');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('253', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-11-17 23:16:17');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('254', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-11-18 07:59:09');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('255', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-11-18 08:03:33');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('256', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-11-19 09:29:23');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('257', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-11-21 07:59:26');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('258', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-11-22 00:09:35');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('259', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-11-23 07:45:28');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('260', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-11-25 04:05:45');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('261', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-11-25 04:24:09');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('262', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-11-26 06:58:32');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('263', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-11-28 00:29:49');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('264', '1', NULL, '42.0.6.231', 'wedothewebs@gmail.com', '2020-11-29 23:41:26');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('265', '1', NULL, '103.225.93.38', 'wedothewebs@gmail.com', '2020-11-29 23:47:12');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('266', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-11-30 09:34:36');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('267', '1', NULL, '103.60.175.137', 'wedothewebs@gmail.com', '2020-11-30 21:15:32');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('268', '1', NULL, '103.60.175.137', 'wedothewebs@gmail.com', '2020-11-30 21:16:27');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('269', '1', NULL, '42.0.6.248', 'wedothewebs@gmail.com', '2020-11-30 22:37:22');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('270', '1', NULL, '42.0.6.248', 'wedothewebs@gmail.com', '2020-11-30 23:04:27');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('271', '1', NULL, '42.0.6.248', 'wedothewebs@gmail.com', '2020-12-01 02:19:49');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('272', '1', NULL, '42.0.6.248', 'wedothewebs@gmail.com', '2020-12-01 02:23:31');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('273', '1', NULL, '103.225.93.38', 'wedothewebs@gmail.com', '2020-12-01 02:47:36');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('274', '1', NULL, '103.225.93.38', 'wedothewebs@gmail.com', '2020-12-01 02:55:26');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('275', '1', NULL, '42.0.5.233', 'wedothewebs@gmail.com', '2020-12-01 03:40:29');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('276', '27', NULL, '185.217.71.170', 'corporate.sharafat@gmail.com', '2020-12-01 04:28:58');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('277', '27', NULL, '185.217.71.170', 'corporate.sharafat@gmail.com', '2020-12-01 04:31:08');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('278', '27', NULL, '185.217.71.170', 'corporate.sharafat@gmail.com', '2020-12-01 04:39:43');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('279', '1', NULL, '42.0.5.233', 'wedothewebs@gmail.com', '2020-12-01 05:47:33');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('280', '27', NULL, '185.217.71.170', 'corporate.sharafat@gmail.com', '2020-12-01 06:32:12');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('281', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-12-01 06:46:12');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('282', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-12-02 01:29:17');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('283', '1', NULL, '103.91.229.182', 'wedothewebs@gmail.com', '2020-12-02 02:11:53');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('284', '1', NULL, '42.0.5.233', 'wedothewebs@gmail.com', '2020-12-02 02:29:19');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('285', '1', NULL, '42.0.4.240', 'wedothewebs@gmail.com', '2020-12-02 06:12:05');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('286', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-12-03 07:33:38');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('287', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-12-07 06:31:57');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('288', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-12-08 05:43:48');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('289', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-12-09 03:26:11');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('290', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-12-09 06:17:06');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('291', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-12-10 02:07:36');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('292', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-12-10 06:42:38');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('293', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-12-11 23:35:56');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('294', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-12-12 07:44:29');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('295', '27', NULL, '103.239.252.209', 'corporate.sharafat@gmail.com', '2020-12-13 05:04:56');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('296', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-12-13 05:16:38');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('297', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-12-13 06:58:09');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('298', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-12-14 07:12:57');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('299', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-12-15 02:05:18');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('300', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-12-17 07:44:55');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('301', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-12-19 04:17:19');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('302', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-12-19 06:38:32');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('303', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-12-20 04:46:07');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('304', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-12-21 04:26:06');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('305', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-12-22 03:12:23');
INSERT INTO `tec_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES ('306', '34', NULL, '103.239.252.209', 'cctbangladesh@cct.com.bd', '2020-12-23 04:52:52');


#
# TABLE STRUCTURE FOR: tec_users
#

DROP TABLE IF EXISTS `tec_users`;

CREATE TABLE `tec_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `last_ip_address` varbinary(45) DEFAULT NULL,
  `ip_address` varbinary(45) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `avatar` varchar(55) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `group_id` int(11) unsigned NOT NULL DEFAULT '2',
  `store_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

INSERT INTO `tec_users` (`id`, `last_ip_address`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `avatar`, `gender`, `group_id`, `store_id`) VALUES ('1', '42.0.4.240', '127.0.0.1', 'admin', '71820aec2f0cbfe7229b8c726871fd8c0f105ae1', NULL, 'wedothewebs@gmail.com', NULL, NULL, NULL, NULL, '1435204774', '1606911125', '1', 'it', 'admin', 'Electrolife', '+88018XXXXXXXX', NULL, 'male', '1', '0');
INSERT INTO `tec_users` (`id`, `last_ip_address`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `avatar`, `gender`, `group_id`, `store_id`) VALUES ('27', '103.239.252.209', '103.105.93.70', 'sharafat', 'c1b535bcb6c3a1e06523f9ec10efc8143400153c', NULL, 'corporate.sharafat@gmail.com', NULL, '500e93c72def3a4d35161e2dc084dfa333dd3083', '1585234096', NULL, '1525955873', '1607857496', '1', 'S. M. MAHMUD', 'SHARAFAT', NULL, '01915799982', NULL, 'male', '1', '0');
INSERT INTO `tec_users` (`id`, `last_ip_address`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `avatar`, `gender`, `group_id`, `store_id`) VALUES ('31', '43.245.235.138', '103.105.93.69', 'teh', '861892180fb8ad811356b8a63414df2dcc985c26', NULL, 'theelectrohousebd@gmail.com', NULL, NULL, NULL, NULL, '1533213542', '1578309759', '1', 'THE ELECTRO', 'HOUSE', NULL, '01906121121', NULL, 'male', '2', '1');
INSERT INTO `tec_users` (`id`, `last_ip_address`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `avatar`, `gender`, `group_id`, `store_id`) VALUES ('33', '103.120.202.49', '103.120.202.49', 'mazid', 'c70d497506e8c9d4dc2b303bc9474ebc297e3dbe', NULL, 'mazid@wedothewebs.com', NULL, NULL, NULL, NULL, '1554121042', '1554121072', '1', 'Test', 'Manger', NULL, '01821915511', NULL, 'male', '2', '1');
INSERT INTO `tec_users` (`id`, `last_ip_address`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `avatar`, `gender`, `group_id`, `store_id`) VALUES ('34', '103.239.252.209', '43.245.235.138', 'cctbangladesh', 'ac472d8ee8de63375bbf7991c6515db2a04610d8', NULL, 'cctbangladesh@cct.com.bd', NULL, NULL, NULL, NULL, '1580301929', '1608720772', '1', 'CREATIVE CITY', 'TECHNOLOGIES', NULL, '9634223', NULL, 'male', '2', '1');



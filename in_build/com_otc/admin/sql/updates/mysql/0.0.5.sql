CREATE TABLE IF NOT EXISTS `#__otc_buy_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyid` int(11) NOT NULL,
  `memberid` int(11) NOT NULL,
  `num_shares` int(5) NOT NULL,
  `share_price` int(5) NOT NULL,
  `bidding_price` int(5) NOT NULL,
  `security_tax` int(5) NOT NULL,
  `transaction_fee` int(5) NOT NULL DEFAULT 0,
  `confirmed` int(1) NOT NULL DEFAULT 0,
  `pending` int(1) NOT NULL DEFAULT 1,
  `expiry_date` DATE NOT NULL,
  `ts` timestamp NOT NULL default CURRENT_TIMESTAMP,
   PRIMARY KEY  (`id`),
   FOREIGN KEY (`companyid`) REFERENCES `#__otc_companies`(`id`),
   FOREIGN KEY (`memberid`) REFERENCES `#__otc_members`(`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__otc_sell_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyid` int(11) NOT NULL,
  `memberid` int(11) NOT NULL,
  `num_shares` int(5) NOT NULL,
  `selling_price` int(5) NOT NULL,
  `security_tax` int(5) NOT NULL DEFAULT 0,
  `transaction_fee` int(5) NOT NULL,
  `confirmed` int(1) NOT NULL DEFAULT 0,
  `pending` int(1) NOT NULL DEFAULT 1,
  `is_reimbursed` tinyint(1) NOT NULL DEFAULT '0',
  `expiry_date` DATE NOT NULL,
  `ts` timestamp NOT NULL default CURRENT_TIMESTAMP,
   PRIMARY KEY  (`id`),
   FOREIGN KEY (`companyid`) REFERENCES `#__otc_companies`(`id`),
   FOREIGN KEY (`memberid`) REFERENCES `#__otc_members`(`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__otc_planning` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `memberid` int(11) NOT NULL,
  `companyid` int(11) NOT NULL,
  `num_shares` int(7) NOT NULL,
  `when_to_purchase` date NOT NULL,
  `is_email_sent` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;


CREATE TABLE IF NOT EXISTS `#__otc_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `memberid` int(11) NOT NULL,
  `tnx_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `error_code` varchar(50) NOT NULL,
  `seller_email` varchar(200) NOT NULL,
  `buyer_ref` varchar(50) NOT NULL,
  `buyer_uname` varchar(255) NOT NULL,
  `buyer_title` varchar(10) NOT NULL,
  `buyer_fname` varchar(200) NOT NULL,
  `buyer_lname` varchar(200) NOT NULL,
  `buyer_email` varchar(255) NOT NULL,
  `buyer_street1` varchar(255) NOT NULL,
  `buyer_street2` varchar(255) NOT NULL,
  `buyer_city` varchar(255) NOT NULL,
  `buyer_state` varchar(150) NOT NULL,
  `buyer_zip` varchar(100) NOT NULL,
  `buyer_country` varchar(150) NOT NULL,
  `buyer_cnumber` varchar(200) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `currency` varchar(50) NOT NULL,
  `tnx_id` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tnx_id` (`tnx_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;
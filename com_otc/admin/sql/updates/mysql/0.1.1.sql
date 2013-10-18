CREATE TABLE IF NOT EXISTS `#__otc_processed_sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `buy_tr_id` int(11) NOT NULL,
  `sell_tr_id` int(11) NOT NULL,
  `num_shares` int(7) NOT NULL,
  `share_price` int(5) NOT NULL,
  `ts` timestamp NOT NULL default CURRENT_TIMESTAMP,
   PRIMARY KEY  (`id`),
   FOREIGN KEY (`buy_tr_id`) REFERENCES `#__otc_buy_transactions`(`id`),
   FOREIGN KEY (`sell_tr_id`) REFERENCES `#__otc_sell_transactions`(`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__otc_shares` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyid` int(11) NOT NULL,
  `memberid` int(11) NOT NULL,
  `num_shares` int(7) NOT NULL,
  `last_update` timestamp NOT NULL default CURRENT_TIMESTAMP,
   PRIMARY KEY  (`id`),
   FOREIGN KEY (`companyid`) REFERENCES `#__otc_companies`(`id`),
   FOREIGN KEY (`memberid`) REFERENCES `#__otc_members`(`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
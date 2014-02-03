CREATE TABLE IF NOT EXISTS `#__otc_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `memberid` int(11) NOT NULL,
  `account_id` int(13) NOT NULL,
  `created_by` int(11) NOT NULL, 
  `amount` int(7) NOT NULL,
  `transaction_type` varchar(8) NOT NULL,
  `ts` timestamp NOT NULL default CURRENT_TIMESTAMP,
   PRIMARY KEY  (`id`),
   FOREIGN KEY (`created_by`) REFERENCES `#__users`(`id`),
   FOREIGN KEY (`memberid`) REFERENCES `#__otc_members`(`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
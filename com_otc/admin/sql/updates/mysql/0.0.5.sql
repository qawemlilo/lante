ALTER TABLE `#__otc_companies`ADD COLUMN `available_shares` int(11) NOT NULL DEFAULT 0;CREATE TABLE IF NOT EXISTS `#__otc_shares_transactions` (  `id` int(11) NOT NULL AUTO_INCREMENT,  `created_by` int(11) NOT NULL,  `owner_name` varchar(128) NOT NULL default '',  `cell_number` int(10) NOT NULL default 0,  `email` varchar(128) NOT NULL default '',  `ts` timestamp NOT NULL default CURRENT_TIMESTAMP,   PRIMARY KEY  (`id`),   FOREIGN KEY (`created_by`) REFERENCES `#__users`(`id`)) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
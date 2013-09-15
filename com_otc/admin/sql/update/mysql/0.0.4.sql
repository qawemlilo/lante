CREATE TABLE IF NOT EXISTS `#__otc_companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ownerid` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `name` varchar(128) NOT NULL default '',
  `website` varchar(164) NOT NULL default '',
  `about` varchar(200) NOT NULL default '',
  `share_price` int(5) NOT NULL,
  `ts` timestamp NOT NULL default CURRENT_TIMESTAMP,
   PRIMARY KEY  (`id`),
   FOREIGN KEY (`created_by`) REFERENCES `#__users`(`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__otc_owners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by` int(11) NOT NULL,
  `owner_name` varchar(128) NOT NULL default '',
  `cell_number` int(10) NOT NULL default 0,
  `email` varchar(128) NOT NULL default '',
  `ts` timestamp NOT NULL default CURRENT_TIMESTAMP,
   PRIMARY KEY  (`id`),
   FOREIGN KEY (`created_by`) REFERENCES `#__users`(`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
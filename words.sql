CREATE TABLE IF NOT EXISTS `words` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `word` varchar(32) NOT NULL DEFAULT '',
  `trans_word` varchar(128) NOT NULL DEFAULT '',
  `phrase` text NOT NULL,
  `trans_phrase` text NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


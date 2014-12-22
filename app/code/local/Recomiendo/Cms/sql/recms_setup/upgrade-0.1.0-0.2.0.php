<?php

$installer = $this;

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS {$this->getTable('recomiendo_homepage_basket_cell')};
CREATE TABLE {$this->getTable('recomiendo_homepage_basket_cell')} (
  `basket_cell_id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `headline` text NULL default '',
  `slogan` varchar(255) NULL default '',
  `url` varchar(255) NULL default '',
  `filename` varchar(255) NOT NULL default '',
  `position` int(11) NOT NULL default '0',
  `status` smallint(6) NOT NULL default '0',
  `cell_type` smallint(6) NOT NULL default '0',
  `created_at` datetime NULL,
  `update_at` datetime NULL,
  PRIMARY KEY (`basket_cell_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

$installer->endSetup();

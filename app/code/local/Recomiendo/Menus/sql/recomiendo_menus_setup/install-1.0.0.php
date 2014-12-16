<?php
/**
 * Adding product relationships installation script
 *
 * @author Hector Luis Barrientos Margolles
 */

/**
 * @var $installer Mage_Core_Model_Resource_Setup
 */
$installer = $this;
/**
 * Create table 'recomiendo_product_recipe'
 */

$installer->run("

  -- DROP TABLE IF EXISTS `{$installer->getTable('recomiendo_menus/relation_menu_recipe')}`;
CREATE TABLE `{$installer->getTable('recomiendo_menus/relation_menu_recipe')}` (
  `menu_recipe_id` int(11) NOT NULL auto_increment,
  `entity_id` smallint(8) unsigned NOT NULL default '0',
  `recipe_id` smallint(5) unsigned NOT NULL default '0',
  `is_lunch` tinyint(1) NOT NULL DEFAULT '1',
  `position` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY  (`menu_recipe_id`),
  KEY `FK_{$installer->getTable('catalog/product')}_r_p_r` (`entity_id`),
  KEY `FK_{$installer->getTable('recomiendo_recipes/recipe')}_r_p_r` (`recipe_id`),
  CONSTRAINT `FK_{$installer->getTable('catalog/product')}_r_p_r`
  FOREIGN KEY (`entity_id`) REFERENCES `{$installer->getTable('catalog/product')}` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_{$installer->getTable('recomiendo_recipes/recipe')}_r_p_r`
  FOREIGN KEY (`recipe_id`) REFERENCES `{$installer->getTable('recomiendo_recipes/recipe')}` (`recipe_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

?>

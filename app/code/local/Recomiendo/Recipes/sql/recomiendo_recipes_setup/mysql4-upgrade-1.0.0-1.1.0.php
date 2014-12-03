<?php
/**
 * Adding relationships installation script
 *
 * @author Hector Luis Barrientos Margolles
 */

/**
 * @var $installer Mage_Core_Model_Resource_Setup
 */
$installer = $this;

/**
 * Create table 'recomiendo_ingredient_type_ingredient'
 */

$installer->run("

-- DROP TABLE IF EXISTS `{$installer->getTable('recomiendo_recipes/relation_provider_ingredient')}`;
CREATE TABLE `{$installer->getTable('recomiendo_recipes/relation_provider_ingredient')}` (
  `provider_ingredient_id` int(11) NOT NULL auto_increment,
  `ingredient_id` smallint(8) unsigned NOT NULL default '0',
  `provider_id` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`provider_ingredient_id`),
  KEY `FK_{$installer->getTable('recomiendo_recipes/codifier_ingredient')}_r_p_i` (`ingredient_id`),
  KEY `FK_{$installer->getTable('recomiendo_recipes/codifier_provider')}_r_p_i` (`provider_id`),
  CONSTRAINT `FK_{$installer->getTable('recomiendo_recipes/codifier_ingredient')}_r_p_i`
  FOREIGN KEY (`ingredient_id`) REFERENCES `{$installer->getTable('recomiendo_recipes/codifier_ingredient')}` (`ingredient_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_{$installer->getTable('recomiendo_recipes/codifier_provider')}_r_p_i`
  FOREIGN KEY (`provider_id`) REFERENCES `{$installer->getTable('recomiendo_recipes/codifier_provider')}` (`provider_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `{$installer->getTable('recomiendo_recipes/relation_ingredienttype_ingredient')}`;
CREATE TABLE `{$installer->getTable('recomiendo_recipes/relation_ingredienttype_ingredient')}` (
  `ingredienttype_ingredient_id` int(11) NOT NULL auto_increment,
  `ingredienttype_id` smallint(5) unsigned NOT NULL default '0',
  `ingredient_id` smallint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`ingredienttype_ingredient_id`),
  KEY `FK_{$installer->getTable('recomiendo_recipes/codifier_ingredient')}_r_i_i` (`ingredient_id`),
  KEY `FK_{$installer->getTable('recomiendo_recipes/codifier_ingredienttype')}_r_i_i` (`ingredienttype_id`),
  CONSTRAINT `FK_{$installer->getTable('recomiendo_recipes/codifier_ingredient')}_r_i_i`
  FOREIGN KEY (`ingredient_id`) REFERENCES `{$installer->getTable('recomiendo_recipes/codifier_ingredient')}` (`ingredient_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_{$installer->getTable('recomiendo_recipes/codifier_ingredienttype')}_r_i_i`
  FOREIGN KEY (`ingredienttype_id`) REFERENCES `{$installer->getTable('recomiendo_recipes/codifier_ingredienttype')}` (`ingredienttype_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `{$installer->getTable('recomiendo_recipes/relation_recipe_ingredient')}`;
CREATE TABLE `{$installer->getTable('recomiendo_recipes/relation_recipe_ingredient')}` (
  `recipe_ingredient_id` int(11) NOT NULL auto_increment,
  `ingredient_id` smallint(5) unsigned NOT NULL default '0',
  `recipe_id` smallint(8) unsigned NOT NULL default '0',
  `measure_one_person` decimal(10,1) NOT NULL,
  `measure_two_persons` decimal(10,1) NOT NULL,
  `measure_three_persons` decimal(10,1) NOT NULL,
  `measure_four_persons` decimal(10,1) NOT NULL,
  `measure_unit` varchar(20) NOT NULL,
  `frontend_label` varchar(255) NOT NULL,
  PRIMARY KEY  (`recipe_ingredient_id`),
  KEY `FK_{$installer->getTable('recomiendo_recipes/codifier_ingredient')}_r_r_i` (`ingredient_id`),
  KEY `FK_{$installer->getTable('recomiendo_recipes/recipe')}_r_r_i` (`recipe_id`),
  CONSTRAINT `FK_{$installer->getTable('recomiendo_recipes/codifier_ingredient')}_r_r_i`
  FOREIGN KEY (`ingredient_id`) REFERENCES `{$installer->getTable('recomiendo_recipes/codifier_ingredient')}` (`ingredient_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_{$installer->getTable('recomiendo_recipes/recipe')}_r_r_i`
  FOREIGN KEY (`recipe_id`) REFERENCES `{$installer->getTable('recomiendo_recipes/recipe')}` (`recipe_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `{$installer->getTable('recomiendo_recipes/relation_recipe_util')}`;
CREATE TABLE `{$installer->getTable('recomiendo_recipes/relation_recipe_util')}` (
  `recipe_util_id` int(11) NOT NULL auto_increment,
  `recipe_id` smallint(5) unsigned NOT NULL default '0',
  `util_id` smallint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`recipe_util_id`),
  KEY `FK_{$installer->getTable('recomiendo_recipes/recipe')}_r_r_u` (`recipe_id`),
  KEY `FK_{$installer->getTable('recomiendo_recipes/codifier_util')}_r_r_u` (`util_id`),
  CONSTRAINT `FK_{$installer->getTable('recomiendo_recipes/recipe')}_r_r_u`
  FOREIGN KEY (`recipe_id`) REFERENCES `{$installer->getTable('recomiendo_recipes/recipe')}` (`recipe_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_{$installer->getTable('recomiendo_recipes/codifier_util')}_r_r_u`
  FOREIGN KEY (`util_id`) REFERENCES `{$installer->getTable('recomiendo_recipes/codifier_util')}` (`util_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `{$installer->getTable('recomiendo_recipes/relation_recipe_recipetype')}`;
CREATE TABLE `{$installer->getTable('recomiendo_recipes/relation_recipe_recipetype')}` (
  `recipe_recipetype_id` int(11) NOT NULL auto_increment,
  `recipetype_id` smallint(8) unsigned NOT NULL default '0',
  `recipe_id` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`recipe_recipetype_id`),
  KEY `FK_{$installer->getTable('recomiendo_recipes/codifier_recipetype')}_r_r_r` (`recipetype_id`),
  KEY `FK_{$installer->getTable('recomiendo_recipes/recipe')}_r_r_r` (`recipe_id`),
  CONSTRAINT `FK_{$installer->getTable('recomiendo_recipes/codifier_recipetype')}_r_r_r`
  FOREIGN KEY (`recipetype_id`) REFERENCES `{$installer->getTable('recomiendo_recipes/codifier_recipetype')}` (`recipetype_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_{$installer->getTable('recomiendo_recipes/recipe')}_r_r_r`
  FOREIGN KEY (`recipe_id`) REFERENCES `{$installer->getTable('recomiendo_recipes/recipe')}` (`recipe_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `{$installer->getTable('recomiendo_recipes/relation_recipe_socialgroup')}`;
CREATE TABLE `{$installer->getTable('recomiendo_recipes/relation_recipe_socialgroup')}` (
  `recipe_socialgroup_id` int(11) NOT NULL auto_increment,
  `recipe_id` smallint(5) unsigned NOT NULL default '0',
  `socialgroup_id` smallint(8) unsigned NOT NULL default '0',
  PRIMARY KEY (`recipe_socialgroup_id`),
  KEY `FK_{$installer->getTable('recomiendo_recipes/recipe')}_r_r_s` (`recipe_id`),
  KEY `FK_{$installer->getTable('recomiendo_recipes/codifier_socialgroup')}_r_r_s` (`socialgroup_id`),
  CONSTRAINT `FK_{$installer->getTable('recomiendo_recipes/recipe')}_r_r_s`
  FOREIGN KEY (`recipe_id`) REFERENCES `{$installer->getTable('recomiendo_recipes/recipe')}` (`recipe_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_{$installer->getTable('recomiendo_recipes/codifier_socialgroup')}_r_r_s`
  FOREIGN KEY (`socialgroup_id`) REFERENCES `{$installer->getTable('recomiendo_recipes/codifier_socialgroup')}` (`socialgroup_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

?>

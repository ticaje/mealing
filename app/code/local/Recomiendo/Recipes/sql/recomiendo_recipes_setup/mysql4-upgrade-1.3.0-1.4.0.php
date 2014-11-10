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

-- DROP TABLE IF EXISTS `{$installer->getTable('recomiendo_recipes/relation_traceability_ingredient')}`;
CREATE TABLE `{$installer->getTable('recomiendo_recipes/relation_traceability_ingredient')}` (
  `traceability_ingredient_id` int(11) NOT NULL auto_increment,
  `ingredient_id` smallint(8) unsigned NOT NULL default '0',
  `traceability_id` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`traceability_ingredient_id`),
  KEY `FK_{$installer->getTable('recomiendo_recipes/codifier_ingredient')}_r_t_i` (`ingredient_id`),
  KEY `FK_{$installer->getTable('recomiendo_recipes/codifier_traceability')}_r_t_i` (`traceability_id`),
  CONSTRAINT `FK_{$installer->getTable('recomiendo_recipes/codifier_ingredient')}_r_t_i`
  FOREIGN KEY (`ingredient_id`) REFERENCES `{$installer->getTable('recomiendo_recipes/codifier_ingredient')}` (`ingredient_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_{$installer->getTable('recomiendo_recipes/codifier_traceability')}_r_t_i`
  FOREIGN KEY (`traceability_id`) REFERENCES `{$installer->getTable('recomiendo_recipes/codifier_traceability')}` (`traceability_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


");

?>

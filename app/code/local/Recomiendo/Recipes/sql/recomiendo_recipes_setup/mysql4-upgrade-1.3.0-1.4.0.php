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
  `stock_number` varchar(255) NOT NULL,
  `expires_on` datetime NOT NULL,
  `operations` text NOT NULL,
  PRIMARY KEY  (`traceability_ingredient_id`),
  KEY `FK_{$installer->getTable('recomiendo_recipes/codifier_ingredient')}_r_t_i` (`ingredient_id`),
  KEY `FK_{$installer->getTable('recomiendo_recipes/codifier_traceability')}_r_t_i` (`traceability_id`),
  CONSTRAINT `FK_{$installer->getTable('recomiendo_recipes/codifier_ingredient')}_r_t_i`
  FOREIGN KEY (`ingredient_id`) REFERENCES `{$installer->getTable('recomiendo_recipes/codifier_ingredient')}` (`ingredient_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_{$installer->getTable('recomiendo_recipes/codifier_traceability')}_r_t_i`
  FOREIGN KEY (`traceability_id`) REFERENCES `{$installer->getTable('recomiendo_recipes/codifier_traceability')}` (`traceability_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


");

/**
 * Create table 'recomiendo_recipes/relation_recipe_image'
 */
$table = $installer->getConnection()
  ->newTable($installer->getTable('recomiendo_recipes/relation_recipe_image'))
  ->addColumn('recipe_image_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'identity'  => true,
    'unsigned'  => true,
    'nullable'  => false,
    'primary'   => true,
  ), 'Id')
  ->addColumn('recipe_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'unsigned'  => true,
    'nullable'  => false,
    'default'   => '0',
  ), 'Recipe Id')
  ->addColumn('image_path', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
  ), 'Image Path')
  ->addColumn('label', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
  ), 'Image Label')
  ->addIndex($installer->getIdxName('recomiendo_recipes/relation_recipe_image', array('recipe_id')),
    array('recipe_id'))
    ->addForeignKey($installer->getFkName('recomiendo_recipes/relation_recipe_image', 'recipe_id', 'recomiendo_recipes/recipe', 'recipe_id'),
      'recipe_id', $installer->getTable('recomiendo_recipes/recipe'), 'recipe_id',
      Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
      ->setComment('Recipe as foreign key');

$installer->getConnection()->createTable($table);
?>

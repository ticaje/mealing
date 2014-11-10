<?php
/**
 * Recipes installation script
 *
 * @author Hector Luis Barrientos Margolles
 */

/**
 * @var $installer Mage_Core_Model_Resource_Setup
 */
$installer = $this;
/**
 * Create table 'recomiendo_recipe_classification'
 */
$table = $installer->getConnection()
  ->newTable($installer->getTable('recomiendo_recipes/codifier_rclassification'))
  ->addColumn('recipe_classification_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'identity'  => true,
    'unsigned'  => true,
    'nullable'  => false,
    'primary'   => true,
  ), 'Recipe Classification Id')
  ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
  ), 'Name');

$installer->getConnection()->createTable($table);

?>

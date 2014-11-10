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
 * Create table 'recomiendo_shipping_rule_hourbelt'
 */
$table = $installer->getConnection()
  ->newTable($installer->getTable('recomiendo_recipes/hourbelt_rule'))
  ->addColumn('shipping_hourbelt_rule_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'identity'  => true,
    'unsigned'  => true,
    'nullable'  => false,
    'primary'   => true,
  ), 'Shipping rule hour belt Id')
  ->addColumn('hourbelt_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'unsigned'  => true,
    'nullable'  => false,
    'default'   => '0',
  ), 'Hour belt Id')
  ->addColumn('quantity', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
  ), 'Quantity')
  ->addColumn('price', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,2', array(
  ), 'Price')
  ->addColumn('order', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
  ), 'Order')
  ->addIndex($installer->getIdxName('recomiendo_recipes/hourbelt_rule', array('hourbelt_id')),
    array('hourbelt_id'))
    ->addForeignKey($installer->getFkName('recomiendo_recipes/hourbelt_rule', 'hourbelt_id', 'recomiendo_recipes/hourbelt', 'hourbelt_id'),
      'hourbelt_id', $installer->getTable('recomiendo_recipes/hourbelt'), 'hourbelt_id',
      Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
      ->setComment('Hour belt as foreign key');

$installer->getConnection()->createTable($table);

?>

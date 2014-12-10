<?php
/**
 * Menus price rules installation script
 *
 * @author Hector Luis Barrientos Margolles
 */

/**
 * @var $installer Mage_Core_Model_Resource_Setup
 */
$installer = $this;


/**
 * Create table 'recomiendo_menus_rule_set'
 */
$table = $installer->getConnection()
  ->newTable($installer->getTable('recomiendo_menus/rule_set'))
  ->addColumn('rule_set_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'identity'  => true,
    'unsigned'  => true,
    'nullable'  => false,
    'primary'   => true,
  ), 'Rule Set Id')
  ->addColumn('dishes_set', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
  ), 'Dishes Set')
  ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
  ), 'Name');


$installer->getConnection()->createTable($table);

/**
 * Create table 'recomiendo_menus_prices_group'
 */
$table = $installer->getConnection()
  ->newTable($installer->getTable('recomiendo_menus/price_group'))
  ->addColumn('price_group_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'identity'  => true,
    'unsigned'  => true,
    'nullable'  => false,
    'primary'   => true,
  ), 'Price Group Id')
  ->addColumn('rule_set_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'unsigned'  => true,
    'nullable'  => false,
    'default'   => '0',
  ), 'Rule Set Id')
  ->addColumn('price', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,2', array(
  ), 'Normal Price')
  ->addColumn('price_club', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,2', array(
  ), 'Club Recomiendo Price')
  ->addIndex($installer->getIdxName('recomiendo_menus/price_group', array('rule_set_id')),
    array('rule_set_id'))
    ->addForeignKey($installer->getFkName('recomiendo_menus/price_group', 'rule_set_id', 'recomiendo_menus/rule_set', 'rule_set_id'),
      'rule_set_id', $installer->getTable('recomiendo_menus/rule_set'), 'rule_set_id',
      Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
      ->setComment('Rule Set as foreign key');

$installer->getConnection()->createTable($table);

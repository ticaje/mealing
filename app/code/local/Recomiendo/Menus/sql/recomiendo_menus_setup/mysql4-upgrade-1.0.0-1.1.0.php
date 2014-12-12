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
  ->addColumn('price_formula_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'unsigned'  => true,
    'nullable'  => false,
    'default'   => '0',
  ), 'Price Formula Id')
  ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
  ), 'Name');


$installer->getConnection()->createTable($table);

/**
 * Create table 'recomiendo_menus_prices_group'
 */
$table = $installer->getConnection()
  ->newTable($installer->getTable('recomiendo_menus/rule_group'))
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
  ->addColumn('persons', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'unique'    => true,
  ), 'Number of Persons')
  ->addColumn('price_recipes_three', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,2', array(
  ), 'Price Three Recipes')
  ->addColumn('price_club_recipes_three', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,2', array(
  ), 'Club Recomiendo Price Three Recipes')
  ->addColumn('price_recipes_five', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,2', array(
  ), 'Price Five Recipes')
  ->addColumn('price_club_recipes_five', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,2', array(
  ), 'Club Recomiendo Price Five Recipes')
  ->addColumn('price_recipes_six', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,2', array(
  ), 'Price Six Recipes')
  ->addColumn('price_club_recipes_six', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,2', array(
  ), 'Club Recomiendo Price Six Recipes')
  ->addColumn('price_recipes_seven', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,2', array(
  ), 'Price Seven Recipes')
  ->addColumn('price_club_recipes_seven', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,2', array(
  ), 'Club Recomiendo Price Seven Recipes')
  ->addColumn('price_recipes_eight', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,2', array(
  ), 'Price Eight Recipes')
  ->addColumn('price_club_recipes_eight', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,2', array(
  ), 'Club Recomiendo Price Eight Recipes')
  ->addColumn('price_recipes_Ten', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,2', array(
  ), 'Price Ten Recipes')
  ->addColumn('price_club_recipes_ten', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,2', array(
  ), 'Club Recomiendo Price Ten Recipes')
  ->addColumn('price_recipes_twelve', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,2', array(
  ), 'Price Twelve Recipes')
  ->addColumn('price_club_recipes_twelve', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,2', array(
  ), 'Club Recomiendo Price Twelve Recipes')
  ->addColumn('price_recipes_fourteen', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,2', array(
  ), 'Price Fourteen Recipes')
  ->addColumn('price_club_recipes_fourteen', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,2', array(
  ), 'Club Recomiendo Price Fourteen Recipes')
  ->addIndex($installer->getIdxName('recomiendo_menus/rule_group', array('rule_set_id')),
    array('rule_set_id'))
    ->addForeignKey($installer->getFkName('recomiendo_menus/rule_group', 'rule_set_id', 'recomiendo_menus/rule_set', 'rule_set_id'),
      'rule_set_id', $installer->getTable('recomiendo_menus/rule_set'), 'rule_set_id',
      Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
      ->setComment('Rule Set as foreign key');

$installer->getConnection()->createTable($table);


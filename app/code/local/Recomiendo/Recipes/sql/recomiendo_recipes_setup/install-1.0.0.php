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
 * Creating table 'recomiendo_recipes'
 */
$table = $installer->getConnection()
  ->newTable($installer->getTable('recomiendo_recipes/recipe'))
  ->addColumn('recipe_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'unsigned' => true,
    'identity' => true,
    'nullable' => false,
    'primary'  => true,
  ), 'Recipe Id')
  ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    'nullable' => true,
  ), 'Name')
  ->addColumn('time', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'nullable' => true,
  ), 'Time in Minutes')
  ->addColumn('user_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'unsigned'  => true,
    'nullable'  => false,
    'default'   => '0',
  ), 'Creator Id')
  ->addColumn('published_at', Varien_Db_Ddl_Table::TYPE_DATE, null, array(
    'nullable' => true,
    'default'  => null,
  ), 'World publish date')
  ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
    'nullable' => true,
    'default'  => null,
  ), 'Creation Time')
  ->addIndex($installer->getIdxName('recomiendo_recipes/recipe', array('user_id')),
    array('user_id'))
    ->addForeignKey($installer->getFkName('recomiendo_recipes/recipe', 'user_id', 'admin/user', 'user_id'),
      'user_id', $installer->getTable('admin/user'), 'user_id',
      Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
      ->setComment('System\'s User as foreign key');
  ->addIndex($installer->getIdxName(
    $installer->getTable('recomiendo_recipes/recipe'),
    array('published_at'),
    Varien_Db_Adapter_Interface::INDEX_TYPE_INDEX
  ),
  array('published_at'),
  array('type' => Varien_Db_Adapter_Interface::INDEX_TYPE_INDEX)
)
->setComment('Recipe');

$installer->getConnection()->createTable($table);

/**
 * Create table 'recomiendo_recipe_preparing_step'
 */
$table = $installer->getConnection()
  ->newTable($installer->getTable('recomiendo_recipes/recipe_pstep'))
  ->addColumn('pstep_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'identity'  => true,
    'unsigned'  => true,
    'nullable'  => false,
    'primary'   => true,
  ), 'Preparing Step Id')
  ->addColumn('recipe_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'unsigned'  => true,
    'nullable'  => false,
    'default'   => '0',
  ), 'Recipe Id')
  ->addColumn('order', Varien_Db_Ddl_Table::TYPE_INTEGER, 3, array(
  ), 'Preparing Step Order')
  ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
  ), 'Preparing Step Name')
  ->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
  ), 'Preparing Step Content')
  ->addIndex($installer->getIdxName('recomiendo_recipes/recipe_pstep', array('recipe_id')),
    array('recipe_id'))
    ->addForeignKey($installer->getFkName('recomiendo_recipes/recipe_pstep', 'recipe_id', 'recomiendo_recipes/recipe', 'recipe_id'),
      'recipe_id', $installer->getTable('recomiendo_recipes/recipe'), 'recipe_id',
      Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
      ->setComment('Recipe as foreign key');

$installer->getConnection()->createTable($table);

/**
 * Create table 'recomiendo_recipe_elaboration_step'
 */
$table = $installer->getConnection()
  ->newTable($installer->getTable('recomiendo_recipes/recipe_estep'))
  ->addColumn('estep_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'identity'  => true,
    'unsigned'  => true,
    'nullable'  => false,
    'primary'   => true,
  ), 'Elaboration Step Id')
  ->addColumn('recipe_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'unsigned'  => true,
    'nullable'  => false,
    'default'   => '0',
  ), 'Recipe Id')
  ->addColumn('order', Varien_Db_Ddl_Table::TYPE_INTEGER, 3, array(
  ), 'Elaboration Step Order')
  ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
  ), 'Elaboration Step Name')
  ->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
  ), 'Elaboration Step Content')
  ->addIndex($installer->getIdxName('recomiendo_recipes/recipe_estep', array('recipe_id')),
    array('recipe_id'))
    ->addForeignKey($installer->getFkName('recomiendo_recipes/recipe_estep', 'recipe_id', 'recomiendo_recipes/recipe', 'recipe_id'),
      'recipe_id', $installer->getTable('recomiendo_recipes/recipe'), 'recipe_id',
      Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
      ->setComment('Recipe as foreign key');

$installer->getConnection()->createTable($table);

/**
 * Create table 'recomiendo_recipe_presentation_step'
 */
$table = $installer->getConnection()
  ->newTable($installer->getTable('recomiendo_recipes/recipe_sstep'))
  ->addColumn('sstep_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'identity'  => true,
    'unsigned'  => true,
    'nullable'  => false,
    'primary'   => true,
  ), 'Showing Step Id')
  ->addColumn('recipe_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'unsigned'  => true,
    'nullable'  => false,
    'default'   => '0',
  ), 'Recipe Id')
  ->addColumn('order', Varien_Db_Ddl_Table::TYPE_INTEGER, 3, array(
  ), 'Presentation Step Order')
  ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
  ), 'Presentation Step Name')
  ->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
  ), 'Presentation Step Content')
  ->addIndex($installer->getIdxName('recomiendo_recipes/recipe_sstep', array('recipe_id')),
    array('recipe_id'))
    ->addForeignKey($installer->getFkName('recomiendo_recipes/recipe_sstep', 'recipe_id', 'recomiendo_recipes/recipe', 'recipe_id'),
      'recipe_id', $installer->getTable('recomiendo_recipes/recipe'), 'recipe_id',
      Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
      ->setComment('Recipe as foreign key');

$installer->getConnection()->createTable($table);


/**
 *
 *
 * From now on
 * Codifiers section
 * Starts down
 *
 *
 */


/**
 * Create table 'recomiendo_ingredient_type'
 */
$table = $installer->getConnection()
  ->newTable($installer->getTable('recomiendo_recipes/codifier_ingredienttype'))
  ->addColumn('ingredienttype_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'identity'  => true,
    'unsigned'  => true,
    'nullable'  => false,
    'primary'   => true,
  ), 'Ingredient Type Id')
  ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
  ), 'Ingredient Type Name');

$installer->getConnection()->createTable($table);

/**
 * Create table 'recomiendo_ingredient'
 */
$table = $installer->getConnection()
  ->newTable($installer->getTable('recomiendo_recipes/codifier_ingredient'))
  ->addColumn('ingredient_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'identity'  => true,
    'unsigned'  => true,
    'nullable'  => false,
    'primary'   => true,
  ), 'Ingredient Id')
  ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
  ), 'Ingredient Name');

$installer->getConnection()->createTable($table);

/**
 * Create table 'recomiendo_zipcode'
 */
$table = $installer->getConnection()
  ->newTable($installer->getTable('recomiendo_recipes/codifier_zipcode'))
  ->addColumn('zipcode_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'identity'  => true,
    'unsigned'  => true,
    'nullable'  => false,
    'primary'   => true,
  ), 'Zipcode Id')
  ->addColumn('number', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
  ), 'Zipcode Number')
  ->addColumn('comment', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
  ), 'Comment')
  ->addColumn('extra_price', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
  ), 'Price extra');

$installer->getConnection()->createTable($table);

/**
 * Create table 'recomiendo_hourbelt'
 */
$table = $installer->getConnection()
  ->newTable($installer->getTable('recomiendo_recipes/hourbelt'))
  ->addColumn('hourbelt_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'identity'  => true,
    'unsigned'  => true,
    'nullable'  => false,
    'primary'   => true,
  ), 'Hour Belt Id')
  ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
  ), 'Name')
  ->addColumn('start', Varien_Db_Ddl_Table::TYPE_TIME, null, array(
  ), 'Starting Hour')
  ->addColumn('finish', Varien_Db_Ddl_Table::TYPE_TIME, null, array(
  ), 'Finish Hour');

$installer->getConnection()->createTable($table);

/**
 * Create table 'utils'
 */
$table = $installer->getConnection()
  ->newTable($installer->getTable('recomiendo_recipes/codifier_util'))
  ->addColumn('util_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'identity'  => true,
    'unsigned'  => true,
    'nullable'  => false,
    'primary'   => true,
  ), 'Util Id')
  ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
  ), 'Util Name');

$installer->getConnection()->createTable($table);

/**
 * Create table 'social_group'
 */
$table = $installer->getConnection()
  ->newTable($installer->getTable('recomiendo_recipes/codifier_socialgroup'))
  ->addColumn('socialgroup_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'identity'  => true,
    'unsigned'  => true,
    'nullable'  => false,
    'primary'   => true,
  ), 'Social Group Id')
  ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
  ), 'Social Group Name');

$installer->getConnection()->createTable($table);

/**
 * Create table 'recipe_category'
 */
$table = $installer->getConnection()
  ->newTable($installer->getTable('recomiendo_recipes/codifier_recipetype'))
  ->addColumn('recipetype_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'identity'  => true,
    'unsigned'  => true,
    'nullable'  => false,
    'primary'   => true,
  ), 'Recipe Category Id')
  ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
  ), 'Recipe Category Name')
  ->addColumn('description', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
  ), 'Recipe Category Description');

$installer->getConnection()->createTable($table);

/**
 * Create table 'provider'
 */
$table = $installer->getConnection()
  ->newTable($installer->getTable('recomiendo_recipes/codifier_provider'))
  ->addColumn('provider_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'identity'  => true,
    'unsigned'  => true,
    'nullable'  => false,
    'primary'   => true,
  ), 'Provider Id')
  ->addColumn('social_reason', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
  ), 'Social Reason')
  ->addColumn('nif', Varien_Db_Ddl_Table::TYPE_VARCHAR, 10, array(
  ), 'Provider NIF')
  ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
  ), 'Provider Name')
  ->addColumn('address', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
  ), 'Provider Address');

$installer->getConnection()->createTable($table);

$table = $installer->getConnection()
  ->newTable($installer->getTable('recomiendo_recipes/codifier_traceability'))
  ->addColumn('traceability_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'identity'  => true,
    'unsigned'  => true,
    'nullable'  => false,
    'primary'   => true,
  ), 'Traceability Id')
  ->addColumn('provider_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'unsigned'  => true,
    'nullable'  => false,
    'default'   => '0',
  ), 'Provider Id')
  ->addColumn('stock_number', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
  ), 'Stock Number')
  ->addColumn('invoice_type', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
  ), 'Invoice Type')
  ->addColumn('adquired_on', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
  ), 'Adquiring Date')
  ->addColumn('file', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
  ), 'Archive')
  ->addIndex($installer->getIdxName('recomiendo_recipes/codifier_traceability', array('provider_id')),
    array('recipe_id'))
    ->addForeignKey($installer->getFkName('recomiendo_recipes/codifier_traceability', 'provider_id', 'recomiendo_recipes/codifier_provider', 'provider_id'),
      'provider_id', $installer->getTable('recomiendo_recipes/codifier_provider'), 'provider_id',
      Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
      ->setComment('Provider as foreign key');

$installer->getConnection()->createTable($table);

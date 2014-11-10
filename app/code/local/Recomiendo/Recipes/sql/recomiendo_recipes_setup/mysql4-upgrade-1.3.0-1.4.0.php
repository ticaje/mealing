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

/**
 * Create table 'recomiendo_invoice_type'
 */
$table = $installer->getConnection()
  ->newTable($installer->getTable('recomiendo_recipes/codifier_invoicetype'))
  ->addColumn('invoicetype_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'identity'  => true,
    'unsigned'  => true,
    'nullable'  => false,
    'primary'   => true,
  ), 'Invoice Type Id')
  ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
  ), 'Invoice Type Name');

$installer->getConnection()->createTable($table);

/*
 * Create rwlatioship between traceability and invoicetype
 * */
$installer
  ->getConnection()
  ->addIndex($installer->getIdxName('recomiendo_recipes/codifier_traceability', array('invoicetype_id')),
    array('invoicetype_id'))
    ->addForeignKey($installer->getFkName('recomiendo_recipes/codifier_traceability', 'invoicetype_id', 'recomiendo_recipes/codifier_invoicetype', 'invoicetype_id'),
      'invoicetype_id', $installer->getTable('recomiendo_recipes/codifier_invoicetype'), 'invoicetype_id',
      Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
      ->setComment('Invoicetype as foreign key');


$installer->run("

-- DROP TABLE IF EXISTS `{$installer->getTable('recomiendo_recipes/relation_traceability_invoicetype')}`;
CREATE TABLE `{$installer->getTable('recomiendo_recipes/relation_traceability_invoicetype')}` (
  `traceability_invoicetype_id` int(11) NOT NULL auto_increment,
  `invoicetype_id` smallint(8) unsigned NOT NULL default '0',
  `traceability_id` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`traceability_invoicetype_id`),
  KEY `FK_{$installer->getTable('recomiendo_recipes/codifier_invoicetype')}_r_t_i` (`invoicetype_id`),
  KEY `FK_{$installer->getTable('recomiendo_recipes/codifier_traceability')}_r_t_i` (`traceability_id`),
  CONSTRAINT `FK_{$installer->getTable('recomiendo_recipes/codifier_invoicetype')}_r_t_i`
  FOREIGN KEY (`invoicetype_id`) REFERENCES `{$installer->getTable('recomiendo_recipes/codifier_invoicetype')}` (`invoicetype_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_{$installer->getTable('recomiendo_recipes/codifier_traceability')}_r_t_i`
  FOREIGN KEY (`traceability_id`) REFERENCES `{$installer->getTable('recomiendo_recipes/codifier_traceability')}` (`traceability_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

?>

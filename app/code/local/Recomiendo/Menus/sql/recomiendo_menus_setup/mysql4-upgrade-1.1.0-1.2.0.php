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

$setup = new Mage_Eav_Model_Entity_Setup();
$installer->startSetup();

$setup->addAttribute('catalog_product', 'recomiendo_price_template', array(
  'group'             => 'Prices',
  'label'             => 'Plantilla de Precios',
  'note'              => '',
  'type'              => 'int', //backend_type
  'input'             => 'select',  //frontend_input
  'frontend_class'    => '',
  'source'            => 'recomiendo_menus/product_attribute_source_template',
  'backend'           => '',
  'frontend'          => '',
  'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
  'required'          => true,
  'visible_on_front'  => false,
  'apply_to'          => 'menu',
  'is_configurable'   => false,
  'used_in_product_listing' => false,
  'sort_order'        => 5,
));

$installer->endSetup();

<?php

class Recomiendo_Menus_Block_Adminhtml_Tabs extends Mage_Adminhtml_Block_Catalog_Product_Edit_Tabs
{
  private $parent;

  protected function _prepareLayout()
  {
    //get all existing tabs
    $this->parent = parent::_prepareLayout();
    //add new tab
    if ($this->getProduct()->getTypeId() == Recomiendo_Menus_Helper_Config::PRODUCT_TYPE_CODE){
      $this->addTab('lunchmenu', array(
        'label'     => Mage::helper('catalog')->__('Menu Comidas'),
        'url'       => $this->getUrl('*/*/lunch', array('_current' => true)),
        'class'     => 'ajax',
        'before'    => 'catalog.product.edit.tab.related',
      ));
      $this->addTab('dinnermenu', array(
        'label'     => Mage::helper('catalog')->__('Menu Cenas'),
        'url'      => $this->getUrl('*/*/dinner', array('_current' => true)),
        'class'     => 'ajax',
      ));
    }
    return $this->parent;
  }
}

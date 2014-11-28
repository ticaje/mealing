<?php

class Recomiendo_Menus_Block_Adminhtml_Catalog_Product_Edit_Tabs_Lunch extends Mage_Adminhtml_Block_Catalog_Product_Edit_Tabs
{
  private $parent;

  protected function _prepareLayout()
  {
    //get all existing tabs
    $this->parent = parent::_prepareLayout();
    //add new tab
    $this->addTab('lunchmenu', array(
      'label'     => Mage::helper('catalog')->__('Comidas'),
      'content'   => $this->getLayout()
      ->createBlock('recomiendo_menus/adminhtml_tabs_lunchmenu')->toHtml(),
      ));
    return $this->parent;
  }
}

<?php
/**
 * Recipes List admin edit form tabs block
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Cms_Block_Adminhtml_Homepage_Basketcell_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
  public function __construct()
  {
    parent::__construct();
    $this->setId('basketcell_tabs');
    $this->setDestElementId('edit_form');
    $this->setTitle(Mage::helper('recomiendo_cms')->__('Item Information'));
  }

  protected function _prepareLayout()
  {

    $this->addTab('main_section', array(
      'label'     => Mage::helper('recomiendo_cms')->__('Item Information'),
      'title'     => Mage::helper('recomiendo_cms')->__('Item Information'),
      'content'   => $this->getLayout()->createBlock('recomiendo_cms/adminhtml_homepage_basketcell_edit_tab_form')->toHtml(),
      'active'	  => true,
    ));

    return parent::_prepareLayout();
  }
}

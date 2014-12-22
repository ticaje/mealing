<?php
/**
 * Recipes List admin grid container
 *
 * @author Hector Luis Barrientos Margolles
 */

class Recomiendo_Cms_Block_Adminhtml_Slideshow extends Recomiendo_Cms_Block_Adminhtml_Refactor_BaseGridContainer
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_slideshow';
    $this->_blockGroup = 'recomiendo_cms';
    $this->_headerText = Mage::helper('recomiendo_cms')->__('Slideshow Items Manager');
    $this->_addButtonLabel = Mage::helper('recomiendo_cms')->__('Add Item');
    parent::__construct();
  }
}

<?php
/**
 * Base Admin Grid Container
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Menus_Block_Adminhtml_Refactor_BaseGridContainer extends Mage_Adminhtml_Block_Widget_Grid_Container
{

  /**
   * Block constructor
   */
  public function __construct()
  {
    $this->_headerText = Mage::helper('recomiendo_menus')->__($this->_headerText);

    parent::__construct();

    if (Mage::helper('recomiendo_menus/admin')->isActionAllowed('save')) {
      $this->_updateButton('add', 'label', Mage::helper('recomiendo_menus')->__('Adicionar nueva entidad %s', $this->_entityLabel));
    } else {
      $this->_removeButton('add');
    }
  }
}

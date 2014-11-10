<?php
/**
 * Base List Admin Edit Form Main Tab
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Block_Adminhtml_Refactor_Edit_Tab_BaseMain
  extends Mage_Adminhtml_Block_Widget_Form
  implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

  protected $_instanceName;
  protected $_instanceRegisterName;
  protected $_entityName;
  protected $_entityLabel;
  /**
   * Prepare form elements for tab
   *
   * @return Recomiendo_Recipes_Block_Adminhtml_Refactor_Edit_Tab_BaseMain
   */
  protected function _prepareForm()
  {
    return parent::_prepareForm();
  }

  /**
   * Prepare label for tab
   *
   * @return string
   */
  public function getTabLabel()
  {
    return Mage::helper('recomiendo_recipes')->__('Información de %s', $this->_entityLabel);
  }

  /**
   * Prepare title for tab
   *
   * @return string
   */
  public function getTabTitle()
  {
    return Mage::helper('recomiendo_recipes')->__('Información de %s', $this->_entityLabel);
  }

  /**
   * Returns status flag about this tab can be shown or not
   *
   * @return true
   */
  public function canShowTab()
  {
    return true;
  }

  /**
   * Returns status flag about this tab hidden or not
   *
   * @return true
   */
  public function isHidden()
  {
    return false;
  }
}

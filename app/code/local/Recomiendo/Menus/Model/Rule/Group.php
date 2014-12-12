<?php
/**
 * Menu rule groups model
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Menus_Model_Rule_Group extends Mage_Core_Model_Abstract
{
  /**
   * Define resource model
   */
  protected function _construct()
  {
    $this->_init('recomiendo_menus/rule_group');
  }

  protected function _afterSave()
  {
  }

}

<?php
/**
 * Menus price rule set collection
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Menus_Model_Resource_Rule_Set_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
  /**
   * Define collection model
   */
  protected function _construct()
  {
    $this->_init('recomiendo_menus/rule_set');
  }
}

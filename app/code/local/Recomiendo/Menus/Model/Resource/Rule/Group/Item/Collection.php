<?php
/**
 * Menus price rule group item collection
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Menus_Model_Resource_Rule_Group_Item_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
  /**
   * Define collection model
   */
  protected function _construct()
  {
    $this->_init('recomiendo_menus/price_group_item');
  }
}

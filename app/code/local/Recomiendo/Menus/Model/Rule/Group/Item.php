<?php
/**
 * Menu rule group item model
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Menus_Model_Rule_Group_Item extends Mage_Core_Model_Abstract
{
  /**
   * Define resource model
   */
  protected function _construct()
  {
    $this->_init('recomiendo_menus/price_group_item');
  }
}

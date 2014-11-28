<?php
/**
 * Product_Recipe resource model
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Menus_Model_Resource_Relation_Menu_Recipe extends Mage_Core_Model_Resource_Db_Abstract
{
  /**
   * Initialize connection and define main table and primary key
   */
  protected function _construct()
  {
    $this->_init('recomiendo_menus/relation_menu_recipe', 'menu_recipe_id');
  }
}

<?php
/**
 * Recipe Estep collection
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Model_Resource_Recipe_Estep_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
  /**
   * Define collection model
   */
  protected function _construct()
  {
    $this->_init('recomiendo_recipes/recipe_estep');
  }
}

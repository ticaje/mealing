<?php
/**
 * Recipe_Image resource model
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Model_Resource_Relation_Recipe_Image extends Mage_Core_Model_Resource_Db_Abstract
{
  /**
   * Initialize connection and define main table and primary key
   */
  protected function _construct()
  {
    $this->_init('recomiendo_recipes/relation_recipe_image', 'recipe_image_id');
  }
}

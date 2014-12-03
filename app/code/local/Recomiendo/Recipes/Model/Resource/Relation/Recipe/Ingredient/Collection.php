<?php
/**
 * Recipe_Ingredient relationship collection
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Model_Resource_Relation_Recipe_Ingredient_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Define collection model
     */
    protected function _construct()
    {
        $this->_init('recomiendo_recipes/relation_recipe_ingredient');
    }

    /**
     * Prepare for displaying in list
     *
     * @param integer $page
     * @return Recomiendo_Recipes_Model_Resource_Relation_Recipe_Ingredient_Collection
     */
    public function prepareForList($page)
    {
        $this->setPageSize(Mage::helper('recomiendo_recipes')->getRecipeIngredientPerPage());
        return $this;
    }

    public function getValuesSelected($recipeId)
    {
      $this->addFieldToFilter('recipe_id', $recipeId);
      foreach ($this as $item){
        $result[] = $item->getRecipeIngredientId();
      }
      return $result;
    }
}

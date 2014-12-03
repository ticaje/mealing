<?php
/**
 * Recipe_Recipetype relationship collection
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Model_Resource_Relation_Recipe_Recipetype_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Define collection model
     */
    protected function _construct()
    {
        $this->_init('recomiendo_recipes/relation_recipe_recipetype');
    }

    /**
     * Prepare for displaying in list
     *
     * @param integer $page
     * @return Recomiendo_Recipes_Model_Resource_Relation_Recipe_Recipetype_Collection
     */
    public function prepareForList($page)
    {
        $this->setPageSize(Mage::helper('recomiendo_recipes')->getRecipeRecipetypePerPage());
        return $this;
    }

    public function getValuesSelected($recipeId)
    {
      $this->addFieldToFilter('recipe_id', $recipeId);
      foreach ($this as $item){
        $result[] = $item->getRecipetypeId();
      }
      return $result;
    }
}

<?php
/**
 * Ingredienttype_Ingredient relationship collection
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Model_Resource_Relation_Ingredienttype_Ingredient_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Define collection model
     */
    protected function _construct()
    {
        $this->_init('recomiendo_recipes/relation_ingredienttype_ingredient');
    }

    /**
     * Prepare for displaying in list
     *
     * @param integer $page
     * @return Recomiendo_Recipes_Model_Resource_Relation_Ingredienttype_Ingredient_Collection
     */
    public function prepareForList($page)
    {
        $this->setPageSize(Mage::helper('recomiendo_recipes')->getIngredientypeIngredientPerPage());
        return $this;
    }

    public function getValuesSelected($ingredient_id)
    {
      $this->addFieldToFilter('ingredient_id', $ingredient_id);
      foreach ($this as $item){
        $result[] = $item->getIngredienttypeId();
      }
      return $result;
    }

    public function getLabelsOfValuesSelected($ingredient_id)
    {
      $arr_of_values = $this->getValuesSelected($ingredient_id);
      $sel = Mage::getModel('recomiendo_recipes/codifier_ingredienttype')->getCollection()
        ->addFieldToFilter('ingredienttype_id', $arr_of_values);
      $result = "";
      foreach ($sel as $item){
        $result .= ucfirst($item->getName())." ";
      }
      return $result;
    }
}

<?php
/**
 * Traceability_Ingredient relationship collection
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Model_Resource_Relation_Traceability_Ingredient_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Define collection model
     */
    protected function _construct()
    {
        $this->_init('recomiendo_recipes/relation_traceability_ingredient');
    }

    /**
     * Prepare for displaying in list
     *
     * @param integer $page
     * @return Recomiendo_Recipes_Model_Resource_Relation_Traceability_Ingredient_Collection
     */
    public function prepareForList($page)
    {
        $this->setPageSize(Mage::helper('recomiendo_recipes')->getTraceabilityIngredientPerPage());
        return $this;
    }

    public function getValuesSelected($traceability_id)
    {
      $this->addFieldToFilter('traceability_id', $traceability_id);
      foreach ($this as $item){
        $result[] = $item->getIngredientId();
      }
      return $result;
    }

    public function getLabelsOfValuesSelected($traceability_id)
    {
      $arr_of_values = $this->getValuesSelected($traceability_id);
      $sel = Mage::getModel('recomiendo_recipes/codifier_ingredient')->getCollection()
        ->addFieldToFilter('ingredient_id', $arr_of_values);
      $result = "";
      foreach ($sel as $item){
        $result .= ucfirst($item->getName())." ";
      }
      return $result;
    }
}

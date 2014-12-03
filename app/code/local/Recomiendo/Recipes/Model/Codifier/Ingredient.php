<?php
/**
 * Ingredient model
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Model_Codifier_Ingredient extends Mage_Core_Model_Abstract
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
      $this->_init('recomiendo_recipes/codifier_ingredient');
    }

    protected function _afterSave()
    {
      $_id  = $this->getIngredientId();
      $_types = $this->getIngredienttypes();

      Mage::getModel('recomiendo_recipes/relation_ingredienttype_ingredient')
        ->getCollection()
        ->addFieldToFilter('ingredient_id', $_id)
        ->walk('delete');

      foreach ($_types as $type){
        Mage::getModel('recomiendo_recipes/relation_ingredienttype_ingredient')
          ->setIngredienttypeId($type)
          ->setIngredientId($_id)
          ->save();
      }
    }

    public function getIngredientsValuesForForm($entityName, $entityId)
    {
      $_ingredients = $this->getCollection();

      foreach($_ingredients as  $item){
        $arr['value'] =  $item->getIngredientId();
        $arr['label'] =  ucfirst($item->getName());
        $res[] = $arr;
      }
      $sel = Mage::getResourceModel('recomiendo_recipes/'.$entityName.'_collection');
      $result['selected'] = $sel->getValuesSelected($entityId);
      $result['values']   = $res;

      return $result;
    }
}

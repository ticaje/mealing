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

    public function getIngredientsValuesForForm($_id)
    {
      $i_types = $this->getCollection();

      foreach($i_types as  $item){
        $arr['value'] =  $item->getIngredientId();
        $arr['label'] =  ucfirst($item->getName());
        $res[] = $arr;
      }
      $sel = Mage::getModel('recomiendo_recipes/relation_provider_ingredient')->getCollection();
      $result['selected'] = $sel->getValuesSelected($_id);
      $result['values']   = $res;

      return $result;
    }
}

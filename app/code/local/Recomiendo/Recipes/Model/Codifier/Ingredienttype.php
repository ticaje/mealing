<?php
/**
 * Ingredienttype model
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Model_Codifier_Ingredienttype extends Mage_Core_Model_Abstract
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('recomiendo_recipes/codifier_ingredienttype');
    }

    public function getIngredienttypeValuesForForm($_id)
    {
      $i_types = $this->getCollection();

      foreach($i_types as  $item){
        $arr['value'] =  $item->getIngredienttypeId();
        $arr['label'] =  ucfirst($item->getName());
        $res[] = $arr;
      }
      $sel = Mage::getModel('recomiendo_recipes/relation_ingredienttype_ingredient')->getCollection();
      $result['selected'] = $sel->getValuesSelected($_id);
      $result['values']   = $res;

      return $result;
    }
}

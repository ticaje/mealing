<?php

class Recomiendo_Recipes_Block_Adminhtml_Ingredients_Renderer_Ingredienttypes extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
  public function render(Varien_Object $row)
  {
    $_id = $row->getIngredientId();
    $sel = Mage::getModel('recomiendo_recipes/relation_ingredienttype_ingredient')->getCollection();
    $val = $sel->getLabelsOfValuesSelected($_id);
    return $val;
  }
}
?>

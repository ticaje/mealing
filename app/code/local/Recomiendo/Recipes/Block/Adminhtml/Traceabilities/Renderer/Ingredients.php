<?php

class Recomiendo_Recipes_Block_Adminhtml_Traceabilities_Renderer_Ingredients extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
  public function render(Varien_Object $row)
  {
    $_id = $row->getTraceabilityId();
    $sel = Mage::getResourceModel('recomiendo_recipes/relation_traceability_ingredient_collection');
    $val = $sel->getLabelsOfValuesSelected($_id);
    return $val;
  }
}
?>

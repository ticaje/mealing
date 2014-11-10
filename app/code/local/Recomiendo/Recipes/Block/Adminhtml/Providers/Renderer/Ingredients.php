<?php

class Recomiendo_Recipes_Block_Adminhtml_Providers_Renderer_Ingredients extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
  public function render(Varien_Object $row)
  {
    $_id = $row->getProviderId();
    $sel = Mage::getModel('recomiendo_recipes/relation_provider_ingredient')->getCollection();
    $val = $sel->getLabelsOfValuesSelected($_id);
    return $val;
  }
}
?>

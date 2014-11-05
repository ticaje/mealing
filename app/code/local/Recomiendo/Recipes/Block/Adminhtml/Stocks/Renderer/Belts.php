<?php

class Recomiendo_Recipes_Block_Adminhtml_Stocks_Renderer_Belts extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
  public function render(Varien_Object $row)
  {
    $_id = $row->getHourbeltId();
    $sel = Mage::getSingleton('recomiendo_recipes/codifier_hourbelt')->getCollection();
    $val = $sel->getBelts();
    return $val;
  }
}
?>

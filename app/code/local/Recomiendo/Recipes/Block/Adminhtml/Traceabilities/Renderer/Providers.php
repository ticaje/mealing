<?php
/**
 * Providers renderer
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Block_Adminhtml_Traceabilities_Renderer_Providers extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
  private static $_providers = array();

  public static  function getProvidersArray()
  {
    if (count(self::$_providers) == 0){
      self::$_providers = $providers;
    }
    return self::$_providers;
  }

  public function render(Varien_Object $row)
  {
    $val = $this->_getValue($row);
    $providers = Mage::getSingleton('core/session')->getRenderingProviders();
    if (!$providers){
      $collection  = Mage::getResourceModel('recomiendo_recipes/codifier_provider_collection');
      Mage::getSingleton('core/session')->setRenderingProviders((string)$collection);
    }
    $collection->addFieldToFilter('provider_id', $val);
    $arr = $collection;
    return $arr->getSize() ? $arr->getData()[0]['name'] : '';
  }
}

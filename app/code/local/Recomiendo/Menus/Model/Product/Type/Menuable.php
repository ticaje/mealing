<?php
/**
 * Recipe item model
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Menus_Model_Product_Type_Menuable extends Mage_Catalog_Model_Product_Type_Abstract
{
  const TYPE_MENU = 'menu';
  const XML_PATH_AUTHENTICATION = 'catalog/menus/authentication';

  protected $_product;

  /**
   * Retrieve product instance in any cost
   * @return
   */
  public function getProduct($product = null) {
    if(!$product)
    {
      if ($this->_product) return $this->_product;
      $product = $this->_product;
      if(!$product)
      {
        $product = Mage::registry('product');
        if(!$product) {
          throw new AW_Core_Exception("Can't get product instance");
        }
      }
    }
    $this->setProduct($product);
    return $product;
  }

  protected function _prepareProduct(Varien_Object $buyRequest, $product, $processMode)
  {
    return parent::_prepareProduct($buyRequest, $product, $processMode);
  }

  public function getRelatedRecipeCollection($isLunch)
  {
    return Mage::getModel('recomiendo_menus/relation_menu_recipe')->getCollection()
      ->addFieldToFilter('is_lunch', $isLunch);
  }
  /**
   * Retrieve array of related recipes
   *
   * @return array
   */
  public function getRelatedRecipes($isLunch)
  {
    $_product = $this->getProduct();
    if ($_product){
      $recipes = array();
      $recipes = $this->getRelatedRecipeCollection($isLunch)->getValuesSelected($_product->getId());
      foreach ($recipes as $recipe) {
        $recipes[] = $recipe;
      }
    }
    return $recipes;
  }
}

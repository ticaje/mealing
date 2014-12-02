<?php
/**
 * Recipe Presentation Step model
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Model_Recipe_Media_Config extends Mage_Catalog_Model_Product_Media_Config  //implements Mage_Media_Model_Image_Config_Interface
{
  public function getBaseMediaPathAddition()
  {
    return 'recipes' . DS . 'images';
  }

  public function getBaseTmpMediaPathAddition()
  {
    return 'tmp' . DS . $this->getBaseMediaPathAddition();
  }

  public function getBaseTmpMediaPath()
  {
    return Mage::getBaseDir('media') . DS . $this->getBaseTmpMediaPathAddition();
  }

  public function getBaseMediaUrl()
  {
    return Mage::getBaseUrl('media') . 'recipes/images';
  }

  public function getBaseMediaPath()
  {
    return Mage::getBaseDir('media') . DS . 'recipes' . DS . 'images';
  }

  public function getBaseMediaUrlAddition()
  {
    return 'recipes/images';
  }
}

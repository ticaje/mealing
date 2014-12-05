<?php
/**
 * Traceability Presentation Step model
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Model_Codifier_Traceability_Media_Config extends Mage_Catalog_Model_Product_Media_Config  //implements Mage_Media_Model_Image_Config_Interface
{
  public function getBaseMediaPathAddition()
  {
    return 'traceabilities' . DS . 'invoices';
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
    return Mage::getBaseUrl('media') . 'traceabilities/invoices';
  }

  public function getBaseMediaPath()
  {
    return Mage::getBaseDir('media') . DS . 'traceabilities' . DS . 'invoices';
  }

  public function getBaseMediaUrlAddition()
  {
    return 'traceabilities/invoices';
  }
}

<?php
/**
 * Traceability model
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Model_Codifier_Traceability extends Mage_Core_Model_Abstract
{
  /**
   * Define resource model
   */
  protected function _construct()
  {
    $this->_init('recomiendo_recipes/codifier_traceability');
  }

  protected function _beforeSave()
  {
    parent::_beforeSave();
    $this->saveFile();
    return $this;
  }

  protected function _afterSave()
  {
    $_ingredients = $this->getTraceabilityIngredients();
    array_shift($_ingredients['ingredients']);
    $this->saveIngredients($_ingredients['ingredients']);
  }

  /**
   * This data type is defined statically since its values do not change at all
   */
  public static function getInvoiceTypes()
  {
    $types = array(1 => 'Factura', 2 => 'Albaran');
    foreach ($types as $i => $type){
      $result[] = array('value'=>$i+1, 'label'=>$type);
    }
    return $types;
  }

  private function saveIngredients($ingredients)
  {
    $_id = $this->getTraceabilityId();

    Mage::getModel('recomiendo_recipes/relation_traceability_ingredient')
      ->getCollection()
      ->addFieldToFilter('traceability_id', $_id)
      ->walk('delete');

    foreach ($ingredients as $ingredient){
      $date = Mage::app()->getLocale()->date($ingredient['expires_on'], Zend_Date::DATE_SHORT);
      $_expires_on = $date->toString('dd-MM-YYYY');
      Mage::getModel('recomiendo_recipes/relation_traceability_ingredient')
        ->setTraceabilityId($_id)
        ->setIngredientId($ingredient['ingredient'])
        ->setStockNumber($ingredient['stock_number'])
        ->setExpiresOn($_expires_on)
        ->setOperations($ingredient['operations'])
        ->save();
    }
  }

  public function getIngredients()
  {
    $sel = Mage::getResourceModel('recomiendo_recipes/relation_traceability_ingredient_collection')
      ->addFieldToFilter('traceability_id', $this->getId());
    return $sel->getData();
  }

  public function saveFile()
  {
    $file = $_FILES;
    if (!empty($file['document']['name'])){
      $dir  = Mage::getSingleton('recomiendo_recipes/codifier_traceability_media_config')->getBaseMediaPath();
      if ($this->getDocument()){
        $file = $this->getDocument();
        unlink($dir.$file['value']);
      }
      $uploaded = Mage::Helper('recomiendo_recipes/data')->
        uploadFile('codifier_traceability_media_config', 'document', explode(",", Mage::getStoreConfig(Recomiendo_Recipes_Helper_Config::CODIFIER_TRACEABILITY_ALLOWED_EXTENSIONS)));
      $this->setData("file", $uploaded['file']);
    }
  }

}

<?php
/**
 * Provider model
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Model_Codifier_Provider extends Mage_Core_Model_Abstract
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('recomiendo_recipes/codifier_provider');
    }

    protected function _afterSave()
    {
      $_id  = $this->getProviderId();
      $_types = $this->getIngredients();
      //exit;

      Mage::getModel('recomiendo_recipes/relation_provider_ingredient')
        ->getCollection()
        ->addFieldToFilter('provider_id', $_id)
        ->walk('delete');

      foreach ($_types as $InId){
        Mage::getModel('recomiendo_recipes/relation_provider_ingredient')
          ->setIngredientId($InId)
          ->setProviderId($_id)
          ->save();
      }
    }

    public function toOptionArray()
    {
      $array = array(
          'value'=>0,
          'label'=>'Please Select'
      );
      $result = $this->getCollection();
      //array_unshift($result, $array);
      return $result;
    }
}

<?php
/**
 * Hourbelt model
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Model_Hourbelt extends Mage_Core_Model_Abstract
{
  /**
   * Define resource model
   */
  protected function _construct()
  {
    $this->_init('recomiendo_recipes/hourbelt');
  }

  protected function _afterSave()
  {
    $_id = $this->getHourbeltId();
    $_shipping_rules = $this->getShipping();;
    $_rules = (object)$_shipping_rules;

    array_shift($_rules->hourbelt_rules);
    if (count($_rules->hourbelt_rules) > 0 ){

      Mage::getModel('recomiendo_recipes/hourbelt_rule')
        ->getCollection()
        ->addFieldToFilter('hourbelt_id', $_id)
        ->walk('delete');

      foreach ($_rules->hourbelt_rules as $rule){
        Mage::getModel('recomiendo_recipes/hourbelt_rule')
          ->setHourbeltId($_id)
          ->setPrice($rule['price'])
          ->setQuantity($rule['quantity'])
          ->setOrder($rule['order'])
          ->save();
      }

    }
  }
}

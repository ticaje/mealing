<?php
/**
 * Menu rule set model
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Menus_Model_Rule_Set extends Mage_Core_Model_Abstract
{
  /**
   * Define resource model
   */
  protected function _construct()
  {
    $this->_init('recomiendo_menus/rule_set');
  }

  protected function _afterSave()
  {
    $_groups = $this->getPricerulesGroups();
    array_shift($_groups['groups']);
    $this->saveGroups($_groups['groups']);
  }

  private function saveGroups($groups)
  {
    $_id = $this->getId();
    $_headers = Recomiendo_Menus_Helper_Config::getSelectionPossibilities();

    $_group = Mage::getModel('recomiendo_menus/rule_group')
      ->getCollection()
      ->addFieldToFilter('rule_set_id', $_id)
      ->walk('delete');

    foreach ($groups as $group){
      $_persons = $group['persons'];
      $model = Mage::getModel('recomiendo_menus/rule_group');

      foreach ($_headers as $number){
        $setter      = "setPriceRecipes".ucfirst($number);
        $setter_club = "setPriceClubRecipes".ucfirst($number);
        $model->{$setter}($group['price_recipes_'.$number]);
        $model->{$setter_club}($group['price_club_recipes_'.$number]);
      }
      $model->setPersons($_persons);
      $model->setRuleSetId($_id);
      $model->save();
    }
  }

  public function getRulesetGroups()
  {
    $sel = Mage::getResourceModel('recomiendo_menus/rule_group_collection')
      ->addFieldToFilter('rule_set_id', $this->getId());
    return $sel->getData();
  }

  /**
   * This data type is defined statically since its values do not change at all
   */
  public static function getRuleSetFormulas()
  {
    $types = array(1 => 'Estandar', 2 => 'Promocion');
    foreach ($types as $i => $type){
      $result[] = array('value'=>$i+1, 'label'=>$type);
    }
    return $types;
  }
}

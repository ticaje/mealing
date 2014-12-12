<?php
/**
 * Menus Data Helper
 *
 * @author Hector Luis Barrientos Margolles
 *
 */
class Recomiendo_Menus_Helper_Config extends Mage_Core_Helper_Abstract
{
  /** Product type code */
  const PRODUCT_TYPE_CODE = 'menu';
  const ENTITY_ITEM_INSTANCE_RULE_SET = 'pricerulesSetItemInstance';
  const REGISTRY_VARIABLE_RULE_SET    = 'sets_item';

  static function getSelectionPossibilities()
  {
    return array("three","five","six","seven","eight","ten","twelve","fourteen");
  }

  static function getSelectionPossibilitiesInNumbers()
  {
    return array(3,5,6,7,8,10,12,14);
  }

  static function getSelectionFields()
  {
    return array("dishes" , "price_recipes_", "price_club_recipes_");
  }

  static function getSelectionFieldsHeaders()
  {
    return array("#Platos" , "Precio", "Precio Club R");
  }
}

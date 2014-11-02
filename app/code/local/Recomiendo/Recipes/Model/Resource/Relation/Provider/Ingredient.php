<?php
/**
 * Provider_Ingredient resource model
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Providers_Model_Resource_Relation_Provider_Ingredient extends Mage_Core_Model_Resource_Db_Abstract
{
  /**
   * Initialize connection and define main table and primary key
   */
  protected function _construct()
  {
    $this->_init('recomiendo_providers/relation_provider_ingredient', 'provider_ingredient_id');
  }
}

<?php
/**
 * Shipping Rule resource model
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Model_Resource_Hourbelt_Rule extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Initialize connection and define main table and primary key
     */
    protected function _construct()
    {
      $this->_init('recomiendo_recipes/hourbelt_rule', 'shipping_hourbelt_rule_id');
    }

}

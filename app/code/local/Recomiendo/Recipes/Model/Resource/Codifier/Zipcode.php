<?php
/**
 * Zipcode resource model
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Model_Resource_Codifier_Zipcode extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Initialize connection and define main table and primary key
     */
    protected function _construct()
    {
        $this->_init('recomiendo_recipes/codifier_zipcode', 'zipcpode_id');
    }
}

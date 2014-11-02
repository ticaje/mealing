<?php
/**
 * Stockgroup resource model
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Model_Resource_Codifier_Stockgroup extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Initialize connection and define main table and primary key
     */
    protected function _construct()
    {
        $this->_init('recomiendo_recipes/codifier_stockgroup', 'stockgroup_id');
    }
}

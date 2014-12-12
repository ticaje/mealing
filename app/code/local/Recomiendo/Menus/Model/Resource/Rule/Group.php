<?php
/**
 * Menus price rule group resource model
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Menus_Model_Resource_Rule_Group extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Initialize resource
     */
    protected function _construct()
    {
        $this->_init('recomiendo_menus/rule_group', 'price_group_id');
    }
}

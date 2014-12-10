<?php
/**
 * Menus price rule group item resource model
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Menus_Model_Resource_Rule_Group_Item extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Initialize resource
     */
    protected function _construct()
    {
        $this->_init('recomiendo_menus/price_group_item', 'price_group_item_id');
    }
}

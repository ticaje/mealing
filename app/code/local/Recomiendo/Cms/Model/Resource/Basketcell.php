<?php
/**
 * Home Page Basket Cell item resource model
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Cms_Model_Resource_Basketcell extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Initialize resource
     */
    protected function _construct()
    {
        $this->_init('recomiendo_cms/basketcell', 'basket_cell_id');
    }
}

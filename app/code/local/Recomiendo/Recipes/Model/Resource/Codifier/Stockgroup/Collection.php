<?php
/**
 * Stockgroup collection
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Model_Resource_Codifier_Stockgroup_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Define collection model
     */
    protected function _construct()
    {
        $this->_init('recomiendo_recipes/codifier_stockgroup');
    }

    /**
     * Prepare for displaying in list
     *
     * @param integer $page
     * @return Recomiendo_Recipes_Model_Resource_Stockgroup_Collection
     */
    public function prepareForList($page)
    {
        $this->setPageSize(Mage::helper('recomiendo_recipes')->getStockgroupPerPage());
        return $this;
    }
}

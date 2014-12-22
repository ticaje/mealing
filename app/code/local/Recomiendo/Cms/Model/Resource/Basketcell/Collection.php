<?php
/**
 * Home Page Basket Cell collection
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Cms_Model_Resource_Basketcell_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Define collection model
     */
    protected function _construct()
    {
        $this->_init('recomiendo_cms/basketcell');
    }

    /**
     * Prepare for displaying in list
     *
     * @param integer $page
     * @return Recomiendo_Cms_Model_Resource_Basketcell_Collection
     */
    public function prepareForList($page)
    {
        $this->setPageSize(Mage::helper('recomiendo_cms')->getBasketcellsPerPage());
        $this->setCurPage($page)->setOrder('published_at', Varien_Data_Collection::SORT_ORDER_DESC);
        return $this;
    }
}

<?php
/**
 * Zipcode collection
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Model_Resource_Codifier_Zipcode_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Define collection model
     */
    protected function _construct()
    {
        $this->_init('recomiendo_recipes/codifier_zipcode');
    }

    /**
     * Prepare for displaying in list
     *
     * @param integer $page
     * @return Recomiendo_Recipes_Model_Resource_Zipcode_Collection
     */
    public function prepareForList($page)
    {
        $this->setPageSize(Mage::helper('recomiendo_recipes')->getZipcodePerPage());
        return $this;
    }
}

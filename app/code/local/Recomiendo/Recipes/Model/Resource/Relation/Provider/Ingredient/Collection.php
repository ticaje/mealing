<?php
/**
 * Provider_Ingredient relationship collection
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Model_Resource_Relation_Provider_Ingredient_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Define collection model
     */
    protected function _construct()
    {
        $this->_init('recomiendo_recipes/relation_provider_ingredient');
    }

    /**
     * Prepare for displaying in list
     *
     * @param integer $page
     * @return Recomiendo_Recipes_Model_Resource_Relation_Provider_Ingredient_Collection
     */
    public function prepareForList($page)
    {
        $this->setPageSize(Mage::helper('recomiendo_recipes')->getProviderIngredientPerPage());
        return $this;
    }
}

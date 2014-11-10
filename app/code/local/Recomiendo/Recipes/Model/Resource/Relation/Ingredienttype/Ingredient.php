<?php
/**
 * Ingredienttype_Ingredient resource model
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Model_Resource_Relation_Ingredienttype_Ingredient extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Initialize connection and define main table and primary key
     */
    protected function _construct()
    {
        $this->_init('recomiendo_recipes/relation_ingredienttype_ingredient', 'ingredienttype_ingredient_id');
    }

}

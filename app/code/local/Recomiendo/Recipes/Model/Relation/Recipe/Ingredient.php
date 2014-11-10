<?php
/**
 * Recipe_Ingredient relationship model
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Model_Relation_Recipe_Ingredient extends Mage_Core_Model_Abstract
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('recomiendo_recipes/relation_recipe_ingredient');
    }

}

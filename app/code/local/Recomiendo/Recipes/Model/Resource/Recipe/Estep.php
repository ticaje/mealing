<?php
/**
 * Recipe Elaboration Step resource
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Model_Resource_Recipe_Estep extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('recomiendo_recipes/recipe_estep', 'estep_id');
    }
}

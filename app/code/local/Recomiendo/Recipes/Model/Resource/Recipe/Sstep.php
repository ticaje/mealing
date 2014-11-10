<?php
/**
 * Recipe Presentation Step resource
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Model_Resource_Recipe_Sstep extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('recomiendo_recipes/recipe_sstep', 'sstep_id');
    }
}

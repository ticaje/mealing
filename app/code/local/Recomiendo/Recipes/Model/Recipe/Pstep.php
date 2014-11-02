<?php
/**
 * Recipe Preparing Step model
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Model_Recipe_Pstep extends Mage_Core_Model_Abstract
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('recomiendo_recipes/recipe_pstep');
    }
}

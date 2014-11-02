<?php
/**
 * Recipe item model
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Model_Recipe extends Mage_Core_Model_Abstract
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('recomiendo_recipes/recipe');
    }

    /**
     * If object is new adds creation date
     *
     * @return Recomiendo_Recipes_Model_Recipe
     */
    protected function _beforeSave()
    {
        parent::_beforeSave();
        if ($this->isObjectNew()) {
            $this->setData('created_at', Varien_Date::now());
        }
        return $this;
    }
}

<?php
/**
 * Recipes Admin Helper
 *
 * @author Hector Luis Barrientos Margolles
 *
 */
class Recomiendo_Recipes_Helper_Admin extends Mage_Core_Helper_Abstract
{
    /**
     * Check permission for passed action
     *
     * @param string $action
     * @return bool
     */
    public function isActionAllowed($action)
    {
        return Mage::getSingleton('admin/session')->isAllowed('recipes/manage/' . $action);
    }
}

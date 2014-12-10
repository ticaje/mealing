<?php
/**
 * Menus Admin Helper
 *
 * @author Hector Luis Barrientos Margolles
 *
 */
class Recomiendo_Menus_Helper_Admin extends Mage_Core_Helper_Abstract
{
    /**
     * Check permission for passed action
     *
     * @param string $action
     * @return bool
     */
    public function isActionAllowed($action)
    {
        return Mage::getSingleton('admin/session')->isAllowed('menus/manage/' . $action);
    }

}

<?php
/**
 * Recipes Admin Helper
 *
 * @author Hector Luis Barrientos Margolles
 *
 */
class Recomiendo_Cms_Helper_Admin extends Mage_Core_Helper_Abstract
{
  /**
   * Check permission for passed action
   *
   * @param string $action
   * @return bool
   */
  public function isActionAllowed($action)
  {
    return Mage::getSingleton('admin/session')->isAllowed('cms/manage/' . $action);
  }

}

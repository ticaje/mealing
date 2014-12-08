<?php
/**
 * Menus Data Helper
 *
 * @author Hector Luis Barrientos Margolles
 *
 */
class Recomiendo_Menus_Helper_Data extends Mage_Core_Helper_Data
{
  /**
   * Path to store config if front-end output is enabled
   *
   * @var string
   */
  const XML_PATH_ENABLED            = 'menus/view/enabled';

  /**
   * Checks whether menus can be displayed in the frontend
   *
   * @param integer|string|Mage_Core_Model_Store $store
   * @return boolean
   */
  public function isEnabled($store = null)
  {
    return Mage::getStoreConfigFlag(self::XML_PATH_ENABLED, $store);
  }

  public function normalizeAfterSaveObject($object, $new)
  {
    $_rows = explode("&", $object);
    foreach ($_rows as $_row){
      $_row = explode("=", $_row);
      if ($_row[0])
        $result[] = $_row[0];
    }
    $result = empty($result) ? array() : $result;

    $_new = $new ? $new : array();
    foreach ($result as $item){
      if (!in_array($item, $_new))
        array_push($_new, $item);
    }
    return $_new;
  }

}

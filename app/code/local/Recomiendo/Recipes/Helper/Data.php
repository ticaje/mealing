<?php
/**
 * Recipes Data Helper
 *
 * @author Hector Luis Barrientos Margolles
 *
 */
class Recomiendo_Recipes_Helper_Data extends Mage_Core_Helper_Data
{
  /**
   * Path to store config if front-end output is enabled
   *
   * @var string
   */
  const XML_PATH_ENABLED            = 'recipes/view/enabled';

  /**
   * Path to store config where count of recipes posts per page is stored
   *
   * @var string
   */
  const XML_PATH_ITEMS_PER_PAGE     = 'recipes/view/items_per_page';

  /**
   * Path to store config where count of days while recipes is still recently added is stored
   *
   * @var string
   */
  const XML_PATH_DAYS_DIFFERENCE    = 'recipes/view/days_difference';

  /**
   * Recipes Item instance for lazy loading
   *
   * @var Recomiendo_Recipes_Model_Recipes
   */
  protected $_recipeItemInstance,
            $_ingredientItemInstance,
            $_ingredienttypeItemInstance,
            $_utilItemInstance,
            $_socialgroupItemInstance,
            $_ruleItemInstance,
            $_zipcodeItemInstance,
            $_recipetypeItemInstance,
            $_traceabilityItemInstance;

  /**
   * Checks whether recipes can be displayed in the frontend
   *
   * @param integer|string|Mage_Core_Model_Store $store
   * @return boolean
   */
  public function isEnabled($store = null)
  {
    return Mage::getStoreConfigFlag(self::XML_PATH_ENABLED, $store);
  }

  /**
   * Return the number of items per page
   *
   * @param integer|string|Mage_Core_Model_Store $store
   * @return int
   */
  public function getRecipesPerPage($store = null)
  {
    return abs((int)Mage::getStoreConfig(self::XML_PATH_ITEMS_PER_PAGE, $store));
  }

  /**
   * Return difference in days while recipes is recently added
   *
   * @param integer|string|Mage_Core_Model_Store $store
   * @return int
   */
  public function getDaysDifference($store = null)
  {
    return abs((int)Mage::getStoreConfig(self::XML_PATH_DAYS_DIFFERENCE, $store));
  }

  /**
   * Return current entity item instance from the Registry
   *
   * @return Recomiendo_Recipes_Model_%s
   */
  public function getEntityItemInstance($instanceName, $registryVariable)
  {
    //die("Instancing...");
    if (!$this->_{$instanceName}) {
      $this->_{$instanceName} = Mage::registry($registryVariable);
      if (!$this->_{$instanceName}) {
        Mage::throwException($this->__('Type instance %s does not exist in Registry', $registryVariable));
      }
    }

    return $this->_{$instanceName};
  }

  public function uploadImage()
  {
    $uploader = new Mage_Core_Model_File_Uploader('file');
    $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
    $uploader->addValidateCallback('catalog_product_image',
      Mage::helper('catalog/image'), 'validateUploadFile');
    $uploader->setAllowRenameFiles(true);
    $uploader->setFilesDispersion(true);
    $result = $uploader->save(
      Mage::getSingleton('recomiendo_recipes/recipe_media_config')->getBaseMediaPath()
    );

    $_session_handler = Mage::getSingleton('core/session');
    /**
     * Workaround for prototype 1.7 methods "isJSON", "evalJSON" on Windows OS
     */
    $result['tmp_name'] = str_replace(DS, "/", $result['tmp_name']);
    $result['path'] = str_replace(DS, "/", $result['path']);

    $result['url'] = Mage::getSingleton('recomiendo_recipes/recipe_media_config')->getMediaUrl($result['file']);
    $result['insertion_name'] = $result['file'];
    $result['file'] = $result['file'] . '.tmp';
    $result['cookie'] = array(
      'name'     => session_name(),
      'value'    => $_session_handler->getSessionId(),
      'lifetime' => $_session_handler->getCookieLifetime(),
      'path'     => $_session_handler->getCookiePath(),
      'domain'   => $_session_handler->getCookieDomain()
    );

    $_session = $_session_handler->getRecipeImagesUploaded();
    $_session_values = array();

    if ($_session){
      $_session_values = $_session;
      array_push($_session_values, $result);
    }else{
      $_session_values[] = $result;
    }

    $_session_handler->setRecipeImagesUploaded($_session_values);

    return $result;
  }
}

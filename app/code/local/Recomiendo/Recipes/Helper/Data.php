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
  protected $_recipeItemInstance, $_ingredientItemInstance;

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
   * Return current recipe item instance from the Registry
   *
   * @return Recomiendo_Recipes_Model_Recipe
   */
  public function getRecipesItemInstance()
  {
    if (!$this->_recipeItemInstance) {
      $this->_recipeItemInstance = Mage::registry('recipes_item');

      if (!$this->_recipeItemInstance) {
        Mage::throwException($this->__('Recipe instance does not exist in Registry'));
      }
    }

    return $this->_recipeItemInstance;
  }

  /**
   * Return current ingredient item instance from the Registry
   *
   * @return Recomiendo_Recipes_Model_Ingredient
   */
  public function getIngredientItemInstance()
  {
    if (!$this->_ingredientItemInstance) {
      $this->_ingredientItemInstance = Mage::registry('ingredients_item');

      if (!$this->_ingredientItemInstance) {
        Mage::throwException($this->__('Ingredient instance does not exist in Registry'));
      }
    }

    return $this->_ingredientItemInstance;
  }
}

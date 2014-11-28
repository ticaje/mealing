<?php
/**
 * Menu module observer
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Menus_Model_Observer
{
  /**
   * Event before show recipe item on frontend
   * If specified new post was added recently (term is defined in config) we'll see message about this on front-end.
   *
   * @param Varien_Event_Observer $observer
   */
  public function setRecipesPerMenuLunch(Varien_Event_Observer $observer)
  {
    $this->setRecipesPerMenu(true);
  }

  public function setRecipesPerMenuDinner(Varien_Event_Observer $observer)
  {
    $this->setRecipesPerMenu(false);
  }

  private function setRecipesPerMenu($isLunch)
  {
    $request = Mage::app()->getFrontController()->getRequest();
    $_id = $request->getParam('id');
    $_recipes = $isLunch ? $request->getParam('selectedLunchRecipes') : $request->getParam('selectedDinnerRecipes');

    if ($_recipes){
      Mage::getModel('recomiendo_menus/relation_menu_recipe')
        ->getCollection()
        ->addFieldToFilter('entity_id', $_id)
        ->addFieldToFilter('is_lunch', $isLunch)
        ->walk('delete');

      foreach ($_recipes as $_recipe_id)
      {
        Mage::getModel('recomiendo_menus/relation_menu_recipe')
          ->setRecipeId($_recipe_id)
          ->setEntityId($_id)
          ->setIsLunch($isLunch)
          ->save();
      }
    }
  }
}

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
    $request = Mage::app()->getFrontController()->getRequest();
    $_post    = Mage::app()->getRequest()->getPost();
    $_lunches = $_post['recipes']['lunch'];
    if (!in_array("lunch", array_keys($_post['recipes'])))
      return;

    $_new_lunches        = $request->getParam('selectedLunchRecipes');
    $_persisting_lunches = Mage::helper("recomiendo_menus")->normalizeAfterSaveObject($_lunches, $_new_lunches);
    $this->setRecipesPerMenu(true, $_persisting_lunches);
  }

  public function setRecipesPerMenuDinner(Varien_Event_Observer $observer)
  {
    $request  = Mage::app()->getFrontController()->getRequest();
    $_post    = Mage::app()->getRequest()->getPost();
    $_dinners = $_post['recipes']['dinner'];
    if (!in_array("dinner", array_keys($_post['recipes'])))
      return;

    $_new_dinners        = $request->getParam('selectedDinnerRecipes');
    $_persisting_dinners = Mage::helper("recomiendo_menus")->normalizeAfterSaveObject($_dinners, $_new_dinners);
    $this->setRecipesPerMenu(false, $_persisting_dinners);
  }

  private function setRecipesPerMenu($isLunch, $newOnes)
  {
    $request = Mage::app()->getFrontController()->getRequest();
    $_id = $request->getParam('id');

    if ($newOnes){
      Mage::getModel('recomiendo_menus/relation_menu_recipe')
        ->getCollection()
        ->addFieldToFilter('entity_id', $_id)
        ->addFieldToFilter('is_lunch', $isLunch)
        ->walk('delete');

      foreach ($newOnes as $_recipe_id)
      {
        Mage::getModel('recomiendo_menus/relation_menu_recipe')
          ->setRecipeId($_recipe_id)
          ->setEntityId($_id)
          ->setIsLunch($isLunch)
          ->save();
      }
    }
  }

  public function addMassactionToProductGrid($observer)
  {
    $block = $observer->getBlock();
    if($block instanceof Mage_Adminhtml_Block_Catalog_Product_Grid){

      $sets = Mage::getResourceModel('eav/entity_attribute_set_collection')
        ->setEntityTypeFilter(Mage::getModel('catalog/product')->getResource()->getTypeId())
        ->load()
        ->toOptionHash();

      $block->getMassactionBlock()->addItem('recomiendo_changeattributeset', array(
        'label'=> Mage::helper('catalog')->__('Change attribute set'),
        'url'  => $block->getUrl('*/*/changeattributeset', array('_current'=>true)),
        'additional' => array(
          'visibility' => array(
            'name' => 'attribute_set',
            'type' => 'select',
            'class' => 'required-entry',
            'label' => Mage::helper('catalog')->__('Attribute Set'),
            'values' => $sets
          )
        )
      ));
    }
  }
}

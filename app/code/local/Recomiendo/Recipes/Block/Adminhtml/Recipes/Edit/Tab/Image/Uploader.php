
<?php
/**
 * Recipes List admin edit form container
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Block_Adminhtml_Recipes_Edit_Tab_Image_Uploader extends Mage_Adminhtml_Block_Media_Uploader
{
  public function __construct()
  {
    parent::__construct();
    $this->setTemplate('recomiendo/recipes/edit/tab/image/uploader.phtml');
  }

  public function getRecipeImages()
  {
    $_id = $this->getRequest()->getParams('id');
    $_id = $_id['id'];
    $collection =  Mage::getResourceModel('recomiendo_recipes/relation_recipe_image_collection')
      ->addFieldToFilter('recipe_id', $_id);
    $_items = $collection->getItems();

    foreach ($_items as $item){
      $result[] = $item->getData();
    }
    return $result;

  }

}

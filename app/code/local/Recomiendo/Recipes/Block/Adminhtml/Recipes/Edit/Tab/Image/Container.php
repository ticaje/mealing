<?php
/**
 * Recipes List admin edit form image tab
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Block_Adminhtml_Recipes_Edit_Tab_Image_Container extends Recomiendo_Recipes_Block_Adminhtml_Refactor_Edit_Tab_BaseMain
{
  protected $_entityLabel = "Imagenes";

  public function _prepareLayout()
  {
    $this->setTemplate('recomiendo/recipes/edit/tab/image/container.phtml');
    $uploader = $this->getLayout()->createBlock('recomiendo_recipes/adminhtml_recipes_edit_tab_image_uploader');
    $this->setChild('uploader', $uploader);
  }

  public function getTabLabel()
  {
    return Mage::helper('recomiendo_recipes')->__($this->_entityLabel);
  }
}

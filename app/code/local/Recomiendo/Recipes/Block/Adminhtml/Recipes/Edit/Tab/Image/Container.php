<?php
/**
 * Recipes List admin edit form image tab
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Block_Adminhtml_Recipes_Edit_Tab_Image_Container
   extends Mage_Adminhtml_Block_Widget
  implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
  protected $_entityName  = "Imagenes";
  protected $_entityLabel = "Imagenes";

  public function _prepareLayout()
  {
    $this->setTemplate('recomiendo/recipes/edit/tab/image/container.phtml');
    $uploader = $this->getLayout()->createBlock('recomiendo_recipes/adminhtml_recipes_edit_tab_image_uploader');
    $this->setChild('uploader', $uploader);
    //parent::_prepareLayout();
  }

  /**
   * Prepare label for tab
   *
   * @return string
   */
  public function getTabLabel()
  {
    return Mage::helper('recomiendo_recipes')->__('Imagenes');
  }

  /**
   * Prepare title for tab
   *
   * @return string
   */
  public function getTabTitle()
  {
    return Mage::helper('recomiendo_recipes')->__('Imagenes');
  }

  /**
   * Returns status flag about this tab can be showen or not
   *
   * @return true
   */
  public function canShowTab()
  {
    return true;
  }

  /**
   * Returns status flag about this tab hidden or not
   *
   * @return true
   */
  public function isHidden()
  {
    return false;
  }

  /**
   * Retrieve predefined additional element types
   *
   * @return array
   */
  protected function _getAdditionalElementTypes()
  {
    return array(
      'image' => Mage::getConfig()->getBlockClassName('recomiendo_recipes/adminhtml_recipes_edit_form_element_image')
    );
  }
}

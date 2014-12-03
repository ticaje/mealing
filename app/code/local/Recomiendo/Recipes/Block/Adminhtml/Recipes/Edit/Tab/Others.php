<?php
/**
 * Other codifiers for recipe admin tab
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Block_Adminhtml_Recipes_Edit_Tab_Others
  extends Mage_Adminhtml_Block_Widget_Form
  implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
  /**
   *
   * @return Recomiendo_Recipes_Block_Adminhtml_Providers_Edit_Tab_Others
   */

  protected $model = array();

  public function __construct()
  {
    $this->model['current']     = Mage::getSingleton('recomiendo_recipes/recipe');
    parent::__construct();
  }

  protected function _prepareLayout()
  {
    parent::_prepareLayout();
    return $this;
  }

  /**
   * Prepares tab form
   *
   * @return Mage_Adminhtml_Block_Widget_Form
   */
  protected function _prepareForm()
  {
    /**
     * Checking if user have permissions to save information
     */
    if (Mage::helper('recomiendo_recipes/admin')->isActionAllowed('save')) {
      $isElementDisabled = false;
    } else {
      $isElementDisabled = true;
    }

    $form = new Varien_Data_Form();

    $form->setHtmlIdPrefix('ingredients_content_');

    $fieldset = $form->addFieldset('content_fieldset', array(
      'legend' => Mage::helper('recomiendo_recipes')->__('Ingredientes'),
      'class'  => 'fieldset-wide'
    ));

    $_id = $this->getRequest()->getParams('params')['id'];

    $utils = $this->model['current']->getEntityValuesForForm("util", $_id, "UtilId", "Name");
    $fieldset->addField('utils', 'multiselect', array(
      'name'     => 'utils[]',
      'label'    => Mage::helper('recomiendo_recipes')->__('Utensilios y Equipos'),
      'title'    => Mage::helper('recomiendo_recipes')->__('Utensilios y Equipos'),
      'required' => true,
      'values'   => $utils['values'],
    ), 'frontend_class');
    //print_r($utils);

    $socialgroups = $this->model['current']->getEntityValuesForForm("socialgroup", $_id, "SocialgroupId", "Name");
    $fieldset->addField('socialgroups', 'multiselect', array(
      'name'     => 'socialgroups[]',
      'label'    => Mage::helper('recomiendo_recipes')->__('Grupos'),
      'title'    => Mage::helper('recomiendo_recipes')->__('Grupos'),
      'required' => true,
      'values'   => $socialgroups['values'],
    ), 'frontend_class');

    $categories = $this->model['current']->getEntityValuesForForm("recipetype", $_id, "RecipetypeId", "Name");
    $fieldset->addField('recipetypes', 'multiselect', array(
      'name'     => 'recipetypes[]',
      'label'    => Mage::helper('recomiendo_recipes')->__('Categorias'),
      'title'    => Mage::helper('recomiendo_recipes')->__('Categorias'),
      'required' => true,
      'values'   => $categories['values'],
    ), 'frontend_class');


    $form->setValues($this->model['current']->getData());
    $this->setForm($form);

    $form->getElement('utils')->setValue($utils['selected']);
    $form->getElement('recipetypes')->setValue($categories['selected']);
    $form->getElement('socialgroups')->setValue($socialgroups['selected']);

    return parent::_prepareForm();
  }

  /**
   * Prepare label for tab
   *
   * @return string
   */
  public function getTabLabel()
  {
    return Mage::helper('recomiendo_recipes')->__('Otros Datos');
  }

  /**
   * Prepare title for tab
   *
   * @return string
   */
  public function getTabTitle()
  {
    return Mage::helper('recomiendo_recipes')->__('Otros Datos');
  }

  /**
   * Returns status flag about this tab can be shown or not
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
}

<?php
/**
 * Ingredienttypes List admin edit form main tab
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Block_Adminhtml_Ingredienttypes_Edit_Tab_Main extends Recomiendo_Recipes_Block_Adminhtml_Refactor_Edit_Tab_BaseMain
{

  protected $_entityLabel = "Tipos Ingrediente";
  /**
   * Prepare form elements for tab
   *
   * @return Mage_Adminhtml_Block_Widget_Form
   */
  protected function _prepareForm()
  {
    $model = Mage::helper('recomiendo_recipes')->getEntityItemInstance("ingredienttypeItemInstance", "ingredienttypes_item");

    /**
     * Checking if user have permissions to save information
     */
    if (Mage::helper('recomiendo_recipes/admin')->isActionAllowed('save')) {
      $isElementDisabled = false;
    } else {
      $isElementDisabled = true;
    }

    $form = new Varien_Data_Form();

    $form->setHtmlIdPrefix('ingredienttypes_main_');

    $fieldset = $form->addFieldset('base_fieldset', array(
      'legend' => Mage::helper('recomiendo_recipes')->__('Información de tipo ingrediente')
    ));

    if ($model->getId()) {
      $fieldset->addField('ingredienttype_id', 'hidden', array(
        'name' => 'ingredienttype_id',
      ));
    }

    $fieldset->addField('name', 'text', array(
      'name'     => 'name',
      'label'    => Mage::helper('recomiendo_recipes')->__('Nombre'),
      'title'    => Mage::helper('recomiendo_recipes')->__('Nombre'),
      'required' => true,
      'disabled' => $isElementDisabled
    ));

    Mage::dispatchEvent('adminhtml_ingredients_edit_tab_main_prepare_form', array('form' => $form));

    $data = $model->getData();
    $form->setValues($data);
    $this->setForm($form);

    return parent::_prepareForm();
  }

}

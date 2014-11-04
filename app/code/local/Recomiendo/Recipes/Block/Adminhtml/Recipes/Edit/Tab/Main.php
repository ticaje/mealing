<?php
/**
 * Recipes List admin edit form main tab
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Block_Adminhtml_Recipes_Edit_Tab_Main extends Recomiendo_Recipes_Block_Adminhtml_Refactor_Edit_Tab_BaseMain
{

  protected $_entityLabel = "Recetas";
  /**
   * Prepare form elements for tab
   *
   * @return Mage_Adminhtml_Block_Widget_Form
   */
  protected function _prepareForm()
  {
    $model = Mage::helper('recomiendo_recipes')->getEntityItemInstance("recipeItemInstance", "recipes_item");

    /**
     * Checking if user have permissions to save information
     */
    if (Mage::helper('recomiendo_recipes/admin')->isActionAllowed('save')) {
      $isElementDisabled = false;
    } else {
      $isElementDisabled = true;
    }

    $form = new Varien_Data_Form();

    $form->setHtmlIdPrefix('recipes_main_');

    $fieldset = $form->addFieldset('base_fieldset', array(
      'legend' => Mage::helper('recomiendo_recipes')->__('Información de receta')
    ));

    if ($model->getId()) {
      $fieldset->addField('recipe_id', 'hidden', array(
        'name' => 'recipe_id',
      ));
    }

    $fieldset->addField('name', 'text', array(
      'name'     => 'name',
      'label'    => Mage::helper('recomiendo_recipes')->__('Nombre'),
      'title'    => Mage::helper('recomiendo_recipes')->__('Nombre'),
      'required' => true,
      'disabled' => $isElementDisabled
    ));

    $fieldset->addField('time', 'text', array(
      'name'     => 'time',
      'label'    => Mage::helper('recomiendo_recipes')->__('Tiempo en minutos'),
      'title'    => Mage::helper('recomiendo_recipes')->__('Tiempo'),
      'required' => true,
      'disabled' => $isElementDisabled
    ));

    $fieldset->addField('published_at', 'date', array(
      'name'     => 'published_at',
      'format'   => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
      'image'    => $this->getSkinUrl('images/grid-cal.gif'),
      'label'    => Mage::helper('recomiendo_recipes')->__('Publicado'),
      'title'    => Mage::helper('recomiendo_recipes')->__('Publicado'),
      'required' => true
    ));

    Mage::dispatchEvent('adminhtml_recipes_edit_tab_main_prepare_form', array('form' => $form));

    $form->setValues($model->getData());
    $this->setForm($form);

    return parent::_prepareForm();
  }

}

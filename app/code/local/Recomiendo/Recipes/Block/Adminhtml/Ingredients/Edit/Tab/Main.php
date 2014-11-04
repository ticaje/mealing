<?php
/**
 * Ingredients List admin edit form main tab
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Block_Adminhtml_Ingredients_Edit_Tab_Main
    extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    /**
     * Prepare form elements for tab
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $model = Mage::helper('recomiendo_recipes')->getIngredientItemInstance();

        /**
         * Checking if user have permissions to save information
         */
        if (Mage::helper('recomiendo_recipes/admin')->isActionAllowed('save')) {
            $isElementDisabled = false;
        } else {
            $isElementDisabled = true;
        }

        $form = new Varien_Data_Form();

        $form->setHtmlIdPrefix('ingredients_main_');

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend' => Mage::helper('recomiendo_recipes')->__('Información de ingrediente')
        ));

        if ($model->getId()) {
            $fieldset->addField('ingredient_id', 'hidden', array(
                'name' => 'ingredient_id',
            ));
        }

        $fieldset->addField('name', 'text', array(
          'name'     => 'name',
          'label'    => Mage::helper('recomiendo_recipes')->__('Nombre'),
          'title'    => Mage::helper('recomiendo_recipes')->__('Nombre'),
          'required' => true,
          'disabled' => $isElementDisabled
        ));

        $ingredients = Mage::getSingleton('recomiendo_recipes/codifier_ingredienttype')->getIngredienttypeValuesForForm($model->getId());
        $fieldset->addField('ingredienttype_id', 'multiselect', array(
          'name'     => 'ingredienttypes[]',
          'label'    => Mage::helper('recomiendo_recipes')->__('Tipo ingrediente'),
          'title'    => Mage::helper('recomiendo_recipes')->__('Tipo ingrediente'),
          'required' => true,
          'values'   => $ingredients['values'],
        ), 'frontend_class');

        Mage::dispatchEvent('adminhtml_ingredients_edit_tab_main_prepare_form', array('form' => $form));

        $data = $model->getData();
        $form->setValues($data);
        $this->setForm($form);

        $form->getElement('ingredienttype_id')->setValue($ingredients['selected']);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return Mage::helper('recomiendo_recipes')->__('Información de ingrediente');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return Mage::helper('recomiendo_recipes')->__('Información de ingrediente');
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

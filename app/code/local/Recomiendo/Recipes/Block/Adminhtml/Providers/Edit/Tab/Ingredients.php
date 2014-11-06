<?php
/**
 * Providers List admin edit form content tab
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Block_Adminhtml_Providers_Edit_Tab_Ingredients
    extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    /**
     *
     * @return Recomiendo_Recipes_Block_Adminhtml_Providers_Edit_Tab_Ingredients
     */
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
        $model = Mage::getSingleton('recomiendo_recipes/codifier_ingredient');

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
        $ingredients = $model->getIngredientsValuesForForm($_id);

        $fieldset->addField('ingredients', 'multiselect', array(
          'name'     => 'ingredients[]',
          'label'    => Mage::helper('recomiendo_recipes')->__('Ingredientes'),
          'title'    => Mage::helper('recomiendo_recipes')->__('Ingredientes'),
          'required' => true,
          'values'   => $ingredients['values'],
        ), 'frontend_class');

        Mage::dispatchEvent('adminhtml_providers_edit_tab_ingredients_prepare_form', array('form' => $form));

        $form->setValues($model->getData());
        $this->setForm($form);

        $form->getElement('ingredients')->setValue($ingredients['selected']);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return Mage::helper('recomiendo_recipes')->__('Ingredientes');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return Mage::helper('recomiendo_recipes')->__('Ingredients');
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

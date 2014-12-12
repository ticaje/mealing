<?php
/**
 * Pricerules_Sets List admin edit form main tab
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Menus_Block_Adminhtml_Pricerules_Sets_Edit_Tab_Main extends Recomiendo_Menus_Block_Adminhtml_Refactor_Edit_Tab_BaseMain
{

    protected $_entityLabel = "Plantillas";
    /**
     * Prepare form elements for tab
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $model = Mage::helper('recomiendo_menus')->getEntityItemInstance("pricerulesSetItemInstance", "sets_item");

        /**
         * Checking if user have permissions to save information
         */
        if (Mage::helper('recomiendo_menus/admin')->isActionAllowed('save')) {
            $isElementDisabled = false;
        } else {
            $isElementDisabled = true;
        }

        $form = new Varien_Data_Form();

        $form->setHtmlIdPrefix('rule_set_main_');

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend' => Mage::helper('recomiendo_menus')->__('Información de Plantilla')
        ));

        if ($model->getId()) {
            $fieldset->addField('rule_set_id', 'hidden', array(
                'name' => 'rule_set_id',
            ));
        }

        $fieldset->addField('name', 'text', array(
          'name'     => 'name',
          'label'    => Mage::helper('recomiendo_menus')->__('Nombre'),
          'title'    => Mage::helper('recomiendo_menus')->__('Nombre'),
          'required' => true,
          'disabled' => $isElementDisabled
        ));

        $fieldset->addField('description', 'textarea', array(
          'name'     => 'description',
          'label'    => Mage::helper('recomiendo_menus')->__('Descripción'),
          'title'    => Mage::helper('recomiendo_menus')->__('Descripción'),
          'note'     => "Información general de este set",
          'required' => true,
          'disabled' => $isElementDisabled
        ));

        $formulas = Recomiendo_Menus_Model_Rule_set::getRuleSetFormulas();
        $fieldset->addField('price_formula_id', 'select', array(
          'label'    => Mage::helper('recomiendo_menus')->__('Formula a Utilizar'),
          'class'    => 'required-entry validate-select',
          'values'   => $formulas,
          'required' => true,
          'name'     => 'price_formula_id',
        ));

        $data = $model->getData();
        $form->setValues($data);
        $this->setForm($form);

        $form->getElement('price_formula_id')->setValue($model->getPriceFormulaId());
        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */

    /**
     * Prepare title for tab
     *
     * @return string
     */

    /**
     * Returns status flag about this tab can be shown or not
     *
     * @return true
     */

    /**
     * Returns status flag about this tab hidden or not
     *
     * @return true
     */

}

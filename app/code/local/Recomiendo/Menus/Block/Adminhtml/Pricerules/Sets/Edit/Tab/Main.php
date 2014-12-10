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

        $fieldset->addField('dishes_set', 'text', array(
          'name'     => 'dishes_set',
          'label'    => Mage::helper('recomiendo_menus')->__('Set de recetas'),
          'title'    => Mage::helper('recomiendo_menus')->__('Set de recetas'),
          'note'     => "Formato requerido: 3,5,7",
          'required' => true,
          'disabled' => $isElementDisabled
        ));

        $data = $model->getData();
        $form->setValues($data);
        $this->setForm($form);

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

<?php
/**
 * Zipcodes List admin edit form main tab
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Block_Adminhtml_Zipcodes_Edit_Tab_Main extends Recomiendo_Recipes_Block_Adminhtml_Refactor_Edit_Tab_BaseMain
{

    protected $_entityLabel = "Codigos Postales";
    /**
     * Prepare form elements for tab
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $model = Mage::helper('recomiendo_recipes')->getEntityItemInstance("zipcodeItemInstance", "zipcodes_item");

        /**
         * Checking if user have permissions to save information
         */
        if (Mage::helper('recomiendo_recipes/admin')->isActionAllowed('save')) {
            $isElementDisabled = false;
        } else {
            $isElementDisabled = true;
        }

        $form = new Varien_Data_Form();

        $form->setHtmlIdPrefix('zipcodes_main_');

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend' => Mage::helper('recomiendo_recipes')->__('Información de código postal')
        ));

        if ($model->getId()) {
            $fieldset->addField('zipcode_id', 'hidden', array(
                'name' => 'zipcode_id',
              ));
            $_label = "Número";
        }else{
          $_label = "Número o Desde(Rango)";
        }

        $fieldset->addField('number', 'text', array(
          'name'     => 'number',
          'label'    => Mage::helper('recomiendo_recipes')->__($_label),
          'title'    => Mage::helper('recomiendo_recipes')->__($_label),
          'style'    => 'width:50px;',
          'class'    => 'validate-zip validate-digits',
          'required' => true,
          'disabled' => $isElementDisabled
        ));

        $fieldset->addField('range', 'text', array(
          'name'     => 'range',
          'label'    => Mage::helper('recomiendo_recipes')->__('Hasta(Rango)'),
          'title'    => Mage::helper('recomiendo_recipes')->__('Hasta'),
          'style'     => 'width:50px;',
          'class'    => 'validate-zip validate-digits',
          'required' => false,
          'disabled' => $isElementDisabled
        ));

        $fieldset->addField('extra_price', 'text', array(
          'name'     => 'extra_price',
          'label'    => Mage::helper('recomiendo_recipes')->__('Multiplicador'),
          'title'    => Mage::helper('recomiendo_recipes')->__('Multiplicador'),
          'style'     => 'width:50px;',
          'class'    => 'validate-not-negative-number validate-number',
          'required' => true,
        ));

        $fieldset->addField('comment', 'textarea', array(
          'name'     => 'comment',
          'label'    => Mage::helper('recomiendo_recipes')->__('Comentarios'),
          'title'    => Mage::helper('recomiendo_recipes')->__('Comentarios'),
          'style'     => 'width:550px;',
          'required' => false,
        ));

        Mage::dispatchEvent('adminhtml_zipcodes_edit_tab_main_prepare_form', array('form' => $form));

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

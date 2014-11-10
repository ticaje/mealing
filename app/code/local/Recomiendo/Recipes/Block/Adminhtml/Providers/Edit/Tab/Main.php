<?php
/**
 * Providers List admin edit form main tab
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Block_Adminhtml_Providers_Edit_Tab_Main extends Recomiendo_Recipes_Block_Adminhtml_Refactor_Edit_Tab_BaseMain
{

    protected $_entityLabel = "Proveedores";
    /**
     * Prepare form elements for tab
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $model = Mage::helper('recomiendo_recipes')->getEntityItemInstance("providerItemInstance", "providers_item");

        /**
         * Checking if user have permissions to save information
         */
        if (Mage::helper('recomiendo_recipes/admin')->isActionAllowed('save')) {
            $isElementDisabled = false;
        } else {
            $isElementDisabled = true;
        }

        $form = new Varien_Data_Form();

        $form->setHtmlIdPrefix('providers_main_');

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend' => Mage::helper('recomiendo_recipes')->__('Información de proveedor')
        ));

        if ($model->getId()) {
            $fieldset->addField('provider_id', 'hidden', array(
                'name' => 'provider_id',
            ));
        }

        $fieldset->addField('name', 'text', array(
          'name'     => 'name',
          'label'    => Mage::helper('recomiendo_recipes')->__('Nombre'),
          'title'    => Mage::helper('recomiendo_recipes')->__('Nombre'),
          'required' => true,
        ));

        $fieldset->addField('social_reason', 'text', array(
          'name'     => 'social_reason',
          'label'    => Mage::helper('recomiendo_recipes')->__('Razón social'),
          'title'    => Mage::helper('recomiendo_recipes')->__('Razón social'),
          'required' => true,
        ));

        $fieldset->addField('nif', 'text', array(
          'name'     => 'nif',
          'label'    => Mage::helper('recomiendo_recipes')->__('NIF'),
          'title'    => Mage::helper('recomiendo_recipes')->__('NIF'),
          'required' => true,
        ));

        $fieldset->addField('address', 'text', array(
          'name'     => 'address',
          'label'    => Mage::helper('recomiendo_recipes')->__('Dirección particular'),
          'title'    => Mage::helper('recomiendo_recipes')->__('Dirección particular'),
          'required' => true,
        ));

        Mage::dispatchEvent('adminhtml_providers_edit_tab_main_prepare_form', array('form' => $form));

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

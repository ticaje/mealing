<?php
/**
 * Traceabilities List admin edit form main tab
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Block_Adminhtml_Traceabilities_Edit_Tab_Main extends Recomiendo_Recipes_Block_Adminhtml_Refactor_Edit_Tab_BaseMain
{

    protected $_entityLabel = "Trazas";
    /**
     * Prepare form elements for tab
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $model = Mage::helper('recomiendo_recipes')->getEntityItemInstance("traceabilityItemInstance", "traceabilities_item");

        /**
         * Checking if user have permissions to save information
         */
        if (Mage::helper('recomiendo_recipes/admin')->isActionAllowed('save')) {
            $isElementDisabled = false;
        } else {
            $isElementDisabled = true;
        }

        $form = new Varien_Data_Form();

        $form->setHtmlIdPrefix('traceabilities_main_');

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend' => Mage::helper('recomiendo_recipes')->__('Información de Trazas de proviciones')
        ));

        if ($model->getId()) {
            $fieldset->addField('traceability_id', 'hidden', array(
                'name' => 'traceability_id',
            ));
            $providerId   = $model->getProviderId();
            $ingredientId = $model->getIngredientId();
        }
        else{
        }

        $params = array("idname" => "ProviderId", "label" => "Name");
        $n_providers = Mage::helper('recomiendo_recipes/admin')->normalizeCollectionArrayForSelect("codifier_provider", $params);
        $providers = $n_providers['values'];

        $fieldset->addField('provider_id', 'select', array(
          'label'    => Mage::helper('recomiendo_recipes')->__('Proveedor'),
          'class'    => 'required-entry validate-select',
          'values'   => $providers,
          'required' => true,
          'name'     => 'provider_id',
        ));

        $params        = array("idname" => "IngredientId", "label" => "Name");
        $n_ingredients = Mage::helper('recomiendo_recipes/admin')->normalizeCollectionArrayForSelect("codifier_ingredient", $params);
        $ingredients   = $n_ingredients['values'];
        $fieldset->addField('ingredient_id', 'select', array(
          'label'    => Mage::helper('recomiendo_recipes')->__('Ingrediente'),
          'class'    => 'required-entry',
          'values'   => $ingredients,
          'required' => true,
          'name'     => 'ingredient_id',
        ));

        $fieldset->addField('stock_number', 'text', array(
          'name'     => 'stock_number',
          'label'    => Mage::helper('recomiendo_recipes')->__('Numero de Lote'),
          'required' => true,
          'disabled' => $isElementDisabled
        ));

        $fieldset->addField('expires_on', 'date', array(
          'name'     => 'expires_on',
          'format'   => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM),
          'image'    => $this->getSkinUrl('images/grid-cal.gif'),
          'label'    => Mage::helper('recomiendo_recipes')->__('Fecha Caducidad'),
          'required' => true
        ));

        $fieldset->addField('operations', 'textarea', array(
          'name'     => 'operations',
          'label'    => Mage::helper('recomiendo_recipes')->__('Operaciones'),
          'required' => false,
          'disabled' => $isElementDisabled
        ));

        $fieldset->addField('file', 'file', array(
          'name'     => 'file',
          'label'    => Mage::helper('recomiendo_recipes')->__('Archivo'),
          'required' => false,
          'disabled' => $isElementDisabled
        ));

        $fieldset->addField('adquired_on', 'date', array(
          'name'     => 'adquired_on',
          'format'   => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM),
          'image'    => $this->getSkinUrl('images/grid-cal.gif'),
          'label'    => Mage::helper('recomiendo_recipes')->__('Fecha Adquisición'),
          'required' => true
        ));

        Mage::dispatchEvent('adminhtml_traceabilities_edit_tab_main_prepare_form', array('form' => $form));

        $data = $model->getData();
        $form->setValues($data);
        $this->setForm($form);

        $form->getElement('provider_id')->setValue($providerId);
        $form->getElement('ingredient_id')->setValue($ingredientId);

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

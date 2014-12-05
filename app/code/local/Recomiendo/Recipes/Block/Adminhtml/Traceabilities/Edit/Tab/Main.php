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

        //$form = new Varien_Data_Form();
        $form = new Varien_Data_Form(
          array(
            'method' => 'post',
            'enctype' => 'multipart/form-data'
          )
        );

        $form->setHtmlIdPrefix('traceabilities_main_');

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend' => Mage::helper('recomiendo_recipes')->__('Información de Trazas de proviciones')
        ));

        if ($model->getId()) {
            $fieldset->addField('traceability_id', 'hidden', array(
                'name' => 'traceability_id',
            ));
            $data = $model->getData();
        }

        $invoicetypes = Recomiendo_Recipes_Model_Codifier_Traceability::getInvoiceTypes();
        $fieldset->addField('invoice_type', 'select', array(
          'label'    => Mage::helper('recomiendo_recipes')->__('Tipo de Documento'),
          'class'    => 'required-entry validate-select',
          'values'   => $invoicetypes,
          'required' => true,
          'name'     => 'invoice_type',
        ));

        $fieldset->addField('invoice_number', 'text', array(
          'name'     => 'invoice_number',
          'label'    => Mage::helper('recomiendo_recipes')->__('Numero de Documento'),
          'required' => true,
          'disabled' => $isElementDisabled
        ));

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

        $fieldset->addField('adquired_on', 'date', array(
          'name'     => 'adquired_on',
          'format'   => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM),
          'image'    => $this->getSkinUrl('images/grid-cal.gif'),
          'label'    => Mage::helper('recomiendo_recipes')->__('Fecha Adquisición'),
          'required' => true
        ));

        $fieldset->addType('file', Mage::getConfig()->getBlockClassName('recomiendo_recipes/adminhtml_traceabilities_helper_file'));
        $fieldset->addField('document', 'file', array(
          'name'     => 'document',
          'label'    => Mage::helper('recomiendo_recipes')->__('Archivo'),
          'required' => false,
          'showing'  => $data['invoice_number'],
          'file'     => $data['file'],
        ));
        $url = Mage::getSingleton('recomiendo_recipes/codifier_traceability_media_config')->getBaseMediaUrl();
        $data['document'] = $url.$data['file'];

        $form->setValues($data);
        $this->setForm($form);

        $form->getElement('provider_id')->setValue($model->getProviderId());
        $form->getElement('invoice_type')->setValue($model->getInvoiceType());

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

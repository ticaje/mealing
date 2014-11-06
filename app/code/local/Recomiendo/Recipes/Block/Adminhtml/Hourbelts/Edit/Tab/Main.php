<?php
/**
 * Hourbelts List admin edit form main tab
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Block_Adminhtml_Hourbelts_Edit_Tab_Main extends Recomiendo_Recipes_Block_Adminhtml_Refactor_Edit_Tab_BaseMain
{

    protected $_entityLabel = "Franja horaria";
    /**
     * Prepare form elements for tab
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $model = Mage::helper('recomiendo_recipes')->getEntityItemInstance("hourbeltItemInstance", "hourbelts_item");

        /**
         * Checking if user have permissions to save information
         */
        if (Mage::helper('recomiendo_recipes/admin')->isActionAllowed('save')) {
            $isElementDisabled = false;
        } else {
            $isElementDisabled = true;
        }

        $form = new Varien_Data_Form();

        $form->setHtmlIdPrefix('hourbelts_main_');

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend' => Mage::helper('recomiendo_recipes')->__('Franja Horaria')
        ));

        if ($model->getId()) {
            $fieldset->addField('hourbelt_id', 'hidden', array(
                'name' => 'hourbelt_id',
            ));
        }else{
          $model->setData('start', '00:00:00');
          $model->setData('finish', '00:00:00');
        }

        $fieldset->addField('name', 'text', array(
          'name'     => 'name',
          'label'    => Mage::helper('recomiendo_recipes')->__('Nombre Franja'),
          'title'    => Mage::helper('recomiendo_recipes')->__('Nombre Franja'),
          'required' => true,
          'disabled' => $isElementDisabled
        ));

        $fieldset->addField('start', 'text', array(
          'name'     => 'start',
          'label'    => Mage::helper('recomiendo_recipes')->__('Hora inicio'),
          'title'    => Mage::helper('recomiendo_recipes')->__('Hora inicio'),
          'required' => true,
          'disabled' => $isElementDisabled
        ));

        $fieldset->addField('finish', 'text', array(
          'name'     => 'finish',
          'label'    => Mage::helper('recomiendo_recipes')->__('Hora fin'),
          'title'    => Mage::helper('recomiendo_recipes')->__('Hora fin'),
          'required' => true,
          'disabled' => $isElementDisabled
        ));

        Mage::dispatchEvent('adminhtml_hourbelts_edit_tab_main_prepare_form', array('form' => $form));

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

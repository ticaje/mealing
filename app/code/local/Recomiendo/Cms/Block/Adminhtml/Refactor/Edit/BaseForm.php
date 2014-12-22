<?php
/**
 * Base List Admin Edit Form Block
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Cms_Block_Adminhtml_Refactor_Edit_BaseForm extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Prepare form action
     *
     * @return Recomiendo_Cms_Block_Adminhtml_Refactor_Edit_BaseForm
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array(
            'id'      => 'edit_form',
            'action'  => $this->getUrl('*/*/save'),
            'method'  => 'post',
            'enctype' => 'multipart/form-data'
        ));

        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}

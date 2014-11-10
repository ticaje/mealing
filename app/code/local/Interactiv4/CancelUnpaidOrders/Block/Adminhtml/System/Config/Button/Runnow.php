<?php

/**
 * Description of Runnow
 *
 * @author davidslater
 */
class Interactiv4_CancelUnpaidOrders_Block_Adminhtml_System_Config_Button_Runnow extends Mage_Adminhtml_Block_System_Config_Form_Field {

    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element) {

        $buttonBlock = $element->getForm()->getParent()->getLayout()->createBlock('adminhtml/widget_button');


        $data = array(
            'label' => Mage::helper('adminhtml')->__('Run now!'),
            'onclick' => 'setLocation(\'' . Mage::helper('adminhtml')->getUrl("i4cancelunpaidorders/adminhtml_index/index") . '\')',
            'class' => '',
        );

        $html = $buttonBlock->setData($data)->toHtml();

        return $html;
    }

}

?>

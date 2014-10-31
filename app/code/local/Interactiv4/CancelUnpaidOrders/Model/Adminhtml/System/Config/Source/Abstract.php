<?php

/**
 * Description of Abstract
 *
 * @author davidslater
 */
class Interactiv4_CancelUnpaidOrders_Model_Adminhtml_System_Config_Source_Abstract {

    /**
     *
     * @return Interactiv4_CancelUnpaidOrders_Helper_Data
     */
    protected function _getHelper() {
        return Mage::helper('i4cancelunpaidorders');
    }
    
    /**
     *
     * @param string $translateString
     * @return string
     */
    protected function __($translateString) {
        return $this->_getHelper()->__($translateString);
    }    
    
    /**
     *
     * @return array 
     */
    public function getOptions() {
        return array();
    }
    
    /**
     *
     * @return array 
     */
    public function toOptionArray() {
        $optionArray = array();
        foreach ($this->getOptions() as $value => $label) {
            $optionArray[] = array('value' => $value, 'label' => $label); 
        }
        return $optionArray;
    }        
    
}
?>

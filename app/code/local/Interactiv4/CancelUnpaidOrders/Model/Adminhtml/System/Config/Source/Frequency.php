<?php

/**
 * Description of Frequency
 *
 * @author davidslater
 */
class Interactiv4_CancelUnpaidOrders_Model_Adminhtml_System_Config_Source_Frequency extends Interactiv4_CancelUnpaidOrders_Model_Adminhtml_System_Config_Source_Abstract {

    public function toOptionArray() {
        return array(
            array(
                'value' => '*/5 * * * *',
                'label' => $this->__('Every 5 minutes')
            ), 
            array(
                'value' => '*/10 * * * *',
                'label' => $this->__('Every 10 minutes')
            ),          
            array(
                'value' => '*/20 * * * *',
                'label' => $this->__('Every 20 minutes')
            ),    
            array(
                'value' => '*/30 * * * *',
                'label' => $this->__('Every 30 minutes')
            ),                  
            array(
                'value' => '0 * * * *',
                'label' => $this->__('Hourly')
            ),
            array(
                'value' => '0 */2 * * *',
                'label' => $this->__('Every 2 hours')
            ),
            array(
                'value' => '0 */3 * * *',
                'label' => $this->__('Every 3 hours')
            ),
            array(
                'value' => '0 */4 * * *',
                'label' => $this->__('Every 4 hours')
            ),
            array(
                'value' => '0 */6 * * *',
                'label' => $this->__('Every 6 hours')
            ),
            array(
                'value' => '0 */12 * * *',
                'label' => $this->__('Every 12 hours')
            ),
            array(
                'value' => '0 0 * * *',
                'label' => $this->__('Daily')
            ),
        );
    }

}

?>

<?php

/**
 * Description of Orderdeliverystatus
 *
 * @author davidslater
 */
class Interactiv4_CancelUnpaidOrders_Model_Adminhtml_System_Config_Source_Maxage extends Interactiv4_CancelUnpaidOrders_Model_Adminhtml_System_Config_Source_Abstract {

    public function getOptions() {
        $options = array();
        $options[5] = $this->__("5 Minutes");
        $options[10] = $this->__("10 Minutes");
        $options[20] = $this->__("20 Minutes");
        $options[30] = $this->__("30 Minutes");
        $options[60] = $this->__("1 hour");
        $options[2 * 60] = $this->__("2 hours");
        $options[3 * 60] = $this->__("3 hours");
        $options[6 * 60] = $this->__("6 hours");
        $options[12 * 60] = $this->__("12 hours");
        $options[24 * 60] = $this->__("1 day");
        $options[2 * 24 * 60] = $this->__("2 days");
        $options[3 * 24 * 60] = $this->__("3 days");
        $options[7 * 24 * 60] = $this->__("1 week");
        $options[14 * 24 * 60] = $this->__("2 weeks");
        $options[30 * 24 * 60] = $this->__("30 days");
        return $options;
    }

}

?>

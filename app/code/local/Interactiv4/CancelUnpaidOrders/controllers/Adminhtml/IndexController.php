<?php

/**
 * Description of IndexController
 *
 * @author davidslater
 */
class Interactiv4_CancelUnpaidOrders_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action {

    /**
     * Se ejecuta el proceso del cron al pulsar el boton en config. 
     */
    public function indexAction() {
        $cron = Mage::getModel('i4cancelunpaidorders/cron'); /* @var $cron Interactiv4_CancelUnpaidOrders_Model_Cron */
        $message = $cron->cancelUnpaidOrders("Manual Invocation", true);   
        Mage::getSingleton('core/session')->addSuccess($message);
        $this->_redirect('adminhtml/system_config/edit/section/i4cancelunpaidorders');
    }
}

?>

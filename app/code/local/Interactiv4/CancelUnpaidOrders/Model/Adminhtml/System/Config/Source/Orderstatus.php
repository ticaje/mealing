<?php


/**
 * Description of Orderstatus
 *
 * @author davidslater
 */
class Interactiv4_CancelUnpaidOrders_Model_Adminhtml_System_Config_Source_Orderstatus extends Interactiv4_CancelUnpaidOrders_Model_Adminhtml_System_Config_Source_Abstract {
    protected static $_options = null;
    
    public function getOptions() {
        if (!is_array(self::$_options)) {
            self::$_options = array();
            
            $configStatuses = Mage::getModel('adminhtml/system_config_source_order_status'); /* @var $configStatuses Mage_Adminhtml_Model_System_Config_Source_Order_Status */ 
            foreach ($configStatuses->toOptionArray() as $configStatus) {
                self::$_options[$configStatus['value']] = $configStatus['label'];
            }
            $statuses = Mage::getResourceModel('sales/order_status_collection'); /* @var $statuses Mage_Sales_Model_Resource_Order_Status_Collection */
            foreach ($statuses as $status) {  /* @var $status Mage_Sales_Model_Order_Status */
                self::$_options[$status->getStatus()] = $status->getStoreLabel();
            }
        }
        return self::$_options;
    }
}

?>

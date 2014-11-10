<?php


class Interactiv4_CancelUnpaidOrders_Helper_Data extends Mage_Core_Helper_Abstract {

    /**
     *
     * @param string $field
     * @param mixed $store
     * @return mixed
     */
    public function getConfigData($field, $store = null) {
        $value = Mage::getStoreConfig("i4cancelunpaidorders/general/$field", $store);
        return $value;
    }
    
    /**
     *
     * @param mixed $store
     * @return boolean 
     */
    public function isActive($store = null) {
        return $this->getConfigData('active', $store) ? true : false;
    }
    
    
    
    /**
     *
     * @param mixed $store
     * @return array 
     */
    public function getStoreUnpaidOrderStatuses($store) {
        $storeStatuses = $this->getConfigData("cancelled_statuses", $store);
        return $storeStatuses ? explode(",", $storeStatuses) : array();
    }
    
    /**
     *
     * @param mixed $store
     * @return string 
     */
    public function getStoreStartDate($store) {
        return $this->getConfigData("start_date", $store);
    }
    
    /**
     *
     * @param mixed $store
     * @return int 
     */
    public function getStoreMaxAgeSeconds($store) {
        $maxAgeMinutes = $this->getConfigData("max_age", $store);
        $maxAgeMinutes = $maxAgeMinutes ? $maxAgeMinutes : 0;
        $maxAgeSeconds = $maxAgeMinutes * 60;
        return $maxAgeSeconds;
    }
    

    /**
     * Grabar el mensaje pasado en el log de Servired (i4cancelunpaidorders).
     * @param string $message
     * @return string 
     */
    public function log($message) {
        Mage::log($message, null, 'i4cancelunpaidorders.log',true);
        return true;
    }

    
 
    
}

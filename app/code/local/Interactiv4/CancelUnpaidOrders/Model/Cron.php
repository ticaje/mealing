<?php

class Interactiv4_CancelUnpaidOrders_Model_Cron {

    const MAX_ORDERS = 1000;
    const MAX_ITERATIONS = 100;
    
    const MAX_ORDERS_MANUAL_INVOCATION = 50;
    
    protected $_manualInvocation = false;
    
    protected $_totalOrdersProcessed = 0;
    
    /**
     *
     * @param boolean $manualInvocation
     * @return string 
     */
    public function cancelUnpaidOrders($schedule, $manualInvocation = false) {
        if (!$this->_getHelper()->isActive() && !$manualInvocation) {
            $this->_log('Interactiv4 Cancel Unpaid Orders is not active.');
            return;
        }
        
        $this->_manualInvocation = $manualInvocation;

        $this->_log('Starting cancellation of unpaid orders ...');
        if ($this->_manualInvocation) {
            $this->_log("(Manual Invocation)");
        } else {
            $this->_log("(Scheduled Invocation)");
        }

        $notifications = array();
        $this->_totalOrdersProcessed = 0;
        foreach (Mage::app()->getStores() as $store) {
            $notifications = array_merge($notifications, $this->_cancelStoreUnpaidOrders($store));
            if ($this->_manualInvocationLimitReached()) {
                break;
            }
        }

        if ($notifications) {
            if ($this->_manualInvocationLimitReached()) {
                array_unshift($notifications, $this->_getHelper()->__("(Process terminated after manual invocation limit was reached)"));
            }
            array_unshift($notifications, $this->_getHelper()->__("%s Orders Processed as follows", $this->_totalOrdersProcessed));

        } else {
            $notifications[] = $this->_getHelper()->__("There are no orders to cancel at this time.");
        }
        $this->_log("Finished cancelling unpaid orders");

        return implode("<br />", $notifications);
        
    }

    /**
     *
     * @param Mage_Core_Model_Store $store 
     */
    protected function _cancelStoreUnpaidOrders(Mage_Core_Model_Store $store) {
        if (!$this->_getHelper()->getStoreUnpaidOrderStatuses($store)) {
            $this->_log("No unpaid order statuses specified for store {$store->getName()} ... moving on to the next store.");
            return;
        }
        $this->_log("Starting processing of unpaid orders for store {$store->getName()}");

        $batchNumber = 1;
        $currentTimeStamp = time();
        $notifications = array();
        while ($batchNumber <= self::MAX_ITERATIONS) {
            try {
                $unpaidOrders = $this->_getStoreUnpaidOrders($store, $currentTimeStamp);
                $count = $unpaidOrders->count();
                if (!$count) { // No hay más pedidos que procesar.
                    break;
                }
                
                $this->_log("Processing batch number $batchNumber for store {$store->getName()} considering $count orders for cancellation.");
                $notifications = array_merge($notifications, $this->_processUnpaidOrders($unpaidOrders));
                
                
                if ($count < self::MAX_ORDERS || $this->_manualInvocationLimitReached()) { // Si había menos del máximo en la úlitma iteración es que hemos terminado.
                    break;
                }
                $batchNumber++;


            } catch (Exception $e) {
                $message = "An error occurred whilst cancelling orders ... aborting: %s";
                $notifications[] = $this->_getHelper()->__($message, $e->getMessage());
                $this->_log(sprintf($message, $e->getMessage()));
                break;
            }
        }

        $this->_log("Finished processing cancelled orders for store {$store->getName()}. Processed {$this->_totalOrdersProcessed} orders in $batchNumber batches");
        return $notifications;
    }

    /**
     *
     * @param Mage_Core_Model_Store $store
     * @param int $currentTimeStamp
     * @return Mage_Sales_Model_Resource_Order_Collection 
     */
    protected function _getStoreUnpaidOrders(Mage_Core_Model_Store $store, $currentTimeStamp) {
        $unpaidOrders = Mage::getResourceModel('sales/order_collection'); /* @var $unpaidOrders Mage_Sales_Model_Resource_Order_Collection */
        $unpaidOrders->addFieldToFilter("i4processed_by_cancel_unpaid", array("neq" => 1))
                ->addFieldToFilter("status", array("in" => $this->_getHelper()->getStoreUnpaidOrderStatuses($store)))
                ->addFieldToFilter("store_id", $store->getId());
        $startDate = $this->_getHelper()->getStoreStartDate($store);
        if ($startDate) {
            $unpaidOrders->addFieldToFilter("created_at", array('gteq' => $startDate));
        }

        // Sólo consideramos pedidos que se han creado desde hace el tiempo especificado en el config. 
        $endDateTimeStamp = $currentTimeStamp - $this->_getHelper()->getStoreMaxAgeSeconds($store);
        $endDate = gmdate('Y-m-d H:i:s', $endDateTimeStamp);
        $unpaidOrders->addFieldToFilter("created_at", array('lteq' => $endDate));

        // Para no sobrecargar la colección sacamos solo los primeros x pedidos
        $unpaidOrders->setPage(1, self::MAX_ORDERS);
        
        $select = (string) $unpaidOrders->getSelect();
        $this->_log($select);

        return $unpaidOrders;
    }

    /**
     *
     * @param Mage_Sales_Model_Resource_Order_Collection $unpaidOrders
     * @return array 
     */
    protected function _processUnpaidOrders(Mage_Sales_Model_Resource_Order_Collection $unpaidOrders) {
        $notificationMessages = array();
        foreach ($unpaidOrders as $unpaidOrder) { /* @var $unpaidOrder Mage_Sales_Model_Order */
            $errorMessage = "";
            try {
                $unpaidOrder->setData('i4processed_by_cancel_unpaid', 1); // Seteamos un flag para no volver a considerar este pedido.
                if ($unpaidOrder->canCancel()) {
                    $unpaidOrder->cancel();
                    $unpaidOrder->addStatusHistoryComment($this->_getHelper()->__("Order cancelled by Interactiv4 Cancel Unpaid Orders"));
                    $message = "Order %s from store %s cancelled by Interactiv4 Cancel Unpaid Orders";
                } else {
                    $unpaidOrder->addStatusHistoryComment($this->_getHelper()->__("Interactiv4 Cancel Unpaid Orders attempted to cancel this order, but the order could not be cancelled. No further attempts will be made."));
                    $message = "Unable to cancel order %s from store %s. No further attempts will be made.";
                }
                $unpaidOrder->save();
            } catch (Exception $e) {
                $errorMessage = $e->getMessage() ? $e->getMessage() : get_class($e);
                $message = "An error occurred whilst trying to cancel order %s from store %s. No further attempts will be made to cancel the order automatically. Attempt manual cancellation.";
            }
            $notificationMessages[] = $this->_getHelper()->__($message, $unpaidOrder->getIncrementId(), $unpaidOrder->getStore()->getName());
            $this->_log(sprintf($message, $unpaidOrder->getIncrementId(), $unpaidOrder->getStore()->getName()));

            if ($errorMessage) {
                $notificationMessages[] = $this->_getHelper()->__("Error detail: %s", $errorMessage);
                $this->_log(sprintf("Error detail: %s", $errorMessage));
                try { // Intentamos actualizar el pedido con la información del error.
                    $unpaidOrder->addStatusHistoryComment($this->_getHelper()->__("Interactiv4 Cancel Unpaid Orders attempted to cancel this order, but an error occurred. No further attempts will be made. Error Detail: %s", $errorMessage));
                    $unpaidOrder->setData('i4processed_by_cancel_unpaid', 1);
                    $unpaidOrder->save();
                } catch (Exception $e) {
                    // pasa.
                }
            }
            $this->_totalOrdersProcessed++;
            if ($this->_manualInvocationLimitReached()) {
                break;
            }
         }
        return $notificationMessages;
    }
    
    /**
     *
     * @return boolean 
     */
    protected function _manualInvocationLimitReached() {
        return $this->_manualInvocation && $this->_totalOrdersProcessed >= self::MAX_ORDERS_MANUAL_INVOCATION;
    }

    /**
     *
     * @return Mage_Sales_Model_Resource_Order_Collection 
     */
    protected function _getUnpaidOrdersCollection() {
        $collection = Mage::getResourceModel('sales/order_collection'); /* @var $collection Mage_Sales_Model_Resource_Order_Collection */
        $collection->addFieldToFilter("i4processed_by_cancel_unpaid", array("neq" => 1))
                ->addFieldToFilter("status", array("in" => $this->_getHelper()->getAllUnpaidOrderStatuses()))
                ->addFieldToFilter("store_id", array("in" => $this->_getHelper()->getActiveStoreIds()));
        $collection->getSelect()->limit(self::MAX_ORDERS);
        return $collection;
    }

    /**
     *
     * @return Interactiv4_CancelUnpaidOrders_Helper_Data
     */
    protected function _getHelper() {
        return Mage::helper('i4cancelunpaidorders');
    }

    /**
     *
     * @param string $message
     * @return boolean 
     */
    protected function _log($message) {
        return $this->_getHelper()->log($message);
    }

}
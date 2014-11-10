<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cronexpr
 *
 * @author davidslater
 */
class Interactiv4_CancelUnpaidOrders_Model_Adminhtml_System_Config_Data_Startdate extends Mage_Core_Model_Config_Data {

    protected function _afterSave() {
        $phpTimeZone = date_default_timezone_get();
        try {
            $startDateValues = $this->getData('groups/general/fields/start_date');
            if (!is_array($startDateValues) || !array_key_exists('value', $startDateValues) || !$startDateValues['value']) {
                return $this;
            }
            $startDate = $startDateValues['value'];
            
            $dateFormat = Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
            $locale = Mage::app()->getLocale()->getLocale();           
            if (!Zend_Locale_Format::checkDateFormat($startDate, array('date_format' => $dateFormat, 'locale' => $locale))) {
                throw new Exception($this->_getHelper()->__("The start date format is not valid."));
            }
            
            $magentoTimeZone = Mage::app()->getStore()->getConfig('general/locale/timezone');
            date_default_timezone_set($magentoTimeZone);

            $parsed = Zend_Locale_Format::getDate($startDate, array('date_format' => $dateFormat, 'locale' => $locale));
            $saveDate = new Zend_Date($parsed);
            $saveDate->setTimezone('UTC');
            
            $saveDateStr = $saveDate->toString("YYYY-MM-dd HH:mm:ss");
            
            date_default_timezone_set($phpTimeZone);
            
            Mage::getModel('core/config_data')
                    ->load('i4cancelunpaidorders/general/start_date', 'path')
                    ->setValue($saveDateStr)
                    ->setPath('i4cancelunpaidorders/general/start_date')
                    ->save();
        } catch (Exception $e) {
            date_default_timezone_set($phpTimeZone);
            Mage::throwException($this->_getHelper()->__("Unable to save start date: %s", $e->getMessage()));
        }
    }
    
    /**
     *
     * @return Interactiv4_CancelUnpaidOrders_Helper_Data
     */
    protected function _getHelper() {
        return Mage::helper('i4cancelunpaidorders');
    }

}

?>

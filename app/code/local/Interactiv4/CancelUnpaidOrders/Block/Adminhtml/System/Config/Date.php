<?php

/**
 * Description of Date
 *
 * @author davidslater
 */
class Interactiv4_CancelUnpaidOrders_Block_Adminhtml_System_Config_Date extends Mage_Adminhtml_Block_System_Config_Form_Field {

    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element) {
        $date = new Varien_Data_Form_Element_Date;


        $data = array(
            'name' => $element->getName(),
            'html_id' => $element->getId(),
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
        );
        $date->setData($data);


        $rawDateValueUTC = (string) $element->getValue();
        if ($rawDateValueUTC) {
            $phpTimeZone = date_default_timezone_get();
            $magentoTimeZone = Mage::app()->getStore()->getConfig('general/locale/timezone');
            $format = Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
            date_default_timezone_set('UTC');
            try {
                $dateUtc = new Zend_Date($rawDateValueUTC, Zend_Date::ISO_8601);
                $dateUtc->setTimezone($magentoTimeZone);
                $date->setValue($dateUtc->toString("YYYY-MM-dd"), $format);
            } catch (Exception $e) {
                
            }
            date_default_timezone_set($phpTimeZone);
        }

        $date->setFormat(Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT));
        $date->setForm($element->getForm());

        return $date->getElementHtml();
    }

}

?>

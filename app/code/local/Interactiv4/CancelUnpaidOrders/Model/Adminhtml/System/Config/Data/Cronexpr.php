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
class Interactiv4_CancelUnpaidOrders_Model_Adminhtml_System_Config_Data_Cronexpr extends Mage_Core_Model_Config_Data {

    const CRON_STRING_PATH = 'crontab/jobs/i4cancelunpaidorders/schedule/cron_expr';
    const CRON_MODEL_PATH = 'crontab/jobs/i4cancelunpaidorders/run/model';

    protected function _afterSave() {
        $cronExprString = $this->getData('groups/general/fields/cron_syntax');

        try {
            Mage::getModel('core/config_data')
                    ->load(self::CRON_STRING_PATH, 'path')
                    ->setValue($cronExprString)
                    ->setPath(self::CRON_STRING_PATH)
                    ->save();
            Mage::getModel('core/config_data')
                    ->load(self::CRON_MODEL_PATH, 'path')
                    ->setValue((string) Mage::getConfig()->getNode(self::CRON_MODEL_PATH))
                    ->setPath(self::CRON_MODEL_PATH)
                    ->save();
        } catch (Exception $e) {
            throw new Exception(Mage::helper('i4cancelunpaidorders')->__('Unable to save Cron expression'));
        }
    }

}

?>

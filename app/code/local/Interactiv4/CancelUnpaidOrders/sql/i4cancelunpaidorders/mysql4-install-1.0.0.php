<?php

$installer = new Mage_Sales_Model_Mysql4_Setup('sales_setup');

$installer->startSetup();

$installer->addAttribute('order', 'i4processed_by_cancel_unpaid', array('type' => 'int', 'default' => 0));

$installer->endSetup();

?>

<?php
/**
 * ServiRedPro
 *
 * @category    Interactiv4
 * @package     Interactiv4_ServiRedPro
 * @copyright   Copyright (c) 2012 Interactiv4 SL. (http://www.interactiv4.com)
 */
class Interactiv4_ServiRedPro_Model_Mysql4_Serviredpro_Refund extends Mage_Core_Model_Mysql4_Abstract
{
	protected function _construct()
	{
		$this->_init('serviredpro/serviredpro_refund', 'id');
	}
}
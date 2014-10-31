<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Checkout
 * @copyright   Copyright (c) 2013 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * ServiRedPro observer model
 *
 * @category   Interactiv4
 * @package    Interactiv4_ServiRedPro
 * @author     osaluena
 */
class Interactiv4_ServiRedPro_Model_Observer
{
    CONST REDIRECT_SERVIRED_MODULE = "serviredpro";
    CONST REDIRECT_SERVIRED_CONTROLLER = "payment";
    CONST REDIRECT_SERVIRED_ACTION = "redirect";

    public function unsetI4ServiredCookie(Varien_Event_Observer $observer) {

        $currentModule      = Mage::app()->getRequest()->getModuleName();
        $currentController  = Mage::app()->getRequest()->getControllerName();
        $currentAction  = Mage::app()->getRequest()->getActionName();

        if ($currentModule == self::REDIRECT_SERVIRED_MODULE && $currentController == self::REDIRECT_SERVIRED_CONTROLLER && $currentAction == self::REDIRECT_SERVIRED_ACTION) {
            return $this;
        }

        $cookieModel = Mage::app()->getCookie();
        $serviredCookie = $cookieModel->get('i4servired');

        if ($serviredCookie !== false) {
            $cookieModel->delete('i4servired');
        }
    }
}

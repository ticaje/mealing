<?php
/**
 * MagenMarket.com
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * DISCLAIMER
 *
 * Edit or modify this file with yourown risk.
 *
 * @category    Extensions
 * @package     Recomiendo_Cms free
 * @copyright   Copyright (c) 2013 MagenMarket. (http://www.magenmarket.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
**/
/* $Id: Cms.php 15 2013-11-05 07:30:45Z linhnt $ */

class Recomiendo_Cms_Block_Adminhtml_Slideshow extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_slideshow';
    $this->_blockGroup = 'recomiendo_cms';
    $this->_headerText = Mage::helper('recomiendo_cms')->__('Slideshow Items Manager');
    $this->_addButtonLabel = Mage::helper('recomiendo_cms')->__('Add Item');
    parent::__construct();
  }
}

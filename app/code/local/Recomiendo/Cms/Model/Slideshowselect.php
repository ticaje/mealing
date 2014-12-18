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
/* $Id: Cmsselect.php 15 2013-11-05 07:30:45Z linhnt $ */

class Recomiendo_Cms_Model_Slideshowselect
{
    public function toOptionArray()
    {
		$options = array();
		$collection = Mage::getModel('slideshow/slideshow')
			->getCollection()
			->addFieldToSelect('slideshow_id')
			->addFieldToSelect('title')
			->addFieldToFilter('status',1);

		foreach ($collection as $item){
			$options[] = array('value' => $item->getData('slideshow_id'), 'label' => $item->getData('title'));
		}
        return $options;
    }
}


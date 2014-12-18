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

class Recomiendo_Cms_Model_Slideshow extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('slideshow/slideshow');
    }

	public function getCollectionSlideshowData() {

		$collection = $this->getCollection()
			->addFieldToFilter('status',1)
			->orderBySort()
			/* ->addStoreFilter(Mage::app()->getStore()) */
		;
		if(Mage::getStoreConfig('slideshow_options/general/limited'))
		{
			$collection->setPageSize(Mage::getStoreConfig('slideshow_options/general/limited'));
		}

		return $collection;
	}
}

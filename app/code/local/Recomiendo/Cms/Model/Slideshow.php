<?php
/**
 * Home Page Slideshow item resource model
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Cms_Model_Slideshow extends Mage_Core_Model_Abstract
{
  public function _construct()
  {
    parent::_construct();
    $this->_init('recomiendo_cms/slideshow');
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

<?php
/**
 * Home Page Slideshow item resource model
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Cms_Model_Resource_Slideshow_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
  public function _construct()
  {
    parent::_construct();
    $this->_init('recomiendo_cms/slideshow');
  }

  public function orderBySort(){
    $this->getSelect()->order('sortorder');
    return $this;
  }
}

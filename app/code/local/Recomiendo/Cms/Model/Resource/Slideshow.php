<?php
/**
 * Home Page Slideshow item resource model
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Cms_Model_Resource_Slideshow extends Mage_Core_Model_Mysql4_Abstract
{
  public function _construct()
  {
    // Note that the slideshow_id refers to the key field in your database table.
    $this->_init('recomiendo_cms/slideshow', 'slideshow_id');
  }
}

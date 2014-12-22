<?php


class Recomiendo_Theme_Block_Page_Html_Custom_Pages_Carousel extends Mage_Page_Block_Html
{
  public function getMediaPath()
  {
    return Mage::getBaseUrl('media').'recomiendoslideshow/';
  }

  protected function _toHtml()
  {
    $collection = Mage::getModel('recomiendo_cms/slideshow')
      ->getCollection();

    $this->assign('slideitems', $collection);
    $this->assign('slideoptions', json_decode(json_encode(Mage::getStoreConfig('slideshow_options/general'))));

    return parent::_toHtml();
  }
}

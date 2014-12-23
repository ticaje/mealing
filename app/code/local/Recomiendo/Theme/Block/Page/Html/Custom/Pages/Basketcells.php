<?php


class Recomiendo_Theme_Block_Page_Html_Custom_Pages_Basketcells extends Mage_Page_Block_Html
{
  public function getCellsHtml()
  {
    $collection = Mage::getResourceModel('recomiendo_cms/basketcell_collection');
    $items = $collection->getItems();
    return $items;
  }
}

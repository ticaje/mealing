<?php


class Recomiendo_Theme_Block_Page_Html_Custom_Pages_Header extends Mage_Page_Block_Html_Header


  public function _construct()
  {
    echo "Paso por aqui"; exit;
    $this->setTemplate('partials/cart/header.phtml');
  }
?>

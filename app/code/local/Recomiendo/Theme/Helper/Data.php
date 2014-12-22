<?php
class Recomiendo_Theme_Helper_Data extends Mage_Core_Helper_Abstract
{
  public function recipeInfoRow($text)
  {
    return
      '<i class="fa fa-sun-o"></i>  &#183;
       <i class="fa fa-clock-o"></i>
       <span>'.$text.'</span>  &#183;
       <i class="fa fa-list-alt"></i>';
  }

  public function getStaticBlockIdentifier($blockId)
  {
    $locale = Mage::app()->getLocale()->getLocaleCode();
    $locale = explode("_", $locale);
    $locale = $locale[0];
    return $blockId."_".$locale;
  }
}
?>

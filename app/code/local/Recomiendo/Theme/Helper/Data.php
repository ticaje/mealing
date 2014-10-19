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
}
?>

<?php
/**
 * Recipes image helper
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Block_Adminhtml_Recipes_Helper_Image extends Varien_Data_Form_Element_Image
{
  public function getHtmlAttributes(){
    return array_merge(parent::getHtmlAttributes(), array('multiple'));
  }
}

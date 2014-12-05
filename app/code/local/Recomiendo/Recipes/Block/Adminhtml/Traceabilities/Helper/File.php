<?php
/**
 * Traceabilities block helper file
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Block_Adminhtml_Traceabilities_Helper_File extends Varien_Data_Form_Element_Abstract
{
  public function __construct($data){
    parent::__construct($data);
    $this->setType('file');
  }

  public function getElementHtml(){
    $html = '';
      $this->addClass('input-file');
      $html.= parent::getElementHtml();
      if ($this->getValue()) {
        $url = $this->_getUrl();
        if( !preg_match("/^http\:\/\/|https\:\/\//", $url) ) {
          $url = Mage::getSingleton('recomiendo_recipes/codifier_traceability_media_config')->getBaseMediaPathAddition().$url;
        }
        if ($this->existsFile()){
          $html .= '<br/><span>Ver documento: </span>';
          $html .= '<a target="_blank" href="'.$url.'">'.$this->getShowLabel().'</a> ';
        }
      }
      $html.= $this->_getDeleteHiddenInput();
    return $html;
  }

  protected function _getDeleteCheckbox(){
    $html = '';
    if ($this->getValue()) {
      $label = Mage::helper('recomiendo_recipes')->__('Delete File');
      $html .= '<span>';
      $html .= '<input type="checkbox" name="'.parent::getName().'[delete]" value="1" class="checkbox" id="'.$this->getHtmlId().'_delete"'.($this->getDisabled() ? ' disabled="disabled"': '').'/>';
      $html .= '<label for="'.$this->getHtmlId().'_delete"'.($this->getDisabled() ? ' class="disabled"' : '').'> '.$label.'</label>';
      $html .= $this->_getHiddenInput();
      $html .= '</span>';
    }
    return $html;
  }

  protected function _getDeleteHiddenInput()
  {
    $file = str_replace(Mage::getSingleton('recomiendo_recipes/codifier_traceability_media_config')->getBaseMediaUrl(), "", $this->_getUrl());
    return '<input type="hidden" name="'.parent::getName().'[value]" value="'.$file.'" />';
  }
  protected function _getHiddenInput(){
    return '<input type="hidden" name="'.parent::getName().'[value]" value="'.$this->getValue().'" />';
  }

  protected function _getUrl(){
    return $this->getValue();
  }

  protected function getShowLabel()
  {
    return $this->getData('showing');
  }

  protected function existsFile()
  {
    return !empty($this->getFile());
  }
  public function getName(){
    return $this->getData('name');
  }
}

<?php
/**
 * Hourbelt Rules Form
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Block_Adminhtml_Hourbelts_Edit_Tab_Rules
  extends Recomiendo_Recipes_Block_Adminhtml_Refactor_Edit_Tab_BaseMain implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    protected function _prepareLayout()
    {
      $this->setTemplate('recomiendo/hourbelts/edit/tab/main/rules.phtml');
      $this->setChild('add_button',
        $this->getLayout()->createBlock('adminhtml/widget_button')
        ->setData(array(
          'label'     => Mage::helper('catalog')->__('Grupo'),
          'onclick'   => 'rulesHandler.addItem()',
          'class' => 'add'
        )));
        parent::_prepareLayout();
    }

    public function getValues()
    {
      $_id = $this->getRequest()->getParams('id');
      $_id = $_id['id'];
      $collection =  Mage::getSingleton('recomiendo_recipes/hourbelt_rule')->getCollection()
        ->addFieldToFilter('hourbelt_id', $_id);
      return $collection->getItems();
    }

    public function createContentBlock($name)
    {
      $html = '
        <div style="margin: 10px;">
        <span><b id="hourbelt_rule"></b></span><br>
        <span><b> Cantidad: </b></span><input style="width:50px" type="text" id="rules_row___index___quantity" name="'.$name.'[__index__][quantity]"  value="" class="input-text require">
        <span><b> Precio: </b></span><input style="width:50px" type="text" id="rules_row___index___price" name="'.$name.'[__index__][price]"  value="" class="input-text require">
        <span><b> Orden: </b></span><input style="width:15px" type="text" id="rules_row___index___order" name="'.$name.'[__index__][order]"  value="" class="input-text require">
        </div>
        <script language="javascript" type="text/javascript" src="/js/tiny_mce/tiny_mce.js"></script>
        <script type="text/javascript">
          var rule = document.getElementById(\'hourbelt_rule\');
          var index = "__index__";
          rule.innerHTML = "<div style=\'color: black; background:#eee2be; padding: 2px 10px; border: 1px solid grey; \'>Regla</div>";
          //< ![CDATA[
          Event.observe(window, "load", function() {
            tinyMCE.init({
              mode : "exact",
              theme : "'.$this->getTheme().'",
              elements : "' . $element . '",
              theme_advanced_toolbar_location : "top",
              theme_advanced_toolbar_align : "left",
              theme_advanced_path_location : "bottom",
              extended_valid_elements : "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
              theme_advanced_resize_horizontal : "false",
              theme_advanced_resizing : "false",
              apply_source_formatting : "true",
              convert_urls : "false",
              force_br_newlines : "true",
              doctype : \'< !DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">\'
            });
          });
          //]]>
        </script>';
    return $html;
  }
}

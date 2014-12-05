<?php
/**
 * Invoice types renderer
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Block_Adminhtml_Traceabilities_Renderer_Invoicetypes extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
  private static $_invoicetypes = array();

  public static  function getInvoicetypesArray()
  {
    if (count(self::$_invoicetypes) == 0){
      $types = Recomiendo_Recipes_Model_Codifier_Traceability::getInvoiceTypes();
      self::$_invoicetypes = $types;
    }
    return self::$_invoicetypes;
  }

  public function render(Varien_Object $row)
  {
    $val   = $this->_getValue($row);
    $types = self::getInvoicetypesArray();
    return isset($types[$val]) ? $types[$val] : false;
  }
}

<?php
/**
 * Zipcodes List admin edit form container
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Block_Adminhtml_Zipcodes_Edit extends Recomiendo_Recipes_Block_Adminhtml_Refactor_BaseEdit
{

  protected $_blockGroup   = "recomiendo_recipes_zipcodes";
  protected $_controller   = "adminhtml_zipcodes";
  protected $_entityLabel  = "Código Postal";
  protected $_instanceName = "zipcodeItemInstance";
  protected $_instanceRegisterName = "zipcodes_item";

  public function __construct()
  {

    parent::__construct();

    $this->addButton ('removeRange', array(
      'label'     =>  'Borrar Rango',
      'onclick'   => 'deleteRange()',
      'type'      => 'submit',
      'class'     => 'delete',
      //'confirm'   => Mage::helper('recomiendo_recipes')->__('Esta seguro que desea borrar el rango?')
    )
    , 0, 100,  'header');

    $this->_formScripts[] = "

      function deleteRange(){
        var check = confirm('Esta seguro que desea borrar el rango?');
        if (check == true) {
          $('edit_form').action = '".$this->getUrl('*/*/deleteRange')."'
          editForm.submit();
          }else{
            return false;
          }
      }
    ";
  }

  /**
   * Initialize edit form container
   *
   */

  /**
   * Retrieve text for header element depending on loaded page
   *
   * @return string
   */

}

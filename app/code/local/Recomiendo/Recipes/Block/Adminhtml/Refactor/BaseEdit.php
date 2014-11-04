<?php
/**
 * Base Admin Edit Form Container
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Block_Adminhtml_Refactor_BaseEdit extends Mage_Adminhtml_Block_Widget_Form_Container
{

  protected $_entityLabel;
  protected $_instanceName;
  protected $_instanceRegisterName;

  /**
   * Initialize edit form container
   *
   */
  public function __construct()
  {

    parent::__construct();

    if (Mage::helper('recomiendo_recipes/admin')->isActionAllowed('save')) {
      $this->_updateButton('save', 'label', Mage::helper('recomiendo_recipes')->__('Guardar %s', $this->_entityLabel));
      $this->_addButton('saveandcontinue', array(
        'label'   => Mage::helper('adminhtml')->__('Guardar y seguir editando'),
        'onclick' => 'saveAndContinueEdit()',
        'class'   => 'save',
      ), -100);
    } else {
      $this->_removeButton('save');
    }

    if (Mage::helper('recomiendo_recipes/admin')->isActionAllowed('delete')) {
      $this->_updateButton('delete', 'label', Mage::helper('recomiendo_recipes')->__('Eliminar %s', $this->_entityLabel));
    } else {
      $this->_removeButton('delete');
    }

    $this->_formScripts[] = "
      function toggleEditor() {
        if (tinyMCE.getInstanceById('page_content') == null) {
          tinyMCE.execCommand('mceAddControl', false, 'page_content');
  } else {
    tinyMCE.execCommand('mceRemoveControl', false, 'page_content');
  }
  }

  function saveAndContinueEdit(){
    editForm.submit($('edit_form').action+'back/edit/');
  }
  ";
  }

  /**
   * Retrieve text for header element depending on loaded page
   *
   * @return string
   */
  public function getHeaderText()
  {
    $model = Mage::helper('recomiendo_recipes')->getEntityItemInstance($this->_instanceName, $this->_instanceRegisterName);
    if ($model->getId()) {
      $title = $model->getTitle() ? $model->getTitle() : $model->getName();
      return Mage::helper('recomiendo_recipes')->__('Editar %s', $this->escapeHtml($title));
    } else {
      return Mage::helper('recomiendo_recipes')->__('Nuevo %s', $this->_entityLabel);
    }
  }
}

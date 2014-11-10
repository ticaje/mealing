<?php
/**
 * Recipe Steps Presentation Form
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Block_Adminhtml_Recipes_Edit_Tab_Presentation
  extends Recomiendo_Recipes_Block_Adminhtml_Refactor_Edit_Tab_BaseMain implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

  protected $_entityName  = "Pasos Presentacion";
  protected $_entityLabel = "Pasos Presentacion";
  protected function _prepareLayout()
  {
    $this->setTemplate('recomiendo/recipes/edit/tab/main/ssteps.phtml');
    $this->setChild('add_button',
      $this->getLayout()->createBlock('adminhtml/widget_button')
      ->setData(array(
        'label'     => Mage::helper('catalog')->__('Paso'),
        'onclick'   => 'sstepsHandler.addItem()',
        'class' => 'add'
      )));
    parent::_prepareLayout();
  }

  public function getValues()
  {
    $_id = $this->getRequest()->getParams('id');
    $_id = $_id['id'];
    $collection =  Mage::getSingleton('recomiendo_recipes/recipe_sstep')->getCollection()
      ->addFieldToFilter('recipe_id', $_id);
    return $collection->getItems();
  }

  public function getTabLabel()
  {
    return Mage::helper('recomiendo_recipes')->__($this->_entityLabel);
  }

  public function createContentBlock($name)
  {
    $html = '
        <div class="steps" style="margin: 10px;">
         <span><b> Numero: </b></span>
         <input class="order" type="text" id="ssteps_row___index___order" name="'.$name.'[__index__][order]"  value="" class="input-text require"/>
         <span><b> Nombre: </b></span>
         <input class="name" type="text" id="ssteps_row___index___name" name="'.$name.'[__index__][name]"  value="" class="input-text require"/>
         <span><b> Contenido: </b></span>
         <textarea type="textarea" rows="2" id="ssteps_row___index___content" name="'.$name.'[__index__][content]"  value="" class="input-text require">
         </textarea>
        </div>';
    return $html;
  }
}

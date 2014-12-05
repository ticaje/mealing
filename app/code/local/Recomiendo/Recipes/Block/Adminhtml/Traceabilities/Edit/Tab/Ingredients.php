<?php
/**
 * Traceabilities List admin edit form main tab
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Block_Adminhtml_Traceabilities_Edit_Tab_Ingredients extends Recomiendo_Recipes_Block_Adminhtml_Refactor_Edit_Tab_BaseMain
{

  protected $_entityLabel = "Ingredientes";
  protected $_id;
  /**
   * Prepare form elements for tab
   *
   * @return Mage_Adminhtml_Block_Widget_Form
   */

  protected function _prepareLayout()
  {
    $this->setTemplate('recomiendo/traceabilities/edit/tab/ingredients.phtml');
    $this->setChild('add_button',
      $this->getLayout()->createBlock('adminhtml/widget_button')
      ->setData(array(
        'label'     => Mage::helper('catalog')->__('Ingrediente'),
        'onclick'   => 'ingredientsHandler.addItem()',
        'class' => 'add'
      )));
    $this->_id = $this->getRequest()->getParams('params')['id'];
    parent::_prepareLayout();
  }

  protected function getIngredientsForSelect()
  {
    $ingredients = Mage::getSingleton('recomiendo_recipes/codifier_ingredient')->getIngredientsValuesForForm("relation_traceability_ingredient", $this->_id);
    return $ingredients;
  }

  protected function getTraceabilityIngredients()
  {
    $model       = Mage::helper('recomiendo_recipes')->getEntityItemInstance("traceabilityItemInstance", "traceabilities_item");
    $ingredients = $model->getIngredients();
    return $ingredients;
  }

  public function getTabLabel()
  {
    return Mage::helper('recomiendo_recipes')->__($this->_entityLabel);
  }

  public function createContentBlock($name)
  {
    $_ingredients = $this->getIngredientsForSelect();
    $values = "";
    foreach($_ingredients['values'] as $item){
        $value    = $item['value'];
        $label    = $item['label'];
        $selected = in_array($item['selected'], $item['value']) ? 'selected="selected"' : '';
        $values .= '<option value="'.$value.'" '.$selected.'>'.$label.'</option>';
    }
    $html = '
      <td style="text-align:center;">
      <select id="ingredients_row___index___ingredient" name="'.$name.'[__index__][ingredient]"  value="" title="Tipo ingrediente" class="">
      '.$values.'
      </select>
      </td>
      <td style="text-align:center;">
      <input class="order" type="text" id="ingredients_row___index___stock_number" name="'.$name.'[__index__][stock_number]"  value="" class="input-text require"/>
      </td>
      <td style="text-align:center;">
      <input class="order required-entry validate-date-au" type="text " id="ingredients_row___index___expires_on" name="'.$name.'[__index__][expires_on]" placeholder="dd/mm/yyyy" value="" class="input-text require"/>
      </td>
      <td style="text-align:center;">
      <textarea class="name required-entry" type="text" id="ingredients_row___index___operations" name="'.$name.'[__index__][operations]"  value="" class="input-text require"></textarea>
      </td>
      ';
    return $html;
  }

  public function displayFormatedDate($date)
  {
    $formatted = explode("-", $date);
    $year  = $formatted[0];
    $month = $formatted[1];
    $day   = $formatted[2];
    return $day."/".$month."/".$year;
  }
}

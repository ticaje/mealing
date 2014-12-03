<?php
/**
 * Recipes List admin edit form main tab
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Block_Adminhtml_Recipes_Edit_Tab_Ingredients extends Recomiendo_Recipes_Block_Adminhtml_Refactor_Edit_Tab_BaseMain
{

  protected $_entityLabel = "Ingredientes";
  /**
   * Prepare form elements for tab
   *
   * @return Mage_Adminhtml_Block_Widget_Form
   */

  protected function _prepareLayout()
  {
    $this->setTemplate('recomiendo/recipes/edit/tab/main/ingredients.phtml');
    $this->setChild('add_button',
      $this->getLayout()->createBlock('adminhtml/widget_button')
      ->setData(array(
        'label'     => Mage::helper('catalog')->__('Ingrediente'),
        'onclick'   => 'ingredientsHandler.addItem()',
        'class' => 'add'
      )));
    parent::_prepareLayout();
  }

  protected function getIngredientsForSelect()
  {
    $model       = Mage::helper('recomiendo_recipes')->getEntityItemInstance("recipeItemInstance", "recipes_item");
    $ingredients = Mage::getSingleton('recomiendo_recipes/codifier_ingredient')->getIngredientsValuesForForm("relation_recipe_ingredient", $model->getId());
    return $ingredients;
  }

  protected function getRecipeIngredients()
  {
    $model       = Mage::helper('recomiendo_recipes')->getEntityItemInstance("recipeItemInstance", "recipes_item");
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
      <td>
      <select id="ingredients_row___index___ingredient" name="'.$name.'[__index__][ingredient]"  value="" title="Tipo ingrediente" class="">
      '.$values.'
      </select>
      </td>
      <td>
      <input class="order" type="text" id="ingredients_row___index___frontend_label" name="'.$name.'[__index__][frontend_label]"  value="" class="input-text require"/>
      </td>
      <td>
      <input class="order required-entry" type="text " id="ingredients_row___index___measure_unit" name="'.$name.'[__index__][measure_unit]"  value="" class="input-text require"/>
      </td>
      <td>
      <input class="name validate-number required-entry" type="text" id="ingredients_row___index___measure_one_person" name="'.$name.'[__index__][measure_one_person]"  value="" class="input-text require"/>
      </td>
      <td>
      <input class="name validate-number required-entry" type="text" id="ingredients_row___index___measure_two_persons" name="'.$name.'[__index__][measure_two_persons]"  value="" class="input-text require"/>
      </td>
      <td>
      <input class="name validate-number required-entry" type="text" id="ingredients_row___index___measure_three_persons" name="'.$name.'[__index__][measure_three_persons]"  value="" class="input-text require"/>
      </td>
      <td>
      <input class="name validate-number required-entry" type="text" id="ingredients_row___index___measure_four_persons" name="'.$name.'[__index__][measure_four_persons]"  value="" class="input-text require"/>
      </td>
      ';
    return $html;
  }
}

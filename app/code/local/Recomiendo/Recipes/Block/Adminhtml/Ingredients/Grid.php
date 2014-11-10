<?php
/**
 * Ingredients List admin grid
 *
 * @author Hector Luis Barrientos Margolles
 */
Class Recomiendo_Recipes_Block_Adminhtml_Ingredients_Grid extends Recomiendo_Recipes_Block_Adminhtml_Refactor_BaseGrid
{

  protected $_listIdString = 'ingredients_list_grid';
  protected $_modelName    = 'recomiendo_recipes/codifier_ingredient';

  /**
   * Prepare collection for Grid
   *
   * @return Recomiendo_Recipes_Block_Adminhtml_Ingredients_Grid
   */

  /**
   * Prepare Grid columns
   *
   * @return Recomiendo_Recipes_Block_Adminhtml_Ingredients_Grid
   */
  protected function _prepareColumns()
  {
    $this->addColumn('ingredient_id', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('ID'),
      'width'     => '50px',
      'index'     => 'ingredient_id',
    ));

    $this->addColumn('name', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('Nombre Ingrediente'),
      'index'     => 'name',
    ));

    $this->addColumn('ingredienttype', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('Tipo(s) Ingrediente'),
      'index'     => 'ingredienttype',
      'renderer'  => 'Recomiendo_Recipes_Block_Adminhtml_Ingredients_Renderer_Ingredienttypes',
    ));

    return parent::_prepareColumns();
  }

  /**
   * Return row URL for js event handlers
   *
   * @return string
   */

  /**
   * Grid url getter
   *
   * @return string current grid url
   */
}

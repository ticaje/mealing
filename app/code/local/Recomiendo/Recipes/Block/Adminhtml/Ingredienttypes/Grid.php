<?php
/**
 * Ingredienttypes List admin grid
 *
 * @author Hector Luis Barrientos Margolles
 */
Class Recomiendo_Recipes_Block_Adminhtml_Ingredienttypes_Grid extends Recomiendo_Recipes_Block_Adminhtml_Refactor_BaseGrid
{

  protected $_listIdString = 'ingredienttypes_list_grid';
  protected $_modelName    = 'recomiendo_recipes/codifier_ingredienttype';

  /**
   * Init Grid default properties
   *
   */

  /**
   * Prepare collection for Grid
   *
   * @return Recomiendo_Recipes_Block_Adminhtml_Ingredienttypes_Grid
   */

  /**
   * Prepare Grid columns
   *
   * @return Recomiendo_Recipes_Block_Adminhtml_Ingredienttypes_Grid
   */
  protected function _prepareColumns()
  {
    $this->addColumn('ingredienttype_id', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('ID'),
      'width'     => '50px',
      'index'     => 'ingredienttype_id',
    ));

    $this->addColumn('name', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('Nombre Tipo Ingrediente'),
      'width'     => '450px',
      'index'     => 'name',
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

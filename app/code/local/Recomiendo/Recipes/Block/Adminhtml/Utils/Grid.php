<?php
/**
 * Utils List admin grid
 *
 * @author Hector Luis Barrientos Margolles
 */
Class Recomiendo_Recipes_Block_Adminhtml_Utils_Grid extends Recomiendo_Recipes_Block_Adminhtml_Refactor_BaseGrid
{

  protected $_listIdString = 'utils_list_grid';
  protected $_modelName    = 'recomiendo_recipes/codifier_util';

  /**
   * Prepare collection for Grid
   *
   * @return Recomiendo_Recipes_Block_Adminhtml_Utils_Grid
   */

  /**
   * Prepare Grid columns
   *
   * @return Recomiendo_Recipes_Block_Adminhtml_Utils_Grid
   */
  protected function _prepareColumns()
  {
    $this->addColumn('util_id', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('ID'),
      'width'     => '50px',
      'index'     => 'util_id',
    ));

    $this->addColumn('name', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('Nombre Utensilio'),
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

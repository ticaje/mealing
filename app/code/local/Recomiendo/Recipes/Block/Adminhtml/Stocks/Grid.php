<?php
/**
 * Stocks List admin grid
 *
 * @author Hector Luis Barrientos Margolles
 */
Class Recomiendo_Recipes_Block_Adminhtml_Stocks_Grid extends Recomiendo_Recipes_Block_Adminhtml_Refactor_BaseGrid
{

  protected $_listIdString = 'stocks_list_grid';
  protected $_modelName    = 'recomiendo_recipes/codifier_stock';

  /**
   * Prepare collection for Grid
   *
   * @return Recomiendo_Recipes_Block_Adminhtml_Stocks_Grid
   */

  /**
   * Prepare Grid columns
   *
   * @return Recomiendo_Recipes_Block_Adminhtml_Stocks_Grid
   */
  protected function _prepareColumns()
  {
    $this->addColumn('stcokgroup_id', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('ID'),
      'width'     => '50px',
      'index'     => 'stockgroup_id',
    ));

    $this->addColumn('name', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('Nombre'),
      'index'     => 'name',
    ));

    $this->addColumn('quantity', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('Cantidad'),
      'index'     => 'quantity',
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

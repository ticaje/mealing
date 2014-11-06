<?php
/**
 * Zipcodes List admin grid
 *
 * @author Hector Luis Barrientos Margolles
 */
Class Recomiendo_Recipes_Block_Adminhtml_Zipcodes_Grid extends Recomiendo_Recipes_Block_Adminhtml_Refactor_BaseGrid
{

  protected $_listIdString = 'zipcodes_list_grid';
  protected $_modelName    = 'recomiendo_recipes/codifier_zipcode';

  /**
   * Prepare collection for Grid
   *
   * @return Recomiendo_Recipes_Block_Adminhtml_Zipcodes_Grid
   */

  /**
   * Prepare Grid columns
   *
   * @return Recomiendo_Recipes_Block_Adminhtml_Zipcodes_Grid
   */
  protected function _prepareColumns()
  {
    $this->addColumn('zipcode_id', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('ID'),
      'width'     => '50px',
      'index'     => 'zipcode_id',
    ));

    $this->addColumn('number', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('Número'),
      'index'     => 'number',
    ));

    $this->addColumn('extra_price', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('Multiplicador'),
      'index'     => 'extra_price',
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

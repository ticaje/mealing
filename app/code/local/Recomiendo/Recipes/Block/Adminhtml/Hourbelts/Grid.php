<?php
/**
 * Hourbelts List admin grid
 *
 * @author Hector Luis Barrientos Margolles
 */
Class Recomiendo_Recipes_Block_Adminhtml_Hourbelts_Grid extends Recomiendo_Recipes_Block_Adminhtml_Refactor_BaseGrid
{

  protected $_listIdString = 'hourbelts_list_grid';
  protected $_modelName    = 'recomiendo_recipes/codifier_hourbelt';

  /**
   * Prepare collection for Grid
   *
   * @return Recomiendo_Recipes_Block_Adminhtml_Hourbelts_Grid
   */

  /**
   * Prepare Grid columns
   *
   * @return Recomiendo_Recipes_Block_Adminhtml_Hourbelts_Grid
   */
  protected function _prepareColumns()
  {
    $this->addColumn('hourbelt_id', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('ID'),
      'width'     => '50px',
      'index'     => 'hourbelt_id',
    ));

    $this->addColumn('start', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('Hora Inicio'),
      'index'     => 'start',
    ));

    $this->addColumn('finish', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('Hora Fin'),
      'index'     => 'finish',
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

<?php
/**
 * Traceabilities List admin grid
 *
 * @author Hector Luis Barrientos Margolles
 */
Class Recomiendo_Recipes_Block_Adminhtml_Traceabilities_Grid extends Recomiendo_Recipes_Block_Adminhtml_Refactor_BaseGrid
{

  protected $_listIdString = 'traceabilities_list_grid';
  protected $_modelName    = 'recomiendo_recipes/codifier_traceability';

  /**
   * Prepare collection for Grid
   *
   * @return Recomiendo_Recipes_Block_Adminhtml_Traceabilities_Grid
   */

  /**
   * Prepare Grid columns
   *
   * @return Recomiendo_Recipes_Block_Adminhtml_Traceabilities_Grid
   */
  protected function _prepareColumns()
  {
    $this->addColumn('traceability_id', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('ID'),
      'width'     => '50px',
      'index'     => 'traceability_id',
    ));

    $this->addColumn('provider', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('Proveedor'),
      'index'     => 'provider',
    ));

    $this->addColumn('ingredient', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('Ingrediente'),
      'index'     => 'ingredient',
    ));

    $this->addColumn('stock_number', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('Número de Lote'),
      'index'     => 'stock_number',
    ));

    $this->addColumn('expires_on', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('Fecha de caducidad'),
      'index'     => 'expires_on',
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

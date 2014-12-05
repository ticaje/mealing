<?php
/**
 * Traceabilities List admin grid
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Block_Adminhtml_Traceabilities_Grid extends Recomiendo_Recipes_Block_Adminhtml_Refactor_BaseGrid
{

  protected $_listIdString = 'traceabilities_list_grid';
  protected $_modelName    = 'recomiendo_recipes/codifier_traceability';
  protected $_collection_default_sort_field = "adquired_on";
  protected $_collection_default_sort_direction = "DESC";

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

    $this->addColumn('provider_id', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('Proveedor'),
      'index'     => 'provider_id',
      'renderer'  => 'Recomiendo_Recipes_Block_Adminhtml_Traceabilities_Renderer_Providers',
      'filter'    => false,
      //'filter_condition_callback' => array($this, '_providerFilter'),
    ));

    $this->addColumn('ingredients', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('Ingrediente(s)'),
      'index'     => 'ingredients',
      'renderer'  => 'Recomiendo_Recipes_Block_Adminhtml_traceabilities_Renderer_Ingredients',
      'filter'    => false,
    ));

    $this->addColumn('invoice_type', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('Tipo Factura'),
      'index'     => 'invoice_type',
      'type'      => 'options',
      'renderer'  => new Recomiendo_Recipes_Block_Adminhtml_Traceabilities_Renderer_Invoicetypes(),
      'options'   => Recomiendo_Recipes_Block_Adminhtml_Traceabilities_Renderer_Invoicetypes::getInvoicetypesArray(),
    ));

    $this->addColumn('invoice_number', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('Número de Factura'),
      'index'     => 'invoice_number',
    ));

    $this->addColumn('adquired_on', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('Fecha de Adquisición'),
      'index'     => 'adquired_on',
      'type'      => 'datetime',
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

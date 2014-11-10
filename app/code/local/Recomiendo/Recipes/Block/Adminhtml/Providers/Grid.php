<?php
/**
 * Providers List admin grid
 *
 * @author Hector Luis Barrientos Margolles
 */
Class Recomiendo_Recipes_Block_Adminhtml_Providers_Grid extends Recomiendo_Recipes_Block_Adminhtml_Refactor_BaseGrid
{

  protected $_listIdString = 'providers_list_grid';
  protected $_modelName    = 'recomiendo_recipes/codifier_provider';

  /**
   * Prepare collection for Grid
   *
   * @return Recomiendo_Recipes_Block_Adminhtml_Providers_Grid
   */

  /**
   * Prepare Grid columns
   *
   * @return Recomiendo_Recipes_Block_Adminhtml_Providers_Grid
   */
  protected function _prepareColumns()
  {
    $this->addColumn('provider_id', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('ID'),
      'width'     => '50px',
      'index'     => 'provider_id',
    ));

    $this->addColumn('name', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('Nombre Proveedor'),
      'index'     => 'name',
    ));

    $this->addColumn('ingredient', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('Ingrediente(s) asociado(s)'),
      'index'     => 'ingredient',
      'renderer'  => 'Recomiendo_Recipes_Block_Adminhtml_Providers_Renderer_Ingredients',
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

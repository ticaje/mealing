<?php
/**
 * Recipes List admin grid
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Block_Adminhtml_Recipes_Grid extends Recomiendo_Recipes_Block_Adminhtml_Refactor_BaseGrid
{

  protected $_listIdString = 'recipe_list_grid';
  protected $_modelName    = 'recomiendo_recipes/recipe';

  /**
   * Init Grid default properties
   *
   */

  /**
   * Prepare collection for Grid
   *
   * @return Recomiendo_Recipes_Block_Adminhtml_Recipes_Grid
   */

  /**
   * Prepare Grid columns
   *
   * @return Recomiendo_Recipes_Block_Adminhtml_Recipes_Grid
   */
  protected function _prepareColumns()
  {
    $this->addColumn('recipe_id', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('ID'),
      'width'     => '50px',
      'index'     => 'recipe_id',
    ));

    $this->addColumn('name', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('Nombre Receta'),
      'index'     => 'name',
    ));

    $this->addColumn('published_at', array(
      'header'   => Mage::helper('recomiendo_recipes')->__('Fecha de ultima publicación'),
      'sortable' => true,
      'width'    => '170px',
      'index'    => 'published_at',
      'type'     => 'date',
    ));

    $this->addColumn('created_at', array(
      'header'   => Mage::helper('recomiendo_recipes')->__('Fecha Creación'),
      'sortable' => true,
      'width'    => '170px',
      'index'    => 'created_at',
      'type'     => 'date',
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

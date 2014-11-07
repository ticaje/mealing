<?php
/**
 * Recipe Classifications List admin grid
 *
 * @author Hector Luis Barrientos Margolles
 */
Class Recomiendo_Recipes_Block_Adminhtml_Rclassifications_Grid extends Recomiendo_Recipes_Block_Adminhtml_Refactor_BaseGrid
{

  protected $_listIdString = 'rclassifications_list_grid';
  protected $_modelName    = 'recomiendo_recipes/codifier_rclassification';

  /**
   * Prepare collection for Grid
   *
   * @return Recomiendo_Recipes_Block_Adminhtml_Rclassifications_Grid
   */

  /**
   * Prepare Grid columns
   *
   * @return Recomiendo_Recipes_Block_Adminhtml_Rclassifications_Grid
   */
  protected function _prepareColumns()
  {
    $this->addColumn('employee_role_id', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('ID'),
      'width'     => '50px',
      'index'     => 'employee_role_id',
    ));

    $this->addColumn('name', array(
      'header'    => Mage::helper('recomiendo_recipes')->__('Nombre Clasificación'),
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

<?php
/**
 * Sets List admin grid
 *
 * @author Hector Luis Barrientos Margolles
 */
Class Recomiendo_Menus_Block_Adminhtml_Pricerules_Sets_Grid extends Recomiendo_Menus_Block_Adminhtml_Refactor_BaseGrid
{

  protected $_listIdString = 'sets_list_grid';
  protected $_modelName    = 'recomiendo_menus/rule_set';

  /**
   * Prepare collection for Grid
   *
   * @return Recomiendo_Menus_Block_Adminhtml_Sets_Grid
   */

  /**
   * Prepare Grid columns
   *
   * @return Recomiendo_Menus_Block_Adminhtml_Sets_Grid
   */
  protected function _prepareColumns()
  {
    $this->addColumn('rule_set_id', array(
      'header'    => Mage::helper('recomiendo_menus')->__('ID'),
      'width'     => '50px',
      'index'     => 'rule_set_id',
    ));

    $this->addColumn('name', array(
      'header'    => Mage::helper('recomiendo_menus')->__('Nombre Plantilla'),
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

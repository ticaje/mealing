<?php
/**
 * Basket Cells List admin grid
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Cms_Block_Adminhtml_Homepage_Basketcell_Grid extends Recomiendo_Cms_Block_Adminhtml_Refactor_BaseGrid
{

  protected $_listIdString = 'basketcell_list_grid';
  protected $_modelName    = 'recomiendo_cms/basketcell';

  /**
   * Init Grid default properties
   *
   */

  /**
   * Prepare collection for Grid
   *
   * @return Recomiendo_Cms_Block_Adminhtml_Homepage_Basketcell_Grid
   */

  /**
   * Prepare Grid columns
   *
   * @return Recomiendo_Cms_Block_Adminhtml_Homepage_Basketcell_Grid
   */
  protected function _prepareColumns()
  {
    $this->addColumn('basket_cell_id', array(
      'header'    => Mage::helper('recomiendo_cms')->__('ID'),
      'width'     => '50px',
      'index'     => 'basket_cell_id',
    ));

    $this->addColumn('title', array(
      'header'    => Mage::helper('recomiendo_cms')->__('Nombre de la Celda'),
      'index'     => 'title',
    ));

    $this->addColumn('position', array(
      'header'    => Mage::helper('recomiendo_cms')->__('Posicion en el Grid'),
      'index'     => 'position',
    ));

    $this->addColumn('published_at', array(
      'header'   => Mage::helper('recomiendo_cms')->__('Fecha de ultima publicación'),
      'sortable' => true,
      'width'    => '170px',
      'index'    => 'published_at',
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

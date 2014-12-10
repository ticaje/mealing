<?php
/**
 * Base Admin Grid List admin grid
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Menus_Block_Adminhtml_Refactor_BaseGrid extends Mage_Adminhtml_Block_Widget_Grid
{

    protected $_listIdString;
    protected $_modelName;
    /**
     * Init Grid default properties
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId($this->_listIdString);
        $this->setDefaultSort('created_at');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    /**
     * Prepare collection for Grid
     *
     * @return Recomiendo_Menus_Block_Adminhtml_Refactor_BaseGrid
     */
    protected function _prepareCollection()
    {
      $collection = Mage::getModel($this->_modelName)->getResourceCollection();
      if (!empty($this->_collection_default_sort_field)){
        $collection->setCurPage($this->getCurrentPage())
          ->setOrder($this->_collection_default_sort_field, $this->_collection_default_sort_direction);
      }else{
        $collection->setCurPage($this->getCurrentPage());
      }
      $this->setCollection($collection);
      return parent::_prepareCollection();
    }

    /**
     * Prepare Grid columns
     *
     * @return Recomiendo_Menus_Block_Adminhtml_Refactor_BaseGrid
     */
    protected function _prepareColumns()
    {

        $this->addColumn('action',
            array(
                'header'    => Mage::helper('recomiendo_menus')->__('Acciones'),
                'width'     => '100px',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(array(
                    'caption' => Mage::helper('recomiendo_menus')->__('Eliminar'),
                    'url'     => array('base' => '*/*/delete'),
                    'field'   => 'id',
                    'confirm' =>  Mage::helper('recomiendo_menus')->__('Esta seguro?')
                )),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'menus',
        ));

        return parent::_prepareColumns();
    }

    /**
     * Return row URL for js event handlers
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    /**
     * Grid url getter
     *
     * @return string current grid url
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current' => true));
    }
}

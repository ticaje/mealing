<?php
/**
 * Ingredienttypes List admin grid
 *
 * @author Hector Luis Barrientos Margolles
 */
Class Recomiendo_Recipes_Block_Adminhtml_Ingredienttypes_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Init Grid default properties
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('recipes_list_grid');
        $this->setDefaultSort('created_at');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    /**
     * Prepare collection for Grid
     *
     * @return Recomiendo_Recipes_Block_Adminhtml_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('recomiendo_recipes/codifier_ingredienttype')->getResourceCollection();

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * Prepare Grid columns
     *
     * @return Mage_Adminhtml_Block_Catalog_Search_Grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn('ingredienttype_id', array(
            'header'    => Mage::helper('recomiendo_recipes')->__('ID'),
            'width'     => '50px',
            'index'     => 'ingredienttype_id',
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('recomiendo_recipes')->__('Nombre Tipo Ingrediente'),
            'width'     => '450px',
            'index'     => 'name',
        ));

        $this->addColumn('action',
            array(
                'header'    => Mage::helper('recomiendo_recipes')->__('Acciones'),
                'width'     => '50px',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                  array(
                    'caption' => Mage::helper('recomiendo_recipes')->__('Eliminar'),
                    'url'     => array('base' => '*/*/delete'),
                    'field'   => 'id',
                    'confirm' => Mage::helper('recomiendo_recipes')->__('Seguro?')
                  )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'ingredienttypes',
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

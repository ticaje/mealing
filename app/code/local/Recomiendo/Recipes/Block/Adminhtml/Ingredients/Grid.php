<?php
/**
 * Ingredients List admin grid
 *
 * @author Hector Luis Barrientos Margolles
 */
Class Recomiendo_Recipes_Block_Adminhtml_Ingredients_Grid extends Mage_Adminhtml_Block_Widget_Grid
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
        $collection = Mage::getModel('recomiendo_recipes/codifier_ingredient')->getResourceCollection();

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
        $this->addColumn('recipe_id', array(
            'header'    => Mage::helper('recomiendo_recipes')->__('ID'),
            'width'     => '50px',
            'index'     => 'recipe_id',
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('recomiendo_recipes')->__('Nombre Ingrediente'),
            'index'     => 'name',
        ));

        $this->addColumn('ingredienttype', array(
            'header'    => Mage::helper('recomiendo_recipes')->__('Tipo(s) Ingrediente'),
            'index'     => 'ingredienttype',
            'renderer'  => 'Recomiendo_Recipes_Block_Adminhtml_Ingredients_Renderer_Ingredienttypes',
        ));

        $this->addColumn('action',
            array(
                'header'    => Mage::helper('recomiendo_recipes')->__('Acciones'),
                'width'     => '100px',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(array(
                    'caption' => Mage::helper('recomiendo_recipes')->__('Editar'),
                    'url'     => array('base' => '*/*/edit'),
                    'field'   => 'id'
                )),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'recipes',
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

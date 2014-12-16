<?php

class Recomiendo_Menus_Block_Adminhtml_Tabs_Lunchmenu extends Mage_Adminhtml_Block_Widget_Grid
{
  /**
   * Set grid params
   *
   */
  public function __construct()
  {
    parent::__construct();
    $this->setId('lunch_recipes_grid');
    $this->setDefaultSort('recipe_id');
    $this->setUseAjax(true);
  }

  /**
   * Retrieve currently edited product model
   *
   * @return Mage_Catalog_Model_Product
   */
  protected function _getProduct()
  {
    return Mage::registry('current_product');
  }

  /**
   * Add filter
   *
   * @param object $column
   * @return Mage_Adminhtml_Block_Catalog_Product_Edit_Tab_Related
   */
  protected function _addColumnFilterToCollection($column)
  {
    // Set custom filter for in product flag
    if ($column->getId() == 'in_products') {
      $recipeIds = $this->_getSelectedRecipes();
      if (empty($recipeIds)) {
        $recipeIds = 0;
      }
      if ($column->getFilter()->getValue()) {
        $this->getCollection()->addFieldToFilter('recipe_id', array('in' => $recipeIds));
      } else {
        if($recipeIds) {
          $this->getCollection()->addFieldToFilter('recipe_id', array('nin' => $recipeIds));
        }
      }
    } else {
      parent::_addColumnFilterToCollection($column);
    }
    return $this;
  }

  /**
   * Prepare collection
   *
   * @return Mage_Adminhtml_Block_Widget_Grid
   */
  protected function _prepareCollection()
  {
    $collection = Mage::getModel('recomiendo_recipes/recipe')->getCollection();

    if ($this->isReadonly()) {
      $recipesIds = $this->_getSelectedRecipes();
      if (empty($recipesIds)) {
        $recipesIds = array(0);
      }
      $collection->addFieldToFilter('recipe_id', array('in' => $recipesIds));
    }

    $this->setCollection($collection);
    return parent::_prepareCollection();
  }

  /**
   * Checks when this block is readonly
   *
   * @return boolean
   */
  public function isReadonly()
  {
    return $this->_getProduct()->getRelatedReadonly();
  }

  /**
   * Add columns to grid
   *
   * @return Mage_Adminhtml_Block_Widget_Grid
   */
  protected function _prepareColumns()
  {
    if (!$this->isReadonly()) {
      $this->addColumn('in_products', array(
        'header_css_class'  => 'a-center',
        'type'              => 'checkbox',
        'name'              => 'in_products',
        'values'            => $this->_getSelectedRecipes(),
        'align'             => 'center',
        'index'             => 'recipe_id',
        'field_name'        => 'selectedLunchRecipes[]'
      ));
    }

    $this->addColumn('position', array(
      'header'            => Mage::helper('catalog')->__('Orden en el Menu'),
      'name'              => 'position',
      'type'              => 'number',
      'validate_class'    => 'validate-number',
      'width'             => 10,
      'editable'          => true,
      'filter'            => false,
      'sorteable'         => false,
    ));

    $this->addColumn('name', array(
      'header'    => Mage::helper('catalog')->__('Nombre Receta'),
      'index'     => 'name'
    ));

    $this->addColumn('classification', array(
      'header'    => Mage::helper('catalog')->__('Categoria'),
      'index'     => 'classification'
    ));

    $this->addColumn('created_at', array(
      'header'    => Mage::helper('catalog')->__('Fecha creación'),
      'width'     => 90,
      'type'      => 'date',
      'index'     => 'created_at',
    ));

    $this->addColumn('published_at', array(
      'header'    => Mage::helper('catalog')->__('Ultima Publicación'),
      'width'     => 90,
      'type'      => 'date',
      'index'     => 'published_at',
    ));

    return parent::_prepareColumns();
  }

  /**
   * Rerieve grid URL
   *
   * @return string
   */
  public function getGridUrl()
  {
    return $this->getData('grid_url')
      ? $this->getData('grid_url')
      : $this->getUrl('*/*/lunchGrid', array('_current' => true));
  }

  /**
   * Retrieve selected related recipes
   *
   * @return array
   */
  protected function _getSelectedRecipes()
  {
    $recipes = $this->getRecipesRelated();
    if (!is_array($recipes)) {
      $recipes = array_keys($this->getSelectedRelatedRecipes());
    }
    return $recipes;
  }

  /**
   * Retrieve related products
   *
   * @return array
   */
  public function getSelectedRelatedRecipes()
  {
    $recipes = array();

    $instance = $this->_getProduct()->getTypeInstance();

    foreach ($instance->getRelatedRecipes(true) as $recipe) {
      $recipes[$recipe['id']] = array('position' => 0);
      $recipes[$recipe['id']]['position'] = $recipe['position'];
    }
    return $recipes;
  }
}

<?php
/**
 * MagenMarket.com
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * DISCLAIMER
 *
 * Edit or modify this file with yourown risk.
 *
 * @category    Extensions
 * @package     Recomiendo_Cms free
 * @copyright   Copyright (c) 2013 MagenMarket. (http://www.magenmarket.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 **/
/* $Id: Grid.php 15 2013-11-05 07:30:45Z linhnt $ */

class Recomiendo_Cms_Block_Adminhtml_Slideshow_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
    parent::__construct();
    $this->setId('slideshowGrid');
    // This is the primary key of the database
    $this->setDefaultSort('slideshow_id');
    $this->setDefaultDir('ASC');
    $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
    $collection = Mage::getModel('recomiendo_cms/slideshow')->getCollection();
    $this->setCollection($collection);
    return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
    $this->addColumn('slideshow_id', array(
      'header'    => Mage::helper('cms')->__('ID'),
      'align'     =>'center',
      'width'     => '50px',
      'index'     => 'slideshow_id',
      'type'	  => ''
    ));

    $this->addColumn('title', array(
      'header'    => Mage::helper('cms')->__('Title'),
      'align'     =>'left',
      'index'     => 'title',
    ));

    $this->addColumn('content', array(
      'header'    => Mage::helper('cms')->__('Item Content'),
      'width'     => '355px',
      'index'     => 'content',
    ));

    $this->addColumn('created_at', array(
      'header'    => Mage::helper('cms')->__('Creation Time'),
      'align'     => 'left',
      'width'     => '120px',
      'type'      => 'date',
      'default'   => '--',
      'index'     => 'created_at',
    ));

    $this->addColumn('update_at', array(
      'header'    => Mage::helper('cms')->__('Update Time'),
      'align'     => 'left',
      'width'     => '120px',
      'type'      => 'date',
      'default'   => '--',
      'index'     => 'update_at',
    ));

    $this->addColumn('status', array(
      'header'    => Mage::helper('cms')->__('Status'),
      'align'     => 'left',
      'width'     => '80px',
      'index'     => 'status',
      'type'      => 'options',
      'options'   => array(
        1 => 'Enabled',
        2 => 'Disabled',
      ),
    ));

    $this->addColumn('action',
      array(
        'header'    =>  Mage::helper('cms')->__('Action'),
        'width'     => '100',
        'type'      => 'action',
        'getter'    => 'getId',
        'actions'   => array(
          array(
            'caption'   => Mage::helper('cms')->__('Edit'),
            'url'       => array('base'=> '*/*/edit'),
            'field'     => 'id'
          )
        ),
        'filter'    => false,
        'sortable'  => false,
        'index'     => 'stores',
        'is_system' => true,
      ));

    $this->addExportType('*/*/exportCsv', Mage::helper('cms')->__('CSV'));
    $this->addExportType('*/*/exportXml', Mage::helper('cms')->__('XML'));

    return parent::_prepareColumns();
  }

  protected function _prepareMassaction()
  {
    $this->setMassactionIdField('slideshow_id');
    $this->getMassactionBlock()->setFormFieldName('slideshow');

    $this->getMassactionBlock()->addItem('delete', array(
      'label'    => Mage::helper('cms')->__('Delete'),
      'url'      => $this->getUrl('*/*/massDelete'),
      'confirm'  => Mage::helper('cms')->__('Are you sure?')
    ));

    $statuses = Mage::getSingleton('recomiendo_cms/status')->getOptionArray();

    array_unshift($statuses, array('label'=>'', 'value'=>''));
    $this->getMassactionBlock()->addItem('status', array(
      'label'=> Mage::helper('cms')->__('Change status'),
      'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
      'additional' => array(
        'visibility' => array(
          'name' => 'status',
          'type' => 'select',
          'class' => 'required-entry',
          'label' => Mage::helper('cms')->__('Status'),
          'values' => $statuses
        )
      )
    ));
    return $this;
  }

  public function getRowUrl($row)
  {
    return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

  public function getGridUrl()
  {
    return $this->getUrl('*/*/grid', array('_current'=>true));
  }

  /**
   * Helper function to do after load modifications
   *
   */
  protected function _afterLoadCollection()
  {
    $this->getCollection()->walk('afterLoad');
    parent::_afterLoadCollection();
  }

  /**
   * Helper function to add store filter condition
   *
   * @param Mage_Core_Model_Mysql4_Collection_Abstract $collection Data collection
   * @param Mage_Adminhtml_Block_Widget_Grid_Column $column Column information to be filtered
   */
  protected function _filterStoreCondition($collection, $column)
  {
    if (!$value = $column->getFilter()->getValue()) {
      return;
    }

    $this->getCollection()->addStoreFilter($value);
  }
}

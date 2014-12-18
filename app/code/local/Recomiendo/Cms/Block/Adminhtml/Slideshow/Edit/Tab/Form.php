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
/* $Id: Form.php 15 2013-11-05 07:30:45Z linhnt $ */

class Recomiendo_Cms_Block_Adminhtml_Slideshow_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareLayout()
	{
		parent::_prepareLayout();
		if(Mage::getSingleton('cms/wysiwyg_config')->isEnabled())
		{
			$this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
		}
	}

  protected function _prepareForm()
  {
    $form = new Varien_Data_Form();
    $form->setHtmlIdPrefix('slideshow_');
    $this->setForm($form);
    $fieldset = $form->addFieldset('slideshow_form', array('legend'=>Mage::helper('recomiendo_cms')->__('Item information')));

	  $slideshow = Mage::getModel('slideshow/slideshow')->load( $this->getRequest()->getParam('id') );
    $after_html = '';
    if( $slideshow->getFilename() )
    {
        $path = Mage::getBaseUrl('media')."recomiendoslideshow/".$slideshow->getFilename();
        $after_html = '<a onclick="imagePreview(recomiendoslideshow); return false;" href="'.$path.'">
                <img height="22" width="22" class="small-image-preview v-middle" alt="'.$slideshow->getFilename().'" title="'.$slideshow->getFilename().'" id="recomiendoslideshow" src="'.$path.'"/>
                </a>';
    }

	  try {
		$config = Mage::getSingleton('cms/wysiwyg_config')->getConfig();
		$config->setData(
			Mage::helper('recomiendo_cms')->recursiveReplace('/cms/', '/' . (string) Mage::app()->getConfig()->getNode('admin/routers/adminhtml/args/frontName') . '/', $config->getData())
		);
	  } catch (Exception $ex) {
		$config = null;
	  }

    $fieldset->addField('title', 'text', array(
        'label'     => Mage::helper('recomiendo_cms')->__('Titulo'),
        'class'     => 'required-entry',
        'required'  => true,
        'name'      => 'title',
    ));

   $fieldset->addField('slideshow_url', 'text', array(
        'label'     => Mage::helper('recomiendo_cms')->__('Click URL'),
        'name'      => 'slideshow_url',
        'note'      => Mage::helper('recomiendo_cms')->__('Seccion a donde va a redirigir'),
    ));

   $fieldset->addField('headline', 'text', array(
        'label'     => Mage::helper('recomiendo_cms')->__('Titular'),
        'name'      => 'headline',
        'note'      => Mage::helper('recomiendo_cms')->__('Texto debajo del titulo'),
    ));

   $fieldset->addField('slogan', 'text', array(
        'label'     => Mage::helper('recomiendo_cms')->__('Slogan'),
        'name'      => 'slogan',
        'note'      => Mage::helper('recomiendo_cms')->__('Texto pequeño debajo del titular'),
    ));

   $fieldset->addField('button', 'text', array(
        'label'     => Mage::helper('recomiendo_cms')->__('Texto botón'),
        'name'      => 'button',
        'note'      => Mage::helper('recomiendo_cms')->__('Texto del botón de acción'),
    ));

    $fieldset->addField('filename', 'file', array(
        'label'     => Mage::helper('recomiendo_cms')->__('Subir imagen'),
        'name'      => 'filename',
        'after_element_html' => $after_html,
        'class'     => (($slideshow->getfilename()) ? '' : 'required-entry'),
        'required'  => (($slideshow->getfilename()) ? false : true),
	  ));

    $fieldset->addField('status', 'select', array(
        'label'     => Mage::helper('recomiendo_cms')->__('Status'),
        'name'      => 'status',
        'values' => array(
            1 => Mage::helper('recomiendo_cms')->__('Enabled'),
            2 => Mage::helper('recomiendo_cms')->__('Disabled')
        )
    ));

	  $fieldset->addField('sortorder', 'text', array(
        'label'     => Mage::helper('recomiendo_cms')->__('Orden'),
        'class'     => 'required-entry validate-digits',
        'required'  => true,
        'name'      => 'sortorder',
    ));

    $fieldset->addField('content', 'editor', array(
        'name'      => 'content',
        'label'     => Mage::helper('recomiendo_cms')->__('Descripcion'),
        'title'     => Mage::helper('recomiendo_cms')->__('Descripcion'),
        'style'     => 'width:666px; height:255px;',
        'wysiwyg'   => true,
        'config'  => $config,
        'required'  => true,
    ));

      if ( Mage::getSingleton('adminhtml/session')->getSlideshowData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getSlideshowData());
          Mage::getSingleton('adminhtml/session')->setSlideshowData(null);
      } elseif ( Mage::registry('slideshow_data') ) {
          $form->setValues(Mage::registry('slideshow_data')->getData());
      }
      return parent::_prepareForm();
  }
}

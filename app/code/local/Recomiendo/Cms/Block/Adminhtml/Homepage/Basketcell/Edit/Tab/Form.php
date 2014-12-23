<?php

class Recomiendo_Cms_Block_Adminhtml_Homepage_Basketcell_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
    $model = Mage::getModel('recomiendo_cms/basketcell');
    $form = new Varien_Data_Form();
    $form->setHtmlIdPrefix('basketcell_');
    $this->setForm($form);
    $fieldset = $form->addFieldset('basketcell_form', array('legend'=>Mage::helper('recomiendo_cms')->__('Item information')));

    $basketcell = $model->load( $this->getRequest()->getParam('id') );
    $after_html = '';
    if( $basketcell->getFilename() )
    {
      $path = Mage::getBaseUrl('media')."recomiendohome/".$basketcell->getFilename();
      $after_html = '<a onclick="imagePreview(recomiendohome); return false;" href="'.$path.'">
        <img height="22" width="22" class="small-image-preview v-middle" alt="'.$basketcell->getFilename().'" title="'.$basketcell->getFilename().'" id="recomiendohome" src="'.$path.'"/>
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
      'label'     => Mage::helper('recomiendo_cms')->__('Nombre'),
      'class'     => 'required-entry',
      'required'  => true,
      'name'      => 'title',
      'note'      => Mage::helper('recomiendo_cms')->__('Nombre relacionado con la posicion que ocupara en el Grid'),
    ));

    $fieldset->addField('storeview', 'select', array(
      'label'     => 'Idioma',
      'class'     => 'required-entry',
      'required'  => true,
      'name'      => 'storeview',
      'values'    => $this->getStoreViews(),
      'disabled'  => false,
      'readonly'  => false,
      'tabindex'  => 1
    ));

    $fieldset->addField('headline', 'text', array(
      'label'     => Mage::helper('recomiendo_cms')->__('Titulo'),
      'class'     => 'required-entry',
      'required'  => true,
      'name'      => 'headline',
      'note'      => Mage::helper('recomiendo_cms')->__('Titulo encabezado'),
    ));

    $fieldset->addField('slogan', 'text', array(
      'label'     => Mage::helper('recomiendo_cms')->__('Slogan'),
      'name'      => 'slogan',
      'note'      => Mage::helper('recomiendo_cms')->__('Texto pequeño debajo del titular'),
    ));

    $fieldset->addField('cell_type', 'select', array(
      'label'     => Mage::helper('recomiendo_cms')->__('Tipo de Celda'),
      'name'      => 'cell_type',
      'note'      => Mage::helper('recomiendo_cms')->__('Admite dos tipos, informativa o celda con imagen de receta'),
      'values'    => Recomiendo_Cms_Model_Entity_Celltype::getCellTypes()
    ));

    $fieldset->addField('category', 'select', array(
      'label'     => 'Categoria',
      'class'     => 'required-entry',
      'required'  => true,
      'name'      => 'category',
      'values'    => $this->getCategories(),
      'disabled'  => false,
      'readonly'  => false,
      'tabindex'  => 1
    ));

    $fieldset->addField('filename', 'file', array(
      'label'     => Mage::helper('recomiendo_cms')->__('Imagen'),
      'name'      => 'filename',
      'after_element_html' => $after_html,
      'class'     => (($basketcell->getFilename()) ? '' : 'required-entry'),
      'required'  => (($basketcell->getFilename()) ? false : true),
      'note'      => Mage::helper('recomiendo_cms')->__('Imagen de receta o imagen explicativa'),
    ));

    $fieldset->addField('position', 'text', array(
      'label'     => Mage::helper('recomiendo_cms')->__('Orden en el Grid'),
      'class'     => 'required-entry validate-digits',
      'required'  => true,
      'name'      => 'position',
      'note'      => Mage::helper('recomiendo_cms')->__('Orden que ocupa en el grid de la seccion, de 1 a 12'),
    ));

    if ( Mage::getSingleton('adminhtml/session')->getBasketcellData() )
    {
      $form->setValues(Mage::getSingleton('adminhtml/session')->getBasketcellData());
      Mage::getSingleton('adminhtml/session')->setBasketcellData(null);
    } elseif ( Mage::registry('basketcell_data') ) {
      $form->setValues(Mage::registry('basketcell_data')->getData());
    }
    return parent::_prepareForm();
  }

  protected function getCategories()
  {
    $category = Mage::getModel('catalog/category');
    $tree = $category->getTreeModel();
    $tree->load();
    $ids = $tree->getCollection()->getAllIds();
    $arr = array();
    $arr[0] = "Seleccione Categoria";
    if ($ids){
      array_shift($ids);
      array_shift($ids);
      foreach ($ids as $id){
        $cat = Mage::getModel('catalog/category');
        $cat->load($id);
        $arr[$id] = $cat->getName();
      }
    }
    return $arr;

  }

  protected function getStoreViews()
  {
    $result = array();
    $result[0] = "Seleccione Idioma";
    foreach (Mage::app()->getWebsites() as $website) {
      foreach ($website->getGroups() as $group) {
        $stores = $group->getStores();
        foreach ($stores as $store) {
          $id   = $store->getId();
          $name = $store->getName();
          $result[$id] = $name;
        }
      }
    }
    return $result;
  }
}

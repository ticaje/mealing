<?php
/**
 * Basket Cell Type item model
 *
 * @author Hector Luis Barrientos Margolles
 */

class Recomiendo_Cms_Model_Entity_Celltype
{
  static public function getCellTypes()
  {
    return array(
      array('value' => '1',	'label' => Mage::helper('recomiendo_cms')->__('Texto Informativo')),
      array('value' => '2',	'label' => Mage::helper('recomiendo_cms')->__('Imagen'))
    );
  }
}

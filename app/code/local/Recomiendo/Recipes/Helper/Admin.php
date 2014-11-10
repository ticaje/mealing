<?php
/**
 * Recipes Admin Helper
 *
 * @author Hector Luis Barrientos Margolles
 *
 */
class Recomiendo_Recipes_Helper_Admin extends Mage_Core_Helper_Abstract
{
    /**
     * Check permission for passed action
     *
     * @param string $action
     * @return bool
     */
    public function isActionAllowed($action)
    {
        return Mage::getSingleton('admin/session')->isAllowed('recipes/manage/' . $action);
    }

    public function normalizeCollectionArrayForSelect($model, $params)
    {
      /* Setting up parameters first */
      $params = (object)$params;
      $id    = "get{$params->idname}";
      $label = "get{$params->label}";
      $res[] = array('value' => '', 'label' => '---Selecciona---');

      $collection = Mage::getModel('recomiendo_recipes/'.$model)->getCollection();
      foreach($collection as  $item){
        $arr['value'] =  $item->$id();
        $arr['label'] =  ucfirst($item->$label());
        $res[] = $arr;
      }
      $result['values']   = $res;
      return $result;
    }

    public function touchMyBalls($collection, $params)
    {
    }
}

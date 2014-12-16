<?php
/**
 * Recipetype model
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Model_Codifier_Recipetype extends Mage_Core_Model_Abstract
{
    /**
     * Define resource model
     */
    protected $_names;
    protected function _construct()
    {
        $this->_init('recomiendo_recipes/codifier_recipetype');
    }

    public function getSetOfNames($listOfIds)
    {
      $this->_names .= "";
      $collection = $this->getCollection();
      $names = Mage::getSingleton('core/resource_iterator')->walk(
        $collection->getSelect(),
        array(array($this, 'getNameCallback')),
        array('ids' => $listOfIds)
      );
      return $this->_names;
    }

    public function getNameCallback($args)
    {
      $item = $args['row'];
      if (in_array($item['recipetype_id'], $args['ids'])){
        $result .= $item['name']." ";
      }
      $this->_names .= $result;
    }
}

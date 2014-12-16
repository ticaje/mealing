<?php
/**
 * Product_Recipe relationship collection
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Menus_Model_Resource_Relation_Menu_Recipe_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Define collection model
     */
    protected function _construct()
    {
        $this->_init('recomiendo_menus/relation_menu_recipe');
    }

    /**
     * Prepare for displaying in list
     *
     * @param integer $page
     * @return Recomiendo_Menus_Model_Resource_Relation_Menu_Recipe_Collection
     */
    public function prepareForList($page)
    {
        $this->setPageSize(Mage::helper('recomiendo_menus')->getProviderIngredientPerPage());
        return $this;
    }

    public function getValuesSelected($menu_id)
    {
      $this->addFieldToFilter('entity_id', $menu_id);
      foreach ($this as $item){
        $result[] = array('id' => $item->getRecipeId(), 'position' => $item->getPosition());
      }
      return $result;
    }

    public function getLabelsOfValuesSelected($menu_id)
    {
      $arr_of_values = $this->getValuesSelected($menu_id);
      $sel = Mage::getModel('recomiendo_recipes/recipe')->getCollection()
        ->addFieldToFilter('recipe_id', $arr_of_values);
      $result = "";
      foreach ($sel as $item){
        $result .= ucfirst($item->getName())." ";
      }
      return $result;
    }
}

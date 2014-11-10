<?php
/**
 * Recipe item model
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Model_Recipe extends Mage_Core_Model_Abstract
{
  /**
   * Define resource model
   */
  protected function _construct()
  {
    $this->_init('recomiendo_recipes/recipe');
  }

  /**
   * If object is new adds creation date
   *
   * @return Recomiendo_Recipes_Model_Recipe
   */
  protected function _beforeSave()
  {
    parent::_beforeSave();
    if ($this->isObjectNew()) {
      $this->setData('created_at', Varien_Date::now());
    }
    return $this;
  }

  protected function _afterSave()
  {
    $_steps = $this->getRecipeSteps();
    $_steps = (object)$_steps;

    array_shift($_steps->psteps);
    $this->saveSteps($_steps->psteps, "pstep");
    array_shift($_steps->ssteps);
    $this->saveSteps($_steps->ssteps, "sstep");
    array_shift($_steps->esteps);
    $this->saveSteps($_steps->esteps, "estep");
  }

  private function saveSteps($steps, $name)
  {

    $_id = $this->getRecipeId();
    if (count($steps) > 0 ){

      Mage::getModel('recomiendo_recipes/recipe_'.$name)
        ->getCollection()
        ->addFieldToFilter('recipe_id', $_id)
        ->walk('delete');

      foreach ($steps as $step){
        Mage::getModel('recomiendo_recipes/recipe_'.$name)
          ->setRecipeId($_id)
          ->setName($step['name'])
          ->setOrder($step['order'])
          ->setContent($step['content'])
          ->save();
      }
    }

  }
}

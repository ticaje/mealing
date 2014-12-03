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

    $_del_images_ids = Mage::app()->getRequest()->getParam('deleteImages');
    if ($_del_images_ids){
      $this->deleteImages($_del_images_ids);
    }

    $_images_data = Mage::getSingleton('core/session')->getRecipeImagesUploaded();
    if ($_images_data){
      $this->saveImages($_images_data);
    }

    $_ingredients = $this->getRecipeIngredients();
    array_shift($_ingredients['ingredients']);
    $this->saveIngredients($_ingredients['ingredients']);
  }

  private function saveIngredients($ingredients)
  {
    $_id = $this->getRecipeId();

    Mage::getModel('recomiendo_recipes/relation_recipe_ingredient')
      ->getCollection()
      ->addFieldToFilter('recipe_id', $_id)
      ->walk('delete');

    foreach ($ingredients as $ingredient){
      Mage::getModel('recomiendo_recipes/relation_recipe_ingredient')
        ->setRecipeId($_id)
        ->setIngredientId($ingredient['ingredient'])
        ->setFrontendLabel($ingredient['frontend_label'])
        ->setMeasureUnit($ingredient['measure_unit'])
        ->setMeasureOnePerson($ingredient['measure_one_person'])
        ->setMeasureTwoPersons($ingredient['measure_two_persons'])
        ->setMeasureThreePersons($ingredient['measure_three_persons'])
        ->setMeasureFourPersons($ingredient['measure_four_persons'])
        ->save();
    }
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

  private function saveImages($images)
  {
    foreach ($images as $item){
      Mage::getModel('recomiendo_recipes/relation_recipe_image')
        ->setRecipeId($this->getId())
        ->setImagePath($item['insertion_name'])
        ->save();
    }
    Mage::getSingleton('core/session')->unsRecipeImagesUploaded();
  }

  private function deleteImages($toDel)
  {
    foreach ($toDel as $item){
      $_param = 'image_path_'.$item;
      $_path = Mage::app()->getRequest()->getParam($_param);
      $_full_path = Mage::getSingleton('recomiendo_recipes/recipe_media_config')->getBaseMediaPath().$_path;
      if (Mage::getResourceModel('recomiendo_recipes/relation_recipe_image_collection')
        ->addFieldToFilter('recipe_image_id', $item)
        ->walk('delete')){
          unlink($_full_path);
        }
    }
  }

  public function getIngredients()
  {
    $sel = Mage::getResourceModel('recomiendo_recipes/relation_recipe_ingredient_collection')
      ->addFieldToFilter('recipe_id', $this->getId());
    return $sel->getData();
  }

}

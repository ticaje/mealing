<?php
/**
 * Recipe module observer
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Model_Observer
{
    /**
     * Event before show recipe item on frontend
     * If specified new post was added recently (term is defined in config) we'll see message about this on front-end.
     *
     * @param Varien_Event_Observer $observer
     */
    public function beforeRecipeDisplayed(Varien_Event_Observer $observer)
    {
        $recipeItem = $observer->getEvent()->getRecipeItem();
        $currentDate = Mage::app()->getLocale()->date();
        $recipeCreatedAt = Mage::app()->getLocale()->date(strtotime($recipeItem->getCreatedAt()));
        $daysDifference = $currentDate->sub($recipeCreatedAt)->getTimestamp() / (60 * 60 * 24);
        if ($daysDifference < Mage::helper('recomiendo_recipes')->getDaysDifference()) {
            Mage::getSingleton('core/session')->addSuccess(Mage::helper('recomiendo_recipes')->__('Recently added'));
        }
    }
}

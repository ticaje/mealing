<?php
/**
 * Custom image form element that generates correct thumbnail image URL
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Block_Adminhtml_Recipes_Edit_Form_Element_Image extends Varien_Data_Form_Element_Image
{
    /**
     * Get image preview url
     *
     * @return string
     */
    protected function _getUrl()
    {
        $url = false;
        if ($this->getValue()) {
            $url = Mage::helper('recomiendo_recipes/image')->getBaseUrl() . '/' . $this->getValue();
        }
        return $url;
    }
}

<?php
/**
 * Ingredients List admin grid container
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Block_Adminhtml_Ingredients extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * Block constructor
     */
    public function __construct()
    {
        $this->_blockGroup = 'recomiendo_recipes_ingredients';
        $this->_controller = 'adminhtml_ingredients';
        $this->_headerText = Mage::helper('recomiendo_recipes')->__('Gestión de los Ingredientes');

        parent::__construct();

        if (Mage::helper('recomiendo_recipes/admin')->isActionAllowed('save')) {
            $this->_updateButton('add', 'label', Mage::helper('recomiendo_recipes')->__('Adicionar nuevo ingrediente'));
        } else {
            $this->_removeButton('add');
        }
    }
}

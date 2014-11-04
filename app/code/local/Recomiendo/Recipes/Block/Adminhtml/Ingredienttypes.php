<?php
/**
 * Ingredienttypes List admin grid container
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Block_Adminhtml_Ingredienttypes extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * Block constructor
     */
    public function __construct()
    {
        $this->_blockGroup = 'recomiendo_recipes_ingredienttypes';
        $this->_controller = 'adminhtml_ingredienttypes';
        $this->_headerText = Mage::helper('recomiendo_recipes')->__('Gestión de los Tipos de Ingrediente');

        parent::__construct();

        if (Mage::helper('recomiendo_recipes/admin')->isActionAllowed('save')) {
            $this->_updateButton('add', 'label', Mage::helper('recomiendo_recipes')->__('Adicionar nuevo tipo de ingrediente'));
        } else {
            $this->_removeButton('add');
        }
    }
}

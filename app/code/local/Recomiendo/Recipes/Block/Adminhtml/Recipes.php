<?php
/**
 * Recipes List admin grid container
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Block_Adminhtml_Recipes extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * Block constructor
     */
    public function __construct()
    {
        $this->_blockGroup = 'recomiendo_recipes';
        $this->_controller = 'adminhtml_recipes';
        $this->_headerText = Mage::helper('recomiendo_recipes')->__('Gestión de Recetas');

        parent::__construct();

        if (Mage::helper('recomiendo_recipes/admin')->isActionAllowed('save')) {
            $this->_updateButton('add', 'label', Mage::helper('recomiendo_recipes')->__('Adicionar nueva receta'));
        } else {
            $this->_removeButton('add');
        }
        $this->addButton(
            'recipes_flush_images_cache',
            array(
                'label'      => Mage::helper('recomiendo_recipes')->__('Vaciar la cache de imagenes'),
                'onclick'    => 'setLocation(\'' . $this->getUrl('*/*/flush') . '\')',
            )
        );

    }
}

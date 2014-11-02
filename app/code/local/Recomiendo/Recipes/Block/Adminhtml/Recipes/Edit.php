<?php
/**
 * Recipes List admin edit form container
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Block_Adminhtml_Recipes_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Initialize edit form container
     *
     */
    public function __construct()
    {
        $this->_objectId   = 'id';
        $this->_blockGroup = 'recomiendo_recipes';
        $this->_controller = 'adminhtml_recipes';

        parent::__construct();

        if (Mage::helper('recomiendo_recipes/admin')->isActionAllowed('save')) {
            $this->_updateButton('save', 'label', Mage::helper('recomiendo_recipes')->__('Guardar receta'));
            $this->_addButton('saveandcontinue', array(
                'label'   => Mage::helper('adminhtml')->__('Guardar y seguir editando'),
                'onclick' => 'saveAndContinueEdit()',
                'class'   => 'save',
            ), -100);
        } else {
            $this->_removeButton('save');
        }

        if (Mage::helper('recomiendo_recipes/admin')->isActionAllowed('delete')) {
            $this->_updateButton('delete', 'label', Mage::helper('recomiendo_recipes')->__('Eliminar receta'));
        } else {
            $this->_removeButton('delete');
        }

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('page_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'page_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'page_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /**
     * Retrieve text for header element depending on loaded page
     *
     * @return string
     */
    public function getHeaderText()
    {
        $model = Mage::helper('recomiendo_recipes')->getRecipesItemInstance();
        if ($model->getId()) {
            return Mage::helper('recomiendo_recipes')->__("Editar Receta '%s'",
                 $this->escapeHtml($model->getTitle()));
        } else {
            return Mage::helper('recomiendo_recipes')->__('Nueva receta');
        }
    }
}

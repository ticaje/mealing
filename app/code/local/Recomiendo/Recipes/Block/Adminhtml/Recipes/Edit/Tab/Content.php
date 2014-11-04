<?php
/**
 * Recipes List admin edit form content tab
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Recipes_Block_Adminhtml_Recipes_Edit_Tab_Content
    extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    /**
     * Load WYSIWYG on demand and prepare layout
     *
     * @return Recomiendo_Recipes_Block_Adminhtml_Recipes_Edit_Tab_Content
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
        return $this;
    }

    /**
     * Prepares tab form
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $model = Mage::helper('recomiendo_recipes')->getEntityItemInstance("recipeItemInstance", "recipes_item");

        /**
         * Checking if user have permissions to save information
         */
        if (Mage::helper('recomiendo_recipes/admin')->isActionAllowed('save')) {
            $isElementDisabled = false;
        } else {
            $isElementDisabled = true;
        }

        $form = new Varien_Data_Form();

        $form->setHtmlIdPrefix('recipes_content_');

        $fieldset = $form->addFieldset('content_fieldset', array(
            'legend' => Mage::helper('recomiendo_recipes')->__('Contenido'),
            'class'  => 'fieldset-wide'
        ));

        $wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig(array(
            'tab_id' => $this->getTabId()
        ));

        $contentField = $fieldset->addField('content', 'editor', array(
            'name'     => 'content',
            'style'    => 'height:36em;',
            'required' => false,
            'disabled' => $isElementDisabled,
            'config'   => $wysiwygConfig
        ));

        // Setting custom renderer for content field to remove label column
        $renderer = $this->getLayout()->createBlock('adminhtml/widget_form_renderer_fieldset_element')
            ->setTemplate('cms/page/edit/form/renderer/content.phtml');
        $contentField->setRenderer($renderer);

        $form->setValues($model->getData());
        $this->setForm($form);

        Mage::dispatchEvent('adminhtml_recipes_edit_tab_content_prepare_form', array('form' => $form));

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return Mage::helper('recomiendo_recipes')->__('Contenido');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return Mage::helper('recomiendo_recipes')->__('Content');
    }

    /**
     * Returns status flag about this tab can be shown or not
     *
     * @return true
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Returns status flag about this tab hidden or not
     *
     * @return true
     */
    public function isHidden()
    {
        return false;
    }
}

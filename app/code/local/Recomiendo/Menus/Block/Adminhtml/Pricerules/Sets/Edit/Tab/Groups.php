<?php
/**
 * Pricerules_Sets List admin edit form main tab
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Menus_Block_Adminhtml_Pricerules_Sets_Edit_Tab_Groups extends Recomiendo_Menus_Block_Adminhtml_Refactor_Edit_Tab_BaseMain
{

  protected $_entityLabel = "Grupos de Precios";
  protected $_id;

  protected function _prepareLayout()
  {
    $this->setTemplate('recomiendo/menus/pricerules/edit/tab/groups.phtml');
    $this->setChild('add_button',
      $this->getLayout()->createBlock('adminhtml/widget_button')
      ->setData(array(
        'label'     => Mage::helper('catalog')->__('Adicionar Grupo'),
        'onclick'   => 'groupsHandler.addItem()',
        'class' => 'add'
      )));
    $this->setChild('saveandcontinue',
      $this->getLayout()->createBlock('adminhtml/widget_button')
      ->setData(array(
        'label'     => Mage::helper('catalog')->__('Salvar Grupos'),
        'onclick' => 'saveAndContinueEdit()',
        'class' => 'save'
      )));
    $this->_id = $this->getRequest()->getParams('params')['id'];
    parent::_prepareLayout();
  }

  public function getSaveAndEditButton()
  {
    return $this->getChildHtml('saveandcontinue');
  }

  protected function getRulesetGroups()
  {
    $model = Mage::helper('recomiendo_menus')
      ->getEntityItemInstance(Recomiendo_Menus_Helper_Config::ENTITY_ITEM_INSTANCE_RULE_SET, Recomiendo_Menus_Helper_Config::REGISTRY_VARIABLE_RULE_SET);
    $groups = $model->getRulesetGroups();
    return $groups;
  }

  public function createContentBlock($name)
  {
    $html = '
      <td style="text-align:center;">
      <input class="order" type="text" id="groups_row___index___name" name="'.$name.'[__index__][name]"  value="" class="input-text require"/>
      </td>
      <td style="text-align:center;">
      <input class="order" type="text" id="groups_row___index___price" name="'.$name.'[__index__][price]"  value="" class="input-text require"/>
      </td>
      <td style="text-align:center;">
      <input class="order" type="text" id="groups_row___index___price_club" name="'.$name.'[__index__][price_club]"  value="" class="input-text require"/>
      </td>
      ';
    return $html;
  }

  /**
   * Prepare label for tab
   *
   * @return string
   */
  public function getTabLabel()
  {
    return Mage::helper('recomiendo_recipes')->__($this->_entityLabel);
  }

  /**
   * Prepare title for tab
   *
   * @return string
   */

  /**
   * Returns status flag about this tab can be shown or not
   *
   * @return true
   */

  /**
   * Returns status flag about this tab hidden or not
   *
   * @return true
   */

}

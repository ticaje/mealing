<?php
/**
 * Pricerules_Sets List admin edit form main tab
 *
 * @author Hector Luis Barrientos Margolles
 */
class Recomiendo_Menus_Block_Adminhtml_Pricerules_Sets_Edit_Tab_Groups extends Recomiendo_Menus_Block_Adminhtml_Refactor_Edit_Tab_BaseMain
{

  protected $_entityLabel = "Precios por grupos de personas";
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
    $this->setChild('deleterow',
      $this->getLayout()->createBlock('adminhtml/widget_button')
      ->setData(array(
        'label'     => Mage::helper('catalog')->__('Eliminar'),
        'onclick' => 'groupsHandler.deleteItem()',
        'class' => 'delete'
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

  public function getDeleterowButton()
  {
    return $this->getChildHtml('deleterow');
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
    $numbers       = Recomiendo_Menus_Helper_Config::getSelectionPossibilitiesInNumbers();
    $possibilities = Recomiendo_Menus_Helper_Config::getSelectionPossibilities();
    $fields        = Recomiendo_Menus_Helper_Config::getSelectionFields();
    $headers       = Recomiendo_Menus_Helper_Config::getSelectionFieldsHeaders();
    $html = '
      <td>
        <div style="text-align: center; padding: 20px;">
        <span><b>Numero de personas: </b></span>
        <input class="order required-entry" type="text" id="groups_row___index___persons" name="'.$name.'[__index__][persons]"  value="" class="input-text require"/>
        </div>
        <table>
        <tr class="headings" style="text-align:center;">';
            $_headers = '';
            foreach ($headers as $header) {
              $_headers .= '<th style="text-align:center; width: 10%">'.$header.'</th>';
            }
            $html .= $_headers.
        '</tr>
        <tr>';
         $columns = '';
         foreach ($fields as $field){
           $columns .= '<td style="text-align:center;">';
           $rows= '';
           foreach ($possibilities as $i => $number){
             $value = $field == "dishes" ? $numbers[$i] : "";
             $rows .= '<input class="order" type="text" id="groups_row___index___'.$field.$number.'" name="'.$name.'[__index__]['.$field.$number.']"  value="'.$value.'" class="input-text require"/>';
           }
           $columns .= $rows.'</td>';
         }
         $html .= $columns;
         $html .= '</tr>
        </table>
      </td>';
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

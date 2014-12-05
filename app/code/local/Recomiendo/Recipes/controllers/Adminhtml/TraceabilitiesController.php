<?php
/*
 * Traceabilities admin controller
 *
 * @author Hector Luis Barrientos Margolles
 *
 */
class Recomiendo_Recipes_Adminhtml_TraceabilitiesController extends Recomiendo_Recipes_Controller_Adminhtml_Codifier_BaseController
{

  /* Define general variables based on refactoring */
  protected $_currentEntity          = "Trazabilidad";
  protected $_currentEntityModelName = "recomiendo_recipes/codifier_traceability";
  protected $_titleLabel             = "Trazabilidad";
  protected $_registeringEntityName  = "traceabilities_item";
  protected $_getParamId             = "traceability_id";

  /**
   * Index action defined in parent, redefine it here if necesary
   */

  /**
   * Create New Ingredienttypes item, defined in parent, redefine it here if necesary
   */

  /**
   * Edit Ingredienttypes item, defined in parent, redefine it here if necesary
   */

  /**
   * Save action, defined in parent, redefine it here if necesary
   */
  public function saveAction()
  {
    $redirectPath   = '*/*';
    $redirectParams = array();

    // check if data sent
    $data = $this->getRequest()->getPost();
    if ($data) {
      $data = $this->_filterPostData($data);
      // init model and set data
      /* @var $model Recomiendo_Recipes_Model_Codifiers_%s_Item */
      $model = Mage::getModel($this->_currentEntityModelName);

      // if entity item exists, try to load it
      $entityId = $this->getRequest()->getParam($this->_getParamId);
      if ($entotyId) {
        $model->load($entityId);
      }

      if($data['adquired_on'] != NULL )
      {
        $date = Mage::app()->getLocale()->date($data['adquired_on'], Zend_Date::DATE_SHORT);
        $data['adquired_on'] = $date->toString('YYYY-MM-dd HH:mm:ss');
      }

      $model->addData($data);
      //print_r($model); exit;
      try {
        $hasError = false;
        // save the data
        $model->save();

        // display success message
        $this->_getSession()->addSuccess(
          Mage::helper('recomiendo_recipes')->__('La entidad %s se ha guardado', $this->_titleLabel)
        );

        // check if 'Save and Continue'
        if ($this->getRequest()->getParam('back')) {
          $redirectPath   = '*/*/edit';
          $redirectParams = array('id' => $model->getId());
        }
      } catch (Mage_Core_Exception $e) {
        $hasError = true;
        $this->_getSession()->addError($e->getMessage());
      } catch (Exception $e) {
        $hasError = true;
        $this->_getSession()->addException($e,
          Mage::helper('recomiendo_recipes')->__('Ha ocurrido un error al guardar la entitdad %s',  $this->_titleLabel)
        );
      }

      if ($hasError) {
        $this->_getSession()->setFormData($data);
        $redirectPath   = '*/*/edit';
        $redirectParams = array('id' => $this->getRequest()->getParam('id'));
      }
    }

    $this->_redirect($redirectPath, $redirectParams);
  }

  /**
   * Delete action, defined in parent, redefine it here if necesary
   */

  /**
   * Check the permission to run it, defined in parent, redefine it here if necesary
   *
   * @return boolean
   */

  /**
   * Filtering posted data. Converting localized data if needed, defined in parent, redefine it here if necesary
   *
   * @param array
   * @return array
   */

  /**
   * Grid ajax action, defined in parent, redefine it here if necesary
   */

  /**
   * Flush Ingredienttypes Posts Images Cache action, defined in parent, redefine it here if necesary
   */

}

?>

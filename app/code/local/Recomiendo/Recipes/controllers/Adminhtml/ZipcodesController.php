<?php
/*
 * Zipcodes admin controller
 *
 * @author Hector Luis Barrientos Margolles
 *
 */
class Recomiendo_Recipes_Adminhtml_ZipcodesController extends Recomiendo_Recipes_Controller_Adminhtml_Codifier_BaseController
{

  /* Define general variables based on refactoring */
  protected $_currentEntity          = "Códigos Postales";
  protected $_currentEntityModelName = "recomiendo_recipes/codifier_zipcode";
  protected $_titleLabel             = "Código Postal";
  protected $_registeringEntityName  = "zipcodes_item";
  protected $_getParamId             = "zipcode_id";

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

      $_init    = $data['number'];
      $_end     = $data['range'];
      $_i_init  = (int)$_init;
      $_i_end   = (int)$_end;
      $_price   = $data['extra_price'];
      $_comment = $data['comment'];

      try {

        if (($_end) && ($_i_end > $_i_init))
        {
          $_zeros = strlen($_init) - strlen($_i_init);
          for ($i = 1; $i <= $_zeros; $i++)
          {
            $_zero .= "0";
          }
          //echo print_r($data); exit;
          $_range  = $_i_end - $_i_init;
          for ($i = 0; $i <= $_range; $i++)
          {
            $number = $_init + $i;
            $model = Mage::getModel($this->_currentEntityModelName);
            $model->load($number, "number");
            if (!$model->getId())
            {
              $model->setExtraPrice($_price);
              $ni = (string)$_zero.(string)$number;
              $model->setNumber($ni);
            }
            else
            {
              $model->setExtraPrice($_price);
            }
            $model->setComment($_comment);
            // save the data
            $model->save();
          }
        }
        else
        {
          $entityId = $this->getRequest()->getParam($this->_getParamId);
          if ($entityId) {
            $model->load($entityId);
          }

          // save the data
          $model->addData($data);
          $model->save();
        }

        $hasError = false;

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

  public function deleteRangeAction()
  {
    // check if we know what should be deleted
    $data = $this->getRequest()->getPost();
    $data = $this->_filterPostData($data);
    $_init    = $data['number'];
    $_end     = $data['range'];
    $_i_init  = (int)$_init;
    $_i_end   = (int)$_end;
    try{
      if (($_end) && ($_i_end > $_i_init))
      {
        $_range  = $_i_end - $_i_init;
        for ($i = 0; $i <= $_range; $i++)
        {
          $number = $_init + $i;
          $model = Mage::getModel($this->_currentEntityModelName);
          $model->load($number, "number");
          if (!$model->getId()) {
            Mage::throwException(Mage::helper('recomiendo_recipes')->__('No se pudo encontrar el código postal %s, es posible que el rango especificado no sea válido', $number));
          }
          $model->delete();
        }
        $this->_getSession()->addSuccess(
          Mage::helper('recomiendo_recipes')->__('Se eliminaron %s códigos postales', $_range)
        );
      }
    }
    catch (Mage_Core_Exception $e) {
      $this->_getSession()->addError($e->getMessage());
    } catch (Exception $e) {
      $this->_getSession()->addException($e,
        Mage::helper('recomiendo_recipes')->__('Ha ocurrido un error al tratar de eliminar la entidad %s', $this->_titleLabel)
      );
    }

    // go to grid
    $this->_redirect('*/*/');
  }
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

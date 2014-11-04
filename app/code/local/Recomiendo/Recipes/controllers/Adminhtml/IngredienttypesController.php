<?php
/*
 * Ingredienttypes controller
 *
 * @author Hector Luis Barrientos Margolles
 *
 */
class Recomiendo_Recipes_Adminhtml_IngredienttypesController extends Mage_Adminhtml_Controller_Action
{

  /**
   * Init actions
   *
   * @return Recomiendo_Ingredienttypes_Adminhtml_IngredienttypesController
   */
  protected function _initAction()
  {
    // load layout, set active menu and breadcrumbs
    $this->loadLayout()
      ->_setActiveMenu('ingredienttypes/manage')
      ->_addBreadcrumb(
        Mage::helper('recomiendo_recipes')->__('Ingredienttypes'),
        Mage::helper('recomiendo_recipes')->__('Ingredienttypes')
      )
      ->_addBreadcrumb(
        Mage::helper('recomiendo_recipes')->__('Manage Ingredienttypes'),
        Mage::helper('recomiendo_recipes')->__('Manage Ingredienttypes')
      )
      ;
    return $this;
  }

  /**
   * Index action
   */
  public function indexAction()
  {
    $this->_title($this->__('Ingredienttypes'))
      ->_title($this->__('Manage Ingredienttypes'));

    $this->_initAction();
    $this->renderLayout();
  }

  /**
   * Create new Ingredienttypes item
   */
  public function newAction()
  {
    // the same form is used to create and edit
    $this->_forward('edit');
  }

  /**
   * Edit Ingredienttypes item
   */
  public function editAction()
  {
    $this->_title($this->__('Ingredienttypes'))
      ->_title($this->__('Manage Ingredienttypes'));

    // 1. instance recipes model
    /* @var $model Recomiendo_Ingredienttypes_Model_Item */
    $model = Mage::getModel('recomiendo_recipes/codifier_ingredienttype');

    // 2. if exists id, check it and load data
    $ingredienttypeId = $this->getRequest()->getParam('id');
    if ($ingredienttypeId) {
      $model->load($ingredienttypeId);

      if (!$model->getId()) {
        $this->_getSession()->addError(
          Mage::helper('recomiendo_recipes')->__('Ingredienttypes item does not exist.')
        );
        return $this->_redirect('*/*/');
      }
      // prepare title
      $this->_title($model->getTitle());
      $breadCrumb = Mage::helper('recomiendo_recipes')->__('Edit Item');
    } else {
      $this->_title(Mage::helper('recomiendo_recipes')->__('New Item'));
      $breadCrumb = Mage::helper('recomiendo_recipes')->__('New Item');
    }

    // Init breadcrumbs
    $this->_initAction()->_addBreadcrumb($breadCrumb, $breadCrumb);

    // 3. Set entered data if was error when we do save
    $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
    if (!empty($data)) {
      $model->addData($data);
    }

    // 4. Register model to use later in blocks
    Mage::register('ingredienttypes_item', $model);

    // 5. render layout
    $this->renderLayout();
  }

  /**
   * Save action
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
      /* @var $model Recomiendo_Ingredienttypes_Model_Item */
      $model = Mage::getModel('recomiendo_recipes/codifier_ingredienttype');

      // if recipes item exists, try to load it
      $ingredienttypeId = $this->getRequest()->getParam('ingredienttype_id');
      if ($ingredienttypeId) {
        $model->load($ingredienttypeId);
      }

      $model->addData($data);

      try {
        $hasError = false;
        // save the data
        $model->save();

        // display success message
        $this->_getSession()->addSuccess(
          Mage::helper('recomiendo_recipes')->__('The ingredienttype item has been saved.')
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
          Mage::helper('recomiendo_recipes')->__('An error occurred while saving the ingredienttype item.')
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
   * Delete action
   */
  public function deleteAction()
  {
    // check if we know what should be deleted
    $itemId = $this->getRequest()->getParam('id');
    if ($itemId) {
      try {
        // init model and delete
        /** @var $model Recomiendo_Ingredienttypes_Model_Item */
        $model = Mage::getModel('recomiendo_recipes/codifier_ingredienttype');
        $model->load($itemId);
        if (!$model->getId()) {
          Mage::throwException(Mage::helper('recomiendo_recipes')->__('Unable to find a recipes item.'));
        }
        $model->delete();

        // display success message
        $this->_getSession()->addSuccess(
          Mage::helper('recomiendo_recipes')->__('The ingredient type item has been deleted.')
        );
      } catch (Mage_Core_Exception $e) {
        $this->_getSession()->addError($e->getMessage());
      } catch (Exception $e) {
        $this->_getSession()->addException($e,
          Mage::helper('recomiendo_recipes')->__('An error occurred while deleting the recipes item.')
        );
      }
    }

    // go to grid
    $this->_redirect('*/*/');
  }

  /**
   * Check the permission to run it
   *
   * @return boolean
   */
  protected function _isAllowed()
  {
    switch ($this->getRequest()->getActionName()) {
    case 'new':
    case 'save':
      return Mage::getSingleton('admin/session')->isAllowed('recipes/manage/save');
      break;
    case 'delete':
      return Mage::getSingleton('admin/session')->isAllowed('recipes/manage/delete');
      break;
    default:
      return Mage::getSingleton('admin/session')->isAllowed('recipes/manage');
      break;
    }
  }

  /**
   * Filtering posted data. Converting localized data if needed
   *
   * @param array
   * @return array
   */
  protected function _filterPostData($data)
  {
    $data = $this->_filterDates($data, array('time_published'));
    return $data;
  }

  /**
   * Grid ajax action
   */
  public function gridAction()
  {
    $this->loadLayout();
    $this->renderLayout();
  }

  /**
   * Flush Ingredienttypes Posts Images Cache action
   */
  public function flushAction()
  {
    if (Mage::helper('recomiendo_recipes/image')->flushImagesCache()) {
      $this->_getSession()->addSuccess('Cache successfully flushed');
    } else {
      $this->_getSession()->addError('There was error during flushing cache');
    }
    $this->_forward('index');
  }
}

?>

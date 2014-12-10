<?php
/*
 * Codifiers Base Controller
 *
 * @author Hector Luis Barrientos Margolles
 *
 */
class Recomiendo_Menus_Controller_Adminhtml_Codifier_BaseController extends Mage_Adminhtml_Controller_Action
{

  protected $_activeMenu = "menus";

  protected $_currentEntity;

  protected $_titleLabel;

  protected $_currentEntityModelName;

  protected $_registeringEntityName;

  protected $_getParamId;

  /**
   * Init actions
   *
   * @return Recomiendo_Menus_Controller_Adminhtml_Codifier_BaseController
   */
  protected function _initAction()
  {
    // load layout, set active menu and breadcrumbs
    $this->loadLayout()
      ->_setActiveMenu($this->_activeMenu)
      ->_addBreadcrumb(
        Mage::helper('recomiendo_menus')->__($this->_currentEntity),
        Mage::helper('recomiendo_menus')->__($this->_currentEntity)
      )
      ->_addBreadcrumb(
        Mage::helper('recomiendo_menus')->__('Gestión '.$this->_currentEntity),
        Mage::helper('recomiendo_menus')->__('Gestión '.$this->_currentEntity)
      );
    return $this;
  }

  /**
   * Index action
   */
  public function indexAction()
  {
    $this->_title($this->__($this->_currentEntity))
      ->_title($this->__('Gestión '.$this->_currentEntity));

    $this->_initAction();
    $this->renderLayout();
  }

  /**
   * Create new entity item
   */
  public function newAction()
  {
    // the same form is used to create and edit
    $this->_forward('edit');
  }

  /**
   * Edit entity item
   */
  public function editAction()
  {
    $this->_title($this->__($this->_currentEntity))
      ->_title($this->__('Gestión '.$this->_currentEntity));

    // 1. instance entity model
    /* @var $model Recomiendo_Menus_Model_Codifiers_%s_Item */
    $model = Mage::getModel($this->_currentEntityModelName);

    // 2. if exists id, check it and load data
    $entityId = $this->getRequest()->getParam('id');
    if ($entityId) {
      $model->load($entityId);

      if (!$model->getId()) {
        $this->_getSession()->addError(
          Mage::helper('recomiendo_menus')->__('La entidad %s no existe', $this->_titleLabel)
        );
        return $this->_redirect('*/*/');
      }
      // prepare title
      $this->_title($model->getName() || $model->getTitle );
    } else {
      $this->_title(Mage::helper('recomiendo_menus')->__('Nuevo '. $this->_titleLabel));
    }

    // Init breadcrumbs
    $this->_initAction()->_addBreadcrumb($breadCrumb, $breadCrumb);

    // 3. Set entered data if was error when we do save
    $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
    if (!empty($data)) {
      $model->addData($data);
    }

    // 4. Register model to use later in blocks
    Mage::register($this->_registeringEntityName, $model);

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
      /* @var $model Recomiendo_Menus_Model_Codifiers_%s_Item */
      $model = Mage::getModel($this->_currentEntityModelName);

      // if entity item exists, try to load it
      $entityId = $this->getRequest()->getParam($this->_getParamId);
      if ($entotyId) {
        $model->load($entityId);
      }

      $model->addData($data);
      //print_r($model); exit;
      try {
        $hasError = false;
        // save the data
        $model->save();

        // display success message
        $this->_getSession()->addSuccess(
          Mage::helper('recomiendo_menus')->__('La entidad %s se ha guardado', $this->_titleLabel)
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
          Mage::helper('recomiendo_menus')->__('Ha ocurrido un error al guardar la entitdad %s',  $this->_titleLabel)
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
        /* @var $model Recomiendo_Menus_Model_Codifiers_%s_Item */
        $model = Mage::getModel($this->_currentEntityModelName);
        $model->load($itemId);
        if (!$model->getId()) {
          Mage::throwException(Mage::helper('recomiendo_menus')->__('No se pudo encontrar la entidad %s', $this->_titleLabel));
        }
        $model->delete();

        // display success message
        $this->_getSession()->addSuccess(
          Mage::helper('recomiendo_menus')->__('La entidad %s ha sido eliminada', $this->_titleLabel)
        );
      } catch (Mage_Core_Exception $e) {
        $this->_getSession()->addError($e->getMessage());
      } catch (Exception $e) {
        $this->_getSession()->addException($e,
          Mage::helper('recomiendo_menus')->__('Ha ocurrido un error al tratar de eliminar la entidad %s', $this->_titleLabel)
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
      return Mage::getSingleton('admin/session')->isAllowed('menus/manage/save');
      break;
    case 'delete':
      return Mage::getSingleton('admin/session')->isAllowed('menus/manage/delete');
      break;
    default:
      return Mage::getSingleton('admin/session')->isAllowed('menus/manage');
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
   * Flush Posts Images Cache action
   */
  public function flushAction()
  {
    if (Mage::helper('recomiendo_menus/image')->flushImagesCache()) {
      $this->_getSession()->addSuccess('Cache successfully flushed');
    } else {
      $this->_getSession()->addError('There was error during flushing cache');
    }
    $this->_forward('index');
  }
}

?>

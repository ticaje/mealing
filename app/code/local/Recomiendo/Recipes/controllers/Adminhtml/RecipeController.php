<?php
/*
 * Recipes controller
 *
 * @author Hector Luis Barrientos Margolles
 *
 */
class Recomiendo_Recipes_Adminhtml_RecipeController extends Mage_Adminhtml_Controller_Action
{

  /*
   * Helper local variable
   *
   */
  protected $_recipes_helper = Mage::helper('recipes');

  /**
   * Init actions
   *
   * @return Recomiendo_Recipes_Adminhtml_RecipesController
   */
  protected function _initAction()
  {
    // load layout, set active menu and breadcrumbs
    $this->loadLayout()
      ->_setActiveMenu('recipes/manage')
      ->_addBreadcrumb(
        $_recipes_helper->__('Recipes'),
        $_recipes_helper->__('Recipes')
      )
      ->_addBreadcrumb(
        $_recipes_helper->__('Manage Recipes'),
        $_recipes_helper->__('Manage Recipes')
      )
      ;
    return $this;
  }

  /**
   * Index action
   */
  public function indexAction()
  {
    $this->_title($this->__('Recipes'))
      ->_title($this->__('Manage Recipes'));

    $this->_initAction();
    $this->renderLayout();
  }

  /**
   * Create new Recipes item
   */
  public function newAction()
  {
    // the same form is used to create and edit
    $this->_forward('edit');
  }

  /**
   * Edit Recipes item
   */
  public function editAction()
  {
    $this->_title($this->__('Recipes'))
      ->_title($this->__('Manage Recipes'));

    // 1. instance recipes model
    /* @var $model Recomiendo_Recipes_Model_Item */
    $model = Mage::getModel('recomiendo_recipes/recipe');

    // 2. if exists id, check it and load data
    $recipeId = $this->getRequest()->getParam('id');
    if ($recipeId) {
      $model->load($recipeId);

      if (!$model->getId()) {
        $this->_getSession()->addError(
          $_recipes_helper->__('Recipes item does not exist.')
        );
        return $this->_redirect('*/*/');
      }
      // prepare title
      $this->_title($model->getTitle());
      $breadCrumb = $_recipes_helper->__('Edit Item');
    } else {
      $this->_title($_recipes_helper->__('New Item'));
      $breadCrumb = $_recipes_helper->__('New Item');
    }

    // Init breadcrumbs
    $this->_initAction()->_addBreadcrumb($breadCrumb, $breadCrumb);

    // 3. Set entered data if was error when we do save
    $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
    if (!empty($data)) {
      $model->addData($data);
    }

    // 4. Register model to use later in blocks
    Mage::register('recipes_item', $model);

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
      /* @var $model Recomiendo_Recipes_Model_Item */
      $model = Mage::getModel('recomiendo_recipes/recipe');

      // if recipes item exists, try to load it
      $recipeId = $this->getRequest()->getParam('recipe_id');
      if ($recipeId) {
        $model->load($recipeId);
      }
      // save image data and remove from data array
      if (isset($data['image'])) {
        $imageData = $data['image'];
        unset($data['image']);
      } else {
        $imageData = array();
      }
      $model->addData($data);

      try {
        $hasError = false;
        /* @var $imageHelper Recomiendo_Recipes_Helper_Image */
        $imageHelper = Mage::helper('recipes/image');
        // remove image

        if (isset($imageData['delete']) && $model->getImage()) {
          $imageHelper->removeImage($model->getImage());
          $model->setImage(null);
        }

        // upload new image
        $imageFile = $imageHelper->uploadImage('image');
        if ($imageFile) {
          if ($model->getImage()) {
            $imageHelper->removeImage($model->getImage());
          }
          $model->setImage($imageFile);
        }
        // save the data
        $model->save();

        // display success message
        $this->_getSession()->addSuccess(
          $_recipes_helper->__('The recipes item has been saved.')
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
          $_recipes_helper->__('An error occurred while saving the recipes item.')
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
        /** @var $model Recomiendo_Recipes_Model_Item */
        $model = Mage::getModel('recomiendo_recipes/recipe');
        $model->load($itemId);
        if (!$model->getId()) {
          Mage::throwException($_recipes_helper->__('Unable to find a recipes item.'));
        }
        $model->delete();

        // display success message
        $this->_getSession()->addSuccess(
          $_recipes_helper->__('The recipes item has been deleted.')
        );
      } catch (Mage_Core_Exception $e) {
        $this->_getSession()->addError($e->getMessage());
      } catch (Exception $e) {
        $this->_getSession()->addException($e,
          $_recipes_helper->__('An error occurred while deleting the recipes item.')
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
   * Flush Recipes Posts Images Cache action
   */
  public function flushAction()
  {
    if (Mage::helper('recipes/image')->flushImagesCache()) {
      $this->_getSession()->addSuccess('Cache successfully flushed');
    } else {
      $this->_getSession()->addError('There was error during flushing cache');
    }
    $this->_forward('index');
  }
}

?>

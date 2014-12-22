<?php
/*
 * Basketcells Controller
 *
 * @author Hector Luis Barrientos Margolles
 *
 */

class Recomiendo_Cms_Adminhtml_BasketcellController extends Mage_Adminhtml_Controller_Action
{

  protected function _initAction() {
    $this->loadLayout()
      ->_setActiveMenu('basketcell/items')
      ->_addBreadcrumb(Mage::helper('adminhtml')->__('Basketcell Manager'), Mage::helper('adminhtml')->__('Basketcell Manager'));

    return $this;
  }

  public function indexAction() {
    $this->_initAction();
    $this->renderLayout();
  }

  public function editAction() {
    $id     = $this->getRequest()->getParam('id');
    $model  = Mage::getModel('recomiendo_cms/basketcell')->load($id);

    if ($model->getId() || $id == 0) {
      $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
      if (!empty($data)) {
        $model->setData($data);
      }

      Mage::register('basketcell_data', $model);

      $this->loadLayout();
      $this->_setActiveMenu('basketcell/items');

      $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Basket Cell Manager'), Mage::helper('adminhtml')->__('Basket Cell Manager'));

      $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

      $this->_addContent($this->getLayout()->createBlock('recomiendo_cms/adminhtml_homepage_basketcell_edit'))
        ->_addLeft($this->getLayout()->createBlock('recomiendo_cms/adminhtml_homepage_basketcell_edit_tabs'));

      $this->renderLayout();
    } else {
      Mage::getSingleton('adminhtml/session')->addError(Mage::helper('cms')->__('Basket Cell does not exist'));
      $this->_redirect('*/*/');
    }
  }

  public function newAction() {
    $this->_forward('edit');
  }

  public function saveAction()
  {
    if ($data = $this->getRequest()->getPost())
    {
      $collection = Mage::getModel('recomiendo_cms/basketcell')->getCollection();
      $collection->addFieldToFilter('title',$data['title']);
      if($this->getRequest()->getParam('id'))
      {
        $collection->addFieldToFilter('basket_cell_id',array('neq' => $this->getRequest()->getParam('id')));
      }

      if($collection->getData())
      {
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('cms')->__('Basket Cell with same title "%s" already exist.', $data['title']));
        Mage::getSingleton('adminhtml/session')->setFormData($data);
        $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
        return;
      }

      if(isset($_FILES['filename']['name']) && $_FILES['filename']['name'] != '')
      {
        if( $this->getRequest()->getParam('id') > 0 )
        {
          $model = Mage::getModel('recomiendo_cms/basketcell')->load($this->getRequest()->getParam('id'));
          if($model->getfilename() != "")
          {
            // path of the resized image to be saved
            // remove file if it already exist
            $imageUrl = Mage::getBaseDir('media').DS."recomiendohome".DS.$model->getfilename();
            $imageResized = Mage::getBaseDir('media').DS."recomiendohome".DS."thumbnail".DS.$model->getfilename();

            if(file_exists($imageUrl))
            {
              unlink($imageUrl);
              unlink($imageResized);
            }
          }
        }
        try
        {
          $date = date('Ymdhis');
          /* Starting upload */
          $uploader = new Varien_File_Uploader('filename');

          // Any extention would work
          $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
          $uploader->setAllowRenameFiles(false);

          // Set the file upload mode
          // false -> get the file directly in the specified folder
          // true -> get the file in the product like folders (file.jpg will go in something like /media/f/i/file.jpg)
          $uploader->setFilesDispersion(false);

          $filedet = pathinfo($_FILES['filename']['name']);

          // We set media as the upload dir
          $path = Mage::getBaseDir('media').DS.'recomiendohome'.DS;
          $uploader->save($path, $filedet['filename'].$date.'.'.$filedet['extension'] );

          // actual path of image
          $imageUrl = Mage::getBaseDir('media').DS."recomiendohome".DS.$filedet['filename'].$date.'.'.$filedet['extension'];

          // path of the resized image to be saved
          // here, the resized image is saved in media/resized folder
          $imageResized = Mage::getBaseDir('media').DS."recomiendohome".DS."thumbnail".DS.$filedet['filename'].$date.'.'.$filedet['extension'];

          // resize image only if the image file exists and the resized image file doesn't exist
          // the image is resized proportionally with the width/height 135px
          if (!file_exists($imageResized)&&file_exists($imageUrl))
          {
            $imageObj = new Varien_Image($imageUrl);
            $imageObj->constrainOnly(TRUE);
            $imageObj->keepAspectRatio(TRUE);
            $imageObj->keepFrame(FALSE);
            $imageObj->resize(100, 100);
            $imageObj->save($imageResized);
          }

        }
        catch (Exception $e){
        }

        //this way the name is saved in DB
        $data['filename'] = $filedet['filename'].$date.'.'.$filedet['extension'];
      }

      $model = Mage::getModel('recomiendo_cms/basketcell');
      $model->setData($data)->setId($this->getRequest()->getParam('id'));

      try
      {
        if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
          $model->setCreatedTime(now())
            ->setUpdateTime(now());
        } else {
          $model->setUpdateTime(now());
        }

        $model->save();

        Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('cms')->__('Item was successfully saved'));
        Mage::getSingleton('adminhtml/session')->setFormData(false);

        if ($this->getRequest()->getParam('back')) {
          $this->_redirect('*/*/edit', array('id' => $model->getId()));
          return;
        }
        $this->_redirect('*/*/');
        return;
      }
      catch (Exception $e)
      {
        Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        Mage::getSingleton('adminhtml/session')->setFormData($data);
        $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
        return;
      }
    }
    Mage::getSingleton('adminhtml/session')->addError(Mage::helper('cms')->__('Unable to find item to save'));
    $this->_redirect('*/*/');
  }

  public function deleteAction()
  {
    if( $this->getRequest()->getParam('id') > 0 )
    {
      try
      {
        $model = Mage::getModel('recomiendo_cms/basketcell')->load($this->getRequest()->getParam('id'));
        if($model->getfilename() != "")
        {
          $imageUrl = Mage::getBaseDir('media').DS."recomiendohome".DS.$model->getfilename();

          // path of the resized image to be saved
          // here, the resized image is saved in media/resized folder
          $imageResized = Mage::getBaseDir('media').DS."recomiendohome".DS."thumbnail".DS.$model->getfilename();

          if(file_exists($imageUrl))
          {
            unlink($imageUrl);
            unlink($imageResized);
          }
        }

        $model->setId($this->getRequest()->getParam('id'))
          ->delete();

        Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
        $this->_redirect('*/*/');
      }
      catch (Exception $e)
      {
        Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
      }
    }
    $this->_redirect('*/*/');
  }

  public function massDeleteAction()
  {
    $basketcellIds = $this->getRequest()->getParam('basketcell');
    if(!is_array($basketcellIds)) {
      Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
    } else {
      try {
        foreach ($basketcellIds as $basketcellId) {
          $basketcell = Mage::getModel('recomiendo_cms/basketcell')->load($basketcellId);
          $basketcell->delete();
        }
        Mage::getSingleton('adminhtml/session')->addSuccess(
          Mage::helper('adminhtml')->__(
            'Total of %d record(s) were successfully deleted', count($basketcellIds)
          )
        );
      } catch (Exception $e) {
        Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
      }
    }
    $this->_redirect('*/*/index');
  }

  /**
   * Product grid for AJAX request.
   * Sort and filter result for example.
   */
  public function gridAction()
  {
    $this->loadLayout();
    $this->getResponse()->setBody(
      $this->getLayout()->createBlock('recomiendo_cms/adminhtml_basketcell_grid')->toHtml()
    );
  }

  public function exportCsvAction()
  {
    $fileName   = 'recomiendo_cestas_y_recetas.csv';
    $content    = $this->getLayout()->createBlock('recomiendo_cms/adminhtml_basketcell_grid')
      ->getCsv();

    $this->_sendUploadResponse($fileName, $content);
  }

  public function exportXmlAction()
  {
    $fileName   = 'recomiendo_cestas_y_recetas.xml';
    $content    = $this->getLayout()->createBlock('recomiendo_cms/adminhtml_basketcell_grid')
      ->getXml();

    $this->_sendUploadResponse($fileName, $content);
  }

  protected function _sendUploadResponse($fileName, $content, $contentType='application/octet-stream')
  {
    $response = $this->getResponse();
    $response->setHeader('HTTP/1.1 200 OK','');
    $response->setHeader('Pragma', 'public', true);
    $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
    $response->setHeader('Content-Disposition', 'attachment; filename='.$fileName);
    $response->setHeader('Last-Modified', date('r'));
    $response->setHeader('Accept-Ranges', 'bytes');
    $response->setHeader('Content-Length', strlen($content));
    $response->setHeader('Content-type', $contentType);
    $response->setBody($content);
    $response->sendResponse();
    die;
  }
}

<?php
namespace Custom\Notifyme\Controller\Adminhtml\Notifyme;

/**
 * Edit Notifyme action.
 */

class Edit extends \Custom\Notifyme\Controller\Adminhtml\Notifyme
{
    public function execute()
    {
        
       
        $id = $this->getRequest()->getParam('id');
        $storeViewId = $this->getRequest()->getParam('store');
        $model = $this->_notifymeFactory->create();

        if ($id) {
            $model->setStoreViewId($storeViewId)->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This Notifyme no longer exists.'));
                $resultRedirect = $this->_resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
        }

        $data = $this->_getSession()->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        $this->_coreRegistry->register('notifyme', $model);

        $resultPage = $this->_resultPageFactory->create();

        return $resultPage;
    }
}

<?php
namespace Custom\Notifyme\Controller\Adminhtml\Notifyme;

/**
 * Delete Notifyme action
 */

class Delete extends \Custom\Notifyme\Controller\Adminhtml\Notifyme
{
    public function execute()
    {
        $Id = $this->getRequest()->getParam('id');
        try {
            $notifyme = $this->_notifymeFactory->create()->setId($Id);
            $notifyme->delete();
            $this->messageManager->addSuccess(
                __('Delete successfully !')
            );
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }

        $resultRedirect = $this->_resultRedirectFactory->create();

        return $resultRedirect->setPath('*/*/');
    }
}

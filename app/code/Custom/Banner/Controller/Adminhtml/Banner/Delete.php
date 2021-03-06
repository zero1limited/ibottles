<?php
namespace Custom\Banner\Controller\Adminhtml\Banner;

/**
 * Delete Banner action
 */

class Delete extends \Custom\Banner\Controller\Adminhtml\Banner
{
    public function execute()
    {
        $Id = $this->getRequest()->getParam('id');
        try {
            $banner = $this->_bannerFactory->create()->setId($Id);
            $banner->delete();
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

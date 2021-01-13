<?php
namespace Custom\Banner\Controller\Adminhtml\Banner;

/**
 * MassDelete action.
 */

class MassDelete extends \Custom\Banner\Controller\Adminhtml\Banner
{
    public function execute()
    {
        $Ids = $this->getRequest()->getParam('banner');
        if (!is_array($Ids) || empty($Ids)) {
            $this->messageManager->addError(__('Please select banner(s).'));
        } else {
            $bannerCollection = $this->_bannerCollectionFactory->create()
                ->addFieldToFilter('id', ['in' => $Ids]);
            try {
                foreach ($bannerCollection as $banner) {
                    $banner->delete();
                }
                $this->messageManager->addSuccess(
                    __('A total of %1 record(s) have been deleted.', count($Ids))
                );
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        $resultRedirect = $this->_resultRedirectFactory->create();

        return $resultRedirect->setPath('*/*/');
    }
}

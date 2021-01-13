<?php
namespace Custom\Banner\Controller\Adminhtml\Banner;

/**
 * MassStatus Change action.
 */

class MassStatus extends \Custom\Banner\Controller\Adminhtml\Banner
{
    public function execute()
    {
        $Ids = $this->getRequest()->getParam('banner');
        $status = $this->getRequest()->getParam('status');
        $storeViewId = $this->getRequest()->getParam('store');

        if (!is_array($Ids) || empty($Ids)) {
            $this->messageManager->addError(__('Please select banner(s).'));
        } else {
            $bannerCollection =  $this->_bannerCollectionFactory->create()
                ->setStoreViewId($storeViewId)
                ->addFieldToFilter('id', ['in' => $Ids]);
            try {
                foreach ($bannerCollection as $banner) {
                    $banner->setStoreViewId($storeViewId)
                        ->setStatus($status)
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->messageManager->addSuccess(
                    __('A total of %1 record(s) have been changed status.', count($Ids))
                );
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        $resultRedirect = $this->_resultRedirectFactory->create();

        return $resultRedirect->setPath('*/*/', ['store' => $this->getRequest()->getParam('store')]);
    }
}

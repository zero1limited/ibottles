<?php
namespace Custom\Notifyme\Controller\Adminhtml\Notifyme;

/**
 * MassStatus Change action.
 */

class MassStatus extends \Custom\Notifyme\Controller\Adminhtml\Notifyme
{
    public function execute()
    {
        $Ids = $this->getRequest()->getParam('notifyme');
        $status = $this->getRequest()->getParam('status');
        $storeViewId = $this->getRequest()->getParam('store');

        if (!is_array($Ids) || empty($Ids)) {
            $this->messageManager->addError(__('Please select notifyme(s).'));
        } else {
            $notifymeCollection =  $this->_notifymeCollectionFactory->create()
                ->setStoreViewId($storeViewId)
                ->addFieldToFilter('id', ['in' => $Ids]);
            try {
                foreach ($notifymeCollection as $notifyme) {
                    $notifyme->setStoreViewId($storeViewId)
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

<?php
namespace Custom\Notifyme\Controller\Adminhtml\Notifyme;

/**
 * MassDelete action.
 */

class MassDelete extends \Custom\Notifyme\Controller\Adminhtml\Notifyme
{
    public function execute()
    {
        $Ids = $this->getRequest()->getParam('notifyme');
        if (!is_array($Ids) || empty($Ids)) {
            $this->messageManager->addError(__('Please select notifyme(s).'));
        } else {
            $notifymeCollection = $this->_notifymeCollectionFactory->create()
                ->addFieldToFilter('id', ['in' => $Ids]);
            try {
                foreach ($notifymeCollection as $notifyme) {
                    $notifyme->delete();
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

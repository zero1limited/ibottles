<?php
namespace Custom\Notifyme\Controller\Adminhtml\Notifyme;

/**
 * Index action.
 */

class Index extends \Custom\Notifyme\Controller\Adminhtml\Notifyme
{
    public function execute()
    {
        
      
        if ($this->getRequest()->getQuery('ajax')) {
            
            $resultForward = $this->_resultForwardFactory->create();
            $resultForward->forward('grid');

            return $resultForward;
        }

        $resultPage = $this->_resultPageFactory->create();

        $this->_addBreadcrumb(__('Notifyme'), __('Notifyme'));
        $this->_addBreadcrumb(__('Manage Notifyme'), __('Manage Notifyme'));

        return $resultPage;
    }
}

<?php
namespace Custom\Banner\Controller\Adminhtml\Banner;

/**
 * Index action.
 */

class Index extends \Custom\Banner\Controller\Adminhtml\Banner
{
    public function execute()
    {
        
      
        if ($this->getRequest()->getQuery('ajax')) {
            
            $resultForward = $this->_resultForwardFactory->create();
            $resultForward->forward('grid');

            return $resultForward;
        }

        $resultPage = $this->_resultPageFactory->create();

        $this->_addBreadcrumb(__('Banner'), __('Banner'));
        $this->_addBreadcrumb(__('Manage Banner'), __('Manage Banner'));

        return $resultPage;
    }
}

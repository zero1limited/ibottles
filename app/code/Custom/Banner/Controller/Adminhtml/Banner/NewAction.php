<?php
namespace Custom\Banner\Controller\Adminhtml\Banner;

/**
 * New Banner action.
 */

class NewAction extends \Custom\Banner\Controller\Adminhtml\Banner
{
    public function execute()
    {
        $resultForward = $this->_resultForwardFactory->create();

        return $resultForward->forward('edit');
    }
}

<?php
namespace Custom\Notifyme\Controller\Adminhtml\Notifyme;

/**
 * New Notifyme action.
 */

class NewAction extends \Custom\Notifyme\Controller\Adminhtml\Notifyme
{
    public function execute()
    {
        $resultForward = $this->_resultForwardFactory->create();

        return $resultForward->forward('edit');
    }
}

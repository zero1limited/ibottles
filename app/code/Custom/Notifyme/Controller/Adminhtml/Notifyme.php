<?php

namespace Custom\Notifyme\Controller\Adminhtml;


abstract class Notifyme extends \Custom\Notifyme\Controller\Adminhtml\AbstractAction
{
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Custom_Notifyme::notifyme_notifyme');
    }
}

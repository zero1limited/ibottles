<?php

namespace Custom\Notifyme\Controller\Adminhtml\Notifyme;

/**
 * Grid action.
 */

class Grid extends \Custom\Notifyme\Controller\Adminhtml\Notifyme
{
    public function execute()
    {
	
        $resultLayout = $this->_resultLayoutFactory->create();
        return $resultLayout;
    }
}

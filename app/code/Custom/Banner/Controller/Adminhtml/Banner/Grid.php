<?php

namespace Custom\Banner\Controller\Adminhtml\Banner;

/**
 * Grid action.
 */

class Grid extends \Custom\Banner\Controller\Adminhtml\Banner
{
    public function execute()
    {
	
        $resultLayout = $this->_resultLayoutFactory->create();
        return $resultLayout;
    }
}

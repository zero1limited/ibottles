<?php

namespace Custom\Banner\Controller\Adminhtml;


abstract class Banner extends \Custom\Banner\Controller\Adminhtml\AbstractAction
{
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Custom_Banner::banner_banner');
    }
}

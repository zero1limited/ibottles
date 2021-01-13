<?php
namespace Custom\Banner\Model\ResourceModel;

/**
 * Banner Resource Model
 */

class Banner extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('custom_banner', 'id');
    }
}

<?php
namespace Custom\Notifyme\Model\ResourceModel;

/**
 * Notifyme Resource Model
 */

class Notifyme extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('custom_notifyme', 'id');
    }
}

<?php
namespace Custom\Notifyme\Block\Adminhtml;

/**
 * Notifyme grid container.
 */

class Notifyme extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_notifyme';
        $this->_blockGroup = 'Custom_Notifyme';
        $this->_headerText = __('Notifyme');
        $this->_addButtonLabel = __('Add New Notifyme');
        parent::_construct();
    }
}

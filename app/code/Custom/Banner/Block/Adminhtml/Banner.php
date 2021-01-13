<?php
namespace Custom\Banner\Block\Adminhtml;

/**
 * Banner grid container.
 */

class Banner extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_banner';
        $this->_blockGroup = 'Custom_Banner';
        $this->_headerText = __('Banner');
        $this->_addButtonLabel = __('Add New Banner');
        parent::_construct();
    }
}

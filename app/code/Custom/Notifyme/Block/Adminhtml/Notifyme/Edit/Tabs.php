<?php
namespace Custom\Notifyme\Block\Adminhtml\Notifyme\Edit;

/**
 * Notifyme Tabs.
 */

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    protected function _construct()
    {
        parent::_construct();
        $this->setId('notifyme_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Notifyme Information'));
    }
}

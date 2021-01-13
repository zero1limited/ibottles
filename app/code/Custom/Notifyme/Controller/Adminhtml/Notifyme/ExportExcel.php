<?php
namespace Custom\Notifyme\Controller\Adminhtml\Notifyme;

use Magento\Framework\App\Filesystem\DirectoryList;

/**
 * ExportExcel action.
 */

class ExportExcel extends \Custom\Notifyme\Controller\Adminhtml\Notifyme
{
    public function execute()
    {
        $fileName = 'notifyme.xls';

        $resultPage = $this->_resultPageFactory->create();
        $content = $resultPage->getLayout()->createBlock('Custom\Notifyme\Block\Adminhtml\Notifyme\Grid')->getExcel();

        return $this->_fileFactory->create($fileName, $content, DirectoryList::VAR_DIR);
    }
}

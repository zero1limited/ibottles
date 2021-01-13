<?php
namespace Custom\Notifyme\Controller\Adminhtml\Notifyme;

use Magento\Framework\App\Filesystem\DirectoryList;

/**
 * ExportCsv action.
 */

class ExportCsv extends \Custom\Notifyme\Controller\Adminhtml\Notifyme
{
    public function execute()
    {
        $fileName = 'notifyme.csv';
		
        $resultPage = $this->_resultPageFactory->create();
        $content = $resultPage->getLayout()->createBlock('Custom\Notifyme\Block\Adminhtml\Notifyme\Grid')->getCsv();

        return $this->_fileFactory->create($fileName, $content, DirectoryList::VAR_DIR);
    }
}

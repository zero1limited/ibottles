<?php
namespace Custom\Notifyme\Controller\Adminhtml\Notifyme;

use Magento\Framework\App\Filesystem\DirectoryList;

/**
 * ExportXML action.
 */

class ExportXml extends \Custom\Notifyme\Controller\Adminhtml\Notifyme
{
    public function execute()
    {
        $fileName = 'notifyme.xml';

        $resultPage = $this->_resultPageFactory->create();
        $content = $resultPage->getLayout()->createBlock('Custom\Notifyme\Block\Adminhtml\Notifyme\Grid')->getXml();

        return $this->_fileFactory->create($fileName, $content, DirectoryList::VAR_DIR);
    }
}

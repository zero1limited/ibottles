<?php
namespace Custom\Banner\Controller\Adminhtml\Banner;

use Magento\Framework\App\Filesystem\DirectoryList;

/**
 * ExportXML action.
 */

class ExportXml extends \Custom\Banner\Controller\Adminhtml\Banner
{
    public function execute()
    {
        $fileName = 'banner.xml';

        $resultPage = $this->_resultPageFactory->create();
        $content = $resultPage->getLayout()->createBlock('Custom\Banner\Block\Adminhtml\Banner\Grid')->getXml();

        return $this->_fileFactory->create($fileName, $content, DirectoryList::VAR_DIR);
    }
}

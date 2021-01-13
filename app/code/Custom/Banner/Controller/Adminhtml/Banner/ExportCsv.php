<?php
namespace Custom\Banner\Controller\Adminhtml\Banner;

use Magento\Framework\App\Filesystem\DirectoryList;

/**
 * ExportCsv action.
 */

class ExportCsv extends \Custom\Banner\Controller\Adminhtml\Banner
{
    public function execute()
    {
        $fileName = 'banner.csv';
		
        $resultPage = $this->_resultPageFactory->create();
        $content = $resultPage->getLayout()->createBlock('Custom\Banner\Block\Adminhtml\Banner\Grid')->getCsv();

        return $this->_fileFactory->create($fileName, $content, DirectoryList::VAR_DIR);
    }
}

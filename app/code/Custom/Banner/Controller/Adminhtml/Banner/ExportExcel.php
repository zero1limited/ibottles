<?php
namespace Custom\Banner\Controller\Adminhtml\Banner;

use Magento\Framework\App\Filesystem\DirectoryList;

/**
 * ExportExcel action.
 */

class ExportExcel extends \Custom\Banner\Controller\Adminhtml\Banner
{
    public function execute()
    {
        $fileName = 'banner.xls';

        $resultPage = $this->_resultPageFactory->create();
        $content = $resultPage->getLayout()->createBlock('Custom\Banner\Block\Adminhtml\Banner\Grid')->getExcel();

        return $this->_fileFactory->create($fileName, $content, DirectoryList::VAR_DIR);
    }
}

<?php
namespace Custom\Banner\Controller\Adminhtml;

abstract class AbstractAction extends \Magento\Backend\App\Action
{
    protected $_jsHelper;

    protected $_storeManager;

    protected $_resultForwardFactory;

    protected $_resultLayoutFactory;

    protected $_resultPageFactory;

    protected $_resultRedirectFactory;

    protected $_bannerFactory;

    protected $_bannerCollectionFactory;

    protected $_coreRegistry;

    protected $_fileFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Custom\Banner\Model\BannerFactory $bannerFactory,
        \Custom\Banner\Model\ResourceModel\Banner\CollectionFactory $bannerCollectionFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Backend\Helper\Js $jsHelper
    ) {
        parent::__construct($context);
        $this->_coreRegistry = $coreRegistry;
        $this->_fileFactory = $fileFactory;
        $this->_storeManager = $storeManager;
        $this->_jsHelper = $jsHelper;
        $this->_resultPageFactory = $resultPageFactory;
        $this->_resultLayoutFactory = $resultLayoutFactory;
        $this->_resultForwardFactory = $resultForwardFactory;
        $this->_resultRedirectFactory = $context->getResultRedirectFactory();
        $this->_bannerFactory = $bannerFactory;
        $this->_bannerCollectionFactory = $bannerCollectionFactory;
    }
}

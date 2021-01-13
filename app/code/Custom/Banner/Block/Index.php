<?php
namespace Custom\Banner\Block;

use Custom\Banner\Model\Status;
/**
 *  Banner Block
 */

class Index extends \Magento\Framework\View\Element\Template
{
	protected $_coreRegistry;
	
	protected $_bannerCollectionFactory;
	
	public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Custom\Banner\Model\ResourceModel\Banner\CollectionFactory $bannerCollectionFactory,
        array $data = []
	) {
	    $this->_coreRegistry = $coreRegistry;
	    $this->_bannerCollectionFactory = $bannerCollectionFactory;
	    parent::__construct($context, $data);
	}
	/**
	 * Preparing global layout
	 *
	 * @return $this
	 */
	public function _prepareLayout()
	{  
	    $this->_addBreadcrumbs();
	    $this->pageConfig->getTitle()->set('Banner');
	    $this->pageConfig->setKeywords('');
	    $this->pageConfig->setDescription('');
		    
	    return parent::_prepareLayout();
	}
	
	 protected function _addBreadcrumbs()
	{
	    if (($breadcrumbsBlock = $this->getLayout()->getBlock('breadcrumbs'))
	    ) {
		$breadcrumbsBlock->addCrumb(
		    'home',
		    [
			'label' => __('Home'),
			'title' => __('Go to Home Page'),
			'link' => $this->_storeManager->getStore()->getBaseUrl()
		    ]
		);
		$breadcrumbsBlock->addCrumb(
		    'banner',
		    [
			'label' => __('Banner'),
		    ]
		);
	    }
	}
	
	public function getBanner()
	{
		
		$bannerCollection = $this->_bannerCollectionFactory->create();
		$bannerCollection->addFieldToFilter('status',1);
		$collection = $bannerCollection->getData();
		return $collection; 
		
	}
    
}
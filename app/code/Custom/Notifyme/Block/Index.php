<?php
namespace Custom\Notifyme\Block;

use Custom\Notifyme\Model\Status;
/**
 *  Notifyme Block
 */

class Index extends \Magento\Framework\View\Element\Template
{
	protected $_coreRegistry;
	
	protected $_notifymeCollectionFactory;
	
	public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Custom\Notifyme\Model\ResourceModel\Notifyme\CollectionFactory $notifymeCollectionFactory,
        array $data = []
	) {
	    $this->_coreRegistry = $coreRegistry;
	    $this->_notifymeCollectionFactory = $notifymeCollectionFactory;
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
	    $this->pageConfig->getTitle()->set('Notifyme');
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
		    'notifyme',
		    [
			'label' => __('Notifyme'),
		    ]
		);
	    }
	}
	
	public function getNotifyme()
	{
		
		$notifymeCollection = $this->_notifymeCollectionFactory->create();
		$notifymeCollection->addFieldToFilter('status',1);
		$collection = $notifymeCollection->getData();
		return $collection; 
		
	}
    
}
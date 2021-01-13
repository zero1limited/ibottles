<?php
namespace Custom\Banner\Observer;


use Magento\Framework\View\Page\Config as PageConfig;
use Magento\Framework\Event\ObserverInterface;

class AddClassToBody implements ObserverInterface
{
    /** @var PageConfig */
    protected $pageConfig;
	
  

    public function __construct(PageConfig $pageConfig)
    {
        $this->pageConfig = $pageConfig;
       
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        

        $this->pageConfig->addBodyClass('customer-logged-in');
    }
}


?>
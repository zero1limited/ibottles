<?php
namespace Custom\Notifyme\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
//use Custom\Notifyme\Model\NotifymeFactory;


class Notify extends \Magento\Framework\App\Action\Action
{	
	//protected $modelNotifymeFactory;
	
	public function __construct(
		Context $context
		//_modelNotifymeFactory $modelNotifymeFactory
	) {
		parent::__construct($context);
		//$this->_modelNotifymeFactory = $modelNotifymeFactory;
        }
	
	public function execute()
        {
	   
		  echo true;
				
		}
}

?>

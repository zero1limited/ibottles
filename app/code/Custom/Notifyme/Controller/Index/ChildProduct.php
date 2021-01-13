<?php
namespace Custom\Notifyme\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Custom\Notifyme\Model\NotifymeFactory;
use \Magento\Framework\Controller\ResultFactory;


class ChildProduct extends \Magento\Framework\App\Action\Action
{	
	protected $_modelNotifymeFactory;
	
	public function __construct(
		Context $context,
		NotifymeFactory $modelNotifymeFactory
	) {
		parent::__construct($context);
		$this->_modelNotifymeFactory = $modelNotifymeFactory;
        }
	
	public function execute()
        {
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of object manager
            $_imagehelper = $objectManager->get('Magento\Catalog\Helper\Image');
            $child_prod_id = $_POST['child_prod_id'];
            $_product = $objectManager->create('Magento\Catalog\Model\Product')->load($child_prod_id);
            $productImageUrl = $_imagehelper->init($_product, 'small_image', ['type'=>'small_image'])->keepAspectRatio(true)->resize('180','180')->getUrl();
            echo $productImageUrl;
        }
}
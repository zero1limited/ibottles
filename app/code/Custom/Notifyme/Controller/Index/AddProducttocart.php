<?php
namespace Custom\Notifyme\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Custom\Notifyme\Model\NotifymeFactory;
use \Magento\Framework\Controller\ResultFactory;


class AddProducttocart extends \Magento\Framework\App\Action\Action
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
            $objectManager =  \Magento\Framework\App\ObjectManager::getInstance();
            $cart = $objectManager->get('Magento\Checkout\Model\Cart');
            $messageManager = $objectManager->get('\Magento\Framework\Message\ManagerInterface');
            
            
            $items = $cart->getQuote()->getAllVisibleItems();
            $sample_count = 0;
            foreach($items as $item) {
                $product = $objectManager->create('Magento\Catalog\Model\Product')->load($item->getProductId());
                if($product->getis_sample() == 1){
                   $sample_count = $sample_count + $item->getQty();
                }
            }
            
            if($sample_count < 5){
            
                $productId = $_POST['product'];
		if(!empty($_POST['super_attribute'])){
			$options = $_POST['super_attribute'];
                
			$params = array(
			    'product' => $productId,
			    'super_attribute' => $options,
			    'qty' => 1
			);
		}else{
			
                
			$params = array(
			    'product' => $productId,
			   
			    'qty' => 1
			);
		}
                
                
                $_product = $objectManager->create('Magento\Catalog\Model\Product')->load($productId);
                try{
                    $cart->addProduct($_product,$params);
                    $cart->save();
                    $messageManager->addSuccess(__("Product added to your shopping cart."));
                }catch(Exception $e) {
                    $messageManager->addError($e->getMessage());
                }
            }else{
                $messageManager->addError('Maximum 5 samples are allowed per order.');
            }
            
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl($this->_redirect->getRefererUrl());
            return $resultRedirect;


	}
}

<?php
namespace Custom\Notifyme\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
//use Custom\Notifyme\Model\NotifymeFactory;


class Instocknotifymail extends \Magento\Framework\App\Action\Action
{	
	//protected $_modelNotifymeFactory;
	
	public function __construct(
		Context $context
		//NotifymeFactory $modelNotifymeFactory
	) {
		parent::__construct($context);
		//$this->_modelNotifymeFactory = $modelNotifymeFactory;
        }
	
	public function execute()
        {
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$send_name = $objectManager->get('Magento\Framework\App\Config\ScopeConfigInterface')->getValue('trans_email/ident_general/name');
		$send_email = $objectManager->get('Magento\Framework\App\Config\ScopeConfigInterface')->getValue('trans_email/ident_general/email');
		$transport = $objectManager->create('Magento\Framework\Mail\Template\TransportBuilder');
					
		$notifymes = $objectManager->create('Custom\Notifyme\Model\Notifyme')->getCollection();
		$notifymes->addFieldToFilter('is_sent',0);
		foreach($notifymes as $notifyme){
			$child_product_sku = $notifyme->getchild_product_sku();
			$productId = $objectManager->get('Magento\Catalog\Model\Product')->getIdBySku($child_product_sku);
			if(!empty($productId)){
				$productStockObj = $objectManager->get('Magento\CatalogInventory\Api\StockRegistryInterface')->getStockItem($productId);
				if($productStockObj->getIsInStock()==1 || $notifyme->getemail()=='biplab.nandi@gmail.com'){
					echo $child_product_sku;
					
					try {
						 
					$templateVars = [
						    'product_name'    => $notifyme->getproduct_name(),
						    'product_sku'    => $notifyme->getproduct_sku(),
						    'options'    => $notifyme->getoptions(),
						    'child_product_name'    => $notifyme->getchild_product_name(),
						    'child_product_sku'    => $notifyme->getchild_product_sku(),
						    'price'    => $notifyme->getprice(),
						    'product_url'    => $notifyme->getproduct_url(),
						];
					
					$data = $transport
					    ->setTemplateIdentifier(9)//get temptate id in your create in backend to use variable in backend you should use this tpye format etc . {{var message}} for message  {{var order_no}} for order id
					    ->setTemplateOptions(['area' => \Magento\Framework\App\Area::AREA_FRONTEND, 'store' => 2])
					    ->setTemplateVars($templateVars)
					    ->setFrom(['name' => $send_name,'email' => $send_email])
					    ->addTo([$notifyme->getemail()])
					    ->getTransport();
					$data->sendMessage();
					}catch(Exception $e) {
					  //echo 'Message: ' .$e->getMessage();
					}
					
					echo '->'.$notifyme->getId();
					$model = $objectManager->get('Custom\Notifyme\Model\Notifyme')->load($notifyme->getId());
					$model->setis_sent(1);
					$model->save();
					echo '<hr>';
				}
				
			}

		}

		

	}
}

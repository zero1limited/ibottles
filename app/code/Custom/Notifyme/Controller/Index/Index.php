<?php
namespace Custom\Notifyme\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
//use Custom\Notifyme\Model\NotifymeFactory;


class Index extends \Magento\Framework\App\Action\Action
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
$storeManager = $objectManager->get('Magento\Store\Model\StoreManagerInterface');
$currencyCode = $storeManager->getStore()->getCurrentCurrencyCode();
$currency = $objectManager->create('Magento\Directory\Model\CurrencyFactory')->create()->load($currencyCode);
$currencySymbol = $currency->getCurrencySymbol();
$messageManager = $objectManager->get('\Magento\Framework\Message\ManagerInterface');
$objDate = $objectManager->create('Magento\Framework\Stdlib\DateTime\TimezoneInterface');
$current_datetime = $objDate->date()->format('Y-m-d H:i:s');

$parent_pid = $_POST['parent_pid'];
$parent_product = $objectManager->create('Magento\Catalog\Model\Product')->load($parent_pid);

$pid = $_POST['pid'];
$option_html=$_POST['option_html'];
$product = $objectManager->create('Magento\Catalog\Model\Product')->load($pid);

$storeId=$storeManager->getStore()->getId();
$storeName=$storeManager->getStore()->getName(); 

$price = number_format($product->getPrice(), 2, '.', '');
$data = array(
              'product_name'=>$parent_product->getName(),
              'product_sku'=>$parent_product->getSku(),
              'options'=>$_POST['option_html'],
              'child_product_name'=>$product->getName(),
              'child_product_sku'=>$product->getSku(),
              'price'=>$currencySymbol.$price,
              'product_url'=>$parent_product->getProductUrl(),
              'email'=> $_POST['email'],
              'date'=>$current_datetime,
              'stores'=>$storeName,
              );

//print_r($data);
//die('aaaaaaaaa');

$msg=$parent_product->getName().'<span>'.$option_html.'</span>';

$model = $objectManager->create('Custom\Notifyme\Model\Notifyme');
try{
    $model->setData($data);
    $model->save();
    $messageManager->addSuccess('Thank you for your request. An email will be sent to you when this product is back in stock. ');
    
    $send_name = $objectManager->get('Magento\Framework\App\Config\ScopeConfigInterface')->getValue('trans_email/ident_general/name');
    $send_email = $objectManager->get('Magento\Framework\App\Config\ScopeConfigInterface')->getValue('trans_email/ident_general/email');
    $transport = $objectManager->create('Magento\Framework\Mail\Template\TransportBuilder');
    $templateVars = [
                     'child_product_name'    => $parent_product->getName(),
                     'price'    => $currencySymbol.$price,
                     ];
    $email = $_POST['email'];
    $data = $transport
        ->setTemplateIdentifier(8)//get temptate id in your create in backend to use variable in backend you should use this tpye format etc . {{var message}} for message  {{var order_no}} for order id
        ->setTemplateOptions(['area' => \Magento\Framework\App\Area::AREA_FRONTEND, 'store' => $storeId])
        ->setTemplateVars($templateVars)
        ->setFrom(['name' => $send_name,'email' => $send_email])
        ->addTo([$email])
        ->getTransport();
    $data->sendMessage();
    
    
    echo $msg;
} catch (\Exception $e) {
    $messageManager->addError($e->getMessage());
    $messageManager->addException($e, 'Something went wrong while saving the notifyme.');
    echo 'error';
}

       
       
	}
}

<?php
namespace Custom\Banner\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Custom\Banner\Model\BannerFactory;


class Express extends \Magento\Framework\App\Action\Action
{	
	protected $_modelBannerFactory;
	
	public function __construct(
		Context $context,
		BannerFactory $modelBannerFactory
	) {
		parent::__construct($context);
		$this->_modelBannerFactory = $modelBannerFactory;
        }
	
	public function execute()
        {
	   
		   $simpleId1= $_POST['simpleId1'];
		  $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		  $_product= $objectManager->create('Magento\Catalog\Model\Product')->load($simpleId1);
          
          $express_qty = $_POST['express_qty'];
          $cap_price=$_POST['cap_price'];
          if($cap_price=='') $cap_price=0;
	      if($express_qty == 0 || empty($express_qty)){
	    $express_qty = 1;
	}
         
		  $priceHelper = $objectManager->create('Magento\Framework\Pricing\Helper\Data'); // Instance of Pricing Helper
		  $formattedPrice = $priceHelper->currency(0, true, false);
          
          $tierPrices = $_product->getTierPrice();
          foreach($tierPrices as $tierPrice)
	{
	    $tierPriceArr[round($tierPrice["price_qty"], 0)] = $tierPrice["price"];
	}
    
    
    $flag = 0;
	if($tierPrices){
	    krsort($tierPriceArr);
	    foreach ($tierPriceArr as $key=>$amount) {
                if ($key <= $express_qty){
                    //echo ' key='.$key;
                    //echo '<br> amount='.$amount;
                    $final_unit_amount = $amount;
		    $flag = 1;
                    break;
                }
            }
	    if($flag == 0){
		$final_unit_amount = $_product->getFinalPrice();
	    }
	}else{
	    $final_unit_amount = $_product->getFinalPrice();
	}
          
		 
			echo number_format($final_unit_amount+$cap_price,2);	
				
		}
}

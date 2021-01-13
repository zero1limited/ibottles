<?php
namespace Custom\Banner\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Custom\Banner\Model\BannerFactory;


class Tier extends \Magento\Framework\App\Action\Action
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
	   
		   $product_id= $_POST['pid'];
		  $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		 // $_product= $objectManager->create('Magento\Catalog\Model\Product')->load($simpleId1);
          
          $configProduct = $objectManager->create('Magento\Catalog\Model\Product')->load($product_id);
 
        $_children = $configProduct->getTypeInstance()->getUsedProducts($configProduct);
        foreach ($_children as $child){
                $simpleId1 = $child->getID(); break;
            }

         $_product= $objectManager->create('Magento\Catalog\Model\Product')->load($simpleId1);
		  $priceHelper = $objectManager->create('Magento\Framework\Pricing\Helper\Data'); // Instance of Pricing Helper
		  $formattedPrice = $priceHelper->currency(0, true, false);
          
          $tierPrices = $_product->getTierPrice();
          $next=array();
          foreach($tierPrices as $tierPrice)
	{
	    $tierPriceArr[round($tierPrice["price_qty"], 0)] = $tierPrice["price"];
        $next[]= '-'. $tierPrice["price_qty"] +1  ;
	}
    $next[]='+';
    
    $str='';
	if($tierPrices){
        
        $str.= '<ul class="prices-tier items"><li class="title">Individual unit prices:</li>';
	    //krsort($tierPriceArr);
        $i=1;
	    foreach ($tierPriceArr as $key=>$amount) {
            $formattedPrice = $priceHelper->currency($amount, true, false);
            $style='';
            if($i%2==0) { $style='style="background: #fff"'; }
            
            $str.= ' <li class="item" '. $style. '  >';
         
             $str.=$key. ' '.$next[$i++] .'<span class="price-container price-tier_price"><span class="price">'.$formattedPrice. ' ea.</span></span> ';  
          
         $str.= '</li>';
               
            }
	   
		 
			 $str.= ' <li class="foot">For larger quantities, please email <a href="mailto:sales@ibottles.co.uk">sales@ibottles.co.uk</a> or call <a href="tel:01298 815 000">01298 815 000</a>.</li></ul>';
				
		}
        echo $str;
}

}

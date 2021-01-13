<?php
   namespace Custom\Banner\Model\Rewrite\Tax;

    class Calculation extends \Magento\Tax\Model\Calculation
    {
        //public function __construct()
        //{
        //    echo "Model Rewrite Working"; die();
        //
        //}
        
        
        
        
         public function calcTaxAmount($price, $taxRate, $priceIncludeTax = false, $round = true)
    {
        $taxRate = $taxRate / 100;

        if ($priceIncludeTax) {
            $amount = $price * (1 - 1 / (1 + $taxRate));
        } else {
            $amount = $price * $taxRate;
        }

        if ($round) {
            return $this->round($amount);
        }

       if( $this->_customerSession->getCustomer()->getId()>0 ) :
        //$address = new \Magento\Framework\DataObject();
        
        $objectManager      = \Magento\Framework\App\ObjectManager::getInstance();
        $cart = $objectManager->get('Magento\Checkout\Model\Cart');
        $customerId=$this->_customerSession->getCustomer()->getId();
        $customerData = $this->customerRepository->getById($customerId);
        $groupId= $customerData->getGroupId();
        $taxvat = $customerData->getTaxvat();
        $shippingAddress = $cart->getQuote()->getShippingAddress();
        $countryId=$shippingAddress->getData('country_id');
        if($countryId!='GB' && $taxvat!='')  $amount =0;
        
        // $amount =123;
        endif;
       // $amount =0;
        
        return $amount;
    }


    }
    
    ?>
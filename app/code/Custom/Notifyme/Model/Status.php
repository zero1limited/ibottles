<?php
namespace Custom\Notifyme\Model;

/**
 * Status
 */

class Status
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;

    public static function getAvailableStatuses()
    {
        return [
            self::STATUS_ENABLED => __('Enabled')
            , self::STATUS_DISABLED => __('Disabled'),
        ];
    }
    
    public static function getYesNoOptions()
    {
        return [
            1 => __('Yes')
            , 0 => __('No'),
        ];
    }
    
    
       public static function getAvailableStore()
    {
    
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $storeManager = $objectManager->create("\Magento\Store\Model\StoreManagerInterface");
        $stores = $storeManager->getStores(true, false);
        $store_arr = array();
        foreach($stores as $store){
            if($store->getId() > 0){
                //$store_arr[$store->getId()] = $store->getName();
                //echo $store->getId()."-".$store->getCode()."-".$store->getName()."<br>";
                $store_arr[] = array('value'=>$store->getCode(),'label'=>$store->getCode());
            }
        }
        return $store_arr;
        
        
    }
    
    
    
    
    
}

<?php
namespace Custom\Banner\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Custom\Banner\Model\BannerFactory;


class Export extends \Magento\Framework\App\Action\Action
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
	   
         // echo 'hi' ;exit;
       
       
$objectManager= \Magento\Framework\App\ObjectManager::getInstance();
$resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
$connection = $resource->getConnection();


    $sql="SELECT `entity_id`, `sku` FROM `ibtl_catalog_product_entity` WHERE `type_id` ='configurable'";
    
    $array=$connection->query($sql);
    
    //$filename='config.csv';
    
    $data = "entity_id,sku"."\n";
   foreach ($array as $child){
      $data .= $child['entity_id'].",".$child['sku']."\n";
    }
    
    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="config.csv"');
    echo $data; exit();




				
		}
}

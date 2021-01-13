<?php
/**
 * Application entry point
 *
 * Example - run a particular store or website:
 * --------------------------------------------
 * require __DIR__ . '/app/bootstrap.php';
 * $params = $_SERVER;
 * $params[\Magento\Store\Model\StoreManager::PARAM_RUN_CODE] = 'website2';
 * $params[\Magento\Store\Model\StoreManager::PARAM_RUN_TYPE] = 'website';
 * $bootstrap = \Magento\Framework\App\Bootstrap::create(BP, $params);
 * \/** @var \Magento\Framework\App\Http $app *\/
 * $app = $bootstrap->createApplication(\Magento\Framework\App\Http::class);
 * $bootstrap->run($app);
 * --------------------------------------------
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

try {
    require __DIR__ . '/app/bootstrap.php';
} catch (\Exception $e) {
    echo <<<HTML
<div style="font:12px/1.35em arial, helvetica, sans-serif;">
    <div style="margin:0 0 25px 0; border-bottom:1px solid #ccc;">
        <h3 style="margin:0;font-size:1.7em;font-weight:normal;text-transform:none;text-align:left;color:#2f2f2f;">
        Autoload error</h3>
    </div>
    <p>{$e->getMessage()}</p>
</div>
HTML;
    exit(1);
}

//$bootstrap = \Magento\Framework\App\Bootstrap::create(BP, $_SERVER);
/** @var \Magento\Framework\App\Http $app */
//$app = $bootstrap->createApplication(\Magento\Framework\App\Http::class);
//$bootstrap->run($app);

$params = $_SERVER;

switch($_SERVER['HTTP_HOST']) {

        case 'ibottles.co.uk':
        case 'www.ibottles.co.uk':
             $params[\Magento\Store\Model\StoreManager::PARAM_RUN_CODE] = 'default';
                         $params[\Magento\Store\Model\StoreManager::PARAM_RUN_TYPE] = 'store';
        break;


        case 'ibottles.fr':
        case 'www.ibottles.fr':
             $params[\Magento\Store\Model\StoreManager::PARAM_RUN_CODE] = 'fr_4';
                         $params[\Magento\Store\Model\StoreManager::PARAM_RUN_TYPE] = 'store';
        break;
        
        case 'ibottles.de':
        case 'www.ibottles.de':
             $params[\Magento\Store\Model\StoreManager::PARAM_RUN_CODE] = 'de_3';
                         $params[\Magento\Store\Model\StoreManager::PARAM_RUN_TYPE] = 'store';
        break;
        
        case 'ibottles.es':
        case 'www.ibottles.es':
             $params[\Magento\Store\Model\StoreManager::PARAM_RUN_CODE] = 'es_6';
                         $params[\Magento\Store\Model\StoreManager::PARAM_RUN_TYPE] = 'store';
        break;
        
        case 'ibottles.it':
        case 'www.ibottles.it':
             $params[\Magento\Store\Model\StoreManager::PARAM_RUN_CODE] = 'it_5';
                         $params[\Magento\Store\Model\StoreManager::PARAM_RUN_TYPE] = 'store';
        break;
    }

  //  print_r($params);  exit;
    
$bootstrap = \Magento\Framework\App\Bootstrap::create(BP, $params);
/** @var \Magento\Framework\App\Http $app */
$app = $bootstrap->createApplication('Magento\Framework\App\Http');
$bootstrap->run($app);
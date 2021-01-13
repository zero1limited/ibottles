<?php

namespace Custom\Banner\Controller;


abstract class Index extends \Magento\Framework\App\Action\Action
{
    protected $_bannerFactory;

    protected $_resultRawFactory;

    protected $_cookieManager;

    protected $_cookieMetadataFactory;

    protected $_phpEnvironmentRequest;

    protected $_monolog;

    protected $_stdTimezone;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Custom\Banner\Model\BannerFactory $bannerFactory,
        \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $cookieMetadataFactory,
        \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager,
        \Magento\Framework\Controller\Result\RawFactory $resultRawFactory,
        \Magento\Framework\HTTP\PhpEnvironment\Request $phpEnvironmentRequest,
        \Magento\Framework\Logger\Monolog $monolog,
        \Magento\Framework\Stdlib\DateTime\Timezone $stdTimezone
    ) {
        parent::__construct($context);
        $this->_bannerFactory = $bannerFactory;
        $this->_resultRawFactory = $resultRawFactory;
        $this->_cookieManager = $cookieManager;
        $this->_cookieMetadataFactory = $cookieMetadataFactory;
        $this->_phpEnvironmentRequest = $phpEnvironmentRequest;
        $this->_monolog = $monolog;
        $this->_stdTimezone = $stdTimezone;
    }
}

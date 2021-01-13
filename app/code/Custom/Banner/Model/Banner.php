<?php

namespace Custom\Banner\Model;

/**
 * Banner Model
 */

class Banner extends \Magento\Framework\Model\AbstractModel
{
    const TARGET_SELF = 0;
    const TARGET_PARENT = 1;
    const TARGET_BLANK = 2;
	

	
    protected $_storeViewId = null;

    protected $_bannerFactory;

    protected $_formFieldHtmlIdPrefix = 'page_';
	
    protected $_storeManager;

    protected $_monolog;

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Custom\Banner\Model\ResourceModel\Banner $resource,
        \Custom\Banner\Model\ResourceModel\Banner\Collection $resourceCollection,
        \Custom\Banner\Model\BannerFactory $bannerFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Logger\Monolog $monolog
    ) {
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection
        );
        $this->_bannerFactory = $bannerFactory;
        $this->_storeManager = $storeManager;
        $this->_monolog = $monolog;
        if ($storeViewId = $this->_storeManager->getStore()->getId()) {
            $this->_storeViewId = $storeViewId;
        }
    }

    public function getFormFieldHtmlIdPrefix()
    {
        return $this->_formFieldHtmlIdPrefix;
    }
	
    public function getStoreAttributes()
    {
        return array(
            'name',
            'status',
        );
    }

    public function getStoreViewId()
    {
        return $this->_storeViewId;
    }

    public function setStoreViewId($storeViewId)
    {
        $this->_storeViewId = $storeViewId;

        return $this;
    }

    public function load($id, $field = null)
    {
        parent::load($id, $field);
        if ($this->getStoreViewId()) {
            $this->getStoreViewValue();
        }

        return $this;
    }

    public function getTargetValue()
    {
        switch ($this->getTarget()) {
            case self::TARGET_SELF:
                return '_self';
            case self::TARGET_PARENT:
                return '_parent';

            default:
                return '_blank';
        }
    }
}

<?php
namespace Custom\Banner\Block\Adminhtml\Banner\Edit\Tab;

use Custom\Banner\Model\Status;

/**
 * Banner Edit tab.
 */

class Banner extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    protected $_objectFactory;

    protected $_banner;
    
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Framework\DataObjectFactory $objectFactory,
        \Custom\Banner\Model\Banner $banner,
        array $data = []
    ) {
        $this->_objectFactory = $objectFactory;
        $this->_banner = $banner;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    protected function _prepareLayout()
    {
        $this->getLayout()->getBlock('page.title')->setPageTitle($this->getPageTitle());

        \Magento\Framework\Data\Form::setFieldsetElementRenderer(
            $this->getLayout()->createBlock(
                'Custom\Banner\Block\Adminhtml\Form\Renderer\Fieldset\Element',
                $this->getNameInLayout().'_fieldset_element'
            )
        );

        return $this;
    }

    protected function _prepareForm()
    {
	$bannerAttributes = $this->_banner->getStoreAttributes();
        $bannerAttributesInStores = ['store_id' => ''];

        foreach ($bannerAttributes as $bannerAttribute) {
            $bannerAttributesInStores[$bannerAttribute.'_in_store'] = '';
        }

        $dataObj = $this->_objectFactory->create(
            ['data' => $bannerAttributesInStores]
        );
        $model = $this->_coreRegistry->registry('banner');

        $dataObj->addData($model->getData());

        $storeViewId = $this->getRequest()->getParam('store');
		
        $form = $this->_formFactory->create();
		
        $form->setHtmlIdPrefix($this->_banner->getFormFieldHtmlIdPrefix());
		
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Banner Information')]);

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }

        $elements = [];
        $elements['title'] = $fieldset->addField(
            'title',
            'text',
            [
                'name' => 'title',
                'label' => __('Title'),
                'title' => __('Title'),
                'required' => true,
            ]
        );
	
	$elements['image'] =  $fieldset->addField(
            'image',
            'image',
            ['name' => 'image',
	     'label' => __('Image'),
	     'title' => __('Image'),
	     'required' => false,
	    ]
        );
	
	$elements['link'] = $fieldset->addField(
            'link',
            'text',
            [
                'name' => 'link',
                'label' => __('Link'),
                'title' => __('Link'),
                'required' => false,
            ]
        );
		
	/*$elements['comment'] = $fieldset->addField(
            'comment',
            'textarea',
            [
                'name' => 'comment',
                'label' => __('Comment'),
                'title' => __('Comment'),
                'required' => true,
            ]
        );*/
		
        $elements['status'] = $fieldset->addField(
            'status',
            'select',
            [
                'label' => __('Status'),
                'title' => __('Status'),
                'name' => 'status',
                'options' => Status::getAvailableStatuses(),
            ]
        );

        $form->addValues($dataObj->getData());
        $this->setForm($form);
	$p = $form->getElement('image')->getValue();
	$p = $form->getElement('image')->setValue('banner/'.$p);


        return parent::_prepareForm();
    }

    public function getBanner()
    {
        return $this->_coreRegistry->registry('banner');
    }

    public function getPageTitle()
    {
        return $this->getBanner()->getId()? __("EDIT Banner '%1'", $this->escapeHtml($this->getBanner()->getTitle())) : __('NEW Banner');
    }

    public function getTabLabel()
    {
        return __('Banner Information');
    }

    public function getTabTitle()
    {
        return __('Banner Information');
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }
}

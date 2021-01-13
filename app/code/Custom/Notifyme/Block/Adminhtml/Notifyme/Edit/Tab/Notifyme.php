<?php
namespace Custom\Notifyme\Block\Adminhtml\Notifyme\Edit\Tab;

use Custom\Notifyme\Model\Status;

/**
 * Notifyme Edit tab.
 */

class Notifyme extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    protected $_objectFactory;

    protected $_notifyme;
    
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Framework\DataObjectFactory $objectFactory,
        \Custom\Notifyme\Model\Notifyme $notifyme,
        array $data = []
    ) {
        $this->_objectFactory = $objectFactory;
        $this->_notifyme = $notifyme;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    protected function _prepareLayout()
    {
        $this->getLayout()->getBlock('page.title')->setPageTitle($this->getPageTitle());

        \Magento\Framework\Data\Form::setFieldsetElementRenderer(
            $this->getLayout()->createBlock(
                'Custom\Notifyme\Block\Adminhtml\Form\Renderer\Fieldset\Element',
                $this->getNameInLayout().'_fieldset_element'
            )
        );

        return $this;
    }

    protected function _prepareForm()
    {
	$notifymeAttributes = $this->_notifyme->getStoreAttributes();
        $notifymeAttributesInStores = ['store_id' => ''];

        foreach ($notifymeAttributes as $notifymeAttribute) {
            $notifymeAttributesInStores[$notifymeAttribute.'_in_store'] = '';
        }

        $dataObj = $this->_objectFactory->create(
            ['data' => $notifymeAttributesInStores]
        );
        $model = $this->_coreRegistry->registry('notifyme');

        $dataObj->addData($model->getData());

        $storeViewId = $this->getRequest()->getParam('store');
		
        $form = $this->_formFactory->create();
		
        $form->setHtmlIdPrefix($this->_notifyme->getFormFieldHtmlIdPrefix());
		
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Notifyme Information')]);

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }

        $elements = [];
    /*    $elements['question'] = $fieldset->addField(
            'question',
            'text',
            [
                'name' => 'question',
                'label' => __('Question'),
                'title' => __('Question'),
                'required' => true,
            ]
        );
		
	$elements['answer'] = $fieldset->addField(
            'answer',
            'textarea',
            [
                'name' => 'answer',
                'label' => __('Answer'),
                'title' => __('Answer'),
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
		
          $elements['stores'] = $fieldset->addField(
            'stores',
            'multiselect',
            [
                'label' => __('Stores'),
                'title' => __('Stores'),
                'name' => 'stores[]',
                'values' => Status::getAvailableStore(),
				'required' => true,
            ]
        );
        
        
        
        
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
*/
        $form->addValues($dataObj->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    public function getNotifyme()
    {
        return $this->_coreRegistry->registry('notifyme');
    }

    public function getPageTitle()
    {
        return $this->getNotifyme()->getId()? __("EDIT Notifyme '%1'", $this->escapeHtml($this->getNotifyme()->getName())) : __('NEW Notifyme');
    }

    public function getTabLabel()
    {
        return __('Notifyme Information');
    }

    public function getTabTitle()
    {
        return __('Notifyme Information');
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

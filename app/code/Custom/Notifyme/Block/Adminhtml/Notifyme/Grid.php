<?php

namespace Custom\Notifyme\Block\Adminhtml\Notifyme;

use Custom\Notifyme\Model\Status;

/**
 * Notifyme grid.
 */

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    protected $_notifymeCollectionFactory;
	
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Custom\Notifyme\Model\ResourceModel\Notifyme\CollectionFactory $notifymeCollectionFactory,
        array $data = []
    ) {
         $this->_notifymeCollectionFactory = $notifymeCollectionFactory;

        parent::__construct($context, $backendHelper, $data);
    }

    protected function _construct()
    {
        parent::_construct();
        $this->setId('notifymeGrid');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $storeViewId = $this->getRequest()->getParam('store');

        $collection = $this->_notifymeCollectionFactory->create()->setStoreViewId($storeViewId);
	
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
		$this->addColumn(
            'id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
		'width' => '20px',
            ]
        );
        $this->addColumn(
            'product_name',
            [
                'header' => __('Product Name'),
                'index' => 'product_name',
                'class' => 'xxx',
                //'width' => '50px',
            ]
        );
	
	$this->addColumn(
            'product_sku',
            [
                'header' => __('Product SKU'),
                'index' => 'product_sku',
                'class' => 'xxx',
            ]
        );
	
	$this->addColumn(
            'options',
            [
                'header' => __('Options'),
                'index' => 'options',
                'class' => 'xxx',
            ]
        );
	
	$this->addColumn(
            'child_product_name',
            [
                'header' => __('Child Product Name'),
                'index' => 'child_product_name',
                'class' => 'xxx',
            ]
        );
	
	$this->addColumn(
            'child_product_sku',
            [
                'header' => __('Child Product SKU'),
                'index' => 'child_product_sku',
                'class' => 'xxx',
            ]
        );
	
	$this->addColumn(
            'price',
            [
                'header' => __('Price'),
                'index' => 'price',
                'class' => 'xxx',
            ]
        );
	
	$this->addColumn(
            'email',
            [
                'header' => __('Email'),
                'index' => 'email',
                'class' => 'xxx',
            ]
        );
    
    
    $this->addColumn(
            'stores',
            [
                'header' => __('Stores'),
                'index' => 'stores',
                'class' => 'xxx',
                'width' => '50px',
            ]
        );
    
    
	
	$this->addColumn(
            'is_sent',
            [
                'header' => __('Is Sent'),
                'index' => 'is_sent',
                'type' => 'options',
                'options' => Status::getYesNoOptions(),
            ]
        ); 
	
	$this->addColumn(
            'date',
            [
                'header' => __('Created On'),
                'index' => 'date',
                'class' => 'xxx',
		
            ]
        );
    
        /*$this->addColumn(
            'status',
            [
                'header' => __('Status'),
                'index' => 'status',
                'type' => 'options',
                'options' => Status::getAvailableStatuses(),
            ]
        );*/

        //$this->addColumn(
        //    'edit',
        //    [
        //        'header' => __('Edit'),
        //        'type' => 'action',
        //        'getter' => 'getId',
        //        'actions' => [
        //            [
        //                'caption' => __('Edit'),
        //                'url' => ['base' => '*/*/edit'],
        //                'field' => 'id',
        //            ],
        //        ],
        //        'filter' => false,
        //        'sortable' => false,
        //        'index' => 'stores',
        //        'header_css_class' => 'col-action',
        //        'column_css_class' => 'col-action',
        //    ]
        //);
        $this->addExportType('*/*/exportCsv', __('CSV'));
        $this->addExportType('*/*/exportXml', __('XML'));
        $this->addExportType('*/*/exportExcel', __('Excel'));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('notifyme');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('notifyme/*/massDelete'),
                'confirm' => __('Are you sure?'),
            ]
        );

        $statuses = Status::getAvailableStatuses();

        array_unshift($statuses, ['label' => '', 'value' => '']);
        $this->getMassactionBlock()->addItem(
            'status',
            [
                'label' => __('Change status'),
                'url' => $this->getUrl('notifyme/*/massStatus', ['_current' => true]),
                'additional' => [
                    'visibility' => [
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => __('Status'),
                        'values' => $statuses,
                    ],
                ],
            ]
        );

        return $this;
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', ['_current' => true]);
    }

    public function getRowUrl($row)
    {
       
	return '#';
    }
}

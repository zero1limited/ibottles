<?php

namespace Custom\Banner\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Install schema
 */

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();
		
	$installer->getConnection()->dropTable($installer->getTable('custom_banner'));
		
        $table = $installer->getConnection()->newTable(
        $installer->getTable('custom_banner')
        )->addColumn(
            'id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            10,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'ID'
        )->addColumn(
            'title',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => false, 'default' => ''],
            'Title'
        )->addColumn(
            'image',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => true],
            'Image'
        )
	->addColumn(
	    'link',
	    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
	    null,
	    ['default' => null],
	    'Link'
        )
	 ->addColumn(
	    'comment',
	    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
	    null,
	    ['default' => null],
	    'Comment'
        )
	 ->addColumn(
            'status',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, 'default' => '1'],
            'Status'
        )->addColumn(
            'date',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
            null,
            ['nullable' => true],
            'Date'
        );
	  $installer->getConnection()->createTable($table);	
	$installer->endSetup();
    }
}

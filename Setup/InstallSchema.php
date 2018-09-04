<?php

namespace Dford\Geoip\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $table = $setup->getConnection()
                       ->newTable($setup->getTable('dford_geoip_data'))
                       ->addColumn(
                           'entity_id',
                           \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                           null,
                           ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                           'Entity ID'
                       )
                       ->addColumn(
                           'customer_id',
                           \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                           null,
                           ['unsigned' => true, 'nullable' => false],
                           'Customer ID'
                       )
                       ->addColumn(
                           'ip_address',
                           \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                           255,
                           [],
                           'IP Address'
                       )
                       ->addColumn(
                           'user_agent',
                           \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                           400,
                           [],
                           'User Agent'
                       )
                       ->addColumn(
                           'created_at',
                           \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                           null,
                           ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                           'Created At'
                       )
                       ->setComment(
                           'DFord Geoip Trellis Test Table'
                        );
        $setup->getConnection()->createTable($table);
        $setup->endSetup();
    }
}
                            

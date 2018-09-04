<?php

namespace Dford\Geoip\Model\ResourceModel\Geoip;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'Dford\Geoip\Model\Geoip',
            'Dford\Geoip\Model\ResourceModel\Geoip'
        );
    }
}

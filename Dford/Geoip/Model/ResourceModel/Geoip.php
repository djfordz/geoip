<?php

namespace Dford\Geoip\Model\ResourceModel;

class Geoip extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('dford_geoip_data', 'entity_id');
    }
}

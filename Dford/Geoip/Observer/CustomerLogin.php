<?php

namespace Dford\Geoip\Observer;

use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Magento\Framework\HTTP\PhpEnvironment\Request;
use Dford\Geoip\Model\GeoipFactory;

class CustomerLogin implements \Magento\Framework\Event\ObserverInterface
{

    protected $_remoteAddress;
    protected $_request;
    protected $_geoipFactory;

    public function __construct(
        RemoteAddress $remoteAddress,
        Request $request,
        GeoipFactory $geoipFactory
    )
    {
        $this->_remoteAddress = $remoteAddress;
        $this->_request = $request;
        $this->_geoipFactory = $geoipFactory;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $data['customer_id'] = $observer->getEvent()->getCustomer()->getId();
        $data['ip_address'] = $this->_remoteAddress->getRemoteAddress();
        $data['user_agent'] = $this->_request->getServer('HTTP_USER_AGENT');

        $geoip = $this->_geoipFactory->create();
        $geoip->setData($data);
        $geoip->save();

        return true;
    }
}

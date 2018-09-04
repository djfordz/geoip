<?php

namespace Dford\Geoip\ViewModel;

use Dford\Geoip\Model\GeoipFactory;
use Magento\Framework\App\Http\Context;

class LoginHistory implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    const GEOIP_ALL = 'all';
    const GEOIP_LAST = 'last';

    protected $_geoipFactory;
    protected $_httpContext;

    public function __construct(GeoipFactory $geoipFactory, Context $httpContext)
    {
        $this->_geoipFactory = $geoipFactory;
        $this->_httpContext = $httpContext;
    }

    public function getGeoData($flag = 'all')
    {

        $customerId = $this->_getCustomerId();

        if (empty($customerId)) {
            return;
        }

        $geoip = $this->_geoipFactory
                    ->create()
                    ->getCollection();

        $collection = $geoip
            ->addFieldToSelect('*')
            ->addFieldToFilter('customer_id', ['eq' => $customerId])
            ->setOrder('created_at')
            ->setPageSize(25)
            ->setCurPage(1);


        if ($collection->getSize() > 1) {
            $resultArray = $collection->toArray();
            if ($flag == self::GEOIP_LAST ) {
                $result =  $resultArray['items'][1];
            } else if ($flag == self::GEOIP_ALL) {
                $result = $resultArray['items']; 
            }
        } else {
            $result = 'This is your first login.';
        }
        
        return $result;
    }

    protected function _isLoggedIn()
    {
        return $this->_customerSession->isLoggedIn();
    }

    protected function _getCustomerId()
    {
        return $this->_httpContext->getValue(\Dford\Geoip\Model\Customer\Context::CONTEXT_CUSTOMER_ID);
    }
}

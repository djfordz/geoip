<?php

namespace Dford\Geoip\Model\Customer;

/**
 * Attribution
 * https://ranasohel.me/2017/05/05/how-to-get-customer-id-from-block-when-full-page-cache-enable-in-magento-2/
 */
class Context
{
    /**
     * Customer authorization cache context
     */
    const CONTEXT_CUSTOMER_ID = 'logged_in_customer_id';
}

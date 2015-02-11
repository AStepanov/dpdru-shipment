<?php

namespace stp\dpd\message;

use stp\dpd\type\Order;
use stp\dpd\response\CreateOrderResponse;

/**
 * @property string $header_datePickup
 * @property string $header_senderAddress
 * @property string $header_pickupTimePeriod
 * @property string $header_regularNum
 * @property Order[] $order
 *
 */
class CreateOrder extends BaseMessage
{

    public function isMulti()
    {
        return is_array($this->order) && count($this->order) > 1;
    }

    /**
     * @return string
     */
    public function getWrapperName()
    {
        return 'orders';
    }

    /**
     * @return string
     */
    public function responseType()
    {
        return CreateOrderResponse::className();
    }

}

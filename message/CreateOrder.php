<?php

namespace stp\dpd\message;

use stp\dpd\type\Parcel;
use stp\dpd\response\CreateOrderResponse;

/**
 * @property string $header_datePickup
 * @property string $header_senderAddress
 * @property string $header_pickupTimePeriod
 * @property string $header_regularNum
 * @property string $order_orderNumberInternal
 * @property string $order_serviceCode
 * @property string $order_serviceVariant
 * @property string $order_cargoNumPack
 * @property string $order_cargoWeight
 * @property bool $order_cargoRegistered
 * @property string $order_cargoVolume
 * @property string $order_cargoValue
 * @property string $order_cargoCategory
 * @property string $order_deliveryTimePeriod
 * @property string $order_extraParam
 * @property string $order_dataInt
 * @property string $order_extraService
 * @property string $order_receiverAddress
 * @property Parcel[] $order_parcel
 * @property string $order_unitLoad
 *
 */
class CreateOrder extends BaseMessage
{
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

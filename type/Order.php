<?php

namespace stp\dpd\type;

use stp\dpd\BaseType;

/**
 * Описание заказа заказа
 *
 * @property string $orderNumberInternal
 * @property string $serviceCode
 * @property string $serviceVariant
 * @property string $cargoNumPack
 * @property string $cargoWeight
 * @property bool $cargoRegistered
 * @property float|null $cargoVolume
 * @property int|null $cargoValue
 * @property string $cargoCategory
 * @property string|null $deliveryTimePeriod
 * @property string|null $extraParam
 * @property string|null $dataInt
 * @property string|null $extraService
 * @property string $receiverAddress
 * @property Parcel[]|null $parcel
 * @property array[]|null $unitLoad
 */
class Order extends BaseType
{


}

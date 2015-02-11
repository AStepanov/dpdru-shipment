<?php

namespace stp\dpd\message;

use stp\dpd\response\GetStatesByClientResponse;


/**
 *
 * @property string $clientOrderNr Номер заказа в информационной системе клиента
 * @property string|null $pickupDate Дата приёма груза (на случай, если номер заказа не уникален, и требуется уточнение по дате)
 */
class GetStatesByClientOrder extends BaseMessage
{
    /**
     * @return string
     */
    public function getWrapperName()
    {
        return 'request';
    }

    /**
     * @return string
     */
    public function responseType()
    {
        return GetStatesByClientResponse::className();
    }

}

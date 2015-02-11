<?php

namespace stp\dpd\message;

use stp\dpd\response\RegisterFileResponse;


/**
 * Получить реестр заказов, передаваемых курьеру DPD (формат файла - xls)
 *
 * @property string $datePickup Дата приёма груза (2014-09-15)
 */
class GetRegisterFile extends BaseMessage
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
        return RegisterFileResponse::className();
    }

}

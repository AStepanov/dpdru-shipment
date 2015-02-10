<?php

namespace stp\dpd\response;

class CreateOrderResponse extends BaseResponse
{
    public $status;
    public $orderNum;
    public $orderNumberInternal;
    public $errorMessage;

    const STATUS_OK = 'OK';
    const STATUS_DUPLICATE = 'OrderDuplicate';
    const STATUS_PENDING = 'OrderPending';
    const STATUS_UNKNOWN = 'UNKNOWN';

    static $statuses = [self::STATUS_OK, self::STATUS_DUPLICATE, self::STATUS_PENDING];


    public function __construct($response)
    {
        parent::__construct($response);
        $this->status = in_array($response->status, self::$statuses) ? $response->status : self::STATUS_UNKNOWN;
    }

}
<?php

namespace stp\dpd\response;

class BaseResponse
{

    public $responseBody;

    public function __construct($response)
    {
        $this->responseBody = $response;
        foreach ((array)$response->return as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Returns the fully qualified name of this class.
     * @return string the fully qualified name of this class.
     */
    public static function className()
    {
        return get_called_class();
    }

}

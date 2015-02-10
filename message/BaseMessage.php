<?php

namespace stp\dpd\message;

use stp\dpd\BaseType;

/**
 * @property string $auth_clientNumber
 * @property string $auth_clientKey
 */
abstract class BaseMessage extends BaseType
{

    /**
     * @return string
     */
    abstract public function getWrapperName();

    /**
     * @return string
     */
    abstract public function responseType();

}

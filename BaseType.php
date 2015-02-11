<?php

namespace stp\dpd;

abstract class BaseType
{
    protected $_dataRaw = [];

    function __get($name)
    {
        return isset($this->_dataRaw[$name]) ? $this->_dataRaw[$name] : null;
    }

    function __set($name, $value)
    {
        $this->_dataRaw[$name] = $value;
    }

    public function asArray()
    {
        $result = [];
        foreach($this->_dataRaw as $string => $value) {
            $parts = array_filter(explode('_', $string));
            $ref = &$result;
            foreach($parts as $key => $p) {
                isset($ref[$p]) || $ref[$p] = [];
                $ref = &$ref[$p];
            }
            if ($value instanceof BaseType) {
                $ref = $value->asArray();
            } elseif (is_array($value) && !empty($value[0]) && $value[0] instanceof BaseType) {
                $ref = [];
                foreach($value as $subtype) {
                    $ref[] = $subtype->asArray();
                }
            } else {
                $ref = $value;
            }

        }

        return $result;
    }
}

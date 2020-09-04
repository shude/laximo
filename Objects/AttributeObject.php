<?php

namespace shude\Laximo\Objects;

use shude\Laximo\BaseObject;

class AttributeObject extends BaseObject
{
    public $key;

    public $name;

    public $value;

    protected function fromXml($data)
    {
        $this->key = (string)$data['key'];
        $this->name = (string)$data['name'];
        $this->value = (string)$data['value'];
    }
}
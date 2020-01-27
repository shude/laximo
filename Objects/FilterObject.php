<?php

namespace shude\Laximo\Objects;

use shude\Laximo\BaseObject;

class FilterObject extends BaseObject
{
    public $fields;
    protected function fromXml($data)
    {
        foreach ($data->row as $filterField) {
            $this->fields[] = new FilterFieldObject($filterField);
        }
    }
}
<?php

namespace shude\Laximo\Objects;

use shude\Laximo\BaseObject;
use SimpleXMLElement;

class UnitListObject extends BaseObject
{

    /**
     * @var UnitObject[]
     */
    public $units;

    protected function fromXml($data)
    {
        foreach ($data->row as $unit) {
            $current = new UnitObject($unit);
            $this->units[] = $current;
        }
    }
}
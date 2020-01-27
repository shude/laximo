<?php

namespace shude\Laximo\Objects;

use shude\Laximo\BaseObject;
use SimpleXMLElement;

class FilterFieldObject extends BaseObject
{

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $type;

    /**
     * @var FilterFieldValueObject[]
     */
    public $values;



    protected function fromXml($data)
    {
        $this->name = (string)$data['name'];
        $this->type = (string)$data['type'];

        if ($data->values instanceof SimpleXMLElement) {
            foreach ($data->values->row as $value) {
                $this->values[] = new FilterFieldValueObject($value);
            }
        }
    }
}
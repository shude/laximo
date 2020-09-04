<?php

namespace shude\Laximo\Objects;

use shude\Laximo\BaseObject;
use SimpleXMLElement;

class FeatureObject extends BaseObject
{

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $example;

    protected function fromXml($data)
    {
        $this->example = isset($data['example']) ? (string)$data['example'] : null;
        $this->name = (string)$data['name'];
    }
}
<?php

namespace shude\Laximo\Objects;

use shude\Laximo\BaseObject;
use SimpleXMLElement;

class DetailObject extends BaseObject
{

    /**
     * @var string
     */
    public $oem;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $codeonimage;

    /**
     * @var string
     */
    public $ssd;

    /**
     * var bool
     */
    public $match;

    /**
     * var bool
     */
    public $filter;

    /**
     * @var AttributeObject[]
     */
    public $attributes;


    /**
     * @param SimpleXMLElement $data
     */
    protected function fromXml($data)
    {
        $this->oem = (string)$data['oem'];
        $this->name = (string)$data['name'];
        $this->codeonimage = (string)$data['codeonimage'];
        $this->match = (string)$data['match'] == 't' ? 1 : 0;
        $this->filter = (string)$data['filter'];
        $this->ssd = (string)$data['ssd'];

        if ($data->attribute instanceof SimpleXMLElement) {
            foreach ($data->attribute as $attribute) {
                $this->attributes[] = new AttributeObject($attribute);
            }
        }
    }
}
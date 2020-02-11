<?php

namespace shude\Laximo\Objects;

use shude\Laximo\BaseObject;
use SimpleXMLElement;

class UnitObject extends BaseObject
{

    /**
     * @var string
     */
    public $code;

    /**
     * @var string
     */
    public $unitid;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $imageurl;

    /**
     * @var string
     */
    public $largeimageurl;

    /**
     * @var string
     */
    public $ssd;

    /**
     * @var string
     */
    public $filter;

    /**
     * @var DetailObject[]
     */
    public $details;

    /**
     * @var AttributeObject[];
     */
    public $attributes;

    protected function fromXml($data)
    {
        if(isset($data->row)) $data = $data->row;

        $this->code          = (string)$data['code'];
        $this->unitid        = (string)$data['unitid'];
        $this->name          = (string)$data['name'];
        $this->imageurl      = str_replace('http://' , 'https://', (string)$data['imageurl']);
        $this->largeimageurl = str_replace('http://' , 'https://', (string)$data['largeimageurl']);
        $this->ssd           = (string)$data['ssd'];
        $this->filter        = (string)$data['filter'];

        if ($data->attribute instanceof SimpleXMLElement) {
            foreach ($data->attribute as $attribute) {
                $this->attributes[] = new AttributeObject($attribute);
            }
        }

        if ($data->Detail instanceof SimpleXMLElement) {
            foreach ($data->Detail as $detail) {
                $this->details[] = new DetailObject($detail);
            }
        }

        $this->getDetailsByCode();
    }

    private function getDetailsByCode()
    {
        $groups = [];

        if ($this->details) {
            foreach ($this->details as $detail) {
                if ($detail->codeonimage && $detail->codeonimage != '-') {
                    $groups['i' . $detail->codeonimage][] = $detail;
                } else {
                    $groups['-'][] = $detail;
                }
            }
        }

        $this->detailsByCode = $groups;
    }
}
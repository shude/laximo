<?php

namespace shude\Laximo\Objects;

use shude\Laximo\BaseObject;
use SimpleXMLElement;

class CategoryObject extends BaseObject
{

    /**
     * @var int
     */
    public $categoryid;

    /**
     * @var CategoryObject[]|null
     */
    public $childrens;

    /**
     * @var string
     */
    public $code;

    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $parentcategoryid;

    /**
     * @var string
     */
    public $ssd;

    /**
     * @var bool
     */
    public $selected;

    /**
     * @var UnitObject[]
     */
    public $units;

    /**
     * @param SimpleXMLElement $data
     */
    protected function fromXml($data)
    {
        if(isset($data->row)) $data = $data->row;

        $this->categoryid       = (string)$data['categoryid'];
        $this->code             = (string)$data['code'];
        $this->name             = (string)$data['name'];
        $this->parentcategoryid = (string)$data['parentcategoryid'];
        $this->ssd              = (string)$data['ssd'];
        $this->selected         = false;
        if ($data->Unit instanceof SimpleXMLElement) {
            foreach ($data->Unit as $unit) {
                $this->units[] = new UnitObject($unit);
            }
        }
    }
}
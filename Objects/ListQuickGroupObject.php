<?php


namespace shude\Laximo\Objects;


use shude\Laximo\BaseObject;
use SimpleXMLElement;

class ListQuickGroupObject extends BaseObject
{
    public $groups;

    protected function fromXml(SimpleXMLElement $data)
    {
        $this->groups = new GroupObject($data->row);
    }
}
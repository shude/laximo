<?php


namespace shude\Laximo\Objects;


use shude\Laximo\BaseObject;
use SimpleXMLElement;

class ListQuickDetailObject extends BaseObject
{
    public $list;

    protected function fromXml(SimpleXMLElement $data)
    {
        $this->list = new CategoryObject($data->Category);
    }
}
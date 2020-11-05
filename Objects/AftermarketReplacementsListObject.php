<?php

namespace shude\Laximo\Objects;

use \shude\Laximo\BaseObject;
use SimpleXMLElement;

class AftermarketReplacementsListObject extends BaseObject
{
    /**
     * @var AftermarketReplacementsObject[] $replacements
     */
    public $replacements;

    protected function fromXml(SimpleXMLElement $data)
    {
        foreach ($data->row as $row) {
            $this->replacements[] = new AftermarketReplacementsObject($row);
        }
    }
}
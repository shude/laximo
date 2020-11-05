<?php

namespace shude\Laximo\Objects;

use shude\Laximo\BaseObject;
use SimpleXMLElement;

class ImageMapObject extends BaseObject
{
    public $mapObjects;

    protected function fromXml($data)
    {
        foreach ($data->row as $mapObject) {
            $this->mapObjects[] = new MapObject($mapObject);
        }
    }
}
<?php

namespace shude\Laximo\Objects;

use shude\Laximo\BaseObject;
use SimpleXMLElement;

class CatalogListObject extends BaseObject
{
    /** @var CatalogObject[] */
    public $catalogs;

    protected function fromXml(SimpleXMLElement $data)
    {
        foreach ($data as $catalog) {
            $catObj = new CatalogObject($catalog);
            $this->catalogs[] = $catObj;
        }
    }
}
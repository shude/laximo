<?php

namespace shude\Laximo\Objects;

use shude\Laximo\BaseObject;
use SimpleXMLElement;

class CatalogOperationObject extends BaseObject
{

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $kind;

    /**
     * @var string
     */
    public $name;

    /**
     * @var CatalogOperationFieldObject[]
     */
    public $fields;

    protected function fromXml(SimpleXMLElement $data)
    {
        $this->description = (string)$data['description'];
        $this->kind = (string)$data['kind'];
        $this->name = (string)$data['name'];
        foreach ($data->field as $field) {
            $this->fields[] = new CatalogOperationFieldObject($field);
        }
    }
}
<?php
/**
 * Created by Laximo
 * User: altunint
 * Date: 4/9/18
 * Time: 12:16 PM
 * TasK:
 */

namespace shude\Laximo\Objects;

use shude\Laximo\BaseObject;
use SimpleXMLElement;

class CatalogOperationFieldObject extends BaseObject
{

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $pattern;

    protected function fromXml(SimpleXMLElement $data)
    {
        $this->description = (string)$data['description'];
        $this->name        = (string)$data['name'];
        $this->pattern     = (string)$data['pattern'];
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: applebred
 * Date: 16.01.19
 * Time: 15:54
 */
namespace shude\Laximo\Objects;

use shude\Laximo\BaseObject;
use SimpleXMLElement;

class DetailReferenceObject extends BaseObject
{
    /**
     * @var string $brand
     */
    public $brand;

    /**
     * @var string $code
     */
    public $code;

    /**
     * @param SimpleXMLElement $data
     */
    protected function fromXml($data)
    {
        $this->brand = (string)$data->attributes()->brand;
        $this->code  = (string)$data->attributes()->code;
    }
}
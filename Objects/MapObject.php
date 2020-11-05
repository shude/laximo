<?php
namespace shude\Laximo\Objects;

use shude\Laximo\BaseObject;
use SimpleXMLElement;

class MapObject extends BaseObject
{

    /**
     * @var string
     */
    public $code;

    /**
     * @var string
     */
    public $type;

    /**
     * @var int
     */
    public $x1;

    /**
     * @var int
     */
    public $x2;

    /**
     * @var int
     */
    public $y1;

    /**
     * @var int
     */
    public $y2;


    protected function fromXml($data)
    {
        $this->code = (string)$data['code'];
        $this->type = (string)$data['type'];
        $this->x1 = (int)$data['x1'];
        $this->x2 = (int)$data['x2'];
        $this->y1 = (int)$data['y1'];
        $this->y2 = (int)$data['y2'];

    }
}
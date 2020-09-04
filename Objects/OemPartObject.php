<?php
/**
 * Created by Laximo.
 * User: elnikov.a
 * Date: 08.05.18
 * Time: 15:15
 */

namespace shude\Laximo\Objects;

use shude\Laximo\BaseObject;

class OemPartObject extends BaseObject
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $oem;

    protected function fromXml($data) {
        $this->name = (string) $data->name;
        $this->oem  = (string) $data->attributes()->oem;
    }
}
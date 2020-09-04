<?php
/**
 * Created by Laximo.
 * User: elnikov.a
 * Date: 08.05.18
 * Time: 15:04
 */

namespace shude\Laximo\Objects;

use shude\Laximo\BaseObject;

class PartsListObject extends BaseObject
{
    public $oemParts = [];

    protected function fromXml($data) {
        foreach ($data->OEMPart as $part) {
            $partObj = new OemPartObject($part);
            $this->oemParts[] = $partObj;
        }
    }

}
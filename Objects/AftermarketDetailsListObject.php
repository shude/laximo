<?php
/**
 * Created by PhpStorm.
 * User: applebred
 * Date: 10.01.19
 * Time: 15:30
 */

namespace shude\Laximo\Objects;

use shude\Laximo\BaseObject;
use SimpleXMLElement;

class AftermarketDetailsListObject extends BaseObject
{
    /**
     * @var AftermarketDetailObject[] $oems
     */
    public $oems;

    protected function fromXml(SimpleXMLElement $data)
    {
        foreach ($data as $detail) {
            $detail = new AftermarketDetailObject($detail);
            $this->oems[] = $detail;
        }
    }
}
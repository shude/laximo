<?php
/**
 * Created by Laximo
 * User: altunint
 * Date: 4/13/18
 * Time: 3:08 PM
 * TasK:
 */

namespace shude\Laximo\Objects;

use shude\Laximo\BaseObject;
use SimpleXMLElement;

class QuickDetailListObject extends BaseObject
{
    public $categories;

    protected function fromXml($data)
    {
        foreach ($data->Category as $category) {
            $this->categories[] = new CategoryObject($category);
        }
    }
}
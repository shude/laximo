<?php

namespace shude\Laximo\Objects;

use shude\Laximo\BaseObject;
use SimpleXMLElement;

class GroupObject extends BaseObject
{

    /**
     * @var string
     */
    public $link;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $quick_group_id;

    /**
     * @var GroupObject[]
     */
    public $childGroups;

    /**
     * @param SimpleXMLElement $data
     */
    protected function fromXml($data)
    {
        $this->link           = (string)$data['link'];
        $this->name           = (string)$data['name'];
        $this->quick_group_id = (string)$data['quickgroupid'];
        $children             = $data->children();

        foreach ($children->row as $child) {
            $this->childGroups[] = new GroupObject($child);
        }
    }
}
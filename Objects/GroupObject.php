<?php
namespace shude\Laximo\Objects;

use shude\Laximo\BaseObject;
use SimpleXMLElement;

class GroupObject extends BaseObject
{

    /**
     * @var string
     */
    public $contains;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $synonyms;

    /**
     * @var string
     */
    public $quickgroupid;

    /**
     * @var GroupObject[]
     */
    public $childGroups;

    /**
     * @param SimpleXMLElement $data
     */
    protected function fromXml($data)
    {
        $this->contains     = (string)$data['contains'];
        $this->name         = (string)$data['name'];
        $this->quickgroupid = (string)$data['quickgroupid'];
        $this->synonyms     = (string)$data['synonyms'];
        $children           = $data->children();

        foreach ($children->row as $child) {
            $this->childGroups[] = new GroupObject($child);
        }
    }
}
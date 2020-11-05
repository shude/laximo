<?php

namespace shude\Laximo\Objects;

use shude\Laximo\BaseObject;
use SimpleXMLElement;

class VehicleListObject extends BaseObject
{

    protected static $mainAttributes = [
        'brand',
        'name',
        'grade',
        'transmission',
        'doors',
        'creationregion',
        'destinationregion',
        'date',
        'manufactured',
        'framecolor',
        'trimcolor',
        'datefrom',
        'dateto',
        'frame',
        'frames',
        'framefrom',
        'frameto',
        'engine',
        'engine1',
        'engine',
        'engineno',
        'options',
        'modelyearfrom',
        'modelyearto',
        'modification',
        'description',
    ];

    /**
     * @var VehicleObject[]
     */
    public $vehicles;

    /**
     * @var array
     */
    public $tableHeaders;

    /**
     * @var array
     */
    public $tableColumns;

    /**
     * @var array
     */
    public $commonColumns;

    /**
     * @var array
     */
    public $groupedByName;


    /**
     * @param \SimpleXMLElement $data
     */
    protected function fromXml($data)
    {
        foreach ($data->row as $vehicle) {
            $this->vehicles[] = new VehicleObject($vehicle);
        }
    }
}
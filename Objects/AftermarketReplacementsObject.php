<?php


namespace shude\Laximo\Objects;


use shude\Laximo\BaseObject;
use SimpleXMLElement;

class AftermarketReplacementsObject extends BaseObject
{
    /**
     * @var string
     */
    public $detail_id;

    /**
     * @var string
     */
    public $formatted_oem;

    /**
     * @var string
     */
    public $manufacturer;

    /**
     * @var string
     */
    public $manufacturer_id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $oem;

    /**
     * @var string
     */

    public $replacement_type1;
    /**
     * @var string
     */
    public $replacement_type2;

    /**
     * @var string
     */
    public $weight;

    /**
     * @var string
     */
    public $rate;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $type1;

    /**
     * @var string
     */
    public $type2;

    /**
     * @var string
     */
    public $search_url;

    protected function fromXml(SimpleXMLElement $data)
    {
        $this->detail_id         = (string)$data->attributes()->detailid;
        $this->formatted_oem     = (string)$data->attributes()->formattedoem;
        $this->manufacturer      = (string)$data->attributes()->manufacturer;
        $this->manufacturer_id   = (string)$data->attributes()->manufacturerid;
        $this->rate              = (string)$data->attributes()->rate;
        $this->oem               = (string)$data->attributes()->oem;
        $this->replacement_type1 = (string)$data->attributes()->replacementtype1;
        $this->replacement_type2 = (string)$data->attributes()->replacementtype2;
        $this->type              = (string)$data->attributes()->type;
        $this->type1             = (string)$data->attributes()->type1;
        $this->type2             = (string)$data->attributes()->type2;
        $this->name              = (string)$data->attributes()->name;
        $this->weight            = (string)$data->attributes()->weight;
        $this->search_url        = (string)$data->attributes()->searchurl;
    }
}
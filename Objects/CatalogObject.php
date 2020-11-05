<?php
/**
 * Created by Laximo
 * User: altunint
 * Date: 4/4/18
 * Time: 4:31 PM
 * TasK:
 */

namespace shude\Laximo\Objects;

use shude\Laximo\BaseObject;
use SimpleXMLElement;

class CatalogObject extends BaseObject
{

    /**
     * @var string
     */
    public $brand;

    /**
     * @var string
     */
    public $code;

    /**
     * @var string
     */
    public $vinexample;

    /**
     * @var string
     */
    public $frameexample;

    /**
     * @var string
     */
    public $icon;

    /**
     * @var string
     */
    public $name;

    /**
     * @var bool
     */
    public $supportquickgroups;

    /**
     * @var bool
     */
    public $supportvinsearch;

    /**
     * @var bool
     */
    public $supportframesearch;

    /**
     * @var bool
     */
    public $supportparameteridentification;

    /**
     * @var bool
     */
    public $supportparameteridentification2;

    /**
     * @var FeatureObject[]
     */
    public $features;

    /**
     * @var CatalogOperationObject[]
     */
    public $operations;

    /**
     * @var bool
     */
    public $supportdetailapplicability;

    /**
     * @param SimpleXMLElement $data
     */
    protected function fromXml($data)
    {
        if(isset($data->row)) $data = $data->row;

        $this->brand                           = (string)$data['brand'];
        $this->name                            = (string)$data['name'];
        $this->code                            = (string)$data['code'];
        $this->vinexample                      = (string)$data['vinexample'];
        $this->frameexample                    = (string)$data['frameexample'];
        $this->icon                            = (string)$data['icon'];
        $this->supportquickgroups              = (string)$data['supportquickgroups'] === 'true' ? 1 : 0;
        $this->supportvinsearch                = (string)$data['supportvinsearch'] === 'true' ? 1 : 0;
        $this->supportframesearch              = (string)$data['supportframesearch'] === 'true' ? 1 : 0;
        $this->supportparameteridentification  = (string)$data['supportparameteridentification'] === 'true' ? 1 : 0;
        $this->supportparameteridentification2 = (string)$data['supportparameteridentification2'] === 'true' ? 1 : 0;
        $this->supportdetailapplicability      = (string)$data['supportdetailapplicability'] === 'true' ? 1 : 0;

        if (isset($data->features) && $data->features instanceof SimpleXMLElement) {
            foreach ($data->features->feature as $feature) {
                $this->features[] = new FeatureObject($feature);
            }
        }

        if (isset($data->extensions) && $data->extensions instanceof SimpleXMLElement && $data->extensions->operations instanceof SimpleXMLElement) {
            foreach ($data->extensions->operations->operation as $operation) {
                $this->operations[] = new CatalogOperationObject($operation);
            }
        }
            }
}
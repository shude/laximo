<?php

namespace shude\Laximo\Objects;

use shude\Laximo\BaseObject;
use SimpleXMLElement;

class WizardStepObject extends BaseObject
{

    /**
     * @var bool
     */
    public $allowListVehicles;

    /**
     * @var string
     */
    public $automatic;

    /**
     * @var string
     */
    public $conditionId;

    /**
     * @var bool
     */
    public $determined;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $value;

    /**
     * @var string
     */
    public $ssd;


    /**
     * @var WizardStepOptionObject[]
     */
    public $options;

    protected function fromXml($data)
    {
        $this->allowListVehicles = (string)$data['allowlistvehicles'] == 'true' ? 1 : 0;
        $this->automatic         = (string)$data['automatic'] == 'true' ? 1 : 0;
        $this->conditionId       = (string)$data['conditionid'];
        $this->determined        = (string)$data['determined'] == 'true' ? 1 : 0;
        $this->name              = (string)$data['name'];
        $this->type              = (string)$data['type'];
        $this->value             = (string)$data['value'];
        $this->ssd               = (string)$data['ssd'];
        if ($data->options instanceof SimpleXMLElement) {
            foreach ($data->options->row as $option) {
                $this->options[] = new WizardStepOptionObject($option);
            }
        }
    }
}
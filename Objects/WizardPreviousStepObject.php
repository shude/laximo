<?php


namespace shude\Laximo\Objects;


use shude\Laximo\BaseObject;
use SimpleXMLElement;

class WizardPreviousStepObject extends BaseObject
{

    /**
     * @var string
     */
    public $automatic;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $ssd;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $value;

    /**
     * @param SimpleXMLElement $data
     */
    protected function fromXml($data)
    {
        $this->automatic = (string)$data['automatic'] ?? '';
        $this->name      = (string)$data['name'] ?? '';
        $this->ssd       = (string)$data['ssd'] ?? '';
        $this->type      = (string)$data['type'] ?? '';
        $this->value     = (string)$data['value'] ?? '';
    }
}
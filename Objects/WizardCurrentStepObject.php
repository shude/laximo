<?php

namespace shude\Laximo\Objects;

use shude\Laximo\BaseObject;
use SimpleXMLElement;

class WizardCurrentStepObject extends BaseObject
{
    /**
     * @var string
     */
    public $allowlistvehicles;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $type;

    /**
     * @var WizardStepOptionObject[]
     */
    public $options;

    /**
     * @param SimpleXMLElement $data
     */
    protected function fromXml($data)
    {
        if(isset($data['allowlistvehicles']))
        {
            $this->allowlistvehicles = (string)$data['allowlistvehicles'];
        }else{
            $this->name = (string)$data['name'];
            $this->type = (string)$data['type'];

            if ($data->options instanceof SimpleXMLElement) {
                foreach ($data->options->row as $option) {
                    $this->options[] = new WizardStepOptionObject($option);
                }
            }
        }
    }
}
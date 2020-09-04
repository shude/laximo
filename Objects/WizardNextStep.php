<?php

namespace shude\Laximo\Objects;

use shude\Laximo\BaseObject;
use SimpleXMLElement;

class WizardNextStep extends BaseObject
{
    /**
     * @var \shude\Laximo\Objects\WizardCurrentStepObject
     */
    public $currentStep;

    /**
     * @var array
     */
    public $previousSteps;

    /**
     * @param SimpleXMLElement $data
     */
    protected function fromXml($data)
    {
        foreach ($data->previousStep->row as $previousStep){
            $this->previousSteps[] = new WizardPreviousStepObject($previousStep);
        }

        $this->currentStep = new WizardCurrentStepObject($data->currentStep);
    }
}
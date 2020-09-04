<?php

namespace shude\Laximo\Objects;

use shude\Laximo\BaseObject;

class WizardObject extends BaseObject
{

    public $steps;

    protected function fromXml($data)
    {
        foreach ($data->row as $step) {
            $this->steps[] = new WizardStepObject($step);
        }
    }
}
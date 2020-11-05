<?php

namespace shude\Laximo\Objects;

use shude\Laximo\BaseObject;

class WizardStepOptionObject extends BaseObject
{

    /**
     * @var string
     */
    public $key;

    /**
     * @var string
     */
    public $value;

    protected function fromXml($data)
    {
        $this->key = (string)$data['key'];
        $this->value = html_entity_decode($data['value']);
    }
}
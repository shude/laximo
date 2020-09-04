<?php


namespace shude\Laximo;

use SimpleXMLElement;

abstract class BaseObject
{
    public function __construct(SimpleXMLElement $data = null)
    {
        if(null !== $data) {
            $this->fromXml($data);
        }
    }

    abstract protected function fromXml(SimpleXMLElement $data);
}
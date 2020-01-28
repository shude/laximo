<?php
/**
 * Created by PhpStorm.
 * User: applebred
 * Date: 16.01.19
 * Time: 15:39
 */
namespace shude\Laximo\Objects;

use shude\Laximo\BaseObject;
use SimpleXMLElement;

class DetailReferencesListObject extends BaseObject
{
    /**
     * @var string $oem
     */
    public $oem;

    /**
     * @var string $name
     */
    public $name;

    /**
     * @var array $referencesList
     */
    public $referencesList;

    /**
     * @param SimpleXMLElement $data
     */
    protected function fromXml($data)
    {
        if (!empty($data)) {
            $this->oem            = (string)$data->OEMPartReference->attributes()->oem;
            $this->name           = (string)$data->OEMPartReference->name;
            $this->referencesList = [];

            if (!empty($data->OEMPartReference)) {
                foreach ($data->OEMPartReference as $OEMPartReferenceItem) {
                    foreach ($OEMPartReferenceItem->CatalogReferences as $catalogReference) {
                        foreach ($catalogReference->CatalogReference as $reference) {
                            $this->addNewReference($reference);
                        }
                    }
                }
            }
        }
    }

    private function addNewReference($catalogReference)
    {
        $detailReference        = new DetailReferenceObject($catalogReference);
        $this->referencesList[] = $detailReference;
    }
}
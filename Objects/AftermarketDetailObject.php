<?php
/**
 * Created by PhpStorm.
 * User: applebred
 * Date: 10.01.19
 * Time: 15:32
 */

namespace shude\Laximo\Objects;

use shude\Laximo\BaseObject;
use SimpleXMLElement;

class AftermarketDetailObject extends BaseObject
{

    /**
     * @var int $detail_id
     */
    public $detail_id;

    /**
     * @var string $formattedoem
     */
    public $formattedoem;

    /**
     * @var string $manufacturer
     */
    public $manufacturer;

    /**
     * @var int $manufacturer_id
     */
    public $manufacturer_id;

    /**
     * @var string $name
     */
    public $name;

    /**
     * @var string $oem
     */
    public $oem;

    /**
     * @var array $replacements
     */
    public $replacements;

    /**
     * @var array $images
     */
    public $images;

    /**
     * @var string $weight
     */
    public $weight;

    /**
     * @var boolean $is_replacement
     */
    public $is_replacement;

    /**
     * @var array $replacement_attributes
     */
    public $replacement_attributes;

    /**
     * @var array
     */
    public $properties;

    /**
     * @var string
     */
    public $code;


    protected function fromXml(SimpleXMLElement $data)
    {
        $this->detail_id       = (int)    $data->attributes()->detailid;
        $this->formattedoem    = (string) $data->attributes()->formattedoem;
        $this->manufacturer    = (string) $data->attributes()->manufacturer;
        $this->manufacturer_id = (int)    $data->attributes()->manufacturerid;
        $this->name            = (string) $data->attributes()->name;
        $this->oem             = (string) $data->attributes()->oem;
        $this->weight          = (string) $data->attributes()->weight;
        $this->is_replacement  = (boolean)$data->is_replacement;

        if ($data->images) {
            foreach ($data->images->image as $image) {
                $newImage = new \stdClass();

                $newImage->filename          = $image->attributes()->filename;
                $newImage->height            = $image->attributes()->height;
                $newImage->width             = $image->attributes()->width;
                $newImage->thumbnailfilename = $image->attributes()->thumbnailfilename;

                $this->images[] = $newImage;
            }

        }

        if ($data->replacement_attrs) {
            $replacementAttrs = json_decode(json_encode($data->replacement_attrs), true);
            $this->replacement_attributes = $replacementAttrs['@attributes'];
        }

        if ($data->properties) {
            $props = [];
            $dataProps = json_decode(json_encode($data->properties),true);

            if (!empty($dataProps['property']) || !empty($dataProps[0]['property'])) {
                $propsArr = !empty($dataProps['property']) ? $dataProps['property'] : [$dataProps[0]['property']];
                foreach ($propsArr as $prop) {
                    $props[] = $prop['@attributes'];
                }
                $this->properties = $props;
            }
        }

        if (!empty($data->replacements->replacement)) {
            foreach ($data->replacements->replacement as $replacement) {
                $replacementData = $replacement->detail;
                $replacementData->is_replacement = true;
                $replacement_attrs = json_decode(json_encode($replacement), true);
                $replacementNode = $replacementData->addChild('replacement_attrs');

                foreach ($replacement_attrs['@attributes'] as $replaceAttrName => $replacrAttr) {
                    $replacementNode->addAttribute($replaceAttrName, $replacrAttr);
                }
                $this->replacements[] = new AftermarketDetailObject($replacementData);
            }
        }
    }
}
<?php


namespace shude\Laximo;


use shude\Laximo\Client\SoapClientInterface;
use shude\Laximo\Objects\AftermarketDetailObject;
use shude\Laximo\Objects\AftermarketDetailsListObject;
use shude\Laximo\Objects\AftermarketReplacementsListObject;
use shude\Laximo\Objects\CatalogListObject;
use shude\Laximo\Objects\CatalogObject;
use shude\Laximo\Objects\CategoryListObject;
use shude\Laximo\Objects\DetailListObject;
use shude\Laximo\Objects\DetailReferencesListObject;
use shude\Laximo\Objects\FilterObject;
use shude\Laximo\Objects\ImageMapObject;
use shude\Laximo\Objects\ListQuickDetailObject;
use shude\Laximo\Objects\ListQuickGroupObject;
use shude\Laximo\Objects\UnitListObject;
use shude\Laximo\Objects\UnitObject;
use shude\Laximo\Objects\VehicleListObject;
use shude\Laximo\Objects\VehicleObject;
use shude\Laximo\Objects\WizardNextStep;
use shude\Laximo\Objects\WizardObject;
use shude\Laximo\Objects\WizardStepObject;
use shude\Laximo\Query\Query;
use shude\Laximo\Query\QueryBuilderInterface;

class Laximo
{
    private $client;
    private $queryBuilder;
    private $locale;
    private $resultObjectStack = [];

    public function __construct(SoapClientInterface $client, QueryBuilderInterface $queryBuilder, string $locale = 'ru_RU')
    {
        $this->client = $client;
        $this->queryBuilder = $queryBuilder;
        $this->locale = $locale;
    }

    protected function addQuery(string $command, array $params)
    {
        $this->queryBuilder->addQuery(
            new Query($command, $params)
        );
    }

    public function addFindOem(string $oem, $options, $brand = '', $replacementTypes = '') : self
    {
        $this->addQuery('FindOEM',[
            'Locale' => $this->locale,
            'OEM' => $oem,
            'Options' => $options,
            'Brand' => $brand,
            'ReplacementTypes' => $replacementTypes
        ]);

        $this->resultObjectStack[] = AftermarketDetailsListObject::class;
        return $this;
    }

    public function addFindDetail(int $detailId, $options) : self
    {
        $this->addQuery('FindDetail',[
            'Locale' => $this->locale,
            'DetailId' => $detailId,
            'Options' => $options
        ]);

        $this->resultObjectStack[] = AftermarketDetailsListObject::class;
        return $this;
    }

    public function addFindOEMCorrection(string $oem, $brand = '') : self
    {
        $this->addQuery('FindOEMCorrection',[
            'Locale' => $this->locale,
            'Brand' => $brand,
            'OEM' => $oem,
        ]);

        $this->resultObjectStack[] = AftermarketDetailsListObject::class;
        return $this;
    }

    public function addFindReplacements(int $detailId) : self
    {
        $this->addQuery('FindReplacements',[
            'Locale' => $this->locale,
            'DetailId' => $detailId,
        ]);

        $this->resultObjectStack[] = AftermarketReplacementsListObject::class;
        return $this;
    }

    public function addListCatalogs() : self
    {
        $this->addQuery('ListCatalogs',[
            'Locale' => $this->locale
        ]);

        $this->resultObjectStack[] = CatalogListObject::class;
        return $this;
    }

    public function addGetCatalogInfo(string $catalog, string $ssd = '') : self
    {
        $this->addQuery('GetCatalogInfo',[
            'Locale' => $this->locale,
            'Catalog' => $catalog,
            'ssd' => $ssd
        ]);

        $this->resultObjectStack[] = CatalogObject::class;

        return $this;
    }

    public function addGetWizard2(string $catalog, string $ssd = '') : self
    {
        $this->addQuery('GetWizard2',[
            'Locale' => $this->locale,
            'Catalog' => $catalog,
            'ssd' => $ssd
        ]);

        $this->resultObjectStack[] = WizardObject::class;

        return $this;
    }

    public function addFindVehicleByWizard2(string $catalog, string $ssd) : self
    {
        $this->addQuery('FindVehicleByWizard2',[
            'Locale' => $this->locale,
            'Catalog' => $catalog,
            'ssd' => $ssd
        ]);

        $this->resultObjectStack[] = VehicleListObject::class;

        return $this;
    }

    public function addGetWizardNextStep2($catalog, $ssd = '')
    {
        $this->addQuery('GetWizardNextStep2',[
            'Locale' => $this->locale,
            'Catalog' => $catalog,
            'ssd' => $ssd
        ]);

        $this->resultObjectStack[] = WizardNextStep::class;

        return $this;
    }

    public function addFindVehicle(string $identity) : self
    {
        $this->addQuery('FindVehicle',[
            'Locale' => $this->locale,
            'IdentString' => $identity
        ]);

        $this->resultObjectStack[] = VehicleListObject::class;

        return $this;
    }

    public function addGetVehicleInfo(string $vehicleId, string $catalog, string $ssd) : self
    {
        $this->addQuery('GetVehicleInfo',[
            'Locale'    => $this->locale,
            'Catalog'   => $catalog,
            'VehicleId' => $vehicleId,
            'ssd'       => $ssd,
            'Localized' => 'true'
        ]);

        $this->resultObjectStack[] = VehicleObject::class;

        return $this;
    }

    public function addFindVehicleByVIN(string $vin, string $catalog = '', string $ssd = '') : self
    {
        $this->addQuery('FindVehicleByVIN',[
            'Locale'    => $this->locale,
            'Catalog'   => $catalog,
            'VIN'       => $vin,
            'ssd'       => $ssd,
            'Localized' => 'true'
        ]);

        $this->resultObjectStack[] = VehicleListObject::class;

        return $this;
    }

    public function addFindVehicleByFrameNo(string $frame, string $catalog = '', string $ssd = '') : self
    {
        $this->addQuery('FindVehicleByFrameNo',[
            'Locale'    => $this->locale,
            'Catalog'   => $catalog,
            'FrameNo'   => $frame,
            'ssd'       => $ssd,
            'Localized' => 'true'
        ]);

        $this->resultObjectStack[] = VehicleListObject::class;

        return $this;
    }

    public function addListCategories(string $vehicleId, string $categoryId, string $catalog, string $ssd) : self
    {
        $this->addQuery('ListCategories',[
            'Locale'     => $this->locale,
            'Catalog'    => $catalog,
            'VehicleId'  => $vehicleId,
            'CategoryId' => $categoryId,
            'ssd'        => $ssd
        ]);

        $this->resultObjectStack[] = CategoryListObject::class;

        return $this;
    }

    public function addListUnits(string $vehicleId, string $categoryId, string $catalog, string $ssd) : self
    {
        $this->addQuery('ListUnits',[
            'Locale'     => $this->locale,
            'Catalog'    => $catalog,
            'VehicleId'  => $vehicleId,
            'CategoryId' => $categoryId,
            'ssd'        => $ssd,
            'Localized'  => 'true'
        ]);

        $this->resultObjectStack[] = UnitListObject::class;

        return $this;
    }

    public function addGetUnitInfo(string $unitId, string $catalog, string $ssd) : self
    {
        $this->addQuery('GetUnitInfo',[
            'Locale'    => $this->locale,
            'Catalog'   => $catalog,
            'UnitId'    => $unitId,
            'ssd'       => $ssd,
            'Localized' => 'true'
        ]);

        $this->resultObjectStack[] = UnitObject::class;

        return $this;
    }

    public function addListImageMapByUnit(string $unitId, string $catalog, string $ssd) : self
    {
        $this->addQuery('ListImageMapByUnit',[
            'Catalog' => $catalog,
            'UnitId' => $unitId,
            'ssd' => $ssd,
        ]);

        $this->resultObjectStack[] = ImageMapObject::class;

        return $this;
    }

    public function addListDetailByUnit(string $unitId, string $catalog, string $ssd) : self
    {
        $this->addQuery('ListDetailByUnit',[
            'Locale'    => $this->locale,
            'Catalog'   => $catalog,
            'UnitId'    => $unitId,
            'ssd'       => $ssd,
            'Localized' => 'true'
        ]);

        $this->resultObjectStack[] = DetailListObject::class;

        return $this;
    }

    public function addGetFilterByUnit(string $filter, string $unitId, string $vehicleId, string $catalog, string $ssd) : self
    {
        $this->addQuery('GetFilterByUnit',[
            'Locale'    => $this->locale,
            'Catalog'   => $catalog,
            'Filter'    => $filter,
            'VehicleId' => $vehicleId,
            'UnitId'    => $unitId,
            'ssd'       => $ssd
        ]);

        $this->resultObjectStack[] = FilterObject::class;

        return $this;
    }

    public function addGetFilterByDetail(string $filter, string $detailId, string $unitId, string $vehicleId, string $catalog, string $ssd) : self
    {
        $this->addQuery('GetFilterByDetail',[
            'Locale'    => $this->locale,
            'Catalog'   => $catalog,
            'Filter'    => $filter,
            'VehicleId' => $vehicleId,
            'UnitId'    => $unitId,
            'DetailId'  => $detailId,
            'ssd'       => $ssd
        ]);

        $this->resultObjectStack[] = FilterObject::class;

        return $this;
    }

    public function addFindApplicableVehicles(string $oem, string $catalog, string $ssd) : self
    {
        $this->addQuery('FindApplicableVehicles',[
            'OEM'     => $oem,
            'Catalog' => $catalog,
            'ssd'     => $ssd,
            'Locale'  => $this->locale
        ]);

        $this->resultObjectStack[] = VehicleListObject::class;

        return $this;
    }

    public function addFindPartReferences(string $oem)
    {
        $this->addQuery('FINDPARTREFERENCES',[
            'Locale' => $this->locale,
            'OEM'    => $oem
        ]);

        $this->resultObjectStack[] = DetailReferencesListObject::class;
    }

    public function addListQuickGroups($catalog, $vehicleId, $ssd) : self
    {
        $this->addQuery('ListQuickGroup',[
            'Locale' => $this->locale,
            'Catalog' => $catalog,
            'VehicleId' => $vehicleId,
            'ssd' => $ssd
        ]);

        $this->resultObjectStack[] = ListQuickGroupObject::class;
        return $this;
    }

    public function addListQuickDetails($catalog, $vehicleId, $ssd, $quickGroupId) : self
    {
        $this->addQuery('ListQuickDetail',[
            'Locale' => $this->locale,
            'Catalog' => $catalog,
            'VehicleId' => $vehicleId,
            'QuickGroupId' => $quickGroupId,
            'All' => 1,
            'ssd' => $ssd
        ]);

        $this->resultObjectStack[] = ListQuickDetailObject::class;
        return $this;
    }

    public function execute()
    {
        $query = $this->queryBuilder->buildQueryString();
        $this->queryBuilder->clear();

        $data  =  $this->client->executeQuery($query);

        $data  = simplexml_load_string($data);

        $result = [];
        if ($data && method_exists(get_class($data), 'children')) {
            foreach ($data->children() as $row) {
                $result[] = $row;
            }
        }

        $objects = [];
        foreach ($result as $r){
            $class = array_pop($this->resultObjectStack);
            $objects[] = new $class($r);
        }

        return $objects;
    }
}
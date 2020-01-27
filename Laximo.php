<?php


namespace shude\Laximo;


use shude\Laximo\Client\SoapClientInterface;
use shude\Laximo\Objects\CatalogListObject;
use shude\Laximo\Objects\CatalogObject;
use shude\Laximo\Objects\CategoryListObject;
use shude\Laximo\Objects\DetailListObject;
use shude\Laximo\Objects\FilterObject;
use shude\Laximo\Objects\ImageMapObject;
use shude\Laximo\Objects\UnitListObject;
use shude\Laximo\Objects\UnitObject;
use shude\Laximo\Objects\VehicleListObject;
use shude\Laximo\Objects\VehicleObject;
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

    public function addListCatalogs()
    {
        $this->addQuery('ListCatalogs',[
            'Locale' => $this->locale
        ]);

        $this->resultObjectStack[] = CatalogListObject::class;
    }

    public function addGetCatalogInfo(string $catalog, string $ssd = '')
    {
        $this->addQuery('GetCatalogInfo',[
            'Locale' => $this->locale,
            'Catalog' => $catalog,
            'ssd' => $ssd
        ]);

        $this->resultObjectStack[] = CatalogObject::class;
    }

    public function addFindVehicle(string $identity)
    {
        $this->addQuery('FindVehicle',[
            'Locale' => $this->locale,
            'IdentString' => $identity
        ]);

        $this->resultObjectStack[] = VehicleListObject::class;
    }

    public function addGetVehicleInfo(string $vehicleId, string $catalog, string $ssd)
    {
        $this->addQuery('GetVehicleInfo',[
            'Locale'    => $this->locale,
            'Catalog'   => $catalog,
            'VehicleId' => $vehicleId,
            'ssd'       => $ssd,
            'Localized' => 'true'
        ]);

        $this->resultObjectStack[] = VehicleObject::class;
    }

    public function addFindVehicleByVIN(string $vin, string $catalog = '', string $ssd = '')
    {
        $this->addQuery('FindVehicleByVIN',[
            'Locale'    => $this->locale,
            'Catalog'   => $catalog,
            'VIN'       => $vin,
            'ssd'       => $ssd,
            'Localized' => 'true'
        ]);

        $this->resultObjectStack[] = VehicleListObject::class;
    }

    public function addFindVehicleByFrameNo(string $frame, string $catalog = '', string $ssd = '')
    {
        $this->addQuery('FindVehicleByFrameNo',[
            'Locale'    => $this->locale,
            'Catalog'   => $catalog,
            'FrameNo'   => $frame,
            'ssd'       => $ssd,
            'Localized' => 'true'
        ]);

        $this->resultObjectStack[] = VehicleListObject::class;
    }

    public function addListCategories(string $vehicleId, string $categoryId, string $catalog, string $ssd)
    {
        $this->addQuery('ListCategories',[
            'Locale'     => $this->locale,
            'Catalog'    => $catalog,
            'VehicleId'  => $vehicleId,
            'CategoryId' => $categoryId,
            'ssd'        => $ssd
        ]);

        $this->resultObjectStack[] = CategoryListObject::class;
    }

    public function addListUnits(string $vehicleId, string $categoryId, string $catalog, string $ssd)
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
    }

    public function addGetUnitInfo(string $unitId, string $catalog, string $ssd)
    {
        $this->addQuery('GetUnitInfo',[
            'Locale'    => $this->locale,
            'Catalog'   => $catalog,
            'UnitId'    => $unitId,
            'ssd'       => $ssd,
            'Localized' => 'true'
        ]);

        $this->resultObjectStack[] = UnitObject::class;
    }

    public function addListImageMapByUnit(string $unitId, string $catalog, string $ssd)
    {
        $this->addQuery('ListImageMapByUnit',[
            'Catalog' => $catalog,
            'UnitId' => $unitId,
            'ssd' => $ssd,
        ]);

        $this->resultObjectStack[] = ImageMapObject::class;
    }

    public function addListDetailByUnit(string $unitId, string $catalog, string $ssd)
    {
        $this->addQuery('ListDetailByUnit',[
            'Locale'    => $this->locale,
            'Catalog'   => $catalog,
            'UnitId'    => $unitId,
            'ssd'       => $ssd,
            'Localized' => 'true'
        ]);

        $this->resultObjectStack[] = DetailListObject::class;
    }

    public function addGetFilterByUnit(string $filter, string $unitId, string $vehicleId, string $catalog, string $ssd)
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
    }

    public function addGetFilterByDetail(string $filter, string $detailId, string $unitId, string $vehicleId, string $catalog, string $ssd)
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
    }

    public function addFindApplicableVehicles(string $oem, string $catalog, string $ssd)
    {
        $this->addQuery('FindApplicableVehicles',[
            'OEM'     => $oem,
            'Catalog' => $catalog,
            'ssd'     => $ssd,
            'Locale'  => $this->locale
        ]);

        $this->resultObjectStack[] = VehicleListObject::class;
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
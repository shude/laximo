<?php


namespace shude\Laximo\Client;


class SoapClient extends \SoapClient implements SoapClientInterface
{
    private const DEFAULT_LOCATION = 'http://ws.laximo.net/ec.Kito.WebCatalog/services/Catalog.CatalogHttpSoap11Endpoint/';
    private const DEFAULT_URI = 'http://WebCatalog.Kito.ec';
    private $credential;

    public function __construct(CredentialInterface $credential, string $location = null, string $uri = null)
    {
       parent::__construct(null, [
           'location' => $location ?? self::DEFAULT_LOCATION,
           'uri' => $uri ?? self::DEFAULT_URI
       ]);

       $this->credential = $credential;
    }

    public function executeQuery(string $query)
    {
        $arguments = [
            $query,
            $this->credential->getLogin(),
            $this->credential->queryHash($query)
        ];

        return $this->__call(
            'QueryDataLogin',
            $arguments
        );
    }
}
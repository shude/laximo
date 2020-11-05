<?php


namespace shude\Laximo\Client;


interface SoapClientInterface
{
    public function executeQuery(string $query);
}
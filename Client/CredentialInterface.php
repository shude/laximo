<?php


namespace shude\Laximo\Client;


interface CredentialInterface
{
    public function queryHash(string $query) : string;
    public function getLogin() : string;
}
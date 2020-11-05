<?php


namespace shude\Laximo\Client;


class BasicCredentials implements CredentialInterface
{
    private $login;
    private $key;

    public function __construct(string $login = '', string $key = '')
    {
        $this->login = $login;
        $this->key   = $key;
    }

    public function queryHash(string $query): string
    {
        return md5($query . $this->key);
    }

    public function getLogin(): string
    {
        return $this->login;
    }
}
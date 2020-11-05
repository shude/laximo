<?php


namespace shude\Laximo\Query;


interface QueryBuilderInterface
{
    public function addQuery(QueryInterface $query);
    public function clear();

    public function buildQueryString() : string;
}
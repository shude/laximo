<?php


namespace shude\Laximo\Query;


class QueryBuilder implements QueryBuilderInterface
{
    private $queries = [];
    private $queryStrings = [];

    public function addQuery(QueryInterface $query)
    {
        $this->queries[] = $query;
        $this->queryStrings[] = $query->getQueryString();
    }

    public function clear()
    {
        $this->queries = [];
        $this->queryStrings = [];
    }


    public function buildQueryString(): string
    {
        return implode("\n", $this->queryStrings);
    }

}
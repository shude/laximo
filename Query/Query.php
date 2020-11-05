<?php


namespace shude\Laximo\Query;


class Query implements QueryInterface
{
    private $command;
    private $params;

    public function __construct(string $command, array $params)
    {
        $this->command = $command;
        $this->params  = $params;
    }

    public function getQueryString(): string
    {
        if(empty($this->params)) return $this->command;

        $query = $this->command . ':';
        $stack = [];
        foreach ($this->params as $key => $value){
            $stack[] = $key .'='.$value;
        }

        $query .= implode('|', $stack);

        return $query;
    }
}
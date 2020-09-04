<?php


namespace shude\Laximo\Tests\Query;


use PHPUnit\Framework\TestCase;
use shude\Laximo\Query\Query;

final class QueryTest extends TestCase
{
    public function testBuildCorrectQueryString()
    {
        $query = new Query('test_command',['param1'=>'value1', 'param2' => 'value2']);

        $this->assertEquals('test_command:param1=value1|param2=value2', $query->getQueryString());
    }
}
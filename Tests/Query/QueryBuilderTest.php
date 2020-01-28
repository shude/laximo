<?php


namespace shude\Laximo\Tests\Query;


use PHPUnit\Framework\TestCase;
use shude\Laximo\Query\Query;
use shude\Laximo\Query\QueryBuilder;

final class QueryBuilderTest extends TestCase
{
    public function testBuildCorrectQueryStringWithOneQuery()
    {
        $query = $this->createMock(Query::class);
        $query->method('getQueryString')->willReturn('Some command');

        $builder = new QueryBuilder();
        $builder->addQuery($query);

        $this->assertEquals('Some command',$builder->buildQueryString());
    }

    public function testBuildCorrectQueryStringWithMultiQueries()
    {
        $query = $this->createMock(Query::class);
        $query->method('getQueryString')->will(
            $this->onConsecutiveCalls('First', 'Second')
        );

        $builder = new QueryBuilder();
        $builder->addQuery($query);
        $builder->addQuery($query);

        $this->assertEquals("First\nSecond",$builder->buildQueryString());
    }

    public function testClearWorksCorrectly()
    {
        $query = $this->createMock(Query::class);
        $query->method('getQueryString')->willReturn('Some command');

        $builder = new QueryBuilder();
        $builder->addQuery($query);
        $builder->clear();

        $this->assertEmpty($builder->buildQueryString());
    }
}
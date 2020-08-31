<?php

use PHPUnit\Framework\TestCase;
use Utils\QueryBuilder;

class QueryBuilderTest extends TestCase
{
    private $query;

    public function setUp() {
        $this->query = new QueryBuilder();
    }

    public function testInstance() {
        $this->assertInstanceOf(QueryBuilder::class, $this->query);
    }

    public function testSelect() {
        $query = new QueryBuilder();
        $this->assertInstanceOf(QueryBuilder::class, $query->select('column_a'));
        $this->assertContains('column_a', $query->getSelect());
        $query = null;

    }

    public function testSelectAliases() {
        $query = new QueryBuilder();
        $this->assertInstanceOf(QueryBuilder::class, $query->select('column_a', 'a'));
        $this->assertContains('column_a', $query->getSelect());
        $this->assertArrayHasKey('column_a', $query->getSelectAliases());
        $this->assertEquals('a', $query->getSelectAliases()['column_a']);
        $query = null;
    }

    public function testFrom() {
        $query = new QueryBuilder();
        $this->assertInstanceOf(QueryBuilder::class, $query->select('*')->from('table_a'));
        $this->assertContains('table_a', $query->getFrom());
        $query = null;

    }

    public function testFromAliases() {
        $query = new QueryBuilder();
        $this->assertInstanceOf(QueryBuilder::class, $query->select('*')->from('table_a', 'a'));
        $this->assertContains('table_a', $query->getFrom());
        $this->assertArrayHasKey('table_a', $query->getFromAliases());
        $this->assertEquals('a', $query->getFromAliases()['table_a']);
        $query = null;

    }

}


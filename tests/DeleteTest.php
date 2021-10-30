<?php

use PHPUnit\Framework\TestCase;
use DinoDev\MySql\Classes\MySql;
use DinoDev\MySql\Classes\Delete;
use DinoDev\MySql\Classes\Insert;

require_once __DIR__ . "/../vendor/autoload.php";

class DeleteTest extends TestCase
{
    public MySql $MySql;
    public Delete $Delete;

    protected function setUp(): void
    {
        $this->MySql = new MySql("localhost", "root", "MySql", "world", $state);
        $this->Delete = new Delete($this->MySql);

        //Create a Temporary Table
        $this->MySql->queryAndFetch("CREATE TABLE IF NOT EXISTS TempTable ( TestValue  varchar(50) )");
    }

    protected function tearDown(): void
    {
        //Delete the Temporary Table
        $this->MySql->queryAndFetch("DROP TABLE temptable");
    }

    public function testAll()
    {
        //Delete
        $this->assertTrue($this->Delete->All("TempTable"));
        $this->assertFalse($this->Delete->All("NoTable"));
    }

    public function testWhere()
    {
        //Insert a Value
        $Insert = new Insert($this->MySql);
        $Insert->Insert("TempTable", ["TestValue"], ["Hello"]);

        //Delete
        $this->assertTrue($this->Delete->Where("TempTable", "TestValue", "Hello"));
        $this->assertFalse($this->Delete->Where("NoTable", "TestValue", "Hello"));
    }

    public function testLike()
    {
        //Insert a Value
        $Insert = new Insert($this->MySql);
        $Insert->Insert("TempTable", ["TestValue"], ["Hello"]);

        //Delete
        $this->assertTrue($this->Delete->Like("TempTable", "TestValue", "Hello"));
        $this->assertFalse($this->Delete->Like("NoTable", "TestValue", "Hello"));
    }
}

<?php

use PHPUnit\Framework\TestCase;
use DinoDev\MySql\Classes\MySql;
use DinoDev\MySql\Classes\Insert;

require_once __DIR__ . "/../vendor/autoload.php";

class InsertTest extends TestCase
{
    public MySql $MySql;
    public Insert $Insert;

    protected function setUp(): void
    {
        $this->MySql = new MySql("localhost", "root", "MySql", "world", $state);
        $this->Insert = new Insert($this->MySql);
    }

    public function testInsert()
    {
        //Create a Temporary Table
        $this->MySql->queryAndFetch("CREATE TABLE IF NOT EXISTS TempTable ( TestValue  varchar(50) )");

        //Insert
        $this->assertTrue($this->Insert->Insert("TempTable", ["TestValue"], ["Hello"]));
        $this->assertFalse($this->Insert->Insert("NoTable", [], []));

        //Delete the Temporary Table
        $this->MySql->queryAndFetch("DROP TABLE temptable");

        
    }
}

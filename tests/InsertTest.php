<?php

use PHPUnit\Framework\TestCase;
use DinoDev\MySql\Classes\{
    Create,
    Drop,
    Insert,
    MySql,
};

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
        $Create = new Create($this->MySql);
        $Create->Table("Test", ["TestValue"], ["varchar(50)"]);

        //Insert
        $this->assertTrue($this->Insert->Insert("Test", ["TestValue"], ["Hello"]));
        $this->assertFalse($this->Insert->Insert("NoTable", [], []));

        //Delete the Temporary Table
        $Drop = new Drop($this->MySql);
        $Drop->Table("Test");     
    }
}

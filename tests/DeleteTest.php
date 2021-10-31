<?php

use PHPUnit\Framework\TestCase;
use DinoDev\MySql\Classes\{
    Create,
    Delete,
    Drop,
    Insert,
    MySql,
};

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
        $Create = new Create($this->MySql);
        $Create->Table("Test", ["TestValue"], ["varchar(50)"]);
    }

    protected function tearDown(): void
    {
        //Delete the Temporary Table
        $Drop = new Drop($this->MySql);
        $Drop->Table("Test");
    }

    public function testAll()
    {
        //Delete
        $this->assertTrue($this->Delete->All("Test"));
        $this->assertFalse($this->Delete->All("NoTable"));
    }

    public function testWhere()
    {
        //Insert a Value
        $Insert = new Insert($this->MySql);
        $Insert->Insert("Test", ["TestValue"], ["Hello"]);

        //Delete
        $this->assertTrue($this->Delete->Where("Test", "TestValue", "Hello"));
        $this->assertFalse($this->Delete->Where("NoTable", "TestValue", "Hello"));
    }

    public function testLike()
    {
        //Insert a Value
        $Insert = new Insert($this->MySql);
        $Insert->Insert("Test", ["TestValue"], ["Hello"]);

        //Delete
        $this->assertTrue($this->Delete->Like("Test", "TestValue", "Hello"));
        $this->assertFalse($this->Delete->Like("NoTable", "TestValue", "Hello"));
    }
}

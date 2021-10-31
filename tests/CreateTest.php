<?php

use PHPUnit\Framework\TestCase;
use DinoDev\MySql\Classes\MySql;
use DinoDev\MySql\Classes\Create;
use DinoDev\MySql\Classes\Drop;

require_once __DIR__ . "/../vendor/autoload.php";

class CreateTest extends TestCase
{
    public MySql $MySql;
    public Create $Create;

    protected function setUp(): void
    {
        $this->MySql = new MySql("localhost", "root", "MySql", "world", $state);
        $this->Create = new Create($this->MySql);
    }

    public function testTable()
    {
        //Drop table, case exists
        $Drop = new Drop($this->MySql);
        $Drop->Table("Test");

        $this->assertTrue($this->Create->Table("Test", ["Value 1", "Value 2"], ["varchar(20)", "varchar(20)"]));

        $this->assertFalse($this->Create->Table("Test", ["Value 1", "Value 2"], ["varchar(20)", "varchar(20)"]));        
        
        $Drop->Table("Test");
    }
}

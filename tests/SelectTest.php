<?php

use PHPUnit\Framework\TestCase;
use DinoDev\MySql\Classes\{
    MySql,
    Select
};

require_once __DIR__ . "/../vendor/autoload.php";

class SelectTest extends TestCase
{
    public MySql $MySql;
    public Select $Select;

    protected function setUp(): void
    {
        $this->MySql = new MySql("localhost", "root", "MySql", "world", $state);
        $this->Select = new Select($this->MySql);
    }

    public function testAll()
    {
        $this->assertIsArray($this->Select->All("country"));
        $this->assertFalse($this->Select->All("NoTable"));
    }

    public function testWhere()
    {
        $this->assertIsArray($this->Select->Where("country", "Name", "Brazil"));
        $this->assertEmpty($this->Select->Where("country", "Name", "Brasil"));

        $this->assertFalse($this->Select->Where("NoTable", "Name", "Brazil"));
    }

    public function testLike()
    {
        $this->assertIsArray($this->Select->Like("country", "Name", "Braz"));
        $this->assertEmpty($this->Select->Like("country", "Name", "Bras"));

        $this->assertFalse($this->Select->Like("NoTable", "Name", "Braz"));        
    }
}

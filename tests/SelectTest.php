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

        $this->assertCount(5, $this->Select->All("country", limit:5));

        $this->assertEquals("ABW", $this->Select->All("country", "Code", 2)[0]["Code"]);
        $this->assertEquals("AFG", $this->Select->All("country", "Code", 2)[1]["Code"]);
    }

    public function testWhere()
    {
        $this->assertIsArray($this->Select->Where("country", "Name", "Brazil"));
        $this->assertEmpty($this->Select->Where("country", "Name", "Brasil"));

        $this->assertFalse($this->Select->Where("NoTable", "Name", "Brazil"));

        $this->assertCount(5, $this->Select->Where("country", "Region", "South America", limit:5));

        $this->assertEquals("BRA", $this->Select->Where("country", "Code", "BRA", "Code", 2)[0]["Code"]);
        $this->assertEquals("ARG", $this->Select->Where("country", "Code", "ARG", "Code", 2)[0]["Code"]);
    }

    public function testLike()
    {
        $this->assertIsArray($this->Select->Like("country", "Name", "Braz"));
        $this->assertEmpty($this->Select->Like("country", "Name", "Bras"));

        $this->assertFalse($this->Select->Like("NoTable", "Name", "Braz")); 
        
        $this->assertCount(5, $this->Select->Like("country", "Region", "th Ame", limit:5));

        $this->assertEquals("BRA", $this->Select->Like("country", "Code", "BRA", "Code", 2)[0]["Code"]);
        $this->assertEquals("ARG", $this->Select->Like("country", "Code", "ARG", "Code", 2)[0]["Code"]);       
    }
}

<?php

use PHPUnit\Framework\TestCase;
use DinoDev\MySql\Classes\MySql;

require_once __DIR__ . "/../vendor/autoload.php";

class MySqlTest extends TestCase
{
    /**
     * @dataProvider sendTestConstructor
     */
    public function testConstructor(string $Database, string $AssertType)
    {
        //Arrange & Act
        new MySql("localhost", "root", "MySql", $Database, $state);
        
        //Assert
        $this->assertFalse(gettype($state) === $AssertType);
    }

    public function testQueryAndFetch()
    {
        //Arrange & Act
        $MySql = new MySql("localhost", "root", "MySql", "world", $state);

        $this->assertIsArray($MySql->queryAndFetch("SELECT * FROM city WHERE ID = 1;"));
        $this->assertEmpty($MySql->queryAndFetch("SELECT * FROM city WHERE ID = 0;"));

        $this->assertFalse($MySql->queryAndFetch("SELECT * FROM NoDatabase.city WHERE ID = 0;"));
    }

    public function sendTestConstructor()
    {
        return [ [ "NoDatabase", "String" ], [ "world", "Boolean" ] ];
    }
}

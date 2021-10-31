<?php

namespace DinoDev\MySql\Classes;

class Drop extends MySql
{
    protected MySql $MySql;

    public function __construct(MySql $_MySql)
    {
        $this->MySql = $_MySql;
    }

    public function Table(string $tableName)
    {
        return $this->MySql->query("DROP TABLE $tableName");
    }
}

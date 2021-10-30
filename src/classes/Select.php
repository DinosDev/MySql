<?php
namespace DinoDev\MySql\Classes;
use DinoDev\MySql\Classes\MySql;

class Select extends MySql
{
    protected MySql $MySql;

    public function __construct(MySql $_MySql)
    {
        $this->MySql = $_MySql;
    }

    public function All(string $table)
    {
        return $this->MySql->queryAndFetch("SELECT * FROM $table");
    }

    public function Where(string $table, string $field, $value)
    {
        $valueCorrection = gettype($value) == "string" ? "'$value'" : $value;

        return $this->MySql->queryAndFetch("SELECT * FROM $table WHERE $field = $valueCorrection");
    }

    public function Like(string $table, string $field, $value)
    {
        $valueType = gettype($value);

        if ($valueType == "string") {
            return $this->MySql->queryAndFetch("SELECT * FROM $table WHERE $field LIKE '%$value%'");
        } else {
            $message = "Value type is incorrect. Value has to be an String. Value type: " . $valueType;

            throw new \RuntimeException($message);
        }
    }
}
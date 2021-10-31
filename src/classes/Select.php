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

    public function All(string $table, int $limit = null)
    {
        $sql = "SELECT * FROM $table";
        $sql .= $limit ? " LIMIT $limit" : "";

        return $this->MySql->queryAndFetch($sql);
    }

    public function Where(string $table, string $field, $value, int $limit = null)
    {
        $valueCorrection = gettype($value) == "string" ? "'$value'" : $value;

        $sql = "SELECT * FROM $table WHERE $field = $valueCorrection";
        $sql .= $limit ? " LIMIT $limit" : "";

        return $this->MySql->queryAndFetch($sql);
    }

    public function Like(string $table, string $field, $value, int $limit = null)
    {
        $valueType = gettype($value);

        if ($valueType == "string") {
            $sql = "SELECT * FROM $table WHERE $field LIKE '%$value%'";
            $sql .= $limit ? " LIMIT $limit" : "";

            return $this->MySql->queryAndFetch($sql);
        } else {
            $message = "Value type is incorrect. Value has to be an String. Value type: " . $valueType;

            throw new \RuntimeException($message);
        }
    }
}

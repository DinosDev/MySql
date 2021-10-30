<?php

namespace DinoDev\MySql\Classes;

class Delete extends MySql
{
    protected MySql $MySql;

    public function __construct(MySql $_MySql)
    {
        $this->MySql = $_MySql;
    }

    public function All(string $table)
    {
        return $this->MySql->query("DELETE FROM $table");
    }

    public function Where(string $table, string $field, $value)
    {
        $valueType = gettype($value);

        if ($valueType == "string") {
            $this->MySql->query("DELETE FROM $table WHERE $field = '$value'");
            
            //If no Rows have been modified
            if($this->MySql->getAffectedRows() <= 0)
                return false;
            
            return true;
        }
        $this->MySql->query("DELETE FROM $table WHERE $field = $value");

        //If no Rows have been modified
        if($this->MySql->getAffectedRows() <= 0)
            return false;

        return true;
    }

    public function Like(string $table, string $field, $value)
    {
        $valueType = gettype($value);

        if ($valueType == "string") {
            return $this->MySql->query("DELETE FROM $table WHERE $field LIKE '%$value%'");
        } else {
            $message = "Value type is incorrect. Value has to be an String. Value type: " . $valueType;

            throw new \RuntimeException($message);
        }
    }
}

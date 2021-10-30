<?php

namespace DinoDev\MySql\Classes;

class Insert extends MySql
{
    protected MySql $MySql;

    public function __construct(MySql $_MySql)
    {
        $this->MySql = $_MySql;
    }

    public function Insert(string $table, array $fields, array $values)
    {
        $fieldsString = $this->createFieldsString($fields);
        $valuesString = $this->createValuesString($values);

        $bindParamTypes = $this->createBindParamTypes($values);

        $sql = "INSERT INTO $table ($fieldsString) VALUES ($valuesString)";

        $stmt = $this->MySql->mysqli->prepare($sql);
        if(!$stmt) return false;

        $bind_param = $stmt->bind_param($bindParamTypes, ...$values);
        $execute = $stmt->execute();
        
        //If no Rows have been modified
        if($stmt->affected_rows <= 0)
           return false;
           
        return true;
    }

    protected function createFieldsString(array $fields)
    {
        $fieldsString = '';

        foreach ($fields as $key => $value) {
            if (count($fields) == ($key + 1)) {
                $fieldsString .= "$value";
            } else {
                $fieldsString .= "$value, ";
            }
        }

        return $fieldsString;
    }

    protected function createValuesString(array $values)
    {
        $valuesString = '';

        foreach ($values as $key => $value) {
            if (count($values) == ($key + 1)) {
                $valuesString .= "?";
            } else {
                $valuesString .= "?, ";
            }
        }

        return $valuesString;
    }

    protected function createBindParamTypes(array $values)
    {
        $bindParamTypes = '';
        foreach ($values as $value) {
            $valueType = gettype($value);
            $bindParamTypes .= $valueType == "string" ? 's' : ($valueType == "int" ? 'i' : 'd');
        }

        return $bindParamTypes;
    }
}

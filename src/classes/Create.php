<?php

namespace DinoDev\MySql\Classes;

class Create extends MySql
{
    protected MySql $MySql;

    public function __construct(MySql $_MySql)
    {
        $this->MySql = $_MySql;
    }

    public function Table(string $tableName, array $valuesName, array $valuesType)
    {
        $sql = $this->generateSql($tableName, $valuesName, $valuesType);

        return $this->MySql->query($sql);
    }

    protected function generateSql(string $tableName, array $valuesName, array $valuesType)
    {
        $valuesName = $this->removeSpaces($valuesName);

        $sql = "CREATE TABLE ";
        $sql .= $tableName . " ( ";
        foreach ($valuesName as $key => $value) {
            $sql .= $value . " " . $valuesType[$key] . " ";

            $sql .= $key === array_key_last($valuesName) ? ");" : ", ";
        }

        return $sql;
    }

    protected function removeSpaces($valueToCheck)
    {
        return str_replace(" ", "", $valueToCheck);
    }
}
